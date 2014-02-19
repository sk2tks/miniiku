<?php echo $this->Html->script('/js/mypage', array('inline'=>true)); ?>

<?php echo $this->Form->create('Family', array('url'=>$this->params->herer, 'class'=>'mailForm', 'id'=>'familyForm',
							'inputDefaults'=>array('label'=>false,'div'=>false, 'legend'=>false))); ?>
<?php echo $this->Form->hidden('Family.id'); ?>
<?php echo $this->Form->hidden('Family.customer_id'); ?>
	<div class="title01">パートナー・親族</div>
	<table cellpadding="0" cellspacing="0" summary="パートナー・親族" class="comTable parentTable">
		<col width="100%">
		<tbody>
			<?php //pr($partners); ?>
			<?php foreach($partners as $n => $customer):  ?>
			<tr><th>ユーザー名</th>
				<td rowspan="6" valign="top">
						<?php
							if(!empty($customer['Customer']['file_name'])){
							 	$image = CUSTOMER_DIR .'list/'.$customer['Customer']['file_name'];
							}else{
								$image = DEFAULT_IMG_CUSTOMER_L;
							}
						?>
						<img src="<?php echo $image; ?>" width="73"  alt="">
			</td></tr>
			<tr><td><?php echo h($customer['User']['name']); ?></td></tr>
			<tr><th>名前</th></tr>
			<tr><td>
					<?php
						printf("%s %s", h(
							$customer['Customer']['last_name']), h($customer['Customer']['first_name']
						));
					?>
			</td></tr>
			<tr><th>続柄</th></tr>
			<tr><td>
					<?php
						if(!empty($customer['Customer']['customer_type']))
							echo MasterOption::$customerTypes[$customer['Customer']['customer_type']];
					?>
			<br /><br />
			</td>
			<td>
					<?php if($is_main_customer): ?>
						<p class="pLink">
							<a href="javascript:void(0);" onclick="unRegistCustomer(<?php echo $customer['Customer']['id']; ?>);">登録解除</a>
						</p>
					<?php endif; ?>
			</td></tr>
			<tr><th></th><th></th></tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<br /><br />
	<div class="title02">こども</div>
	<div id='childBox'>
		<?php if(!empty($this->data['Child'])): ?>
		<?php foreach($this->data['Child'] as $n=>$child): ?>
		<?php echo $this->Form->hidden("Child.{$n}.call_name"); ?>
		&nbsp;&nbsp;<?php echo $this->Form->error("Child.{$n}.call_name",null, array('wrap'=>'span')); ?>
		<?php echo $this->Form->hidden("Child.{$n}.id"); ?>
		<?php echo $this->Form->hidden("Child.{$n}.family_id"); ?>
		<?php echo $this->Form->hidden("Child.{$n}.status", array('value'=>'1')); ?>
		<p class="txt01"><span>※</span>は必須項目</p>
		<table cellpadding="0" cellspacing="0" summary="こども" class="comTable childTable" style="margin-bottom:20px;border-bottom: 2px solid #ADE47A;">
			<col width="76%">
			<col width="24%">
			<tbody class="tableBox" data-num="<?php echo $n; ?>">
				<tr>
					<th colspan="2"><span class="color01">※</span>名前</th>
				</tr>
				<tr>
					<td>
						<?php echo $this->Form->input("Child.{$n}.name", array('class'=>'inputTxt01')); ?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<th colspan="2">ふりがな</th>
				</tr>
				<tr>
					<td>
						<?php echo $this->Form->input("Child.{$n}.kana", array('class'=>'inputTxt01')); ?>
					</td>
					<td>
						<?php echo $this->Form->input("Child.{$n}.pv_kana", array('type'=>'radio', 'label'=>true, 'separator'=>'<br>','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
					</td>
				</tr>
				<tr>
					<th colspan="2">写真</th>
				</tr>
				<tr>
					<td><ul class="clearfix selectPhoto">
							<li style="width:40%">
								<input type="file" value="" name="files" class='uploader' style="width:86%">
								<?php echo $this->Form->hidden("Child.{$n}.uploaded"); ?>
								<?php echo $this->Form->hidden("Child.{$n}.file_name"); ?>
							</li>
							<li class='image-box' style="width:44px">
								<?php
									$img = '';
									if(!empty($this->data['Child'][$n]['uploaded'])){
										$img = TEMP_DIR . 'thumb/' .  $this->data['Child'][$n]['uploaded'];
									}else if(!empty($this->data['Child'][$n]['file_name'])){
										$img = '/uploads/customer/thumb/'. $this->data['Child'][$n]['file_name'];
									}

									$display = empty($img) ? 'none' : 'block';
								?>
								<img src="<?php echo !empty($img) ? $img : DEFAULT_IMG_CHILD; ?>" alt="" width="44">
							</li>
							<li class='delete_image' style="width:17px;display:<?php echo $display; ?>">
								<img src="/sp/img/maypage/icon_01.gif" width="17" alt="削除" class='over' onclick='deleteImage(this);'>
								<input type='hidden' name='data[deleted]' value='' class='deleted'/>
							</li>
						</ul>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<th colspan="2"><span class="color01">※</span>性別</th>
				</tr>
				<tr>
					<td>
						<?php echo $this->Form->input("Child.{$n}.gender",
									array('type'=>'radio','label'=>true, 'options'=>array('1'=>' 男の子　', '2'=>' 女の子　'), 'separator'=>'　　　')); ?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<th colspan="2">誕生日</th>
				</tr>
				<tr>
					<td>
						<?php echo $this->Form->input("Child.{$n}.birth",$this->Form->birthday_option(
										array('separator' => array('　年　','　月　','　日')))); ?>
					</td>
					<td>
						<?php echo $this->Form->input("Child.{$n}.pv_birthday", array('type'=>'radio', 'label'=>true, 'separator'=>'<br>','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
					</td>
				</tr>
				<tr>
					<th colspan="2">通園施設</th>
				</tr>
				<tr>
					<td>
						<ul class="facility clearfix">
							<li style="width:100%">
								<?php echo $this->Form->input('child_client_area',
									array('type'=>'select', 'options'=>$child_client_areas, 'empty'=>'地域', 'onchange'=>'childClientAreaChanged(this);', 'style'=>'width:30%')); ?>

								&gt;
								<?php echo $this->Form->input('child_client_type',
									array('type'=>'select', 'options'=>$child_client_types, 'empty'=>'種類', 'onchange'=>'childClientTypeChanged(this);', 'style'=>'width:30%', 'disabled')); ?>

								&gt;
								<?php echo $this->Form->input("Child.{$n}.client_id",
									array('type'=>'select', 'empty'=>'施設名','options'=>array('その他'=>'その他'), 'onChange'=>'childClientIdChanged(this);', 'style'=>'width:30%', 'disabled')); ?>
							</li>
						</ul>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<?php echo $this->Form->hidden("Child.{$n}.client_id", array('id'=>"child_client_id_${n}", 'class'=>'clientId')); ?>
						<?php
							$clientName = $child['client_name'];
							if(empty($clientName) && !empty($child['Client']['name'])){
								$clientName = $child['Client']['name'];
							}
						?>
						<?php echo $this->Form->input("Child.{$n}.client_name",
							array('type'=>'text', 'class'=>'wid01 clientName','readonly'=>'readonly','id'=>"child_client_name_${n}", 'value'=>$clientName, 'default'=>'未設定')); ?>
						<a href="javascript:void(0);" class='clientVote' <?php if(empty($this->data['Child'][$n]['use_client_vote'])): ?>style='display:none;'<?php endif; ?>>
							<img src="/img/mypage/link18.jpg" width="120" height="23" alt="施設を評価する" onclick='evaluateClient(this);'>
						</a>

					</td>
					<td>
						<?php echo $this->Form->input("Child.{$n}.pv_client", array('type'=>'radio', 'label'=>true, 'separator'=>'<br>','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p class="pLink">
							<a href="javascript:void(0);" onclick="unRegistChild(<?php echo $this->data['Child'][$n]['id']; ?>);">登録解除</a>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php endforeach; ?>
		<?php endif; ?>
	</div>
<?php echo $this->Form->end(); ?>
<ul class="submit clearfix" style="text-align: center">
	<li>
		<a href="javascript:addChild();"><img src="/sp/img/maypage/btn_06.jpg" alt="子どもを追加" width="173"></a>
	</li>
<li>
		<img id='familyRegist' onclick='editFamily();' alt="登録する" value="登録する" src="/sp/img/maypage/btn_04.jpg" name="__send__" class="btn01">
	</li>
</ul>
<div id='family_resultMessage' style='font-size:40px;  color:gray; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:0px;
	opacity:0.6; width:300px; display:none'>
	登録しました
</div>
<div id='family_errorMessage' style='font-size:40px;  color:#E00; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:0px;
	opacity:0.6; width:300px; display:none'>
	※入力にエラーがあります
</div>

<script>
$(function(){
	Uploader.init('/mypage/customers/upload');
	setRollover();

	<?php if(!empty($saved)): ?>
	//$	('#family_resultMessage').css('top', ($('#familyRegist').position().top - 100)  + "px");
	//$('#family_resultMessage').fadeIn('slow');
	//setTimeout(function(){$('#family_resultMessage').fadeOut('slow');}, 3000);
	onFamilyUpdateSuccess();
	<?php endif; ?>

	<?php if(!empty($error)): ?>
	$('#family_errorMessage').css( 'top', ( $('#familyRegist').position().top - 100 )  + "px" );
	$('#family_errorMessage').fadeIn('slow');
	setTimeout(function(){$('#family_errorMessage').fadeOut('slow');}, 3000);
	<?php endif; ?>
});

function addChild(){
	var cnt = $('.tableBox:last').data('num');
	//console.log('cnt:' + cnt);
	if(isNaN(cnt)) cnt = 0;
	$.get('/mypage/families/child_unit/' + (cnt+1).toString(), function(data){
		$('#childBox').append(data);
	})
}
function openClientList(num){
	var selectedClienType = $("#child_client_type_" + num.toString()).val();
	var clientId = $("#child_client_id_" + num.toString()).val();

	$.fancybox({
		type: 'iframe',
		href: "/mypage/clients/popup_list/" + num + "/" + selectedClienType + "/" + clientId,
		padding: 0,
		width: '548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {
						closeClick : false
						}
				},
		beforeClose	:function(){
			fancyboxBeforeClosed();
		}
	});

}

function setChildClientId(targetChildNum, client_id, client_name){
	$("#child_client_id_" + targetChildNum.toString()).val(client_id);
	$("#child_client_name_" + targetChildNum.toString()).val(client_name);
}

//通園施設地域選択
function childClientAreaChanged(elem){
	$(elem).next().removeAttr('disabled').val('').next().val('').attr('disabled', 'diabled');
}
function childClientTypeChanged(elem){
	var areaId = $(elem).prev().val();
	var clientTypeId = $(elem).val();

	$.ajax({
		url:'/mypage/families/list_client/' + areaId + '/' + clientTypeId,
		dataType:'json',
		success:function(data){
			$(elem).next().removeAttr('disabled').setOptions(data, '施設名');
		}

	})
}
function childClientIdChanged(elem){

	if($(elem).val() == "") {
		$(elem).parents('tr:first').next().find('input.clientName').attr('readonly','readonly');
		return;
	}
	$(elem).parents('table:first').find('a.clientVote').hide();
	var num = $(elem).parents('.tableBox:first').data('num');
	if($(elem).val() == "その他"){
		$(elem).parents('tr:first').next().find('input.clientName').removeAttr('readonly');
		$("#child_client_id_" + num.toString()).val("");
	}else{
		$(elem).parents('tr:first').next().find('input.clientName').attr('readonly','readonly');
		var name = $(elem).children(':selected').text();
		$("#child_client_name_" + num.toString()).val(name);
		$("#child_client_id_" + num.toString()).val($(elem).val());
		/*
		checkClientVote($(elem).val(), function(data){
			console.log($(elem).parents('tr:first'));
			if(data == '0'){ //未評価
				$(elem).parents('table:first').find('.clientVote').show();
			}
		});*/
	}
}
</script>
