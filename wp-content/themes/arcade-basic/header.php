<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main>
 * and the left sidebar conditional
 *
 * @since 1.0.0
 */

////////////////////////////////////// Frans Login redirect ///////////////////////////////////////
$server = frg_get_server();
$loginpage = $server.'/kasi/login/';
$mainpage = $server.'/kasi/home/';
$registrationpage = $server.'/kasi/register/';

error_log("Home page -> ".$mainpage, 0 );
error_log("Login page -> ".$loginpage, 0 );
error_log("Current page -> ".frgCurPageURL(), 0 );

// Redirect to login page if user is not logged in.
if (!is_user_logged_in() && frgCurPageURL() != $registrationpage && frgCurPageURL() != $loginpage ) {    
    wp_redirect( $loginpage);
 exit; 
} 

// Redirect to home page page if user is already logged in.
if (is_user_logged_in() && frgCurPageURL() == $loginpage) {
 wp_redirect( $mainpage);
 exit; 
} 

// Get current page URL
function frgCurPageURL() { 
    $pageURL = frg_get_server().$_SERVER["REQUEST_URI"];
    return $pageURL;
}

// Get current server
function frg_get_server() { 
    $pageURL = 'http';   

    if ( !empty($_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }
    return $pageURL;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE]><script src="<?php echo BAVOTASAN_THEME_URL; ?>/library/js/html5.js"></script><![endif]-->
<?php wp_head(); ?>
</head>
<?php
$bavotasan_theme_options = bavotasan_theme_options();
$space_class = '';
?>
<body <?php body_class(); ?>>

	<div id="page">

		<header id="header">
			<nav id="site-navigation" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<h3 class="sr-only"><?php _e( 'Main menu', 'arcade' ); ?></h3>
				<a class="sr-only" href="#primary" title="<?php esc_attr_e( 'Skip to content', 'arcade' ); ?>"><?php _e( 'Skip to content', 'arcade' ); ?></a>

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
				</div>

				<div class="collapse navbar-collapse">
					<?php
					$menu_class = ( is_rtl() ) ? ' navbar-right' : '';
					wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav navbar-nav' . $menu_class, 'fallback_cb' => 'bavotasan_default_menu' ) );
					?>
				</div>
			</nav><!-- #site-navigation -->

			 <div class="title-card-wrapper">
                <div class="title-card">
    				<div id="site-meta">
    					<h1 id="site-title">
    						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    					</h1>

    					<?php if ( $bavotasan_theme_options['header_icon'] ) { ?>
    					<i class="fa <?php echo $bavotasan_theme_options['header_icon']; ?>"></i>
    					<?php } else {
    						$space_class = ' class="margin-top"';
    					} ?>

    					<h2 id="site-description"<?php echo $space_class; ?>>
    						<?php bloginfo( 'description' ); ?>
    					</h2>

    					<a href="#" id="more-site" class="btn btn-default btn-lg"><?php _e( 'See More', 'arcade' ); ?></a>
    				</div>

    				<?php
    				// Header image section
    				bavotasan_header_images();
    				?>
				</div>
			</div>

		</header>

		<main>