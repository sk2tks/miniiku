<?php //debug('data:');debug($this->data);?>
<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>
<script>
$(function(){
	$('#category').change(function(){
		var category_id = $(this).val();
		$.getJSON(
			'/admin/bbs/get_tags/' + category_id,
			null,
			function(data){
				console.log('data:');console.log(data);
				$('#tag').setOptions(data);
				$('#tag').prepend('<option value="0">タグを指定</option>');
			}
		);
	});

	Uploader.init('/bbs/upload');
});
</script>
<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Topic', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php $ope = $isEdit ? 'Edit' : 'Add'; ?>
				<legend>交流広場　<?php echo __("Admin {$ope} %s", __('Topic')); ?></legend>
				<?php
					echo $this->BootstrapForm->hidden('id');
					echo $this->BootstrapForm->hidden('contents_type_id', array('default'=>'7'));
					echo $this->BootstrapForm->input('category_id', array('id'=>'category', 'empty'=>'選択してください'));
					echo $this->BootstrapForm->input('tag_id', array('id'=>'tag', 'label'=>'タグ(カテゴリに依存)', 'empty'=>'タグを指定'));
					echo $this->BootstrapForm->input('user_id', array('type'=>'text', 'label'=>'投稿者ユーザーID'));
					echo $this->BootstrapForm->input('prefecture_id', array('id'=>'prefecture', 'default'=>'13'));
					echo $this->BootstrapForm->input('municipal_id', array('id'=>'municipal', 'label'=>'自治体(都道府県に依存)'));
					echo $this->BootstrapForm->input('area_id', array('id'=>'area', 'label'=>'地域(自治体に依存)'));
					echo $this->BootstrapForm->input('publicity_range', array('type'=>'select', 'options'=>$publicity_ranges));
					echo $this->BootstrapForm->input('title');
					echo $this->BootstrapForm->input('body');
					echo $this->BootstrapForm->input('related_topic');

					echo $this->element('admin/upload_element', array(
						'data'=>!empty($this->data['Topic']) ? $this->data['Topic'] : array(),
						'deleted'=>'deleted1',
						'uploaded'=>'uploaded1',
						'file_name'=>'file_name1',
						'dir'=>TOPIC_DIR
					));
					echo $this->element('admin/upload_element', array(
						'data'=>!empty($this->data['Topic']) ? $this->data['Topic'] : array(),
						'deleted'=>'deleted2',
						'uploaded'=>'uploaded2',
						'file_name'=>'file_name2',
						'dir'=>TOPIC_DIR
					));
					// echo $this->BootstrapForm->input('file_name1');
					// echo $this->BootstrapForm->input('file_name2');

					echo $this->BootstrapForm->input('closed', array('type'=>'checkbox'));
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
</div>