<?php

class Ravel_Widget_Tabs extends WP_Widget {

	/**
	 * Default arguments for the widget settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $defaults = array();

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'widget_util_tabs',
			'description' => esc_html__( 'Outputs recent posts, popular posts, recent comments, and tags in tab form.', 'ravel' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width'  => 200,
			'height' => 350
		);

		/* Create the widget. */
		$this->WP_Widget(
			'ravel-tabs',
			__( 'Ravel Tabs', 'ravel' ),
			$widget_options,
			$control_options
		);

		/* Set up the defaults. */
		$this->defaults = array(
			'title' => esc_attr__( 'Tabs', 'ravel' ),
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $sidebar
	 * @param  array  $instance
	 * @return void
	 */
	function widget( $sidebar, $instance ) {

		$args = wp_parse_args( $instance, $this->defaults );

		/* Output the sidebar's $before_widget wrapper. */
		echo $sidebar['before_widget'];

		/* If a title was input by the user, display it. */
		if ( !empty( $args['title'] ) )
			echo $sidebar['before_title'] . apply_filters( 'widget_title', $args['title'], $instance, $this->id_base ) . $sidebar['after_title'];

			$tabs = array(
				'recent'   => __( 'Recent Posts',    'ravel' ),
				'popular'  => __( 'Popular Posts',   'ravel' ),
				'comments' => __( 'Recent Comments', 'ravel' ),
				'tags'     => __( 'Tags',            'ravel' )
			);
		?>

		<ul class="tabs-nav group tab-count-4">
			<?php foreach ( $tabs as $tab => $label ) : ?>
				<?php printf( '<li class="tab-%s"><a href="#%s" title="%3$s"><span>%3$s</span></a></li>', esc_attr( $tab ), esc_attr( "{$this->id_base}-{$tab}" ), esc_attr( $label ) ); ?>
			<?php endforeach; ?>
		</ul><!-- .tabs-nav -->

		<div class="tabs-container">

			<?php $loop = new WP_Query( 
				array( 
					'posts_per_page'      => 3, 
					'ignore_sticky_posts' => true 
				) 
			); ?>

			<ul id="<?php echo esc_attr( $this->id_base ); ?>-recent" class="tabs-panel group thumbs-enabled">

				<?php while ( $loop->have_posts() ) : ?>

					<?php $loop->the_post(); ?>

					<li>
						<?php get_the_image( array( 'size' => 'post-thumbnail', 'before' => '<div class="tab-thumbnail">', 'after' => '</div>' ) ); ?>

						<div class="tab-content">
							<?php the_title( '<div class="tab-title"><a href="' . get_permalink() . '">', '</a></div>' ); ?>
							<div class="tab-date"><?php echo get_the_date(); ?></div>
						</div><!-- .tab-content -->
					</li>

				<?php endwhile; ?>
			</ul>

			<?php $loop = new WP_Query( 
				array( 
					'posts_per_page'      => 3, 
					'orderby'             => 'comment_count', 
					'ignore_sticky_posts' => true,
					'date_query'          => array(
						array(
							'after' => '1 month ago'
						)
					)
				) 
			); ?>

			<ul id="<?php echo esc_attr( $this->id_base ); ?>-popular" class="tabs-panel thumbs-enabled">

				<?php while ( $loop->have_posts() ) : ?>

					<?php $loop->the_post(); ?>

					<li>
						<?php get_the_image( array( 'size' => 'post-thumbnail', 'before' => '<div class="tab-thumbnail">', 'after' => '</div>' ) ); ?>

						<div class="tab-content">
							<?php the_title( '<div class="tab-title"><a href="' . get_permalink() . '">', '</a></div>' ); ?>
							<div class="tab-date"><?php echo get_the_date(); ?></div>
						</div><!-- .tab-content -->
					</li>

				<?php endwhile; ?>
			</ul>

			<?php $comments = get_comments( array( 'number' => 3, 'status' => 'approve' ) ); ?>

			<?php if ( !empty( $comments ) ) : ?>

				<ul id="<?php echo esc_attr( $this->id_base ); ?>-comments" class="tabs-panel avatars-enabled">

					<?php foreach ( $comments as $comment ) : ?>

						<li>
							<div class="tab-thumbnail avatar">
								<?php printf( '<a href="%s">%s</a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_avatar( $comment->comment_author_email, 96 ) ); ?>
							</div>

							<div class="tab-content">
								<div class="tab-author">
									<cite><?php comment_author( $comment->comment_ID ); ?></cite>
								</div>
								<div class="tab-comment">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<?php comment_excerpt( $comment->comment_ID ); ?>
									</a>
								</div>	
							</div><!-- .tab-content -->
						</li>

					<?php endforeach; ?>

				</ul><!--.tabs-panel-->

			<?php endif; ?>

			<ul id="<?php echo esc_attr( $this->id_base ); ?>-tags" class="tabs-panel">
				<li>
					<?php wp_tag_cloud(); ?>
				</li>
			</ul><!-- .tabs-panel -->

		</div><!-- .tabs-container -->
		<?php

		/* Close the sidebar's widget wrapper. */
		echo $sidebar['after_widget'];
	}

	/**
	 * The update callback for the widget control options.  This method is used to sanitize and/or
	 * validate the options before saving them into the database.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $new_instance
	 * @param  array  $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		/* Strip tags. */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* Return sanitized options. */
		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $instance
	 * @param  void
	 */
	function form( $instance ) {

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ravel' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php echo esc_attr( $this->defaults['title'] ); ?>" />
		</p>
	<?php
	}
}
