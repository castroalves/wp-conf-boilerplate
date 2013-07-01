<?php
/**
 * wp-conf-boilerplate functions and definitions
 *
 * @package wp-conf-boilerplate
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'wp_conference_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function wp_conference_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on wp-conf-boilerplate, use a find and replace
	 * to change 'wp_conference' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wp_conference', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wp_conference' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'wp_conference_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wp_conference_setup
add_action( 'after_setup_theme', 'wp_conference_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function wp_conference_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wp_conference' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wp_conference_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function wp_conference_scripts() {
	wp_enqueue_style( 'wp_conference-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wp_conference-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wp_conference-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'wp_conference-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_conference_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Disable Admin Bar
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Get Twitter Username
 */
function getTwitterUsername( $twitter_url, $show_at = true ) {

	$result = preg_match( '/https?:\/\/(www\.)?twitter\.com\/(#!\/)?@?([^\/]*)/' , $twitter_url, $matches);

	$at = ( $show_at ) ? '@' : '';

	if( $result === 1 ) {
		return $at . $matches[3];
	} else {
		return false;
	}

}

/**
 * Get Latitude and Longitude via Google Maps API
 */
function getLatLong( $address ) {
    
    $url = "http://maps.google.com/maps/api/geocode/json?address=" . urlencode( $address ) . "&sensor=false&region=Brazil";

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PROXYPORT, 3128 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    
    $response = curl_exec( $ch );
    
    curl_close( $ch );
    
    $response_a = json_decode( $response );

    $arr_lat_long = array(
        'lat' => $response_a->results[0]->geometry->location->lat,
        'long' => $response_a->results[0]->geometry->location->lng
    );

    return $arr_lat_long;
}

