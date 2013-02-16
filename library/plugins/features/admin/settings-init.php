<?php

add_action('admin_menu', 'rt_register_feature_settings');
function rt_register_feature_settings() {
	add_submenu_page('edit.php?post_type=rt_feature', 'Feature Settings', 'Settings', 'manage_options', 'rt_feature_settings', 'rt_features_page');
}


/* Settings Control
-------------------------------------------------------------------------------- */
add_action('admin_init', 'rt_feature_admin_init');

/**
 * Registration of each setting field and section
 */
 
function rt_feature_admin_init(){
	
	/* Registers entire page of settings (rt_features)
	-------------------------------- */
	register_setting( 'rt_features', 'rt_features', 'rt_validate_feat_options' );
	
	
	// Setup
	add_settings_section( 'feat_settings_setup', '', 'feat_settings_setup', 'feat_settings_setup' );
	
	$section_name = 'feat_container_settings';	
	add_settings_section( $section_name, '', $section_name, $section_name );	
	add_settings_field('slider_width', 'Slider Width:', 'setdisp_slider_width', $section_name, $section_name);
	add_settings_field('bkg_type', 'Background Type:', 'setdisp_bkg_type', $section_name, $section_name);
	add_settings_field('bkg_color', 'Background Color:', 'setdisp_bkg_color', $section_name, $section_name);
	
	$section_name = 'feat_content_settings';
	add_settings_section( $section_name, '', $section_name, $section_name );
	add_settings_field('text_color', 'Text Color:', 'setdisp_text_color', $section_name, $section_name);
	add_settings_field('linked_content', 'What do you want to use as a hyperlink?', 'setdisp_linked_content', $section_name, $section_name);
	add_settings_field('link_new_window', 'Open links in new window?', 'setdisp_link_new_window', $section_name, $section_name);
	add_settings_field('button_visible', 'Enable Call To Action Buttons:', 'setdisp_button_visible', $section_name, $section_name);
	add_settings_field('button_bkg_color', 'Call To Action Button Color', 'setdisp_button_bkg_color', $section_name, $section_name);
	add_settings_field('button_text_color', 'Call To Action Button TEXT Color', 'setdisp_button_text_color', $section_name, $section_name);
	
	$section_name = 'feat_slider_settings';
	add_settings_section( $section_name, '', $section_name, $section_name );
	add_settings_field('counter_type', 'Counter Type:', 'setdisp_counter_type', $section_name, $section_name);
	add_settings_field('inactive_counter_color', 'Inactive Counter Color:', 'feat_color_field', $section_name, $section_name, 'inactive_counter_color');
	add_settings_field('active_counter_color', 'Active Counter Color:', 'setdisp_active_counter_color', $section_name, $section_name);
	add_settings_field('hover_counter_color', 'Hover Counter Color:', 'setdisp_hover_counter_color', $section_name, $section_name);
	add_settings_field('inactive_counter_text_color', 'Inactive Counter Color:', 'setdisp_inactive_counter_text_color', $section_name, $section_name);
	add_settings_field('active_counter_text_color', 'Active Counter Color:', 'setdisp_active_counter_text_color', $section_name, $section_name);
	add_settings_field('hover_counter_text_color', 'Hover Counter Color:', 'setdisp_hover_counter_text_color', $section_name, $section_name);
	add_settings_field('arrows_type', 'Arrows Type:', 'setdisp_arrows_type', $section_name, $section_name);
	add_settings_field('arrows_bkg_color', 'Arrows Background Color:', 'setdisp_arrows_bkg_color', $section_name, $section_name);		 		 		 

}


?>