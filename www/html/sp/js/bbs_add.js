var Uploader = {
	init:function(url){ 
	    $('.uploader').fileupload({
			url: url,
			dataType: 'json',
			done: function (e, data) {
				// console.log('fileuploadのdoneイベントの引数dataのresult:');
				// console.log(data.result);
	        	
	        	var self = $(this);
	        	
				$.each(data.result.files, function (index, file) {
					// console.log('file:');console.log(file);
					//hiddenにファイル名をアサイン
					self.nextAll('input:first').val(file.name);
					
					var $pic = self.parent().nextAll('.pic');
					var $noImage = self.parent().nextAll('.noImage');
					var $delete_chk = self.parent().nextAll('.delete_chk');
					
					$pic.attr('src', file.list_url).show();
					$noImage.hide();
					$delete_chk.show();
					$delete_chk.next().val('');
					
					/*
					var $divPic = self.parent().next().find('li:first > div.pic').removeClass('pic');
					// console.log('$divPic:');console.log($divPic);
					//imgタグのsrcにファイルのlist_urlをアサイン
					$('img:first', $divPic).attr('src', file.list_url).show();
					
					var $divBatsu = $divPic.find('div.batsu');
					$divBatsu.find('.delete_chk').show();
					$('input', $divBatsu).val('');
					*/
				});
	        }
	    });
	}
};
$(function(){
	//画像削除ボタン
	$('.delete_chk').click(function(){
		$(this).next().val('1');
		var $pic = $(this).prevAll('.pic').attr('src', '');
		var noImage = $(this).prevAll('.noImage').show();
		$(this).hide();
	});
	$('.delete_chk')/*.css('float', 'right')*/.hide();
	Uploader.init('/bbs/upload');
});

$(function(){
	//「カテゴリ」ラジオボタン
	$('select[name="category"]').change(function(){
		var cat = $(this).val();
		console.log('cat:' + cat);
		location.href = '/bbs/add/' + cat;
	});
	
	//「追加」ボタン（タグ追加）
	$('input[name="add"]').click(function(){
		//タグとして入力されたテキスト
		var word = $('#tagInput').val();
		
		//wordがoptionsに既存ならそれを選択、そうでないならoptionsの最後に追加し
		//valueを"__add__"+word としておく。保存したらControllerでtagsテーブルに登録する。
		var found = false;
		$('select#TopicTagId option').each(function(){
			if($(this).text() == word){
				found = true;
				$('select#TopicTagId').val($(this).val());
				return false;//each()をbreakする。
			}
		});
		if(!found){
			$('<option />')
				.attr('value', '__add__' + word)
				.text(word)
				.appendTo($('select#TopicTagId'));
			$('select#TopicTagId').val('__add__' + word);
		}
	});
	
	//登録ボタン
	$('#submit_btn').click(function(){
		var title = $.trim( $('input[name="data[Topic][title]"]').val() );
		var body = $.trim( $('textarea[name="data[Topic][body]"]').val() );
		if(title == ''){
			alert('見出しを入力してください');
		}else if(body == ''){
			alert('本文を入力してください');
		}else if(confirm('登録します。よろしいですか？')){
			$('#TopicAddForm').submit();
		}
	});
});