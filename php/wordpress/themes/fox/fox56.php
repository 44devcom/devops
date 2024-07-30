<?php
if ( ! defined( 'FOX_VERSION' ) ) {
    define( 'FOX_VERSION', '6.3.1' );
}
if ( ! defined( 'FOX_DEMOS_KEY' ) ) {
    define( 'FOX_DEMOS_KEY',  'fox_demos_23_' . FOX_VERSION );
}
if ( ! defined( 'FOX_PLUGINS_KEY' ) ) {
    define( 'FOX_PLUGINS_KEY',  'fox_plugins_16_' . FOX_VERSION );
}

if ( ! defined( 'FOX_ADMIN_URL' ) ) define( 'FOX_ADMIN_URL', get_template_directory_uri() . '/inc/admin/' );
if ( ! defined( 'FOX_ADMIN_PATH' ) ) define( 'FOX_ADMIN_PATH', get_template_directory() . '/inc/admin/' );

// ADMIN
require get_parent_theme_file_path( '/inc/admin/admin.php' ); // general admin problem
require get_parent_theme_file_path( '/inc/admin/import.php' ); // import demo data

// FUNCTIONS
require get_parent_theme_file_path( '/inc/support.php' );
require get_parent_theme_file_path( '/inc/header.php' );
require get_parent_theme_file_path( '/inc/footer.php' );
require get_parent_theme_file_path( '/inc/user.php' );
require get_parent_theme_file_path( '/inc/sidebar.php' );
require get_parent_theme_file_path( '/inc/single.php' );

require get_parent_theme_file_path( '/inc/shortcodes.php' );
require get_parent_theme_file_path( '/inc/helpers.php' );
require get_parent_theme_file_path( '/inc/featured-post.php' );
require get_parent_theme_file_path( '/inc/auto-thumbnail.php' );
require get_template_directory() . '/inc/functions56.php';
require get_template_directory() . '/inc/blog.php';
require get_template_directory() . '/inc/builder/builder.php';
require get_parent_theme_file_path( '/inc/hooks.php' ); // filters, actions

// CUSTOMIZE 56
require get_template_directory() . '/inc/customize/customize.php';
require get_template_directory() . '/inc/header-builder.php';
require get_template_directory() . '/inc/style.php';
require get_template_directory() . '/inc/typography.php';

// PLUGIN COMPATIBILITY
require get_parent_theme_file_path( '/inc/plugin.woocommerce.php' );
require get_parent_theme_file_path( '/inc/plugin.polylang.php' );
require get_parent_theme_file_path( '/inc/plugin.wpml.php' );

// CUSTOM FONTS
if ( ! defined( 'BSF_CUSTOM_FONTS_FILE') ) {
    define( 'BSF_CUSTOM_FONTS_FILE', __FILE__ );
    define( 'BSF_CUSTOM_FONTS_BASE', plugin_basename( BSF_CUSTOM_FONTS_FILE ) );
    define( 'BSF_CUSTOM_FONTS_DIR', get_template_directory() . '/inc/custom-fonts/' );
    define( 'BSF_CUSTOM_FONTS_URI', get_template_directory_uri() . '/inc/custom-fonts/' );
    define( 'BSF_CUSTOM_FONTS_VER', '1.3.7' );
    require get_template_directory() . '/inc/custom-fonts/custom-fonts.php';
}

// WIDGETS
require get_parent_theme_file_path ( '/widgets/about/register.php' );
require get_parent_theme_file_path ( '/widgets/authorbox/register.php' );
require get_parent_theme_file_path ( '/widgets/button/register.php' );
require get_parent_theme_file_path ( '/widgets/latest-posts/register.php' );
require get_parent_theme_file_path ( '/widgets/social/register.php' );
require get_parent_theme_file_path ( '/widgets/media/register.php' );
require get_parent_theme_file_path ( '/widgets/facebook/register.php' );
require get_parent_theme_file_path ( '/widgets/instagram/register.php' );
require get_parent_theme_file_path ( '/widgets/pinterest/register.php' );
require get_parent_theme_file_path ( '/widgets/ad/register.php' );
require get_parent_theme_file_path ( '/widgets/best-rated/register.php' );
require get_parent_theme_file_path ( '/widgets/authorlist/register.php' );
require get_parent_theme_file_path ( '/widgets/imagebox/register.php' );
require get_parent_theme_file_path ( '/widgets/imagetext/register.php' );
require get_parent_theme_file_path ( '/widgets/coronavirus/register.php' );
require get_parent_theme_file_path ( '/widgets/mc4wp/register.php' );

