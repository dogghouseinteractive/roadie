<?php global $block_count; ?>

<section id="block-<?php echo $block_count; ?>" class="warehouse-finder">
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

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.locate-me').on('click', function() {
            alert('You have reset the filters');
            FWP.reset();
        });
    });
</script>