<?php echo $this->Html->script('/js/mypage', array('inline'=>true)); ?>
<style>
#conts .subTab01 .mailForm td .list li input[type=radio]{
	margin-right:5px;
}
.mailForm select{
	margin-right:5px;
}

</style>
<script>

$(function(){
	$('#get_zip_info').click(function(){
		var zip1 = $('#zip1').val();
		var zip2 = $('#zip2').val();
		if(!zip1.match(/^[0-9]{3}/) || !zip2.match(/^[0-9]{4}/)){
			alert('郵便番号を半角数字で正しく入力してください');
			return;
		}
		var zip = $('#zip1').val() + $('#zip2').val();

		$.getJSON(
			'/api/get_zip_info/' + zip,
			null,
			function(data){

				if(data.length <=0 ){
					alert('その郵便番号からは情報が見つかりませんでした');
					return;
				}

				$('#prefecture').val(data['prefecture_id']);
				$('#municipal').val(data['municipal_id']);
				$('#area').val(data['area_id']);
				$('#address').val(data['city'].concat(data['sub_city']));

			}
		);
	});
	Uploader.init('/customers/upload');
});

var customerTypes = <?php echo json_encode(MasterOption::$customerTypes); ?>;
$(function(){
	//Uploader.init('/customers/upload');
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

</script>
<?php echo $this->Facebook->init(); ?>
<?php if(empty($this->data['Customer']['FB_id'])): ?>
<div class="fb_right">
	<?php echo $this->Facebook->login(array('custom'=>true, 'img'=>'/img/mypage/fb.jpg', 'redirect'=>'/users/fb_login')); ?>
	<!-- <a href="javascript:getFbInfo();"><img src="/img/mypage/fb.jpg"></a> -->
	</div>
<?php endif; ?>
<p class="pNote"><span>＊</span>は必須項目</p>
<?php echo $this->Form->create('Customer', array('type'=>'file', 'class'=>'mailForm', 'id'=>'profileForm', 'inputDefaults'=>array('label'=>false, 'div'=>false, 'legend'=>false))); ?>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('User.id');
	?>
	<table cellpadding="0" cellspacing="0" summary="ユーザー情報">
		<colgroup>
			<col width="22%">
			<col width="59%">
		</colgroup>
		<tbody>
			<tr>
				<th><sup>＊</sup>ユーザー名 ：</th>
				<td><?php echo $this->Form->input('User.name', array('class'=>'input01')); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th><sup>＊</sup>メールアドレス ：</th>
				<td><?php echo $this->Form->input('User.email', array('class'=>'femail')); ?></td>
				<td>※非公開</td>
			</tr>
			<tr>
				<th class="thSpecial">パスワード ：</th>
				<td>
				<?php echo $this->Form->input('User.new_password', array('class'=>'input01', 'placeholder'=>'変更する場合に入力してください')); ?>
				</td>
				<td>※非公開</td>
			</tr>
			<tr>
				<th class="thSpecial">パスワード（再） ：</th>
				<td>
				<?php echo $this->Form->input('User.new_password2', array('class'=>'input01', 'placeholder'=>'変更する場合に入力してください')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th class="thSpecial">名前：</th>
				<td>
				<ul class="nameList">
					<li>
						<span>姓</span>
						<?php echo $this->Form->input('last_name', array('class'=>'input02', 'error'=>false)); ?>

					</li>
					<li>
						<span>名</span>
						<?php echo $this->Form->input('first_name', array('class'=>'input02', 'error'=>false)); ?>

					</li>
				</ul>
				<?php echo $this->Form->error('last_name', array('attributes'=>array('wrap'=>'span'))); ?>
				<?php echo $this->Form->error('first_name', array('attributes'=>array('wrap'=>'span'))); ?>
				</td>
				<td>
				<div style='margin-left:-5px;'>
				<?php echo $this->Form->input('pv_name', array('type'=>'radio', 'label'=>true, 'options'=>array('1'=>' 公開', '0'=>' 非公開'), 'default'=>0, 'separator'=>'　')); ?>
				</div>
				</td>
			</tr>
			<tr>
				<th class="thSpecial">ふりがな ：</th>
				<td>
				<ul class="nameList">
					<li>
						<span>せい</span>
						<?php echo $this->Form->input('last_kana', array('class'=>'phonetic', 'error'=>false)); ?>
					</li>
					<li>
						<span>めい</span>
						<?php echo $this->Form->input('first_kana', array('class'=>'phonetic', 'error'=>false)); ?>
					</li>
				</ul>
				<?php echo $this->Form->error('last_name', array('attributes'=>array('wrap'=>'span'))); ?>
				<?php echo $this->Form->error('first_name', array('attributes'=>array('wrap'=>'span'))); ?>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th class="thSpecial">写真 ： </th>
				<td>
				<ul class="photo clearfix">
					<li>
						<div class='file css_btn_class'>
						<input type="file" value="" name="files" class='uploader'>ファイル選択
						<?php echo $this->Form->hidden('Customer.uploaded'); ?>
						<?php echo $this->Form->hidden('Customer.file_name'); ?>
						</div>
					</li>
					<li class='image-box'>
						<?php
							$img = "";
							if(!empty($this->data['Customer']['uploaded'])){
								$img = TEMP_DIR . 'thumb/' .  $this->data['Customer']['uploaded'];
							}else if(!empty($this->data['Customer']['file_name'])){
								$img = '/uploads/customer/thumb/'. $this->data['Customer']['file_name'];
							}
						?>
						<img src="<?php echo empty($img) ?  DEFAULT_IMG_CUSTOMER_S : $img; ?>" width="70" alt="">
					</li>
					<li class='delete_image' <?php if(empty($img)): ?>style='display:none'<?php endif; ?>>
						<img src="/img/mypage/link12.jpg" width="26" height="23" alt="削除" class='over' onclick='deleteImage(this);'>
						<input type='hidden' name='data[deleted]' value='' class='deleted'/>
					</li>
				</ul></td>
				<td>
				<div style='margin-left:-5px;'>
				</div>
				</td>
			</tr>
			<tr>
				<th><sup>＊</sup>性別・続柄 ： </th>
				<td>
				<ul class="list list01 clearfix">
					<li style='width:150px;'>
						<?php echo $this->Form->input('gender', array('type'=>'radio','class'=>'gender', 'options'=>MasterOption::$gender, 'separator'=>'　　')); ?>
					</li>
					<li class="liSpecial">
						<span>続柄</span>
						<?php 	echo $this->Form->input('customer_type', array('type'=>'select', 'options'=>MasterOption::$customerTypes, 'empty'=>'選択してください', 'id'=>'customerType'));
						;?>
					</li>
				</ul></td>
				<td>
				<div style='margin-left:-5px;'>
				</div>
				</td>
			</tr>
			<tr>
				<th><sup>＊</sup>誕生日 ：</th>
				<td><?php echo $this->Form->input('birth', $this->Form->birthday_option()); ?></td>
				<td>※非公開</td>
			</tr>
			<tr>
				<th><sup>＊</sup>郵便番号 ： </th>
				<td>
				<ul class="codeList">
					<li>
						<span>〒</span>
						<?php echo $this->Form->input('zip1', array('id'=>'zip1', 'maxLength'=>'3')); ?>
					</li>
					<li class="liSpecial">
						<span>－</span>
						<?php echo $this->Form->input('zip2', array('id'=>'zip2', 'maxLength'=>'4')); ?>
						<!-- <input type="text" value="" name="code"> -->
					</li>
					<li>
						<img src="/img/mypage/link09.jpg" width="89" height="23" alt="住所検索" id='get_zip_info' style='cursor:pointer'>
					</li>
				</ul>
				<?php echo $this->Form->error('zip', null, array('wrap'=>'div', 'style'=>'clear:both')); ?>
				</td>
				<td>※非公開
					<?php echo $this->Form->hidden('municipal_id', array('id'=>'municipal')); ?>
					<?php echo $this->Form->hidden('area_id', array('id'=>'area_id')); ?>
				</td>
			</tr>
			<tr>
				<th><sup>＊</sup>住所 ：</th>
				<td>
					<?php echo $this->Form->input('prefecture_id', array('id'=>'prefecture', 'options'=>$prefectures, 'empty'=>'選択してください')); ?>
					<?php echo $this->Form->input('address', array('class'=>'input02', 'id'=>'address')); ?>
				</td>
				<td>
					<div style='margin-left:-5px;'>
					<!-- <?php echo $this->Form->input('pv_address', array('type'=>'radio', 'label'=>true, 'options'=>array('1'=>' 公開', '0'=>' 非公開'), 'default'=>1, 'separator'=>'　')); ?> -->
					</div>
				</td>
			</tr>
			<tr>
				<th><sup>＊</sup>住所(番地以下) ：</th>
				<td>
					<?php echo $this->Form->input('sub_address', array('class'=>'input03')); ?>
				</td>
				<td>※非公開</td>
			</tr>
			<tr>
				<th class="thSpecial">URL(ブログなど) ：</th>
				<td>
					<?php echo $this->Form->input('url', array('class'=>'input03')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end() ;?>
<ul class="linkList clearfix">
	<li class="floatR">
		<input type="image" onclick='editProfile();' src="/img/mypage/link11_out.jpg" value="登録する" alt="登録する" onmouseover="this.src='/img/mypage/link11_over.jpg'" onmouseout="this.src='/img/mypage/link11_out.jpg'">
	</li>
</ul>
<div id='resultMessage' style='font-size:60px;  color:gray; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:200px;
	opacity:0.6; width:703px; height:100px; display:none'>
	登録しました
</div>

<script>
$(function(){
	$('.fancybox').fancybox({
		padding: 0,
		width: '548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {
						closeClick : false
						}
					}
	});

	<?php if(!empty($saved)): ?>
	//$('#resultMessage').fadeIn('slow');
	//setTimeout(function(){$('#resultMessage').fadeOut('slow');}, 3000);
	onProfileUpdateSuccess();
	updateSidebar();
	<?php endif; ?>

	setRollover();

});


</script>
