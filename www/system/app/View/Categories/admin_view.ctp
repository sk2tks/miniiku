<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Category');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($category['Category']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Category Name'); ?></dt>
			<dd>
				<?php echo h($category['Category']['category_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type'); ?></dt>
			<dd>
				<?php echo $this->Html->link($category['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $category['ContentsType']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Slug'); ?></dt>
			<dd>
				<?php echo h($category['Category']['slug']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($category['Category']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($category['Category']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Category')), array('action' => 'edit', $category['Category']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Category')), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('action' => 'add')); ?> </li>
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

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Tags')); ?></h3>
	<?php if (!empty($category['Tag'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Category Id'); ?></th>
				<th><?php echo __('Tag'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($category['Tag'] as $tag): ?>
			<tr>
				<td><?php echo $tag['id'];?></td>
				<td><?php echo $tag['category_id'];?></td>
				<td><?php echo $tag['tag'];?></td>
				<td><?php echo $tag['modified'];?></td>
				<td><?php echo $tag['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Tag')), array('controller' => 'tags', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Topics')); ?></h3>
	<?php if (!empty($category['Topic'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Contents Type Id'); ?></th>
				<th><?php echo __('Category Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Area Id'); ?></th>
				<th><?php echo __('Municipal Id'); ?></th>
				<th><?php echo __('Prefecture Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Publicity Range'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('File Name'); ?></th>
				<th><?php echo __('Source'); ?></th>
				<th><?php echo __('Source Url'); ?></th>
				<th><?php echo __('Site Url'); ?></th>
				<th><?php echo __('Site Title'); ?></th>
				<th><?php echo __('Pub Date'); ?></th>
				<th><?php echo __('Related Topic'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($category['Topic'] as $topic): ?>
			<tr>
				<td><?php echo $topic['id'];?></td>
				<td><?php echo $topic['contents_type_id'];?></td>
				<td><?php echo $topic['category_id'];?></td>
				<td><?php echo $topic['user_id'];?></td>
				<td><?php echo $topic['area_id'];?></td>
				<td><?php echo $topic['municipal_id'];?></td>
				<td><?php echo $topic['prefecture_id'];?></td>
				<td><?php echo $topic['title'];?></td>
				<td><?php echo $topic['publicity_range'];?></td>
				<td><?php echo $topic['body'];?></td>
				<td><?php echo $topic['file_name'];?></td>
				<td><?php echo $topic['source'];?></td>
				<td><?php echo $topic['source_url'];?></td>
				<td><?php echo $topic['site_url'];?></td>
				<td><?php echo $topic['site_title'];?></td>
				<td><?php echo $topic['pub_date'];?></td>
				<td><?php echo $topic['related_topic'];?></td>
				<td><?php echo $topic['modified'];?></td>
				<td><?php echo $topic['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'topics', 'action' => 'view', $topic['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'topics', 'action' => 'edit', $topic['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'topics', 'action' => 'delete', $topic['id']), null, __('Are you sure you want to delete # %s?', $topic['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Topic')), array('controller' => 'topics', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
