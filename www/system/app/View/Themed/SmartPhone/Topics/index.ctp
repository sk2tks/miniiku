<?php echo $this->Html->css(array('/sp/css/nursery_info'), null, array('inline' => false)); ?>
<script type="text/javascript" src="/sp/js/topic_search.js"></script>
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
	background:none;
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

#main .button{
	padding-right: 10px;
	float: right;
}


</style>

	<ul id="pagePath">
		<li><a href="/">HOME</a>&gt;</li>
		<li><?php echo $title_for_layout; ?></li>
	</ul>
	<?php if($title_for_layout == '街の告知板一覧'){
	$cls = 'h2_02';
}else if($title_for_layout == '地域イベント一覧'){
	$cls = 'h2_03';
}else if($title_for_layout == '育児情報一覧'){
	$cls = 'h2_01';
}else{
	$cls = 'h2_01';
}
?>
<section id="main">
	<h2><img src="/sp/img/nursery_info/img_<?php echo $cls;?>.png" width="20" alt=""><span><?php echo $title_for_layout; ?></span></h2>
	<div class="formBox clearfix">
		<dl class="clearfix">
			<dt>表示：</dt>
			<dd>
			<?php echo $this->Form->input( 'source_id', array(
			    'type' => 'select',
			    'options' => $sources,
			    'empty' => '情報ソース',
			    'label' => false,
			//  'selected' => $selected  // 規定値をvalueで指定
			)); ?>
			</dd>
		</dl>
		<ul class="clearfix">
			<?php
			$here = $this->here;
			$here = preg_replace('/\/sort.+$/', '', $here);
			?>
			</li>
			<?php if(strpos($this->here, 'num_clips') === false){ ?>
				<li><img class="inactive" src="/img/nursery_info/link01_o.jpg" width="100%" alt="掲載日時順" /></li>
				<li><a href="<?php echo $here; ?>/sort:num_clips/direction/direction:desc"><img class="btn" src="/img/nursery_info/link02_o.jpg" width="100%" alt="クリップ数順" /></a></li>
			<?php }else{ ?>
				<li><a href="<?php echo $here; ?>/sort:pub_date:desc"><img class="btn" src="/img/nursery_info/link01_o.jpg" width="100%" alt="掲載日時順" /></a></li>
				<li><img class="inactive" src="/img/nursery_info/link02_o.jpg" width="100%" alt="クリップ数順" /></li>
			<?php } ?>
			</ul>
	</div>
	<dl class="formDl clearfix">
		<dt>
			<?php
				echo $this->Form->input('keyword', array(
					'type'=>'text',
					'div'=>false,
					'label'=>false,
					'class'=>'fKeyword',
					'placeholder'=>'キーワード'
				));
			?>
		</dt>
		<dd>
			<input class="fSearch" type="image" name="search" src="/sp/img/nursery_info/img_search.gif" value="" alt="">
		</dd>
	</dl>
	<div class="productTab">
		<ul class="comUl">
		<?php foreach ($topics as $topic) { ?>
				<li id="topic<?php echo $topic['Topic']['id']; ?>">
					<div class="lBox heightLine-1">
						<div class="btmBox clearfix">
						<dl>
							<dt class="newTime"><?php echo $this->Html->pr_datetime($topic['Topic']['created']);?>
								<span class="num">クリップ数 ： <?php echo (h($topic['Topic']['num_clips']))?h($topic['Topic']['num_clips']):'-';?>件</span>
								</dt>
							<dd class="newTxt">
								<a target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><?php echo h($topic['Topic']['title']);?></a>
							</dd>
						</dl>
						<a target="_blank" href="<?php echo h($topic['Source']['url']);?>"><?php echo h($topic['Source']['name']);?></a>
						<a href="#">
							<?php if(empty($topic['FamilyClip'])){ ?>
							<span class="button" style="z-index:10;">
								<span class="clip_btn" ><img onclick="javascript:addClip(6 , <?php echo h($topic['Topic']['id']);?>,onFamilyClipSuccess ,
									'<?php echo rawurlencode(h($topic['Topic']['source_url']));?>' , '<?php echo h($topic['Topic']['pub_date']); ?>' ,
									'<?php echo h($topic['Topic']['title']); ?>');" src="/sp/img/nursery_info/link03.jpg" width="89" alt="クリップ" /></span>
							</span>
							<?php }else{ ?>
							<span class="button">
								<span class="clip_btn"><img class="inactive" src="/sp/img/nursery_info/link03.jpg" width="89" alt="クリップ" /></span>
							</span>
						<?php } ?>
						</a>
						</div>
					</div>
					<span class="rBox heightLine-1" target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span>
				</li>
			<?php } ?>
		</ul>
	<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
</section>
