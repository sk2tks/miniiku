<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/common/js/common.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('admin.js', array('inline'=>false)); ?>
<?php echo $this->Html->script("/common/js/jquery.carouFredSel-5.6.4.js", array('inline'=>false)); ?>
<?php //echo $this->Html->css('client/community2', null, array('inline'=>false)); ?>
<?php echo $this->Html->css('client/area', null, array('inline'=>false)); ?>
<?php echo $this->Html->css('map', null, array('inline'=>false)); ?>
<?php echo $this->Html->css('pic', null, array('inline'=>false)); ?>

<script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?sensor=false"></script>

<?php //debug($this->data);?>

<style>
ul i{
	cursor:pointer;
}
#client_user li{
	width:150px;
}
#client_user li i{
	float:right;
}
#addUser{
	margin:10px 0 0 10px;
}
#latlng label{
	width:30px;
	
	}
#latlng .controls{
	width:auto;
	margin-left:50px;
	margin-bottom:10px;
}

table{
		margin-bottom: 8px;
}

table td , table th{
	border:1px solid #ccc;
	padding:4px;

}

.container input[type=text]{
	width:84%;
}

.container textarea{
	width:84%;
	margin:5px 5px 5px 0;
}

/*fieldset h4{
	background-color: #eee;
	line-height: 48px;
	padding: 0px 5px;
	cursor: pointer;
}*/

fieldset h4 span{
	float:right;
}

/*fieldset .group{
	display:none;
}*/

#conts h3 {
  background: url("/img/client/area/h3_bg.gif") repeat-x scroll left bottom #E8FFE2;
  float: left;
  font-size: 2.2em;
  padding: 6px 15px 4px;
  width: 100%;
}

.pop{
	cursor: pointer;
}

#image_up .control-group{
	width: 88px;
	float: left;
	height: 136px;
}

.map_input button{
	margin:8px;
	padding:3px;
	float:left;
}

.menuList a:hover{
	cursor:pointer;
}

#flashMessage{
	width:950px;
}



</style>

<script>

$(function(){

//未送信チェック

chflg = 0;

$("input , textarea , select").change(function(){
	chflg = 1;
});

//フォーム送信


//タブ切り替え
	$('#clientBox.tabSection .linkUl li a').unbind();
	//carousel_init();
	$('#clientBox .tabBox').hide();
	$('#clientBox.tabSection .tabBox').eq(0).show();
	$('#clientBox.tabSection .linkUl li a').click(function(){
		if((chflg == 0) || (window.confirm('変更が破棄されます。よろしいでしょうか？'))){
			//alert('まだ送信されていません');
			//chflg = 0;
			chflg = 0;
			var ind=$(this).parent('li').index();
		//	location.href = '/mypage?tab=' + ind;
			$(this).parent('li').addClass('on').siblings().removeClass('on');
			$('#clientBox.tabSection .tabBox').hide();		
			$('#clientBox.tabSection .tabBox:eq('+ind+')').show();
			if(ind==1){
			carousel_init();//カルーセルの初期化
			if ('function' === typeof initialize)initialize();//マップの初期化

			//return false;
		}else{
			return false;
				}
		}
		});
		//return false;



	$('#addUser').click(function(){
		$.colorbox({iframe:true, href:'/admin/users/client_user_list', width:550, height:500})
	});
	Uploader.init('/clients/upload');

	$('#addFacilityItem').click(function(){
		if($('#facility_items .item:last-child')[0]){
			lastnum = $('#facility_items .item:last-child').attr('class').replace('del clearfix item item-' , '');
		}else{
			lastnum = -1;
		}
		n = parseInt(lastnum) + 1;
		

		cont = '\<div class="del clearfix item item-'+n+'"\>\<div class="control-group"\>\<div class="controls"\>\<input class="proName" name="data[FacilityInfo]['+n+'][item]" value="" type="text" id="FacilityInfoItem'+n+'"\>\<a class="btn btn-danger"\>\<img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" onclick="deleteItem(this);"/\>\</a\>\</div\>\</div\>\<div class="control-group"\>\<div class="controls"\>\<textarea class="fContent" name="data[FacilityInfo]['+n+'][value]" rows="5" cols="5" id="FacilityInfoValue'+n+'"\>\</textarea\>\</div\>\<input type="hidden" name="data[FacilityInfo]['+n+'][tab]" value="1"\>\</div\>\</div\>';


		if($('#facility_items .item:last-child')[0]){
			$('#facility_items .item:last-child').after(cont);
		}else{
			$('#facility_items .textBox').append(cont);
		}
	});

	$('#addBasicItem').click(function(){
		if($('#basic_items .item:last-child')[0]){
		lastnum = $('#basic_items .item:last-child').attr('class').replace('item item-' , '');
		}else{
			lastnum = 0;
		}
		n = parseInt(lastnum) + 1;
		

		cont='\<tr class="item item-'+n+'"\>\<th\>\<label for="BasicInfoItem'+n+'" class="control-label"\>項目\</label\>\<input name="data[BasicInfo]['+n+'][item]" value="" type="text" size="4" id="BasicInfoItem'+n+'"\>\</th\>\<td colspan="2"\>\<textarea name="data[BasicInfo]['+n+'][value]" rows="3" id="BasicInfoValue'+n+'"\>\</textarea\>';

		cont +='\<a onclick="deleteRow(this);"\>\<img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" "/\>\</a\>\<input type="hidden" name="data[BasicInfo]['+n+'][tab]" value="2"\>\</td\>\</tr\>';

		$('#basic_items table tr:last-child').after(cont);
	});

	$('#addRecruitItem').click(function(){
		lastnum = $('#recruit_items .item:last-child').attr('class').replace('item item-' , '');
		n = parseInt(lastnum) + 1;
		

		cont='\
<div class="item item-'+n+'" style="clear:both;">\
						<div class="del clearfix">\
							<input type="text" value="項目名" name="data[RecruitInfo]['+n+'][item]" class="proName" />\
							<span><a ><img onclick="deleteItem(this);" src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a></span></div>\
						<textarea cols="5" rows="5" name="data[RecruitInfo]['+n+'][value]" class="fContent"></textarea>\
						<input type="hidden" name="data[RecruitInfo]['+n+'][tab]" value="8">\
</div>\
		';


		$('#recruit_items .item:last-child').after(cont);
	});

	$('#addCouponItem').click(function(){
		lastnum = $('#coupon_items .item:last-child').attr('class').replace('item item-' , '');
		n = parseInt(lastnum) + 1;
		lasttokuten = n - 1;
	
		cont='\
								<tr class="item item-'+n+'">\
									<th>特典'+(n-1)+'<a onclick="deleteRow(this);"><img src="/img/client/spot/img01.gif" width="74" height="28" alt="削除" /></a>\
									<input name="data[CouponInfo]['+n+'][item]" value="benefit-'+(n-1)+'" type="hidden" id="CouponInfoItem'+n+'">\
									</th>\
									<td><textarea name="data[CouponInfo]['+n+'][value]" rows="3" id="CouponInfoValue'+n+'"></textarea><input type="hidden" name="data[CouponInfo]['+n+'][tab]" value="8">\
									</td>\
								</tr>\
		';


		$('#coupon_items .item:last-child').after(cont);
	});


	$('#addRow').click(function(){
		lastnum = $('#capacity tr:last-child').attr('class').replace('row row-' , '');
		n = parseInt(lastnum) + 1;
	

		cont = '\
		<tr class="row row-'+n+'">\
										<th class="taLeft">\
											<input style="width:30px;" class="" name="data[Capacity]['+n+'][0]" value="" type="text" id="ClientInfoItem'+n+'"><a onclick="deleteRow(this);"><img src="/img/client/spot/img01.gif" width="66" height="24" alt="削除" /></a>\
										</th>\
										<td>\
											<input class="inputTxt01" name="data[Capacity]['+n+'][1]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input class="inputTxt01" name="data[Capacity]['+n+'][2]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input class="inputTxt01" name="data[Capacity]['+n+'][3]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input class="inputTxt02" name="data[Capacity]['+n+'][4]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
									</tr>\
									';

		$('#capacity tr:last-child').after(cont);
	});

	// $('h4').click(function(){
	// 	$(this).next('div.group').toggle();
	// });

/*popup*/
$(".pop").fancybox({
		'hideOnOverlayClick': true,
		'autoSize': true,
		'scrolling':'no'
	});

/*carousel*/
carousel_init();

});

