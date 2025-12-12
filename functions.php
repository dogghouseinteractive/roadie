<?php
/**
 * Dogghouse FCT functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Dogghouse_FCT
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dogghouse_fct_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/dogghouse_fct
	 * If you're building a theme based on Dogghouse FCT, use a find and replace
	 * to change 'dogghouse_fct' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dogghouse_fct' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
    'driver' => __( 'Driver Menu', 'dogghouse_fct' ),
		'top'    => __( 'Top Menu', 'dogghouse_fct' ),
		'social' => __( 'Social Links Menu', 'dogghouse_fct' ),
		'footer' => __( 'Footer Menu', 'dogghouse_fct' ),
		'legal'  => __( 'Legal Menu', 'dogghouse_fct' ),
		'hamburger'  => __( 'Hamburger Menu', 'dogghouse_fct' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
add_action( 'after_setup_theme', 'dogghouse_fct_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dogghouse_fct_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'dogghouse_fct' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer, on the right.', 'dogghouse_fct' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'dogghouse_fct' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in the sidebar of your blog index and post pages.', 'dogghouse_fct' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dogghouse_fct_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Dogghouse FCT 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function dogghouse_fct_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dogghouse_fct' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'dogghouse_fct_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Dogghouse FCT 1.0
 */
function dogghouse_fct_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'dogghouse_fct_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dogghouse_fct_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'dogghouse_fct_pingback_header' );

