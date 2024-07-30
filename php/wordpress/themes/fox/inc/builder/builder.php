<?php
// set_theme_mod( 'sectionlist', [ 'type' => 'builder', 'content' => [] ] );
add_action( 'init', 'fox56_builder_migrate_h', 1 );
add_action( 'admin_init', 'fox56_builder_migrate_h', 1 );
function fox56_builder_migrate_h() {

    // if we don't have 'h', we don't need to migrate
    if ( false === get_theme_mod( 'h', false ) ) {
        return;
    }

    // if we have sectionlist already, we don't need this anymore
    if ( false !== get_theme_mod( 'sectionlist', false ) ) {
        return;
    }

    $big_arr = fox56_builder_migrate_big_arr();
    $css_arr = fox56_builder_migrate_h_part( $big_arr );
    $h2 = [
        'css' => $css_arr,
    ];
    set_theme_mod( 'h2', $h2 );

}

// var_dump( get_theme_mod( 'h2-section_64b27ac1da3c811' ) );

function fox56_builder_migrate_h_part( $arr ) {
    $refresh = $arr[ 'refresh' ];
    set_theme_mod( $refresh[ 'widget_id' ], $refresh );
    $css_arr = [
        $refresh[ 'widget_id' ] => $arr[ 'css' ]
    ];
    foreach( $arr['children'] as $sub_id => $sub_arr ) {
        $sub_css_arr = fox56_builder_migrate_h_part( $sub_arr );
        $css_arr = array_merge( $css_arr, $sub_css_arr );
    }
    return $css_arr;
}

/**
 * RETURN $big_arr
 */
function fox56_builder_migrate_big_arr() {
    $big_arr = [
        'refresh' => [
            'type' => 'builder',
            'widget_id' => 'sectionlist',
        ],
        'css' => [],
    ];
    $children = [];

    $h = get_theme_mod( 'h', [] );
    if ( false === get_theme_mod( 'h_backup', false ) ) {
        set_theme_mod( 'h_backup', $h );
    }

    $h__css = [];
    $sectionlist = isset( $h['sectionlist'] ) ? $h['sectionlist'] : [];
    $content_new = [];

    foreach ( $sectionlist as $section_id ) {

        /* REFRESH PART
        ------------------------ */
        $widget_settings = get_theme_mod( $section_id, false );
        if ( false === $widget_settings ) {
            continue;
        }
        $section_css = get_theme_mod( $section_id . '__css', [] );
        $new_section_id = 'h2-' . $section_id;
        $widget_settings[ 'section_id' ] = $section_id;
        $widget_settings['type'] = 'section';

        $children[ $new_section_id ] = fox56_builder_migrate_section( $widget_settings, $section_css, $new_section_id );

    }

    $big_arr[ 'children' ] = $children;
    $big_arr['refresh'][ 'content' ] = array_keys( $children );
    return $big_arr;

}

/**
 * $widget_settings is the $section theme mod 
 */
function fox56_builder_migrate_section( $widget_settings, $css, $new_section_id ) {

    $children = fox56_builder_legacy_section_children( $widget_settings, $css );
    $content = array_keys( $children );

    $refresh = fox56_filter_by_type( $widget_settings, 'section' );
    $refresh[ 'content' ] = $content;
    $refresh[ 'widget_id' ] = $new_section_id;
    $refresh[ 'section_name' ] = isset( $css['section_name'] ) ? $css['section_name'] : 'Untitled';
    $css_filtered = fox56_filter_css_by_type( $css, 'section' );
    
    $arr = [
        'children' => $children,
        'refresh' => $refresh,
        'css' => $css_filtered,
    ];

    return $arr;

}

function fox56_filter_css_by_type( $arr, $type ) {
    $fields = fox56_builder_get_fields_from_type( $type );
    if ( ! $fields ) {
        $fields = [];
    }
    $args = [];
    foreach ( $arr as $k => $v ) {
        if ( ! isset( $fields[ $k ] ) ) {
            continue;
        }
        if ( ! isset( $fields[ $k ]['css'])) {
            continue;
        }
        $args[$k] = $arr[$k];
    }
    return $args;
}

/**
 * so that we filter only neccesary keys for the array
 */
function fox56_filter_by_type( $arr, $type, $preserve = [ 'widget_id', 'section_name', 'type', 'content' ] ) {
    $fields = fox56_builder_get_fields_from_type( $type );
    if ( ! $fields ) {
        $fields = [];
    }
    $args = [];
    foreach ( $arr as $k => $v ) {
        if ( ! isset( $fields[ $k ] ) ) {
            continue;
        }
        // we don't take css stuff, It's a part of h__css
        if ( isset( $fields[ $k ]['css'])) {
            continue;
        }
        $args[$k] = $arr[$k];
    }
    foreach( $preserve as $k ) {
        if ( isset( $arr[$k] ) ) {
            $args[$k] = $arr[$k];
        }
    }
    return $args;
}

// RETURN array widget_id => widget_settings
function fox56_builder_widgetlist() {
    global $fox_widgets;
    if ( ! is_array( $fox_widgets ) ) {
        $fox_widgets = [];
        $ids = fox56_builder_cone_ids( 'sectionlist' );
        foreach( $ids as $id ) {
            if ( 'sectionlist' != $id ) {
                $fox_widgets[ $id ] = get_theme_mod( $id, [] );
            }
        }
    }
    return $fox_widgets;
}

/**
 * take care everything of the builder
 * ------------------------------------------------
 */
function fox56_builder() {
    global $builder_posts; // list of IDs, this is for unique post rendering
    $builder_posts = [];

    fox56_builder_render_widget_id( 'sectionlist' );

    /*
    $instance = fox56_builder_get_instance_from_type( 'builder' );
    $args = [
        'widget_id' => 'sectionlist',
        'content' => get_theme_mod( 'sectionlist', [] )
    ];
    $instance->final_render( $args );
    */
}

/**
 * BUILDER INNER
 * ------------------------------------------------
 */

function fox56_builder_render_widget_id( $widget_id ) {

    $widget_settings = get_theme_mod( $widget_id, [] );
    if ( 'sectionlist' == $widget_id ) {
        $widget_settings[ 'type' ] = 'builder';
        $widget_settings[ 'widget_id' ] = $widget_id;
    }

    /*
    if ( isset( $structure[ $widget_id ] ) ) {
        $widget_settings[ 'content' ] = $structure[ $widget_id ];
    }
    */

    fox56_builder_render_widget( $widget_settings );

}

function fox56_builder_cone_ids( $widget_id ) {
    $arr = [ $widget_id ];
    $settings = get_theme_mod( $widget_id, [] );
    $content = isset( $settings[ 'content' ] ) ? $settings[ 'content' ] : [];
    foreach( $content as $sub_id ) {
        $arr = array_merge( $arr, fox56_builder_cone_ids( $sub_id ) );
    }
    return $arr;
}

function fox56_builder_render_widget( $widget_settings ) {

    $type = isset( $widget_settings['type'] ) ? $widget_settings['type'] : '';
    $instance = fox56_builder_get_instance_from_type( $type );
    if ( ! $instance ) {
        return;
    }
    $instance->final_render( $widget_settings );

}

function fox56_builder_get_instance_from_type( $type ) {
    global $builder_widgets;
    if ( ! is_array( $builder_widgets ) ) {
        return;
    }
    if ( ! isset( $builder_widgets[ $type ] ) ) {
        return;
    }
    return $builder_widgets[ $type ];
}

function fox56_builder_render_widget_content( $content ) {
    foreach ( $content as $sub_widget_id ) {
        fox56_builder_render_widget_id( $sub_widget_id );
    }
}

/**
 * RETURN array of content elements, ie. row, heading, ad..
 */
