<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title>
	<?php if( is_front_page() ) { bloginfo( 'name' ); }
        else { wp_title('', true) . _e( ' | ' ) . bloginfo( 'name' ); } ?>    
</title>
 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
 
<?php
	// Supports threaded comments     
    if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
 
    wp_head();
    wp_get_archives('type=monthly&format=link');
	
	// fonts selected from rt_options
	$headings_font = rt_get_option( 'rt_headings_font' );
	echo rt_get_font_link( $headings_font ); // ref --> library/content/styles.php
	$body_font = rt_get_option( 'rt_body_font' );
	echo rt_get_font_link( $body_font );
?>

<style>
	body{font-family: <?php print $body_font ?>, serif;}
	h1,h2,h3,h4,h5,h6 {font-family: <?php print $headings_font; ?>, sans serif;}	
	<?php print rt_get_option('rt_css'); /* custom css */ ?>
</style>

</head>

<body>
 
<div id="wrapper">
    
    <div id="header" class="clearfix">
    
    	<div id="social-icons-container" class="clearfix"><?php echo rt_get_social_icons(); // library/content/social-media.php ?></div>
        
        <div id="logo">        	
            <h2><a href="<?php echo get_option('home'); ?>"><?php if( rt_get_option('rt_logo') != '' ) { echo '<img src="' . rt_get_option('rt_logo') . '" style="max-width: ' . rt_get_option('rt_logo_width') . 'px; max-height:' . rt_get_option('rt_logo_height') . 'px;" />'; }
				else { bloginfo('name'); } ?></a></h2>
        
  		<div id="main-menu" class="clearfix"><?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'main-menu', 'theme_location' => 'primary-menu' ) ); ?></div>
		
	</div>
		
        <div id="main-menu-small-container"><?php do_action( 'get_main_menu_as_dropdown' ); //library/content/content.php ?></div>
        
        <?php if( is_front_page() ) { do_action( 'display_feature' ); /* library/plugins/display-feature.php */ } 
		else if( is_single() || is_page() ) { if( has_post_thumbnail() ) { do_action( 'feature_image' ); /* library/content/content.php */ } } ?>
        
	</div>