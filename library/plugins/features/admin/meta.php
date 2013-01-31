<?php

/* Register Meta Box
------------------------------------------------------------------------- */
add_action( 'add_meta_boxes', 'add_feature_metabox' );

function add_feature_metabox() {
    add_meta_box('rt_feature_metabox', 'Custom Settings', 'rt_feature_options', 'rt_feature', 'normal', 'core');
}


/* Display Meta Boxes on Post Edit Page
------------------------------------------------------------------------- */
function rt_feature_options() {
    
	global $post;
	$feat_type = rt_get_feature_option( 'rt_feat_type' );
    
	// Noncename needed to verify where the data originated
    echo '<input type="hidden" name="rt_feature_options_noncename" id="rt_feature_options_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
	/* GLOBAL
	------------------------------------------------------------------------- */
	// _disable_feature
	$disable_feature = get_post_meta($post->ID, '_disable_feature', true);	
	$disable_feature_checked = ''; // Control for showing if checkbox should be checked or not.
	if($disable_feature == 1) $disable_feature_checked = 'checked="checked"';
    
	// _order
    $order = get_post_meta($post->ID, '_order', true);	
	if($order == '') $order = 100;
   	
    // display it ---> ?>
    <h4 class="feature-section-title">GLOBAL</h4>    
    <hr>
    
    <h4 class="feature-sub-title">Deactivate Feature</h4>
	<input type="checkbox" name="_disable_feature" value="1" <?php print $disable_feature_checked; ?> />
    <label for="_disable_feature"><i>Once published, the feature is active by default. Checking the box below will disable the feature, even if published.</i></label>
    
    <h4 class="feature-sub-title">Re-Order Feature</h4>
    <input type="text" size="3" name="_order" value="<?php print $order; ?>" />
    <label for="_order">&nbsp;&nbsp;(default is 100)</label>
	<p><i>Note: This controls the order in which the features are displayed. This can be more easily controlled from the Re-Order Features settings page (under Features).</i></p>
	
	<?php
	
	/* STANDARD SLIDER
	------------------------------------------------------------------------- */
	if( $feat_type == 'Standard Slider' ) :
	
		$std_url = get_post_meta($post->ID, '_std_url', true);
		$std_target = get_post_meta($post->ID, '_std_target', true);
		$std_target_checked = '';
		if($std_target == 1) $std_target_checked = 'checked="checked"';
		
		// display it --> ?>
		<h4 class="feature-section-title">STANDARD SLIDER</h4>
		<hr>
		
		<h4 class="feature-sub-title">Link to Content</h4>
        <label for="_std_url">URL:</label>
		<input type="text" id="std_url" name="_std_url" value="<?php print $std_url; ?>" size="50" />
        <input type="checkbox" name="_std_target" value="1" <?php print $std_target_checked; ?> />
		<label for="_std_target">Open link in new window</label>
		<p><i>Note: If you leave this blank, your feature will not be a hyperlink.</i></p>        
        
	<?php endif;
	
	/* FULL-WIDTH SLIDER
	------------------------------------------------------------------------- */
	if( $feat_type == 'Full-Width Slider' ) :
	
		// background color(s)
		$background_1 = get_post_meta($post->ID, '_background_1', true); 
		$background_2 = get_post_meta($post->ID, '_background_2', true); 	
		// if no values have been entered, needs to inherit values from options
		if($background_1 == '') $background_1 = rt_get_feature_option( 'fw_rt_feat_bkg_1' );
		if($background_2 == '') $background_2 = rt_get_feature_option( 'fw_rt_feat_bkg_2' );
		
		// call to action button
		$button_text = get_post_meta($post->ID, '_button_text', true);
		$button_url = get_post_meta($post->ID, '_button_url', true);
		$button_target = get_post_meta($post->ID, '_button_target', true);	
		$button_target_checked = ''; // Control for showing if $button_target checkbox should be checked or not.
		if($button_target == 1) $button_target_checked = 'checked="checked"';
		   
		// display it --> ?>
		<h4 class="feature-section-title">FULL-WIDTH SLIDER</h4>
		<hr>
		
		<h4 class="feature-sub-title">Background Color</h4>
		<input style="background-color:<?php print $background_1; ?>" type="text" id="rt-farb-input-1" name="_background_1" value="<?php print $background_1; ?>" />
		<p><i>Note: If you leave this alone it will default to the values you chose in the feature settings.</i></p>
		<div id="rt-farb-1"></div>
			
		<h4 class="feature-sub-title">Gradient (optional)</h4>
		<input style="background-color:<?php print $background_2; ?>" type="text" id="rt-farb-input-2" name="_background_2" value="<?php print $background_2; ?>" />
		<p><strong><i>Please note: Choosing a value here will make your background a gradient. It will appear as the bottom color and will blend at 50%. Leaving it blank will display a solid background of the first background color.</i></strong></p>
		<div id="rt-farb-2"></div>    
	   
		<h4 class="feature-sub-title">Call to Action Button</h4>
		<label for="_button_text">Text: </label>
		<input type="text" name="_button_text" value="<?php print $button_text; ?>" class="widefat" />
		<br><br>
		<label for="_button_url">URL: (<i>where clicking the button takes the user</i>)</label>
		<input type="text" name="_button_url" value="<?php print $button_url; ?>" class="widefat" />
		<br><br>
		<input type="checkbox" name="_button_target" value="1" <?php print $button_target_checked; ?> />
		<label for="_button_target">Open link in new window</label>	
        
	<?php endif;
	
}

/* save box data
------------------------------------------------------------------------- */
add_action('save_post', 'rt_save_feature_options_meta', 1, 2);

function rt_save_feature_options_meta($post_id, $post) {
	
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['rt_feature_options_noncename'], plugin_basename(__FILE__) )) {
    	return $post->ID;
    }
	
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ) ) return $post->ID;
	
	/* GLOBAL
	------------------------------------------------------------------------- */
	$feature_meta['_disable_feature'] = $_POST['_disable_feature'];
	// This is used to sort the table on "All Features" admin page
	if( $feature_meta['_disable_feature'] == '') $feature_meta['_disable_feature_key'] = 'Active'; 
	else { $feature_meta['_disable_feature_key'] = 'Disabled'; }	
	$feature_meta['_order'] = sanitize_text_field( $_POST['_order'] );	
	if( $feature_meta['_order'] < 10 ) { $feature_meta['_order'] = '0' . $feature_meta['_order']; }
	
	/* STANDARD SLIDER
	------------------------------------------------------------------------- */
	$feature_meta['_std_url'] = sanitize_text_field( $_POST['_std_url'] );
	$feature_meta['_std_target'] = $_POST['_std_target'];	
	
	/* FULL-WIDTH SLIDER
	------------------------------------------------------------------------- */
	$feature_meta['_background_1'] = sanitize_text_field( $_POST['_background_1'] );
	$feature_meta['_background_2'] = sanitize_text_field( $_POST['_background_2'] );
	$feature_meta['_button_text'] = sanitize_text_field( $_POST['_button_text'] );
	$feature_meta['_button_url'] = sanitize_text_field( $_POST['_button_url'] );
	$feature_meta['_button_target'] = $_POST['_button_target'];	
	
	
	/* update or add meta values
	------------------------------------------------------------------------- */
    foreach ($feature_meta as $key => $value) { // Cycle through the $feature_meta
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
				
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } 
		else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }		
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
	
}

?>