<?php
$fox56_customize->add_section( 'design_general', [
    'title' => 'General',
    'panel' => 'design',
]);

/* ---------------------------------------------        body font */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'body_typography',
    'title' => 'Body text',
    'std' => [
        'size' => 16,
        'size_mobile' => 14,
        'weight' => 400,
        'line_height' => '1.5',
    ],
    'exclude' => [ 'face' ],
    'selector' => 'body',
    'section' => 'design_general',

    'heading' => 'Body',

    'hint' => 'body typography',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'text_color',
    'name' => 'Body text color',
    'css' => [
        [
            'selector' => 'body',
            'property' => 'color',
        ]
    ],
    'std' => '#000000',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'link_color',
    'name' => 'Link color',
    'css' => [
        [
            'selector' => 'a',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'link_hover_color',
    'name' => 'Link hover color',
    'css' => [
        [
            'selector' => 'a:hover',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'border_color',
    'name' => 'General border color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--border-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'accent_color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--accent-color',
        ]
        ],
    'name' => 'Accent color',
    'hint' => 'accent/primary color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'selection_background',
    'name' => 'Selection background',
    'css' => [
        [
            'selector' => '::-moz-selection',
            'property' => 'background-color',
        ],
        [
            'selector' => '::selection',
            'property' => 'background-color',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'selection_text_color',
    'name' => 'Selection text color',
    'css' => [
        [
            'selector' => '::-moz-selection',
            'property' => 'color',
        ],
        [
            'selector' => '::selection',
            'property' => 'color',
        ],
    ]
]);

/* ---------------------------------------------        heading typography */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'heading_typography',
    'title' => 'Heading text',
    'std' => [
        'weight' => 700,
        'line_height' => '1.2',
    ],
    'exclude' => [ 'face', 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h1, h2, h3, h4, h5, h6',

    'heading' => 'Heading',

    'hint' => 'heading typography',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h2',
    'id' => 'h2_typography',
    'title' => 'H2 font size',
    'std' => [
        'size' => 33,
        'size_mobile' => 24,
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h3',
    'id' => 'h3_typography',
    'title' => 'H3 font size',
    'std' => [
        'size' => 26,
        'size_mobile' => 20,
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h4',
    'id' => 'h4_typography',
    'title' => 'H4 font size',
    'std' => [
        'size' => 20,
        'size_mobile' => 16,
    ],
]);