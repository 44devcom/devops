<?php
$fox56_customize->add_section( 'single_bottom_posts', [
    'title' => 'Single Bottom',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_bottom_posts', [
    'selector' => '.single56__bottom_posts',
    'render_callback' => 'fox56_bottom_posts_inner',
]);

/* bottom
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_bottom_elements',
    'title' => 'Bottom elements',
    'hint' => 'single bottom components',
    'std'     => [ 'nav', 'bottom_posts', 'ad' ],
    'options' => [
        'bottom_posts' => 'Bottom posts',
        'related' => 'Related posts',
        'nav' => 'Next/Prev Posts',
        'ad' => 'Ad',
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
        'html3' => 'HTML 3',
    ],
    'refresh' => 'single',
    'section' => 'single_bottom_posts',
    'msg' => 'To set up Ad for bottom area, go to <strong>Single &raquo; Advertisement</strong> panel',
]);

$fox56_customize->add_field([
    'heading' => 'Bottom posts',
    'type' => 'number',
    'id' => 'single_bottom_posts_number',
    'std'       => 5,
    'name'      => 'Number of posts',
    'hint' => 'number of single bottom posts',
    'refresh' => 'single_bottom_posts',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_bottom_posts_source',
    'std'       => 'category',
    'options' => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Related source',
    'refresh' => 'single_bottom_posts',
    'hint' => 'single bottom posts source',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_bottom_posts_orderby',
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
    'refresh' => 'single_bottom_posts',
    'hint' => 'single bottom posts order by',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_bottom_posts_order',
    'std'       => 'DESC',
    'name'      => 'Order',
    'options' => [
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
    ],
    'refresh' => 'single_bottom_posts',
    'hint' => 'single bottom posts order',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_bottom_posts_exclude_categories',
    'placeholder' => 'Eg. 145, 32',
    'name'      => 'Exclude categories',
    'desc' => 'Enter cat IDs, separate them by commas',
    'refresh' => 'single_bottom_posts',
    'hint' => 'single bottom posts exclude categories',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_bottom_posts_components',
    'name'      => 'Components',
    'options' => [
        'thumbnail' => 'Thumbnail',
        'standalone_category' => 'Fancy Category',
        'title' => 'Title',
        'date' => 'Date',
        'category' => 'Category',
        'author' => 'Author',
        'excerpt' => 'Excerpt',
        'more' => 'Read more',
        'view' => 'View count',
        'reading_time' => 'Reading time',
        'comment' => 'Comment link',
    ],
    'std' => [ 'thumbnail', 'title', 'excerpt' ],
    'refresh' => 'single_bottom_posts',
    'hint' => 'single bottom posts components',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_bottom_posts_thumbnail',
    'name'      => 'Thumbnail',
    'hint' => 'single bottom posts thumbnail',
    'options' => [
        '' => 'Inhert',
        'thumbnail' => 'Thumbnail (150x150)',
        'thumbnail-medium' => 'Landscape (480x384)',
        'thumbnail-square' => 'Square (480x480)',
        'thumbnail-portrait' => 'Portrait (480x600)',
        'thumbnail-large' => 'Large (720x480)',
        'medium' => 'Medium (no crop)',
        'large' => 'Large (no crop)',
        'full' => 'Full (original)',
        'custom' => 'Custom',
    ],
    'std' => '',
    'refresh' => 'single_bottom_posts',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'hint' => 'single bottom posts custom thumbnail',
    'id' => 'single_bottom_posts_thumbnail_custom',
    'name' => 'Thumbnail custom',
    'fields' => [
        'width' => [
            'name' => 'Width',
            'type' => 'number',
            'col' => '1-2',
            'step' => 10,
            'min' => 50,
            'max' => 1000,
        ],
        'height' => [
            'name' => 'Height',
            'type' => 'number',
            'col' => '1-2',
            'step' => 10,
            'min' => 50,
            'max' => 1000,
        ],
    ],
    'condition' => [ 'single_bottom_posts_thumbnail' => 'custom' ],
    'refresh' => 'single_bottom_posts',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'hint' => 'single bottom posts title size',
    'id' => 'single_bottom_posts_title_typography',
    'name' => 'Title size',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => '.single56__bottom_posts .title56',
]);