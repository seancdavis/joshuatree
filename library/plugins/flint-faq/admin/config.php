<?php

add_action( 'init', 'rt_register_faq_type' );

function rt_register_faq_type() {
	
	$labels = array(
		'name'               => _x( 'FAQ', 'post type general name' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'FAQ' ),
		'add_new_item'       => __( 'Add New FAQ' ),
		'edit_item'          => __( 'Edit FAQ' ),
		'new_item'           => __( 'New FAQ' ),
		'all_items'          => __( 'All FAQs' ),
		'view_item'          => __( 'View FAQs' ),
		'search_items'       => __( 'Search FAQs' ),
		'not_found'          => __( 'No FAQs found' ),
		'not_found_in_trash' => __( 'No FAQs found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'FAQ'
	);
	
	$args = array(
		'labels'        => $labels,
		'description'   => 'Store and maintain features for your site.',
		'public'        => true,
		'menu_position' => 30,
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
		'taxonomies' => array( 'category' )
	);
	
	register_post_type( 'rt_faq', $args );
		
}

?>