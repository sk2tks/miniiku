<div class="link01">
	<?php if(empty($i['Topic']['closed'])){ ?>
	<a>
		<img id="newComment_btn" src="/sp/img/client/area/img_btn01.jpg" width="247" alt="新規コメント">
	</a>
	<?php } ?>
</div>
<?php if(empty($i['Topic']['closed'])): ?>
<!--
<div class="talk talk01">
	<p>新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。</p>
</div>
-->
<div id="comInput">
	<?php echo $this->Form->create('Comment'); ?>
	<textarea name="data[Comment][body]" cols="41" rows="5" class="postscript" style="width:98%"></textarea>
	<ul class="link02 clearfix">
		<li><a><img id="submitComment_btn" src="/sp/img/client/area/img_btn02.jpg" width="100%" alt="投稿"></a></li>
		<li><a><img id="cancelComment_btn" src="/sp/img/client/area/img_cancel.jpg" width="100%" alt="キャンセル"></a></li>
	</ul>
	<?php echo $this->Form->end(); ?>
</div>
<div id="resInput" style="display:none;margin-top:0">
	<?php echo $this->Form->create('Response'); ?>
	<textarea name="data[Response][body]" cols="41" rows="5" class="postscript" style="width:98%"></textarea>
	<input type="hidden" name="data[Response][parentCommentId]" value="" />
	<ul class="link02 clearfix">
		<li><a><img id="submitResponse_btn" src="/sp/img/client/area/img_btn02.jpg" width="100%" alt="投稿"></a></li>
		<li><a><img id="cancelResponse_btn" src="/sp/img/client/area/img_cancel.jpg" width="100%" alt="キャンセル"></a></li>
	</ul>
	<?php echo $this->Form->end(); ?>
