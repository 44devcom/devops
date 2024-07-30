<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'number' => '4',
    'category' => '',
    'tag' => '',
    'author' => '',
    'include' => '',
    'featured' => '',
    
    'related' => false, // since 4.5
    'related_source' => 'tag', // since 4.5
    
    'orderby' => 'date',
    'order' => 'desc',
    
    'show_excerpt' => false,
    'show_date' => true,
    'layout' => 'small',
    'thumbnail_show' => true,
    'thumbnail_align' => 'left',
    'thumbnail' => 'landscape',
    'index' => '',
    'view' => '',

    // CSS options
    'title_font_size' => '',
    'excerpt_font_size' => '',
    'meta_font_size' => '',
) ) );

if  ( $related && ! is_single() ) {
    return;
}

echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$query_args = [];
/* ------------------------------------------------     query */
if ( $related ) {

    $query = fox56_related_query([
        'number' => $number,
        'source' => $related_source,
        'orderby' => $orderby,
        'order' => strtoupper( $order ),
        'exclude_categories' => get_theme_mod( 'single_related_exclude_categories', '' ),
    ]);

} else {
    
    // INCLUDE
    $include = trim( $include );
    if ( ! empty( $include ) ) {
        $include = explode(',',$include);
        $include = array_map( 'intval', $include );
        $query_args[ 'post__in' ] = $include;
        $query_args[ 'orderby' ] = 'post__in';
        $query_args[ 'order' ] = 'ASC';
    } else {
        $query_args = [
            'posts_per_page' => $number,
            'cat' => $category,
        ];

        // TAG
        $tag = trim( $tag );
        if ( ! empty( $tag ) ) {
            $tag = explode( ',', $tag );
            $tag = array_map( 'intval', $tag );
            $query_args[ 'tag__in' ] = $tag;
        }

        // AUTHOR
        if ( $author ) {
            $query_args[ 'author' ] = $author;
        }

        // FEATURED
        if ( $featured ) {
            $query_args[ 'featured' ] = true;
        }

        // ORDER
        $order = strtoupper( $order );
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
    }

    $query_args[ 'post_type' ] = 'post';
    $query_args[ 'ignore_sticky_posts' ] = true;
    $query_args[ 'post_status' ] = 'publish';
    $query_args[ 'no_found_rows' ] = true;

    $query = new WP_QUery( $query_args );
}

/* ------------------------------------------------     layout */
$args = [
    'column' => [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ],
    'thumbnail_position' => $thumbnail_align,
    'excerpt_length' => ( 'big' == $layout ? '22' : '10' ),
    'title_tag' => 'h3',
    'live' => false,
    'thumbnail_hover' => 'none',
    'post_class' => 'post56--widget',
];

/* --------- COMPONENTS */
$components = [];
if ( $thumbnail_show ) {
    $components[] = 'thumbnail';
}
$components[] = 'title';
if ( $show_date ) {
    $components[] = 'date';
}
if ( $show_excerpt ) {
    $components[] = 'excerpt';
}
$args[ 'components' ] = $components;

/* --------- THUMBNAIL */
$thumbnail_map = [
    'landscape' => 'thumbnail-medium',
    'square' => 'thumbnail-square',
    'portrait' => 'thumbnail-portrait',
];
$thumbnail = isset( $thumbnail_map[ $thumbnail ] ) ? $thumbnail_map[ $thumbnail ] : $thumbnail;
$args['thumbnail'] = $thumbnail;

/* --------- VIEW */
if ( $view ) {
    $args[ 'thumbnail_view' ] = true;
}

/* --------- REVIEW */
if ( $orderby == 'review_score' || $orderby == 'review_date' ) {
    $args[ 'thumbnail_review' ] = true;
}

/* --------- LAYOUT */
if ( 'small' == $layout ) {
    $args['layout'] = 'list';
    $layout = 'list';
    $extra_class = 'blog56--widget blog56--widget--small';
} else {
    $layout = 'grid';
    $args['layout'] = 'grid';
    $extra_class = 'blog56--widget blog56--widget--big';
}
$args[ 'container_class' ] = $extra_class;

/* --------- INDEX */
if ( $index ) {
    $args[ 'thumbnail_index' ] = true;
    global $thumbnail_counter;
    $thumbnail_counter = 0;
}

/* ----------------------- CSS options */
$css = [];
if ( ! empty($title_font_size)) {
    $title_font_size = trim( $title_font_size );
    if ( is_numeric( $title_font_size ) ) {
        $title_font_size .= 'px';
    }
    $css['.title56'][] = "font-size:{$title_font_size}";
}
if ( ! empty($excerpt_font_size)) {
    $excerpt_font_size = trim( $excerpt_font_size );
    if ( is_numeric( $excerpt_font_size ) ) {
        $excerpt_font_size .= 'px';
    }
    $css['.excerpt56'][] = "font-size:{$excerpt_font_size}";
}
if ( ! empty($meta_font_size)) {
    $meta_font_size = trim( $meta_font_size );
    if ( is_numeric( $meta_font_size ) ) {
        $meta_font_size .= 'px';
    }
    $css['.meta56'][] = "font-size:{$meta_font_size}";
}
$style = [];
foreach ( $css as $selector => $css_arr ) {
    if ( empty( $css_arr) ) {
        continue;
    }
    $final_selector = "#{$widget_id} .blog56--widget {$selector}";
    $val = join( ';', $css_arr );
    $style[] = "{$final_selector}{ {$val} }";
}
if ( ! empty( $style ) ) {
    ?>
<style><?php echo join( "\n", $style ); ?></style>
<?php }

switch( $layout ) {
    case 'grid' :
        fox56_blog_grid( $query, $args );
    break;
    case 'list' :
        fox56_blog_list( $query, $args );
    break;
}
wp_reset_query();

echo $after_widget;