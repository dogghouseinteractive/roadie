<?php global $block_count; ?>

<?php $bg_color = get_sub_field('background_color_toggle'); ?>
<?php $bg_image = get_sub_field('background_image'); ?>
<?php $text_color = get_sub_field('text_color_toggle'); ?>
<?php $text_alignment = get_sub_field('text_alignment_toggle'); ?>
<?php $block_heading = get_sub_field('block_heading'); ?>
<?php $content = get_sub_field('block_intro_content'); ?>
<?php $button = get_sub_field('button'); ?>

<section id="block-<?php echo $block_count; ?>" class="carousel-block background-<?php echo $bg_color; ?> text-<?php echo $text_color; ?><?php if($bg_image) { ?> has-background-image<?php } ?><?php if($text_alignment) { echo ' ' . $text_alignment; } ?>"<?php if($bg_image) { ?> style="background-image: url(<?php echo wp_get_attachment_image_src($bg_image, 'full_hd')[0]; ?>);"<?php } ?>>
	<div class="container">
		<div class="block-content">
			<?php if($block_heading) { ?>
				<h2><?php echo $block_heading; ?></h2>
			<?php } ?>
			<?php if($content) { ?>
				<div class="lazy fade-in"><?php echo $content; ?></div>
			<?php } ?>
		</div>
		<?php if(have_rows('logo_carousel')) { ?>
<!--
			<div id="logos" class="cycle-slideshow" data-cycle-fx=carousel data-cycle-slides="> .logo" data-cycle-timeout=0 data-cycle-carousel-visible=4 data-cycle-carousel-fluid=true data-cycle-next="#block-<?php //echo $block_count; ?>-next"
    data-cycle-prev="#block-<?php //echo $block_count; ?>-prev">
-->
			<div id="logos" class="cycle-slideshow">
				<?php while(have_rows('logo_carousel')) { ?>
					<?php the_row(); ?>
					<?php $logo = get_sub_field('logo'); ?>
					<?php $logo_link = get_sub_field('logo_link'); ?>
					<?php $logo_content = get_sub_field('logo_content'); ?>
					<div class="logo">
						<?php if($logo_link) { ?>
							<a href="<?php echo $logo_link['url']; ?>" target="<?php echo $logo_link['target']; ?>"><?php echo $logo_link['text']; ?>
						<?php } ?>
						<?php if($logo) { ?>
							<div class="carousel-image" style="background-image: url(<?php echo $logo; ?>);"></div>
						<?php } ?>
						<?php if($logo_content) { ?>
								<p><?php echo $logo_content; ?></p>
						<?php } ?>
						<?php if($logo_link) { ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<div id="block-<?php echo $block_count; ?>-prev" class="carousel-nav prev"><i class="ion-chevron-left"></i></div>
				<div id="block-<?php echo $block_count; ?>-next" class="carousel-nav next"><i class="ion-chevron-right"></i></div>
			</div>
		<?php } ?>
		<?php if($button) { ?>
			<button class="primary"><a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a></button>
		<?php } ?>	
	</div>
</section>

<?php $logos = 0;
$repeater = get_sub_field('logo_carousel');
if (!empty($repeater)) {
  $logos = count($repeater);
} ?>

<script type="text/javascript">
	function reinit_cycle() {
		var carousel = jQuery('#block-' + <?php echo $block_count; ?> + '.carousel-block #logos');
		var width = jQuery(window).width();
	 if ( width >= 1024 ) {
			<?php if($logos <= 3) { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').hide();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').hide();
			<?php } else { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').show();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').show();
			<?php } ?>
			carousel.cycle('destroy');
			carousel.cycle({
				fx: 'carousel',
				timeout: 0,
				slides: '> .logo',
				carouselFluid: true,
				carouselVisible: 3,
				next: '#block-' + <?php //echo $block_count; ?> + '-next',
				prev: '#block-' + <?php //echo $block_count; ?> + '-prev',
			});
		} else if ( width >= 768 && width < 1024 ) {
			<?php if($logos <= 2) { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').hide();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').hide();
			<?php } else { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').show();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').show();
			<?php } ?>
			carousel.cycle('destroy');
			carousel.cycle({
				fx: 'carousel',
				timeout: 0,
				slides: '> .logo',
				carouselFluid: true,
				carouselVisible: 2,
				next: '#block-' + <?php echo $block_count; ?> + '-next',
				prev: '#block-' + <?php echo $block_count; ?> + '-prev',
			});
		} else {
			<?php if($logos <= 1) { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').hide();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').hide();
			<?php } else { ?>
				jQuery('#block-' + <?php echo $block_count; ?> + '-next').show();
				jQuery('#block-' + <?php echo $block_count; ?> + '-prev').show();
			<?php } ?>
			carousel.cycle('destroy');
			carousel.cycle({
				fx: 'carousel',
				timeout: 0,
				slides: '> .logo',
				carouselFluid: true,
				carouselVisible: 1,
				next: '#block-' + <?php echo $block_count; ?> + '-next',
				prev: '#block-' + <?php echo $block_count; ?> + '-prev',
			});
		}
  }
//	jQuery(document).ready(function() {
//		reinit_cycle();
//	});
//	jQuery(window).on('resize', function() {
//		setTimeout(function() {
//			reinit_cycle();	
//		}, 100);
//	});
</script>