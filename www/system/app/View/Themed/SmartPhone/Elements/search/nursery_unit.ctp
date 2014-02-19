	<!-- unit -->
						<tr>
							<th>
								<div class="date"><?php echo $this->Html->pr_datetime(h($client['Client']['modified'] ), "Y/m/d").' 更新';?></div>
								<a href="/clients/view/<?php echo @h($client['Client']['id']);?>">
									<?php if($client['Client']['file_name1']){ ?>
										<img src="/uploads/client/s/<?php echo @h($client['Client']['file_name1']); ?>" alt="" />
									<?php }else{ ?>
										<img src="/img/no_image.jpg" width="148" height="111" alt="" />
									<?php } ?>
								</a>
							</th>
							<td><p class="pLink clearfix"><span><a href="/clients/view/<?php echo @h($client['Client']['id']);?>"><?php echo @h($client['Client']['name']);?></a></span><span class="textR">タイプ：<?php echo @h($client['ClientType']['name']);?></span></p>
								<p class="text">〒<?php echo @$this->Html->pr_zip(h($client['Client']['zip'])); ?><br />
									<?php echo @h($client['Area']['prefecture']).h($client['Client']['address']); ?><br />
									<span>TEL:<span class="color"><?php echo @h($client['Client']['tel']);?></span>
								<a class="viewlink" href="/clients/view/<?php echo @h($client['Client']['id']);?>"><img src="/img/search/link04.gif" width="58" height="23" alt="詳細" /></a>
							</span>
									</p>
								</td>
							<td><ul class="clearfix">
									<li><div class="radar"><canvas width="95" height="93" id="radar-<?php echo $i; ?>"></canvas></div>
										<!-- <img src="/img/search/imgtext01.gif" width="95" height="93" alt="" /> --></li>
									<li class="tdTable">
										<table cellpadding="0" cellspacing="0" summary="地域の保育施設">
											<col width="60%" />
											<tbody>
												<tr>
													<th>園の活気</th>
													<td><?php echo (!is_null($client['ClientPoll']['n1']))?@h($client['ClientPoll']['n1']):'-'; ?></td>
												</tr>
												<tr>
													<th>保育の質</th>
													<td><?php echo (!is_null($client['ClientPoll']['n2']))?@h($client['ClientPoll']['n2']):'-'; ?></td>
												</tr>
												<tr>
													<th>施設/設備</th>
													<td><?php echo (!is_null($client['ClientPoll']['n3']))?@h($client['ClientPoll']['n3']):'-'; ?></td>
												</tr>
												<tr>
													<th>教育内容</th>
													<td><?php echo (!is_null($client['ClientPoll']['n4']))?@h($client['ClientPoll']['n4']):'-'; ?></td>
												</tr>
												<tr>
													<th>周辺環境</th>
													<td><?php echo (!is_null($client['ClientPoll']['n5']))?@h($client['ClientPoll']['n5']):'-'; ?></td>
												</tr>
											</tbody>
										</table>
									</li>
								</ul>
								<p class="pText clearfix"><span>コメント：<span class="colorBg"><?php echo ($client['Client']['num_comments'])?$client['Client']['num_comments']:'-';?></span>件</span><span class="widthTd">お気に入り：<span class="colorBg colorBg01"><?php echo ($client['Client']['num_likes'])?$client['Client']['num_likes']:'-';?></span>件</span></p></td>
						</tr>
						<!-- unit end -->