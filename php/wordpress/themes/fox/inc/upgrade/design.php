<?php
/* deprecated
====================================================================================================== */
$this->log([
    'heading_color',

    'dropcap_style',
    'caption_align',
    'titlebar_user_max_width',
    'titlebar_user_social_style',
    'titlebar_overlay_opacity',

    'post_header_box',

    'offcanvas_close_icon_image',
    'offcanvas_close_icon_image_width',
], 'deprecated' );

/* general
====================================================================================================== */
$this->set( 'text_color', '#000000' );
$this->set( 'link_color', '#db4a37' );
$this->set( 'link_hover_color', '#db4a37' );
$this->set( 'accent_color', '#db4a37', 'accent' );
$this->set( 'border_color', '#e1e1e1' );
$this->set( 'selection_background' );
$this->set( 'selection_text_color' );

/* --------------       DARK MODE */
$mode = get_theme_mod( 'wi_mode', 'light' );
if ( 'dark' == $mode ) {
    $this->set_theme_mod( 'darkmode', true );
} else {
    $this->set_theme_mod( 'darkmode', false );
}
$this->set( 'darkmode_text_color' );
$this->set( 'darkmode_background_color' );
$this->log( 'mode' );

/* LAYOUT
====================================================================================================== */
$this->set( 'container_width', 1080, 'content_width' );
$this->set( 'sidebar_width', 265 );
$this->set( 'sticky_sidebar', 'false' );

$layout = get_theme_mod( 'wi_body_layout', 'wide' ) == 'boxed' ? 'boxed' : 'wide';

/* --------------       BOXED LAYOUT */
if ( 'boxed' == $layout ) {

    $this->set_theme_mod( 'layout_boxed', true );
    $all_box = $this->get_nice_box( 'all' );
    if ( isset( $all_box['margin']['desktop']['top'] ) && $all_box['margin']['desktop']['top'] ) {
        $this->set_theme_mod( 'inner_margin', $all_box['margin']['desktop']['top'] );
    }

    $this->set_background( 'body_background' );
    
    // hand drawn
    $this->set( 'hand_drawn', 'false' );

}
// wrapper box
$wrapper_box = $this->get_nice_box( 'wrapper' );
$border_arr = [];
if ( isset( $wrapper_box['border']['desktop'] ) && $wrapper_box['border']['desktop'] ) {
    $border_arr = $wrapper_box['border']['desktop'];
}
if ( isset( $wrapper_box['border-color']) && $wrapper_box['border-color'] ) {
    $border_arr['color'] = $wrapper_box['border-color'];
}

$this->log( 'body_layout' );
$this->log([
    'all_box',
    'wrapper_box',
    'hand_drawn'
]);

$content_background = get_theme_mod( 'wi_content_background', '#ffffff' );
$opacity = absint( get_theme_mod( 'wi_content_background_opacity', 100 ) ) / 100;
list($r_val, $g_val, $b_val) = sscanf( $content_background, "#%02x%02x%02x" );
$a_val = $opacity;
$rgba = "rgba({$r_val},{$g_val},{$b_val},{$a_val})";

if ( 'boxed' == $layout ) {
    $this->set_theme_mod( 'inner_background', [
        'color' => $rgba
    ]);
    $this->set_theme_mod( 'inner_border', $border_arr );
    if ( isset( $wrapper_box['padding']['desktop']['top'] ) && $wrapper_box['padding']['desktop']['top'] ) {
        $this->set_theme_mod( 'inner_padding', $wrapper_box['padding']['desktop']['top'] );
    }
} else {
    $this->set_theme_mod( 'body_background', [
        'color' => $rgba
    ]);
    $this->set_theme_mod( 'body_border', $border_arr );
}

$this->log([
    'body_background',
    'content_background',
    'content_background_opacity',
]);

/* FORM INPUT BUTTON
====================================================================================================== */
/* --------------       BUTTON */
$radius = absint( get_theme_mod( 'wi_button_border_radius' ) );
$this->set_theme_mod( 'button_border_radius', $radius );

$this->log([
    'button_border_radius'
]);

/* --------------       INPUT */
/**
* INPUT
*/
$this->set( 'input_color' );
$this->set( 'input_background' );
$this->set( 'input_focus_color' );
$this->set( 'input_focus_background' );
$box = $this->get_nice_box( 'input' );
if ( isset( $box['desktop'][ 'border' ][ 'top' ] ) && $box['desktop'][ 'border' ][ 'top' ] ) {
    $this->set_theme_mod( 'input_border_width', absint( $box['desktop'][ 'border' ][ 'top' ] ) );
}
if ( isset( $box['border-color'] ) && $box['border-color'] ) {
    $this->set_theme_mod( 'input_border_color', $box['border-color'] );
    $this->set_theme_mod( 'input_focus_border_color', $box['border-color'] );
} else {
    $this->set_theme_mod( 'input_border_color', $general_border_color );
    $this->set_theme_mod( 'input_focus_border_color', $general_border_color );
}
$this->log('input_box');

