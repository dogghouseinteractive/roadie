<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $layout_toggle = get_sub_field('layout_toggle'); ?>
<?php $full_bleed_toggle = get_sub_field('full_bleed_toggle'); ?>
<?php $content_width_toggle = get_sub_field('content_width_toggle'); ?>
<?php $image_id = get_sub_field('image'); ?>
<?php $image_src = wp_get_attachment_image_src( $image_id, 'full' ); ?>
<?php $sub_heading = get_sub_field('sub-heading'); ?>
<?php $heading = get_sub_field('heading'); ?>
<?php $content = get_sub_field('content'); ?>

<section id="block-<?php echo $block_count; ?>" class="image-and-content background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?> <?php echo $layout_toggle; ?><?php if($full_bleed_toggle == 'full-bleed') { echo ' full-bleed'; }?><?php if($content_width_toggle) { echo ' content-' . $content_width_toggle; } ?>">
	<?php if($full_bleed_toggle == 'contained') { ?>
		<div class="container">
	<?php } ?>
		<div class="block-image lazy<?php if($full_bleed_toggle == ' full-bleed') { echo ' full-bleed'; }?><?php if($layout_toggle == 'image-left') { echo ' slide-in-left'; } else { echo ' slide-in-right'; } ?>" style="background-image: url(<?php if($image_src) { echo $image_src[0]; } else { ?><?php if($full_bleed_toggle 
		!= 'full-bleed') { ?>https://placehold.co/1280x640<?php } else { ?>https://placehold.co/1280x1125<?php } ?><?php } ?>);"></div>
		<?php if($full_bleed_toggle == 'full-bleed') { ?>
			<div class="container">
		<?php } ?>
			<div class="block-content lazy delay-one-quarter fade-in">
				<?php if($sub_heading) { ?>
					<h3><?php echo $sub_heading; ?></h3>
				<?php } ?>
				<?php if($heading) { ?>
					<h2><?php echo $heading; ?></h2>
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