function fox56_builder_legacy_section_children( $section, $section_css ) {

    $section_children = [];

    /**
     * ad
     */
    $ad_arr = wp_parse_args( $section, [
        'ad_code' => false,
        'banner_image' => false,
        'banner_image_tablet' => false,
        'banner_image_mobile' => false
    ]);
    if ( ! empty( $ad_arr['ad_code'] ) || ! empty( $ad_arr['banner_image'] ) || ! empty( $ad_arr['banner_image_tablet'] ) || ! empty( $ad_arr['banner_image_mobile'] ) ) {
        $new_id = uniqid( 'legacy-' );
        $section_children[ $new_id ] = fox56_section_legacy_ad_element( $section, $section_css, $new_id );
    }

    /**
     * heading
     */
    $heading_arr = wp_parse_args( $section, [
        'heading' => '',
        'heading_empty' => false,
    ]);
    if ( $heading_arr['heading'] !== '' || $heading_arr['heading_empty'] ) {
        $new_id = uniqid( 'legacy-' );
        $section_children[ $new_id ] = fox56_section_legacy_heading_element( $section, $section_css, $new_id );
    }

    /**
     * the main element
     */
    $new_id = uniqid( 'legacy-' );
    $section_children[ $new_id ] = fox56_section_legacy_row_element( $section, $section_css, $new_id );
    return $section_children;
}

/**
 * convert section into an ad
 */
function fox56_section_legacy_ad_element( $section, $section_css, $new_id ) {
    $refresh = fox56_filter_by_type( $section, 'ad' );
    $refresh[ 'type' ] = 'ad';
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];

    $css = fox56_filter_css_by_type( $section_css, 'ad' );
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => [],
    ];
}

function fox56_section_legacy_heading_element( $section, $section_css, $new_id ) {
    $refresh = fox56_filter_by_type( $section, 'heading' );
    $refresh[ 'type' ] = 'heading';
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];

    $css = fox56_filter_css_by_type( $section_css, 'heading' );
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => [],
    ];
}

function fox56_section_legacy_row_element( $section, $section_css, $new_id ) {

    $row_refresh = fox56_filter_by_type( $section, 'row' );
    $row_refresh[ 'type' ] = 'row';
    $row_refresh[ 'widget_id' ] = $new_id;
    
    $row_css = fox56_filter_css_by_type( $section_css, 'row' );
    
    $col_id = uniqid('legacy-');
    $col_refresh = [
        'type' => 'column',
        'size' => '1-1',
        'widget_id' => $col_id,
        'content' => []
    ];
    $col_css = [];
    $col = [
        'refresh' => $col_refresh,
        'css' => $col_css
    ];
    
    /**
     * the main content
     */
    $main_id = uniqid('legacy-');
    $col[ 'children' ] = [
        $main_id => fox56_section_legacy_main_element( $section, $section_css, $main_id ) 
    ];

    /**
     * after code
     */
    if ( isset( $section['after_code'] ) && ! empty( $section['after_code'] ) ) {
        $html_id = uniqid('legacy-');
        $col[ 'children' ][ $html_id ] = [
            'refresh' => [
                'type' => 'html',
                'widget_id' => $html_id,
                'html' => $section['after_code'],
                'content' => []
            ],
            'css' => [],
            'children' => []
        ];
    }

    $col[ 'refresh' ][ 'content' ] = array_keys( $col['children'] );

    $row_children = [
        $col_id => $col 
    ];
    $row_refresh[ 'content' ] = array_keys( $row_children );
    
    return [
        'refresh' => $row_refresh,
        'children' => $row_children,
        'css' => $row_css
    ];

}

function fox56_section_legacy_main_element( $section, $section_css, $new_id ) {

    /**
     * LAYOUT
     */
    extract( wp_parse_args( $section, [
        'layout' => 'grid',
    ]) );
    $arr = [
        'grid' => 'post-grid',
        'list' => 'post-list',
        'masonry' => 'post-masonry',
        'group' => 'post-group',
        'carousel' => 'post-carousel',

        'sidebar' => 'sidebar',
        'page' => 'page',
        'html' => 'html',
    ];
    if ( isset( $arr[ $layout ] ) ) {
        $type = $arr[ $layout ];
    } else {
        $type = 'post-grid';
    }

    /**
     * we take only valid fields
     */
    $refresh = fox56_filter_by_type( $section, $type );
    $css = fox56_filter_css_by_type( $section_css, $type );
    $refresh['type'] = $type;
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => []
    ];
}

/**
 * RETURN array of cat IDs
 * ------------------------------------------------
 */
function fox56_builder_get_cat_array( $cats ) {
    $arr = [];
    foreach ( $cats as $cat ) {
        // cat--
        if ( 0 === strpos( $cat, 'cat--' ) ) {
            // ID
            $cat_remaining = substr( $cat, 5 );
            $cat_id = false;
            if ( is_numeric( $cat_remaining ) ) {
                $cat_id = intval( $cat_remaining );
            } else {
                $cat_slug = $cat_remaining;
                $cat = get_category_by_slug( $cat_slug );
                if ( $cat ) {
                    $cat_id = $cat->term_id;
                }
            }
            if ( $cat_id ) {
                $arr[] = $cat_id;
            }
            continue;
        }
        if ( is_numeric( $cat) ) {
            $arr[] = intval( $cat );
        }
    }
    return $arr;
}

/**
 * RETURN array of author IDs
 * ------------------------------------------------
 */
function fox56_builder_get_author_array( $authors ) {
    $arr = [];
    foreach ( $authors as $author ) {
        if ( 0 === strpos( $author, 'author--' ) ) {
            $author_id = intval( substr( $author, 8 ) );
            $arr[] = $author_id;
            continue;
        }
        if ( is_numeric( $author ) ) {
            $arr[] = intval( $author );
        }
    }
    return $arr;
}

/**
 * RETURN array
 * ------------------------------------------------
 */
