<?php
/* 
 * Controls everything in the Feature Settings page. 
 * These are global feature settings, not post meta.
 * 
 */

add_action('admin_menu', 'rt_register_feature_settings');

function rt_register_feature_settings() {
	add_submenu_page('edit.php?post_type=rt_feature', 'Feature Settings', 'Settings', 'manage_options', 'rt_feature_settings', 'rt_features_page');
}

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
		'linked_content' => array('default' => 'none'),
		'link_new_window' => array('default' => false),
		'button_visible' => array('default' => false),
		'button_bkg_color' => array('default' => '#000'),
		'button_text_color' => array('default' => '#fff'),
		'counter_type' => array('default' => 'numbers'),
		'inactive_counter_color' => array('default' => '#fff'),
		'active_counter_color' => array('default' => '#000'),
		'hover_counter_color' => array('default' => '#000'),
		'inactive_counter_text_color' => array('default' => '#000'),
		'active_counter_text_color' => array('default' => '#fff'),
		'hover_counter_text_color' => array('default' => '#fff'),
		'arrows_visible' => array('default' => true),
		'arrows_bkg_type' => array('default' => 'small'),
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


/* Display theme Options Page
-------------------------------------------------------------------------------- */
function rt_features_page() { ?>
    
    <div>
    
        <h1>Feature Settings</h1>
		
		<?php if ($_GET['settings-updated']==true) { _e( '<div id="message" class="updated"><p>Settings updated.</p></div>' ); } ?>
        
        <form action="options.php" method="post">
        	
			<?php settings_fields('rt_features'); ?>
        	<?php do_settings_sections('feat_settings_setup'); ?>
        	<div class="rt-settings-section" id="feat-container-settings"><?php do_settings_sections('feat_container_settings'); ?></div>
        	<div class="rt-settings-section" id="feat-content-settings"><?php do_settings_sections('feat_content_settings'); ?></div>
        	<div class="rt-settings-section" id="feat-slider-settings"><?php do_settings_sections('feat_slider_settings'); ?></div>
			<div class="rt-option-section" id="standard-options"><?php do_settings_sections('std_rt_feature_settings'); ?></div>
            <div class="rt-option-section" id="full-width-options"><?php do_settings_sections('fw_rt_feature_settings'); ?></div>
         	<?php submit_button(); ?>
        	
        </form>
	
    </div><?php
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
	
	add_settings_section( 'feat_container_settings', '', 'feat_container_settings', 'feat_container_settings' );	
	add_settings_field('slider_width', 'Slider Width:', 'setdisp_slider_width', 'feat_container_settings', 'feat_container_settings');
	add_settings_field('bkg_type', 'Background Type:', 'setdisp_bkg_type', 'feat_container_settings', 'feat_container_settings');
	add_settings_field('bkg_color', 'Background Color:', 'setdisp_bkg_color', 'feat_container_settings', 'feat_container_settings');
	
	add_settings_section( 'feat_content_settings', '', 'feat_content_settings', 'feat_content_settings' );
	add_settings_field('text_color', 'Text Color:', 'setdisp_text_color', 'feat_content_settings', 'feat_content_settings');	
	
	add_settings_section( 'feat_slider_settings', '', 'feat_slider_settings', 'feat_slider_settings' );		 
	 
	 
	/* Register Section (rt_feat_type)
	-------------------------------- */
	add_settings_section( 'rt_feat_type', 'Feature Type', 'rt_feat_section_type', 'rt_feature_settings' );	
	add_settings_field('rt_feat_type', 'Feature Type:', 'rt_feat_field_type', 'rt_feature_settings', 'rt_feat_type');
	
	/* Register Standard Slider Options
	-------------------------------- */
	add_settings_section( 'std_rt_feat_opts', 'Standard Slider Options', 'rt_feat_section_std_opts', 'std_rt_feature_settings' );	
	add_settings_field('std_rt_feat_bkg_type', 'Background Type:', 'std_rt_feat_field_bkg_type', 'std_rt_feature_settings', 'std_rt_feat_opts');
	add_settings_field('std_rt_feat_bkg', 'Background Color:', 'std_rt_feat_field_bkg', 'std_rt_feature_settings', 'std_rt_feat_opts');
	
	/* Register Full-Width Slider Options
	-------------------------------- */
	add_settings_section( 'fw_rt_feat_opts', 'Full-Width Slider Options', 'rt_feat_section_fw_opts', 'fw_rt_feature_settings' );	
	add_settings_field('fw_rt_feat_bkg_1', 'Background Color:', 'fw_rt_feat_field_bkg_1', 'fw_rt_feature_settings', 'fw_rt_feat_opts');
	add_settings_field('fw_rt_feat_bkg_2', 'Secondary (Gradient) Color (optional):', 'fw_rt_feat_field_bkg_2', 'fw_rt_feature_settings', 'fw_rt_feat_opts');
	
}

