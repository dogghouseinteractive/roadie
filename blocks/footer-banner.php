<?php $footer_banner_heading = get_sub_field('footer_banner_heading'); ?>
<?php $footer_banner_button = get_sub_field('footer_banner_button'); ?>
<div id="footer-banner" class="background-secondary text-white">
	<div class="container narrow">
		<?php if($footer_banner_heading) { ?>
			<h2 class="lazy fade-in-left"><?php echo $footer_banner_heading; ?></h2>
		<?php } ?>
		<?php if($footer_banner_button) { ?>
			<button class="primary lazy fade-in-right">
				<a href="<?php echo $footer_banner_button['url']; ?>"><?php echo $footer_banner_button['title']; ?></a>
			</button>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div>