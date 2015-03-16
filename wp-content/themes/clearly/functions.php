<?php
/**
 * clearly functions and definitions
 *
 * @package clearly
 * @since clearly 1.0
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.1' );
define('SITEORIGIN_THEME_UPDATE_ID', false);
define( 'SITEORIGIN_THEME_ENDPOINT' , 'http://updates.siteorigin.com' );

if( file_exists( get_template_directory() . '/premium/functions.php' ) ){
	include get_template_directory() . '/premium/functions.php';
}

// Include all the SiteOrigin extras
include get_template_directory() . '/extras/settings/settings.php';
include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/plugin-activation/plugin-activation.php';

// Load the theme specific files
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/settings.php';
include get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/inc/gallery.php';
include get_template_directory() . '/inc/demo.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since clearly 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 789; /* pixels */

if ( ! function_exists( 'clearly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since clearly 1.0
 */
function clearly_setup() {
	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'clearly', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_theme_support('siteorigin-panels', array(
		'home-page' => true,
		'home-page-template' => 'home-panels.php',
	));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'clearly' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	add_image_size('clearly-slide', 960, 480, true);
	set_post_thumbnail_size(650, 260, true);

	if( !defined('SITEORIGIN_PANELS_VERSION') && !siteorigin_plugin_activation_is_activating('siteorigin-panels') ){
		// Only include panels lite if the panels plugin doesn't exist
		include get_template_directory() . '/extras/panels-lite/panels-lite.php';
	}
}
endif; // clearly_setup
add_action( 'after_setup_theme', 'clearly_setup' );

/**
 * Setup the WordPress core custom background feature.
 * 
 * @since clearly 1.0
 */
function clearly_register_custom_background() {
	$args = array(
		'default-color' => '61666b',
		'default-image' => get_template_directory_uri().'/images/bg.png',
	);

	$args = apply_filters( 'clearly_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'clearly_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since clearly 1.0
 */
function clearly_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'clearly' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'clearly' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'clearly_widgets_init' );

/**
 * Register all the bundled scripts
 */
function clearly_register_scripts(){
	wp_register_script( 'clearly-flexslider' , get_template_directory_uri().'/js/jquery.flexslider.min.js' , array('jquery'), '2.1' );
	wp_register_script( 'clearly-fitvids' , get_template_directory_uri().'/js/jquery.fitvids.min.js' , array('jquery'), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'clearly_register_scripts' , 5);

/**
 * Enqueue scripts and styles
 */
function clearly_scripts() {
	// Everything for the nivo slider
	wp_enqueue_script('clearly-nivo-slider', get_template_directory_uri().'/nivo/jquery.nivo.slider.min.js', array('jquery'), '3.2');
	wp_enqueue_style('clearly-nivo-slider', get_template_directory_uri().'/nivo/nivo-slider.css', array(), '3.2');


	wp_enqueue_style( 'clearly-style', get_stylesheet_uri(), array(), SITEORIGIN_THEME_VERSION);
	wp_enqueue_style( 'clearly-fonts', get_template_directory_uri().'/font/style.css', array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_style( 'clearly-webfonts', 'http://fonts.googleapis.com/css?family=Open+Sans:600italic,600|Old+Standard+TT:400italic&' );

	wp_enqueue_script( 'clearly-main' , get_template_directory_uri().'/js/jquery.theme-main.min.js' , array('jquery', 'clearly-flexslider', 'clearly-fitvids'), SITEORIGIN_THEME_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'clearly_scripts' );

/**
 * Add custom body classes.
 * 
 * @param $classes
 * @return array
 * @package clearly
 * @since 1.0
 */
function clearly_body_class($classes){
	if(siteorigin_setting('layout_responsive')) $classes[] = 'responsive';
	return $classes;
}
add_filter('body_class', 'clearly_body_class');

/**
 * Add headers
 *
 * @package clearly
 * @since 1.0
 */
function clearly_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'clearly_wp_head');

/**
 * Add navigation padding to compensate for logo size.
 *
 * @package clearly
 * @since 1.0.1
 */
function clearly_logo_navigation_margin(){
	if(!siteorigin_setting('logo_logo')) return;
	$attachment = wp_get_attachment_image_src(siteorigin_setting('logo_logo'));
	if(empty($attachment)) return;

	$margin = ($attachment[2]-22)/2;

	?>
	<style id="clearly-logo-config">#masthead nav { margin-top: <?php echo round($margin).'px' ?> }</style>
	<?php
}
add_action('wp_head', 'clearly_logo_navigation_margin', 15);