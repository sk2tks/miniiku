<?php echo $this->Html->script("graph_radar_1_0_2/html5jp/graph/radar.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("https://maps-api-ssl.google.com/maps/api/js?sensor=false", array('inline'=>false)); ?>
<?php echo $this->Html->script("/common/js/jquery.carouFredSel-5.6.4.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("/common/js/common.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("/js/comment.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("/js/system.js", array('inline'=>false)); ?>

<?php if(isset($client['Client']['contents_type_id']) && (($client['Client']['contents_type_id'] == 1))){ ?>
<?php echo $this->Html->css('client/area', null, array('inline'=>false)); ?>
<?php }else{ ?>
<?php echo $this->Html->css('client/community2', null, array('inline'=>false)); ?>
<?php //echo $this->Html->css('client/spot', null, array('inline'=>false)); ?>
<?php } ?>


<style>
.btn {
	cursor: pointer;
}
.btn:hover {
    filter: alpha(opacity=70);
    opacity:0.7;
}

#spot_index  h2,
.spot_index2  h2 {
	background: url(../../img/client/spot/h2_bg.gif) no-repeat 10px 2px !important;
}

#spot_index .thSpecial,
#index2 .thSpecial {
	padding-left: 23px;
	text-align: left !important;
}

#spot_index .tableA {
	clear: both;
	margin-bottom: 16px;
}

#spot_index .tableA th {
	color: #464646;
	font-size: 1.6em;
	text-align: left;
	padding-left: 20px;
}

#spot_index .tableA td {
	color: #464646;
}

#spot_index .text {
    overflow: hidden;
}

#spot_index .text span {
    float: left;
    margin-top: 2px;
    width: 300px;
}

#spot_index .text a {
    float: right;
}

#spot_index .map {
    margin-left: 5px;
}

#spot_index .map a {
    color: #2224FF;
    display: inline-block;
    margin-top: 5px;
}




