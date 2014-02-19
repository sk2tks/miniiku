<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Customer');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Name'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['last_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Name'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['first_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Kana'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['last_kana']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Kana'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['first_kana']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Gender'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['gender']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Customer Type'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['customer_type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($customer['User']['name'], array('controller' => 'users', 'action' => 'view', $customer['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area'); ?></dt>
			<dd>
				<?php echo $this->Html->link($customer['Area']['name'], array('controller' => 'areas', 'action' => 'view', $customer['Area']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal Id'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['municipal_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Prefecture'); ?></dt>
			<dd>
				<?php echo $this->Html->link($customer['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $customer['Prefecture']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Family'); ?></dt>
			<dd>
				<?php echo $this->Html->link($customer['Family']['id'], array('controller' => 'families', 'action' => 'view', $customer['Family']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Zip'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['zip']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Address'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['address']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sub Address'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['sub_address']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['file_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Birth'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['birth']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Occupation'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['occupation']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Info'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['info']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Private Flag'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['private_flag']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Token'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['FB_token']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Id'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['FB_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Data'); ?></dt>
			<dd>
				<?php echo h($customer['Customer']['FB_data']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Customer')), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Customer')), array('action' => 'delete', $customer['Customer']['id']), null, __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Customers')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Customer')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Areas')), array('controller' => 'areas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Area')), array('controller' => 'areas', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Prefectures')), array('controller' => 'prefectures', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Prefecture')), array('controller' => 'prefectures', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

