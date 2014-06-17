<?php
/**
 * Custom tabs widget.
 *
 * @package    Ravel
 * @author     Tung Do, <ttsondo@gmail.com>
 * @author     Justin Tadlock, <justin@justintadlock.com>
 * @copyright  Copyright (c) 2014, Tung Do, Justin Tadlock
 * @link       http://themehybrid.com/themes/ravel
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Tabs widget class.
 *
 * @since  1.0.0
 * @access public
 */
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
			'title'                   => '', // No default title.
			'recent_posts_number'     => 3,
			'popular_posts_number'    => 3,
			'popular_past_months'     => 1,
			'recent_comments_number'  => 3,
			'tag_cloud_number'        => 45,
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

		/* Set up tabs. */
		$tabs = array();

		if ( 0 < $args['recent_posts_number'] )
			$tabs['recent'] = __( 'Recent Posts', 'ravel' );

		if ( 0 < $args['popular_posts_number'] )
			$tabs['popular'] = __( 'Popular Posts', 'ravel' );

		if ( 0 < $args['recent_comments_number'] )
			$tabs['comments'] = __( 'Recent Comments', 'ravel' );

		if ( 0 < $args['tag_cloud_number'] )
			$tabs['tags'] = __( 'Tags', 'ravel' );

		if ( empty( $tabs ) )
			return;

		/* Output the sidebar's $before_widget wrapper. */
		echo $sidebar['before_widget'];

		/* If a title was input by the user, display it. */
		if ( !empty( $args['title'] ) )
			echo $sidebar['before_title'] . apply_filters( 'widget_title', $args['title'], $instance, $this->id_base ) . $sidebar['after_title'];

		?>

		<ul class="tabs-nav">
			<?php foreach ( $tabs as $tab => $label ) : ?>
				<?php printf( '<li class="tab-%s tab-title"><a href="#%s" title="%3$s"><span>%3$s</span></a></li>', esc_attr( $tab ), esc_attr( "{$this->id_base}-{$tab}" ), esc_attr( $label ) ); ?>
			<?php endforeach; ?>
		</ul><!-- .tabs-nav -->

		<div class="tabs-container">

			<?php if ( 0 < $args['recent_posts_number'] ) : ?>

				<?php $loop = new WP_Query( 
					array( 
						'posts_per_page'      => $args['recent_posts_number'], 
						'ignore_sticky_posts' => true 
					) 
				); ?>

				<ul id="<?php echo esc_attr( $this->id_base ); ?>-recent" class="tabs-panel">

					<?php while ( $loop->have_posts() ) : ?>

						<?php $loop->the_post(); ?>

						<li>
							<?php get_the_image( array( 'size' => 'post-thumbnail', 'before' => '<div class="tab-thumbnail">', 'after' => '</div>' ) ); ?>

							<div class="tab-content">

								<div class="tab-post-format">
									<?php hybrid_post_format_link(); ?>
								</div><!-- .tab-post-format -->

								<?php the_title( '<div class="tab-title"><a href="' . get_permalink() . '">', '</a></div>' ); ?>

								<div class="tab-date"><?php echo get_the_date(); ?></div>

							</div><!-- .tab-content -->
						</li>

					<?php endwhile; ?>
				</ul>

			<?php endif; // End check to display recent posts. ?>

			<?php if ( 0 < $args['popular_posts_number'] ) : ?>

				<?php $loop = new WP_Query( 
					array( 
						'posts_per_page'      => $args['popular_posts_number'], 
						'orderby'             => 'comment_count', 
						'ignore_sticky_posts' => true,
						'date_query'          => array(
							array(
								'after' => 1 === $args['popular_past_months'] ? '1 month ago' : sprintf( '%s months ago', $args['popular_past_months'] )
							)
						)
					) 
				); ?>

				<ul id="<?php echo esc_attr( $this->id_base ); ?>-popular" class="tabs-panel">

					<?php while ( $loop->have_posts() ) : ?>

						<?php $loop->the_post(); ?>

						<li>
							<?php get_the_image( array( 'size' => 'post-thumbnail', 'before' => '<div class="tab-thumbnail">', 'after' => '</div>' ) ); ?>

							<div class="tab-content">

								<div class="tab-post-format">
									<?php hybrid_post_format_link(); ?>
								</div><!-- .tab-post-format -->

								<?php the_title( '<div class="tab-title"><a href="' . get_permalink() . '">', '</a></div>' ); ?>

								<div class="tab-date"><?php echo get_the_date(); ?></div>

							</div><!-- .tab-content -->
						</li>

					<?php endwhile; ?>
				</ul>

			<?php endif; // End popular posts check. ?>

			<?php if ( 0 < $args['recent_comments_number'] ) : ?>

				<?php $comments = get_comments(
					array( 
						'number' => $args['recent_comments_number'], 
						'status' => 'approve'
					) 
				); ?>

				<?php if ( !empty( $comments ) ) : ?>

					<ul id="<?php echo esc_attr( $this->id_base ); ?>-comments" class="tabs-panel">

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

				<?php endif; // End if have comments check. ?>

			<?php endif; // End check for comments display. ?>

			<?php if ( 0 < $args['tag_cloud_number'] ) : ?>

				<ul id="<?php echo esc_attr( $this->id_base ); ?>-tags" class="tabs-panel">
					<li>
						<?php wp_tag_cloud(
							array(
								'number' => $args['tag_cloud_number'] 
							)
						); ?>
					</li>
				</ul><!-- .tabs-panel -->

			<?php endif; // End check for display of tag cloud. ?>

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

		/* Numbers. */
		$instance['recent_posts_number']    = absint( $new_instance['recent_posts_number']    );
		$instance['popular_posts_number']   = absint( $new_instance['popular_posts_number']   );
		$instance['recent_comments_number'] = absint( $new_instance['recent_comments_number'] );
		$instance['tag_cloud_number']       = absint( $new_instance['tag_cloud_number']       );
		$instance['popular_past_months']    = absint( $new_instance['popular_past_months']    );

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
		<p>
			<label for="<?php echo $this->get_field_id( 'recent_posts_number' ); ?>"><?php _e( 'Number of recent posts to show?', 'ravel' ); ?></label>
			<input type="number" class="smallfat code" size="5" min="0" id="<?php echo $this->get_field_id( 'recent_posts_number' ); ?>" name="<?php echo $this->get_field_name( 'recent_posts_number' ); ?>" value="<?php echo esc_attr( $instance['recent_posts_number'] ); ?>" placeholder="0" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_posts_number' ); ?>"><?php _e( 'Number of popular posts to show?', 'ravel' ); ?></label>
			<input type="number" class="smallfat code" size="5" min="0" id="<?php echo $this->get_field_id( 'popular_posts_number' ); ?>" name="<?php echo $this->get_field_name( 'popular_posts_number' ); ?>" value="<?php echo esc_attr( $instance['popular_posts_number'] ); ?>" placeholder="0" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_past_months' ); ?>"><?php _e( 'Show popular posts from last __ months:', 'ravel' ); ?></label>
			<input type="number" class="smallfat code" size="5" min="1" max="12" id="<?php echo $this->get_field_id( 'popular_past_months' ); ?>" name="<?php echo $this->get_field_name( 'popular_past_months' ); ?>" value="<?php echo esc_attr( $instance['popular_past_months'] ); ?>" placeholder="1" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'recent_comments_number' ); ?>"><?php _e( 'Number of comments to show?', 'ravel' ); ?></label>
			<input type="number" class="smallfat code" size="5" min="0" id="<?php echo $this->get_field_id( 'recent_comments_number' ); ?>" name="<?php echo $this->get_field_name( 'recent_comments_number' ); ?>" value="<?php echo esc_attr( $instance['recent_comments_number'] ); ?>" placeholder="0" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tag_cloud_number' ); ?>"><?php _e( 'Number of tags to show?', 'ravel' ); ?></label>
			<input type="number" class="smallfat code" size="5" min="0" id="<?php echo $this->get_field_id( 'tag_cloud_number' ); ?>" name="<?php echo $this->get_field_name( 'tag_cloud_number' ); ?>" value="<?php echo esc_attr( $instance['tag_cloud_number'] ); ?>" placeholder="0" />
		</p>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}
