<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo 'みんなの育児管理画面'; ?>
		:: <?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('bootstrap-responsive.min'); ?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	
	<?php echo $this->fetch('script'); ?>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->Html->script('jquery.colorbox-min'); ?>
	<?php echo $this->Html->script('system'); ?>
	<script>
		function addUser(id, name){
			parent.addUser(id, name);
		}
	</script>
</head>

<body>
	<h4 >施設管理者一覧</h4>
	<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>ID</th>
			<th>名前</th>
			<th>Email</th>
			<th> </th>
		</tr>
	</thead>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<td class="actions">
				<a class="btn btn-mini" href="javascript:void(0);" onclick='addUser(<?php echo $user['User']['id']; ?>,"<?php echo $user['User']['name']; ?>")'><i class="icon-plus"></i>追加</a>
				
				
			</td>
		</tr>
	<?php endforeach; ?>
	</table>

	<?php echo $this->BootstrapPaginator->pagination(); ?>
	
</body>
</html>