var marker = null;
var geocoder = null;
var directions = null;
function initMap(){
	var lat = $('#lat').val();
	var lng = $('#long').val();
	
	if(!(lat.length>0 && lng.length>0) ){
		lat = 35.6814883;
		lng = 139.77779680000003;
	}
	var latlng = new google.maps.LatLng(lat,lng);
	
	var options = {
	  zoom: 16,
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("gmap"), options);
	marker = new google.maps.Marker({
	      position: latlng,
	      title:mapTitle
	  });
	  marker.setMap(map);
	  var contentString = 'Hello World!!';
	  var infoWindow = new google.maps.InfoWindow({
		    content: contentString
	  });
	//  infoWindow.open(map,marker);

	  geocoder = new google.maps.Geocoder();

	  google.maps.event.addListener(map, 'dblclick', function(event) {
		  //if($('#clickPoint').attr('checked')){
			  var latLng = event.latLng;
				marker.setPosition(latLng);
		    $('#lat').val(latLng.lat());
		    $('#long').val(latLng.lng());
		  //}
	});
}

function getLatLng(){
	var addr = '';

	if($('#prefecture').val()){
		addr += $('#prefecture option:selected').html();
	}
	addr += $('#address').val() + $('#sub_city').val();
	
	if(!addr) return;

	if (geocoder) {
	      geocoder.geocode( { 'address': addr}, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {
		        var latlng = results[0].geometry.location;
	          	map.setCenter(latlng);
	         	marker.setMap(null);
	          	marker = new google.maps.Marker({
	              map: map,
	              position: latlng,
	              title:mapTitle
	          	});
	          	$("#lat").val(latlng.lat());
	          	$("#long").val(latlng.lng());
	        } else {
	          alert("Geocode was not successful for the following reason: " + status);
	        }
	      });
	}
}

function setLatLng(latlng){
	map.setCenter(latlng, 15);
	var lng = latlng.lng();
	var lat = latlng.lat();
	$('#lat').val(lat);
	$('#long').val(lng);

}
