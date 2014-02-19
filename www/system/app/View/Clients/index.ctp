<!-- <link href="/css/search.css" rel="stylesheet" type="text/css" /> -->
<?php echo $this->Html->css('search', null, array('inline'=>false)); ?>
<?php echo $this->Html->script("client_search", array('inline'=>false)); ?>
<!-- <script type="text/javascript" src="graph_radar_1_0_2/js/html5jp/graph/radar.js"></script> -->
<?php echo $this->Html->script("graph_radar_1_0_2/html5jp/graph/radar.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("https://maps-api-ssl.google.com/maps/api/js?sensor=false", array('inline'=>false)); ?>

<!-- <script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/client_search.js"></script> -->

<script type="text/javascript">

var marker = null;
var geocoder = null;
var directions = null;
var iwin = new Array();
var markers = new Array();
var default_latlng = null;

function initMap(){
		var marker_ar = new Array();
		var item = new Array();
	  geocoder = new google.maps.Geocoder();

//default_latlng = getLatLng('中央区日本橋');//ここはサブドメインまたはユーザー情報より得る・とりあえず日本橋
default_address = '中央区日本橋';
	
<?php foreach($clients as $client){ ?>

item = {'cname': '<?php echo @h($client['Client']['name']);?>', 'lat': '<?php echo @h($client['Client']['lat']);?>', 'lng':'<?php echo @h($client['Client']['lng']);?>' , 'id' : '<?php echo @h($client['Client']['id']);?>'};
marker_ar.push(item);

<?php } ?>
//console.log(default_latlng);


	      geocoder.geocode( { 'address': default_address}, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {

		        default_latlng = results[0].geometry.location;

						var lat = default_latlng.lat();
						var lng = default_latlng.lng();

						var latlng = new google.maps.LatLng(lat,lng);
						
						var options = {
						  zoom: 13,
						  center: latlng,
						  mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						map = new google.maps.Map(document.getElementById("client_all_gmap"), options);


											for(i=0;i<marker_ar.length;i++){

														item_latlng = new google.maps.LatLng(marker_ar[i]['lat'],marker_ar[i]['lng']);
														item_title = marker_ar[i]['cname'];

															marker = new google.maps.Marker({
															      position: item_latlng,
															      title:item_title
															  });
															  marker.setMap(map);

															  markers.push(marker);

															var contentString = marker_ar[i]['cname'];
														  var infowin = new google.maps.InfoWindow({
															    content: contentString
														  	});
														  attachMessage(marker, contentString , marker_ar[i]['id']);
											}

 					} else {
	          alert("Geocode was not successful for the following reason: " + status);
	        }

	});//closure end

}

function attachMessage(marker, msg , id) {
	var iw = new google.maps.InfoWindow({
        content: msg
      });
	iwin.push(iw);
    google.maps.event.addListener(marker, 'mouseover', function(event) {
      iw.open(marker.getMap(), marker);
    });
    google.maps.event.addListener(marker, 'mouseout', function(event) {
      iw.close();
    });
    google.maps.event.addListener(marker, 'click', function(event) {
      location.href = '/clients/view/' + id;
    });
  }



function getLatLng(addr){//非同期のため使いにくい
	//var addr = '';

	// if($('#prefecture').val()){
	// 	addr += $('#prefecture option:selected').html();
	// }
	// addr += $('#address').val() + $('#sub_city').val();


	if(!addr) return;

	if (geocoder) {

	      geocoder.geocode( { 'address': addr}, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {

		        latlng = results[0].geometry.location;



	          // 	map.setCenter(latlng);
	         	// marker.setMap(null);
	          // 	marker = new google.maps.Marker({
	          //     map: map,
	          //     position: latlng,
	          //     title:mapTitle
	          // 	});
	          	//$("#lat").val(latlng.lat());
	          	//$("#long").val(latlng.lng());

	          	//return latlng;
	          
	          	
	        } else {
	          alert("Geocode was not successful for the following reason: " + status);
	        }
	        

	      });

return latlng;

	}
}


function setLatLng(latlng){
	map.setCenter(latlng, 15);
	var lng = latlng.lng();
	var lat = latlng.lat();
	$('#lat').val(lat);
	$('#long').val(lng);

}

