$(function(){
	//jsSection（コメントの伸縮）
	$('.jsSection .no,.jsSection .jsBox').hide();
	$('.jsSection .yes').click(function(){
		if(!loggedIn){
			loginHere();
		}else{
			var eleP=$(this).parents('.jsSection');
			$(this).hide();
			eleP.find('.no').show();
			eleP.find('.infoBox').hide();
			eleP.find('.jsBox').slideDown('fast');
			return false;
		}
	});
	$('.jsSection .no').click(function(){
		var eleP=$(this).parents('.jsSection');
		$(this).hide();
		eleP.find('.yes').show();
		
		eleP.find('.jsBox').slideUp('fast', function(){eleP.find('.infoBox').show();});
		return false;
	});


	//新規コメント
	$('#comInput').hide();
	$('#newComment_btn').click(function(){
		if(!loggedIn){
			loginHere();
		}else{
			$('#comInput').slideDown();
		}
	});
	$('#cancelComment_btn').click(function(){
		$('#comInput textarea').val('');
		$('#comInput').slideUp();
	});
	$('#submitComment_btn').click(function(){
		//console.log('textarea val:');console.log($('textarea[name="data[Comment][body]"]').val());
		if($('textarea[name="data[Comment][body]"]').val() == ''){
			alert('コメント本文を入力してください');
		}else if(confirm('投稿します。よろしいですか？')){
			var $form = $(this).parent().parent().parent();
			$form.submit();
		}
	});
	
	//新規返信
	$('.response_btn').click(function(){
		$resInputPlaceHolder = $(this).parent().parent().parent().parent().next();
		//console.log('$resInputPlaceHolder:');console.log($resInputPlaceHolder);
		$resInputPlaceHolder.append($('#resInput').hide());
		$comment = $(this).parents('.comment');
		$parentCommentId = $comment.attr('data-commentid');
		$('#resInput input').val($parentCommentId);
		$('#resInput').slideDown();
	});
	$('#cancelResponse_btn').click(function(){
		$resInputPlaceHolder = $(this).parent().parent().parent();
		$('#resInput').slideUp('normal', function(){
			$('#resInput').find('textarea').val('');
		});
	});
	$('#submitResponse_btn').click(function(){
		if($('textarea[name="data[Response][body]"]').val() == ''){
			alert('コメント本文を入力してください');
		}else if(confirm('投稿します。よろしいですか？')){
			var $form = $(this).parent().parent().parent();
			$form.submit();
		}
	});
	
	
	//コメント削除
	$('.removeComment_btn').click(function(){
		if(confirm('削除します。よろしいですか？')){
			var $form = $(this).parent();
			//console.log('$form:');console.log($form);
			$form.submit();
		}
	});
	
	//通報
	$('.commentAlert_btn').click(function(){
		if(confirm('管理者へ通報します。よろしいですか？')){
			var comment_id = $(this).attr('data-commentId');
			//console.log('comment_id:' + comment_id);
			$.ajax({
				url:"/bbs/comment_alert/" + comment_id,
				dataType:'json',
				success:function(data){
					//console.log('data:');console.log(data);
					if(data.status == '1'){
						alert("管理者に通報しました");
					}else{
						alert(data.error);
					}
				}
			});
		}
	});
});

function showCurrentComment(){
	var $div = null;
	//console.log('currentComment:' + currentComment);
	//console.log("$('body').height():" + $('body').height());
	if(parentOfCurrentComment != '0'){
		$div = $('div[data-commentid="' + parentOfCurrentComment + '"]');
		if($div.length){
			$div.find('.yes').click();
		}
		
		if(currentComment != '0'){
			$div = $('div[data-commentid="' + currentComment + '"]');
		}
	}else if(currentComment != '0'){
		$div = $('div[data-commentid="' + currentComment + '"]');
		if($div.length){
			$div.find('.yes').click();
		}
	}
	//console.log('$div:');console.log($div);
	if($div != null && $div.length){
		var y = $div.offset().top;
		//console.log('y:' + y);
		//console.log("$('body').height():" + $('body').height());
		//window.scrollTo(0, 1291);
		setTimeout(function(){
			//html Firefox用。body Chrome用。
			$('html, body').animate({scrollTop:y}, 'slow');
		}, 640);
		//console.log('window.scrollY:' + window.scrollY);
		//console.log("$('body').height():" + $('body').height());
	}
}
