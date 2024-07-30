<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'image' => '',
    'tablet' => '',
    'phone' => '',
    'url' => '',
    'target' => '_blank',
    'code' => '',
) ) );

echo $before_widget;
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( ! empty( $title ) ) {
    echo $before_title . $title . $after_title;
}

$cl = [ 'ad56' ];

$code = trim( strval( $code ) );
if ( ! empty( $code ) ) {
    $cl[] = 'ad56--code'; ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo do_shortcode( $code ); ?>
    </div>
    <?php
} else {

    $cl[] = 'ad56--banner';

    $url = trim( strval( $url ) );
    if ( $url ) {
        $a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '">';
        $a_close = '</a>';
    } else {
        $a = ''; $a_close = '';
    }

    $imgs = [];
    if ( $phone ) {
        $imgs[] = wp_get_attachment_image( $phone, 'full', false, [ 'class' => 'banner56--mobile' ]);
    }
    if ( $tablet ) {
        $imgs[] = wp_get_attachment_image( $tablet, 'full', false, [ 'class' => 'banner56--tablet' ]);
    }
    if ( $image ) {
        $imgs[] = wp_get_attachment_image( $image, 'full', false, [ 'class' => 'banner56--desktop' ]);
    }
    
    ?>

    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo $a; ?>
        <?php echo join( "\n", $imgs ); ?>
        <?php echo $a_close; ?>
    </div>
    <?php
}

echo $after_widget;