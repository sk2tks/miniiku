<?php echo $this->Html->css('index', null, array('inline'=>false)); ?>
<style>
ul.heightLine-2 a{
font-size:12px;
}
p.ttl heightLine-1{
	height:30px;
}
</style>
<a id="top" name="top"></a>

			<div class="mainImg">
			<center><img src="img/index/main_img01.jpg"></center>
			</div>
			<ul class="ulList clearfix">
				<li class="liBox01">
					<p class="ttl heightLine-1"><a href="/topics/index/event">最近のイベント</a></p>
						<ul class="heightLine-2">
						<?php if(!empty($recent_events)): ?>
						<?php foreach($recent_events as $n=>$event): ?>
						<li><a target="_blank" href="<?php echo $event['Topic']['source_url']; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d",strtotime($event['Topic']['pub_date'])), mb_strimwidth(h($event['Topic']['title']), 0, 24, '…','utf-8')); ?></a></li>
								<?php if(++$n > 2) break; ?>
						<?php endforeach; ?>
						<?php else: ?>
							<li>イベントはありません</li>
						<?php endif; ?>

					</ul>
					<p class="pLink heightLine-3"><a href="/topics/index/event">その他のイベントを見る</a></p>
				</li>
				<li class="liBox02">
					<p class="ttl heightLine-1"><a href="/bbs/index">最近の投稿<span>(交流広場)</span></a></p>
					<!-- <dl class="heightLine-4">
						<dt>

						</dt>
						<dd>

						</dd>
					</dl> -->
					<ul class="heightLine-2">
						<?php if(!empty($recent_bbs_comments)): ?>
						<?php foreach($recent_bbs_comments as $n=>$comment): ?>
						<li><a href="/bbs/view/<?php echo $comment['Comment']['contents_target_id']; ?>/comment:<?php echo $comment['Comment']['id']; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d",strtotime($comment['Comment']['created'])), mb_strimwidth(h($comment['Comment']['body']), 0, 24, '…','utf-8')); ?></a></li>
								<?php if(++$n > 2) break; ?>
						<?php endforeach; ?>
						<?php else: ?>
							<li>コメントはありません</li>
						<?php endif; ?>

					</ul>
					<p class="pLink heightLine-3"><a href="/bbs/index">その他の投稿を見る</a></p>
				</li>

				<li class="liBox03">
					<p class="ttl heightLine-1">最近のコメント<span>(施設情報)</span></p>
					<!-- <dl class="heightLine-4">
						<dt></dt>
						<dd>

						</dd>
					</dl> -->
					<ul class="heightLine-2">
						<?php if(!empty($recent_client_comments)): ?>
						<?php foreach($recent_client_comments as $n=>$comment): ?>
						<li>
							<?php
								$url = sprintf('/clients/view/%s/comment:%s?tab=7', $comment['Comment']['contents_target_id'],$comment['Comment']['id']);
							 ?>
							<a href="<?php echo $url; ?>" class="clearfix">
								<?php printf("%s %s", date("m/d",strtotime($comment['Comment']['created'])), mb_strimwidth(h($comment['Comment']['body']), 0, 24, '…','utf-8')); ?></a></li>
								<?php if(++$n > 2) break; ?>
						<?php endforeach; ?>
						<?php else: ?>
							<li>コメントはありません</li>
						<?php endif; ?>
					</ul>
					<p class="pLink heightLine-3"><!-- <a href="/topics/index/nursery_news">その他の投稿を見る</a> --></p>
				</li>
			</ul>

			<!-- 育児情報 -->
			<h2>育児情報</h2>
			<div class="section section01 clearfix">
				<div class="clearfix">
					<dl class="formDl clearfix">
						<dt>絞り込み：</dt>
						<dd>
							<form action="/topics/index" method="get">
							<input type="text" name="keyword" class="fKeyword" placeholder="絞り込みキーワード" />
							<input type="image" alt="" value="" src="/img/index/img_search01.gif" name="search" class="fSearch" />
							</form>
						</dd>
					</dl>
				</div>
				<div class="tableBox">
					<table cellpadding="0" cellspacing="0" summary="育児情報">
						<col width="20%" />
						<col width="20%" />
						<col width="60%" />
						<tbody>
							<tr>
								<th>掲載日時</th>
								<th>カテゴリ</th>
								<th>タイトル(ソース)</th>
							</tr>
							<?php foreach($topics as $topic){ ?>
							<?php //debug($topic);?>
							<tr>
								<td><?php echo $this->Html->pr_datetime(h($topic['Topic']['pub_date']));?></td>
								<td><?php echo $this->Html->pr_cat($topic['Category']['id'] , $topic['Category']['category_name']);?><!-- <span class="span01">育児ニュース</span> --></td>
								<td><a target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><?php echo h($topic['Topic']['title']);?></a>（<a target="_blank" href="<?php echo h($topic['Source']['url']);?>"><?php echo h($topic['Source']['name']);?></a>）</td>
							</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
				<p class="comP"><a href="/topics/index">一覧はこちら<span>&gt;&gt;</span></a></p>
			</div>

			<h2 class="h2Ttl01">交流広場</h2>
			<div class="section section02 clearfix">
				<div class="clearfix">
					<dl class="formDl clearfix">
						<dt>絞り込み：</dt>
						<dd>
							<form action="/bbs/index" method="post">

							<input type="text" name="search[keyword]" class="fKeyword" placeholder="絞り込みキーワード" />
							<input type="image" alt="" value="" src="img/index/img_search02.gif" name="search" class="fSearch" />
							</form>
						</dd>
					</dl>
				</div>
				<div class="tableBox">
					<table cellpadding="0" cellspacing="0" summary="交流広場">
						<col width="20%" />
						<col width="20%" />
						<col width="60%" />
						<tbody>
							<tr>
								<th>掲載日時</th>
								<th>カテゴリ</th>
								<th>タイトル</th>
							</tr>

							<?php foreach($recent_bbs as $bbs): ?>
							<tr>
								<td><?php echo date('Y.m.d H:i', strtotime($bbs['Topic']['created'])); ?></td>
								<td><span class="<?php printf("span%02d", $bbs['Topic']['category_id']); ?>"><?php echo $bbs['Category']['category_name']; ?></span></td>
								<td>
									<?php echo $this->Html->link(mb_strimwidth($bbs['Topic']['title'], 0, 54,'…', 'utf-8'), '/bbs/view/'.$bbs['Topic']['id']); ?>
								</td>
							</tr>
							<?php endforeach ;?>

						</tbody>
					</table>
				</div>
				<p class="comP"><a href="/bbs/index">一覧はこちら<span>&gt;&gt;</span></a></p>
			</div>
			<h2 class="h2Ttl02">更新情報</h2>
			<div class="section section03">
				<div class="subBox">
					<?php if(!empty($update_infos)): ?>
					<dl class="comDl clearfix">
						<?php foreach($update_infos as $info): ?>
						<dt><?php echo date('Y.m.d', strtotime($info['UpdateInfo']['update_date'])); ?></dt>
						<dd><?php
								if(!empty($info['UpdateInfo']['url'])){
									echo $this->Html->link(h($info['UpdateInfo']['title']), $info['UpdateInfo']['url']);
								} else{
									echo h($info['UpdateInfo']['title']);
								}
							 ?></dd>
						<?php endforeach; ?>

					</dl>
					<p class="comP"><a href="/update_infos/index">一覧はこちら<span>&gt;&gt;</span></a></p>
					<?php else: ?>

						<span style='font-size:1.3em'>更新情報はありません</span>

					<?php endif; ?>
				</div>
			</div>