function fox56_builder_query_args( $section ) {

    $query_args = [
        'post_status' => 'publish',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    ];

    $section_query_args = wp_parse_args( $section, [
        'include' => '',
        'exclude' => '',
        
        'number' => 3,
        'featured' => false,
        'categories' => [],
        'exclude_categories' => [],
        'tags' => '',
        'exclude_tags' => '',
        'authors' => [],
        'offset' => '',
        'format' => '',
        'orderby' => '',
        'order' => '',

        'exclude_sticky' => false,
        'exclude_featured' => false,

        'pagination' => false,
        'post_type' => '',
        'exclude_displayed' => '',

        'tax_1' => '',
        'tax_1_value' => '',
        'tax_2' => '',
        'tax_2_value' => '',
    ]);

    /* INCLUDE
     * quickly return
    ------------------------------ */
    $include = $section_query_args[ 'include' ];
    if ( ! empty( $include ) ) {
        $include_ids = explode( ',', $include );
        $include_ids = array_map( 'absint', $include_ids );
        $query_args[ 'post__in' ] = $include_ids;
        $query_args[ 'orderby' ] = 'post__in';
        $query_args[ 'order' ] = 'ASC';

        return $query_args;
    }

    /* exclude posts
    ------------------------------ */
    $exclude_posts = [];
    if ( $section_query_args[ 'exclude_sticky' ] ) {
        $sticky_posts = (array) get_option('sticky_posts');
        $exclude_posts = array_merge( $exclude_posts, $sticky_posts );
    }
    if ( $section_query_args[ 'exclude_featured' ] ) {
        $featured_query = new WP_Query([
            'posts_per_page' => -1,
            'featured' => true,
            'post_type' => 'any',
            'post_status' => 'any',
        ]);
        while ( $featured_query->have_posts()) {
            $featured_query->the_post();
            $exclude_posts[] = get_the_ID();
        }
        wp_reset_query();
    }

    /* number
    ------------------------------ */
    $number = $section_query_args['number'];
    if ( ! is_numeric( $number ) ) {
        $number = get_option( 'posts_per_page', 10 );
    }
    if ( ! is_numeric( $number ) ) {
        $number = 10;
    }
    $query_args[ 'posts_per_page' ] = $number;

    /* featured
    ------------------------------ */
    if ( $section_query_args['featured'] ) {
        $query_args[ 'featured' ] = true;
    }

    /* category
    ------------------------------ */
    $categories = $section_query_args['categories'];
    if ( ! empty( $categories ) ) {
        $categories = fox56_builder_get_cat_array( $categories );
        $query_args[ 'category__in' ] = $categories;
    }

    /* exclude category
    ------------------------------ */
    $exclude_categories = $section_query_args[ 'exclude_categories' ];
    if ( ! empty( $exclude_categories ) ) {
        $exclude_categories = fox56_builder_get_cat_array( $exclude_categories );
        $query_args[ 'category__not_in' ] = $exclude_categories;
    }

    /* tags
    ------------------------------ */
    $tag_ids = $section_query_args[ 'tags' ];
    if ( ! empty( $tag_ids ) ) {
        $tag_ids = explode( ',', $tag_ids );
        $tag_ids = array_map( 'intval', $tag_ids );
        $query_args[ 'tag__in' ] = $tag_ids;
    }

    /* tags not in
    ------------------------------ */
    $exclude_tag_ids = $section_query_args[ 'exclude_tags' ];
    if ( ! empty( $exclude_tag_ids ) ) {
        $tag_ids = explode( ',', $exclude_tag_ids );
        $tag_ids = array_map( 'intval', $tag_ids );
        $query_args[ 'tag__not_in' ] = $tag_ids;
    }

    /* authors
    ------------------------------ */
    $authors = $section_query_args[ 'authors' ];
    if ( ! empty( $authors ) ) {
        $authors = fox56_builder_get_author_array( $authors );
        $query_args[ 'author__in' ] = $authors;
    }

    /* offset
    ------------------------------ */
    $offset = $section_query_args['offset'];
    if ( $offset && is_numeric( $offset ) ) {
        $query_args[ 'offset' ] = $offset;
    }

    /* exclude
    ------------------------------ */
    $exclude = $section_query_args['exclude'];
    $exclude_ids = [];

    /* exclude previously posts
    ------------------------------ */
    $exclude_displayed = $section_query_args[ 'exclude_displayed' ];
    if ( 'true' == $exclude_displayed ) {
        $exclude_displayed = true;
    } elseif ( 'false' == $exclude_displayed ) {
        $exclude_displayed = false;
    } else {
        $exclude_displayed = get_theme_mod( 'builder_unique_reading', false );
    }
    if ( $exclude_displayed ) {
        global $builder_posts;
        if ( ! is_array( $builder_posts) ) {
            $builder_posts = [];
        }
        $exclude_ids = array_merge( $exclude_ids, $builder_posts );
    }

    if ( ! empty( $exclude ) ) {
        $exclude_ids = explode( ',', $exclude );
        $exclude_ids = array_map( 'absint', $exclude_ids );
    }
    $exclude_ids = array_merge( $exclude_ids, $exclude_posts );
    if ( ! empty( $exclude_ids) ) {
        $query_args[ 'post__not_in' ] = $exclude_ids;
    }

    /* format
    ------------------------------ */
    $format = $section_query_args['format'];
    if ( in_array( $format, [ 'video', 'audio', 'gallery', 'link' ] ) ) {
            
        $query_args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-' . $format ),
            ),
        );
        
    } elseif ( $format == 'standard' ) {

        $query_args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-video', 'post-format-audio', 'post-format-link', 'post-format-gallery', ),
                'operator' => 'NOT IN',
            ),
        );

    }

    /* order
    ------------------------------ */
    $orderby = $section_query_args['orderby'];
    $order = $section_query_args['order'];
    if ( 'ASC' != $order ) {
        $order = 'DESC';
    }
    if ( 'view' === $orderby ) {
            
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_week' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'week' => date('W'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_month' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'month' => date('n'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_year' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'review_score' == $orderby || 'review_date' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'meta_value_num';
        $query_args[ 'meta_key' ] = '_wi_review_average';
        $query_args[ 'meta_value_num' ] = 0;
        $query_args[ 'meta_compare' ] = '>';
        
        if ( 'review_date' == $orderby ) {
            $query_args[ 'orderby' ] = 'date';
        }
        
        $query_args[ 'order' ] = $order;
        
    } elseif ( ! empty( $orderby ) ) {
        
        $query_args[ 'orderby' ] = $orderby;
        $query_args[ 'order' ] = $order;
        
    }

    /* CPT
    ------------------------------ */
    $post_type = $section_query_args[ 'post_type' ];
    if ( ! empty( $post_type ) ) {
        if ( 'any' == $post_type ) {
            $query_args[ 'post_type' ] = 'any';
        } else {
            if ( ! is_array( $post_type ) ) {
                $post_type = explode( ',', $post_type );
                $post_type = array_map( 'trim', $post_type );
            }
            $query_args[ 'post_type' ] = $post_type;
        }
    }

    /* TAX
    ------------------------------ */
    $tax_query = [];
    for ( $j = 1; $j <=2; $j++ ) {
        if ( $section_query_args[ 'tax_' . $j ] && $section_query_args[ 'tax_' . $j . '_value' ] ) {
            
            $terms = $section_query_args[ 'tax_' . $j . '_value' ];
            $terms = explode( ',', $terms );
            $terms = array_map( 'trim', $terms );
            $tax_query[] = [
                'taxonomy' => $section_query_args[ 'tax_' . $j ],
                'field'    => 'name',
                'terms'    => $terms,
            ];
            
        }
    }
    if ( $tax_query ) {
        if ( ! isset( $query_args[ 'tax_query' ] ) ) {
            $query_args[ 'tax_query' ] = [];
        }
        $query_args[ 'tax_query' ] = array_merge( $query_args[ 'tax_query' ], $tax_query );
    }

    /* pagination
    ------------------------------ */
    if ( $section_query_args[ 'pagination' ] ) {
        $query_args[ 'no_found_rows' ] = false;
        $query_args[ 'paged' ] = get_query_var( 'paged' );
        // adjust offset accordingly
        $offset = absint( $offset );
        if ( $offset > 0 && absint( $query_args[ 'paged' ] ) > 1 ) {
            $offset = $offset + ( ( absint( $query_args[ 'paged' ] ) - 1 ) * absint( $query_args[ 'posts_per_page' ] ) );
            $query_args[ 'offset' ] = $offset;
        }
    } else {
        $query_args[ 'no_found_rows' ] = true;
    }

    return $query_args;

}

/**
 * RETURN WP_Query instance if have_posts
 * RETURN null if not
 * ------------------------------------------------
 */
function fox56_builder_query( $section ) {
    
    if ( isset( $section[ 'custom_query' ] ) && ! empty( trim( $section['custom_query'] ) ) ) {
        $query = new WP_Query( $section['custom_query'] ); 
    } else {
        $query_args = fox56_builder_query_args( $section );
        $query = new WP_Query( $query_args );
    }
    if ( $query->have_posts() ) {
        return $query;
    }
    wp_reset_query();
    return;
    
}

/**
 * HEADING
 * ------------------------------------------------
 */
function fox56_builder_heading_inner( $section ) {

    extract( wp_parse_args( $section, [
        'heading' => '',
        'heading_empty' => false,
        'heading_style' => '',
        'heading_stretch' => 'content',
        'heading_align' => 'center',
        'heading_link' => [],
        'heading_link_position' => 'inheading',
        'heading_link_text' => '',
    ] ) );

    if ( ! $heading && ! $heading_empty ) {
        return;
    }
    if ( $heading_empty ) {
        $heading = '';
    }
    if ( function_exists( 'pll__' ) ) {
        $heading = pll__( $heading );
    }
    
    $cl = [ 'heading56', 'section56__heading' ];

    /**
     * STYLE
     */
    if ( $heading_style ) {
        $cl[] = 'heading56--' . $heading_style;
    }
    if ( in_array( $heading_style, [ 'middle-line', 'pixelate-dots', 'diagonal-stripe' ] ) ) {
        $cl[] = 'heading56--decorate-middle';
    }

    /**
     * STRETCH
     */
    if ( ! in_array( $heading_stretch, [ 'half', 'full' ] ) ) {
        $heading_stretch = 'content';
    }
    $cl[] = 'heading56--stretch-' . $heading_stretch;

    /**
     * ALIGN
     */
    if ( 'left' != $heading_align && 'right' != $heading_align ) {
        $heading_align = 'center';
    }
    $cl[] = 'heading56--' . $heading_align;

    /**
     * LINK
     */
    extract( wp_parse_args( $heading_link, [ 'url' => '', 'target' => '_self' ] ) );
    $a = ''; $a_close = '';
    $a_cl = [ 'heading56__link' ];
    if ( 'separated' != $heading_link_position ) {
        $heading_link_position = 'inheading';
    }
    $a_cl[] = 'heading56__link--' . $heading_link_position;
    if ( $url ) {
        if ( function_exists( 'pll__' )) {
            $url = pll__( $url );
        }
        $a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '" class="' . esc_attr( join( ' ', $a_cl ) ) . '">';
        $a_close = '</a>';
    }
    $separated_link = '';
    if ( 'inheading' != $heading_link_position ) {
        if ( ! $heading_link_text ) {
            $heading_link_text = esc_html__( 'View', 'wi' );
        }
        if ( function_exists( 'pll__' )) {
            $heading_link_text = pll__( $heading_link_text );
        }
        if ( $a && $a_close ) {
            $separated_link = $a . $heading_link_text . $a_close;
        }
    }
    ?>
<div class="heading56__wrapper">    
    <h2 class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php if ( 'inheading' == $heading_link_position ) { echo $a; } ?>
        <?php echo '<span class="heading56__text">'
             . $heading . 
            '<span class="heading56__line heading56__line--left"></span>
            <span class="heading56__line heading56__line--right"></span>
        </span>'; ?>
        <?php if ( 'inheading' == $heading_link_position ) { echo $a_close; } ?>
    </h2>
    <?php echo $separated_link; ?>
</div>
    <?php
}

