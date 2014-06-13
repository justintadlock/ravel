jQuery( document ).ready( function() {

	/* Menu toggle. */
	jQuery( '.menu-toggle' ).click(
		function() {
			jQuery( this ).parent().children( '.wrap' ).fadeToggle();
			jQuery( this ).toggleClass( 'active' );
		}
	);

	/* Sidebar toggle. */
	jQuery( '.sidebar-toggle' ).click(
		function() {
			jQuery( this ).toggleClass( 'active' );
			jQuery( this ).parent().toggleClass( 'active' );
		}
	);
			
	/* Inline labels for comment form elements. */
	if ( jQuery( 'body' ).has( '.comment-form' ) ) {

		jQuery( '.comment-form p > label ' ).each( 
			function( index ) {
				var labelText = jQuery( this ).text();

				jQuery( this ).siblings( 'input, textarea' ).attr( 'placeholder', labelText );
			}
		);
	}

	/* Tabs. */
	/*jQuery( '.tabs-nav ' ).each(
		function( index ) {
			jQuery( this ).parent().tabs();
		}
	);*/

} );