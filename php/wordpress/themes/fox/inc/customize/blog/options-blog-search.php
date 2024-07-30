<?php
$fox56_customize->add_section( 'blog_search', [
    'title' => 'Search page',
    'panel' => 'blog',
]);

/* ----------------------------------       layout */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'search_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Search display',
    'section' => 'blog_search',
    'refresh' => 'blog',

    'std_affects' => [
        'search_column' => [
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

    'hint' => 'search page layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'search_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'search page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'search_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Search custom sidebar',

    'hint' => 'search page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'search_column',
    'hint' => 'search page column',
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
    'name' => 'Search posts column',
    'refresh' => 'blog',
]);