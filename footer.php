<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<footer class="site-footer">
	<?php $footer_logo = get_field('footer_logo', 'option'); ?>
	<div id="footer-bottom">
		<div class="container">
			<div class="footer-left site-info">
				<div class="branding-info">
					<div class="footer-logo" style="background-image: url(<?php echo $footer_logo; ?>);">
						<a href="<?php echo home_url(); ?>"></a>
					</div>
				</div>
				<?php if ( has_nav_menu( 'footer' ) ) { ?>
					<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Nav Menu', 'dogghouse_fct' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer',
								'menu_class'     => 'footer-nav-menu',
								'depth'          => 1,
								'link_before'    => '',
								'link_after'     => '',
							) );
						?>
					</nav><!-- .footer nav -->
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="footer-right">
				<?php if(is_active_sidebar('sidebar-1')) { ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="clear"></div>
			<div class="footer-copyright-legal">
				<div class="copyright">
					<p>&copy;<?php echo date('Y'); ?> Roadie, Inc.</p>
				</div>
				<?php if ( has_nav_menu( 'legal' ) ) { ?>
					<nav class="legal-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Legal Menu', 'dogghouse_fct' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'legal',
								'menu_class'     => 'legal-nav-menu',
								'depth'          => 1,
								'link_before'    => '',
								'link_after'     => '',
							) );
						?>
					</nav><!-- .footer nav -->
				<?php } ?>
				<div class="clear"></div>
			</div>
			<?php echo do_shortcode("[autopilot_shortcode]")?>
		</div>
	</div>
</footer>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#menu-legal-menu-1').append('<li class="menu-item"><a class="optanon-toggle-display" href="javascript:;" onclick="Optanon.ToggleInfoDisplay();">Cookie Settings</a></li>'); 
	});
</script>
	
<?php wp_footer(); ?>
<div class="clear"></div>
</body>
</html>
