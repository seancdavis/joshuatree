jQuery(document).ready(function($) {
	$('.feat-color').wpColorPicker(); // controls the color pickers	
	$('.feature-settings-tab').click(function(){
		var id = $(this).attr('id').substr(4);
		$('.feature-settings-tab').removeClass('feature-settings-tab-selected');
		$(this).addClass('feature-settings-tab-selected');
		$('.feature-settings-section').hide();
		$('#' + id).show();
	});
	$('#tab_').hide();	
});