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
		<?php echo $this->Form->create('Contact',array('type'=>'post', 'inputDefaults'=>array('label'=>false, 'div'=>false, 'legend'=>false))); ?>
			<input type='hidden' name='data[mode]' value='conf' />
			<?php echo $this->element('token'); ?>
			<table width="730" cellpadding="0" cellspacing="0" class="comTable comTable01" summary="基本情報入力">
				<col width="20%" />
				<col width="80%" />
				<tbody>
					<tr>
						<th>氏名 ：</th>
						<td>
							<?php echo $this->Form->input('name'); ?>
						
						</td>
					</tr>
					<tr>
						<th>メールアドレス ：</th>
						<td>
							<?php echo $this->Form->input('email', array('class'=>'email')); ?>
						
						</td>
					</tr>
					<tr>
						<th>種類 ：</th>
						<td>
						<ul>
							<?php echo $this->Form->input('type', array('type'=>'radio', 'default'=>'質問', 'separator'=>'　　　','options'=>array(
								'質問'=>'質問',
								'申し込み'=>'申し込み'
							)));
							?>
							<!-- <li>
								<label for="fType01">
									<input type="radio" value="質問" name="type" id="fType01" checked="checked" />
									質問</label>
							</li>
							<li>
								<label for="fType02">
									<input type="radio" value="申し込み" name="type" id="fType02" />
									申し込み</label>
							</li> -->

						</ul></td>
					</tr>
					<tr>
						<th>内容 ：</th>
						<td>
							<?php echo $this->Form->input('message', array('type'=>'textarea', 'cols'=>'5')); ?></td>
					</tr>
				</tbody>
			</table>
			<div class="submit">
				<input type="image" src="/img/client/learn/btn_out.jpg" alt="確 認" value="確 認" name="__send__" onmouseover="this.src='/img/client/learn/btn_over.jpg'" onmouseout="this.src='/img/client/learn/btn_out.jpg'" />
			</div>
		<?php echo $this->Form->end(); ?>

	</div>
	<div class="pageTop">
		<a href="#top">トップへ移動する</a>
	</div>
</div>

</html>