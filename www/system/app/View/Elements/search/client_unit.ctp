<!-- unit -->
	<tr>
		<!-- <th>
			<div class="date"><?php echo $this->Html->pr_datetime(h($client['Client']['modified'] ), "Y/m/d").' 更新';?></div>
			<a href="/clients/view/<?php echo @h($client['Client']['id']);?>" onmouseover="">
				<?php if($client['Client']['file_name1']){ ?>
				<img src="/uploads/client/s/<?php echo @h($client['Client']['file_name1']); ?>" alt="" />
				<?php }else{ ?>
					<img src="/img/no_image.jpg" width="148" height="111" alt="" />
				<?php } ?>
			</a>
		</th> -->
		<td>
			<p class="pLink clearfix">
				<span><a href="/clients/view/<?php echo @h($client['Client']['id']);?>"><?php echo @h($client['Client']['name']);?></a></span>
				<span class="textR">タイプ：<?php echo @h($client['ClientType']['name']);?></span>
			</p>
			<p class="text">
				〒<?php echo @$this->Html->pr_zip(h($client['Client']['zip'])); ?><br />
				<?php echo @h($client['Area']['prefecture']).h($client['Client']['address']); ?><br />
				<span>
					TEL:<span class="color"><?php echo @h($client['Client']['tel']);?></span>
					<a class="viewlink" href="/clients/view/<?php echo @h($client['Client']['id']);?>"><img src="/img/search/link04.gif" width="58" height="23" alt="詳細" align="right"/></a>
				</span>
			</p>
		</td>
		<td>
			<div class="inner clearfix">
				<div class="photoBox_graphbox">
					<?php
					$w = array();
					$max = max($client['ClientPoll']['n1'] , $client['ClientPoll']['n2'] , $client['ClientPoll']['n3']);
					$w[1] = ($max)?$client['ClientPoll']['n1'] / $max * 95:'0';
					$w[2] = ($max)?$client['ClientPoll']['n2'] / $max * 95:'0';
					$w[3] = ($max)?$client['ClientPoll']['n3'] / $max * 95:'0';
					?>
					<div class="photoBox_graph1"><img src="/img/search/imgtext08.gif" width="<?php echo $w['1'];?>" height="15" alt="" /></div>
					<div class="photoBox_graph2"><img src="/img/search/imgtext08.gif" width="<?php echo $w['2'];?>" height="15" alt="" /></div>
					<div class="photoBox_graph3"><img src="/img/search/imgtext08.gif" width="<?php echo $w['3'];?>" height="15" alt="" /></div>
				</div>
				<div class="textBox">
					<p class="title">投票件数　</p>
					<ul class="clearfix">
					<?php
					switch ($type) {
					case '2': ?>
						<li>
							<span>行ってみたい</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n1']))?@h($client['ClientPoll']['n1'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>また行きたい</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n2']))?@h($client['ClientPoll']['n2'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>もう十分</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n3']))?@h($client['ClientPoll']['n3'])+0:'-'; ?></span>件
						</li>
					<?php
					break;
					case '4': ?>
						<li>
							<span>興味あり</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n1']))?@h($client['ClientPoll']['n1'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>加入中</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n2']))?@h($client['ClientPoll']['n2'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>加入していた</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n3']))?@h($client['ClientPoll']['n3'])+0:'-'; ?></span>件
						</li>
					<?php
					break;
					default: ?>
						<li>
							<span>興味あり</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n1']))?@h($client['ClientPoll']['n1'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>利用中</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n2']))?@h($client['ClientPoll']['n2'])+0:'-'; ?></span>件
						</li>
						<li>
							<span>利用した</span>
							<span class="color"><?php echo (!is_null($client['ClientPoll']['n3']))?@h($client['ClientPoll']['n3'])+0:'-'; ?></span>件
						</li>
					<?php
					break;
					}
					?>
					</ul>
				</div>
			</div>
			<p class="pText clearfix">
				<span>コメント：<span class="colorBg"><?php echo ($client['Client']['num_comments'])?$client['Client']['num_comments']:'-';?></span>件</span>
				<span class="widthTd">お気に入り：<span class="colorBg colorBg01"><?php echo ($client['Client']['num_likes'])?$client['Client']['num_likes']:'-';?></span>件</span>
			</p>
		</td>
	</tr>
<!-- unit end -->