<?php $user_info = $this->Session->read('user_info'); ?>
<?php echo $this->Html->css(array('mypage'), null, array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.cookie.js', array('inline' => false)); ?>
<?php echo $this->Html->script('system', array('inline' => false)); ?>
<?php echo $this->Html->script('/common/js/common.js', array('inline' => false)); ?>

<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline' => false)); ?>
<?php echo $this->Html->script("/js/jquery.upload-1.0.2.min.js", array('inline'=>false)); ?>
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
	if(str.indexOf('#family')!=-1){
		$('li.tab01').removeClass('on');
		$('.subTab01').hide();
		$('li.tab02').addClass('on');
		$('.subTab02').show();
	}
	if(str.indexOf('#profileEdit')!=-1){
		showProfileEdit();
	}

	$('.subSection .subLink li a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings().removeClass('on');
		$(this).parent().parent().parent().find('.subTab').hide();
		$(this).parent().parent().parent().find('.subTab:eq('+ind+')').show();
		return false;
	});

});

function showProfileEdit(){
	$('#profileView').hide();
	$('#profileArea').show();
}

function showFamilyEdit(){
	$('#familyView').hide();
	$('#familyArea').show();
}

function onProfileUpdateSuccess() {
	window.location = '/mypage/';
	location.reload();
}

function onFamilyUpdateSuccess() {
	window.location = '/mypage/#family';
	location.reload();
}

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
		}
	});
}
<?php echo $this->Html->scriptEnd(); ?>

