		<div class="tableBox" data-num="<?php echo $n; ?>">
			<p class="pNote"><span>※</span>は必須項目
			<?php echo $this->Form->hidden("Child.{$n}.call_name"); ?>
			&nbsp;&nbsp;<?php echo $this->Form->error("Child.{$n}.call_name",null, array('wrap'=>'span')); ?>
			</p>
			<table cellpadding="0" cellspacing="0" summary="こども">
				<?php echo $this->Form->hidden("Child.{$n}.id"); ?>
				<?php echo $this->Form->hidden("Child.{$n}.family_id", array('value'=>$family_id)); ?>
				<?php echo $this->Form->hidden("Child.{$n}.status", array('value'=>'1')); ?>
				<colgroup>
					<col width="22%">
					<col width="59%">
				</colgroup><tbody>
					<tr>
						<th><span>※</span>名前：</th>
						<td><?php echo $this->Form->input("Child.{$n}.name", array('label'=>false,'class'=>'wid01')); ?></td>
						<td><div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_name",
								array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>1)); ?></div></td>
					</tr>
					<tr>
						<th class="thSpecial">ふりがな：</th>
						<td><?php echo $this->Form->input("Child.{$n}.kana", array('label'=>false, 'class'=>'wid01')); ?></td>
						<td><div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_kana",
								array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>1)); ?></td>
					</tr>
					<tr>
						<th class="thSpecial">写真 ： </th>
						<td><ul class="photo clearfix">
								<li>
									<div class='file css_btn_class'>ファイル選択
									<input type="file" value="" name="files" class='uploader'>
									<?php echo $this->Form->hidden("Child.{$n}.uploaded"); ?>
									<?php echo $this->Form->hidden("Child.{$n}.file_name"); ?>
									</div>
								</li>
								<li class='image-box'>
									<?php
										$img = '';
										if(!empty($this->data['Child'][$n]['uploaded'])){
											$img = TEMP_DIR . 'thumb/' .  $this->data['Child'][$n]['uploaded'];
										}else if(!empty($this->data['Child'][$n]['file_name'])){
											$img = '/uploads/customer/thumb/'. $this->data['Child'][$n]['file_name'];
										}
									?>
									<img src="<?php echo !empty($img) ? $img:DEFAULT_IMG_CHILD; ?>" width="70" alt="">
								</li>
								<li class='delete_image' <?php if(empty($img)): ?>style='display:none'<?php endif; ?>>
									<img src="/img/mypage/link12.jpg" width="26" height="23" alt="削除" class='over' onclick='deleteImage(this, "<?php echo DEFAULT_IMG_CHILD; ?>");'>
									<input type='hidden' name='data[Child][<?php echo $n; ?>][deleted]' value='' class='deleted' />
								</li>
							</ul></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th class="thSpecial">性別 ： </th>
						<td>
							<?php echo $this->Form->input("Child.{$n}.gender",
								array('type'=>'radio', 'legend'=>false, 'label'=>true, 'options'=>array('1'=>' 男の子　', '2'=>' 女の子　'), 'separator'=>'　　　')); ?>
							</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_gender", array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>1)); ?>
							</div>
						</td>
					</tr>
					<tr>
						<th class="thSpecial">誕生日 ：</th>
						<td>
							<?php echo $this->Form->input("Child.{$n}.birth",$this->Form->birthday_option(	array('label'=>false))); ?>
						</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_birthday", array('type'=>'radio', 'legend'=>false, 'label'=>true, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>1)); ?>
							</div>
						</td>
					</tr>
					<tr class="trFacility">
						<th class="thSpecial">通園施設：</th>
						<td colspan="2"><ul class="facility">
							<li>
								<?php echo $this->Form->input('child_client_area',
									array('type'=>'select', 'label'=>false, 'div'=>false, 'options'=>$child_client_areas, 'empty'=>'地域', 'onchange'=>'childClientAreaChanged(this);')); ?>
								&gt;
								<?php echo $this->Form->input('child_client_type',
									array('type'=>'select', 'label'=>false, 'div'=>false, 'options'=>$child_client_types, 'empty'=>'種類', 'onchange'=>'childClientTypeChanged(this);', 'disabled')); ?>
								&gt;
								<?php echo $this->Form->input("Child.{$n}.client_id",
									array('type'=>'select', 'label'=>false, 'div'=>false, 'empty'=>'施設名','options'=>array('その他'=>'その他'), 'onChange'=>'childClientIdChanged(this);', 'disabled')); ?>
							</li>
						</ul></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<?php echo $this->Form->hidden("Child.{$n}.client_id", array('id'=>"child_client_id_${n}", 'class'=>'clientId')); ?>
							<?php echo $this->Form->input("Child.{$n}.client_name",
								array('type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'wid01 clientName','readonly'=>'readonly','id'=>"child_client_name_${n}", 'default'=>'地域、種類から選択')); ?>
							<a href="javascript:void(0);" class='clientVote' style='display:none;'><img src="/img/mypage/link18.jpg" width="120" height="23" alt="施設を評価する" onclick='evaluateClient(this);'></a>
						</td>
						<td>
							<div class="list clearfix" style='margin-left:-4px;'>
							<?php echo $this->Form->input("Child.{$n}.pv_client", array('type'=>'radio', 'label'=>true, 'legend'=>false, 'separator'=>'　 ','options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php if($is_main_customer): ?>
			<p class="pLink" onclick='deleteChild(this);'>&gt;&gt;<a href="javascript:void(0);" >登録解除</a></p>
			<?php endif; ?>
		</div>
<script>
	$(function(){
		Uploader.init('/mypage/customers/upload');
		setRollover();
	})

	function deleteChild(elem){
		if(confirm("本当にこの子供をファミリーから登録解除してもよろしいですか？")){
			$(elem).parent().remove();
		}
	}
</script>
