<?php
$builder_data = fox56_builder_data();
$section_data = get_theme_mod( 'h', [] );
if ( ! is_array( $builder_data ) ) {
    $builder_data = [];
}

$uniqid = strval( uniqid() );
$section_index = 0;
$builder = [];
$sectionlist = [];

$section_transfer = isset( $section_data['transfer'] ) ? $section_data['transfer'] : [];

$first_section = true;

$std_arr = [
    'id' => 0,
    'section_name' => 'Untitled',
];
$fields = fox_builder_fields();
foreach ( $fields as $key => $field_data ) {
    if ( is_numeric( $key ) ) {
        continue;
    }
    if ( 'heading' == $field_data['type'] ) {
        continue;
    }
    $std_arr[ $key ] = isset( $field_data['std'] ) ? $field_data['std'] : null;
}

$this->log([
    'include_categories',
    'exclude_categories',
    'offset',
    'home_number',

    // rare exceptions to avoid trouble
    'exclude_sticky',
    'exclude_featured_posts',
]);

foreach ( $builder_data as $old_section ) {

    $section_index += 1;
    $section56_id = isset( $section_transfer[ $section_index ] ) ? $section_transfer[ $section_index ] : 'section_' . $uniqid. $section_index . $section_index;

    $section = [];
    $section_css = [];

    extract( wp_parse_args( $old_section, $std_arr ) );
    
    $this->blog( 'id' );

    /* GENERAL
    ================================================================== */
    // name
    $section_css[ 'section_name' ] = $section_name;
    $this->blog( 'section_name' );

    /* Main Sidebar
    ---------------------- */
    $section[ 'main_sidebar' ] = $main_sidebar;
    $section[ 'sidebar_layout' ] = $sidebar_layout;

    $this->blog( 'main_sidebar' );
    $this->blog( 'sidebar_layout' );

    /* Page
    ---------------------- */
    $section[ 'page' ] = $page;
    $this->blog( 'page' );

    /* Shortcode
    ---------------------- */
    $section[ 'html' ] = $shortcode;
    $this->blog( 'shortcode' );

    /* QUERY TAB
    if 'norm' section, It'll take values from Customize > Blog/Archive > Homepage
    for other sections, It takes values from the $section_data
    ================================================================== */
    if ( 'norm' === $id ) {

        // number
        $home_number = get_theme_mod( 'wi_home_number' );
        if ( ! $home_number ) {
            $home_number = get_option( 'posts_per_page', 10 );
        }
        $section[ 'number' ] = $home_number;

        // featured
        $section[ 'featured' ] = false; // forced
        
        // order
        $section[ 'orderby' ] = 'date';
        $section[ 'order' ] = 'DESC';
        
        // pagination
        $section[ 'pagination' ] = true; // forced
        $section[ 'disable_paged' ] = false; // yes, by default behaviour
        
        // offset
        $offset = get_theme_mod( 'wi_offset' );
        if ( $offset ) {
            $section['offset'] = $offset;
        }

        $section[ 'categories' ] = $this->mapcat_ids( get_theme_mod( 'wi_include_categories' ) );
        $section[ 'exclude_categories' ] = $this->mapcat_ids( get_theme_mod( 'wi_exclude_categories' ) );

        /**
         * exclude posts
         */
        if ( 'true' == get_theme_mod( 'wi_exclude_featured_posts' ) ) {
            $section[ 'exclude_featured' ] = true;
        }
        if ( 'true' == get_theme_mod( 'wi_exclude_sticky' ) ) {
            $section[ 'exclude_sticky' ] = true;
        }

    } else {

        $section[ 'number' ] = $number;
        $section[ 'featured' ] = $featured;
        $section[ 'orderby' ] = $orderby;
        $section[ 'order' ] = strtoupper( strval( $order ) );
        $section[ 'pagination' ] = $pagination;
        $section[ 'post_type' ] = $post_type;
        $section[ 'custom_query' ] = $custom_query;
        $section[ 'tax_1' ] = $tax_1;
        $section[ 'tax_1_value' ] = $tax_1_value;
        $section[ 'tax_2' ] = $tax_2;
        $section[ 'tax_2_value' ] = $tax_2_value;
        $section[ 'categories' ] = $this->mapcats( $categories );
        $section[ 'exclude_categories' ] = $this->mapcats( $exclude_categories );
        $section[ 'tags' ] = $tags;
        $section[ 'format' ] = $format;
        $section[ 'offset' ] = $offset;
        $section[ 'include' ] = $include;
        $section[ 'exclude' ] = $exclude;
        $section[ 'authors' ] = $this->map_authors( $authors );

        /**
         * disabled on paged, since v6 this becomes per-section rather than global
         */
        if ( 'false' == get_theme_mod( 'wi_builder_paged', 'true' ) ) {
            $section[ 'disable_paged' ] = true;
        }
    }

    $this->blog([
        'number',
        'featured',
        'orderby',
        'order',
        'pagination',
        'post_type',
        'custom_query',
        'tax_1',
        'tax_1_value',
        'tax_2',
        'tax_2_value',

        'tags',
        'format',
        'offset',
        'include',
        'exclude',

        'categories',
        'exclude_categories',
        'authors',
    ]);

    // sticky is deprecated because It's heavy
    $this->blog([
        'sticky',

        'masonry_dropcap',
        'first_standard',

        'thumbnail_type',
    ], 'deprecated' );

    /* Things for norm section
    ------------------------------------------------------------------ */
    if ( 'norm' === $id ) {
        $layout = get_theme_mod( 'wi_home_layout', 'list' );
        $column = get_theme_mod( 'wi_column', 3 );
        $sidebar_state = get_theme_mod( 'wi_home_sidebar_state', 'sidebar-right' );
        if ( 'sidebar-right' == $sidebar_state ) {
            $sidebar = 'sidebar';
            $sidebar_position = 'right';
        } elseif ( 'sidebar-left' == $sidebar_state ) {
            $sidebar = 'sidebar';
            $sidebar_position = 'left';
        } else {
            $sidebar = '';
            $sidebar_position = 'right';
        }
        $components = get_theme_mod( 'wi_components', 'thumbnail,title,date,category,excerpt,excerpt_more,share' );
        $item_card = get_theme_mod( 'wi_item_card', 'none' );
        $item_spacing = get_theme_mod( 'wi_item_spacing', 'normal' );
        $item_template = get_theme_mod( 'wi_item_template', '1' );
        $item_border = get_theme_mod( 'wi_item_border', 'false' );
        $item_border_color = get_theme_mod( 'wi_item_border_color' );
        $align = get_theme_mod( 'wi_align', 'left' );
        $list_spacing = '';
        $list_sep = '';
        $list_sep_style = '';
        $list_sep_color = '';
        $list_valign = '';
        $list_mobile_layout = get_theme_mod( 'wi_list_mobile_layout', 'grid' );
        $thumbnail = '';
        $thumbnail_custom = get_theme_mod( 'wi_thumbnail_custom' );
        $thumbnail_placeholder = get_theme_mod( 'wi_thumbnail_placeholder', 'true' );
        $thumbnail_placeholder_id = get_theme_mod( 'wi_thumbnail_placeholder_id' );
        $thumbnail_border_width = get_theme_mod( 'wi_thumbnail_border_width' );
        $thumbnail_border_color = get_theme_mod( 'wi_thumbnail_border_color' );
        $thumbnail_shape = '';
        $thumbnail_hover = '';
        $thumbnail_hover_overlay = '';
        $thumbnail_hover_logo = get_theme_mod( 'wi_thumbnail_hover_logo' );
        $thumbnail_hover_logo_width = get_theme_mod( 'wi_thumbnail_hover_logo_width', '40%' );
        $thumbnail_showing_effect = get_theme_mod( 'wi_thumbnail_showing_effect', 'none' );
        $thumbnail_background = get_theme_mod( 'wi_thumbnail_background' );
        $thumbnail_components = get_theme_mod( 'wi_thumbnail_components', 'format_indicator' );
        $thumbnail_position = get_theme_mod( 'wi_thumbnail_position', 'left' );
        $thumbnail_width = get_theme_mod( 'wi_thumbnail_width', '' );

        $title_tag = get_theme_mod( 'wi_title_tag', 'h2' );
        $title_size = '';
        if ( 'standard' == $layout ) {
            // standard_excerpt_length
            $excerpt_length = get_theme_mod( 'wi_standard_excerpt_length', 55 );
        } else {
            $excerpt_length = get_theme_mod( 'wi_excerpt_length', 22 );
        }
        $excerpt_color = '';
        $excerpt_size = '';
        $excerpt_more_style = '';
        $excerpt_more_text = '';
    }

    /* LAYOUT
    ================================================================== */
    if ( 'grid' == $layout ) {
        $section[ 'layout' ] = 'grid';
        $section[ 'column' ] = [
            'desktop' => $column,
        ];
    } elseif ( 'list' == $layout ) {
        $section[ 'layout' ] = 'list';
        $section[ 'column' ] = [
            'desktop' => 1,
        ];
    } elseif ( 'masonry' == $layout ) {
        $section[ 'layout' ] = 'masonry';
        $section[ 'column' ] = [
            'desktop' => $column,
        ];
        if ( 'true' == get_theme_mod( 'wi_masonry_item_creative' ) ) {
            $section[ 'masonry_item_creative' ] = true;
        }
        if ( ! $big_first_post ) {
            $big_first_post = get_theme_mod( 'wi_big_first_post', 'true' );
        }
        $section[ 'big_first_post' ] = $big_first_post == 'true';
    } elseif ( 'slider' == $layout ) {
        $section[ 'layout' ] = 'carousel';
        $section[ 'column' ] = [
            'desktop' => 1,
        ];
    } elseif ( 'big' == $layout ) {
        $section['layout'] = 'grid';
        $section['column'] = [
            'desktop' => 1,
        ];
    } elseif ( 'standard' == $layout ) {
        $section['layout'] = 'grid'; 
        $section['column'] = [
            'desktop' => 1,
        ];
    } elseif ( 'newspaper' == $layout ) {
        $section['layout'] = 'masonry'; 
        $section['column'] = [
            'desktop' => 2,
        ];
    } elseif ('vertical' == $layout) {
        $section['layout'] = 'list';
        $section[ 'column' ] = [
            'desktop' => 1,
        ];
    } elseif ( 'slider-1' == $layout ) {
        $section[ 'layout' ] = 'carousel';
        $section[ 'column' ] = [
            'desktop' => 1,
        ];
    } elseif ( 'slider-3' == $layout ) {
        $section[ 'layout' ] = 'carousel';
        $section[ 'column' ] = [
            'desktop' => 3,
        ];
    } elseif ( 'group-1' == $layout ) {
        $section[ 'layout' ] = 'group';
    } elseif ( 'group-2' == $layout ) {
        $section[ 'layout' ] = 'group';
    } else {
        $section['layout'] = $layout;
    }

    $this->blog([
        'layout',
        'big_first_post',
        'column',
    ]);
    
    /**
     * tablet col policy
     */
    if ( isset( $section['column']['desktop'])) {
        $desktop_col = $section['column']['desktop'];
        if ( 6 == $desktop_col ) {
            $section['column']['tablet'] = 3;
        } elseif ( 5 == $desktop_col ) {
            $section['column']['tablet'] = 3;
        } elseif ( 4 == $desktop_col ) {
            $section['column']['tablet'] = 2;
        } elseif ( 3 == $desktop_col ) {
            $section['column']['tablet'] = 3;
        } elseif ( 2 == $desktop_col ) {
            $section['column']['tablet'] = 2;
        } elseif ( 1 == $desktop_col ) {
            $section['column']['tablet'] = 1;
        } else {
            $section['column']['tablet'] = 1;
        }
    }

    /**
     * policy of previous version
     */
    if ( isset( $section['column']) ) {
        $section[ 'column' ][ 'mobile' ] = 1;
    }

    /* item card
    ----------------------------------- */
    if ( ! $item_card ) {
        $item_card = get_theme_mod( 'wi_item_card', 'false' );
    }
    if ( in_array( $item_card, [ 'normal', 'normal_no_shadow', 'overlap', 'overlap_no_shadow' ] ) && in_array( $layout, [ 'grid', 'list', 'masonry', 'standard' ] ) ) {
        $section_css[ 'item_background' ] = '#ffffff';
        if ( $item_card_background ) {
            $section_css[ 'item_background' ] = $item_card_background;  
        }
        $section_css[ 'item_padding' ] = [
            'desktop' => 30,
            'tablet' => 24,
            'mobile' => 20,
        ];
        if ( 'normal' == $item_card ) {
            $section_css[ 'item_shadow' ] = 2;
        } elseif ( 'normal_no_shadow' == $item_card ) {
            $section_css[ 'item_shadow' ] = 0;
        } elseif ( 'overlap' == $item_card ) {
            // deprecated56
        } elseif ( 'overlap_no_shadow' == $item_card ) {
            // deprecated56
        }
    }

    $this->blog([
        'item_card',
        'item_card_background',
    ]);

    /* GROUP 1 - (BORDER, SPACING.. BELOW)
    ================================================================== */
    if ( 'group-1' == $layout ) {

        /* ------------------------ group layout */
        if ( '' == $group1_big_position ) {
            $group1_big_position = get_theme_mod( 'wi_group1_big_position', 'left' );
        }
        if ( '' == $group1_big_ratio ) {
            $group1_big_ratio = get_theme_mod( 'wi_group1_big_ratio', '2/3' );
        }
        $group_layout = $this->group_layout_from_group1( $group1_big_position, $group1_big_ratio );

        $section[ 'group_layout' ] = $group_layout;

        /* ------------------------ big number */
        if ( is_numeric( $group1_big_number ) ) {
            $section[ 'big_number' ] = $group1_big_number;
        }

        /* ------------------------ small layout */
        if ( 'grid' != $group1_small_display ) {
            $group1_small_display = 'list';
        }
        $section[ 'medium_layout' ] = $group1_small_display;

        /* ------------------------ small column */
        if ( 'grid' == $group1_small_display ) {
            if ( 2 != $group1_small_column ) {
                $group1_small_column = 1;
            }
            $section[ 'medium_column' ] = [
                'desktop' => $group1_small_column,
                'tablet' => $group1_small_column,
                'mobile' => 1,
            ];
        } else {
            $section[ 'medium_column' ] = [
                'desktop' => 1,
                'tablet' => 1,
                'mobile' => 1,
            ];
        }

        /* ------------------------ big components */
        $big_components = get_theme_mod( 'wi_group1_big_components', 'thumbnail,title,date,category,excerpt,excerpt_more' );
        if ( ! is_array( $big_components ) ) {
            $big_components = explode( ',', strval( $big_components ) );
        }
        if ( in_array( 'author_avatar', $big_components ) ) {
            $section[ 'author_avatar' ] = true;
        } else {
            $section[ 'author_avatar' ] = false;
        }
        $big_item_template = get_theme_mod( 'wi_group1_big_item_template', '2' );
        $components_order = $this->components_from_data([
            'item_template' => $big_item_template,
            'components' => $big_components,
        ]);
        $section[ 'big_components' ] = $components_order;

        /* ------------------------ big align */
        $bigpost_align = get_theme_mod( 'wi_group1_big_align', 'center' );
        $section[ 'big_align' ] = $bigpost_align;

        /* ------------------------ big thumbnail */
        $section[ 'big_thumbnail' ] = $this->thumbnail_map( get_theme_mod( 'wi_group1_big_thumbnail', 'large' ) );

        /* ------------------------ big excerpt length */
        $section[ 'big_excerpt_length' ] = get_theme_mod( 'wi_group1_big_excerpt_length', 44 );

        /* ------------------------ big more style */
        // $section[ 'big_more_style' ] = $this->more_style( get_theme_mod( 'wi_group1_big_excerpt_more_style', 'btn' ) );

        /* ------------------------ small components */
        $small_components = get_theme_mod( 'wi_group1_small_components', 'thumbnail,title,date,excerpt' );
        if ( ! is_array( $small_components ) ) {
            $small_components = explode( ',', strval( $small_components ) );
        }
        $small_item_template = get_theme_mod( 'wi_group1_small_item_template', '2' );
        $components_order = $this->components_from_data([
            'item_template' => $small_item_template,
            'components' => $small_components,
        ]);
        $section[ 'medium_components' ] = $components_order;

        /* ------------------------ small thumbnail */
        $section[ 'medium_thumbnail' ] = $this->thumbnail_map( get_theme_mod( 'wi_group1_small_thumbnail', 'landscape' ) );

        /* ------------------------ force options */
        $section[ 'medium_excerpt_length' ] = get_theme_mod( 'wi_group1_small_excerpt_length', 12 );
        $section[ 'medium_thumbnail_width_type' ] = 'pixel';
        $section_css[ 'medium_excerpt_typography' ] = [
            'size' => 13,
            'line_height' => '1.3',
        ];
        $section_css[ 'medium_thumbnail_width_px' ] = [
            'desktop' => 130,
        ];
        $small_list_spacing = get_theme_mod( 'wi_group1_small_list_spacing' );
        $section_css[ 'v_spacing' ] = $this->v_spacing_map( $small_list_spacing );

        // big more style
        $section[ 'big_more_style' ] = $this->more_style( get_theme_mod( 'wi_group1_big_excerpt_more_style', 'btn-primary' ) );

    /* GROUP 2 (BORDER, SPACING.. BELOW)
    ================================================================== */
    } elseif ( 'group-2' == $layout ) {

        /* ------------------------ group layout */
        if ( '' == $group2_columns_order ) {
            $group2_columns_order = get_theme_mod( 'wi_group2_columns_order', '1a-3-1b' );
        }
        
        $section[ 'group_layout' ] = $this->group_layout_from_group2( $group2_columns_order ); 

        /* ------------------------ big number */
        if ( is_numeric( $group2_big_number ) ) {
            $section[ 'big_number' ] = $group2_big_number;
        }

        /* ------------------------ medium number */
        if ( is_numeric( $group2_medium_number ) ) {
            $section[ 'medium_number' ] = $group2_medium_number;
        }

        /* ------------------------ small layout */
        if ( 'list' != $group2_small_display ) {
            $group2_small_display = 'grid';
        }
        $section[ 'small_layout' ] = $group2_small_display;
        $section[ 'small_column' ] = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1
        ];

        /* ------------------------ big components */
        $big_components = get_theme_mod( 'wi_group2_big_components', 'thumbnail,title,date,category,excerpt,excerpt_more' );
        if ( ! is_array( $big_components ) ) {
            $big_components = explode( ',', strval( $big_components ) );
        }
        if ( in_array( 'author_avatar', $big_components ) ) {
            $section[ 'author_avatar' ] = true;
        } else {
            $section[ 'author_avatar' ] = false;
        }
        $big_item_template = get_theme_mod( 'wi_group2_big_item_template', '2' );
        $components_order = $this->components_from_data([
            'item_template' => $big_item_template,
            'components' => $big_components,
        ]);
        $section[ 'big_components' ] = $components_order;

        /* ------------------------ big align */
        $bigpost_align = get_theme_mod( 'wi_group2_big_align', 'center' );
        $section[ 'big_align' ] = $bigpost_align;

        /* ------------------------ big title size */
        $bigpost_title_size = get_theme_mod( 'wi_group2_big_title_size', 'medium' );
        $section[ 'big_title_typography' ] = $this->title_typo_map( $bigpost_title_size );

        /* ------------------------ big excerpt length */
        $section[ 'big_excerpt_length' ] = get_theme_mod( 'wi_group2_big_excerpt_length', 32 );

        // big more style
        $section[ 'big_more_style' ] = $this->more_style( get_theme_mod( 'wi_group2_big_excerpt_more_style', 'btn-fill' ) );

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
        $section[ 'medium_components' ] = $components_order;

        /* ------------------------ medium thumbnail */
        $section[ 'medium_thumbnail' ] = get_theme_mod( 'wi_group2_medium_thumbnail', 'medium' );

        /* ------------------------ medium title size */
        $medium_title_size = get_theme_mod( 'wi_group2_medium_title_size', 'normal' );
        $section[ 'medium_title_typography' ] = $this->title_typo_map( $medium_title_size );

        /* ------------------------ medium excerpt length */
        $section[ 'medium_excerpt_length' ] = get_theme_mod( 'wi_group2_medium_excerpt_length', 40 );

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
        $section[ 'small_components' ] = $components_order;

        /* ------------------------ small title size */
        $small_title_size = get_theme_mod( 'wi_group2_small_title_size', 'small' );
        $section[ 'small_title_typography' ] = $this->title_typo_map( $small_title_size );

        /* ------------------------ small excerpt length */
        $section[ 'small_excerpt_length' ] = get_theme_mod( 'wi_group2_small_excerpt_length', 12 );

        /* ------------------------ force options */
        $section_css[ 'small_excerpt_typography' ] = [
            'size' => 13,
            'line_height' => '1.3',
        ];
        $section_css[ 'medium_thumbnail_width_px' ] = [
            'desktop' => 120,
        ];
        
    }

    $this->blog([
        'group1_big_position',
        'group1_big_ratio',
        'group1_big_number',
        'group1_small_display',
        'group1_small_column',
        'group2_columns_order',
        'group2_big_number',
        'group2_medium_number',
        'group2_small_display',
    ]);

    /* GROUP 1, 2 - SEP, BORDER, SPACING
    ================================================================== */
    if ( in_array( $layout,[ 'group-1', 'group-2' ] ) ) {
        $i = str_replace( 'group-', '', $layout );
        $col_spacing = get_theme_mod( "wi_group{$i}_spacing", 'normal' );
        $col_sep = get_theme_mod( "wi_group{$i}_sep_border", 'false' );
        $col_sep_color = get_theme_mod( "wi_group{$i}_sep_border_color" );

        /* ------------------------ col spacing */
        $spacing_arr = $this->spacing_arr( $col_spacing );
        $section_css[ 'h_spacing' ] = $spacing_arr['h'];

        /* ------------------------ col sep */
        if ( 'true' == $col_sep ) {
            $section_css[ 'v_sep' ] = '1px';
        } else {
            $section_css[ 'v_sep' ] = '0px';
        }

        /* ------------------------ col sep color */
        $section_css[ 'v_sep_color' ] = $col_sep_color;

        /* ------------------------ forced options */
        $section_css[ 'thumbnail_width_px' ] = [
            'desktop' => 100,
            'tablet' => 80,
            'mobile' => 72,
        ];

        /* ------------------------ big col title medium */
        $section_css[ 'big_title_typography' ] = [
            'size' => '2.1em',
        ];
        if ( 'group-2' == $layout ) {
            $section_css[ 'medium_title_typography' ] = [
                'size' => '1.625em',
            ];
            $section_css[ 'small_title_typography' ] = [
                'size' => '1.3em',
            ];
        } else {
            $section_css[ 'medium_title_typography' ] = [
                'size' => '1.3em',
            ];
        }
        
    }

    /* NON-GROUP 1, 2
    ================================================================== */
    if ( ! in_array( $layout, [ 'group-1', 'group-2' ] ) ) {

        /* Components / item_template
        ------------------------------------------------------------------ */
        if ( ! $item_template ) {
            $item_template = get_theme_mod( 'wi_item_template', '2' );
        }
        if ( ! in_array( $item_template, [ '1', '2', '3', '4', '5' ] ) ) {
            $item_template = '2';
        }
        if ( 'slider-1' == $layout ) {
            $item_template = 4; // forced
        }

        if ( 'true' != $customize_components ) {
            if ( 'slider-1' == $layout ) {
                $components = 'category,thumbnail,title,date';
            } elseif ( 'standard' == $layout ) {
                $components = get_theme_mod( 'wi_components', 'title,thumbnail,date,excerpt' );
                // standard more
                $standard_excerpt_more = get_theme_mod( 'wi_standard_excerpt_more', 'true' );
                if ( 'false' != $standard_excerpt_more ) {
                    $components .= ',excerpt_more';
                }
            } else {
                $components = get_theme_mod( 'wi_components', 'thumbnail,title,date,excerpt' );
            }
        }
        if ( ! is_array( $components ) ) {
            $components = explode( ',', strval( $components ) );
        }

        /**
         * SIDE EFFECT OF COMPONENTS
         */
        if ( in_array( 'author_avatar', $components ) ) {
            $section[ 'author_avatar' ] = true;
        } else {
            $section[ 'author_avatar' ] = false;
        }

        /**
         * CONVERT IT TO components v5.6
         */
        $components_order = $this->components_from_data([
            'item_template' => $item_template,
            'components' => $components,
        ]);
        $section[ 'components' ] = $components_order;

        /* item spacing
        ------------------------------------------------------------------ */
        if ( '' == $item_spacing ) {
            $item_spacing = get_theme_mod( 'wi_item_spacing', 'normal' );
        }
        $spacing_arr = $this->spacing_arr( $item_spacing );
        $section_css[ 'v_spacing' ] = $spacing_arr[ 'v' ];
        $section_css[ 'h_spacing' ] = $spacing_arr[ 'h' ];

        /* item border
        ------------------------------------------------------------------ */
        if ( '' == $item_border ) {
            $item_border = get_theme_mod( 'wi_item_border', 'false' );
        }
        if ( 'true' == $item_border && in_array( $layout, [ 'grid', 'masonry', 'group-1', 'group-2' ]) ) {
            $section_css[ 'v_sep' ] = '1px';
            if ( ! $item_border_color ) {
                $item_border_color = get_theme_mod( 'wi_item_border_color', '#d0d0d' );
            }
            $section_css[ 'v_sep_color' ] = $item_border_color;
        }

        /* align
        ------------------------------------------------------------------ */
        if ( '' == $align ) {
            $align = get_theme_mod( 'wi_align', 'left' );
        }
        $section[ 'align' ] = $align;
        if ( 'big' == $layout ) {
            if ( '' == $big_align ) {
                $big_align = get_theme_mod( 'wi_big_align', 'left' );
            }
            $section['align'] = $big_align;
        }
        $this->blog('big_align');

        /* list options
        ------------------------------------------------------------------ */
        if ( 'list' == $layout ) {
            
            /* --------------------------   spacing */
            if ( '' == $list_spacing ) {
                $list_spacing = get_theme_mod( 'wi_list_spacing', 'normal' );
            }
            $section_css[ 'v_spacing' ] = $this->v_spacing_map( $list_spacing );

            /* --------------------------   sep */
            if ( '' == $list_sep ) {
                $list_sep = get_theme_mod( 'wi_list_sep', 'true' );
            }
            if ( 'false' != $list_sep ) {
                $section_css[ 'h_sep' ] = '1px';
            }
            if ( ! $list_sep_color ) {
                $list_sep_color = get_theme_mod( 'wi_list_sep_color', '#c0c0c0' );
            }
            $section_css[ 'h_sep_color' ] = $list_sep_color;

            /* --------------------------   valign */
            if ( '' == $list_valign ) {
                $list_valign = get_theme_mod( 'wi_list_valign', 'top' );
            }
            $section[ 'valign' ] = $list_valign;

            /* --------------------------   list_mobile_layout */
            $section[ 'list_mobile_layout' ] = $list_mobile_layout;

        }

        /* thumbnail
        ------------------------------------------------------------------ */
        /* --------------------------    THUMBNAIL */
        if ( '' == $thumbnail ) {
            $thumbnail = get_theme_mod( 'wi_thumbnail', 'landscape' );
        }
        $map = [
            'landscape' => 'thumbnail-medium',
            'square' => 'thumbnail-square',
            'portrait' => 'thumbnail-portrait',
            'original' => 'full',
            'original_fixed' => 'full', // deprecated56
        ];
        $thumbnail = isset( $map[ $thumbnail] ) ? $map[ $thumbnail] : $thumbnail;
        $section[ 'thumbnail' ] = $thumbnail;
        if ( 'custom' == $thumbnail ) {
            if ( ! $thumbnail_custom ) {
                $thumbnail_custom = '600x600';
            }
            if ( ! is_string( $thumbnail_custom) ) {
                $thumbnail_custom = '';
            }
            $explode = explode( 'x', $thumbnail_custom );
            $w = isset( $explode[0] ) ? $explode[0] : 600;
            $h = isset( $explode[1] ) ? $explode[1] : 600;
            $w = absint($w);
            $h = absint($h);
            $section[ 'thumbnail_custom' ] = [
                'width' => $w,
                'height' => $h,
            ];
        }

        /* --------------------------    SHAPE */
        if ( '' == $thumbnail_shape ) {
            $thumbnail_shape = get_theme_mod( 'wi_thumbnail_shape', 'acute' );
        }
        if ( 'circle' == $thumbnail_shape ) {
            $section_css[ 'thumbnail_border_radius' ] = '50%';
        } elseif ( 'round' == $thumbnail_shape ) {
            $section_css[ 'thumbnail_border_radius' ] = '4px';
        } else {
            $section_css[ 'thumbnail_border_radius' ] = '0px';
        }

        /* --------------------------    HOVER */
        if ( '' == $thumbnail_hover ) {
            $thumbnail_hover = get_theme_mod( 'wi_thumbnail_hover', 'none' );
        }
        $section[ 'thumbnail_hover_effect' ] = $thumbnail_hover;

        /* --------------------------    HOVER LOGO */
        if ( ! $thumbnail_hover_logo ) {
            $thumbnail_hover_logo = get_theme_mod( 'wi_thumbnail_hover_logo' );
        }
        if ( $thumbnail_hover_logo ) {
            if ( is_numeric( $thumbnail_hover_logo) ) {
                $section[ 'thumbnail_hover_logo' ] = intval( $thumbnail_hover_logo );
            } else {
                $thumbnail_hover_logo_id = attachment_url_to_postid( $thumbnail_hover_logo );
                if ( $thumbnail_hover_logo_id ) {
                    $section[ 'thumbnail_hover_logo' ] = $thumbnail_hover_logo_id;
                }
            }
        }

        /* --------------------------    HOVER LOGO WIDTH */
        if ( '' == $thumbnail_hover_logo_width ) {
            $thumbnail_hover_logo_width = get_theme_mod( 'wi_thumbnail_hover_logo_width', '40%' );
        }
        $thumbnail_hover_logo_width = str_replace( '%', '', $thumbnail_hover_logo_width );
        $thumbnail_hover_logo_width = absint( $thumbnail_hover_logo_width );
        $section_css[ 'thumbnail_hover_logo_width' ] = $thumbnail_hover_logo_width;

        /* --------------------------    THUMBNAIL COMPONENTS */
        // index @deprecated56    
        if ( ! is_array( $thumbnail_components ) ) {
            $thumbnail_components = explode( ',', strval( $thumbnail_components ) );
        }
        $thumbnail_components56 = [];
        if ( in_array( 'review', $thumbnail_components ) ) {
            $thumbnail_components56[] = 'review';
        }
        if ( in_array( 'view', $thumbnail_components ) ) {
            $thumbnail_components56[] = 'view';
        }
        if ( in_array( 'format_indicator', $thumbnail_components ) ) {
            $thumbnail_components56[] = 'format_indicator';
        }
        $section[ 'thumbnail_components' ] = join(',', $thumbnail_components56 );

        /* --------------------------    THUMBNAIL SHOWING EFFECT */
        if ( $thumbnail_showing_effect ) {
            $section[ 'thumbnail_showing_effect' ] = $thumbnail_showing_effect;
        }

        if ( 'list' == $layout ) {
            /* --------------------------    THUMBNAIL POSITION */
            if ( '' == $thumbnail_position ) {
                $thumbnail_position = get_theme_mod( 'wi_thumbnail_position', 'right' );
            }
            $section[ 'thumbnail_position' ] = $thumbnail_position;

            /* --------------------------    THUMBNAIL WIDTH */
            $thumbnail_width = trim( strval( $thumbnail_width ) );
            if ( '' === $thumbnail_width ) {
                $thumbnail_width = 360; // default value
            }
            if ( strpos( $thumbnail_width, '%' ) !== false ) {
                $section[ 'thumbnail_width_type' ] = 'percent';
                $section_css[ 'thumbnail_width_percent' ] = [
                    'desktop' => absint( $thumbnail_width ),
                    'tablet' => 40,
                    'mobile' => 30,
                ];
            } else {
                $section[ 'thumbnail_width_type' ] = 'pixel';
                $section_css[ 'thumbnail_width_px' ] = [
                    'desktop' => absint( $thumbnail_width ),
                    'tablet' => 300,
                    'mobile' => 100,
                ];
            }
        }

    } // not group

    $this->blog([

        'customize_components',
        'align',
        'list_spacing',
        'list_sep',
        'list_sep_color',
        'list_valign',
        'list_mobile_layout',

        'item_spacing',
        'item_border',
        'item_border_color',
        'item_template',
        'components',

        'thumbnail',
        'thumbnail_custom',
        'thumbnail_shape',
        'thumbnail_hover',
        'thumbnail_hover_logo',
        'thumbnail_hover_logo_width',
        'thumbnail_components',
        'thumbnail_showing_effect',
        'thumbnail_position',
        'thumbnail_width',
        
    ]);

    $this->blog([
        'list_sep_style'
    ], 'deprecated' );

    /* TEXT
    ------------------------------------------------------------------ */
    /* ----------------  title tag */
    if ( '' == $title_tag ) {
        $title_tag = get_theme_mod( 'wi_title_tag', 'h2' );
    }
    $section[ 'title_tag' ] = $title_tag;
    
    $this->blog( 'title_tag' );

    /* ----------------  title size */
    if ( '' == $title_size && 'slider-3' == $layout ) {
        $title_size = 'small';
    } 
    if ( '' != $title_size ) {
        $section_css[ 'title_typography' ] = $this->title_typo_map( $title_size );
    }
    $this->blog( 'title_size' );

    /* ----------------  title color */
    if ( $title_color ) {
        $section_css[ 'title_color' ] = $title_color;
    }

    $this->blog( 'title_color' );

    /* ----------------  excerpt length */
    $excerpt_length = trim( strval( $excerpt_length ) );
    if ( '' == $excerpt_length ) {
        if ( 'standard' == $layout ) {
            // standard_excerpt_length
            $excerpt_length = get_theme_mod( 'wi_standard_excerpt_length', 55 );
        } else {
            $excerpt_length = get_theme_mod( 'wi_excerpt_length', 22 );
        }
    }
    $section[ 'excerpt_length' ] = $excerpt_length;
    $this->blog( 'excerpt_length' );

    /* ----------------  excerpt size */
    if ( '' != $excerpt_size ) {
        $section_css[ 'excerpt_typography' ] = $this->excerpt_typo_map( $excerpt_size );
    }
    $this->blog( 'excerpt_size' );
    
    /* ----------------  excerpt color */
    if ( $excerpt_color ) {
        $section_css[ 'excerpt_color' ] = $excerpt_color;
    }
    $this->blog( 'excerpt_color' );

    /* ----------------  excerpt more style */
    if ( '' == $excerpt_more_style ) {
        $excerpt_more_style = get_theme_mod( 'wi_excerpt_more_style', 'simple' );
        if ( 'standard' == $layout ) {
            $excerpt_more_style = get_theme_mod( 'wi_standard_excerpt_more_style', 'btn-black' );
        }
    }
    $section[ 'more_style' ] = $this->more_style( $excerpt_more_style );
    $this->blog( 'excerpt_more_style' );

    // deprecated
    $this->blog( 'excerpt_more_text', 'deprecated' );

    /* VERTICAL
    ------------------------------------------------------------------ */
    if ( 'vertical' == $layout ) {
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
        $section[ 'thumbnail' ] = 'large';
        $section[ 'thumbnail_width_type' ] = 'percent';
        $section_css[ 'thumbnail_width_percent' ] = [
            'desktop' => 54,
            'tablet' => 54,
            'mobile' => 30,
        ];
        $section_css[ 'thumbnail_text_gap' ] = [
            'desktop' => 45,
            'tablet' => 20,
            'mobile' => 8,
        ];

        // vertical_thumbnail_position
        $vertical_thumbnail_position = get_theme_mod( 'wi_vertical_thumbnail_position', 'left' );
        $section[ 'thumbnail_position' ] = $vertical_thumbnail_position;

        $vertical_excerpt_size = get_theme_mod( 'wi_vertical_excerpt_size', 'medium' );
        $section_css[ 'excerpt_typography' ] = $this->excerpt_typo_map( $vertical_excerpt_size );
    }

    /* BIG
    ------------------------------------------------------------------ */
    if ( 'big' == $layout ) {
        $section['thumbnail'] = 'full';
        $section[ 'more_style' ] = 'minimal';
        $section_css[ 'thumbnail_border_radius' ] = '0px';
        $section_css[ 'title_typography' ] = [
            'size' => 55,
            'size_tablet' => 38,
            'size_mobile' => 30,
        ];
        $section_css[ 'excerpt_typography' ] = [
            'size' => 21,
            'size_tablet' => 19,
            'size_mobile' => 17,
        ];

        // big_content_excerpt
        if ( ! $big_content_excerpt ) {
            $big_content_excerpt = get_theme_mod( 'wi_big_content_excerpt', 'content' );
        }
        $section[ 'excerpt_content' ] = $big_content_excerpt;
    }
    $this->blog('big_content_excerpt');
    $this->blog('big_meta_background','deprecated');

    /* NEWSPAPER
    ------------------------------------------------------------------ */
    if ( 'newspaper' == $layout ) {
        $section['thumbnail'] = 'large';
        $section_css[ 'thumbnail_border_radius' ] = '0px';

        // content - excerpt
        if ( ! $newspaper_content_excerpt ) {
            $newspaper_content_excerpt = get_theme_mod( 'wi_newspaper_content_excerpt', 'content' );
        }
        $section[ 'excerpt_content' ] = $newspaper_content_excerpt;
    }
    $this->blog( 'newspaper_content_excerpt' );

    /* STANDARD
    ------------------------------------------------------------------ */
    if ( 'standard' == $layout ) {
        $section['thumbnail'] = 'full';
        $section_css[ 'thumbnail_border_radius' ] = '0px';

        // content - excerpt
        if ( ! $standard_content_excerpt ) {
            $standard_content_excerpt = get_theme_mod( 'wi_standard_content_excerpt', 'content' );
        }
        $section[ 'excerpt_content' ] = $standard_content_excerpt;

        // standard_sep
        $standard_sep = get_theme_mod( 'wi_standard_sep', 'true' );
        if ( 'false' == $standard_sep ) {
            $section_css[ 'h_sep' ] = '0px';
        } else {
            $section_css[ 'h_sep' ] = '1px';
        }

        // standard_spacing
        $standard_spacing = get_theme_mod( 'wi_standard_spacing', 'normal' );
        $section_css[ 'v_spacing' ] = $this->standard_spacing_map( $standard_spacing );

        // standard_title_size
        $standard_title_size = get_theme_mod( 'wi_standard_title_size', '3em' );
        $standard_title_size_abs = absint( $standard_title_size );
        if ( $standard_title_size_abs > 0 ) {
            $size_tablet = str_replace( $standard_title_size_abs, $standard_title_size_abs * 0.7, $standard_title_size );
            $size_mobile = str_replace( $standard_title_size_abs, $standard_title_size_abs * 0.5, $standard_title_size );
            $section_css[ 'title_typography' ] = [
                'size' => $standard_title_size,
                'size_tablet' => $size_tablet,
                'size_mobile' => $size_mobile,
            ];
        }
    }
    $this->blog([
        'standard_content_excerpt'
    ]);

    // please DIY
    $this->log([
        'standard_thumbnail_header_order'
    ], 'deprecated' );

    /* SLIDER
    ------------------------------------------------------------------ */
    if ( 'slider' == $layout ) {
        $section['thumbnail'] = 'full';
        $section['post_style'] = 'ontop';
        $section['ontop_height_style'] = 'padding';
        $section[ 'ontop_valign' ] = 'bottom';
        $section_css[ 'text_inner_width' ] = [
            'desktop' => 660,
            'tablet' => 660,
            'mobile' => '100%',
        ];
        
        // slider_size
        if ( ! $slider_size ) {
            $slider_size = get_theme_mod( 'wi_slider_size', '1020x510' );
        }
        $ontop_padding = 44;
        if ( $slider_size ) {
            $try = explode( 'x', $slider_size );
            if ( count( $try ) >= 2 ) {
                $w = absint( $try[0] );
                $h = absint( $try[1] );
                if ( $w > 0 && $h > 0 ) {
                    $ratio = round( $h/$w * 100 );
                    if ( $ratio > 30 && $ratio < 300 ) {
                        $ontop_padding = $ratio;
                    }
                }
            }
        }
        $section_css['ontop_padding'] = [
            'desktop' => $ontop_padding,
            'tablet' => 60,
            'mobile' => 90,
        ];
    }

    $this->blog([
        'slider_size'
    ]);

    /* Slider 1
    ------------------------------------------------------------------ */
    if ( 'slider-1' == $layout ) {
        $section[ 'column' ] = [ 'desktop' => 1,'tablet' => 1,'mobile' => 1 ];
        $section['thumbnail'] = 'full';
        $section['post_style'] = 'ontop';
        $section_css['ontop_overlay'] = 'rgba(0,0,0,.3)';
        $section_css['item_padding'] = [
            'desktop' => '10%',
            'tablet' => '10%',
            'mobile' => '5%',
        ];
        $section[ 'ontop_valign' ] = 'middle';
        $section['align'] = 'center'; // force this value
        $section_css[ 'text_inner_width' ] = [
            'desktop' => 600,
            'tablet' => '90%',
            'mobile' => '90%',
        ];
        $section_css[ 'color' ] = '#fff';
        // $section_css[ 'title_color' ] = '#fff';
        // $section_css[ 'meta_color' ] = '#fff';

        if ( ! $slider1_height ) {
            $slider1_height = get_theme_mod( 'wi_slider1_height', 'short' );
        }
        
        if ( ! in_array( $slider1_height, [ 'tall', 'fullscreen' ]) ) {
            $slider1_height = 'short';
        }
        if ( 'short' == $slider1_height ) {
            $section['ontop_height_style'] = 'padding';
            $section_css['ontop_padding'] = [
                'desktop' => 50,
                'tablet' => 60,
                'mobile' => 90,
            ];
        }

        /* -------------- background */
        if ( $slider1_content_background ) {
            $slider1_content_background_opacity = trim( $slider1_content_background_opacity );
            if ( '' === $slider1_content_background_opacity ) {
                $slider1_content_background_opacity = '0.3';
            }
            $slider1_content_background_opacity = floatval( $slider1_content_background_opacity );

            list($r_val, $g_val, $b_val) = sscanf( $slider1_content_background, "#%02x%02x%02x" );
            $a_val = $slider1_content_background_opacity;
            $rgba = "rgba({$r_val},{$g_val},{$b_val},{$a_val})";
            $section_css[ 'text_inner_background' ] = $rgba;
            $section_css[ 'ontop_overlay' ] = 'rgba(0,0,0,0)';
        }
        if ( ! $slider1_content_color ) {
            $slider1_content_color = get_theme_mod( 'wi_slider1_content_color' );
        }
        if ( $slider1_content_color ) {
            $section_css[ 'color' ] = $slider1_content_color;
        }

    }

    /* Slider 3
    ------------------------------------------------------------------ */
    if ( 'slider-3' == $layout ) {
        $section_css[ 'item_background' ] = $slider3_text_background;
        $section_css[ 'item_padding' ] = [
            'desktop' => 16,
            'tablet' => 12,
            'mobile' => 10,
        ];
        $section_css[ 'carousel_h_spacing' ] = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    }

    $this->blog([
        'slider1_height',
        'slider1_content_color',
        'slider1_content_background',
        'slider1_content_background_opacity',

        'slider_nav_style',
        'slider_dot_style',
        'slider_autoplay',

        'slider3_text_background',
    ]);

    /* SLIDER ARROWS
    ------------------------------------------------------------------ */ 
    if ( in_array( $layout, [ 'slider', 'slider-1', 'slider-3' ] ) ) {

        // default slider nav
        if ( ! $slider_nav_style ) {
            if ( 'slider' == $layout ) {
                $slider_nav_style = 'text';
            } elseif ( 'slider-1' == $layout ) {
                $slider_nav_style = 'square-3';
            } else {
                $slider_nav_style = 'square-3';
            }
        }

        /* -------------- slider_nav_style */
        if ( 'circle-1' == $slider_nav_style ) {
            $section['carousel_nav_shape'] = 'circle';
            $section[ 'carousel_nav_style'] = 'outline';
            $section[ 'carousel_nav' ] = 'middle-inside';
        } elseif ( 'square-1' == $slider_nav_style || 'square-2' == $slider_nav_style  ) {
            $section['carousel_nav_shape'] = 'square';
            $section[ 'carousel_nav' ] = 'middle-inside';
            $section[ 'carousel_nav_style'] = 'outline';
        } elseif ( 'square-3' == $slider_nav_style || 'square-2' == $slider_nav_style ) {
            $section['carousel_nav_shape'] = 'high-square';
            $section[ 'carousel_nav' ] = 'middle-edge';
            if ( 'square-3' == $slider_nav_style ) {
                $section[ 'carousel_nav_style'] = 'outline';
            } else {
                $section[ 'carousel_nav_style'] = 'dark';
            }
        } else {
            $section[ 'carousel_nav_shape' ] = 'circle';
            $section[ 'carousel_nav' ] = 'middle-inside';
        }

        /* -------------- position */
        if ( 'text' == $slider_nav_style ) {
            $section[ 'carousel_nav' ] = 'top-right';
        }

        /* -------------- slider_dot_style */
        if ( 'disabled' == $slider_dot_style ) {
            $section[ 'carousel_pager' ] = false;
        } else {
            $section[ 'carousel_pager' ] = true;
            if ( 'small' == $slider_dot_style ) {
                $section['carousel_pager_style'] = 'circle';
            } elseif ( 'square-small' == $slider_dot_style ) {
                $section['carousel_pager_style'] = 'square';
            } elseif ( 'big' == $slider_dot_style ) {
                $section['carousel_pager_style'] = 'big-circle';
            } elseif ( 'square-big' == $slider_dot_style ) {
                $section['carousel_pager_style'] = 'big-square';
            }
        }

        /* -------------- autoplay */
        if ( 'true' == $slider_autoplay ) {
            $section['carousel_autoplay'] = true;
        } else {
            $section['carousel_autoplay'] = false;
        }

    }

    /* AVATAR SIZE
    ------------------------------------------------------------------ */ 
    $section_css[ 'author_avatar_size' ] = [
        'desktop' => get_theme_mod( 'wi_author_avatar_width', 32 ),
        'tablet' => 24,
        'mobile' => 20,
    ];

    /* SECTION
    ================================================================== */
    /* ----------------  background */
    $section_css[ 'background_color' ] = $background;
    if ( ! empty( $background ) ) {

        // we set padding for sections having background
        $section_css['padding'] = [
            'desktop' => '3.5em 0',
            'tablet' => '2.5em 0',
            'mobile' => '1.5em 0',
        ];
    }
    
    /* ----------------  color */
    if ( $text_color ) {
        $section_css[ 'color' ] = $text_color;
    }
    
    if ( $color ) {
        $section_css['color'] = $color;
    }

    /* ----------------  hide */
    if ( 'false' === $visibility ) {
        $section['hide'] = true;
    }

    $this->blog([
        'background',
        'text_color',
        'color',
        'visibility',
    ]);

    $this->blog([
        'border'
    ], 'deprecated' );

    /* ----------------  responsive */
    if ( ! is_array( $section_visibility ) ) {
        $section_visibility = explode( ',', trim( strval( $section_visibility ) ) );
    }
    $section[ 'responsiveness' ] = $section_visibility;

    $this->blog([
        'section_visibility',
    ]);

    /* ----------------  stretch */
    if ( 'full' != $stretch && 'narrow' != $stretch ) {
        $stretch = 'content';
    }
    if ( 'full' == $stretch ) {
        $stretch = 'fullwidth';
    }
    $section[ 'stretch' ] = $stretch;

    $this->blog([
        'stretch',
    ]);

    /* ----------------  sidebar */
    $section[ 'sidebar' ] = $sidebar;
    $this->set_theme_mod( "{$section56_id}_sidebar", $sidebar );
    if ( 'left' != $sidebar_position ) {
        $sidebar_position = 'right';
    }
    $section[ 'sidebar_position' ] = $sidebar_position;
    $section[ 'sidebar_sticky' ] = boolval( 'true' == $sidebar_sticky );

    $this->blog([
        'sidebar',
        'sidebar_position',
        'sidebar_sticky',
    ]);

    if ( 'true' == $sidebar_sep ) {
        $section_css[ 'sidebar_main_sep' ] = '1px';
    } else {
        $section_css[ 'sidebar_main_sep' ] = '0px';
    }
    if ( $sidebar_sep_color ) {
        $section_css[ 'sidebar_main_sep_color' ] = $sidebar_sep_color;
    }

    $this->blog([
        'sidebar_sep',
        'sidebar_sep_color',
    ]);

    /* ----------------  id, class */
    if ( $section_id ) {
        $section[ 'id' ] = $section_id;
    }
    if ( $class ) {
        $section['class'] = $class;
    }

    $this->blog([
        'section_id',
        'class',
    ]);

    /* HEADING
    v6 heading doesn't have an 'inherit' option. only per-section style.
    ================================================================== */
    $section['heading'] = $heading;
    $section['heading_empty'] = $heading_empty;
    $section_css['heading_color'] = $heading_color;

    /* ----------------- heading style */
    if ( '' == $heading_style ) {
        $heading_style = get_theme_mod( 'wi_builder_heading_style', '1a' );
    }
    if ( 'plain' == $heading_style ) {
        $section[ 'heading_style' ] = 'plain';
    } elseif ( '1a' == $heading_style ) {
        $section[ 'heading_style' ] = 'border-top';
        $section_css[ 'heading_border_width' ] = [
            'desktop' => 3,
            'tablet' => 3,
            'mobile' => 3,
        ];
    } elseif ( '1b' == $heading_style ) {
        $section[ 'heading_style' ] = 'border-bottom';
        $section_css[ 'heading_border_width' ] = [
            'desktop' => 3,
            'tablet' => 3,
            'mobile' => 3,
        ];
    } elseif ( in_array( $heading_style, [ '2a', '2b', '4a', '4b' ] )  ) {
        $section[ 'heading_style' ] = 'middle-line';
        $section_css[ 'heading_border_width' ] = [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ];
    } elseif ( '3a' == $heading_style || '3b' == $heading_style ) {
        $section[ 'heading_style' ] = 'middle-line';
        $section_css[ 'heading_border_width' ] = [
            'desktop' => 5,
            'tablet' => 3,
            'mobile' => 3,
        ];
    } elseif ( '5' == $heading_style ) {
        $section[ 'heading_style' ] = 'border-around';
        $section_css[ 'heading_border_width' ] = [
            'desktop' => 5,
            'tablet' => 4,
            'mobile' => 3,
        ];
    } elseif ( '6' == $heading_style ) {
        $section[ 'heading_style' ] = 'plain';
    } elseif ( '7a' == $heading_style ) {
        $section[ 'heading_style' ] = 'diagonal-stripe';
    } elseif ( '8a' == $heading_style ) {
        $section[ 'heading_style' ] = 'pixelate-dots';
    }
    $general_border_color = get_theme_mod( 'wi_border_color', '#e1e1e1' );
    $section_css[ 'heading_line_color' ] = get_theme_mod( 'wi_builder_heading_line_color' );// $general_border_color;

    /* ----------------- heading stretch */
    if ( '' == $heading_line_stretch ) {
        $heading_line_stretch = get_theme_mod( 'wi_builder_heading_line_stretch', 'content' ); 
    }
    if ( 'content-half' == $heading_line_stretch ) {
        $heading_line_stretch = 'half';
    }
    $section[ 'heading_stretch' ] = $heading_line_stretch;

    /* ----------------- heading align */
    if ( '' == $heading_align ) {
        $heading_align = get_theme_mod( 'wi_builder_heading_align', 'center' ); 
    }
    $section[ 'heading_align' ] = $heading_align;

    /* ----------------- heading size */
    if ( '' == $heading_size ) {
        // don't do this, we set it globally
        $section_css['heading_typography'] = [
            'size' => '',
            'size_tablet' => '',
            'size_mobile' => '',
        ];
    } else {
        $section_css[ 'heading_typography' ] = $this->builder_heading_typo_map( $heading_size );
    }

    $this->blog([
        'heading',
        'heading_empty',
        'heading_color',
        'heading_style',
        'heading_line_stretch',
        'heading_align',
        'heading_size',
    ]);

    /* ----------------- viewall link */
    $section[ 'heading_link_position' ] = $viewall_link_position;
    $section[ 'heading_link' ] = [
        'url' => $viewall_link,
        // 'target' => '_blank',
    ];
    $section_css[ 'heading_link_text' ] = $viewall_link_text;

    $this->blog([
        'viewall_link_position',
        'viewall_link',
        'viewall_link_text',
    ]);

    /* AD CODE
    ================================================================== */
    $section[ 'ad_code' ] = $ad_code;
    $section[ 'banner_image' ] = $banner;
    $section[ 'banner_image_tablet' ] = $banner_tablet;
    $section[ 'banner_image_mobile' ] = $banner_mobile;
    $section[ 'banner_link' ] = [
        'url' => $banner_url,
        'target' => '_blank',
    ];
    $section_css[ 'banner_width' ] = [
        'desktop' => $banner_width,
        'tablet' => $banner_tablet_width,
        'mobile' => $banner_mobile_width,
    ];

    $section[ 'ad_visibility' ] = $ad_visibility;

    $this->blog([
        'ad_code',
        'banner',
        'banner_tablet',
        'banner_mobile',
        'banner_url',
        'banner_width',
        'banner_tablet_width',
        'banner_mobile_width',
        'ad_visibility',
    ]);

    /* FINAL
    ================================================================== */
    $this->set_theme_mod( $section56_id, $section );
    $this->set_theme_mod( $section56_id . '__css', $section_css );
    $sectionlist[] = $section56_id;

    $section_transfer[ $section_index ] = $section56_id;

}
$builder['sectionlist'] = $sectionlist;
$builder['transfer'] = $section_transfer;

