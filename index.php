<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		<?php $bg_color = get_field('background_color_toggle', 'option'); ?>
		<?php $bg_image = get_field('background_image', 'option'); ?>
		<?php $text_color = get_field('text_color_toggle', 'option'); ?>
		<?php $layout_toggle = get_field('layout_toggle', 'option'); ?>
		<?php $full_bleed_toggle = get_field('full_bleed_toggle', 'option'); ?>
		<?php if($full_bleed_toggle == 'full-bleed') { ?>
			<?php $fallback_image = 'https://placehold.co/1280x1125'; ?>
		<?php } else { ?>
			<?php $fallback_image = 'https://placehold.co/1280x640'; ?>
		<?php } ?>
		<?php $image_id = get_field('header_block_image', 'option'); ?>
		<?php $image_src = wp_get_attachment_image_src( $image_id, 'full' ); ?>
		<?php $sub_heading = get_field('header_block_sub-heading', 'option'); ?>
		<?php $heading = get_field('header_block_heading', 'option'); ?>
		<?php $content = get_field('header_block_content', 'option'); ?>
		<section id="block-1" class="image-and-content background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?> <?php echo $layout_toggle; ?><?php if($full_bleed_toggle == 'full-bleed') { echo ' full-bleed'; }?>">
			<?php if($full_bleed_toggle == 'contained') { ?>
				<div class="container">
			<?php } ?>
				<div class="block-image lazy<?php if($full_bleed_toggle == ' full-bleed') { echo ' full-bleed'; }?><?php if($layout_toggle == 'image-left') { echo ' slide-in-left'; } else { echo ' slide-in-right'; } ?>" style="background-image: url(<?php if($image_src) { echo $image_src[0]; } else { echo $fallback_image; } ?>);"></div>
				<?php if($full_bleed_toggle == 'full-bleed') { ?>
					<div class="container">
				<?php } ?>
					<div class="block-content lazy delay-one-quarter fade-in">
						<?php if($sub_heading) { ?>
							<h3><?php echo $sub_heading; ?></h3>
						<?php } ?>
						<?php if($heading) { ?>
							<h1><?php echo $heading; ?></h1>
						<?php } ?>
						<?php if($content) { ?>
							<?php echo $content; ?>
						<?php } ?>
					</div>
					<div class="clear"></div>
				<?php if($full_bleed_toggle == 'full-bleed') { ?>
					</div>
				<?php } ?>
			<?php if($full_bleed_toggle == 'contained') { ?>
				</div>
			<?php } ?>
		</section>
		<div class="post-content">
			<div class="container">
				<!-- <section class="breadcrumbs">
					<?php //if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</section> -->
				<section id="block-2" class="posts-container">
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
							'prev_text' => __( 'Previous page', 'dogghouse_fct' ),
							'next_text' => __( 'Next page', 'dogghouse_fct' ),
							'before_page_number' => __( 'Page ', 'dogghouse_fct' ),
						) );

					} ?>
					<div class="clear"></div>
				</section>
				<?php get_sidebar('blog'); ?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
