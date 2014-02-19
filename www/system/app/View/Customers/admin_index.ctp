
<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Customers'));?></legend>
			<?php echo $this->Form->create('Customer', array('url'=>'/admin/customers/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				<tr><th>ID</th><td><?php echo $this->Form->input('id', array('type'=>'text', 'div'=>false)); ?></td></tr>
				<tr><th>ユーザー名</th><td><?php echo $this->Form->input('user_name', array('div'=>false)); ?></td></tr>
				<tr><th>ファミリー</th><td><?php echo $this->Form->input('family_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>

				<tr><th>都道府県</th><td><?php echo $this->Form->input('prefecture_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>
				<!-- <tr><th>自治体</th><td><?php echo $this->Form->input('municipal_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>	 -->	
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
			
			
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('Customer')), array('action' => 'add'), array('class'=>'btn btn-info')); ?></p>
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th>ユーザ名</th>
				<th><?php echo $this->BootstrapPaginator->sort('last_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('first_name');?></th>
				
				<th><?php echo $this->BootstrapPaginator->sort('gender');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('customer_type');?></th>
			
				<th><?php echo $this->BootstrapPaginator->sort('area_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('prefecture_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('family_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('zip');?></th>

				<th><?php echo $this->BootstrapPaginator->sort('status');?></th>
				
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>
		<?php foreach ($customers as $customer): ?>
			<tr>
				<td><?php echo h($customer['Customer']['id']); ?>&nbsp;</td>
				<td><?php echo h($customer['User']['name']); ?></td>
				<td><?php echo h($customer['Customer']['last_name']); ?>&nbsp;</td>
				<td><?php echo h($customer['Customer']['first_name']); ?>&nbsp;</td>
				
				<td><?php if(!empty($customer['Customer']['gender'])) echo MasterOption::$gender[$customer['Customer']['gender']]; ?>&nbsp;</td>
				<td><?php if(!empty($customer['Customer']['customer_type'])) echo MasterOption::$customerTypes[$customer['Customer']['customer_type']]; ?>&nbsp;</td>
				
				<td>
					<?php echo $customer['Area']['name']; ?>
				</td>
				<td><?php echo h($customer['Municipal']['name']); ?>&nbsp;</td>
				<td>
					<?php echo $customer['Prefecture']['name']; ?>
				</td>
				<td>
					<?php echo $this->Html->link($customer['Family']['nickname'], array('controller'=>'families', 'action'=>'edit', $customer['Customer']['family_id'])); ?>
				</td>
				<td><?php echo h($customer['Customer']['zip']); ?>&nbsp;</td>
				
			
				<td><?php  if(!empty($customer['Customer']['status'])) echo MasterOption::$userStatus[$customer['Customer']['status']]; ?>&nbsp;</td>
				
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $customer['Customer']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $customer['Customer']['id']),  array('class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Customer')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Families')), array('controller' => 'families', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family')), array('controller' => 'families', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div> -->
