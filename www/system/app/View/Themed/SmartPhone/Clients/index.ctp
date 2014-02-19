<!-- <link href="/css/search.css" rel="stylesheet" type="text/css" /> -->

<?php echo $this->Html->script("/sp/js/client_search", array('inline'=>false)); ?>
<!-- <script type="text/javascript" src="graph_radar_1_0_2/js/html5jp/graph/radar.js"></script> -->
<?php echo $this->Html->script("graph_radar_1_0_2/html5jp/graph/radar.js", array('inline'=>false)); ?>
<?php echo $this->Html->script("https://maps-api-ssl.google.com/maps/api/js?sensor=false", array('inline'=>false)); ?>
<?php echo $this->Html->css('/sp/css/search', null, array('inline'=>false)); ?>
<?php echo $this->Html->css('/sp/css/common', null, array('inline'=>false)); ?>

<!-- <script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/client_search.js"></script> -->

<style>
.btn {
	cursor: pointer;
}
.inactive {
    filter: alpha(opacity=40);
    opacity: 0.4;
}
</style>

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
	$src = 'img_h2_01.jpg';
}else if($type == 'culture'){
	$src = 'img_h2_03.jpg';
}else if($type == 'community'){
	$src = 'img_h2_04.jpg';
}else if($type == 'medical'){
	$src = 'img_h2_05.jpg';
}else{
	$src = 'img_h2_01.jpg';
}
?>
<ul id="pagePath">
	<li><a href="<?php echo $this->Html->url('/', true); ?>">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout;?></li>
</ul>
<section id="main">
<h2><img src="/sp/img/search/<?php echo $src; ?>" alt="" width="28"><span><?php echo $title_for_layout;?></span></h2>

<div class="map" id="client_all_gmap" width="100%" height="140" style="width:100%;height:140px;"></div>

<?php echo $this->Form->create('search', array('type' => 'get'));?>
<ul class="formSearch clearfix">
	<li>
		<?php echo $this->Form->input( 'client_type_id', array( 
			'type' => 'select',
				'options' => $clientTypes,
				'empty' => 'タイプ',
				'label' => false
				//  'selected' => $selected  // 規定値をvalueで指定
		)); ?>
	</li>
	<li>
		<?php echo $this->Form->input( 'keyword', array( 
			'class' => 'fKeyword',
				'type' => 'text',
				'label' => false
				//  'selected' => $selected  // 規定値をvalueで指定
		)); ?>
	</li>
	<li>
		<input type="image" class="fSearch" name="search" src="/sp/img/search/img_search.gif" width="23" value="" alt="">
	</li>
</ul>
<ul class="link clearfix tabList">
	<?php
		$here = $this->here;
		$here = preg_replace('/\/sort.+$/', '', $here);
	?>
	<li class="on"><a href="<?php echo $here; ?>/sort:created/direction:desc"><img <?php echo ((isset($this->params['named']['sort'])&&($this->params['named']['sort']=='created'))||
		(empty($this->params['named']['sort'])))?'class="inactive"':'active';?> src="/sp/img/search/img_link01_over.jpg" alt="掲載日時順" width="100%"></a></li>
	<li><a href="<?php echo $here; ?>/sort:num_comments/direction:desc"><img <?php echo (isset($this->params['named']['sort'])&&($this->params['named']['sort']=='num_comments'))?'class="inactive"':'active';?> src="/sp/img/search/img_link02_over.jpg" alt="コメント数順" width="100%"></a></li>
	<li><a href="<?php echo $here; ?>/sort:num_likes/direction:desc"><img <?php echo (isset($this->params['named']['sort'])&&($this->params['named']['sort']=='num_likes'))?'class="inactive"':'active';?> src="/sp/img/search/img_link03_over.jpg" alt="お気に入り数順" width="100%"></a></li>
</ul>

<?php echo $this->Form->end(); ?>

<div class="productTab">
	<div class="innerBox">


<!-- loop -->
<?php

if(count($clients) < 1)echo '<h4>検索条件に合うデータが見つかりません</h4>';

 $i = 0;

 foreach($clients as $client){ ?>

<ul class="inner">
	<a href="/clients/view/<?php echo @h($client['Client']['id']);?>">
		<!-- <span class="photoBox">
			<?php if($client['Client']['file_name1']){ ?>
				<img src="/uploads/client/m/<?php echo @h($client['Client']['file_name1']); ?>" width="98" alt="" />
			<?php }else{ ?>
				<img src="/sp/img/common/img01.jpg" width="98" height="63" alt="" />
			<?php } ?>
		</span> -->	
		<span>
			<span class="title">
				<?php echo @h($client['Client']['name']);?>
			</span>
			<li class="text">
				タイプ：<?php echo @h($client['ClientType']['name']);?>
			</li>
				〒<?php echo @$this->Html->pr_zip(h($client['Client']['zip'])); ?><br>
				<?php echo @h($client['Area']['prefecture']).h($client['Client']['address']); ?><br>
				TEL:<?php echo @h($client['Client']['tel']);?>
			</span>
		</span>
	</a>
</ul>

<?php 

//echo $this->element('search/nursery_unit' , array('client' => $client , 'i' => $i));

// switch ($client['Client']['contents_type_id']) {
// 	case '1':
// 		echo $this->element('search/nursery_unit' , array('client' => $client , 'i' => $i));
// 		break;

// 	case '2':
// 		echo $this->element('search/client_unit' , array('client' => $client , 'i' => $i));
// 		break;

// 	case '3':
// 		echo $this->element('search/client_unit' , array('client' => $client , 'i' => $i));
// 		break;

// 	case '4':
// 		echo $this->element('search/client_unit' , array('client' => $client , 'i' => $i));
// 		break;

// 	case '5':
// 		echo $this->element('search/client_unit' , array('client' => $client , 'i' => $i));
// 		break;

// 	default:
// 		# code...
// 		break;
// }





?>
					



<?php 
$i++;
} ?>
<!-- loop end -->

	</div>
</div>

			<?php //debug($clients); ?>


			</section>

	