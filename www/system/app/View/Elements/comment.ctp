<div class="commentBox clearfix">
	<?php if(empty($i['Topic']['closed'])){ ?>
	<div><img id="newComment_btn" class="btn" src="/img/client/area/com_link01.png" alt="新規コメント" width="161" height="29" /></div>
	<?php } ?>
</div>
<?php if(empty($i['Topic']['closed'])): ?>
<div id="comInput" class="comTextBox clearfix">
	<?php echo $this->Form->create('Comment'); ?>
	<textarea name="data[Comment][body]" cols="41" rows="5" class="postscript"></textarea>
	<ul class="clearfix">
		<li><img id="submitComment_btn" class="btn" src="/img/client/area/com_link02.png" alt="投稿" width="100" height="33" /></li>
		<li><img id="cancelComment_btn" class="btn" src="/img/client/area/com_link03.png" alt="キャンセル" width="100" height="33" /></li>
	</ul>
	<?php echo $this->Form->end(); ?>
</div>

<div id="resInput" class="comTextBox clearfix" style="display:none;margin-top:0">
	<?php echo $this->Form->create('Response'); ?>
	<textarea name="data[Response][body]" cols="41" rows="5" class="postscript"></textarea>
	<input type="hidden" name="data[Response][parentCommentId]" value="" />
	<ul class="clearfix">
		<li><img id="submitResponse_btn" class="btn" src="/img/client/area/com_link02.png" alt="投稿" width="100" height="33" /></li>
		<li><img id="cancelResponse_btn" class="btn" src="/img/client/area/com_link03.png" alt="キャンセル" width="100" height="33" /></li>
	</ul>
	<?php echo $this->Form->end(); ?>
