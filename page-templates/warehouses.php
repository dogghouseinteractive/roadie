<?php
/**
 * Template Name: Warehouses
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<?php while(have_posts()) { ?>
		<?php the_post(); ?>
		<?php get_template_part('blocks/flexible-content'); ?>
        
        <section class="warehouse-finder">
             <div class="warehouse-proximity mobile">
                <?php echo do_shortcode('[facetwp facet="proximity"]'); ?>
            </div>
            <div class="warehouse-map">
                <?php echo do_shortcode('[facetwp facet="warehouse_map"]'); ?>
            </div>
            <div class="map-filters">
                <div class="warehouse-proximity desktop">
                    <?php echo do_shortcode('[facetwp facet="proximity"]'); ?>
                </div>
                <div class="warehouse-listings">
                    <?php echo do_shortcode('[facetwp template="warehouses"]'); ?>
                </div>
            </div>
        </section>
        
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
