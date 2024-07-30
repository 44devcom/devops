<?php
/* Top Area Content
 * @since 4.0 */
if ( is_category() ) {
    $slug = 'category';
} elseif ( is_tag() ) {
    $slug = 'tag';
} elseif ( is_author() ) {
    $slug = 'author';
} else {
    return;
}

$prefix = 'wi_' . $slug . '_top_area_';

$display = '';
if ( 'category' == $slug || 'tag' == $slug ) {
    $display = get_term_meta( get_queried_object_id(), '_wi_toparea_display', true );
    if ( 'none' == $display ) return;
}
if ( ! $display ) {
    $display = get_theme_mod( $prefix . 'display' );
}

/**
 * to build query
 */
$args = [
    'order' => 'desc',
];

if ( 'view' == $display ) {
    $args[ 'orderby' ] = 'view';
} elseif ( 'comment_count' == $display ) {
    $args[ 'orderby' ] = 'comment_count';
} elseif ( 'featured' == $display ) {
    $args[ 'orderby' ] = 'date';
    $args[ 'featured' ] = 'true';
} else {
    return;
}

$number = '';
if ( 'category' == $slug || 'tag' == $slug ) {
    $number = get_term_meta( get_queried_object_id(), '_wi_toparea_number', true );
}
if ( '' === $number ) {
    $number = get_theme_mod( $prefix . 'number', 4 );
}
$args[ 'number' ] = $number;

if ( is_category() ) {
    $args[ 'categories' ] = [ 'cat_' . get_queried_object_id() ];
} elseif ( is_tag() ) {
    $args[ 'tags' ] = [ get_queried_object_id() ];
} elseif ( is_author() ) {
    global $author;
    $userdata = get_userdata( $author );
    $user_id = get_the_author_meta( 'ID' );
    $args[ 'author' ] = 'author_' . $user_id;
}

$query = fox_query( $args );
if ( ! $query->have_posts() ) {
    wp_reset_query();
    return;
}

$layout = '';
if ( 'category' == $slug || 'tag' == $slug ) {
    $layout = get_term_meta( get_queried_object_id(), '_wi_toparea_layout', true );
}
if ( ! $layout ) {
    $layout = get_theme_mod( $prefix . 'layout', 'group-1' );
}

if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
    $column = intval( str_replace( 'grid-', '', $layout ) );
    $layout = 'grid';
} elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
    $column = intval( str_replace( 'masonry-', '', $layout ) );
    $layout = 'masonry';
} else {
    $column = '';
}

$fn_params = fox_customize_params( $layout );
$fn_params[ 'pagination' ] = false;
if ( $column ) {
    $fn_params[ 'column' ] = $column;
}
$fn_params[ 'layout' ] = $layout;

?>

<div class="toparea">
    
    <div class="container">
        
        <?php fox_blog( $fn_params, $query ); ?>
        
    </div><!-- .container -->
    
</div><!-- .toparea -->