<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta name="description" content="育児・施設情報サイト「みんなの育児 [みん育] 」は、育児についての情報、ファミリー向けイベント情報が満載！みんなの育児 [みん育] を活用して、家族でたくさん共有しよう！" />
<meta name="keywords" content="みん育,育児,子供,家族,ファミリー,日本橋" />
<title>みんなの育児 [みん育] 我が家の子育てスタイル <?php echo $current_area_name; ?> | <?php echo $title_for_layout; ?></title>
 <?php echo $this->fetch('meta'); ?>
<link href="/img/miniku_16.ico" rel="shortcut icon" type="image/x-icon" />
<!-- <link href="/img/app-icon.gif" rel="apple-touch-icon" type="image/gif" /> -->
<meta property="og:title" content="みんなの育児 [みん育]  我が家の子育てスタイル">
<meta property="og:type" content="website">
<meta property="og:description" content="育児・施設情報サイト「みんなの育児 [みん育] 」は、育児についての情報、ファミリー向けイベント情報が満載！みんなの育児を活用して、家族でたくさん共有しよう！">
<meta property="og:url" content="http://miniku.net">
<meta property="og:image" content="/img/logo_minnanoikuji.gif">
<meta property="og:site_name" content="みんなの育児 [みん育] ">
<meta property="og:email" content="info@communitylinks.co.jp">
<link href="/common/css/layout.css" rel="stylesheet" type="text/css" />
<link href="/common/css/general.css" rel="stylesheet" type="text/css" />
<?php echo $this->Html->css('system'); ?>
<?php  echo $this->fetch('css'); ?>
<!-- <link href="/css/index.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="/css/mypage.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="/css/nursery_info.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="/css/search.css" rel="stylesheet" type="text/css" /> -->
<link href="/common/js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/common/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/common/js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="/common/js/jquery.page-scroller.js"></script>
<script type="text/javascript" src="/common/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/common/js/heightLine.js"></script>
<!--[if IE]><script type="text/javascript" src="/js/graph_radar_1_0_2/html5jp/excanvas/excanvas.js"></script><![endif]-->

<?php  echo $this->fetch('script'); ?>
<!-- <script type="text/javascript" src="/common/js/jquery.carouFredSel-5.6.4.js"></script> -->
<!-- <script type="text/javascript" src="/common/js/index.js"></script> -->
<!-- <script language="JavaScript" type="text/javascript" src="/common/js/topimg.js"></script> -->
<script type="text/javascript">
$(function(){
	$('.fancybox').fancybox({
		padding: 0,
		width: '548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {
						closeClick : false
						}
				},
		beforeClose	:function(){
			fancyboxBeforeClosed();
		}
	});
	
	$("#gNavi li ul").hide();
	$('#gNavi li:has(ul)').hover(function(){
		$(this).children('ul').show();
	},function(){
		$(this).children('ul').hide();
	});
	$('#gNavi li ul li').hover(
		function(){$(this).fadeTo(0,0.8);},
  		function(){$(this).fadeTo(0,1);}
	 );

	if ($.cookie('miniku_welcome') != '1') {
		$.cookie('miniku_welcome', '1', { domain: '.miniku.net', expires: 1000 });
		window.location = 'https://miniku.net/lp/';
	}

})
var domain = "<?php echo Configure::read('domain'); ?>";
function fancyboxBeforeClosed(){}
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-47114677-1', 'miniku.net');
  ga('send', 'pageview');
</script>
</head>
<body>
<a id="top" name="top"></a>
