<?php
/* deprecated
====================================================================================================== */
$this->log([
    'single_template',
    'single_breadcrumbs',

    'link_hovercard', // wikipedia idea, but should wait for future development
    'single_column_layout',
    'single_dropcap',

    'single_hero_full_overlay_bg', // hard to maintain
    'single_hero_full_overlay_opacity', // hard to maintain

    'single_format_gallery_slider_effect',
    'single_format_gallery_slider_size',

], 'deprecated' );

/* elementor stuffs
====================================================================================================== */
$this->log([
    'single_layout_type',
]);

/* LAYOUT: style, sidebar state, sidebar
====================================================================================================== */
$this->set( 'single_style', '1' );
$this->set( 'single_sidebar_state', 'sidebar-right' );
$this->set( 'single_sidebar' );

// #single_padding_top
$single_padding_top = trim( get_theme_mod( 'wi_single_padding_top', '' ) );
if ( '' !== $single_padding_top ) {
    $single_padding_top = absint( $single_padding_top );
    $this->set_theme_mod( 'single_padding_top', [
        'desktop' => $single_padding_top,
        'tablet' => round( 0.5 * $single_padding_top ),
        'mobile' => round( 0.2 * $single_padding_top ),
    ]);
}
$this->log( 'single_padding_top' );

/* #single_components
------------------------------------------------------------ */
$components = get_theme_mod( 'wi_single_components', [ 'date', 'category','post_header', 'thumbnail', 'share', 'tag', 'related', 'authorbox','comment', 'nav', 'bottom_posts', 'side_dock' ] );
if ( ! is_array( $components ) ) {
    $components = explode(',', strval( $components) );
}
$this->log( 'single_components' );

/* #share_positions
------------------------------------------------------------ */
$share_positions = get_theme_mod( 'wi_share_positions', 'after' );
if ( ! is_array( $share_positions ) ) {
    $share_positions = explode( ',', $share_positions );
}
if ( in_array( 'side', $share_positions )) {
    $share_positions[] = 'after';
}

$this->log( 'share_positions' );

// thumbnail
if ( ! in_array( 'thumbnail', $components ) ) {
    $this->set_theme_mod( 'disable_single_thumbnail', true );
} else {
    $this->set_theme_mod( 'disable_single_thumbnail', false );
}

/* SINGLE HEADER
====================================================================================================== */
$header_possible_components = [ 'date', 'category','author', 'author_avatar', 'comment_link', 'reading_time', 'view' ];

/* 
#subtitle_position
#review_positions
------------------------------------------------------------ */
$subtitle_position = get_theme_mod( 'wi_subtitle_position', 'after_title' );
$review_positions = get_theme_mod( 'wi_review_positions', 'before' );
if ( ! is_array( $review_positions ) ) {
    $review_positions = explode(',',$review_positions);
}
$this->log([
    'subtitle_position',
    'review_positions'
]);

/* #single_meta_template        */
$template = get_theme_mod( 'wi_single_meta_template', '1' );
if ( $template != 4 && $template != 2 ) { $template = 1; }
$title_arr = [ 'title' ];
$header_components = [];
if ( 'after_title' == $subtitle_position ) {
    $title_arr[] = 'subtitle';
}
foreach ( $components as $com ) {
    if ( ! in_array( $com, $header_possible_components ) ) {
        continue;
    }
    if ( 'comment_link' == $com ) {
        $com = 'comment';
    }
    if ( 'author_avatar' == $com ) {
        $this->set_theme_mod( 'single_header_author_avatar', true );
        continue;
    }
    $header_components[] = $com;
}
$final_components = [];
// title -> meta
if ( '1' == $template ) {
    $final_components = array_merge( $title_arr, $header_components );
} elseif ( '2' == $template ) {
    $final_components = array_merge( $header_components, $title_arr );
} elseif ( '4' == $template ) {
    if ( in_array( 'category', $header_components ) ) {
        $final_components[] = 'standalone_category';
    }
    $final_components = array_merge( $final_components, $title_arr );
    $final_components = array_merge( $final_components, array_diff( $header_components, ['category'] ));
}

