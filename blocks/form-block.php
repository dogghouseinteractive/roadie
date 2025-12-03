<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $content_width_toggle = get_sub_field('content_width_toggle'); ?>
<?php $block_heading = get_sub_field('block_heading'); ?>
<?php $block_subheading = get_sub_field('block_sub_heading'); ?>
<?php $block_content = get_sub_field('block_content'); ?>
<?php $content_position = get_sub_field('content_position_toggle'); ?>
<?php $content_alignment = get_sub_field('content_alignment_toggle'); ?>
<?php $form_heading = get_sub_field('form_heading'); ?>
<?php $form_position = get_sub_field('form_position_toggle'); ?>
<?php $form_id = get_sub_field('form'); ?>
<?php $form_image = get_sub_field('form_image'); ?>

<section id="block-<?php echo $block_count; ?>" class="form-block<?php if($bg_color) { ?> background-<?php echo $bg_color; ?><?php } ?><?php if($text_color) { ?> text-<?php echo $text_color; ?><?php } ?><?php if($content_position) { ?> <?php echo $content_position; ?><?php } ?><?php if($form_position) { ?> form-<?php echo $form_position; ?><?php } ?><?php if($content_alignment) { echo ' ' . $content_alignment; } ?><?php if($content_width_toggle) { echo ' content-' . $content_width_toggle; } ?>" style="<?php if($bg_image) { ?>background-image: url(<?php echo wp_get_attachment_image_src( $bg_image, 'featured_image' )[0]; ?>)<?php } ?>;">
	<?php $slide_count = 0; ?>
	<?php if(have_rows('images')) { ?>
		<ul class="slider">
		<?php while(have_rows('images')) { ?>
			<?php the_row('images'); ?>
			<li class="slide">
				<?php $image_id = get_sub_field('image'); ?>
				<?php $image_src = wp_get_attachment_image_src( $image_id, 'form_block_image' ); ?>
				<div class="slide-image" style="background-image: url(<?php echo $image_src[0]; ?>);"></div>
			</li> <!-- .slide -->
			<?php $slide_count++; ?>
    	<?php } ?>
		</ul>
	<?php } ?>
	<?php if($slide_count > 1) { ?>
		<div class="block-<?php echo $block_count; ?>-slider-prev"></div>
		<div class="block-<?php echo $block_count; ?>-slider-next"></div>
	<?php } ?>
	<div class="form-content-holder">
		<div class="form-content-container">
			<div class="form-block-content">
				<?php if($block_subheading) { ?>
					<h3><?php echo $block_subheading; ?></h3>
				<?php } ?>
				<?php if($block_heading) { ?>
					<h1><?php echo $block_heading; ?></h1>
				<?php } ?>
				<?php if($block_content) { ?>
					<?php echo $block_content; ?>
				<?php } ?>
			</div>
		<?php if($form_position == 'beside-content') { ?>
			</div> <!-- .form-content-container -->
		<?php } ?>
		<?php if($form_id) { ?>
			<div class="form-container<?php if($form_image) { ?> has-image<?php } ?>">
				<?php if($form_heading) { ?>
					<h2><?php echo $form_heading; ?></h2>
				<?php } ?>
				<?php echo do_shortcode('[gravityform id="'.$form_id.'" title="false" description="false" ajax="true"]'); ?>
			</div>
			<?php if($form_position == 'beside-content' && $form_image) { ?>
				<div class="form-image" style="background-image: url(<?php echo wp_get_attachment_image_src( $form_image, 'full' )[0] ?>);"></div>
			<?php } ?>
		<?php } ?>
		<?php if($form_position != 'beside-content') { ?>
				<div class="clear"></div>
			</div> <!-- .form-content-container -->
		<?php } ?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#block-<?php echo $block_count; ?>.form-block .slider').cycle({
				timeout: 0,
				slides: '.slide',
				prev: '.block-<?php echo $block_count; ?>-slider-prev',
				next: '.block-<?php echo $block_count; ?>-slider-next',
			});
		});
		jQuery(document).on('cycle-initialized', function() {
			jQuery('.block-<?php echo $block_count; ?>-slider-prev, .block-<?php echo $block_count; ?>-slider-next').fadeIn(250);
		});
	</script>
</section>