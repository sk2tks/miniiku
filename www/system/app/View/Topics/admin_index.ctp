<div class="row-fluid">
	<div class="span9">

		<?php

		echo $this->Form->create();
				echo $this->Form->label('カテゴリ');
				echo $this->Form->select('category_id' , $categories,array('empty' => 'カテゴリで絞り込み'));
				echo $this->Form->submit('表示');
		echo $this->Form->end();
		?>

		<h2><?php echo __('List %s', __('Topics'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>
<a class="btn btn-info" href="/admin/topics/add">+ 新規育児情報</a>
		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<!-- <th><?php echo $this->BootstrapPaginator->sort('contents_type_id');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('category_id');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('area_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('prefecture_id');?></th> -->
				<th><?php echo $this->BootstrapPaginator->sort('title');?></th>
				<!-- <th><?php echo $this->BootstrapPaginator->sort('publicity_range');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('body');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('file_name1');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('file_name2');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('source');?></th> -->
				<th><?php echo $this->BootstrapPaginator->sort('source_url');?></th>
				<!-- <th><?php echo $this->BootstrapPaginator->sort('site_url');?></th> -->
				<th><?php echo $this->BootstrapPaginator->sort('site_title');?></th>
				<!-- <th><?php echo $this->BootstrapPaginator->sort('pub_date');?></th> -->
				<!-- <th><?php echo $this->BootstrapPaginator->sort('related_topic');?></th> -->
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('pub_date');?></th>
				<th class="actions" style="width:104px;"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topics as $topic): ?>
			<tr>
				<td><?php echo h($topic['Topic']['id']); ?>&nbsp;</td>
				<!-- <td>
					<?php echo $this->Html->link($topic['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $topic['ContentsType']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($topic['Category']['id'], array('controller' => 'categories', 'action' => 'view', $topic['Category']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($topic['User']['name'], array('controller' => 'users', 'action' => 'view', $topic['User']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($topic['Area']['name'], array('controller' => 'areas', 'action' => 'view', $topic['Area']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($topic['Municipal']['name'], array('controller' => 'municipals', 'action' => 'view', $topic['Municipal']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($topic['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $topic['Prefecture']['id'])); ?>
				</td> -->
				<td><?php echo h($topic['Topic']['title']); ?>&nbsp;</td>
				<!-- <td><?php echo h($topic['Topic']['publicity_range']); ?>&nbsp;</td> -->
				<!-- <td><?php echo h($topic['Topic']['body']); ?>&nbsp;</td> -->
<!-- 				<td><?php echo h($topic['Topic']['file_name1']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['file_name2']); ?>&nbsp;</td> -->
				<!-- <td><?php echo h($topic['Topic']['source']); ?>&nbsp;</td> -->
				<td><a target="_blank" href="<?php echo h($topic['Topic']['source_url']); ?>"><i class="icon-share"></i></a>&nbsp;</td>
				<!-- <td><?php echo h($topic['Topic']['site_url']); ?>&nbsp;</td> -->
				<td><?php echo h($topic['Source']['name']); ?>&nbsp;</td>
				<!-- <td><?php echo h($topic['Topic']['pub_date']); ?>&nbsp;</td> -->
				<!-- <td><?php echo h($topic['Topic']['related_topic']); ?>&nbsp;</td> -->
				<!-- <td><?php echo h($topic['Topic']['modified']); ?>&nbsp;</td> -->
				<td><?php echo h($topic['Topic']['created']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['pub_date']); ?>&nbsp;</td>
				
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $topic['Topic']['id']) , array('class' => 'btn  btn-small')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $topic['Topic']['id']), array('class' => 'btn btn-small btn-primary')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $topic['Topic']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $topic['Topic']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
<!-- 		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Contents Types')), array('controller' => 'contents_types', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Contents Type')), array('controller' => 'contents_types', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Categories')), array('controller' => 'categories', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Category')), array('controller' => 'categories', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('User')), array('controller' => 'users', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Areas')), array('controller' => 'areas', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Area')), array('controller' => 'areas', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Municipals')), array('controller' => 'municipals', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Municipal')), array('controller' => 'municipals', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Prefectures')), array('controller' => 'prefectures', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Prefecture')), array('controller' => 'prefectures', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comment Alerts')), array('controller' => 'comment_alerts', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment Alert')), array('controller' => 'comment_alerts', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Comments')), array('controller' => 'comments', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Family Likes')), array('controller' => 'family_likes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Family Like')), array('controller' => 'family_likes', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Topic Votes')), array('controller' => 'topic_votes', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic Vote')), array('controller' => 'topic_votes', 'action' => 'add')); ?> </li>
		</ul>
		</div> -->
	</div>
</div>