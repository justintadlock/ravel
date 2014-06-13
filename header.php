<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container" class="page-container">

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

				<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

			</header><!-- #header -->

			<div id="main" class="main content-container">
