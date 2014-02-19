<div class="row-fluid">
	<div class="span9">
		<h2>RSSフィード</h2>
<?php
							foreach(MasterOption::$feed_source as $site){
						echo '<dt>'.$site['site_name'].'</dt>'.'<dd>'.$site['url'].'    ['.$site['type'].']'.'</dd>';
					}
?>
<!--
		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('contents_type_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('category_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('area_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('municipal_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('prefecture_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('title');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('publicity_range');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('body');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('file_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('source');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('source_url');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('related_topic');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modfied');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topics as $topic): ?>
			<tr>
				<td><?php echo h($topic['Topic']['id']); ?>&nbsp;</td>
				<td>
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
				</td>
				<td><?php echo h($topic['Topic']['title']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['publicity_range']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['body']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['file_name']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['source']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['source_url']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['related_topic']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['modfied']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $topic['Topic']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $topic['Topic']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $topic['Topic']['id']), null, __('Are you sure you want to delete # %s?', $topic['Topic']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
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
		</div>
	</div>-->
</div>