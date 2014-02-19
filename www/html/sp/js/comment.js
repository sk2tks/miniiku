$(function(){
	//jsSection（コメントの伸縮）
	$('.jsSection .no,.jsSection .detailBox').hide();
	$('.jsSection .yes').click(function(){
		if(!loggedIn){
			loginHere();
		}else{
			var eleP=$(this).parents('.jsSection');
			$(this).hide();
			eleP.find('.no').show();
			eleP.find('.briefBox').hide();
			eleP.find('.detailBox').slideDown('fast');
			
		}
		return false;
	});
	$('.jsSection .no').click(function(){
		var eleP=$(this).parents('.jsSection');
		$(this).hide();
		eleP.find('.yes').show();
		
		eleP.find('.detailBox').slideUp('fast', function(){eleP.find('.briefBox').show();});
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
			var $form = $(this).parents('#CommentViewForm');
			$form.submit();
		}
	});
	
	//新規返信
	$('.response_btn').click(function(){
		$resInputPlaceHolder = $(this).parent().parent().parent().parent().parent().next();
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
			var $form = $(this).parents('#ResponseViewForm');
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
	//console.log('$div.length:' + $div.length);
	if($div != null && $div.length){
		var y = $div.offset().top;
		//console.log('y:' + y);
		//window.scrollTo(0, y);
		setTimeout(function(){
			//html Firefox用。body Chrome用。
			$('html, body').animate({scrollTop:y}, 'slow');
		}, 640);
		//console.log('window.scrollY:' + window.scrollY);
	}
}