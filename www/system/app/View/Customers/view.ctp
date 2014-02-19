<?php $user_info = $this->Session->read('user_info'); ?>
<?php echo $this->Html->css(array('mypage'), null, array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.cookie.js', array('inline' => false)); ?>
<?php echo $this->Html->script('system', array('inline' => false)); ?>
<?php echo $this->Html->script('/common/js/common.js', array('inline' => false)); ?>
<style>
	#conts .section {
		background-image: none;
	}
	#conts .tabSection {
		background-image: none;
	}
</style>
<?php echo $this->Html->scriptStart(); ?>

$(function(){
	$('.subTab').hide();
	$('.subSection .subTab').eq(0).show();
	$('.subSection .subTab').eq(2).show();
	var str=window.location;
	str+='';
	if(str.indexOf('tab=')!=-1){
	var p=str.slice(str.indexOf('tab='));
	p=p.slice(4);
	$('.tabSection .linkUl li:eq('+p+')').addClass('on').siblings().removeClass('on');
	$('.tabSection .tabBox:eq('+p+')').show().siblings().hide();
	}

	$('.subSection .subLink li a').click(function(){
	var ind=$(this).parent('li').index();
	$(this).parent('li').addClass('on').siblings().removeClass('on');
	$(this).parent().parent().parent().find('.subTab').hide();
	$(this).parent().parent().parent().find('.subTab:eq('+ind+')').show();
	return false;
	});

});

function editProfile(){
	var data = $('#profileForm').serialize();
	//$('#profileArea').hide();
	$.ajax({
		type: 'POST',
		url:'/mypage/customers/profile',
		data: data,
		cache: false,
		success:function(data){
			$('#profileArea').html(data);
			$('#profileArea').fadeIn('slow');
		}
	});
}

function editFamily(){
	var data = $('#familyForm').serialize();
	//$('#familyArea').hide();
	$.ajax({
		type: 'POST',
		url:'/mypage/families/profile',
		data: data,
		cache: false,
		success:function(data){
		$('#familyArea').html(data);
		$('#familyArea').fadeIn('slow');
		}
	});
}
<?php echo $this->Html->scriptEnd(); ?>
<h2>ユーザー情報ページ</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li>ユーザー情報ページ</li>
</ul>
<div class="ttl">
	<p><span><?php echo $customer['User']['name']; ?>　さんのプロフィール</span></p>
