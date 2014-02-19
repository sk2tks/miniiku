
<div id="sideBar">
<div id="sideBarUserInfo">			
	<?php if(AuthComponent::user('id')): ?>
		<?php if( AuthComponent::user('user_type') == USER_TYPE_CUSTOMER): ?>
			<?php $user_info = $this->Session->read('user_info'); ?>
			<div class="imgBox">
				<div class="photo">
					<?php if(!empty($user_info['Customer']['file_name']) && $user_info['Customer']['pv_file'] == '1'): ?>
					<img src="<?php echo CUSTOMER_DIR . "/list/". $user_info['Customer']['file_name']; ?>" alt="" width="190" >
					<?php else: ?>
					<img src="<?php echo DEFAULT_IMG_CUSTOMER_L; ?>" alt="" width="190" >	
					<?php endif; ?>
				</div>
				<ul class="clearfix">
					<li class='mb0'><span>ユーザー名 : </span><?php echo $user_info['User']['name']; ?></li>
					
					<li class="mb0"><span>コメント : </span><?php printf("%s件", $user_info['Customer']['recentReplay']); ?></li>
					<?php $point=$user_info['Customer']['point']; if(intval($point)<0 || empty($point)) $point = 0;?>
					<li class="mb0"><span>ポイント : </span><?php printf("%sPt", $point); ?></li>
					
				</ul>
				<div class="link"><a href="/mypage/"><img src="/img/client/area/s_link01.jpg" alt="ファミリーページ" width="196" height="36"></a></div>
			</div>
		<?php else: ?>
			<?php $user_title = (AuthComponent::user('user_type') == USER_TYPE_ADMIN) ? '管理者' : '施設管理者'; ?>
			<div class="imgBox">
				<div class="photo">
					<img src="<?php echo DEFAULT_IMG_OWNER_L; ?>" alt="" width="190" >
				</div>
				<ul class="clearfix">
					<a href='/owner/'>
					<li style='margin-top:5px; margin-bottom:0;'><span><?php echo $user_title; ?> </span><?php echo AuthComponent::user('name'); ?></li>
					</a>
				</ul>
			</div>
		<?php endif; ?>
	<?php else: ?>
			<div class="entry">
				<p><img src="/img/common/img/s_ttl.gif" width="120" height="23" alt="初めての方へ" /></p>
				<div class="entryList">
					<ul>
						<li>みんなで育児に役立つ情報を集めるためのサイトです！</li>
						<li>無料の会員登録によって、<br />口コミの閲覧や、地域の<br />パパ・ママとの情報交換も<br />できるようになります！</li>
					</ul>
				</div>
				<div class="login">
					<a id='regist_user_popup' href="/users/regist" class="fancybox fancybox.iframe">
						<img src="/img/common/img/s_link01.gif" width="194" height="57" alt="会員登録はこちら" />
					</a>
				</div>
			</div>
	<?php endif; ?>
</div>			
			
			<ul class="banner clearfix">
				<li><a href="/about/index"><img src="/img/common/img/s_banner01.gif" alt="みんなの育児[みん育]について みん育サイトについてのご案内はこちら" width="216" height="60" /></a></li>
				<li><a href="/about/rules"><img src="/img/common/img/s_banner02.gif" alt="利用規約 当HPを利用する前にお読み下さい" width="216" height="60" /></a></li>
				<li><a href="/about/company"><img src="/img/common/img/s_banner03.gif" alt="運営会社 当サイトを運営している会社情報" width="216" height="60" /></a></li>
				<li><a href="/about/contact"><img src="/img/common/img/s_banner04.gif" alt="ご要望/お問合せ お気軽にご相談下さい" width="216" height="60" /></a></li>
			</ul>
			<div class="freeSpace"><iframe
src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fminiku.net&amp;wi
dth=216&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=fa
lse&amp;height=80&amp;appId=241167419381065" scrolling="no" frameborder="0"
style="border:none; overflow:hidden; width:216px; height:80px;"
allowTransparency="true"></iframe>
				<!-- <img src="/img/common/img/s_img.jpg" alt="フリースペース" width="216" height="853" /> -->
			</div>
		</div>