/**
 * AD
 * ------------------------------------------------
 */
function fox56_builder_ad_inner( $section ) {
    extract( wp_parse_args( $section, [
        'ad_code' => '',
        'banner_image' => 0,
        'banner_image_tablet' => 0,
        'banner_image_mobile' => 0,
        'banner_link' => [],
        'ad_visibility' => 'desktop,tablet,mobile',
    ] ) );
    
    if ( ! $ad_code && ! $banner_image ) {
        return;
    }
    $cl = [ 'section56__ad', 'ad56' ];
    if ( $ad_code ) {
        $cl[] = 'ad56--code';
        ?>
        <div class="ad56__container">
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <?php echo $ad_code ; ?>
            </div>
        </div>
        <?php
        return;
    }

    $cl[] = 'ad56--banner';
    $cl[] = 'banner56';

    /**
     * LINK
     */
    extract( wp_parse_args( $banner_link, [ 'url' => '', 'target' => '_self' ] ) );
    $a = ''; $a_close = '';
    if ( $url ) {
        $a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '">';
        $a_close = '</a>';
    }

    /**
     * VISIBILITY
     */
    if ( ! is_array( $ad_visibility ) ) {
        $ad_visibility = explode( ',', $ad_visibility );
    }
    if ( ! is_customize_preview() ) {
        $cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'hide--desktop';
        $cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'hide--tablet';
        $cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'hide--mobile';
    } else {
        $cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'disable--desktop';
        $cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'disable--tablet';
        $cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'disable--mobile';
    }

    $imgs = [];
    if ( $banner_image_mobile ) {
        $imgs[] = wp_get_attachment_image( $banner_image_mobile, 'full', false, [ 'class' => 'banner56--mobile' ]);
    }
    if ( $banner_image_tablet ) {
        $imgs[] = wp_get_attachment_image( $banner_image_tablet, 'full', false, [ 'class' => 'banner56--tablet' ]);
    }
    if ( $banner_image ) {
        $imgs[] = wp_get_attachment_image( $banner_image, 'full', false, [ 'class' => 'banner56--desktop' ]);
    }
    ?>
<div class="ad56__container">
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo $a; ?>
        <?php echo join( "\n", $imgs ); ?>
        <?php echo $a_close; ?>
    </div>
</div>
    <?php
}

/**
 * $sb is 'main', 'my_sidebar'
 * ------------------------------------------------
 */
function fox56_builder_sidebar_inner( $sb ) {
    if ( ! $sb ) {
        return;
    }
    dynamic_sidebar(  $sb );
}

/**
 * 
 * ------------------------------------------------
 */
function fox56_builder_primary_inner( $section ) {
    $layout = isset( $section['layout'] ) ? $section['layout'] : 'grid';

    switch( $layout ) {
        
        case 'grid' :
            fox56_builder_grid( $section );
        break;

        case 'masonry' :
            fox56_builder_masonry( $section );
        break;

        case 'list' :
            fox56_builder_list( $section );
        break;

        case 'group' :
            fox56_builder_group( $section );
        break;

        case 'carousel' :
            fox56_builder_carousel( $section );
        break;

        case 'sidebar' :
            fox56_builder_main_sidebar( $section );
        break;

        case 'html' :
            fox56_builder_html( $section );
        break;

        case 'page' :
            fox56_builder_page_content( $section );
        break;
            
        default :
        break;
    }
    wp_reset_query(); // in case we forget
}



/**
 * $components = [thumbnail,title,date,excerpt, title-general,title-desktop,title-mobile,date-tablet,date-mobile] is the input from Customizer
 * $std = only components without devices: [thumbnail,title,date..]
 * RETURN array of existing component => devices
 * title => [ desktop, mobile ], date => [ tablet, mobile ]..
 */
function fox56_friendly_components( $components = [] ) {

    $components_order = [];
    $visibility = [];
    foreach ( $components as $com ) {
        $device = null;
        if ( substr( $com, 0, 8 ) == 'tablet--') {
            $device = 'tablet';
            $original_com = substr( $com, 8 );
        } elseif ( substr( $com, 0, 8 ) == 'mobile--') {
            $device = 'mobile';
            $original_com = substr( $com, 8 );
        } elseif ( substr( $com, 0, 9 ) == 'general--' ) {
            $device = 'general';
            $original_com = substr( $com, 9 );
        } elseif ( substr( $com, 0, 9 ) == 'desktop--' ) {
            $device = 'desktop';
            $original_com = substr( $com, 9 );
        } else {
            $components_order[] = $com;
            $original_com = $com;
        }
        if ( ! isset( $visibility[ $original_com ] ) ) {
            $visibility[ $original_com] = [];
        }
        if ( $device ) {
            $visibility[ $original_com ][] = $device;
        }
    }
    foreach ( $visibility as $com => $devices ) {
        if ( empty( $devices ) ) {
            unset( $visibility[$com]);
        }
    }
    $final = [];
    foreach ( $components_order as $com ) {
        if ( isset( $visibility[$com] ) ) {
            $final[$com] = $visibility[$com];
        }
    }

    return $final;

}

/**
 * $components_std = [thumbnail,title,date,author,view].. order of components and redundant
 * $component_arr = [ thumbnail,title,excerpt] only existing components
 * RETURN array with all devices filled
 * title, thumbnail => title-general, title-desktop, title-mobile..
 */
function fox56_components_fill_devices( $components_std, $component_arr ) {
    foreach ( $component_arr as $com ) {
        $components_std[] = "general--{$com}";
        $components_std[] = "desktop--{$com}";
        $components_std[] = "tablet--{$com}";
        $components_std[] = "mobile--{$com}";
    }
    return $components_std;
}

/**
 * RETURN array of popular args (components..)
 */
