<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('User');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($user['User']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Login'); ?></dt>
			<dd>
				<?php echo h($user['User']['last_login']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Password'); ?></dt>
			<dd>
				<?php echo h($user['User']['password']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User Type'); ?></dt>
			<dd>
				<?php echo h($user['User']['user_type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($user['User']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Email'); ?></dt>
			<dd>
				<?php echo h($user['User']['email']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($user['User']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($user['User']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($user['User']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('User')), array('action' => 'edit', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('User')), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Customers')), array('controller' => 'customers', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Customer')), array('controller' => 'customers', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('User Ips')), array('controller' => 'user_ips', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User Ip')), array('controller' => 'user_ips', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
	-->
</div>
<!--
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Clients')); ?></h3>
	<?php if (!empty($user['Client'])):?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo $user['Client']['name'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Kana'); ?></dt>
			<dd>
				<?php echo $user['Client']['kana'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['contents_type_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['area_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['municipal_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Prefecture Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['prefecture_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Publicity Range'); ?></dt>
			<dd>
				<?php echo $user['Client']['publicity_range'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Client Type Id'); ?></dt>
			<dd>
				<?php echo $user['Client']['client_type_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Info'); ?></dt>
			<dd>
				<?php echo $user['Client']['info'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Character'); ?></dt>
			<dd>
				<?php echo $user['Client']['character'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Representative'); ?></dt>
			<dd>
				<?php echo $user['Client']['representative'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Position'); ?></dt>
			<dd>
				<?php echo $user['Client']['position'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Zip'); ?></dt>
			<dd>
				<?php echo $user['Client']['zip'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Address'); ?></dt>
			<dd>
				<?php echo $user['Client']['address'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sub Address'); ?></dt>
			<dd>
				<?php echo $user['Client']['sub_address'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Tel'); ?></dt>
			<dd>
				<?php echo $user['Client']['tel'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Fax'); ?></dt>
			<dd>
				<?php echo $user['Client']['fax'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo $user['Client']['url'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Mail'); ?></dt>
			<dd>
				<?php echo $user['Client']['mail'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Gmap Code'); ?></dt>
			<dd>
				<?php echo $user['Client']['gmap_code'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name1'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name1'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name2'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name2'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name3'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name3'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name4'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name4'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name5'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name5'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name6'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name6'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name7'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name7'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name8'); ?></dt>
			<dd>
				<?php echo $user['Client']['file_name8'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo $user['Client']['status'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo $user['Client']['modified'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo $user['Client']['created'];?>
				&nbsp;
			</dd>
		</dl>
	<?php endif; ?>
	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('Edit %s', __('Client')), array('controller' => 'clients', 'action' => 'edit', $user['Client']['id'])); ?></li>
		</ul>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Customers')); ?></h3>
	<?php if (!empty($user['Customer'])):?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Name'); ?></dt>
			<dd>
				<?php echo $user['Customer']['last_name'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Name'); ?></dt>
			<dd>
				<?php echo $user['Customer']['first_name'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Kana'); ?></dt>
			<dd>
				<?php echo $user['Customer']['last_kana'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Kana'); ?></dt>
			<dd>
				<?php echo $user['Customer']['first_kana'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Gender'); ?></dt>
			<dd>
				<?php echo $user['Customer']['gender'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Customer Type'); ?></dt>
			<dd>
				<?php echo $user['Customer']['customer_type'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('User Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['user_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['area_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['municipal_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Prefecture Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['prefecture_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Family Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['family_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Zip'); ?></dt>
			<dd>
				<?php echo $user['Customer']['zip'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Address'); ?></dt>
			<dd>
				<?php echo $user['Customer']['address'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sub Address'); ?></dt>
			<dd>
				<?php echo $user['Customer']['sub_address'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name'); ?></dt>
			<dd>
				<?php echo $user['Customer']['file_name'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Birth'); ?></dt>
			<dd>
				<?php echo $user['Customer']['birth'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Occupation'); ?></dt>
			<dd>
				<?php echo $user['Customer']['occupation'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Info'); ?></dt>
			<dd>
				<?php echo $user['Customer']['info'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Private Flag'); ?></dt>
			<dd>
				<?php echo $user['Customer']['private_flag'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo $user['Customer']['status'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo $user['Customer']['url'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Token'); ?></dt>
			<dd>
				<?php echo $user['Customer']['FB_token'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Id'); ?></dt>
			<dd>
				<?php echo $user['Customer']['FB_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('FB Data'); ?></dt>
			<dd>
				<?php echo $user['Customer']['FB_data'];?>
				&nbsp;
			</dd>
		</dl>
	<?php endif; ?>
	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('Edit %s', __('Customer')), array('controller' => 'customers', 'action' => 'edit', $user['Customer']['id'])); ?></li>
		</ul>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('User Ips')); ?></h3>
	<?php if (!empty($user['UserIp'])):?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo $user['UserIp']['id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('User Id'); ?></dt>
			<dd>
				<?php echo $user['UserIp']['user_id'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Ip'); ?></dt>
			<dd>
				<?php echo $user['UserIp']['ip'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo $user['UserIp']['modified'];?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo $user['UserIp']['created'];?>
				&nbsp;
			</dd>
		</dl>
	<?php endif; ?>
	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('Edit %s', __('User Ip')), array('controller' => 'user_ips', 'action' => 'edit', $user['UserIp']['id'])); ?></li>
		</ul>
	</div>
</div>
-->
