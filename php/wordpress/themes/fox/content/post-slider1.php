<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

/**
 * post class
 */
$post_class = [ 'post-slide1' ];
if ( isset( $args[ 'post_extra_class']  ) ) {
    $post_class[] = $args[ 'post_extra_class' ];
}
    
$args[ 'thumbnail_type' ] = 'simple';
$args[ 'thumbnail' ] = 'original';
$args[ 'thumbnail_extra_class' ] = 'post-slide1-thumbnail';
$args[ 'thumbnail_shape' ] = 'acute';
$args[ 'thumbnail_hover' ] = 'none';
$args[ 'thumbnail_showing_effect' ] = 'none';
$args[ 'thumbnail_format_indicator' ] = false;
$args[ 'thumbnail_view' ] = false;
$args[ 'thumbnail_index' ] = false;
$args[ 'thumbnail_review_score' ] = false;

$args[ 'title_extra_class' ] = 'post-slide1-title';
$args[ 'meta_extra_class' ] = 'post-slide1-meta';
$show_category = $args[ 'category_show' ]; // extract value first
$args[ 'category_show' ] = false;

/**
 * Text Box CSS
 */
$text_class = [ 'post-slide1-text' ];
$text_css = $background_css = [];
if ( $args[ 'slider1_content_color' ] ) {
    $post_class[] = 'has-custom-color';
    $text_css[] = 'color:' . $args[ 'slider1_content_color' ];
}
if ( $args[ 'slider1_content_background' ] ) {
    $post_class[] = 'has-custom-background';
    $background_css[] = 'background-color:' . $args[ 'slider1_content_background' ];

    if ( '' !== $args[ 'slider1_content_background_opacity' ] ) {
        $background_css[] = 'opacity:' . $args[ 'slider1_content_background_opacity' ];
    }
}

$text_css = join( ';', $text_css );
if ( $text_css ) {
    $text_css = ' style="' . esc_attr( $text_css ) . '"';
}

$background_css = join( ';', $background_css );
if ( $background_css ) {
    $background_css = ' style="' . esc_attr( $background_css ) . '"';
}

/**
 * Align
 * @since 4.6.2.2
 */
$post_class[] = 'post-align-' . $args[ 'align' ];

?>

<li class="slide">
                
    <article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

        <?php fox_thumbnail( $args ); ?>

        <div class="post-slide1-text"<?php echo $text_css; ?>>

            <div class="post-slide1-content">

                <div class="post-slide1-main-content">

                    <?php if ( $show_category ) { fox_post_categories([  'extra_class' => 'standalone-categories post-slide1-categories', 'style' => get_theme_mod( 'wi_standalone_category_style', 'plain' ) ]); } ?>

                    <?php if ( $args[ 'title_show' ] ) { fox_post_title( $args ); } ?>

                    <?php fox_post_meta( $args ); ?>
                    
                    <?php if ( $args[ 'excerpt_show' ] ) { ?>
                    
                    <?php fox_post_excerpt( $args ); ?>
                    
                    <?php } ?>

                </div><!-- .post-slide1-main-content -->

                <div class="post-slide1-background"<?php echo $background_css; ?>></div>

            </div><!-- .post-slide1-content -->

        </div><!-- .post-slide1-text -->

        <div class="post-slide1-overlay"></div>
        <div class="post-slide1-height"></div>

    </article><!-- .post-slide1 -->

</li>