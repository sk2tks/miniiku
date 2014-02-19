<?php $user_info = $this->Session->read('user_info'); ?>
<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline' => false)); ?>
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

function onProfileUpdateSuccess() {
	window.location = '/mypage/';
	location.reload();
}

function onFamilyUpdateSuccess() {
	window.location = '/mypage/#family';
	location.reload();
}

function editProfile(){
	//console.log('sp mypage_profile.ctp editProfile called.');
	var data = $('#profileForm').serialize();
	//$('#profileArea').hide();
	$.ajax({
		type: 'POST',
		url:'/mypage/customers/profile',
		data: data,
		cache: false,
		success:function(data){
			$('#profileArea').html(data);
			//$('#profileArea').fadeIn('slow');
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
			//$('#familyArea').fadeIn('slow');
		}
	});
}
</script>

<!-- #EndLibraryItem -->
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><a href="#">ログイン</a>&gt;</li>
	<li>マイページ</li>
</ul>
<section id="main">
	<h2><img src="/sp/img/maypage/img_h2_01.png" alt="" width="21"><span>マイページ</span></h2>
	<ul class="dateTxt clearfix">
		<li><span>最終ログイン日</span><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
		<li><span>更新日</span><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['Customer']['modified'])); ?></span></li>
	</ul>
	<h3>ユーザー名：<span><?php printf("%s　さん", $user_info['User']['name']); ?></span></h3>
	<ul class="comTab clearfix">
		<li class="tab01"><a href="#"><img src="/sp/img/common/img_tab_01_out.gif" alt="プロフィール" width="100%"></a></li>
		<li class="tab02"><a href="#"><img src="/sp/img/common/img_tab_02_out.gif" alt="お気に入り" width="100%"></a></li>
		<li class="tab03"><a href="#"><img src="/sp/img/common/img_tab_03_out.gif" alt="コメント履歴" width="100%"></a></li>
		<li class="tab04"><a href="#"><img src="/sp/img/common/img_tab_04_out.gif" alt="アンケート" width="100%"></a></li>
	</ul>
	<div class="tabBox tabBox01">
		<ul class="subTab clearfix">
			<li><a href="#"><img src="/sp/img/common/img_tab_05_out.gif" alt="ユーザー情報" width="100%"></a></li>
			<li><a href="#"><img src="/sp/img/common/img_tab_06_out.gif" alt="ファミリー情報" width="100%"></a></li>
		</ul>
		<div id='profileArea' class="subTabBox subTabBox01">
        	<?php echo $this->requestAction('/mypage/customers/profile', array('return')); ?>
		</div>
		<div id='familyArea' class="subTabBox subTabBox02">
			<?php echo $this->requestAction('/mypage/families/profile', array('return')); ?>
		</div>
	</div>
	<div class="tabBox tabBox02">
		<ul class="subTab clearfix">
			<li><a href="#"><img src="/sp/img/common/img_tab_15.gif" alt="我が家のお気に入り" width="100%"></a></li>
			<li><a href="#"><img src="/sp/img/common/img_tab_16.gif" alt="育児情報クリップ" width="100%"></a></li>
		</ul>
		<div class="subTabBox subTabBox01">
			<div class="formBox clearfix">
				<dl class="clearfix">
					<dt>表示：</dt>
					<dd>
						<!--
						<select name="type">
							<option value="カテゴリ">カテゴリ</option>
						</select>
						-->
						<?php
							echo $this->Form->input('categories', array(
								'onchange'=>'likeSearch();','id'=>'likeSelect',
								'options'=>$categories, 'label'=>false, 'div'=>false,
								'empty'=>'選択してください'
							));
						?>
					</dd>
				</dl>
				<p>
					<input type="text" name="keyword" class="fKeyword" placeholder="キーワード" id='likeKeyword'>
					<input type="image" alt="" value="" src="/sp/img/maypage/btn_09.gif" name="search" class="fSearch" onclick='likeSearch();'>
				</p>
			</div>
			<div id="familyLikeArea">
				<?php echo $this->requestAction('/mypage/families/like', array('return')); ?>
			</div>
		</div>
		<div class="subTabBox subTabBox02">
			<div class="formBox clearfix">
				<div class="link"><a href="javascript:addClip();"><img src="/sp/img/maypage/btn_10.jpg" alt="クリップを追加" width="100%"></a></div>
				<p>
					<input type="text" name="keyword" class="fKeyword" placeholder="キーワード" id='clipKeyword'>
					<input type="image" alt="" value="" src="/sp/img/maypage/btn_09.gif" name="search" class="fSearch" onclick='clipSearch();'>
				</p>
			</div>
			<div id="familyClipArea">
				<?php echo $this->requestAction('/mypage/families/clip', array('return')); ?>
			</div>
		</div>
	</div>
	<div class="tabBox tabBox03">
		<div class="formBox clearfix">
			<dl class="clearfix">
				<dt>表示：</dt>
				<dd>
					<?php
						echo $this->Form->input('categories',array(
							'onchange'=>'commentSearch()','id'=>'commentSelect',
							'options'=>$categories, 'label'=>false, 'div'=>false,
							'empty'=>'選択してください'
						));
					?>
				</dd>
			</dl>
			<p>
				<input type="text" placeholder="絞り込みキーワード" name="keyword" id='commentKeyword'>
				<input type="image" name="__submit__" src="/sp/img/maypage/btn_09.gif" onclick='commentSearch();'>
			</p>
		</div>
		<div id='familyCommentArea'>
			<?php echo $this->requestAction('/mypage/families/comment', array('return')); ?>
		</div>
	</div>
	<div class="tabBox tabBox04">
		<p>現在アンケートはありません。</p>
	</div>
</section>

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
	//console.log('addClip called');
	$.fancybox({
		type: 'iframe',
		href: "/mypage/families/new_clip",
		padding: 0,
		width: '548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {closeClick : true}
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
</script>
