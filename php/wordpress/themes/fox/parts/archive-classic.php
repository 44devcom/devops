<?php get_template_part( 'parts/titlebar' ); ?>

<?php get_template_part( 'parts/toparea' ); ?>

<?php

global $wp_query;

$layout = fox_layout();

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

if ( $column ) {
    
    $fn_params[ 'column' ] = $column;
    
}

$fn_params[ 'layout' ] = $layout;
$fn_params[ 'pagination'] = true;
$fn_params[ 'skip_rendered' ] = ( 'true' == get_theme_mod( 'wi_top_area_non_duplicate', 'false' ) );
?>

<div class="wi-content">
    
    <div class="container">

        <div class="content-area primary" id="primary" role="main">

            <div class="theiaStickySidebar">

                <?php fox_blog( $fn_params, $wp_query ); ?>

            </div><!-- .theiaStickySidebar -->

        </div><!-- .content-area -->

        <?php fox_sidebar( 'sidebar' ); ?>

    </div><!-- .container -->
    
</div><!-- .wi-content -->