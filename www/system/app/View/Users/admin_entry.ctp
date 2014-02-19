<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('User', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('施設管理者')); ?></legend>
				<?php else: ?>
				<legend><?php echo __('Admin Add %s', __('施設管理者')); ?></legend>
				<?php endif; ?>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->hidden('user_type',array('value'=>1)); 
				echo $this->BootstrapForm->input('name');
				echo $this->BootstrapForm->input('email');
				if($isEdit){
					echo $this->BootstrapForm->input('new_password', array('label'=>'新規パスワード'));
				}else{
					echo $this->BootstrapForm->input('password');
				}
				
				
				echo $this->BootstrapForm->input('status', array('default'=>0, 'type'=>'radio','options'=>MasterOption::$userStatus));
				?>
				<div class="form-actions">
					<button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick='history.back();'>一覧に戻る</button>
					
				</div>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('観覧する操作'); ?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('施設管理者')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?></li>
			
		</ul>
		</div>
	</div>
</div>