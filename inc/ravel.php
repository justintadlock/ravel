<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, 
 * and lots of other awesome stuff that WordPress themes do.
 *
 * @package    Ravel
 */

/* Register custom image sizes. */
add_action( 'init', 'ravel_register_image_sizes', 5 );

/* Register custom menus. */
add_action( 'init', 'ravel_register_menus', 5 );

/* Register sidebars. */
add_action( 'widgets_init', 'ravel_register_sidebars', 5 );

/* Register custom styles. */
add_action( 'wp_enqueue_scripts', 'ravel_register_styles', 0 );

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_image_sizes() {

	/* Sets the 'post-thumbnail' size. */
	//set_post_thumbnail_size( 175, 131, true );

	/* Adds the 'ravel-medium' image size. */
	add_image_size( 'ravel-medium', 540, 540, true );

	/* Adds the 'ravel-full' image size. */
	add_image_size( 'ravel-full', 728, 9999, false );
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_menus() {
	register_nav_menu( 'primary', _x( 'Primary', 'nav menu location', 'ravel' ) );
	register_nav_menu( 'social', _x( 'Social',   'nav menu location', 'ravel' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'ravel' ),
			'description' => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'ravel' )
		)
	);
}

/**
 * Registers custom stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_styles() {

	wp_deregister_style( 'mediaelement'    );
	wp_deregister_style( 'wp-mediaelement' );

	wp_register_style( 'ravel-fonts', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic|Roboto:400,400italic,700,700italic' );
	wp_register_style( 'ravel-mediaelement', trailingslashit( get_template_directory_uri() ) . 'css/mediaelementplayer.min.css' );
	wp_register_style( 'ravel-wp-mediaelement', trailingslashit( get_template_directory_uri() ) . 'css/wp-mediaelement.css' );
}
