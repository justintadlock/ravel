<?php 
/**
 * Template Name: Intro
 */

get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

			<?php the_post(); // Loads the post data. ?>

			<?php get_the_image( array( 'size' => 'ravel-medium', 'link_to_post' => false, 'image_class' => 'hero-image', 'before' => '<section id="hero-image-container" class="col"><p>', 'after' => '</p></section>' ) ); ?>

			<section id="intro-quote-thumbnails" class="col">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</section><!-- #intro-quote-thumbnails -->

		<?php endwhile; // End found posts loop. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>