function fox56_builder_popular_args( $section ) {

    $args = wp_parse_args( $section, [
        'layout' => 'grid',
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
        
        // post style: normal/overlay
        'post_style' => 'normal',
        'ontop_height_style' => 'ratio',
        'ontop_valign' => 'middle',

        // list_mobile_layout
        'list_mobile_layout' => '',

        // align
        'align' => 'left',
        'valign' => 'top',

        // thumbnail
        'thumbnail_loading' => 'lazy',
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_rich' => false,
        'thumbnail_custom' => [],
        'thumbnail_caption' => false,
        'thumbnail_hover_effect' => '',
        'thumbnail_hover_logo' => 0,
        'thumbnail_position' => 'left',
        
        'excerpt_content' => 'excerpt',
        'excerpt_hellip' => get_theme_mod( 'excerpt_hellip', false ),
        'excerpt_length' => 24,
        'title_tag' => 'h2',
        'date_format' => '',
        'date_type' => '',
        'author_avatar' => false,
        'category_tax' => '',
        'more_style' => 'primary',

        // components
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt' ],
    ]);

    /* list_mobile_layout */
    if ( ! in_array( $args['list_mobile_layout'], [ 'list', 'grid' ] ) ) {
        $args['list_mobile_layout'] = get_theme_mod( 'list_mobile_layout', 'list' );
    }

    /**
     * THUMBNAIL COMPONENTS
     */
    $thumbnail_components = isset( $args[ 'thumbnail_components'] ) ? $args['thumbnail_components'] : [ 'format_indicator' ];
    if ( ! is_array( $thumbnail_components ) ) {
        $thumbnail_components = explode(',',$thumbnail_components);
    }
    $args[ 'thumbnail_format_indicator' ] = in_array( 'format_indicator', $thumbnail_components );
    $args[ 'thumbnail_caption' ] = in_array( 'caption', $thumbnail_components );
    $args[ 'thumbnail_review' ] = in_array( 'review', $thumbnail_components );
    $args[ 'thumbnail_view' ] = in_array( 'view', $thumbnail_components );

    return $args;
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_grid( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    fox56_blog_grid( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_masonry( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    fox56_blog_masonry( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_list( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    $args['layout'] = 'list';

    // thumbnail width
    $args[ 'thumbnail_width_type' ] = isset( $section['thumbnail_width_type'] ) ? $section['thumbnail_width_type'] : 'percent';

    fox56_blog_list( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_carousel( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );

    /**
     * more carousel args
     */
    $args[ 'carousel_hint' ] = isset( $section['carousel_hint'] ) ? $section['carousel_hint'] : false;

    fox56_blog_carousel( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_group( $section ) {
    
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );

    /**
     * group layout
     */
    $args[ 'group_layout' ] = isset( $section['group_layout'] ) ? $section['group_layout'] : '2-1';
    $args[ 'big_number' ] = isset( $section['big_number'] ) ? $section['big_number'] : 1;
    $args[ 'medium_number' ] = isset( $section['medium_number'] ) ? $section['medium_number'] : 1;

    /**
     * col options
     */
    $cols = [
        'big' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'thumbnail-large',
            'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'primary',
        ],
        'medium' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
        'small' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'title', 'excerpt' ],
            'excerpt_length' => 12,
            'thumbnail' => 'thumbnail-medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
    ];
    foreach ( $cols as $col => $std ) {
        foreach( $std as $key => $val ) {
            if ( 'components' == $key ) {
                continue;
            }
            $args[ "{$col}_{$key}" ] = isset( $section[ "{$col}_{$key}" ] ) ? $section[ "{$col}_{$key}" ] : $std[ $key ];
        }
    }

    /**
     * force options
     */
    $args[ 'thumbnail_text_gap' ] = [ 'desktop' => 12, 'tablet' => 10, 'mobile' => 8 ];
    $args[ 'thumbnail_width_type' ] = 'pixel';
    $args[ 'thumbnail_position' ] = 'right';

    fox56_blog_group( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_main_sidebar( $section ) {
    extract( wp_parse_args( $section, [
        'main_sidebar' => '',
        'sidebar_layout' => '3',
    ]));

    if ( ! $main_sidebar ) {
        if ( current_user_can( 'manage_options' ) ) {
            echo '<p class="fox-error">Please choose a sidebar to display</p>';
        }
        return;
    }

    if ( ! is_active_sidebar( $main_sidebar ) ) {
        if ( current_user_can( 'manage_options' ) ) {
            echo '<p class="fox-error">Your sidebar is currently empty. Please go to <strong>Appearance > Widgets</strong> to drop widgets there!</p>';
        }
        return;
    }

    $cl = [ 'main-section-sidebar' ];
    if ( ! in_array( $sidebar_layout, [ '1', '2', '3', '4' ] ) ) {
        $sidebar_layout = '3';
    }
    $cl[] = 'main-section-sidebar-' . $sidebar_layout;

    echo '<div class="' . esc_attr( join( ' ', $cl ) ) . '"><div class="section-sidebar-inner">';

    dynamic_sidebar( $main_sidebar );

    echo '</div></div>';

}

/**
 * HTML
 */
function fox56_builder_html( $section ) {

    $html = isset( $section[ 'html' ] ) ? $section[ 'html' ] : '';
    echo '<div class="section-shortcode">';
    echo do_shortcode( $html );
    echo '</div>';

}

/**
 * Page Content
 */
function fox56_builder_page_content( $section ) {
    $page_id = isset( $section[ 'page' ] ) ? $section[ 'page' ] : '';
    $page_id = str_replace( 'page_', '', $page_id );
    if ( ! $page_id ) {
        return;
    }
    
    // we should use WP_Query instead of get_post
    // so that we can pass the_content instead of get_the_content
    $query = new WP_Query([
        'p' => $page_id,
        'post_type' => 'page',
        'post_status' => 'publish',
    ]);
    
    if ( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            echo '<div class="section-page-content">';
            the_content();
            echo '</div>';
        }
    }
    wp_reset_query();
}

/**
 * adjust home posts_per_page
 */
add_action( 'pre_get_posts', function( $query ) {
    if ( is_admin() ) {
        return;
    }
    if ( ! $query->is_main_query() ) {
        return;
    }
    if ( ! is_home() ) {
        return;
    }
    /**
     * set it to 1, so that we can go pagination infinitely
     */
    $query->set( 'posts_per_page', 1 );
});

function fox56_register_widgets( $widgets_manager ) {

    global $builder_widgets;

	require_once( __DIR__ . '/widgets/builder.php' );
    require_once( __DIR__ . '/widgets/section.php' );
    require_once( __DIR__ . '/widgets/row.php' );
    require_once( __DIR__ . '/widgets/column.php' );
	require_once( __DIR__ . '/widgets/heading.php' );
    require_once( __DIR__ . '/widgets/spacer.php' );
    
    require_once( __DIR__ . '/widgets/post-grid.php' );
    require_once( __DIR__ . '/widgets/post-list.php' );
    require_once( __DIR__ . '/widgets/post-group.php' );
    require_once( __DIR__ . '/widgets/post-carousel.php' );
    require_once( __DIR__ . '/widgets/post-masonry.php' );

    require_once( __DIR__ . '/widgets/html.php' );
    require_once( __DIR__ . '/widgets/sidebar.php' );
    require_once( __DIR__ . '/widgets/ad.php' );
    require_once( __DIR__ . '/widgets/page.php' );

	$builder_widgets[ 'builder' ] = new \Fox56_Builder_Builder();
    $builder_widgets[ 'section' ] = new \Fox56_Builder_Section();
    $builder_widgets[ 'row' ] = new \Fox56_Builder_Row();
    $builder_widgets[ 'column' ] = new \Fox56_Builder_Column();
    $builder_widgets[ 'heading' ] = new \Fox56_Builder_Heading();
    $builder_widgets[ 'spacer' ] = new \Fox56_Builder_Spacer();

    $builder_widgets[ 'post-grid' ] = new \Fox56_Builder_Post_Grid();
    $builder_widgets[ 'post-list' ] = new \Fox56_Builder_Post_List();
    $builder_widgets[ 'post-group' ] = new \Fox56_Builder_Post_Group();
    $builder_widgets[ 'post-carousel' ] = new \Fox56_Builder_Post_Carousel();
    $builder_widgets[ 'post-masonry' ] = new \Fox56_Builder_Post_Masonry();
    
    $builder_widgets[ 'html' ] = new \Fox56_Builder_HTML();
    $builder_widgets[ 'sidebar' ] = new \Fox56_Builder_Sidebar();
    $builder_widgets[ 'ad' ] = new \Fox56_Builder_Ad();
    $builder_widgets[ 'page' ] = new \Fox56_Builder_Page();

}
add_action( 'init', 'fox56_register_widgets', 0 );
add_action( 'admin_init', 'fox56_register_widgets', 0 );

if (!function_exists('array_is_list')) {
    function array_is_list(array $arr)
    {
        if ($arr === []) {
            return true;
        }
        return array_keys($arr) === range(0, count($arr) - 1);
    }
}

class Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'slug';
	}

	public function get_title() {
		return 'title';
	}

	public function get_icon() {
		return 'icon';
	}

    public function get_preview_image_url() {
        return '';
    }

	protected function register_controls() {
	}

    private function get_settings_for_display() {
    }

    /**
     * RETURN $args filled with std
     */
    function process( $args ) {
        $fields = $this->fields();
        $std_arr = [];
        foreach ( $fields as $field_id => $field ) {
            if ( ! isset( $field[ 'std' ] ) ) {
                continue;
            }
            if ( ! isset( $args[ $field_id ] ) ) {
                $args[ $field_id ] = $field[ 'std' ];
            } elseif ( is_array( $field[ 'std' ] ) && is_array( $args[ $field_id ] ) && ! array_is_list( $args[ $field_id ] ) ) {
                $args[ $field_id ] = wp_parse_args( $args[ $field_id ], $field[ 'std' ] );
            }
        }
        $args['container_class'] = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
        return $args;
    }

	public function render( $args ) {
        return;
	}

    public function final_render( $args ) {
        $args = $this->process( $args );
        $this->render( $args );
    }

}

/**
 * builder css problem
 */
add_action( 'wp_head', 'fox56_builder_css', 0 );
function fox56_builder_css() {
    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }
    global $builder_widgets;

    $ids = fox56_builder_cone_ids( 'sectionlist' );
    
    // $fox56_customize->css = [];
    $h2 = get_theme_mod( 'h2', [] );
    $h__css = isset( $h2['css'] ) ? $h2['css'] : [];

    foreach( $ids as $widget_id ) {
        if ( 'sectionlist' == $widget_id ) {
            continue;
        }
        $widget_settings = get_theme_mod( $widget_id, false );
        if ( false === $widget_settings ) {
            continue;
        }
        if ( ! isset( $widget_settings['type'] ) ) {
            continue;
        }
        $css = isset( $h__css[ $widget_id ] ) ? $h__css[ $widget_id ] : [];
        $type = $widget_settings[ 'type' ];
        $instance = $builder_widgets[ $type ];
        $fields = $instance->fields();

        foreach ( $fields as $field_id => $field ) {
            if ( ! isset( $field['css'])) {
                continue;
            }
            $field_std = isset( $field['std' ] ) ? $field['std' ] : null;
            
            $value = isset( $css[ $field_id ] ) ? $css[ $field_id ] : $field_std;

            $css_piece = [];
            $has_font = false;
            foreach( $field['css'] as $css_arr ) {
                
                $css_arr['selector'] = str_replace( '{{wrapper}}', '.' . $widget_id, $css_arr['selector'] );

                if ( 'group' == $field['type'] ) {
                    $use = $css_arr['use'];
                    if ( isset( $value[ $use ] ) ) {
                        $final_value = $value[ $use ];
                    } elseif ( isset( $field_std[ $use ] ) ) {
                        $final_value = $field_std[ $use ];
                    } else {
                        $final_value = null;
                    }
                    unset( $css_arr['use'] );
                } else {
                    $final_value = $value;
                }

                /*
                 * size template
                 *
                if ( isset( $css_arr['property'] ) && $css_arr['property'] == 'font-size-template' ) {
                    if ( 'small' == $final_value ) {
                        $selector = $css_arr['selector'];
                        $fox56_customize->css[] = [
                            'selector' => $selector,
                            'property' => 'font-size',
                            'value' => '0.9em',
                        ];
                        $fox56_customize->css[] = [
                            'selector' => $selector,
                            'property' => 'font-size',
                            'value' => '0.8em',
                            'media_query' => $fox56_customize->tablet,
                        ];
                        $fox56_customize->css[] = [
                            'selector' => $selector,
                            'property' => 'font-size',
                            'value' => '0.8em',
                            'media_query' => $fox56_customize->mobile,
                        ];
                    }
                    continue;
                }
                */

                $css_arr[ 'value' ] = $final_value;
                $fox56_customize->css[] = $css_arr;
                $css_piece[] = $css_arr;

                if ( isset( $css_arr['property'] ) && $css_arr['property'] == 'font-family' ) {
                    $has_font = true;
                }
            }
            
            if ( $has_font ) {
                $fox56_customize->typography[] = $css_piece;
            }
            
        }
    } 
}

/* common functions for widgets
---------------------------------------------------------------------- */
function fox56_builder_query_options() {
    global $fox56_customize;

    $fields = [];

    /* Query 
    --------------------------------------------------------------- */
    $fields[ 'number' ] = [
        'type' => 'number',
        'min' => -1,
        'std' => 3,
        'title' => 'Number of posts?',

        'section' => 'query',
        'section_name' => 'Query',
    ];
    
    $fields[ 'orderby' ] = [
        'type' => 'select',
        'std' => '',
        'options' => [
            '' => 'Default',
            'date'  =>'Published Date',
            'modified'  =>'Modified Date',
            'title'  =>'Post title',
            'comment_count'=>'Comment count',
            'view'=>'View count',
            'view_week' =>'View count (Weekly)',
            'view_month'=>'View count (Monthly)',
            'view_year'=>'View count (Yearly)',
            
            'menu_order' => 'Menu Order',
    
            'review_score' => 'Review Score',
            'review_date' => 'Recent Review',
            'rand' => 'Random',
        ],
        'title' => 'Order by',
    ];
    
    $fields[ 'order' ] = [
        'type' => 'radio',
        'std' => 'DESC',
        'options' => [
            'ASC' => 'ASC',
            'DESC' => 'DESC',
        ],
        'title' => 'Order',
    ];
    
    $fields[ 'featured' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Only featured posts?',
    ];
    
    $fields[ 'categories' ] = [
        'type' => 'select',
        'multiple' => true,
        'title' => 'Category',
        'options' => $fox56_customize->category_list,
    ];
    
    $fields[ 'exclude_categories' ] = [
        'type' => 'select',
        'multiple' => true,
        'title' => 'Exclude Category',
        'options' => $fox56_customize->category_list,
    ];
    
    $fields[ 'tags' ] = [
        'type' => 'text',
        'title' => 'Include only tags:',
        'desc' => 'Use tag IDs, eg. 5, 291, 67',
    ];
    
    $fields[ 'exclude_tags' ] = [
        'type' => 'text',
        'title' => 'Exclude following tags:',
        'desc' => 'Use tag IDs, eg. 5, 291, 67',
    ];
    
    $fields[ 'authors' ] = [
        'type' => 'select',
        'title' => 'Include only author:',
        'multiple' => true,
        'options' => $fox56_customize->author_list,
    ];
    
    $fields[ 'format' ] = [
        'type' => 'select',
        'title' => 'Post Format',
        'options' => [
            '' => 'All',
            'standard' => 'Only Standard',
            'video' => 'Only Video',
            'audio' => 'Only Audio',
            'gallery' => 'Only Gallery',
            'link' => 'Only Link',
        ],
        'std' => '',
    ];
    
    $fields[ 'include' ] = [
        'type' => 'text',
        'title' => 'Include only post IDs:',
        'desc' => 'Eg. 5, 17, 211',
    ];
    
    $fields[ 'exclude' ] = [
        'type' => 'text',
        'title' => 'Exclude post IDs:',
        'desc' => 'Eg. 5, 17, 211',
    ];
    
    $fields[ 'exclude_displayed' ] = [
        'type' => 'select',
        'title' => 'Exclude previously displayed posts',
        'options' => [
            '' => 'Inherit from Builder Settings',
            'true' => 'Yes',
            'false' => 'No',
        ],
        'std' => '',
        'desc' => 'If you choose Yes, It will skip posts have been displayed by previous sections. This is for Non-duplicated posts.',
    ];
    
    $fields[ 'offset' ] = [
        'type' => 'number',
        'std' => 0,
        'title' => 'Offset',
        'desc' => 'Number of posts to pass by',
    ];
    
    $fields[ 'exclude_sticky' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Exclude sticky posts?',
        'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
    ];
    
    $fields[ 'exclude_featured_posts' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Exclude featured posts?',
        'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
    ];
    
    $fields[ 'pagination' ] = [
        'type' => 'checkbox',
        'title' => 'Pagination?',
    ];
    
    $fields[ 'disable_paged' ] = [
        'type' => 'checkbox',
        'title' => 'Disable this section from 2nd pages?',
    ];
    
    $fields[ 'custom_query' ] = [
        'type' => 'textarea',
        'title' => 'Custom Query String',
        'desc' => 'Do not enter if you don\'t understand what are you doing.',
    ];
    
    /* ---------------------------------        cpt         */
    $fields[ 'cpt__heading' ] = [
        'type' => 'heading',
        'heading' => 'Custom post type',
    ];
    
    $fields[ 'post_type' ] = [
        'type' => 'text',
        'title' => 'Enter custom post type',
        'desc' => 'Eg. my_movie. You can enter several post types, separated by comma: post, my_movie, my_book',
    ];
    
    $fields[ 'tax_1' ] = [
        'type' => 'text',
        'title' => 'Enter custom taxonomy 1',
        'desc' => 'Eg. movie_genre',
    ];
    
    $fields[ 'tax_1_value' ] = [
        'type' => 'text',
        'title' => 'Taxonomy 1 value (name)',
        'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
    ];
    
    $fields[ 'tax_2' ] = [
        'type' => 'text',
        'title' => 'Enter custom taxonomy 2',
        'desc' => 'Eg. movie_genre',
    ];
    
    $fields[ 'tax_2_value' ] = [
        'type' => 'text',
        'title' => 'Taxonomy 2 value (name)',
        'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
    ];

    return $fields;
}

function fox56_builder_post_style_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'post_style' ] = [
        'type' => 'radio_image',
        'std' => 'normal',
        'options' => [
            'normal' => get_template_directory_uri() . '/inc/customize/images/post-style-normal.jpg',
            'ontop' => get_template_directory_uri() . '/inc/customize/images/post-style-ontop.jpg',
        ],
        'title' => 'Post text style',
    
        'section' => 'post_style',
        'section_name' => 'Post Style',
    ];

    $fields[ 'ontop_valign' ] = [
        'type' => 'radio',
        'title' => '[On Top] Text Position',
        'options' => [
            'top' => 'Top',
            'middle' => 'Middle',
            'bottom' => 'Bottom',
        ],
        'std' => 'middle',
        'transport' => 'postMessage',
        'condition' => [
            "post_style" => 'ontop',
        ]
    ];

        /* -----------------------  ON TOP OPTIONS */
        $fields[ 'ontop_height_style' ] = [
            'type' => 'radio',
            'std' => 'ratio',
            'options' => [
                'fixed' => 'Fixed height',
                'ratio' => 'By ratio',
            ],
            'title' => 'Post height by?',
            
            'condition' => [
                "post_style" => 'ontop',
            ],
        ];
    
        $fields[ 'ontop_padding' ] = [
            'type' => 'group',
            'fields' => [
                'desktop' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'placeholder' => 'Eg. 80%',
                    'name' => 'Desktop', 
                ],
                'tablet' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'name' => 'Tablet', 
                ],
                'mobile' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'name' => 'Mobile', 
                ],
            ],
            'std' => [
                'desktop' => '80',
                'tablet' => '80',
                'mobile' => '80',
            ],
            'css' => [
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'desktop',
                ],
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
            ],
            'desc' => 'Post ratio height/width. If any devices value missing, it will take value from bigger device.',
            'title' => 'Padding (%)',
            'condition' => [
                "post_style" => 'ontop',
                'ontop_height_style' => 'ratio',
            ],
        ];
    
        $fields[ 'ontop_height' ] = [
            'type' => 'group',
            'fields' => [
                'desktop' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'placeholder' => 'Eg. 320',
                    'name' => 'Desktop', 
                ],
                'tablet' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'name' => 'Tablet', 
                ],
                'mobile' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'name' => 'Mobile', 
                ],
            ],
            'desc' => 'Post fixed. If any devices value missing, it will take value from bigger device.',
            'title' => 'Post height',
            'condition' => [
                "post_style" => 'ontop',
                'ontop_height_style' => 'fixed',
            ],
            'std' => [
                'desktop' => '320',
                'tablet' => '320',
                'mobile' => '320',
            ],
            'css' => [
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'desktop',
                ],
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
            ],
        ];
    
        $fields[ 'ontop_overlay' ] = [
            'type' => 'color',
            'name' => 'Overlay background',
            'std' => 'rgba(0,0,0,.3)',
            'css' => [
                [
                    'selector' => '{{wrapper}} .post56__overlay',
                    'property' => 'background',
                ]
            ],
            'condition' => [
                "post_style" => 'ontop',
            ],
        ];

    return $fields;

}

