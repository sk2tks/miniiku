<?php echo $this->Html->script('system', true); ?>
	<div id="header">
		<div class="hBox clearfix">
			<div class="lBox">
				<h1>みん育：地域密着型「我が家の子育てスタイル」発見サイト β版</h1>
				<div class="logo"><a href="/"><img src="/img/common/img/logos/<?php echo !empty($current_area_slug) ? $current_area_slug : 'zenkoku'; ?>.gif" alt="みんなの育児" width="216" height="47" /></a></div>
			</div>
			<div class="rBox clearfix">
				<div class="hLink clearfix">
					<form action="/" method="post" class="mailForm">
						<p>地域：</p>

						<?php echo $this->Form->input('sub_domain',
							array('type'=>'select', 'options'=>$areas, 'label'=>false, 'div'=>false, 'id'=>'areaChange', 'empty'=>'全国共通', 'selected'=>$current_area_slug)); ?>
					</form>
					<?php if(!AuthComponent::user()): ?>
					<div class="login" id='headerLogin'>
						<a href="/users/login" class="fancybox fancybox.iframe">
							<img src="/img/common/img/h_link.jpg" alt="ログイン" width="125" height="27" />
						</a>
					</div>
					<?php else: ?>
						<div class="login" id='headerLogin'>
						<a href="/users/logout">
							<img src="/img/common/img/h_link_o.jpg" alt="ログイン" width="125" height="27" />
						</a>
					</div>

					<?php endif; ?>
				</div>
				<ul class="ulList clearfix">
					<li><iframe
src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fminiku.net&amp;wi
dth=100&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;sha
re=false&amp;height=21&amp;appId=241167419381065" scrolling="no"
frameborder="0" style="border:none; overflow:hidden; width:100px;
height:21px;" allowTransparency="true"></iframe></li>
					<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://miniku.net/" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></li>
					<!-- <li><a href="#"><img src="/img/common/img/h_mlink.jpg" alt="mチェック" width="58" height="21" /></a></li> -->
				</ul>
			</div>
		</div>
		<div class="naviBox clearfix">
			<ul id="gNavi" class="clearfix">
				<li><a href="/"><img src="/img/common/img/g_navi01.gif" alt="TOP" width="151" height="43" /></a>
					<!-- <ul class="clearfix" style='display:none;'>
						<li><a href="/"><img src="/img/common/img/sub_navi01.png" width="150" height="29" alt="TOP" /></a></li>
						<li><a href="/about/"><img src="/img/common/img/sub_navi02.png" width="150" height="29" alt="当サイトについて" /></a></li>
						<li><a href="/about/rules"><img src="/img/common/img/sub_navi03.png" width="150" height="29" alt="利用規約" /></a></li>
						<li><a href="/about/company"><img src="/img/common/img/sub_navi04.png" width="150" height="29" alt="運営会社" /></a></li>
						<li><a href="/about/contact"><img src="/img/common/img/sub_navi05.png" width="150" height="30" alt="ご要望/お問合せ" /></a></li>
					</ul> -->
				</li>
				<li><a href="/topics/index"><img src="/img/common/img/g_navi02.gif" alt="育児情報" width="150" height="43" /></a>
					<ul class="clearfix" style='display:none;'>
						<li><a href="/topics/index/nursery_news"><img src="/img/common/img/sub_navi06.png" width="150" height="29" alt="育児ニュース" /></a></li>
						<li><a href="/topics/index/local_news"><img src="/img/common/img/sub_navi07.png" width="150" height="29" alt="街の告知板" /></a></li>
						<li><a href="/topics/index/event"><img src="/img/common/img/sub_navi08.png" width="150" height="30" alt="地域イベント" /></a></li>
					</ul>
				</li>
				<li><a href="#"><img src="/img/common/img/g_navi03.gif" alt="街の施設" width="151" height="43" /></a>
					<ul class="clearfix" style='display:none;'>
						<li><a href="/clients/search/nursery"><img src="/img/common/img/sub_navi09.png" width="150" height="29" alt="育児施設" /></a></li>
						<li><a href="/clients/search/spot"><img src="/img/common/img/sub_navi10.png" width="150" height="29" alt="子連れスポット" /></a></li>
						<li><a href="/clients/search/culture"><img src="/img/common/img/sub_navi11.png" width="150" height="29" alt="近所の習い事" /></a></li>
						<li><a href="/clients/search/community"><img src="/img/common/img/sub_navi12.png" width="150" height="29" alt="地域コミュニティ" /></a></li>
						<li><a href="/clients/search/medical"><img src="/img/common/img/sub_navi13.png" width="150" height="30" alt="街の医療機関" /></a></li>
					</ul>
				</li>
				<li><a href="/bbs/index"><img src="/img/common/img/g_navi04.gif" alt="交流広場" width="150" height="43" /></a>
					<!-- <ul class="clearfix" style='display:none;'>
						<li><a href="/bbs/index/pregnancy"><img src="/img/common/img/sub_navi14.png" width="150" height="29" alt="妊娠・出産" /></a></li>
						<li><a href="/bbs/index/education"><img src="/img/common/img/sub_navi15.png" width="150" height="29" alt="育児・教育" /></a></li>
						<li><a href="/bbs/index/life"><img src="/img/common/img/sub_navi16.png" width="150" height="29" alt="くらし・家事" /></a></li>
						<li><a href="/bbs/index/hobby"><img src="/img/common/img/sub_navi17.png" width="150" height="29" alt="趣味・仕事" /></a></li>
						<li><a href="/bbs/index/health"><img src="/img/common/img/sub_navi18.png" width="150" height="29" alt="健康・医療" /></a></li>
						<li><a href="/bbs/index/toy"><img src="/img/common/img/sub_navi19.png" width="150" height="29" alt="絵本・おもちゃ" /></a></li>
						<li><a href="/bbs/index/interaction"><img src="/img/common/img/sub_navi20.png" width="150" height="30" alt="地域交流・リユース" /></a></li>
					</ul> -->
				</li>
				<li><a href="/mypage/"><img src="/img/common/img/g_navi05.gif" alt="マイページ" width="150" height="43" /></a>
					<ul class="clearfix" style='display:none;'>
						<li><a href="/mypage/"><img src="/img/common/img/sub_navi21.png" width="151" height="29" alt="プロフィール" /></a></li>
						<li><a href="/mypage?tab=1"><img src="/img/common/img/sub_navi22.png" width="151" height="29" alt="お気に入り" /></a></li>
						<li><a href="/mypage?tab=2"><img src="/img/common/img/sub_navi23.png" width="151" height="29" alt="コメント履歴" /></a></li>
						<li><a href="/mypage?tab=3"><img src="/img/common/img/sub_navi24.png" width="151" height="30" alt="アンケート" /></a></li>
					</ul>
				</li>
			</ul>
			<?php echo $this->Form->create(false,array('url'=>array(
				'controller'=>'Top',
				'action'=>'search'
				),
			'type'=>'get'
			)
			);?>
			<div class="searchBox clearfix">
				<?php echo $this->Form->input('keyword' ,array('class'=>'searchTxt' , 'label' => false , 'placeholder'=>'　検索キーワード'));?>
				<!-- <input type="text" value="" name="name01" class="searchTxt" /> -->
				<input type="image" name="" src="/img/common/img/btn_search.gif" value="" alt="" onClick="void(this.form.submit());return false" />

			</div>
			<?php echo $this->Form->end();?>
		</div>
	</div>
	<!-- #EndLibraryItem -->