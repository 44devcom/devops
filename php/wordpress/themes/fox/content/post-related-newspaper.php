<?php
$post_class = [
    'post-item',
    'post-related',
];

$params = fox_customize_params( 'list' );
$params[ 'components' ] = 'title';
$params[ 'thumbnail_components' ] = '';
$params = fox_justify_params( $params );

$thumbnail_params = wp_parse_args( [
    'thumbnail' => 'thumbnail-medium',
    'thumbnail_placeholder' => false,
    'thumbnail_extra_class' => 'related-thumbnail',

    // @todo: circle, round
    'thumbnail_shape' => 'acute',
    
    'thumbnail_hover' => 'none',
    'thumbnail_width' => '',
], $params );

$title_params = wp_parse_args( [
    'title_tag' => 'h3',
    'title_extra_class' => 'related-title',
    'title_size' => 'tiny',
], $params );

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <div class="related-inner">
    
        <?php fox_thumbnail( $thumbnail_params ); ?>

        <div class="related-body post-item-body">
            
            <?php fox_post_title( $title_params ); ?>

        </div><!-- .related-body -->
    
    </div><!-- .related-inner -->

</article><!-- .post-related -->
