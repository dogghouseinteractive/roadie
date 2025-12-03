<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $content_position = get_sub_field('content_position_toggle'); ?>
<?php $content_alignment = get_sub_field('content_alignment_toggle'); ?>
<?php $content = get_sub_field('content'); ?>
<?php $column_a_heading = get_sub_field('column_a_heading'); ?>
<?php $column_b_heading = get_sub_field('column_b_heading'); ?>

<section id="block-<?php echo $block_count; ?>" class="comparison-table-block background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($content_position) { ?> <?php echo $content_position; ?><?php } ?><?php if($content_alignment) { echo ' ' . $content_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);"<?php } ?>>
	<div class="container">
		<div class="block-content lazy fade-in">
			<?php if($content) { ?>
				<?php echo $content; ?>
			<?php } ?>
		</div>
		<div class="comparison-table lazy fade-in delay-one-quarter">
			<div class="tr">
				<?php if($column_a_heading) { ?>
					<div class="th">&nbsp;</div>
					<div class="th" style="text-align: center; font-size: 20px;"> 
						<?php echo $column_a_heading; ?>
					</div>
				<?php } ?>
				<?php if($column_b_heading) { ?>
					<div class="th" style="text-align: center; font-size: 20px;">
						<?php echo $column_b_heading; ?>
					</div>
				<?php } ?>
			</div>
			<?php if(have_rows('comparison_items')) { ?>
				<?php while(have_rows('comparison_items')) { ?>
					<?php the_row(); ?>
					<?php $comparison_item = get_sub_field('comparison_item'); ?>
					<?php $comparison_a = get_sub_field('comparison_a'); ?>
					<?php $comparison_b = get_sub_field('comparison_b'); ?>
					<div class="tr" style="font-size: 15px;">
						<div class="td">
							<?php echo $comparison_item; ?>
						</div>
						<div class="td" style="text-align: center;">
							<?php if($comparison_a == 'true') { ?>
								<i class="fas fa-check"></i>
							<?php } else { ?>
								<i class="fas fa-times"></i>
							<?php } ?>
						</div>
						<div class="td" style="text-align: center;">
							<?php if($comparison_b == 'true') { ?>
								<i class="fas fa-check"></i>
							<?php } else { ?>
								<i class="fas fa-times"></i>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</section>