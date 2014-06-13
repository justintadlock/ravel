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

/* Register sidebars and widgets. */
add_action( 'widgets_init', 'ravel_register_sidebars', 5 );
add_action( 'widgets_init', 'ravel_register_widgets',  5 );

/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'ravel_enqueue_scripts' );

/* Register custom styles. */
add_action( 'wp_enqueue_scripts', 'ravel_register_styles', 0 );

/* Modifies the theme layout. */
add_filter( 'theme_mod_theme_layout', 'ravel_mod_theme_layout', 15 );

/* Modifies the excerpt more */
add_filter('excerpt_more', 'ravel_excerpt_more');

/* Custom search form. */
add_filter( 'get_search_form', 'ravel_search_form' );

/* Adds custom settings for the visual editor. */
add_filter( 'tiny_mce_before_init', 'ravel_tiny_mce_before_init' );

/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_image_sizes() {

	/*
	 * Sets the 'post-thumbnail' size. This is based off the default WordPress' 'thumbnail' size of 
	 * 150x150, so only a single image is created if the settings are the same.  Otherwise, the theme's 
	 * 'post-thumbnail' size will be used.
	 */
	set_post_thumbnail_size( 150, 150, true );

	/* Adds the 'ravel-medium' image size. */
	add_image_size( 'ravel-medium', 540, 540, true );

	/* Adds the 'ravel-large' image size. */
	add_image_size( 'ravel-large', 728, 9999, false );

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
			'description' => __( 'The main sidebar.', 'ravel' )
		)
	);
}

/**
 * Registers widgets.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_register_widgets() {

	require_once( trailingslashit( get_template_directory() ) . 'inc/widget-ravel-tabs.php' );

	register_widget( 'Ravel_Widget_Tabs' );
}

/**
 * Enqueues scripts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_enqueue_scripts() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'ravel', trailingslashit( get_template_directory_uri() ) . "js/ravel{$suffix}.js", array( 'jquery-ui-tabs' ), null, true );
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

/**
 * Get attached images.
 *
 * @since  1.0.0
 */
function ravel_attached_images() {

	$children = array(
		'post_parent' => get_the_ID(),
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID'
	);

	/* Get image attachments. If none, return. */
	$attachments = get_children( $children );

	if ( empty( $attachments ) )
		return '';
		
	$out = '<div class="featured-media">';

	/* Loop through each attachment. */
	foreach ( $attachments as $id => $attachment ) {

		$out .= '<figure>' . wp_get_attachment_link( $id, 'ravel-large', false );
		
		$caption = wptexturize( esc_html( $attachment->post_excerpt ) );

		if ( !empty( $caption ) )
			$out .= '<figcaption class="gallery-caption">' . $caption . '</figcaption>';
			
		$out .= '</figure>';
		
	}
	
	$out .= '</div>';

	return $out;
}

/**
 * Modifies the excerpt more
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_excerpt_more($more) {
	global $post;
	return '<a class="moretag read-more-link" href="'. get_permalink($post->ID) . '">&#133;</a>';
}

/**
 * Creates a custom search form for the theme.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $form
 * @return string
 */
function ravel_search_form( $form ) {

	$form = sprintf( 
		'<form role="search" method="get" class="search-form" action="%s">  
			<div>
				<label>
					<span class="screen-reader-text">%s</span>
					<input class="search-text" type="text" name="s" placeholder="%s" />
				</label>
				<input class="search-submit button" name="submit" type="submit" value="%s" />
			</div>
		</form><!-- .search-form -->',
		esc_url( home_url( '/' ) ),
		_x( 'Search', 'screen reader text', 'ravel' ),
		esc_attr__( 'Search for &hellip;', 'ravel' ),
		esc_attr_x( 'Search', 'submit button', 'ravel' )
	);

	return $form;
}

/**
 * Adds the <body> class to the visual editor.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $settings
 * @return array
 */
function ravel_tiny_mce_before_init( $settings ) {

	$settings['body_class'] = join( ' ', get_body_class() );

	return $settings;
}

/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function ravel_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'css/editor-style.css';

	/* If a child theme, add its editor styles. Note: WP checks whether the file exists before using it. */
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . 'css/editor-style.css' ) )
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'ravel_editor_styles', admin_url( 'admin-ajax.php' ) );

	/* Return the styles. */
	return $editor_styles;
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
			return '<a class="button portfolio-item-link" href="' . esc_url( $url ) . '">' . __( 'Visit Project', 'ravel' ) . '</a>';
	}

/* End CPT: Portfolio section. */
