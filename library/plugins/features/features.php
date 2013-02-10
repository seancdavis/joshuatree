<?php

// Include all necessary files.
add_action( 'rt_features_init', 'rt_features_load_files' );
function rt_features_load_files() {
	
	define( 'RT_FEATURES', get_template_directory() . '/library/plugins/features' );
	
	require_once( RT_FEATURES . '/admin/registration.php' );
	require_once( RT_FEATURES . '/admin/options.php' );
	require_once( RT_FEATURES . '/admin/meta.php' );
	require_once( RT_FEATURES . '/content/display-feature.php' );
	require_once( RT_FEATURES . '/admin/re-order.php' );		
}
do_action( 'rt_features_init' );

// Admin scripts. These only run when on admin site.
if( $_GET['page'] == 'rt_feature_options' ) add_action( 'admin_enqueue_scripts', 'load_rt_feat_option_admin_scripts' );	
function load_rt_feat_option_admin_scripts() {
	$rt_feat_dir = get_template_directory_uri() . '/library/plugins/features';
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'farbtastic-toggle', $rt_feat_dir . '/admin/farbtastic-toggle.js', array('jquery', 'farbtastic', 'wp-color-picker') );
	wp_enqueue_script( 'feature-options', $rt_feat_dir . '/admin/options.js', array('jquery') );	
}

if( $_GET['page'] == 'rt_feature_order_options' ) add_action( 'admin_enqueue_scripts', 'load_rt_feat_reorder_options' );	
function load_rt_feat_reorder_options() {
	$rt_feat_dir = get_template_directory_uri() . '/library/plugins/features';
	wp_enqueue_script( 'jquery-ui', 'http://code.jquery.com/ui/1.9.2/jquery-ui.js', array('jquery') );
	wp_enqueue_script( 're-order', $rt_feat_dir . '/admin/re-order.js', array('jquery','jquery-ui') );
	wp_enqueue_style( 'feature-order', $rt_feat_dir . '/admin/re-order.css' );
}

if( $_GET['post_type'] == 'rt_feature' ) add_action( 'admin_enqueue_scripts', 'load_feat_meta' );	
function load_feat_meta() {
	$rt_feat_dir = get_template_directory_uri() . '/library/plugins/features';
	wp_enqueue_style( 'feature-meta', $rt_feat_dir . '/admin/meta.css' );
}


?>