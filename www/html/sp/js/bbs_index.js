//ajaxでお気に入り登録（/js/system.js のaddLike）したときのcallback
function onFamilyLikeSuccess(data){
	//console.log('data:');console.log(data);
	if(data.status == '1'){
		var topicId = data.contents_target_id;
		var $addLike_li = $('#topic' + topicId).find('> td:last li:last');
		//console.log('$addLike_li');console.log($addLike_li);
		var $addLike_a = $addLike_li.find('a');
		var $addLike_img = $addLike_a.find('img');

		$addLike_img.appendTo($addLike_li);
		$addLike_a.remove();
		$addLike_img.addClass('inactiveFamilyLikeBtn').css('opacity', 0.3);

		alert("お気に入りに登録しました");
	}else{
		alert(data.error);
	}
}

$(document).ready(function(){
	//セレクト「カテゴリ」の選択変更でformをsubmit
	$('form select#searchCategoryId').change(function(){
		$('form#searchIndexForm').submit();
	});
	//セレクト「タグ」の選択変更でformをsubmit
	$('form select#searchTagId').change(function(){
		$('form#searchIndexForm').submit();
	});
});