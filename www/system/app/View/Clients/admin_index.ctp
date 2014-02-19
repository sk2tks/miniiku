<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Clients'));?></legend>
		
		<?php echo $this->Form->create('Client', array('url'=>'/admin/clients/index','type'=>'post','class'=>'form-horizontal','inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
	
			<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
				
				<tr><th>名前</th><td><?php echo $this->Form->input('name', array('div'=>false)); ?></td></tr>
				<tr><th>コンテンツタイプ</th><td><?php echo $this->Form->input('contents_type_id', array('div'=>false, 'empty'=>'選択してください','options'=>$contents_types)); ?></td></tr>				
				<tr><th>都道府県</th><td><?php echo $this->Form->input('prefecture_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>
				<!-- <tr><th>自治体</th><td><?php echo $this->Form->input('municipal_id', array('div'=>false, 'empty'=>'選択してください')); ?></td></tr>	 -->	
				<tr><td colspan='2' style='text-align:center; padding:10px 0'> <button class="btn" type="button" onclick='$(this).parents("form").submit();'>　検索　</button></td></tr>
			</table>	
			<?php echo $this->Form->end(); ?>
		
		
		<!-- <p class='new_btn'><?php echo $this->Html->link(__('New %s', __('Client')), array('action' => 'add'), array('class'=>'btn btn-info btn-mini')); ?></p> -->

<a class="btn btn-info" href="/admin/clients/add/1">+ 新規保育所</a>
<a class="btn btn-info" href="/admin/clients/add/2">+ 新規スポット</a>
<a class="btn btn-info" href="/admin/clients/add/3">+ 新規習い事</a>
<a class="btn btn-info" href="/admin/clients/add/4">+ 新規コミュニティ</a>
<a class="btn btn-info" href="/admin/clients/add/5">+ 新規医療施設</a>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table table-striped">
			<thead>
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>

				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('client_type_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('area_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('prefecture_id');?></th>
				


				<th><?php echo $this->BootstrapPaginator->sort('zip');?></th>
				

				<th><?php echo $this->BootstrapPaginator->sort('status');?></th>
				
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
			</thead>

			<?php //debug($clients); ?>
		<?php foreach ($clients as $client): ?>
			<tr>
				<td><?php echo h($client['Client']['id']); ?>&nbsp;</td>
				<td><a target="_blank" href="<?php echo '/clients/view/'.$client['Client']['id'];?>"><?php echo h($client['Client']['name']); ?>&nbsp;<i class="icon-share"></i></a></td>
				<td>
					<?php echo $client['ContentsType']['name']; ?>
				</td>
				<td>
					<?php echo $client['ClientType']['name']; ?>
				</td>

				<td>
					<?php echo $client['Area']['name']; ?>
				</td>
				<td>
					<?php echo $client['Municipal']['name']; ?>
				</td>
				<td>
					<?php echo $client['Prefecture']['name']; ?>
				</td>
			


				<td><?php echo h($client['Client']['zip']); ?>&nbsp;</td>
				

				<td><?php echo MasterOption::$userStatus[$client['Client']['status']]; ?>&nbsp;</td>

				<td><?php echo h($client['Client']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $client['Client']['id']),array('class'=>'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $client['Client']['id']),array('class'=>'btn  btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $client['Client']['id']), array('class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Client')), array('action' => 'add')); ?></li>
			
		</ul>
		</div>
	</div>
</div> -->
