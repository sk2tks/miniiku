var Uploader = {
	init : function(url) {

		$('.uploader').fileupload({
			url : url,
			dataType : 'json',
			done : function(e, data) {
				var self = $(this);
				var paernt_li = self.parents('li:first');

				$.each(data.result.files, function(index, file) {
					self.nextAll('input:first').val(file.name);
					var imageBox = paernt_li.nextAll('.image-box:first').show();
					$('img:first', imageBox).attr('src', file.thumb_url);

					var delete_image = paernt_li.nextAll('li.delete_image');
					delete_image.show();
					$('input', delete_image).val('');

				});
			}
		});

	}
};

function deleteImage(elem, defaultImage) {
	if(defaultImage == undefined) defaultImage = '/img/common/img/default_img_customer_s.jpg';
	$(elem).next().val('1');
	var li = $(elem).parents('li:first');
	li.hide();
	li.prev('li.image-box').find('img').attr('src', defaultImage);
}

function unRegistCustomer(customerId){
	if(confirm("本当にこのユーザーをファミリーから登録解除してもよろしいですか？")){
		$.get('/mypage/families/unregist_customer/' + customerId, function(data){
			updateFamily();
		});
	}
}

function unRegistChild(childId){
	if(confirm("本当にこの子供をファミリーから登録解除してもよろしいですか？")){
		$.get('/mypage/families/unregist_child/' + childId, function(data){
			updateFamily();
		});
	}
}

function updateFamily(){
	$.get('/mypage/families/profile', function(data){
		$('#familyArea').html(data);
		$('#familyArea').fadeIn('slow');
	});
}
