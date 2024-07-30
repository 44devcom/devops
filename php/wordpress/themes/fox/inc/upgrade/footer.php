<?php
/*
@backtotop: true
    @backtotop_type: icon-chevron-up
    @backtotop_shape: circle
    @backtotop_border_width:
    @backtotop_border_radius:
    @backtotop_color:
    @backtotop_background_color:
    @backtotop_border_color:
    @backtotop_hover_color:
    @backtotop_hover_background_color:
    @backtotop_hover_border_color:
*/

$this->log([
    'footer_social_text',
    'footer_social_text_size',

    'footer_bottom_builder',
    'footer_bottom_layout',
], 'deprecated' );

/* FOOTER BUILDER - ELEMENTOR
====================================================================================================== */
$this->log([
    'footer_builder',
    'footer_block_id',
    'single_footer_template',
    'page_footer_template',
    'category_footer_template',
    'tag_footer_template',
    'author_footer_template',
    'search_footer_template',
    '404_footer_template',
]);

/* FOOTER INSTAGRAM
====================================================================================================== */
$this->set( 'footer_instagram_bg' );

/* SIDEBAR
====================================================================================================== */
$this->set( 'footer_sidebar', 'true' );
$this->set( 'footer_sidebar_layout', '1-1-1-1' );
$this->set( 'footer_1_align', '' );
$this->set( 'footer_2_align', '' );
$this->set( 'footer_3_align', '' );
$this->set( 'footer_4_align', '' );
$this->set( 'footer_sidebar_sep', 'true' );
$this->set( 'footer_sidebar_sep_color' );
$this->set( 'footer_sidebar_stretch', 'content' );
$this->set( 'footer_sidebar_valign', 'stretch' );
$this->set( 'footer_sidebar_skin', 'light' );
$this->set( 'footer_sidebar_color' );
$this->set_background( 'footer_sidebar_background' );

/* ----------   box */
$box = $this->get_nice_box( 'footer_sidebar' );
$padding = [];
if ( isset( $box['padding']['desktop']['top'])) {
    $padding['desktop'] = $box['padding']['desktop']['top'];
}
if ( isset( $box['padding']['tablet']['top'])) {
    $padding['tablet'] = $box['padding']['tablet']['top'];
}
if ( isset( $box['padding']['phone']['top'])) {
    $padding['mobile'] = $box['padding']['phone']['top'];
}
$this->set_theme_mod( 'footer_sidebar_padding', $padding );

$border = [];
if ( isset( $box['border']['desktop']['top'])) {
    $border['top'] = $box['border']['desktop']['top'];
}
if ( isset( $box['border']['desktop']['bottom'])) {
    $border['bottom'] = $box['border']['desktop']['bottom'];
}
if ( isset( $box['border-color'] ) ) {
    $border['color'] = $box['border-color'];
}
$this->set_theme_mod( 'footer_sidebar_border', $border );

/* ----------   footer col box */
$box = $this->get_nice_box( 'footer_col' );
$padding = [];
if ( isset( $box['padding']['desktop']['top'])) {
    $padding['desktop'] = $box['padding']['desktop']['top'];
}
if ( isset( $box['padding']['tablet']['top'])) {
    $padding['tablet'] = $box['padding']['tablet']['top'];
}
if ( isset( $box['padding']['phone']['top'])) {
    $padding['mobile'] = $box['padding']['phone']['top'];
}
$this->set_theme_mod( 'footer_sidebar_col_padding', $padding );

$this->log([
    'footer_sidebar_box',
    'footer_col_box',
]);

/* BOTTOM
====================================================================================================== */
$this->set( 'footer_bottom', 'true' );
$this->set( 'footer_bottom_layout', 'stack', 'footer_bottom_classic_layout' );
$this->set( 'footer_bottom_skin', 'light' );
$this->set( 'footer_bottom_stretch', 'content' );
$this->set( 'footer_bottom_color', '', 'footer_text_color' );
$this->set_background( 'footer_bottom_background' );

/* ------------------------------------     elements */
$elements = [];
$left = [];
$right = [];
if ( 'true' == get_theme_mod( 'wi_footer_logo_show', 'true' ) ) {
    $elements[] = 'logo';
    $left[] = 'logo';
}
if ( 'true' == get_theme_mod( 'wi_footer_social', 'true' ) ) {
    $elements[] = 'social';
    $right[] = 'social';
}
if ( 'true' == get_theme_mod( 'wi_footer_search', 'true' ) ) {
    $elements[] = 'search';
}
if ( 'true' == get_theme_mod( 'wi_footer_copyright', 'true' ) ) {
    $elements[] = 'copyright';
    $left[] = 'copyright';
}
if ( has_nav_menu( 'footer' ) ) {
    $elements[] = 'nav';
    $right[] = 'nav';
}
if ( 'inline' == get_theme_mod( 'wi_footer_bottom_classic_layout', 'stack' ) ) {
    $this->set_theme_mod( 'footer_left_elements', $left );
    $this->set_theme_mod( 'footer_right_elements', $right );
} else {
    $this->set_theme_mod( 'footer_stack_elements', $elements );
}

