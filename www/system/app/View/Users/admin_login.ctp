<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>みん育管理画面::管理者ログイン</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="/css/bootstrap.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 40px;
				padding-bottom: 40px;
				background-color: #f5f5f5;
			}

			.form-signin {
				max-width: 300px;
				padding: 19px 29px 29px;
				margin: 0 auto 20px;
				background-color: #fff;
				border: 1px solid #e5e5e5;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
				box-shadow: 0 1px 2px rgba(0,0,0,.05);
			}
			.form-signin .form-signin-heading, .form-signin .checkbox {
				margin-bottom: 10px;
			}


		</style>
		

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->


	</head>

	<body>

		<div class="container">

			<!-- <form class="form-signin"> -->
			<?php echo $this->BootstrapForm->create('User', array('class'=>'form-signin', 'inputDefaults'=>array('label'=>false))); ?>
				<h3 class='text-center'>管理者ログイン</h3>
				<?php echo $this->BootstrapForm->input('email', array('class'=>'input-block-level', "placeholder"=>"Email")); ?>
				<?php echo $this->BootstrapForm->input('password', array('class'=>'input-block-level', "placeholder"=>"Password")); ?>
				
				<div class='text-center'>
				<button class="btn " type="submit">
					ログイン
				</button>
				<p style='padding:15px 0 0 0 ;'><?php echo $this->Html->link('本サイトへ', '/'); ?></p>
				</div>
			<?php echo $this->BootstrapForm->end(); ?>
			

		</div>
		<!-- /container -->

	</body>
</html>