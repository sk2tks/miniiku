<!DOCTYPE html>
<html lang="ja">
<?php echo $this->Facebook->html(); ?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="育児,子供,家族,ファミリー">
<meta name="description" content="">
<title>みんなの育児[みん育] 我が家の子育てスタイル</title>
<link rel="stylesheet" href="/sp/css/common.css">
<link rel="stylesheet" href="/sp/css/login.css">
<script src="/sp/js/jquery.js"></script>
<script src="/sp/js/smartphone.js"></script>
</head>
<body>
<?php echo $this->Facebook->init(); ?>
<article id="container" class="comPopup">
	<br />
	<section id="main">
		<h2><img src="/sp/img/login/img_h2_01.gif" width="23" alt=""><span>ログイン</span></h2>
		<!--<form class="loginForm" method="post" action="./">-->
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth');; ?>
		<?php echo $this->Form->create('User', array('action'=>'login','class'=>'mailForm',
			'inputDefaults'=>array(
				'div'=>false, 'label'=>false, 'legend'=>false
			)
		)); ?>
			<dl>
				<dt>メールアドレス</dt>
				<dd>
					<!--<input type="text" value="" name="text01" class="text">-->
					<?php echo $this->Form->input('email', array('autocomplete'=>'on')); ?>
				</dd>
				<dt>パスワード</dt>
				<dd>
					<!--<input type="text" value="" name="text02" class="text">-->
					<?php echo $this->Form->input('password', array('autocomplete'=>'on')); ?>
				</dd>
				<dd class="ddSpecial">
					<label for="fSave">
						<!--<input type="checkbox" value="メールアドレス/パスワードを記憶する" name="save" id="fSave">-->
						<?php echo $this->Form->input('auto_login', array('type'=>'checkbox','id'=>'fSave')); ?>
						メールアドレス/パスワードを記憶する </label>
				</dd>
			</dl>
			<ul class="submit clearfix">
				<li>
					<input type="image" src="/sp/img/login/img_btn01.jpg" value="ログイン" alt="ログイン" name="__submit__" style='width:98%'>
				</li>
				<li>
					<!--<input type="image" src="/sp/img/login/img_link.jpg" value="Facebook ID でログイン" alt="Facebook ID でログイン" name="__submit__" style='width:98%'>-->
					<?php echo $this->Facebook->login(array('custom'=>true, 'img'=>'/img/login/link.jpg', 'redirect'=>'/users/fb_login')); ?>
				</li>
                <!--<li>
					<input type="image" src="/sp/img/login/img_link_fb.jpg" value="Facebookと連携" alt="Facebookと連携" name="__submit__">
				</li>-->
			</ul>
		<!--</form>-->
		<?php echo $this->Form->end(); ?>
		<p class="textP"><a href="/users/reminder">パスワードをお忘れの場合はこちら</a></p>
		<h2 class="h2Ttl"><img src="/sp/img/login/img_h2_02.gif" width="23" alt=""><span>会員登録はこちらから♪</span></h2>
		<!--<form action="" method="post" class="loginForm">-->
		<form action="" method="post" class="mailForm">
			<ul class="submit clearfix">
				<li>
					<!--
					<input type="image" src="/sp/img/login/img_btn02.jpg" value="新規会員登録(無料)はこちら" alt="新規会員登録(無料)はこちら" name="__submit__" style='width:98%'>
					-->
					<img src="/sp/img/login/img_btn02.jpg" value="新規会員登録(無料)はこちら" alt="新規会員登録(無料)はこちら"
							onclick='location.href="/users/regist"' style='width:307px;cursor:pointer;'/>
				</li>
			</ul>
		</form>
	</section>
	<br />
</article>
</body>
</html>