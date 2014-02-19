<?php echo $this->Html->css('/sp/css/owner.css', null, array('inline'=>false)); ?>


	<!-- #EndLibraryItem -->
	<ul id="pagePath">
		<li><a href="../">HOME</a>&gt;</li>
		<li>オーナー情報</li>
	</ul>
	<section id="main">
		<h2><img src="../img/owner/img_h2_01.png" alt="" width="22"><span>オーナー情報</span></h2>
		<ul class="dateTxt clearfix">
			<li><span>最終ログイン日</span><span>2013.9.10 22:22</span></li>
			<li><span>更新日</span><span>2013.10.10 10:00</span></li>
		</ul>
		<h3>ユーザー名：<span>佐藤さん</span></h3>
		<h3 class="comH3Ttl"><img src="../img/owner/img_h3_01.png" alt="" width="20">オーナー情報</h3>
		<div class="tabBox">
			<div class="subTabBox">
				<form action="./" method="post" class="mailForm">
					<p class="noteP"><span>＊</span>は必須項目</p>
					<table cellpadding="0" cellspacing="0" summary="ユーザー名：佐藤さん" class="comTable">
						<col width="100%">
						<tbody>
							<tr>
								<th><span>＊</span>ユーザー</th>
							</tr>
							<tr>
								<td><input type="text" name="" placeholder="" class="inputTxt"></td>
							</tr>
							<tr>
								<th><span>＊</span>メールアドレス</th>
							</tr>
							<tr>
								<td><input type="text" name="" placeholder="" class="inputTxt"></td>
							</tr>
							<tr>
								<th><span>＊</span>パスワード</th>
							</tr>
							<tr>
								<td><input type="text" name="" placeholder="" class="inputTxt"></td>
							</tr>
							<tr>
								<th><span>＊</span>パスワード（再）</th>
							</tr>
							<tr>
								<td><input type="text" name="" placeholder="" class="inputTxt"></td>
							</tr>
						</tbody>
					</table>
					<ul class="submit clearfix">
						<li>
							<input type="image" alt="登録する" value="登録する" src="../img/owner/btn_01.jpg" name="__send__" class="btn01">
						</li>
					</ul>
				</form>
			</div>
		</div>
		<h3 class="comH3Ttl"><img src="../img/owner/img_h3_02.png" alt="" width="24">施設管理<a href="#"><img src="../img/owner/btn_02.jpg" width="110" alt="施設を追加"></a></h3>
		<ul class="linkList">
			<li><a href="#"> <span class="title"> <span>AAA保育園</span>タイプ：公立 </span> <span class="imgBox clearfix"> <img src="../img/owner/img_01.jpg" width="102" alt=""> <span>更新日時： 2013.10.10 10:00<br>
				TEL:03-0000-0000<br>
				〒000-0000<br>
				東京都○○区○○1-1-1</span> </span> </a></li>
			<li><a href="#"> <span class="title"><span>AAA保育園</span>タイプ：公立 </span> <span class="imgBox clearfix"> <img src="../img/owner/img_02.jpg" width="102" alt=""><span>更新日時： 2013.10.10 10:00<br>
				TEL:03-0000-0000<br>
				〒000-0000<br>
				東京都○○区○○1-1-1</span> </span> </a></li>
		</ul>
	</section>