/* Callback functions --> what gets displayed on the settings page
-------------------------------------------------- */

function feat_radio_buttons( $option_name ) {	
	$options = get_feat_option($option_name,true);
	$current_option = get_feat_option($option_name);	
	foreach ($options as $option) {
		?><input type="radio" name="rt_features[<?php echo $option_name; ?>]" value="<?php echo $option; ?>" <?php if($current_option == $option) echo 'checked="checked"'; ?>>
		<label><?php echo $option; ?></label><br>
	<?php }	
}

function feat_color_field( $option_name ) {
	?><input class="feat-color" name="rt_features[<?php echo $option_name; ?>]" size="40" type="text" value="<?php echo get_feat_option($option_name); ?>"><?php
}

// Setup
function feat_settings_setup() {
	?><p>Setup Section</p><?php
	// this is where the tabs go
}

// Container
function feat_container_settings() {}
function setdisp_slider_width() {feat_radio_buttons('slider_width');}
function setdisp_bkg_type() {feat_radio_buttons('bkg_type');}
function setdisp_bkg_color() {feat_color_field('bkg_color');}

// Content
function feat_content_settings() { ?><h2>Content</h2><?php }
function setdisp_text_color() {feat_color_field('text_color');}

function feat_slider_settings() {
	
}


// Feature Type Heading
function rt_feat_section_type() {
	echo '<p>Choose the type of feature you would like to display. The options below will change based on your choice.</p>';
}

// rt_feat_type field
function rt_feat_field_type() {
	$rt_types = array(
		'Standard Slider',
		'Full-Width Slider'
	);
	
	echo '<select id="rt-feat-type" name="rt_features[rt_feat_type]">';
	
	foreach( $rt_types as $rt_type ) {
		$selected = '';
		if( rt_get_feature_option( 'rt_feat_type' ) == $rt_type ) { $selected = "selected='selected'"; }
		
		echo '<option value="' . $rt_type . '" ' . $selected . '>' . $rt_type . '</option>';
	}
	
	echo '</select>';
}

// Standard Slider Options
function rt_feat_section_std_opts() {
	// intro text here (if needed)
}

function std_rt_feat_field_bkg_type() {
	$view = rt_get_feature_option( 'std_rt_feat_bkg_type' ); ?>
		
	<input type="radio" name="rt_features[std_rt_feat_bkg_type]" value="Color" <?php if( $view == 'Color' ) print 'checked="checked"'; ?> />&nbsp;&nbsp;<label>Color (Standard)</label><br>	
	<input type="radio" name="rt_features[std_rt_feat_bkg_type]" value="Transparent" <?php if( $view == 'Transparent' ) print 'checked="checked"'; ?> />&nbsp;&nbsp;<label>Transparent</label>
	<p><i>Note: Choosing "Transparent" will override your color selection below.</i></p>
	
<?php }

// std_rt_feat_bkg
function std_rt_feat_field_bkg() {	
	echo "<input style='background-color: " . rt_get_feature_option( 'std_rt_feat_bkg' ) . ";' id='std-rt-feat-bkg' name='rt_features[std_rt_feat_bkg]' size='40' type='text' value='" . rt_get_feature_option( 'std_rt_feat_bkg' ) . "' />";	
}

