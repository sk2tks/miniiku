<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('ClientType', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('施設タイプ')); ?></legend>
				<?php else: ?>
				<legend><?php echo __('Admin Add %s', __('施設タイプ')); ?></legend>
				<?php endif; ?>
				<?php echo $this->BootstrapForm->input('name'); ?>
				<?php echo $this->BootstrapForm->input('contents_type_id', array('empty'=>'選択してください')); ?>
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
			<li class="nav-header"><?php echo __('関連する操作'); ?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('施設タイプ')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>