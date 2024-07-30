<?php
$fox56_customize->add_section( 'footer_scrollup',[
    'title' => '"Back to top" button',
    'panel' => 'footer',
]);

$fox56_customize->add_partial( 'scrollup', [
    'selector' => '.scrollup__placeholder',
    'render_callback' => 'fox56_scrollup_render',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'scrollup',
    'title' => 'Enable footer scroll up',
    'std' => true,
    'section' => 'footer_scrollup',
    'refresh' => 'scrollup',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'scrollup_type',
    'title' => 'Scrollup button type',
    'options' => [
        'text' => 'Text',
        'icon' => 'Icon',
        'image' => 'Custom image',
    ],
    'std' => 'text',
    'refresh' => 'scrollup',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'scrollup_icon',
    'title' => 'Scroll button icon',
    'options' => [
        'chevron-thin-up' => 'Chevron up',
        'chevrons-up' => 'Double Chevron up',
        'caret-up' => 'Caret up',
        'arrow_upward' => 'Arrow up'
    ],
    'std' => 'chevron-thin-up',
    'condition' => [
        'scrollup_type' => 'icon',
    ],
    'refresh' => 'scrollup',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'scrollup_image',
    'title' => 'Scroll button image',
    'condition' => [
        'scrollup_type' => 'image',
    ],
    'refresh' => 'scrollup',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'scrollup_image_width',
    'title' => 'Scroll button image width',
    'css' => [
        [
            'selector' => '.scrollup56--image img',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
    'std '=> 32,
    'condition' => [
        'scrollup_type' => 'image',
    ]
]);

/* -----------------------  style */
$fox56_customize->add_field([
    'type' => 'radio',
    'options' => [
        'square' => 'Square',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std' => 'square',
    'id' => 'scrollup_shape',
    'name' => 'Scroll up button shape',
    'condition' => [
        'scrollup_type' => [ 'icon', 'text' ],
    ],
    'refresh' => 'scrollup',
]);

$fox56_customize->add_field([
    'type' => 'tabs',
    'id' => 'scrollup_tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
    'condition' => [
        'scrollup_type' => [ 'icon', 'text' ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_color',
    'title' => 'Color',
    'hint' => 'scrollup color',
    'css' => [
        [
            'selector' => '.scrollup56--noimage',
            'property' => 'color',
        ]
        ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],
    
    'tabs' => 'scrollup_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_background',
    'title' => 'Background',
    'hint' => 'scrollup background',
    'css' => [
        [
            'selector' => '.scrollup56--noimage',
            'property' => 'background',
        ]
    ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],

    'tabs' => 'scrollup_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'scrollup_border_width',
    'title' => 'Border width',
    'hint' => 'scrollup border width',
    'std' => 1,
    'css' => [
        [
            'selector' => '.scrollup56--noimage',
            'property' => 'border-width',
            'unit' => 'px',
        ]
    ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],

    'tabs' => 'scrollup_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_border_color',
    'title' => 'Border color',
    'hint' => 'scrollup border color',
    'css' => [
        [
            'selector' => '.scrollup56--noimage',
            'property' => 'border-color',
        ]
    ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],

    'tabs' => 'scrollup_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_hover_color',
    'title' => 'Hover Color',
    'hint' => 'scrollup hover color',
    'css' => [
        [
            'selector' => '.scrollup56--noimage:hover',
            'property' => 'color',
        ]
        ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],
    
    'tabs' => 'scrollup_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_hover_background',
    'title' => 'Hover Background',
    'hint' => 'scrollup hover background',
    'css' => [
        [
            'selector' => '.scrollup56--noimage:hover',
            'property' => 'background',
        ]
    ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],

    'tabs' => 'scrollup_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'scrollup_hover_border_color',
    'title' => 'Hover border color',
    'hint' => 'scrollup hover border color',
    'css' => [
        [
            'selector' => '.scrollup56--noimage:hover',
            'property' => 'border-color',
        ]
    ],
    'condition' => [
        'scrollup_type' => [ 'text', 'icon' ],
    ],

    'tabs' => 'scrollup_tabs',
    'tab' => 'hover',
]);