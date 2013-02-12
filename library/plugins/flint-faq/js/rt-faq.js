jQuery(document).ready(function($) {
    
    var questionCount = 1;
	$('.faq-question').each(function(){
		$(this).attr('id','rt-faq-' + questionCount);
		questionCount++;
	});
	
	$('.faq-question').click(function() {
		
		$('.faq-question').css('clear','none');
		$('.faq-answer').hide();
		
		var thisQuestion = parseFloat( $(this).attr('id').substr(7, $(this).attr('id').length - 7 ) );
		
		$(this).css('clear','both');
		$('#rt-faq-' + (thisQuestion + 1) ).css('clear','both');
		
		$(this).parent().children('.faq-answer').show();
		
		
		//$(this).parent().children('.faq-answer').fadeIn();
		/*
		$(this).animate({
			opacity: 0.25
		}, 500);
		*/
		//$('.faq-question').css('clear','none');
		//$(this).css('clear','both');
	});
	//function() {
		//$(this).css('clear','none');
		//$(this).parent().children('.faq-answer').fadeOut();
	//});
	
});