$this->set_theme_mod( 'h', $builder );

// var_dump( get_theme_mod( 'h' ) );

$this->log([
    'builder_heading_style',
    'builder_heading_align',
    'builder_heading_line_stretch',
    'builder_heading_line_color',
]);

/**
 * builder settings
 */

/*
@layout: slider
@customize_components: false
@components: thumbnail,title,date,category,excerpt
@column: 3
@first_standard:
@big_first_post:
@item_card:
@item_card_background:
@item_spacing:
@item_template:
@item_border:
@item_border_color:
@align:
@color:
@list_spacing:
@list_sep:
@list_sep_style:
@list_sep_color:
@list_valign:
@list_mobile_layout:
@big_content_excerpt:
@big_align:
@big_meta_background:
@slider_size:
@slider_nav_style:
@slider_dot_style:
@slider_autoplay:
@slider1_height: short
@slider1_content_color:
@slider1_content_background:
@slider1_content_background_opacity:
@slider3_text_background:
@group1_big_position:
@group1_big_ratio:
@group1_big_number: 1
@group1_small_display: list
@group1_small_column: 1
@group2_columns_order:
@group2_big_number: 1
@group2_medium_number: 1
@group2_small_display: grid
@heading_thumbnail:
@thumbnail_type:
@thumbnail:
@thumbnail_custom:
@thumbnail_shape:
@thumbnail_hover:
@thumbnail_hover_logo:
@thumbnail_hover_logo_width: 40%
@thumbnail_showing_effect:
@thumbnail_components: format_indicator
@thumbnail_position:
@thumbnail_width:
@heading_title:
@title_tag:
@title_size:
@title_color:
@heading_excerpt:
@standard_content_excerpt:
@newspaper_content_excerpt:
@excerpt_length:
@excerpt_size:
@excerpt_color:
@excerpt_more_style:
@excerpt_more_text:
@masonry_dropcap:
*/

