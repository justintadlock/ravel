<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

	<?php if ( $attached_images = ravel_attached_images() ) : // If there are attached images. ?>

		<?php echo $attached_images; ?>

	<?php else : // If no attached images. ?>

		<?php get_the_image( array( 'size' => 'ravel-large', 'attachment' => false, 'before' => '<div class="featured-media"><figure>', 'after' => '</figure></div>' ) ); ?>

	<?php endif; // End check for attachments. ?>

	<article <?php hybrid_attr( 'post' ); ?>>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php echo wpautop( ravel_get_portfolio_item_link() ); ?>
			<?php edit_post_link(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'portfolio', 'sep' => ' ' ) ); ?>
		</footer><!-- .entry-footer -->

	</article><!-- .entry -->

<?php endif; // End single post check. ?>