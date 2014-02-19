<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta name="description" content="育児・施設情報サイト「みんなの育児」は、育児についての情報、ファミリー向けイベント情報が満載！みんなの育児を活用して、家族でたくさん共有しよう！" />
<meta name="keywords" content="育児,子供,家族,ファミリー" />
<title>みんなの育児[みん育] 我が家の子育てスタイル</title>

<link href="/common/css/layout.css" rel="stylesheet" type="text/css" />
<link href="/common/css/general.css" rel="stylesheet" type="text/css" />
<link href="/css/member.css" rel="stylesheet" type="text/css" />
<link href="/css/system.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/common/js/jquery-1.8.3.min.js"></script>
</head>
<body>
	<?php echo $this->Facebook->init(); ?>
<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>会員登録</h1>
		<div class="popInner">
			<?php echo $this->Form->create('TempUser', array('class'=>'mailForm', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
				<?php echo $this->Form->hidden('family_id'); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->hidden('FB_id'); ?>
				<div style='text-align:center; padding:10px 20px 20px 0;'><?php echo $this->Facebook->login(array('custom'=>true, 'img'=>'/img/login/link_fb.jpg', 'redirect'=>'/users/fb_login')); ?></div>
				<dl>
					<dt>ユーザー名（公開）</dt>
					<dd>
						<?php echo $this->Form->input('name'); ?>
						<!-- <input type="text" value="" name="user" /> -->
					</dd>
                    <dt>メールアドレス</dt>
					<dd>
						<?php echo $this->Form->input('email'); ?>
						<!-- <input type="text" value="" name="email" /> -->
					</dd>
					<dt>パスワード（６文字以上）</dt>
					<dd>
						<?php echo $this->Form->input('password', array('type'=>'password')); ?>
						<!-- <input type="text" value="" name="pwd" /> -->
					</dd>

					<dt>パスワード（再入力）</dt>
					<dd>
						<?php echo $this->Form->input('password2', array('type'=>'password')); ?>
						<!-- <input type="text" value="" name="pwd2" /> -->
					</dd>
				</dl>
				<div class="check">
					<label for="fAgree">
						<?php echo $this->Form->input('agree', array('type'=>'checkbox', 'id'=>'rules_chk', 'checked'=>true)); ?>
						<!-- <input type="checkbox" value="利用規約に同意する " name="save" id="fAgree"> -->
						<a id='rules' target='_blank' href="/about/rules" style="text-decoration: underline">利用規約</a>に同意する。 </label>
				</div>
				<br />
				<div class="check">
					メール受信拒否設定をされている場合、<br />
【@communitylinks.co.jp】を受信設定してから登録してください。
				</div>
				<ul class="submit clearfix">
					<li>
						<input type="image" src="/img/member/btn01.gif" value="ログイン" alt="登録" name="__submit__" />
					</li>
					<li class="floatR">
						<input type="image" src="/img/member/btn02.gif" value="会員登録" alt="戻る" name="__submit__" onclick='parent.$.fancybox.close();'/>
					</li>

				</ul>
			<?php $this->Form->end(); ?>

		</div>
	</div>
</div>
</body>
<script>
$(function(){
	$("#rules").click(function(){
		$("#rules_chk").attr('checked', 'checked');
	})
})
</script>
</html>