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

<link href="/css/clip.css" rel="stylesheet" type="text/css" />
<style>
.error-message{
	color:#c00;
	font-size:12px;
	margin-left:100px;
}
.error-message:before{
	content:"※";
}
</style>
</head>
<body id="tuuen">
<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>クリップ登録</h1>
		<div class="popInner">
			<?php echo $this->Form->create('FamilyClip', 
				array('class'=>'mailForm','url'=>$this->request->herer, 'type'=>'post', 'inputDefaults'=>array('label'=>false, 'legend'=>false, 'div'=>false))); ?>
				<?php echo $this->Form->hidden('family_id'); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<?php echo $this->Form->hidden('query'); ?>
				<p>クリップに追加する情報をご記入ください。</p>
				<div class="radioBox">
					<ul class="radioList clearfix">
					
						<li class="liSpecial"> <span>
							<label for="fNursery09">
								URL：　　</label>
							</span>
							<?php echo $this->Form->input('url', array('class'=>'inputText')); ?>
							<!-- <input type="text" value="" name="text" class="inputText" /> -->
						</li>
                        <li class="liSpecial"> <span>
							<label for="fNursery09">
								
								タイトル：</label>
							</span>
							<?php echo $this->Form->input('title', array('class'=>'inputText')); ?>
							<!-- <input type="text" value="" name="text" class="inputText" /> -->
						</li>
                        <li class="liSpecial"> <span>
							<!-- <label for="fNursery09" > -->
								メモ：　　<!-- </label> -->
							</span>
							<?php echo $this->Form->input('memo', array('class'=>'inputText')); ?>
							<!-- <input type="text" value="" name="text" class="inputText" /> -->
						</li>
					</ul>
				</div>
				<ul class="submit">
					<li>
						<input type="image" name="__send__" src="/img/clip/btn01.gif" value="登 録" alt="登 録" onmouseover="this.src='/img/clip/btn01_over.gif'" onmouseout="this.src='/img/clip/btn01.gif'" />
					</li>
					</li>
					<li>
						<input type="image" name="__send__" src="/img/clip/btn02.gif" value="キャンセル" alt="キャンセル" onmouseover="this.src='/img/clip/btn02_over.gif'" onmouseout="this.src='/img/clip/btn02.gif'" onclick="parent.$.fancybox.close();"/>
					</li>
					</li>
				</ul>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
</body>
</html>