<style>
.fancybox-margin {
	margin-right: 0px;
}
.tabInner {
	//min-height: 600px;
}
#conts .section .dateUl .liSpecial01 {
	width: 160px;
}
.css_btn_class {
	font-size:9pt;
	font-family:Arial;
	font-weight:bolder;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	padding:2px 12px;
	text-decoration:none;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #f9f9f9), color-stop(100%, #e9e9e9) );
	background:-moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
	background:-ms-linear-gradient( top, #f9f9f9 5%, #e9e9e9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
	background-color:#f9f9f9;
	color:#666666;
	display:inline-block;
	text-shadow:1px 1px 0px #ffffff;
 	-webkit-box-shadow:inset 1px 1px 0px 0px #ffffff;
 	-moz-box-shadow:inset 1px 1px 0px 0px #ffffff;
 	box-shadow:inset 1px 1px 0px 0px #ffffff;
 	cursor:pointer;
}.css_btn_class:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(5%, #e9e9e9), color-stop(100%, #f9f9f9) );
	background:-moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
	background:-ms-linear-gradient( top, #e9e9e9 5%, #f9f9f9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9');
	background-color:#e9e9e9;
}.css_btn_class:active {
	position:relative;
	top:1px;
}
.file {
display: inline-block;
  overflow: hidden;
  position: relative;
  margin-right:10px;
  cursor:pointer;
}
.file input[type="file"] {
  opacity: 0;
  filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  position: absolute;
  right: 0;
  top: 0;
  margin: 0;
  font-size: 100px;
  cursor: pointer;
}

#conts .subTab01 .mailForm td .list li input[type=radio]{
	margin-right:5px;
}
.mailForm select{
	margin-right:5px;
}

</style>
<!-- マイページ -->
<h2>マイページ</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><a href="#">ログイン</a>&gt;</li>
	<li>マイページ</li>
</ul>
<div class="ttl"><p>ユーザー名 ： <span><?php printf("%s　さん", $user_info['User']['name']); ?></span></p></div>
<div class="tabSection tabSection1">
	<ul class="linkUl clearfix">
		<li class="tab01 on"><a href="#"><img src="/img/mypage/link02.jpg" width="190" height="63" alt="プロフィール"></a></li>
		<li class="tab02"><a href="#"><img src="/img/mypage/link03.jpg" width="188" height="63" alt="お気に入り"></a></li>
		<li class="tab03"><a href="#"><img src="/img/mypage/link04.jpg" width="188" height="63" alt="コメント履歴"></a></li>
		<li class="tab04"><a href="#"><img src="/img/mypage/link05.jpg" width="189" height="63" alt="アンケート"></a></li>
	</ul>
	<!-- プロフィール -->
	<div class="section">
		<div class="tabBox" style="display: block;">
			<div class="dateUl clearfix">
				<ul>
					<li>最終ログイン日 ：</li>
					<li class="liSpecial01"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
					<li class="liSpecial02">更新日 ：</li>
					<li class="liSpecial03"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['Customer']['modified'])); ?></span></li>
				</ul>
			</div>
			<div class="subSection">
				<ul class="subLink clearfix">
					<li class="tab01 on"><a href="#"><img src="/img/mypage/link06.jpg" width="363" height="60" alt="ユーザー情報"></a></li>
					<li class="tab02"><a href="#"><img src="/img/mypage/link07.jpg" width="364" height="60" alt="ファミリー情報"></a></li>
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
									<tr>
										<th>地域：</th>
										<td>
											<?php if($customer['Customer']['area_id'])
												printf("%s %s %s", h($customer['Prefecture']['name']), h($customer['Municipal']['name']), h($customer['Area']['name']));
											else
												printf("%s %s", h($customer['Prefecture']['name'], h($customer['Municipal']['name'])));?>
											</td><td></td>
									</tr>

									<?php if(!empty($customer['Customer']['pv_url']) && !empty($customer['Customer']['url'])): ?>
									<tr>
										<th>URL(ブログなど) ：</th>
										<td>
										<?php echo $this->Html->link(h($customer['Customer']['url']), h($customer['Customer']['url'])); ?>
										</td><td></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<br />
							<table><tbody>
								<tr>
									<td style="border-bottom:0px"><a href="/mypage/users/invite" class='fancybox fancybox.iframe'><img src="/img/mypage/link10.jpg" width="222" height="33" alt="パートナー・親族を招待"></a></td>
									<td class="link" style="text-align:right; border-bottom:0px" onclick="showProfileEdit()"><a href="#"><img src="/img/mypage/link01.jpg" width="121" height="33" alt="設 定"></a></td>
								</tr>
							</tbody></table>
						</div><!-- /profileView -->
						<div id='profileArea' style='position:realative; display:none'>
							<?php echo $this->requestAction('/mypage/customers/profile', array('return')); ?>
						</div>
					</div><!-- /tabInner -->
				</div><!-- /subTab subTab01 -->
				<!-- ファミリー情報 -->
				<div class="subTab subTab02" id='subTab' style="display: none;">
					<div class="tabInner">
						<div id="familyView" class="mailForm">
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
												<tr>
													<th>名前 ：</th>
													<td>
														<?php  printf("%s %s", h($customer['Customer']['last_name']), h($customer['Customer']['first_name'])); ?>
													</td>
												</tr>
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
							<div class="link" style="text-align:right" onclick="showFamilyEdit()"><a href="#"><img src="/img/mypage/link01.jpg" width="121" height="33" alt="設 定"></a></div>
						</div><!-- /familyView -->
						<div id='familyArea' style="display:none">
							<?php echo $this->requestAction('/mypage/families/profile', array('return')); ?>
						</div> <!-- /familyArea -->
					</div><!-- /tabInner -->
				</div><!-- /subTab subTab02 -->
			</div><!-- /subSection -->
		</div><!-- /tabBox -->
	</div><!-- /section -->
	<div class="tabBox tabBox02" style="display: block;">
		<div class="dateUl clearfix">
			<ul>
				<li>最終ログイン日 ：</li>
				<li class="liSpecial01"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
				<li class="liSpecial02">更新日 ：</li>
				<li class="liSpecial03"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['Customer']['modified'])); ?></span></li>
			</ul>
		</div>
		<div class="subSection">
			<ul class="subLink clearfix">
				<li class="tab01 on"><a href="#"><img src="../img/mypage/link14.jpg" width="363" height="60" alt="我が家のお気に入り"></a></li>
				<li class="tab02"><a href="#"><img src="../img/mypage/link15.jpg" width="365" height="60" alt="育児情報クリップ"></a></li>
			</ul>
