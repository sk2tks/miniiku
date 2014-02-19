<ul class="comUl clearfix">
	<?php if(empty($family_likes)): ?>
	<li>我が家のお気に入りは登録されていません</li>
	<?php else: ?>
	<?php foreach($family_likes as $like):?>
	<li>
		<div class="lBox">
			<dl>
				<dt>
					<span><?php echo date('Y.m.d H:i', strtotime($like['FamilyLike']['created'])); ?></span>
					<span class="<?php printf("span%02d", $like['Content']['categoryIcon']); ?>"><?php if(!empty($like['Content']['categoryName'])) echo $like['Content']['categoryName']; ?></span>
				</dt>
				<dd>
					<?php echo $this->Html->link($like['Content']['title'], $like['Content']['url']); ?>
				</dd>
			</dl>
			<div class="btmBox clearfix">
				<p>新着コメント ： <?php echo $like['FamilyLike']['comment_count']; ?>件</p>
			</div>
		</div>
		<div class="rBox delete_likes">
			<input type="checkbox" name="check" value="<?php echo $like['FamilyLike']['id']; ?>">
		</div>
	</li>
	<?php endforeach ;?>
	<?php endif; ?>
</ul>
<div class="delBox clearfix"> <span>チェックした内容を削除する</span>
	<input type="image" name="delete" src="/sp/img/maypage/btn_08.jpg" value="" alt="削 除" onclick='deleteLikes();'>
</div>
<?php echo $this->element('pagination', array('paging_id'=>'pagingLike')); ?>

<script>
$(function(){
	$("#pagingLike a").click(function(){ alert('oops');
		parent.updateLike($(this).attr('href'));
		return false;
	})
})
function deleteLikes(){
	if(!confirm('お気に入りを削除してもよろしいですか')) return;
	var checked = [];
	$('.delete_likes input:checked').each(function(){
		checked.push($(this).val());
	})
	if(checked.length > 0 ){
		$.ajax({
			url:'/mypage/families/delete_likes',
			data:'ids=' + checked.join(','),
			type:'post',
			dataType:'json',
			success:function(data){

				if(data.status == '1'){
					//alert('お気に入りを削除しました');
				}
				updateLike();
			}
		})
	}else{
		alert('削除するコンテンツを選択してください');
	}
}
</script>
<?php //echo $this->element('sql_dump'); ?>