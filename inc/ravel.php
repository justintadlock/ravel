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

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'ravel_enqueue_scripts' );

/* Register custom styles. */
add_action( 'wp_enqueue_scripts', 'ravel_register_styles', 0 );

/* Modifies the theme layout. */
add_filter( 'theme_mod_theme_layout', 'ravel_mod_theme_layout', 15 );

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

	/* Adds the 'ravel-portfolio-thumb' image size. */
	if ( post_type_exists( 'portfolio_item' ) )
		add_image_size( 'ravel-portfolio-thumb', 352, 352, true );
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
 * Enqueues scripts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_enqueue_scripts() {

	wp_enqueue_script( 'ravel', trailingslashit( get_template_directory_uri() ) . 'js/ravel.js', array( 'jquery' ), null, true );
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

/**
 * Modifies the theme layout for specific pages.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $layout
 * @return string
 */
function ravel_mod_theme_layout( $layout ) {

	if ( is_page_template( 'page-template-intro.php' ) || is_404() || is_singular( 'portfolio_item' ) || is_post_type_archive( 'portfolio_item' ) || is_tax( 'portfolio' ) ) {
		$layout = '1c';
	}

	return $layout;
}

/* === CPT: PORTFOLIO PLUGIN. === */

	/**
	 * Returns a link to the porfolio item URL if it has been set.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function ravel_get_portfolio_item_link() {

		$url = get_post_meta( get_the_ID(), 'portfolio_item_url', true );

		if ( !empty( $url ) )
			return '<a class="portfolio-item-link button" href="' . esc_url( $url ) . '">' . __( 'Visit Project', 'ravel' ) . '</a>';
	}

/* End CPT: Portfolio section. */
