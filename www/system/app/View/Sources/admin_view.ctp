<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Source');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($source['Source']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($source['Source']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($source['Source']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($source['Source']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo h($source['Source']['url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Rss Name'); ?></dt>
			<dd>
				<?php echo h($source['Source']['rss_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Rss Url'); ?></dt>
			<dd>
				<?php echo h($source['Source']['rss_url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($source['Source']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal'); ?></dt>
			<dd>
				<?php echo $this->Html->link($source['Municipal']['name'], array('controller' => 'municipals', 'action' => 'view', $source['Municipal']['id'])); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Source')), array('action' => 'edit', $source['Source']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Source')), array('action' => 'delete', $source['Source']['id']), null, __('Are you sure you want to delete # %s?', $source['Source']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Sources')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Source')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

