<?php
$fox56_customize->add_section( 'design_layout', [
    'title' => 'Layout',
    'panel' => 'design',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'container_width',
    'title' => 'Container width',
    'desc' => 'Enter numeric value like 1020, or percent valule like: 92%',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--content-width',
            'unit' => 'px',
        ],
        /*
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'width',
            'value_pattern' => 'calc($ + 60px)',
            'unit' => 'px',
        ],
        */
    ],
    'std' => 1080,
    'section' => 'design_layout',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'sidebar_width',
    'std' => 265,
    'title' => 'Sidebar width',
    'css' => [
        [
            'selector' => '.secondary56',
            'property' => 'width',
            'unit' => 'px',
            'media_query' => '@media only screen and (min-width: 840px)',
        ],
        [
            'selector' => '.hassidebar > .container--main > .primary56',
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'media_query' => '@media only screen and (min-width: 840px)',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'sticky_sidebar',
    'title' => 'Sticky sidebar?',
]);

/* ---------------------------------------------        boxed / wide */
$fox56_customize->add_field([
    'heading' => 'Body Background',
    'type' => 'background',
    'id' => 'body_background',
    'std' => [
        'size' => 'cover',
        'repeat' => 'no-repeat',
        'position' => 'center center',
        'attachment' => 'scroll',
    ],
    'selector' => 'body',

    'hint' => 'body background',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'body_border',
    'title' => 'Body border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-5',
        ],
        'right' => [
            'name' => 'Right',
            'type' => 'number',
            'col' => '1-5',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-5',
        ],
        'left' => [
            'name' => 'Left',
            'type' => 'number',
            'col' => '1-5',
        ],
        'color' => [
            'name' => 'Color',
            'type' => 'color',
            'col' => '1-5',
        ]
    ],
    'std' => [
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'left' => 0,
        'color' => '',
    ],
    'css' => [
        [
            'selector' => 'body',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => 'body',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => 'body',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => 'body',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => 'body',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
]);

/* ---------------------------------------------        boxed */
$fox56_customize->add_field([
    'heading' => 'Boxed layout',
    'name' => 'Layout boxed?',
    'type' => 'checkbox',
    'id' => 'layout_boxed',
    'transport' => 'postMessage',

    'hint' => 'boxed layout',
]);

$fox56_customize->add_field([
    'name' => 'Inner top/bottom margin',
    'type' => 'number',
    'id' => 'inner_margin',
    'css' => [
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'margin-top',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'margin-bottom',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
    ],
    'std' => 0,
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'name' => 'Inner top/bottom padding',
    'type' => 'number',
    'id' => 'inner_padding',
    'css' => [
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'padding-top',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
    ],
    'std' => 0,
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'name' => 'Inner background',
    'type' => 'background',
    'id' => 'inner_background',
    'std' => [
        'size' => 'cover',
        'repeat' => 'no-repeat',
        'position' => 'center center',
        'attachment' => 'scroll',
    ],
    'selector' => 'body.layout-boxed #wi-all',
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'inner_border',
    'title' => 'Inner border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-5',
        ],
        'right' => [
            'name' => 'Right',
            'type' => 'number',
            'col' => '1-5',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-5',
        ],
        'left' => [
            'name' => 'Left',
            'type' => 'number',
            'col' => '1-5',
        ],
        'color' => [
            'name' => 'Color',
            'type' => 'color',
            'col' => '1-5',
        ]
    ],
    'std' => [
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'left' => 0,
        'color' => '',
    ],
    'css' => [
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
    'condition' => [ 'layout_boxed' => true ]
]);

$fox56_customize->add_field([
    'name' => 'Use hand-drawn border?',
    'type' => 'checkbox',
    'id' => 'hand_drawn',
    'condition' => [ 'layout_boxed' => true ],

    'hint' => 'hand drawn line border',
]);