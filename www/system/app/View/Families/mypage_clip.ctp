<script>

function editClip(id){
	<?php
		if(!empty($this->request->query)){
			$query = '?' . http_build_query($this->request->query);
		}else{
			$query = '';
		}
	?>
	var query = '<?php echo $query; ?>';

	$.fancybox({
		type: 'iframe',
		href: "/mypage/families/edit_clip/" + id + query,
		padding: 0,
		width: '548px',
		fitToView   : false,
		autoSize    : true,
		autoScale   : true,
		scrolling	: 'no',
		helpers		: {'overlay' : {
						closeClick : false
						}
				},
		beforeClose	:function(){
			//fancyboxBeforeClosed();
			//updateClip();
		}
	});
}
function deleteClips(){
	if(!confirm('育児情報を削除してもよろしいですか')) return;
	
	var checked = [];
	$('td.delete_clips input:checked').each(function(){
		checked.push($(this).val());
	})
	if(checked.length > 0 ){
		$.ajax({
			url:'/mypage/families/delete_clips',
			data:'ids=' + checked.join(','),
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status == '1'){
					//alert('育児情報を削除しました');
				}
				updateClip();
			}
		})
	}else{
		alert('削除するコンテンツを選択してください');
	}
}
</script>

<table cellpadding="0" cellspacing="0" summary="育児情報クリップ">
	<colgroup><col width="21%">
	<col width="55%">
	<col width="13%">
	<col width="10%">
	</colgroup><tbody>
		<tr>
			<th>掲載日時</th>
			<th>タイトル</th>
			<th class="taCenter">メモ</th>
			<th class="taCenter"><input type="image" alt="" value="" src="/img/mypage/btn02.jpg" name="delete" onclick='deleteClips();'></th>
		</tr>
		<?php if(empty($family_clips)): ?>
			<tr><td colspan='4'>育児情報クリップは登録されていません</td></tr>
		<?php else: ?>
		<?php foreach($family_clips as $clip): $clip = $clip['FamilyClip'];?>
		<tr>
			<td><?php echo date("Y.m.d H:i", strtotime($clip['created'])); ?></td>
			<td><a target="_blank" href="<?php echo $clip['url']; ?>"><?php echo h($clip['title']); ?></a></td>
			<td class="taCenter"><a href="javascript:editClip(<?php echo $clip['id']; ?>)"><img src="/img/mypage/btn01.jpg" width="75" height="24" alt="表示"></a></td>
			<td class="taCenter delete_clips"><input type="checkbox" name="check" value="<?php echo $clip['id']; ?>"></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		
	</tbody>
</table>
<?php echo $this->element('pagination', array('paging_id'=>'pagingClip')); ?>

<script>
$(function(){
	$("#pagingClip a").click(function(){
		parent.updateClip($(this).attr('href'));
		return false;
	})
})
</script>
<?php echo $this->element('sql_dump'); ?>
