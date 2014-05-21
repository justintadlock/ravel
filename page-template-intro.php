<?php 
/**
 * Template Name: Intro
 */

get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php get_the_image( array( 'size' => 'ravel-medium', 'before' => '<section id="hero-image-container" class="col">', 'after' => '</section>' ) ); ?>

			<section id="intro-quote-thumbnails" class="col">

				<blockquote>
					<?php the_content(); ?>
				</blockquote>

				<?php $children = get_children( 
					array( 
						'post_parent'    => get_the_ID(), 
						'post_status'    => 'inherit',
						'post_type'      => 'attachment',
						'post_mime_type' => 'image',
						'order'          => 'ASC',
						'orderby'        => 'menu_order ID',
						'numberposts'    => 2, 
						'exclude'        => array( get_post_thumbnail_id() ) 
					) 
				); ?>


				<?php if ( !empty( $children ) ) : // If image attachments found. ?>

					<?php foreach ( $children as $attachment ) : // Loop through images. ?>

						<?php echo wp_get_attachment_image( $attachment->ID, 'thumbnail', false, array( 'class' => 'thumbnail' ) ); ?>

					<?php endforeach; // End images loop. ?>

				<?php endif; // End check for image attachments found. */ ?>

			</section><!-- #intro-quote-thumbnails -->

		<?php endwhile; // End found posts loop. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>