</style>
<script type="text/javascript">
$(function(){
//tab

	//carousel_init();
	$('#clientBox .tabBox').hide();
	$('#clientBox.tabSection .tabBox').eq(0).show();
	$('#clientBox.tabSection .linkUl li a').click(function(){
		var ind=$(this).parent('li').index();
	//	location.href = '/mypage?tab=' + ind;
			$(this).parent('li').addClass('on').siblings().removeClass('on');
			$('#clientBox.tabSection .tabBox').hide();		
			$('#clientBox.tabSection .tabBox:eq('+ind+')').show();
				//google map 中心ずれ対策
			  var rel = $('#clientBox.tabSection .tabBox:eq('+ind+')').find('iframe').attr('rel');
        $('#clientBox.tabSection .tabBox:eq('+ind+')').find('iframe').attr('src',rel);
			if(ind==1){//カルーセルの初期化
				carousel_init();
			}
	});
	//return false;



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

<h2><?php echo h($client['ContentsType']['name']);?></h2>
<ul id="pagePath">
	<li><a href="<?php echo $this->Html->url('/', true); ?>">HOME</a>&gt;</li>
	<li><a href="/clients/search/<?php echo h($client['ContentsType']['slug']);?>"><?php echo h($client['ContentsType']['name']);?></a>&gt;</li>
	<li><?php echo h($client['Client']['name']);?></li>
</ul>

<div class="formBox clearfix">
	<div class="link"><a href="/clients/search/<?php echo h($client['ContentsType']['slug']);?>"><img src="/img/client/area/link_<?php echo h($client['ContentsType']['slug']);?>.jpg" width="253" height="37" alt="地域の<?php echo h($client['ContentsType']['name']);?>一覧へ" /></a></div>
	<div class="formR clearfix">
		<dl class="dlBox clearfix">
			<dt>更新日</dt>
			<dd><?php $this->Html->pr_datetime($client['Client']['modified']); ?></dd>
		</dl>
	</div>
</div>

<div class="comBox clearfix">
	<h3><?php echo h($client['Client']['name']);?></h3>
	<div class="textImg addLike">
		<a href="javascript:addLike(<?php printf("%s,%s", $client['Client']['contents_type_id'], $client['Client']['id']); ?>,$.proxy(onClientLikeSuccess, $('div.addLike')));">
			<img src="/img/client/area/imgtext.jpg" width="55" height="45" alt="お気に入り" />
		</a>
	</div>
</div>

<a name="tab"></a>
<div id="clientBox" class="tabSection cid-<?php echo $client['Client']['contents_type_id']?>">
	<div class="tabInner">

<!-- 基本情報********************************************************************************** -->
		<div class="tabBox">
			<h4>基本情報</h4>
			<table cellpadding="0" cellspacing="0" summary="基本情報">
				<col width="14%" />
				<col width="42%" />
				<tbody>
					<tr>
						<th class="heiSpecial">住所</th>
						<td class="heiSpecial">〒<?php echo (!empty($client['Client']['zip']))?h($this->Html->pr_zip($client['Client']['zip'])):''; ?><br />
							<?php echo @h($client['Area']['prefecture']).h($client['Client']['address']); ?><br />
							<?php //echo (!empty($client['Area']['prefecture']))?h($client['Area']['prefecture']):''; ?>
							<?php //echo (!empty($client['Area']['city']))?h($client['Area']['city']):''; ?>
							<?php //echo (!empty($client['Area']['name']))?h($client['Area']['name']):''; ?>
							<?php //echo (!empty($client['Client']['address']))?h($client['Client']['address']):''; ?>
							<?php echo (!empty($client['Client']['sub_address']))?h($client['Client']['sub_address']):''; ?>
						</td>
						<td class="tdSpecial" rowspan="5">
							<?php if(!(($client['Client']['lat'] == '')&&($client['Client']['lng'] == ''))){ ?>
									<iframe width="360" height="270" frameborder="0" 
									scrolling="no" marginheight="0" marginwidth="0" 
									src="https://maps.google.co.jp/maps?q=<?php echo h($client['Client']['lat']);?>,<?php echo h($client['Client']['lng']);?>&hl=ja&spn=1.612832,3.120117&z=17&output=embed">
									</iframe><br /><small><a 
									href="https://maps.google.co.jp/maps?q=<?php echo h($client['Client']['lat']);?>,<?php echo h($client['Client']['lng']);?>+(<?php echo h($client['Client']['name']);?>)&hl=ja&spn=1.612832,3.120117&z=15"
									target="_blank" style="color:#ff8800;text-align:left">*大きな地図で見る
									</a></small>
								<?php }else{ ?>
								地図情報はありません
								<?php } ?>
						</td>
					</tr>
					<tr>
						<th>TEL</th>
						<td><?php echo (!empty($client['Client']['tel']))?h($client['Client']['tel']):''; ?></td>
					</tr>
					<tr>
						<th>FAX</th>
						<td><?php echo (!empty($client['Client']['fax']))?h($client['Client']['fax']):''; ?></td>
					</tr>
					<tr>
						<th>代表</th>
						<td><?php echo (!empty($client['Client']['representative']))?h($client['Client']['representative']):''; ?></td>
					</tr>
					<tr>
						<th>最寄駅</th>
						<td><?php echo $this->Html->get_meta_value('最寄り駅' , $client['ClientInfo']);?><br />
						</td>
					</tr>
					<tr>
						<th>HP</th>
						<td colspan="2"><a href="<?php echo (!empty($client['Client']['url']))?h($client['Client']['url']):''; ?>" target="_blank"><?php echo (!empty($client['Client']['url']))?h($client['Client']['url']):''; ?></a></td>
					</tr>
					<tr>
						<th>営業</th>
						<td colspan="2"><?php echo $this->Html->get_meta_value('営業時間' , $client['ClientInfo']);?></td>
					</tr>
					<tr>
						<th>定休日</th>
						<td colspan="2"><?php echo $this->Html->get_meta_value('定休日' , $client['ClientInfo']);?></td>
					</tr>
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
					<tr>
						<th><?php echo h($item['item']); ?></th>
						<td colspan="2"><?php echo h($item['value']);?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

<!-- コメント  ********************************************************************************** -->
			<h4>評 価</h4>
<!--評価関連-->
			<div class="evaluation clearfix">
				<dl>
					<dt>コメント　：</dt>
					<dd><span class="spanText01"><?php echo ($client['Client']['num_comments'])?$client['Client']['num_comments']:'-'; ?></span>件</dd>
					<dt>お気に入り：</dt>
					<dd><span class="spanText02"><?php echo ($client['Client']['num_likes'])?$client['Client']['num_likes']:'-'; ?></span>人</dd>
				</dl>
				<?php if(isset($client['Client']['contents_type_id']) && (($client['Client']['contents_type_id'] == 1))){//保育施設	 ?>
				<div class="rBox clearfix">
					<div class="inner clearfix">
						<div class="photoBox">
							<div class="radar"><canvas width="95" height="93" id="radar"></canvas></div>
						</div>
						<div class="tableBox">
							<table cellpadding="0" cellspacing="0" summary="評 価">
								<col width="60%" />
								<col width="40%" />
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
					</div>
					<p>※お子様が通園された複数の保護者による評価の平均値です</p>
				</div><!-- /rBox -->
				<?php } else{//保育施設以外 ?>
				<div class="voteSection clearfix">
					<div class="voteImg2">
						<div class="jScroll">
							<table>
								<tbody>
									<tr><td>
										<div class="inner2 clearfix">
											<div class="textBox2">
												<div class="title2">投票件数</div>
												<ul class="clearfix">
													<?php
														$lab = array();
														if($contents_type_id == 2){//スポット
															$lab = array('行ってみたい','また行きたい','もう十分');
														}else if($contents_type_id == 3){//習い事
															$lab = array('興味あり','利用中','利用していた');
														}else if($contents_type_id == 4){//コミュニティ
															$lab = array('興味あり','加入中','加入していた');
														}else if($contents_type_id == 5){//医療施設
															$lab = array('興味あり','利用中','利用していた');
														}
													?>
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
						</td></tr></tbody></table></div>
					</div>
					<?php if(isset($user_info)){ ?>
					<div class="voteBox clearfix">
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
						<div class="btnVote">
							<a id="eva3_submit"><img src="/img/client/area/ind2_btn_vote.gif" /></a>
						</div>
					</div>
					<?php } ?>
					</div>
				<?php } ?>
				</div><!-- /voteSection -->
<!--/評価関連-->

<!--コメント関連-->
				<h4>コメント</h4>
				<?php echo $this->element('comment'); ?>
				<script type="text/javascript">
					var commentPosted = <?php echo empty($commentPosted) ? 'false' : 'true'; ?>;
					var currentComment = <?php echo empty($currentComment) ? '0' : $currentComment; ?>;
					var parentOfCurrentComment = <?php echo empty($parentOfCurrentComment) ? '0' : $parentOfCurrentComment; ?>;
					$(function(){
						var cols = $('#comInput textarea').attr('cols');
						$('#comInput textarea, #resInput textarea').attr('cols', cols - 1);
						if(commentPosted){
							$('#tab_comment').click();
							showCurrentComment();
						}
					});
				</script>
<!--/コメント関連-->
			</div><!-- /evaluation -->
		</div><!-- /tabBox -->
	</div><!-- /tabInner -->

<script type="text/javascript">
jQuery(document).ready(function(){
	//get
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
});
</script>

<?php //debug($client); ?>
