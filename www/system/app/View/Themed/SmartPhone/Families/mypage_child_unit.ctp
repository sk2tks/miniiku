<?php echo $this->Form->hidden("Child.{$n}.call_name"); ?>
&nbsp;&nbsp;<?php echo $this->Form->error("Child.{$n}.call_name",null, array('wrap'=>'span')); ?>
<?php echo $this->Form->hidden("Child.{$n}.id"); ?>
<?php echo $this->Form->hidden("Child.{$n}.family_id", array('value'=>$family_id)); ?>
<?php echo $this->Form->hidden("Child.{$n}.status", array('value'=>'1')); ?>
<p class="txt01"><span>※</span>は必須項目</p>
<table cellpadding="0" cellspacing="0" summary="こども" class="comTable childTable" style="margin-bottom:20px;border-bottom: 2px solid #ADE47A;">
	<col width="76%">
	<col width="24%">
	<tbody class="tableBox" data-num="<?php echo $n; ?>">
		<tr>
			<th colspan="2"><span class="color01">※</span>名前</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->input("Child.{$n}.name", array('class'=>'inputTxt01', 'div'=>false, 'label'=>false)); ?>
			</td>
			<td>
				<!--<input type="image" alt="公 開" value="公 開" src="/sp/img/maypage/btn_01.jpg" name="__send__" class="btn01">-->
				<?php
					echo $this->Form->input("Child.{$n}.pv_name", array(
						'type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'<br>',
						'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0
					));
				?>
			</td>
		</tr>
		<tr>
			<th colspan="2">ふりがな</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->input("Child.{$n}.kana", array('class'=>'inputTxt01')); ?>
			</td>
			<td>
				<?php echo $this->Form->input("Child.{$n}.pv_kana", array('type'=>'radio', 'label'=>true, 'separator'=>'<br>','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
			</td>
		</tr>
				<tr>
			<th colspan="2">写真</th>
		</tr>
		<tr>
			<td><ul class="clearfix selectPhoto">
					<li style="width:40%">
						<input type="file" value="" name="files" class='uploader' style="width:86%">
						<?php echo $this->Form->hidden("Child.{$n}.uploaded"); ?>
						<?php echo $this->Form->hidden("Child.{$n}.file_name"); ?>
					</li>
					<li class='image-box' style="width:44px">
						<?php
							$img = '';
							if(!empty($this->data['Child'][$n]['uploaded'])){
								$img = TEMP_DIR . 'thumb/' .  $this->data['Child'][$n]['uploaded'];
							}else if(!empty($this->data['Child'][$n]['file_name'])){
								$img = '/uploads/customer/thumb/'. $this->data['Child'][$n]['file_name'];
							}

							$display = empty($img) ? 'none' : 'block';
						?>
						<img src="<?php echo !empty($img) ? $img : DEFAULT_IMG_CHILD; ?>" alt="" width="44">
					</li>
					<li class='delete_image' style="width:17px;display:<?php echo $display; ?>">
						<img src="/sp/img/maypage/icon_01.gif" width="17" alt="削除" class='over' onclick='deleteImage(this);'>
						<input type='hidden' name='data[deleted]' value='' class='deleted'/>
					</li>
				</ul></td>
			<td>&nbsp</td>
		</tr>
		<tr>
			<th colspan="2"><span class="color01">※</span>性別</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->input("Child.{$n}.gender",
							array('type'=>'radio', 'legend'=>false, 'label'=>true, 'options'=>array('1'=>' 男の子　', '2'=>' 女の子　'), 'separator'=>'　　　')); ?>

			</td>
			<td>&nbsp</td>
		</tr>
		<tr>
			<th colspan="2">誕生日</th>
		</tr>
		<tr>
			<td>
				<?php echo $this->Form->input("Child.{$n}.birth",$this->Form->birthday_option(
								array('separator' => array('　年　','　月　','　日')))); ?>
			</td>
			<td>
				<!--<input type="image" alt="非公開" value="非公開" src="/sp/img/maypage/btn_03.jpg" name="__send__" class="btn01">-->
				<?php
					echo $this->Form->input("Child.{$n}.pv_birthday", array(
						'type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'<br>',
						'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0
					));
				?>
			</td>
		</tr>
		<tr>
			<th colspan="2">通園施設</th>
		</tr>
		<tr>
			<td>
				<ul class="facility clearfix">
					<li style="width:100%">
						<?php echo $this->Form->input('child_client_area',
							array('type'=>'select', 'options'=>$child_client_areas, 'empty'=>'地域', 'onchange'=>'childClientAreaChanged(this);', 'style'=>'width:30%', 'div'=>false, 'label'=>false)); ?>

						&gt;
						<?php echo $this->Form->input('child_client_type',
							array('type'=>'select', 'options'=>$child_client_types, 'empty'=>'種類', 'onchange'=>'childClientTypeChanged(this);', 'style'=>'width:30%', 'div'=>false, 'label'=>false, 'disabled')); ?>

						&gt;
						<?php echo $this->Form->input("Child.{$n}.client_id",
							array('type'=>'select', 'empty'=>'施設名','options'=>array('その他'=>'その他'), 'onChange'=>'childClientIdChanged(this);', 'style'=>'width:30%', 'div'=>false, 'label'=>false, 'disabled')); ?>

					</li>
				</ul>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<!--<input type="text" class="inputTxt01"name="url" value="">-->
				<?php echo $this->Form->hidden("Child.{$n}.client_id", array('id'=>"child_client_id_${n}", 'class'=>'clientId')); ?>
				<?php echo $this->Form->input("Child.{$n}.client_name",
					array('type'=>'text', 'class'=>'wid01 clientName','readonly'=>'readonly','id'=>"child_client_name_${n}", 'div'=>false, 'label'=>false, 'default'=>'未設定')); ?>
				<a href="javascript:void(0);" class='clientVote' style='display:none;'>
					<img src="/img/mypage/link18.jpg" width="120" height="23" alt="施設を評価する" onclick='evaluateClient(this);'>
				</a>
			</td>
			<td>
				<?php
					echo $this->Form->input("Child.{$n}.pv_client", array(
						'type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'<br>',
						'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0
					));
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="margin-bottom:30px;border-bottom: 2px solid #ADE47A;">
				<p class="pLink">
					<a href="javascript:void(0);" onclick="deleteChild(this);">登録解除</a>
				</p>
			</td>
		</tr>
	</tbody>
</table>
<script>
	$(function(){
		//Uploader.init('/mypage/customers/upload');
	})

	function deleteChild(elem){
		if(confirm("本当にこの子供をファミリーから登録解除してもよろしいですか？")){
			$(elem).parent().remove();
		}
	}
</script>
