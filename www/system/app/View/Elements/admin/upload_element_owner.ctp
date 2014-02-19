
<?php
	if(empty($dir)) return;
	if(empty($uploaded)) $uploaded = 'uploaded';
	if(empty($file_name)) $file_name = 'file_name';
	if(empty($title)) $title = '画像';
	if(empty($deleted)) $deleted = 'deleted';
	$thumb = empty($thumb) ? 'thumb/' : $thumb . '/';
?>
<div class="control-group">
	<label for="CustomerFileName" class="control-label"><?php echo $title; ?></label>
	<div class="controls">
		<button><a class='btn btn-success btn-small' style='position:relative;float:left;margin-right:10px; '>アップロード<input type='file' class='uploader' style='position:absolute; top:0; right:0; opacity:0 '>
		</a></button>
		<?php echo $this->Form->hidden($uploaded); ?>
		<?php echo $this->Form->hidden($file_name); ?>
		<?php 
			$img = '';
			if(!empty($data[$uploaded])){
				$img = TEMP_DIR . $thumb.  $data[$uploaded];	
			}else if(!empty($data[$file_name])){
				$img = $dir . $thumb. $data[$file_name];
			}
		?>
		<?php echo '<p class="progress"><img class="bar" src="/img/img_progress.gif" alt="" width="0%" height="14"></p>';?>
		<div <?php if(empty($img)): ?>style='display:none'<?php endif; ?> class='image-box'>
		<img src='<?php echo $img; ?>' style='clear:both; display:block; margin-top:5px;'>
		<input type="hidden" name="data[<?php echo $deleted;?>]" id="deleted1_" value="0"/>
		<input type="checkbox" name="data[<?php echo $deleted;?>]"  class="delete_chk_client" value="1" id="deleted1"/><label for="deleted1">削除する</label>
		<?php //echo $this->Form->input($deleted, array('type'=>'checkbox', 'div'=>false, 'label'=>'削除する', 'class'=>'delete_chk_client')); ?>

		</div>

	</div>

</div>