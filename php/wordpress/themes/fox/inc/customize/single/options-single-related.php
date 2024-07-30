<?php
$fox56_customize->add_section( 'single_related', [
    'title' => 'Related Posts',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_related',[
    'selector' => '.single56__related',
    'render_callback' => 'fox56_single_related_inner',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'placeholder' => 'Eg. Related posts',
    'id' => 'single_related_heading',
    'std'       => 'Related Posts',
    'name'      => 'Related posts heading text',
    'section' => 'single_related',

    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'single_related_number',
    'std'       => 3,
    'name'      => 'Number of related posts',
    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_related_source',
    'std'       => 'tag',
    'options' => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Related source',
    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_related_orderby',
    'std'       => 'date',
    'name'      => 'Related posts order by',
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
    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_related_order',
    'std'       => 'DESC',
    'name'      => 'Related posts order',
    'options' => [
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
    ],
    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_related_exclude_categories',
    'placeholder' => 'Eg. 145, 32',
    'name'      => 'Exclude categories',
    'desc' => 'Enter cat IDs, separate them by commas',
    'refresh' => 'single_related',
    'hint' => 'related: exclude categories',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_related_layout',
    'name'      => 'Layout',
    'options' => [
        'grid-2' => 'Grid 2 cols',
        'grid-3' => 'Grid 3 cols',
        'grid-4' => 'Grid 4 cols',
        'list' => 'List',  
    ],
    'std' => 'grid-3',
    'refresh' => 'single_related',
    'hint' => 'related posts layout',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_related_components',
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
    'std' => [ 'thumbnail', 'title', 'date' ],
    'refresh' => 'single_related',
    'hint' => 'related posts components',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_related_thumbnail',
    'name'      => 'Thumbnail',
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
    'refresh' => 'single_related',

    'hint' => 'related posts thumbnail',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_related_thumbnail_custom',
    'name' => 'Thumbnail custom',
    'hint' => 'related posts custom thumbnail',
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
    'condition' => [ 'single_related_thumbnail' => 'custom' ],
    'refresh' => 'single_related',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_related_title_typography',
    'name' => 'Title size',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => '.single56__related .title56',
    'hint' => 'related posts title size',
]);