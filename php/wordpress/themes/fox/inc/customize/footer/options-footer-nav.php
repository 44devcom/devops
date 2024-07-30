<?php
$fox56_customize->add_section( 'footernav',[
    'title' => 'Footer Menu',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'col' => '1-3',
            'type' => 'number',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'col' => '1-3',
            'type' => 'number',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'col' => '1-3',
            'type' => 'number',
        ],
    ],
    'std' => [
        'desktop' => 10,
        'tablet' => 8,
        'mobile' => 6,
    ],
    'css' => [
        [
            'selector' => '.footer56__nav li + li',
            'property' => 'margin-left',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.footer56__nav li + li',
            'property' => 'margin-left',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.footer56__nav li + li',
            'property' => 'margin-left',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'id' => 'footernav_item_spacing',
    'title' => 'Footer menu item spacing',
    'section' => 'footernav',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'footernav_typography',
    'name' => 'Footer Menu Typography',
    'hint' => 'footer menu font',
    'std' => [
        'transform' => 'uppercase',
        'spacing' => '1px',
        'size' => 11,
    ],
    'selector' => '.footer56__nav a',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footernav_color',
    'title' => 'Footer menu color',
    'css' => [
        [
            'selector' => '.footer56__nav a',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footernav_hover_color',
    'title' => 'Footer menu hover color',
    'css' => [
        [
            'selector' => '.footer56__nav a:hover',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footernav_active_color',
    'title' => 'Footer menu active color',
    'css' => [
        [
            'selector' => '.footer56__nav li.current-menu-item > a',
            'property' => 'color',
        ]
    ]
]);