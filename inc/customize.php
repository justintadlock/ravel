<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    Ravel
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

	/* Add single-letter site title setting. */
	$wp_customize->add_setting(
		'single_letter',
		array(
			'default'              => false,
			'type'                 => 'theme_mod',
			'capability'           => 'edit_theme_options',
		//	'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		//	'sanitize_js_callback' => 'maybe_hash_hex_color',
		//	'transport'            => 'postMessage',
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