/* =================================================        BUILDER SETTINGS        */
// #unique_reading
$unique_reading = get_theme_mod( 'wi_unique_reading', 'false' );
if ( 'true' == $unique_reading ) {
    $this->set_theme_mod( 'builder_unique_reading', true );
} else {
    $this->set_theme_mod( 'builder_unique_reading', false );
}

// #home_padding_top
$builder_padding_top = absint( get_theme_mod( 'wi_home_padding_top', 10 ) );
$this->set_theme_mod( 'builder_padding_top', [
    'desktop' => $builder_padding_top,
    'tablet' => $builder_padding_top,
    'mobile' => $builder_padding_top,
]);

// #home_padding_bottom
$builder_padding_bottom = absint( get_theme_mod( 'wi_home_padding_bottom', 60 ) );
$this->set_theme_mod( 'builder_padding_bottom', [
    'desktop' => $builder_padding_bottom,
    'tablet' => $builder_padding_bottom,
    'mobile' => $builder_padding_bottom,
]);

// #section_spacing
$spacing = get_theme_mod( 'wi_section_spacing', 'small' );
$this->set_theme_mod( 'section_spacing', $this->section_spacing_map( $spacing ) );

$this->log([
    'home_builder', // the homepage builder itself of course
    'builder_paged',
    'unique_reading',
    'home_padding_top',
    'home_padding_bottom',
    'section_spacing',
]);

