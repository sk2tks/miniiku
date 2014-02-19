<div class="row-fluid">
	<div class="span12">
		<h2><?php echo __('List %s', __('Children'));?></h2>
		<?php echo $this->Form->create('Child', array('url'=>'/admin/children/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>名前</th><td><?php echo $this->Form->input('name', array('div'=>false)); ?></td></tr>
				<tr><th>ニックネーム</th><td><?php echo $this->Form->input('nickname', array('div'=>false)); ?></td></tr>
				<tr><th>施設</th><td><?php echo $this->Form->input('client_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>
				<tr><th>ファミリー</th><td><?php echo $this->Form->input('family_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>
				<!-- <tr><th>自治体</th><td><?php echo $this->Form->input('municipal_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>	 -->	
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
		
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('Child')), array('action' => 'add'), array('class'=>'btn btn-info ')); ?></p>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('gender');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('nickname');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('family_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('client_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('status');?></th>
	
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>
		<?php foreach ($children as $child): ?>
			<tr>
				<td><?php echo h($child['Child']['id']); ?>&nbsp;</td>
				<td><?php echo MasterOption::$gender[$child['Child']['gender']]; ?>&nbsp;</td>
				<td><?php echo h($child['Child']['name']); ?>&nbsp;</td>
				<td><?php echo h($child['Child']['nickname']); ?>&nbsp;</td>
				<td>
					<?php echo $child['Family']['nickname']; ?>
				<td><?php echo $child['Client']['name']; ?>&nbsp;</td>
				<td><?php echo MasterOption::$userStatus[$child['Child']['status']]; ?>&nbsp;</td>
				<td><?php echo h($child['Child']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $child['Child']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $child['Child']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $child['Child']['id']), array('class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $child['Child']['id'])); ?>
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
			
			<li><?php echo $this->Html->link(__('New %s', __('Child')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div> -->