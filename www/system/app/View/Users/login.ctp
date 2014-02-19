<?php echo $this->Facebook->html(); ?>
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
<link href="/css/system.css" rel="stylesheet" type="text/css" />
<link href="/css/login.css" rel="stylesheet" type="text/css" />
<style>
#authMessage{
	font-size:14px;
	color:#C00;
	text-align:center;
	font-weight:bold;
}
#authMessage:before{
	content:"※"
}
</style>
</head>
<body >
	<?php echo $this->Facebook->init(); ?>

<div class="popBox">
	
	<div class="close"></div>
	<div class="popup">
		<h1>ログイン</h1>
		
		<div class="popInner">
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
						<?php echo $this->Form->input('email', array('autocomplete'=>'on')); ?>
					</dd>
					<dt>パスワード</dt>
					<dd>
						<?php echo $this->Form->input('password', array('autocomplete'=>'on')); ?>
					</dd>
				</dl>
				<div class="check">
					<label for="fSave">
						<?php echo $this->Form->input('auto_login', array('type'=>'checkbox','id'=>'fSave')); ?>
						<!-- <input type="checkbox" value="メールアドレス/パスワードを記憶する " name="save" id="fSave" /> -->
						メールアドレス/パスワードを記憶する </label>
				</div>
				<ul class="submit clearfix">
					<li>
						<input type="image" src="/img/login/btn01.gif" value="ログイン" alt="ログイン"  />
					</li>
                    <li>
                    	<?php echo $this->Facebook->login(array('custom'=>true, 'img'=>'/img/login/link.jpg', 'redirect'=>'/users/fb_login')); ?>
						<!-- <input type="image" src="/img/login/link.jpg" value="Facebook ID でログイン" alt="Facebook ID でログイン" name="__submit__" />		 -->			
					</li>
					
				</ul>
			<?php echo $this->Form->end(); ?>
			<p class="text"><a href="/users/reminder">パスワードをお忘れの場合はこちら</a></p>
			
		</div>
        <div class="popup2">
		<h1>会員登録はこちらから♪</h1>
		<div class="popInner">
				<form action="" method="post" class="mailForm">
				<ul class="submit clearfix">
					<li>
						<img src="/img/login/btn02.gif" value="新規会員登録(無料)はこちら" alt="新規会員登録(無料)はこちら" 
							onclick='location.href="/users/regist"' style='cursor:pointer;'/>
					</li>
				</ul>
                </form>
		</div>
		</div>
	</div>
</div>

</body>
</html>