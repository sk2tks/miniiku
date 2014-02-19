<?php $this->Html->css('about', null, array('inline' => false)); ?>
<style>
input[type=radio]{
	margin-right:5px;
}
</style>
<div id="conts">
	<h2 class="h2Ttl_3">ご要望/お問合せ</h2>
	<ul id="pagePath">
		<li>
			<a href="/">HOME</a>&gt;
		</li>
		<li>
			ご要望/お問合せ
		</li>
	</ul>
	<div class="comSubBox_">
		<p>
			日頃よりご愛顧いただきありがとうございます。みんなの育児に関するお問い合わせは下記よりご記入ください。お問い合わせいただいた内容を確認し、ご回答いたします。
			<br />
			<br />
			※恐れ入りますが、ご回答まで1営業日ほどいただく場合があります。何卒ご了承いただけますようお願い申し上げます。
		</p>
		<div style=' font-size:24px; padding:50px 0 10px 100px;'>
		<?php echo ($this->data['Contact']['type']=='質問') ? "ご質問" : "お申し込み"; ?>を受け付けました
		<br />
		<p style='margin-left:100px; margin-top:10px; font-size:14px; text-decoration:underline;'><a  href='/'>TOPページに戻る</a></p>
		</div>
		

	</div>
	<div class="pageTop">
		<a href="#top">トップへ移動する</a>
	</div>
</div>

</html>