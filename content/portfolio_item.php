<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

	<?php get_the_image( array( 'size' => 'ravel-full', 'split_content' => true, 'scan_raw' => true, 'scan' => true, 'order' => array( 'scan_raw', 'scan', 'featured', 'attachment' ), 'before' => '<div class="featured-media">', 'after' => '</div>' ) ); ?>

	<article <?php hybrid_attr( 'post' ); ?>>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php echo wpautop( ravel_get_portfolio_item_link() ); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'portfolio', 'sep' => ' ' ) ); ?>
		</footer><!-- .entry-footer -->

	</article><!-- .entry -->

<?php endif; // End single post check. ?>
