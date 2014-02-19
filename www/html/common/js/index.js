function randomInit(){
	var arr=[]; 
	for(var i=1;i<4;i++){ 
		arr[i]=i; 
	} 
	
	for(var j=0;j<15;j++){
		var x= Math.floor(Math.random()*3+1);
		$('#randomSlide').append('<img src="../img/index/main_img0'+arr[x]+'.jpg" width="752" height="203" alt="" />');
	}

	
	$('#randomSlide').carouFredSel({
		scroll: {
			fx: "crossfade"
		}
	});
}

$(function(){
	randomInit();
});