// COMPONENTS
$this->set_theme_mod( 'single_header_elements', $final_components );

$this->log( 'single_meta_template' );

// #single_meta_align
$this->set( 'single_header_align', 'center', 'single_meta_align' );

// #single_meta_border      #single_meta_border_color
// NOTE: since 5.6, single layout 6 doesn't have the border
$single_meta_border = get_theme_mod( 'wi_single_meta_border', 'none' );
$border = [];
if ( strpos( $single_meta_border, 'top-1' ) !== false ) {
    $border['top'] = 1;
} elseif ( strpos( $single_meta_border, 'top-2' ) !== false ) {
    $border['top'] = 2;
} elseif ( strpos( $single_meta_border, 'top-3' ) !== false ) {
    $border['top'] = 3;
}
if ( strpos( $single_meta_border, 'bottom-1' ) !== false ) {
    $border['bottom'] = 1;
} elseif ( strpos( $single_meta_border, 'bottom-2' ) !== false ) {
    $border['bottom'] = 2;
}
$general_border_color = get_theme_mod( 'wi_border_color', '#e1e1e1' );
if ( ! empty( $border ) ) {
    $border['color'] = get_theme_mod( 'wi_single_meta_border_color', $general_border_color );
    $this->set_theme_mod( 'single_header_border', $border );
}

$this->log([
    'single_meta_border',
    'single_meta_border_color',
]);

// SUBTITLE DISPLAY
$this->set( 'subtitle_display', 'subtitle' );

/* BEFORE CONTENT
====================================================================================================== */
$before_content_elements = [ 'ad' ];
if ( in_array( 'before', $share_positions) ) {
    $before_content_elements[] = 'share';
}
$before_content_elements[] = 'sponsor';
if ( in_array( 'before', $review_positions)) {
    $before_content_elements[] = 'review';
}
if ( 'before_content' == $subtitle_position ) {
    $before_content_elements[] = 'subtitle';
}
$this->set_theme_mod( 'single_before_content_elements', $before_content_elements );

/* AFTER CONTENT
====================================================================================================== */
$after_content_order = get_theme_mod( 'wi_after_content_order', 'share-tag-related-authorbox-comment-nav' );
$after_content_order = explode( '-', $after_content_order );
$single_related_position = get_theme_mod( 'wi_single_related_position', 'after_main_content' );
$single_nav_position = get_theme_mod( 'wi_single_nav_position', 'after_container' );

$after_content_elements = [];
if ( in_array( 'after', $review_positions)) {
    $after_content_elements[] = 'review';
}
$after_content_elements[] = 'ad';

$map = [
    'comment' => 'comments',
    'tag' => 'tags',
];

foreach ( $after_content_order as $ele ) {
    if ( ! in_array( $ele, $components ) ) {
        continue;
    }
    $ele = isset( $map[$ele] ) ? $map[$ele] : $ele;
    if ( 'related' == $ele && 'after_main_content' != $single_related_position ) {
        continue;
    }
    if ( 'nav' == $ele && 'after_main_content' != $single_nav_position ) {
        continue;
    }
    if ( 'share' == $ele && ( ! in_array( 'after', $share_positions ) ) ) {
        continue;
    }
    $after_content_elements[] = $ele;
}
$this->set_theme_mod( 'single_after_content_elements', $after_content_elements );
$this->log([
    'single_related_position',
    'after_content_order'
]);

/* BOTTOM
====================================================================================================== */
$bottom_elements = [];
if ( in_array( 'related', $components ) && 'after_container' == $single_related_position ) {
    $bottom_elements[] = 'related';
}
if ( in_array( 'nav', $components ) && 'after_container' == $single_nav_position ) {
    $bottom_elements[] = 'nav';
}
if ( in_array( 'bottom_posts', $components ) ) {
    $bottom_elements[] = 'bottom_posts';
}
$this->set_theme_mod( 'single_bottom_elements', $bottom_elements );

$this->log( 'single_nav_position' );

