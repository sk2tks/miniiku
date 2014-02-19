<?php echo $this->Html->css('owner', null, array('inline'=>false)); ?>
<?php $user_info = $this->Session->read('user_info'); //pr($user_info);?>
<h2>オーナーページ</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li>オーナーページ</li>
</ul>
<div class="ttl">
	<p>ユーザー名 ： <span><?php printf("%s　さん", $user_info['User']['name']); ?></span></p>
	
</div>
<div class="dateUl clearfix">
	<ul>
		<li>最終ログイン日 ：</li>
		<li class="liSpecial01"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['last_login'])); ?></span></li>
		<li class="liSpecial02">更新日 ：</li>
		<li class="liSpecial03"><span><?php echo date("Y年m月d日 H:i", strtotime($user_info['User']['modified'])); ?></span></li>
	</ul>
</div>
<h2 class="h201">オーナー情報</h2>
<script>
setInterval(function(){ $('#result').fadeIn('slow')}, 3000);
</script>
<div class="owner">
	<div class="dis"><img src="/img/owner/img_top.gif" alt="" width="740" height="5" /></div>
	<div class="inner">
		<?php echo $this->Form->create('User', array('url'=>$this->request->herer, 'type'=>'post', 'inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<p><span class="colorRed">＊</span>は必須項目</p>
		<table cellspacing="0" cellpadding="0" summary="オーナー情報">
			<col width="22%" />
			<col width="78%" />
			<tr>
				<th><span class="colorRed">＊</span>ユーザー名 ：</th>
				<td>
					<?php echo $this->Form->input('name'); ?>
				</td>
			</tr>
			<tr>
				<th><span class="colorRed">＊</span>メールアドレス ：</th>
				<td>
					<?php echo $this->Form->input('email', array('class'=>'email')); ?>
				</td>
			</tr>
			<tr>
				<th><span class="colorRed">＊</span>パスワード ：</th>
				<td>
					<?php echo $this->Form->input('new_password', array( 'placeholder'=>'パスワードを変更する場合に入力してください')); ?>	
				</td>
			</tr>
			<tr>
				<th><span class="colorRed">＊</span>パスワード（再） ： </th>
				<td><?php echo $this->Form->input('new_password2', array( 'placeholder'=>'パスワードを変更する場合に入力してください')); ?>	</td>
			</tr>
		</table>
		<ul class="submit">
			<li>
				<input type="image" src="/img/owner/btn01.jpg" alt="登録する" value="登録する" name="login" onmouseover="this.src='/img/owner/btn01_over.jpg'" onmouseout="this.src='/img/owner/btn01.jpg'" />
			</li>
		</ul>
		<?php $this->Form->end(); ?>
	</div>
</div>

<h2 class="h202 clearfix"><a href="#"><img src="../img/owner/btn02.jpg" alt="施設を追加" width="133" height="33" /></a>施設管理</h2>

<ul class="resultUl">
	
	<?php foreach($this->data['Client'] as $n=>$client):?>
	<li <?php if($n%2==0): ?>class="bgColor"<?php endif; ?> >
		<div class="clearfix">
			<p class="OwnBtn"><a href="/clients/view/<?php echo h($client['id']); ?>"><img src="../img/owner/btn03.png" alt="詳細" width="58" height="24" /></a></p>
			<div class="floatL">
				<?php if(!empty($client['file_name1'])){ ?>
				<img src="<?php echo CLIENT_DIR . 's/' . $client['file_name1']; ?>" alt=""  width="108"/>
				<?php }else{ ?>
					<img src="/img/no_image.jpg" width="108" />
				<?php } ?>
			</div>
			<dl>
				<dt><a href="/clients/edit/<?php echo h($client['id']); ?>"><?php echo h($client['name']); ?></a>タイプ：<?php echo $client['ClientType']['name']; ?></dt>
				<dd>更新日時： <?php echo date("Y.m.d H:i", strtotime($client['modified'])); ?><br />
					<?php if(!empty($client['tel'])) printf("TEL:%s　",h($client['tel'])); ?>
					<?php printf("〒%s %s%s%s",preg_replace("/^(\d{3})(\d{4})$/", "$1-$2", $client['zip']),$client['Prefecture']['name'], $client['address'], $client['sub_address']);?> </dd>
			</dl>
		</div>
	</li>
	<?php endforeach; ?>
	
</ul>
<div class="pageTop"><a href="#top">トップへ移動する</a></div>

<div id='resultMessage' style='font-size:60px;  color:gray; font-weight:bold;
	 z-index:1000; text-align:center; position:absolute; top:400px;  
	opacity:0.6; width:703px; height:100px; display:none;'>
	登録しました
</div>
<script>
$(function(){
	
	<?php if(!empty($saved)): ?>
	$('#resultMessage').fadeIn('slow');
	setTimeout(function(){$('#resultMessage').fadeOut('slow');}, 3000);
	<?php endif; ?>
})
</script>