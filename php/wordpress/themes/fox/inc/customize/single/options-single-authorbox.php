<?php
$fox56_customize->add_section( 'single_authorbox', [
    'title' => 'Author box',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_authorbox',[
    'selector' => ".authorboxes56",
    'render_callback' => 'fox56_authorbox_inner',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'authorbox_style',
    'section' => 'single_authorbox',
    'name' => 'Style',
    'options' => [
        'simple' => 'Simple',
        'box' => 'Box + tab',
    ],
    'std' => 'simple',
    'refresh' => 'single_authorbox',

    'hint' => 'author box style',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'authorbox_width',
    'options'   => [
        'full' => 'Full',
        'narrow' => 'Narrow',
    ],
    'std'       => 'narrow',
    'name'      => 'Author box width',
    'refresh' => 'single_authorbox',
]);


$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'authorbox_avatar_width',
    'name' => 'Avatar width',
    'hint' => 'author box avatar width',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '2-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 90,
        'mobile' => 54,
    ],
    'css' => [
        [
            'selector' => '.authorbox56__avatar',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.authorbox56__text',
            'property' => 'width',
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'desktop',
        ],

        [
            'selector' => '.authorbox56__avatar',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => '.authorbox56__text',
            'property' => 'width',
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'authorbox_avatar_shape',
    'type'      => 'select',
    'options'   => [
        'acute' => 'Square',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std'       => 'circle',
    'name'      => 'Author avatar shape',
    'refresh'   => 'single_authorbox',
]);