<footer id="gFooter">
<div class="pageTop"><a href="#top"><img src="/sp/img/common/img_pagetop.png" alt="PAGE TOP" width="47"></a></div>
<ul class="fNavi clearfix">
	<li><a href="#">育児情報</a>
		<ul class="clearfix">
			<li><a href="/topics/index/nursery_news">育児ニュース</a></li>
			<li><a href="/topics/index/local_news">街の告知板</a></li>
			<li><a href="/topics/index/event">地域イベント</a></li>
		</ul>
	</li>
	<li><a href="#">街の施設</a>
		<ul class="clearfix">
			<li><a href="/clients/search/nursery">育児施設</a></li>
			<li><a href="/clients/search/spot">子連れスポット</a></li>
			<li><a href="/clients/search/culture">近所の習い事</a></li>
			<li><a href="/clients/search/community">地域コミュニティ</a></li>
			<li><a href="/clients/search/medical">街の医療機関</a></li>
		</ul>
	</li>
	<li><a href="/bbs/index">交流広場</a>
		<!-- <ul class="clearfix">
			<li><a href="/bbs/index/pregnancy">妊娠 ・ 出産</a></li>
			<li><a href="/bbs/index/education">育児 ・ 教育</a></li>
			<li><a href="/bbs/index/life">くらし ・ 家事</a></li>
			<li><a href="/bbs/index/hobby">趣味 ・ 仕事</a></li>
			<li><a href="/bbs/index/health">健康 ・ 医療</a></li>
			<li><a href="/bbs/index/toy">絵本 ・ おもちゃ</a></li>
			<li><a href="/bbs/index/interaction">地域交流 ・ リユース</a></li>
		</ul> -->
	</li>
	<li><a href="/">TOP</a>
		<!-- <ul class="clearfix">
			<li><a href="/about/index">みんなの育児について</a></li>
			<li><a href="/about/rules">利用規約/プライバシーポリシー</a></li>
			<li><a href="/about/company">運営会社</a></li>
			<li><a href="/about/contact">ご要望/お問合せ</a></li>
		</ul> -->
	</li>
</ul>
<div class="fBox">
	<ul class="clearfix">
		<li><iframe
			src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fminiku.net&amp;width=100&amp;layout=button_count&amp;
			action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=241167419381065" scrolling="no"
			frameborder="0" style="border:none; overflow:hidden; width:100px;
			height:21px;" allowTransparency="true">
		</iframe></li>
		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://miniku.net/" data-lang="ja">ツイート</a>
			<script>
				!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
			</script>
		</li>
	</ul>
<p>
	<?php if(!AuthComponent::user()): ?>
		<a href="/users/regist" class="fancybox fancybox.iframe">ログイン</a><br>
		新規会員様はこちら【<a href="/users/regist" class="fancybox fancybox.iframe">会員登録</a>】
	<?php else: ?>
		<a href="/users/logout">ログアウト</a>
	<?php endif; ?>
</p>
<p class="copyright">Copyright &copy; コミュニティリンクス株式会社, All Rights Researved.</p>
</div>
</footer>