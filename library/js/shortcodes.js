jQuery(document).ready(function($) {
	// Help text is placed in 'name' attribute. This controls showing and hiding help text as needed.
	$('input, textarea').focus(function() {
		if( $(this).attr('class') != 'rt-mrcf-submit' && $(this).attr('name') == $(this).attr('value') ) $(this).attr('value','');
	});
	$('input, textarea').blur(function() {
		if( $(this).attr('class') != 'rt-mrcf-submit' && $(this).attr('name') != $(this).attr('value') && $(this).attr('value') != '' ) $(this).addClass('rt-input-blur');
		else if( $(this).attr('value') == '' ) {
			$(this).attr( 'value',$(this).attr('name') );
			$(this).removeClass('rt-input-blur');
		}
	});	
});