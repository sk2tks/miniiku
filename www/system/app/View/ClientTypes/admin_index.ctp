<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('施設タイプ'));?></legend>
		<?php echo $this->Form->create('ClientType', array('url'=>'/admin/client_types/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>名前</th><td><?php echo $this->Form->input('name', array('div'=>false)); ?></td></tr>
				<tr><th>コンテンツタイプ</th><td><?php echo $this->Form->input('contents_type_id', array('div'=>false, 'empty'=>'選択してください','options'=>$contents_types)); ?></td></tr>				
				
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
		
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('Client')), array('action' => 'add'), array('class'=>'btn btn-info')); ?></p>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>
		<?php foreach ($clientTypes as $clientType): ?>
			<tr>
				<td><?php echo h($clientType['ClientType']['id']); ?>&nbsp;</td>
				<td><?php echo h($clientType['ClientType']['name']); ?>&nbsp;</td>
				<td><?php echo h($clientType['ContentsType']['name']); ?>&nbsp;</td>
				<td><?php echo h($clientType['ClientType']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $clientType['ClientType']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $clientType['ClientType']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $clientType['ClientType']['id']),array('class'=>'btn  btn-small btn-danger'), __('Are you sure you want to delete # %s?', $clientType['ClientType']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	
</div>
<!-- <div class='row'>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<li class="nav-header">関連する操作</li>	
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('施設タイプ')), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div> -->