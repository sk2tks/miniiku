<?php echo $this->Html->script('/js/admin.js', array('inline'=>false)); ?>
<style>
select{
	margin-right:2px;
	margin-left: 3px;
}
</style>
<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('UpdateInfo', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Admin Edit %s', __('Update Info')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('title', array('class'=>'input-xxlarge'));
				echo $this->BootstrapForm->input('body', array('class'=>'input-xxlarge','rows'=>10));
				echo $this->BootstrapForm->input('url', array('class'=>'input-xxlarge'));
				echo $this->BootstrapForm->input('prefecture_id', array('id'=>'prefecture', 'empty'=>'選択してください'));
				
				echo $this->BootstrapForm->input('municipal_id', array('id'=>'municipal','empty'=>'選択してください'));
				echo $this->BootstrapForm->input('area_id', array('id'=>'area', 'empty'=>'選択してください'));
				echo $this->BootstrapForm->input('publicity_range', array('type'=>'select', 'options'=>MasterOption::$publicity_ranges, 'empty'=>'選択してください' ));
				?>
				<div class="control-group">
					<label for="UpdateInfoTitle" class="control-label">更新日</label>
				<div class="controls">
				<?php
				echo  $this->Form->dateTime('UpdateInfo.update_date', 'YMD H:i',24,
									array(
										'style'=>'width:auto;height:auto;',
										'separator'=>array('年','月','日'),
										'empty' => '---',
							            'minYear' => 2012,
							            'maxYear' => date('Y')+1,
							            'monthNames' => false,
							            'default'=>array('year'=>date('Y'),'day'=>date('d'), 'month'=>date('m'))
							        )); 
				?>
				</div></div>
				<?php echo $this->BootstrapForm->input('status', array('type'=>'radio', 'label'=>'状態', 'options'=>array('1'=>'公開', '0'=>'非公開'), 'default'=>0)); ?>
				<div class="form-actions">
					<button type="submit" class="btn  btn-primary span3">登録</button>
					<button type="button" class="btn span3" onclick='location.href="/admin/update_infos"'>一覧に戻る</button>
					
				</div>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	
</div>