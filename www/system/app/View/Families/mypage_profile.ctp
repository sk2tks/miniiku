<?php echo $this->Html->script('/js/mypage', array('inline'=>true)); ?>
<?php echo $this->Form->create('Family', array('url'=>$this->params->herer, 'class'=>'mailForm', 'id'=>'familyForm',
							'inputDefaults'=>array('label'=>false,'div'=>false, 'legend'=>false))); ?>
<?php echo $this->Form->hidden('Family.id'); ?>
<?php echo $this->Form->hidden('Family.customer_id'); ?>
<div class="innerBox innerBox10">
	<div class="topImg"><img src="/img/mypage/sub_box_top_img01.png" width="716" height="10" alt=""></div>
	<div class="subBox">
		<p class="pTtl">パートナー・親族</p>
		<?php //pr($partners); ?>
		<?php foreach($partners as $n => $customer):  ?>
		<div class='partnerBox'>
			<div class="inner clearfix">
				<div class="photoBox"> <span></span>
					<?php
						if(!empty($customer['Customer']['file_name'])){
						 	$image = CUSTOMER_DIR .'list/'.$customer['Customer']['file_name'];
						}else{
							$image = DEFAULT_IMG_CUSTOMER_L;
						}
					?>
					<img src="<?php echo $image; ?>" width="110"  alt=""> </div>

				<table cellpadding="0" cellspacing="0" summary="パートナー・親族">
					<colgroup><col width="33%">
					<col width="67%">
					</colgroup><tbody>
						<tr>
							<th>ユーザー名 ：</th>
							<td>
								<?php echo h($customer['User']['name']); ?>
							</td>
						</tr>
						<tr>
							<th>名前 ：</th>
							<td>
								<?php  printf("%s %s", h($customer['Customer']['last_name']), h($customer['Customer']['first_name'])); ?>
							</td>
						</tr>
						<tr>
							<th>続柄 ：</th>
							<td>
								<?php if(!empty($customer['Customer']['customer_type'])) echo MasterOption::$customerTypes[$customer['Customer']['customer_type']]; ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php if($is_main_customer): ?>
			<p class="pLink">&gt;&gt;<a href="javascript:void(0);"
					onclick="unRegistCustomer(<?php echo $customer['Customer']['id']; ?>);">登録解除</a></p>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>

	</div>
</div>

<div class="innerBox innerBox01">
	<div class="topImg"><img src="/img/mypage/sub_box_top_img02.png" width="716" height="10" alt=""></div>
	<div class="subBox" id='childBox'>
		<p class="pTtl">こども</p>
