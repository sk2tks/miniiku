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
<link href="../../common/css/layout.css" rel="stylesheet" type="text/css" />
<link href="../../common/css/general.css" rel="stylesheet" type="text/css" />
<link href="../../css/client/pop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/common/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-ui-1.10.3.custom.min.js"></script>
<link href="../../common/css/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
<?php //echo $this->Html->script("/common/js/jquery-ui-1.10.3.custom.min", array('inline'=>false)); ?>
<?php //echo $this->Html->script("/common/js/jquery-ui-1.10.3.custom.min", array('inline'=>false)); ?>
</head>
<style>
.popup .mailForm .check {
	/*background:none;*/
	}
table#nursery_eva{
	width:90%;
	font-size: 14px;
	margin:0 auto;
}

table#nursery_eva td
{
	padding: 5px 2px; 
}

table#nursery_eva ul.btnbox{
	padding-top: 19px;
}

table#nursery_eva input:hover{
	opacity: 0.7;
}

#sub{
	width:164px;
	height:50px;
	background:url('/img/pop/btn01.gif');
	border:none;
}

#can{
	width:164px;
	height:50px;
	background:url('/img/pop/btn02.gif');
	border:none;
}

</style>
<script>
  $(function() {

result = $('input#result').val();
cid = $('#ClientVoteClientId').val();

if(result == 'saved'){
	parent.hideClientEvalButton(cid);
	parent.$.fancybox.close();
}

$('#sub').click(function(){
	$('form#ClientVoteEvaluateForm').submit();
});
$('#can').click(function(){
	parent.$.fancybox.close();
});

function cancelBubble(e) {
 var evt = e ? e:window.event;
 if (evt.stopPropagation)    evt.stopPropagation();
 if (evt.cancelBubble!=null) evt.cancelBubble = true;
}


  	for(i=1;i<6;i++){
  		exval = $( "#n"+i ).val();
	    $( "#slider_n"+i ).slider({
	      'value':exval,
	      'min': 1,
	      'max': 5,
	      'step': 1,
	      stop: function( event, ui ) {
		      if (event.originalEvent) {
		      	event.stopPropagation();

		        $( this ).parent().parent().find('input').val( ui.value );
	        }
	        else {
	        }
	      }
	    });

  	}

$('input.n').change(function(){
	no = $(this).attr('id').replace('n' , '');
	v = $(this).val();
	$( "#slider_n"+no ).slider("value" , v);
});


  });
  </script>
<body>
	<?php //debug($this->request->data); ?>

<div class="popBox">
	<div class="close"></div>
	<div class="popup">
		<h1>評価</h1>
		<div class="popInner">
			<h2><?php //echo $this->Session->flash(); ?></h2>
			<?php 
			echo $this->Form->input('result', array('type'=>'hidden' , 'id'=>'result' , 'value'=>$result));?>

			<?php echo $this->Form->create('ClientVote', array('url'=>'/clients/evaluate/'.$cid,'type'=>'post','class'=>'','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
			<?php echo $this->Form->input('client_id', array('type'=>'hidden' , 'value'=>$cid));?>
			<?php echo $this->Form->input('user_id', array('type'=>'hidden' , 'value'=>$uid));?>
				<p>お子様の通っている保育施設の評価にご協力をお願い致します。</p>
				<div class="radioBox">
					<ul class="radioList clearfix">
						<li class="liSpecial"> <span>評価対象：<?php echo $client['Client']['name']?></span>
							<!-- <input type="text" name="text" class="inputText" value="施設名" size="25" /> -->
						</li>
					</ul>
				</div>
				<?php echo $this->Form->input('id', array('type'=>'hidden'));?>
				<div class="check">
					<table id="nursery_eva" style="width:90%">
						<tbody>
							<tr>
								<td>
										<?php echo $this->Form->input('n1', array('type'=>'text','id'=>'n1', 'size'=>'1' , 'class'=>'n'));?><span>園の活気</span>
								</td>
										<td width="80%"><div class="slider_item" id="slider_n1"></div>
											
								</td>
							</tr>
							<tr>
								<td>
										<?php echo $this->Form->input('n2', array('type'=>'text','id'=>'n2', 'size'=>'1' , 'class'=>'n'));?><span>保育の質</span>
								</td>
										<td><div class="slider_item" id="slider_n2" type="text" value="" ></div>
											
								</td>
							</tr>
							<tr>
								<td>
										<?php echo $this->Form->input('n3', array('type'=>'text','id'=>'n3', 'size'=>'1' , 'class'=>'n'));?><span>施設・設備</span>
								</td>
										<td><div class="slider_item" id="slider_n3" type="text" value="" ></div>
											
								</td>
							</tr>
							<tr>
								<td>
										<?php echo $this->Form->input('n4', array('type'=>'text','id'=>'n4', 'size'=>'1' , 'class'=>'n'));?><span>教育内容</span>
								</td>
										<td><div class="slider_item" id="slider_n4" type="text" value="" ></div>
											
								</td>
							</tr>
							<tr>
								<td>
										<?php echo $this->Form->input('n5', array('type'=>'text','id'=>'n5', 'size'=>'1' , 'class'=>'n'));?><span>周辺環境</span>
								</td>
										<td><div class="slider_item" id="slider_n5" type="text" value="" ></div>
											
								</td>
							</tr>
							<tr>
								<td colspan="2">
										<ul class="clearfix btnbox">
											<li>
												<input class="floatL" id="sub" type="submit" value="" alt="登録" name="" onclick="return false;"/>
											</li>
											<li class="floatR">
												<input id="can" type="reset" value="" alt="戻る" name="" />
											</li>
										</ul>
								</td>
							</tr>	
						</tnody>
					</table>

<!-- 					<div class="point"><img src="../../img/pop/point.png" width="15" height="15" border="0" alt="評価" style="display:block" /></div>
					<div class="point"><img src="../../img/pop/point.png" width="15" height="15" border="0" alt="評価" style="display:block" /></div>
					<div class="point"><img src="../../img/pop/point.png" width="15" height="15" border="0" alt="評価" style="display:block" /></div>
					<div class="point"><img src="../../img/pop/point.png" width="15" height="15" border="0" alt="評価" style="display:block" /></div>
					<div class="point"><img src="../../img/pop/point.png" width="15" height="15" border="0" alt="評価" style="display:block" /></div> -->
				</div>
			
			<?php echo $this->Form->end();?>
			<?php //echo $this->element('sql_dump'); ?>
		</div>
	</div>
</div>
</body>
</html>