<!-- 我が家のお気に入り -->
			<div class="subTab subTab01" style="display: block;">
				<div class="tabInner">
					<div class="comSubBox" >
						<div class="formBox clearfix">
						<dl class="formDl clearfix">
							<dt>表示：</dt>
							<dd>
								<?php echo $this->Form->input('categories', array('onchange'=>'likeSearch();','id'=>'likeSelect', 'options'=>$categories, 'label'=>false, 'div'=>false, 'empty'=>'カテゴリ')); ?>

							</dd>
						</dl>
						<dl class="formDl formDlR clearfix">
							<dt>絞り込み：</dt>
							<dd>
								<input type="text" name="keyword" class="fKeyword" placeholder="キーワード" id='likeKeyword'>
								<input type="image" alt="" value="" src="/img/search/img_search.gif" name="search" class="fSearch" onclick='likeSearch();'>
							</dd>
						</dl>
					</div>
					<div id='familyLikeArea'>
						<?php echo $this->requestAction('/mypage/families/like', array('return')); ?>
					</div>
					</div><!-- /FamilyLikeArea -->
				</div>
			</div>
<!-- 育児情報クリップ -->
			<div class="subTab subTab02" style="display: none;">
				<div class="tabInner">
					<div class="comSubBox" >
						<div class="formBox clearfix">
							<ul class="clearfix">
								<li><a href="javascript:addClip();"><img src="/img/mypage/link16.jpg" width="159" height="37" alt="クリップを追加"></a></li>
							</ul>
							<dl class="formDl formDlR clearfix">
								<dt>絞り込み：</dt>
								<dd>
									<input type="text" name="keyword" class="fKeyword" placeholder="キーワード" id='clipKeyword'>
									<input type="image" alt="" value="" src="/img/search/img_search.gif" name="search" class="fSearch" onclick='clipSearch();'>
								</dd>
							</dl>
						</div>
						<div id='familyClipArea'>
						<?php echo $this->requestAction('/mypage/families/clip', array('return')); ?>
						</div>
					</div><!-- /familyClip -->
				</div>
			</div>
		</div>
	</div>
	<div class="tabBox" style="display: block;">
		<div class="dateUl clearfix">
			<ul>
				<li>最終ログイン日 ：</li>
				<li class="liSpecial01"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
				<li class="liSpecial02">更新日 ：</li>
				<li class="liSpecial03"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['Customer']['modified'])); ?></span></li>
			</ul>
		</div>
<!-- コメント履歴 -->
		<div class="comSubBox">
			<div class="formBox clearfix">
				<dl class="formDl clearfix">
					<dt>表示：</dt>
					<dd>
						<?php echo $this->Form->input('categories',array('onchange'=>'commentSearch()','id'=>'commentSelect', 'options'=>$categories, 'label'=>false, 'div'=>false, 'empty'=>'選択してください')); ?>
					</dd>
				</dl>
				<dl class="formDl formDlR clearfix">
					<dt>絞り込み：</dt>
					<dd>
						<input type="text" name="keyword" class="fKeyword" placeholder="キーワード", id='commentKeyword'>
						<input type="image" alt="" value="" src="../img/search/img_search.gif" name="search" class="fSearch" onclick='commentSearch();'>
					</dd>
				</dl>
			</div>
			<div id='familyCommentArea'>
				<?php echo $this->requestAction('/mypage/families/comment', array('return')); ?>
			</div><!-- /commentArea -->
		</div>
	</div>
	<div class="tabBox" style="display: block;">
		<div class="tabPhotos">
			<div class="dateUl clearfix">
				<ul>
				<li>最終ログイン日 ：</li>
				<li class="liSpecial01"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
				<li class="liSpecial02">更新日 ：</li>
				<li class="liSpecial03"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['Customer']['modified'])); ?></span></li>
			</ul>
			</div>
			<p style='text-align:center; font-size:1.5em; padding:20px;'>準備中です</p>
			<?php /*
			<p class="pSize">サイトのTOPページに表示するお子さまの写真の投稿を募集中です。</p>
			<p class="pTitle">写真投稿</p>

			<?php echo $this->Form->create("Photo", array('type'=>'post')); ?>
			<table cellpadding="0" cellspacing="0" summary="写真投稿">
				<colgroup><col width="9%">
				<col width="39%">
				<col width="52%">
				</colgroup><tbody>
					<tr>
						<th>写真：</th>
						<td><div class="fileImg">
								<input type="file" value="" name="file" id='uploadPhoto'>
							</div>
							<span class="tdSpan">横200px×縦190px</span></td>
						<td rowspan="2"><div class="tabInner clearfix">
								<div class="fileImg">
									<span><a href="#"><img width="26" height="23" alt="削除" src="/img/mypage/link12.png"></a></span></div>
								<div class="textBox">
									<div class="topImg"><img src="/img/mypage/top_img.gif" width="251" height="10" alt=""></div>
									<p>投稿いただいたお写真は投稿日から3か月間、ランダムにTOPページに表示させていただきます。</p>
									<div class="btmImg"><img src="/img/mypage/btm_img.gif" width="251" height="10" alt=""></div>
								</div>
							</div></td>
					</tr>
					<tr>
						<th>コメント：</th>
						<td><textarea class="fContent" name="content" cols="5" rows="5"></textarea>
							<span>24字以内に記入してください。</span>
							<input onclick='updatePhotoList(); return false;' type="image" name="contribution" src="/img/mypage/btn03.gif" value="" alt="投稿"></td>
					</tr>
				</tbody>
			</table>
			<?php echo $this->Form->end(); ?>
			<p class="pTitle">過去の投稿画像</p>
			<div id='familyPhotoArea'>
				<?php echo $this->requestAction('/mypage/photo/list', array('return')); ?>
			</div>
			 */?>
		</div>
	</div>
