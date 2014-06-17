<?php
/**
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Ravel
 * @subpackage Functions
 * @author     Tung Do, <ttsondo@gmail.com>
 * @author     Justin Tadlock, <justin@justintadlock.com>
 * @copyright  Copyright (c) 2014, Tung Do, Justin Tadlock
 * @link       http://themehybrid.com/themes/ravel
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get the template directory and make sure it has a trailing slash. */
$ravel_dir = trailingslashit( get_template_directory() );

/* Load the Hybrid Core framework and launch it. */
require_once( $ravel_dir . 'library/hybrid.php' );
new Hybrid();

/* Load theme-specific files. */
require_once( $ravel_dir . 'inc/custom-header.php' );

/* Set up the theme early. */
add_action( 'after_setup_theme', 'ravel_theme_setup', 5 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function ravel_theme_setup() {

	/* Load files. */
	require_once( trailingslashit( get_template_directory() ) . 'inc/ravel.php'     );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customize.php' );

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Theme layouts. */
	add_theme_support( 
		'theme-layouts',
		array( '1c' => __( '1 Column', 'ravel' ) ),
		array( 'customize' => false, 'post_meta' => false )
	);

	/* Load stylesheets. */
	add_theme_support(
		'hybrid-core-styles',
		array( 'ravel-fonts', 'ravel-mediaelement', 'ravel-wp-mediaelement', 'parent', 'style' )
	);

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Pagination. */
	add_theme_support( 'loop-pagination' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );
	
	/* If support for Cleaner Gallery is removed, remove default gallery style as well and use ambience's gallery CSS. */
	if( !current_theme_supports('cleaner-gallery') ) {
		/* Remove default gallery inline CSS */
		add_filter( 'use_default_gallery_style', '__return_false' );
		}

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) 
	);

	/* Editor styles. */
	add_editor_style( ravel_get_editor_styles() );

	/* Handle content width for embeds and images. */
	// Note: this is the largest size based on the theme's various layouts.
	hybrid_set_content_width( 728 );
}
