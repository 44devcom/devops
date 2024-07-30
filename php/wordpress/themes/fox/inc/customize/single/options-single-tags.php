<?php
$fox56_customize->add_section( 'single_tags', [
    'title' => 'Post Tags',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'tags_label',
    'std' => '',
    'name' => 'Tags label:',
    'section' => 'single_tags',

    'hint' => 'single tags label',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'tags_align',
    'std' => 'left',
    'name' => 'Tags align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],

    'hint' => 'single tags align',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'tags_height',
    'std' => 24,
    'name' => 'Item height',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'line-height',
            'unit' => 'px',
        ],
    ],
    'hint' => 'single tags height',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'tags_typography',
    'name' => 'Item typography',
    'selector' => '.terms56 a',
    'exclude' => [ 'line_height' ],

    'hint' => 'single tags font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'tags_border_radius',
    'std' => 0,
    'name' => 'Items border radius',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'hint' => 'single tags item border radius',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'tags_border_width',
    'std' => 0,
    'name' => 'Items border width',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ],
    'hint' => 'single tags border',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_color',
    'name' => 'Item color',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'color',
        ]
    ],
    'hint' => 'single tags item color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_background',
    'name' => 'Item background',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'background',
        ]
    ],
    'hint' => 'single tags item background',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_border_color',
    'name' => 'Item border color',
    'css' => [
        [
            'selector' => '.terms56 a',
            'property' => 'border-color',
        ]
    ],
    'hint' => 'single tags item border color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_hover_color',
    'name' => 'Item hover color',
    'css' => [
        [
            'selector' => '.terms56 a:hover',
            'property' => 'color',
        ]
    ],
    'hint' => 'single tags item hover color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_hover_background',
    'name' => 'Item hover background',
    'css' => [
        [
            'selector' => '.terms56 a:hover',
            'property' => 'background',
        ]
    ],
    'hint' => 'single tags item hover background',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'tags_hover_border_color',
    'name' => 'Item hover border color',
    'css' => [
        [
            'selector' => '.terms56 a:hover',
            'property' => 'border-color',
        ]
    ],
    'hint' => 'single tags item hover border color',
]);