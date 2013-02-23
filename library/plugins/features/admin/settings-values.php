<?php 

global $rt_feat_settings;

$rt_feat_settings = array(
	'throw_me_away' => array(), // my foreach loop was not picking up first key here. This keeps it running.
	'feat_global_settings' => array(
		'feature_type' => array(
			'name' => 'feature_type',
			'label' => 'Feature Type:',
			'type' => 'radio',
			'default' => 'simple-slider',
			'choices' => array('simple-slider', 'free-form'),
			'choice_labels' => array('Simple Slider (entire feature slides)', 'Free Form (text and featured image move separately)'),
			'before' => '<p><i>Determines the type of animation for your feature</i></p>'
		),
		'slider_width' => array(
			'name' => 'slider_width',
			'label' => 'Feature Width:',
			'type' => 'radio',
			'default' => 'standard',
			'choices' => array('standard', 'full-width'),
			'choice_labels' => array('Standard (80% width)', 'Full Width')
		),
		'bkg_type' => array(
			'name' => 'bkg_type',
			'label' => 'Background Type:',
			'type' => 'radio',
			'default' => 'color',
			'choices' => array('color','gradient','transparent'),
			'choice_labels' => array('Solid Color', 'Gradient', 'Transparent (no background color)')
		),
		'bkg_color' => array(
			'name' => 'bkg_color',
			'label' => 'Background Color:',
			'type' => 'color',
			'default' => '#fff',
			'after' => '<p><i>Please note: this is the color of the background behind the features. It is the full width of the window. If you have chosen the Full Width option, individual feature background colors will cover this color.</i></p>'
		),
	),
	'feat_content_settings' => array(
		'bkg_color_lock' => array(
			'name' => 'bkg_color_lock',
			'label' => 'Lock Individual Background Colors:',
			'type' => 'checkbox',
			'default' => false,
			'choice_labels' => '<img width="20" src ="'.get_template_directory_uri().'/images/icons/locked.png'.'" />',
			'after' => '<p><i>With the simple slider, you are able to color the background of each feature (controlled from the edit feature page). This enables you to lock that option, so all features reflect the background color of the feature container. <b>This does not affect you unless using simple slider.</b></i></p>'
		),
		'text_display' => array (
			'name' => 'text_display',
			'label' => 'Text Display Type:',
			'type' => 'radio',
			'default' => 'flat',
			'choices' => array('flat', 'box', 'none'),
			'choice_labels' => array('Normal', 'Box (displays content and call to action button in box with background-color option)', 'No Content')
		),
		'box_bkg_color' => array(
			'name' => 'box_bkg_color',
			'label' => 'Box Background Color (if necessary):',
			'type' => 'color',
			'default' => '#000',
			'after' => '<p><i>Only applies to <b>Box Text Display Type</b>.</i></p>'
		),
		'text_color' => array(
			'name' => 'text_color',
			'label' => 'Text Color:',
			'type' => 'color',
			'default' => '#fff',
			'after' => '<p><i>Please note: this does not color the button text. See below for Button Text option.</i></p>'
		),
		'linked_content' => array(
			'name' => 'linked_content',
			'label' => 'Linked Content:',
			'type' => 'radio',
			'default' => 'none',
			'choices' => array('content', 'button', 'none'),
			'choice_labels' => array('Entire feature is a link', 'Call to Action Button', 'No linked content'),
			'after' => '<p><i>Please note: Call to action buttons must be enabled here if you wish to use them on any feature (though they are not required on every feature if you select here). The text and URL of each button is controlled when editing or adding a feature. </i></p>'
		),
		'button_bkg_color' => array(
			'name' => 'button_bkg_color',
			'label' => 'Button Background Color:',
			'type' => 'color',
			'default' => '#000',
			'after' => '<p><i>This should be the main background color you wish to use. The gradient and hover effects are figured out for you.</i><p>'
		),
		'button_text_color' => array(
			'name' => 'button_text_color',
			'label' => 'Button Text Color:',
			'type' => 'color',
			'default' => '#fff',
		)
	),
	'feat_slider_settings' => array(
		'counter_type' => array(
			'name' => 'counter_type',
			'label' => 'Counter Type:',
			'type' => 'radio',
			'default' => 'circles',
			'choices' => array('circles', 'numbers', 'none')
		),
		'inactive_counter_color' => array(
			'name' => 'inactive_counter_color',
			'label' => 'Inactive Counter Color:',
			'type' => 'color',
			'default' => '#fff'
		),
		'active_counter_color' => array(
			'name' => 'active_counter_color',
			'label' => 'Active Counter Color:',
			'type' => 'color',
			'default' => '#000'
		),
		'hover_counter_color' => array(
			'name' => 'hover_counter_color',
			'label' => 'Hover Counter Color:',
			'type' => 'color',
			'default' => '#000'
		),
		'counter_border_color' => array(
			'name' => 'counter_border_color',
			'label' => 'Counter Border Color',
			'type' => 'color',
			'default' => '#ccc',
		),
		'inactive_counter_text_color' => array(
			'name' => 'inactive_counter_text_color',
			'label' => 'Inactive Counter TEXT Color:',
			'type' => 'color',
			'default' => '#000'
		),
		'active_counter_text_color' => array(
			'name' => 'active_counter_text_color',
			'label' => 'Active Counter TEXT Color:',
			'type' => 'color',
			'default' => '#fff'
		),
		'hover_counter_text_color' => array(
			'name' => 'hover_counter_text_color',
			'label' => 'Hover Counter TEXT Color:',
			'type' => 'color',
			'default' => '#fff'
		),
		'arrows_type' => array(
			'name' => 'arrows_type',
			'label' => 'Arrows Type',
			'type' => 'radio',
			'default' => 'small',
			'choices' => array('small', 'full-height', 'none')
		),
		'arrows_color' => array(
			'name' => 'arrows_color',
			'label' => 'Arrows Color',
			'type' => 'radio',
			'default' => 'white',
			'choices' => array('white', 'grey', 'black')
		),
		'arrows_bkg_color' => array(
			'name' => 'arrows_bkg_color',
			'label' => 'Arrows Background Color',
			'type' => 'color',
			'default' => '',
			'after' => '<p><i>Leaving this blank will make the background transparent.</i></p>'
		),
		'arrows_hover_color' => array(
			'name' => 'arrows_hover_color',
			'label' => 'Arrows Hover Color',
			'type' => 'color',
			'default' => '#000',
		),
	)
);

function get_feat_option_value( $option_name ) {
	$current_options = get_option('rt_features');
	// first if statement is a catch to help control navigation of settings page
	if( $option_name == 'feat_nav_control' ) {
		if( $current_options[$option_name] == '' ) '';		
		else return $current_options[$option_name];
	}
	else {
		global $rt_feat_settings;
		foreach ($rt_feat_settings as $sections) {
			foreach($sections as $section) {
				if( $section['name'] == $option_name ) $default = $section['default'];
			}
		}
		if( $current_options[$option_name] == '' ) return $default;
		else return $current_options[$option_name];
	}
}

function get_feat_option_choices( $option_name ) {
	global $rt_feat_settings;
	foreach ($rt_feat_settings as $sections) {
		foreach($sections as $section) {
			if( $section['name'] == $option_name ) $choices = $section['choices'];
		}
	}
	return $choices;
}

function get_feat_option_labels( $option_name ) {
	global $rt_feat_settings;
	foreach ($rt_feat_settings as $sections) {
		foreach($sections as $section) {
			if( $section['name'] == $option_name && $section['choice_labels'] == '' ) $choices = $section['label']; 
			else if( $section['name'] == $option_name ) $choices = $section['choice_labels'];
		}
	}
	return $choices;
}

?>