/* CONTENT
====================================================================================================== */
/* CONTENT
#content_link_style
#single_content_narrow_width
#single_content_width
#single_content_image_stretch
============================================================================== */
$this->set( 'single_content_width', 'full' );
$this->set( 'single_content_narrow_width' );
$this->set( 'content_link_style', '1' );
if ( 'stretch-none' != get_theme_mod( 'wi_single_content_image_stretch', 'stretch-none' ) ) {
    $this->set_theme_mod( 'single_content_image_stretch', true );
} else {
    $this->set_theme_mod( 'single_content_image_stretch', false );
}
$this->log( 'single_content_image_stretch' );

/* THUMBNAIL
====================================================================================================== */
// #single_thumbnail_stretch
$this->set( 'single_thumbnail_stretch', 'stretch-none' );

/* SHARE
====================================================================================================== */
// #share_icons
$share_icons = get_theme_mod( 'wi_share_icons', 'facebook,messenger,twitter,pinterest,whatsapp,email' );
if ( ! is_array( $share_icons ) ) {
    $share_icons = explode( ',', $share_icons );
}
$share_icons = array_diff( $share_icons, ['messenger'] );
$this->set_theme_mod( 'share_elements', $share_icons );

// STYLE
$share_icon_style = get_theme_mod( 'wi_share_icon_style', 'default' );
if ( 'custom' == $share_icon_style ) {
    $this->set_theme_mod( 'share_stretch', 'inline' );
    $this->set_theme_mod( 'share_color_scheme', 'custom' );
} else {
    $this->set_theme_mod( 'share_stretch', 'full' );
    $this->set_theme_mod( 'share_color_scheme', 'brand' );
}
if ( 'custom' == $share_icon_style ) {

    $this->set_theme_mod( 'share_spacing', 8 );
    $this->set_theme_mod( 'share_font_size', 18 ); // by default

    // ALIGN #share_layout
    $share_layout = get_theme_mod( 'wi_share_layout', 'inline' );
    if ( 'stack' == $share_layout ) {
        $this->set_theme_mod( 'share_align', 'center' );
        $this->set_theme_mod( 'share_label', '' );
    } else {
        $this->set_theme_mod( 'share_align', 'right' );
        $this->set_theme_mod( 'share_label', 'Share this' );
    }

    // SHAPE
    $shape = get_theme_mod( 'wi_share_icon_shape', 'circle' );
    if ( 'acute' == $shape ) {
        $this->set_theme_mod( 'share_inline_border_radius', 0 );
    } elseif ( 'round' == $shape ) {
        $this->set_theme_mod( 'share_inline_border_radius', 4 );
    } else {
        $this->set_theme_mod( 'share_inline_border_radius', 40 );
    }

    // SIZE
    $share_icon_size = get_theme_mod( 'wi_share_icon_size', 32 );
    $this->set_theme_mod( 'share_width', $share_icon_size );
    $this->set_theme_mod( 'share_height', $share_icon_size );

    // COLOR
    if ( 'brand' == get_theme_mod( 'wi_share_icon_color' ) || 'brand' == get_theme_mod( 'wi_share_icon_background' ) ) {
        $this->set_theme_mod( 'share_color_scheme', 'brand' );
    } else {

        $this->set( 'share_color', '', 'share_icon_custom_color' );
        $this->set( 'share_background', '', 'share_icon_custom_background' );
        $this->set( 'share_hover_color', '#fff', 'share_icon_hover_custom_color' );
        $this->set( 'share_hover_background', '', 'share_icon_hover_custom_background' );

    }

}

$this->log([
    'share_icons',
    'share_icon_style',
    'share_layout',
    'share_icon_shape',
    'share_icon_size',
    'share_icon_color',
    'share_icon_custom_color',
    'share_icon_background',
    'share_icon_custom_background',
    'share_icon_hover_color',
    'share_icon_hover_custom_color',
    'share_icon_hover_background',
    'share_icon_hover_custom_background',
]);

$this->log([
    'share_lines'
], 'deprecated' );

/* TAGS
====================================================================================================== */

