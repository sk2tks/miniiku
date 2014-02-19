$(document).ready(function(){
	$('form select#searchClientTypeId').change(function(){
		$('form#searchSearchForm').submit();
	});
	$('form .searchBtn').click(function(){
		$('form#searchSearchForm').submit();
	});
})