<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Client Polls'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('client_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('poll_n1');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('poll_n2');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('poll_n3');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('poll_n4');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('poll_n5');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($clientPolls as $clientPoll): ?>
			<tr>
				<td><?php echo h($clientPoll['ClientPoll']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($clientPoll['Client']['name'], array('controller' => 'clients', 'action' => 'view', $clientPoll['Client']['id'])); ?>
				</td>
				<td><?php echo h($clientPoll['ClientPoll']['poll_n1']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['poll_n2']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['poll_n3']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['poll_n4']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['poll_n5']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['modified']); ?>&nbsp;</td>
				<td><?php echo h($clientPoll['ClientPoll']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $clientPoll['ClientPoll']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientPoll['ClientPoll']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientPoll['ClientPoll']['id']), null, __('Are you sure you want to delete # %s?', $clientPoll['ClientPoll']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Client Poll')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>