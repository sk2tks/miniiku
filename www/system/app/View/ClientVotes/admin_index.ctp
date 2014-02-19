<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Client Votes'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('client_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('n1');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('n2');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('n3');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('n4');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('n5');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($clientVotes as $clientVote): ?>
			<tr>
				<td><?php echo h($clientVote['ClientVote']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($clientVote['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientVote['Client']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($clientVote['User']['name'], array('controller' => 'users', 'action' => 'view', $clientVote['User']['id'])); ?>
				</td>
				<td><?php echo h($clientVote['ClientVote']['n1']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['n2']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['n3']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['n4']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['n5']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['modified']); ?>&nbsp;</td>
				<td><?php echo h($clientVote['ClientVote']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $clientVote['ClientVote']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientVote['ClientVote']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientVote['ClientVote']['id']), null, __('Are you sure you want to delete # %s?', $clientVote['ClientVote']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Client Vote')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>