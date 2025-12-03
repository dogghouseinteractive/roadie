<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $bg_repeat = get_sub_field('background_repeat'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $text_alignment = get_sub_field('text_alignment_toggle'); ?>
<?php $banner_icon = get_sub_field('banner_icon'); ?>
<?php $banner_content = get_sub_field('banner_content'); ?>

<section id="block-<?php echo $block_count; ?>" class="banner-divider lazy fade-in slow background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($text_alignment) { echo ' ' . $text_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full')[0]; ?>); background-repeat: <?php echo $bg_repeat; ?>"<?php } ?>>
	<?php if($banner_content) { ?>
		<div class="container">
			<div class="block-content lazy zoom-in<?php if($banner_icon != 'no-icon') { ?> has-icon<?php } ?>">
				<?php if($banner_content) { ?>
					<div class="banner-content <?php echo $banner_icon; ?>">
						<?php echo $banner_content; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</section>