<?php
$this->log([
    'masonry_dropcap',

    // standard
    'standard_thumbnail_type',
    'standard_column_layout',
    'standard_dropcap',

    // newspaper
    'newspaper_thumbnail_type',
    'newspaper_column_layout',
    'newspaper_dropcap',

    // vertical
    'vertical_thumbnail_type',

    // big
    'big_date_format',
    'big_meta_background',

    // slider
    'slider_effect',

], 'deprecated' );

$this->log([
    'big_align'
]);

/* BUILDER - ELEMENTOR
====================================================================================================== */
$this->log([
    'archive_layout_type',
    'archive_template',
    'category_template',
    'tag_template',
    'author_template',
    'search_template',
    '404_template',

    'top_area_non_duplicate', // this becomes default true

    'tag_top_area_display', // this has no value in new version, we take category as standard
    'tag_top_area_layout',  // this has no value in new version, we take category as standard
    'author_top_area_display', // this has no value in new version, we take category as standard
    'author_top_area_layout', // this has no value in new version, we take category as standard

    'first_standard', // while It's hard to maintain this layout
]);

/* ARCHIVE LAYOUT
====================================================================================================== */
/* -----------------------      layout */
$pages = [
    'category' => 'Category',
    'tag' => 'Tag',
    'archive' => 'Date / Month / Year',
    'author' => 'Author',
    'search' => 'Search',
];
foreach ( $pages as $page => $name ) {
    $layout = get_theme_mod( "wi_{$page}_layout", 'list' );
    $sidebar_state = get_theme_mod( "wi_{$page}_sidebar_state", 'sidebar-right' );
    $custom_sidebar = get_theme_mod( "wi_{$page}_sidebar", '' );
    if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
        $new_layout = 'grid';
        $col = str_replace( 'grid-', '', $layout );
        if ( 4 == $col || 5 == $col ) {
            $tablet_col = 3;
        } else {
            $tablet_col = $col;
        }
        $new_col = [
            'desktop' => $col,
            'tablet' => $tablet_col,
            'mobile' => 1,
        ];
    } elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
        $new_layout = 'masonry';
        $col = str_replace( 'masonry-', '', $layout );
        if ( 4 == $col || 5 == $col ) {
            $tablet_col = 3;
        } else {
            $tablet_col = $col;
        }
        $new_col = [
            'desktop' => $col,
            'tablet' => $tablet_col,
            'mobile' => 1,
        ];
    } elseif ( 'list' == $layout ) {
        $new_layout = 'list';
        $new_col = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    } elseif ( 'standard' == $layout ) {
        $new_layout = 'grid';
        $new_col = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    } elseif ( 'newspaper' == $layout ) {
        $new_layout = 'masonry';
        $new_col = [
            'desktop' => 2,
            'tablet' => 2,
            'mobile' => 1,
        ];
    } elseif ( 'vertical' == $layout ) {
        $new_layout = 'list';
        $new_col = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    // worst case    
    } else {
        $new_layout = 'list';
        $new_col = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    }
    $this->set_theme_mod( "{$page}_layout", $new_layout );
    $this->set_theme_mod( "{$page}_column", $new_col );
    $this->set_theme_mod( "{$page}_sidebar_state", $sidebar_state );
    $this->set_theme_mod( "{$page}_sidebar", $custom_sidebar );

    $this->log([
        "{$page}_layout",
        "{$page}_column",
        "{$page}_sidebar_state",
        "{$page}_sidebar",
    ]);
}

/* TOPAREA
====================================================================================================== */
$this->set( 'category_toparea_display', 'none', 'category_top_area_display' );
$this->set( 'tag_toparea_display', 'none', 'tag_top_area_display' );
$this->set( 'author_toparea_display', 'none', 'author_top_area_display' );

$this->set( 'category_toparea_number', 4, 'category_top_area_number' );
$this->set( 'tag_toparea_number', 4, 'tag_top_area_number' );
$this->set( 'author_toparea_number', 4, 'author_top_area_number' );

