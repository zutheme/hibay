<?php
/**
 * hibay functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hibay
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'hibay_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hibay_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hibay, use a find and replace
		 * to change 'hibay' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hibay', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'hibay' ),
				'menu-2' => esc_html__( 'menu 2', 'hibay' ),
				'menu-3' => esc_html__( 'menu 3', 'hibay' ),
				'menu-4' => esc_html__( 'menu 4', 'hibay' ),
				'menu-5' => esc_html__( 'menu languages', 'hibay' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'hibay_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'hibay_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hibay_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hibay_content_width', 640 );
}
add_action( 'after_setup_theme', 'hibay_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hibay_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hibay' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hibay' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hibay_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hibay_scripts() {
	wp_enqueue_style( 'hibay-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'hibay-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hibay-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hibay_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
// 1. customize ACF path
add_filter('acf/settings/path', 'willgroup_acf_settings_path');
function willgroup_acf_settings_path( $path ) {
	 $path = get_stylesheet_directory() . '/inc/acf/';
	return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'willgroup_acf_settings_dir');
function willgroup_acf_settings_dir( $dir ) {
	 $dir = get_stylesheet_directory_uri() . '/inc/acf/';
	 return $dir;
}

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );
//include_once( get_stylesheet_directory() . '/inc/acf-options-for-polylang/bea-acf-options-for-polylang.php' );
require get_template_directory() . '/inc/customizer.php';
//require get_template_directory() . '/inc/customizer1.php';  
//add_filter('use_block_editor_for_post', '__return_false');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_desktop.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_desktop_language.php');
//require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_footer.php');
require get_template_directory() . '/inc/breadcrumb.php';
//require get_template_directory() . '/inc/services-type.php';
require get_template_directory() . '/inc/custom-page-type.php';
//require get_template_directory() . '/inc/mailattach.php';
require get_template_directory() . '/inc/custom_number_page.php';
require get_template_directory() . '/inc/process.php';
require get_template_directory() . '/inc/language.php';
function get_the_excerpt_max($charlength) {
	$excerpt = get_the_content();
	 $cleanText = filter_var($excerpt, FILTER_SANITIZE_STRING);
    $introCleanText = strip_tags($cleanText);
	$charlength++;

	if ( mb_strlen( $introCleanText ) > $charlength ) {
		$subex = mb_substr( $introCleanText, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut );
		} else {
			return $subex;
		}
		return '...';
	} else {
		return $introCleanText;
	}
	return $introCleanText;
}
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }
    return $title;    
});
add_action("admin_enqueue_scripts", "cate_admin_script");
function cate_admin_script() {
	    global $post_type;
    	//if( 'services' != $post_type ) return;
	        wp_enqueue_media();
	        // Registers and enqueues the required javascript.
	       
	        wp_register_script( 'cate_admin_script', get_stylesheet_directory_uri() . '/js/media_upload.js', array(), '0.0.1', true );
	        wp_localize_script( 'cate_admin_script', 'meta_image',
	            array(
	                'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
	                'button' => __( 'Use this image', 'prfx-textdomain' ),
	            )
	        );
	        wp_enqueue_script( 'cate_admin_script' );
}
add_action("admin_enqueue_scripts", "ckeditor");
function ckeditor(){
	wp_enqueue_script( 'ckeditor_admin_script', get_template_directory_uri() . '/ckeditor5/build/ckeditor.js', array(), '0.0.5', true );
	//wp_register_script( 'ckeditor_admin_script', get_stylesheet_directory_uri() . '/ckeditor5/build/ckeditor.js', array(), '0.0.2', true );
	wp_enqueue_script( 'ckeditor_custom_admin_script', get_template_directory_uri() . '/ckeditor5/js/custom.js', array(), '0.1.3', true );
}
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function extend_tag_cloud($tag_data) {
  return array_map (
      function ( $item )
      {
          $item['class'] .= ' ';
          return $item;
      },
      (array) $tag_data
  );
}
//add_filter( 'wp_generate_tag_cloud_data', 'extend_tag_cloud');

function wpb_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri() .'/images/logo-hibay.png'; ?>);
        height:100px;
        width:300px;
        background-size: 300px 100px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

function wpdocs_my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );

/*function novrian_breadcrumbs($sep = '')
{
    if (!function_exists('yoast_breadcrumb')) {
        return null;
    }
    // Default Yoast Breadcrumbs Separator
    //  $old_sep = '\&raquo\;';
    $old_sep = '»';
    // Get the crumbs
    $crumbs = yoast_breadcrumb(null, null, false);
    // Hilangkan wrapper <span xmlns:v />
    $output = preg_replace("/^\\<span xmlns\\:v=\"http\\:\\/\\/rdf\\.data\\-vocabulary\\.org\\/#\"\\>/", "", $crumbs);
    $output = preg_replace("/\\<\\/span\\>\$/", "", $output);
    // Ambil Crumbs
    $crumb = preg_split("/ (" . $old_sep . ") /", $output);
    // Manipulasi string output tiap crumbs
    $crumb = array_map(create_function('$crumb', '
      if (preg_match(\'/\\<span\\40class=\\"breadcrumb_last\\"/\', $crumb)) {
        return \'<li class="active">\' . $crumb . \'</li>\';
      }
      return \'<li>\' . $crumb . \' <span class="divider">' . $sep . '</span></li>\';
      '), $crumb);
    // Bangun output HTML
    $output = '<div class="breadcrumbs-container text-right" xmlns:v="http://rdf.data-vocabulary.org/#"\\><ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';
    // Print
    echo $output;
}*/
function get_top_breadcrumbs($sep = '')
{
    if (!function_exists('yoast_breadcrumb')) {
        return null;
    }
    // Default Yoast Breadcrumbs Separator
    //  $old_sep = '\&raquo\;';
    $old_sep = '»';
    // Get the crumbs
    $crumbs = yoast_breadcrumb(null, null, false);
	
    // Hilangkan wrapper <span xmlns:v />
    $output = preg_replace("/^\\<span xmlns\\:v=\"http\\:\\/\\/rdf\\.data\\-vocabulary\\.org\\/#\"\\>/", "", $crumbs);
    $output = preg_replace("/\\<\\/span\\>\$/", "", $output);
    // Ambil Crumbs
    $crumb = preg_split("/ (" . $old_sep . ") /", $output);
	$_slug = '';
	if(count($crumb) > 1){
		$title_strip = $crumb[1];
		$_slug = slug_from_string($title_strip);
	}elseif(count($crumb) == 1){
		$title_strip = $crumb[1];
		$_slug = slug_from_string($title_strip);
	}
    return $_slug;
}
function slug_from_string($title_strip){
	$title_strip = strip_tags($title_strip,'');
	$title_strip = stripVN($title_strip);
	$title_strip = preg_replace('/[ ](?=[ ])|[^-_,A-Za-z0-9 ]+/', '', $title_strip);
	$title_strip = strtolower($title_strip);
	$_slug = preg_replace('/\s+/', '-', $title_strip);
	return $_slug;
}
function stripVN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }