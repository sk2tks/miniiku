<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Child');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($child['Child']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Gender'); ?></dt>
			<dd>
				<?php echo h($child['Child']['gender']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($child['Child']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Kana'); ?></dt>
			<dd>
				<?php echo h($child['Child']['kana']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Nickname'); ?></dt>
			<dd>
				<?php echo h($child['Child']['nickname']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Birth'); ?></dt>
			<dd>
				<?php echo h($child['Child']['birth']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Family'); ?></dt>
			<dd>
				<?php echo $this->Html->link($child['Family']['id'], array('controller' => 'families', 'action' => 'view', $child['Family']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name'); ?></dt>
			<dd>
				<?php echo h($child['Child']['file_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Info'); ?></dt>
			<dd>
				<?php echo h($child['Child']['info']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Client Id'); ?></dt>
			<dd>
				<?php echo h($child['Child']['client_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Private Flag'); ?></dt>
			<dd>
				<?php echo h($child['Child']['private_flag']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($child['Child']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($child['Child']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($child['Child']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Child')), array('action' => 'edit', $child['Child']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Child')), array('action' => 'delete', $child['Child']['id']), null, __('Are you sure you want to delete # %s?', $child['Child']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Children')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Child')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

