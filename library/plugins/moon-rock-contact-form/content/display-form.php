<?php

add_shortcode( 'mrcf', 'display_mrcf' );

function display_mrcf( $atts ) {
	extract( shortcode_atts( array(
		'some_att' => '',
	), $atts ) );
	
	$topic = $_POST['rt_mrcf_topic'];
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
		<div class="rt-success"><span>&#x2713;</span>Message submitted successfully. We will be in touch soon.</div>
		<?php 
		if( rt_get_mrcf_option('email_notification') == 'On' ) {
			$to = rt_get_mrcf_option('to');
			$subject = $topic;
			$from = rt_get_mrcf_option('from');
			$headers = "From:" . $from;
			mail($to,$subject,$msg,$headers); 
		}
		
	endif; ?>
	
	<form class="rt-mrcf" name="rt_mrcf" method="post">
		<label class="rt-mrcf-topic">Topic:</label>&nbsp;<input name="What is your message about?" class="rt-mrcf-input" type="text" value="What is your message about?" size="30">
		<label class="rt-mrcf-msg">Message:</label>&nbsp;<textarea class="rt-mrcf-input" type="text" name="Have a question or request? Enter it here...">Have a question or request? Enter it here...</textarea>
		<input type="submit" value="Send Message" class="rt-mrcf-submit">
	</form>
	
<?php }

?>