</div>
<?php endif; ?>
<?php foreach($comments as $com){ //debug('com:');debug($com); ?>
<?php
	$comUserLink = ($com['User']['status'] == 1) ? "/users/view/".$com['User']['id'] : 'javascript:void(0)';
?>
<div class="comment jsSection" data-commentid="<?php echo $com['Comment']['id']; ?>">
	<div class="comHeader commentBox02 clearfix">
		<div class="dlBox clearfix">
			<dl>
				<dt>投稿日</dt>
				<dd><?php echo $this->Html->pr_datetime($com['Comment']['created']);?></dd>
			</dl>
			<dl class="dlStyle">
				<dt>ユーザ</dt>
				<dd><?php echo $this->Html->link( sprintf("%sさん（%sPt）",$com['User']['name'],
					!empty($com['User']['Customer']['point']) ? $com['User']['Customer']['point'] : 0 ), $comUserLink); ?></dd>
			</dl>
		</div>
		<a href="#" class="yes"><img class="btn" src="/img/client/area/com_link09.png" alt="表示" width="138" height="35" /></a>
		<a href="#" class="no"><img class="btn" src="/img/client/area/com_link04.png" alt="非表示" width="138" height="35" /></a>
	</div>
	<div class="shrinkedComment infoBox" style="display:block;">
		<div class="comInner clearfix">
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
			<div class="photoBox"><a href="<?php echo $comUserLink; ?>"><img src="<?php echo $userIcon ?>" alt="" width="37" /></a></div>
			<div class="subBox">
				<div class="textBox">
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
	<div class="expandedComment jsBox" style="display:none;">
		<div class="infoBox02 clearfix">
			<div class="comInner clearfix">
				<div class="photoBox">
					<a href="<?php echo $comUserLink; ?>"><img src="<?php echo $userIcon; ?>" alt="" width="37" /></a>
				</div>
				<div class="subBox">
					<div class="textBox">
						<p class="comBody"><?php echo nl2br($body); ?></p>
					</div>
				</div>
			</div>
			<?php if( empty( $i['Topic']['closed'] ) && empty( $com['Comment']['delete_flag'] ) ): ?>
			<div class="tableBox">
				<table cellpadding="0" cellspacing="0" summary="コメント">
					<col width="35%" />
					<col width="35%" />
					<col width="30%" />
					<tbody>
						<tr>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="1"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $com['Comment']['id']; ?>"/>
							<th>
								<?php if(empty($com['CommentVote'])){ ?>
								<input type="image" class="btn" src="/img/client/area/com_link05.png" alt="賛成" width="101" height="33" />
								<?php }else{ ?>
								<img class="inactive" src="/img/client/area/com_link05.png" alt="賛成" width="101" height="33" />
								<?php } ?>
							</th>
							<td class="tdStyle"><?php echo $com['Comment']['plus'] ?></td>
							<td>件</td>
							<?php echo $this->Form->end();?>
						</tr>
						<tr>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="2"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $com['Comment']['id']; ?>"/>
							<th>
								<?php if(empty($com['CommentVote'])){ ?>
								<input type="image" class="btn" src="/img/client/area/com_link06.png" alt="反対" width="101" height="34" />
								<?php }else{ ?>
								<img class="inactive" src="/img/client/area/com_link06.png" alt="反対" width="101" height="34" />
								<?php } ?>
							</th>
							<td class="tdStyle02"><?php echo $com['Comment']['minus'] ?></td>
							<td>件</td>
							<?php echo $this->Form->end();?>
						</tr>
					</tbody>
				</table>
				
				<ul class="clearfix">
					<?php //if(empty($i['Topic']['closed'])){ ?>
					<li><img class="response_btn btn" src="/img/client/area/com_link07.png" alt="返信" width="84" height="39" style="cursor: $reporter;" /></li>
					<?php //} ?>
					<li class="floatR">
						<?php if($com['User']['id'] == $loginUserId){ ?>
							<?php echo $this->Form->create('Comment'); ?>
							<input type="hidden" name="data[Comment][delete_flag]" value="1" />
							<input type="hidden" name="data[Comment][id]" value="<?php echo $com['Comment']['id']; ?>" />
							<img class="removeComment_btn btn" src="/img/client/area/com_link11.png" alt="削除" width="84" height="38" />
							<?php echo $this->Form->end(); ?>
						<?php }else{ ?>
							<img class="commentAlert_btn btn" data-commentId="<?php echo $com['Comment']['id']; ?>" src="/img/client/area/com_link08.png" alt="通報" width="84" height="39" />
						<?php } ?>
					</li>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<div class="resInputPlaceHolder"></div>
		
		<?php 
		if(!empty($com['responses'])){
			foreach($com['responses'] as $res){
				$resUserLink = ($res['User']['status'] == 1) ? "/users/view/".$res['User']['id'] : 'javascript:void(0)';
		?>
		<div class="dlBox dlBox02 clearfix res" data-commentid="<?php echo $res['Comment']['id']; ?>">
			<dl>
				<dt>返信日</dt>
				<dd><?php echo $this->Html->pr_datetime($res['Comment']['created']);?></dd>
			</dl>
			<dl class="dlStyle">
				<dt>ユーザ</dt>
				<dd>
					<?php echo $this->Html->link( sprintf("%sさん（%sPt）",$res['User']['name'],
						!empty($res['User']['Customer']['point']) ? $res['User']['Customer']['point'] : 0), $resUserLink); ?>
				</dd>
			</dl>
		</div>
		<div class="infoBox02 mb0 clearfix">
			<div class="comInner02 clearfix">
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
				<div class="photoBox"><a href="<?php echo $resUserLink; ?>"><img src="<?php echo $userIcon; ?>" alt="" width="34" /></a></div>
				<div class="subBox">
					<div class="textBox">
						<p class="resBody"><?php echo $body; ?></p>
					</div>
				</div>
			</div>
			<?php if( empty( $i['Topic']['closed'] ) && empty( $res['Comment']['delete_flag'] )): ?>
			<div class="tableBox">
				<table cellpadding="0" cellspacing="0" summary="コメント">
					<col width="35%" />
					<col width="35%" />
					<col width="30%" />
					<tbody>
						<tr>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="1"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $res['Comment']['id']; ?>"/>
							<th>
								<?php if(empty($res['CommentVote'])){ ?>
								<input type="image" class="btn" src="/img/client/area/com_link05.png" alt="賛成" width="101" height="33" />
								<?php }else{ ?>
								<img class="inactive" src="/img/client/area/com_link05.png" alt="賛成" width="101" height="33" />
								<?php } ?>
							</th>
							<td class="tdStyle"><?php echo $res['Comment']['plus'] ?></td>
							<td>件</td>
							<?php echo $this->Form->end();?>
						</tr>
						<tr>
							<?php echo $this->Form->create('CommentVote');?>
							<input type="hidden" name="data[CommentVote][value]" value="2"/>
							<input type="hidden" name="data[CommentVote][comment_id]" value="<?php echo $res['Comment']['id']; ?>"/>
							<th>
								<?php if(empty($res['CommentVote'])){ ?>
								<input type="image" class="btn" src="/img/client/area/com_link06.png" alt="反対" width="101" height="34" />
								<?php }else{ ?>
								<img class="inactive" src="/img/client/area/com_link06.png" alt="反対" width="101" height="34" />
								<?php } ?>
							</th>
							<td class="tdStyle02"><?php echo $res['Comment']['minus'] ?></td>
							<td>件</td>
							<?php echo $this->Form->end();?>
						</tr>
					</tbody>
				</table>
				<ul class="clearfix">
					<li class="floatR">
						<?php if($res['User']['id'] == $loginUserId){ ?>
							<?php echo $this->Form->create('Response'); ?>
							<input type="hidden" name="data[Response][delete_flag]" value="1" />
							<input type="hidden" name="data[Response][id]" value="<?php echo $res['Comment']['id']; ?>" />
							<img class="removeComment_btn btn" src="/img/client/area/com_link11.png" alt="削除" width="84" height="38" />
							<?php echo $this->Form->end(); ?>
						<?php }else{ ?>
							<img class="commentAlert_btn btn" data-commentId="<?php echo $res['Comment']['id']; ?>" src="/img/client/area/com_link08.png" alt="通報" width="84" height="39" />
						<?php } ?>
					</li>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<br />
		<?php 
			}
		}
		?>
	</div>
</div>
<?php } ?>
	