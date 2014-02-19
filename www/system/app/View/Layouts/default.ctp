<?php echo $this->element('header'); ?>

	<!-- #EndLibraryItem -->

<div id="container">
<?php echo $this->element('topnavi'); ?>
	<div id="main">

		<div id="conts">
			<?php echo $this->fetch('content'); ?>
		</div><!-- end conts -->
		<!-- #BeginLibraryItem "/Library/sidebar.lbi" -->
			<?php echo $this->element('sidebar'); ?>
		<!-- #EndLibraryItem -->
	</div><!-- end main -->
	<!-- #BeginLibraryItem "/Library/footer.lbi" -->
<?php echo $this->element('footer'); ?>
</div><!-- end container -->
