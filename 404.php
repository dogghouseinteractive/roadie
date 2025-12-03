<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
				<h1>404: Not Found</h1>
			</div>
		</section>
		
		<div class="container">
			<section id="block-1" class="posts-container">						
				<h2><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'dogghouse_fct' ); ?></h2>
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
				<div class="clear"></div>
			</section>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
