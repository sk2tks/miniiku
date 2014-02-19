<?php $this->Html->css('sp/common', null, array('inline' => false)); ?>
<style>
input[type=radio]{
	margin-right:5px;
}
</style>
<div id="conts">
	<ul id="pagePath">
		<li><a href="../../sp">HOME</a>&gt;</li>
		<li>ご要望/お問合せ</li>
	</ul>
	<section id="main">
		<h2>ご要望/お問合せ</h2>
		<div class="formBox clearfix">
       <form class="mailForm" action="./" method="post">
		<p>
			日頃よりご愛顧いただきありがとうございます。<br />
			みんなの育児に関するお問い合わせは<br />
			下記よりご記入ください。<br />
			お問い合わせいただいた内容を確認し、ご回答いたします。
			<br />
			<br />
			※恐れ入りますが、ご回答まで1営業日ほどいただく場合があります。<br />
			何卒ご了承いただけますようお願い申し上げます。<br />
		</p>
		<br />
		<?php echo $this->Form->create('Contact',array('type'=>'post', 'inputDefaults'=>array('label'=>false, 'div'=>false, 'legend'=>false))); ?>
			<input type='hidden' name='data[mode]' value='conf' />
			<?php echo $this->element('token'); ?>
			<table class="comTable" summary="ご要望/お問合せ" cellpadding="0" cellspacing="0" width="730">
				<tbody>
					<tr><th>氏名 ：</th></tr>
					<tr><td><?php echo $this->Form->input('name'); ?></td></tr>
					<tr><th>メールアドレス ：</th></tr>
					<tr><td><?php echo $this->Form->input('email', array('class'=>'email')); ?></td></tr>
					<tr><th>種類 ：</th></tr>
					<tr><td>
						<ul><?php echo $this->Form->input('type', array('type'=>'radio', 'default'=>'質問', 'separator'=>'　　　','options'=>array(
							'質問'=>'質問',
							'申し込み'=>'申し込み'
							)));
							?>
						</ul></td></tr>
					<tr><th>内容 ：</th></tr>
					<tr><td><?php echo $this->Form->input('message', array('type'=>'textarea', 'cols'=>'5')); ?></td></tr>
				</tbody>
			</table>
			<div class="submit">
				<input type="image" src="/img/client/learn/btn_out.jpg" alt="確 認" value="確 認" name="__send__" onmouseover="this.src='/img/client/learn/btn_over.jpg'" onmouseout="this.src='/img/client/learn/btn_out.jpg'" />
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</section>
</div>