// STYLE
$tag_style = get_theme_mod( 'wi_tag_style', 'block' );
if ( 'block' == $tag_style ) {
    $this->set_theme_mod( 'tags_color', '#111' );
    $this->set_theme_mod( 'tags_border_color', '#111' );
    $this->set_theme_mod( 'tags_background', '#fff' );
    $this->set_theme_mod( 'tags_border_width', 1 );
    $this->set_theme_mod( 'tags_border_color', $general_border_color );

    $this->set_theme_mod( 'tags_hover_background', '#000' );
    $this->set_theme_mod( 'tags_hover_border_color', '#000' );
    $this->set_theme_mod( 'tags_hover_color', '#fff' );
} elseif ( 'block-2' == $tag_style ) {
    $this->set_theme_mod( 'tags_background', 'rgba(0,0,0,0.05)' );
    $this->set_theme_mod( 'tags_border_width', 0 );
    $this->set_theme_mod( 'tags_color', '#333' );

    $this->set_theme_mod( 'tags_hover_background', 'rgba(0,0,0,0.05)' );
    $this->set_theme_mod( 'tags_hover_color', '#999' );
} elseif ( 'block-3' == $tag_style ) {
    $this->set_theme_mod( 'tags_background', '#111' );
    $this->set_theme_mod( 'tags_border_color', 0 );
    $this->set_theme_mod( 'tags_color', '#eee' );

    $this->set_theme_mod( 'tags_hover_background', '#111' );
    $this->set_theme_mod( 'tags_hover_color', '#fff' );
} else {
    $this->set_theme_mod( 'tags_color', '#000' );
    $this->set_theme_mod( 'tags_background', '#fff' );
    $this->set_theme_mod( 'tags_typography', [
        'transform' => 'uppercase',
        'weight' => '700',
        'spacing' => 1,
        'size' => '0,8em',
    ]);
}

if ( 'plain' != $tag_style ) {
    $this->set_theme_mod( 'tags_typography', [
        'transform' => 'uppercase',
        'weight' => '400',
        'spacing' => 1,
        'size' => 12,
    ]);
}

$this->log([
    'tag_style',
]);

// ALIGN
$this->set( 'tags_align', 'center' );

// tag_label_show
if ( 'show' == get_theme_mod( 'wi_tag_label_show' ) ) {
    $this->set_theme_mod( 'tags_label', fox_word( 'tag_label' ) );
} else {
    $this->set_theme_mod( 'tags_label', '' );
}

$this->log([
    'tag_label_show'
]);

/* REVIEW
====================================================================================================== */
$this->set( 'review_overall_color' );
$this->set( 'review_overall_background' );
$this->set( 'review_custom_text_color', '', 'review_text_color' );
$this->set( 'review_custom_text_background', '', 'review_text_background' );

/* PROGRESS
====================================================================================================== */
$this->set( 'single_reading_progress', 'false' );
$this->set( 'reading_progress_position', 'top' );
$this->set_number( 'reading_progress_height', '5px' );
$this->set( 'reading_progress_color' );

/* AUTHOR BOX
====================================================================================================== */
// #authorbox_style
$this->set( 'authorbox_style', 'simple' );
$this->set( 'authorbox_avatar_shape', 'circle', 'single_authorbox_avatar_shape' );
$this->set( 'authorbox_width', 'narrow', 'single_authorbox_width' );

/* RELATED
====================================================================================================== */
// #single_related_number
$this->set( 'single_related_number', 3 );
$this->set( 'single_related_source', 'tag' );
$this->set( 'single_related_orderby', 'date' );
$this->set_theme_mod( 'single_related_order', strtoupper( get_theme_mod( 'wi_single_related_order', 'desc' ) ) );
$this->set( 'single_related_exclude_categories' );
$this->set( 'single_side_dock_exclude_categories', '', 'single_related_exclude_categories' );
$this->set( 'single_related_layout', 'grid-3' );

$this->log( 'single_related_order' );

