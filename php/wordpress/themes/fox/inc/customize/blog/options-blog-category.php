<?php
$fox56_customize->add_section( 'blog_category', [
    'title' => 'Category Archive',
    'panel' => 'blog',
]);

/* ----------------------------------       layout */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'category_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Category display',
    'section' => 'blog_category',
    'refresh' => 'blog',

    'std_affects' => [
        'category_column' => [
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

    'hint' => 'Category page layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'category_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'Category page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'category_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Category custom sidebar',
    'refresh' => 'blog',

    'hint' => 'Category page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'category_column',
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
    'name' => 'Category posts column',
    'refresh' => 'blog',

    'hint' => 'Category page column',
]);

/* ----------------------------------       toparea */
$fox56_customize->add_field([
    'heading' => 'Top area',
    'type' => 'select',
    'id' => 'category_toparea_display',
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
    'msg' => 'Note: You can specify post IDs to display in the top area of each category when edit that category.',

    'hint' => 'Category page toparea',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'category_toparea_number',
    'std' => 4,
    'name' => 'Number of posts to show',
    'refresh' => 'toparea',

    'hint' => 'Category page toparea number',
]);