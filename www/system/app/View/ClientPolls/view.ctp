<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Client Poll');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Client'); ?></dt>
			<dd>
				<?php echo $this->Html->link($clientPoll['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientPoll['Client']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Poll N1'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['poll_n1']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Poll N2'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['poll_n2']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Poll N3'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['poll_n3']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Poll N4'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['poll_n4']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Poll N5'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['poll_n5']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($clientPoll['ClientPoll']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Client Poll')), array('action' => 'edit', $clientPoll['ClientPoll']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Client Poll')), array('action' => 'delete', $clientPoll['ClientPoll']['id']), null, __('Are you sure you want to delete # %s?', $clientPoll['ClientPoll']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Client Polls')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client Poll')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

