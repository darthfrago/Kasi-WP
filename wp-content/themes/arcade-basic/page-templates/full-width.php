<?php
/**
 * Template Name: Full Width
 *
 * Description: A full width page template without any sidebars
 *
 * @since 1.0.3
 */
get_header();
?>
	<div class="container">
		<div class="row">
			<div id="primary" >
				<?php
				while ( have_posts() ) : the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>

					    <div class="entry-content description clearfix">
						    <?php the_content( __( 'Read more', 'arcade') ); ?>
					    </div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
					<?php
				endwhile;
				?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>