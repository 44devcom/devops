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
    
    'item_card' => 'none',
    'title_size' => '',
    'show_excerpt' => false,
    'show_date' => true,
    'layout' => 'small',
    'thumbnail_show' => true,
    'thumbnail_align' => 'left',
    'thumbnail' => 'landscape',
    'index' => '',
    'view' => '',
    
    'list_index' => false,
) ) );

echo $before_widget;

/**
 * related not showing in single
 */
if ( $related && ! is_single() ) {
    return;
}

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

if ( 'big' !== $layout ) $layout = 'small';

if ( $related ) {
    
    $query = fox_related_query([

        'number' => $number,
        'source' => $related_source,
        'orderby' => $orderby,
        'order' => $order,
        'exclude_categories' => get_theme_mod( 'wi_single_related_exclude_categories' ),

    ]);
    
} else {

    $args = [
        'number' => $number,
        'unique_posts' => false,
        'pagination' => false,

        'orderby' => $orderby,
        'order' => $order,
    ];
    if ( $tag ) {
        $tags = explode( ',', $tag );
        $tags = array_map( 'trim', $tags );
        $args[ 'tags' ] = $tags;
    }
    if ( $category ) {
        $args[ 'categories' ] = [ $category ];
    }
    if ( $author ) {
        $args[ 'author' ] = $author;
    }
    $args[ 'include' ] = $include;
    $args[ 'featured' ] = (bool) $featured;

    $query = fox_query( $args );
    
}

$blog_layout = 'big' == $layout ? 'grid' : 'list';
$c_params = fox_customize_params( $blog_layout );

/**
 * components
 */
$components = ['title'];
if ( $thumbnail_show ) $components[] = 'thumbnail';
if ( $show_date ) $components[] = 'date';
if ( $show_excerpt ) $components[] = 'excerpt';
$components = join( ',', $components );

/**
 * thumbnail components
 */
$thumbnail_components = [];
if ( $index ) $thumbnail_components[] = 'index';
if ( $view ) $thumbnail_components[] = 'view';
if ( 'review_score' == $orderby || 'review_date' == $orderby ) $thumbnail_components[] = 'review';
if ( 'big' == $layout ) $thumbnail_components[] = 'format_indicator';
$thumbnail_components = join( ',', $thumbnail_components );

/**
 * title size
 */
if ( ! $title_size ) {
    $title_size = 'big' == $layout ? 'small' : 'tiny';
}

$fn_params = wp_parse_args([
    
    'extra_class' => 'blog-widget blog-widget-' . $layout,
    'layout' => ( 'big' == $layout ? 'grid' : 'list' ),
    'list_mobile_layout' => 'list',
    'column' => '1',
    'first_standard' => false,
    'item_card' => $item_card, // since 4.6
    'item_spacing' => 'small',
    'item_template' => ( 'big' == $layout ? 2 : 1 ),
    
    'components' => $components,
    'thumbnail_components' => $thumbnail_components,
    
    // thumbnail
    'thumbnail' => $thumbnail,
    'thumbnail_hover' => 'none',
    'thumbnail_showing_effect' => 'none',
    'thumbnail_width' => '',
    'thumbnail_position' => 'left',
    'thumbnail_shape' => 'acute', // for safe
    'thumbnail_position' => $thumbnail_align,
    
    // title
    'title_tag' => 'h3',
    'title_size' => $title_size,
    'title_extra_class' => 'latest-title',
    
    // excerpt
    'excerpt_length' => ( 'big' == $layout ? '22' : '10' ),
    
    'live' => false,
    
    'list_index' => (bool) $list_index,
    
], $c_params );

fox_blog( $fn_params, $query );

echo $after_widget;