<?php
/**
 * @since 4.0
 */
if ( ! defined( 'FOX_VERSION' ) ) {
    define( 'FOX_VERSION', '5.5.4.6' );
}
if ( ! defined( 'FOX_DEMOS_KEY' ) ) {
    define( 'FOX_DEMOS_KEY',  'fox_demos_17_' . FOX_VERSION );
}
if ( ! defined( 'FOX_PLUGINS_KEY' ) ) {
    define( 'FOX_PLUGINS_KEY',  'fox_plugins_5' . FOX_VERSION );
}

if ( ! defined( 'FOX_ADMIN_URL' ) ) define( 'FOX_ADMIN_URL', get_template_directory_uri() . '/v55/inc/admin/' );
if ( ! defined( 'FOX_ADMIN_PATH' ) ) define( 'FOX_ADMIN_PATH', get_template_directory() . '/v55/inc/admin/' );

// ADMIN
require_once get_parent_theme_file_path( '/v55/inc/admin/admin.php' ); // general admin problem
require_once get_parent_theme_file_path( '/v55/inc/admin/import.php' ); // import demo data
require_once get_parent_theme_file_path( '/v55/inc/admin/updater.php' ); // about update problem
require_once get_parent_theme_file_path( '/v55/inc/admin/auto-thumbnail.php' ); // pull thumbnails from video to post

// FUNCTIONS
require_once get_parent_theme_file_path( '/v55/inc/support.php' ); // array of things we support to validate
require_once get_parent_theme_file_path( '/v55/inc/header.php' );
require_once get_parent_theme_file_path( '/v55/inc/footer.php' );
require_once get_parent_theme_file_path( '/v55/inc/sidebar.php' );
require_once get_parent_theme_file_path( '/v55/inc/mobile.php' ); // mobile
require_once get_parent_theme_file_path( '/v55/inc/query.php' ); // query functions
require_once get_parent_theme_file_path( '/v55/inc/archive.php' ); // functions concerning archive
require_once get_parent_theme_file_path( '/v55/inc/blog-templates.php' ); // blog templates
require_once get_parent_theme_file_path( '/v55/inc/components.php' ); // components: thumbnails, date, author etc
require_once get_parent_theme_file_path( '/v55/inc/single.php' ); // single problems
require_once get_parent_theme_file_path( '/v55/inc/hero.php' ); // post hero
require_once get_parent_theme_file_path( '/v55/inc/page.php' ); // page problems
require_once get_parent_theme_file_path( '/v55/inc/review.php' ); // review system

// INCLUDE BUILDER
require_once get_parent_theme_file_path( '/v55/inc/builder/layout-options.php' ); // since 4.5
require_once get_parent_theme_file_path( '/v55/inc/builder/query-options.php' ); // since 4.5
require_once get_parent_theme_file_path( '/v55/inc/builder/heading-options.php' ); // since 4.5
require_once get_parent_theme_file_path( '/v55/inc/builder/ad-options.php' ); // since 4.5
require_once get_parent_theme_file_path( '/v55/inc/builder/design-options.php' ); // since 4.5
require_once get_parent_theme_file_path( '/v55/inc/builder/customize.php' );
require_once get_parent_theme_file_path( '/v55/inc/builder/builder.php' );

// FUNCTIONS SINCE FOX 4.3
require_once get_parent_theme_file_path( '/v55/inc/shortcodes.php' );

// PIECES
require_once get_parent_theme_file_path( '/v55/inc/banner.php' ); // ad
require_once get_parent_theme_file_path( '/v55/inc/button.php' ); // button
require_once get_parent_theme_file_path( '/v55/inc/gallery.php' ); // gallery
require_once get_parent_theme_file_path( '/v55/inc/instagram.php' ); // instagram
require_once get_parent_theme_file_path( '/v55/inc/user.php' ); // user templates
require_once get_parent_theme_file_path( '/v55/inc/generated_selectors.php' ); // generated by dev plugin
require_once get_parent_theme_file_path( '/v55/inc/styling.php' ); // all about site styling
require_once get_parent_theme_file_path( '/v55/inc/autoloadpost.php' ); // autoload next post single post

