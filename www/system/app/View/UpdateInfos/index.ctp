
<?php $this->Html->css('nursery_info', null, array('inline' => false)); ?>
	
			<h2 class=""><?php echo $title_for_layout; ?></h2>
			<ul id="pagePath">
				<li><a href="/">HOME</a>&gt;</li>
				<li><?php echo $title_for_layout; ?></li>
			</ul>

<div class="comSubBox">

<table cellpadding="0" cellspacing="0" summary="育児ニュース">
	<col width="20%" />
	
	<tbody>
		<tr>
			<th>更新日時</th>
			<th></th>
			
		</tr>
		<?php foreach ($update_infos as $info): ?>
		
		
		<tr id="topic<?php echo $info['UpdateInfo']['id']; ?>">
			<td><?php echo date('Y.m.d', strtotime($info['UpdateInfo']['created'])); ?></td>
			<td><?php echo h($info['UpdateInfo']['title']); ?></td>
			
		</tr>
		<?php endforeach; ?>

	</tbody>
</table>

<?php echo $this->element('pagination'); ?>

</div>

<div class="pageTop"><a href="#top">トップへ移動する</a></div>
