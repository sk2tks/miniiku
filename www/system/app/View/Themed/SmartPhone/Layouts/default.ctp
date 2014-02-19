<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<?php echo $this->fetch('meta'); ?>
<title>みんなの育児 我が家の子育てスタイル <?php echo $current_area_name; ?> | <?php echo $title_for_layout; ?></title>
<link rel="stylesheet" href="/sp/css/common.css">
<link rel="stylesheet" href="/sp/css/form.css">
<?php echo $this->fetch('css'); ?>

<script src="/sp/js/jquery.js"></script>
<script src="/sp/js/fancybox/jquery.fancybox.js"></script>
<script src="/sp/js/smartphone.js"></script>
<script src="/sp/js/jquery.page-scroller.js"></script>
<script src="/sp/js/fancybox.js"></script>
<script>
$(function(){
	$('.indTabBox .news:eq(0)').show().siblings('.news').hide();
	$('.indTab li').click(function(){
		var ind=$(this).index();
		$('.indTab li').removeClass('on');
		$(this).addClass('on');
		$('.indTabBox .news').hide();
		$('.indTabBox .news:eq('+ind+')').show();
		return false;
	});
});
</script>
<script type="text/javascript">
$(function(){
	var setImg = '.mainImg ul';
	var fadeSpeed = 1500;
	var switchDelay = 5000;

	$(setImg).children('li').css({opacity:'0'});
	$(setImg + ' li:first').stop().animate({opacity:'1',zIndex:'20'},fadeSpeed);

	setInterval(function(){
		$(setImg + ' li:first-child').animate({opacity:'0'},fadeSpeed).next('li').animate({opacity:'1'},fadeSpeed).end().appendTo(setImg);
	},switchDelay);
});
</script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('system', true); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-47114677-1', 'miniku.net');
  ga('send', 'pageview');

	$(function(){
		$('.fancybox').fancybox({
			padding: 0,
			width		: '98%',//'548px',
			autoSize	: true,
			fitToView   : false,
			autoSize    : true,
			autoScale   : true,
			scrolling	: 'no',
			helpers		: {'overlay' : {closeClick : false}},
			beforeClose	:function(){
				fancyboxBeforeClosed();
			}
		});
	})
	var domain = "<?php echo Configure::read('domain'); ?>";
	function fancyboxBeforeClosed(){}
</script>
</head>
<body>
<a id="top" name="top"></a>
<article id="container">
	<?php echo $this->element('header'); ?>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('footer'); ?>
</article>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>