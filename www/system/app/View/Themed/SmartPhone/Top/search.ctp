<?php echo $this->Html->css(array('/sp/css/search'), null, array('inline' => false)); ?>

<style>
.result{
	font-size:20px;
	text-align: center;
}
</style>

	<ul id="pagePath">
		<li><a href="../">HOME</a>&gt;</li>
		<li>横断検索結果一覧</li>
	</ul>
	<section id="main">

<h2><img src="/sp/img/search/ind_img_h2_01.png" alt="" width="18"><span>横断検索結果</span></h2>
		<div class="search clearfix">
			<p class="num">件数：<span class="txt"><?php echo $count;?></span>件</p>
			<span class="btn"><?php echo $this->Form->create(false,array('url'=>array(
				'controller'=>'Top',
				'action'=>'search'
				),
			'type'=>'get'
			)
			);?>
			<?php
$value = (isset($this->request->query['keyword']))?$this->request->query['keyword']:'';
			 echo $this->Form->input('keyword' ,array('type'=>'hidden' ,'value' => $value));?>
			<?php echo $this->Form->input('keyword2' ,array('class'=>'fKeyword' , 'label' => false , 'placeholder' => '絞り込みキーワード'));
			?>
						<input type="image" onClick="void(this.form.submit());return false" alt="" value="" src="/sp/img/search/img_search.gif" name="search" class="fSearch" />
			<?php echo $this->Form->end();?></span><!-- end -->
		</div>
			

      
            
			<ul class="comUl_s">
				<?php if(isset($results)){ ?>
				<!-- loop start -->
				<?php for($i=0 ; $i<count($results) ; $i++){ ?>

				<li <?php if($i%2)echo 'class="bgColor"';?>>
					<?php if(isset($results[$i][0]['contents_type_id']) && ($results[$i][0]['contents_type_id'] < 6)){ //施設?>


			<li><a href="/clients/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><span class="lBox"><span class="newList"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></span><span class="newTime">更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?></span><span class="btmBox clearfix"><span class="num">TEL:<?php echo ($results[$i][0]['tel'])?h($results[$i][0]['tel']):'';?><br />
				<?php echo ($results[$i][0]['zip'])?'〒'.$this->Html->pr_zip(h($results[$i][0]['zip'])):'';?> <?php echo ($results[$i][0]['address'])?h($results[$i][0]['address']):'';?></span></span></span><span class="rBox"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span></a></li>




			<!-- 			<dl>
							<dt><a href="/clients/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								TEL:<?php echo ($results[$i][0]['tel'])?h($results[$i][0]['tel']):'';?>　<?php echo ($results[$i][0]['zip'])?'〒'.$this->Html->pr_zip(h($results[$i][0]['zip'])):'';?> <?php echo ($results[$i][0]['address'])?h($results[$i][0]['address']):'';?></dd>
						</dl> -->
					<?php }else if (isset($results[$i][0]['contents_type_id']) && ($results[$i][0]['contents_type_id'] == 6)){ //育児情報?>

			<li><a href="<?php echo @$results[$i][0]['url']?>"><span class="lBox"><span class="newList"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></span><span class="newTime">更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?></span><span class="btmBox clearfix"></span></span><span class="rBox"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span></a></li>
			

<!-- 
						<dl>
							<dt><a href="<?php echo @$results[$i][0]['url']?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								</dd>
						</dl> -->

					<?php }else{//交流広場?>

			<li><a href="/bbs/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><span class="lBox"><span class="newList"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></span><span class="newTime">更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?></span><span class="btmBox clearfix"></span></span><span class="rBox"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span></a></li>


<!-- 						<dl>
							<dt><a href="/bbs/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								</dd>
						</dl> -->

					<?php } ?>
				</li>
				<?php } ?>
				<!-- loop end -->
				<?php }else{ ?>
				<p class="result">検索結果はありません</p>
				<?php } ?>
			</ul>
			<?php
					$current_page = (isset($this->request->params['named']['page']))?$this->request->params['named']['page']:1;
					$total_pages = ceil($count/$limit);
					$query = '';
					if($keyword)$query.='?keyword='.$keyword;
					if($keyword2)$query.='&keyword2='.$keyword2;

 ?>
			<ul class="pageNavi">
				<li class="prev"><?php if($current_page>1)echo '<a href="/Top/search/page:'.($current_page - 1).'/'.$query.'">&lt;&lt;</a>';?></li>

				<?php for ($i=1 ; $i<=$total_pages; $i++){ ?>
					<?php
						if($current_page != $i){
							echo '<li><a href="/Top/search/page:'.$i.'/'.$query.'">'.$i.'</a><li>';
						}else{
							echo '<li class="on">'.'<a>'.$i.'</a><li>';
						}
					?>
				<?php } ?>

				<li class="next"><?php if($total_pages-$current_page>=1)echo '<a href="/Top/search/page:'.($current_page + 1).'/'.$query.'">&gt;&gt;</a>';?></li>
			</ul>

			</section>
			<div class="pageTop"><a href="#top">トップへ移動する</a></div>





