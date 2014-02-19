<?php echo $this->Html->scriptStart(array('inline' => true)); ?>



<?php echo $this->Html->scriptEnd(); ?>


<header id="gHeader">
		<h1>地域密着型「我が家の子育てスタイル」発見サイト β版</h1>
		<div class="hBox clearfix">
			<div class="logo"><a href="/">
				<img src="/sp/img/logos/<?php echo !empty($current_area_slug) ? $current_area_slug : 'zenkoku'; ?>.gif" alt="みんなの育児" width="330">
			</a></div>
			<div class="rBox">
				<div class="selectBox">
					<form action="/" method="post" class="mailForm">
						<span>地域：</span>
						<?php echo $this->Form->input('sub_domain',
							array('type'=>'select', 'options'=>$areas, 'label'=>false, 'div'=>false, 'id'=>'areaChange', 'empty'=>'全国共通', 'selected'=>$current_area_slug)); ?>
					</form>
				</div>
				<div class="hLink clearfix">
					<ul class="clearfix">
						<?php if(!AuthComponent::user()): ?>
						<li><a href="/users/regist" id="regist_user_popup" class="fancybox fancybox.iframe"><img src="/sp/img/common/img_h_link_01.gif" alt="会員登録" width="46"></a></li>
						<li id='headerLogin'><a href="/users/login" class="fancybox fancybox.iframe"><img src="/sp/img/common/img_h_link_03.gif" alt="ログイン" width="46"></a></li>
						<?php else: ?>
						<li id="headerLogin"><a href="/users/logout"><img src="/sp/img/common/img_h_link_04.gif" alt="ログイン" width="46"></a></li>

						<?php endif; ?>
						<li class="searchLink"><a href="#"><img src="/sp/img/common/img_h_link_02.gif" alt="" width="28"></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="hSearch clearfix">
				<?php echo $this->Form->create(false,array('url'=>array(
				'controller'=>'Top',
				'action'=>'search' ,
				),
			'type'=>'get'
			)
			);?>
			<ul class="searchBox" style="display: none">
				<li>
					<?php echo $this->Form->input('keyword' ,array('type'=>'text', 'label' => false, 'placeholder' => '検索キーワード'));?>
				</li>
			</ul>
			<?php echo $this->Form->end();?>
		</div>
		<ul id="gNavi" class="clearfix">
			<li><a href="/"><img src="/sp/img/common/img_navi_01_out.jpg" alt="TOP" width="60"></a>
				<!-- <div class="menu" style="display: none">
					<ul class="clearfix">
						<li><a href="/">TOP</a></li>
						<li><a href="/about/index">当サイトについて</a></li>
						<li><a href="/about/rules">利用規約/プライバシーポリシー</a></li>
						<li><a href="/about/company">運営会社</a></li>
						<li><a href="/about/contact">ご要望/お問合せ</a></li>
					</ul>
				</div> -->
			</li>
			<li><a href="#"><img src="/sp/img/common/img_navi_02_out.jpg" alt="育児情報" width="60"></a>
				<div class="menu" style="display: none">
					<ul class="clearfix">
						<li><a href="/topics/index/nursery_news">育児ニュース</a></li>
						<li><a href="/topics/index/local_news">街の告知板</a></li>
						<li><a href="/topics/index/event">地域イベント</a></li>
					</ul>
				</div>
			</li>
			<li><a href="#"><img src="/sp/img/common/img_navi_03_out.jpg" alt="街の施設" width="60"></a>
				<div class="menu" style="display: none">
					<ul class="clearfix">
						<li><a href="/clients/search/nursery">育児施設</a></li>
						<li><a href="/clients/search/spot">子連れスポット</a></li>
						<li><a href="/clients/search/culture">近所の習い事</a></li>
						<li><a href="/clients/search/community">地域コミュニティ</a></li>
						<li><a href="/clients/search/medical">街の医療機関</a></li>
					</ul>
				</div>
			</li>
			<li><a href="/bbs/index"><img src="/sp/img/common/img_navi_04_out.jpg" alt="交流広場" width="60"></a>
				<!-- <div class="menu" style="display: none">
					<ul class="clearfix">
						<li><a href="/bbs/index/pregnancy">妊娠 ・ 出産</a></li>
						<li><a href="/bbs/index/education">育児 ・ 教育</a></li>
						<li><a href="/bbs/index/life">くらし ・ 家事</a></li>
						<li><a href="/bbs/index/hobby">趣味 ・ 仕事</a></li>
						<li><a href="/bbs/index/health">健康 ・ 医療</a></li>
						<li><a href="/bbs/index/toy">絵本 ・ おもちゃ</a></li>
						<li><a href="/bbs/index/interaction">地域交流 ・ リユース</a></li>
					</ul>
				</div> -->
			</li>
			<li><a href="#"><img src="/sp/img/common/img_navi_05_out.jpg" alt="マイページ" width="60"></a>
				<div class="menu" style="display: none">
					<ul class="clearfix">
						<li><a href="/mypage/">プロフィール</a></li>
						<li><a href="/mypage?tab=1">お気に入り</a></li>
						<li><a href="/mypage?tab=3">コメント履歴</a></li>
						<li><a href="/mypage?tab=3">アンケート</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</header>

