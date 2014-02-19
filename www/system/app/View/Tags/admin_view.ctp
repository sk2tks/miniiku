<div class="row-fluid">
	<div class="span9">
		<legend><?php  echo __('Tag');?></legend>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Category'); ?></dt>
			<dd>
				<?php echo $this->Html->link($tag['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $tag['Category']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Word'); ?></dt>
			<dd>
				<?php echo h($tag['Tag']['word']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Tag.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('controller' => 'categories', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('controller' => 'categories', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
	-->
</div>