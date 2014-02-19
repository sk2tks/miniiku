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
<?php echo $this->Html->css('system',null, array('inline'=>true)); ?>

</head>
<body>
<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>パスワードをお忘れの方へ</h1>
		<p style='text-align:left;'>パスワードの再設定を行います。</p>
		<p style='color:#C00; text-align:left; margin-bottom:15px;'>※メールが届いてから1時間以内にパスワードの再設定を行ってください。</p>
		<div class="popInner">
			<?php echo $this->Form->create('Reminder', array('url'=>'/users/reminder', 'class'=>'mailForm', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
				<dl style='text-align:left;'>
                    <dt>メールアドレス</dt>
					<dd>
						<?php echo $this->Form->input('email'); ?>
					</dd>
				</dl>
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
</html>