/* ------------ layout, we'll use category as standard for top area */
$layout = get_theme_mod( 'wi_category_top_area_layout', 'group-1' );
$this->log( 'category_top_area_layout' );

/* ------------- group 1 */
$params = [];
if ( 'group-1' == $layout ) {

    // GROUP LAYOUT
    $this->set_theme_mod( 'toparea_layout', 'group' );
    $big_position = get_theme_mod( 'wi_group1_big_position', 'left' );
    $group1_big_ratio = get_theme_mod( 'wi_group1_big_ratio', '2/3' );
    $this->set_theme_mod( 'toparea_group_layout', $this->group_layout_from_group1( $big_position, $group1_big_ratio ) );

    // BIG
    $this->set_theme_mod( 'toparea_big_number', 1 );
    $this->set_theme_mod( 'toparea_big_layout', 'grid' );
    $this->set_theme_mod( 'toparea_big_components', 'grid' );

    /* ------------------------ big components */
    $big_components = get_theme_mod( 'wi_group1_big_components', 'thumbnail,title,date,category,excerpt,excerpt_more' );
    if ( ! is_array( $big_components ) ) {
        $big_components = explode( ',', strval( $big_components ) );
    }
    if ( in_array( 'author_avatar', $big_components ) ) {
        $params[ 'author_avatar' ] = true;
    } else {
        $params[ 'author_avatar' ] = false;
    }
    $big_item_template = get_theme_mod( 'wi_group1_big_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $big_item_template,
        'components' => $big_components,
    ]);
    $this->set_theme_mod( 'toparea_big_components', $components_order );

    /* ------------------------ big align */
    $bigpost_align = get_theme_mod( 'wi_group1_big_align', 'center' );
    $this->set_theme_mod( 'toparea_big_align', $bigpost_align );

    /* ------------------------ big thumbnail */
    $this->set_theme_mod( 'toparea_big_thumbnail', $this->thumbnail_map( get_theme_mod( 'wi_group1_big_thumbnail', 'large' ) ) );

    /* ------------------------ big excerpt length */
    $this->set_theme_mod( 'toparea_big_excerpt_length', get_theme_mod( 'wi_group1_big_excerpt_length', 44 ) );

    /* ------------------------ big more style */
    $this->set_theme_mod( 'toparea_big_more_style', $this->more_style( get_theme_mod( 'wi_group1_big_excerpt_more_style', 'btn-primary' ) ) );

    /* ------------------------ small components */
    $this->set_theme_mod( 'toparea_medium_layout', 'list' );

    $small_components = get_theme_mod( 'wi_group1_small_components', 'thumbnail,title,date,excerpt' );
    if ( ! is_array( $small_components ) ) {
        $small_components = explode( ',', strval( $small_components ) );
    }
    $small_item_template = get_theme_mod( 'wi_group1_small_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $small_item_template,
        'components' => $small_components,
    ]);
    $this->set_theme_mod( 'toparea_medium_components', $components_order );

    /* ------------------------ small thumbnail */
    $this->set_theme_mod( 'toparea_medium_thumbnail', $this->thumbnail_map( get_theme_mod( 'wi_group1_small_thumbnail', 'landscape' ) ) );

    /* ------------------------ force options */
    $this->set_theme_mod( 'toparea_medium_excerpt_length', get_theme_mod( 'wi_group1_excerpt_length', 12 ) );
    $small_list_spacing = get_theme_mod( 'wi_group1_small_list_spacing' );
    $this->set_theme_mod( 'toparea_v_spacing', $this->v_spacing_map( $small_list_spacing ) );

} elseif ( 'group-2' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'group' );
    $group2_columns_order = get_theme_mod( 'wi_group2_columns_order', '1a-3-1b' );
    $this->set_theme_mod( 'toparea_group_layout', $this->group_layout_from_group2( $group2_columns_order ) );

    /* ------------------------ big number, medium number */
    $this->set_theme_mod( 'toparea_big_number', 1 );
    $this->set_theme_mod( 'toparea_medium_number', 1 );

    // force layout
    $this->set_theme_mod( 'toparea_big_layout', 'grid' );
    $this->set_theme_mod( 'toparea_medium_layout', 'grid' );
    $this->set_theme_mod( 'toparea_small_layout', 'grid' );

    /* ------------------------ big components */
    $big_components = get_theme_mod( 'wi_group2_big_components', 'thumbnail,title,date,category,excerpt,excerpt_more' );
    if ( ! is_array( $big_components ) ) {
        $big_components = explode( ',', strval( $big_components ) );
    }
    if ( in_array( 'author_avatar', $big_components ) ) {
        $params[ 'author_avatar' ] = true;
    } else {
        $params[ 'author_avatar' ] = false;
    }
    $big_item_template = get_theme_mod( 'wi_group2_big_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $big_item_template,
        'components' => $big_components,
    ]);
    $this->set_theme_mod( 'toparea_big_components', $components_order );

    /* ------------------------ big align */
    $bigpost_align = get_theme_mod( 'wi_group2_big_align', 'center' );
    $this->set_theme_mod( 'toparea_big_align', $bigpost_align );

    /* ------------------------ big title size */
    // $bigpost_title_size = get_theme_mod( 'wi_group2_big_title_size', 'medium' );
    // $section[ 'big_title_typography' ] = $this->title_typo_map( $bigpost_title_size );

    /* ------------------------ big excerpt length */
    $this->set_theme_mod( 'toparea_big_excerpt_length', get_theme_mod( 'wi_group2_big_excerpt_length', 32 ) );

    // big more style
    $this->set_theme_mod( 'toparea_big_more_style', $this->more_style( get_theme_mod( 'wi_group2_big_excerpt_more_style', 'btn-fill' ) ) );

    /* ------------------------ medium components */
    $medium_components = get_theme_mod( 'wi_group2_medium_components', 'thumbnail,title,date,excerpt,excerpt_more' );
    if ( ! is_array( $medium_components ) ) {
        $medium_components = explode( ',', strval( $medium_components ) );
    }
    $medium_item_template = get_theme_mod( 'wi_group2_medium_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $medium_item_template,
        'components' => $medium_components,
    ]);
    $this->set_theme_mod( 'toparea_medium_components', $components_order );

    /* ------------------------ medium thumbnail */
    $this->set_theme_mod( 'toparea_medium_thumbnail', get_theme_mod( 'wi_group2_medium_thumbnail', 'medium' ) );
    
    /* ------------------------ medium title size */
    // $medium_title_size = get_theme_mod( 'wi_group2_medium_title_size', 'normal' );
    // $section[ 'medium_title_typography' ] = $this->title_typo_map( $medium_title_size );

    /* ------------------------ medium excerpt length */
    $this->set_theme_mod( 'toparea_medium_excerpt_length', get_theme_mod( 'wi_group2_medium_excerpt_length', 40 ) );

    /* ------------------------ small components */
    $small_components = get_theme_mod( 'wi_group2_small_components', 'thumbnail,title,date' );
    if ( ! is_array( $small_components ) ) {
        $small_components = explode( ',', strval( $small_components ) );
    }
    $small_item_template = get_theme_mod( 'wi_group2_small_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $small_item_template,
        'components' => $small_components,
    ]);
    $this->set_theme_mod( 'toparea_small_components', $components_order );

    /* ------------------------ small title size */
    // $small_title_size = get_theme_mod( 'wi_group2_small_title_size', 'small' );
    // $section[ 'small_title_typography' ] = $this->title_typo_map( $small_title_size );

    /* ------------------------ small excerpt length */
    $this->set_theme_mod( 'toparea_small_excerpt_length',  get_theme_mod( 'wi_group2_small_excerpt_length', 12 ) );

    /* ------------------------ force options */
    /*
    $section_css[ 'small_excerpt_typography' ] = [
        'size' => 13,
        'line_height' => '1.3',
    ];
    $section_css[ 'medium_thumbnail_width_px' ] = [
        'desktop' => 120,
    ]; */

} elseif ( 'vertical' == $layout ) {

    /*
    $section['valign'] = 'middle';
    $section_css[ 'title_typography' ] = [
        'size' => 45,
        'size_tablet' => 38,
        'size_mobile' => 30,
    ];
    $section_css[ 'excerpt_typography' ] = [
        'size' => 18,
        'size_tablet' => 17,
        'size_mobile' => 16,
    ];
    $section_css[ 'thumbnail_border_radius' ] = '0px';
    */
    // $this->set_theme_mod( 'toparea_components', '' );
    $params[ 'valign' ] = 'middle';
    $params[ 'thumbnail_border_radius' ] = '0';

    $this->set_theme_mod( 'toparea_layout', 'list' );
    $this->set_theme_mod( 'toparea_column', [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ] );
    $this->set_theme_mod( 'toparea_thumbnail', 'large' );
    $this->set_theme_mod( 'toparea_thumbnail_width_type', 'percent' );
    $this->set_theme_mod( 'toparea_thumbnail_width_percent', [
        'desktop' => 54,
        'tablet' => 54,
        'mobile' => 30,
    ] );
    $this->set_theme_mod( 'toparea_thumbnail_text_gap', [
        'desktop' => 45,
        'tablet' => 20,
        'mobile' => 8,
    ] );

} elseif ( 'list' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'list' );
    $this->set_theme_mod( 'toparea_column', [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ] );

} elseif ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {

    $this->set_theme_mod( 'toparea_layout', 'grid' );
    $col = str_replace( 'grid-', '', $layout );
    if ( 5 == $col ) {
        $tablet_col = 3;
    } elseif ( 4 == $col ) {
        $tablet_col = 2;
    } else {
        $tablet_col = $col;
    }
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => $col,
        'tablet' => $tablet_col,
        'mobile' => 1,
    ]);

} elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {

    $this->set_theme_mod( 'toparea_layout', 'masonry' );
    $col = str_replace( 'masonry-', '', $layout );
    if ( 5 == $col ) {
        $tablet_col = 3;
    } elseif ( 4 == $col ) {
        $tablet_col = 2;
    } else {
        $tablet_col = $col;
    }
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => $col,
        'tablet' => $tablet_col,
        'mobile' => 1,
    ]);

} elseif ( 'standard' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'grid' );
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ]);

} elseif ( 'newspaper' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'masonry' );
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => 2,
        'tablet' => 2,
        'mobile' => 1,
    ]);
    
} elseif ( 'big' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'grid' );
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ]);
    
} elseif ( 'slider' == $layout || 'slider-1' == $layout ) {

    $this->set_theme_mod( 'toparea_layout', 'slider' );

} elseif ( 'slider-3' == $layout ) {
    
    $this->set_theme_mod( 'toparea_layout', 'carousel' );
    $this->set_theme_mod( 'toparea_column', [
        'desktop' => 2,
        'tablet' => 3,
        'mobile' => 1,
    ]);

}

