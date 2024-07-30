<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

$post_class = [ 'wi-post', 'post-item', 'post-vertical' ];

/**
 * post class
 */
if ( isset( $args['post_extra_class'] ) ) {
    $post_class[] = $args['post_extra_class' ];
}

/**
 * body clas
 */
$post_body_class = [ 'post-body', 'post-item-body', 'vertical-body', 'post-vertical-body' ];

/**
 * thumbnail position
 */
$thumbnail_position = isset( $args[ 'thumbnail_position' ] ) ? $args[ 'thumbnail_position' ] : '';
if ( 'right' != $thumbnail_position && 'alternative' != $thumbnail_position ) $thumbnail_position = 'left';

if ( 'alternative' == $thumbnail_position ) {
    $count = $args[ 'count' ];
    $final_thumbnail_position = ( $count % 2 ) ? 'right' : 'left';
} else {
    $final_thumbnail_position = $thumbnail_position;
}

$post_class[] = 'post-thumbnail-align-' . $final_thumbnail_position;

/**
 * customized args for post vertical
 */
$args[ 'title_extra_class' ] = 'post-vertical-title';
$args[ 'header_class' ] = 'post-vertical-header';
$args[ 'excerpt_extra_class' ] = 'post-vertical-content';
$args[ 'date_fashion' ] = 'short';

/**
 * thumbnail args
 */
$args[ 'thumbnail_placeholder' ] = false;
$args[ 'thumbnail_extra_class' ] .= ' vertical-thumbnail';
$args[ 'thumbnail' ] = 'large';

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <div class="post-item-inner vertical-inner post-vertical-inner">

        <?php if ( $args[ 'thumbnail_show' ] ) { fox_thumbnail( $args ); } ?>

        <div class="<?php echo esc_attr( join( ' ', $post_body_class ) ); ?>">

            <div class="post-body-inner">

                <?php fox_post_body( $args ); ?>

            </div>

        </div><!-- .post-item-body -->

    </div><!-- .post-item-inner -->

</article><!-- .post-item -->