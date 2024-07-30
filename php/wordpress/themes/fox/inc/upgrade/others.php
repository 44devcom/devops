<?php
/*
@disable_dashicons: false
@disable_polyfill: false
@translate:

@mobile_header_scroll: fixed
@mobile_header_background:
@mobile_header_color:
@mobile_logo:
@mobile_logo_height:
@hamburger_icon_font_size:

@offcanvas_width: 320
@offcanvas_padding_left: 32
@offcanvas_padding_right: 32
@offcanvas_skin: light
@offcanvas_animation: false
@offcanvas_color:
@offcanvas_background:
@offcanvas_search: true
@offcanvas_nav_font: font_nav
@offcanvas_nav_typography: {"font-style":"normal"}
@offcanvas_nav_item_height:
@offcanvas_nav_border: false
@offcanvas_social: true
@offcanvas_social_style: plain      /// deprecated
@offcanvas_social_shape: circle     /// deprecated
@offcanvas_social_size: bigger      /// deprecated
@offcanvas_social_spacing: small    /// deprecated

@offcanvas_widgets_position: after

@single_top_code:
@single_top_banner:
@single_top_banner_width:
@single_top_banner_tablet:
@single_top_banner_phone:
@single_top_banner_url:
@single_top_banner_url_target: _blank   /// deprecated - all now new tab

@single_before_code:
@single_before_banner:
@single_before_banner_width:
@single_before_banner_tablet:
@single_before_banner_phone:
@single_before_banner_url:
@single_before_banner_url_target: _blank   /// deprecated - all now new tab

@single_after_code:
@single_after_banner:
@single_after_banner_width:
@single_after_banner_tablet:
@single_after_banner_phone:
@single_after_banner_url:
@single_after_banner_url_target: _blank

@twitter_username:
@exclude_pages_from_search: false
@live_grid_list: false
@time_style: standard
@publish_update: publish
@sentence_base: word        /// deprecated since 6.x because we used `wp_trim_words`, this function is localized
@reading_speed: 250
@author_avatar_width: 32
@lightbox: true
@icon_style: smooth         /// deprecated
@social_icon_shape: light   /// deprecated
@header_code:

@comment_shortcode:     /// deprecated

@404_title:
@page_404_message:
@page_404_searchform: true

@revert_elementor_heading: false

*/

$this->log([
    'social_custom_1',
    'social_custom_1_url',
    'social_custom_1_name',
    'social_custom_2',
    'social_custom_2_url',
    'social_custom_2_name',

    'compress_files',

    'offcanvas_social_style',
    'offcanvas_social_shape',
    'offcanvas_social_size',
    'offcanvas_social_spacing',

    'single_top_banner_url_target', // new tab by default
    'single_before_banner_url_target',
    'single_after_banner_url_target',

    'live_grid_list', // deprecated, now we have builder mechanism

    'icon_style',
    'social_icon_shape',
    'comment_shortcode',

    'sentence_base',

], 'deprecated' );

/* ------------------------------------------------------ hamburger
#hamburger_icon_image
#hamburger_icon_image_width
*/
$this->set_theme_mod( 'hamburger_icon_type', 'icon' );
$this->set_theme_mod( 'hamburger_image', '' );
$hamburger_img_url = get_theme_mod( 'wi_hamburger_icon_image' );
if ( $hamburger_img_url ) {
    if ( ! is_numeric( $hamburger_img_url ) ) {
        $hamburger_img_id = attachment_url_to_postid( $hamburger_img_url );
    } else {
        $hamburger_img_id = $hamburger_img_url;
    }
    if ( $hamburger_img_id ) {
        $this->set_theme_mod( 'hamburger_icon_type', 'image' );
        $this->set_theme_mod( 'hamburger_image', $hamburger_img_id );
        $this->set_theme_mod( 'hamburger_image_width', get_theme_mod( 'wi_hamburger_icon_image_width', 32 ) );
    }
}

