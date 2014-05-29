/*
 *
 * Ravel theme scripts
 * ===================
 *
 */

		jQuery( document ).ready( function() {
		
			jQuery( '.menu-toggle' ).click(
				function() {
					jQuery( this ).parent().children( '.wrap' ).fadeToggle();
					jQuery( this ).toggleClass( 'active' );
				}
			);
			
			/* sidebar toggle */
			jQuery( '.sidebar-toggle' ).click(function() {

				jQuery( this ).toggleClass( 'active' );
				jQuery( this ).parent().toggleClass( 'active' );
	
			});
			
			/*
			 * Comment form inline label
			 */

			if ( jQuery( 'body' ).has( '.comment-form' ) ) {
			
				jQuery( '.comment-form p > label ' ).each( function (index) {

					var labelText = jQuery(this).text();

					jQuery( this ).siblings( 'input, textarea' ).attr( 'placeholder', labelText );
					
				});
			
			}
			
			if ( jQuery( 'body' ).has( '.tabs-nav' ) ) {

				jQuery( '.tabs-nav ' ).each( function (index) {
			
					jQuery( this ).parent().tabs();
				
				});
			
			}

		});