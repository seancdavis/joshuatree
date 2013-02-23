jQuery(document).ready(function($) {
	$('.feat-color').wpColorPicker(); // controls the color pickers
	// current highlighted nav
	var currentMenuItem = $('#feat_nav_control').attr('value');
	if( currentMenuItem != '' ) {
		$('.feature-settings-section').hide();
		$('#' + currentMenuItem).show();
		$('.feature-settings-tab').removeClass('feature-settings-tab-selected');
		$('#tab_' + currentMenuItem).addClass('feature-settings-tab-selected');
	}
	// click control	
	$('.feature-settings-tab').click(function(){
		var id = $(this).attr('id').substr(4);
		$('.feature-settings-tab').removeClass('feature-settings-tab-selected');
		$(this).addClass('feature-settings-tab-selected');
		$('.feature-settings-section').hide();
		$('#' + id).show();
		$('#feat_nav_control').attr('value', id);
	});	
	$('#tab_').hide();
	//alert( $('#checkbox-bkg_color_lock').attr('checked') );
	if( $('#checkbox-bkg_color_lock').attr('checked') == undefined ) $('#label-bkg_color_lock').hide();
	$('#checkbox-bkg_color_lock').click(function(){
		if( $('#checkbox-bkg_color_lock').attr('checked') == undefined ) $('#label-bkg_color_lock').hide();
		else $('#label-bkg_color_lock').show();
	});	
});