<li <?php hybrid_attr( 'comment' ); ?>>

	<article class="comment-wrap">

		<header class="comment-meta">
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite><br />
			<time <?php hybrid_attr( 'comment-published' ); ?>>
				<a <?php hybrid_attr( 'comment-permalink' ); ?>><?php printf( __( '%s ago', 'ravel' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></a>
			</time> 
			<?php edit_comment_link(); ?>
		</header><!-- .comment-meta -->

	</article><!-- .comment-wrap -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>