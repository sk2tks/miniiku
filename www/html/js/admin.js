$(function(){
	$('#get_zip_info').click(function(){
		var zip = $('#zip').val();
		$.getJSON(
			'/admin/api/get_zip_info/' + zip,
			null,
			function(data){ 
				if(data.length <=0 ){
					alert('その郵便番号からは情報が見つかりませんでした');
					return;
				}
				$('#prefecture').val(data['prefecture_id']);
				$('#municipal').setOptions(data['municipals']);
				$('#area').setOptions(data['areas']);
				$('#municipal').val(data['municipal_id']);			
				$('#address').val(data['city'].concat(data['sub_city']));
				$('#area').val(data['area_id']);
			}
		);
	});
	
	$('#prefecture').change(function(){
		var pref_id = $(this).val();
		$.getJSON(
			'/admin/api/get_municipal/' + pref_id,
			null,
			function(data){
				$('#municipal').setOptions(data, '選択してください');
				$('#area').setOptions([], '選択してください');
				$('#municipal').trigger('change');
			}	
		);
	});
	
	$('#municipal').change(function(){
		var municipal_id = $(this).val();
		$.getJSON(
			'/admin/api/get_area/' + municipal_id,
			null,
			function(data){
				$('#area').setOptions(data,'選択してください');
			}	
		);
	});
	
	$('#contents_type').change(function(){
		var contents_type_id = $(this).val();
		$.getJSON(
			'/admin/api/get_client_type/' + contents_type_id,
			null,
			function(data){
				
				  $("#client_type").setOptions(data,"選択してください");
				 /*
				$('#client_type').empty();
				var optionItems = new Array();
                optionItems.push(new Option("選択してください", ""));
                for (key in data) {
                    optionItems.push(new Option(data[key], key));
                }
                $("#client_type").append(optionItems); */
			}
		);
	});
	
	$('.delete_chk').click(function(){
		
		if($(this).val()){
			$(this).parents('div:first').hide();
		}
	});
	
	$('.delete_chk_client').click(function(){
	
	if($(this).val()){
		$(this).parents('div:first').hide();
	}
});
});

var Uploader = {
	init:function(url){   
	    $('.uploader').fileupload({
	        url: url,
	        dataType: 'json',
	        progressall: function (e, data) {

		        var progress = parseInt(data.loaded / data.total * 100, 10);
		        $(this).parent().nextAll('p.progress:first').find('img.bar').css(
		        //$(this).find('img.bar').css(
		            'width',
		            progress + '%'
		        );
		    },
	        done: function (e, data) {
	        	var self = $(this);
	     
	            $.each(data.result.files, function (index, file) {
	               self.parent().nextAll('input:first').val(file.name);
	               var imageBox = self.parent().nextAll('div.image-box:first').show();
	               
	               //共通で使っているので設定している可能性のあるディレクトリ名をチェックする
	               var url = file.thumb_url == undefined ? file.s_url : file.thumb_url;
	               $('img:first', imageBox).attr('src', url);//s_urlの's'は種別を表す
	               $('input[type=checkbox]', imageBox).attr('checked',false);
	              
	            });
	        }
	    });

	}
	
};
