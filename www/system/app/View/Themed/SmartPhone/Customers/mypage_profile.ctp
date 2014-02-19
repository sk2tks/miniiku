<style>
.error-message {
	color: #b94a48;
}
</style>

<?php echo $this->Html->script('/js/mypage', array('inline'=>true)); ?>
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
	// $('.delete_chk').click(function(){
		// $(this).next().val('1');
		// var li = $(this).parents('li:first');
		// li.hide();
		// li.prev('li.image-box').hide();
	// })
	Uploader.init('/customers/upload');
});

var customerTypes = <?php echo json_encode(MasterOption::$customerTypes); ?>;
$(function(){
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

</script>
<?php echo $this->Facebook->init(); ?>
<?php if(empty($this->data['Customer']['FB_id'])): ?>
<div class="fb_rendou">
	<!--<a href="#"><img src="/sp/img/maypage/img_link_fb.jpg" width="100%" /></a>-->
	<?php echo $this->Facebook->login(array('custom'=>true, 'img'=>'/sp/img/maypage/img_link_fb.jpg', 'redirect'=>'/users/fb_login')); ?>
</div>
<?php endif; ?>
<p class="txt01"><span>＊</span>は必須項目</p>
<?php echo $this->Form->create('Customer', array('type'=>'file', 'class'=>'mailForm', 'id'=>'profileForm', 'inputDefaults'=>array('label'=>false, 'div'=>false, 'legend'=>false))); ?>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('User.id');
	?>
	<table cellpadding="0" cellspacing="0" summary="ユーザー情報" class="comTable">
		<col width="75%">
		<col width="25%">
		<tbody>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>ユーザー名 ：</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('User.name', array('class'=>'inputTxt01')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>メールアドレス&nbsp;※非公開</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('User.email', array('class'=>'inputTxt01')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">パスワード&nbsp;※非公開</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('User.new_password', array('class'=>'inputTxt01', 'placeholder'=>'パスワードを変更する場合に入力してください')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">パスワード（再）</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('User.new_password2', array('class'=>'inputTxt01', 'placeholder'=>'パスワードを変更する場合に入力してください')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">名前</th>
			</tr>
			<tr>
				<td>
					<span class="txt02">性</span>
					<?php echo $this->Form->input('last_name', array('class'=>'inputTxt02', 'error'=>false)); ?>
					<span class="txt02">名</span>
					<?php echo $this->Form->input('first_name', array('class'=>'inputTxt03', 'error'=>false)); ?>
				</td>
				<td>
					<?php
						echo $this->Form->input('pv_name', array(
							'type'=>'radio', 'label'=>true, 'options'=>array('1'=>' 公開', '0'=>' 非公開'), 'default'=>0, 'separator'=>'<br>'
						));
					?>
				</td>
			</tr>
			<tr>
				<th colspan="2">ふりがな</th>
			</tr>
			<tr>
				<td>
					<span class="txt02">せい</span>
					<?php echo $this->Form->input('last_kana', array('class'=>'inputTxt02', 'error'=>false)); ?>
					<span class="txt02">めい</span>
					<?php echo $this->Form->input('first_kana', array('class'=>'inputTxt03', 'error'=>false)); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">写真</th>
			</tr>
			<tr>
				<td>
					<ul class="clearfix selectPhoto">
						<li style="width:40%">
							<input type="file" name="files" value="" class='uploader' style="width:90%">
							<?php echo $this->Form->hidden('Customer.uploaded'); ?>
							<?php echo $this->Form->hidden('Customer.file_name'); ?>
						</li>
						<li class='image-box' style="width:51px">
							<?php
								$img = "";
								if(!empty($this->data['Customer']['uploaded'])){
									$img = TEMP_DIR . 'thumb/' .  $this->data['Customer']['uploaded'];
								}else if(!empty($this->data['Customer']['file_name'])){
									$img = '/uploads/customer/thumb/'. $this->data['Customer']['file_name'];
								}
								$display = empty($img) ? 'none' : 'block';
							?>
							<img src="<?php echo empty($img) ?  DEFAULT_IMG_CUSTOMER_S : $img; ?>" alt="" width="51">
						</li>
						<li class='delete_image' style="width:26px;display:<?php echo $display; ?>">
							<img src="/img/mypage/link12.jpg" width="26" height="23" alt="削除" class='over' onclick='deleteImage(this);'>
							<input type='hidden' name='data[deleted]' value='' class='deleted'/>
						</li>
					</ul>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>性別・続柄</th>
			</tr>
			<tr>
				<td><ul class="radioUl clearfix">
						<li>
							<span>性別：</span>
							<?php echo $this->Form->input('gender', array('type'=>'radio','class'=>'gender', 'options'=>MasterOption::$gender, 'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;')); ?><br />
							<span>続柄：</span>
							<?php echo $this->Form->input('customer_type', array('type'=>'select', 'options'=>MasterOption::$customerTypes, 'empty'=>'選択してください', 'id'=>'customerType'));?>
						</li>
					</ul></td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>誕生日 ※非公開</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('birth',$this->Form->birthday_option()); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>郵便番号 ※非公開</th>
			</tr>
			<tr>
				<td><ul class="telUl clearfix">
						<li>
							<?php echo $this->Form->input('zip1', array('id'=>'zip1', 'maxLength'=>'3', 'class'=>'inputTxt04')); ?>
							<span>－</span>
							<?php echo $this->Form->input('zip2', array('id'=>'zip2', 'maxLength'=>'4', 'class'=>'inputTxt05')); ?>
							&nbsp;<img id='get_zip_info' src="/sp/img/maypage/img_link01.jpg" alt="住所検索" width="59">
						</li>
					</ul></td>
				<td>&nbsp;
					<?php echo $this->Form->hidden('municipal_id', array('id'=>'municipal')); ?>
					<?php echo $this->Form->hidden('area_id', array('id'=>'area')); ?>
				</td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>住所</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('prefecture_id', array('id'=>'prefecture', 'options'=>$prefectures, 'empty'=>'選択してください')); ?>
					<?php echo $this->Form->input('address', array('class'=>'inputTxt01', 'id'=>'address')); ?>
				</td>
				<td></td>
			</tr>
			<tr>
				<th colspan="2"><span style="color:#dc0000">＊</span>住所(番地以下) ※非公開</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('sub_address', array('class'=>'inputTxt01')); ?>
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">URL(ブログなど)</th>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('url', array('class'=>'inputTxt01')); ?>
				</td>
			</tr>
				<td>&nbsp;</td>
			</tbody>
	</table>
<?php echo $this->Form->end() ;?>
<ul class="submit clearfix">
	<li>
		<a href="/mypage/users/invite" class='fancybox fancybox.iframe'><img src="/sp/img/maypage/btn_05.jpg" alt="パートナー・親族を招待" width="252"></a>
	</li>
	<li>
		<img id="profileRegist" onclick='editProfile();' alt="登録する" value="登録する" src="/sp/img/maypage/btn_04.jpg" name="__send__" class="btn01" width="240">
	</li>
</ul>
<div id='resultMessage' style='font-size:40px;  color:gray; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:500px;
	opacity:0.6; width:100%; display:none'>
	登録しました
</div>

<script>
$(function(){
	$('.fancybox').fancybox({
		padding: 0,
		width: '100%',//'548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {closeClick : true}}
	});

	<?php if(!empty($saved)): ?>
	$('#resultMessage').css( 'top', ( $('#profileRegist').position().top - 100 )  + "px" );
	//alert('登録しました');
	$('#resultMessage').fadeIn('slow');
	setTimeout(function(){$('#resultMessage').fadeOut('slow');}, 3000);
	//updateSidebar();
	//onProfileUpdateSuccess();
	<?php endif; ?>

});
</script>
