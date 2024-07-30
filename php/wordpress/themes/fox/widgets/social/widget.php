<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'color' => '',
    'background_color' => '',
    'border_color' => '',
    'hover_color' => '',
    'hover_background_color' => '',
    'hover_border_color' => '',
    'border_radius' => null,
    'border_width' => null,
    'size' => null,
    'font_size' => '',
    'spacing' => null,
    'align' => '',
) ) );

echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}
/**
 * CSS
 */
$css = [
    'a' => [],
    'a:hover' => [],
    'li + li' => [],
];
$cl = [ 'social56--widget', 'fox56-social-list' ];

/* ----------------------- align */
if ( 'left' != $align && 'right' != $align ) {
    $align = 'center';
}
$cl[] = 'align-' . $align;

/* ----------------------- spacing */
if ( ! empty($spacing)) {
    if ( is_numeric($spacing)) {
        $spacing .= 'px';
    }
    $css['li + li'][] = "margin-left:{$spacing}";
}

/* ----------------------- size */
if ( ! empty($size)) {
    if ( is_numeric($size)) {
        $size .= 'px';
    }
    $css['a'][] = "width:{$size};height:{$size}";
}

/* ----------------------- font size */
if ( ! empty($font_size)) {
    if ( is_numeric($font_size)) {
        $font_size .= 'px';
    }
    $css['a'][] = "font-size:{$font_size}";
}

/* ----------------------- border radius */
if ( ! empty($border_radius)) {
    if ( is_numeric($border_radius)) {
        $border_radius .= 'px';
    }
    $css['a'][] = "border-radius:{$border_radius}";
}

/* ----------------------- border width */
if ( ! empty($border_width)) {
    if ( is_numeric($border_width)) {
        $border_width .= 'px';
    }
    $css['a'][] = "border-width:{$border_width}";
}

/* ----------------------- color */
if ( ! empty($color)) {
    $css['a'][] = "color:{$color}";
}
if ( ! empty($background_color)) {
    $css['a'][] = "background-color:{$background_color}";
}
if ( ! empty($border_color)) {
    $css['a'][] = "border-color:{$border_color}";
}

/* ----------------------- hover color */
if ( ! empty($hover_color)) {
    $css['a:hover'][] = "color:{$hover_color}";
}
if ( ! empty($hover_background_color)) {
    $css['a:hover'][] = "background-color:{$hover_background_color}";
}
if ( ! empty($hover_border_color)) {
    $css['a:hover'][] = "border-color:{$hover_border_color}";
}

$style = [];
foreach ( $css as $selector => $css_arr ) {
    if ( empty( $css_arr) ) {
        continue;
    }
    $final_selector = "#{$widget_id} .fox56-social-list {$selector}";
    $val = join( ';', $css_arr );
    $style[] = "{$final_selector}{ {$val} }";
}
?>
<style><?php echo join( "\n", $style ); ?></style>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <?php echo fox56_social_list(); ?>
</div>

<?php echo $after_widget; ?>