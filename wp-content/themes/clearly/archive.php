<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package clearly
 * @since clearly 1.0
 * @license GPL 2.0
 */

get_header(); ?>

<section id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'loop' ); ?>
		<?php endwhile; ?>

		<?php clearly_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'archive' ); ?>

	<?php endif; ?>

	</div><!-- #content .site-content -->
</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>