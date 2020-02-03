$(document).ready(function(){
	$('.select_all').click(function(){
		$('.dropdown_group li input[type=checkbox]').prop('checked', true);
	})

	$('.remove_select_all').click(function(){
		$('.dropdown_group li input[type=checkbox]').prop('checked', false);
	})

})