$this->log([
    'hamburger_icon_image',
    'hamburger_icon_image_width',
]);

$this->set( 'hamburger_size', '', 'hamburger_icon_font_size' );

/* ------------------------------------     #search_icon_image #search_icon_image_width */
$img = get_theme_mod( 'wi_search_icon_image' );
if ( $img ) {
    if ( ! is_numeric( $img ) ) {
        $img_id = attachment_url_to_postid( $img );
    } else {
        $img_id = $img;
    }
    if ( $img_id ) {
        $this->set_theme_mod( 'search_icon_image', $img_id );
    }
}
$this->set( 'search_icon_image_width' );

$this->log([
    'search_icon_image',
]);

/**
    * #cart_icon_image
    * #cart_icon_image_width
    */
$cart_img = get_theme_mod( 'wi_cart_icon_image' );
if ( $cart_img ) {
    if ( is_numeric( $cart_img ) ) {
        $cart_img_id = $cart_img;
    } else {
        $cart_img_id = attachment_url_to_postid( $cart_img );
    }
    if ( $cart_img_id ) {
        $this->set_theme_mod( 'header_cart_icon_image', $cart_img_id );
    }
}
$this->set( 'header_cart_icon_image_width', 24, 'cart_icon_image_width' );

$this->log([
    'cart_icon_image',
]);

/* 
#social
-------------------------------------------------------------------------------- */
$old_social_list = json_decode( get_theme_mod( 'wi_social', '[]' ), true );
if ( ! is_array( $old_social_list ) ) {
    $old_social_list = [];
}

$social_arr = [
    'facebook' => 'facebook|Facebook',
    'twitter' => 'twitter|Twitter',
    'instagram' => 'instagram|Instagram',
    'pinterest' => 'pinterest|Pinterest',
    'linkedin' => 'linkedin2|Linkedin',
    'youtube' => 'youtube|Youtube',
    'snapchat' => 'snapchat|Snapchat',
    'tiktok' => 'tiktok|Tiktok',
    'medium' => 'medium|Medium',
    'reddit' => 'reddit|Reddit',
    'whatsapp' => 'whatsapp|Whatsapp',
    'soundcloud' => 'soundcloud|Soundcloud',
    'spotify' => 'spotify|Spotify',
    'tumblr' => 'tumblr|Tumblr',
    'yelp' => 'yelp|Yelp',
    'vimeo' => 'vimeo|Vimeo',
    'telegram' => 'telegram|Telegram',
    'vk' => 'vk|VKontakte',
    'twitch' => 'twitch|Twitch',
    'tripadvisor' => 'tripadvisor|Tripadvisor',
    'behance' => 'behance|Behance',
    'dribbble' => 'dribbble|Dribbble',
    'flickr' => 'flickr|Flickr',
    'github' => 'github|Github',
    'paypal' => 'paypal|Paypal',
    'quora' => 'quora|Quora',
    'rss' => 'rss|RSS',
    'skype' => 'skype|Skype',
    'steam' => 'steam|Steam',
    'wordpress' => 'wordpress|WordPress',
    'yahoo' => 'yahoo|Yahoo!',
    'amazon' => 'amazon|Amazon',
    '500px' => '500px|500px',
    'weibo' => 'sina-weibo|Weibo',
    'email' => 'envelope|Email',
    'google' => 'google|Google',
];
$new_social_arr = [];

/* -----------  all icons */

foreach ( $old_social_list as $k => $v ) {
    if ( ! $v ) {
        continue;
    }
    if ( $k == 'vkontakte' ) {
        $l = 'vk';
    } elseif ( $k == 'google-play' ) {
        $l = 'google';
    } elseif ( $k == 'twitch-tv' ) {
        $l = 'twitch';
    } elseif ( $k == 'rss-2' ) {
        $l = 'rss';
    } else {
        $l = $k;
    }

    if ( isset( $social_arr[$l]) ) {
        $new_social_arr[ $l ] = $v;
    }
}

