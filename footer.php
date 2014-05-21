				<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

			</div><!-- #main -->

			<footer <?php hybrid_attr( 'footer' ); ?>>

				<?php hybrid_get_menu( 'social' ); // Loads the menu/social.php template. ?>

				<div class="footer-content">
					<p class="copyright">
						<?php printf(
							/* Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link. */
							__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'ravel' ), 
							date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
						); ?>
					</p><!-- .copyright -->

				</div><!-- .footer-content -->

			</footer><!-- #footer -->

		</div><!-- .wrap -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>