$this->log([
    'footer_logo_show',
    'footer_social',
    'footer_search',
    'footer_copyright',
]);

/* ------------------------------------     footer bottom box */
$box = $this->get_nice_box( 'footer_bottom' );
$padding = [];
if ( isset( $box['padding']['desktop']['top'])) {
    $padding['desktop'] = $box['padding']['desktop']['top'];
}
if ( isset( $box['padding']['tablet']['top'])) {
    $padding['tablet'] = $box['padding']['tablet']['top'];
}
if ( isset( $box['padding']['phone']['top'])) {
    $padding['mobile'] = $box['padding']['phone']['top'];
}
$this->set_theme_mod( 'footer_bottom_padding', $padding );

$border = [];
if ( isset( $box['border']['desktop']['top'])) {
    $border['top'] = $box['border']['desktop']['top'];
}
if ( isset( $box['border']['desktop']['bottom'])) {
    $border['bottom'] = $box['border']['desktop']['bottom'];
}
if ( isset( $box['border-color'] ) ) {
    $border['color'] = $box['border-color'];
}
$this->set_theme_mod( 'footer_bottom_border', $border );

$this->log( 'footer_bottom_box' );

/* FOOTER LOGO
====================================================================================================== */
$this->set_image( 'footer_logo' );
$this->set( 'footer_logo_width' );
$this->set( 'footer_logo_custom_link' );

/* FOOTER SOCIAL
====================================================================================================== */
$social_size = get_theme_mod( 'wi_footer_social_size', 'normal' );
$social_spacing = get_theme_mod( 'wi_footer_social_spacing', 'small' );
$social_shape = get_theme_mod( 'wi_footer_social_shape', 'circle' );
$social_style = get_theme_mod( 'wi_footer_social_skin', 'black' );

$this->log([
    'footer_social_size',
    'footer_social_spacing',
    'footer_social_shape',
    'footer_social_skin',
]);

if ( 'small' == $social_size ) {
    $size = 24; $font = 14;
} elseif ( 'normal' == $social_size ) {
    $size = 30; $font = 16;
} elseif ( 'bigger' == $social_size ) {
    $size = 30; $font = 17;
} elseif ( 'medium' == $social_size ) {
    $size = 36; $font = 18;
} elseif ( 'medium_plus' == $social_size ) {
    $size = 36; $font = 21;
} else {
    $size = 30; $font = 16; // safe values
}
$this->set_theme_mod( 'footer_social_icon_size', $size );
$this->set_theme_mod( 'footer_social_icon_font', $font );

// spacing
if ( 'small' == $social_spacing ) {
    $this->set_theme_mod( 'footer_social_icon_spacing', 3 );
} elseif ( 'normal' == $social_spacing ) {
    $this->set_theme_mod( 'footer_social_icon_spacing', 10 );
} elseif ( 'big' == $social_spacing ) {
    $this->set_theme_mod( 'footer_social_icon_spacing', 20 );
}

