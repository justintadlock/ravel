<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_page() ) : // If viewing a single page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
			<?php edit_post_link(); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links"><span class="page-links-text">' . __( 'Pages:', 'ravel' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

	<?php else : // If not viewing a single page. ?>

		<header class="entry-header">

			<div class="entry-byline">
				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
			</div><!-- .entry-byline -->

			<?php get_the_image( array( 'size' => 'ravel-medium', 'before' => '<div class="featured-media"><figure>', 'after' => '</figure></div>' ) ); ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single page check. ?>

</article><!-- .entry -->