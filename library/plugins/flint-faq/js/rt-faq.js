jQuery(document).ready(function($) {
    
	$('.faq-question').toggle(function() {
		$(this).parent().children('.faq-answer').fadeIn();
	},
	function() {
		$(this).parent().children('.faq-answer').fadeOut();
	});
	
});