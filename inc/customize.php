<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    Ravel
 * @author     Tung Do, <ttsondo@gmail.com>
 * @author     Justin Tadlock, <justin@justintadlock.com>
 * @copyright  Copyright (c) 2014, Tung Do, Justin Tadlock
 * @link       http://themehybrid.com/themes/ravel
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Theme Customizer setup. */
add_action( 'customize_register', 'ravel_customize_register' );

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $wp_customize
 * @return void
 */
function ravel_customize_register( $wp_customize ) {

	/* Load JavaScript files. */
	add_action( 'customize_preview_init', 'ravel_enqueue_customizer_scripts' );

	/* Enable live preview for WordPress theme features. */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/* Add single-letter site title setting. */
	$wp_customize->add_setting(
		'single_letter',
		array(
			'default'              => false,
			'type'                 => 'theme_mod',
			'capability'           => 'edit_theme_options',
		//	'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		//	'sanitize_js_callback' => 'maybe_hash_hex_color',
			'transport'            => 'postMessage',
		)
	);

	/* Add a control for the single letter setting. */
	$wp_customize->add_control(
		'ravel-single-letter',
		array(
			'label'    => esc_html__( 'Use single letter title', 'ravel' ),
			'section'  => 'title_tagline',
			'settings' => 'single_letter',
			'type'     => 'checkbox',
		)
	);
}

/**
 * Loads theme customizer JavaScript.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_enqueue_customizer_scripts() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'stargazer-customize',
		trailingslashit( get_template_directory_uri() ) . "js/customize{$suffix}.js",
		array( 'jquery' ),
		null,
		true
	);
}
