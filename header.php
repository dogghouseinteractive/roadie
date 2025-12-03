<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- OneTrust Cookies Consent Notice start for roadie.com -->

<script src="https://cdn.cookielaw.org/scripttemplates/otSDKStub.js"  type="text/javascript" charset="UTF-8" data-domain-script="018fca46-58b5-78d9-8526-7387c947b737" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- OneTrust Cookies Consent Notice end for roadie.com -->
<?php if(get_field('typekit_fonts_script', 'option')) { ?>
	<link rel="stylesheet" href="<?php echo get_field('typekit_fonts_script', 'option'); ?>" media="all" onload="this.media='all'; this.onload=null;">
<?php } ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TW74Z27');</script>
<!-- End Google Tag Manager -->
<!-- Hotjar Tracking Code for https://www.roadie.com/ -->
<script>
	(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
			h._hjSettings={hjid:698554,hjsv:6};
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TW74Z27"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<header class="site-header" role="banner">
		<div class="container">
			<?php $custom_logo = get_custom_logo(); ?>
			<div id="hamburger">
				<div class="top-bun fadeIn"></div>
				<div class="patty fadeIn"></div>
				<div class="bottom-bun fadeIn"></div>
			</div>
			<div id="logo">
				<?php if(!empty($custom_logo)) { 
					 echo $custom_logo;
				} else { ?>
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png">
					</a>
				<?php } ?>
			</div>
			<div id="primary-nav-container">
				<nav id="primary-nav">
					<?php if ( has_nav_menu( 'top' ) ) {
						wp_nav_menu( array( 'theme_location' => 'top', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); 
					} else { ?>
						<nav id="primary-nav">
							<div class="menu-primary-navigation-container">
								<ul>
									<li><a href="<?php echo home_url(); ?>">Home</a></li>
								</ul>
							</div>
						</nav>
					<?php } ?>
				</nav>
				<div class="clear"></div>
			</div> <!-- #primary-nav-container -->
			<div class="clear"></div>
		</div>
		<?php get_template_part('template-parts/hamburger', 'toggle'); ?>
	</header>