<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>
<div class="row-fluid">
	<div class="span12">
		<h2><?php echo __('List %s', __('Update Infos'));?></h2>
		<?php echo $this->Form->create('UpdateInfo', array('url'=>'/admin/update_infos/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:auto;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>タイトル</th><td><?php echo $this->Form->input('title', array('div'=>false,'style'=>'width:80%')); ?></td></tr>
				<tr><th>更新日</th><td>
					<?php echo $this->Form->dateTime('update_date_start', 'YMD','NONE',
									array(
										'style'=>'width:auto;height:auto;',
										'separator'=>array(' 年 ',' 月 ',' 日'),
										'empty' => '---',
							            'minYear' => 2012,
							            'maxYear' => date('Y')+1,
							            'monthNames' => false
					 )); ?>
					 〜
					 <?php echo $this->Form->dateTime('update_date_end', 'YMD','NONE',
									array(
										'style'=>'width:auto;height:auto;',
										'separator'=>array(' 年 ',' 月 ',' 日'),
										'empty' => '---',
							            'minYear' => 2012,
							            'maxYear' => date('Y')+1,
							            'monthNames' => false
					 )); ?>
        	</td></tr>
				<tr><th>都道府県</th><td><?php echo $this->Form->input('prefecture_id', array('div'=>false, 'empty'=>'選択してください', 'id'=>'prefecture')); ?></td></tr>
				<tr><th>市区町村</th><td><?php echo $this->Form->input('municipal_id', array('div'=>false, 'empty'=>'選択してください', 'id'=>'municipal')); ?></td></tr>
				<tr><th>行政区</th><td><?php echo $this->Form->input('area_id', array('div'=>false, 'empty'=>'選択してください', 'id'=>'area')); ?></td></tr>
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('UpdateInfo')), array('action' => 'add'), array('class'=>'btn btn-info btn')); ?></p>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('title');?></th>
				
				<th><?php echo $this->BootstrapPaginator->sort('prefecture_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('area_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('publicity_range');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('update_date');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('status','状態');?></th>
				
				
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($updateInfos as $updateInfo):?>
			<tr>
				<td ><?php echo h($updateInfo['UpdateInfo']['id']); ?>&nbsp;</td>
				<td ><?php echo h($updateInfo['UpdateInfo']['title']); ?>&nbsp;</td>
				
				<td><?php echo $updateInfo['Prefecture']['name']; ?></td>
				<td><?php echo $updateInfo['Municipal']['name']; ?></td>
				<td><?php echo $updateInfo['Area']['name']; ?></td>
				<td ><?php  if(!empty($updateInfo['UpdateInfo']['publicity_range'])) echo MasterOption::$publicity_ranges[$updateInfo['UpdateInfo']['publicity_range']]; ?>&nbsp;</td>
				<td><?php echo date('Y年m月d日 H:i', strtotime($updateInfo['UpdateInfo']['update_date'])); ?>&nbsp;</td>
				<td><?php  echo !empty($updateInfo['UpdateInfo']['status']) ? '公開':'非公開';  ?>&nbsp;</td>

				
				<td class="actions">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $updateInfo['UpdateInfo']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $updateInfo['UpdateInfo']['id']), array('class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $updateInfo['UpdateInfo']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	
</div>