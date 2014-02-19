<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Client Type');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($clientType['ClientType']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($clientType['ClientType']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($clientType['ClientType']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($clientType['ClientType']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Client Type')), array('action' => 'edit', $clientType['ClientType']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Client Type')), array('action' => 'delete', $clientType['ClientType']['id']), null, __('Are you sure you want to delete # %s?', $clientType['ClientType']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Client Types')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client Type')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

