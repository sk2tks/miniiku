<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Family');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($family['Family']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Customer'); ?></dt>
			<dd>
				<?php echo $this->Html->link($family['Customer']['id'], array('controller' => 'customers', 'action' => 'view', $family['Customer']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name'); ?></dt>
			<dd>
				<?php echo h($family['Family']['file_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Nickname'); ?></dt>
			<dd>
				<?php echo h($family['Family']['nickname']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($family['Family']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($family['Family']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Family')), array('action' => 'edit', $family['Family']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Family')), array('action' => 'delete', $family['Family']['id']), null, __('Are you sure you want to delete # %s?', $family['Family']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Families')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Customers')), array('controller' => 'customers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Customer')), array('controller' => 'customers', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Children')), array('controller' => 'children', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Child')), array('controller' => 'children', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Family Clips')), array('controller' => 'family_clips', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family Clip')), array('controller' => 'family_clips', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Family Likes')), array('controller' => 'family_likes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family Like')), array('controller' => 'family_likes', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Children')); ?></h3>
	<?php if (!empty($family['Child'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Gender'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Kana'); ?></th>
				<th><?php echo __('Nickname'); ?></th>
				<th><?php echo __('Birth'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('File Name'); ?></th>
				<th><?php echo __('Info'); ?></th>
				<th><?php echo __('Client Id'); ?></th>
				<th><?php echo __('Private Flag'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($family['Child'] as $child): ?>
			<tr>
				<td><?php echo $child['id'];?></td>
				<td><?php echo $child['gender'];?></td>
				<td><?php echo $child['name'];?></td>
				<td><?php echo $child['kana'];?></td>
				<td><?php echo $child['nickname'];?></td>
				<td><?php echo $child['birth'];?></td>
				<td><?php echo $child['family_id'];?></td>
				<td><?php echo $child['file_name'];?></td>
				<td><?php echo $child['info'];?></td>
				<td><?php echo $child['client_id'];?></td>
				<td><?php echo $child['private_flag'];?></td>
				<td><?php echo $child['status'];?></td>
				<td><?php echo $child['modified'];?></td>
				<td><?php echo $child['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'children', 'action' => 'view', $child['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'children', 'action' => 'edit', $child['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'children', 'action' => 'delete', $child['id']), null, __('Are you sure you want to delete # %s?', $child['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Child')), array('controller' => 'children', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Customers')); ?></h3>
	<?php if (!empty($family['Customer'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Last Name'); ?></th>
				<th><?php echo __('First Name'); ?></th>
				<th><?php echo __('Last Kana'); ?></th>
				<th><?php echo __('First Kana'); ?></th>
				<th><?php echo __('Gender'); ?></th>
				<th><?php echo __('Customer Type'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Area Id'); ?></th>
				<th><?php echo __('Municipal Id'); ?></th>
				<th><?php echo __('Prefecture Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('Zip'); ?></th>
				<th><?php echo __('Address'); ?></th>
				<th><?php echo __('Sub Address'); ?></th>
				<th><?php echo __('File Name'); ?></th>
				<th><?php echo __('Birth'); ?></th>
				<th><?php echo __('Occupation'); ?></th>
				<th><?php echo __('Info'); ?></th>
				<th><?php echo __('Private Flag'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Url'); ?></th>
				<th><?php echo __('FB Token'); ?></th>
				<th><?php echo __('FB Id'); ?></th>
				<th><?php echo __('FB Data'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($family['Customer'] as $customer): ?>
			<tr>
				<td><?php echo $customer['id'];?></td>
				<td><?php echo $customer['last_name'];?></td>
				<td><?php echo $customer['first_name'];?></td>
				<td><?php echo $customer['last_kana'];?></td>
				<td><?php echo $customer['first_kana'];?></td>
				<td><?php echo $customer['gender'];?></td>
				<td><?php echo $customer['customer_type'];?></td>
				<td><?php echo $customer['user_id'];?></td>
				<td><?php echo $customer['area_id'];?></td>
				<td><?php echo $customer['municipal_id'];?></td>
				<td><?php echo $customer['prefecture_id'];?></td>
				<td><?php echo $customer['family_id'];?></td>
				<td><?php echo $customer['zip'];?></td>
				<td><?php echo $customer['address'];?></td>
				<td><?php echo $customer['sub_address'];?></td>
				<td><?php echo $customer['file_name'];?></td>
				<td><?php echo $customer['birth'];?></td>
				<td><?php echo $customer['occupation'];?></td>
				<td><?php echo $customer['info'];?></td>
				<td><?php echo $customer['private_flag'];?></td>
				<td><?php echo $customer['status'];?></td>
				<td><?php echo $customer['url'];?></td>
				<td><?php echo $customer['FB_token'];?></td>
				<td><?php echo $customer['FB_id'];?></td>
				<td><?php echo $customer['FB_data'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'customers', 'action' => 'view', $customer['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'customers', 'action' => 'edit', $customer['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'customers', 'action' => 'delete', $customer['id']), null, __('Are you sure you want to delete # %s?', $customer['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Customer')), array('controller' => 'customers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Family Clips')); ?></h3>
	<?php if (!empty($family['FamilyClip'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('Url'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Public Date'); ?></th>
				<th><?php echo __('Date'); ?></th>
				<th><?php echo __('Memo'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($family['FamilyClip'] as $familyClip): ?>
			<tr>
				<td><?php echo $familyClip['id'];?></td>
				<td><?php echo $familyClip['family_id'];?></td>
				<td><?php echo $familyClip['url'];?></td>
				<td><?php echo $familyClip['title'];?></td>
				<td><?php echo $familyClip['public_date'];?></td>
				<td><?php echo $familyClip['date'];?></td>
				<td><?php echo $familyClip['memo'];?></td>
				<td><?php echo $familyClip['modified'];?></td>
				<td><?php echo $familyClip['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'family_clips', 'action' => 'view', $familyClip['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'family_clips', 'action' => 'edit', $familyClip['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'family_clips', 'action' => 'delete', $familyClip['id']), null, __('Are you sure you want to delete # %s?', $familyClip['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Family Clip')), array('controller' => 'family_clips', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Family Likes')); ?></h3>
	<?php if (!empty($family['FamilyLike'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Contents Type Id'); ?></th>
				<th><?php echo __('Like Family Id'); ?></th>
				<th><?php echo __('Client Id'); ?></th>
				<th><?php echo __('Topic Id'); ?></th>
				<th><?php echo __('Like Name'); ?></th>
				<th><?php echo __('Date'); ?></th>
				<th><?php echo __('Memo'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($family['FamilyLike'] as $familyLike): ?>
			<tr>
				<td><?php echo $familyLike['id'];?></td>
				<td><?php echo $familyLike['family_id'];?></td>
				<td><?php echo $familyLike['user_id'];?></td>
				<td><?php echo $familyLike['contents_type_id'];?></td>
				<td><?php echo $familyLike['like_family_id'];?></td>
				<td><?php echo $familyLike['client_id'];?></td>
				<td><?php echo $familyLike['topic_id'];?></td>
				<td><?php echo $familyLike['like_name'];?></td>
				<td><?php echo $familyLike['date'];?></td>
				<td><?php echo $familyLike['memo'];?></td>
				<td><?php echo $familyLike['modified'];?></td>
				<td><?php echo $familyLike['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'family_likes', 'action' => 'view', $familyLike['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'family_likes', 'action' => 'edit', $familyLike['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'family_likes', 'action' => 'delete', $familyLike['id']), null, __('Are you sure you want to delete # %s?', $familyLike['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Family Like')), array('controller' => 'family_likes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
