<?php
$fox56_customize->add_section( 'header_hamburger', [
    'title' => 'Hamburger button',
    'panel' => 'header',
]);

$fox56_customize->add_partial( 'header_hamburger', [
    'selector' => '.header56__hamburger',
    'render_callback' => 'fox56_header_hamburger_inner',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'hamburger_icon_type',
    'title' => 'Hamburger icon type',
    
    'std' => 'default',
    'options' => [
        'default' => 'Default',
        'image' => 'Upload custom image',
    ],
    'refresh' => 'header_hamburger',
    'section' => 'header_hamburger',

    'hint' => 'mobile hamburger menu icon',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'hamburger_size',
    'title' => 'Hamburger icon size',
    'hint' => 'mobile hamburger menu icon size',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'font-size',
            'unit' => 'px',
        ]
    ],
    'std' => 18,
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'hamburger_container_size',
    'title' => 'Hamburger container size',
    'hint' => 'mobile hamburger menu container size',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'height',
            'unit' => 'px',
        ],
    ],
    'std' => 40,
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

/* ----------------------------------------     color */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_color',
    'title' => 'Hamburger icon color',
    'hint' => 'mobile hamburger menu icon color',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'color',
        ]
    ],
    
    'heading' => 'Color',
    'heading_size' => 'small',
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_background',
    'title' => 'Hamburger icon background',
    'hint' => 'mobile hamburger menu icon background',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'background-color',
        ]
    ],
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_hover_color',
    'title' => 'Hamburger icon hover color',
    'hint' => 'mobile hamburger menu icon hover color',
    'css' => [
        [
            'selector' => '.hamburger--type-icon:hover',
            'property' => 'color',
        ]
    ],
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_hover_background',
    'title' => 'Hamburger icon hover background',
    'hint' => 'mobile hamburger menu icon hover background',
    'css' => [
        [
            'selector' => '.hamburger--type-icon:hover',
            'property' => 'background-color',
        ]
    ],
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

/* ----------------------------------------     border */
$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'hamburger_border_width',
    'hint' => 'mobile hamburger menu icon border width',
    'title' => 'Hamburger border',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ],
    'std' => 0,
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_border_color',
    'title' => 'Hamburger border color',
    'hint' => 'mobile hamburger menu icon border color',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'border-color',
        ]
    ],
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'hamburger_hover_border_color',
    'hint' => 'mobile hamburger menu icon hover border color',
    'title' => 'Hover border color',
    'css' => [
        [
            'selector' => '.hamburger--type-icon:hover',
            'property' => 'border-color',
        ]
    ],
    
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'hamburger_border_radius',
    'hint' => 'mobile hamburger menu icon border radius',
    'title' => 'Hamburger border radius',
    'css' => [
        [
            'selector' => '.hamburger--type-icon',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'std' => 0,
    'condition' => [ 'hamburger_icon_type' => 'default' ],
]);

/* ----------------------------------------     image */
$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'hamburger_image',
    'title' => 'Upload hamburger image',
    
    'refresh' => 'header_hamburger',
    'condition' => [ 'hamburger_icon_type' => 'image' ],
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'hamburger_close_image',
    'title' => 'Upload close image',
    'hint' => 'mobile hamburger close image',
    
    'refresh' => 'header_hamburger',
    
    'condition' => [ 'hamburger_icon_type' => 'image' ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'hamburger_image_width',
    'hint' => 'mobile hamburger image width',
    'title' => 'Image Width',
    'css' => [
        [
            'selector' => '.hamburger--type-image',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
    'std' => 40,
    'condition' => [ 'hamburger_icon_type' => 'image' ],
]);