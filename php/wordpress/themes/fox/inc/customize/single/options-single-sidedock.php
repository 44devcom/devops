<?php
$fox56_customize->add_section( 'single_sidedock', [
    'title' => 'Footer Side Dock',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'sidedock', [
    'selector' => '.sidedock56-placement',
    'render_callback' => 'fox56_sidedock_inner',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_side_dock',
    'std'       => true,
    'name'      => 'Enable footer side dock?',
    'section' => 'single_sidedock',

    'hint' => 'single footer side dock',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_side_dock_heading',
    'std'       => 'Don\'t Miss',
    'name'      => 'Heading',
    'refresh' => 'sidedock',

    'hint' => 'dont miss text',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_side_dock_heading_background',
    'std'       => '#000',
    'name'      => 'Heading background',
    'hint' => 'dont miss background',
    'css' => [
        [
            'property' => 'background',
            'selector' => '.sidedock56__heading',
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'single_side_dock_orientation',
    'type' => 'radio',
    'std'       => 'up',
    'options'   => [
        'up' => 'Bottom up',
        'right' => 'Left to right',
    ],
    'name'      => 'Sliding Orientation',
    'refresh' => 'sidedock',
    'hint' => 'side dock slide orientation',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'single_side_dock_number',
    'std'       => 2,
    'name'      => 'Number of posts',
    'refresh' => 'sidedock',
    'hint' => 'side dock number of posts',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_side_dock_source',
    'std'       => 'tag',
    'options' => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Source',
    'refresh' => 'sidedock',

    'hint' => 'single side dock posts source',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_side_dock_orderby',
    'std'       => 'date',
    'name'      => 'Order by',
    'options' => [
        'date' => 'Date',
        'modified' => 'Updated Date',
        
        'view' => 'View count',
        'view_week' => 'View count (Weekly)',
        'view_month' => 'View count (Monthly)',
        'view_year' => 'View count (Yearly)',
        
        'title' => 'Post title',
        'rand' => 'Random',
        'comment_count' => 'Comment count',
        
        'review_score' => 'Review Score',
        'review_date' => 'Recent Review',
    ],
    'refresh' => 'sidedock',
    'hint' => 'single side dock order by',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_side_dock_order',
    'std'       => 'DESC',
    'name'      => 'Order',
    'options' => [
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
    ],
    'refresh' => 'sidedock',
    'hint' => 'single side dock order',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_side_dock_exclude_categories',
    'placeholder' => 'Eg. 145, 32',
    'name'      => 'Exclude categories',
    'desc' => 'Enter cat IDs, separate them by commas',
    'refresh' => 'sidedock',
    'hint' => 'single side dock: exclude categories',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_side_dock_title_typography',
    'name' => 'Title size',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => '.sidedock56__post .title56',
    'hint' => 'single side dock title font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'std' => 0,
    'id' => 'single_side_dock_excerpt_length',
    'name' => 'Excerpt length',
    'refresh' => 'sidedock',
    'hint' => 'single side dock excerpt length',
]);