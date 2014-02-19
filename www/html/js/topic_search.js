//ajaxでクリップ登録したときのcallback
function onFamilyClipSuccess(data){
	//console.log('data:');console.log(data);
	if(data.status == '1'){
		var topicId = data.contents_target_id;
		var $addClip_li = $('#topic' + topicId).find('> td:last li:last');
		//console.log('$addLike_li');console.log($addLike_li);
		var $addClip_a = $addClip_li.find('a');
		var $addClip_img = $addClip_a.find('img');
		
		$addClip_img.appendTo($addClip_li);
		$addClip_a.remove();
		$addClip_img.addClass('inactiveFamilyLikeBtn').css('opacity', 0.4);
		
		alert("クリップに登録しました");
	}else{
		alert(data.error);
	}
}

$(document).ready(function(){
	$('form select#searchSourceId').change(function(){
		$('form#searchIndexForm').submit();
	});
	$('form .searchBtn').click(function(){
		$('form#searchIndexForm').submit();
	});
	
	

	
})