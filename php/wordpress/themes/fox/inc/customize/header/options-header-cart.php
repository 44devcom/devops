<?php
if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}
$fox56_customize->add_section( 'header_cart',[
    'title' => 'Cart',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_cart_font_size',
    'title' => 'Header cart size',
    'section' => 'header_cart',
    'std' => 16,
    'css' => [
        [
            'selector' => '.header_cart56',
            'property' => 'font-size',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_cart_color',
    'title' => 'Header cart color',
    'section' => 'header_cart',
    'css' => [
        [
            'selector' => '.header_cart56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_cart_hover_color',
    'title' => 'Header cart hover color',
    'css' => [
        [
            'selector' => '.header_cart56:hover',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'header_cart_icon_image',
    'title' => 'Header cart icon image',
    'refresh' => [
        'selector' => '.header56__cart',
        'render_callback' => 'fox56_header_cart_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_cart_icon_image_width',
    'title' => 'Cart icon width',
    'css' => [
        [
            'selector' => '.header_cart56, .header_cart56 img',
            'property' => 'width',
            'unit' => 'px',
        ]
    ],
    'std' => 24,
]);