<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="post-header">
			<div class="container">
				<div class="breadcrumbs">
					<a href="/blog"><i class="fas fa-long-arrow-alt-left"></i> Back to All Posts</a>
				</div>
			</div>
		</section>
		<section class="post-content">
			<div class="container">
<!--
				<section class="breadcrumbs">
					<?php //if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</section>
-->
				<?php while ( have_posts() ) {
					the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="post-title"><?php echo get_the_title(); ?></h1>
						<p class="byline">by <?php echo get_the_author_meta('display_name'); ?></p>
						<?php if(has_post_thumbnail()) { ?>
							<?php $featured_image = get_the_post_thumbnail_url(); ?>
						<?php } else { ?>
							<?php $featured_image = get_field('blog_fallback_image', 'option'); ?>
						<?php } ?>
						<?php if($featured_image) { ?>
							<div class="post-featured-image" style="background-image: url(<?php echo $featured_image; ?>);"></div>
						<?php } ?>
						<?php the_content(); ?>
					</article><!-- #post-## -->
				<?php } ?>
				<?php get_sidebar('blog'); ?>
				<div class="clear"></div>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
