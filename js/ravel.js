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

	/*
	 * Video and other embeds.  Let's make them more responsive.	
	 */

	/* Overrides WP's <div> wrapper around videos, which mucks with flexible videos. */
	jQuery( 'div[style*="max-width: 100%"] > video' ).parent().css( 'width', '100%' );

	/* Responsive videos. */
	/* blip.tv adds a second <embed> with "display: none".  We don't want to wrap that. */
	jQuery( '.content object, .content embed, .content iframe' ).not( 'embed[style*="display"], [src*="soundcloud.com"], [src*="amazon"], [name^="gform_"]' ).wrap( '<div class="embed-wrap" />' );

	/* Removes the 'width' attribute from embedded videos and replaces it with a max-width. */
	jQuery( '.embed-wrap object, .embed-wrap embed, .embed-wrap iframe' ).attr( 
		'width',
		function( index, value ) {
			jQuery( this ).attr( 'style', 'max-width: ' + value + 'px;' );
			jQuery( this ).removeAttr( 'width' );
		}
	);

	/* Tabs. */
	jQuery( '.widget_util_tabs .tabs-panel' ).hide();
	jQuery( '.widget_util_tabs .tabs-panel:first-of-type' ).show();
	jQuery( '.widget_util_tabs .tabs-nav :first-child' ).attr( 'aria-selected', 'true' );

	jQuery( '.widget_util_tabs .tabs-nav li a' ).click(
		function( j ) {
			j.preventDefault();

			var href = jQuery( this ).attr( 'href' );

			jQuery( this ).parents( '.widget_util_tabs' ).find( '.tabs-panel' ).hide();

			jQuery( this ).parents( '.widget_util_tabs' ).find( href ).show();

			jQuery( this ).parents( '.widget_util_tabs' ).find( '.tab-title' ).attr( 'aria-selected', 'false' );

			jQuery( this ).parent().attr( 'aria-selected', 'true' );
		}
	);

} );