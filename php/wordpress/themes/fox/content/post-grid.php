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
$post_class = [ 'wi-post', 'post-item', 'post-grid', 'fox-grid-item' ];
if ( isset( $args[ 'post_extra_class']  ) ) {
    $post_class[] = $args[ 'post_extra_class' ];
}

/**
 * Post Body Class
 */
$post_body_class = [ 'post-body', 'post-item-body' ];
$post_body_class[] = 'grid-body';
$post_body_class[] = 'post-grid-body';

/**
 * Align
 */
$post_class[] = 'post-align-' . $args[ 'align' ];

/**
 * extra thumbnail css
 */
$args[ 'thumbnail_extra_class' ] .= ' grid-thumbnail';

/**
 * thumbnail order
 * @since 4.6.7
 */
if ( isset( $args[ 'thumbnail_order' ] ) && $args[ 'thumbnail_order' ] == 'after' ) {
    $thumbnail_order = 'after';
} else {
    $thumbnail_order = 'before';
}
$post_class[] = 'post--thumbnail-' . $thumbnail_order;

$card_css = '';
if ( isset( $args[ 'item_card_background' ] ) ) {
    $card_css = ' style="background-color:' . $args[ 'item_card_background' ] . '"';
}

/**
 * RENDER
 */
ob_start();

if ( $args[ 'thumbnail_show' ] ) {
    fox_thumbnail( $args );
}

$thumbnail_final_html = ob_get_clean();

ob_start(); ?>

<div class="<?php echo esc_attr( join( ' ', $post_body_class ) ); ?>"<?php echo $card_css; ?>>

    <div class="post-body-inner">

        <?php fox_post_body( $args ); ?>

    </div>

</div><!-- .post-item-body -->

<?php $text_final_html = ob_get_clean();

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <div class="post-item-inner grid-inner post-grid-inner">
        
        <?php if ( isset( $args[ 'thumbnail_order' ] ) && $args[ 'thumbnail_order' ] == 'after' ) { ?>
        
        <?php echo $text_final_html . $thumbnail_final_html ; ?>
        
        <?php } else { ?>
        
        <?php echo $thumbnail_final_html . $text_final_html ; ?>

        <?php } ?>

    </div><!-- .post-item-inner -->

</article><!-- .post-item -->