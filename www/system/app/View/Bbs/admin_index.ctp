<?php //debug('topics:');debug($topics); ?>
<div class="row-fluid">
	<div class="span12">
		<legend>交流広場　<?php echo __('List %s', __('Topics'));?></legend>
		<?php echo $this->Form->create('Topic', array('url'=>'/admin/bbs/index', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
		<table class='table table-bordered table-condensed' style='width:500px;;margin-left:auto; margin-right:auto;'>
			<tr><th>ID</th><td><?php echo $this->Form->input('id', array('type'=>'text', 'div'=>false)); ?></td></tr>
			<tr><th>カテゴリ</th><td><?php echo $this->Form->select('category_id', $categories, array('div'=>false, 'empty'=>'カテゴリで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><th>タグ(カテゴリ依存)</th><td><?php echo $this->Form->select('tag_id', $tags, array('div'=>false, 'empty'=>'タグで絞り込み', 'onchange'=>'$(this).parents("form").submit();')); ?></td></tr>
			<tr><th>キーワード</th><td><?php echo $this->Form->input('keyword', array('div'=>false)); ?></td></tr>
			<tr><td colspan='2' style='text-align:center; padding:10px 0'>
				<input class="btn" type="submit" value="検索" />
				<button class="btn"
					onclick="$('#TopicAdminIndexForm select option').removeAttr('selected');$('#TopicId, #TopicKeyword').val('');">リセット</button>
			</td></tr>
		</table>
		<?php echo $this->Form->end(); ?>
		<div style="float:left"><?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></div>
		<div style="float:right;margin-bottom:10px"><a class="btn btn-info" href="/admin/bbs/add">+ 新規交流広場トピック</a></div>
		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('Topic.id', 'ID');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Category.id', 'カテゴリ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Tag.word', 'タグ');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Topic.title', 'タイトル');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('User.name', '投稿者');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Topic.num_comments', 'コメント数');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Topic.modified', '更新日時');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('Topic.created', '登録日時');?></th>
				<th class="actions" style="width:104px;"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topics as $topic): ?>
			<tr>
				<td><a href="/bbs/view/<?php echo $topic['Topic']['id']; ?>" target="_blank"><?php echo $topic['Topic']['id']; ?>&nbsp;</a></td>
				<td><?php echo h($topic['Category']['category_name']); ?>&nbsp;</td>
				<td><?php echo h($topic['Tag']['word']); ?>&nbsp;</td>
				<td><?php echo h($topic['Topic']['title']); ?>&nbsp;</td>
				<td><a href="<?php echo empty($topic['User']['id']) ? '#' : '/admin/users/view/'.$topic['User']['id']; ?>"><?php echo h($topic['User']['name']); ?>&nbsp;</a></td>
				<td><?php echo $topic['Topic']['num_comments']; ?>&nbsp;</td>
				<td><?php echo $topic['Topic']['modified']; ?>&nbsp;</td>
				<td><?php echo $topic['Topic']['created']; ?>&nbsp;</td>
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
	<!--
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
	</div>
	-->
</div>