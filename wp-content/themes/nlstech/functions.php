<?php
/**
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package nlstech
 */


if ( ! function_exists( 'nls_setup' ) ) :
	function nls_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'nls' ),
			'iconic-vintage' => esc_html__( 'Iconic Vintage', 'nls' ),
			'client-services' => esc_html__( 'Client Services', 'nls' ),
			'contact-us' => esc_html__( 'Contact Us', 'nls' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'nls_setup' );
/**
 * Register widget area
 */
function nls_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'About us', 'nls' ),
		'id'            => 'about_us_widget',
		'description'   => esc_html__( 'Add widgets here.', 'nls' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Latest posts', 'nls' ),
		'id'            => 'latest_posts_widget',
		'description'   => esc_html__( 'Add widgets here.', 'nls' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Find us', 'nls' ),
		'id'            => 'find_us_widget',
		'description'   => esc_html__( 'Add widgets here.', 'nls' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) ); 
}
add_action( 'widgets_init', 'nls_widgets_init' );
//enqueue scripts
function nls_scripts() {		
	wp_enqueue_style( 'nls-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome.min.css', get_template_directory_uri().'/css/font-awesome.min.css' );
	wp_enqueue_style( 'owl.carousel.min.css', get_template_directory_uri().'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'main.css', get_template_directory_uri().'/css/main.css' );
	wp_enqueue_style( 'responsive.css', get_template_directory_uri().'/css/responsive.css' );

	wp_enqueue_script( 'owl.carousel.min.js', get_template_directory_uri().'/js/owl.carousel.min.js',array('jquery'), '3.8', true );
	wp_enqueue_script( 'jquery.lazyload.min.js', get_template_directory_uri().'/js/jquery.lazyload.min.js',array('jquery'), '3.8', true );
	wp_enqueue_script( 'main.js', get_template_directory_uri().'/js/main.js',array('jquery'), '3.8', true );
}
add_action( 'wp_enqueue_scripts', 'nls_scripts' );
/**
 * Theme option
 */
require get_template_directory() . '/inc/theme-option.php';
/**
 * BFI_Thumb
 */
require get_template_directory() . '/BFI_Thumb.php';
/**
 * Shortcode
 */
require_once get_template_directory() . '/inc/shortcode.php';

//filter logout
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect(home_url());
  exit();
}
//filter wp mail html
add_filter('wp_mail_content_type','wpdocs_set_html_mail_content_type');
function wpdocs_set_html_mail_content_type($content_type){
	return 'text/html';
}
//funtion crop_img
function crop_img($w, $h, $url_img){
 $params = array( 'width' => $w, 'height' => $h, 'crop' => true);
 return bfi_thumb($url_img, $params );
}
//funtion crop_img
function get_favicon(){
    global $nls_option;
    $favicon  = $nls_option['favicon'];
    echo '<link rel="icon" type="image/png" href="'.$favicon['url'].'" sizes="32x32"/>';
}
