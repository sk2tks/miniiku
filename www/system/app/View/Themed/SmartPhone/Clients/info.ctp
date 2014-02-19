<?php echo $this->Html->script("graph_radar_1_0_2/html5jp/graph/radar.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("https://maps-api-ssl.google.com/maps/api/js?sensor=false", array('inline'=>false)); ?>
<?php echo $this->Html->script("/common/js/jquery.carouFredSel-5.6.4.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("/sp/js/comment.js", array('inline'=>false)); ?>
<?php //echo $this->Html->script("/js/system.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("/sp/js/jquery.touchSwipe.min.js", array('inline'=>false)); ?>

<?php if(isset($client['Client']['contents_type_id']) && (($client['Client']['contents_type_id'] == 1))){ ?>
<?php echo $this->Html->css('/sp/css/client/area', null, array('inline'=>false)); ?>
<?php }else{ ?>
<?php echo $this->Html->css('/sp/css/client/community2', null, array('inline'=>false)); ?>
<?php } ?>
<?php echo $this->Html->css('/sp/css/common', null, array('inline' => false)); ?>


<style>
.btn {
	cursor: pointer;
	margin:0 auto;
	width:55%;
}

</style>
<script type="text/javascript">
$(function(){

//tab

	$('.tabSection .subTab li a').unbind();
	$('.tabSection .subTabBox').hide();
	$('.tabSection .subTabBox').eq(0).show();

	$('.tabSection .subTab li a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings().removeClass('on');
		$('.tabSection .subTabBox').hide();		
		$('.tabSection .subTabBox:eq('+ind+')').show();
						//google map 中心ずれ対策
			  var rel = $('.tabSection .subTabBox:eq('+ind+')').find('iframe').attr('rel');
        $('.tabSection .subTabBox:eq('+ind+')').find('iframe').attr('src',rel);
		setTimeout(function(){
			sInit();
		},500);
		$(window).resize(function(){
			sInit();
		});

		return false;
	});

function getRequest(){
  if(location.search.length > 1) {
    var get = new Object();
    var ret = location.search.substr(1).split("&");
    for(var i = 0; i < ret.length; i++) {
      var r = ret[i].split("=");
      get[r[0]] = r[1];
    }
    return get;
  } else {
    return false;
  }
}

//?tab=*でタブをOPEN
	get = getRequest();
	if((get['tab']!=undefined) && (get['tab']!='')){
		no = get['tab'];
		$('li.tab0'+no+' a').click();
	}


	//3択評価
	$('#ClientVoteViewForm #eva3_submit').click(function(){
		$('#ClientVoteViewForm').submit();
	});

	//画像表示
	function carousel_init(){
		var toolbar=$('.photoList .photo').clone();
		$('.linkPhoto').carouFredSel({
			prev: '.prev',
			next: '.next',
			auto: false,
			pagination:{
				container:'.photoList .photo',
				anchorBuilder:function(nr, item) {
					return toolbar.find('li').eq(nr-1).clone();
				}
			}
		});
	}


});
//ajaxでお気に入り登録したときのcallback
function onClientLikeSuccess(data){	
	if(data.status == '1'){
		var img = this.find('img');
		this.html(img).css('opacity',0.3);
		alert("お気に入りに登録しました");
	}else{
		alert(data.error);
	}
	
}
var loggedIn = <?php echo $loggedIn ? 'true' : 'false'; ?>

</script>

<script type="text/javascript">
//レーダーチャート	
window.onload = function() {

<?php
if((!$client['ClientPoll']['n1'])&&(!$client['ClientPoll']['n2'])&&(!$client['ClientPoll']['n3'])&&(!$client['ClientPoll']['n4'])&&(!$client['ClientPoll']['n5'])){echo "$('.radar').text('データがありません');return false;";}
	?> 
  var rc = new html5jp.graph.radar("radar");
  if( ! rc ) { return; }
  var items = [
    ["施設",
    <?php echo @h($client['ClientPoll']['n1']); ?>,
    <?php echo @h($client['ClientPoll']['n2']); ?>,
    <?php echo @h($client['ClientPoll']['n3']); ?>,
    <?php echo @h($client['ClientPoll']['n4']); ?>,
    <?php echo @h($client['ClientPoll']['n5']); ?>
    ]
  ];
  var params = {
    aCap: ["活気", "質", "設備", "教育", "環境"],
    aCapFontSize:"8px",
    aMax: 5,
    aMin: 0,
    sLabel:false,
    legend:false,

  }
  rc.draw(items, params);


};
</script>

<?php $display_tabs = (isset($client['Client']['display_tabs'])&&(!empty($client['Client']['display_tabs'])))?$client['Client']['display_tabs']:array();
$contents_type_id = $client['Client']['contents_type_id'];
$c_id = $client['Client']['id'];
//debug($user_info);
?>

<ul id="pagePath">
	<li><a href="<?php echo $this->Html->url('/', true); ?>">HOME</a>&gt;</li>
	<li><a href="/clients/search/<?php echo h($client['ContentsType']['slug']);?>"><?php echo h($client['ContentsType']['name']);?></a>&gt;</li>
	<li><?php echo h($client['Client']['name']);?></li>
</ul>
<section id="main">
	<h2><img src="/sp/img/client/area/img_h2_01.png" alt="" width="21"><span>地域の保育施設</span></h2>
	<ul class="dateUl clearfix">
		<li><span>更新日</span><span><?php $this->Html->pr_datetime($client['Client']['modified']); ?></span></li>
	</ul>
	<h3><?php echo h($client['Client']['name']);?></h3>
	<ul class="comBtnList clearfix">
		<li class="floatL"><a href="/clients/search/<?php echo h($client['ContentsType']['slug']);?>"><img src="/sp/img/common/com_btn_01.jpg" width="100%" alt="一覧に戻る"></a> </li>
		<li class="floatR"><a href="javascript:addLike(<?php printf("%s,%s", $client['Client']['contents_type_id'], $client['Client']['id']); ?>,$.proxy(onClientLikeSuccess, $('div.addLike')));"><img src="/sp/img/common/com_btn_03.jpg" width="100%" alt="お気に入り"></a></li>
	</ul>

	<a name="tab"></a>
	<div class="tabSection  cid-<?php echo $client['Client']['contents_type_id']?>">

<!-- 基本情報********************************************************************************** -->
		<div class="subTabBox subTabBox01">
			<h4>基本情報</h4>
			<dl class="infoDl">
				<dt>住所</dt>
				<dd>〒<?php echo (!empty($client['Client']['zip']))?h($this->Html->pr_zip($client['Client']['zip'])):''; ?><br />
					<?php echo (!empty($client['Area']['prefecture']))?h($client['Area']['prefecture']):''; ?>
					<?php echo (!empty($client['Area']['city']))?h($client['Area']['city']):''; ?>
					<?php echo (!empty($client['Area']['name']))?h($client['Area']['name']):''; ?>
					<?php echo (!empty($client['Client']['address']))?h($client['Client']['address']):''; ?>
					<?php echo (!empty($client['Client']['sub_address']))?h($client['Client']['sub_address']):''; ?></dd>
				<dt>TEL</dt>
				<dd><?php echo (!empty($client['Client']['tel']))?h($client['Client']['tel']):''; ?></dd>
				<dt>FAX</dt>
				<dd><?php echo (!empty($client['Client']['fax']))?h($client['Client']['fax']):''; ?></dd>
				<dt>代表</dt>
				<dd><?php echo (!empty($client['Client']['representative']))?h($client['Client']['representative']):''; ?></dd>
				<dt>最寄駅</dt>
				<dd><?php echo $this->Html->get_meta_value('最寄り駅' , $client['ClientInfo']);?></dd>
				<dt>HP</dt>
				<dd><a href="<?php echo (!empty($client['Client']['url']))?h($client['Client']['url']):''; ?>" target="_blank"><?php echo (!empty($client['Client']['url']))?h($client['Client']['url']):''; ?></a></dd>
				<dt>営業</dt>
				<dd><?php echo $this->Html->get_meta_value('営業時間' , $client['ClientInfo']);?><br>
					日曜・祝日8:00～20:00</dd>
				<dt>定休日</dt>
				<dd><?php echo $this->Html->get_meta_value('定休日' , $client['ClientInfo']);?></dd>
				<?php
				$a = array();
				 foreach ($basic_info as $item){
						if(!in_array($item['item'], $basic_info_default_arr)){
							$a[] = $item;
						}else{
							continue;
						}
				}
				 ?>
				 <?php foreach ($a as $item) { ?>
					<dt><?php echo h($item['item']); ?></dt>
					<dd colspan="2"><?php echo h($item['value']);?></dd>
				<?php } ?>
				<dt>MAP</dt>
				<dd>
					<iframe width="100%" height="270" frameborder="0" 
						scrolling="no" marginheight="0" marginwidth="0" 
						src="https://maps.google.co.jp/maps?q=<?php echo h($client['Client']['lat']);?>,<?php echo h($client['Client']['lng']);?>&hl=ja&spn=1.612832,3.120117&z=17&output=embed">
					</iframe><br />
					<small><a 
						href="http://maps.google.co.jp/maps?q=<?php echo h($client['Client']['lat']);?>,<?php echo h($client['Client']['lng']);?>+(<?php echo h($client['Client']['name']);?>)&hl=ja&spn=1.612832,3.120117&z=15"
						target="_blank" style="color:#ff8800;text-align:left">*大きな地図で見る
					</a></small>
				</dd>
			</dl>

<!-- コメント  ********************************************************************************** -->
<!--評価関連-->
			<h4>評価</h4>
			<ul class="numTxt clearfix">
				<li>コメント：<span><?php echo ($client['Client']['num_comments'])?$client['Client']['num_comments']:'-'; ?></span>件</li>
				<li>お気に入り：<span><?php echo ($client['Client']['num_likes'])?$client['Client']['num_likes']:'-'; ?></span>人</li>
			</ul>
			<?php if(isset($client['Client']['contents_type_id']) && (($client['Client']['contents_type_id'] == 1))){//保育施設	 ?>
			<div class="numBox clearfix">
				<div class="numImg">
					<div class="radar"><canvas width="95" height="93" id="radar"></canvas></div>
				</div>
				<div class="numTable">
					<table cellpadding="0" cellspacing="0" summary="評価" class="comTable01">
						<col width="60%">
						<col width="40%">
						<tbody>
							<tr>
								<th>園の活気</th>
								<td><?php echo (!is_null($client['ClientPoll']['n1']))?@h($client['ClientPoll']['n1']):'-'; ?></td>
							</tr>
							<tr>
								<th>保育の質</th>
								<td><?php echo (!is_null($client['ClientPoll']['n2']))?@h($client['ClientPoll']['n2']):'-'; ?></td>
							</tr>
							<tr>
								<th>施設/設備</th>
								<td><?php echo (!is_null($client['ClientPoll']['n3']))?@h($client['ClientPoll']['n3']):'-'; ?></td>
							</tr>
							<tr>
								<th>教育内容</th>
								<td><?php echo (!is_null($client['ClientPoll']['n4']))?@h($client['ClientPoll']['n4']):'-'; ?></td>
							</tr>
							<tr>
								<th>周辺環境</th>
								<td><?php echo (!is_null($client['ClientPoll']['n5']))?@h($client['ClientPoll']['n5']):'-'; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<p class="text02">※お子様が通園された複数の保護者による評価の平均値です</p>
			</div>
			<?php }else{//保育施設以外(3択) ?>
			<div class="title2">投票件数</div>
			<div class="voteBox clearfix">
			<?php
				$lab = array();
				if($contents_type_id == 2){//スポット
					$lab = array('行ってみたい','また行きたい','もう十分');
				}else if($contents_type_id == 3){//習い事
					$lab = array('興味あり','利用中','利用した');
				}else if($contents_type_id == 4){//コミュニティ
					$lab = array('興味あり','加入中','加入していた');
				}else if($contents_type_id == 5){//医療施設
					$lab = array('興味あり','利用中','利用した');
				}
			?>
				<div class="box clearfix">
					<div class="inner clearfix">
						<div class="textBox">
							<p class="title">投票件数</p>
							<ul class="clearfix">
								<li><span><?php echo $lab[0];?></span><span class="color"><?php echo ($client['ClientPoll']['n1'])?floor($client['ClientPoll']['n1']):'-'; ?></span>件</li>
								<li><span><?php echo $lab[1];?></span><span class="color"><?php echo ($client['ClientPoll']['n2'])?floor($client['ClientPoll']['n2']):'-'; ?></span>件</li>
								<li><span><?php echo $lab[2];?></span><span class="color"><?php echo ($client['ClientPoll']['n3'])?floor($client['ClientPoll']['n3']):'-'; ?></span>件</li>
							</ul>
						</div>
						<div class="photoBox_graphbox">
						<?php
							$w = array();
							$max = max($client['ClientPoll']['n1'] , $client['ClientPoll']['n2'] , $client['ClientPoll']['n3']);
							$w[1] = ($max)?$client['ClientPoll']['n1'] / $max * 95:'0';
							$w[2] = ($max)?$client['ClientPoll']['n2'] / $max * 95:'0';
							$w[3] = ($max)?$client['ClientPoll']['n3'] / $max * 95:'0';
						?>
							<div class="photoBox_graph1"><img src="/img/search/imgtext08.gif" width="<?php echo $w['1'];?>" height="15" alt="" /></div>
							<div class="photoBox_graph2"><img src="/img/search/imgtext08.gif" width="<?php echo $w['2'];?>" height="15" alt="" /></div>
							<div class="photoBox_graph3"><img src="/img/search/imgtext08.gif" width="<?php echo $w['3'];?>" height="15" alt="" /></div>
						</div>
					</div>
					<div class="rVote">
						<?php
						if(isset($user_info)){ ?>
							<?php echo $this->Form->create('ClientVote', array('url'=>'/clients/evaluate/'.$c_id,'type'=>'post','class'=>'','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
							<?php
								echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_info['User']['id']));
								echo $this->Form->input('client_id',array('type'=>'hidden','value'=>$c_id));
							?>
							<ul>
								<li>
									<input value="1" name="data[ClientVote][n]" id="vote01" type="radio" <?php if(isset($this->data['ClientVote']['n1'])&&($this->data['ClientVote']['n1']=='1'))echo 'checked'; ?>>
									<label for="vote01">&nbsp;<?php echo $lab[0];?></label>
								</li>
								<li>
									<input value="2" name="data[ClientVote][n]" id="vote02" type="radio" <?php if(isset($this->data['ClientVote']['n2'])&&($this->data['ClientVote']['n2']=='1'))echo 'checked'; ?>>
									<label for="vote02">&nbsp;<?php echo $lab[1];?></label>
								</li>
								<li>
									<input value="3" name="data[ClientVote][n]" id="vote03" type="radio" <?php if(isset($this->data['ClientVote']['n3'])&&($this->data['ClientVote']['n3']=='1'))echo 'checked'; ?>>
									<label for="vote03">&nbsp;<?php echo $lab[2];?></label>
								</li>
							</ul>
							<div class="btnVote btn"><a id="eva3_submit"><img src="/img/client/area/ind2_btn_vote.gif" /></a></div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
<!--/評価関連-->

<!--コメント関連-->
			<h4>コメント</h4>
			<style>
				.inactive {
					filter: alpha(opacity=40);
					opacity: 0.4;
				}
			</style>
			<script type="text/javascript">
				var commentPosted = <?php echo empty($commentPosted) ? 'false' : 'true'; ?>;
				var currentComment = <?php echo empty($currentComment) ? '0' : $currentComment; ?>;
				var parentOfCurrentComment = <?php echo empty($parentOfCurrentComment) ? '0' : $parentOfCurrentComment; ?>;
				$(function(){
					if(commentPosted){
						setTimeout(function(){
							$('#tab_comment').click();
							showCurrentComment();
						}, 10);
					}
				});
			</script>
			<div class="commentBox"><?php echo $this->element('comment'); ?></div>
<!--/コメント関連-->
		</div><!-- /subTabSection -->
	</div><!-- /tabSection -->

	<ul class="comBtnList clearfix">
		<li class="floatL"><a href="/clients/search/<?php echo h($client['ContentsType']['slug']);?>"><img src="/sp/img/common/com_btn_01.jpg" width="100%" alt="一覧に戻る"></a> </li>
		<li class="floatR"><a href="javascript:addLike(<?php printf("%s,%s", $client['Client']['contents_type_id'], $client['Client']['id']); ?>,$.proxy(onClientLikeSuccess, $('div.addLike')));"><img src="/sp/img/common/com_btn_03.jpg" width="100%" alt="お気に入り"></a></li>
	</ul>
</section>

<script type="text/javascript">
jQuery(document).ready(function(){
	//get
});
</script>

<?php //debug($client); ?>
