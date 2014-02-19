<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Comment');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type Id'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['contents_type_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Target Id'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['contents_target_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Parent Comment Id'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['parent_comment_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($comment['User']['name'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Body'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['body']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Delete Flag'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['delete_flag']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Plus'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['plus']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Minus'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['minus']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($comment['Comment']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Comment')), array('action' => 'edit', $comment['Comment']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Comment')), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
	-->
</div>