/**
    * NON-GROUP 1, 2
    */
if ( ! in_array( $layout,[ 'group-1', 'group-2' ] ) ) {
    // components
    $components = get_theme_mod( 'wi_components', 'thumbnail,title,date,category,excerpt,excerpt_more,share' );
    if ( ! is_array( $components ) ) {
        $components = explode( ',', strval( $components ) );
    }
    if ( in_array( 'author_avatar', $components ) ) {
        $params[ 'author_avatar' ] = true;
    } else {
        $params[ 'author_avatar' ] = false;
    }
    $item_template = get_theme_mod( 'wi_item_template', '2' );
    $components_order = $this->components_from_data([
        'item_template' => $item_template,
        'components' => $components,
    ]);
    $this->set_theme_mod( 'toparea_components', $components_order );
}

/**
    * GROUP 1, 2: column spacing, sep, sep color
    */
if ( in_array( $layout,[ 'group-1', 'group-2' ] ) ) {
    $i = str_replace( 'group-', '', $layout );
    $col_spacing = get_theme_mod( "wi_group{$i}_spacing", 'normal' );
    $col_sep = get_theme_mod( "wi_group{$i}_sep_border", 'false' );
    $col_sep_color = get_theme_mod( "wi_group{$i}_sep_border_color" );

    /* ------------------------ col spacing */
    if ( 'tiny' == $col_spacing ) {
        $h_spacing = [
            'desktop' => 10,
            'tablet' => 10,
            'mobile' => 10,
        ];
    } elseif ( 'small' == $col_spacing ) {
        $h_spacing = [
            'desktop' => 20,
            'tablet' => 16,
            'mobile' => 10,
        ];
    } else {
        $h_spacing = [
            'desktop' => 40,
            'tablet' => 36,
            'mobile' => 20,
        ];
    }
    $this->set_theme_mod( 'toparea_h_spacing', $h_spacing );

    /* ------------------------ col sep */
    if ( 'true' == $col_sep ) {
        $this->set_theme_mod( 'toparea_v_sep', '1px' );
    } else {
        $this->set_theme_mod( 'toparea_v_sep', '0px' );
    }

    /* ------------------------ col sep color */
    $this->set_theme_mod( 'toparea_v_sep_color', $col_sep_color );
    
}

