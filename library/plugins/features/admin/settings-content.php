<?php

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

function feat_container_settings( $settings_name ) {
	?><h2>Container</h2><?php
}

function feat_content_settings( $settings_name ) {
	?><h2>Content</h2><?php
}

function feat_slider_settings( $settings_name ) {
	?><h2>Slider</h2><?php
}

function feat_radio_field( $option_name ) {	
	$options = get_feat_option_choices($option_name);
	$current_option = get_feat_option_value($option_name);	
	foreach ($options as $option) {
		?><input type="radio" name="rt_features[<?php echo $option_name; ?>]" value="<?php echo $option; ?>" <?php if($current_option == $option) echo 'checked="checked"'; ?>>
		<label><?php echo $option; ?></label><br><?php
	}	
}

function feat_checkbox_field( $option_name ) {
	$current_option = get_feat_option_value($option_name);
	?><input value=true type="checkbox" name="rt_features[<?php echo $option_name; ?>]" <?php if( $current_option == true ) echo 'checked="checked"';?> ><?php
}

function feat_color_field( $option_name ) {
	?><input class="feat-color" name="rt_features[<?php echo $option_name; ?>]" size="40" type="text" value="<?php echo get_feat_option_value($option_name); ?>"><?php
}

function rt_validate_feat_options($input) {
	//$input['std_rt_feat_bkg'] = sanitize_text_field($input['std_rt_feat_bkg']);			
	return $input;
}

?>