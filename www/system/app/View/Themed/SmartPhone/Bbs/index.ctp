<?php //debug($topics);?>
<?php echo $this->Html->css(array('/sp/css/bbs'), null, array('inline' => false)); ?>

<?php echo $this->Html->script("/sp/js/bbs_index", array('inline'=>false)); ?>
<?php //echo $this->Html->script("system", array('inline'=>false)); ?>

<style>
.pagination {
  margin: 20px 0;
}

.pagination ul {
  display: inline-block;
  *display: inline;
  margin-bottom: 0;
  margin-left: 0;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  *zoom: 1;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
     -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
          box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.pagination ul > li {
  display: inline;
}

.pagination ul > li > a,
.pagination ul > li > span {
  float: left;
  padding: 4px 12px;
  line-height: 20px;
  text-decoration: none;
  background-color: #ffffff;
  border: 1px solid #dddddd;
  border-left-width: 0;
}

.pagination ul > li > a:hover,
.pagination ul > li > a:focus,
.pagination ul > .active > a,
.pagination ul > .active > span {
  background-color: #f5f5f5;
}

.pagination ul > .active > a,
.pagination ul > .active > span {
  color: #999999;
  cursor: default;
}

.pagination ul > .disabled > span,
.pagination ul > .disabled > a,
.pagination ul > .disabled > a:hover,
.pagination ul > .disabled > a:focus {
  color: #999999;
  cursor: default;
  background-color: transparent;
}

.pagination ul > li:first-child > a,
.pagination ul > li:first-child > span {
  border-left-width: 1px;
  -webkit-border-bottom-left-radius: 4px;
          border-bottom-left-radius: 4px;
  -webkit-border-top-left-radius: 4px;
          border-top-left-radius: 4px;
  -moz-border-radius-bottomleft: 4px;
  -moz-border-radius-topleft: 4px;
}

.pagination ul > li:last-child > a,
.pagination ul > li:last-child > span {
  -webkit-border-top-right-radius: 4px;
          border-top-right-radius: 4px;
  -webkit-border-bottom-right-radius: 4px;
          border-bottom-right-radius: 4px;
  -moz-border-radius-topright: 4px;
  -moz-border-radius-bottomright: 4px;
}

.pagination-centered {
  text-align: center;
}

.pagination-right {
  text-align: right;
}


.inactive {
    filter: alpha(opacity=40);
    opacity: 0.4;
}

.span04 {
	background: url(/img/market/img_04.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span05 {
	background: url(/img/market/img_05.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span06 {
	background: url(/img/market/img_06.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span07 {
	background: url(/img/market/img_07.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span08 {
	background: url(/img/market/img_08.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span09 {
	background: url(/img/market/img_09.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}

.span10 {
	background: url(/img/index/img_10.gif) no-repeat left 1px;
	float:left;
	padding-left:20px;
}


</style>

<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>
<section id="main">
	<h2><img src="/sp/img/market/img_h2.png" alt="" width="23"><span>交流広場</span></h2>
	<h3 class="comH3Ttl"><img src="<?php echo $catIcon; ?>" alt="" width="18"><?php echo $catName; ?></h3>
	<?php echo $this->Form->create('search', array('type' => 'post' , 'url' => '/bbs/index/'.$catSlug.'/'));?>
	<div class="formBox clearfix">
		<dl class="clearfix">
			<dd>
				<?php if($is_index):
					echo $this->Form->input( 'category_id', array(
					    'type' => 'select',
					    'options' => $category_list,
					    'empty' => 'カテゴリ',
					    'label' => false
					));
					else:
					echo $this->Form->input( 'tag_id', array(
					    'type' => 'select',
					    'options' => $tags,
					    'empty' => 'タグ',
					    'label' => false
					));
					endif; ?>
			</dd>
		</dl>
		<ul class="clearfix">
			<?php if(strpos($this->here, 'num_comments') === false){ ?>
				<li><img class="inactive" src="/img/market/link01_o.jpg" width="100%" alt="掲載日時順" /></li>
				<li><a href="/bbs/index/<?php echo $catSlug; ?>/sort:num_comments/direction:desc"><img class="btn" src="/img/market/link02_o.jpg" width="100%" alt="コメント数順" /></a></li>
			<?php }else{ ?>
				<li><a href="/bbs/index/<?php echo $catSlug; ?>/sort:created/direction:desc"><img class="btn" src="/img/market/link01_o.jpg" width="100%" alt="掲載日時順" /></a></li>
				<li><img class="inactive" src="/img/market/link02_o.jpg" width="100%" alt="コメント数順" /></li>
			<?php } ?>
		</ul>
	</div>
	<div class="searchBox clearfix">
		<dl class="formDl clearfix">
			<dt>
				<!--<input class="fKeyword" type="text" value="絞り込みキーワード" name="keyword">-->
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
				<input type="image" class="fSearch" name="search" src="/sp/img/nursery_info/img_search.gif" value="" alt="">
			</dd>
		</dl>
		<div class="link"><a href="/bbs/add/<?php echo $catSlug;?>" id='newTopic'><img src="/sp/img/market/ind_btn03.jpg" alt="新規トピック" width="100%"></a></div>
	</div>
	<?php echo $this->Form->end(); ?>
	<div class="productTab">
		<ul class="comUl">
		<?php foreach ($topics as $topic) { ?>
				<li id="topic<?php echo $topic['Topic']['id']; ?>">
					<div class="lBox heightLine-1">
						<div class="btmBox clearfix">
						<dl>
							<dt class="newTime"><?php echo $this->Html->pr_datetime($topic['Topic']['created']);?>
								<span class="num">コメント数 ： <?php echo $topic['Topic']['num_comments'];?>件</span>
								</dt>
							<dd class="newTxt"><a href="/bbs/view/<?php echo $topic['Topic']['id'];?>"><?php echo h($topic['Topic']['title']);?></a></dd>
						</dl>
							<?php if($is_index): ?>
							<?php printf("<span class='span%02d'>%s</span>", $topic['Category']['id'], $topic['Category']['category_name']); ?>
							<?php else: ?>
							<span>タグ ： <?php echo $topic['Tag']['word']?></span><br>
							<?php endif; ?>
							<div class="btn">
								<a href="#">
									<?php if(empty($topic['FamilyLike'])){ ?>
									<img src="/sp/img/market/ind_btn04.jpg" width="89" alt="お気に入り"
										onclick="addLike(<?php printf('%s,%s', 7, $topic['Topic']['id']); ?>,onFamilyLikeSuccess);"/>
									<?php }else{ ?>
									<img src="/sp/img/market/ind_btn04.jpg" width="89" alt="お気に入り" class="inactive" />
									<?php } ?>
								</a>
							</div>
						</div>
					</div>
					<span class="rBox heightLine-1" data-href="/bbs/view/<?php echo $topic['Topic']['id'];?>"><img src="/sp/img/nursery_info/img.gif" width="10" alt=""></span>
				</li>
			<?php } ?>
		</ul>
		<ul class="pageNavi">
			<?php echo $this->BootstrapPaginator->pagination(); ?>
		</ul>
	</div>
</section>

<!-- category window -->
<?php if($is_index): ?>
<div id='categorySelect' style='display:none'>
<div id='conts'>
<div  class="childbirth clearfix" style=' background-color:#FDD; padding:15px;'>
	<h2>投稿するトピックのカテゴリを<br />選択してください</h2>
	<dl class="clearfix">
		<dt>　</dt>
		<dd>
			<ul class="clearfix">
				<?php foreach($categories as $category):?>
				<li>
					<label>
						<input type="radio" value="<?php echo $category['Category']['slug']?>" name="category" <?php if($category['Category']['slug'] == $catSlug){echo 'checked="checked"';}?> />
						<?php echo $category['Category']['category_name']?></label>
				</li>
				<?php endforeach; ?>
			</ul>
		</dd>
	</dl>

	<div style='text-align:center;padding:15px 0 0 0;clear:both; '>
		<input type='button' value='戻る' onclick='parent.$.fancybox.close();'>　
		<input type='button' value='次に進む' onclick='checkCategory();'>
	</div>


</div>
</div>
</div>
<script>
function checkCategory(){
	var v = $("input[name=category]:checked").val();
	if(!v){
		alert("カテゴリを選択してください");
		return;
	}
	parent.location.href='/bbs/add/' + v;
}
$('#newTopic').click(function(){
	$.fancybox.open({
		href:'#categorySelect',
		autoWidth: true,
		autoCenter	:true,
		autoResize	:true,
		fitToView   : true,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		closeBtn	: false,
		margin		: 20,
		helpers		: {'overlay' : {closeClick : false}}
	})
	return false;
})

</script>
<?php endif; ?>
