// Controls the showing and hiding of available options based on feature type

jQuery(document).ready(function($) {
	
	$('.rt-option-section').hide();
	
	var def_type = $('#rt-feat-type').attr('value');
		
	switch( def_type ) {
		
		case 'Standard Slider': 
			$('#standard-options').show(); 
		break;
		
		case 'Full-Width Slider': 
			$('#full-width-options').show();
		break;
		
	}
	
	$('#rt-feat-type').change(function() {
	
		var feat_type = $('#rt-feat-type').attr('value');
		
		switch( feat_type ) {
			
			case 'Standard Slider': 
				$('.rt-option-section').hide();
				$('#standard-options').fadeIn(500); 
			break;
			
			case 'Full-Width Slider': 
				$('.rt-option-section').hide();
				$('#full-width-options').fadeIn(500);
			break;
			
		}
		
	});
	
});