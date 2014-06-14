<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_attachment() ) : // If viewing a single attachment. ?>

		<header class="entry-header">

			<div class="entry-byline">
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php hybrid_post_author( array( 'text' => __( 'By %s', 'ravel' ) ) ); ?>
				<?php comments_popup_link( __( '0 Comments', 'ravel' ), __( '1 Comment', 'ravel' ), __( '% Comments', 'ravel' ), 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php hybrid_attachment(); // Function for handling non-image attachments. ?>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

	<?php else : // If not viewing a single attachment. ?>

		<header class="entry-header">

			<div class="entry-byline">
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php hybrid_post_author( array( 'text' => __( 'By %s', 'ravel' ) ) ); ?>
				<?php comments_popup_link( __( '0 Comments', 'ravel' ), __( '1 Comment', 'ravel' ), __( '% Comments', 'ravel' ), 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->
			
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
			
			<?php get_the_image( array( 'size' => 'ravel-medium', 'before' => '<div class="featured-media">', 'after' => '</div>' ) ); ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		
	<?php endif; // End single post check. ?>

</article><!-- .entry -->