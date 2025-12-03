<?php global $block_count; ?>

<?php $content_vert_align = get_sub_field('content_vert_align'); ?>
<?php $left_column_full_bleed_toggle = get_sub_field('left_column_full_bleed_toggle'); ?>
<?php $left_column_text_alignment_toggle = get_sub_field('left_column_text_alignment_toggle'); ?>
<?php $left_column_bg_color = get_sub_field('left_column_bg_color_toggle'); ?>
<?php $left_column_text_color = get_sub_field('left_column_text_color_toggle'); ?>
<?php $left_column_image_left_id = get_sub_field('left_column_image_left'); ?>
<?php $left_column_image_left_src = wp_get_attachment_image_src( $left_column_image_left_id, 'full' ); ?>
<?php $left_column_image_right_id = get_sub_field('left_column_image_right'); ?>
<?php $left_column_image_right_src = wp_get_attachment_image_src( $left_column_image_right_id, 'full' ); ?>
<?php $left_column_content = get_sub_field('left_column_content'); ?>
<?php $right_column_full_bleed_toggle = get_sub_field('right_column_full_bleed_toggle'); ?>
<?php $right_column_text_alignment_toggle = get_sub_field('right_column_text_alignment_toggle'); ?>
<?php $right_column_bg_color = get_sub_field('right_column_bg_color_toggle'); ?>
<?php $right_column_text_color = get_sub_field('right_column_text_color_toggle'); ?>
<?php $right_column_image_left_id = get_sub_field('right_column_image_left'); ?>
<?php $right_column_image_left_src = wp_get_attachment_image_src( $right_column_image_left_id, 'full' ); ?>
<?php $right_column_image_right_id = get_sub_field('right_column_image_right'); ?>
<?php $right_column_image_right_src = wp_get_attachment_image_src( $right_column_image_right_id, 'full' ); ?>
<?php $right_column_content = get_sub_field('right_column_content'); ?>

<section id="block-<?php echo $block_count; ?>" class="half-width">
	<div class="columns">
		<div class="block-left lazy slide-in-left background-<?php echo $left_column_bg_color; ?> text-<?php echo $left_column_text_color; ?><?php if($left_column_full_bleed_toggle) { echo ' ' . $left_column_full_bleed_toggle; } ?><?php if($left_column_text_alignment_toggle) { echo ' ' . $left_column_text_alignment_toggle; } ?><?php if($content_vert_align) { echo ' ' . $content_vert_align; } ?>">
			<div class="column-images">
				<?php if($left_column_image_left_src) { ?>
					<div class="column-image left" style="background-image: url(<?php echo $left_column_image_left_src[0]; ?>);"></div>
				<?php } ?>
				<?php if($left_column_image_right_src) { ?>
					<div class="column-image right" style="background-image: url(<?php echo $left_column_image_right_src[0]; ?>);"></div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<?php if($left_column_content) { ?>
				<div class="block-content">
					<?php echo $left_column_content; ?>
				</div>
			<?php } ?>
		</div>
		<div class="block-right lazy slide-in-right delay-one-quarter background-<?php echo $right_column_bg_color; ?> text-<?php echo $right_column_text_color; ?><?php if($right_column_full_bleed_toggle) { echo ' ' . $right_column_full_bleed_toggle; } ?><?php if($right_column_text_alignment_toggle) { echo ' ' . $right_column_text_alignment_toggle; } ?><?php if($content_vert_align) { echo ' ' . $content_vert_align; } ?>">
			<div class="column-images">
				<?php if($right_column_image_left_src) { ?>
					<div class="column-image left" style="background-image: url(<?php echo $right_column_image_left_src[0]; ?>);"></div>
				<?php } ?>
				<?php if($right_column_image_right_src) { ?>
					<div class="column-image right" style="background-image: url(<?php echo $right_column_image_right_src[0]; ?>);"></div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<?php if($right_column_content) { ?>
				<div class="block-content">
					<?php echo $right_column_content; ?>
				</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<?php if(have_rows('buttons')) { ?>
		<div class="button-container">
			<?php while(have_rows('buttons')) { ?>
				<?php the_row(); ?>
				<?php $button_link = get_sub_field('button')['url']; ?>
				<?php $button_text = get_sub_field('button')['title']; ?>
				<?php $button_target = get_sub_field('button')['target']; ?>
				<button class="primary">
					<a href="<?php echo $button_link; ?>" target="<?php echo $button_target; ?>">
						<?php echo $button_text; ?>
					</a>
			</button>
			<?php } ?>
		</div>
	<?php } ?>
</section>