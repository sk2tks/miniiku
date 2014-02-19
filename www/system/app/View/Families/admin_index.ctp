<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Families'));?></legend>
		<?php echo $this->Form->create('Family', array('url'=>'/admin/families/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>カスタマー</th><td><?php echo $this->Form->input('name', array('div'=>false)); ?></td></tr>
				<tr><th>ニックネーム</th><td><?php echo $this->Form->input('nickname', array('div'=>false)); ?></td></tr>
				
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
			
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('Family')), array('action' => 'add'), array('class'=>'btn btn-info')); ?></p>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('customer_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('nickname');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>
		<?php foreach ($families as $family): ?>
			<tr>
				<td><?php echo h($family['Family']['id']); ?>&nbsp;</td>
				<td>
					<?php printf("%s %s", $family['MasterCustomer']['last_name'],$family['MasterCustomer']['first_name']); ?>
				</td>
				<td><?php echo h($family['Family']['nickname']); ?>&nbsp;</td>
				<td><?php echo h($family['Family']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $family['Family']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $family['Family']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $family['Family']['id']), array('class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $family['Family']['id'])); ?>
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
			
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Child')), array('controller'=>'children','action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Child')), array('controller'=>'children','action' => 'add')); ?></li>
			
		</ul>
		</div>
	</div>
</div> -->