function fox56_builder_component_spacing_options() {
    global $fox56_customize;
    $fields = [];
    $fields[ 'component_spacing' ] = [
        'type' => 'group',
        'title' => 'Component spacing',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 8,
            'tablet' => 8,
            'mobile' => 6,
        ],

        'css' => [
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    $fields[ 'thumbnail_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Thumbnail gap bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'condition' => [
            "post_style" => 'normal',
        ],
    ];

    $fields[ 'title_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Title margin bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    $fields[ 'excerpt_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Excerpt margin bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    return $fields;
}

function fox56_builder_border_options() {
    global $fox56_customize;
    $fields = [];
    
    $fields[ 'border__heading' ] = [
        'type' => 'heading',
        'heading' => 'Border',
    ];
    
    $fields[ 'v_sep' ] = [
        'type' => 'radio',
        'title' => 'Vertical border between cols?',
        'options' => [
            '1px' => 'Yes',
            '0px' => 'No',
        ],
        'std' => '0px',
        'css' => [
            [
                'property' => 'border-right-width',
                'selector' => "{{wrapper}} .blog56__sep__line",
            ],
        ],
    ];

    $fields[ 'v_sep_color' ] = [
        'type' => 'color',
        'title' => 'Vertical border color',
        'css' => [
            [
                'property' => 'border-color',
                'selector' => "{{wrapper}} .blog56__sep__line",
            ],
        ],
    ];

    // if group, it applies to sub-items
    $fields[ 'h_sep' ] = [
        'type' => 'radio',
        'title' => 'Horizontal border between items?',
        'options' => [
            '1px' => 'Yes',
            '0px' => 'No',
        ],
        'std' => '0px',
        'css' => [
            [
                'property' => 'border-top-width',
                'selector' => "{{wrapper}} .post56__sep__line",
            ],
        ],
        
    ];

    $fields[ 'h_sep_color' ] = [
        'type' => 'color',
        'title' => 'Horizontal border color',
        'css' => [
            [
                'property' => 'border-color',
                'selector' => "{{wrapper}} .post56__sep__line",
            ],
        ],
    ];
    return $fields;
}

function fox56_builder_item_box_options() {
    
    global $fox56_customize;
    
    $fields = [];

    $fields[ 'item__heading' ] = [
        'type' => 'heading',
        'heading' => 'Post Item Box',
    ];

    $fields[ 'item_border_radius' ] = [
        'type' => 'text',
        'std' => '0',
        'id' => "item_border_radius",
        'title' => 'Post box border radius',
        'css' => [
            [
                'property' => 'border-radius',
                'selector' => "{{wrapper}} .post56",
                'unit' => 'px',
            ],
        ],
    ];

    $fields[ 'item_background' ] = [
        'type' => 'color',
        'title' => 'Post box background',
        'css' => [
            [
                'property' => 'background-color',
                'selector' => "{{wrapper}} .post56",
            ],
        ],
        
    ];

    $fields[ 'item_shadow' ] = [
        'type' => 'number',
        'title' => 'Post box shadow',
        'std' => 0,
        'css' => [
            [
                'property' => 'box-shadow',
                'selector' => "{{wrapper}} .post56",
                'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
            ],
        ],
    ];

    $fields[ 'item_padding' ] = [
        'type' => 'group',
        'fields' => [
            'desktop' => [
                'type' => 'text',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'text',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'text',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 0,
            'tablet' => 0,
            'mobile' => 0,
        ],
        'title' => 'Post box padding',
        'css' => [
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];
    return $fields;
}

function fox56_builder_component_options() {

    global $fox56_customize;
    $fields = [];

    $fields[ 'components' ] = [
        'type' => 'sortable',

        'section' => 'components',
        'section_name' => 'Components',

        'options' => [
            'thumbnail' => 'Post Thumbnail',
            'standalone_category' => [
                'display' => 'inline',
                'name' => 'Fancy Category'
            ],
            'live' => [
                'display' => 'inline',
                'name' => 'LIVE Indicator'
            ],
            'title' => 'Post Title',
            'date' => [
                'display' => 'inline',
                'name' => 'Date'
            ],
            'author' => [
                'display' => 'inline',
                'name' => 'Author'
            ],
            'category' => [
                'display' => 'inline',
                'name' => 'Category'
            ],
            'comment' => [
                'display' => 'inline',
                'name' => 'Comment'
            ],
            'reading_time' => [
                'display' => 'inline',
                'name' => 'Read time'
            ],
            'view' => [
                'display' => 'inline',
                'name' => 'View'
            ],
            'excerpt' => 'Excerpt',
            'more' => 'ReadMore button',
            'share' => 'Social share icons',
        ],
        'title' => 'Components to display',
        'std' => [ 'thumbnail', 'standalone_category', 'live', 'title', 'date', 'excerpt' ],
    ];

    return $fields;

}

function fox56_builder_title_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'title_tag' ] = [
        'id' => "title_tag",
        'type' => 'radio',
        'options' => [
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
        ],
        'std' => 'h2',
        'title' => 'Title heading',

        'section' => 'title',
        'section_name' => 'Title',
    ];

    return $fields;
}

function fox56_builder_excerpt_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'excerpt_content' ] = [
        'type' => 'radio',
        'title' => 'Excerpt/content?',
        'options' => [
            'excerpt' => 'Excerpt',
            'content' => 'Content',
        ],

        'std' => 'excerpt',
        
        'section' => 'excerpt',
        'section_name' => 'Excerpt',
    ];

    $fields[ 'excerpt_length' ] = [
        'type' => 'number',
        'title' => 'Excerpt length',
        
        'std' => 24,
        'min' => 0,
        'max' => 60,
        'step' => 1,
    ];

    $fields[ 'more_style' ] = [
        'type' => 'radio_image',
        'title' => 'More button style',
        
        'options' => [
            'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
            'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
            'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
            'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
            'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
            'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
        ],
        'std' => 'primary',
    ];

    return $fields;
}

