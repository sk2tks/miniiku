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