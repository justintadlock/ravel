<?php if ( '1c' !== get_theme_mod( 'theme_layout' ) ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'primary' ); ?>>

		<h1 class="sidebar-toggle">Sidebar</h1><!-- .sidebar-toggle -->

		<?php if ( is_active_sidebar( 'primary' ) ) : // If the sidebar has widgets. ?>

			<?php dynamic_sidebar( 'primary' ); // Displays the primary sidebar. ?>

		<?php else : // If the sidebar has no widgets. ?>

			<?php the_widget(
				'Ravel_Widget_Tabs',
				array(
					'title'  => '',
				),
				array(
					'before_widget' => '<section class="widget widget_util_tabs">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
				)
			); ?>

		<?php endif; // End widgets check. ?>

	</aside><!-- #sidebar-primary -->

<?php endif; // End layout check. ?>