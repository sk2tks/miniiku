<?php

App::uses('CakeEmail', 'Network/Email', 'Component', 'Controller');

class CommentComponent extends Component {
    /**
	 * manageComment method
	 *
	 * @param Controller $c				: コントローラー
	 * @param array $d					: $c->request->data
	 * @param int   $contents_type_id	: コンテンツタイプ。「交流広場」は7、「街の施設」は1～5。
	 * @param int   $contents_target_id	: コメントの対象となるTopic又はClientのid
	 * @param array $i					: Topic又はClient1件の詳細データ
	 * @param int   $loginUserId		: ログインユーザーID
	 * @return void
	 */
	public function manageComment(&$c, &$d, $contents_type_id, $contents_target_id, &$i, $loginUserId){
		if($contents_type_id == 7){
			//「交流広場」の場合
			$m = 'Topic';//モデル名
			$t = 'topics';//テーブル名
		}else{
			//「街の施設」の場合
			$m = 'Client';//モデル名
			$t = 'clients';//テーブル名
			$c->loadModel('Topic');//query()のため
		}
		
		//画面上部に表示したいコメントのID
		$currentComment = 0;
		//その親コメントのID
		$parentOfCurrentComment = 0;
		
		if(!empty($d['Comment']['body']) || !empty($d['Response']['body'])){
			if(!empty($d['Response']['body'])){
				//コメントへの返信がポストされたとき$d['Response']['parentCommentId']と$d['Response']['body']がViewでアサインされている。
				$d['Comment'] = $d['Response'];
				unset($d['Response']);
				$d['Comment']['parent_comment_id'] = $d['Comment']['parentCommentId'];
				unset($d['Comment']['parentCommentId']);
			}
			$d['Comment']['contents_type_id'] = $contents_type_id;
			$d['Comment']['contents_target_id'] = $contents_target_id;
			$d['Comment']['user_id'] = $loginUserId;
			
			$c->Comment->create();
			if($c->Comment->save($d)){
				$currentComment = $c->Comment->getLastInsertID();
				$parentOfCurrentComment = $c->Comment->field('parent_comment_id');
				
				//当該Topicのnum_commentsを更新
				//当該Topicへの返信を含めた総コメント数再取得
				$cnt = $c->Comment->find('count', array(
					'conditions'=>array(
						'contents_type_id'=>$contents_type_id,
						'contents_target_id'=>$contents_target_id,
						'delete_flag'=>0
					)
				));
				$i[$m]['num_comments'] = $cnt;
				$sql = "UPDATE {$t} SET num_comments={$cnt} WHERE id={$contents_target_id}";
				$c->Topic->query($sql);
				// $c->Session->setFlash(
					// __('The %s has been saved', __('comment')),
					// 'alert',
					// array(
						// 'plugin' => 'TwitterBootstrap',
						// 'class' => 'alert-success'
					// )
				// );
			}else{
				$c->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('comment')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}else if(!empty($d['Comment']['delete_flag'])){
			//delete_flagとidがポストされている。
			
			//Commentを論理削除
			$commentId = $d['Comment']['id'];
			$c->Comment->id = $commentId;
			$c->Comment->saveField('delete_flag', 1);
			//そのコメントを親とする返信Commentも論理削除⇒返信コメントは削除しないよう仕様変更
			// $sql = "UPDATE comments SET delete_flag=1 WHERE parent_comment_id={$commentId}";
			// $c->Topic->query($sql);
			
			$currentComment = $commentId;
			
			//当該Topicのnum_commentsを更新
			//当該Topicへの返信を含めた総コメント数再取得
			$cnt = $c->Comment->find('count', array(
				'conditions'=>array(
					'contents_type_id'=>$contents_type_id,
					'contents_target_id'=>$contents_target_id,
					'delete_flag'=>0
				)
			));
			$i[$m]['num_comments'] = $cnt;
			$sql = "UPDATE {$t} SET num_comments={$cnt} WHERE id={$contents_target_id}";
			$c->Topic->query($sql);
			
		}else if(!empty($d['Response']['delete_flag'])){
			//delete_flagとidがポストされている。
			
			//Commentを論理削除
			$c->Comment->id = $d['Response']['id'];
			$c->Comment->saveField('delete_flag', 1);
			
			$currentComment = $d['Response']['id'];
			$parentOfCurrentComment = $c->Comment->field('parent_comment_id');
			
			//当該Topicのnum_commentsを更新
			//当該Topicへの返信を含めた総コメント数再取得
			$cnt = $c->Comment->find('count', array(
				'conditions'=>array(
					'contents_type_id'=>$contents_type_id,
					'contents_target_id'=>$contents_target_id,
					'delete_flag'=>0
				)
			));
			$i[$m]['num_comments'] = $cnt;
			$sql = "UPDATE {$t} SET num_comments={$cnt} WHERE id={$contents_target_id}";
			$c->Topic->query($sql);
			
		}else if(!empty($d['CommentVote']['value'])){
			//既に投票しているかどうかを取得
			$voted = $c->CommentVote->find('first', array(
				'conditions'=>array(
					'user_id'=>$loginUserId,
					'comment_id'=>$d['CommentVote']['comment_id']
				)
			));
			//pr('voted:');pr($voted);
			if(empty($voted)){
				//comment_votesテーブルにレコード挿入
				$d['CommentVote']['user_id'] = $loginUserId;
				//pr('d:');pr($d);
				
				$c->CommentVote->create();
				if($c->CommentVote->save($d)){
					//valueが1ならcommentsテーブルの該当レコードのplusに1を足す。valueが2ならcommentsテーブルの該当レコードのminusに1を足す。
					if($d['CommentVote']['value'] == 1){
						$sql = 'UPDATE comments SET plus=plus+1 WHERE id=' . $d['CommentVote']['comment_id'];
					}else if($d['CommentVote']['value'] == 2){
						$sql = 'UPDATE comments SET minus=minus+1 WHERE id=' . $d['CommentVote']['comment_id'];
					}
					$c->Comment->query($sql);
					
					$c->Comment->id = $d['CommentVote']['comment_id'];
					$currentComment = $d['CommentVote']['comment_id'];
					$parentOfCurrentComment = $c->Comment->field('parent_comment_id');
				}
			}
		}else if(!empty($c->request->params['named']['comment'])){
			$currentComment = $c->request->params['named']['comment'];
			$c->Comment->id = $currentComment;
			$parentOfCurrentComment = $c->Comment->field('parent_comment_id');
			
			$c->set('commentPosted', 1);
		}
		
		//pr('currentComment:');pr($currentComment);
		//pr('parentOfCurrentComment:');pr($parentOfCurrentComment);
		
		if(!empty($d['Comment']) || !empty($d['Response']) || !empty($d['CommentVote'])){
			//「街の施設」のviewページはタブ切り替えでコメントを表示するようになっているので、
			//コメントポスト後かどうかを表す変数をsetしておき、コメントポスト後ならjsでコメントのタブをclick()する。
			$c->set('commentPosted', 1);
		}
		//ページの初期状態で当該コメントが開いていて且つスクロール位置がそこになっているようにする。
		$c->set(compact('currentComment', 'parentOfCurrentComment'));
		
		$this->setUpCommentBinding($c, $loginUserId);
		$c->paginate = array(
		 	'fields'=>array(
		 		'Comment.id', 'Comment.parent_comment_id', 'Comment.body', 'Comment.created', 
		 		'Comment.user_id', 'Comment.plus', 'Comment.minus', 'Comment.delete_flag'
			),
			'conditions'=>array(
				'Comment.contents_type_id'=>$contents_type_id,
				'Comment.contents_target_id'=>$contents_target_id, //contents_target_idはcontents_type_idが7ならtopic_idのこと。
				//'Comment.delete_flag'=>0,
				'Comment.parent_comment_id'=>null
			),
			'order'=>'created DESC', //投稿日時降順
		 	'limit'=>10
		);
		$comments = $c->Paginator->paginate('Comment');
		
		
		foreach($comments as &$com){
			$commentId = $com['Comment']['id'];
			$this->setUpCommentBinding($c, $loginUserId);//paginateかfindを行うたびに設定する必要あり。
			$responses = $c->Comment->find('all', array(
				'fields'=>array(
					'Comment.id', 'Comment.parent_comment_id', 'Comment.body', 'Comment.created', 
					'Comment.user_id', 'Comment.plus', 'Comment.minus', 'Comment.delete_flag'
				),
				'conditions'=>array(
					'Comment.contents_type_id'=>$contents_type_id,
					//'Comment.delete_flag'=>0,
					'Comment.parent_comment_id'=>$commentId
				),
				'order'=>'created', //投稿日時昇順
			));
			if(!empty($responses)){
				$com['responses'] = $responses;
			}
		}
		
		$c->set(compact('comments', 'loginUserId'));
	}

	private function setUpCommentBinding(&$c, $loginUserId){
		$c->Comment->recursive = 2;
		$c->Comment->bindModel(array(
			'belongsTo'=>array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => array('id', 'name', 'user_type', 'status'),
					'order' => ''
				),
			)
		));
		
