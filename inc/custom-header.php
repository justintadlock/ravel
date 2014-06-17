<?php
/**
 * Handles the setup and usage of the WordPress custom headers feature.
 *
 * @package    Ravel
 * @author     Tung Do, <ttsondo@gmail.com>
 * @author     Justin Tadlock, <justin@justintadlock.com>
 * @copyright  Copyright (c) 2014, Tung Do, Justin Tadlock
 * @link       http://themehybrid.com/themes/ravel
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Call late so child themes can override. */
add_action( 'after_setup_theme', 'ravel_custom_header_setup', 15 );

/**
 * Adds support for the WordPress 'custom-header' theme feature and registers custom headers.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_custom_header_setup() {

	/* Adds support for WordPress' "custom-header" feature. */
	add_theme_support( 
		'custom-header', 
		array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 120,
			'height'                 => 120,
			'flex-width'             => true,
			'flex-height'            => true,
			'default-text-color'     => '',
			'header-text'            => false,
			'uploads'                => true,
			'wp-head-callback'       => '__return_false',
			'admin-head-callback'    => '__return_false',
			'admin-preview-callback' => 'ravel_custom_header_admin_preview',
		)
	);

	/* Load the stylesheet for the custom header screen. */
	add_action( 'admin_enqueue_scripts', 'ravel_enqueue_admin_custom_header_styles', 5 );
}

/**
 * Enqueues the styles for the "Appearance > Custom Header" screen in the admin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_enqueue_admin_custom_header_styles( $hook_suffix ) {

	if ( 'appearance_page_custom-header' === $hook_suffix ) {
		wp_enqueue_style( 'ravel-fonts' );
		wp_enqueue_style( 'ravel-admin-custom-header' );

		if ( is_child_theme() ) {
			$dir = trailingslashit( get_stylesheet_directory() );
			$uri = trailingslashit( get_stylesheet_directory_uri() );

			if ( file_exists( $dir . 'css/admin-custom-header.css' ) )
				wp_enqueue_style( get_stylesheet() . '-admin-custom-header', "{$uri}css/admin-custom-header.css" );
		}
	}
}

/**
 * Callback for the admin preview output on the "Appearance > Custom Header" screen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_custom_header_admin_preview() { ?>

	<div <?php hybrid_attr( 'body' ); // Fake <body> class. ?>>

		<div class="page-container">

			<div class="wrap">

				<header <?php hybrid_attr( 'header' ); ?>>

					<div <?php hybrid_attr( 'branding' ); ?>>

						<?php if ( get_header_image() ) : // If there's a header image. ?>

							<h1 <?php hybrid_attr( 'site-title' ); ?>>
								<a href="<?php echo esc_url( home_url() ); ?>">
									<img class="header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
								</a>
							</h1>

						<?php else : // If there's no header image. ?>

							<?php hybrid_site_title(); ?>

						<?php endif; // End header image check. ?>

					</div><!-- #branding -->

					<?php //endif; // End check for header text. ?>

				</header><!-- #header -->

			</div><!-- .wrap -->

		</div><!-- .page-container -->

	</div><!-- Fake </body> close. -->

<?php }
