<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
</head><body>
<article id="container" class="comPopup">
	<br />
	<section id="main">
		<h1>親族登録</h1>
		<div class="popInner">
			<?php echo $this->Form->create('TempUser', array('url'=>'/mypage/users/invite', 'class'=>'mailForm', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
				<p style='text-align:left;'>
				ご家族を招待することで「お気に入り」や「投稿写真」などの情報を共有することができます。<br />
				招待メールの送信先アドレスを入力して「登録」を押してください。
				</p>
				<dl>
					
                    <dt>メールアドレス</dt>
					<dd>
						<?php echo $this->Form->input('email'); ?>
					</dd>
					
				</dl>
				
				<ul class="submit clearfix">
					<li class="floatL">
						<input type="image" src="/img/member/btn01.gif" value="ログイン" alt="登録" name="__submit__"/>
					</li>
					<li class="floatL">
						<input type="image" src="/img/member/btn02.gif" value="会員登録" alt="戻る" name="__submit__" onclick='parent.$.fancybox.close();' />
					</li>
					
				</ul>
			<?php $this->Form->end(); ?>
			
		</div>
	</section>
	<br />
</article>
</body>
</html>