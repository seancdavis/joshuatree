<?php

add_shortcode( 'mrcf', 'display_mrcf' );

function display_mrcf( $atts ) {
	extract( shortcode_atts( array(
		'some_att' => '',
	), $atts ) );
	
	$msg = $_POST['rt_mrcf_msg'];
	
	// Create post object
	if( $msg != '' ) :
		$new_msg = array(
		  'post_title'    => 'Test Post',
		  'post_content'  => $msg,
		  'post_status'   => 'publish',
		  'post_author'   => 'This person',
		  'post_type' => 'rt_mrcf'
		);
		
		$error_msg = 'Error submitting form.';
		
		// Insert the post into the database
		wp_insert_post( $new_msg, $error_msg ); ?>
		<p class="rt-success">Message submitted successfully. We will be in touch soon.</p>
		<?php 
		if( rt_get_mrcf_option('email_notification') == 'On' ) {
			$to = rt_get_mrcf_option('to');
			$subject = "Test mail";
			$from = rt_get_mrcf_option('from');
			$headers = "From:" . $from;
			mail($to,$subject,$msg,$headers); 
		}
		
	endif; ?>
	
	<form name="rt_mrcf" method="post">
		Message:&nbsp;<input type="text" name="rt_mrcf_msg">
		<input type="submit" value="Submit">
	</form>
	
<?php }

?>