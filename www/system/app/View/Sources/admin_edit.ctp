<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Source', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Source')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('name', array(

				));
				echo $this->BootstrapForm->input('url', array(


				));
				echo $this->BootstrapForm->input('rss_name', array(


				));
				echo $this->BootstrapForm->input('rss_url', array(

				));
				echo $this->BootstrapForm->input('type', array(


				));
				echo $this->BootstrapForm->input('municipal_id', array(


				));
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Source.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Source.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Sources')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>