function fox56_builder_meta_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'date_format' ] = [
        'type' => 'text',
        'title' => 'Date format',
        'desc' => 'Learn about date format <a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank">here</a>. By default, It will display date based on your general date format setting.',
        
        'section' => 'meta',
        'section_name' => 'Meta',
    ];

    $fields[ 'date_type' ] = [
        'type' => 'radio',
        'title' => 'Date type',
        'options' => [
            '' => 'Default',
            'publish' => 'Published date',
            'updated' => 'Updated date',
        ],
        'std' => '',
    ];

    $fields[ 'author_avatar' ] = [
        'type' => 'checkbox',
        'title' => 'Author avatar?',
    ];

    $fields[ 'author_avatar_size' ] = [
        'type' => 'group',
        'title' => 'Author avatar size',
        'css' => [
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'fields' => [
            'desktop' => [
                'name' => 'Desktop',
                'type' => 'number',
                'max' => 100,
                'min' => 20,
                'col' => '1-3',
            ],
            'tablet' => [
                'name' => 'Tablet',
                'type' => 'number',
                'max' => 100,
                'min' => 20,
                'col' => '1-3',
            ],
            'mobile' => [
                'name' => 'Mobile',
                'type' => 'number',
                'max' => 100,
                'min' => 10,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 32,
            'tablet' => 28,
            'mobile' => 24,
        ],
    ];

    $fields[ 'category_tax' ] = [
        'type' => 'text',
        'title' => 'Custom Taxonomy in place of category',
        'desc' => 'Please use precisely the taxonomy slug, eg. post_tag, product_cat or my_movie',
    ];

    return $fields;
}

function fox56_builder_color_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'color' ] = [
        'type' => 'color',
        'title' => 'Custom Text color',
        'css' => [
            [
                'selector' => "
                {{wrapper}},
                {{wrapper}} .post56,
                {{wrapper}} .title56, 
                {{wrapper}} .excerpt56, 
                {{wrapper}} .meta56,
                {{wrapper}} .meta56 a, 
                {{wrapper}} .meta56__category--fancy,
                {{wrapper}} .btn56--outline,
                {{wrapper}} .btn56--fill",
                'property' => 'color',
            ],
            [
                'selector' => "{{wrapper}} .btn56--outline,
                {{wrapper}} .btn56--fill",
                'property' => 'border-color',
            ],
            [
                'selector' => "{{wrapper}} .btn56--fill:hover",
                'property' => 'background-color',
            ],
            // make this always white when hovered
            [
                'selector' => "{{wrapper}} .btn56--fill:hover",
                'property' => 'color',
                'value_pattern' => 'white',
            ],
        ],

        'section' => 'color',
        'section_name' => 'Color',
    ];

    $fields[ 'title_color' ] = [
        'id' => 'title_color',
        'type' => 'color',
        'title' => 'Title color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .title56 a",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'title_hover_color' ] = [
        'type' => 'color',
        'title' => 'Title hover color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .title56 a:hover",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'excerpt_color' ] = [
        'type' => 'color',
        'title' => 'Excerpt color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .excerpt56",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'meta_color' ] = [
        'type' => 'color',
        'title' => 'Post meta color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'meta_link_color' ] = [
        'type' => 'color',
        'title' => 'Meta link color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56 a",
                'property' => 'color',
            ],
        ],
        
    ];

    $fields[ 'meta_link_hover_color' ] = [
        'type' => 'color',
        'title' => 'Meta link hover color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56 a:hover",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'standalone_category_color' ] = [
        'type' => 'color',
        'title' => 'Fancy category color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56__category--fancy a",
                'property' => 'color',
            ],
        ],
    ];

    return $fields;
}