// FOOTER WIDGETS
require get_parent_theme_file_path ( '/widgets/footer-logo/register.php' );
require get_parent_theme_file_path ( '/widgets/copyright/register.php' );
require get_parent_theme_file_path ( '/widgets/footer-nav/register.php' );

/* patches
since 6.1 - it's not related to inc/upgrade
================================================================================================== */
include_once(dirname( __FILE__ ).'/inc/patches/patches61.php' );

/* register sidebars
================================================================================================== */
add_action( 'widgets_init', 'fox56_register_sidebars' );
if ( ! function_exists( 'fox56_register_sidebars' ) ) :
function fox56_register_sidebars() {
    
    $sidebars = [
        'sidebar' => [
            'name' => 'Main Sidebar',
            'desc' => 'Used for blog, archive, single post',
        ],
        'page-sidebar' => [
            'name' => 'Page Sidebar',
            'desc' => 'Used for page',
        ],
    ];
    
    $sidebars[ 'before-header' ] = [
        'name' => 'Before Header',
        'desc' => 'In case you wanna insert some banner before the header',
    ];
    
    $sidebars[ 'after-header' ] = [
        'name' => 'After Header (Desktop)',
        'desc' => 'In case you wanna insert some banner after the header',
    ];
    
    $sidebars[ 'after-header-mobile' ] = [
        'name' => 'After Header (Mobile)',
        'desc' => 'In case you wanna insert some banner after the header',
    ];
    
    $sidebars[ 'footer-instagram' ] = [
        'name' => 'Footer Instagram',
        'desc' => 'Drag your Instagram widget here.',
    ];
    
    $sidebars[ 'footer-newsletter' ] = [
        'name' => 'Footer Newsletter',
        'desc' => 'Drag your <strong>(FOX) Mailchimp Form</strong> widget here',
    ];
    
    for ( $i = 1; $i <= 4; $i++ ) {
        $sidebars[ 'footer-' . $i ] = [
            'name' => 'Footer ' . $i,
            'desc' => 'Footer Sidebar Column ' . $i,
        ];
    }
    
    $sidebars[ 'off-canvas' ] = [
        'name' => 'Off-Canvas Sidebar',
        'desc' => 'Add widgets here, they will appear in Off-Canvas menu',
    ];
    
    /**
     * now finally register them
     */
    foreach ( $sidebars as $id => $sb ) {
        
        register_sidebar( array(
            'name'          => $sb[ 'name' ],
            'id'            => $id,
            'description'   => $sb[ 'desc' ],
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
        
    }

}
endif;

/* pingback
================================================================================================== */
if ( ! function_exists( 'fox56_pingback_header' ) ) :
function fox56_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
endif;
add_action( 'wp_head', 'fox56_pingback_header' );

/* debug info
================================================================================================== */
add_action( 'wp_footer', 'fox_debug_info' );
if ( ! function_exists( 'fox_debug_info' ) ) :
function fox_debug_info() {
    
    $info = [];
    
    // 01 - theme version
    $info[ 'fox_version' ] = FOX_VERSION;
    
    // 02 - framework version
    if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
        $info[ 'fox_framework_version' ] = FOX_FRAMEWORK_VERSION;
    }
    
    // 03 - the demo
    $demo = get_theme_mod( 'wi_demo' );
    $info[ 'demo' ] = $demo;
    
    // 04 ------- FINAL
    $attrs = [];
    foreach ( $info as $k => $val ) {
        $attrs[] = 'data-' . $k . '="' . esc_attr( $val ) . '"';
    }
    ?>
<span <?php echo join( ' ', $attrs ) ;?>></span>
    <?php
}
endif;

/* ------------------------------------------------------------------------     since 5.6 */
/**
 * IMPORTANT CONDITIONAL FUNCTION
 */
if ( ! function_exists( 'fox56_has_builder' ) ) :
function fox56_has_builder() {
    return is_home();
}
endif;

/**
 * After Setup Theme
 * since 5.6
 * =============================================================================================
 */
add_action( 'after_setup_theme', 'fox56_setup' );
if ( ! function_exists( 'fox56_setup' ) ) :
function fox56_setup() {

    global $content_width;
    if ( ! isset( $content_width ) ) {
        $get_content_width = get_theme_mod( 'container_width', 1080 );
        $get_content_width = absint( $get_content_width );
        if ( $get_content_width < 600 || $get_content_width > 2600 ) {
            $get_content_width = 1080;
        }
        $content_width = $get_content_width;
    }
    
    // translation
	load_theme_textdomain( 'wi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

    // title tag
    add_theme_support( 'title-tag' );

    // post thumbnail
    add_theme_support( 'post-thumbnails' );
    
    add_image_size( 'tiny', 60, 9999, false ); // for lazyload
    
    $thumbnail_medium = get_theme_mod( 'thumbnail_medium', [ 'width' => 480, 'height' => 384 ] );
    $thumbnail_medium = wp_parse_args( $thumbnail_medium, [ 'width' => 480, 'height' => 384 ] );
	add_image_size( 'thumbnail-medium', $thumbnail_medium[ 'width'], $thumbnail_medium[ 'height'], true );  // medium landscape

    $thumbnail_square = get_theme_mod( 'thumbnail_square', [ 'width' => 480, 'height' => 480 ] );
    $thumbnail_square = wp_parse_args( $thumbnail_square, [ 'width' => 480, 'height' => 480 ] );
    add_image_size( 'thumbnail-square', $thumbnail_square[ 'width'], $thumbnail_square[ 'height'], true );  // medium square

    $thumbnail_portrait = get_theme_mod( 'thumbnail_portrait', [ 'width' => 480, 'height' => 600 ] );
    $thumbnail_portrait = wp_parse_args( $thumbnail_portrait, [ 'width' => 480, 'height' => 680 ] );
    add_image_size( 'thumbnail-portrait', $thumbnail_portrait[ 'width'], $thumbnail_portrait[ 'height'], true );  // medium portrait

    $thumbnail_large = get_theme_mod( 'thumbnail_large', [ 'width' => 720, 'height' => 480 ] );
    $thumbnail_large = wp_parse_args( $thumbnail_large, [ 'width' => 720, 'height' => 480 ] );
    add_image_size( 'thumbnail-large', $thumbnail_large[ 'width'], $thumbnail_large[ 'height' ], true );  // large landscape

    // this is not used
    // derepcated56
    // add_image_size( 'thumbnail-medium-nocrop', 480, 9999, false );  // medium thumbnail no crop
    
    // deprecated since 4.0
    // add_image_size( 'thumbnail-big', 1020, 510, true );  // big thumbnail (ratio 2:1)
    // add_image_size( 'thumbnail-vertical', 9999, 500, false );  // vertical image used for gallery
    
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => 'Primary Menu',
        'mobile' => 'Off-Canvas Menu',
        'footer' => 'Footer Menu',
        'search-menu' => 'Flying Search Suggestions',
	));
    
	// html5
	add_theme_support( 'html5', array(
		'navigation-widgets',
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
	) );

	// post formats
	add_theme_support( 'post-formats', array(
		'video', 'gallery', 'audio', 'link',
	) );
    
    // since 2.4
    add_theme_support( 'woocommerce' );
    // https://belovdigital.agency/blog/how-to-add-woocommerce-support-to-a-theme/
    // since v6.2.4
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    
    // since 4.0
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // align wide
    // since 4.3
    add_theme_support( 'align-wide' );

}
endif;

