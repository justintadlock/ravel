<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline">
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php hybrid_post_author( array( 'text' => __( 'By %s', 'ravel' ) ) ); ?>
				<?php comments_popup_link( __( '0 Comments', 'ravel' ), __( '1 Comment', 'ravel' ), __( '% Comments', 'ravel' ), 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php _e( 'Permalink', 'ravel' ); ?></a>
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => ' ' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => ' ' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">

			<div class="entry-byline">
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php hybrid_post_author( array( 'text' => __( 'By %s', 'ravel' ) ) ); ?>
				<?php comments_popup_link( __( '0 Comments', 'ravel' ), __( '1 Comment', 'ravel' ), __( '% Comments', 'ravel' ), 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_title( '<p><a href="' . hybrid_get_the_post_format_url() . '">', is_rtl() ? ' <span class="meta-nav">&larr;</span>' : ' <span class="meta-nav">&rarr;</span>' . '</a></p>' ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php _e( 'Permalink', 'ravel' ); ?></a>
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'sep' => ' ' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'sep' => ' ' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->