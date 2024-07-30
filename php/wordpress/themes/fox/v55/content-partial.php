<?php while ( have_posts() ) : the_post(); ?>

<?php
$style = fox_get_single_option( 'style', '1' );

$params = [
    'style' => $style,
    
    'sidebar_state' => fox_get_single_option( 'sidebar_state', 'right' ),
    'thumbnail_stretch' => fox_get_single_option( 'thumbnail_stretch', 'stretch-none' ),
    'content_width' => fox_get_single_option( 'content_width', 'full' ),
    'image_stretch' => fox_get_single_option( 'content_image_stretch', 'stretch-none' ),
    'column_layout' => fox_get_single_option( 'column_layout', 1 ),
    
    'header_align' => get_theme_mod( 'wi_single_meta_align', 'center' ),
    'header_item_template' => get_theme_mod( 'wi_single_meta_template', '1' ),
    
    // autoload problem
    'autoload' => fox_autoload(),
    
    // it's a factor
    'body_layout' => get_theme_mod( 'wi_body_layout', 'wide' ),
    
    'dropcap' => ( 'true' == fox_get_single_option( 'dropcap', 'false' ) ),
    'text_column' => fox_get_single_option( 'column_layout', 1 ),
];

$std = [
    'date', 
    'category',
    'post_header',
    'thumbnail',
    'share',
    'tag',
    'related',
    'authorbox',
    'comment',
    'nav',
    'bottom_posts',
    'side_dock',
];
$std = join( ',', $std );

$single_components = get_theme_mod( 'wi_single_components', $std );
$single_components = explode( ',', $single_components );
$single_components = array_map( 'trim', $single_components );

$possible_components = [
    'date', 
    'category',
    'author',
    'author_avatar',
    'comment_link',
    'reading_time',
    'view',
    
    'post_header',
    'thumbnail',
    'share',
    'tag',
    'related',
    'authorbox',
    'comment',
    'nav',
    'bottom_posts',
    'side_dock',
    'show_header',
    'show_footer',
];

$single_possible_options = [
    'post_header',
    'thumbnail',
    'share',
    'tag',
    'related',
    'authorbox',
    'comment',
    'nav',
    'bottom_posts',
    'side_dock',
    'show_header',
    'show_footer',
];

foreach ( $possible_components as $com ) {
    
    $get = '';
    if ( in_array( $com, $single_possible_options ) ) {
        $get = get_post_meta( get_the_ID(), '_wi_' . $com, true );
    }
    
    if ( 'true' == $get ) {
        $value = true;
    } elseif ( 'false' == $get ) {
        $value = false;
    } else {
        $value = in_array( $com, $single_components );
    }
    
    $params[ $com . '_show' ] = $value;
    
}

/**
 * post class based on params
 */
$cl = [
    'wi-content',
    'partial-content',
];
$cl[] = 'single-style-' . $params['style'];

// hero posts
if ( 4 == $params['style'] || 5 == $params['style'] ) {
    $cl[] = 'single-style-hero';
    
}

/**
 * padding top problem
 * padding top should be zero, when: 
        layout 3, has thumbnail, thumbnail stretch full, show thumbnai, has thumbnail, not a post format :))
        layout 1, has thumbnail, thumbnail stretch full, no sidebar
 */
$padding_top_zero = false;
if ( 'stretch-full' == $params[ 'thumbnail_stretch' ]
    && $params[ 'thumbnail_show'] 
    && has_post_thumbnail()
    && ! get_post_format() ) {
    
    if (
        '3' == $style ||
        ( '1' == $style && 'no-sidebar' == $params[ 'sidebar_state' ] ) ) {
        
        $padding_top_zero = true;
    }
}

if ( $padding_top_zero ) {
    $cl[] = 'no-padding-top';
}

$params[ 'post_class' ] = $cl;

/**
 * Now final call
 */
get_template_part( 'single/content', $style, $params );

endwhile; // End the loop. ?>