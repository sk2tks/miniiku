<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('CommentAlert', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Add %s', __('Comment Alert')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('contents_type_id');
				echo $this->BootstrapForm->input('contents_target_id', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('comment_id');
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('alert_flag');
				echo $this->BootstrapForm->input('alert_check');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
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
</div>