</div>
<div class="pageTop"><a href="#top">トップへ移動する</a></div>
<script>
/************************************************
 * クリップ
 ************************************************/
function clipSearch(){
	var kw = $("#clipKeyword").val();
	var url = '/mypage/families/clip?kw=' + kw;
	updateClip(url);
}
function addClip(){
	$.fancybox({
		type: 'iframe',
		href: "/mypage/families/new_clip",
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
function updateClip(url){
	if(url == undefined){
		url = '/mypage/families/clip';
	}
	$.ajax({
		url:url,
		cache:false,
		type:'get',
		success:function(data){
			$('#familyClipArea').html(data)
		}
	})
}
/************************************************
 * お気に入り
 ************************************************/
function likeSearch(){
	var kw = $("#likeKeyword").val();
	var c = $("#likeSelect").val();
	var url = '/mypage/families/like?kw=' + kw + '&c=' + c;
	updateLike(url);
}

function updateLike(url){
	if(url == undefined){
		url = '/mypage/families/like';
	}
	$.ajax({
		url:url,
		cache:false,
		type:'get',
		success:function(data){
			$('#familyLikeArea').html(data)
		}
	})
}

/************************************************
 * コメント履歴
 ************************************************/

function commentSearch(){
	var kw = $("#commentKeyword").val();
	var c = $("#commentSelect").val();
	var url = '/mypage/families/comment?kw=' + kw + '&c=' + c;
	updateComment(url);
}
function updateComment(url){
	if(url == undefined){
		url = '/mypage/families/comment';
	}
	$.ajax({
		url:url,
		cache:false,
		type:'get',
		success:function(data){
			$('#familyCommentArea').html(data)
		}
	})
}

/************************************************
 * 施設を評価
 ************************************************/
function evaluateClient(elem){
	var clientId = $(elem).parents('tr').find('input.clientId').val();

	$.fancybox.open({
		href: "/clients/evaluate/" + clientId,
		padding: 0,
		width: '548px',
		type: 'iframe',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {
						closeClick : false
						}
					}
	});

	//window.open('/clients/view/' + clientId, 'clientVote');
}
function checkClientVote(clientId, callback){

	$.ajax({
		url:'/mypage/api/check_client_vote/' + clientId,
		cache:false,
		type:'get',
		success:function(data){
			callback(data);
			return;
			// if(data == '1'){
				// alert('評価済み');
			// }else{
				// alert('未評価');
			// }
		}
	})
}

function hideClientEvalButton(id){
	$("input.clientId").each(function(){
		if($(this).val() == id){
			var $message = $("<span style='color:#c00'>※施設を評価しました</span>");
			$(this).nextAll('a:first').hide().after($message);
			setTimeout(function(){$message.fadeOut('slow');}, 5000);


		}
	})
}

/************************************************
 * 投稿写真
 ************************************************/
$(function(){

	$("#uploadPhoto").change(function(){

		$(this).upload(
			'/mypage/photo/upload',
			function(data){
				alert(data);
			}
		)
	})
})
function updatePhotoList(url){
	if(url == undefined){
		url = '/mypage/photo/list';
	}
	$.ajax({
		url:url,
		cache:false,
		type:'get',
		success:function(data){
			$('#familyPhotoArea').html(data)
		}
	})
}
</script>

