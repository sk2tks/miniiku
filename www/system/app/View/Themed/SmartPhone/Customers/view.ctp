<?php $user_info = $this->Session->read('user_info'); ?>
<?php echo $this->Html->css('/sp/css/mypage.css', null, array('inline'=>false)); ?>
<style>
.span01 {
	background: url(../../img/index/img_01.gif) no-repeat left 1px;
}

.span02 {
	background: url(../../img/index/img_02.gif) no-repeat left 1px;
}

.span03 {
	background: url(../../img/index/img_03.gif) no-repeat left 1px;
}
<!--
.span04 {
	background: url(../../img/index/img_04.gif) no-repeat left 1px;
}

.span05 {
	background: url(../../img/index/img_05.gif) no-repeat left 1px;
}

.span06 {
	background: url(../../img/index/img_06.gif) no-repeat left 1px;
}
-->
.span07 {
	background: url(../../img/index/img_07.gif) no-repeat left 1px;
}

.span08 {
	background: url(../../img/index/img_08.gif) no-repeat left 1px;
}

.span09 {
	background: url(../../img/index/img_09.gif) no-repeat left 1px;
}

.span10 {
	background: url(../../img/index/img_10.gif) no-repeat left 1px;
}

.span101 {
	background: url(../../img/index/img_101.gif) no-repeat left 1px;
}

.span102 {
	background: url(../../img/index/img_102.gif) no-repeat left 1px;
}

.span103 {
	background: url(../../img/index/img_103.gif) no-repeat left 1px;
}

.span104 {
	background: url(../../img/index/img_104.gif) no-repeat left 1px;
}

.span105 {
	background: url(../../img/index/img_105.gif) no-repeat left 1px;
}

.comList {
	clear: both;
	font-size: 1.3em;
	margin-right: 5px;
	text-align: right;
	font-family: Meiryo, "メイリオ", "Hiragino Kaku Gothic Pro", "ヒラギノ角ゴ Pro W3", sans-serif;
	font-size: 1em;
}
.comList li {
	display:inline;
}
.on {
	font-weight:bold;
}

.fancybox-iframe {
	overflow:hidden;
}
</style>
<script>
$(function(){
	$('#main .tabBox:eq(0)').show().siblings('#main .tabBox').hide();

	$('#main .comTab a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings('li').removeClass('on');
		$('#main .tabBox:eq('+ind+')').show().siblings('.tabBox').hide();
		return false;
	});

	$('#main .tabBox01 .subTabBox:eq(0)').show().siblings('#main .tabBox01 .subTabBox').hide();
	$('#main .tabBox01 .subTab a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings('li').removeClass('on');
		$('#main .tabBox01 .subTabBox:eq('+ind+')').show().siblings('#main .tabBox01 .subTabBox').hide();
		return false;
	});

	$('#main .tabBox02 .subTabBox:eq(0)').show().siblings('#main .tabBox02 .subTabBox').hide();
	$('#main .tabBox02 .subTab a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings('li').removeClass('on');
		$('#main .tabBox02 .subTabBox:eq('+ind+')').show().siblings('#main .tabBox02 .subTabBox').hide();
		return false;
	});

	$('#main .subTabBox').hide();
	$('#main .tabBox01 .subTabBox').eq(0).show();
	$('#main .tabBox02 .subTabBox').eq(0).show();
	var str=window.location;
	str+='';
	if(str.indexOf('tab=')!=-1){
		var p=str.slice(str.indexOf('tab='));
		p=p.slice(4);
		$('#main .comTab li').addClass('on').siblings('li').removeClass('on');
		$('#main .tabBox:eq('+p+')').show().siblings('.tabBox').hide();
		return false;
	}
});

$(function(){
	$('#main .fancybox').fancybox({
		width: '90%',//290,
		padding: 0,
		fitToView: false,
        autoSize:true,
        autoScale:true
	});
});

</script>