$this->set_theme_mod( 'social', $new_social_arr );
$this->log( 'social' );

/* ========================================================================     PERFORMANCE
#font_display
#disable_dashicons
#disable_polyfill
*/
$this->set( 'font_display', 'swap' );
$this->set( 'disable_dashicons', 'true' ); // we set this by default
$this->set( 'disable_the_polyfill', 'false', 'disable_polyfill' ); // we set this by default

/* ========================================================================     MOBILE
#mobile_header_scroll
#mobile_header_background
    */
$mobile_header_scroll = get_theme_mod( 'wi_mobile_header_scroll', 'fixed' );
if ( 'static' == $mobile_header_scroll ) {
    $this->set_theme_mod( 'mobile_header_sticky', false );
} else {
    $this->set_theme_mod( 'mobile_header_sticky', true );
}
$this->set( 'header_mobile_background', '', 'mobile_header_background' );
$this->set( 'header_mobile_color', '', 'mobile_header_color' );
$this->log([
    'mobile_header_scroll',
]);

/* 
#mobile_logo
#mobile_logo_height
------------------------------------ */
$logo_img_url = get_theme_mod( 'wi_mobile_logo', 0 );
if ( ! is_numeric( $logo_img_url ) ) {
    $logo_img_id = attachment_url_to_postid( $logo_img_url );
} else {
    $logo_img_id = $logo_img_url;
}
if ( $logo_img_id ) {
    $this->set_theme_mod( 'mobile_logo', $logo_img_id );
}
$this->set( 'mobile_logo_height', 24 );

$this->log([
    'mobile_logo',
]);

/* ------------------------------------------------------ offcanvas */
/* ------------------------ elements */
$offcanvas_components = [];
if ( 'false' != get_theme_mod( 'wi_offcanvas_search' ) ) {
    $offcanvas_components[] = 'search';
}
$offcanvas_components[] = 'nav'; // always
if ( 'false' != get_theme_mod( 'wi_offcanvas_social' ) ) {
    $offcanvas_components[] = 'social';
}
$this->log('offcanvas_social');
// always
$offcanvas_widgets_position = get_theme_mod( 'wi_offcanvas_widgets_position', 'after' );
if ( 'before' == $offcanvas_widgets_position ) {
    array_unshift( $offcanvas_components, 'sidebar' );
} else {
    $offcanvas_components[] = 'sidebar';
}
$this->set_theme_mod( 'offcanvas_elements', $offcanvas_components );
$this->log([
    'offcanvas_search',
    'offcanvas_widgets_position'
]);

/* ------------------------ width */
$this->set( 'offcanvas_width' );

/* ------------------------ background
#offcanvas_background */
$this->set_background( 'offcanvas_background' );

/* ------------------------ skin */
if ( 'dark' == get_theme_mod( 'wi_offcanvas_skin', 'light' ) ) {
    $this->set_theme_mod( 'offcanvas_text_color', '#fff' );
    $this->set_theme_mod( 'offcanvas_nav_item_color', 'rgba(255,255,255,.7)' );
    $this->set_theme_mod( 'offcanvas_nav_item_hover_color', 'rgba(255,255,255,.9)' );
    $this->set_theme_mod( 'offcanvas_nav_item_active_color', '#fff' );
    $this->set_theme_mod( 'offcanvas_nav_sep_color', 'rgba(255,255,255,.3)' );

    $background = get_theme_mod( 'offcanvas_background', [] );
    if ( ! isset( $background['color'] ) ) {
        $background['color'] = '#111';
    }
    $this->set_theme_mod( 'offcanvas_background', $background );
}
$this->log([
    'offcanvas_skin',
]);

/* ------------------------ animation #offcanvas_animation */
if ( 'true' == get_theme_mod( 'wi_offcanvas_animation' ) ) {
    $this->set_theme_mod( 'offcanvas_animation', true );
}
$this->log([
    'offcanvas_animation'
]);

