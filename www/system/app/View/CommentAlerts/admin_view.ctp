<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Comment Alert');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type'); ?></dt>
			<dd>
				<?php echo $this->Html->link($commentAlert['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $commentAlert['ContentsType']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Target Id'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['contents_target_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Comment'); ?></dt>
			<dd>
				<?php echo $this->Html->link($commentAlert['Comment']['id'], array('controller' => 'comments', 'action' => 'view', $commentAlert['Comment']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($commentAlert['User']['name'], array('controller' => 'users', 'action' => 'view', $commentAlert['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Alert Flag'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['alert_flag']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Alert Check'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['alert_check']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($commentAlert['CommentAlert']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Comment Alert')), array('action' => 'edit', $commentAlert['CommentAlert']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Comment Alert')), array('action' => 'delete', $commentAlert['CommentAlert']['id']), null, __('Are you sure you want to delete # %s?', $commentAlert['CommentAlert']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comment Alerts')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment Alert')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

