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
<link href="/css/mypage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/common/js/jquery-1.8.3.min.js"></script>
<script>
var targetChildNum = <?php echo $target_child_num; ?>;
function setClient(){
	var selectedClient = $("input[type=radio]:checked");
	
	var clientId = selectedClient.val();

	if(clientId != '0'){
		var clientName = selectedClient.parent('label').text().replace(/^\s+/,'').replace(/\s+$/,'');
	}else{
		var clientName = $("#client_name").val();
	}
	
	if(!clientName || !clientId) {
		alert("施設を選択もしくは施設名を記入してください");
		return;
	}
	parent.setChildClientId(targetChildNum, clientId, clientName);
	parent.$.fancybox.close();
}

$(function(){
	$("input[type=radio]").click(function(){
		setOther();
	})
})
function setOther(){
	if($("#client_other").attr('checked')){
		$('#client_name').show();
	}else{
		$('#client_name').hide();
	}
}
</script>

</head>
<body id="tuuen">
<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>通園施設</h1>
		
		<div class="popInner">
			<form action="" method="post" class="mailForm" onsubmit='return false;'>
				<p>お子様の通園施設を以下の中からお選びください。</p>
				<div class="radioBox">
					<ul class="radioList clearfix">
						<?php foreach($clients as $key=>$name): ?>
						<li>
							<label for="fNursery01">
								<input type="radio" value="<?php echo $key; ?>" name="data[client_id]" id="fNursery01" 
									<?php if(isset($this->data['client_id']) && $this->data['client_id'] == $key): ?>checked="checked"<?php endif; ?> />
								<?php echo $name; ?></label>
						</li>
						<?php endforeach; ?>
						
						<li class="liSpecial"> <span>
							<label for="fNursery09">
								<input type="radio"  name="data[client_id]" id='client_other' value='0' <?php if(isset($this->data['client_id']) && $this->data['client_id'] == '0'): ?>checked="checked"<?php endif; ?> />
								その他</label>
							</span>
							
							<input type="text" value="" name="info" class="inputText"  id='client_name'
								<?php if(isset($this->data['client_id']) && $this->data['client_id'] != '0'): ?>style='display:none' <?php endif; ?>
							/>
							
						</li>
					</ul>
				</div>
				<ul class="submit">
					<li>
						<input onclick='setClient();' type="image" name="__send__" src="/img/mypage/tuu_btn01.gif" value="登 録" alt="登 録" onmouseover="this.src='/img/mypage/tuu_btn01_over.gif'" onmouseout="this.src='/img/mypage/tuu_btn01.gif'" />
					</li>
					</li>
					<li>
						<input onclick="parent.$.fancybox.close();" type="image" name="__send__" src="/img/mypage/tuu_btn02.gif" value="キャンセル" alt="キャンセル" onmouseover="this.src='/img/mypage/tuu_btn02_over.gif'" onmouseout="this.src='/img/mypage/tuu_btn02.gif'" />
					</li>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>
</body>
</html>