// MISC
require_once get_parent_theme_file_path( '/v55/inc/helpers.php' ); // small helper functions
require_once get_parent_theme_file_path( '/v55/inc/featured-post.php' ); // featured post
require_once get_parent_theme_file_path( '/v55/inc/misc.php' ); // various functions

// since 4.6, we no longer need this

// CUSTOMIZER
require_once get_parent_theme_file_path( '/v55/inc/customizer/fonts.php' );
require_once get_parent_theme_file_path( '/v55/inc/customizer/customizer.php' );
require_once get_parent_theme_file_path( '/v55/inc/customizer/register.php' );

// WIDGETS
require_once get_parent_theme_file_path ( '/v55/widgets/about/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/authorbox/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/button/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/latest-posts/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/social/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/media/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/facebook/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/instagram/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/pinterest/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/ad/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/best-rated/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/authorlist/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/imagebox/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/imagetext/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/coronavirus/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/mc4wp/register.php' );

// HEADER BUILDER WIDGETS
require_once get_parent_theme_file_path ( '/v55/widgets/header-logo/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/header-nav/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/header-search/register.php' );

// FOOTER WIDGETS
require_once get_parent_theme_file_path ( '/v55/widgets/footer-logo/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/copyright/register.php' );
require_once get_parent_theme_file_path ( '/v55/widgets/footer-nav/register.php' );

// PLUGIN COMPATIBILITY
require_once get_parent_theme_file_path( '/v55/inc/plugin.woocommerce.php' );
require_once get_parent_theme_file_path( '/v55/inc/plugin.polylang.php' );
require_once get_parent_theme_file_path( '/v55/inc/plugin.wpml.php' );

// LEGACY
// require_once get_parent_theme_file_path( '/inc/legacy/shortcodes.php' );
// require_once get_parent_theme_file_path( '/inc/legacy/wi.php' );

/**
 * Content Width
 * @since 1.0
 */
global $content_width;
if ( ! isset( $content_width ) ) {
    $get_content_width = trim( get_theme_mod( 'wi_content_width' ) );
    if ( $get_content_width == '' ) {
        $get_content_width = 1080;
    }
    if ( is_numeric( $get_content_width ) ) {
        $content_width = $get_content_width;
    }
}

/**
 * After Setup Theme
 * @since 4.0
 */
add_action( 'after_setup_theme', 'fox_setup' );
function fox_setup() {
    
    // translation
	load_theme_textdomain( 'wi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

    // title tag
    add_theme_support( 'title-tag' );

    // post thumbnail
    add_theme_support( 'post-thumbnails' );
    
    // add_image_size( 'tiny', 60, 9999, false );  // for lazyload
	add_image_size( 'thumbnail-medium', 480, 384, true );  // medium landscape
    add_image_size( 'thumbnail-square', 480, 480, true );  // medium square
    add_image_size( 'thumbnail-portrait', 480, 600, true );  // medium portrait
    add_image_size( 'thumbnail-large', 720, 480, true );  // large landscape
    add_image_size( 'thumbnail-medium-nocrop', 480, 9999, false );  // medium thumbnail no crop
    
    // deprecated since 4.0
    // add_image_size( 'thumbnail-big', 1020, 510, true );  // big thumbnail (ratio 2:1)
    // add_image_size( 'thumbnail-vertical', 9999, 500, false );  // vertical image used for gallery
    
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => 'Primary Menu',
        'mobile' => 'Off-Canvas Menu',
        'footer' => 'Footer Menu',
        'search-menu' => 'Modal Search Suggestion',
	) );
    
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
    
    // since 4.0
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    // align wide
    // since 4.3
    add_theme_support( 'align-wide' );

}

/**
 * Register Widgets
 * @since 4.0
 */
