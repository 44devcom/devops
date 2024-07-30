<?php
$fox56_customize->add_section( 'blog_title', [
    'title' => 'Post title',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'title_tag',
    'type' => 'radio',
    'options' => [
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
    ],
    'std' => 'h2',
    'title' => 'Title heading',
    'refresh' => 'blog',
    'section' => 'blog_title',

    'hint' => 'post title tag',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'post_title_typography',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '',
        'spacing' => '',
        'transform' => '',
        'line_height' => '',
        'size' => 26,
        'size_mobile' => 20,
    ],
    'selector' => '.title56',

    'name' => 'Post title typography',
    'hint' => 'post title font',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_title_color',
    'name' => 'Title color',
    'css' => [
        [
            'selector' => '.title56 a',
            'property' => 'color',
        ]
    ],
    'hint' => 'post title color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_title_hover_color',
    'name' => 'Title hover color',
    'hint' => 'post title hover color',
    'css' => [
        [
            'selector' => '.title56 a:hover',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'post_title_hover_text_decoraction',
    'name' => 'Title hover style',
    'hint' => 'post title hover style',
    'options' => [
        'none' => 'None',
        'underline' => 'Underline',
        'overline' => 'Overline',
        'line-through' => 'Line-through',
    ],
    'std' => 'none',
    'css' => [
        [
            'selector' => '.title56 a:hover',
            'property' => 'text-decoration',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_title_hover_text_decoraction_color',
    'name' => 'Title hover line color',
    'hint' => 'post title hover line color',
    'css' => [
        [
            'selector' => '.title56 a:hover',
            'property' => 'text-decoration-color',
        ]
    ]
]);