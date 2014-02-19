
<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline'=>false)); ?>
<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>
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

fieldset h4{
	background-color: #eee;
	line-height: 48px;
	padding: 0px 5px;
	cursor: pointer;
}

fieldset h4 span{
	float:right;
}

fieldset .group{
	display:none;
}

</style>
<script>

$(function(){
	$('#addUser').click(function(){
		$.colorbox({iframe:true, href:'/admin/users/client_user_list', width:550, height:500})
	});
	Uploader.init('/clients/upload');

	$('#addFacilityItem').click(function(){
		if($('#facility_items .item:last-child')[0]){
			lastnum = $('#facility_items .item:last-child').attr('class').replace('item item-' , '');
		}else{
			lastnum = -1;
		}
		n = parseInt(lastnum) + 1;
		cont = '\<div class="item item-'+n+'"\>\<div class="control-group"\>\<label for="FacilityInfoItem'+n+'" class="control-label"\>項目\</label\>\<div class="controls"\>\<input name="data[FacilityInfo]['+n+'][item]" value="" type="text" id="FacilityInfoItem'+n+'"\>\</div\>\</div\>\<div class="control-group"\>\<label for="FacilityInfoValue'+n+'" class="control-label"\>内容\</label\>\<div class="controls"\>\<textarea name="data[FacilityInfo]['+n+'][value]" rows="3" id="FacilityInfoValue'+n+'"\>\</textarea\><input type="hidden" name="data[FacilityInfo]['+n+'][tab]" value="1">';
		cont += '\<a class="btn btn-danger"\>\<i class="icon-trash" onclick="deleteItem(this);"\>\</i\>\</a\>\</div\>\</div\>\</div\>';
		if($('#facility_items .item:last-child')[0]){
			$('#facility_items .item:last-child').after(cont);
		}else{
			$('#facility_items').append(cont);
		}
	})

	$('#addBasicItem').click(function(){
		lastnum = $('#basic_items .item:last-child').attr('class').replace('item item-' , '');
		n = parseInt(lastnum) + 1;
		cont = '\<div class="item item-'+n+'"\>\<div class="control-group"\>\<label for="BasicInfoItem'+n+'" class="control-label"\>項目\</label\>\<div class="controls"\>\<input name="data[BasicInfo]['+n+'][item]" value="" type="text" id="BasicInfoItem'+n+'"\>\</div\>\</div\>\<div class="control-group"\>\<label for="BasicInfoValue'+n+'" class="control-label"\>内容\</label\>\<div class="controls"\>\<textarea name="data[BasicInfo]['+n+'][value]" rows="3" id="BasicInfoValue'+n+'"\>\</textarea\><input type="hidden" name="data[BasicInfo]['+n+'][tab]" value="2">';
		cont += '\<a class="btn btn-danger"\>\<i class="icon-trash" onclick="deleteItem(this);"\>\</i\>\</a\>\</div\>\</div\>\</div\>';

		$('#basic_items .item:last-child').after(cont);
	})

	$('#addRecruitItem').click(function(){
		lastnum = $('#recruit_items .item:last-child').attr('class').replace('item item-' , '');
		n = parseInt(lastnum) + 1;
		cont = '\<div class="item item-'+n+'"\>\<div class="control-group"\>\<label for="RecruitInfoItem'+n+'" class="control-label"\>項目\</label\>\<div class="controls"\>\<input name="data[RecruitInfo]['+n+'][item]" value="" type="text" id="RecruitInfoItem'+n+'"\>\</div\>\</div\>\<div class="control-group"\>\<label for="RecruitInfoValue'+n+'" class="control-label"\>内容\</label\>\<div class="controls"\>\<textarea name="data[RecruitInfo]['+n+'][value]" rows="3" id="RecruitInfoValue'+n+'"\>\</textarea\><input type="hidden" name="data[RecruitInfo]['+n+'][tab]" value="4">';
		cont += '\<a class="btn btn-danger"\>\<i class="icon-trash" onclick="deleteItem(this);"\>\</i\>\</a\>\</div\>\</div\>\</div\>';

		$('#recruit_items .item:last-child').after(cont);
	})

	$('#addCouponItem').click(function(){
		lastnum = $('#coupon_items .item:last-child').attr('class').replace('item item-' , '');
		n = parseInt(lastnum) + 1;
		lasttokuten = n - 1;
		cont = '\<div class="item item-'+n+'"\>\<div class="control-group"\>\<label for="CouponInfoValue'+n+'" class="control-label"\>特典'+lasttokuten+'\</label\><input name="data[CouponInfo]['+n+'][item]" value="'+'benefit'+lasttokuten+'" type="hidden" id="CouponInfoItem'+n+'"\>\<div class="controls"\>\<textarea name="data[CouponInfo]['+n+'][value]" rows="3" id="CouponInfoValue'+n+'"\>\</textarea\><input type="hidden" name="data[CouponInfo]['+n+'][tab]" value="9">';
		cont += '\<a class="btn btn-danger"\>\<i class="icon-trash" onclick="deleteItem(this);"\>\</i\>\</a\>\</div\>\</div\>\</div\>';

		$('#coupon_items .item:last-child').after(cont);
	})


	$('#addRow').click(function(){
		lastnum = $('#capacity tr:last-child').attr('class').replace('row row-' , '');
		n = parseInt(lastnum) + 1;
		cont = '\
											<tr class="row row-'+n+'">\
										<th><a class="btn btn-danger"><i class="icon-trash" onclick="deleteRow(this);""></i></a></th>\
										<td class="taLeft">\
											<input name="data[Capacity]['+n+'][0]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input name="data[Capacity]['+n+'][1]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input name="data[Capacity]['+n+'][2]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input name="data[Capacity]['+n+'][3]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
										<td>\
											<input name="data[Capacity]['+n+'][4]" value="" type="text" id="ClientInfoItem'+n+'">\
										</td>\
									</tr>\
		';

		$('#capacity tr:last-child').after(cont);
	})

	$('h4').click(function(){
		$(this).next('div.group').toggle();
	});

});

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
		target = $(elem).parent().parent().parent();
		target.fadeOut('1000' , function(){this.remove();});
	}
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



