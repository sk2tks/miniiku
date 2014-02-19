<style>
#conts .comList .prev{
	margin:0;
}
#conts .comList li a{
	margin:0;
}
#conts .comList .next{
	margin:0;
}
#conts .comList li.on{
	color:#0;
	font-weight:bold;
}
</style>				
<?php if($this->Paginator->hasPage(2)): ?>
<ul class="comList" <?php if(!empty($paging_id)) printf("id='%s'", $paging_id); ?> >
	<?php echo $this->Paginator->prev('<<', array('tag' => 'li')); ?>
	<?php echo $this->Paginator->numbers(array(
			'tag' => 'li',
			'separator' => ' | ',
			'before' => '| ',
			'after' => ' |',
			'currentClass' => 'on'
		));
 ?>
	<?php echo $this->Paginator->next('>>', array('tag' => 'li')); ?>
</ul>
<?php endif; ?>