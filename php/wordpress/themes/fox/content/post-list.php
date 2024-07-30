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
$post_class = [ 'wi-post', 'post-item', 'post-list' ];
if ( isset( $args[ 'post_extra_class']  ) ) {
    $post_class[] = $args[ 'post_extra_class' ];
}

/**
 * Post Body Class
 */
$post_body_class = [ 'post-body', 'post-item-body' ];
$post_body_class[] = 'list-body';
$post_body_class[] = 'post-list-body';

/**
 * Thumbnail Position
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
 * extra thumbnail css
 */
$args[ 'thumbnail_extra_class' ] .= ' list-thumbnail';

/**
 * valign
 */
$list_valign = $args[ 'list_valign' ];
if ( 'middle' != $list_valign && 'bottom' != $list_valign ) $list_valign = 'top';
$post_class[] = 'post-valign-' . $list_valign;

/**
 * mobile layout
 */
if ( 'list' != $args[ 'list_mobile_layout' ] ) $args[ 'list_mobile_layout' ] = 'grid';
$post_class[] = 'list-mobile-layout-' . $args[ 'list_mobile_layout' ];

/**
 * separator
 */
$sep_css = [];
if ( $args[ 'list_sep_color' ] ) {
    $sep_css[] = 'border-color:' . $args[ 'list_sep_color' ];
}
if ( 'solid' != $args[ 'list_sep_style' ] ) {
    $sep_css[] = 'border-style:' . $args[ 'list_sep_style' ];
}
$sep_css = join( ';', $sep_css );
if ( $sep_css ) {
    $sep_css = ' style="' . esc_attr( $sep_css ). '"';
}

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <?php if ( $args[ 'list_sep'] ) { ?>
    <div class="post-list-sep"<?php echo $sep_css; ?>></div>
    <?php } ?>
    
    <?php if ( isset( $args[ 'list_index' ] ) && $args[ 'list_index' ] ) { ?>
    <span class="post-list-count color-accent font-heading"><?php printf("%02d", $args[ 'count' ] ); ?></span>
    <?php } ?>

    <div class="post-item-inner list-inner post-list-inner">

        <?php if ( $args[ 'thumbnail_show' ] ) {

            fox_thumbnail( $args );

        } ?>

        <div class="<?php echo esc_attr( join( ' ', $post_body_class ) ); ?>">

            <div class="post-body-inner">

                <?php fox_post_body( $args ); ?>

            </div><!-- .post-body-inner -->

        </div><!-- .post-item-body -->

    </div><!-- .post-item-inner -->

</article><!-- .post-item -->