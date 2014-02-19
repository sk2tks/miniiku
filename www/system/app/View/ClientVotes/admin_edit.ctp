<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('ClientVote', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Client Vote')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('client_id');
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('n1', array()

				);
				echo $this->BootstrapForm->input('n2', array()

				);
				echo $this->BootstrapForm->input('n3', array()

				);
				echo $this->BootstrapForm->input('n4', array()

				);
				echo $this->BootstrapForm->input('n5', array()

				);
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ClientVote.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ClientVote.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Client Votes')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>