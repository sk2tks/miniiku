<?php echo $this->Html->css(array('/sp/css/nursery_info'), null, array('inline' => false)); ?>

<style type="text/css">
	/*------------------------------------------------------------
	 pageNavi
	 ------------------------------------------------------------*/
	#main .pagination ul {
		clear: both;
		text-align: center;
	}

	#main .pagination ul li {
		margin: 0 1px;
		display: inline;
		font-size: 12px;
		font-weight: bold;
	}

	#main .pagination ul .on a {
		color: #D1D1D1;
		background-color: #FFF;
	}

	#main .pagination ul li a {
		padding: 5px 8px;
		display: inline-block;
		color: #286A06;
		border: 1px solid #CFCFCF;
	}

	#main .pagination ul li.disabled a {
		padding: 5px 8px;
		display: inline-block;
		color: #CCC;
		border: 1px solid #CCC;
	}

	#main .pageNavi .prev a {
		color: #D4D4D4;
	}

	#main .pageNavi .next a {
		border: 1px solid #CFCFCF;
	}

	/*------------------------------------------------------------
	 tabList
	 ------------------------------------------------------------*/
	#main .tabList a {
		display: block;
	}

	#main .tabList li:first-child a {
		/*background: url(../img/nursery_info/link01_over.jpg) no-repeat;*/
		background: none;
		background-size: 100%;
	}

	#main .tabList li:last-child a {
		/*background: url(../img/nursery_info/link02_over.jpg) no-repeat;*/
		background: none;
		background-size: 100%;
	}

	#main .tabList .on img {
		visibility: visible;
	}

	.inactive {
		filter: alpha(opacity=40);
		opacity: 0.4;
	}
	/*------------------------------------------------------------
	 button
	 ------------------------------------------------------------*/

	#main .button {
		padding-right: 10px;
		float: right;
	}

</style>

	<ul id="pagePath">
		<li><a href="/">HOME</a>&gt;</li>
		<li><?php echo $title_for_layout; ?></li>
	</ul>

	<section id="main">
		<h2><img src="/sp/img/nursery_info/img_h2_01.png" width="20" alt=""><span><?php echo $title_for_layout; ?></span></h2>
		
		
		<div class="productTab">
			<ul class="comUl">

		<?php foreach ($update_infos as $info): ?>
					<li id="topic<?php echo $info['UpdateInfo']['id']; ?>">
						
							<span class="lBox">
								<span class="newList">
									<span class="newTime"><?php echo date('Y.m.d', strtotime($info['UpdateInfo']['created'])); ?></span>
									<span class="newTxt"><?php echo h($info['UpdateInfo']['title']); ?></span>
								</span>
							</span>
							<!-- <span class="btmBox clearfix"></span>
							<span class="rBox"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span> -->
							
					</li>
	<?php endforeach ; ?>
				<!-- <li><a href="#"><span class="lBox"><span class="newList"><span class="newTime">2013.10.10 10:10</span><span class="newTxt">育児に関するニュース……（読売新聞）</span></span><span class="btmBox clearfix"><span class="num">クリップ数 ： 14件</span><span class="btn" data-href="#"><img src="/sp/img/nursery_info/link03.jpg" width="89" alt="クリップ"></span></span></span><span class="rBox"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span></a></li> -->
			
				<!-- </li> -->
			</ul>

<?php echo $this->BootstrapPaginator->pagination(); ?>

		</div>

	</section>
	