// this is from v2.x
$this->log([
    'sections_order'
], 'deprecated' );

// home layout
$this->log([
    'home_layout',
    'home_sidebar_state',
    'column',
]);

$this->log([

    /*------------------ GROUP 1 ------------------- */
    // spacing, sep - common for group 1, 2
    'group1_spacing',
    'group1_sep_border',
    'group1_sep_border_color',

    // layout
    'group1_big_ratio',
    'group1_big_position',

    // big
    'group1_big_components',
    'group1_big_align',
    'group1_big_item_template',
    'group1_big_thumbnail',
    'group1_big_excerpt_length',
    'group1_big_excerpt_more_text',
    'group1_big_excerpt_more_style',

    // small
    'group1_small_components',
    'group1_small_item_template',
    'group1_small_list_spacing',
    'group1_small_thumbnail',
    'group1_small_excerpt_length',

    /*------------------ GROUP 2 ------------------- */
    // spacing, sep - common for group 1, 2
    'group2_spacing',
    'group2_sep_border',
    'group2_sep_border_color',
    
    // layout
    'group2_columns_order',

    // big
    'group2_big_components',
    'group2_big_align',
    'group2_big_item_template',
    'group2_big_title_size',
    'group2_big_excerpt_length',
    'group2_big_excerpt_more_text',
    'group2_big_excerpt_more_style',

    // medium
    'group2_medium_components',
    'group2_medium_item_template',
    'group2_medium_thumbnail',
    'group2_medium_title_size',
    'group2_medium_excerpt_length',

    // small
    'group2_small_components',
    'group2_small_item_template',
    'group2_small_title_size',
    'group2_small_excerpt_length',

    /*------------------ SLIDER ------------------- */
    'slider1_height',
    'slider1_content_color',
    'slider1_content_background',
    'slider1_content_background_opacity',
    'slider_nav_style',
    'slider_size',

    /*------------------ STANDARD ------------------- */
    'standard_content_excerpt',
    'standard_sep',
    'standard_spacing',
    'standard_title_size',
    'standard_excerpt_length',
    'standard_excerpt_more',
    'standard_excerpt_more_style',

    /*------------------ NEWSPAPER ------------------- */
    'newspaper_content_excerpt',

    /*------------------ BIG ------------------- */
    'big_content_excerpt',

    /*------------------ VERTICAL ------------------- */
    'vertical_thumbnail_position',
    'vertical_excerpt_size',
]);

// old slider
$this->log([
    'slider_title_background',
    'standard_header_align',
    'standard_excerpt_more_align',

    'newspaper_header_align',
], 'deprecated' );