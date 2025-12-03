<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $content_alignment = get_sub_field('content_alignment_toggle'); ?>
<?php $content = get_sub_field('content'); ?>
<?php $image = get_sub_field('image'); ?>
<?php $layout = get_sub_field('layout_toggle'); ?>
<?php $content_position = get_sub_field('content_position_toggle'); ?>

<section id="block-<?php echo $block_count; ?>" class="accordions-block background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($layout) { ?> <?php echo $layout; ?><?php } ?><?php if($content_position) { ?> <?php echo $content_position; ?><?php } ?><?php if($content_alignment) { echo ' ' . $content_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);"<?php } ?>>
	<?php if(have_rows('accordions')) { ?>
		<div class="accordions">
			<?php if($content) { ?>
				<div class="accordion-block-content lazy fade-in">
					<?php echo $content; ?>	
				</div>
			<?php } ?>
			<?php $lazy = ''; ?>
			<?php while(have_rows('accordions')) { ?>
				<?php the_row(); ?>
				<div class="accordion<?php if(get_row_index() == 1) { echo ' active'; } ?>">
					<?php $accordion_heading = get_sub_field('accordion_heading'); ?>
					<?php $accordion_content = get_sub_field('accordion_content'); ?>
					<?php $accordion_image = get_sub_field('accordion_image'); ?>
					<?php if(get_row_index() == 1) { ?>
						<?php $delay = 'delay-one-quarter'; ?>
					<?php } else if(get_row_index() == 2) { ?>
						<?php $delay = 'delay-one-half'; ?>
					<?php } else if(get_row_index() == 3) { ?>
						<?php $delay = 'delay-three-quarters'; ?>
					<?php } ?>
					<?php if($accordion_image) { ?>
						<div class="accordion-image lazy<?php if($layout == 'accordions-left') { echo ' fade-in-right'; } else { echo ' fade-in-left'; } ?>" style="background-image: url(<?php echo wp_get_attachment_image_src($accordion_image, 'full_hd')[0]; ?>);"></div>
					<?php } ?>
					<div class="block-content lazy fade-in <?php echo $delay; ?>">
						<h2 class="accordion-heading"><?php echo $accordion_heading; ?></h2>
						<div class="accordion-content"><?php echo $accordion_content; ?></div>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	<?php } ?>
	<div class="clear"></div>
</section>