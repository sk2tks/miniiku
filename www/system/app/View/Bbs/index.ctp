<?php //debug($topics);?>
<?php //$this->Html->css('bootstrap', null, array('inline' => false)); ?>
<?php $this->Html->css('/common/js/fancybox/jquery.fancybox.css', null, array('inline'=>false)); ?>
<?php $this->Html->css('market', null, array('inline' => false)); ?>
<?php echo $this->Html->script("bbs_index", array('inline'=>false)); ?>
<?php echo $this->Html->script("system", array('inline'=>false)); ?>

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

.btn {
	cursor: pointer;
}
.btn:hover {
    filter: alpha(opacity=70);
    opacity:0.7;
}
.inactive {
    filter: alpha(opacity=40);
    opacity: 0.4;
}
</style>

<h2 class="h2Ttl">交流広場</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>
<div class="market index">
	<div class="subMarket">
	<h3><span style="background-image: url('<?php echo $catIcon; ?>')"><?php echo $catName; ?></span>
		<div class="title_box2"><a id='newTopic' href="/bbs/add/<?php echo $catSlug;?>">
			<img class="btn" src="/img/market/link06.jpg" width="159" height="37"  alt="新規トピック" /></a>
	</div></h3>
	<?php echo $this->Form->create('search', array('type' => 'post' , 'url' => '/bbs/index/'.$catSlug.'/'));?>
	<div class="formBox clearfix">
		<dl class="formDl clearfix">
			<dt></dt>
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
				<li><img class="inactive" src="/img/market/link01_o.jpg" width="99" height="26" alt="掲載日時順" /></li>
				<li><a href="/bbs/index/<?php echo $catSlug; ?>/sort:num_comments/direction:desc"><img class="btn" src="/img/market/link02_o.jpg" width="116" height="26" alt="コメント数順" /></a></li>
			<?php }else{ ?>
				<li><a href="/bbs/index/<?php echo $catSlug; ?>/sort:created/direction:desc"><img class="btn" src="/img/market/link01_o.jpg" width="99" height="26" alt="掲載日時順" /></a></li>
				<li><img class="inactive" src="/img/market/link02_o.jpg" width="116" height="26" alt="コメント数順" /></li>
			<?php } ?>
		</ul>
		<dl class="formDl formDlR clearfix">
			<dt>絞り込み：</dt>
			<dd>
				<?php
					echo $this->Form->input('keyword', array(
						'type'=>'text',
						'div'=>false,
						'label'=>false,
						'class'=>'fKeyword',
						'placeholder'=>'キーワード'
					));
				?>
				<input type="image" class="btn" alt="" value="" src="/img/search/img_search.gif" name="search" class="fSearch">
			</dd>
		</dl>
		</div>
		<?php echo $this->Form->end(); ?>
		<table cellpadding="0" cellspacing="0" summary="交流広場-<?php echo $title_for_layout; ?>">
			<col width="20%" />
            <col width="15%" />
			<col width="32%" />
			<col width="10%" />
			<tbody>
				<tr>
					<!--<th>掲載日時</th>-->
					<th><?php echo $this->Paginator->sort('created','掲載日時');?></th>
					<th><?php echo $is_index ? 'カテゴリ' : 'タグ'; ?></th>
					<th>タイトル</th>
					<th>コメント数</th>
					<th></th>
				</tr>
				<?php foreach ($topics as $topic) { ?>
				<tr id="topic<?php echo $topic['Topic']['id']; ?>">
					<td><?php echo $this->Html->pr_datetime($topic['Topic']['created']);?></td>
					<td><?php
						if(!$is_index){
							echo $topic['Tag']['word'];
						}else{
							printf("<span class='span%02d'>%s</span>", $topic['Category']['id'], $topic['Category']['category_name']);
						}
						?></td>
					<td><a href="/bbs/view/<?php echo $topic['Topic']['id'];?>"><?php echo h($topic['Topic']['title']);?></a></td>
					<td class="spacing"><?php echo $topic['Topic']['num_comments'];?>件</td>
					<td><ul class="clearfix">
							<li><a href="/bbs/view/<?php echo $topic['Topic']['id'];?>"><img src="/img/market/link03.jpg" width="59" height="24" alt="詳細" /></a></li>
							<?php //if($loggedIn){ ?>
							<?php if(empty($topic['FamilyLike'])){ ?>
							<li><a href="javascript:addLike(<?php printf("%s,%s", 7, $topic['Topic']['id']); ?>,onFamilyLikeSuccess);"><img src="/img/market/link04.jpg" width="92" height="24" alt="お気に入り" /></a></li>
							<?php }else{ ?>
							<li><img src="/img/market/link04.jpg" width="92" height="24" alt="お気に入り" class="inactive" /></li>
							<?php } ?>
							<?php //} ?>
						</ul></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php echo $this->element('pagination'); ?>
		<?php /*
		<ul class="comList">
			<p>
				<?php //echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
			</p>
			<?php //echo $this->BootstrapPaginator->pagination(); ?>
			<!-- <li class="prev"><a href="#">&lt;&lt;</a> |</li>
			<li class="on"><a href="#">1</a></li>
			<li>|<a href="#">2</a></li>
			<li>|<a href="#">3</a></li>
			<li>|<a class="special" href="#">4</a></li>
			<li class="next">|<a href="#">&gt;&gt;</a></li> -->
		</ul>
		 */?>
	</div>
</div>
<div class="pageTop"><a href="#top">トップへ移動する</a></div>

<!-- category window -->
<?php if($is_index): ?>
<div id='categorySelect' style='display:none'>
<div id='conts'>
<div  class="childbirth clearfix" style=' background-color:white; padding:20px 50px 50px 50px; border-coler:#5ace3a; width:550px;'>
	<h2>投稿するトピックのカテゴリを選択してください</h2>
	<dl class="clearfix">
		<dt>カテゴリ：</dt>
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
		width: '500px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {closeClick : true}}
	})
	return false;
})

</script>
<?php endif; ?>