$str_params = [];
foreach ( $params as $k => $v ) {
    $str_params[] = "{$k} = {$v}";
}
$str_params = join( ";", $str_params );
$this->set_theme_mod( 'toparea_custom_params', $str_params );


/* PAGINATION
====================================================================================================== */
#pagination_style */
$pagination_style = get_theme_mod( 'wi_pagination_style', '1' );
$accent_color = get_theme_mod( 'wi_accent', '#db4a37' );
if ( 1 == $pagination_style ) {
    $this->set_theme_mod( 'pagination_item_color', '' );
    $this->set_theme_mod( 'pagination_item_hover_color', $accent_color );

    $this->set_theme_mod( 'pagination_item_border', 0 );
    $this->set_theme_mod( 'pagination_item_background', '' );
    $this->set_theme_mod( 'pagination_item_hover_background', '' );

// square border    
} elseif ( 2 == $pagination_style ) {
    $this->set_theme_mod( 'pagination_item_border_radius', 0 );
    $this->set_theme_mod( 'pagination_item_border', 2 );
    $this->set_theme_mod( 'pagination_item_color', '#000' );
    $this->set_theme_mod( 'pagination_item_border_color', '#000' );
    $this->set_theme_mod( 'pagination_item_hover_color', '#fff' );
    $this->set_theme_mod( 'pagination_item_hover_background', '#000' );
    $this->set_theme_mod( 'pagination_item_hover_border_color', '#000' );
} elseif ( 3 == $pagination_style ) {
    $this->set_theme_mod( 'pagination_item_background', 'rgba(0,0,0,.1)' );
    $this->set_theme_mod( 'pagination_item_hover_background', 'rgba(0,0,0,.2)' );
} elseif ( 4 == $pagination_style ) {
    $this->set_theme_mod( 'pagination_item_border_radius', 30 );
    $this->set_theme_mod( 'pagination_item_hover_color', '#fff' );
    $this->set_theme_mod( 'pagination_item_hover_background', $accent_color );
}