if ( ! function_exists( 'fox56_has_woocommerce' ) ) :
function fox56_has_woocommerce() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return false;
    } 
    if ( is_woocommerce() ) {
        return true;
    }
    if ( is_cart() || is_checkout() || is_account_page() ) {
        return true;
    }
}
endif;

/**
 * Enqueue scripts
 * since 5.6
 * =============================================================================================
 */

// return array of which css files will be considered as 'above'
function fox56_above_css_files() {

    $file = [];

    /* header */
    $files[] = 'common.css';
    $files[] = 'header-above.css';

    if ( is_single() ) {
        $files[] = 'single-above.css';
    }
    if ( is_page() ) {
        $files[] = 'single-above.css';
    }

    /* woocommerce */
    if ( fox56_has_woocommerce() ) {
        $files[] = 'woocommerce.css';
    }
    
    /** builder */
    if ( fox56_has_builder() ) {

        $files[] = 'builder/common.css';

        $widgetlist = fox56_builder_widgetlist();
        foreach ( $widgetlist as $widget_id => $widget ) {

            $type = $widget['type'];
            if ( 'post-grid' == $type ) {
                $files[] = 'builder/grid.css';
            } elseif ( 'post-masonry' == $type ) {
                $files[] = 'builder/grid.css';
                $files[] = 'builder/masonry.css';
            } elseif ( 'post-list' == $type ) {
                $files[] = 'builder/grid.css';
                $files[] = 'builder/list.css';
            } elseif ( 'post-carousel' == $type ) {
                $files[] = 'flickity.css';
                $files[] = 'builder/carousel.css';
            } elseif ( 'post-group' == $type ) {
                $files[] = 'builder/grid.css';
                $files[] = 'builder/list.css';
                $files[] = 'builder/group.css';
            } else {
                $files[] = 'builder/others.css';
            }
            
        }

    }

    // if fox framework installed
    if ( is_archive() || is_search() || ( is_page() && defined( 'FOX_FRAMEWORK_VERSION' ) ) ) {
        $files = array_merge( $files, [
            'builder/common.css',
            'builder/grid.css',
            'builder/list.css',
            'builder/masonry.css',
            'builder/carousel.css',
            'builder/group.css',
            'builder/others.css',
        ]);
    }

    $files = array_unique( $files );
    return $files;

}
// all css files
function fox56_below_css_files() {
    $files = [
        'common.css',
        'common-below.css',
        'header-above.css',
        'header-below.css',
        'footer.css',
        'widgets.css',

        'builder/common.css',
        'builder/grid.css',
        'builder/list.css',
        'builder/masonry.css',
        'builder/carousel.css',
        'builder/group.css',
        'builder/others.css',

        'misc.css',
    ];

    if ( is_single() ) {
        $files[] = 'single-above.css';
    }
    if ( is_page() ) {
        $files[] = 'single-above.css';
    }
    if ( fox56_has_woocommerce() ) {
        $files[] = 'woocommerce.css';
    }

    if ( is_customize_preview() || fox56_has_flickity() ) {
        $files[] = 'flickity.css';
    }
    if ( is_customize_preview() || fox56_has_tooltipster() ) {
        $files[] = 'tooltipster.css';
    }
    if ( is_customize_preview() || fox56_has_lightbox() ) {
        $files[] = 'lightbox.css';
    }

    if ( is_customize_preview() || is_single() || is_page() ) {
        $files[] = 'single-below.css';
    }
    
    return $files;
}