<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Client', array('class' => 'form-horizontal'));?>
			<fieldset>
				<?php if($isEdit): ?>
				<legend><?php echo __('Admin Edit %s', __('Client')); ?></legend>
				<?php else: ?>
				<legend><?php echo $contentsTypes[$ctype].'新規作成'; ?></legend>
				<?php endif; ?>
				<?php
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->input('status', array('type'=>'radio','options'=>MasterOption::$userStatus , 'default'=>0));
				echo $this->BootstrapForm->hidden('id');
				echo $this->BootstrapForm->input('name');
				echo $this->BootstrapForm->input('kana');
				echo $this->BootstrapForm->input('contents_type_id', array('empty'=>'選択してください','id'=>'contents_type' , 'value'=>$ctype , 'type'=>'hidden'));
				echo $this->BootstrapForm->input('client_type_id', array('type'=>'select' , 'options' => $clientTypes , 'empty' => '選択して下さい', 'id'=>'client_type'));
				?>
				<div class="control-group <?php if($this->BootstrapForm->error('zip')) echo ' error'; ?>">
						<label class="control-label" for="appendedInputButtons">郵便番号</label>
						<div class="controls">
							<div class="input-append">
								<?php echo $this->BootstrapForm->input('zip', 
									array('class'=>'span4', 'size'=>'7','maxLength'=>'7', 'div'=>false,'label'=>false, 'id'=>'zip', 'error'=>false));  ?> 
								<button class="btn btn-warning " type="button" id='get_zip_info'>郵便番号から情報を設定する</button>
						
							</div>
							<?php echo $this->BootstrapForm->error('zip'); ?>
						</div>
						
				</div>
				<?php
				echo $this->BootstrapForm->input('representative');
				echo $this->BootstrapForm->input('position');
				echo $this->BootstrapForm->input('tel');
				echo $this->BootstrapForm->input('fax');
				echo $this->BootstrapForm->input('url');
				echo $this->BootstrapForm->input('mail');
				echo $this->BootstrapForm->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください'));
				echo $this->BootstrapForm->input('address', array('id'=>'address', 'class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('sub_address', array('label'=>'建物名以下','id'=>'sub_address', 'class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('municipal_id', array('id'=>'municipal','empty'=>'選択してください'));
				echo $this->BootstrapForm->input('area_id', array('id'=>'area', 'empty'=>'選択してください'));

				if(!$isEdit){

				$selected = array(1,2,6,7,8);

				echo $this->BootstrapForm->input('display_tabs', array(
					'multiple'=>'checkbox' ,
					'label'=>'表示タブ',
					'options' => $tabs,
					'selected' => $selected
					)
				);

				}else{

				echo $this->BootstrapForm->input('display_tabs', array(
					'multiple'=>'checkbox' ,
					'label'=>'表示タブ',
					'options' => $tabs,
					)
				);


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

				echo $this->BootstrapForm->input('publicity_range', array('type'=>'select', 'options'=>MasterOption::$publicity_ranges, 'empty'=>'選択してください' , 'selected' => $pr_sel));
?>


<h4>施設紹介<span>▼</span></h4>
<div id="facility" class="group">
	
<?php	
				echo $this->BootstrapForm->input('info', array('type'=>'textarea','class'=>'input-xlarge'));
				echo $this->BootstrapForm->input('character', array('type'=>'textarea','class'=>'input-xlarge'));


				// echo $this->BootstrapForm->input('ClientPoll.id' , array('type'=>'hidden'));
				// echo $this->BootstrapForm->input('ClientPoll.poll_n1');
				// echo $this->BootstrapForm->input('ClientPoll.poll_n2');
				// echo $this->BootstrapForm->input('ClientPoll.poll_n3');
				// echo $this->BootstrapForm->input('ClientPoll.poll_n4');
				// echo $this->BootstrapForm->input('ClientPoll.poll_n5');
				//echo $this->BootstrapForm->input('gmap_code');
				
		?>


<div class="control-group">

	<div id="facility_items">
	
				<?php

if($isEdit){
	//$facility_info = $this->data['FacilityInfo'];
}else if(!empty($this->data['FacilityInfo'])){//投稿エラーで戻った時など
	$facility_info = $this->data['FacilityInfo'];
}

//debug($this->data['FacilityInfo']);
if(isset($facility_info) && (count($facility_info)>0)){
				$i = 0;
				foreach($facility_info as $item){
					echo '<div class="item item-'.$i.'">';
					?>
								<div class="control-group">
									<label for="FacilityInfoItem<?php echo $i; ?>" class="control-label">項目</label>
									<div class="controls">
										<input name="data[FacilityInfo][<?php echo $i; ?>][item]" value="<?php echo $facility_info[$i]['item']; ?>" type="text" id="FacilityInfoItem<?php echo $i; ?>">

									</div>
								</div>
								<div class="control-group">
									<label for="FacilityInfoValue<?php echo $i; ?>" class="control-label">内容</label>
									<div class="controls">
										<textarea name="data[FacilityInfo][<?php echo $i; ?>][value]" rows="3" id="FacilityInfoValue<?php echo $i; ?>"><?php echo @$facility_info[$i]['value'];?></textarea>
										<a class="btn btn-danger"><i class='icon-trash' onclick='deleteItem(this);'></i></a>
									</div>
									<input type="hidden" name="data[FacilityInfo][<?php echo $i; ?>][tab]" value="1">
								</div>

					<?php
					//echo $this->BootstrapForm->input('ClientInfo.item.'.$i , array('label'=>'項目' , 'value'=>$facility_info[$ctype][$i]));
					//echo $this->BootstrapForm->input('ClientInfo.value.'.$i , array('type' => 'textarea' , 'label'=>'内容'));
				$i++;
					echo '</div>';
				}
}
				?>
	</div>

				<div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addFacilityItem'>＋項目を追加</a>
				</div>
</div>




</div>


<h4>基本情報<span>▼</span></h4>
<div class="group" id="basic_items">
	
		<div>
				<?php

if($isEdit){
	//$basic_info = $this->data['BasicInfo'];
}else if(!empty($this->data['BasicInfo'])){//投稿エラーで戻った時など
	$basic_info = $this->data['BasicInfo'];
}

//1個もない状態のときはデフォルトを表示
if(empty($basic_info)){
			$basic_info = array();
				$i = 0;
				foreach($basic_info_default[$ctype] as $k){
					$basic_info[] = array('item'=>$k, 'value' => ''); 
					$i++;
				}
}

//debug($this->data['BasicInfo']);
if(!empty($basic_info)){
				$i = 0;
				foreach($basic_info as $item){
					echo '<div class="item item-'.$i.'">';
					?>
								<div class="control-group">
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
								</div>

					<?php
					//echo $this->BootstrapForm->input('ClientInfo.item.'.$i , array('label'=>'項目' , 'value'=>$basic_info[$ctype][$i]));
					//echo $this->BootstrapForm->input('ClientInfo.value.'.$i , array('type' => 'textarea' , 'label'=>'内容'));
				$i++;
					echo '</div>';
				}
}
				?>
	</div>

				<div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addBasicItem'>＋項目を追加</a>
				</div>

</div>

<?php
if($ctype == 1){//保育施設のみ

if(!empty($this->data['Capacity'])){
	$capacity_info = $this->data['Capacity'];
}

?>

<h4>定員情報<span>▼</span></h4>
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
									<th></th>
									<th>年齢</th>
									<th>定員数</th>
									<th>在籍者数</th>
									<th>待機児童数</th>
									<th>備考</th>
								</tr>
								<?php $i = 0; foreach ($capacity_info as $row) {?>
									<tr class="row row-<?php echo $i;?>">
										<th><a class="btn btn-danger"><i class='icon-trash' onclick='deleteRow(this);'></i></a></th>
										<td class="taLeft">
											<input name="data[Capacity][<?php echo $i; ?>][0]" value="<?php echo @$row[0]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input name="data[Capacity][<?php echo $i; ?>][1]" value="<?php echo @$row[1]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input name="data[Capacity][<?php echo $i; ?>][2]" value="<?php echo @$row[2]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input name="data[Capacity][<?php echo $i; ?>][3]" value="<?php echo @$row[3]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
										<td>
											<input name="data[Capacity][<?php echo $i; ?>][4]" value="<?php echo @$row[4]; ?>" type="text" id="ClientInfoItem<?php echo $i; ?>">
										</td>
									</tr>
								<?php $i++;} ?>

							</tbody>
						</table>
					</div>

					<div class="controls">
						<a class="btn btn-success" href="javascript:void(0);" id='addRow'>＋項目を追加</a>
					</div>

	</div>
</div>


<h4>職員募集<span>▼</span></h4>
<div id="recruit_items" class="group">

<div class="control-group">

	
				<?php

if(!empty($this->data['RecruitInfo'])){//投稿エラーで戻った時など
	$recruit_info = $this->data['RecruitInfo'];
}

//debug($this->data['RecruitInfo']);

				$i = 0;
				foreach($recruit_info as $item){
					echo '<div class="item item-'.$i.'">';
					?>
								<div class="control-group">
									<!-- <label for="RecruitInfoItem<?php echo $i; ?>" class="control-label"></label> -->
									<div class="controls">
										<input name="data[RecruitInfo][<?php echo $i; ?>][item]" value="<?php echo $recruit_info[$i]['item']; ?>" type="<?php echo ($i<6)?'hidden':'text';?>" id="RecruitInfoItem<?php echo $i; ?>">

									</div>
								</div>
								<div class="control-group">

									<label for="RecruitInfoValue<?php echo $i; ?>" class="control-label"><?php echo ($i<6)?$recruit_info[$i]['item']:''; ?></label>
									<div class="controls">
										<textarea name="data[RecruitInfo][<?php echo $i; ?>][value]" rows="3" id="RecruitInfoValue<?php echo $i; ?>"><?php echo @$recruit_info[$i]['value'];?></textarea>
										<?php if($i>=6){?>
																				<a class="btn btn-danger"><i class='icon-trash' onclick='deleteItem(this);'></i></a>
										<?php } ?>
									</div>
									<input type="hidden" name="data[RecruitInfo][<?php echo $i; ?>][tab]" value="8">
								</div>

					<?php
				$i++;
					echo '</div>';
				}

				?>
	</div>

				<div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addRecruitItem'>＋項目を追加</a>
				</div>
</div>



<?php }else if($ctype == 2){ //クーポンはスポットのみ?>

<h4>クーポン情報<span>▼</span></h4>
<div id="coupon_items" class="group">

<div class="control-group">

	
				<?php

if(!empty($this->data['CouponInfo'])){//投稿エラーで戻った時など
	$coupon_info = $this->data['CouponInfo'];
}



				$i = 0;
				foreach($coupon_info as $item){
					echo '<div class="item item-'.$i.'">';

					if(($coupon_info[$i]['item']=='期間1')||($coupon_info[$i]['item']=='期間2')){
					?>

								<div class="control-group">

									<label for="CouponInfoValue<?php echo $i; ?>" class="control-label"><?php echo $coupon_info[$i]['item']; ?></label>
									<div class="controls">
										<input name="data[CouponInfo][<?php echo $i; ?>][item]" value="<?php echo @$coupon_info[$i]['item'];?>" type="hidden">
										<input name="data[CouponInfo][<?php echo $i; ?>][value]" id="CouponInfoValue<?php echo $i; ?>" value="<?php echo @$coupon_info[$i]['value'];?>">
		
									</div>
									<input type="hidden" name="data[CouponInfo][<?php echo $i; ?>][tab]" value="9">
								</div>





					<?php 
						}else{
					?>
								<div class="control-group">
									<!-- <label for="RecruitInfoItem<?php echo $i; ?>" class="control-label"></label> -->
									<div class="controls">
										<input name="data[CouponInfo][<?php echo $i; ?>][item]" value="<?php echo $coupon_info[$i]['item']; ?>" type="<?php echo ($i<6)?'hidden':'text';?>" id="CouponInfoItem<?php echo $i; ?>">

									</div>
								</div>
								<div class="control-group">

									<label for="CouponInfoValue<?php echo $i; ?>" class="control-label"><?php echo '特典'.($i-1); ?></label>
									<div class="controls">
										<textarea name="data[CouponInfo][<?php echo $i; ?>][value]" rows="3" id="CouponInfoValue<?php echo $i; ?>"><?php echo @$coupon_info[$i]['value'];?></textarea>
										<?php if($i>=6){?>
																				<a class="btn btn-danger"><i class='icon-trash' onclick='deleteItem(this);'></i></a>
										<?php } ?>
										<a class="btn btn-danger"><i class="icon-trash" onclick="deleteItem(this);"></i></a>
									</div>

									<input type="hidden" name="data[CouponInfo][<?php echo $i; ?>][tab]" value="8">
								</div>

					<?php
					}
				$i++;
					echo '</div>';
				}

				?>
	</div>

				<div class="controls">
					<a class="btn btn-success" href="javascript:void(0);" id='addCouponItem'>＋項目を追加</a>
				</div>
</div>


<?php } ?>

<h4>画像登録<span>▼</span></h4>
<div class="group" id="capacity">

<?php

		for($i=1; $i<=8; $i++):
					echo $this->element('admin/upload_element', 
						array('data'=>!empty($this->data['Client']) ? $this->data['Client'] : array(), 'dir'=>CLIENT_DIR,'thumb'=>'t',
							'title'=>'画像'.$i , 'file_name'=>'file_name'.$i, 'uploaded'=>'uploaded'.$i, 'deleted'=>'deleted'.$i));

				endfor;
				
	
				?>

</div>

<hr>
				<div class="control-group">

					<label for="ClientFileName8" class="control-label">Googleマップ</label>
					<div class="controls" >
	
	
					<div id='latlng'>
		            <?php echo $this->Form->input('Client.lat',array('id'=>'lat','size'=>'40','maxlength'=>'50','label'=>'緯度'));?>
		            <?php echo $this->Form->input('Client.lng',array('id'=>'lng','size'=>'40','maxlength'=>'50','label'=>'経度'));?>
		          </div>
		              <p><a class='btn  btn-danger' onclick='codeAddress();'>住所からGoogleマップを設定する</a>
		              <p><a class='btn  btn-success' onclick='setAddress();'>この位置に設定する</a>
		            	
		            
		            <div id="map" width="640" height="480" style="width:640px;height:480px;"></div>
		            <div style='margin-top:15px;'>
		            <label><!-- <input type='checkbox' id='clickPoint' style='margin:3px 3px 5px 0px;'/> --></label>
		            </div>
	

		      </div>
		      </div>




				<div class="control-group">
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
				</div>
				
				
				<div class="form-actions">
					 
					 <button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick="location.href='/admin/clients/'">一覧に戻る</button>
					
				</div>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
		
	</div>
	<div class="span3"><!--
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		 <ul class="nav nav-list">
			<li class="nav-header">関連する操作</li>
			<!-- <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Client.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Client.id'))); ?></li> 
			<li><?php echo $this->Html->link('・'.__('List %s', __('Clients')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link('・'.__('List %s', __('施設管理者')), array('controller' => 'users', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('・'.__('New %s', __('施設管理者')), array('controller' => 'users', 'action' => 'add')); ?></li>
			
			
		</ul> 
		</div>-->
	</div>
</div>