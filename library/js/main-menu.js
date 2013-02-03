jQuery(document).ready(function($){
	
	// adds hover effects to WordPress menus
	var hover_num = 0;
	var control_num = 0;
	if( $('.main-menu').length > 0 ) {	
		$('.main-menu li').hover(function() {
			hover_num++;
			control_num = hover_num;
			slide_check($(this).attr('id'), control_num);
		}, 
		function() {
			hover_num++;
			$(this).children( 'ul' ).fadeOut(500);
		});	
		function slide_check(id, num_check) {
			setTimeout(function(){
				if( hover_num == num_check && $('#' + id).parent().attr('class') != 'sub-menu' ) {
					$('#' + id).children( 'ul' ).slideDown(350);
				}
			},250);
		}
	}
	
	// when main menu is shown as dropdown, this makes a selection of a menu item act as a click on a link.	
	if( $('#main-menu-small').length > 0 ) {
		$('#main-menu-small').change(function() {		
			window.open( $(this).attr('value'), '_self' );
		});
	}
		
}); 