<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'align' => '',
    'layout' => 'imagetop',
    
    'image' => '',
    'image_size' => '',
    'image_width' => '',
    'image_shape' => '',
    
    'heading' => '',
    'description' => '',
    
    'url' => '',
    'target' => '',
    
    
) ) );

echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$class = [ 'fox-imagetext' ];

/**
 * image layout
 */
if ( 'imageleft' != $layout ) {
    $layout = 'imagetop';
}
$class[] = 'imagetext-' . $layout;

/**
 * align
 */
if ( ! in_array( $align, [ 'left', 'right' ] ) ) {
    $align = 'center';
}
if ( 'imagetop' == $layout ) {
    $class[] = 'align-' . $align;
}

// target
if ( '_blank' != $target ) $target = '_self';
$open = $close = '';
if ( $url ) {
    $open = '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ). '">';
    $close = '</a>';
}

/**
 * image
 */
if ( ! in_array( $image_shape, [ 'round', 'circle' ]) ) {
    $image_shape = 'acute';
}
$img_html = '';
if ( $image ) {
    $css_width = '';
    $image_width = trim( $image_width );
    if ( $image_width ) {
        if ( is_numeric( $image_width ) ) {
            $image_width .= 'px';
        }
        $css_width = ' style="width:' . $image_width . '"';
        $attrs[ 'width' ] = $image_width;
    }
    $img_html = wp_get_attachment_image( $image, $image_size );
    if ( $img_html ) {
        $img_html = '<span class="image-element"' . $css_width . '>' . $img_html . '</span>';
    }
}
if ( $img_html ) {
    $img_html = $open . $img_html . $close;
    $img_html = '<figure class="imagetext-image image-shape-' . esc_attr( $image_shape ). '">' . $img_html .  '</figure>';
}
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <?php echo $img_html; ?>
    
    <div class="imagetext-text">
        
        <?php if ( $heading ) { ?>
            
        <h3 class="imagetext-heading"><?php echo $open . $heading . $close ; ?></h3>
            
        <?php } ?>
        
        <?php if ( $description ) { ?>
        
        <div class="imagetext-description">
        
            <?php echo do_shortcode( $description ); ?>
        
        </div>
        
        <?php } ?>
        
    </div><!-- .imagetext-text -->
    
</div><!-- .fox-imagetext -->

<?php
echo $after_widget;