/**
 * check whether we use css critical
 */
function fox56_use_css_critical() {
    if ( defined('LSCWP_V') ) {
        return false;
    }
    return get_theme_mod( 'css_critical', false );
}

add_action( 'wp_enqueue_scripts', 'fox56_enqueue_styles_critical' );
function fox56_enqueue_styles_critical() {
    if ( ! fox56_use_css_critical() ) {
        return;
    }
    $above_css_files = fox56_above_css_files();

    /* ----------------------       part 1: load inline critical css */
    wp_register_style( 'fox-above', false );
    wp_enqueue_style( 'fox-above' );
    wp_add_inline_style( 'fox-above', apply_filters( 'fox56_above_css', '' ) );

    /* ----------------------       part 2: load async below css */
    $all_css_files = fox56_below_css_files();
    $i = 0;
    $prefix = get_template_directory_uri() . '/css56/';
    foreach ( $all_css_files as $below_file ) {
        if ( in_array( $below_file, $above_css_files ) ) {
            continue;
        }
        $i += 1;
        wp_enqueue_style( 'fox-style-' . $i, $prefix . $below_file, null, FOX_VERSION, 'fox56_async' );
    }

    // this is to add inline style
    wp_register_style( 'style56', false );
    wp_enqueue_style( 'style56' );

    /* ----------------------       part 3: register icon font ready to use */
    wp_register_style( 'fox-fontawesome', get_template_directory_uri() . '/fontawesome.css', null, FOX_VERSION, 'fox56_async' );
    wp_register_style( 'fox-feather', get_template_directory_uri() . '/feather.css', null, FOX_VERSION, 'fox56_async' );

}

