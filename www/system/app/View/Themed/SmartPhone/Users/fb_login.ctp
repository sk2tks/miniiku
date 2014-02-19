<script>
function fancyboxBeforeClosed(){
	location.href = '<?php echo $referer; ?>';
}
$(function(){
	$('#regist_user_popup').trigger('click');
})
</script>

