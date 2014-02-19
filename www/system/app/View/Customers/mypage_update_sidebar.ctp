<div class="imgBox">
	<div class="photo">
		<?php if(!empty($user_info['Customer']['file_name']) && $user_info['Customer']['pv_file'] == '1'): ?>
		<img src="<?php echo CUSTOMER_DIR . "/list/". $user_info['Customer']['file_name']; ?>" alt="" width="190" >
		<?php else: ?>
		<img src="<?php echo DEFAULT_IMG_CUSTOMER_L; ?>" alt="" width="190" >	
		<?php endif; ?>
	</div>
	<ul class="clearfix">
		<li><span>ユーザー名 : </span><?php echo $user_info['User']['name']; ?></li>
		
		<li class="mb0"><span>コメント : </span><?php printf("%s件", $user_info['Customer']['recentReplay']); ?></li>
		<li class="mb0"><span>ポイント : </span><?php printf("%sポイント", $user_info['Customer']['point']); ?></li>
		
	</ul>
	<div class="link"><a href="/mypage/"><img src="/img/client/area/s_link01.jpg" alt="ファミリーページ" width="196" height="36"></a></div>
</div>