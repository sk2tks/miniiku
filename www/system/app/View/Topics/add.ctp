<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Topic', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Topic')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('contents_type_id');
				echo $this->BootstrapForm->input('category_id');
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('area_id');
				echo $this->BootstrapForm->input('municipal_id');
				echo $this->BootstrapForm->input('prefecture_id');
				echo $this->BootstrapForm->input('title');
				echo $this->BootstrapForm->input('publicity_range');
				echo $this->BootstrapForm->input('body');
				echo $this->BootstrapForm->input('file_name');
				echo $this->BootstrapForm->input('source');
				echo $this->BootstrapForm->input('source_url');
				echo $this->BootstrapForm->input('site_url');
				echo $this->BootstrapForm->input('site_title');
				echo $this->BootstrapForm->input('pub_date');
				echo $this->BootstrapForm->input('related_topic');
				echo $this->BootstrapForm->input('modfied');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Topics')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('controller' => 'categories', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('controller' => 'categories', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Areas')), array('controller' => 'areas', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Area')), array('controller' => 'areas', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Prefectures')), array('controller' => 'prefectures', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Prefecture')), array('controller' => 'prefectures', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comment Alerts')), array('controller' => 'comment_alerts', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment Alert')), array('controller' => 'comment_alerts', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Family Likes')), array('controller' => 'family_likes', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Family Like')), array('controller' => 'family_likes', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Topic Votes')), array('controller' => 'topic_votes', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic Vote')), array('controller' => 'topic_votes', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>