/* WIDGET
====================================================================================================== */
/* --------------       WIDGET SEP 
#widget_sep */
if ( 'true' == get_theme_mod( 'wi_widget_sep', 'false' ) ) {
    $this->set_theme_mod( 'wid_sep', '1px' );
} else {
    $this->set_theme_mod( 'wid_sep', '0px' );
}
$this->log( 'widget_sep' );

/* --------------       WIDGET TITLE */
$this->set( 'wid_title_color', '', 'widget_title_color' );
$this->set( 'wid_title_background', '', 'widget_title_background_color' );
$this->set( 'wid_title_align', 'left', 'widget_title_align' );
$box = $this->get_nice_box( 'widget_title' );
$border = [];
if ( isset( $box['border']['desktop'] ) ) {
    $this->set_theme_mod( 'wid_title_border', $box['border']['desktop'] );
}
if ( isset( $box['border-color'] ) ) {
    $this->set_theme_mod( 'wid_title_border_color', $box['border-color'] );
}
if ( isset( $box['padding']['desktop'] ) ) {
    $this->set_theme_mod( 'wid_title_padding', $box['padding']['desktop'] );
}
$this->log(['widget_title_box']);

/* --------------       WIDGET TAG 
#tagcloud_style */
$this->set( 'tagcloud_style', '1' );

/* --------------       WIDGET LIST
#widget_list_style */
$widget_list_style = get_theme_mod( 'wi_widget_list_style', '1' );
if ( '3' == $widget_list_style ) {
    $typo = [
        'transform' => 'uppercase',
        'size' => 12,
        'spacing' => 1,
    ];
    $this->set_theme_mod( 'list_widget_typography', $typo );
    $this->set_theme_mod( 'list_widget_border_style', 'solid' );
    $this->set_theme_mod( 'list_widget_border_color', $general_border_color );
} elseif ( '2' == $widget_list_style ) {
    $typo = [
        'transform' => 'uppercase',
        'size' => 11,
        'spacing' => 1,
        'weight' => '700',
    ];
    $this->set_theme_mod( 'list_widget_typography', $typo );
    $this->set_theme_mod( 'list_widget_border_style', 'none' );
    $this->set_theme_mod( 'list_widget_border_color', $general_border_color );
} else {
    $this->set_theme_mod( 'list_widget_typography', [] );
    $this->set_theme_mod( 'list_widget_border_style', 'solid' );
    $this->set_theme_mod( 'list_widgdet_border_color', $general_border_color );
}
$this->log( 'widget_list_style' );

/* CAPTION
====================================================================================================== */
$this->set( 'caption_color' );

/* BLOCKQUOTE
====================================================================================================== */
$this->set_color( 'blockquote_color' );
$this->set_color( 'blockquote_background' );
$this->set( 'blockquote_align' );

$box = $this->get_nice_box( 'blockquote' );

// border
$border = [];
if ( isset( $box['border']['desktop']['top'] ) && $box['border']['desktop']['top'] ) {
    $border[ 'top' ] = $box['border']['desktop']['top'];
}
if ( isset( $box['border']['desktop']['bottom'] ) && $box['border']['desktop']['bottom'] ) {
    $border[ 'bottom' ] = $box['border']['desktop']['bottom'];
}
if ( isset( $box['border']['desktop']['left'] ) && $box['border']['desktop']['left'] ) {
    $border[ 'left' ] = $box['border']['desktop']['left'];
}
if ( isset( $box['border']['desktop']['right'] ) && $box['border']['desktop']['right'] ) {
    $border[ 'right' ] = $box['border']['desktop']['right'];
}
if ( isset( $box['border-color'] ) && $box['border-color'] ) {
    $border[ 'color' ] = $box['border-color'];
}
$this->set_theme_mod( 'blockquote_border', $border );

$this->log( 'blockquote_box' );

// style
$icon = get_theme_mod( 'wi_blockquote_quote_icon', 'true' );
if ( 'true' == $icon ) {
    $blockquote_quote_icon_style = get_theme_mod( 'wi_blockquote_quote_icon_style', 'above' );
    $this->set_theme_mod( 'blockquote_icon', $blockquote_quote_icon_style );
} else {
    $this->set_theme_mod( 'blockquote_icon', 'none' );
}
$icon_icon = get_theme_mod( 'wi_blockquote_quote_icon_icon', '1' );
$this->set_theme_mod( 'blockquote_icon_icon', $icon_icon );
$this->log([
    'blockquote_quote_icon',
    'blockquote_quote_icon_icon',
    'blockquote_quote_icon_style',
]);

