<ul class="comUl">
	<?php if(empty($family_comments)): ?>
		<li>コメント履歴は登録されていません</li>
	<?php else: ?>
	<?php foreach($family_comments as $comment): ?>
	<li>
		<div class="lBox">
			<dl>
				<dt>
					<span><?php echo date("Y.m.d H:i", strtotime($comment['Comment']['modified'])); ?></span>
					<span class="<?php printf("span%02d", $comment['Content']['categoryIcon']); ?>"><?php echo $comment['Content']['categoryName']; ?></span>
				</dt>
				<dd>
					<a href="<?php echo $comment['Content']['url']; ?>"><?php echo $comment['Content']['title']; ?></a>
				</dd>
			</dl>
			<p class="txt03"><a href="<?php echo $comment['Content']['url']; ?>"><?php echo mb_strimwidth($comment['Comment']['body'], 0,100, '…', 'utf-8'); ?></a></p>
			<div class="btmBox clearfix">
				<p>コメント ： <?php echo $comment['Comment']['comment_count']; ?>件</p>
			</div>
		</div>
		<div class="rBox" onclick='javascript:location.href="<?php echo $comment['Content']['url']; ?>"'><img width="10" alt="" src="/sp/img/nursery_info/img.gif"></div>
	</li>
	<?php endforeach; ?>
	<?php endif; ?>
</ul>
<?php echo $this->element('pagination', array('paging_id'=>'pagingComment')); ?>

<script>
$(function(){
	$("#pagingComment a").click(function(){
		updateComment($(this).attr('href'));
		return false;
	})
})
</script>
<?php //echo $this->element('sql_dump'); ?>

<!--
<div class="delBox clearfix"><span>チェックした内容を削除する</span>
	<input type="image" name="delete" src="/sp/img/maypage/btn_08.jpg" value="" alt="削 除">
</div>
<ul class="pageNavi">
	<li class="prev"><a href="#">&lt; 前へ</a></li>
	<li class="on"><a href="#">1</a></li>
	<li><a href="#">2</a></li>
	<li><a href="#">3</a></li>
	<li><a href="#">4</a></li>
	<li><a href="#">5</a></li>
	<li>...</li>
	<li class="next"><a href="#">次へ &gt;</a></li>
</ul>
-->