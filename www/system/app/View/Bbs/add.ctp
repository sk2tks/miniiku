<?php $this->Html->css('market', null, array('inline' => false)); ?>

<style>
/*ファイル選択ボタン画像化のためのcss*/
.file_area {
  position: relative;
  display: block;
  width: 191px;
  height: 28px;
  overflow: hidden;
  background: url('/img/market/imgtext.jpg') no-repeat;
}
.file_area input {
  position: absolute;
  opacity: 0;
  right: 0;
  bottom: 0;
  padding: 0;
  margin: 0;
  font-size: 100px;
  z-index: 999;
  height: 300px;
}

.btn {
	cursor: pointer;
}
.btn:hover {
    filter: alpha(opacity=70);
    opacity:0.7;
}
.inactive {
    filter: alpha(opacity=40);
    opacity: 0.4;
}
</style>

<?php echo $this->Html->script('/common/js/common.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/common/js/smartRollover.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/common/js/jquery.carouFredSel-5.6.4.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/bbs_add.js', array('inline' => false)); ?>

<script type="text/javascript">
$(function(){
	var toolbar=$('.photoList .photo').clone();
	$('.linkPhoto').carouFredSel({
		prev: '.prev',
		next: '.next',
		auto: false,
		pagination:{
			container:'.photoList .photo',
			anchorBuilder:function(nr, item) {
				return toolbar.find('li').eq(nr-1).clone();
			}
		}
	});
});
</script>

<h2 class="h2Ttl">交流広場</h2>
<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>
<div class="market">
	<div class="subMarket">
		<?php echo $this->Form->create('Topic'); ?>
		<h3><span style="background-image: url('<?php echo $catIcon; ?>')"><?php echo $catName; ?></span></h3>
		<div class="childbirth clearfix">
			<dl class="clearfix">
				<dt>カテゴリ：</dt>
				<dd>
					<ul class="clearfix">
						<?php foreach($categories as $category):?>
						<li>
							<label>
								<input type="radio" value="<?php echo $category['Category']['slug']?>" name="category" <?php if($category['Category']['slug'] == $catSlug){echo 'checked="checked"';}?> />
								<?php echo $category['Category']['category_name']?></label>
						</li>
						<?php endforeach; ?>
					</ul>
				</dd>
			</dl>
			<p>公開範囲：
				<select name="data[Topic][publicity_range]">
					<option value="1">地域限定</option>
					<option value="2">市区町村</option>
					<option value="3">都道府県</option>
					<option value="4">全国</option>
				</select>
			</p>
		</div>
		<div class="inner clearfix">
			<p>
				<input type="text" size="40" placeholder="見出しを記入してください" name="data[Topic][title]" style="color:initial">
			</p>
			<!--
			<select name="tag">
				<option value="タグ">タグ</option>
			</select>
			-->
			<?php
				echo $this->Form->input( 'tag_id', array(
				    'type' => 'select',
				    'options' => $tags,
				    'empty' => 'タグ',
				    'label' => false
				));
			?>
			<br />
			<input id="tagInput" type="text" value="" class="text"  size="20" />
			<input type="button" value="追加" name="add" class="add btn" />

		</div>
		<div class="box clearfix">
			<div class="lBox">
				<textarea name="data[Topic][body]" cols="5" rows="5"></textarea>
				<!--
				<p>追記</p>
				<textarea name="related_topic" cols="5" rows="5" class="postscript"></textarea>
				-->
			</div>
			<div class="rBox">
				<!--<p class="file"><a href="#"><img src="/img/market/imgtext.jpg" width="191" height="28" alt="ファイル選択" /></a></p>-->
				<div class="file file_area">
					<input type="file" name="files" class="uploader"/>
					<?php echo $this->Form->hidden('Topic.uploaded1'); ?>
					<?php echo $this->Form->hidden('Topic.file_name1'); ?>
				</div>
				<ul class="clearfix">
					<li>
						<div class="pic">
							<?php
								$img1 = '';
								if(!empty($this->data['Topic']['uploaded1'])){
									$img1 = TEMP_DIR .  $this->data['Topic']['uploaded1'];
								}
							?>
							<img src="<?php echo $img1; ?>" width="190" alt="">
							<div class="batsu">
								<img src="/img/market/link12.png" alt="削除" width="26" height="23" class='delete_chk btn' />
								<input type='hidden' name='data[deleted1]' value='' class='deleted' />
							</div>
						</div>
					</li>
				</ul>
				<div class="file file_area">
					<input type="file" name="files" class="uploader"/>
					<?php echo $this->Form->hidden('Topic.uploaded2'); ?>
					<?php echo $this->Form->hidden('Topic.file_name2'); ?>
				</div>
				<ul class="clearfix">
					<li>
						<div class="pic">
							<?php
								$img2 = '';
								if(!empty($this->data['Topic']['uploaded2'])){
									$img2 = TEMP_DIR .  $this->data['Topic']['uploaded2'];
								}
							?>
							<img src="<?php echo $img2; ?>" width="190" alt="">
							<div class="batsu">
								<img src="/img/market/link12.png" alt="削除" width="26" height="23" class='delete_chk btn' />
								<input type='hidden' name='data[deleted2]' value='' class='deleted' />
							</div>
						</div>
					</li>
				</ul>
				<ul class="submit clearfix">
					<li>
						<img id="submit_btn" class="btn" src="/img/market/btn01.jpg" alt="登録" name="__submit__" value="登録" onmouseover="this.src='/img/market/btn01_over.jpg'" onmouseout="this.src='/img/market/btn01.jpg'" />
					</li>
					<li>
						<a href="/bbs/index/<?php echo $catSlug;?>">
							<img src="/img/market/btn02.jpg" alt="キャンセル" name="__retry_input__" value="キャンセル" onmouseover="this.src='/img/market/btn02_over.jpg'" onmouseout="this.src='/img/market/btn02.jpg'" />
						</a>
						<!--<BUTTON type="reset" style="border-width:0;padding:0">
							<IMG src="/img/market/btn02.jpg" alt="キャンセル" name="__retry_input__" value="キャンセル" onmouseover="this.src='/img/market/btn02_over.jpg'" onmouseout="this.src='/img/market/btn02.jpg'">
						</BUTTON>-->
					</li>
				</ul>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="pageTop"><a href="#top">トップへ移動する</a></div>