/* TITLE BAR
====================================================================================================== */

/* TITLEBAR
#archive_label
#archive_description
#titlebar_user_max_width
#titlebar_subcategories
#titlebar_align
=========================================================================== */
$this->set( 'titlebar_label', 'false', 'archive_label' );
$this->set( 'titlebar_description', 'true', 'archive_description' );
// $this->set( 'titlebar_width', '600px', 'titlebar_user_max_width' );
$this->set( 'titlebar_subcategories', 'true' );
$this->set( 'titlebar_align', 'center' );

$this->set( 'titlebar_background_color', '', 'titlebar_background' );
$this->set( 'titlebar_title_color', '', 'archive_title_color' );
$this->set( 'titlebar_description_color', '', 'archive_title_color' );
$box = $this->get_nice_box( 'titlebar' );

// padding
$padding = [];
if ( isset( $box['padding']['desktop']['top'] ) && $box['padding']['desktop']['top'] ) {
    $padding[ 'desktop' ] = $box['padding']['desktop']['top'];
}
if ( isset( $box['padding']['tablet']['top'] ) && $box['padding']['tablet']['top'] ) {
    $padding[ 'tablet' ] = $box['padding']['tablet']['top'];
}
if ( isset( $box['padding']['mobile']['top'] ) && $box['padding']['mobile']['top'] ) {
    $padding[ 'mobile' ] = $box['padding']['mobile']['top'];
}
$this->set_theme_mod( 'titlebar_padding', $padding );

// border
$border = [];
if ( isset( $box['border']['desktop']['top'] ) && $box['border']['desktop']['top'] ) {
    $border[ 'top' ] = $box['border']['desktop']['top'];
}
if ( isset( $box['border']['desktop']['bottom'] ) && $box['border']['desktop']['bottom'] ) {
    $border[ 'bottom' ] = $box['border']['desktop']['bottom'];
}
$this->set_theme_mod( 'titlebar_container_border', $border );

// border color
if ( isset( $box['border-color'] ) && $box['border-color'] ) {
    $this->set_theme_mod( 'titlebar_border_color', $box['border-color'] );
}

$this->log( 'titlebar_box' );

/* BLOG POST
====================================================================================================== */
$this->set( 'post_title_color' );
$this->set( 'post_title_hover_color' );
$this->set( 'post_title_hover_text_decoraction' );
$this->set( 'post_title_hover_text_decoraction_color' );

/**
* POST META
* #post_meta_typography
*/
$this->set( 'post_meta_color' );
$this->set( 'post_meta_link_color' );
$this->set( 'post_meta_link_hover_color' );

/**
* standalone_category
* #standalone_category_style
* #standalone_category_color
* #standalone_category_background
*/
$this->set( 'standalone_category_style', 'plain' );
$this->set( 'standalone_category_color' );
$this->set( 'standalone_category_background' );

/* SINGLE POST
====================================================================================================== */
/*
#single_post_title_font
#single_post_title_color
#single_post_subtitle_font
#single_post_subtitle_color
#single_content_font
#single_heading_font
-------------------------------------------------------- */
$this->set( 'single_title_color', '', 'single_post_title_color' );
$this->set( 'single_content_color' );

/**
    * #single_heading_font
    * #single_heading_align
    * #single_heading_style
    */
$this->set( 'single_heading_align', 'center' );
$single_heading_style = get_theme_mod( 'wi_single_heading_style', 'border_top' );
if ( 'border_bottom' == $single_heading_style ) {
    $border = [ 'bottom' => 1 ];
    $this->set_theme_mod( 'single_heading_style', 'normal' );
    $this->set_theme_mod( 'single_heading_border', $border );
} elseif ( 'border_top' == $single_heading_style ) {
    $border = [ 'top' => 1 ];
    $this->set_theme_mod( 'single_heading_style', 'normal' );
    $this->set_theme_mod( 'single_heading_border', $border );
} elseif ( 'border_around' == $single_heading_style ) {
    $border = [];
    $this->set_theme_mod( 'single_heading_border', $border );
    $this->set_theme_mod( 'single_heading_style', 'around' );
} else {
    $border = [];
    $this->set_theme_mod( 'single_heading_border', $border );
    $this->set_theme_mod( 'single_heading_style', 'normal' );
}

$this->log( 'single_heading_style' );