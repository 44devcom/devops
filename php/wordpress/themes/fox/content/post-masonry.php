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
$post_class = [ 'wi-post', 'post-item', 'post-masonry', 'fox-grid-item', 'fox-masonry-item' ];
if ( isset( $args[ 'post_extra_class']  ) ) {
    $post_class[] = $args[ 'post_extra_class' ];
}

/**
 * Post Body Class
 */
$post_body_class = [ 'post-body', 'post-item-body' ];
$post_body_class[] = 'masonry-body';
$post_body_class[] = 'post-masonry-body';

/**
 * Align
 */
$post_class[] = 'post-align-' . $args[ 'align' ];

/**
 * extra thumbnail css
 */
$args[ 'thumbnail_extra_class' ] .= ' masonry-thumbnail';

/**
 * customized args for masonry layout
 */
if ( $args['column'] >=3 ) {
    $args[ 'thumbnail' ] = 'medium';
} else {
    $args[ 'thumbnail' ] = 'large';
}

if ( 1 == $args[ 'count' ] && $args[ 'big_first_post' ] ) {
    $args[ 'thumbnail' ] = 'large';
    $post_class[] = 'masonry-featured-post';
}

// custom thumbnail is set to be false
$args[ 'thumbnail_placeholder' ] = false;

// disable thumbnail showing effect
$args[ 'thumbnail_showing_effect' ] = false;

// extra class
$args[ 'thumbnail_extra_class' ] .= ' masonry-animation-element';

$args[ 'excerpt_extra_class' ] = 'masonry-content dropcap-content small-dropcap-content';

// set them to animation element
$post_body_class[] = 'masonry-animation-element';

/**
 * drop cap
 */
$drop_cap = get_post_meta( get_the_ID(), '_wi_blog_dropcap', true );
if ( ! $drop_cap ) {
    $drop_cap = $args[ 'masonry_dropcap' ] ? 'true' : 'false';
}
if ( 'true' == $drop_cap ) {
    $post_class[] = 'enable-dropcap';
} else {
    $post_class[] = 'disable-dropcap';
}

/**
 * since 4.7.1
 */
$card_css = '';
if ( isset( $args[ 'item_card_background' ] ) ) {
    $card_css = ' style="background-color:' . $args[ 'item_card_background' ] . '"';
}

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <div class="post-item-inner masonry-inner post-masonry-inner">

        <?php if ( $args[ 'thumbnail_show' ] ) {

            fox_thumbnail( $args );

        } ?>

        <div class="<?php echo esc_attr( join( ' ', $post_body_class ) ); ?>"<?php echo $card_css; ?>>

            <div class="post-body-inner">

                <?php fox_post_body( $args ); ?>

            </div>

        </div><!-- .post-item-body -->

    </div><!-- .post-item-inner -->

</article><!-- .post-item -->