function fox56_load_async_css() {
    ?>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        var fox56_async_css = document.querySelectorAll('link[media="fox56_async"],style[media="fox56_async"]')
        if ( ! fox56_async_css ) {
            return;
        }
        for( var link of fox56_async_css ) {
            link.setAttribute('media','all')
        }
    });
</script>
<?php
}
add_action( 'wp_head', 'fox56_load_async_css', 0 );

function fox56_css_compressor( $buffer ) {

    // Remove comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

    // Remove space after colons
    $buffer = str_replace(': ', ':', $buffer);

    // Remove whitespace
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

    return $buffer;

}
add_filter( 'fox56_above_css', 'fox56_inline_above_css' );
function fox56_inline_above_css( $css_string ) {

    /* ----------------------       part 1: icon font */
    ob_start();
    ?>
    @font-face {
    font-family: 'icon56';
    src:
        url('<?php echo get_template_directory_uri(); ?>/css56/icons56/icon56.ttf?version=<?php echo FOX_VERSION; ?>') format('truetype'),
        url('<?php echo get_template_directory_uri(); ?>/css56/icons56/icon56.woff?version=<?php echo FOX_VERSION; ?>') format('woff'),
        url('<?php echo get_template_directory_uri(); ?>/css56/icons56/icon56.svg?version=<?php echo FOX_VERSION; ?>#icon56') format('svg');
    font-weight: normal;
    font-style: normal;
    font-display: block;
    }
    <?php
    $css_string .= ob_get_clean();
    $css_string .= "\n";

    /* ----------------------       part 2: above files */
    $above_css_files = fox56_above_css_files();
    foreach ( $above_css_files as $file ) {
        $css_string .= file_get_contents( get_template_directory() . '/css56/' . $file );
    }
    $css_string = str_replace( '../images/', get_template_directory_uri() . '/images/', $css_string );

    return fox56_css_compressor( $css_string );
}
add_action( 'wp_enqueue_scripts', 'fox56_enqueue_styles_normal' );
function fox56_enqueue_styles_normal() {

    if ( fox56_use_css_critical() ) {
        return;
    }
    $file_content = [];
    $all_css_files = fox56_below_css_files();
    array_unshift( $all_css_files, 'icon56-loading.css' );
    $i = 0;
    $prefix = get_template_directory_uri() . '/css56/';
    foreach ( $all_css_files as $file ) {
        $i += 1;
        wp_enqueue_style( 'fox-style-' . $i, $prefix. $file, null, FOX_VERSION, 'all' );
    }

    // this is to add inline style
    wp_register_style( 'style', false );
    wp_enqueue_style( 'style' );

    // this is to add inline style
    wp_register_style( 'style56', false );
    wp_enqueue_style( 'style56' );

    /* ----------------------       part 3: register icon font ready to use */
    wp_register_style( 'fox-fontawesome', get_template_directory_uri() . '/fontawesome.css', null, FOX_VERSION, 'all' );
    wp_register_style( 'fox-feather', get_template_directory_uri() . '/feather.css', null, FOX_VERSION, 'all' );

}