$layout = get_theme_mod( 'wi_single_related_layout' );
$title_size = get_theme_mod( 'wi_single_related_title_size', '' );
if ( ! $title_size ) {
    if ( 'grid-2' == $layout ) {
        $title_size = 'normal';
    } elseif ( 'grid-3' == $layout ) {
        $title_size = 'small';
    } elseif ( 'grid-4' == $layout ) {
        $title_size = 'tiny';
    }
}
if ( $title_size ) {
    $this->set_theme_mod( 'single_related_title_typography', $this->title_typo_map( $title_size ) );
}
$this->log([
    'single_related_title_size'
]);
if ( 'list' == $layout ) {
    $this->set_theme_mod( 'single_related_components', [ 'thumbnail', 'date', 'title', 'excerpt' ] );
} else {
    $this->set_theme_mod( 'single_related_components', [ 'thumbnail', 'date', 'title' ] );
}

/* BOTTOM POSTS
====================================================================================================== */
$this->set( 'single_bottom_posts_number', 5 );
$this->set( 'single_bottom_posts_source', 'category' );
$this->set( 'single_bottom_posts_orderby', 'date' );
$this->set( 'single_bottom_posts_order', strtoupper( get_theme_mod( 'wi_single_bottom_posts_order', 'desc' ) ) );
$this->set( 'single_bottom_posts_exclude_categories' );
$bottom_post_components = [ 'thumbnail', 'title' ];
if ( 'true' == get_theme_mod( 'wi_single_bottom_posts_excerpt', 'true' ) ) {
    $bottom_post_components[] = 'excerpt';
}
$this->log( 'single_bottom_posts_excerpt' );
$this->set_theme_mod( 'single_bottom_posts_components', $bottom_post_components );

/* ADS
====================================================================================================== */
// TOP
$this->set( 'ad_single_top_code', '', 'single_top_code' );
$this->set_image( 'ad_single_top_image', null, 'single_top_banner' );
$this->set( 'ad_single_top_image_width', '', 'single_top_banner_width' );
$this->set_image( 'ad_single_top_tablet', '', 'single_top_banner_tablet' );
$this->set_image( 'ad_single_top_mobile', '', 'single_top_banner_phone' );
$this->set( 'ad_single_top_url', '', 'single_top_banner_url' );

// BEFORE CONTENT
$this->set( 'ad_single_before_content_code', '', 'single_before_code' );
$this->set_image( 'ad_single_before_content_image', null, 'single_before_banner' );
$this->set( 'ad_single_before_content_image_width', '', 'single_before_banner_width' );
$this->set_image( 'ad_single_before_content_tablet', '', 'single_before_banner_tablet' );
$this->set_image( 'ad_single_before_content_mobile', '', 'single_before_banner_phone' );
$this->set( 'ad_single_before_content_url', '', 'single_before_banner_url' );

// AFTER CONTENT
$this->set( 'ad_single_after_content_code', '', 'single_after_code' );
$this->set_image( 'ad_single_after_content_image', null, 'single_after_banner' );
$this->set( 'ad_single_after_content_image_width', '', 'single_after_banner_width' );
$this->set_image( 'ad_single_after_content_tablet', '', 'single_after_banner_tablet' );
$this->set_image( 'ad_single_after_content_mobile', '', 'single_after_banner_phone' );
$this->set( 'ad_single_after_content_url', '', 'single_after_banner_url' );

/* POST NAVIGATION
====================================================================================================== */
$this->set( 'single_nav_style', 'advanced', 'single_post_navigation_style' );
$this->set( 'single_nav_same_term', 'false', 'single_post_navigation_same_term' );
$ratio = get_theme_mod( 'wi_single_nav_image_ratio', '1000x450' );
if ( '1000x600' == $ratio ) {
    $single_nav_padding = 60;
} else {
    $single_nav_padding = 45;
}
$this->set_theme_mod( 'single_nav_padding', $single_nav_padding );
$this->log( 'single_nav_image_ratio' );