if ( ! function_exists( 'dogghouse_fct_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function dogghouse_fct_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return '<span class="screen-reader-text">' . _x( 'Posted on', 'post date', 'dogghouse_fct' ) . '</span> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
}
endif;

if ( ! function_exists( 'dogghouse_fct_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function dogghouse_fct_edit_link() {

	$link = edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'dogghouse_fct' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	return $link;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function dogghouse_fct_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'dogghouse_fct-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Begin Custom Enqueues */
    
  /* jQuery Cycle2 */    
  wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/assets/js/jquery.cycle2.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Cycle2 Carousel */
  wp_enqueue_script ( 'cycle-carousel', get_template_directory_uri() . '/assets/js/jquery.cycle2.carousel.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery ImagesLoaded */
  wp_enqueue_script ( 'images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* jQuery Fancybox */
  wp_enqueue_script ( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_script ( 'fancybox-media', get_template_directory_uri() . '/assets/js/fancybox/src/js/media.js', array( 'jquery' ), date('YmdHis'), true );
  wp_enqueue_style( 'fancy-style', get_template_directory_uri() . '/assets/js/fancybox/dist/jquery.fancybox.min.css', array(), date('YmdHis') );
    
  /* jQuery Stellar Parallax */
  wp_enqueue_script ( 'stellar-parallax', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js' );
	
  /* jQuery Masonry */
   wp_enqueue_script ( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array( 'jquery' ), date('YmdHis'), true );
    
  /* Fonts on Fonts on Fonts */
  wp_enqueue_style ( 'font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome-5.15.4/css/all.min.css' );    
    
  wp_enqueue_style ( 'ion-icons', get_template_directory_uri() . '/assets/fonts/ionicons-2.0.1/css/ionicons.min.css' );  
  
  wp_enqueue_script( 'site-functions', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), date('YmdHis'), true );

  wp_enqueue_script('jquery-tabs', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery', 'jquery-ui-core') );
    
   wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css', array('jquery', 'jquery-ui-core') );
}
add_action( 'wp_enqueue_scripts', 'dogghouse_fct_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dogghouse_fct_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'dogghouse_fct_front_page_template' );

/** 
 * Set SASS color vars with colorpicker fields from the ACF Options page 
 */
//define('WP_SCSS_ALWAYS_RECOMPILE', true);

add_filter( 'wp_scss_variables','wp_scss_set_variables' );

function wp_scss_set_variables() {
  $primary = get_field( 'primary', 'option' ) ? : '#3F5563';
	$darkprimary = get_field('darkprimary', 'option') ? : '#004F50';
  $secondary = get_field( 'secondary', 'option' ) ? : '#3D403F';
	$tertiary = get_field( 'tertiary', 'option' ) ? : '#477982';
	$quaternary = get_field( 'quaternary', 'option' ) ? : '#477982';
	$quinary = get_field( 'quinary', 'option' ) ? : '#477982';
	$senary = get_field( 'senary', 'option' ) ? : '#477982';
	$darkgray = get_field( 'medgray', 'option' ) ? : '#3e4140';
	$medgray = get_field( 'darkgray', 'option' ) ? : '#B4B5B4';
	$lightgray = get_field( 'lightgray', 'option' ) ? : '#F6F6F6';
	
	$typekit_fonts_script = get_field('typekit_fonts_script', 'option') ? : 'url("'.get_template_directory_uri().'/style.css");';
	$typekit_font_headings = get_field( 'typekit_font_headings', 'option' ) ? : 'Georgia, serif';
	$typekit_font_main = get_field( 'typekit_font_main', 'option' ) ? : 'Arial, sans-serif';
	
	$google_fonts_script = get_field('google_fonts_script', 'option') ? : 'url("'.get_template_directory_uri().'/style.css");';
	$google_font_headings = get_field('google_font_headings', 'option') ? : $typekit_font_headings;
	$google_font_main = get_field('google_font_main', 'option') ? : $typekit_font_main;
	
	$mainfont = $google_font_main ? : $typekit_font_main;
	$headingfont = $google_font_headings ? : $typekit_font_headings;
    
	$variables = array(
		'primary' => $primary,
		'darkprimary' => $darkprimary,
		'secondary' => $secondary,
		'tertiary' => $tertiary,
		'quaternary' => $quaternary,
		'quinary' => $quinary,
		'senary' => $senary,
		'medgray' => $medgray,
		'darkgray' => $darkgray,
		'lightgray' => $lightgray,
		'import-google-fonts' => $google_fonts_script,
		'import-typekit-fonts' => $typekit_fonts_script,
		'mainfont' => $mainfont,
		'headingfont' => $headingfont,
	);
    return $variables;
}

/**
 * Create ACF Options Page for theme options
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/** 
 * Custom Image Sizes
 */

add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes() {
    /* New image size for HD images */
    add_image_size( 'full_hd', 1920, 1080, $crop = true );
		/* New image size for hero images */
    add_image_size( 'form_block_image', 1366, 1366, $crop = true );
    /* New image size for featured images */
    add_image_size( 'featured_image', 1920, 768, $crop = true );
    /* New image size for image & content blocks */
    add_image_size( 'image_content_block', 768, 615, $crop = true );
    /* New image size for half-width blocks */
    add_image_size( 'half_width_block', 768, 460, $crop = true );
}


/* Colorize the color selector buttons in ACF FCB's */
add_filter( 'acf/load_field/type=button_group', 'modify_color_buttons' );           
function modify_color_buttons( $field )                                              
{                          
	$primary = get_field( 'primary', 'option' ) ? : '#3F5563';
	$darkprimary = get_field('darkprimary', 'option') ? : '#004F50';
	$secondary = get_field( 'secondary', 'option' ) ? : '#3D403F';
	$tertiary = get_field( 'tertiary', 'option' ) ? : '#477982';
	$quaternary = get_field( 'quaternary', 'option' ) ? : '#477982';
	$quinary = get_field( 'quinary', 'option' ) ? : '#477982';
	$senary = get_field( 'senary', 'option' ) ? : '#477982';
	$darkgray = get_field( 'medgray', 'option' ) ? : '#3e4140';
	$lightgray = get_field( 'lightgray', 'option' ) ? : '#F6F6F6';
  $color_array = array(                                                              
    'primary' => 'Primary',                                                          
    'darkprimary' => 'Dark Primary',                                                
    'secondary' => 'Secondary',                                                      
    'tertiary' => 'Tertiary',  
		'quaternary' => 'Quaternary',  
		'quinary' => 'Quinary',
		'senary' => 'Senary', 
		'lightgray' => 'Light Gray',
		'darkgray' => 'Dark Gray',
		'white' => 'White',
  );                                                                                 
  $colors = array(                                                                   
    'primary' => $primary,                                                          
    'darkprimary' => $darkprimary,                                                
    'secondary' => $secondary,                                                      
    'tertiary' => $tertiary,  
		'quaternary' => $quaternary,  
		'quinary' => $quinary,
		'senary' => $senary,
		'lightgray' => $lightgray,
		'darkgray' => $darkgray,
		'white' => '#ffffff',
  );                                                                                 
  $choices = array();                                                                
  foreach( $color_array as $key => $label )                                          
  {
		$styles = 'padding: 10px; font-size: 0; background-color: ' . $colors[$key] .';';
		if($label == 'White' || $label == 'Light Gray') {
			$styles .= 'color: #000;';
		} else {
			$styles .= 'color: #fff;';
		}
    $choices[$key] = "<div style='".$styles."'>$label</div>";
  }                                                                                  
                                                                                     
  $field['choices'] = $choices;                                                      
  return $field;                                                                     
}  

// Fix Active Color Toggle Styles
function my_acf_admin_head() { ?>
	<style type="text/css">
		.acf-button-group label.selected {
			background-color: #eaeaea !important;
			border-color: #eaeaea !important;
		}
	</style>
<?php }

add_action('acf/input/admin_head', 'my_acf_admin_head');


// Autopopulate Form Block Form Selector Field with list of active Gravity Forms
add_filter( 'acf/load_field/key=field_647e35b625236', 'populate_gform_dropdown' );

function populate_gform_dropdown( $field ) {
	// if GFAPI doesn't exist, GravityForms is not running so bail early
	if ( ! class_exists( 'GFAPI' ) ) {
		return $field;
	}

	$forms = \GFAPI::get_forms();

	// Set the initial 'Select a Form' drop down value
	$choices = [
		'' => __( 'Select a Form', 'textdomain' ),
	];

	// Add each form to an array with the form ID as the array key
	foreach( $forms as $form ) {
		$choices[$form['id']] = $form['title'];
	}

	$field['choices'] = $choices;

	return $field;
}

// Add Link back to Roadie.com to Rankmath breadcrumbs
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
	$tld = ['Roadie', 'https://roadie.com'];
	array_splice( $crumbs, 0, 0, array($tld) );
	return $crumbs;
}, 10, 2);



// --- Driver intake form and candidate ID generation ---

// Return environmental parameters for current Roadie environment.
function get_roadie_env( $param = '' )
{
  $envs = array(
    'sandbox' => array(
      'site_url' => 'https://driver-sandbox.roadie.com',
      'redirect' => 'https://my-sandbox.roadie.com',
      'curl' => 'https://candidates-sandbox.roadie.com',
      'token' => 'jwoo1XkOfkynB1K3YjTMAiIuIp8bfV',
    ),
    'prod' => array(
      'site_url' => 'https://driver.roadie.com',
      'redirect' => 'https://drive.roadie.com',
      'curl' => 'https://candidates.roadie.com',
      'token' => 'z6QXIlXwsi3VCPuhCtgdGXwb0SFYUM',
    ),
  );
  preg_match( '/^.*\-sandbox\..*$/', get_site_url(), $site );
  $env = $site ? 'sandbox' : 'prod';
  if ( ! empty( $envs[$env] ) ) return $envs[$env];
  else return false;
}

function dogg_curl_new_candidate( $entry )
{
  $env = get_roadie_env();
  if ( ! $env ) return;

  /*
  $submitted_payload = array(
    'email' => rgar( $entry, '3' ),
    'last_name' => rgar( $entry, '7' ),
    'first_name' => rgar( $entry, '6' ),
  );
  
  $payload = $entry;
   */
  $entry = array(
    'email' => $_POST['input_3'],
    'last_name' => $_POST['input_7'],
    'first_name' => $_POST['input_6'],
  );

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $env['curl'] . '/candidates',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => json_encode( $entry ),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $env['token'],
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  $response = json_decode( $response, true ); // Associative 'candidate-id' array
  $candidate_id = $response['candidate-id'] ?: '';
  $_POST['input_8'] = $candidate_id;
  return $candidate_id;
}

// Delete Driver intake data upon submission
add_action( 'gform_after_submission_1', 'remove_form_entry' );
function remove_form_entry( $entry ) {
    GFAPI::delete_entry( $entry['id'] );
}

add_filter( 'gform_confirmation_1', 'dogg_gfconf_driver2roadie', 10, 4);
function dogg_gfconf_driver2roadie ( $confirmation, $form, $entry, $ajax ) {
  GFCommon::log_debug( 'gform_confirmation: running.' );

  $forms = array( 1 );

  if ( ! in_array( $form['id'], $forms ) || empty( $confirmation['redirect'] ) ) {
    return $confirmation;
  }

  $url = esc_url_raw( $confirmation['redirect'] );

  $candidate_id = dogg_curl_new_candidate( $entry );
  $prospect_id = api2_new_prospect( $entry );

  $env = get_roadie_env();
  $url = "{$env['redirect']}/sign-up?candidate_token=$candidate_id";
  
  GFCommon::log_debug( __METHOD__ . '(): Redirect to URL: ' . $url );
	$confirmation = '<div class="form-success"><p>Please complete the driver signup process in the other tab.</p></div>';
  $confirmation .= GFCommon::get_inline_script_tag( "window.open('$url', '_parent');" );

  return $confirmation;
}


/* Google Maps API for ACF */
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyBsKnnW0ryG0GkPdRYWISdSvl6Vk6dBoow');
}
add_action('acf/init', 'my_acf_init');

function parse_address_google( $address = '' ) {
	if( empty( $address ) ) return;
	$geolocate_api_key = 'AIzaSyBsKnnW0ryG0GkPdRYWISdSvl6Vk6dBoow';
	$address = urlencode( $address );
	$request = wp_remote_get("https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$geolocate_api_key");
	$json = wp_remote_retrieve_body( $request );
	$data = json_decode( $json );
	if ( !$data ) {
		return;
	}
	if ( isset($data->{'error_message'}) ) {
		return;
	}
	$array = json_decode( $json, true );
	$result = $array['results'][0];
	$location = array();
	foreach ($result['address_components'] as $component) {
		switch ($component['types']) {
		case in_array('street_number', $component['types']):
			$location['street_number'] = $component['long_name'];
			break;
		case in_array('route', $component['types']):
			$location['street_name'] = $component['long_name'];
			break;
		case in_array('sublocality', $component['types']):
			$location['sublocality'] = $component['long_name'];
			break;
		case in_array('locality', $component['types']):
			$location['city'] = $component['long_name'];
			break;
		case in_array('administrative_area_level_2', $component['types']):
			$location['region'] = $component['long_name'];
			break;
		case in_array('administrative_area_level_1', $component['types']):
			$location['state'] = $component['long_name'];
			$location['state_short'] = $component['short_name'];
			break;
		case in_array('postal_code', $component['types']):
			$location['postal_code'] = $component['long_name'];
			break;
		case in_array('country', $component['types']):
			$location['country'] = $component['long_name'];
			$location['country_short'] = $component['short_name'];
			break;
		}
	}
	$location['lat'] = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	$location['lng'] = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
	return $location;
} 

function on_import_update_map_field( $id ) 
{
  $type = get_post_type( $id );
  if ( $type == 'warehouse' ) {
    $address = get_field('field_681d1a7e35a8f'); // Google Map Field Key

    $location = parse_address_google( $address );

		$lat_field_key = 'field_681d0b878f49a';
    update_field( $lat_field_key, $location['lat'], $id );
		
		$long_field_key = 'field_681d0b908f49b';
    update_field( $long_field_key, $location['lng'], $id );
  }
}
add_action( 'pmxi_saved_post', 'on_import_update_map_field', 10, 1 );

add_filter( 'facetwp_map_init_args', function ( $args ) {
 
  $args['init']['zoomControl']       = true; // +- zoom control
  $args['init']['mapTypeControl']    = false; // roadmap / satellite toggle
  $args['init']['streetViewControl'] = true; // street view / yellow man icon
  $args['init']['fullscreenControl'] = true; // full screen icon
 
  return $args;
 
} );
 
// Part 2 - Trigger a "Locate-me" button click on the first map load, but only when the Proximity facet has no selection.
// This code adds the 'visible' class the first map load or when the first map load has an active Proximity facet.
add_action( 'facetwp_scripts', function() {
  ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      if ('undefined' !== typeof FWP.hooks) {
 
        FWP.hooks.addAction('facetwp/loaded', function() {
 
          // On first page load, only when the Proximity facet has no selection.
          if ( ! FWP.loaded && ! FWP.facets['proximity'].length ) {
            fUtil('.locate-me').trigger('click');
          }
          // After the first map load or when the Proximity facet has a selection on the first map load. 
          if ( FWP.loaded || FWP.facets['proximity'].length > 0 ) {
            fUtil('.facetwp-type-map').addClass('visible');
          }
        });
      }
 
    });
  </script>
  <?php
}, 1000);
 
// Part 3 - Hide the map on the initial map load, when it loads with no markers.
// Then show it after the "Locate me" button click has triggered, or when the Proximity facet has a selection on the first map load. 
add_action( 'wp_head', function() {
  ?>
  <style>
    .facetwp-type-map {
      opacity: 0.25;
    }
    .facetwp-type-map.visible {
      opacity: 1.0;
    }
  </style>
  <?php
}, 100 );

// Disable New Relic on Warehouse Map page
add_action( 'init', 'disable_new_relic' );
function disable_new_relic() {
    if (extension_loaded('newrelic') && is_page(1808)) { // Ensure PHP agent is available
		?><script>console.log('New Relic loaded.');</script><?php
        newrelic_disable_autorum();
		?><script>console.log('New Relic disabled.');</script><?php
    }
}

add_filter( 'facetwp_map_marker_args', function( $args, $post_id ) {
 
  // Example 1
  // Use a PNG image URL. See https://developers.google.com/maps/documentation/javascript/advanced-markers/graphic-markers
  $args['markerHtml'] = '<img width=100 height=100 src="'. home_url() .'/wp-content/uploads/2025/07/truck-marker2.png" class="my-png-marker" alt="marker icon" />';
 
  return $args;
}, 10, 2 );

/*
// add_action( 'gform_pre_submission_1', 'dogg_driver_pre_submission' );
function dogg_driver_pre_submission( $form )
{
  $post = $post ?: $_POST;
  $first_name = $post['input_6'];
  $last_name = $post['input_7'];
  $email = $post['input_3'];
  $phone = $post['input_4'];
  $candidate_ID = $post['input_8'];

  $_POST['input_8'] = dogg_curl_new_candidate( $post, $form );
  print_r( $_POST );
  die;
}
 */

/*
// add_action( 'gform_after_submission_1', 'dogg_gfsubmit_driver2roadie', 10, 2 );
function dogg_gfsubmit_driver2roadie( $entry, $form ) {
  $payload = array(
    'email' => rgar( $entry, '3' ),
    'phone' => rgar( $entry, '4' ),
    'last_name' => rgar( $entry, '7' ),
    'first_name' => rgar( $entry, '6' ),
    'candidateID' => rgar( $entry, '8' ),
  );
  
  $candidateID = dogg_getCandidate( $entry, $form, $payload );

  $curl = curl_init();
  $token = 'ZvYSsxvP2ZG625pH2oOoUiiTy1IHV6Qgoy9DtVpAmrjCvmnMZe0M1A8PhBs29uuMzM1GqsKqMmbgIXDLr7H1CTtCPqT8XDJqQTukA';
  $url = 'https://candidates-sandbox.roadie.com/';

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url . 'candidates',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode( $payload ),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token,
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);
  echo $response;

  $form['candidate_id'] = $response;
  
  $form['redirect'] = $redirect = 'https://my.roadie.com/drive/sign-up?candidate_token=' . $response;
}
 */

function get_api2_env( $param = '' )
{
  $site_url = get_site_url();

  $envs = array(
    'sandbox' => array(
      'site_url' => 'https://driver-sandbox.roadie.com',
      'redirect' => 'https://my-sandbox.roadie.com',
      'curl' => 'https://api-sandbox.roadie.com/v3',
      'token' => 'DhWd-skP9PwxVHMRL90e9AQqpHbDIScSw8PUPMNe',
    ),
    'prod' => array(
      'site_url' => 'https://driver.roadie.com',
      'redirect' => 'https://my.roadie.com',
      'curl' => 'https://api.roadie.com/v3',
      'token' => 'hexr932T9ENqSQsm6a2MIbBHz-Ww-d0TGIQ-X_GV',
    ),
  );
  preg_match( '/^.*\-sandbox\..*$/', $site_url, $site );
  $env = $site ? 'sandbox' : 'prod';
  if ( ! empty( $envs[$env] ) ) return $envs[$env];
  else return false;
}

function api2_new_prospect( $entry )
{
  $env = get_api2_env();
  if ( ! $env ) return;

  $entry = array(
    'email' => $_POST['input_3'],
    'last_name' => $_POST['input_7'],
    'first_name' => $_POST['input_6'],
  );

  $curlResponseHeaderCallback = function ($ch, $headerLine) use ( &$cookies ) {
    if (preg_match('/^Set-Cookie: prospect_id=\s*([^;]*)/mi', $headerLine, $cookie) == 1)
        $cookies[] = $cookie;
    return strlen($headerLine); // Needed by curl
  };

  $curl = curl_init();
  $headers = array(
    'Accept: application/json',
    'Source-Application: INMO_CREATIVE',
    'X-Api-Key: ' . $env['token'],
  );
  $cookies = [];
  curl_setopt_array($curl, array(
    CURLOPT_URL => $env['curl'] . '/prospect',
    CURLOPT_HEADERFUNCTION => $curlResponseHeaderCallback,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => json_encode( $entry ),
    CURLOPT_HTTPHEADER => $headers,
  ));

  $response = curl_exec($curl);
  if ( empty( $cookies ) ) return false;
  
  $cookie = array_shift( $cookies );
  if ( empty( $cookie[1] ) ) return null;

  curl_close($curl);
  return $cookie[1];
}

function api2_send_cookie( $prospect_id ) {
  $env = get_api2_env();
  if ( ! $env ) return;

  $curlResponseHeaderCallback = function ($ch, $headerLine) use ( &$cookies ) {
    if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', $headerLine, $cookie) == 1)
        $cookies[] = $cookie;
    return strlen($headerLine); // Needed by curl
  };

  $curl = curl_init();
  $headers = array(
    'Accept: application/json',
    'Source-Application: INMO_CREATIVE',
    'X-Api-Key: ' . $env['token'],
    'Cookie: ' . $prospect_id,
  );
  $cookies = [];
  curl_setopt_array($curl, array(
    CURLOPT_URL => $env['curl'] . '/prospect',
    CURLOPT_HEADERFUNCTION => $curlResponseHeaderCallback,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    // CURLOPT_POST => 0,
    // CURLOPT_CUSTOMREQUEST => 'GET',
    // CURLOPT_COOKIE => 'prospect_id=' . $prospect_id,
    // CURLOPT_POSTFIELDS => json_encode( $body ),
    CURLOPT_HTTPHEADER => $headers,
    // CURLOPT_RETURNTRANSFER => true,
    // CURLOPT_ENCODING => '',
    // CURLOPT_FOLLOWLOCATION => true,
    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  ));

  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}