// Section heading
function rt_feat_section_fw_opts() {
	echo '<p>You can set the default background color for your slider here. The colors can be changed for each feature on the Add/Edit Feature page.</p>';
}

// Field 1
function fw_rt_feat_field_bkg_1() {	
	echo "<input style='background-color: " . rt_get_feature_option( 'rt_feature_default_background_1' ) . ";' id='fw-rt-feat-bkg-1' name='rt_features[fw_rt_feat_bkg_1]' size='40' type='text' value='" . rt_get_feature_option( 'fw_rt_feat_bkg_1' ) . "' />";	
}

// Field 2
function fw_rt_feat_field_bkg_2() {
	echo "<input style='background-color: " . rt_get_feature_option( 'rt_feature_default_background_2' ) . ";' id='fw-rt-feat-bkg-2' name='rt_features[fw_rt_feat_bkg_2]' size='40' type='text' value='" . rt_get_feature_option( 'fw_rt_feat_bkg_2' ) . "' />";
	echo '<p style="width: 400px;"><strong>Please note: The secondary color will be used as a gradient for your sliders. If you fill this out, all of your features will have a gradient by default. This color will appear on the bottom of the section.</strong></p>';
	
	// Displays preview of background
	echo '<h4>Preview (save to view preview)</h4>';
	
	$this_bkg_1 = rt_get_feature_option( 'fw_rt_feat_bkg_1' );
	$this_bkg_2 = rt_get_feature_option( 'fw_rt_feat_bkg_2' );
	
	if( $this_bkg_2 == '#' ) {
		echo '<div id="bkg_preview" style="height: 100px; width: 200px; background-color:' . $this_bkg_1 . ';"></div>';
	} 
	else {					
		echo '<div id="bkg_preview" style="height: 100px; width: 200px; background-color: ' . $this_bkg_1 . '; background-image: -webkit-gradient(linear, left top, left bottom, from(' . $this_bkg_1 . '), to(' . $this_bkg_2 . ')); background-image: -webkit-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . ');	background-image: -moz-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . ');	background-image: -ms-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); background-image: -o-linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); background-image: linear-gradient(top, ' . $this_bkg_1 . ', ' . $this_bkg_2 . '); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=' . $this_bkg_1 . ', endColorstr=' . $this_bkg_2 . ');"></div>';					
	}
	
}

/* Validate Options (and save settings)
-------------------------------------------------------------------------------- */
function rt_validate_feat_options($input) {	

	$input['std_rt_feat_bkg'] = sanitize_text_field($input['std_rt_feat_bkg']);	
	$input['fw_rt_feat_bkg_1'] = sanitize_text_field($input['fw_rt_feat_bkg_1']);
	$input['fw_rt_feat_bkg_2'] = sanitize_text_field($input['fw_rt_feat_bkg_2']);
	
	$default_bkg_1 = rt_get_feature_option('fw_rt_feat_bkg_1');
	$default_bkg_2 = rt_get_feature_option('fw_rt_feat_bkg_2');
	
	// We also have to update post meta for those features that had the default value
	$loop = new WP_Query( array ( 'post_type' => 'rt_feature' ) );

		while ( $loop->have_posts() ) : $loop->the_post();	
		
			$old_bkg_1 = get_post_meta( get_the_ID(), '_background_1', true );
			$old_bkg_2 = get_post_meta( get_the_ID(), '_background_2', true );
			
			if( $old_bkg_1 == $default_bkg_1 ) { update_post_meta( get_the_ID(), '_background_1', $input['fw_rt_feat_bkg_1'] ); }
			if( $old_bkg_2 == $default_bkg_2 ) { update_post_meta( get_the_ID(), '_background_2', $input['fw_rt_feat_bkg_2'] ); }
			
		endwhile;
		
	return $input;
}

?>