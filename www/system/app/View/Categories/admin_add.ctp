<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Category', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Category')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('category_name');
				echo $this->BootstrapForm->input('contents_type_id');
				echo $this->BootstrapForm->input('slug');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Tags')), array('controller' => 'tags', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Tag')), array('controller' => 'tags', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Topics')), array('controller' => 'topics', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic')), array('controller' => 'topics', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>