$this->log( 'pagination_style' );

/* POST ITEM GENERAL
====================================================================================================== */
/* components + item_template
============================================== */
$components = get_theme_mod( 'wi_components', 'thumbnail,title,date,category,excerpt,excerpt_more,share' );
if ( ! is_array( $components ) ) {
    $components = explode( ',', strval( $components ) );
}
if ( in_array( 'author_avatar', $components ) ) {
    $this->set_theme_mod( 'author_avatar', true );
} else {
    $this->set_theme_mod( 'author_avatar', false );
}
$item_template = get_theme_mod( 'wi_item_template', '1' );
$components_order = $this->components_from_data([
    'item_template' => $item_template,
    'components' => $components,
]);
$this->set_theme_mod( 'components', $components_order );
$this->log([
    'components',
    'item_template',
]);

/* #big_first_post
------------------ */
$this->set( 'big_first_post', 'true' );

// #masonry_item_creative
$this->set( 'masonry_item_creative', 'false' );

/* item_card
============================================== */
$item_card = get_theme_mod( 'wi_item_card', 'false' );
if ( in_array( $item_card, [ 'normal', 'normal_no_shadow', 'overlap', 'overlap_no_shadow' ] ) ) {
    $this->set_theme_mod( 'item_background', '#fff' );
    $this->set_theme_mod( 'item_padding', [
        'desktop' => 30,
        'tablet' => 24,
        'mobile' => 20,
    ] );
    if ( 'normal' == $item_card ) {
        $this->set_theme_mod( 'item_shadow', 2 );
    } elseif ( 'normal_no_shadow' == $item_card ) {
        $this->set_theme_mod( 'item_shadow', 0 );
    } elseif ( 'overlap' == $item_card ) {
        // deprecated56
    } elseif ( 'overlap_no_shadow' == $item_card ) {
        // deprecated56
    }
} else {
    $this->set_theme_mod( 'item_padding', [
        'desktop' => 0,
        'tablet' => 0,
        'mobile' => 0,
    ]);
}
$this->log( 'item_card' );