function showIWin(no){
	iwin[no].open(map , markers[no]);
}

</script>


<script>
var mapTitle = "client_all_gmap";
$(function(){
	initMap();
})
</script>

<script type="text/javascript">
//レーダーチャート	
window.onload = function() {

<?php 



$i = 0; foreach ($clients as $client){
if((!$client['ClientPoll']['n1'])&&(!$client['ClientPoll']['n2'])&&(!$client['ClientPoll']['n3'])&&(!$client['ClientPoll']['n4'])&&(!$client['ClientPoll']['n5'])){echo "$('#radar-{$i}').text('データがありません');";continue;}
	?> 
  var rc = new html5jp.graph.radar("radar-<?php echo $i; ?>");
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
<?php $i++ ;} ?>

};
</script>
<?php if($type == 'spot'){
	$cls = 'h2Ttl';
}else if($type == 'culture'){
	$cls = 'h2Ttl2';
}else if($type == 'community'){
	$cls = 'h2Ttl3';
}else if($type == 'medical'){
	$cls = 'h2Ttl4';
}else{
	$cls = '';
}
?>

		<h2 class="<?php echo $cls; ?>"><?php echo $title_for_layout;?></h2>
			<ul id="pagePath">
				<li><a href="<?php echo $this->Html->url('/', true); ?>">HOME</a>&gt;</li>
				<li><?php echo $title_for_layout;?></li>
			</ul>
			<div class="map" id="client_all_gmap" width="730" height="250" style="width:730px;height:250px;">
			</div>
			<?php echo $this->Form->create('search', array('type' => 'get'));?>
			<div class="formBox clearfix">
				<dl class="formDl clearfix">
					<dt>表示：</dt>
					<dd>

						<?php echo $this->Form->input( 'client_type_id', array( 
						    'type' => 'select',
						    'options' => $clientTypes,
						    'empty' => 'タイプ',
						    'label' => false
						//  'selected' => $selected  // 規定値をvalueで指定
						)); ?>
						
					</dd>
				</dl>
				<ul class="clearfix">
						<?php
						$here = $this->here;
						$here = preg_replace('/\/sort.+$/', '', $here);
						?>
					<li><a href="<?php echo $here; ?>/sort:created/direction:desc"><img <?php echo ((isset($this->params['named']['sort'])&&($this->params['named']['sort']=='created'))||
					(empty($this->params['named']['sort'])))?'class="inactive"':'active';?> src="/img/search/link01_o.jpg" width="99" height="26" alt="掲載日時順" /></a></li>
					<li><a href="<?php echo $here; ?>/sort:num_comments/direction:desc"><img <?php echo (isset($this->params['named']['sort'])&&($this->params['named']['sort']=='num_comments'))?'class="inactive"':'active';?> src="/img/search/link02_o.jpg" width="116" height="26" alt="コメント数順" /></a></li>
					<li><a href="<?php echo $here; ?>/sort:num_likes/direction:desc"><img  <?php echo (isset($this->params['named']['sort'])&&($this->params['named']['sort']=='num_likes'))?'class="inactive"':'active';?> src="/img/search/link03_o.jpg" width="126" height="26" alt="お気に入り数順" /></a></li>
				</ul>
				<dl class="formDl formDlR clearfix">
					<dt>絞り込み：</dt>
					<dd>
						<!-- <input type="text" name="keyword" class="fKeyword" value="キーワード" /> -->
							<?php echo $this->Form->input( 'keyword', array( 
								'class' => 'fKeyword',
						    'type' => 'text',
						    'label' => false
						//  'selected' => $selected  // 規定値をvalueで指定
						)); ?>
						<a class="searchBtn"><img src="/img/search/img_search.gif" name="search" class="fSearch" /></a>
					</dd>
				</dl>
			</div>
			<?php echo $this->Form->end(); ?>
			<div class="jScroll">

				<table cellpadding="0" cellspacing="0" summary="地域の保育施設">
					<col width="22%" />
					<col width="46%" />
					<col width="32%" />
					<tbody>

<!-- loop -->
<?php

