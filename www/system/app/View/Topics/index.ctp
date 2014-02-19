<!-- <link href="/css/nursery_info.css" rel="stylesheet" type="text/css" /> -->
<?php $this->Html->css('nursery_info', null, array('inline' => false)); ?>
<script type="text/javascript" src="/js/topic_search.js"></script>


<?php if($title_for_layout == '街の告知板一覧'){
	$cls = 'h2Ttl2';
}else if($title_for_layout == '地域イベント一覧'){
	$cls = 'h2Ttl3';
}else if($title_for_layout == '育児情報一覧'){
	$cls = 'h2Ttl1';
}else{
	$cls = 'h2Ttl1';
}
?>
<h2 class="<?php echo $cls; ?>"><?php echo $title_for_layout; ?></h2>
<ul id="pagePath">
	<li><a href="../">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>

<div class="comSubBox">
	<?php echo $this->Form->create('search', array('type' => 'get' , 'url' => '/topics/index/'.$type.'/'));?>
		<div class="formBox clearfix">
			<dl class="formDl clearfix">
				<dt>表示：</dt>
				<dd>
				<?php echo $this->Form->input( 'source_id', array(
				    'type' => 'select',
				    'options' => $source,
				    'empty' => '情報ソース',
				    'label' => false,
				//  'selected' => $selected  // 規定値をvalueで指定
				)); ?>
				</dd>
			</dl>
			<ul class="clearfix">
				<?php
				$here = $this->here;
				$here = preg_replace('/\/sort.+$/', '', $here);
				?>
				<?php if(strpos($this->here, 'num_clips') === false){ ?>
					<li><img class="inactive" src="/img/nursery_info/link01_o.jpg" width="100%" alt="掲載日時順" /></li>
					<li><a href="<?php echo $here; ?>/sort:num_clips/direction/direction:desc"><img class="btn" src="/img/nursery_info/link02_o.jpg" width="100%" alt="クリップ数順" /></a></li>
				<?php }else{ ?>
					<li><a href="<?php echo $here; ?>/sort:pub_date:desc"><img class="btn" src="/img/nursery_info/link01_o.jpg" width="100%" alt="掲載日時順" /></a></li>
					<li><img class="inactive" src="/img/nursery_info/link02_o.jpg" width="100%" alt="クリップ数順" /></li>
				<?php } ?>
												</ul>
			<dl class="formDl formDlR clearfix">
				<dt>絞り込み：</dt>
				<dd>
					<input type="text" name="keyword" class="fKeyword" value="" placeholder="キーワード"/>
					<a class="searchBtn" >
						<img alt="" value="" src="/img/search/img_search.gif" class="fSearch" />
					</a>
				</dd>
			</dl>
		</div>
		<?php echo $this->Form->end(); ?>
		<table cellpadding="0" cellspacing="0" summary="育児ニュース">
			<col width="20%" />
			<col width="46%" />
			<col width="11%" />
			<tbody>
				<tr>
					<th>掲載日時</th>
					<th>タイトル（ソース）</th>
					<th>クリップ数</th>
					<th>&nbsp;</th>
				</tr>
				<?php foreach ($topics as $topic) { ?>
				<tr id="topic<?php echo $topic['Topic']['id']; ?>">
					<td><?php echo $this->Html->pr_datetime(h($topic['Topic']['pub_date']));?></td>
					<td><a target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><?php echo h($topic['Topic']['title']);?></a>（<a target="_blank" href="<?php echo h($topic['Source']['url']);?>"><?php echo h($topic['Source']['name']);?></a>）</td>
					<td class="spacing"><?php echo (h($topic['Topic']['num_clips']))?h($topic['Topic']['num_clips']):'-';?>　件</td>
					<td><ul class="clearfix">
						<li><a target="_blank" href="<?php echo h($topic['Topic']['source_url']);?>"><img src="/img/nursery_info/link03.jpg" width="58" height="24" alt="詳細" /></a></li>
						<?php if(empty($topic['FamilyClip'])){ ?>
							<li><a class="clip_btn" href="javascript:addClip(6 , <?php echo h($topic['Topic']['id']);?>,onFamilyClipSuccess , '<?php echo rawurlencode(h($topic['Topic']['source_url']));?>' , '<?php echo h($topic['Topic']['pub_date']); ?>' , '<?php echo h($topic['Topic']['title']); ?>');"><img src="/img/nursery_info/link04.jpg" width="92" height="24" alt="クリップ" /></a></li>
						<?php }else{ ?>
							<li><a class="clip_btn"><img class="inactive" src="/img/nursery_info/link04.jpg" width="92" height="24" alt="クリップ" /></a></li>
						<?php } ?>
					</ul></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<ul class="list">
	<p>
		<?php //echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
	</p>
	<?php echo $this->BootstrapPaginator->pagination(); ?>
	</ul>
</div>