/* item_spacing
------------------------------------------------------------------ */
$item_spacing = get_theme_mod( 'wi_item_spacing', 'normal' );
$spacing_arr = $this->spacing_arr( $item_spacing );
$this->set_theme_mod( 'v_spacing', $spacing_arr['v'] );
$this->set_theme_mod( 'h_spacing', $spacing_arr['h'] );

$this->log( 'item_spacing' );

/* #item_border
#item_border_color
------------------------------------------------------------------ */
$item_border = get_theme_mod( 'wi_item_border', 'false' );
if ( 'true' == $item_border ) {
    $this->set_theme_mod( 'v_sep', '1px' );
    $item_border_color = get_theme_mod( 'wi_item_border_color', '#d0d0d' );
    $this->set_theme_mod( 'v_sep_color', $item_border_color );
}
$this->log([
    'item_border',
    'item_border_color',
]);

/* #align
------------------------------------------------------------------ */
$this->set( 'align', 'left' );

/* #list_spacing
#list_sep
#list_sep_color
#list_valign
------------------------------------------------------------------ */
$list_spacing = get_theme_mod( 'wi_list_spacing', 'normal' );
$this->set_theme_mod( 'v_spacing', $this->v_spacing_map( $list_spacing ) );

$list_sep = get_theme_mod( 'wi_list_sep', 'true' );
if ( 'false' != $list_sep ) {
    $this->set_theme_mod( 'h_sep', '1px' );
}
$list_sep_color = get_theme_mod( 'wi_list_sep_color', '#c0c0c0' );
$this->set_theme_mod( 'h_sep_color', $list_sep_color );

$this->log([
    'list_spacing',
    'list_sep',
    'list_sep_color',
]);
$this->log( 'list_sep_style', 'deprecated' );

/* --------------------------   valign */
$this->set( 'valign', 'top', 'list_valign' );

// #list_mobile_layout
$this->set( 'list_mobile_layout', 'list' );

/* THUMBNAIL
====================================================================================================== */
$thumbnail = get_theme_mod( 'wi_thumbnail', 'landscape' );
$map = [
    'landscape' => 'thumbnail-medium',
    'square' => 'thumbnail-square',
    'portrait' => 'thumbnail-portrait',
    'original' => 'full',
    'original_fixed' => 'full', // deprecated56
];
$thumbnail = isset( $map[ $thumbnail] ) ? $map[ $thumbnail] : $thumbnail;
$this->set_theme_mod( 'thumbnail', $thumbnail );
if ( 'custom' == $thumbnail ) {
    $thumbnail_custom = get_theme_mod( 'wi_thumbnail_custom', '' );
    if ( ! is_string( $thumbnail_custom) ) {
        $thumbnail_custom = '';
    }
    $explode = explode( 'x', $thumbnail_custom );
    $w = isset( $explode[0] ) ? $explode[0] : 600;
    $h = isset( $explode[1] ) ? $explode[1] : 600;
    $w = absint($w);
    $h = absint($h);
    $this->set_theme_mod( 'thumbnail_custom', [
        'width' => $w,
        'height' => $h,
    ]);
}

