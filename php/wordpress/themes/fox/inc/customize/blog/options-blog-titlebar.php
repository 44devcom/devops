<?php
$fox56_customize->add_section( 'blog_titlebar', [
    'title' => 'Title bar',
    'panel' => 'blog',
]);

$fox56_customize->add_partial( 'titlebar', [
    'selector' => '.archive56__titlebar',
    'render_callback' => 'fox56_titlebar_inner',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'titlebar_label',
    'name' => 'Archive Label: category, tag..',
    'refresh' => 'titlebar',
    'section' => 'blog_titlebar',

    'hint' => 'archive label',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'titlebar_width',
    'hint' => 'titlebar width',
    'std' => '600px',
    'name' => 'Titlebar content width',
    'css' => [
        [
            'selector' => '.titlebar56__main',
            'property' => 'width',
            'unit' => 'px',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'titlebar_subcategories',
    'hint' => 'titlebar subcategories',
    'std' => true,
    'name' => 'Shows subcategories for category archive',
    'refresh' => 'titlebar',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'titlebar_align',
    'hint' => 'titlebar align',
    'std' => 'center',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'name' => 'Title bar align',
    'refresh' => 'titlebar',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'titlebar_background_color',
    'name' => 'Title bar background',
    'hint' => 'titlebar background',
    'css' => [
        [
            'selector' => '.titlebar56',
            'property' => 'background-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'titlebar_padding',
    'name' => 'Title bar padding',
    'hint' => 'titlebar padding',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'col' => '1-3',
        ],
    ],
    'css' => [
        [
            'selector' => '.titlebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.titlebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.titlebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 20,
        'tablet' => 10,
        'mobile' => 10,
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'titlebar_border',
    'name' => 'Title bar border',
    'hint' => 'titlebar border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.titlebar56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.titlebar56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'titlebar_container_border',
    'name' => 'Title bar container border',
    'hint' => 'titlebar container',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.titlebar56 .container',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.titlebar56 .container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
    ],
    'std' => [
        'top' => 0,
        'bottom' => 1,
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'titlebar_border_color',
    'hint' => 'titlebar border color',
    'name' => 'Border color',
    'css' => [
        [
            'selector' => '.titlebar56, .titlebar56 .container',
            'property' => 'border-color',
        ]
    ]
]);

/* ----------------------------------------     title */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'titlebar_title_typography',
    'hint' => 'titlebar title font',
    'std' => [
        'face' => 'var(--font-heading)',
        'variant' => '700',
        'spacing' => '',
        'transform' => '',
        'line_height' => '',
        'size' => 64,
        'size_mobile' => 36,
    ],
    'selector' => '.titlebar56__title',
    'heading' => 'Title bar title',
    'name' => 'Title typography',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'titlebar_title_color',
    'hint' => 'titlebar title color',
    'name' => 'Title bar title color',
    'css' => [
        [
            'selector' => '.titlebar56__title',
            'property' => 'color',
        ]
    ]
]);

/* ----------------------------------------     description */
$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'titlebar_description',
    'hint' => 'titlebar description',
    'std' => true,
    'name' => 'Title bar description',
    'refresh' => 'titlebar',
    'heading' => 'Title bar description',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'titlebar_description_typography',
    'hint' => 'titlebar description font',
    'std' => [
        'face' => 'var(--font-body)',
        'variant' => '400',
        'spacing' => '',
        'transform' => '',
        'line_height' => '',
    ],
    'name' => 'Description typography',
    'selector' => '.titlebar56__description',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'titlebar_description_color',
    'hint' => 'titlebar description color',
    'name' => 'Title bar description color',
    'css' => [
        [
            'selector' => '.titlebar56__description, .titlebar56 .fox56-social-list a, .titlebar56 .fox56-social-list a:hover',
            'property' => 'color',
        ]
    ]
]);

/* ---------------------------------------- author *
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'titlebar_author_social',
    'std' => 'center',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'name' => 'Title bar align',
    'refresh' => 'titlebar',
]);
*/