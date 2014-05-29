<li <?php hybrid_attr( 'comment' ); ?>>

	<article class="comment-wrap">
		<header class="comment-meta">
			<?php echo get_avatar( $comment ); ?>
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite><br />
			<time <?php hybrid_attr( 'comment-published' ); ?>>
				<a <?php hybrid_attr( 'comment-permalink' ); ?>><?php printf( __( '%s ago', 'ravel' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></a>
			</time> 
			<?php edit_comment_link(); ?>
		</header><!-- .comment-meta -->

		<div <?php hybrid_attr( 'comment-content' ); ?>>
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php hybrid_comment_reply_link(); ?>
	</article><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>