/* SIDE DOCK
====================================================================================================== */
$this->set_theme_mod( 'single_side_dock', in_array( 'side_dock', $components ) );
$this->set( 'single_side_dock_number', 2 );
$this->set( 'single_side_dock_source', 'tag' );
$this->set( 'single_side_dock_orderby', 'date' );
$this->set( 'single_side_dock_order', '' );
$this->set_theme_mod( 'single_side_dock_order', strtoupper( get_theme_mod( 'wi_single_side_dock_order', 'desc' ) ) );
$this->set( 'single_side_dock_orientation', 'up' );
$this->set( 'single_side_dock_excerpt_length', 0 );
$single_side_dock_title_size = get_theme_mod( 'wi_single_side_dock_title_size', 'tiny' );
$this->set_theme_mod( 'single_side_dock_title_typography', $this->title_typo_map( $single_side_dock_title_size ) );

$this->log( 'single_side_dock_title_size' );

/* FORMAT OPTIONS
====================================================================================================== */
$this->set( 'video_indicator_style', 'outline' );
$this->set( 'single_format_link_target', '_self' );
$this->set( 'single_format_gallery_style', 'metro' );
$this->set( 'single_format_gallery_lightbox', 'true' );
$this->set( 'single_format_gallery_grid_column', 3 );
$this->set( 'single_format_gallery_grid_size', 'landscape' );
$this->set( 'single_format_gallery_grid_size_custom', '' );

/* HERO POST
====================================================================================================== */
$this->set( 'single_hero_header', 'minimal' );
$this->set( 'min_logo', 'true' );
$this->set( 'min_logo_type' );
$this->set_image( 'logo_minimal' );
$this->set_image( 'logo_minimal_white' );
$this->set_number( 'logo_minimal_height' );

$this->set( 'hero_full_text_position', 'bottom-left', 'single_hero_full_text_layout' );
$this->set( 'single_hero_half_skin', 'light', 'single_hero_half_skin' );
$this->set( 'single_hero_scroll', 'false' );
$single_hero_scroll_style = get_theme_mod( 'wi_single_hero_scroll_style', 'arrow' );
if ( 'arrow' == $single_hero_scroll_style ) {
    $this->set_theme_mod( 'single_hero_scroll_style', 'arrow' );
} else {
    $this->set_theme_mod( 'single_hero_scroll_style', str_replace( 'btn-', '', $single_hero_scroll_style ) );
}
$this->set( 'single_hero_scroll_btn_text', 'Start Reading' );
$this->log( 'single_hero_scroll_style' );

// STANDALONE CATEGORY STYLE
$this->set( 'hero_header_category_style', 'plain', 'single_hero_meta_1_category_style' );

// META 1
$meta1 = get_theme_mod( 'wi_single_hero_meta_1_elements', 'category' );
if  (! $meta1 ) {
    $meta1 = [];
}
if ( ! is_array($meta1)) {
    $meta1 = explode( ',',$meta1);
}
$final_meta1 = [];
if ( in_array('category',$meta1)) {
    $final_meta1[] = 'standalone_category';
}
$meta1 = array_diff( $meta1, [ 'category', 'author_avatar' ]);
$final_meta1[] = 'title';
$final_meta1[] = 'subtitle';
$final_meta1 = array_merge( $final_meta1, $meta1 );
$final_meta1b = [];
foreach ( $final_meta1 as $item ) {
    if ( ! $item ) {
        continue;
    }
    if ( 'reading' == $item ) {
        $item = 'reading_time';
    }
    $final_meta1b[] = $item;
}
$this->set_theme_mod( 'hero_header_elements', $final_meta1b );

// META 2
$meta2 = get_theme_mod( 'wi_single_hero_meta_2_elements', 'author,date' );
if ( ! $meta2 ) {
    $meta2 = [];
}
if ( ! is_array($meta2)) {
    $meta2 = explode( ',',$meta2);
}
$final_meta2 = [];
foreach ( $meta2 as $item ) {
    if ( ! $item ) {
        continue;
    }
    if ( 'reading' == $item ) {
        $item = 'reading_time';
    }
    if ( 'author_avatar' == $item ) {
        continue;
    }
    $final_meta2[] = $item;
}
$this->set_theme_mod( 'hero_content_meta_elements', $final_meta2 );

$this->log([
    'single_hero_meta_1_elements',
    'single_hero_meta_2_elements',
]);

$this->log([
    'autoload_post',
    'autoload_post_nav_same_term',
], 'deprecated' );