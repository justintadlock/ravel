<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php hybrid_get_menu( 'portfolio' ); // Loads the menu/primary.php template. ?>

	<?php if ( have_posts() ) : // Checks if any posts were found. ?>

		<ul class="loop-entries-gallery">

			<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

				<?php the_post(); // Loads the post data. ?>

				<li>
					<?php get_the_image(
						array(
							'default' => hybrid_locate_theme_file( array( 'images/placeholder-540.png' ) ),
							'size'    => 'ravel-medium',
							'scan'    => true,
							'order'   => array( 'scan', 'featured', 'attachment', 'default' ),
							'before'  => '<figure>',
							'after'   => '</figure>'
						)
					); ?>
					<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
				</li>

			<?php endwhile; // End found posts loop. ?>

		</ul>

		<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

	<?php else : // If no posts were found. ?>

		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

	<?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>