<?php 

global $rt_feat_settings;

$rt_feat_settings = array(
	'feat_container_settings' => array(
		'slider_width' => array(
			'name' => 'slider_width',
			'label' => 'Slider Width:',
			'type' => 'radio',
			'default' => 'standard',
			'choices' => array('standard', 'full-width')
		),
		'bkg_type' => array(
			'name' => 'bkg_type',
			'label' => 'Background Type:',
			'type' => 'radio',
			'default' => 'color',
			'choices' => array('color','gradient','none')
		),
		'bkg_color' => array(
			'name' => 'bkg_color',
			'label' => 'Background Color:',
			'type' => 'color',
			'default' => '#fff'
		),
	),
	'feat_content_settings' => array(
		'bkg_color_lock' => array(
			'name' => 'bkg_color_lock',
			'label' => 'Lock individual background color',
			'type' => 'checkbox',
			'default' => false,
		),
		'text_color' => array(
			'name' => 'text_color',
			'label' => 'Text Color:',
			'type' => 'color',
			'default' => '#fff',
		),
		'linked_content' => array(
			'name' => 'linked_content',
			'label' => 'Linked Content:',
			'type' => 'radio',
			'default' => 'none',
			'choices' => array('content', 'button', 'none')
		),
		'button_bkg_color' => array(
			'name' => 'button_bkg_color',
			'label' => 'Button Background Color:',
			'type' => 'color',
			'default' => '#000'
		),
		'button_text_color' => array(
			'name' => 'button_text_color',
			'label' => 'Button Text Color:',
			'type' => 'color',
			'default' => '#fff'
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
	global $rt_feat_settings;
	foreach ($rt_feat_settings as $sections) {
		foreach($sections as $section) {
			if( $section['name'] == $option_name ) $default = $section['default'];
		}
	}
	$current_options = get_option('rt_features');
	if( $current_options[$option_name] == '' ) return $default;
	else return $current_options[$option_name];
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

?>