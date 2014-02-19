<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('施設管理者'));?></legend>
		<?php echo $this->Form->create('User', array('url'=>'/admin/users/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>名前</th><td><?php echo $this->Form->input('name', array('div'=>false)); ?></td></tr>
				<tr><th>メールアドレス</th><td><?php echo $this->Form->input('email', array('div'=>false)); ?></td></tr>
				
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
		
		<p class='new_btn'><?php echo $this->Html->link(__('New %s', __('施設管理者')), array('action' => 'add'), array('class'=>'btn btn-info')); ?></p>
	
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped ">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('email');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('last_login');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('status');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				
				

				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['last_login']); ?>&nbsp;</td>
				<td><?php echo MasterOption::$userStatus[$user['User']['status']]; ?>&nbsp;</td>
				<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn  btn-small btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('施設管理者')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Clients')), array('controller' => 'clients', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('controller' => 'clients', 'action' => 'add')); ?> </li>
			
		</ul>
		</div>
	</div>
</div> -->
