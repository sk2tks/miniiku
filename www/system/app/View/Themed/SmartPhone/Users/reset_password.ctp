<style>
.reset_password_tbl{
	margin-top:30px;
	margin-left:auto;
	margin-right:auto;
	width:600px;
}
.reset_password_tbl td{
	padding:10px;
}
.reset_password_tbl th{
	font-size:1.2em;
}
</style>
<div id="conts">
	<h2 class="h2Ttl_2">パスワードを再設定する</h2>
			<ul id="pagePath">
				<li><a href="../">HOME</a>&gt;</li>
				<li>パスワードを再設定する</li>
			</ul>
		  <div class="comSubBox_">


	<?php echo $this->Form->create('User', array('action'=>$this->request->herer, 'type'=>'post',
						'class'=>'mailForm', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<?php echo $this->Form->hidden('Reminder.id'); ?>
		<table width="730" cellpadding="0" cellspacing="0" class="reset_password_tbl" summary="基本情報入力">
			<col width="30%" />
			<col width="80%" />
			<tbody>
				<tr>
					<th>新規パスワード ：</th>
					<td><?php echo $this->Form->input('new_password', array('type'=>'text')); ?></td>
				</tr>
				<tr>
					<th>新規パスワード（再入力） ：</th>
					<td><?php echo $this->Form->input('new_password2'); ?></td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:center;'>
						<input type="image" src="/img/member/btn01.gif" value="ログイン" alt="登録" name="__submit__" style='width:98%'/>
					</td>
				</tr>
			</tbody>
		</table>
		
	<?php $this->Form->end(); ?>
	
</div>
</div>