/*              SCRIPTS 
----------------------------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'fox56_enqueue_scripts' );
function fox56_enqueue_scripts() {

    /* ---------- fb */
    wp_register_script( 'wi-facebook', 'https://connect.facebook.net/en_US/all.js#xfbml=1', false, '1.0', true );
    
    /* ---------- lightbox */
    wp_register_script( 'wi-magnific-popup', get_theme_file_uri( '/js56/jquery.magnific-popup.js' ), array( 'jquery' ), '1.1.0' , true );
    if ( is_customize_preview() || fox56_has_lightbox() ) {
        wp_enqueue_script( 'wi-magnific-popup' );
    }
    
    /* ---------- comment */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    /* ---------- tooltipster */
    wp_register_script( 'wi-tooltipster', get_theme_file_uri( '/js56/tooltipster.bundle.min.js' ), array( 'jquery' ), '4.2.6' , true );
    if ( is_customize_preview() || fox56_has_tooltipster() ) {
        wp_enqueue_script( 'wi-tooltipster' );
    }

    /* ---------- fitvids */
    wp_register_script( 'wi-fitvids', get_theme_file_uri( '/js56/jquery.fitvids.js' ), array( 'jquery' ), time() , true );
    wp_enqueue_script( 'wi-fitvids' );

    /* ---------- masonry */
    wp_register_script( 'wi-imagesloaded', get_theme_file_uri( '/js56/imagesloaded.pkgd.min.js' ), array( 'jquery' ), '3.1.8' , true );
    wp_register_script( 'wi-masonry', get_theme_file_uri( '/js56/masonry.pkgd.min.js' ), array( 'jquery' ), '4.2.2' , true );
    if ( is_customize_preview() || fox56_has_masonry() ) {
        wp_enqueue_script( 'wi-imagesloaded' );
        wp_enqueue_script( 'wi-masonry' );
    }
    
    /* ---------- sticky sidebar */
    wp_register_script( 'wi-theia-sticky-sidebar', get_theme_file_uri( '/js56/theia-sticky-sidebar.js' ), array( 'jquery' ), '1.3.1' , true );
    if ( is_customize_preview() || fox56_has_sticky_sidebar() ) {
        wp_enqueue_script( 'wi-theia-sticky-sidebar' );
    }
    
    /* ---------- flickity */
    wp_register_script( 'wi-flickity', get_theme_file_uri( '/js56/unpkg.com_flickity@2.3.0_dist_flickity.pkgd.min.js' ), null, '2.3.0' , true );
    if ( is_customize_preview() || fox56_has_flickity() ) {
        wp_enqueue_script( 'wi-flickity' );
    }

    /* ---------- main script */
    wp_register_script( 'wi-main56', get_theme_file_uri( '/js56/main.js' ), array( 'jquery' ), FOX_VERSION , true );
    
    $jsdata = array(
        'l10n' => array( 
            'prev' => fox_word( 'previous' ), 
            'next' => fox_word( 'next' ),
            'loading' => esc_html__( 'Loading..', 'wi' ),
        ),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => get_site_url( '/' ),
        'site_id' => get_current_blog_id(),
    );
    if ( fox56_has_lightbox() ) {
        $jsdata[ 'enable_lightbox' ] = true;
    }
    $jsdata = apply_filters( 'jsdata', $jsdata );
    wp_enqueue_script( 'wi-main56' );
	wp_localize_script( 'wi-main56', 'WITHEMES56', $jsdata );    

    /* - maintaining
    if ( fox_autoload() && ! is_customize_preview() ) {
        
        wp_enqueue_script( 'scrollspy', get_theme_file_uri( '/js56/scrollspy.js' ), array('jquery'), FOX_VERSION, true );
        wp_enqueue_script( 'autoloadpost', get_theme_file_uri( '/js56/autoloadpost.js' ), array('jquery', 'scrollspy'), FOX_VERSION, true );
        wp_enqueue_script( 'history', get_theme_file_uri( '/js56/jquery.history.js' ), array('jquery'), FOX_VERSION, true );
        $jsdata[ 'enable_autoload' ] = true;
        
    }
    */

}

/* LIGHTBOX
---------------------------------------- */
function fox56_has_lightbox() {
    /* hmm, maybe it's the gallery widget - Times demo
    if ( ! is_singular() ) {
        return;
    }
    */
    if ( get_theme_mod( 'disable_theme_lightbox') ) {
        return;
    }
    return true;
}

/* TOOLTIP
 * we use tooltipster only for single post, and only for hovercard
---------------------------------------- */
function fox56_has_tooltipster() {
    if ( ! is_singular() ) {
        return;
    }
    if ( 'true' != get_theme_mod( 'wi_link_hovercard', 'false' ) ) {
        return true;
    }
}

