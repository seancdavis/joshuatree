<?php

add_action('init', 'load_faq_script');	
function load_faq_script() {
	wp_enqueue_script( 'rt-faq', get_template_directory_uri() . '/library/plugins/flint-faq/js/rt-faq.js', array('jquery') );
	//wp_enqueue_script( 'fancybox-css', get_template_directory_uri() . '/library/plugins/flint-faq/js/jquery.fancybox.pack.js', array('jquery') );
	wp_enqueue_style( 'rt-faq', get_template_directory_uri() . '/library/plugins/flint-faq/css/rt-faq.css' ); 
	//wp_enqueue_style( 'rt-faq', get_template_directory_uri() . '/library/plugins/flint-faq/css/jquery.fancybox.css' ); 
}

add_shortcode( 'faq', 'the_faq_loop' );

function the_faq_loop( $atts ) {
	
	extract(shortcode_atts(array(
		"category" => ''
	), $atts));
	
	$args = array( 
		'post_type' => 'rt_faq', 
	);
	
	$cat_corrector = 0;
	
	$content = '';
	
	if( $category != '' ) {
		
		$cat_query = new WP_Query( $args );
			
			while ( $cat_query->have_posts() ) :
			
				$cat_query->the_post();			
				
				$cats = get_the_category();
				
				foreach($cats as $cat) {					
					
					if( $cat->cat_name == $category ) {
												
						$this_content = get_the_content();
						$this_content = apply_filters('the_content', $this_content);
						
						$content .= '<div class="faq"><h2 class="faq-question">' . get_the_title() . '</h2>';
						
						$content .= '<div class="faq-answer">' . $this_content . '</div></div>';
						
						$cat_corrector = 1;
						
					}
				}
				
			endwhile;
			
			if( $cat_corrector == 1 ) $content = '<h1 class="faq-category">' . $category . '</h1><hr>' . $content;
	}
	
	if( $cat_corrector == 0 ) {
	
		$cats =  get_categories();
		
			foreach ($cats as $cat) {
				
				$cat_start = 0;
				
				$this_cat = $cat->cat_name;
				
				$the_query = new WP_Query( $args );
				
				while ( $the_query->have_posts() ) :
				
					$the_query->the_post();			
					
					$cats = get_the_category();
					
					$output = '';
					
					foreach($cats as $cat) {					
						
						if( $cat->cat_name == $this_cat ) {
							
							if( $cat_start == 0 ) { 
							
								$content .= '<h1 class="faq-category">' . $this_cat . '</h1><hr>'; 
								
								$cat_start = 1;
							}
							
							$this_content = get_the_content();
							$this_content = apply_filters('the_content', $this_content);
							
							$content .= '<div class="faq"><h2 class="faq-question">' . get_the_title() . '</h2>';
							
							$content .= '<div class="faq-answer">' . $this_content . '</div></div>';
							
						}
					}
					
				endwhile;
			}
	}
	
	return $content;
		
}

?>