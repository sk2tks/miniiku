//ajaxでお気に入り登録したときのcallback
function onFamilyLikeSuccess(data){
	//console.log('data:');console.log(data);
	if(data.status == '1'){
		
		var $addLike_div = $('#addLike_div');
		//console.log('$addLike_div');console.log($addLike_div);
		var $addLike_a = $addLike_div.find('a');
		var $addLike_img = $addLike_a.find('img');
		
		$addLike_img.appendTo($addLike_div);
		$addLike_a.remove();
		$addLike_img.addClass('inactiveFamilyLikeBtn').css('opacity', 0.3);
		
		alert("お気に入りに登録しました");
	}else{
		alert(data.error);
	}
}

$(function(){
	//追記
	$('#tsuikiBox').hide();
	$('#tsuiki_btn').click(function(){
		$('#tsuikiBox').slideDown('slow');
	});
	$('#cancelTsuiki_btn').click(function(){
		$('#tsuikiBox').slideUp('slow', function(){
			$('#tsuikiBox textarea').val('');
		});
	});
	$('#submitTsuiki_btn').click(function(){
		var tsuiki = $.trim( $('textarea[name="data[Topic][tsuiki]"]').val() );
		if(tsuiki == ''){
			alert('追記する内容を入力してください');
		}else if(confirm('投稿します。よろしいですか？')){
			var $form = $(this).parent().parent().parent();
			$form.submit();
		}
	});
	
	//トピック締切り
	$('#closeTopic_btn').click(function(){
		if(confirm('このトピックを締切ります。よろしいですか？')){
			var $form = $(this).parent();
			$form.submit();
		}
	});
});