add_action( 'widgets_init', 'fox_widgets_init' );
function fox_widgets_init() {
    
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
    
    $sidebars[ 'header' ] = [
        'name' => 'After Logo',
        'desc' => 'In case you wanna display some ad after the logo',
    ];
    
    $sidebars[ 'before-header' ] = [
        'name' => 'Before Header',
        'desc' => 'In case you wanna insert some banner before the header',
    ];
    
    $sidebars[ 'after-header' ] = [
        'name' => 'After Header',
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
    
    if ( 'true' == get_theme_mod( 'wi_footer_bottom_builder', 'false' ) ) {
    
        $sidebars[ 'footer-bottom-stack' ] = [
            'name' => 'Footer Bottom Stack',
            'desc' => 'Drag your widgets here if you choose Footer Bottom: Stack Layout',
        ];

        $sidebars[ 'footer-bottom-left' ] = [
            'name' => 'Footer Bottom Left',
            'desc' => 'Drag your widgets here if you choose Footer Bottom: Left - Right Layout',
        ];

        $sidebars[ 'footer-bottom-right' ] = [
            'name' => 'Footer Bottom Right',
            'desc' => 'Drag your widgets here if you choose Footer Bottom: Left - Right Layout',
        ];
        
    }
    
    if ( 'true' == get_theme_mod( 'wi_header_builder', 'false' ) ) {
    
        $query[ 'autofocus[section]' ] = 'wi_header_builder';
        $section_link = add_query_arg( $query, admin_url( 'customize.php' ) );

        $sidebars[ 'header-builder' ] = [
            'name' => 'Header Builder',
            'desc' => 'Drag header widgets (ie. header elements) here to build your own header. To use header builder, you must enable it in <a href="' . $section_link . '" target="_blank">Customize > Header > Header Builder</a>',
        ];
        
    }
    
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

/**
 * Enqueue CSS & JS
 * @since 4.0
 */
add_action( 'wp_enqueue_scripts', 'fox_enqueue_scripts' );
function fox_enqueue_scripts() {
    
    // loads google fonts
    $gg_fonts = fox_fonts();
    if ( $gg_fonts ) {
        wp_enqueue_style( 'wi-fonts', fox_fonts(), array(), FOX_VERSION );
    }
    
    $compress = ( 'true' == get_theme_mod( 'wi_compress_files', 'true' ) );
    if ( defined( 'LOCALHOST' ) && LOCALHOST ) {
        $compress = false;
    }
    
    // Load our main stylesheet.
    if ( ! $compress || is_child_theme() ) {
        if ( defined( 'FOX_CHILD_VERSION' ) ) {
            $version = FOX_CHILD_VERSION;
        } else {
            $version = FOX_VERSION;
        }
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.min.css', null, FOX_VERSION );
        wp_enqueue_style( 'style', get_stylesheet_uri(), [ 'parent-style' ], $version );
    } else {
        wp_enqueue_style( 'style', get_theme_file_uri( 'style.min.css' ), null, FOX_VERSION );
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    // facebook
    wp_register_script( 'wi-facebook', 'https://connect.facebook.net/en_US/all.js#xfbml=1', false, '1.0', true );
    
    // main
    if ( ! $compress ) {
        
        wp_enqueue_script( 'imagesloaded', get_theme_file_uri( '/v55/js/imagesloaded.pkgd.min.js' ), array( 'jquery' ), '3.1.8' , true );
        wp_enqueue_script( 'wi-magnific-popup', get_theme_file_uri( '/v55/js/jquery.magnific-popup.js' ), array( 'jquery' ), '1.1.0' , true ); // since 4.0
        wp_enqueue_script( 'tooltipster', get_theme_file_uri( '/v55/js/tooltipster.bundle.min.js' ), array( 'jquery' ), '4.2.6' , true ); // since 4.0
        
        wp_enqueue_script( 'easing', get_theme_file_uri( '/v55/js/jquery.easing.1.3.js' ), array( 'jquery' ), '1.3' , true );
        wp_enqueue_script( 'fitvids', get_theme_file_uri( '/v55/js/jquery.fitvids.js' ), array( 'jquery' ), '1.0' , true );
        wp_enqueue_script( 'flexslider', get_theme_file_uri( '/v55/js/jquery.flexslider.js' ), array( 'jquery' ), '2.7.2' , true );
        wp_enqueue_script( 'inview', get_theme_file_uri( '/v55/js/jquery.inview.min.js' ), array( 'jquery' ), '1.0' , true );
        wp_enqueue_script( 'fox-masonry', get_theme_file_uri( '/v55/js/masonry.pkgd.min.js' ), array( 'jquery' ), '4.2.2' , true );
        wp_enqueue_script( 'matchMedia', get_theme_file_uri( '/v55/js/matchMedia.js' ), array( 'jquery' ), '1.0' , true );
        wp_enqueue_script( 'wi-slick', get_theme_file_uri( '/v55/js/slick.min.js' ), array( 'jquery' ), '1.8.0' , true );
        wp_enqueue_script( 'theia-sticky-sidebar', get_theme_file_uri( '/v55/js/theia-sticky-sidebar.js' ), array( 'jquery' ), '1.3.1' , true );
        wp_enqueue_script( 'fox-modernizr', get_theme_file_uri( '/v55/js/modernizr-custom.js' ), array( 'jquery' ), FOX_VERSION , true );
        
        // since 4.0
        wp_enqueue_script( 'superfish', get_theme_file_uri( '/v55/js/superfish.js' ), array( 'jquery' ), '1.7.9' , true );
        
        wp_enqueue_script( 'wi-main', get_theme_file_uri( '/v55/js/main.js' ), array( 'jquery', 'wp-mediaelement' ), FOX_VERSION , true );
        
    } else {
        
        if ( is_single() ) {
             wp_enqueue_script( 'wi-main', get_theme_file_uri( '/v55/js/theme.min.js' ), array( 'jquery', 'wp-mediaelement' ), FOX_VERSION , true );
        } else {
            wp_enqueue_script( 'wi-main', get_theme_file_uri( '/v55/js/theme.min.js' ), array( 'jquery' ), FOX_VERSION , true );
        }
        
    }
    
    // Create a filter to add global JS data to <head />
    // @since Fox 2.2
    $jsdata = array(
        'l10n' => array( 
            'prev' => fox_word( 'previous' ), 
            'next' => fox_word( 'next' ),
            'loading' => esc_html__( 'Loading..', 'wi' ),
        ),
        'enable_sticky_sidebar'=> ( 'true' == get_theme_mod( 'wi_sticky_sidebar', 'false' ) ),
        
        // @since 2.8
        'enable_sticky_header' => ( 'false' != get_theme_mod( 'wi_header_sticky', 'true' ) ),
        
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => get_site_url( '/' ),
        'nonce' => wp_create_nonce( 'nav_mega_nonce' ),
        
        'resturl_v2' => get_rest_url( null, '/wp/v2/', 'rest' ),
        'resturl_v2_posts' => get_rest_url( null, '/wp/v2/posts/', 'rest' ),
        
        'tablet_breakpoint' => 840,
        
        'enable_lightbox' => (bool) ( 'true' == get_theme_mod( 'wi_lightbox', 'true' ) ), // since 4.5
    );
    
    if ( fox_autoload() && ! is_customize_preview() ) {
        
        wp_enqueue_script( 'scrollspy', get_theme_file_uri( '/v55/js/scrollspy.js' ), array('jquery'), FOX_VERSION, true );
        wp_enqueue_script( 'autoloadpost', get_theme_file_uri( '/v55/js/autoloadpost.js' ), array('jquery', 'scrollspy'), FOX_VERSION, true );
        wp_enqueue_script( 'history', get_theme_file_uri( '/v55/js/jquery.history.js' ), array('jquery'), FOX_VERSION, true );
        $jsdata[ 'enable_autoload' ] = true;
        
    }
    
    $jsdata = apply_filters( 'jsdata', $jsdata );
	wp_localize_script( 'wi-main', 'WITHEMES', $jsdata );

}

/**
 * remove font awesome lib from elementor completely
 * @since 4.0
 */
function fox_remove_fontawesome_elementor() {
    wp_deregister_style( 'font-awesome'); 
    wp_dequeue_style( 'font-awesome' );
}
add_action( 'wp_enqueue_scripts', 'fox_remove_fontawesome_elementor', 50 );
add_action( 'elementor/frontend/after_enqueue_styles', 'fox_remove_fontawesome_elementor' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 2.8
 */
function fox_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'fox_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 * @since 2.8
 */
function fox_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'fox_pingback_header' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since 2.8
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function fox_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'wi-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'fox_resource_hints', 10, 2 );

/**
 * head code / legacy
------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_add_head_code' ) ) :
/**
 * Head Code
 * You can enter custom code into <head /> tag
 * Just a legacy
 * @since 1.0
 */
add_action( 'wp_head' , 'fox_add_head_code' );
function fox_add_head_code() {
	echo trim( get_theme_mod( 'wi_header_code' ) );
}
endif;

/**
 * since 4.7.1.2
 */
add_filter( 'wpseo_breadcrumb_single_link', 'fox_remove_title_from_wpseo_breadcrumb' );
function fox_remove_title_from_wpseo_breadcrumb( $link_output) {
	if( strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
   	return $link_output;
}

/**
 * print Fox version
 * @since 4.6 for debugging
 * updated since 5.3.2
------------------------------------------------------------------------------------------------ */
add_action( 'wp_footer', 'fox_debug_info' );
function fox_debug_info() {
    
    $info = [];
    
    // 01 - theme version
    $info[ 'fox_version' ] = FOX_VERSION;
    
    // 02 - dine elementor version
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

/* PERFORMANCE OPTIONS
 * since 5.5.2
------------------------------------------------------------------------------------------------ */
/**
 * Disable Polyfill Script
 */
function wi_deregister_polyfill() {

    $disable_poly = false;
    if ( 'true' == get_theme_mod( 'wi_disable_polyfill', 'false' ) ) {
        $disable_poly = true;
    }

    if ( is_admin() || ( function_exists( 'bbp_is_single_user_edit' ) && bbp_is_single_user_edit() ) ) {
        $disable_poly = false;
    }

    if ( $disable_poly ) {
        wp_deregister_script( 'wp-polyfill' );
    }

}

/**
 * since 5.5.2
 */
add_action( 'wp_print_styles', 'wi_deregister_dashicons', 100 );
function wi_deregister_dashicons() { 
    if ( 'true' == get_theme_mod( 'wi_disable_dashicons', 'false' ) && ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}

/* HOVER CARD
 * since 5.5.3
------------------------------------------------------------------------------------------------ */
add_action( 'wp_ajax_fetch_preview_post', 'wi_fetch_preview_post' );
add_action( 'wp_ajax_nopriv_fetch_preview_post', 'wi_fetch_preview_post' );
function wi_fetch_preview_post() {
    
    /**
     * nonce check
     */
    $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    if ( ! wp_verify_nonce( $nonce, 'nav_mega_nonce' ) ) {
        die ( 'Busted!');   
    }
    
    /**
     * get post
     */
    $postid = isset( $_POST[ 'postid' ] ) ? $_POST[ 'postid' ] : [];
    $p = get_post( $postid );
    
    if ( $p ) {
        
        ob_start();
        $cl = [ 'hovercard-post' ];
        
        $img_id = get_post_thumbnail_id( $postid );
        $img = null;
        if ( $img_id ) {
            $img = wp_get_attachment_image_src( $img_id, 'medium' );
            $w = $img[1];
            $h = $img[2];
            if ( $w/$h < 0.9 ) {
                $cl[] = 'hovercard-side';
            }
        }
        
        ?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <?php
        if ( $img ) { ?>
    <figure class="hovercard-thumbnail">
        <a href="<?php echo get_permalink( $p ); ?>">
            <?php echo wp_get_attachment_image( $img_id, 'medium' ); ?>
        </a>
    </figure>
    <?php } ?>
    <div class="hovercard-text">
        <h3 class="hovercard-title">
            <a href="<?php echo get_permalink( $p ); ?>">
            <?php echo get_the_title( $p ) ?>
            </a>
        </h3>
        <div class="hovercard-excerpt"><?php echo get_the_excerpt( $p ); ?></div>
    </div><!-- .hovercard-text -->
</div>
<?php
        $json = [
            'html' => ob_get_clean()
        ];
        
        echo json_encode( $json );
        die();
    }
    
}

add_action( 'body_class', 'fox_link_hovercard_poss_class' );
function fox_link_hovercard_poss_class( $cl ) {
    if ( 'true' == get_theme_mod( 'wi_link_hovercard', 'false' ) ) {
        $cl[] = 'has-link-hovercard';
    }
    return $cl;
}

function fox55_remove_widgets_block_editor() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'fox55_remove_widgets_block_editor' );