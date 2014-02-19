<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>

<script>
$(function(){
	Uploader.init('/families/upload');
})
</script>

<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Family', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('Family')); ?></legend>
				<?php else: ?>
				<legend><?php echo __('Admin Add %s', __('Family')); ?></legend>
				<?php endif; ?>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->input('customer_id', array('empty'=>'選択してください', 'label'=>'世帯主'));
				
				echo $this->BootstrapForm->input('nickname');
				echo $this->element('admin/upload_element', 
					array('data'=>!empty($this->data['Family']) ? $this->data['Family'] : array(), 'dir'=>CUSTOMER_DIR)); 
				
				//echo $this->BootstrapForm->input('file_name');
				?>
				<?php if($isEdit): ?>
				<hr>
				
				<div class="control-group">
					<label class="control-label">ファミリーメンバー</label>
					<div class='controls'>
					<?php if(!empty($this->request->data['Customer'])): ?>
					<ul>
					<?php foreach($this->request->data['Customer'] as $customer): ?>
						<?php  printf("<li>%s</li>", $this->Html->link(
							sprintf("%s %s",$customer['last_name'], $customer['first_name']), "/admin/customers/edit/".$customer['id']));; ?>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					</div>
				</div>
				<hr>
				<div class="control-group">
					<label class="control-label">子供</label>
					<div class='controls'>
					<?php if(!empty($this->request->data['Child'])): ?>
					<ul>
					<?php foreach($this->request->data['Child'] as $child): ?>
						<?php  printf("<li>%s</li>", $this->Html->link($child['name'], '/admin/children/edit/'.$child['id'])); ?>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="form-actions">
					<button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick='location.href="/admin/families"'>一覧に戻る</button>
					
				</div>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
		
		
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('関連する操作'); ?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Families')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Customers')), array('controller' => 'customers', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('Customer')), array('controller' => 'customers', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Children')), array('controller' => 'children', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('Child')), array('controller' => 'children', 'action' => 'add')); ?></li>
			
		</ul>
		</div>
	</div>
</div>