<?php echo $this->Html->css(array('searchtop'), null, array('inline' => false)); ?>

<style>
#conts .formBox .formDl {
float: right;
text-align: right;
width: 250px;
}
#conts .formBox .formDl dt {
float: left;
width: 69px;
font-size: 1.3em;
margin-top: 6px;
}
#conts .result{
	font-size:20px;
	text-align: center;
}
</style>

			<h2 class="indexH2">横断検索結果</h2>
			<ul id="pagePath">
				<li><a href="../">HOME</a>&gt;</li>
				<li>横断検索結果一覧</li>
			</ul>
			<div class="formBox clearfix">
            
            
				<dl class="formDl clearfix">
					<dt>絞り込み：</dt>
					<dd>
			<?php echo $this->Form->create(false,array('url'=>array(
				'controller'=>'Top',
				'action'=>'search'
				),
			'type'=>'get'
			)
			);?>
			<?php

$value = (isset($this->request->query['keyword']))?$this->request->query['keyword']:'';
			 echo $this->Form->input('keyword' ,array('type'=>'hidden' ,'value' => $value));?>
			<?php echo $this->Form->input('keyword2' ,array('class'=>'fKeyword' , 'label' => false , 'placeholder' => 'キーワード'));?>

						<input type="image" onClick="void(this.form.submit());return false" alt="" value="" src="../img/search/img_search.gif" name="search" class="fSearch" />
			<?php echo $this->Form->end();?>
					</dd>
				</dl>
                
						<div class="dateUl clearfix">
							<ul>
								<li class="liSpecial02">件数 ：</li>
								<li class="liSpecial04"><span><?php echo $count;?></span></li>
                                <li class="liSpecial02">件</li>
							</ul>
						</div>
      </div>
            
		<?php if(isset($results)){ ?>
			<ul class="resultUl">
				<!-- loop start -->
				<?php for($i=0 ; $i<count($results) ; $i++){ ?>
				<li <?php if($i%2)echo 'class="bgColor"';?>>
					<?php if(isset($results[$i][0]['contents_type_id']) && ($results[$i][0]['contents_type_id'] < 6)){ //施設?>
						<dl>
							<dt><a href="/clients/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								TEL:<?php echo ($results[$i][0]['tel'])?h($results[$i][0]['tel']):'';?>　<?php echo ($results[$i][0]['zip'])?'〒'.$this->Html->pr_zip(h($results[$i][0]['zip'])):'';?> <?php echo ($results[$i][0]['address'])?h($results[$i][0]['address']):'';?></dd>
						</dl>
					<?php }else if (isset($results[$i][0]['contents_type_id']) && ($results[$i][0]['contents_type_id'] == 6)){ //育児情報?>
						<dl>
							<dt><a href="<?php echo @$results[$i][0]['url']?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								</dd>
						</dl>

					<?php }else{//交流広場?>
						<dl>
							<dt><a href="/bbs/view/<?php echo  ($results[$i][0]['id'])?h($results[$i][0]['id']):'';?>"><?php echo ($results[$i][0]['name'])?h($results[$i][0]['name']):'';?></a></dt>
							<dd>更新日時： <?php echo $this->Html->pr_datetime(h($results[$i][0]['modified']));?><br />
								</dd>
						</dl>

					<?php } ?>
				</li>
				<?php } ?>
				<!-- loop end -->
			</ul>
			<?php
					$current_page = (isset($this->request->params['named']['page']))?$this->request->params['named']['page']:1;
					$total_pages = ceil($count/$limit);
					$query = '';
					if($keyword)$query.='?keyword='.$keyword;
					if($keyword2)$query.='&keyword2='.$keyword2;

 ?>
			<ul class="comList">
				<li class="prev"><?php if($current_page>1)echo '<a href="/Top/search/page:'.($current_page - 1).'/'.$query.'">&lt;&lt;</a>';?> |</li>

				<?php for ($i=1 ; $i<=$total_pages; $i++){ ?>
					<?php
						if($current_page != $i){
							echo '<li><a href="/Top/search/page:'.$i.'/'.$query.'">'.$i.'</a><li> |';
						}else{
							echo '<li class="on">'.'<a>'.$i.'</a><li> |';
						}
					?>
				<?php } ?>

				<li class="next"><?php if($total_pages-$current_page>=1)echo '<a href="/Top/search/page:'.($current_page + 1).'/'.$query.'">&gt;&gt;</a>';?></li>
			</ul>
		<?php }else{ ?>
		<p class="result">検索結果はありません</p>
		<?php } ?>
	<div class="pageTop"><a href="#top">トップへ移動する</a></div>




