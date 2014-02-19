<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>


<script>
var customerTypes = <?php echo json_encode(MasterOption::$customerTypes); ?>;
$(function(){
	
	$('input[name="data[Customer][new_family]"]').click(function(){
		update_new_family();
	});
	update_new_family();
	Uploader.init('/customers/upload');
	setCustomerTypes(<?php  if(!empty($this->data['Customer']['customer_type'])) echo $this->data['Customer']['customer_type']; ?>);
	
	
	$('.gender').change(function(){
		setCustomerTypes();
	})
});

function setCustomerTypes(selected){
	var gender = $('.gender:checked').val();
	var data = {};
	if(gender != undefined){
		for(var key in customerTypes){
			
			if(key % 2 == 1 && gender == '1'){
				data[key] = customerTypes[key];
			}else if (key %2 == 0 && gender == '2'){
				data[key] = customerTypes[key];
			}
		}
		data[9] = 'その他';
	}
	
	$('#customerType').setOptions(data);
	
	if(selected){
		$('#customerType').val(selected);
	}
}

function update_new_family (){
	$new_family = $('input[name="data[Customer][new_family]"]:checked').val();
	if($new_family == 2){
		$('#family_name').parents('.control-group:first').show();
		$('#family_id').parents('.control-group:first').hide();
	}else{
		$('#family_name').parents('.control-group:first').hide();
		$('#family_id').parents('.control-group:first').show();
	}
}
</script>
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

<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Customer', array('type'=>'file', 'class' => 'form-horizontal', 'inputDefaults'=>array('hiddenField'=>false)));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('Customer')); ?></legend>
				<?php else: ?>
				<legend><?php echo __('Admin Add %s', __('Customer')); ?></legend>
				<?php endif; ?>
				<?php
				
				echo $this->BootstrapForm->hidden('User.id'); 
				echo $this->BootstrapForm->hidden('User.user_type', array('value'=>2));
				echo $this->BootstrapForm->input('User.name', array('label'=>'ユーザー名'));
				echo $this->BootstrapForm->input('User.email');
				if($isEdit){
					echo $this->BootstrapForm->input('User.new_password', array('label'=>'新規パスワード'));
					echo $this->BootstrapForm->input('User.new_password2', array('label'=>'新規パスワード（再）'));
				}else{
					echo $this->BootstrapForm->input('User.password');
				}
				
				echo $this->BootstrapForm->hidden('user_id');
				echo $this->BootstrapForm->hidden('id'); 
				echo $this->BootstrapForm->input('last_name');
				echo $this->BootstrapForm->input('first_name');
				echo $this->BootstrapForm->input('last_kana');
				echo $this->BootstrapForm->input('first_kana');
				?>
				<div class="control-group <?php if($this->BootstrapForm->error('zip')) echo ' error'; ?>">
						<label class="control-label" for="appendedInputButtons">郵便番号</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this->BootstrapForm->input('zip', 
									array('class'=>'span4', 'size'=>'7','maxLength'=>'7', 'div'=>false,'label'=>false, 'id'=>'zip', 'error'=>false));  ?> 
								<button class="btn btn-warning " type="button" id='get_zip_info'>郵便番号から情報を設定する</button>
								
							</div>
							<?php echo $this->BootstrapForm->error('zip'); ?>
						</div>
					</div>
				<?php
				echo $this->BootstrapForm->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください'));
				echo $this->BootstrapForm->input('address', array('id'=>'address', 'class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('sub_address', array('id'=>'sub_city', 'class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('municipal_id', array('id'=>'municipal','empty'=>'選択してください'));
				echo $this->BootstrapForm->input('area_id', array('id'=>'area', 'empty'=>'選択してください'));
				
				echo $this->BootstrapForm->input('gender', array('type'=>'radio','options'=>MasterOption::$gender, 'class'=>'gender'));
				echo $this->BootstrapForm->input('customer_type', array('type'=>'select', 'options'=>MasterOption::$customerTypes, 'empty'=>'選択してください', 'id'=>'customerType'));
				
				if($isEdit == false){
					echo $this->BootstrapForm->input('new_family', array('type'=>'radio','options'=>array(
						'1'=>'既存ファミリー',
						'2'=>'新規ファミリー作成'
					), 'default'=>'1', 'label'=>'ファミリー','id'=>'new_family', 'hiddenField'=>false));
				}
				echo $this->BootstrapForm->input('family_id', array('empty'=>'選択してください','id'=>'family_id', 'label'=>'ファミリー選択'));
				echo $this->BootstrapForm->input('family_nickname', array('label'=>'新規ファミリー名', 'id'=>'family_name'));
				
			
				echo $this->BootstrapForm->input('birth',$this->Form->birthday_option());
				echo $this->BootstrapForm->input('occupation');
				echo $this->BootstrapForm->input('info');
				
				
				
				
				echo $this->BootstrapForm->input('url');

				echo $this->element('admin/upload_element', 
					array('data'=>!empty($this->data['Customer']) ? $this->data['Customer'] : array(), 'dir'=>CUSTOMER_DIR)); 

				echo $this->BootstrapForm->input('status', array('type'=>'radio','default'=>0,'options'=>MasterOption::$userStatus, 'default'=>0));
				
				echo "<div class='control-group'>";
				echo "<label class='control-label'>公開設定</label>";
				echo "<div class='controls pv'>";
				
				
				echo $this->BootstrapForm->input('pv_name', array('type'=>'radio', 'label'=>'姓名', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_file', array('type'=>'radio', 'label'=>'画像', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_gender', array('type'=>'radio', 'label'=>'性別', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_birthday', array('type'=>'radio', 'label'=>'誕生日', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_address', array('type'=>'radio', 'label'=>'住所', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo $this->BootstrapForm->input('pv_url', array('type'=>'radio', 'label'=>'URL', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0));
				echo "</div></div>";
				
					
				//echo $this->BootstrapForm->input('FB_token');
				echo $this->BootstrapForm->input('FB_id', array('type'=>'text', 'label'=>'Facebook ID'));
				echo $this->BootstrapForm->input('FB_data', array('label'=>'Facebook Data'));
				echo $this->BootstrapForm->hidden('id');
				?>
				<div class="form-actions">
					<button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick='location.href="/admin/customers"'>一覧に戻る</button>
					
				</div>
				
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
		
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('関連する操作'); ?></li>
			<!-- <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Customer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Customer.id'))); ?></li> -->			
			<li><?php echo $this->Html->link('・'.__('List %s', __('Customers')), array('action' => 'index'));?></li>
			
			
			<li><?php echo $this->Html->link('・'.__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>