<?php echo $this->Html->css('/sp/css/index.css', null, array('inline'=>false)); ?>
<?php echo $this->Html->scriptStart(array('inline' => false)); ?>
$(function() {
	$('.indTabBox .news:eq(0)').show().siblings('.news').hide();
	$('.indTab li').click(function() {
		var ind = $(this).index();
		$('.indTab li').removeClass('on');
		$(this).addClass('on');
		$('.indTabBox .news').hide();
		$('.indTabBox .news:eq(' + ind + ')').show();
		return false;
	});

	//$('.fancybox-inner').css('width', '100%');
});
<?php echo $this->Html->scriptEnd(); ?>

	<section id="main">
			<div class="mainImg">
			<center><img src="img/index/main_img01.jpg" width="100%"></center>
			</div>
		<?php if(!AuthComponent::user()): ?>
		<ul class="ulLink clearfix">
			<li><a href="/users/regist" class="fancybox fancybox.iframe"><img src="/sp/img/index/btn_01.gif" alt="会員登録" width="157"></a></li>
			<li><a href="/users/login" class="fancybox fancybox.iframe"><img src="/sp/img/index/btn_02.gif" alt="ログイン" width="157"></a></li>
		</ul>
		<?php endif; ?>
		<h2 class="h2Ttl"><img src="/sp/img/index/img_01.png" alt="" width="22"><span>最近のイベント</span><a href="/topics/index/event"><img src="/sp/img/index/btn_03.jpg" alt="もっと見る" width="86"></a></h2>
		<div class="firstNews news">
			<ul>
				<?php if(!empty($recent_events)): ?>
						<?php foreach($recent_events as $n=>$event): ?>
						<li><a target="_blank" href="<?php echo $event['Topic']['source_url']; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d", strtotime($event['Topic']['pub_date'])), mb_strimwidth(h($event['Topic']['title']), 0, 60, '…', 'utf-8')); ?></a></li>

						<?php endforeach; ?>
						<?php else: ?>
							<li>イベントはありません</li>
						<?php endif; ?>
			</ul>
		</div>
		<h2 class="h2Ttl"><img src="/sp/img/index/img_02.png" alt="" width="22"><span>最近の投稿（交流広場）</span><a href="/bbs/index"><img src="/sp/img/index/btn_04.jpg" alt="もっと見る" width="86"></a></h2>
		<div class="twoNews news">
			<ul>
				<?php if(!empty($recent_bbs_comments)): ?>
						<?php foreach($recent_bbs_comments as $n=>$comment): ?>
						<li><a href="/bbs/view/<?php echo $comment['Comment']['contents_target_id']; ?>/comment:<?php echo $comment['Comment']['id']; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d", strtotime($comment['Comment']['created'])), mb_strimwidth(h($comment['Comment']['body']), 0, 60, '…', 'utf-8')); ?></a></li>

						<?php endforeach; ?>
						<?php else: ?>
							<li>コメントはありません</li>
						<?php endif; ?>
			</ul>
		</div>
		<h2 class="h2Ttl"><img src="/sp/img/index/img_03.png" alt="" width="22"><span>最近のコメント（施設情報）</span><a href="/clients/search/index"><img src="/sp/img/index/btn_05.jpg" alt="もっと見る" width="86"></a></h2>
		<div class="threeNews news">
			<ul>
				<?php if(!empty($recent_client_comments)): ?>
						<?php foreach($recent_client_comments as $n=>$comment): ?>
						<li>
							<?php
								$url = sprintf('/clients/view/%s/comment:%s?tab=7', $comment['Comment']['contents_target_id'], $comment['Comment']['id']);
							 ?>
							<a href="<?php echo $url; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d", strtotime($comment['Comment']['created'])), mb_strimwidth(h($comment['Comment']['body']), 0, 60, '…', 'utf-8')); ?></a></li>

						<?php endforeach; ?>
						<?php else: ?>
							<li>コメントはありません</li>
						<?php endif; ?>
			</ul>
		</div>
		<ul class="indTab clearfix">
			<li class="on"><a href="#">育児情報</a></li>
			<li><a href="#">交流広場</a></li>
		</ul>
		<div class="indTabBox">
			<div class="fourNews news">
				<dl class="clearfix">
					<?php foreach($topics as $topic): ?>
					<dt><?php echo $this->Html->pr_datetime(h($topic['Topic']['pub_date']));?></dt>
					<dd><a target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><?php echo h($topic['Topic']['title']);?></a>（<a target="_blank" href="<?php echo h($topic['Source']['url']);?>"><?php echo h($topic['Source']['name']);?></a></dd>
					<?php endforeach; ?>

				</dl>
				<form action="/topics/index" method="get">
					<div class="form_se1">
						<input type="text" value="絞り込みキーワード" name="search" onfocus="if (this.value == defaultValue) this.value = '';" onblur="if (!this.value) this.value = defaultValue;">
					</div>
					<div class="form_se2">
						<input type="image" name="__submit__" src="/sp/img/index/btn_07.gif" value="" alt="">
					</div>
				</form>
				<div class="form_se3"><a href="/topics/index">一覧はこちら</a>&gt;&gt;</div>
			</div>
			<div class="fourNews news">
				<dl class="clearfix">
					<?php foreach($recent_bbs as $bbs): ?>
					<dt><?php echo date('Y.m.d H:i', strtotime($bbs['Topic']['created'])); ?></dt>
					<dd><?php echo $this->Html->link(mb_strimwidth($bbs['Topic']['title'], 0, 54,'…', 'utf-8'), '/bbs/view/'.$bbs['Topic']['id']); ?></dd>
					<?php endforeach; ?>

				</dl>
				<form action="/bbs/index" method="get">
					<div class="form_se1">
						<input type="text" value="絞り込みキーワード" name="search" onfocus="if (this.value == defaultValue) this.value = '';" onblur="if (!this.value) this.value = defaultValue;">
					</div>
					<div class="form_se2">
						<input type="image" name="__submit__" src="/sp/img/index/btn_06.gif" value="" alt="">
					</div>
				</form>
				<div class="form_se3"><a href="/bbs/index">一覧はこちら</a>&gt;&gt;</div>
			</div>
		</div>
		<h3>更新情報</h3>
		<div class="fiveNews news">
			<?php if(!empty($update_infos)): ?>
			<dl class="clearfix">
				<?php foreach($update_infos as $info): ?>
				<dt><?php echo date('Y.m.d', strtotime($info['UpdateInfo']['update_date'])); ?></dt>
				<dd>
					<?php
						if(!empty($info['UpdateInfo']['url'])){
							echo $this->Html->link(h($info['UpdateInfo']['title']), $info['UpdateInfo']['url']);
						} else{
							echo h($info['UpdateInfo']['title']);
						}
					 ?>
				</dd>
				<?php endforeach; ?>

			</dl>
			<?php else: ?>

			<?php endif; ?>
			<p><a href="/update_infos/index">一覧はこちら</a>&gt;&gt;</p>
		</div>
	</section>
