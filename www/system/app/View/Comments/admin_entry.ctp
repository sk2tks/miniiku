<?php //debug('data:');debug($this->data);?>
<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Comment', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php $ope = $isEdit ? 'Edit' : 'Add'; ?>
				<legend><?php echo __("Admin {$ope} %s", __('Comment')); ?></legend>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->input('contents_type_id', array('label'=>'対象コンテンツタイプ'));
				echo $this->BootstrapForm->input('contents_target_id', array('label'=>'対象コンテンツID', 'type'=>'text'));
				echo $this->BootstrapForm->input('parent_comment_id', array('label'=>'親コメントID', 'type'=>'text'));
				echo $this->BootstrapForm->input('user_id', array('label'=>'投稿者ユーザーID', 'type'=>'text'));
				echo $this->BootstrapForm->input('body');
				echo $this->BootstrapForm->input('delete_flag');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Comment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Comment.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
	-->
</div>