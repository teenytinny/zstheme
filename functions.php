<?php

// Path constants
define('THEMELIB', TEMPLATEPATH . '/lib');

// Add Post Thumbnail Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 160, 160, true ); // 160x160 size
	add_image_size( '200x200', 200, 200, true ); // 200x200 image size
	add_image_size( '320x320', 320, 320, true ); // 320x320 image size
	add_image_size( '590', 590, 9999 ); // 590 image size
	add_image_size( '950', 950, 9999 ); // 950 image size
}

// Add Max Content Width
if ( ! isset( $content_width ) ) $content_width = 950;

// Automatic Feed Links
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support('automatic-feed-links');
}

// Add Menu Theme Support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'nav-menus' );
	add_action( 'init', 'fullscreen_register_menus' );

	function fullscreen_register_menus() {
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu' )
			)
		);
	}
}

// Make Menu Support compatible with earlier WP versions
function fullscreen_theme_nav() {
	if ( function_exists( 'wp_nav_menu' ) )
		wp_nav_menu( 'sort_column=menu_order&menu_location=main-menu&container_id=nav&menu_class=sf-menu' );
	else
		get_template_part('nav');
}

// Allow Custom Background Image
add_custom_background();

// Load Post Images
require_once (THEMELIB . '/images.php');

// Get Video
include(THEMELIB . '/video-embed/video-post.php');

// Filter Comments
include(THEMELIB . '/comments-filter.php');

// Load widgets
include(THEMELIB . '/widgets.php');

// Produces an avatar image with the hCard-compliant photo class for author info
include(THEMELIB . '/author-info-avatar.php');

// Remove the WordPress Generator 
function gpp_remove_generators() { return ''; }  
add_filter('the_generator','gpp_remove_generators');

function theme_wp_head() { ?><link href="<?php bloginfo('template_directory'); ?>/lib/style.php" rel="stylesheet" type="text/css" /><?php } 
if(get_option('T_css')=="On")
add_action('wp_head', 'theme_wp_head'); 

define('THEME', get_bloginfo('template_url'), true);
define('THEME_JS', THEME . '/js/', true);

// Load javascripts
function theme_load_js() {
    if (is_admin()) return;
    wp_enqueue_script('jquery');    
    wp_enqueue_script('jqueryui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('superfish', THEME_JS .'nav/superfish.js', array('jquery'));
    wp_enqueue_script('nav', THEME_JS .'nav/jquery.bgiframe.min.js', array('jquery'));
    wp_enqueue_script('nav', THEME_JS .'nav/hoverintent.js', array('jquery'));
    wp_enqueue_script('supersubs', THEME_JS .'nav/supersubs.js', array( 'jquery' ) );
      
}

function load_feature_js() {
	if(is_home()) {
		wp_enqueue_script('mousewheel', THEME_JS . 'jquery.mousewheel.js', array('jquery'));
    		wp_enqueue_script('fullscreen', THEME_JS .'fullscreen.js', array('jquery'));
		wp_enqueue_script('fullscreener', THEME_JS .'jquery.fullscreenr.js', array('jquery'));  
	} else if (is_post_type_archive( 'catalog' )) {
		wp_enqueue_script('heightLine', THEME_JS .'heightLine.js', array('jquery'));  
	}
}

function doc_ready_js() {
	$doc_ready_script = '<script type="text/javascript">
		jQuery(function() {
			jQuery("#dialog").dialog({
				autoOpen: false,
				modal: true,
				width: 600,
				height: 400,
				buttons: {
					"Close": function() { 
						jQuery(this).dialog("close"); 
					} 
				}
			});
			
			jQuery("#dialog_link").click(function(){
				jQuery("#dialog").dialog("open");
				return false;
			});
		});

	jQuery(document).ready(function(){
	
        jQuery("ul.sf-menu").supersubs({ 
            minWidth:    12,
            maxWidth:    27,
            extraWidth:  1
        }).superfish({
    		delay:       500,
			animation:   {opacity:"show",height:"show"},
			speed:       "fast",
			autoArrows:  true,
			dropShadows: true
        });
	 });
	</script>';
	echo $doc_ready_script;
}

add_action('init', theme_load_js);
add_action('template_redirect', load_feature_js); //hook
add_action('wp_head', doc_ready_js);

/*
customize for zsinc
---------------------------------------------
*/
/* home full screen background */
add_action('wp_head','zsinc_head');
function zsinc_head() {
	if (is_home()) {
		
		?>
		<script type="text/javascript">  
		<!--
			// You need to specify the size of your background image here (could be done automatically by some PHP code)
			var FullscreenrOptions = {  width: 960, height: 720, bgID: '#bgimg' };
			// This will activate the full screen background!
			jQuery.fn.fullscreenr(FullscreenrOptions);
		//-->
		</script>
		<style type="text/css">
			body {
				overflow:hidden; 		/* needed to eliminate scrollbars caused by the background image */
				padding:0;margin:0;		/* necesarry for the raster to fill the screen */
				height:100%;width:100%;
			}
		</style>
	<?php
	} 
}

//side-widgetを追加
//add_action('get_footer', 'zsinc_sidewidget');
function zsinc_sidewidget() {
	if (is_page()) {
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Side-widget') ){
		}
	}
}

//edit post link
add_action('edit_post_link','zsinc_edit_post_link');
function zsinc_edit_post_link($before) {
	$before = str_replace('<p>', '<p class="zs-editpost">', $before);
	return $before;
}

?>