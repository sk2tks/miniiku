<?php 
//debug($i);
//debug($items);
//debug($comments);
//debug('currentComment:');debug($currentComment);
//debug('parentOfCurrentComment:');debug($parentOfCurrentComment);
?>
<?php 
	echo $this->Html->css('market', null, array('inline' => false));
	echo $this->Html->css('client/area', null, array('inline' => false));
	echo $this->Html->script("/common/js/common.js", array('inline'=>false));
	echo $this->Html->script("/js/bbs_view.js", array('inline'=>false));
	echo $this->Html->script("/js/comment.js", array('inline'=>false));
?>

<style>
.photoFrame {
	margin-bottom: 5px;
	padding: 11px 0 10px 10px;
	background-color: #E9E9E9;
	background-repeat: no-repeat;
	background-position: left top;
	border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
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
.underline, .underline:link, .underline:visited {
	text-decoration: underline;
}
.underline:hover {
	text-decoration: none;
}
</style>
<script>
var loggedIn = <?php echo $loggedIn ? 'true' : 'false'; ?>
</script>
<h2 class="h2Ttl">交流広場</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>
<div class="market index">
	<div class="subMarket">
		<h3><span style="background-image: url('<?php echo $catIcon; ?>')"><?php echo $catName; ?></span></h3>
		<p class="topBtn"><a href="/bbs/index/<?php echo $catSlug; ?>"><img src="/img/market/ind_btn01.jpg" width="253" height="38" alt="トピック 一覧へ" /></a></p>
		<?php
			$userLink = ($i['User']['status'] == 1) ? "/users/view/".$i['User']['id'] : 'javascript:void(0)';
		?>
		<p class="pStyle">掲載日<span class="textSpan01"><?php echo $this->Html->pr_datetime($i['Topic']['created']);?></span>ユーザー<span class="textSpan02"><?php echo $this->Html->link($i['User']['name'], $userLink); ?></span>コメント<span class="textSpan03"><?php echo $i['Topic']['num_comments'];?></span>件</p>
		<div class="photoBox_sam"><a href="<?php echo $userLink; ?>"><img src="<?php echo $photoIcon;?>" alt="" width="37" /></a></div>
		<div class="detailBox clearfix">
			<p><?php echo h($i['Topic']['title']); ?></p>
            <div class="title_source">タグ：<a class="underline" href="/bbs/index/<?php echo $catSlug;?>/<?php echo $i['Tag']['id'];?>"><?php echo h($i['Tag']['word']); ?></a></div>
            <?php if(empty($i['FamilyLike'])){ ?>
            <div id="addLike_div" class="title_box">
            	<a href="javascript:addLike(<?php printf("%s,%s", 7, $i['Topic']['id']); ?>,onFamilyLikeSuccess);">
            		<img src="/img/market/imgtext_o.jpg" width="55" height="45" alt="お気に入り" class="btn" />
            	</a>
            </div>
			<?php }else{ ?>
			<div class="title_box"><img src="/img/market/imgtext_o.jpg" width="55" height="45" alt="お気に入り" class="inactive" /></div>
			<?php } ?>
		</div>
		<div class="comProduct clearfix">
			<div class="photoBox heightLine-L">
				<?php if(!empty($i['Topic']['file_name1'])): ?>
				<div class="photoFrame"><img src="<?php echo TOPIC_DIR.'list/'.$i['Topic']['file_name1']; ?>" width="190" alt="" /></div>
				<?php endif; ?>
				<?php if(!empty($i['Topic']['file_name2'])): ?>
                <div class="photoFrame"><img src="<?php echo TOPIC_DIR.'list/'.$i['Topic']['file_name2']; ?>" width="190" alt="" /></div>
                <?php endif; ?>
                <?php if($loginUserId == $i['Topic']['user_id']):?>
				<ul class="linkList clearfix">
					<?php if(empty($i['Topic']['closed'])): ?>
					<li><img id="tsuiki_btn" class="btn" src="/img/market/ind_btn04.jpg" width="208" height="44" alt="追記" /></li>
					<li class="mb0">
						<!--
						<a href="/bbs/view/<?php echo $i['Topic']['id']; ?>/closed:1">
							<img id="closeTopic_btn" src="/img/market/ind_btn05.jpg" width="208" height="44" alt="トピック締切り" />
						</a>
						-->
						<?php echo $this->Form->create('Topic');?>
						<input type="hidden" name="data[Topic][closed]" value="1" />
						<img id="closeTopic_btn" class="btn" src="/img/market/ind_btn05.jpg" width="208" height="44" alt="トピック締切り" />
						<?php echo $this->Form->end();?>
					</li>
					<?php endif; ?>
				</ul>
				<?php endif;?>
			</div>
			<div class="textBox heightLine-L">
				<div class="subText">
					<p><?php echo nl2br(h($i['Topic']['body']));?></p>
					<?php if(!empty($i['Topic']['related_topic'])): ?>
					<br />
					<p><b>追記：</b><?php echo nl2br(h($i['Topic']['related_topic']));?></p>
					<?php endif; ?>
				</div>
            </div>
        </div>
     	<div id="tsuikiBox" class="box clearfix">
     		<?php echo $this->Form->create('Topic'); ?>
			<div class="lBox">
				<p>追記</p>
				<textarea name="data[Topic][tsuiki]" cols="5" rows="5" class="postscript"></textarea>
			</div>
			<!--
			<input type="submit" />
			<a href="/bbs/view/<?php echo $i['Topic']['id']; ?>"><img src="/img/client/area/com_link03.png" alt="キャンセル" width="100" height="33"></a>
			-->
			<ul class="clearfix">
				<li style="float: left;padding-left: 7px;"><img id="submitTsuiki_btn" class="btn" src="/img/client/area/com_link02.png" alt="投稿" width="100" height="33" /></li>
				<li style="float: left;padding-left: 7px;"><img id="cancelTsuiki_btn" class="btn" src="/img/client/area/com_link03.png" alt="キャンセル" width="100" height="33" /></li>
			</ul>
			<?php echo $this->Form->end(); ?>
		</div>
		<?php if(!empty($i['Topic']['closed'])): ?>
		<div class="box clearfix">
			<div class="textred"><center>このトピックは締め切られました。</center></div>
		</div>
		<?php endif; ?>
		<h4>コメント</h4>
		<div class="tabBox">
		
			<!--コメント関連-->
			<?php echo $this->element('comment'); ?>
			<script type="text/javascript">
				var currentComment = <?php echo empty($currentComment) ? '0' : $currentComment; ?>;
				var parentOfCurrentComment = <?php echo empty($parentOfCurrentComment) ? '0' : $parentOfCurrentComment; ?>;
				
				$(function(){
					showCurrentComment();
				});
			</script>
			<!--/コメント関連-->
		
		</div>
		<div class="comList"><?php echo $this->BootstrapPaginator->pagination(); ?></div>
	</div>
</div>
<div class="pageTop"><a href="#top">トップへ移動する</a></div>