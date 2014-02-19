<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Update Info');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Body'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['body']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Update Date'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['update_date']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($updateInfo['UpdateInfo']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Update Info')), array('action' => 'edit', $updateInfo['UpdateInfo']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Update Info')), array('action' => 'delete', $updateInfo['UpdateInfo']['id']), null, __('Are you sure you want to delete # %s?', $updateInfo['UpdateInfo']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Update Infos')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Update Info')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

