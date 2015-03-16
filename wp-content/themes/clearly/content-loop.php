<?php
/**
 * Displays 
 * 
 * @package clearly
 * @since clearly 1.0
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('loop-entry'); ?>>
	<header class="entry-header">
		<?php if(has_post_thumbnail()) : ?>
			<div class="thumbnail">
				<div class="post-actions">
					<a href="http://twitter.com/intent/tweet?url=<?php echo esc_attr(get_permalink()) ?>" class="twitter"><div class="clearly-icon-twitter-square"></div></a>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo esc_attr(get_permalink()) ?>" class="facebook"><div class="clearly-icon-facebook-square"></div></a>
					<a href="https://plus.google.com/share?url=<?php echo esc_attr(get_permalink()) ?>" class="google"><div class="clearly-icon-google-plus-square"></div></a>

					<a href="#" class="post-format standard"></a>
				</div>

				<a href="<?php the_permalink() ?>" title="<?php esc_attr( get_the_title() ) ?>">
					<?php if( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
				</a>
			</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-meta">
		<?php $category_list = get_the_category_list( __( ', ', 'clearly' ) ); ?>
		<ul>
			<li class="date"><a href="<?php the_permalink() ?>"><?php echo get_the_date() ?></a></li>
			<li class="comments"><?php comments_number( __('No Comments', 'clearly'), __('One Comment', 'clearly'), __('% Comments', 'clearly') ); ?></li>
			<?php if(clearly_categorized_blog() && !empty($category_list)) : ?>
				<li class="categories"><?php echo $category_list ?></li>
			<?php endif ?>
		</ul>
	</div>

	<div class="entry-summary">
		<h1 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
