$(function(){
	setTimeout(function(){
		$('#flashMessage').slideUp();
	},3000);
});

$.fn.extend({
	setOptions:function(data, emptyMessage){
		
		this.empty();
		var optionItems = new Array();
		if(emptyMessage == undefined ) {
			emptyMessage = "選択してください";
		}else{
			if(emptyMessage != false){
				optionItems.push(new Option( emptyMessage, ""));
				
			}
		}
        for (key in data) {
            optionItems.push(new Option(data[key], key));
        }
       this.append(optionItems);
	}
});

$(function(){
	$('#areaChange').change(function(){
		var sub_domain = $(this).val();
		if(sub_domain.length > 0){
			location.href = 'http://' + sub_domain + '.' + domain;
		}else{
			location.href = 'http://' + domain;
		}
	});
});

function updateSidebar(){
	$.get('/mypage/customers/update_sidebar', function(data){
		$("#sideBarUserInfo").html(data).hide().fadeIn('slow');
	});
}

function addLike(contents_type_id, contents_target_id, callback){
	$.ajax({
		url:"/api/add_like/" + contents_type_id + "/" + contents_target_id ,
		dataType:'json',
		success:function(data){
			data['contents_type_id'] = contents_type_id;
			data['contents_target_id'] = contents_target_id;
			if(callback){
				callback(data);
			}else{
				if(data.status == '1'){
					alert("お気に入りに登録しました");
				}else{
					alert(data.error);
				}
			}
		}
	});
}

function addClip(contents_type_id, contents_target_id, callback , source , pub_date , title){
	$.ajax({
		url:"/api/add_clip/" + contents_type_id + "/" + contents_target_id,
		dataType:'json',
		type:'post',
		data:{
			'source':encodeURIComponent(source),
			'pub_date':pub_date,
			'title':title
			},
		success:function(data){
			data['contents_type_id'] = contents_type_id;
			data['contents_target_id'] = contents_target_id;
			if(callback){
				callback(data);
			}else{
				if(data.status == '1'){
					alert("クリップに登録しました");
				}else{
					alert(data.error);
				}
			}
		}
	});
}

function loginHere(){
	$('#headerLogin a').attr('href', '/users/login/?r=' + location.href).trigger('click');
}

function setRollover(){
	$('img.over').mouseover(function(){ $(this).css('opacity', 0.7);}).mouseout(function(){$(this).css('opacity', 1);}).css('cursor', 'pointer');
}

