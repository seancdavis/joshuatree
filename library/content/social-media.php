<?php

/* Social Icons
------------------------------------------------------------------------ */
function rt_get_social_icons() {
	
	$social_icons = '';
	
	if( rt_get_option('rt_facebook') != '' ) $social_icons .= '<a href="' . rt_get_option('rt_facebook') . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/facebook.png" /></a>';
	
	if( rt_get_option('rt_twitter') != '' ) $social_icons .= '<a href="' . rt_get_option('rt_twitter') . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/twitter.png" /></a>';

	if( rt_get_option('rt_linkedin') != '' ) $social_icons .= '<a href="' . rt_get_option('rt_linkedin') . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/linkedin.png" /></a>';

	if( rt_get_option('rt_pinterest') != '' ) $social_icons .= '<a href="' . rt_get_option('rt_pinterest') . '" target="_blank"><img src="' . get_template_directory_uri() . '/images/pinterest.png" /></a>';
	
	return $social_icons;
				
}

?>