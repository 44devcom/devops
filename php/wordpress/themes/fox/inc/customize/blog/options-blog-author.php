<?php
$fox56_customize->add_section( 'blog_author', [
    'title' => 'Author Archive',
    'panel' => 'blog',
]);

/* ----------------------------------       layout */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'author_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Author display',
    'section' => 'blog_author',
    'refresh' => 'blog',

    'std_affects' => [
        'author_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],

    'hint' => 'Author Page Layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'author_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'Archive page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'author_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Author custom sidebar',
    'refresh' => 'blog',

    'hint' => 'Archive page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'author_column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Author posts column',
    'refresh' => 'blog',

    'hint' => 'Archive page column',
]);

/* ----------------------------------       toparea */
$fox56_customize->add_field([
    'heading' => 'Top area',
    'type' => 'select',
    'id' => 'author_toparea_display',
    'options' => [
        'none' => 'None',
        'view' => 'Most viewed',
        'comment_count' => 'Most commented',
        'featured' => 'Featured posts',
        'latest' => 'Latest posts',
    ],
    'std' => 'none',
    'name' => 'Top area',
    'refresh' => 'toparea',

    'hint' => 'Archive page top area',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'author_toparea_number',
    'std' => 4,
    'name' => 'Number of posts to show',
    'refresh' => 'toparea',

    'hint' => 'Archive page top area number',
]);