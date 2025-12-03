<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
				<h1><?php echo single_cat_title(); ?></h1>
			</div>
		</section>
		
		<div class="container">
<!--
			<section class="breadcrumbs">
				<?php //if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
			</section>
-->
			<section id="block-1" class="posts-container">
				<?php if ( have_posts() ) { ?>
					<div class="posts-grid">
					<?php while ( have_posts() ) { 
						the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if(has_post_thumbnail()) { ?>
								<div class="post-featured-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
							<?php } else { ?>
								<div class="post-featured-image" style="background-image: url(<?php echo get_field('blog_fallback_image', 'option'); ?>);"></div>
							<?php } ?>
							<a href="<?php echo get_permalink(); ?>">
								<h2><?php echo get_the_title(); ?></h2>	
							</a>
							<div class="post-excerpt">
								<?php the_excerpt(); ?>
							</div>
							<a class="blog-link" href="<?php echo get_permalink(); ?>">Read the Article</a>
						</article>
				
					<?php } ?>
						
					</div>
				
					<?php the_posts_pagination( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'dogghouse_fct' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'dogghouse_fct' ) . '</span>',
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dogghouse_fct' ) . ' </span>',
					) );

				} else {

					echo 'No posts found.';

				} ?>
				<div class="clear"></div>
			</section>
			<?php get_sidebar('blog'); ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
