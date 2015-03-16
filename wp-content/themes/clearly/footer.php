<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package clearly
 * @since clearly 1.0
 * @license GPL 2.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer-widgets">
			<?php dynamic_sidebar( 'sidebar-footer' ) ?>
		</div>
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<div id="site-info">
	<?php do_action( 'clearly_credits' ); ?>
	<?php echo apply_filters( 'clearly_credits_siteorigin', sprintf( __( 'Designed by %1$s', 'clearly' ), '<a href="http://siteorigin.com/" rel="designer">SiteOrigin</a>' ) ); ?>
</div><!-- .site-info -->

<?php wp_footer(); ?>

</body>
</html>