function sub(elem){
	chflg = 0;
	elem.submit();
}

function addUser(id, name){
	$('#client_user').append('<li>' + name + "　<i class='icon-trash' onclick='removeUser(this);'></i><input type='hidden' name='data[User][]' value='" + id + "'></li>");
	$.colorbox.close();
}

function removeUser(elem){
	if(confirm('本当にこの施設管理者を削除してもよろしいですか？'))
	$(elem).parent('li').remove();
}

function deleteItem(elem){
	if(confirm('本当にこの項目を削除してもよろしいですか？')){
		target = $(elem).parent().parent().parent().parent();
		target.fadeOut('1000' , function(){this.remove();});
	}
}

function deleteRow(elem){
	if(confirm('本当にこの項目を削除してもよろしいですか？')){
		target = $(elem).parent().parent();
		target.fadeOut('1000' , function(){this.remove();});
	}
}

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


</script>


<script>
var mapTitle = "<?php if(!empty($this->data['Client']['name'])) echo $this->data['Client']['name'];?>";
$(function(){
	//initMap();
	initialize();
})
</script>

<script type="text/javascript">
  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();

    var lat = document.getElementById("lat").value;
    var lng = document.getElementById("lng").value;

var latlng = new google.maps.LatLng(lat, lng);
    //var latlng = new google.maps.LatLng(35.689488, 139.691706);
    var myOptions = {
    zoom: 16,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControl: true
//    ,streetViewControl: true
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);

    var centerIcon = new google.maps.Marker({
      icon: image
    });
    var image = new google.maps.MarkerImage(
      '/img/centerMark.gif'
      , new google.maps.Size(39, 39)
      , new google.maps.Point(0,0)
      , new google.maps.Point(19,19)
    );
    var centerIcon = new google.maps.Marker({
      position: latlng,
      icon: image,
      map: map
    });




    function drawMarker(centerLocation){
      centerIcon.setPosition(centerLocation);
    }

    function setCenter_map(){

    var centerd = map.getCenter();

    document.getElementById("lat").value = centerd.lat().toFixed(6);
    document.getElementById("lng").value = centerd.lng().toFixed(6);

    google.maps.event.addListener(map, 'center_changed', function(event) {
      var center = map.getCenter();
      //document.getElementById("lat").value=center.lat().toFixed(6);
      //document.getElementById("lng").value=center.lng().toFixed(6);
      drawMarker(map.getCenter());
    });

    }



  setCenter_map();

  //codeAddress();
  }
  function setAddress(){
    	 var center = map.getCenter();
      document.getElementById("lat").value=center.lat().toFixed(6);
      document.getElementById("lng").value=center.lng().toFixed(6);
    }

  function codeAddress() {

      // kenno = $('#shozaichiken').val();
      // ken = $('#shozaichiken option[value='+kenno+']').text();
      // shono = $('#shozaichicode').val();
      // if(shono){
      //   sho = $('#shozaichicode option[value='+shono+']').text();
      // }else if($('input[name=shozaichicode_name]').val()){
      //   sho = $('input[name=shozaichicode_name]').val();
      // }else{
      //   sho = '';
      // }
      // meisho = $('input[name=shozaichimeisho]').val();
      //address = ken + sho + meisho;
      ken = $('#prefecture option[selected]').text();
      add = $('#address').val();
      add2 = $('#sub_address').val();
      address = ken +'　'+ add;
  
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
      } else {
      //  alert("Geocode was not successful for the following reason: " + status);
        alert("座標が見つかりませんでした。\n「 " + address + "」\n手動で座標を設定してください。" );
      }
    });
  }

  function getCurrentPos(){
  
    function showPosition(position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      $('#lat').val(lat);
      $('#lng').val(lng);
      var latlng = new google.maps.LatLng(lat, lng);

      map.setCenter(latlng);
  
    }
    
    function handleError(error) {
     alert('位置情報が取得出来ません');
    }
  
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition, handleError);
    }
  }
</script>