$this->log([
    'thumbnail',
    'thumbnail_custom',
]);

/*
#thumbnail_placeholder
#thumbnail_placeholder_id
------------------------------------------------------------------ */
if ( 'true' == get_theme_mod( 'wi_thumbnail_placeholder', 'true' ) ) {
    $thumbnail_placeholder_URL = get_theme_mod( 'wi_thumbnail_placeholder_id' );
    $this->set_image( 'placeholder_thumbnail', $thumbnail_placeholder_URL );
} else {
    $this->set_theme_mod( 'placeholder_thumbnail', '' );
}
$this->log([
    'thumbnail_placeholder',
    'thumbnail_placeholder_id',
]);

/*
#thumbnail_border_width
#thumbnail_border_color
------------------------------------------------------------------ */
$thumbnail_border_width = get_theme_mod( 'wi_thumbnail_border_width', '' );
$thumbnail_border_width = str_replace( 'px', '', $thumbnail_border_width );
$thumbnail_border_width = absint( $thumbnail_border_width );
$thumbnail_border_color = get_theme_mod( 'wi_thumbnail_border_color', '' );
$this->set_theme_mod( 'thumbnail_border', [
    'top' => $thumbnail_border_width,
    'right' => $thumbnail_border_width,
    'bottom' => $thumbnail_border_width,
    'left' => $thumbnail_border_width,
    'color' => $thumbnail_border_color,
]);

$this->log([
    'thumbnail_border_width',
    'thumbnail_border_color'
]);

/* #thumbnail_shape
-------------------------- */
$thumbnail_shape = get_theme_mod( 'wi_thumbnail_shape', 'acute' );
if ( 'circle' == $thumbnail_shape ) {
    $this->set_theme_mod( 'thumbnail_border_radius', '50%' );
} elseif ( 'round' == $thumbnail_shape ) {
    $this->set_theme_mod( 'thumbnail_border_radius', '4px' );
} else {
    $this->set_theme_mod( 'thumbnail_border_radius', '0px' );
}

$this->log([
    'thumbnail_shape',
]);

/* #thumbnail_hover
#thumbnail_hover_overlay
#thumbnail_hover_logo
#thumbnail_hover_logo_width
-------------------------    HOVER */
$thumbnail_hover = get_theme_mod( 'wi_thumbnail_hover', 'none' );
$this->set_theme_mod( 'thumbnail_hover_effect', $thumbnail_hover );
$this->set( 'thumbnail_hover_overlay', '#000' );

/* --------------------------    HOVER LOGO */
$thumbnail_hover_logo = get_theme_mod( 'wi_thumbnail_hover_logo' );
if ( $thumbnail_hover_logo ) {
    if ( is_numeric( $thumbnail_hover_logo) ) {
        $this->set_theme_mod( 'thumbnail_hover_logo', intval( $thumbnail_hover_logo ) );
    } else {
        $thumbnail_hover_logo_id = attachment_url_to_postid( $thumbnail_hover_logo );
        if ( $thumbnail_hover_logo_id ) {
            $this->set_theme_mod( 'thumbnail_hover_logo', $thumbnail_hover_logo_id );
        }
    }
}

/* --------------------------    HOVER LOGO WIDTH */
$thumbnail_hover_logo_width = get_theme_mod( 'wi_thumbnail_hover_logo_width', '40%' );
$thumbnail_hover_logo_width = str_replace( '%', '', $thumbnail_hover_logo_width );
$thumbnail_hover_logo_width = absint( $thumbnail_hover_logo_width );
$this->set_theme_mod( 'thumbnail_hover_logo_width', $thumbnail_hover_logo_width );

