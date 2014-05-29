<nav <?php hybrid_attr( 'menu', 'portfolio' ); ?>>

<?php if ( has_nav_menu( 'portfolio' ) ) { ?>
	
	<?php wp_nav_menu(
		array(
			'theme_location'  => 'portfolio',
			'container'       => 'div',
			'container_class' => 'wrap',
			'menu_id'         => 'menu-portfolio-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'fallback_cb'     => '',
			'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
		)
	); ?>

<?php } else { ?>

	<ul id="menu-portfolio-items" class="menu-items">
		<?php $type = get_post_type_object( 'portfolio_item' ); ?>

		<li <?php echo is_post_type_archive( 'portfolio_item' ) ? 'class="current-cat"' : ''; ?>>
			<a href="<?php echo get_post_type_archive_link( 'portfolio_item' ); ?>">
				<?php _e( 'All', 'ravel' ); ?>
			</a>
		</li>

		<?php wp_list_categories( 
			array( 
				'taxonomy'     => 'portfolio', 
				'depth'        => 1, 
				'hierarchical' => false,
				'show_option_none' => false,
				'title_li'     => false 
			) 
		); ?>
	</ul>

<?php } ?>

</nav><!-- #menu-portfolio -->