<table cellpadding="0" cellspacing="0" summary="コメント履歴">
	<colgroup><col width="20%">
	<col width="20%">
	<col width="25%">
	<col width="24%">
	</colgroup><tbody>
		<tr>
			<th>掲載日時</th>
			<th>カテゴリ</th>
			<th>タイトル</th>
			<th>コメント</th>
			<th>新着返信</th>
		</tr>
		<?php if(empty($family_comments)): ?>
			<tr><td colspan='5'>コメント履歴は登録されていません</td></tr>
		<?php else: ?>
		<?php foreach($family_comments as $comment): ?>
		<tr>
			<td><?php echo date("Y.m.d H:i", strtotime($comment['Comment']['modified'])); ?></td>
			<td><span class="<?php printf("span%02d", $comment['Content']['categoryIcon']); ?>"><?php echo $comment['Content']['categoryName']; ?></span></td>
			<td><a  href="<?php echo $comment['Content']['url']; ?>"><?php echo $comment['Content']['title']; ?></a></td>
			<td><a href="<?php echo $comment['Content']['url']; ?>"><?php echo mb_strimwidth($comment['Comment']['body'], 0,100, '…', 'utf-8'); ?></a></td>
			<td class="taCenter"><?php echo $comment['Comment']['comment_count']; ?> 件</td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		
	</tbody>
</table>
<?php echo $this->element('pagination', array('paging_id'=>'pagingComment')); ?>

<script>
$(function(){
	$("#pagingComment a").click(function(){
		updateComment($(this).attr('href'));
		return false;
	})
})
</script>
<?php echo $this->element('sql_dump'); ?>
