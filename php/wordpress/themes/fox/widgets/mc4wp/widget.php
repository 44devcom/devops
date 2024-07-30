<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'form_id' => '',
    'layout' => 'stack',
    'heading' => '',
    'mail_icon' => true,
    'subtitle' => '',
    'text_color' => '',
    'background_color' => '',
    'background_image' => '',
    'border_color' => '',
    'button_style' => '',
) ) );

echo $before_widget;

/**
 * if no form_id, get anything
 */
if ( ! $form_id ) {
    $args = array(
        'post_type' => 'mc4wp-form',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
    );
    $get_forms = get_posts( $args );
    if ( $get_forms ) {
        $form_id = $get_forms[0]->ID;
    }
}

/**
 * title
 */
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$class = [ 'foxmc' ];
$inner_css = [];
$css = [];

/**
 * layout
 */
if ( 'stack' != $layout ) {
    $layout = 'inline';
}
$class[] = 'foxmc-' . $layout;

/**
 * button style
 */
if ( ! in_array( $button_style, [ 'outline', 'fill', 'primary' ] ) ) {
    $button_style = 'black';
}
$class[] = 'foxmc-button-' . $button_style;

/**
 * color
 */
if ( $text_color ) {
    $class[] = 'custom-color';
    $css[] = 'color:' . $text_color;
}

/**
 * background color
 */
if ( $background_color ) {
    $css[] = 'background-color:' . $background_color;
}

/**
 * background image
 */
$bg_img = '';
if ( $background_image ) {
    if ( is_numeric( $background_image ) ) {
        $img_html = wp_get_attachment_image( $background_image, 'full' );
    } else {
        $img_html = '<img src="' . esc_url( $background_image ) . '" alt="Mailchimp form background" />';
    }
    $bg_img = '<div class="foxmc-bg-image">' . $img_html . '</div>';
    $class[] = 'foxmc-has-bg-image';
}

// so that we set the zero padding
if ( ! $background_color && ! $background_image ) {
    $class[] = 'foxmc-no-bg';
}

/**
 * border
 */
if ( $border_color ) {
    $class[] = 'foxmc-has-border';
    $inner_css[] = 'border-color:' . $border_color;
} else {
    $class[] = 'foxmc-no-border';
}

/**
 * final css
 */
$inner_css = join( ';', $inner_css );
if ( $inner_css ) {
    $inner_css = ' style="' . esc_attr( $inner_css ). '"';
}
$css = join( ';', $css );
if ( $css ) {
    $css = ' style="' . esc_attr( $css ). '"';
}
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $css; ?>>
    
    <div class="foxmc-inner"<?php echo $inner_css; ?>>
        
        <?php if ( $heading || $subtitle ) { ?>
        
        <div class="foxmc-heading">
        
            <?php if ( $heading ) {
                if ( fox56() ) {
                    $mail_icon_html = $mail_icon ? '<i class="ic56-envelope"></i>' : '';
                } else {
                    $mail_icon_html = $mail_icon ? '<i class="fa fa-envelope"></i>' : '';
                }
            ?>
            <h2 class="foxmc-title"><?php echo $mail_icon_html . $heading; ?></h2>
            <?php } ?>
            
            <?php if ( $subtitle ) { ?>
            <p class="foxmc-subtitle"><?php echo do_shortcode( $subtitle ); ?></p>
            <?php } ?>
        
        </div><!-- .foxmc-heading -->
        
        <?php } ?>
        
        <div class="foxmc-form">

            <?php if ( function_exists( 'mc4wp_show_form' ) ) { mc4wp_show_form( $form_id ); } ?>
            
        </div><!-- .foxmc-form -->
        
    </div><!-- .foxmc-inner -->
    
    <?php echo $bg_img; ?>
    
</div><!-- .foxmc -->

<?php echo $after_widget; ?>