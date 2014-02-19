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
<link href="/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php echo $this->Session->flash('auth');; ?>
<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>ログイン</h1>
		<div class="popInner">
			<p style='font-size:18px; text-align:center;padding:30px 0; color:gray;'>
				ログイン成功しました。
			</p>
			<p style='text-align:center'>
				<img src='/img/loadinfo.net.gif'>
			</p>

			<script>
			//var url = '<?php echo empty($login_redirect)? ($user_type == 1 ? '/owner/' : '/mypage/') : $login_redirect; ?>';
			var url = '<?php echo $login_redirect; ?>';
			setTimeout(function(){
				parent.location.href=url;
			}, 1000);
			</script>
			
		</div>
        
	</div>
</div>
</body>
</html>