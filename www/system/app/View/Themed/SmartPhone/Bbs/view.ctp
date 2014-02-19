<?php echo $this->Html->css('/sp/css/common', null, array('inline' => false)); ?>
<?php echo $this->Html->css('/sp/css/bbs', null, array('inline' => false)); ?>
<?php echo $this->Html->script("/sp/js/heightLine", array('inline'=>false)); ?>
<?php
	echo $this->Html->script("/sp/js/bbs_view.js", array('inline'=>false));
	echo $this->Html->script("/sp/js/comment.js", array('inline'=>false));
?>


<style>
.inactive {
    filter: alpha(opacity=40);
    opacity: 0.4;
}
.underline, .underline:link, .underline:visited {
	text-decoration: underline;
}
</style>

<script>
var loggedIn = <?php echo $loggedIn ? 'true' : 'false'; ?>
</script>

<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>
<section id="main">
	<h2><img src="/sp/img/market/img_h2.png" alt="" width="23"><span>交流広場</span></h2>
	<h3 class="comH3Ttl"><img src="<?php echo $catIcon; ?>" alt="" width="18"><?php echo $catName; ?></h3>
	<div class="marketBox">
		<ul class="topUl clearfix">
			<li>掲載日<span><?php echo $this->Html->pr_datetime($i['Topic']['created']);?></span></li>
			<?php
				$userLink = ($i['User']['status'] == 1) ? "/users/view/".$i['User']['id'] : 'javascript:void(0)';
			?>
			<li class="liStyle01">ユーザー<span><?php echo $this->Html->link($i['User']['name'], $userLink); ?></span></li>
			<li class="liStyle02">コメント<span><?php echo $i['Topic']['num_comments'];?></span>件</li>
			<li class="liStyle03">タグ<span><a class="underline" href="/bbs/index/<?php echo $catSlug;?>/<?php echo $i['Tag']['id'];?>"><?php echo $i['Tag']['word']; ?></a></span></li>
		</ul>
	</div>
	<ul class="comBtnList clearfix">
		<li class="floatL"><a href="/bbs/index/<?php echo $catSlug; ?>"><img src="/sp/img/client/area/com_btn_01.jpg" width="106" alt="一覧に戻る"></a> </li>
		<li class="floatR">
			<?php if(empty($i['FamilyLike'])){ ?>
			<a href="javascript:addLike(<?php printf("%s,%s", 7, $i['Topic']['id']); ?>,onFamilyLikeSuccess);">
				<img src="/sp/img/client/area/com_btn_02.jpg" width="106" alt="お気に入り">
			</a>
			<?php }else{ ?>
			<img src="/sp/img/client/area/com_btn_02.jpg" width="106" alt="お気に入り" class="inactive">
			<?php } ?>
		</li>
	</ul>
	<p class="intro"> <a href="<?php echo $userLink; ?>"><img src="<?php echo $photoIcon;?>" alt="" width="31" /></a><span><?php echo h($i['Topic']['title']); ?></span> </p>
	<p class="text"><?php echo nl2br(h($i['Topic']['body']));?></p>
	<?php if(!empty($i['Topic']['related_topic'])): ?>
	<br />
	<p class="text"><b>追記：</b><?php echo nl2br(h($i['Topic']['related_topic']));?></p>
	<?php endif; ?>
	<div class="comForm">
		<ul class="photoUl clearfix">
			<?php if(!empty($i['Topic']['file_name1'])): ?>
			<li class="floatL"><img src="<?php echo TOPIC_DIR.'list/'.$i['Topic']['file_name1']; ?>" alt="" width="145"></li>
			<?php endif; ?>
			<?php if(!empty($i['Topic']['file_name2'])): ?>
			<li class="floatR"><img src="<?php echo TOPIC_DIR.'list/'.$i['Topic']['file_name2']; ?>" alt="" width="145"></li>
			<?php endif; ?>
		</ul>
		<?php if($loginUserId == $i['Topic']['user_id']):?>
		<div id="tsuikiBox" style="margin-bottom:20px">
			<p class="title"><img src="/sp/img/market/ind_title.gif" alt="追記" width="100%"></p>
	 		<?php echo $this->Form->create('Topic'); ?>
			<div class="lBox">
				<textarea name="data[Topic][tsuiki]" cols="5" rows="5" class="postscript" style="width:100%"></textarea>
			</div>
			<ul class="clearfix" style="margin:0 auto 12px;width:79%">
				<li style="float:left;width:50%"><a style="display:block;margin:0 auto;width:90.7%"><img id="submitTsuiki_btn" src="/sp/img/client/area/img_btn02.jpg" alt="投稿" width="100%" /></a></li>
				<li style="float:left;width:50%"><a style="display:block;margin:0 auto;width:90.7%"><img id="cancelTsuiki_btn" src="/sp/img/client/area/img_cancel.jpg" alt="キャンセル" width="100%" /></a></li>
			</ul>
			<?php echo $this->Form->end(); ?>
		</div>
		<ul class="submit" style="margin: 10px 20px 20px;">
			<?php if(empty($i['Topic']['closed'])): ?>
			<li><img id="tsuiki_btn" src="/sp/img/market/ind_btn_01.jpg" width="218" alt="追 記"></li>
			<li>
				<!--<input type="image" value="キャンセル" name="" src="/sp/img/market/ind_btn_02.jpg" width="218" alt="トピックを締切る">-->
				<?php echo $this->Form->create('Topic');?>
				<input type="hidden" name="data[Topic][closed]" value="1" />
				<img id="closeTopic_btn" src="/sp/img/market/ind_btn_02.jpg" width="218" alt="トピックを締切る" />
				<?php echo $this->Form->end();?>
			</li>
			<?php endif;?>
		</ul>
		<?php endif;?>
	</div>

	<?php if(!empty($i['Topic']['closed'])): ?>
	<div class="box clearfix">
		<div class="textred"><center>このトピックは締め切られました。</center></div>
	</div>
	<?php endif; ?>
	<h4>コメント</h4>
	<div class="commentBox">

		<!--コメント関連-->
		<?php echo $this->element('comment'); ?>
		<script type="text/javascript">
			var currentComment = <?php echo empty($currentComment) ? '0' : $currentComment; ?>;
			var parentOfCurrentComment = <?php echo empty($parentOfCurrentComment) ? '0' : $parentOfCurrentComment; ?>;
			//console.log('currentComment:');console.log(currentComment);
			//console.log('parentOfCurrentComment:');console.log(parentOfCurrentComment);
			$(function(){
				/*
				var y = 0;
				var $div = null;
				if(parentOfCurrentComment != '0'){
					$div = $('div[data-commentid="' + parentOfCurrentComment + '"]');
					if(!$div.length) return;

					$div.find('.yes').click();
					if(currentComment != '0'){
						$div = $('div[data-commentid="' + currentComment + '"]');
						if(!$div.length) return;

						y = $div.offset().top;
					}else{
						y = $div.offset().top;
					}

				}else{
					if(currentComment != '0'){
						$div = $('div[data-commentid="' + currentComment + '"]');
						if(!$div.length) return;

						$div.find('.yes').click();
						y = $div.offset().top;
					}
				}
				window.scrollTo(0, y);
				*/
				showCurrentComment();
			});
		</script>
		<!--/コメント関連-->

	</div>
</section>
