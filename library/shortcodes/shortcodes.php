<?php
	
add_shortcode( 'column', 'build_column_shortcode' );

function build_column_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'number' => '1-2',
	  'new_line' => false
      ), $atts ) );
 
 	 if( $new_line == false ) return '<div class="col-' . esc_attr($number) . ' rt-col">' . do_shortcode($content) . '</div>';
	 else return '<div class="col-' . esc_attr($number) . ' rt-col" style="clear:both;">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'tile', 'build_tile_shortcode' );

function build_tile_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'number' => '1-2',
	  'new_line' => false
      ), $atts ) );
 
 	 if( $new_line == false ) return '<div class="tile-' . esc_attr($number) . ' rt-tile">' . do_shortcode($content) . '</div>';
	 else return '<div class="tile-' . esc_attr($number) . ' rt-tile" style="clear:both;">' . do_shortcode($content) . '</div>';
}
	
?>