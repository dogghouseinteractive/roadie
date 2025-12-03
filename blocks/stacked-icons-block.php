<?php global $block_count; ?>

<?php $bg_image = get_sub_field('background_image'); ?>
<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $text_alignment = get_sub_field('text_alignment_toggle'); ?>
<?php $block_heading = get_sub_field('block_heading'); ?>
<?php $block_subheading = get_sub_field('block_subheading'); ?>
<?php $block_content = get_sub_field('block_content'); ?>
<?php $columns = get_sub_field('number_of_columns'); ?>
<?php $button = get_sub_field('button'); ?>


<section id="block-<?php echo $block_count; ?>" class="stacked-icons background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($text_alignment) { echo ' ' . $text_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);"<?php } ?>>
	<div class="container">
		<?php if($block_subheading || $block_heading || $block_content) { ?>
			<div class="block-content">
				<?php if($block_subheading) { ?>
					<h3><?php echo $block_subheading; ?></h3>
				<?php } ?>
				<?php if($block_heading) { ?>
					<h2><?php echo $block_heading; ?></h2>
				<?php } ?>
				<?php if($block_content) { ?>
					<?php echo $block_content; ?>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if(have_rows('icons')) { ?>
			<div id="icons" class="<?php echo $columns; ?>-columns">
				<?php while(have_rows('icons')) { ?>
					<?php the_row(); ?>
					<?php $icon = get_sub_field('icon'); ?>
					<?php $icon_src = wp_get_attachment_image_src($icon, 'full'); ?>
					<?php $icon_text = get_sub_field('icon_text'); ?>
					<?php $icon_link = get_sub_field('icon_link'); ?>
					<div class="icon">
						<?php if($icon_link) { ?>
							<div class="icon-link"><a href="<?php echo $icon_link['url']; ?>" target="<?php echo $icon_link['target']; ?>"></a></div>
						<?php } ?>
						<div class="icon-image" style="background-image: url(<?php echo $icon_src[0]; ?>);"></div>
						<div class="icon-text"><?php echo $icon_text; ?></div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if($button) { ?>
			<button class="primary">
				<a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
			</button>
		<?php } ?>
	</div>
</section>