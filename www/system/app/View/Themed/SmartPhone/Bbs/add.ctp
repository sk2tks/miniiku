<?php $this->Html->css('/sp/css/common', null, array('inline' => false)); ?>
<?php $this->Html->css('/sp/css/bbs', null, array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.ui.widget.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.iframe-transport.js', array('inline' => false)); ?>
<?php echo $this->Html->script('/js/jquery.fileupload.js', array('inline' => false)); ?>
<?php echo $this->Html->script("/sp/js/bbs_add", array('inline'=>false)); ?>
<style>

/*ファイル選択ボタン画像化*/
.file_area {
  position: relative;
  display: block;
  width: 191px;
  height: 31px;
  overflow: hidden;
  background: url('/img/market/imgtext.jpg') no-repeat;
  zoom:0.7;
}
.file_area input {
  position: absolute;
  opacity: 0;
  right: 0;
  bottom: 5;
  padding: 0;
  margin: 0;
  font-size: 100px;
  z-index: 999;
  height: 28px;
}
</style>

<ul id="pagePath">
	<li><a href="/">HOME</a>&gt;</li>
	<li><?php echo $title_for_layout; ?></li>
</ul>

<section id="main">
	<h2><img src="/sp/img/market/img_h2_01.jpg" alt="" width="22"><span>交流広場</span></h2>
	<h3 class="comH3Ttl"><img src="<?php echo $catIcon; ?>" alt="" width="18"><?php echo $catName; ?></h3>
	<div class="market413">
		<!--<form class="mailForm" action="./" method="post">-->
		<?php echo $this->Form->create('Topic', array('class'=>'mailForm')); ?>
			<dl class="clearfix">
				<dt>カテゴリ</dt>
				<dd>：
					<select name="category">
						<?php foreach($categories as $category):?>
						<option value="<?php echo $category['Category']['slug']?>" <?php if($category['Category']['slug'] == $catSlug){echo 'selected="selected"';}?>><?php echo $category['Category']['category_name']?></option>
						<?php endforeach; ?>
					</select>
				</dd>
				<dt>公開範囲</dt>
				<dd class="next">：
					<select name="data[Topic][publicity_range]">
						<option value="1">地域限定</option>
						<option value="2">市区町村</option>
						<option value="3">都道府県</option>
						<option value="4">全国</option>
					</select>
				</dd>
			</dl>
			<p>
				<?php
					echo $this->Form->input( 'tag_id', array(
					    'type' => 'select',
					    'options' => $tags,
					    'empty' => 'タグ',
					    'label' => false,
					    'class'=>'tag',
					    'div'=>false
					));
				?>
				<input id="tagInput" type="text" placeholder="" name="text" class="text2">
				<input type="button" value="追加" name="add" class="add">
			</p>
			<p class="text1">タイトル：<br />
				<input type="text" placeholder="見出しを記入してください" name="data[Topic][title]" style="color:#000">
			</p>
			<p>本文：<br />
				<textarea name="data[Topic][body]" cols="5" rows="5"></textarea>
			</p>
			<div class="comForm">

				<ul class="photoUl clearfix">
					<li>
						<p class="file_area">
							<input type="file" name="files" class="uploader"/>
							<?php echo $this->Form->hidden('Topic.uploaded1'); ?>
							<?php echo $this->Form->hidden('Topic.file_name1'); ?>
						</p>
						<img class="pic" width="100%" />
						<img class="noImage" src="/sp/img/common/img01.jpg" alt="noImage" width="100%">
						<img class="delete_chk" src="/sp/img/common/close_img.jpg" alt="" style="width:38px;cursor:pointer">
						<input type='hidden' name='data[deleted1]' value='' class='deleted' />
					</li>
					<li class="floatR">
						<p class="file_area">
							<input type="file" name="files" class="uploader"/>
							<?php echo $this->Form->hidden('Topic.uploaded2'); ?>
							<?php echo $this->Form->hidden('Topic.file_name2'); ?>
						</p>
						<img class="pic" width="100%" />
						<img class="noImage" src="/sp/img/common/img02.jpg" alt="noImage" width="100%">
						<img class="delete_chk" src="/sp/img/common/close_img.jpg" alt="" style="width:38px;cursor:pointer">
						<input type='hidden' name='data[deleted2]' value='' class='deleted' />
					</li>
				</ul>
				<ul class="submit">
					<li>
						<img id="submit_btn" src="/sp/img/market/btn01.jpg" width="150" alt="登録">
					</li>
					<li>
						<a href="/bbs/index/<?php echo $catSlug;?>">
							<img name="" src="/sp/img/market/btn02.jpg" width="150" alt="キャンセル">
						</a>
					</li>
				</ul>
			</div>
		<!--</form>-->
		<?php echo $this->Form->end(); ?>
	</div>
</section>
