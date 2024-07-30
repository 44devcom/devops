<?php
/**
 * abstract: 
 
 misc functions or hooks
 unclassified problems
 
 it's not helper functions
 helper functions are php functions for php-purposes
 
 */

/* Since 4.0, we replace "gettext" filter by fox_word function
 * to get a better experience and consitent code
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_word' ) ) :
function fox_word( $id = '' ) {
    
    $strings = fox_quick_translation_support();
    
    if ( ! isset( $strings[ $id ] ) ) return;
    
    $translation = get_theme_mod( 'wi_translate' );
    if ( ! $translation ) return $get = $strings[ $id ];;
    
    try {
        $translation = json_decode( $translation, true );
    } catch ( Exception $err ) {
        $translation = [];
    }
    
    $translation = ( array ) $translation;
    
    $get = isset( $translation[ $id ] ) ? $translation[ $id ] : '';
    
    if ( ! $get ) {
        $get = $strings[ $id ];
    }
    
    return $get;
    
}
endif;

/**
 * check if we're in demo version
 * @since 4.4
------------------------------------------------------------------------------------ */
function fox_is_demo() {
    
    return defined( 'FOX_DEMO_URL' );
    
}

if ( ! function_exists( 'fox_icon_search' ) ) :
/**
 * icon selection
 * custom icon since 4.7.1
------------------------------------------------------------------------------------ */
function fox_icon_search() {
    
    $img_html = '';
    $img_id = get_theme_mod( 'wi_search_icon_image' );
    if ( $img_id ) {
        $img_id = attachment_url_to_postid( $img_id );
        if ( $img_id ) {
            $img_html = wp_get_attachment_image( $img_id, 'medium' );
        }
    }
    
    if ( ! $img_html ) {
        $img_html = fox_icon_search_i();
    }
    
    return $img_html;
    
}
endif;

/**
 * search icon <i>
 * @since 4.6
 */
function fox_icon_search_i() {
    
    $icon_style = get_theme_mod( 'wi_icon_style', 'smooth' );
    if ( 'sharp' != $icon_style ) {
        $icon_style = 'smooth';
    }
    if ( 'smooth' == $icon_style ) {
        return '<i class="fa fa-search"></i>';
    } else {
        return '<i class="feather-search"></i>';
    }
    
}

/*
 * hamburger icon
 * since 4.7.1
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_icon_hamburger' ) ) :
function fox_icon_hamburger() {
    
    $img_html = '';
    $img_id = get_theme_mod( 'wi_hamburger_icon_image' );
    if ( $img_id ) {
        $img_id = attachment_url_to_postid( $img_id );
        if ( $img_id ) {
            $img_html = wp_get_attachment_image( $img_id, 'medium' );
        }
    }
    if ( $img_html ) {
        $img_html = '<span class="hamburger-open-icon">' . $img_html . '</span>';
    }
    if ( ! $img_html ) {
        $img_html = fox_icon_hamburger_i();
    }
    
    return $img_html;
    
}
endif;

if ( ! function_exists( 'fox_icon_hamburger_i' ) ) :
/**
 * icon hamburger
 * @since 4.6.2.5
 */
function fox_icon_hamburger_i() {
    
    $icon_style = get_theme_mod( 'wi_icon_style', 'smooth' );
    if ( 'sharp' != $icon_style ) {
        $icon_style = 'smooth';
    }
    if ( 'smooth' == $icon_style ) {
        return '<span class="hamburger-open-icon"><i class="fa fa-bars ic-hamburger"></i></span>';
    } else {
        return '<span class="hamburger-open-icon"><i class="feather-menu ic-hamburger"></i></span>';
    }
    
}
endif;

/*
 * off canvas close
 * since 4.7.1
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_icon_offcanvas_close' ) ) :
function fox_icon_offcanvas_close() {
    
    $img_html = '';
    $img_id = get_theme_mod( 'wi_offcanvas_close_icon_image' );
    if ( $img_id ) {
        $img_id = attachment_url_to_postid( $img_id );
        if ( $img_id ) {
            $img_html = wp_get_attachment_image( $img_id, 'medium' );
        }
    }
    if ( $img_html ) {
        $img_html = '<span class="hamburger-close-icon">' . $img_html . '</span>';
    }
    if ( ! $img_html ) {
        $img_html = fox_icon_offcanvas_close_i();
    }
    
    return $img_html;
    
}
endif;

if ( ! function_exists( 'fox_icon_offcanvas_close_i' ) ) :
/**
 * off canvas close icon
 * @since 4.7.1
 */
