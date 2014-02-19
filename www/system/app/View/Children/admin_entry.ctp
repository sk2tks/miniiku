<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>
<style>
div.pv{
	border:1px solid #EEE;
	width:400px;
	padding:5px 0;
}
div.pv div.control-group{
	margin-bottom:5px;
}
div.pv .control-label{
	width:110px
}
div.pv .controls{
	margin-left:140px;
}
div.pv .control-group{
	border-bottom:1px solid #F9F9F9;	
}
</style>
<script>
$(function(){
	Uploader.init('/children/upload');
})
</script>
<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Child', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('Child')); ?></legend>
				<?php else: ?>
				<legend><?php echo __('Admin Add %s', __('Child')); ?></legend>
				<?php endif; ?>
				
				<?php
				echo $this->BootstrapForm->hidden('Child.id');
				echo $this->BootstrapForm->input('gender', array('type'=>'radio','options'=>MasterOption::$gender));
				echo $this->BootstrapForm->input('name');
				echo $this->BootstrapForm->input('kana');
				echo $this->BootstrapForm->input('nickname');
				
				echo $this->BootstrapForm->input('birth',$this->Form->birthday_option());
				echo $this->BootstrapForm->input('family_id', array('empty'=>'選択してください'));
				
				//echo $this->BootstrapForm->input('file_name');
				
				echo $this->element('admin/upload_element', 
					array('data'=>!empty($this->data['Child']) ? $this->data['Child'] : array(), 'dir'=>CUSTOMER_DIR)); 
					
				echo $this->BootstrapForm->input('info', array('class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('client_id', array('empty'=>'選択してください'));
				echo "<div class='control-group'>";
				echo "<label class='control-label'>公開設定</label>";
				echo "<div class='controls pv'>";
				
				echo $this->BootstrapForm->input('pv_name', array('type'=>'radio', 'label'=>'姓名', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_kana', array('type'=>'radio', 'label'=>'ふりがな', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_nickname', array('type'=>'radio', 'label'=>'ニックネーム', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_file', array('type'=>'radio', 'label'=>'写真', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_gender', array('type'=>'radio', 'label'=>'性別', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_birthday', array('type'=>'radio', 'label'=>'誕生日', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_client', array('type'=>'radio', 'label'=>'通園施設', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo "</div></div>";
				
				echo $this->BootstrapForm->input('status', array('type'=>'radio','default'=>0, 'options'=>MasterOption::$userStatus));
				?>
				<div class="form-actions">
					<button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick='location.href="/admin/children/"'>一覧に戻る</button>
					
				</div>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('関連する操作'); ?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Children')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>