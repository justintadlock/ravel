<form method="get" class="search-form" action="<?php echo trailingslashit( home_url() ); ?>">
	<div>
		<label><span class="screen-reader-text"><?php _e( 'Search', 'ravel' ); ?></span>
			<input class="search-text" type="text" name="s" placeholder="<?php esc_attr_e( 'Search for...', 'ravel' ); ?>" />
		</label>
		<input class="search-submit button" name="submit" type="submit" value="<?php esc_attr_e( 'Search', 'ravel' ); ?>" />
	</div>
</form><!-- .search-form -->