<?php if(isset($error) && ($error == 'not_owner')){ ?>

<p>オーナーではありません</p>

<?php }else{ ?>


		<?php /*echo $this->Form->create('Client', array('class' => 'form-horizontal' ,'inputDefaults' => array(
        //'label' => false,
        'div' => false
    )));
*/
    ?>
			
				<?php if($isEdit): ?>

				<?php else: ?>

				<?php endif; ?>
				<?php
				echo $this->Form->hidden('id');
				//echo $this->Form->input('status', array('type'=>'radio','options'=>MasterOption::$userStatus , 'default'=>0));
				//echo $this->Form->hidden('id');
				//echo $this->Form->input('name');
				//echo $this->Form->input('kana');
				//echo $this->Form->input('contents_type_id', array('empty'=>'選択してください','id'=>'contents_type' , 'value'=>$ctype , 'type'=>'hidden'));
				//echo $this->Form->input('client_type_id', array('type'=>'select' , 'options' => $clientTypes , 'empty' => '選択して下さい', 'id'=>'client_type'));
				?>
				<!-- <div class="control-group <?php if($this->Form->error('zip')) echo ' error'; ?>">
						<label class="control-label" for="appendedInputButtons">郵便番号</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this->Form->input('zip', 
									array('class'=>'span4', 'size'=>'7','maxLength'=>'7', 'div'=>false,'label'=>false, 'id'=>'zip', 'error'=>false));  ?> 
								<button class="btn btn-warning " type="button" id='get_zip_info'>郵便番号から情報を設定する</button>
						
							</div>
							<?php echo $this->Form->error('zip'); ?>
						</div>
						
				</div> -->
				<?php
				// echo $this->Form->input('representative');
				// echo $this->Form->input('position');
				// echo $this->Form->input('tel');
				// echo $this->Form->input('fax');
				// echo $this->Form->input('url');
				// echo $this->Form->input('mail');
				// echo $this->Form->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください'));
				// echo $this->Form->input('address', array('id'=>'address', 'class'=>'input-xlarge'));
				// echo $this->Form->input('sub_address', array('label'=>'建物名以下','id'=>'sub_address', 'class'=>'input-xlarge'));
				// echo $this->Form->input('municipal_id', array('id'=>'municipal','empty'=>'選択してください'));
				// echo $this->Form->input('area_id', array('id'=>'area', 'empty'=>'選択してください'));

				if(!$isEdit){

				$selected = array(1,2,6,7,8);

				// echo $this->Form->input('display_tabs', array(
				// 	'multiple'=>'checkbox' ,
				// 	'label'=>'表示タブ',
				// 	'options' => $tabs,
				// 	'selected' => $selected
				// 	)
				// );

				}else{

				// echo $this->Form->input('display_tabs', array(
				// 	'multiple'=>'checkbox' ,
				// 	'label'=>'表示タブ',
				// 	'options' => $tabs,
				// 	)
				// );


				}

						if(!$isEdit){
							if($ctype=='1'){
								$pr_sel = 1;
							}else if($ctype=='3'){
								$pr_sel = 3;
							}else{
								$pr_sel = 2;
							}
						}else{
							$pr_sel = $this->data['Client']['publicity_range'];
						}

				//echo $this->Form->input('publicity_range', array('type'=>'select', 'options'=>MasterOption::$publicity_ranges, 'empty'=>'選択してください' , 'selected' => $pr_sel));
?>


	</li>



<div id="index2">
<?php echo $this->Session->flash(); ?>
<?php
$client = array();
 $client['Client'] = $this->data['Client'];?>


<div id="clientBox" class="tabSection cid-<?php echo $this->data['Client']['contents_type_id'];?>">

<!-- <div id="clientBox" class="tabSection cid-1"> -->

				<ul class="linkUl clearfix">
					<li class="tab02 on"><a>施設紹介</a></li>
					<li class="tab01"><a>基本情報</a></li>
				<?php if($ctype == 1){ ?>
					<li class="tab03"><a>定員情報</a></li>
				<?php } ?>
					<!-- <li class="tab04"><a>評価・コメント</a></li> -->
					<li class="tab05"><a>職員募集</a></li>
				</ul>

<div class="tabInner">

<div class="tabBox">
			<?php echo $this->Form->create('Client', array(
				'class' => 'form-horizontal',
				'id' => 'ClientFacility',
					'inputDefaults' => array(
        	'label' => false,
        	'div' => false
    			)
				)
			);
				echo $this->Form->hidden('id');
				echo $this->Form->hidden('form_tab' , array('value' => '2'));
				echo $this->Form->hidden('data_tab' , array('value' => '1'));
    ?>

<div id="facility" class="features group">

<div class="comBox clearfix">
				<h3>
					<!-- <INPUT type="text" size="53" value="AAA団体" name="txt"> -->
						<span style="font-size:11px;">名称</span><?php echo $this->Form->input('name' , array('size'=>'24' , 'label'=>false));?>
						<span style="font-size:11px;">かな</span><?php echo $this->Form->input('kana' , array('size'=>'24' , 'label'=>false));?>
				</h3>
				<!-- <div class="textImg"><a href="#"><img src="/img/client/area/imgtext_.jpg" width="55" height="45" alt="お気に入り" /></a>
				</div> -->
</div>
	
<div class="control-group">

	<div id="facility_items">
	
				<?php

if($isEdit){
	//$facility_info = $this->data['FacilityInfo'];
}else if(!empty($this->data['FacilityInfo'])){//投稿エラーで戻った時など
	$facility_info = $this->data['FacilityInfo'];
}
?>

	<ul class="menuList clearfix">
							<li><a id='addFacilityItem'><img src="/img/client/area/area_link06.gif" alt="項目を追加" width="173" height="28" /></a></li>
							<!-- <li><span class="pop" id="open_pic" href="#tuuen_pic"><img src="/img/client/area/area_link07.gif" alt="写真の編集" width="173" height="28" /></a></li> -->
							<li><a onclick="$('form#ClientFacility')[0].reset();"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientFacility').submit();"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
	</ul>
						<div class="features clearfix">

						<div class="photoBox">
								<div class="topImg"><img src="/img/client/area/top_img.gif" width="353" height="9" alt="" /></div>
								<div class="photoList">
									<ul class="linkPhoto clearfix">
										<?php for($i=1;$i<9;$i++){
											?>
										<li><a href="#"><?php if(!empty($client['Client']['file_name'.$i])){ ?><img src="/uploads/client/m/<?php echo $client['Client']['file_name'.$i];?>" alt="" /><?php }else{ echo '<img src="/img/no_image.jpg" width="338" />'; } ?></a></li>
										<?php } ?>
	
									</ul>
									<div class="btnBox clearfix">
										<div class="floatL prev"><a href="#"><img src="/img/client/area/btn01.gif" width="25" height="25" alt="" /></a></div>
										<!-- <p>AAA施設建物全体</p> -->
										<div class="floatR next"><a href="#"><img src="/img/client/area/btn02.gif" width="26" height="26" alt="" /></a></div>
									</div>
									<ul class="photo clearfix">
										<?php for($i=1;$i<9;$i++){
											?>
										<li><?php if(!empty($client['Client']['file_name'.$i])){ ?>
											<img src="/uploads/client/t/<?php echo $client['Client']['file_name'.$i];?>" width="81" height="59" alt="" />
											<?php }else
{ echo '<img src="/img/no_image.jpg" width="81" height="59"/>'; }
											 ?>
										</li>
										<?php } ?>
									</ul>
								</div>
								<div class="btmImg"><img src="/img/client/area/btm_img.gif" width="353" height="8" alt="" /></div>

<div id="image_up" style="">
<div class="group">
<?php
		for($i=1; $i<=8; $i++):
					echo $this->element('admin/upload_element_owner', 
						array('data'=>!empty($this->data['Client']) ? $this->data['Client'] : array(),
							'dir'=>CLIENT_DIR,
							'thumb'=>'t',
							'title'=>'画像'.$i ,
							'file_name'=>'file_name'.$i,
							'uploaded'=>'uploaded'.$i,
							'deleted'=>'deleted'.$i
							));
				endfor;
?>
</div>
</div>

</div>
		<!-- 					
							<div class="photoBox">
								<div class="topImg"><img src="/img/client/area/top_img.gif" width="353" height="9" alt="" /></div>
								<div class="photoList">
									<ul class="linkPhoto clearfix">
										<li><a href="#"><img src="/img/client/area/ind2_photo01.jpg" width="338" height="254" alt="" /></a></li>
	
									</ul>
									<div class="btnBox clearfix">
										<div class="floatL prev"><a href="#"><img src="/img/client/area/btn01.gif" width="25" height="25" alt="" /></a></div>
										<p>AAA施設建物全体</p>
										<div class="floatR next"><a href="#"><img src="/img/client/area/btn02.gif" width="26" height="26" alt="" /></a></div>
									</div>
									<ul class="photo clearfix">
										<li><img src="/img/client/area/ind2_s_photo01.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo02.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo03.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo04.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo05.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo06.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo07.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/area/ind2_s_photo08.jpg" width="81" height="59" alt="" /></li>
									</ul>
								</div>
								<div class="btmImg"><img src="/img/client/area/btm_img.gif" width="353" height="8" alt="" /></div>
							</div> -->


	<!-- 						<div class="textBox">
								<h4>特 徴</h4>
								<div class="del clearfix">
									<textarea cols="5" rows="5" name="body" class="fContent">施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について</textarea>
								</div>
								<div class="del clearfix">
									<input type="text" value="運営者より" name="proname" class="proName" />
									<a href="#"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a>
									<textarea cols="5" rows="5" name="body" class="fContent">施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について</textarea>
								</div>
								<div class="del clearfix">
									<input type="text" value="項目名" name="proname" class="proName" />
									<a href="#"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a>
									<textarea cols="5" rows="5" name="body" class="fContent"></textarea>
								</div>
							</div> 
						</div>-->


<div class="textBox">
<?php

				//echo $this->Form->input('info', array('type'=>'textarea','class'=>'input-xlarge'));
				//echo $this->Form->input('character', array('type'=>'textarea','class'=>'input-xlarge'));

?>
<h4>紹 介</h4>
<div class="del clearfix">

								<div class="control-group">
									<div class="controls">
										<?php echo $this->Form->input('info', array('type'=>'textarea','class'=>'fContent' , 'rows'=>'5' , 'cols'=>'5' , 'label' => false));?>
									</div>
								</div>
</div>
<h4>特 徴</h4>
<div class="del clearfix">

								<div class="control-group">
									<div class="controls">
										<?php echo $this->Form->input('character', array('type'=>'textarea','class'=>'fContent' , 'rows'=>'5' , 'cols'=>'5' , 'label' => false));?>
									</div>
								</div>
</div>
<?php

//debug($this->data['FacilityInfo']);
if(isset($facility_info) && (count($facility_info)>0)){
				$i = 0;
				foreach($facility_info as $item){
					echo '<div class="del clearfix item item-'.$i.'">';
					?>
								<div class="control-group">
									<label for="FacilityInfoItem<?php echo $i; ?>" class="control-label">項目</label>
									<div class="controls">
										<input class="proName" name="data[FacilityInfo][<?php echo $i; ?>][item]" value="<?php echo $facility_info[$i]['item']; ?>" type="text" id="FacilityInfoItem<?php echo $i; ?>">

									</div>
								</div>
								<div class="control-group">
									<label for="FacilityInfoValue<?php echo $i; ?>" class="control-label">内容</label>
									<div class="controls">
										<textarea class="fContent" name="data[FacilityInfo][<?php echo $i; ?>][value]" rows="5" cols="5" id="FacilityInfoValue<?php echo $i; ?>"><?php echo @$facility_info[$i]['value'];?></textarea>
										<a class="btn btn-danger"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" onclick="deleteItem(this);"/></a>
									</div>
									<input type="hidden" name="data[FacilityInfo][<?php echo $i; ?>][tab]" value="1">
								</div>

					<?php
					//echo $this->Form->input('ClientInfo.item.'.$i , array('label'=>'項目' , 'value'=>$facility_info[$ctype][$i]));
					//echo $this->Form->input('ClientInfo.value.'.$i , array('type' => 'textarea' , 'label'=>'内容'));
				$i++;
					echo '</div>';
				}
}
				?>
			</div>
	</div>

				<!-- <div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addFacilityItem'>＋項目を追加</a>
				</div>
 -->	</div>




		</div>
	</div>
	<?php echo $this->Form->end();?>
</div><!-- end tabBox -->

<div class="tabBox"><!-- 基本情報 -->

			<?php echo $this->Form->create('Client', array(
				'class' => 'form-horizontal',
				'id' => 'ClientBasic',
					'inputDefaults' => array(
        	'label' => false,
        	'div' => false
    			)
				)
			);
				echo $this->Form->hidden('id');
				echo $this->Form->hidden('form_tab' , array('value' => '1'));
				echo $this->Form->hidden('data_tab' , array('value' => '2'));
    ?>



						<ul class="menuList clearfix">
							<li><a id='addBasicItem'><img src="/img/client/area/area_link06.gif" alt="項目を追加" width="173" height="28" /></a></li>
							<!-- <li><span class="pop" href="#tuuen"><img src="/img/client/area/area_link13.gif" alt="位置情報を登録" width="173" height="28" /></span></li> -->
							<li><a onclick="$('form#ClientBasic')[0].reset();"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientBasic').submit();"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
						</ul>

					
					<div class="group" id="basic_items">
						
							<div>
									<?php

					if($isEdit){
						//$basic_info = $this->data['BasicInfo'];
					}else if(!empty($this->data['BasicInfo'])){//投稿エラーで戻った時など
						$basic_info = $this->data['BasicInfo'];
					}
?>

				<table cellpadding="0" cellspacing="0" summary="基本情報">
					<col width="14%" />
					<col width="42%" />
					<tbody>
								<tr>
									<th class="heiSpecial">
										<!-- <INPUT type="text" size="4" value="住所" name="txt"> -->
										住所
										</th>
									<td class="heiSpecial">〒
										<!-- <INPUT type="text" size="10" value="000-0000" name="txt"> -->
													<div class="control-group <?php if($this->Form->error('zip')) echo ' error'; ?>">
															<div class="controls">
																<div class="input-append">
																	<?php echo $this->Form->input('zip', 
																		array('class'=>'span4', 'size'=>'7','maxLength'=>'7', 'div'=>false,'label'=>false, 'id'=>'zip', 'error'=>false));  ?> 
																	<button class="btn btn-warning " type="button" id='get_zip_info'>郵便番号から情報を設定する</button>
															
																</div>
																<?php echo $this->Form->error('zip'); ?>
															</div>
						
													</div>
										<br />
											<?php echo $this->Form->input('address', array('id'=>'address', 'class'=>'' , 'size' => '18' , 'label' => false));?>
										</td>
									<td class="tdSpecial" rowspan="5">

<!-- map -->
			<div class="control-group map_input">

					<div class="controls" >	
	
					<div id='latlng'>
		            <?php echo $this->Form->input('Client.lat',array('id'=>'lat','size'=>'10','maxlength'=>'20','label'=>'緯度' , 'div' => false));?>
		            <?php echo $this->Form->input('Client.lng',array('id'=>'lng','size'=>'10','maxlength'=>'20','label'=>'経度', 'div' => false));?>
		          </div>
		              <p><button><span class='btn  btn-danger' onclick='codeAddress();return false;'>住所からGoogleマップを設定する</span></button>
		              <p><button><span class='btn  btn-success' onclick='setAddress();return false;'>この位置に設定する</span></button>
		            	
		            
		            <div id="map" width="360" height="270" style="width:360px;height:270px;"></div>
		            <div style='margin-top:15px;'>
		            <label><!-- <input type='checkbox' id='clickPoint' style='margin:3px 3px 5px 0px;'/> --></label>
		            </div>
	
		      </div>
		      
			</div>
<!-- /map -->

										<!-- <iframe width="360" height="270" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.jp/maps?client=firefox-a&amp;hl=ja&amp;q=%E6%9D%B1%E4%BA%AC%E9%83%BD+%E5%9C%B0%E5%9B%B3&amp;ie=UTF8&amp;hq=&amp;hnear=%E6%9D%B1%E4%BA%AC%E9%83%BD&amp;gl=jp&amp;t=m&amp;brcurrent=3,0x60188d2059b7fd4b:0xec61c68fe232efd2,0&amp;z=13&amp;iwloc=A&amp;output=embed"></iframe>
										<br />
										<small><a href="https://maps.google.co.jp/maps?client=firefox-a&amp;hl=ja&amp;q=%E6%9D%B1%E4%BA%AC%E9%83%BD+%E5%9C%B0%E5%9B%B3&amp;ie=UTF8&amp;hq=&amp;hnear=%E6%9D%B1%E4%BA%AC%E9%83%BD&amp;gl=jp&amp;t=m&amp;brcurrent=3,0x60188d2059b7fd4b:0xec61c68fe232efd2,0&amp;z=13&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">大きな地図で見る</a></small><br />
										位置情報は「位置情報を登録」ボタンより変更できます。 -->



									</td>
								</tr>
								<tr>
									<th>都道府県</th>
									<td><?php echo $this->Form->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください', 'label' => false));?></td>
								</tr>
								<tr>
									<th>市区町村</th>
									<td><?php echo $this->Form->input('municipal_id', array('label'=>'建物名以下','id'=>'sub_address', 'class'=>'input-xlarge', 'label' => false));?></td>
								</tr>
								<tr>
									<th>地区</th>
									<td><?php echo $this->Form->input('area_id', array('id'=>'area', 'empty'=>'選択してください', 'label' => false));?></td>
								</tr>
								<tr>
									<th>建物名以下</th>
									<td><?php echo $this->Form->input('sub_address', array('label'=>'建物名以下','id'=>'sub_address', 'class'=>'input-xlarge', 'label' => false));?></td>
								</tr>
								<tr>
									<th>TEL</th>
									<td colspan="2"><?php echo $this->Form->input('tel', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>
								<tr>
									<th>FAX</th>
									<td colspan="2"><?php echo $this->Form->input('fax', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>
								<tr>
									<th>代表者</th>
									<td colspan="2"><?php echo $this->Form->input('representative', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>
								<tr>
									<th>代表者肩書</th>
									<td colspan="2"><?php echo $this->Form->input('position', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>

								<tr>
									<th>施設タイプ</th>
									<td colspan="2"><?php echo $this->Form->input('client_type_id', array('type'=>'select' , 'options' => $clientTypes , 'empty' => '選択して下さい', 'id'=>'client_type' , 'label' => false));?></td>
								</tr>

								<tr>
									<th>e-mail</th>
									<td colspan="2"><?php echo $this->Form->input('mail', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>

								<tr>
									<th>URL</th>
									<td colspan="2"><?php echo $this->Form->input('url', array('id'=>'', 'class'=>'' , 'size' => '18' , 'label' => false));?></td>
								</tr>



<?php
					//debug($this->data['BasicInfo']);
					if(!empty($basic_info)){
									$i = 0;
									foreach($basic_info as $item){
										?>

								<tr class="item item-<?php echo $i;?>">
									<th>
										<label for="BasicInfoItem<?php echo $i; ?>" class="control-label">項目</label>
										<input name="data[BasicInfo][<?php echo $i; ?>][item]" value="<?php echo $basic_info[$i]['item']; ?>" type="text" size="4" id="BasicInfoItem<?php echo $i; ?>">
										<a onclick='deleteRow(this);'><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a>
										</th>
									<td colspan="2">
										<textarea name="data[BasicInfo][<?php echo $i; ?>][value]" rows="3" id="BasicInfoValue<?php echo $i; ?>"><?php echo @$basic_info[$i]['value'];?></textarea>
										
										<input type="hidden" name="data[BasicInfo][<?php echo $i; ?>][tab]" value="2">
									</td>
								</tr>



												<!-- 	<div class="control-group">
														<label for="BasicInfoItem<?php echo $i; ?>" class="control-label">項目</label>
														<div class="controls">
															<input name="data[BasicInfo][<?php echo $i; ?>][item]" value="<?php echo $basic_info[$i]['item']; ?>" type="text" id="BasicInfoItem<?php echo $i; ?>">

														</div>
													</div>
													<div class="control-group">
														<label for="BasicInfoValue<?php echo $i; ?>" class="control-label">内容</label>
														<div class="controls">
															<textarea name="data[BasicInfo][<?php echo $i; ?>][value]" rows="3" id="BasicInfoValue<?php echo $i; ?>"><?php echo @$basic_info[$i]['value'];?></textarea>
															<a class="btn btn-danger"><i class='icon-trash' onclick='deleteItem(this);'></i></a>
														</div>
														<input type="hidden" name="data[BasicInfo][<?php echo $i; ?>][tab]" value="2">
													</div> -->

										<?php
										//echo $this->Form->input('ClientInfo.item.'.$i , array('label'=>'項目' , 'value'=>$basic_info[$ctype][$i]));
										//echo $this->Form->input('ClientInfo.value.'.$i , array('type' => 'textarea' , 'label'=>'内容'));
									$i++;
										
									}
					}
									?>
						</div>

							</tbody>
						</table>

									<!-- <div class="controls">
										<a class="btn btn-success" href="javascript:void(0);" id='addBasicItem'>＋項目を追加</a>
									</div> -->

					</div>
</div>
<?php echo $this->Form->end();?>
</div><!-- end tabBox -->

<?php
if($ctype == 1){//保育施設のみ

if(!empty($this->data['Capacity'])){
	$capacity_info = $this->data['Capacity'];
}

?>

<div class="tabBox">

				<ul class="menuList clearfix">
							<li><a id='addRow'><img src="/img/client/area/area_link06.gif" alt="行を下に追加" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientCapacity')[0].reset();"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientCapacity').submit();"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
				</ul>


			<?php echo $this->Form->create('Client', array(
				'class' => 'form-horizontal',
				'id' => 'ClientCapacity',
					'inputDefaults' => array(
        	'label' => false,
        	'div' => false
    			)
				)
			);
				echo $this->Form->hidden('id');
				echo $this->Form->hidden('form_tab' , array('value' => '3'));
				echo $this->Form->hidden('data_tab' , array('value' => '6'));
    ?>

<div class="group" id="capacity">

<div class="control-group">
	
	<label class="control-label" for="">定員情報</label>
	
		<div class="controls">
		<table cellspacing="2" cellpadding="2" summary="定員情報" class="tableBox" style="">
							<colgroup><col width="13%">
							<col width="15%">
							<col width="15%">
							<col width="15%">
							</colgroup><tbody>
								<tr>
		
									<th>年齢</th>
									<th>定員数</th>
									<th>在籍者数</th>
									<th>待機児童数</th>
									<th>備考</th>
								</tr>
								<?php $i = 0; foreach ($capacity_info as $row) {?>
									<tr class="row row-<?php echo $i;?>">
										<th class="taLeft">
											<input style="width:30px;" class="" name="data[Capacity][<?php echo $i; ?>][0]" value="<?php echo @$row[0]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>"><a  onclick='deleteRow(this);'><img src="/img/client/spot/img01.gif" width="66" height="24" alt="削除" /></a>
										</th>
										<td>
											<input class="inputTxt01" name="data[Capacity][<?php echo $i; ?>][1]" value="<?php echo @$row[1]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input class="inputTxt01" name="data[Capacity][<?php echo $i; ?>][2]" value="<?php echo @$row[2]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input class="inputTxt01" name="data[Capacity][<?php echo $i; ?>][3]" value="<?php echo @$row[3]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input class="inputTxt02" name="data[Capacity][<?php echo $i; ?>][4]" value="<?php echo @$row[4]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
									</tr>
								<?php $i++;} ?>

							</tbody>
						</table>
					</div>

					<!-- <div class="controls">
						<a class="btn btn-success" href="javascript:void(0);" id='addRow'>＋項目を追加</a>
					</div> -->

	</div>
</div>
<?php echo $this->Form->end();?>
</div><!-- end tabBox -->

<?php } ?>

<div class="tabBox">
			<?php echo $this->Form->create('Client', array(
				'class' => 'form-horizontal',
				'id' => 'ClientRecruitCoupon',
					'inputDefaults' => array(
        	'label' => false,
        	'div' => false
    			)
				)
			);
				echo $this->Form->hidden('id');
				echo $this->Form->hidden('form_tab' , array('value' => '5'));
				echo $this->Form->hidden('data_tab' , array('value' => '8'));


    ?>



<?php if($ctype == 1) { ?>

				<ul class="menuList clearfix">
							<li><a id='addRecruitItem'><img src="/img/client/area/area_link06.gif" alt="行を下に追加" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientRecruitCoupon')[0].reset();"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientRecruitCoupon').submit();"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
				</ul>

<div id="recruit_items" class="group">

<div class="control-group">

	<ul class="listNavi clearfix">
				<?php

if(!empty($this->data['RecruitInfo'])){//投稿エラーで戻った時など
	$recruit_info = $this->data['RecruitInfo'];
}

//debug($this->data);

				$i = 0;
				foreach($recruit_info as $item){
					echo '<div class="item item-'.$i.'">';
					?>





							<li>
<!-- 								<div class="control-group">
								
									<div class="controls">
										<input name="data[RecruitInfo][<?php echo $i; ?>][item]" value="<?php echo $recruit_info[$i]['item']; ?>" type="<?php echo ($i<6)?'hidden':'text';?>" id="RecruitInfoItem<?php echo $i; ?>">

									</div>
								</div> -->
								<div class="control-group">

									<h4><label for="RecruitInfoValue<?php echo $i; ?>" class="control-label"><?php echo ($i<6)?$recruit_info[$i]['item']:''; ?></label>
										<input name="data[RecruitInfo][<?php echo $i; ?>][item]" value="<?php echo $recruit_info[$i]['item']; ?>" type="<?php echo ($i<6)?'hidden':'text';?>" id="RecruitInfoItem<?php echo $i; ?>">
										
									</h4>
									<div class="controls">
										<textarea class="fContent" name="data[RecruitInfo][<?php echo $i; ?>][value]" cols="5" rows="5" id="RecruitInfoValue<?php echo $i; ?>"><?php echo @$recruit_info[$i]['value'];?></textarea>
										<?php if($i>=6){?><!-- オプション項目 -->
										<a onclick='deleteItem(this);'>
											<img width="73" height="29" alt="削 除" src="/img/client/area/area_link15.gif">
										</a>
										<?php } ?>

									</div>
									<input type="hidden" name="data[RecruitInfo][<?php echo $i; ?>][tab]" value="8">
								</div>
							</li>

					<?php
							$i++;
								echo '</div>';
								//if(!($i%2))echo '</ul><ul class="listNavi clearfix">';
				}

				?>
			</ul>
	</div>

				<!-- <div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addRecruitItem'>＋項目を追加</a>
				</div> -->
</div>

</div><!-- end tabBox -->

<?php }else if($ctype == 2){
//クーポンはスポットのみ?>



<div id="coupon_items" class="group">

				<?php

if(!empty($this->data['CouponInfo'])){//投稿エラーで戻った時など
	$coupon_info = $this->data['CouponInfo'];
}
?>

<ul class="menuList clearfix">
							<li><a id='addCouponItem'><img src="/img/client/area/area_link06.gif" alt="項目を追加" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientRecruitCoupon')[0].reset();"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a onclick="$('form#ClientRecruitCoupon').submit();"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
</ul>

<table class="tableA" cellpadding="0" cellspacing="0" summary="基本情報">
							<col width="10%" />
							<col width="90%" />
							<tbody>
								<tr>
									<th class="thSpecial">期間</th>
									<td>
										<input name="data[CouponInfo][0][item]" value="期間1" type="hidden" />
										<!-- <input  type="text" value="2013年10月1日" name="name" /> -->
										<input name="data[CouponInfo][0][value]" id="CouponInfoValue0" value="<?php echo @$coupon_info[0]['value'];?>">
										<input type="hidden" name="data[CouponInfo][0][tab]" value="8">


										<span><img src="/img/client/spot/img02.gif" width="37" height="25" alt="" /></span>～
										<input name="data[CouponInfo][1][item]" value="期間2" type="hidden" />
										<!-- <input  type="text" value="2013年10月1日" name="name" /> -->
										<input name="data[CouponInfo][1][value]" id="CouponInfoValue1" value="<?php echo @$coupon_info[1]['value'];?>">
										<input type="hidden" name="data[CouponInfo][1][tab]" value="8">
										<span><img src="/img/client/spot/img02.gif" width="37" height="25" alt="" /></span></td>
								</tr>

<!-- 								<tr>
									<th>特典2<span><a href="#"><img src="/img/client/spot/img01.gif" width="74" height="28" alt="削除" /></a></span></th>
									<td><textarea name="content" cols="5" rows="5">期間限定2013年11月から先着1000名様入賞料10％OFFに致します。</textarea></td>
								</tr>
								<tr>
									<th>特典3<span><a href="#"><img src="/img/client/spot/img01.gif" width="74" height="28" alt="削除" /></a></span></th>
									<td><textarea name="content" cols="5" rows="5">期間限定2013年11月から先着1000名様入賞料10％OFFに致します。</textarea></td>
								</tr> -->
						



<?php 
				$i = 0;
				foreach($coupon_info as $item){

					if(($coupon_info[$i]['item']=='期間1')||($coupon_info[$i]['item']=='期間2')){
						$i++;
						continue;
					}
					?>
<!-- 
								<div class="control-group">

									<label for="CouponInfoValue<?php echo $i; ?>" class="control-label"><?php echo $coupon_info[$i]['item']; ?></label>
									<div class="controls">
										<input name="data[CouponInfo][<?php echo $i; ?>][item]" value="<?php echo @$coupon_info[$i]['item'];?>" type="hidden">
										<input name="data[CouponInfo][<?php echo $i; ?>][value]" id="CouponInfoValue<?php echo $i; ?>" value="<?php echo @$coupon_info[$i]['value'];?>">
		
									</div>
									<input type="hidden" name="data[CouponInfo][<?php echo $i; ?>][tab]" value="9">
								</div> -->


					<?php 
						//}else{
					?>
								<tr class="item item-<?php echo $i;?>">
									<th><?php echo '特典'.($i-1); ?><a onclick='deleteRow(this);'><img src="/img/client/spot/img01.gif" width="74" height="28" alt="削除" /></a>
									<input name="data[CouponInfo][<?php echo $i; ?>][item]" value="<?php echo 'benefit-'.($i-1); ?>" type="hidden" id="CouponInfoItem<?php echo $i; ?>">
									</th>
									<td><textarea name="data[CouponInfo][<?php echo $i; ?>][value]" rows="3" id="CouponInfoValue<?php echo $i; ?>"><?php echo @$coupon_info[$i]['value'];?></textarea>
									<input type="hidden" name="data[CouponInfo][<?php echo $i; ?>][tab]" value="8">
									</td>
								</tr>
					<?php
					//}
				$i++;?>
				<?php } ?>

	</tbody>
						</table>
						<div class="map_k">
						<!-- <iframe width="730" height="250" frameborder="0" 
												scrolling="no" marginheight="0" marginwidth="0" 
												rel="https://maps.google.co.jp/maps?q=<?php echo h($this->data['Client']['lat']);?>,<?php echo h($this->data['Client']['lng']);?>&hl=ja&spn=3,6&z=17&output=embed&ll=<?php echo h($this->data['Client']['lat']);?>,<?php echo h($this->data['Client']['lng']);?>">
												</iframe><br /><small><a 
												href="http://maps.google.co.jp/maps?q=<?php echo h($this->data['Client']['lat']);?>,<?php echo h($this->data['Client']['lng']);?>+(<?php echo h($this->data['Client']['name']);?>)&hl=ja&spn=1.612832,3.120117&z=15" t
												arget="_blank" style="color:#ff8800;text-align:left">*大きな地図で見る
												</a></small> -->
						</div>

				<!-- <div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addCouponItem'>＋項目を追加</a>
				</div> -->
</div>
<?php } ?>

<?php echo $this->Form->end();?>
</div><!-- end tabBox -->


</div>



<!-- 				<div class="control-group">
					<label for="ClientFileName8" class="control-label">施設管理者</label>
					<div class="controls" >
						<ul id='client_user'>
							<?php if(!empty($this->data['User'])): ?>
							<?php foreach($this->data['User'] as $user): ?>
								<li><?php echo $user['name']; ?>　<i class='icon-trash' onclick='removeUser(this);'></i><?php echo $this->Form->hidden('User.', array('value'=>$user['id'])); ?></li>
							<?php endforeach; ?>
							<?php endif; ?>
						</ul>
						<a class="btn btn-small" href="javascript:void(0);" id='addUser'><i class="icon-user"></i> 施設管理者を追加</a>
						
					</div>
				</div> -->
				
				
			
		<?php //echo $this->Form->end();?>

</div>

</div>



<!-- source 


<div id="clientBox" class="tabSection cid-4">
				<ul class="linkUl linkUl01 clearfix">
					<li class="tab02 on"><a href="#">団体紹介</a></li>
					<li class="tab01"><a href="#">基本情報</a></li>
					<li class="tab04"><a href="#">評価・コメント</a></li>
					<li class="tab05"><a href="#">お問合せ</a></li>
				</ul>
				<div class="tabInner">
					<div class="tabBox">
						<ul class="menuList clearfix">
							<li><a href="#"><img src="/img/client/area/area_link06.gif" alt="項目を追加" width="173" height="28" /></a></li>
							<li><a href="../pic.html"><img src="/img/client/area/area_link07.gif" alt="写真の編集" width="173" height="28" /></a></li>
							<li><a href="#"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a href="#"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
						</ul>
						<div class="features clearfix">
							<div class="photoBox">
								<div class="topImg"><img src="/img/client/area/top_img.gif" width="353" height="9" alt="" /></div>
								<div class="photoList">
									<ul class="linkPhoto clearfix">
										<li><a href="#"><img src="/img/client/community/ind2_photo01.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo02.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo03.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo04.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo05.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo06.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo07.jpg" width="338" height="254" alt="" /></a></li>
										<li><a href="#"><img src="/img/client/community/ind2_photo08.jpg" width="338" height="254" alt="" /></a></li>
									</ul>
									<div class="btnBox clearfix">
										<div class="floatL prev"><a href="#"><img src="/img/client/area/btn01.gif" width="25" height="25" alt="" /></a></div>
										<p>AAA施設建物全体</p>
										<div class="floatR next"><a href="#"><img src="/img/client/area/btn02.gif" width="26" height="26" alt="" /></a></div>
									</div>
									<ul class="photo clearfix">
										<li><img src="/img/client/community/ind2_s_photo01.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo02.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo03.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo04.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo05.jpg" width="81" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo06.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo07.jpg" width="82" height="59" alt="" /></li>
										<li><img src="/img/client/community/ind2_s_photo08.jpg" width="81" height="59" alt="" /></li>
									</ul>
								</div>
								<div class="btmImg"><img src="/img/client/area/btm_img.gif" width="353" height="8" alt="" /></div>
							</div>
							<div class="textBox">
								<h4>特 徴</h4>
								<div class="del clearfix">
									<textarea cols="5" rows="5" name="body" class="fContent">施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について</textarea>
								</div>
								<div class="del clearfix">
									<input type="text" value="運営者より" name="proname" class="proName" />
									<a href="#"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a>
									<textarea cols="5" rows="5" name="body" class="fContent">施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について施設の特徴について</textarea>
								</div>
								<div class="del clearfix">
									<input type="text" value="項目名" name="proname" class="proName" />
									<a href="#"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a>
									<textarea cols="5" rows="5" name="body" class="fContent"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="tabBox">
						<ul class="menuList clearfix">
							<li><a href="#"><img src="/img/client/area/area_link06.gif" alt="項目を追加" width="173" height="28" /></a></li>
							<li><a href="../map.html"><img src="/img/client/area/area_link13.gif" alt="位置情報を登録" width="173" height="28" /></a></li>
							<li><a href="#"><img src="/img/client/area/area_link08.gif" alt="キャンセル" width="173" height="28" /></a></li>
							<li><a href="#"><img src="/img/client/area/area_link09.gif" alt="登 録" width="173" height="28" /></a></li>
						</ul>


						<table cellpadding="0" cellspacing="0" summary="基本情報">
							<col width="14%" />
							<col width="42%" />
							<tbody>
								<tr>
									<th class="heiSpecial"><INPUT type="text" size="4" value="住所" name="txt"></th>
									<td class="heiSpecial">〒
										<INPUT type="text" size="10" value="000-0000" name="txt">
										<br />
										<INPUT type="text" size="18" value="東京都○○区○○1－1－1" name="txt"></td>
									<td class="tdSpecial" rowspan="5"><iframe width="360" height="270" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.jp/maps?client=firefox-a&amp;hl=ja&amp;q=%E6%9D%B1%E4%BA%AC%E9%83%BD+%E5%9C%B0%E5%9B%B3&amp;ie=UTF8&amp;hq=&amp;hnear=%E6%9D%B1%E4%BA%AC%E9%83%BD&amp;gl=jp&amp;t=m&amp;brcurrent=3,0x60188d2059b7fd4b:0xec61c68fe232efd2,0&amp;z=13&amp;iwloc=A&amp;output=embed"></iframe>
										<br />
										<small><a href="https://maps.google.co.jp/maps?client=firefox-a&amp;hl=ja&amp;q=%E6%9D%B1%E4%BA%AC%E9%83%BD+%E5%9C%B0%E5%9B%B3&amp;ie=UTF8&amp;hq=&amp;hnear=%E6%9D%B1%E4%BA%AC%E9%83%BD&amp;gl=jp&amp;t=m&amp;brcurrent=3,0x60188d2059b7fd4b:0xec61c68fe232efd2,0&amp;z=13&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">大きな地図で見る</a></small><br />
										位置情報は「位置情報を登録」ボタンより変更できます。</td>
								</tr>
								<tr>
									<th><INPUT type="text" size="4" value="TEL" name="txt"></th>
									<td><INPUT type="text" size="18" value="03-0000-0000" name="txt"></td>
								</tr>
								<tr>
									<th><INPUT type="text" size="4" value="FAX" name="txt"></th>
									<td><INPUT type="text" size="18" value="03-0000-0000" name="txt"></td>
								</tr>
								<tr>
									<th><INPUT type="text" size="4" value="代表" name="txt"></th>
									<td><INPUT type="text" size="18" value="田中　太郎" name="txt"></td>
								</tr>
								<tr>
									<th><INPUT type="text" size="4" value="最寄駅" name="txt"></th>
									<td><INPUT type="text" size="18" value="○○駅　徒歩5分	○□駅　徒歩15分 " name="txt"></td>
								</tr>
								<tr>
									<th><INPUT type="text" size="4" value="HP" name="txt"></th>
									<td colspan="2"><INPUT type="text" size="46" value="http://www.xxx.com" name="txt"></td>
								</tr>
							</tbody>
						</table>

						<div class="Item clearfix">
							<INPUT type="text" size="10" value="項目名" name="txt">
							<a href="#"><img src="/img/client/area/area_link15.gif" alt="削 除" width="73" height="29" /></a><br />
							<textarea name="body" cols="5" rows="5"></textarea>
						</div>
					</div>
					<div class="tabBox">
						<h4>評 価</h4>
						<div class="evaluation clearfix">
							<dl>
								<dt>コメント　：</dt>
								<dd><span class="spanText01">32</span>件</dd>
								<dt>お気に入り：</dt>
								<dd><span class="spanText02">60</span>人</dd>
							</dl>
							<div class="voteSection clearfix">
								<div class="voteImg2">
									<div class="jScroll">
										<table>
											<tbody>
												<tr>
													<td><div class="inner2 clearfix">
															<div class="textBox2">
																<div class="title2">投票件数</div>
																<ul class="clearfix">
																	<li><span>興味あり</span><span class="color">35</span>件</li>
																	<li><span>加入中</span><span class="color">3</span>件</li>
																	<li><span>加入していた</span><span class="color">3</span>件</li>
																</ul>
															</div>
															<div class="photoBox"><span class="photoBox2"><img src="/img/search/imgtext06.gif" width="102" height="70" alt="" /></span></div>
														</div></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="voteBox clearfix">
									<ul>
										<li>
											<label for="vote01">
												<input type="radio" value="興味あり" name="vote01" id="vote01" checked="checked" />
												&nbsp;興味あり</label>
										</li>
										<li>
											<label for="vote02">
												<input type="radio" value="利用中" name="vote01" id="vote02" />
												&nbsp;加入中</label>
										</li>
										<li>
											<label for="vote03">
												<input type="radio" value="利用していた" name="vote01" id="vote03" />
												&nbsp;加入していた</label>
										</li>
									</ul>
									<div class="btnVote">
										<input type="image" name="__submit__" src="/img/client/area/ind2_btn_vote.gif" value="投票" alt="投票" />
									</div>
								</div>
							</div>
						</div>
						<h4>コメント</h4>
						<div class="commentBox clearfix">
							<div><a href="#"><img src="/img/client/area/com_link01.png" alt="新規コメント" width="161" height="29" /></a></div>
							<ul class="clearfix">
								<li><a href="#"><img src="/img/common/img/h_fLink.jpg" alt="fいいね！4" width="97" height="21" /></a></li>
								<li><a href="#"><img src="/img/common/img/h_tLink.jpg" alt="ツイート1" width="85" height="21" /></a></li>
							</ul>
						</div>
						<div class="comTextBox clearfix">
							<p>新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。新着コメントの内容が掲載されております。</p>
							<ul class="clearfix">
								<li><a href="#"><img src="/img/client/area/com_link02.png" alt="投 稿" width="100" height="33" /></a></li>
								<li><a href="#"><img src="/img/client/area/com_link03.png" alt="キャンセル" width="100" height="33" /></a></li>
							</ul>
						</div>
						<div class="jsSection">
							<div class="commentBox02 clearfix">
								<div class="dlBox clearfix">
									<dl>
										<dt>投稿日</dt>
										<dd>2013.10.10 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>A子</dd>
									</dl>
								</div>
								<a href="#" class="yes"><img src="/img/client/area/com_link09.png" alt="表 示" width="138" height="35" /></a><a href="#" class="no"><img src="/img/client/area/com_link04.png" alt="非表示" width="138" height="35" /></a></div>
							<div class="infoBox">
								<div class="comInner clearfix">
									<div class="photoBox"><img src="/img/client/area/com_photo02.jpg" alt="" width="37" height="35" /></div>
									<div class="subBox">
										<div class="textBox">
											<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
												新着コメント新着コメント新着コメント新着コメント新着コメント</p>
										</div>
									</div>
								</div>
							</div>
							<div class="jsBox">
								<div class="infoBox02 clearfix">
									<div class="comInner clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo02.jpg" alt="" width="37" height="35" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li><a href="#"><img src="/img/client/area/com_link07.png" alt="返信" width="84" height="39" /></a></li>
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link08.png" alt="通報" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
								<div class="dlBox dlBox02 clearfix">
									<dl>
										<dt>返信日</dt>
										<dd>2013.10.11 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>B男</dd>
									</dl>
								</div>
								<div class="infoBox02 mb0 clearfix">
									<div class="comInner02 clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo03.jpg" alt="" width="31" height="32" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link11.png" alt="削除" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="jsSection">
							<div class="commentBox02 clearfix">
								<div class="dlBox clearfix">
									<dl>
										<dt>投稿日</dt>
										<dd>2013.10.10 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>C子</dd>
									</dl>
								</div>
								<a class="yes" href="#"><img width="138" height="35" alt="表 示" src="/img/client/area/com_link09.png" /></a><a class="no" href="#"><img width="138" height="35" alt="非表示" src="/img/client/area/com_link04.png" /></a></div>
							<div class="infoBox">
								<div class="comInner clearfix">
									<div class="photoBox"><img src="/img/client/area/com_photo04.jpg" alt="" width="32" height="33" /></div>
									<div class="subBox">
										<div class="textBox">
											<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
												新着コメント新着コメント新着コメント新着コメント新着コメント</p>
										</div>
									</div>
								</div>
							</div>
							<div class="jsBox">
								<div class="infoBox02 clearfix">
									<div class="comInner clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo04.jpg" alt="" width="32" height="33" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li><a href="#"><img src="/img/client/area/com_link07.png" alt="返信" width="84" height="39" /></a></li>
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link08.png" alt="通報" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
								<div class="dlBox dlBox02 clearfix">
									<dl>
										<dt>返信日</dt>
										<dd>2013.10.11 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>B男</dd>
									</dl>
								</div>
								<div class="infoBox02 mb0 clearfix">
									<div class="comInner02 clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo03.jpg" alt="" width="31" height="32" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link11.png" alt="削除" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="jsSection">
							<div class="commentBox02 clearfix">
								<div class="dlBox clearfix">
									<dl>
										<dt>投稿日</dt>
										<dd>2013.10.10 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>D子</dd>
									</dl>
								</div>
								<a class="yes" href="#"><img width="138" height="35" alt="表 示" src="/img/client/area/com_link09.png" /></a><a class="no" href="#"><img width="138" height="35" alt="非表示" src="/img/client/area/com_link04.png" /></a></div>
							<div class="infoBox clearfix">
								<div class="comInner floatL clearfix">
									<div class="photoBox"><img src="/img/client/area/com_photo05.jpg" alt="" width="32" height="33" /></div>
									<div class="subBox">
										<div class="textBox">
											<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
												新着コメント新着コメント新着コメント新着コメント新着コメント</p>
										</div>
									</div>
								</div>
							</div>
							<div class="jsBox mb0">
								<div class="infoBox02 clearfix">
									<div class="comInner clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo05.jpg" alt="" width="32" height="33" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li><a href="#"><img src="/img/client/area/com_link07.png" alt="返信" width="84" height="39" /></a></li>
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link08.png" alt="通報" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
								<div class="dlBox dlBox02 clearfix">
									<dl>
										<dt>返信日</dt>
										<dd>2013.10.11 12:00</dd>
									</dl>
									<dl class="dlStyle">
										<dt>ユーザ</dt>
										<dd>B男</dd>
									</dl>
								</div>
								<div class="infoBox02 mb0 clearfix">
									<div class="comInner02 clearfix">
										<div class="photoBox"><img src="/img/client/area/com_photo03.jpg" alt="" width="31" height="32" /></div>
										<div class="subBox">
											<div class="textBox">
												<p>新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント<br />
													新着コメント新着コメント新着コメント新着コメント新着コメント</p>
											</div>
										</div>
									</div>
									<div class="tableBox">
										<table cellpadding="0" cellspacing="0" summary="コメント">
											<col width="35%" />
											<col width="35%" />
											<col width="30%" />
											<tbody>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link05.png" alt="賛 成" width="101" height="33" /></a></th>
													<td class="tdStyle">10</td>
													<td>件</td>
												</tr>
												<tr>
													<th><a href="#"><img src="/img/client/area/com_link06.png" alt="反 対" width="101" height="34" /></a></th>
													<td class="tdStyle02">8</td>
													<td>件</td>
												</tr>
											</tbody>
										</table>
										<ul class="clearfix">
											<li class="floatR"><a href="#"><img src="/img/client/area/com_link11.png" alt="削除" width="84" height="39" /></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tabBox tabBox01">
						<p>お問合せは、団体に直接ご連絡下さい。</p>
						<form class="mailForm" action="./" method="post">
							<table class="comTable comTable01" cellpadding="0" cellspacing="0" summary="基本情報入力">
								<col width="25%" />
								<col width="75%" />
								<tbody>
									<tr>
										<th>氏名 ：</th>
										<td><input  type="text" value="" name="name" /></td>
									</tr>
									<tr>
										<th>メールアドレス ：</th>
										<td><input  type="text" value="" name="email" class="fEmail" /></td>
									</tr>
									<tr>
										<th>種類 ：</th>
										<td><ul>
												<li>
													<label for="fType01">
														<input type="radio" value="質問" name="type" id="fType01" checked="checked" />
														質問</label>
												</li>
												<li>
													<label for="fType02">
														<input type="radio" value="会員申し込み" name="type" id="fType02" />
														会員申し込み</label>
												</li>
											</ul></td>
									</tr>
									<tr>
										<th>内容 ：</th>
										<td><textarea name="content" id="fContent" cols="5" rows="5"></textarea></td>
									</tr>
								</tbody>
							</table>
							<div class="submit">
								<input type="image" src="/img/client/community/btn_out.jpg" alt="確 認" value="確 認" name="__send__" onmouseover="this.src='../../img/client/community/btn_over.jpg'" onmouseout="this.src='../../img/client/learn/btn_out.jpg'" />
							</div>
						</form>
					</div>
				</div>
			</div>
</div>
 source -->

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



<?php } ?>