<?php if(!empty($this->data['Child'])): ?>
<?php foreach($this->data['Child'] as $n=>$child): ?>
		<div class="tableBox" data-num="<?php echo $n; ?>">
			<p class="pNote"><span>※</span>は必須項目
			<?php echo $this->Form->hidden("Child.{$n}.call_name"); ?>
			&nbsp;&nbsp;<?php echo $this->Form->error("Child.{$n}.call_name",null, array('wrap'=>'span')); ?>
			</p>
			<table cellpadding="0" cellspacing="0" summary="こども">
				<?php echo $this->Form->hidden("Child.{$n}.id"); ?>
				<?php echo $this->Form->hidden("Child.{$n}.family_id"); ?>
				<?php echo $this->Form->hidden("Child.{$n}.status", array('value'=>'1')); ?>
				<colgroup>
					<col width="22%">
					<col width="59%">
				</colgroup><tbody>
					<tr>
						<th><span>※</span>名前：</th>
						<td><?php echo $this->Form->input("Child.{$n}.name", array('label'=>false,'class'=>'wid01')); ?></td>
						<td></td>
					</tr>
					<tr>
						<th class="thSpecial">ふりがな：</th>
						<td><?php echo $this->Form->input("Child.{$n}.kana", array('label'=>false, 'class'=>'wid01')); ?></td>
						<td><div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_kana",
								array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?></td>
					</tr>
					<tr>
						<th class="thSpecial">写真 ： </th>
						<td><ul class="photo clearfix">
								<li>
									<div class='file css_btn_class'>ファイル選択
									<input type="file" value="" name="files" class='uploader'>
									<?php echo $this->Form->hidden("Child.{$n}.uploaded"); ?>
									<?php echo $this->Form->hidden("Child.{$n}.file_name"); ?>
									</div>
								</li>
								<li class='image-box'>
									<?php
										$img = '';
										if(!empty($this->data['Child'][$n]['uploaded'])){
											$img = TEMP_DIR . 'thumb/' .  $this->data['Child'][$n]['uploaded'];
										}else if(!empty($this->data['Child'][$n]['file_name'])){
											$img = '/uploads/customer/thumb/'. $this->data['Child'][$n]['file_name'];
										}
									?>
									<img src="<?php echo !empty($img) ? $img:DEFAULT_IMG_CHILD; ?>" width="70" alt="">
								</li>
								<li class='delete_image' <?php if(empty($img)): ?>style='display:none'<?php endif; ?>>
									<img src="/img/mypage/link12.jpg" width="26" height="23" alt="削除" class='over' onclick='deleteImage(this, "<?php echo DEFAULT_IMG_CHILD; ?>");'>
									<input type='hidden' name='data[Child][<?php echo $n; ?>][deleted]' value='' class='deleted' />
								</li>
							</ul></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th class="thSpecial">性別 ： </th>
						<td>
							<?php echo $this->Form->input("Child.{$n}.gender",
								array('type'=>'radio', 'legend'=>false, 'label'=>true, 'options'=>array('1'=>' 男の子　', '2'=>' 女の子　'), 'separator'=>'　　　')); ?>
							</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_gender", array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
							</div>
						</td>
					</tr>
					<tr>
						<th class="thSpecial">誕生日 ：</th>
						<td>
							<?php echo $this->Form->input("Child.{$n}.birth",$this->Form->birthday_option(	array('label'=>false))); ?>
						</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_birthday", array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
							</div>
						</td>
					</tr>
					<tr class="trFacility">
						<th class="thSpecial">通園施設：</th>
						<td colspan="2"><ul class="facility">
							<li>
								<?php echo $this->Form->input('child_client_area',
									array('type'=>'select', 'label'=>false, 'div'=>false, 'options'=>$child_client_areas, 'empty'=>'地域', 'onchange'=>'childClientAreaChanged(this);')); ?>
								&gt;
								<?php echo $this->Form->input('child_client_type',
									array('type'=>'select', 'label'=>false, 'div'=>false, 'options'=>$child_client_types, 'empty'=>'種類', 'onchange'=>'childClientTypeChanged(this);', 'disabled')); ?>
								&gt;
								<?php echo $this->Form->input("Child.{$n}.client_id",
									array('type'=>'select', 'label'=>false, 'div'=>false, 'empty'=>'施設名','options'=>array('その他'=>'その他'), 'onChange'=>'childClientIdChanged(this);', 'disabled')); ?>
							</li>
						</ul></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<?php echo $this->Form->hidden("Child.{$n}.client_id", array('id'=>"child_client_id_${n}", 'class'=>'clientId')); ?>
							<?php $clientName = $child['client_name'];
									if(empty($clientName) && !empty($child['Client']['name'])){ $clientName = $child['Client']['name']; } ?>
							<?php echo $this->Form->input("Child.{$n}.client_name",
								array('type'=>'text', 'class'=>'wid01 clientName','readonly'=>'readonly','id'=>"child_client_name_${n}", 'value'=>$clientName, 'default'=>'未設定')); ?>
							<a href="javascript:void(0);" class='clientVote' <?php if(empty($this->data['Child'][$n]['use_client_vote'])): ?>style='display:none;'<?php endif; ?>>
								<img src="/img/mypage/link18.jpg" width="120" height="23" alt="施設を評価する" onclick='evaluateClient(this);'></a>
						</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_client", array('type'=>'radio', 'label'=>true, 'legend'=>false, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php if($is_main_customer): ?>
			<p class="pLink">&gt;&gt;<a href="javascript:void(0);"
					onclick="unRegistChild(<?php echo $this->data['Child'][$n]['id']; ?>);">登録解除</a></p>
			<?php endif; ?>
		</div>
<?php endforeach; ?>
<?php endif; ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
<table>
	<colgroup>
		<col width="22%">
		<col width="59%">
	</colgroup>
<tbody>
	<tr>
		<td class="linkList clearfix"><a href="javascript:addChild();"><img src="/img/mypage/link13.jpg" width="157" height="33" alt="子どもを追加"></a></td>
		<td class="linkList" style="text-align:right;">
			<input id='familyRegist' onclick='editFamily();' type="image" name="__send__" src="/img/mypage/link11_out.jpg" value="登録する" alt="登録する" onmouseover="this.src='/img/mypage/link11_over.jpg'" onmouseout="this.src='/img/mypage/link11_out.jpg'">
		</td>
	</tr>
</tbody></table>
<div id='family_resultMessage' style='font-size:50px;  color:gray; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:200px;
	opacity:0.6; width:703px; height:100px; display:none'>
	登録しました
</div>
<div id='family_errorMessage' style='font-size:36px;  color:#E00; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:200px;
	opacity:0.6; width:703px; height:100px; display:none'>
	※入力にエラーがあります
</div>
<script>



$(function(){
	Uploader.init('/mypage/customers/upload');
	setRollover();

<?php if(!empty($saved)): ?>

//$('#family_resultMessage').css('top', ($('#familyRegist').position().top - 300)  + "px");
//$('#family_resultMessage').fadeIn('slow');
//setTimeout(function(){$('#family_resultMessage').fadeOut('slow');}, 3000);
onFamilyUpdateSuccess();
<?php endif; ?>

<?php if(!empty($error)): ?>
$('#family_errorMessage').css('top', ($('#familyRegist').position().top - 300)  + "px");
$('#family_errorMessage').fadeIn('slow');
setTimeout(function(){$('#family_errorMessage').fadeOut('slow');}, 3000);
<?php endif; ?>


});

function addChild(){
	var cnt = $('.tableBox:last').data('num');
	if(isNaN(cnt)) cnt = 0;
	$.get('/mypage/families/child_unit/' + (cnt+1).toString(),function(data){
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
<?php echo $this->element('sql_dump'); ?>
