<?php //debug($this->data); ?>
<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('CommentAlert', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Edit %s', __('Comment Alert')); ?></legend>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->input('ContentsType.name', array('label'=>'対象コンテンツタイプ', 'type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('contents_target_id', array('label'=>'対象コンテンツ', 'type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('comment_id', array('type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('Comment.delete_flag', array('label'=>'削除フラグ', 'type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('user_id', array('label'=>'通報者ユーザーID', 'type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('User.name', array('label'=>'通報者ユーザー名', 'type'=>'text', 'readonly'=>'readonly'));
				echo $this->BootstrapForm->input('alert_flag', array('type'=>'select'));
				echo $this->BootstrapForm->input('alert_check', array('type'=>'checkbox'));
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CommentAlert.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CommentAlert.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comment Alerts')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
	-->
</div>