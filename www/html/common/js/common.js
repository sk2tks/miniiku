//fancybox
$(function(){
	$('.fancybox').fancybox({
		padding: 0,
		width: 548,
		height: 640,
		fitToView   : false,
		autoSize    : true,
		autoScale   : true
	});
});

//menu
$(function(){
	$("#gNavi li ul").hide();
	$('#gNavi li:has(ul)').hover(function(){
		$(this).children('ul').show();
	},function(){
		$(this).children('ul').hide();
	});
	
	
});

//tab
$(function(){
	//carousel_init();
	$('.tabBox').hide();
	$('.tabSection .tabBox').eq(0).show();
	$('.tabSection .linkUl li a').click(function(){
		var ind=$(this).parent('li').index();
	//	location.href = '/mypage?tab=' + ind;
		$(this).parent('li').addClass('on').siblings().removeClass('on');
		$('.tabSection .tabBox').hide();		
		$('.tabSection .tabBox:eq('+ind+')').show();
		if(ind==1){
		carousel_init();//カルーセルの初期化
		if ('function' === typeof initialize)initialize();//マップの初期化
			}
		});
		return false;
	});
	

// //jsSection（コメントの伸縮）
// $(function(){
	// $('.jsSection .no,.jsSection .jsBox').hide();
	// $('.jsSection:eq(0) .no,.jsSection:eq(0) .jsBox').show();
	// $('.jsSection:eq(0) .yes,.jsSection:eq(0) .infoBox').hide();
	// $('.jsSection .yes').click(function(){
		// var eleP=$(this).parents('.jsSection');
		// $(this).hide();
		// eleP.find('.no').show();
		// eleP.find('.infoBox').hide();
		// eleP.find('.jsBox').show();
		// return false;
	// });
// 
	// $('.jsSection .no').click(function(){
		// var eleP=$(this).parents('.jsSection');
		// $(this).hide();
		// eleP.find('.yes').show();
		// eleP.find('.infoBox').show();
		// eleP.find('.jsBox').hide();
		// return false;
	// });
// 
// });
function carousel_init(){
				var toolbar=$('.photoList .photo').clone();
				$('.linkPhoto').carouFredSel({
					prev: '.prev',
					next: '.next',
					auto: false,
					pagination:{
						container:'.photoList .photo',
						anchorBuilder:function(nr, item) {
							return toolbar.find('li').eq(nr-1).clone();
						}
					}
				});
}