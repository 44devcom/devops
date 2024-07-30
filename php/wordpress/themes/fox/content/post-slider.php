<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

/**
 * Customized Params
 */
$customized_params = $args;

$customized_params[ 'meta_extra_class' ] = 'slider-meta';
$customized_params[ 'title_extra_class' ] = 'slider-title';
$customized_params[ 'excerpt_extra_class' ] = 'slider-excerpt-text';
$customized_params[ 'excerpt_exclude_class' ] = 'entry-excerpt';
$customized_params[ 'excerpt_more_style' ] = 'simple';

$customized_params[ 'thumbnail_extra_class' ] .= ' slider-thumbnail';
$customized_params[ 'thumbnail' ] = 'custom';
$customized_params[ 'thumbnail_shape' ] = 'acute';
$customized_params[ 'thumbnail_hover' ] = 'none';
$customized_params[ 'thumbnail_showing_effect' ] = 'none';
$customized_params[ 'thumbnail_custom' ] = $args[ 'slider_size' ];
$customized_params[ 'thumbnail_format_indicator' ] = false;
$customized_params[ 'thumbnail_index' ] = false;
$customized_params[ 'thumbnail_review_score' ] = false;
$customized_params[ 'thumbnail_view' ] = false;

?>

<li class="slide">
                
    <?php
    $post_class = [ 'post-item', 'post-slider' ];

    /**
     * align
     */
    $post_class[] = 'post-slide-align-' . $args[ 'align'];

    if ( $args[ 'slider_title_background' ] ) {
        $post_class[] = 'style--title-has-background';
    }



    ?>
    <article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

        <?php fox_thumbnail( $customized_params ); ?>

        <div class="slider-body">

            <div class="slider-table">

                <div class="slider-cell">

                    <div class="post-content">

                        <?php if ( $args[ 'title_show' ] ) { ?>

                        <div class="slider-header">

                            <?php fox_post_title( $customized_params ); ?>

                        </div><!-- .slider-header -->

                        <?php } ?>

                        <?php if ( $args[ 'excerpt_show' ] ) { ?>

                        <div class="slider-excerpt">

                            <?php fox_post_meta( $customized_params ); ?>

                            <?php fox_post_excerpt( $customized_params ); ?>

                        </div><!-- .slider-excerpt -->

                        <?php } ?>

                    </div><!-- .post-content -->

                </div><!-- .slider-cell -->

            </div><!-- .slider-table -->

        </div><!-- .slider-body -->

    </article><!-- .post-slider -->

    <?php do_action( 'fox_after_render_post' ); // since 4.0 ?>

</li><!-- .slide -->