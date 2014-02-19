<?php debug($clientVote);?>
<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Client Vote');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Client'); ?></dt>
			<dd>
				<?php echo $this->Html->link($clientVote['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientVote['Client']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($clientVote['User']['name'], array('controller' => 'users', 'action' => 'view', $clientVote['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('N1'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['n1']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('N2'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['n2']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('N3'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['n3']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('N4'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['n4']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('N5'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['n5']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($clientVote['ClientVote']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Client Vote')), array('action' => 'edit', $clientVote['ClientVote']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Client Vote')), array('action' => 'delete', $clientVote['ClientVote']['id']), null, __('Are you sure you want to delete # %s?', $clientVote['ClientVote']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Client Votes')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client Vote')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