function fox56_builder_typo_css( $selector, $wrapper_prefix = true ) {
    global $fox56_customize;
    if ( $wrapper_prefix ) {
        $selector = "{{wrapper}} $selector";
    }
    return [
        [
            'selector' => $selector,
            'property' => 'font-family',
            'use' => 'face',
        ],
        [
            'selector' => $selector,
            'property' => 'font-weight',
            'use' => 'weight',
        ],
        [
            'selector' => $selector,
            'property' => 'font-style',
            'use' => 'style',
        ],
        /*
        [
            'selector' => $selector,
            'property' => 'font-size-template',
            'use' => 'size_template',
        ],
        */
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size',
            'unit' => 'px',
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_tablet',
            'unit' => 'px',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_mobile',
            'unit' => 'px',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => $selector,
            'property' => 'line-height',
            'use' => 'line_height',
        ],
        [
            'selector' => $selector,
            'property' => 'letter-spacing',
            'use' => 'spacing',
            'unit' => 'px',
        ],
        [
            'selector' => $selector,
            'property' => 'text-transform',
            'use' => 'transform',
        ],
    ];
}

function fox56_builder_typography_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'title_typography' ] = [
        'type' => 'group',
        'title' => "Title Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.title56' ),
        
        'section' => 'typography',
        'section_name' => 'Typography',
    ];

    $fields[ 'excerpt_typography' ] = [
        'type' => 'group',
        'title' => "Excerpt Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.excerpt56' ),
    ];

    $fields[ 'more_typography' ] = [
        'type' => 'group',
        'title' => "More Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.readmore56 a' ),
    ];

    $fields[ 'meta_typography' ] = [
        'type' => 'group',
        'title' => "Meta Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.meta56' ),
    ];

    $fields[ 'standalone_category_typography' ] = [
        'type' => 'group',
        'title' => "Fancy Category Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.meta56__category--fancy' ),
    ];

    return $fields;
};

function fox56_builder_style_options() {

    $fields[ 'custom_css' ] = [
        'type' => 'textarea',
        'title' => 'Custom CSS',
        'desc' => 'Use {{wrapper}} for the widget selector, eg. {{wrapper}} h2 {color: red;}',
    ];

}











/**
 * regulate the data, so that It's can be wrong
 */
// add_action( 'init', 'fox56_init_h2', 2 );
// add_action( 'admin_init', 'fox56_init_h2', 2 );
function fox56_init_h2() {

    /**
     * SECTIONLIST
     */
    $sectionlist = get_theme_mod( 'sectionlist' );
    $change = false;
    if ( ! is_array( $sectionlist ) ) {
        $sectionlist = [
            'type' => 'builder',
            'widget_id' => 'sectionlist',
            'content' => []
        ];
        $change = true;
    }
    if ( ! isset( $sectionlist['type'] ) || 'builder' != $sectionlist['type'] ) {
        $sectionlist['type'] = 'builder';
        $change = true;
    }
    if ( ! isset( $sectionlist['widget_id'] ) || 'sectionlist' != $sectionlist['widget_id'] ) {
        $sectionlist['widget_id'] = 'sectionlist';
        $change = true;
    }
    if ( ! isset( $sectionlist['content'] ) || ! is_array( $sectionlist['content'] ) ) {
        $sectionlist['content'] = [];
        $change = true;
    }
    if ( $change ) {
        set_theme_mod( 'sectionlist', $sectionlist );
    }
}

function fox56_builder_get_fields_from_type( $type ) {
    global $builder_widgets;
    if ( ! is_array( $builder_widgets ) ) {
        return;
    }
    if ( ! isset( $builder_widgets[ $type ] ) ) {
        return;
    }
    $instance = $builder_widgets[ $type ];
    return $instance->fields();
}