if(count($clients) < 1)echo '<h4>検索条件に合うデータが見つかりません</h4>';

 $i = 0; ?>
<?php foreach($clients as $client){ ?>
	
<?php 

switch ($client['Client']['contents_type_id']) {
	case '1':
		echo $this->element('search/nursery_unit' , array('client' => $client , 'i' => $i));
		break;

	case '2':
		echo $this->element('search/client_unit' , array('type' => $client['Client']['contents_type_id'] , 'client' => $client , 'i' => $i));
		break;

	case '3':
		echo $this->element('search/client_unit' , array('type' => $client['Client']['contents_type_id'] , 'client' => $client , 'i' => $i));
		break;

	case '4':
		echo $this->element('search/client_unit' , array('type' => $client['Client']['contents_type_id'] , 'client' => $client , 'i' => $i));
		break;

	case '5':
		echo $this->element('search/client_unit' , array('type' => $client['Client']['contents_type_id'] , 'client' => $client , 'i' => $i));
		break;

	default:
		# code...
		break;
}
?>

<?php 
$i++;
} ?>
<!-- loop end -->


						<!-- unit -->
	<!-- 					<tr>
							<th><a href="#"><img src="/img/search/photo01.jpg" width="148" height="106" alt="" /></a></th>
							<td><p class="pLink clearfix"><span><a href="#">AAA保育園</a></span><span class="textR">タイプ：公立<a href="#"><img src="/img/search/link04.gif" width="58" height="23" alt="詳細" /></a></span></p>
								<p class="text">〒000-0000<br />
									東京都○○区○○1-1-1<br />
									<span>TEL:<span class="color">03-0000-0000</span></span></p></td>
							<td><ul class="clearfix">
									<li><img src="/img/search/imgtext01.gif" width="95" height="93" alt="" /></li>
									<li class="tdTable">
										<table cellpadding="0" cellspacing="0" summary="地域の保育施設">
											<col width="60%" />
											<tbody>
												<tr>
													<th>園の活気</th>
													<td>5</td>
												</tr>
												<tr>
													<th>保育の質</th>
													<td>3</td>
												</tr>
												<tr>
													<th>施設/設備</th>
													<td>4</td>
												</tr>
												<tr>
													<th>教育内容</th>
													<td>4</td>
												</tr>
												<tr>
													<th>周辺環境</th>
													<td>5</td>
												</tr>
											</tbody>
										</table>
									</li>
								</ul>
								<p class="pText clearfix"><span>コメント：<span class="colorBg">32</span>件</span><span class="widthTd">お気に入り：<span class="colorBg colorBg01">60</span>件</span></p></td>
						</tr> -->
						<!-- unit end -->

						<!-- unit -->
<!-- 						<tr>
							<td colspan="3" class="special"></td>
						</tr>
						<tr>
							<th><a href="#"><img src="/img/search/photo02.jpg" width="148" height="106" alt="" /></a></th>
							<td><p class="pLink clearfix"><span><a href="#">BBB保育園</a></span><span class="textR">タイプ：私立<a href="#"><img src="/img/search/link04.gif" width="58" height="23" alt="詳細" /></a></span></p>
								<p class="text">〒000-0000<br />
									東京都○○区○○1-1-1<br />
									<span>TEL:<span class="color">03-0000-0000</span></span></p></td>
							<td><ul class="clearfix">
									<li><img src="/img/search/imgtext02.gif" width="95" height="93" alt="No Data" /></li>
									<li class="tdTable"> <img src="/img/search/img.jpg" width="119" height="92" alt="評価数が不足しています" /> </li>
								</ul>
								<p class="pText clearfix"><span>コメント：<span class="colorBg">-</span>件</span><span class="widthTd">お気に入り：<span class="colorBg colorBg01">-</span>件</span></p></td>
						</tr>
						<tr>
							<td colspan="3" class="special"></td>
						</tr>

						<tr>
							<td colspan="3" class="special"></td>
						</tr>

						<tr>
							<td colspan="3" class="special"></td>
						</tr>

						<tr>
							<td colspan="3" class="special"></td>
						</tr> -->
						<!-- unit end -->

					</tbody>
				</table>
			</div>
			<?php //debug($clients); ?>

	