</div>
<?php endif; ?>
<?php foreach($comments as $com){ //debug('com:');debug($com); ?>
<?php
	$comUserLink = ($com['User']['status'] == 1) ? "/users/view/".$com['User']['id'] : 'javascript:void(0)';
?>
<div class="comment jsSection" data-commentid="<?php echo $com['Comment']['id']; ?>">
	<div class="link03">
		<a class="yes">
			<img src="/sp/img/client/area/img_btn04_over.jpg" width="100%" alt="表示">
		</a>
		<a class="no">
			<img src="/sp/img/client/area/img_btn04_out.jpg" width="100%" alt="非表示">
		</a>
	</div>
	<div class="briefBox">
		<div class="people">
			<div class="dateBox clearfix">
				<?php
					if($com['User']['user_type'] == 2){
						$userIcon = DEFAULT_IMG_OWNER_S;
					}else{
						$userIcon = DEFAULT_IMG_CUSTOMER_S;
						$private_flag = unserialize($com['User']['Customer']['private_flag']);
						$photoOpen = ($private_flag['pv_file'] == 1);
						if($photoOpen){
							$file_name = $com['User']['Customer']['file_name'];
							if(!empty($file_name)){
								$userIcon = '/uploads/customer/thumb/' . $file_name;
							}
						}
					}
				?>
				<div class="iconImg"><a href="<?php echo $comUserLink; ?>"><img src="<?php echo $userIcon ?>" alt="" width="36" /></a></div>
				<dl class="clearfix">
					<dt>投稿日</dt>
					<dd><?php echo $this->Html->pr_datetime($com['Comment']['created']);?></dd>
					<dt>ユーザ</dt>
					<dd><?php echo $this->Html->link( sprintf("%sさん（%sPt）",$com['User']['name'],$com['User']['Customer']['point']), $comUserLink); ?></dd>
				</dl>
			</div>
			<div class="talkBox clearfix">
				<div class="talk">
					<?php
						if($com['Comment']['delete_flag']){
							$abbrevBody = $body = '<span style="color:#b94a48">このコメントは削除されました</span>';
						}else{
							$body = h($com['Comment']['body']);
							if(mb_strlen($body) <= COMMENT_ABBREV_BODY_LENGTH){
								$abbrevBody = $body;
							}else{
								$abbrevBody = mb_substr($body, 0, COMMENT_ABBREV_BODY_LENGTH - 3) . '...';
							}
						}
					?>
					<p class="comAbbrevBody"><?php echo $abbrevBody; ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="detailBox">
		<div class="people">
			<div class="dateBox clearfix">
				<div class="iconImg"><a href="<?php echo $comUserLink; ?>"><img src="<?php echo $userIcon; ?>" alt="" width="36" /></a></div>
				<dl class="clearfix">
					<dt>投稿日</dt>
					<dd><?php echo $this->Html->pr_datetime($com['Comment']['created']);?></dd>
					<dt>ユーザ</dt>
					<dd><?php echo $this->Html->link( sprintf("%sさん（%sPt）",$com['User']['name'],$com['User']['Customer']['point']), $comUserLink); ?></dd>
				</dl>
			</div>
			<div class="talkBox clearfix">
				<div class="talk">
					<p class="comBody"><?php echo nl2br($body); ?></p>
				</div>
				<?php if( empty( $i['Topic']['closed'] ) && empty( $com['Comment']['delete_flag'] ) ): ?>
				<div class="voteBox">
					<dl class="clearfix">
						<dt>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="1"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $com['Comment']['id']; ?>"/>
							<?php if(empty($com['CommentVote'])){ ?>
							<input type="image" src="/sp/img/client/area/img_btn05.jpg" width="86%" alt="賛成">
							<?php }else{ ?>
							<img class="inactive" src="/sp/img/client/area/img_btn05.jpg" width="86%" alt="賛成">
							<?php } ?>
							<?php echo $this->Form->end();?>
						</dt>
						<dd style="margin-right:2%"><span><?php echo $com['Comment']['plus'] ?></span>件</dd>
						<dt>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="2"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $com['Comment']['id']; ?>"/>
							<?php if(empty($com['CommentVote'])){ ?>
							<input type="image" src="/sp/img/client/area/img_btn06.jpg" width="86%" alt="反対">
							<?php }else{ ?>
							<img class="inactive" src="/sp/img/client/area/img_btn06.jpg" width="86%" alt="反対">
							<?php } ?>
							<?php echo $this->Form->end();?>
						</dt>
						<dd><span class="span01"><?php echo $com['Comment']['minus'] ?></span>件</dd>
					</dl>
					<ul>
						<li>
						<?php if($com['User']['id'] == $loginUserId){ ?>
							<?php echo $this->Form->create('Comment'); ?>
							<input type="hidden" name="data[Comment][delete_flag]" value="1" />
							<input type="hidden" name="data[Comment][id]" value="<?php echo $com['Comment']['id']; ?>" />
							<img class="removeComment_btn" src="/sp/img/client/area/img_btn09.jpg" width="86%" alt="削除" />
							<?php echo $this->Form->end(); ?>
						<?php }else{ ?>
							<img class="commentAlert_btn" src="/sp/img/client/area/img_btn07.jpg" width="100%" alt="通報">
						<?php } ?>
						</li>
						<li>
							<img class="response_btn" src="/sp/img/client/area/img_btn08.jpg" width="100%" alt="返信">
						</li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="resInputPlaceHolder"></div>
		
		<?php 
		if(!empty($com['responses'])){
			foreach($com['responses'] as $res){
				$resUserLink = ($res['User']['status'] == 1) ? "/users/view/".$res['User']['id'] : 'javascript:void(0)';
		?>
		<div class="response people" data-commentid="<?php echo $res['Comment']['id']; ?>">
			<div class="dateBox clearfix">
				<?php
					if($res['User']['user_type'] == 2){
						$userIcon = DEFAULT_IMG_OWNER_S;
					}else{
						$userIcon = DEFAULT_IMG_CUSTOMER_S;
						$private_flag = unserialize($res['User']['Customer']['private_flag']);
						$photoOpen = ($private_flag['pv_file'] == 1);
						if($photoOpen){
							$file_name = $res['User']['Customer']['file_name'];
							if(!empty($file_name)){
								$userIcon = '/uploads/customer/thumb/' . $file_name;
							}
						}
					}
					
					if(empty($res['Comment']['delete_flag'])){
						$body = nl2br(h($res['Comment']['body']));
					}else{
						$body = '<span style="color:#b94a48">このコメントは削除されました</span>';
					}
				?>
				<div class="iconImg" style="float:right"><a href="<?php echo $resUserLink; ?>"><img src="<?php echo $userIcon; ?>" alt="" width="36" /></a></div>
				<dl class="clearfix" style="float:left">
					<dt>投稿日</dt>
					<dd><?php echo $this->Html->pr_datetime($res['Comment']['created']);?></dd>
					<dt>ユーザ</dt>
					<dd><?php echo $this->Html->link( 
						sprintf("%sさん（%sPt）",$res['User']['name'],$res['User']['Customer']['point']),
						$resUserLink); 
					?></dd>
				</dl>
			</div>
			<div class="talkBox clearfix">
				<div class="talk">
					<p><?php echo $body; ?></p>
				</div>
				<!--
				<div class="voteBox">
					<dl class="clearfix">
						<dt><a href="#"><img src="/sp/img/client/area/img_btn05.jpg" width="100%" alt="賛成"></a></dt>
						<dd><span>10</span>件</dd>
						<dt><a href="#"><img src="/sp/img/client/area/img_btn06.jpg" width="100%" alt="反対"></a></dt>
						<dd><span class="span01">8</span>件</dd>
					</dl>
					<ul>
						<li><a href="#"><img src="/sp/img/client/area/img_btn07.jpg" width="100%" alt="通報"></a></li>
					</ul>
				</div>
				-->
				<?php if( empty( $i['Topic']['closed'] ) && empty( $res['Comment']['delete_flag'] ) ): ?>
				<div class="voteBox">
					<dl class="clearfix">
						<dt>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="1"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $res['Comment']['id']; ?>"/>
							<?php if(empty($res['CommentVote'])){ ?>
							<input type="image" src="/sp/img/client/area/img_btn05.jpg" width="86%" alt="賛成">
							<?php }else{ ?>
							<img class="inactive" src="/sp/img/client/area/img_btn05.jpg" width="86%" alt="賛成">
							<?php } ?>
							<?php echo $this->Form->end();?>
						</dt>
						<dd style="margin-right:2%"><span><?php echo $res['Comment']['plus'] ?></span>件</dd>
						<dt>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="2"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $res['Comment']['id']; ?>"/>
							<?php if(empty($res['CommentVote'])){ ?>
							<input type="image" src="/sp/img/client/area/img_btn06.jpg" width="86%" alt="反対">
							<?php }else{ ?>
							<img class="inactive" src="/sp/img/client/area/img_btn06.jpg" width="86%" alt="反対">
							<?php } ?>
							<?php echo $this->Form->end();?>
						</dt>
						<dd><span class="span01"><?php echo $res['Comment']['minus'] ?></span>件</dd>
					</dl>
					<ul>
						<li>
						<?php if($res['User']['id'] == $loginUserId){ ?>
							<?php echo $this->Form->create('Response'); ?>
							<input type="hidden" name="data[Response][delete_flag]" value="1" />
							<input type="hidden" name="data[Response][id]" value="<?php echo $res['Comment']['id']; ?>" />
							<img class="removeComment_btn" src="/sp/img/client/area/img_btn09.jpg" width="88px" alt="削除" />
							<?php echo $this->Form->end(); ?>
						<?php }else{ ?>
							<img class="commentAlert_btn" data-commentId="<?php echo $res['Comment']['id']; ?>" src="/sp/img/client/area/img_btn07.jpg" width="100%" alt="通報">
						<?php } ?>
						</li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<br />
		<?php 
			}
		}
		?>
	</div>
</div>
<?php } ?>