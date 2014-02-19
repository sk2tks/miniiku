<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Topic');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Contents Type'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['ContentsType']['name'], array('controller' => 'contents_types', 'action' => 'view', $topic['ContentsType']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Category'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['Category']['id'], array('controller' => 'categories', 'action' => 'view', $topic['Category']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['User']['name'], array('controller' => 'users', 'action' => 'view', $topic['User']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['Area']['name'], array('controller' => 'areas', 'action' => 'view', $topic['Area']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Municipal'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['Municipal']['name'], array('controller' => 'municipals', 'action' => 'view', $topic['Municipal']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Prefecture'); ?></dt>
			<dd>
				<?php echo $this->Html->link($topic['Prefecture']['name'], array('controller' => 'prefectures', 'action' => 'view', $topic['Prefecture']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Title'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Publicity Range'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['publicity_range']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Body'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['body']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('File Name'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['file_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Source'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['source']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Source Url'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['source_url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Site Url'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['site_url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Site Title'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['site_title']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Pub Date'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['pub_date']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Related Topic'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['related_topic']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modfied'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['modfied']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($topic['Topic']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Topic')), array('action' => 'edit', $topic['Topic']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Topic')), array('action' => 'delete', $topic['Topic']['id']), null, __('Are you sure you want to delete # %s?', $topic['Topic']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Topics')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Topic')), array('action' => 'add')); ?> </li>
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
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Comment Alerts')); ?></h3>
	<?php if (!empty($topic['CommentAlert'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Content Type Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('Client Id'); ?></th>
				<th><?php echo __('Topic Id'); ?></th>
				<th><?php echo __('Comment Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Alert Flag'); ?></th>
				<th><?php echo __('Alert Check'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topic['CommentAlert'] as $commentAlert): ?>
			<tr>
				<td><?php echo $commentAlert['id'];?></td>
				<td><?php echo $commentAlert['content_type_id'];?></td>
				<td><?php echo $commentAlert['family_id'];?></td>
				<td><?php echo $commentAlert['client_id'];?></td>
				<td><?php echo $commentAlert['topic_id'];?></td>
				<td><?php echo $commentAlert['comment_id'];?></td>
				<td><?php echo $commentAlert['user_id'];?></td>
				<td><?php echo $commentAlert['alert_flag'];?></td>
				<td><?php echo $commentAlert['alert_check'];?></td>
				<td><?php echo $commentAlert['modified'];?></td>
				<td><?php echo $commentAlert['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'comment_alerts', 'action' => 'view', $commentAlert['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'comment_alerts', 'action' => 'edit', $commentAlert['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comment_alerts', 'action' => 'delete', $commentAlert['id']), null, __('Are you sure you want to delete # %s?', $commentAlert['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Comment Alert')), array('controller' => 'comment_alerts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Comments')); ?></h3>
	<?php if (!empty($topic['Comment'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Contents Type Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('Client Id'); ?></th>
				<th><?php echo __('Topic Id'); ?></th>
				<th><?php echo __('Comment Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Body'); ?></th>
				<th><?php echo __('File Name'); ?></th>
				<th><?php echo __('Delete Flag'); ?></th>
				<th><?php echo __('Plus'); ?></th>
				<th><?php echo __('Minus'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topic['Comment'] as $comment): ?>
			<tr>
				<td><?php echo $comment['id'];?></td>
				<td><?php echo $comment['contents_type_id'];?></td>
				<td><?php echo $comment['family_id'];?></td>
				<td><?php echo $comment['client_id'];?></td>
				<td><?php echo $comment['topic_id'];?></td>
				<td><?php echo $comment['comment_id'];?></td>
				<td><?php echo $comment['user_id'];?></td>
				<td><?php echo $comment['title'];?></td>
				<td><?php echo $comment['body'];?></td>
				<td><?php echo $comment['file_name'];?></td>
				<td><?php echo $comment['delete_flag'];?></td>
				<td><?php echo $comment['plus'];?></td>
				<td><?php echo $comment['minus'];?></td>
				<td><?php echo $comment['modified'];?></td>
				<td><?php echo $comment['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Comment')), array('controller' => 'comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Family Likes')); ?></h3>
	<?php if (!empty($topic['FamilyLike'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Family Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Contents Type Id'); ?></th>
				<th><?php echo __('Like Family Id'); ?></th>
				<th><?php echo __('Client Id'); ?></th>
				<th><?php echo __('Topic Id'); ?></th>
				<th><?php echo __('Like Name'); ?></th>
				<th><?php echo __('Date'); ?></th>
				<th><?php echo __('Memo'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topic['FamilyLike'] as $familyLike): ?>
			<tr>
				<td><?php echo $familyLike['id'];?></td>
				<td><?php echo $familyLike['family_id'];?></td>
				<td><?php echo $familyLike['user_id'];?></td>
				<td><?php echo $familyLike['contents_type_id'];?></td>
				<td><?php echo $familyLike['like_family_id'];?></td>
				<td><?php echo $familyLike['client_id'];?></td>
				<td><?php echo $familyLike['topic_id'];?></td>
				<td><?php echo $familyLike['like_name'];?></td>
				<td><?php echo $familyLike['date'];?></td>
				<td><?php echo $familyLike['memo'];?></td>
				<td><?php echo $familyLike['modified'];?></td>
				<td><?php echo $familyLike['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'family_likes', 'action' => 'view', $familyLike['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'family_likes', 'action' => 'edit', $familyLike['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'family_likes', 'action' => 'delete', $familyLike['id']), null, __('Are you sure you want to delete # %s?', $familyLike['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Family Like')), array('controller' => 'family_likes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Topic Votes')); ?></h3>
	<?php if (!empty($topic['TopicVote'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Topic Id'); ?></th>
				<th><?php echo __('User Id'); ?></th>
				<th><?php echo __('Value'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($topic['TopicVote'] as $topicVote): ?>
			<tr>
				<td><?php echo $topicVote['id'];?></td>
				<td><?php echo $topicVote['topic_id'];?></td>
				<td><?php echo $topicVote['user_id'];?></td>
				<td><?php echo $topicVote['value'];?></td>
				<td><?php echo $topicVote['modified'];?></td>
				<td><?php echo $topicVote['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'topic_votes', 'action' => 'view', $topicVote['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'topic_votes', 'action' => 'edit', $topicVote['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'topic_votes', 'action' => 'delete', $topicVote['id']), null, __('Are you sure you want to delete # %s?', $topicVote['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
	<div class="span3">
		<ul class="nav nav-list">
			<li><?php echo $this->Html->link(__('New %s', __('Topic Vote')), array('controller' => 'topic_votes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
