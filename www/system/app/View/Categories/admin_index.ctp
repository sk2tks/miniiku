<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Categories'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('category_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('slug');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
				<td><?php echo h($category['Category']['category_name']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($category['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $category['ContentsType']['id'])); ?>
				</td>
				<td><?php echo h($category['Category']['slug']); ?>&nbsp;</td>
				<td><?php echo h($category['Category']['modified']); ?>&nbsp;</td>
				<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('controller' => 'tags', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Tag')), array('controller' => 'tags', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Topics')), array('controller' => 'topics', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic')), array('controller' => 'topics', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>