<?php
/**
 * Gold Tiger Logistics Solutions Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gold Tiger Logistics Solutions
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_GOLD_TIGER_LOGISTICS_SOLUTIONS_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'gold-tiger-logistics-solutions-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_GOLD_TIGER_LOGISTICS_SOLUTIONS_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );




/**
 * hook between footer widget and bar
 */
function mytheme_footer_hook( ) {
if(is_front_page() ) {
echo do_shortcode("[INSERT_ELEMENTOR id='187']");
}
}
add_action( 'astra_footer_content', 'mytheme_footer_hook', 2 );