/* MASONRY
 * masonry being used for:
 *      homepage builder masonry section
 *      single gallery masonry style
 *      archive masonry layout
---------------------------------------- */
function fox56_has_masonry() {
    
    /** ----------------            case 1: homepage builder */
    if ( is_home() ) {
        $widgetlist = fox56_builder_widgetlist();
        $load = false;
        foreach ( $widgetlist as $widget_id => $widget ) {
            if ( 'post-masonry' == $widget['type'] ) {
                $load = true;
                break;
            }
        } 
        return $load;
    }

    /** ----------------            case 2: singular masonry gallery */
    if ( is_single() ) {
        if ( 'gallery' != get_post_format() ) {
            return;
        }
        $gallery_style = get_post_meta( get_the_ID(), '_wi_format_gallery_style', true );
        if ( ! $gallery_style ) {
            $gallery_style = get_theme_mod( 'single_format_gallery_style' );
        }
        if ( 'masonry' == $gallery_style ) {
            return true;
        }
        return;
    }

    /** ----------------            case 3: archive masonry layout */
    if ( is_archive() || is_search() ) {
        $arr = fox56_get_archive_layout_cols();
        $layout = $arr[ 'layout' ];
        if ( 'masonry' == $layout ) {
            return true;
        }
        // topbar
        $top_query_args = fox56_toparea_query_args();
        if ( ! $top_query_args ) {
            return;
        }
        $toparea_arr = fox56_toparea_layout_cols();
        if ( 'masonry' == $toparea_arr['layout'] ) {
            return true;
        }
    }

}

/* SINGLE CONTENT
 * single css will be used for:
 *      singular
 *      homepage builder with some 'page' section
---------------------------------------- */
function fox56_has_single_content() {
    
    /** ----------------            case 1: homepage builder */
    if ( is_home() ) {
        $widgetlist = fox56_builder_widgetlist();
        $load = false;
        foreach ( $widgetlist as $widget_id => $widget ) {
            if ( 'page' == $widget['type'] ) {
                $load = true;
                break;
            }
        } 
        return $load;
    }

    /** ----------------            case 2: singular */
    if ( is_single() || is_page() ) {
        return true;
    }

    return false;

}

/* STICKY SIDEBAR
 * if sticky sidebar enabled
 * if builder has sticky sidebar section
---------------------------------------- */
function fox56_has_sticky_sidebar() {

    /** ----------------            case 1: homepage builder */
    if ( is_home() ) {

        $widgetlist = fox56_builder_widgetlist();
        $load = false;
        foreach ( $widgetlist as $widget_id => $widget ) {
            if ( 'row' != $widget['type'] ) {
                continue;
            }
            if ( isset( $widget['sidebar'] ) && $widget['sidebar'] && isset( $widget['sidebar_sticky'] ) && $widget['sidebar_sticky'] ) {
                $load = true;
                break;
            }
        } 
        return $load;
    }

    /** ----------------            case 2: other cases */
    if ( get_theme_mod( 'sticky_sidebar' ) && ( ! is_home() ) ) {
        return true;
    }

}

/* FLICKITY
 *      home: if section carousel
 *      single: if slider gallery format
 *      archive: if top area type is slider/carousel
---------------------------------------- */
function fox56_has_flickity() {
    if ( is_home() ) {
        $widgetlist = fox56_builder_widgetlist();
        $load = false;
        foreach ( $widgetlist as $widget_id => $widget ) {
            if ( 'post-carousel' == $widget['type'] ) {
                $load = true;
                break;
            }
        } 
        return $load;
    }

    if ( is_single() ) {
        if ( 'gallery' != get_post_format() ) {
            return;
        }
        $gallery_style = get_post_meta( get_the_ID(), '_wi_format_gallery_style', true );
        if ( ! $gallery_style ) {
            $gallery_style = get_theme_mod( 'single_format_gallery_style' );
        }
        if ( 'slider' == $gallery_style || 'slider-rich' == $gallery_style || 'carousel' == $gallery_style ) {
            return true;
        }
        return;
    }

    if ( is_archive() || is_search() ) {
        $top_query_args = fox56_toparea_query_args();
        if ( ! $top_query_args ) {
            return;
        }
        
        $toparea_arr = fox56_toparea_layout_cols();
        if ( 'slider' == $toparea_arr['layout'] || 'carousel' == $toparea_arr['layout'] ) {
            return true;
        }
        return false;
    }

}

