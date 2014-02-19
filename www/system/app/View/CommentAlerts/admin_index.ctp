<?php
	//debug($commentAlerts);
?>
<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Comment Alerts'));?></legend>
		<?php echo $this->Form->create('CommentAlert', array('url'=>'/admin/comment_alerts/index', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
		<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
			<tr><th>ID</th><td><?php echo $this->Form->input('id', array('type'=>'text', 'div'=>false)); ?></td></tr>
			<tr><th>対象コンテンツタイプ</th><td><?php echo $this->Form->select('contents_type_id', $contentsTypes, array('div'=>false, 'empty'=>'対象コンテンツタイプで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><th>対象コンテンツID(対象コンテンツタイプ依存)</th><td><?php echo $this->Form->input('contents_target_id', array('type'=>'text', 'div'=>false)); ?></td></tr>
			<tr><th>通報フラグ</th><td><?php echo $this->Form->select('alert_flag', $alertFlags, array('div'=>false, 'empty'=>'通報フラグで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><th>通報確認</th><td><?php echo $this->Form->select('alert_check', $alertChecks, array('div'=>false, 'empty'=>'通報確認で絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><td colspan='2' style='text-align:center; padding:10px 0'>
				<input class="btn" type="submit" value="検索" />
				<button class="btn"
					onclick="$('#CommentAlertAdminIndexForm select option').removeAttr('selected');$('#CommentAlertId, #CommentAlertContentsTargetId').val('');">リセット</button>
			</td></tr>
		</table>
		<?php echo $this->Form->end(); ?>
		
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id', 'ID');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id', '対象コンテンツタイプ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_target_id', '対象コンテンツ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('comment_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Comment.delete_flag', '削除フラグ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id', '通報者');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('alert_flag');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('alert_check');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($commentAlerts as $commentAlert): ?>
			<tr>
				<td><?php echo h($commentAlert['CommentAlert']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $commentAlert['ContentsType']['name']; ?>
				</td>
				<?php
					$controller = 'bbs';
					if($commentAlert['CommentAlert']['contents_type_id'] != 7){
						$controller = 'clients';
					}
					$href = '/'.$controller.'/view/'.$commentAlert['CommentAlert']['contents_target_id'];
				?>
				<td><a href="<?php echo $href; ?>" target="_blank"><?php echo h($commentAlert['CommentAlert']['contents_target_id']); ?>&nbsp;</a></td>
				<?php $href = $href . '/comment:' . $commentAlert['CommentAlert']['comment_id']; ?>
				<td><a href="<?php echo $href; ?>" target="_blank"><?php echo h($commentAlert['CommentAlert']['comment_id']); ?>&nbsp;</a></td>
				<td><?php echo $commentAlert['Comment']['delete_flag']; ?></td>
				<td>
					<?php echo $this->Html->link($commentAlert['User']['name'], array('controller' => 'users', 'action' => 'view', $commentAlert['User']['id'])); ?>
				</td>
				<td><?php echo h($commentAlert['CommentAlert']['alert_flag']); ?>&nbsp;</td>
				<td><?php echo h($commentAlert['CommentAlert']['alert_check']); ?>&nbsp;</td>
				<td><?php echo h($commentAlert['CommentAlert']['modified']); ?>&nbsp;</td>
				<td><?php echo h($commentAlert['CommentAlert']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $commentAlert['CommentAlert']['id'])); ?>
					<?php 
						echo $this->Html->link(
							'コメント編集', 
							array('controller'=>'comments', 'action' => 'edit', $commentAlert['CommentAlert']['comment_id']), 
							array('class' => 'btn btn-small btn-primary', 'style'=>'margin-bottom:3px;padding:2px 8px;')
						); 
					?>
					<br />
					<?php 
						echo $this->Html->link(
							__('Edit'), 
							array('action' => 'edit', $commentAlert['CommentAlert']['id']), 
							array('class' => 'btn btn-small btn-primary')
						); 
					?>
					<?php 
						echo $this->Form->postLink(
							__('Delete'), 
							array('action' => 'delete', $commentAlert['CommentAlert']['id']), 
							array('class' => 'btn btn-small btn-danger'), 
							__('Are you sure you want to delete # %s?', $commentAlert['CommentAlert']['id'])
						); 
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment Alert')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
	-->
</div>