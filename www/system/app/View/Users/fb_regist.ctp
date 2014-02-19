<script>
function fancyboxBeforeClosed(){
	location.href = '<?php echo $referer; ?>';
}
$(function(){
	$('#headerLogin a').trigger('click');
})
</script>

