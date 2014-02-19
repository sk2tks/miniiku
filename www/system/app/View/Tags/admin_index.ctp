<div class="row-fluid">
	<div class="span12">
		<legend><?php echo __('List %s', __('Tags'));?></legend>
		<?php echo $this->Form->create('Tag', array('url'=>'/admin/tags/index', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
		<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
			<tr><th>ID</th><td><?php echo $this->Form->input('id', array('type'=>'text', 'div'=>false)); ?></td></tr>
			<tr><th>カテゴリ</th><td><?php echo $this->Form->select('category_id', $categories, array('div'=>false, 'empty'=>'カテゴリで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><th>キーワード</th><td><?php echo $this->Form->input('keyword', array('div'=>false)); ?></td></tr>	
			<tr><td colspan='2' style='text-align:center; padding:10px 0'>
				<input class="btn" type="submit" value="検索" />
				<button class="btn"
					onclick="$('#TagAdminIndexForm select option').removeAttr('selected');$('#TagId, #TagKeyword').val('');">リセット</button>
			</td></tr>
		</table>
		<?php echo $this->Form->end(); ?>
		<div style="float:left"><?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></div>
		<div style="float:right;margin-bottom:10px"><a class="btn btn-info" href="/admin/tags/add">+ 新規タグ</a></div>
		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('category_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('word');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($tags as $tag): ?>
			<tr>
				<td><?php echo h($tag['Tag']['id']); ?>&nbsp;</td>
				<td>
					<?php //echo $this->Html->link($tag['Category']['category_name'], array('controller' => 'categories', 'action' => 'view', $tag['Category']['id'])); ?>
					<?php echo h($tag['Category']['category_name']); ?>
				</td>
				<td><?php echo h($tag['Tag']['word']); ?>&nbsp;</td>
				<td><?php echo h($tag['Tag']['modified']); ?>&nbsp;</td>
				<td><?php echo h($tag['Tag']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $tag['Tag']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tag['Tag']['id']), array('class' => 'btn btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tag['Tag']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<!--
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Tag')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
	-->
</div>