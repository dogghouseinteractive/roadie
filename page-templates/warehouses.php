<?php
/**
 * Template Name: Warehouses
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<?php while(have_posts()) { ?>
		<?php the_post(); ?>
		<?php get_template_part('blocks/flexible-content'); ?>
	<?php } ?>
</main><!-- #main -->

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.locate-me').on('click', function() {
            alert('You have reset the filters');
            FWP.reset();
        });
    });
</script>

<?php get_footer();
