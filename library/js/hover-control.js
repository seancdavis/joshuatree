// adds hover effects to WordPress menus
jQuery(document).ready(function($) {
	
	var hover_num = 0;
	var control_num = 0;
	
	$(".main-menu ul").hover(function() {
		$(this).parent().attr('class', 'main-menu-parent_hover');
	},
	function() {
		$(this).parent().attr('class', 'main-menu-parent_no-hover');		
	});
	
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
	
});