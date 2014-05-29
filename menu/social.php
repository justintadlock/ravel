<?php if ( has_nav_menu( 'social' ) ) : // Check if there's a menu assigned to the 'social' location. ?>

	<nav <?php hybrid_attr( 'menu', 'social' ); ?>>

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'depth'           => 1,
				'container'       => 'div',
				'container_class' => 'wrap',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

	</nav><!-- #menu-social -->

<?php endif; // End check for menu. ?>