/* ---------------------------------------------------------------- load js async, defer */
// Adapted from https://gist.github.com/toscho/1584783
add_filter( 'clean_url', function( $url ) {   
    // return $url; 
    if ( FALSE === strpos( $url, '.js' ) ) {
        // not our file
        return $url;
    }
    // disable for admin
    if ( current_user_can( 'manage_options' ) ) {
        return $url;
    }

    // disable for customizer
    if ( is_customize_preview() ) {
        return $url;
    }

    // do not defer jquery
    if ( FALSE !== strpos( $url, "jquery-core-js" ) ) {
        return $url;
    }
    // do not defer jquery
    if ( FALSE !== strpos( $url, "jquery-migrate-js" ) ) {
        return $url;
    }

    // Must be a ', not "!
    if ( get_theme_mod( 'js_async', false )  ) {
        $url = "$url' async='async";
    }
    if ( get_theme_mod( 'js_defer', false )  ) {
        $url = "$url' defer='defer";
    }
    return $url;
}, 11, 1 );

/* ---------------------------------------------------------------- remove dashicons */
function fox56_is_woocommerce_related() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return false;
    }
    if ( function_exists( 'is_shop' ) && is_shop() ) {
        return true;
    }
    if ( function_exists( 'is_cart' ) && is_cart() ) {
        return true;
    }
    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        return true;
    }
    if ( function_exists( 'is_account_page' ) && is_account_page() ) {
        return true;
    }
    if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url() ) {
        return true;
    }
    if ( is_singular( 'product' ) ) {
        return true;
    }
    if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
        return true;
    }
    return false;
}
add_action( 'wp_print_styles', 'fox56_deregister_styles', 100 );
function fox56_deregister_styles() {

    if ( get_theme_mod( 'disable_dashicons' ) ) {
        if ( ! is_user_logged_in() && ! is_customize_preview() ) {
            wp_deregister_style( 'dashicons' );
        }
    }

    if ( get_theme_mod( 'disable_woocommerce_css' ) ) {

        if ( ! fox56_is_woocommerce_related() ) {
            wp_deregister_style( 'woocommerce-layout' );
            wp_deregister_style( 'woocommerce-smallscreen' );
            wp_deregister_style( 'woocommerce-general' );
            wp_deregister_style( 'wc-blocks-style' );
        }

    }

    if ( get_theme_mod( 'disable_contactform7_css' ) ) {
        if ( ! is_page() ) {
            wp_deregister_style( 'contact-form-7' );
        }
    }
}

/* ---------------------------------------------------------------- Remove Gutenberg Block Library CSS from loading on the frontend */
function fox56_remove_wp_block_library_css() {
    if ( ! fox56_has_single_content() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    }
} 
add_action( 'wp_enqueue_scripts', 'fox56_remove_wp_block_library_css', 100 );

// remove unnecessary CSS on the homepage post count plugin css
add_action( 'wp_enqueue_scripts', function() {
    wp_deregister_style( 'post-views-counter-frontend' );
    wp_dequeue_style( 'post-views-counter-frontend' );
    if ( is_home() ) {
        wp_deregister_style( 'jetpack_css' );
        wp_dequeue_style( 'jetpack_css' );
    }
});

/* ---------------------------------------------------------------- misc */
add_filter( 'wp_lazy_loading_enabled', '__return_true' );
update_option( 'sbi_plugin_do_activation_redirect', false, false ); // disable redirect after activation so that it won't break demo

/* ---------------------------------------------------------------- dark mode */
add_action( 'wp_body_open', function() { ?>
<script>
function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}
let cookie_prefix = 'fox_<?php echo get_current_blog_id(); ?>_'
let user_darkmode = readCookie( cookie_prefix + 'user_darkmode' );
if ( 'dark' == user_darkmode ) {
    document.body.classList.add('darkmode');
} else if ( 'light' == user_darkmode ) {
    document.body.classList.remove('darkmode');
}
</script>
<?php }, 0 );

/**
 * add theme class
 * since 6.3
 */
add_action( 'body_class', 'fox56_add_fox_theme_class' );
function fox56_add_fox_theme_class( $classes ) {
    $classes[] = 'the-fox';
    return $classes;
}