function fox_icon_offcanvas_close_i() {
    return '<span class="hamburger-close-icon"><i class="feather-x"></i></span>';
}
endif;

/*
 * off canvas close
 * since 4.7.1
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_icon_cart' ) ) :
function fox_icon_cart() {
    
    $img_html = '';
    $img_id = get_theme_mod( 'wi_cart_icon_image' );
    if ( $img_id ) {
        $img_id = attachment_url_to_postid( $img_id );
        if ( $img_id ) {
            $img_html = wp_get_attachment_image( $img_id, 'medium' );
        }
    }
    if ( ! $img_html ) {
        $img_html = fox_icon_cart_i();
    }
    
    return $img_html;
    
}
endif;

if ( ! function_exists( 'fox_icon_cart_i' ) ) :
/**
 * icon cart
 * @since 4.6
 */
function fox_icon_cart_i() {
    
    $icon_style = get_theme_mod( 'wi_icon_style', 'smooth' );
    if ( 'sharp' != $icon_style ) {
        $icon_style = 'smooth';
    }
    if ( 'smooth' == $icon_style ) {
        return '<i class="fa fa-shopping-cart"></i>';
    } else {
        return '<i class="feather-shopping-cart"></i>';
    }
    
}
endif;

/**
 * add post count in span for categories, archive
 * @since 4.6
------------------------------------------------------------------------------------ */
function fox_cat_count_span( $links, $args ) {
    
    // only for category, to prevent woocommerce troubles
    if ( ! isset( $args[ 'taxonomy' ] ) || $args[ 'taxonomy' ] == 'category' ) {
    
        $links = str_replace( '</a> (', '</a><span class="fox-post-count">', $links );
        $links = str_replace( ')', '</span>', $links );
        
    }
        
	return $links;
}
add_filter( 'wp_list_categories', 'fox_cat_count_span', 10, 2 );

/**
 * Filter the archives widget to add a span around post count
 */
function fox_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="fox-post-count">', $links );
    if ( false !== strpos( $links, '/a>' ) ) {
	   $links = str_replace( ')', '</span>', $links );
    }
	return $links;
}
add_filter( 'get_archives_link', 'fox_archive_count_span' );

/**
 * acadp_listings plugin no sidebar
------------------------------------------------------------------------------------ */
add_filter( 'fox_sidebar_state', 'fox_acadp_listings_nosidebar', 1000 );
function fox_acadp_listings_nosidebar( $state ) {
    if ( is_singular( 'acadp_listings' ) ) return 'no-sidebar';
    return $state;
}

/**
 * Post View Plugin Concerning
------------------------------------------------------------------------------------ */
add_filter( 'pvc_most_viewed_posts_html', 'fox_custom_most_viewed_posts_html', 10, 2 );
/**
 * @since 4.0
 */
function fox_custom_most_viewed_posts_html( $html, $args ) {
    
    return fox_err( 'This widget has been deprecated since Fox v4.5. Please use <strong>(FOX) Post List</strong> widget instead.' );

}

/**
 * Add Facebook share photo property into <head /> tag
 * @since 4.0
------------------------------------------------------------------------------------ */
// add_action( 'wp_head','fox_facebook_share_picture' );
// removed since this will be supported by SEO plugin
if ( ! function_exists( 'fox_facebook_share_picture' ) ) :
function fox_facebook_share_picture() {
    
    if ( ! is_singular() ) return;
    
    if ( ! has_post_thumbnail() ) return;

    $thumbnail = wp_get_attachment_url( get_post_thumbnail_id(),'full' );
?>

<meta property="og:image" content="<?php echo esc_url($thumbnail);?>"/>
<meta property="og:image:secure_url" content="<?php echo esc_url($thumbnail);?>" />

    <?php
}
endif;