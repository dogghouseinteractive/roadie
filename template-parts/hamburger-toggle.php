<div id="hamburger-toggle-menu">
	<div id="hamburger-logo">
		<a href="<?php echo home_url(); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-hamburger.png">
		</a>
	</div>
	<div class="container">
		<?php if ( has_nav_menu( 'hamburger' ) ) {
			wp_nav_menu( array( 'theme_location' => 'hamburger', 'menu_class' => 'menu-toggle-container', 'menu_id' => 'toggle-nav' ) ); 
		} else { ?>
			<nav id="toggle-nav">
				<div class="menu-toggle-container">
					<ul>
						<li><a href="<?php echo home_url(); ?>">Home</a></li>
					</ul>
				</div>
			</nav>
		<?php } ?>
		<div class="hamburger-footer">
			<?php if(is_active_sidebar('sidebar-1')) { ?>
				<div class="footer-widget-area">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			<?php } ?>
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
		</div>
	</div><!-- .container -->
</div>