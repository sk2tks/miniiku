<?php //debug($comments); ?>
<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Comments'));?></legend>
		<?php echo $this->Form->create('Comment', array('url'=>'/admin/comments/index', 'novalidate'=>true, 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				<tr>
					<th>ID</th>
					<td><?php echo $this->Form->input('id', array('type'=>'text', 'div'=>false)); ?></td>
				</tr>
				<tr>
					<th>対象コンテンツタイプ</th>
					<td><?php echo $this->Form->select('contents_type_id', $contentsTypes, array('div'=>false, 'empty'=>'対象コンテンツタイプで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td>
				</tr>
				<tr>
					<th>対象コンテンツID(対象コンテンツタイプ依存)</th>
					<td><?php echo $this->Form->input('contents_target_id', array('type'=>'text', 'div'=>false)); ?></td>
				</tr>
				<tr>
					<th>キーワード</th>
					<td><?php echo $this->Form->input('keyword', array('div'=>false)); ?></td>
				</tr>	
				<tr>
					<td colspan='2' style='text-align:center; padding:10px 0'> 
						<input class="btn" type="submit" value="検索" />
						<button class="btn"
							onclick="$('#CommentId, #CommentContentsTargetId, #CommentKeyword').val('');$('#CommentAdminIndexForm select option').removeAttr('selected');">リセット</button>
					</td>
				</tr>
			</table>
		<?php echo $this->Form->end(); ?>
		<div style="float:left"><?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></div>
		<div style="float:right;margin-bottom:10px"><a class="btn btn-info" href="/admin/comments/add">+ 新規コメント</a></div>
		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id', 'ID');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id', '対象コンテンツタイプ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_target_id', '対象コンテンツ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('parent_comment_id', '親コメント');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('body');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('delete_flag');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('plus');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('minus');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($comments as $comment): ?>
			<tr>
				<?php
					$controller = ($comment['Comment']['contents_type_id'] == 7) ? 'bbs' : 'clients';
					$href = '/'.$controller.'/view/'.$comment['Comment']['contents_target_id'].'/comment:'.$comment['Comment']['id'];
				?>
				<td><a href="<?php echo $href;?>" target="_blank"><?php echo h($comment['Comment']['id']); ?>&nbsp;</a></td>
				<td><?php echo h($comment['ContentsType']['name']); ?>&nbsp;</td>
				<?php
					$href = '/'.$controller.'/view/'.$comment['Comment']['contents_target_id'];
				?>
				<td><a href="<?php echo $href;?>" target="_blank"><?php echo h($comment['Comment']['contents_target_id']); ?>&nbsp;</a></td>
				<?php
					$href = '/'.$controller.'/view/'.$comment['Comment']['contents_target_id'].'/comment:'.$comment['Comment']['parent_comment_id'];
				?>
				<td><a href="<?php echo $href;?>" target="_blank"><?php echo h($comment['Comment']['parent_comment_id']); ?>&nbsp;</a></td>
				<td>
					<?php 
						echo $this->Html->link($comment['User']['name'], array(
							'controller' => 'users', 
							'action' => 'view', 
							$comment['User']['id']
						)); 
					?>
				</td>
				<td><?php echo h($comment['Comment']['body']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['delete_flag']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['plus']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['minus']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['modified']); ?>&nbsp;</td>
				<td><?php echo h($comment['Comment']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $comment['Comment']['id'])); ?>
					<?php 
						echo $this->Html->link(
							__('Edit'), 
							array(
								'action' => 'edit', 
								$comment['Comment']['id']
							), 
							array('class' => 'btn btn-small btn-primary')
						); 
					?>
					<?php 
						echo $this->Form->postLink(
							__('Delete'), 
							array(
								'action' => 'delete', 
								$comment['Comment']['id']), 
								array('class' => 'btn btn-small btn-danger'), 
								__('Are you sure you want to delete # %s?', 
								$comment['Comment']['id']
							)
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
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
	-->
</div>