<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container" class="page-container">

		<div class="wrap">

			<header <?php hybrid_attr( 'header' ); ?>>

				<?php //if ( display_header_text() ) : // If user chooses to display header text. ?>

					<div <?php hybrid_attr( 'branding' ); ?>>
						<?php hybrid_site_title(); ?>
					</div><!-- #branding -->

				<?php //endif; // End check for header text. ?>

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</header><!-- #header -->

			<div id="main" class="main content-container">