/* ------------------------ color #offcanvas_color */
$offcanvas_color = get_theme_mod( 'wi_offcanvas_color' );
if ( $offcanvas_color ) {
    $this->set_theme_mod( 'offcanvas_text_color', $offcanvas_color );
}
$this->log([
    'offcanvas_color'
]);

/* ------------------------ padding */
$padding_left = get_theme_mod( 'wi_offcanvas_padding_left', 16 );
$this->set_theme_mod( 'offcanvas_padding', [ 'left' => absint( $padding_left ), 'top' => 16 ] );
$this->log([ 'offcanvas_padding_left' ]);
$this->log(['offcanvas_padding_right'], 'deprecated');

/* ------------------------------------------------------ offcanvas menu
#offcanvas_nav_item_height */
$height = get_theme_mod( 'wi_offcanvas_nav_item_height', 32 );
$this->set_theme_mod( 'offcanvas_nav_item_height', $height + 10 ); // for padding in css
$this->log(['offcanvas_nav_item_height']);

/* ------------------------ border */
$offcanvas_nav_border = get_theme_mod( 'wi_offcanvas_nav_border', 'false' );
if ( 'true' == $offcanvas_nav_border ) {
    $this->set_theme_mod( 'offcanvas_nav_sep', '1px' );
    $this->set_theme_mod( 'offcanvas_nav_sep_color', $general_border_color );
} else {
    $this->set_theme_mod( 'offcanvas_nav_sep', '0px' );
}
$this->log([
    'offcanvas_nav_border'
]);

/* ========================================================================     MISC */
// #twitter_username
// #header_code
// #exclude_pages_from_search
// #time_style
$this->set( 'twitter_username' );
$this->set( 'header_code' );
$this->set( 'exclude_pages_from_search', 'false' );
$this->set( 'time_style', 'standard' );

$this->set( 'page_404_title', '', '404_title' );
$this->set( 'page_404_message' );
$this->set( 'page_404_searchform', 'true' );

/* --------------------------------------- quick translation
#translate
*/
$translate = trim( strval( get_theme_mod( 'wi_translate', '[]' ) ) );
try {
    $translate_arr = json_decode( $translate, true );
} catch ( Exception $e ) {
    $translate_arr = [];
}
if ( ! is_array( $translate_arr) ) {
    $translate_arr = [];
}
$this->set_theme_mod( 'translate', $translate_arr );
$this->log( 'translate' );

// #publish_update
$publish_update = get_theme_mod( 'wi_publish_update', 'publish' );
if ( 'publish' == $publish_update ) {
    $this->set_theme_mod( 'date_type', 'publish' );
} else {
    $this->set_theme_mod( 'date_type', 'updated' );
}
$this->log( 'publish_update' );

// #reading_speed
$this->set( 'reading_speed', 250 );

// #author_avatar_width
$author_avatar_size = get_theme_mod( 'wi_author_avatar_width', 32 );
$author_avatar_size = absint( str_replace( 'px', '', $author_avatar_size ) );
$this->set_theme_mod( 'author_avatar_size', [
    'desktop' => $author_avatar_size,
    'tablet' => $author_avatar_size,
    'mobile' => $author_avatar_size,
]);

$this->log( 'author_avatar_width' );

$this->log( 'revert_elementor_heading' );

/* #lightbox 
---------------------------------------  */
if ( 'false' != get_theme_mod( 'wi_lightbox', 'true' ) ) {
    $this->set_theme_mod( 'disable_theme_lightbox', false );
} else {
    $this->set_theme_mod( 'disable_theme_lightbox', true );
}
$this->log( 'lightbox' );

/* #shop_sidebar_state
#products_per_page
#shop_column
#product_align
---------------------------------------  */
$this->set( 'shop_sidebar_state', 'no-sidebar' );
$this->set( 'products_per_page' );
$this->set( 'shop_column', '3' );
$this->set( 'product_align', 'left' );

$this->log([
    'add_to_cart_color',
    'header_cart_position',
], 'deprecated' );