$this->log([
    'thumbnail_hover',
    'thumbnail_hover_logo',
    'thumbnail_hover_logo_width'
]);
$this->log( 'thumbnail_background', 'deprecated' );

/* #thumbnail_showing_effect
--------------------------    */
$this->set( 'thumbnail_showing_effect', 'none' );

/* --------------------------    THUMBNAIL COMPONENTS */
// #thumbnail_components
// index @deprecated56
$thumbnail_components = get_theme_mod( 'wi_thumbnail_components', 'format_indicator' );
if ( ! is_array( $thumbnail_components ) ) {
    $thumbnail_components = explode( ',', strval( $thumbnail_components ) );
}
$thumbnail_components56 = [];
if ( in_array( 'format_indicator', $thumbnail_components ) ) {
    $thumbnail_components56[] = 'format_indicator';
}
if ( in_array( 'review', $thumbnail_components ) ) {
    $thumbnail_components56[] = 'review';
}
if ( in_array( 'view', $thumbnail_components ) ) {
    $thumbnail_components56[] = 'view';
}
$this->set_theme_mod( 'thumbnail_components', $thumbnail_components56 );
$this->log( 'thumbnail_components' );

/* #thumbnail_position
-------------------------- */
$this->set( 'thumbnail_position', 'left' );

/* #thumbnail_width
-------------------------- */
$thumbnail_width = trim( strval( get_theme_mod( 'wi_thumbnail_width' ) ) );
if ( '' === $thumbnail_width ) {
    $thumbnail_width = 360; // default value
}
if ( strpos( $thumbnail_width, '%' ) !== false ) {
    $this->set_theme_mod( 'thumbnail_width_type', 'percent' );
    $this->set_theme_mod( 'thumbnail_width_percent', [
        'desktop' => absint( $thumbnail_width ),
        'tablet' => 50,
        'mobile' => 40,
    ]);
} else {
    $this->set_theme_mod( 'thumbnail_width_type', 'pixel' );
    $this->set_theme_mod( 'thumbnail_width_px', [
        'desktop' => absint( $thumbnail_width ),
        'tablet' => 260,
        'mobile' => 100,
    ]);
}

$this->log( 'thumbnail_width' );

/* TEXT
====================================================================================================== */
/* #title_tag 
-------------------------------- */
$this->set( 'title_tag', 'h2' );

/* ----------------  title size */
// $title_size = get_theme_mod( 'wi_title_size', 'normal' );
// $section_css[ 'title_typography' ] = $this->title_typo_map( $title_size );

// #display_excerpt_html
$this->set( 'display_excerpt_html', 'false' );

/* #excerpt_length
-------------------------------- */
$this->set( 'excerpt_length', 22 );

/* ----------------  
#excerpt_color
#excerpt_size */
$this->set_color( 'excerpt_color' );

// #excerpt_hellip
$this->set( 'excerpt_hellip', 'false' );

/* ----------------  #excerpt_more_style */
$excerpt_more_style = get_theme_mod( 'wi_excerpt_more_style', 'simple' );
$this->set_theme_mod( 'more_style', $this->more_style( $excerpt_more_style ) );
$this->log( 'excerpt_more_style' );

$this->log(['excerpt_more_text'], 'deprecated'); // we use quick translate instead

/* ----------------  #excerpt_size */
$excerpt_size = get_theme_mod( 'wi_excerpt_size', 'normal' );
if ( 'medium' == $excerpt_size ) {
    $section_css[ 'excerpt_typography' ] = [
        'size' => '1.1em',
        'size_tablet' => '1.1em',
        'size_mobile' => '1.1em',
    ];
} elseif ( 'small' == $excerpt_size ) {
    $section_css[ 'excerpt_typography' ] = [
        'size' => '0.85em',
        'size_tablet' => '0.85em',
        'size_mobile' => '0.85em',
    ];
}