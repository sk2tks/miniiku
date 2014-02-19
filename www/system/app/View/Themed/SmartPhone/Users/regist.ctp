<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="育児,子供,家族,ファミリー">
<meta name="description" content="育児・施設情報サイト「みんなの育児」は、育児についての情報、ファミリー向けイベント情報が満載！みんなの育児を活用して、家族でたくさん共有しよう！">
<title>みんなの育児[みん育] 我が家の子育てスタイル</title>

<link rel="stylesheet" href="/sp/css/common.css">
<link rel="stylesheet" href="/sp/css/member.css">
<link href="/css/system.css" rel="stylesheet" type="text/css" />
<script src="/sp/js/jquery.js"></script>
<script src="/sp/js/smartphone.js"></script>
</head>
<body>
<?php echo $this->Facebook->init(); ?>
<article id="container" class="comPopup">
	<br />
	<section id="main">
		<h2 class="h2Ttl"><img src="/sp/img/login/img_h2_02.gif" width="23" alt=""><span>会員登録</span></h2>
		<!--<form class="memberForm" method="post" action="./">-->
		<?php
			echo $this->Form->create('TempUser', array(
				'class'=>'memberForm', 'inputDefaults'=>array('label'=>false, 'div'=>false)
			));
		?>
			<?php echo $this->Form->hidden('family_id'); ?>
			<?php echo $this->Form->hidden('id'); ?>
			<?php echo $this->Form->hidden('FB_id'); ?>
			<ul class="submit clearfix">
				<li>
					<!--
					<input type="image" src="img/login/img_link.jpg" value="Facebook ID でログイン" alt="Facebook ID でログイン" name="__submit__" style='width:98%'>
					-->
					<div style='text-align:center; padding:10px 20px 20px 0; width:98%; cursor:pointer;'>
						<?php
							echo $this->Facebook->login(array(
								'custom'=>true, 'img'=>'/sp/img/login/img_link_fb.jpg', 'redirect'=>'/users/fb_login'
							));
						?>
					</div>
				</li>
			</ul>
			<dl>
				<dt>ユーザー名（公開）</dt>
				<dd>
					<!--<input type="text" value="" name="user" class="text">-->
					<?php echo $this->Form->input('name'); ?>
				</dd>
				<dt>メールアドレス</dt>
				<dd>
					<!--<input type="text" value="" name="email" class="text">-->
					<?php echo $this->Form->input('email'); ?>
				</dd>
				<dt>パスワード（６文字以上）</dt>
				<dd>
					<!--<input type="password" value="" name="pwd" class="text">-->
					<?php echo $this->Form->input('password', array('type'=>'password')); ?>
				</dd>
				<dt>パスワード（再入力）</dt>
				<dd>
					<!--<input type="password" value="" name="pwd2" class="text">-->
					<?php echo $this->Form->input('password2', array('type'=>'password')); ?>
				</dd>
			</dl>
			<p>
				<label for="fAgree">
					<?php echo $this->Form->input('agree', array('type'=>'checkbox', 'id'=>'rules_chk', 'checked'=>true)); ?>
					<a id='rules' target='_blank' href="/about/rules" style="text-decoration: underline">利用規約</a>に同意する。 </label>
			</p>
			<ul class="radioUl clearfix">
				<p class="check">
					メール受信拒否設定をされている場合、<br>
					【@communitylinks.co.jp】を受信設定<br>
					してから登録してください。
				</p>
			</ul>
			<ul class="submit">
				<li>
					<input type="image" src="/sp/img/member/img_btn01.jpg" value="ログイン" alt="登録" name="__submit__" style='width:98%'>
				</li>
			</ul>
		<!--</form>-->
		<?php $this->Form->end(); ?>
	</section>
	<br />
</article>
</body>
</html>