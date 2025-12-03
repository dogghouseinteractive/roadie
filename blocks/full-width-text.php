<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $text_alignment = get_sub_field('text_alignment_toggle'); ?>
<?php $padding_top_amount = get_sub_field('padding_top_amount'); ?>
<?php $padding_top_units = get_sub_field('padding_top_units'); ?>
<?php $padding_top = '' ?>
<?php if($padding_top_amount && $padding_top_units) {
	$padding_top = $padding_top_amount . $padding_top_units;
} else if($padding_top_amount === 0) { 
	$padding_top = '6em';
} ?>
<?php $padding_bottom = '' ?>
<?php $padding_bottom_amount = get_sub_field('padding_bottom_amount'); ?>
<?php $padding_bottom_units = get_sub_field('padding_bottom_units'); ?>
<?php if($padding_bottom_amount && $padding_bottom_units) {
	$padding_bottom = $padding_bottom_amount . $padding_bottom_units;
} else { 
	$padding_bottom = '6em';
} ?>
<?php $timeline_toggle = get_sub_field('timeline_toggle'); ?>
<?php $content_below_timeline = get_sub_field('content_below_timeline'); ?>
<?php $content = get_sub_field('content'); ?>

<section id="block-<?php echo $block_count; ?>" class="full-width-text background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($timeline_toggle == 'true') { ?> has-timeline<?php } ?><?php if($text_alignment) { echo ' ' . $text_alignment; } ?>" style="<?php if($bg_image) { ?>background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);<?php } ?><?php if($padding_top) { echo 'padding-top: ' . $padding_top . ';'; } ?><?php if($padding_bottom) { echo 'padding-bottom: ' . $padding_bottom . ';'; } ?>">
	<div class="container">
		<div class="block-content">
			<div class="lazy fade-in"><?php echo $content; ?></div>
			<?php if(!empty(get_sub_field('timeline_items'))) { ?>
				<?php $count = count(get_sub_field('timeline_items')); ?>
			<?php } ?>
			<?php if(have_rows('timeline_items')) { ?>
				<ol class="timeline-items count-<?php echo $count; ?>">
				<?php $delay = ''; ?>
				<?php while(have_rows('timeline_items')) { ?>
					<?php the_row(); ?>
						<?php if(get_row_index() == 1) { ?>
							<?php $delay = 'delay-one-quarter'; ?>
						<?php } else if(get_row_index() == 2) { ?>
							<?php $delay = 'delay-one-half'; ?>
						<?php } else if(get_row_index() == 3) { ?>
							<?php $delay = 'delay-three-quarters'; ?>
						<?php } ?>
					<li class="timeline-item lazy zoom-in <?php echo $delay; ?>"><?php echo get_sub_field('timeline_item_content'); ?></li>
				<?php } ?>
				</ol>
			<?php } ?>
			<?php if($content_below_timeline) { ?>
				<div class="content-below-timeline">
					<div class="lazy fade-in"><?php echo $content_below_timeline; ?></div>
				</div>
			<?php } ?>
			<?php if(have_rows('buttons')) { ?>
				<div class="button-container">
					<?php $delay = ''; ?>
					<?php while(have_rows('buttons')) { ?>
						<?php if(get_row_index() == 1) { ?>
							<?php $delay = 'delay-one-quarter'; ?>
						<?php } else if(get_row_index() == 2) { ?>
							<?php $delay = 'delay-one-half'; ?>
						<?php } else if(get_row_index() == 3) { ?>
							<?php $delay = 'delay-three-quarters'; ?>
						<?php } ?>
						<?php the_row(); ?>
						<?php $button_type = get_sub_field('button_type'); ?>
						<?php $button_link = get_sub_field('button')['url']; ?>
						<?php $button_text = get_sub_field('button')['title']; ?>
						<?php $button_target = get_sub_field('button')['target']; ?>
						<button class="<?php echo $button_type; ?> lazy fade-in slow <?php echo $delay; ?>">
							<a class="button" href="<?php echo $button_link; ?>" target="<?php echo $button_target; ?>">
								<?php echo $button_text; ?>
							</a>
						</button>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>