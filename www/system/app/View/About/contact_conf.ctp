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

			<table width="730" cellpadding="0" cellspacing="0" class="comTable comTable01" summary="基本情報入力">
				<col width="20%" />
				<col width="80%" />
				<tbody>
					<tr>
						<th>氏名 ：</th>
						<td>
							<?php echo h($this->data['Contact']['name']); ?>
						
						</td>
					</tr>
					<tr>
						<th>メールアドレス ：</th>
						<td>
							<?php echo h($this->data['Contact']['email']); ?>
						
						</td>
					</tr>
					<tr>
						<th>種類 ：</th>
						<td>
							<?php echo $this->data['Contact']['type']; ?>
						</td>
					</tr>
					<tr>
						<th>内容 ：</th>
						<td>
							<?php echo nl2br(h($this->data['Contact']['message'])); ?>
						</td>
					</tr>
				</tbody>
			</table>
<form action ="" method='post'>			
			<div class="submit">
				<input type="image" src="/img/client/learn/btn_out.jpg" alt="確 認" value="確 認" name="__send__" onmouseover="this.src='/img/client/learn/btn_over.jpg'" onmouseout="this.src='/img/client/learn/btn_out.jpg'" />
			</div>
		<?php echo $this->Formhidden->hiddenVars(); ?>
	</form>

	</div>
	<div class="pageTop">
		<a href="#top">トップへ移動する</a>
	</div>
</div>

</html>