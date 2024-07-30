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
$post_class = [ 'post-slider3' ];
if ( isset( $args[ 'post_extra_class']  ) ) {
    $post_class[] = $args[ 'post_extra_class' ];
}
    
$args[ 'thumbnail_type' ] = 'simple';
$args[ 'thumbnail' ] = 'thumbnail-portrait';
$args[ 'thumbnail_extra_class' ] = 'post-slider3-thumbnail';
$args[ 'thumbnail_shape' ] = 'acute';
$args[ 'thumbnail_hover' ] = 'none';
$args[ 'thumbnail_showing_effect' ] = 'none';

$args[ 'thumbnail_view' ] = false;
$args[ 'thumbnail_index' ] = false;
$args[ 'thumbnail_review_score' ] = false;

/**
 * text background
 */
$text_css = [];
if ( $args[ 'slider3_text_background' ] ) {
    $text_css[] = 'background:' . $args[ 'slider3_text_background' ];
}
$text_css = join( ';', $text_css );
if ( $text_css ) {
    $text_css = ' style="' . esc_attr( $text_css ) . '"';
}
?>

<div class="carousel-item">
                
    <article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

        <?php fox_thumbnail( $args ); ?>
        
        <div class="post-slider3-text"<?php echo $text_css; ?>>
            
            <div class="text-inner">
            
                <?php fox_post_body( $args ); ?>
            
            </div><!-- .text-inner -->
            
        </div><!-- .post-slider3-text -->

    </article><!-- .post-slider3 -->

</div><!-- .carousel-item -->