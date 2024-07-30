<?php
$fox56_customize->add_section( 'blog_meta', [
    'title' => 'Post meta',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'date_format',
    'type' => 'text',
    'title' => 'Date format',
    'desc' => 'Learn about date format <a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank">here</a>. By default, It will display date based on your general date format setting.',
    'refresh' => 'blog',
    'section' => 'blog_meta',

    'hint' => 'post date format',
]);

$fox56_customize->add_field([
    'id' => 'date_type',
    'type' => 'radio',
    'title' => 'Date type (Published/Updated)',
    'refresh' => 'blog',
    'options' => [
        'publish' => 'Published',
        'updated' => 'Updated',
    ],
    'std' => 'publish',

    'hint' => 'post date publish/update',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'time_style',
    'name' => 'Time Style',
    'options'   => array(
        'standard' => 'March 22, 2019',
        'human' => '5 days ago',
    ),
    'std'       => 'standard',
    'desc' => 'If you enable human time, It will override date format at all places',
    'hint' =>  'Time style: standard or ago',
]);

$fox56_customize->add_field([
    'id' => 'author_avatar',
    'type' => 'checkbox',
    'title' => 'Author avatar?',
    'refresh' => 'blog',

    'hint' => 'author avatar',
]);

$fox56_customize->add_field([
    'id' => 'author_avatar_size',
    'type' => 'group',
    'hint' => 'author avatar size',
    'title' => 'Author avatar size',
    'css' => [
        [
            'selector' => ".meta56__author a img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".meta56__author a img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".meta56__author a img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'max' => 100,
            'min' => 20,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'max' => 100,
            'min' => 20,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'max' => 100,
            'min' => 10,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 32,
        'tablet' => 28,
        'mobile' => 24,
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'post_meta_typography',
    'name' => 'Post meta typography',
    'hint' => 'post meta font',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '',
        'size' => 13,
        'size_mobile' => 11,
    ],
    'selector' => '.meta56',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_meta_color',
    'hint' => 'post meta color',
    'name' => 'Post meta color',
    'css' => [
        [
            'selector' => '.meta56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_meta_link_color',
    'hint' => 'post meta link color',
    'name' => 'Post meta link color',
    'css' => [
        [
            'selector' => '.meta56 a',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_meta_link_hover_color',
    'hint' => 'post meta link hover color',
    'name' => 'Post meta link hover color',
    'css' => [
        [
            'selector' => '.meta56 a:hover',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'standalone_category_typography',
    'hint' => 'fancy category font',
    'heading' => 'Fancy Category',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '600',
        'spacing' => '0',
        'transform' => 'uppercase',
        'line_height' => '',
        'size' => 14,
        'size_mobile' => 12,
    ],
    'selector' => '.meta56__category--fancy',
]);

$fox56_customize->add_field([
    'id' => 'standalone_category_style',
    'hint' => 'fancy category style',
    'type' => 'radio',
    'options'   => [
        'plain' => 'Plain',
        'box' => 'Box',
        'solid' => 'Solid',
    ],
    'std' => 'plain',
    'name' => 'Style',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'standalone_category_color',
    'hint' => 'fancy category color',
    'css' => [
        [
            'selector' => '.meta56 .meta56__category--fancy a, .meta56 .meta56__category--fancy a:hover',
            'property' => 'color',
        ],
    ],
    'name' => 'Color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'standalone_category_background',
    'hint' => 'fancy category background',
    'css' => [
        [
            'selector' => '.meta56 .meta56__category--fancy.meta56__category--fancy--solid a',
            'property' => 'background',
        ],
    ],
    'condition' => [ 'standalone_category_style' => 'solid' ],
    'name' => 'Background',
]);