if ( 'plain' == $social_style ) {
    
    $this->set_theme_mod( 'footer_social_icon_size', 24 );
    $this->set_theme_mod( 'footer_social_icon_background', '' );
    $this->set_theme_mod( 'footer_social_icon_color', '' );
    $this->set_theme_mod( 'footer_social_icon_hover_background', '' );
    $this->set_theme_mod( 'footer_social_icon_hover_color', '' );
    $this->set_theme_mod( 'footer_social_icon_border', 0 );
    $this->set_theme_mod( 'footer_social_icon_border_radius', 0 );
    
} elseif ( 'black' == $social_style ) {

    $this->set_theme_mod( 'footer_social_icon_background', '#000' );
    $this->set_theme_mod( 'footer_social_icon_color', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_hover_background', '#000' );
    $this->set_theme_mod( 'footer_social_icon_hover_color', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_border', 0 );
    $this->set_theme_mod( 'footer_social_icon_border_radius', 30 );
    
} elseif ( 'outline' == $social_style ) {
    
    $this->set_theme_mod( 'footer_social_icon_background', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_color', '#111' );
    $this->set_theme_mod( 'footer_social_icon_border_color', '#111' );
    
    $this->set_theme_mod( 'footer_social_icon_hover_background', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_hover_color', '#111' );
    $this->set_theme_mod( 'footer_social_icon_hover_border_color', '#111' );
    
    $this->set_theme_mod( 'footer_social_icon_border', 1 );
    $this->set_theme_mod( 'footer_social_icon_border_radius', 30 );
    
} elseif ( 'fill' == $social_style ) {
    
    $this->set_theme_mod( 'footer_social_icon_background', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_color', '#111' );
    $this->set_theme_mod( 'footer_social_icon_border_color', '#111' );
    $this->set_theme_mod( 'footer_social_icon_hover_background', '#111' );
    $this->set_theme_mod( 'footer_social_icon_hover_color', '#fff' );
    $this->set_theme_mod( 'footer_social_icon_hover_border_color', '#111' );
    $this->set_theme_mod( 'footer_social_icon_border', 1 );
    $this->set_theme_mod( 'footer_social_icon_border_radius', 30 );
    
}

/**
* shape
*/
if ( 'square' == $social_shape ) {
    $this->set_theme_mod( 'footer_social_icon_border_radius', 0 );
} elseif ( 'round' == $social_shape ) {
    $this->set_theme_mod( 'footer_social_icon_border_radius', 4 );
} else {
    $this->set_theme_mod( 'footer_social_icon_border_radius', 40 );
}

$this->set( 'footer_social_icon_color', null, 'footer_social_color' );
$this->set( 'footer_social_icon_background', null, 'footer_social_background' );

/* COPYRIGHT
====================================================================================================== */
$this->set( 'footer_copyright', '&copy; [today format="Y"] All rights reserved. Powered by <a href="https://themeforest.net/item/the-fox-contemporary-magazine-theme-for-creators/11103012" target="_blank">The Fox</a>.', 'copyright' );
$this->set( 'footer_copyright_color', '', 'copyright_color' );

/* FOOTER NAV
====================================================================================================== */
// #footernav_color
$this->set( 'footernav_color' );
$this->set( 'footernav_hover_color' );
$this->set( 'footernav_active_color', '', 'footernav_hover_color' );

/* SCROLL UP
====================================================================================================== */
if ( 'false' == get_theme_mod( 'wi_backtotop', 'true' ) ) {
    $this->set_theme_mod( 'scrollup', false );
} else {
    $this->set_theme_mod( 'scrollup', true );
}
$this->log( 'backtotop' );

$backtotop_type = get_theme_mod( 'wi_backtotop_type', 'icon-chevron-up' );
$backtotop_image = get_theme_mod( 'wi_scrollup_icon_image' );
if ( $backtotop_image ) {
    $this->set_theme_mod( 'scrollup_type', 'image' );
    $this->set_theme_mod( 'scrollup_image_width', get_theme_mod( 'wi_scrollup_icon_image_width' ) );
    if ( is_numeric( $backtotop_image ) ) {
        $backtotop_image_id = $backtotop_image;
    } else {
        $backtotop_image_id = attachment_url_to_postid( $backtotop_image );
    }
    if ( $backtotop_image_id ) {
        $this->set_theme_mod( 'scrollup_image', $backtotop_image_id );
    }
} else {
    if ( 'text' == $backtotop_type ) {
        $this->set_theme_mod( 'scrollup_type', 'text' );
    } elseif ( 'icon-arrow-up' == $backtotop_type ) {
        $this->set_theme_mod( 'scrollup_type', 'icon' );
        $this->set_theme_mod( 'scrollup_icon', 'arrow_upward' );
    } elseif ( 'icon-chevron-up' == $backtotop_type ) {
        $this->set_theme_mod( 'scrollup_type', 'icon' );
        $this->set_theme_mod( 'scrollup_icon', 'chevron-thin-up' );
    } elseif ( 'icon-chevrons-up' == $backtotop_type ) {
        $this->set_theme_mod( 'scrollup_type', 'icon' );
        $this->set_theme_mod( 'scrollup_icon', 'chevrons-up' );
    }
}

$this->log([
    'backtotop_type',
    'scrollup_icon_image',
    'scrollup_icon_image_width'
]);

// SHAPE
$backtotop_shape = get_theme_mod( 'wi_backtotop_shape', 'circle' );
$backtotop_border_radius = get_theme_mod( 'wi_backtotop_border_radius' );
if ( 'circle' == $backtotop_shape ) {
    $this->set_theme_mod( 'scrollup_shape', 'circle' );
} else {
    $this->set_theme_mod( 'scrollup_shape', 'square' );
    if ( $backtotop_border_radius ) {
        $backtotop_border_radius = intval( $backtotop_border_radius );
        if ( $backtotop_border_radius >= 3 ) {
            $this->set_theme_mod( 'scrollup_shape', 'round' );
        }
    }
}

$this->log( 'backtotop_shape' );
$this->log( 'backtotop_border_radius' );

// border width
$backtotop_border_width = get_theme_mod( 'wi_backtotop_border_width', '' );
if ( '' == $backtotop_border_width ) {
    $backtotop_border_width = '1px';
}
$backtotop_border_width = str_replace( 'px', '', $backtotop_border_width );
$this->set_theme_mod( 'scrollup_border_width', intval( $backtotop_border_width ) );

$this->log( 'backtotop_border_width' );

$this->set( 'scrollup_color', '', 'backtotop_color' );
$this->set( 'scrollup_background', '', 'backtotop_background_color' );
$this->set( 'scrollup_border_color', '', 'backtotop_border_color' );
$this->set( 'scrollup_hover_color', '', 'backtotop_hover_color' );
$this->set( 'scrollup_hover_background', '', 'backtotop_hover_background_color' );
$this->set( 'scrollup_hover_border_color', '', 'backtotop_hover_border_color' );