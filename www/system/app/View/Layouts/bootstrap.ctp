<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo 'みんなの育児画面'; ?>
		:: <?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap'); ?>
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('bootstrap-responsive'); ?>
	<?php echo $this->Html->css('colorbox'); ?>
	<?php echo $this->Html->css('system'); ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<!--
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<?php echo $this->fetch('script'); ?>
	<?php echo $this->Html->script('bootstrap'); ?>
	<?php echo $this->Html->script('bootstrap-dropdown'); ?>
	<?php echo $this->Html->script('jquery.colorbox-min'); ?>
	<?php echo $this->Html->script('system'); ?>
	
	<script>
	$(function(){
	$('.dropdown-toggle').dropdown()
	});
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
<?php echo $this->Session->flash(); ?>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<!-- <a class="brand" href="/">みんなの育児</a> -->
				<?php $controller = $this->params['controller']; ?>
				<div class="nav-collapse dropdown">
					<ul class="nav">
						
						<li><a href="/admin/">画面TOP</a></li>
						
						 <li class="divider-vertical"></li>
						<li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">マイファミリー <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
								<li><a href="/admin/customers">カスタマー一覧</a></li>
								<li><a href="/admin/families">ファミリー一覧</a></li>
								<li><a href="/admin/children">子供一覧</a></li>
	                      </ul>
						</li>
						 <li class="divider-vertical"></li>
						<li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">施設 <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
								<li><a href="/admin/clients">施設一覧</a></li>
								<li><a href="/admin/users">施設者一覧</a></li>		
								<li><a href="/admin/client_types">施設タイプ一覧</a></li>
	                      </ul>
						</li>
						 <li class="divider-vertical"></li>
						 
						 <li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">育児情報 <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
								<li ><a href="/admin/topics">育児情報</a></li>	
								<li ><a href="/admin/sources">育児情報ソース</a></li>	
							</ul>
						</li>
						 <li class="divider-vertical"></li>
						<li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">交流広場 <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
								<li><a href="/admin/bbs">トピック一覧</a></li>
								<li><a href="/admin/tags">タグ一覧</a></li>
	                    	</ul>
						</li>
						 <li class="divider-vertical"></li>
						 
						<li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">コメント <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
								<li><a href="/admin/comments">コメント一覧</a></li>
								<li><a href="/admin/comment_alerts">コメント通報一覧</a></li>
	                    	</ul>
						</li>
						 <li class="divider-vertical"></li>
						<li><a href="/admin/update_infos">更新情報</a></li>
						
						</li>
						 <li class="divider-vertical"></li>
						<li><a href="/admin/users/logout">ログアウト</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container">
		
		<!-- <h1>Bootstrap starter template</h1> -->

		

		<?php echo $this->fetch('content'); ?>

	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	
	
</body>

</html>
<?php echo $this->element('sql_dump'); ?>
