<?php //pr($family_likes); ?>
<table cellspacing="0" cellpadding="0" summary="コメント履歴">
	<colgroup><col width="20%">
	<col width="20%">
	<col width="34%">
	<col width="15%">
	</colgroup><tbody>
		<tr>
			<th>掲載日時</th>
			<th>カテゴリ</th>
			<th>タイトル</th>
			<th class="taCenter">新着コメント</th>
			<th class="taCenter"><input type="image" alt="" value="" src="/img/mypage/btn02.jpg" name="delete" onclick='deleteLikes();'></th>
		</tr>
		<?php if(empty($family_likes)): ?>
			<tr><td colspan='5'>我が家のお気に入りは登録されていません</td></tr>
		<?php else: ?>
		<?php foreach($family_likes as $like):?>
		<tr>
			<td><?php echo date('Y.m.d H:i', strtotime($like['FamilyLike']['created'])); ?></td>
			<td><span class="<?php printf("span%02d", $like['Content']['categoryIcon']); ?>">
					<?php if(!empty($like['Content']['categoryName'])) echo $like['Content']['categoryName']; ?>
			</span></td>
			<td><?php echo $this->Html->link($like['Content']['title'], $like['Content']['url']); ?></a></td>
			<td class="taCenter"><?php echo $like['FamilyLike']['comment_count']; ?> 件</td>
			<td class="taCenter delete_likes"><input type="checkbox" name="check" value="<?php echo $like['FamilyLike']['id']; ?>"></td>
		</tr>
		<?php endforeach ;?>
		<?php endif; ?>
		
	</tbody>
</table>
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
	$('td.delete_likes input:checked').each(function(){
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
