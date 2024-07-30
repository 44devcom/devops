<?php
$fox56_customize->add_section( 'single_header',[
    'title' => 'Single header area',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_header', [
    'selector' => '.single56__header',
    'render_callback' => 'fox56_single_header_inner',
]);

// breadcrumb - deprecated56
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_header_elements',
    'title' => 'Single header elements',
    'section' => 'single_header',
    'std'     => [
        'standalone_category',
        'title',
        'subtitle',
        'date',
        'author',
    ],
    'options' => [
        'standalone_category' => 'Fancy Category',
        'title' => 'Post title',
        'subtitle' => 'Post subtitle',
        'date' => 'Date',
        'author' => 'Author',
        'view' => 'View count',
        'comment' => 'Comment link',
        'category' => 'Category',
        'reading_time' => 'Reading time',
        'share' => 'Share',
    ],
    'refresh' => 'single_header',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'name' => 'Single header align',
    'id' => 'single_header_align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'name' => 'Single header border',
    'id' => 'single_header_border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'col' => '2-5',
            'type' => 'number',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'col' => '2-5',
            'type' => 'number',
        ],
        'color' => [
            'name' => 'Color',
            'col' => '1-5',
            'type' => 'color',
        ],
    ],
    'css' => [
        [
            'selector' => '.single56__header',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.single56__header',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.single56__header',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_title_typography',
    'hint' => 'single title font',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '',
        'spacing' => '',
        'transform' => '',
        'line_height' => '',
        'size' => 48,
        'size_mobile' => 28,
        'size_tablet' => 36,
    ],
    'selector' => '.single56__title',
    'name' => 'Single title typography',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_title_color',
    'hint' => 'single title color',
    'css' => [
        [
            'selector' => '.single56__title',
            'property' => 'color',
        ]
    ],
    'name' => 'Single title color',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'subtitle_display',
    'options' => [
        'subtitle' => 'Post Subtitle',
        'excerpt' => 'Post Excerpt',
    ],
    'std' => 'subtitle',
    'name' => 'Subtitle displays:',
    'refresh' => 'single_header',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'subtitle_typography',
    'name' => 'Subtitle typography',
    'hint' => 'single subtitle font',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '',
        'size' => 20,
        'size_tablet' => 17,
        'size_mobile' => 16,
    ],
    'selector' => '.single56__subtitle',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'subtitle_color',
    'hint' => 'single subtitle color',
    'css' => [
        [
            'selector' => '.single56__subtitle',
            'property' => 'color',
        ]
    ],
    'name' => 'Subtitle color',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_header_author_avatar',
    'hint' => 'single author avatar',
    'std' => true,
    'name' => 'Author avatar?',
    'refresh' => 'single_header',
]);