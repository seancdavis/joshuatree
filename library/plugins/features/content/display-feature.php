<?php

/* Registration
-------------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'load_feature_script');	
function load_feature_script() {
	if( is_front_page() ) { 		
		$feat_type = rt_get_feature_option( 'rt_feat_type' );		
		switch( $feat_type ) {			
			case 'Standard Slider' :			
				wp_enqueue_script( 'feature-fw', get_template_directory_uri() . '/library/plugins/features/js/standard-slider.js', array('jquery') );
				wp_enqueue_style( 'feature-fw', get_template_directory_uri() . '/library/plugins/features/css/standard-slider.css' ); 
				break;				
			case 'Full-Width Slider' :		
				wp_enqueue_script( 'feature-fw', get_template_directory_uri() . '/library/plugins/features/js/full-width-slider.js', array('jquery') );
				wp_enqueue_style( 'feature-fw', get_template_directory_uri() . '/library/plugins/features/css/full-width-slider.css' ); 
				break;		
		}		
	}	
}

/* Display Feature --- usually called from header.php
------------------------------------------------------------------------- */
add_action( 'display_feature', 'get_feature_type' );

function get_feature_type() {
	
	$feat_type = rt_get_feature_option( 'rt_feat_type' );
	$colors = get_feature_color( $feat_type );
	display_feature_content( $feat_type, $colors['std'], $colors['fw_def_1'], $colors['fw_def_2'] );
	
}

function display_feature_content( $feat_type, $std_color, $fw_def_1, $fw_def_2 ) {
	
	$feature_counter = 1; ?>
	
	<div id="feature-wrapper" style="background-color:<?php print $std_color; ?>">
    	<div id="feature-container">
	
	<?php $loop = new WP_Query( array ( 'post_type' => 'rt_feature', 'orderby' => 'meta_value', 'order' => 'ASC', 'meta_key' => '_order', 'posts_per_page' => '100' ) );

		while ( $loop->have_posts() ) : $loop->the_post();			
			
			// feature must be active to be used
			if( get_post_meta( get_the_ID(), '_disable_feature', true ) == 0 ) {
				
				switch( $feat_type ) {
					
					case 'Standard Slider':
					$std_url = get_post_meta( get_the_ID(), '_std_url', true );
					$std_target = get_post_meta( get_the_ID(), '_std_target', true );
					if( $std_url != '' && $std_target == 1 ) echo '<a href="' . $std_url . '" target="_blank">';
					else if( $feat_type == 'Standard Slider' && $std_url != '' ) echo '<a href="' . $std_url . '>';					
					echo '<div id="feature-container-' . $feature_counter . '" class="feature-container">';					
					break;
					
					case 'Full-Width Slider':
					$these_colors = get_this_feature_color( $feat_type, get_the_ID(), $fw_def_1, $fw_def_2 );
					echo '<div id="feature-container-' . $feature_counter . '" class="feature-container" style="background-color:' . $these_colors . '">';	
					break;					
					
				}				
                	
                    the_post_thumbnail( 'full', array('class' => 'feature-image'));					
					the_title( '<h1 class="feature-title">', '</h1>' );
					the_content();
                        	
					if( $feat_type == 'Full-Width Slider' && get_post_meta( get_the_ID(), '_button_text', true ) != '' ) : ?>
                        
                        <div class="call-to-action-container">
                        
                            <?php 
                                $button_text = get_post_meta( get_the_ID(), '_button_text', true );
                                $button_url = get_post_meta( get_the_ID(), '_button_url', true );
                                $button_target = get_post_meta( get_the_ID(), '_button_target', true );
                                
                                echo '<a class="feature-link" target="' . $button_target . '" href="' . $button_url . '"><span class="call-to-action">' . $button_text . '</span></a>'; ?>
                    
                        </div>
                        
					<?php endif; ?>
                    
				</div>
                
				<?php if( $feat_type == 'Standard Slider' && $std_url != '' ) echo '</a>';
							
				$feature_counter++;
			
			}
			
		endwhile; ?>
        
        </div>
        
	</div>

<?php } 

function get_feature_color( $feat_type ) {
	
	$colors = array(
		'std' => '',
		'fw_def_1' => '',
		'fw_def_2' => ''
	);
	
	switch( $feat_type ) {
		
		case 'Standard Slider':
		if( rt_get_feature_option( 'std_rt_feat_bkg_type' ) == 'Transparent' ) $colors['std'] = 'transparent';
		else $colors['std'] = rt_get_feature_option( 'std_rt_feat_bkg' );		
		break;
		
		case 'Full-Width Slider':
		// Default background colors
		$colors['fw_def_1'] = rt_get_feature_option( 'fw_rt_feat_bkg_1' );
		$colors['fw_def_2'] = rt_get_feature_option( 'fw_rt_feat_bkg_2' );
		break;
		
		
	}
	
	return $colors;
	
}

function get_this_feature_color( $feat_type, $post_id, $def_1, $def_2 ) {
	
	$this_bkg_1 = get_post_meta( $post_id, '_background_1', true );
	$this_bkg_2 = get_post_meta( $post_id, '_background_2', true );	
				
	if($this_bkg_1 == '') $this_bkg_1 = $def_1;
	if($this_bkg_2 == '') $this_bkg_2 = $def_2;
				
	if( $this_bkg_2 == '#' ) $bkg_color = $this_bkg_1;
	else {
		$bkg_color = $this_bkg_1 . '; background-image: -webkit-gradient(linear, left top, left bottom, from(' . $this_bkg_1 . '), to(' . $this_bkg_2 . ')); background-image: -webkit-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . ');	background-image: -moz-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . ');	background-image: -ms-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); background-image: -o-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); background-image: linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=' . $this_bkg_1 . ', endColorstr=' . $this_bkg_2 . ');';
	}
	
	return $bkg_color;
		
}

?>