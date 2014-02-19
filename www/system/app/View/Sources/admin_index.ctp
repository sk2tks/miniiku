<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Sources'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
<!-- 				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th> -->
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('url');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('rss_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('rss_url');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('type');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($sources as $source): ?>
			<tr>
				<td><?php echo h($source['Source']['id']); ?>&nbsp;</td>
<!-- 				<td><?php echo h($source['Source']['created']); ?>&nbsp;</td>
				<td><?php echo h($source['Source']['modified']); ?>&nbsp;</td> -->
				<td><?php echo h($source['Source']['name']); ?>&nbsp;</td>
				<td><?php echo h($source['Source']['url']); ?>&nbsp;</td>
				<td><?php echo h($source['Source']['rss_name']); ?>&nbsp;</td>
				<td><?php echo h($source['Source']['rss_url']); ?>&nbsp;</td>
				<td><?php echo h($source['Source']['type']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($source['Municipal']['name'], array('controller' => 'municipals', 'action' => 'view', $source['Municipal']['id'])); ?>
				</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $source['Source']['id']) , array('class' => 'btn btn-small btn-primary')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $source['Source']['id']) , array('class' => 'btn btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $source['Source']['id']),array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $source['Source']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Source')), array('action' => 'add')); ?></li>
<!-- 			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?> </li> -->
		</ul>
		</div>
	</div>
</div>