<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $text_alignment = get_sub_field('text_alignment_toggle'); ?>
<?php $layout = get_sub_field('layout_toggle'); ?>
<?php $heading = get_sub_field('heading'); ?>
<?php $subheading = get_sub_field('sub-heading'); ?>
<?php $content = get_sub_field('content'); ?>

<section id="block-<?php echo $block_count; ?>" class="icons-and-content background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($layout) { ?> <?php echo $layout; ?><?php } ?><?php if($text_alignment) { echo ' ' . $text_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);"<?php } ?>>
	<div class="container">
		<div class="block-content lazy fade-in">
			<div class="block-content-container">
				<?php if($subheading) { ?>
					<h3><?php echo $subheading; ?></h3>
				<?php } ?>
				<?php if($heading) { ?>
					<h2><?php echo $heading; ?></h2>
				<?php } ?>
				<?php if($content) { ?>
					<?php echo $content; ?>
				<?php } ?>
			</div>
		</div>
		<div class="icons-container">
			<?php if(have_rows('icon_columns')) { ?>
				<div class="icon-columns">
					<?php $delay = ''; ?>
					<?php while(have_rows('icon_columns')) { ?>
						<?php the_row(); ?>
						<?php $icon = get_sub_field('icon'); ?>
						<?php $icon_content = get_sub_field('icon_content'); ?>
						<?php $icon_link = get_sub_field('icon_link'); ?>
						<?php if(get_row_index() == 1) { ?>
							<?php $delay = 'delay-one-quarter'; ?>
						<?php } else if(get_row_index() == 2) { ?>
							<?php $delay = 'delay-one-half'; ?>
						<?php } else if(get_row_index() == 3) { ?>
							<?php $delay = 'delay-three-quarters'; ?>
						<?php } ?>
						<div class="icon-column lazy fade-in <?php if($delay) { echo $delay; } ?>">
							<?php if($icon) { ?>
								<div class="icon">
									<?php if($icon_link) { ?>
										<a href="<?php echo $icon_link['url']; ?>">
									<?php } ?>
										<img src="<?php echo $icon; ?>">
									<?php if($icon_link) { ?>
										</a>		
									<?php } ?>
								</div>
							<?php } ?>
							<?php if($icon_content) { ?>
								<div class="icon-content">
									<?php echo $icon_content; ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</section>