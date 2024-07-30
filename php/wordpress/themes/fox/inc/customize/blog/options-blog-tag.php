<?php
$fox56_customize->add_section( 'blog_tag', [
    'title' => 'Tag Archive',
    'panel' => 'blog',
]);

/* ----------------------------------       layout */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'tag_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Tag display',
    'section' => 'blog_tag',
    'refresh' => 'blog',

    'hint' => 'tag page layout',
    
    
    'std_affects' => [
        'tag_column' => [
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
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'hint' => 'tag page sidebar state',
    'id' => 'tag_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'hint' => 'tag page sidebar',
    'id' => 'tag_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Tag custom sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'hint' => 'tag page column',
    'id' => 'tag_column',
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
    'name' => 'Tag posts column',
    'refresh' => 'blog',
]);

/* ----------------------------------       toparea */
$fox56_customize->add_field([
    'heading' => 'Top area',
    'type' => 'select',
    'hint' => 'tag page toparea',
    'id' => 'tag_toparea_display',
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
    'msg' => 'Note: You can specify post IDs to display in the top area of each tag when edit that tag.',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'tag_toparea_number',
    'hint' => 'tag page toparea number',
    'std' => 4,
    'name' => 'Number of posts to show',
    'refresh' => 'toparea',
]);