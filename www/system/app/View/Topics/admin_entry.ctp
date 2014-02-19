<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>

<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Topic', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php $ope = $isEdit ? 'Edit' : 'Add'; ?>
			<legend>育児情報　<?php echo __("Admin {$ope} %s", __('Topic')); ?></legend>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->hidden('contents_type_id', array('default'=>'6'));
				echo $this->BootstrapForm->input('category_id', array('id'=>'category_id', 'empty'=>'カテゴリを指定'));
				echo $this->BootstrapForm->input('user_id', array('empty'=>'なし'));
				echo $this->BootstrapForm->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください'));
				echo $this->BootstrapForm->input('municipal_id', array('id'=>'municipal', 'label'=>'自治体(都道府県に依存)'));
				echo $this->BootstrapForm->input('area_id', array('id'=>'area', 'label'=>'地域(自治体に依存)'));
				echo $this->BootstrapForm->input('publicity_range', array('type'=>'select', 'options'=>$publicity_ranges));
				echo $this->BootstrapForm->input('source', array('empty'=>'選択してください'));
				echo $this->BootstrapForm->input('source_url');
				echo $this->BootstrapForm->input('pub_date');
				echo $this->BootstrapForm->input('title');
				echo $this->BootstrapForm->input('body');
				echo $this->BootstrapForm->input('file_name');
				echo $this->BootstrapForm->input('related_topic');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>