<?php
$fox56_customize->add_section( 'blog_archive', [
    'title' => 'General Archive',
    'panel' => 'blog',
]);

/* ----------------------------------       archive */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'archive_layout',
    'std' => 'list',
    'options' => $layouts,
    'name' => 'General Archive layout',
    'desc' => 'This applies to general archive types: date, post type.. Each archive type like Category, Tag, Author.. has its own layout option.',
    'section' => 'blog_archive',

    'std_affects' => [
        'archive_column' => [
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

    'hint' => 'Archive Layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'archive_sidebar_state',
    'std' => 'sidebar-right',
    'options' => $sidebar_states,
    'name' => 'Archive sidebar',

    'hint' => 'Archive sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'archive_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Archive custom sidebar',

    'hint' => 'Archive sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'archive_column',
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
    'name' => 'Archive column',

    'hint' => 'Archive column',
]);