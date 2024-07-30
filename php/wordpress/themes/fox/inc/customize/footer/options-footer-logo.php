<?php
$fox56_customize->add_section( 'footer_logo',[
    'title' => 'Footer Logo',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'footer_logo',
    'title' => 'Footer logo',
    'std' => true,
    'section' => 'footer_logo',
    'refresh' => [
        'selector' => '.footer56__logo',
        'render_callback' => 'fox56_footer_logo_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'footer_logo_width',
    'title' => 'Footer logo width',
    'css' => [
        [
            'selector' => '.footer56__logo img',
            'property' => 'width',
            'unit' => 'px',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'footer_logo_custom_link',
    'title' => 'Footer logo custom link',
    'refresh' => [
        'selector' => '.footer56__logo',
        'render_callback' => 'fox56_footer_logo_inner',
    ]
]);