</div>
<div class="tabSection tabSection1">
	<div class="section">
		<div class="tabBox" style="display: block;">
			<div class="dateUl clearfix"></div>
			<div class="subSection">
				<ul class="subLink clearfix">
					<li class="tab01 on">
						<a href="#"><img src="/img/mypage/link06.jpg" width="363" height="60" alt="ユーザー情報"></a>
					</li>
					<li class="tab02">
						<a href="#"><img src="/img/mypage/link07.jpg" width="365" height="60" alt="ファミリー情報"></a>
					</li>
				</ul>
				<!-- ユーザー情報 -->
				<div class="subTab subTab01" style="display: block;">
					<div class="tabInner">
						<div id="profileView" class="mailForm">
							<table cellpadding="0" cellspacing="0" summary="ユーザー情報">
								<colgroup>
									<col width="22%">
									<col width="59%">
								</colgroup>
								<tbody>
									<tr>
										<th>ユーザー名 ：</th>
										<td><?php echo h($customer['User']['name']); ?></td><td rowspan="4">
										<center>
											<?php
												if(!empty($customer['Customer']['pv_file']) && !empty($customer['Customer']['file_name'])){
													$img = '/uploads/customer/list/'. $customer['Customer']['file_name'];
												}else{
													$img = DEFAULT_IMG_CUSTOMER_S;
												}
											?>
											<img src="<?php echo $img; ?>"  height="111" alt="image1">
									</center></td></tr>
									<?php if(!empty($customer['Customer']['pv_name'])): ?>
									<tr>
										<th>名前：</th>
										<td>
										<ul class="nameList">
											<li><?php echo h($customer['Customer']['last_name']); ?></li>
											<li><?php echo h($customer['Customer']['first_name']); ?></li>
									</ul></td></tr>
									<tr>
										<th>ふりがな ：</th>
										<td>
										<ul class="nameList nameList01">
											<li><?php echo h($customer['Customer']['last_kana']); ?></li>
											<li><?php echo h($customer['Customer']['first_kana']); ?></li>
									</ul></td></tr>
									<?php endif; ?>
									<tr>
										<th>続柄 ： </th>
										<td>
										<ul class="list list01 clearfix">
											<li class="liSpecial">
													<?php echo MasterOption::$customerTypes[$customer['Customer']['customer_type']]; ?>
										</li></ul></td><td></td>
									</tr>
									<?php if(!empty($customer['Customer']['pv_address']) && !empty($customer['Customer']['zip'])): ?>
									<tr>
										<th>地域：</th>
										<td>
											<?php if($customer['Customer']['area_id'])
												printf("%s %s %s", h($customer['Prefecture']['name']), h($customer['Municipal']['name']), h($customer['Area']['name']));
											else
												printf("%s %s", h($customer['Prefecture']['name'], h($customer['Municipal']['name'])));?>
											</td><td></td>
									</tr>
									<?php endif; ?>
									<tr>
										<th>URL(ブログなど) ：</th>
										<td>
										<?php echo $this->Html->link(h($customer['Customer']['url']), h($customer['Customer']['url'])); ?>
										</td><td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /subTab subTab01 -->
				<!-- ファミリー情報 -->
				<div class="subTab subTab02" id="subTab" style="display: none;">
					<div class="tabInner">
						<form action="./" method="post" class="mailForm">
							<!-- パートナー・親族 -->
							<div class="innerBox innerBox10">
								<div class="topImg"><img src="/img/mypage/sub_box_top_img01.png" width="716" height="10" alt=""></div>
								<div class="subBox">
									<p class="pTtl">パートナー・親族</p>
									<?php foreach($partners as $n => $customer):  ?>
									<div class="partnerBox">
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
											<colgroup>
												<col width="17%">
												<col width="59%">
											</colgroup>
											<tbody>
												<tr>
													<th>ユーザー名 ：</th>
													<td>
														<?php echo h($customer['User']['name']); ?>
													</td>
												</tr>
												<?php if(!empty($customer['Customer']['pv_name']) &&(!empty($customer['Customer']['last_name']) || !empty($customer['Customer']['first_name']))): ?>
												<tr>
													<th>名前 ：</th>
													<td>
														<?php  printf("%s %s", h($customer['Customer']['last_name']), h($customer['Customer']['first_name'])); ?>
													</td>
												</tr>
												<?php endif; ?>
												<tr>
													<th>続柄 ：</th>
													<td>
														<?php  echo MasterOption::$customerTypes[$customer['Customer']['customer_type']]; ?>
													</td>
												</tr>
									</tbody></table></div></div><!-- /partnerBox -->
									<?php endforeach; ?>
							</div></div><!-- /innerBox innerBox10 -->
							<!-- こども -->
							<div class="innerBox innerBox00">
								<div class="topImg"><img src="/img/mypage/sub_box_top_img02.png" width="716" height="10" alt=""></div>
								<div class="subBox">
									<p class="pTtl">こども</p>
									<?php foreach($children as $child): ?>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="こども">
											<colgroup>
												<col width="17%">
												<col width="50%">
											</colgroup>
											<tbody>
												<tr>
													<th class="thSpecial">名前：</th>
													<td>
														<?php echo h($child['Child']['name']); ?>
													</td>
													<td rowspan="6"> 　 </td>
													<td style="text-align:border-bottom:0px; text-align: center;" rowspan="6">
														<?php
															if(!empty($child['Child']['pv_file']) && !empty($child['Child']['file_name'])){
																$img = '/uploads/customer/list/'. $child['Child']['file_name'];
															}else{
																$img = DEFAULT_IMG_CHILD;
															}
														?>
															<img src="<?php echo $img; ?>" height='111' >
													</td>
												</tr>
												<tr>
													<th class="thSpecial">ふりがな ： </th>
													<td>
													<?php
														if(!empty($child['Child']['pv_kana']) && !empty($child['Child']['kana'])){
															echo h($child['Child']['kana']);
														}
													?>
														</td>
												</tr>
												<tr>
													<th class="thSpecial">性別 ： </th>
													<td>
													<?php
														if(!empty($child['Child']['pv_gender']) && !empty($child['Child']['gender'])){
															echo ($child['Child']['gender'] == '1') ? "男の子" : (($child['Child']['gender'] == '2') ? "女の子" : "");
														}
													?>
													</td>
												</tr>
												<tr>
													<th class="thSpecial">誕生日 ：</th>
													<td>
													<?php
														if(!empty($child['Child']['pv_birthday'])&&!empty($child['Child']['birth'])){
															echo h(date('Y年 m月 d日', strtotime($child['Child']['birth'])));
														}
													?>
													</td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<th class="thSpecial">通園施設：</th>
													<td>
													<?php
														if(!empty($child['Child']['pv_client']) && !empty($child['Child']['client_name'])){
															echo h($child['Child']['client_name']);
														}
													?>
														</td><td></td>
													<td></td>
												</tr>
									</tbody></table></div><!-- /tableBox -->
									<div style='height:10px'></div>
									<?php endforeach; ?>
							</div></div><!-- /innerBox innerBox00 -->
						</form>
					</div><!-- /tabInner -->
				</div><!-- /subTab subTab02 -->
			</div><!-- /subSection -->
		</div><!-- /tabBox -->
	</div><!-- /section -->
</div><!-- /tabSection tabSection1 -->
<div class="pageTop"><a href="#top">トップへ移動する</a></div>