<!-- #EndLibraryItem -->
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li>ユーザー情報ページ</li>
</ul>
<section id="main">
	<h3>ユーザー名：<span><?php printf("%s　さん", h($customer['User']['name'])); ?></span></h3>
	<div class="tabBox tabBox01">
		<ul class="subTab clearfix">
			<li><a href="#"><img src="/sp/img/common/img_tab_05_out.gif" alt="ユーザー情報" width="100%"></a></li>
			<li><a href="#"><img src="/sp/img/common/img_tab_06_out.gif" alt="ファミリー情報" width="100%"></a></li>
		</ul>
		<div id='profileArea' class="subTabBox subTabBox01">
			<table cellpadding="0" cellspacing="0" summary="ユーザー情報" class="comTable">
				<col width="75%">
				<col width="25%">
				<tbody>
					<tr>
						<th colspan="2">ユーザー名 ：</th>
					</tr>
					<tr>
						<td>
							<?php echo h($customer['User']['name']); ?>
						</td>
						<td>
							<?php
								if(!empty($customer['Customer']['pv_file']) && !empty($customer['Customer']['file_name'])){
									$img = '/uploads/customer/list/'. $customer['Customer']['file_name'];
								}else{
									$img = DEFAULT_IMG_CUSTOMER_S;
								}
							?>
							<img src="<?php echo $img; ?>"  height="111" alt="image1">
						</td>
					</tr>
					<?php if(!empty($customer['Customer']['pv_name'])): ?>
					<tr>
						<th colspan="2">名前</th>
					</tr>
					<tr>
						<td>
							<?php echo h($customer['Customer']['last_name']); ?>
							<?php echo h($customer['Customer']['first_name']); ?>
						</td>
					</tr>
					<tr>
						<th colspan="2">ふりがな</th>
					</tr>
						<td>
							<?php echo h($customer['Customer']['last_kana']); ?>
							<?php echo h($customer['Customer']['first_kana']); ?>
						</td>
					<tr>
					</tr>
					<?php endif; ?>
					<?php if(!empty($customer['Customer']['pv_gender'])): ?>
					<tr>
						<th colspan="2">性別・続柄</th>
					</tr>
					<tr>
						<td>
							<?php if(!empty($customer['Customer']['gender'])) echo MasterOption::$gender[$customer['Customer']['gender']]; ?>
							<?php if(!empty($customer['Customer']['customer_type'])): ?>
								<?php echo MasterOption::$customerTypes[$customer['Customer']['customer_type']]; ?>
							<?php endif; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if(!empty($customer['Customer']['pv_birthday'])): ?>
					<tr>
						<th colspan="2">誕生日</th>
					</tr>
					<tr>
						<td>
							<?php echo date('Y 年 m 月 d 日', strtotime($customer['Customer']['birth'])); ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if(!empty($customer['Customer']['pv_address']) && !empty($customer['Customer']['zip'])): ?>
					<tr>
						<th colspan="2">郵便番号</th>
					</tr>
					<tr>
						<td><?php printf("%s-%s", $customer['Customer']['zip1'], $customer['Customer']['zip2']); ?></td>
					</tr>
					<tr>
						<th colspan="2">住所(市区町村)</th>
					</tr>
					<tr>
						<td>
							<?php printf("%s %s", h($customer['Customer']['address']), h($customer['Customer']['sub_address'])); ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if(!empty($customer['Customer']['pv_url']) && !empty($customer['Customer']['url'])): ?>
					<tr>
						<th colspan="2">URL(ブログなど)</th>
					</tr>
					<tr>
						<td>
							<?php echo $this->Html->link(h($customer['Customer']['url']), h($customer['Customer']['url'])); ?>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div id='familyArea' class="subTabBox subTabBox02">
			<div class="title01">パートナー・親族</div>
			<table cellpadding="0" cellspacing="0" summary="パートナー・親族" class="comTable parentTable">
				<col width="100%">
				<tbody>
					<?php //pr($partners); ?>
					<?php foreach($partners as $n => $customer):  ?>
					<tr>
						<th>ユーザー名</th>
					</tr>
					<tr>
						<td>
							<!--<input type="text" class="inputTxt01"name="url" value="">-->
							<?php echo h($customer['User']['name']); ?>
						</td>
					</tr>
					<tr>
						<th>名前</th>
					</tr>
					<tr>
						<td>
							<!--<input type="text" class="inputTxt01"name="url" value="">-->
							<?php
								printf("%s %s", h(
									$customer['Customer']['last_name']), h($customer['Customer']['first_name']
								));
							?>
						</td>
					</tr>
					<tr>
						<th>続柄</th>
					</tr>
					<tr>
						<td>
							<!--<input type="text" class="inputTxt01"name="url" value="">-->
							<?php
								if(!empty($customer['Customer']['customer_type']))
									echo MasterOption::$customerTypes[$customer['Customer']['customer_type']];
							?>
						</td>
					</tr>
					<tr>
						<th>写真</th>
					</tr>
					<tr>
						<td><div class="inner clearfix">
								<div class="photo">
									<!--<img src="/sp/img/maypage/img_02.jpg" alt="" width="73">-->
									<?php
										if(!empty($customer['Customer']['file_name'])){
											$image = CUSTOMER_DIR .'list/'.$customer['Customer']['file_name'];
										}else{
											$image = DEFAULT_IMG_CUSTOMER_L;
										}
									?>
									<img src="<?php echo $image; ?>" width="73"  alt=""> </div>
								</div>
							</div></td>
					</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
			<br /><br />

			<div class="title02">こども</div>

			<div id='childBox'>

				<?php if(!empty($children)): ?>
				<?php foreach($children as $child): ?>

				<table cellpadding="0" cellspacing="0" summary="こども" class="comTable childTable" style="margin-bottom:20px;border-bottom: 2px solid #ADE47A;">
					<col width="76%">
					<col width="24%">
					<tbody class="tableBox" data-num="<?php echo $children; ?>">
						<?php if(!empty($child['Child']['pv_name']) && !empty($child['Child']['name'])): ?>
						<tr>
							<th colspan="2">名前</th>
						</tr>
						<tr>
							<td>
								<?php echo h($child['Child']['name']); ?>
							</td>
							<td>
								<?php
									if(!empty($child['Child']['pv_file']) && !empty($child['Child']['file_name'])){
										$img = '/uploads/customer/list/'. $child['Child']['file_name'];
									}else{
										$img = DEFAULT_IMG_CHILD;
									}
								?>
								<img src="<?php echo $img; ?>" height='111' />
							</td>
						</tr>
						<?php endif; ?>
						<?php if(!empty($child['Child']['pv_kana']) && !empty($child['Child']['kana'])): ?>
						<tr>
							<th colspan="2">ふりがな</th>
						</tr>
						<tr>
							<td>
								<?php echo h($child['Child']['kana']); ?>
							</td>
						</tr>
						<?php endif; ?>
						<?php if(!empty($child['Child']['pv_gender']) && !empty($child['Child']['gender'])): ?>
						<tr>
							<th colspan="2">性別</th>
						</tr>
						<tr>
							<td>
								<?php echo ($child['Child']['gender'] == '1') ? "男の子" : (($child['Child']['gender'] == '2') ? "女の子" : ""); ?>
							</td>
						</tr>
						<?php endif; ?>
						<?php if(!empty($child['Child']['pv_birthday'])&&!empty($child['Child']['birth'])) : ?>
						<tr>
							<th colspan="2">誕生日</th>
						</tr>
						<tr>
							<td>
								<?php echo h(date('Y年 m月 d日', strtotime($child['Child']['birth']))); ?>
							</td>
						</tr>
						<?php endif; ?>
						<?php if(!empty($child['Child']['pv_client']) && !empty($child['Child']['client_name'])): ?>
						<tr>
							<th colspan="2">通園施設</th>
						</tr>
						<tr>
							<td>
								<?php echo h($child['Child']['client_name']); ?>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

