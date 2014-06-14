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
		
			<?php if ( has_excerpt() ) : // If the image has an excerpt/caption. ?>

				<?php $src = wp_get_attachment_image_src( get_the_ID(), 'full' ); ?>

				<?php echo img_caption_shortcode( array( 'align' => 'alignnone', 'width' => esc_attr( $src[1] ), 'caption' => get_the_excerpt() ), wp_get_attachment_image( get_the_ID(), 'full', false ) ); ?>

			<?php else : // If the image doesn't have a caption. ?>

				<?php echo wpautop( wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter ravel-full' ) ) ); ?>

			<?php endif; // End check for image caption. ?>

			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			
			<?php $gallery = gallery_shortcode( array( 'columns' => 4, 'numberposts' => 8, 'orderby' => 'rand', 'id' => get_queried_object()->post_parent, 'exclude' => get_the_ID() ) ); ?>

			<?php if ( !empty( $gallery ) ) : // Check if the gallery is not empty. ?>

				<div class="attachment-image-gallery">
					<h4><?php _e( 'Gallery', 'ravel' ); ?></h4>
					<?php echo $gallery; ?>
				</div>

			<?php endif; // End gallery check. ?>

		</div><!-- .entry-content -->

	<?php else : // If not viewing a single post. ?>

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

	<?php endif; // End single attachment check. ?>

</article><!-- .entry -->