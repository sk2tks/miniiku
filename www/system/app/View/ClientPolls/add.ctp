<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('ClientPoll', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Client Poll')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('client_id');
				echo $this->BootstrapForm->input('poll_n1');
				echo $this->BootstrapForm->input('poll_n2');
				echo $this->BootstrapForm->input('poll_n3');
				echo $this->BootstrapForm->input('poll_n4');
				echo $this->BootstrapForm->input('poll_n5');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Client Polls')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>