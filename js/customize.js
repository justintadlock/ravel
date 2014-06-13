/**
 * Handles the customizer live preview settings.
 */
jQuery( document ).ready( function() {

	/*
	 * Shows a live preview of changing the site title.
	 */
	wp.customize( 'blogname', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-title a' ).html( to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Shows a live preview of changing the site description.
	 */
	wp.customize( 'blogdescription', function( value ) {

		value.bind( function( to ) {

			jQuery( '#site-title' ).attr( 'title', to );

		} ); // value.bind

	} ); // wp.customize

	/*
	 * Toggles the site title 'single-letter' class.
	 */
	wp.customize( 'single_letter', function( value ) {

		value.bind( function( to ) {

			if ( 1 == to )
				jQuery( '#branding' ).addClass( 'single-letter' );
			else
				jQuery( '#branding' ).removeClass( 'single-letter' );

		} ); // value.bind

	} ); // wp.customize

} ); // jQuery( document ).ready