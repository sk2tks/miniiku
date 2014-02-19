<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Client');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($client['Client']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($client['Client']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Kana'); ?></dt>
			<dd>
				<?php echo h($client['Client']['kana']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $client['ContentsType']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['User']['name'], array('controller' => 'users', 'action' => 'view', $client['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['Area']['name'], array('controller' => 'areas', 'action' => 'view', $client['Area']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['Municipal']['name'], array('controller' => 'municipals', 'action' => 'view', $client['Municipal']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Prefecture'); ?></dt>
			<dd>
				<?php echo $this->Html->link($client['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $client['Prefecture']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Publicity Range'); ?></dt>
			<dd>
				<?php echo h($client['Client']['publicity_range']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Client Type Id'); ?></dt>
			<dd>
				<?php echo h($client['Client']['client_type_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Info'); ?></dt>
			<dd>
				<?php echo h($client['Client']['info']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Character'); ?></dt>
			<dd>
				<?php echo h($client['Client']['character']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Representative'); ?></dt>
			<dd>
				<?php echo h($client['Client']['representative']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Position'); ?></dt>
			<dd>
				<?php echo h($client['Client']['position']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Zip'); ?></dt>
			<dd>
				<?php echo h($client['Client']['zip']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Address'); ?></dt>
			<dd>
				<?php echo h($client['Client']['address']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sub Address'); ?></dt>
			<dd>
				<?php echo h($client['Client']['sub_address']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Tel'); ?></dt>
			<dd>
				<?php echo h($client['Client']['tel']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Fax'); ?></dt>
			<dd>
				<?php echo h($client['Client']['fax']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo h($client['Client']['url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Mail'); ?></dt>
			<dd>
				<?php echo h($client['Client']['mail']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Gmap Code'); ?></dt>
			<dd>
				<?php echo h($client['Client']['gmap_code']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name1'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name1']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name2'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name2']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name3'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name3']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name4'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name4']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name5'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name5']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name6'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name6']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name7'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name7']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name8'); ?></dt>
			<dd>
				<?php echo h($client['Client']['file_name8']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($client['Client']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($client['Client']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($client['Client']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Client')), array('action' => 'edit', $client['Client']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Client')), array('action' => 'delete', $client['Client']['id']), null, __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Areas')), array('controller' => 'areas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Area')), array('controller' => 'areas', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Prefectures')), array('controller' => 'prefectures', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Prefecture')), array('controller' => 'prefectures', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

