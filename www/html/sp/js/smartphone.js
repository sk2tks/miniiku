$(function(){
	setting();
	setTimeout(doScroll, 100);
	window.addEventListener('load', function(){ setTimeout(doScroll, 100); },false);
	window.onorientationchange = function(){ setTimeout(doScroll, 100); }
	
	$("a").bind({
		touchstart: function () {
		  $(this).addClass("touch");
		}
	 });
	 
	 $("a").bind({
		touchend: function () {
		  $(this).removeClass("touch");
		}
	 });

	 initPageScroll();
	$(window).scroll(initPageScroll);
	$('.pageTop').hover(function(){
		var winTop = $(document).scrollTop();
		if(winTop>100){
			$(this).stop().fadeTo(500,1);
		}else{
			$('.pageTop').fadeTo(500,0,function(){
				$(this).hide();	
			});
		}
	},function(){
		var winTop = $(document).scrollTop();
		if(winTop>100){
			$(this).stop().fadeTo(500,.5);
		}else{
			$('.pageTop').fadeTo(500,0,function(){
				$(this).hide();	
			});
		}
	});

	$('.comUl .btn,.comUl .rBox').click(function(){
		var datahref = $(this).attr('data-href');
		window.location.href = 	datahref;
		return false;
	});
});

function setting(){
	tilt();

	var agent = navigator.userAgent;
	if(agent.search(/iPhone/) != -1){
		$("body").addClass("iphone");
		window.onorientationchange = tilt;
	}else if(agent.search(/Android/) != -1){
		$("body").addClass("android");
		window.onresize = tilt;
	}
}

function tilt(){
	var orientation = window.orientation;
	if(orientation == 0){
		$("body").addClass("portrait");
		$("body").removeClass("landscape");
	}else{
		$("body").addClass("landscape");
		$("body").removeClass("portrait");
	}
}

function doScroll() {
	if (window.pageYOffset === 0) { window.scrollTo(0,1); }
}

//menu
$(function(){
	$('#gNavi .menu').hide();
	$('#gNavi li:has(.menu) >a').click(function(){
		var child=$(this).parent('li').find('.menu');
		if(child.is(':visible')){
			$(this).removeClass('on');
			child.slideUp();
		}else{
			$('#gNavi li .menu').hide();
			$('#gNavi li > a').removeClass('on');
			$(this).addClass('on');
			child.slideDown();
		};
		return false;
	});
});

//search
$(function(){
	$('#gHeader .hSearch').hide();
	$('#gHeader .rBox .hLink .searchLink a').click(function(){
		$('#gHeader .hSearch').slideToggle();
		return false;
	});
});

//jsBox 
function sInit(){
	var fooLen = $('.foo li').length;
	var sWidth = $(".fooSpace img").width();
	var sHeight= $(".fooSpace img").height();
	$('.foo,.foo li img').width(sWidth).height(sHeight);
	$('.foo ul').carouFredSel({
		auto: 5000,
		scroll:{
			onAfter:function(){
				$(this).trigger("currentPosition", function( pos ) {
					$('.fooBox .num').text(pos+1+'/'+fooLen);
				});
			}
		},
		width:sWidth,
		height:sHeight,
		prev: ".fooBox .prev",
		next: ".fooBox .next",
		swipe: {
			onMouse: true,
			onTouch: true
		}
	});
}

//tab
$(function(){
	$('.tabSection .subTabBox').hide();
	$('.tabSection .subTabBox').eq(0).show();

	$('.tabSection .subTab li a').click(function(){
		var ind=$(this).parent('li').index();
		$(this).parent('li').addClass('on').siblings().removeClass('on');
		$('.tabSection .subTabBox').hide();		
		$('.tabSection .subTabBox:eq('+ind+')').show();
		setTimeout(function(){
			sInit();
		},500);
		$(window).resize(function(){
			sInit();
		});

		return false;
	});
});

$(function(){
	$('.jsSection .no,.jsSection .detailBox').hide();
	$('.jsSection:eq(0) .no,.jsSection:eq(0) .detailBox').show();
	$('.jsSection:eq(0) .yes,.jsSection:eq(0) .briefBox').hide();
	$('.jsSection .yes').click(function(){
		var eleP=$(this).parents('.jsSection');
		$(this).hide();
		eleP.find('.no').show();
		eleP.find('.briefBox').hide();
		eleP.find('.detailBox').show();
		return false;
	});

	$('.jsSection .no').click(function(){
		var eleP=$(this).parents('.jsSection');
		$(this).hide();
		eleP.find('.yes').show();
		eleP.find('.briefBox').show();
		eleP.find('.detailBox').hide();
		return false;
	});

});

//tab02
$(function(){
	$('#main .productTab:eq(0)').show().siblings('#main .productTab').hide();
	$('#main .tabList li').click(function(){
		var ind=$(this).index();
		$(this).addClass('on').siblings('li').removeClass('on');			
		$('#main .productTab:eq('+ind+')').show().siblings('.productTab').hide();
		return false;
	});
});

var showFlug = false;
function initPageScroll(){
	var winTop = $(document).scrollTop();
	if (winTop > 100) {
		if (showFlug == false) {
			showFlug = true;
			$('.pageTop').show().fadeTo(500,.5);
		}
	} else {
		if (showFlug) {
			showFlug = false;
			$('.pageTop').fadeTo(500,0,function(){
				$(this).hide();	
			});
		}
	}
}

$(function(){
	$('.fNavi ul').hide();
	$('.fNavi >li').children('a').attr('href','javascript:void(0);');
	$('.fNavi > li:has(ul) >a').click(function(){
		var ele=$(this).next('ul');
		if(ele.is(':visible')){
			$(this).removeClass('open');
			ele.slideUp();
		}else{
			$('.fNavi li:has(ul)>a').removeClass('open');
			$('.fNavi ul').slideUp();
			$(this).addClass('open');
			ele.slideDown();
		};
		return false;
	});

});