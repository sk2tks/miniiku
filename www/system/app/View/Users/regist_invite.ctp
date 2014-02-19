<script>
function fancyboxBeforeClosed(){
	location.href = '<?php echo $referer; ?>';
}
$(function(){
	$('#regist').trigger('click');
})
</script>

<a id='regist' href="/users/regist/<?php echo $token; ?>" class="fancybox fancybox.iframe"></a>