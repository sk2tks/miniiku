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
	$('.delete_clips input:checked').each(function(){
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

<ul class="comUl clearfix">
	<?php if(empty($family_clips)): ?>
		<li>育児情報クリップは登録されていません</li>
	<?php else: ?>
	<?php foreach($family_clips as $clip): $clip = $clip['FamilyClip'];?>
	<li>
		<div class="lBox">
			<dl>
				<dt><?php echo date("Y.m.d H:i", strtotime($clip['created'])); ?></dt>
				<dd>
					<a target="_blank" href="<?php echo $clip['url']; ?>"><?php echo h($clip['title']); ?></a>
				</dd>
			</dl>
			<div class="btmBox clearfix">
				<p><a href="javascript:editClip(<?php echo $clip['id']; ?>)"><img src="/sp/img/maypage/btn_12.gif" width="140" alt="メモを表示" ></a></p>
			</div>
		</div>
		<div class="rBox delete_clips">
			<input type="checkbox" name="check" value="<?php echo $clip['id']; ?>">
		</div>
	</li>
	<?php endforeach; ?>
	<?php endif; ?>
</ul>
<div class="delBox clearfix"> <span>チェックした内容を削除する</span>
	<input type="image" name="delete" src="/sp/img/maypage/btn_08.jpg" value="" alt="削 除" onclick='deleteClips();'>
</div>
<?php echo $this->element('pagination', array('paging_id'=>'pagingClip')); ?>
