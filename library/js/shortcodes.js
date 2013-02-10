jQuery(document).ready(function($) {
	$('input').focus(function(){
		$(this).attr('value','');
	});
	$('textarea').focus(function(){
		$(this).attr('value','');
	});
});