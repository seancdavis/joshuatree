<?php

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
         	<?php submit_button(); ?>
        	
        </form>
	
    </div><?php
}



/* Callback functions --> what gets displayed on the settings page
-------------------------------------------------------------------------------- */

function feat_radio_buttons( $option_name ) {	
	$options = get_feat_option($option_name,true);
	$current_option = get_feat_option($option_name);	
	foreach ($options as $option) {
		?><input type="radio" name="rt_features[<?php echo $option_name; ?>]" value="<?php echo $option; ?>" <?php if($current_option == $option) echo 'checked="checked"'; ?>>
		<label><?php echo $option; ?></label><br><?php
	}	
}

function feat_checkbox( $option_name ) {
	$current_option = get_feat_option($option_name);
	?><input value=true type="checkbox" name="rt_features[<?php echo $option_name; ?>]" <?php if( $current_option == true ) echo 'checked="checked"';?> ><?php
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
function feat_container_settings() { ?><h2>Container</h2><?php }
function setdisp_slider_width() {feat_radio_buttons('slider_width');}
function setdisp_bkg_type() {feat_radio_buttons('bkg_type');}
function setdisp_bkg_color() {feat_color_field('bkg_color');}

// Content
function feat_content_settings() { ?><h2>Content</h2><?php }
function setdisp_text_color() {feat_color_field('text_color');}
function setdisp_linked_content() {feat_radio_buttons('linked_content');}
function setdisp_link_new_window() {feat_checkbox('link_new_window');}
function setdisp_button_visible() {feat_checkbox('button_visible');}
function setdisp_button_bkg_color() {feat_color_field('button_bkg_color');}
function setdisp_button_text_color() {feat_color_field('button_text_color');}

// Slider
function feat_slider_settings() { ?><h2>Slider</h2><?php }
function setdisp_counter_type() {feat_radio_buttons('counter_type');}
function setdisp_inactive_counter_color() {feat_color_field('inactive_counter_color');}
function setdisp_active_counter_color() {feat_color_field('active_counter_color');}
function setdisp_hover_counter_color() {feat_color_field('hover_counter_color');}
function setdisp_inactive_counter_text_color() {feat_color_field('inactive_counter_text_color');}
function setdisp_active_counter_text_color() {feat_color_field('active_counter_text_color');}
function setdisp_hover_counter_text_color() {feat_color_field('hover_counter_text_color');}
function setdisp_arrows_type() {feat_radio_buttons('arrows_type');}
function setdisp_arrows_bkg_color() {feat_color_field('arrows_bkg_color');}


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