		$c->Comment->bindModel(array(
			'hasMany'=>array(
				'CommentVote' => array(
					'className' => 'CommentVote',
					'foreignKey' => 'comment_id',
					'conditions' => array('CommentVote.user_id'=>$loginUserId),
					'fields' => array('id'),
					'order' => ''
				),
			)
		));
		
		$c->User->unbindModel(array(
			'hasOne'=>array('UserIp')
		));
		$c->User->unbindModel(array(
			'hasAndBelongsToMany'=>array('Client')
		));
		$c->Customer->virtualFields['point'] = 'SELECT (GREATEST(0, (SUM(plus) - SUM(minus))))  FROM comments WHERE comments.user_id = Customer.user_id';
		$c->User->bindModel(array(
			'hasOne'=>array(
				'Customer'=>array(
					'className'=>'Customer',
					'fields'=>array('private_flag', 'file_name', 'point'),
				)
			)
		));
	}

	public function comment_alert(&$c, $commentId = null){
		$c->autoRender = false;
		//$c->layout = 'ajax';
		//pr('commentId:' . $commentId);
		
		try{
			if(empty($commentId)) throw new Exception("入力データが正しくありません");
			if(!$c->Auth->loggedIn()) throw new Exception("ログインしてください");
			
			//通報者情報
			$reporter = $c->Session->read('user_info');
			if(empty($reporter['Customer']['user_id']) || empty($reporter['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
			$family_id = $reporter['Customer']['family_id'];
			$reporter_id = $reporter['Customer']['user_id'];
			$reporter_email = $reporter['User']['email'];
			
			//通報されたコメント情報
			$comment = $c->Comment->read(array(
				'User.id', 'User.name', 'User.email', 
				'Comment.id', 'Comment.body', 'Comment.contents_type_id', 'Comment.contents_target_id', 'Comment.parent_comment_id'
			), $commentId);
			
			$c->log('通報されたコメント情報:', LOG_DEBUG);
			$c->log($comment, LOG_DEBUG);
			
			//管理者へメール
			$data = array(
				'reporterUserName'=>$reporter['User']['name'],
				'reporterEmail'=>$reporter['User']['email'],
				'posterUserName'=>$comment['User']['name'],
				'posterEmail'=>$comment['User']['email'],
				'commentId'=>$comment['Comment']['id'],
				'commentBody'=>$comment['Comment']['body']
			);
			$mail = new CakeEmail( );
			$mail->config('bbsCommentAlert');
			$mail->from($reporter_email);
			$mail->viewVars($data);
			$sent = $mail->send();
			//pr('sent:');pr($sent);
			$c->log('通報メール送信完了。sent:', LOG_DEBUG);
			$c->log($sent, LOG_DEBUG);
			
			//comment_alertsテーブルに登録
			$data = array(
				'contents_type_id'=>$comment['Comment']['contents_type_id'], //「交流広場」は7、「街の施設」は1～5
				'contents_target_id'=>$comment['Comment']['contents_target_id'], //「交流広場」はTopicのid, 「街の施設」はClientのid
				'comment_id'=>$commentId, //通報対象であるコメントのid
				'user_id'=> $reporter_id,
				'alert_flag'=>1,
				'alert_check'=>0
			);
			
			$c->loadModel("CommentAlert");
			
			if($c->CommentAlert->save($data)){
				echo json_encode(array("status"=>'1'));
			}else{
				echo json_encode(array('status'=>'0', 'error'=>'登録できませんでした'));
			}
			
		}catch(Exception $e){
			echo json_encode(array('status'=>'0', 'error'=>$e->getMessage()));
		}
		
	}
}