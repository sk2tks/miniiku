<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Tag', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Add %s', __('Tag')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('category_id');
				echo $this->BootstrapForm->input('word');
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
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('controller' => 'categories', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('controller' => 'categories', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
	-->
</div>