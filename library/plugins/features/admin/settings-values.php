<?php
 
/* Set Default Values and return option value
-------------------------------------------------------------------------------- */
function get_feat_option( $option_name, $choices = false ) {
	
	$options = array(
		'slider_width' => array(
			'default' => 'standard',
			'choices' => array('standard', 'full-width')
		),
		'bkg_type' => array(
			'default' => 'color',
			'choices' => array('color','gradient','none')
		),
		'bkg_color' => array('default' => '#fff'),
		'text_color' => array('default' => '#fff'),
		'linked_content' => array(
			'default' => 'none',
			'choices' => array('content', 'button', 'none')
		),
		'link_new_window' => array('default' => false),
		'button_visible' => array('default' => false),
		'button_bkg_color' => array('default' => '#000'),
		'button_text_color' => array('default' => '#fff'),
		'counter_type' => array(
			'default' => 'circles',
			'choices' => array('circles','numbers','none')
		),
		'inactive_counter_color' => array('default' => '#fff'),
		'active_counter_color' => array('default' => '#000'),
		'hover_counter_color' => array('default' => '#000'),
		'inactive_counter_text_color' => array('default' => '#000'),
		'active_counter_text_color' => array('default' => '#fff'),
		'hover_counter_text_color' => array('default' => '#fff'),
		'arrows_type' => array(
			'default' => 'small',
			'choices' => array('small','full-height','none')
		),
		'arrows_bkg_color' => array('default' => '#000')
	);
	
	$current_options = get_option( 'rt_features' );
	
	if( $choices == true ) return $options[$option_name]['choices'];
	else if( $current_options[$option_name] == '' ) return $options[$option_name]['default'];
	else return $current_options[$option_name];
}

// DELETE ME
function rt_get_feature_option( $option_name ) {
	
	$defaults = array(
		'rt_feat_type' => 'Standard Slider',
		'std_rt_feat_bkg_type' => 'Color',
		'std_rt_feat_bkg' => '#fff',
		'fw_rt_feat_bkg_1' => '#ccc',
		'fw_rt_feat_bkg_2' => '#'
	);
	
	$options = get_option( 'rt_features' );
	
	if( $options[$option_name] == '' ) {
		return $defaults[$option_name];
	}
	else {
		return $options[$option_name];
	}
} 

?>