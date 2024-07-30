<?php
$fox56_customize->add_section( 'blog_toparea', [
    'title' => 'Top area',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'hint' => 'toparea layout',
    'type' => 'radio_image',
    'id' => 'toparea_layout',
    'options' => [
        'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
        'masonry' => get_template_directory_uri() . '/inc/customize/images/masonry.jpg',
        'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
        'group' => get_template_directory_uri() . '/inc/customize/images/group.jpg',
        'carousel' => get_template_directory_uri() . '/inc/customize/images/carousel.jpg',
        'slider' => get_template_directory_uri() . '/inc/customize/images/slider.jpg',
    ],
    'std' => 'group',
    'name' => 'Top area layout',
    'refresh' => 'toparea',
    'section' => 'blog_toparea',

    'std_affects' => [
        'toparea_column' => [
            'grid' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
            'masonry' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
            'carousel' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
            'list' => [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ],
        ]
    ]
]);

$fox56_customize->add_field([
    'hint' => 'toparea column',
    'type' => 'group',
    'id' => 'toparea_column',
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
        'desktop' => 3,
        'tablet' => 2,
        'mobile' => 1,
    ],
    'name' => 'Column',
    'condition' => [ 'toparea_layout' => [ 'grid', 'masonry', 'list', 'carousel' ] ],
    'refresh' => 'toparea',
]);

$fox56_customize->add_field([
    'hint' => 'toparea group layout',
    'type' => 'radio_image',
    'id' => 'toparea_group_layout',
    'std' => '1-3-1',
    'options' => [
        // 2 COLS
        '1-1' => get_template_directory_uri() . '/inc/customize/images/group-1-1.jpg',
        '2-1' => get_template_directory_uri() . '/inc/customize/images/group-2-1.jpg',
        '1-2' => get_template_directory_uri() . '/inc/customize/images/group-1-2.jpg',
        '1-3' => get_template_directory_uri() . '/inc/customize/images/group-1-3.jpg',
        '3-1' => get_template_directory_uri() . '/inc/customize/images/group-3-1.jpg',
        '2-3' => get_template_directory_uri() . '/inc/customize/images/group-2-3.jpg',
        '3-2' => get_template_directory_uri() . '/inc/customize/images/group-3-2.jpg',

        // 3 COLS
        '3-1-1' => get_template_directory_uri() . '/inc/customize/images/group-3-1-1.jpg',
        '1-3-1' => get_template_directory_uri() . '/inc/customize/images/group-1-3-1.jpg',
        '1-1-3' => get_template_directory_uri() . '/inc/customize/images/group-1-1-3.jpg',

        '2-1-1' => get_template_directory_uri() . '/inc/customize/images/group-2-1-1.jpg',
        '1-2-1' => get_template_directory_uri() . '/inc/customize/images/group-1-2-1.jpg',
        '1-1-2' => get_template_directory_uri() . '/inc/customize/images/group-1-1-2.jpg',
    ],
    'name' => 'Group Layout',
    'condition' => [ 'toparea_layout' => 'group' ],
    'refresh' => 'toparea',
]);

$components = [
    'standalone_category' => 'Fancy category',
    'live' => 'LIVE Indicator',
    'title' => 'Title',
    'thumbnail' => 'Thumbnail',
    'date' => 'Date',
    'author' => 'Author',
    'category' => 'Category',
    'comment' => 'Comment',
    'reading_time' => 'Reading Time',
    'view' => 'View count',
    'excerpt' => 'Excerpt',
    'more' => 'More',
    'share' => 'Share',
];

$cols = [
    'big' => [
        'title' => 'Big col',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
        'excerpt_length' => 32,
        'thumbnail' => 'thumbnail-large',
        'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
        'align' => 'left',
        'more_style' => 'primary',
    ],
    'medium' => [
        'title' => 'Small col',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
        'excerpt_length' => 32,
        'thumbnail' => 'medium',
        'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
        'align' => 'left',
        'more_style' => 'plain',
    ],
    'small' => [
        'title' => 'Small col 2',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'title', 'excerpt' ],
        'excerpt_length' => 12,
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
        'align' => 'left',
        'more_style' => 'plain',
    ],
];

$fox56_customize->add_field([
    'id' => 'toparea_components',
    'type' => 'sortable',
    'options' => $components,
    'std' => [ 'standalone_category', 'thumbnail', 'title', 'date', 'author', 'excerpt', 'more' ],
    'name' => 'Components',
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'carousel', 'slider' ] ],
    'refresh' => 'toparea',
]);

$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'id' => 'toparea_h_spacing',
    'type' => 'group',
    'heading' => 'Gap / Spacing',
    'title' => 'Gap between columns',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 32,
        'tablet' => 20,
        'mobile' => 10,
    ],
    'css' => [
        
        /**
         * BLOG GRID
         */
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--grid",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-left',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-left',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-left',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'padding-right',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-right',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-right',
            'selector' => ".toparea56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-left',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-left',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-left',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-right',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-right',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-right',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * GROUP
         */
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .row56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .row56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .row56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        /**
         * sep (list, grid, group)
         */
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56__sep",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56__sep",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".toparea56 .blog56__sep",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * vertical border move right little bit
         */
        [
            'property' => 'transform',
            'selector'=> ".toparea56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'transform',
            'selector'=> ".toparea56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'transform',
            'selector'=> ".toparea56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'carousel' ] ],
    'id' => 'toparea_carousel_item_spacing',
    'type' => 'group',
    'title' => 'Gap between items',
    'hint' => 'toparea carousel item spacing',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
    ],
    'std' => [ 
        'desktop' => 16,
        'tablet' => 8,
        'mobile' => 8,
    ],
    'css' => [
        [
            'property' => 'padding',
            'value_pattern' => '0 $',
            'selector' => ".toparea56 .carousel-cell",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'padding',
            'value_pattern' => '0 $',
            'selector' => ".toparea56 .carousel-cell",
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'property' => 'padding',
            'value_pattern' => '0 $',
            'selector' => ".toparea56 .carousel-cell",
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],


        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".toparea56 .carousel56__container",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".toparea56 .carousel56__container",
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".toparea56 .carousel56__container",
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],
        
    ]
]);

$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'id' => 'toparea_v_spacing',
    'hint' => 'toparea item row spacing',
    'type' => 'group',
    'title' => 'Gap between rows',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 32,
        'tablet' => 20,
        'mobile' => 10,
    ],
    'css' => [

        /**
         * BLOG GRID
         */
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--grid",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".toparea56 .blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-top',
            'selector' => ".toparea56 .masonry-cell",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-top',
            'selector' => ".toparea56 .masonry-cell",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-top',
            'selector' => ".toparea56 .masonry-cell",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-top',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => ".toparea56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BORDER TOP MOVED
         */
        [
            'property' => 'top',
            'selector' => ".toparea56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'top',
            'selector' => ".toparea56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'top',
            'selector' => ".toparea56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
]);

/* BORDER
================================================ */

// vertical border
$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'heading' => 'Border / Sep',
    'id' => 'toparea_v_sep',
    'hint' => 'toparea vertical border',
    'type' => 'radio',
    'title' => 'Vertical border between cols?',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '0px',
    'css' => [
        [
            'property' => 'border-right-width',
            'selector' => ".toparea56 .blog56__sep__line",
        ],
    ],
]);

$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'id' => 'toparea_v_sep_color',
    'hint' => 'toparea vertical border color',
    'type' => 'color',
    'title' => 'Vertical border color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".toparea56 .blog56__sep__line",
        ],
    ],
]);

// if group, it applies to sub-items
$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'id' => 'toparea_h_sep',
    'hint' => 'toparea horizontal border',
    'type' => 'radio',
    'title' => 'Horizontal border between items?',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '0px',
    'css' => [
        [
            'property' => 'border-top-width',
            'selector' => ".toparea56 .post56__sep__line",
        ],
    ],
]);

$fox56_customize->add_field([
    'condition' => [ 'toparea_layout' => [ 'grid', 'list', 'masonry', 'group' ] ],
    'id' => 'toparea_h_sep_color',
    'hint' => 'toparea horizontal border color',
    'type' => 'color',
    'title' => 'Horizontal border color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".toparea56 .post56__sep__line",
        ],
    ],
]);

/* ----------------------------------   group */
$fox56_customize->add_field([
    'type' => 'tabs',
    'id' => 'toparea_group_tabs',
    'tabs' => [
        'big' => 'Col big',
        'medium' => 'Col small',
        'small' => 'Col small 2'
    ],
    'condition' => [ 'toparea_layout' => [ 'group' ] ],
]);

foreach ( $cols as $col => $coldata ) {
    $prefix = "toparea_{$col}_";

    if ( 'big' == $col || 'medium' == $col ) {
        $fox56_customize->add_field([
            'id' => "{$prefix}number",
            'type' => 'number',
            'std' => 1,
            'name' => 'Number of '. $coldata['title']. ' posts',

            'tab' => $col,
            'refresh' => 'toparea',
            'tabs' => 'toparea_group_tabs',
            'condition' => [ 'toparea_layout' => 'group' ],

            'hint' => 'toparea: ' . $coldata[ 'title' ] . ' number of posts',
        ]);
    }
    
    $fox56_customize->add_field([
        'id' => "{$prefix}layout",
        'type' => 'radio_image',
        'options' => [
            'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
            'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
        ],
        'std' => 'grid',
        'name' => 'Layout',

        'tab' => $col,
        'refresh' => 'toparea',
        'tabs' => 'toparea_group_tabs',
        'condition' => [ 'toparea_layout' => 'group' ],

        'hint' => 'toparea: ' . $coldata[ 'title' ] . ' layout',
    ]);

    $fox56_customize->add_field([
        'id' => "{$prefix}components",
        'type' => 'sortable',
        'options' => $components,
        'std' => $coldata[ 'components' ],
        'name' => 'Components',

        'tab' => $col,
        'refresh' => 'toparea',
        'tabs' => 'toparea_group_tabs',
        'condition' => [ 'toparea_layout' => 'group' ],

        'hint' => 'toparea: ' . $coldata[ 'title' ] . ' components',
    ]);

    if ( 'big' == $col ) {
        $fox56_customize->add_field([
            'id' => "{$prefix}align",
            'type' => 'radio',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => $coldata[ 'align' ],
            'name' => 'Align',

            'tab' => $col,
            'refresh' => 'toparea',
            'tabs' => 'toparea_group_tabs',
            'condition' => [ 'toparea_layout' => 'group' ],

            'hint' => 'toparea: ' . $coldata[ 'title' ] . ' align',
        ]);
    }

    $fox56_customize->add_field([
        'id' => "{$prefix}thumbnail",
        'type' => 'select',
        'options' => [
            'thumbnail' => 'Thumbnail (150x150)',
            'thumbnail-medium' => 'Landscape (480x384)',
            'thumbnail-square' => 'Square (480x480)',
            'thumbnail-portrait' => 'Portrait (480x600)',
            'thumbnail-large' => 'Large (720x480)',
            'medium' => 'Medium (no crop)',
            'large' => 'Large (no crop)',
            'full' => 'Full (original)',
        ],
        'std' => $coldata[ 'thumbnail' ],
        'name' => 'Thumbnail',

        'tab' => $col,
        'refresh' => 'toparea',
        'tabs' => 'toparea_group_tabs',
        'condition' => [ 'toparea_layout' => 'group' ],

        'hint' => 'toparea: ' . $coldata[ 'title' ] . ' thumbnail',
    ]);

    $fox56_customize->add_field([
        'id' => "{$prefix}excerpt_length",
        'type' => 'number',
        'std' => $coldata[ 'excerpt_length' ],
        'name' => 'Excerpt length',

        'tab' => $col,
        'refresh' => 'toparea',
        'tabs' => 'toparea_group_tabs',
        'condition' => [ 'toparea_layout' => 'group' ],

        'hint' => 'toparea: ' . $coldata[ 'title' ] . ' excerpt length',
    ]);

    $fox56_customize->add_field([
        'id' => "{$prefix}more_style",
        'type' => 'radio_image',
        'std' => $coldata[ 'more_style' ],
        'name' => 'More style',
        'options' => [
            'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
            'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
            'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
            'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
            'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
            'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
        ],

        'tab' => $col,
        'refresh' => 'toparea',
        'tabs' => 'toparea_group_tabs',
        'condition' => [ 'toparea_layout' => 'group' ],

        'hint' => 'toparea: ' . $coldata[ 'title' ] . ' more style',
    ]);
    
}

/* ================================     THUMBNAIL       */
$fox56_customize->add_field([
    'heading' => 'Thumbnail',
    'id' => 'toparea_thumbnail',
    'type' => 'radio_image',
    'title' => 'Toparea post thumbnail',
    'std' => 'thumbnail-medium',
    'options' => [
        'thumbnail' => get_template_directory_uri() . '/inc/customize/images/thumbnail.jpg',
        'thumbnail-medium' => get_template_directory_uri() . '/inc/customize/images/thumbnail-medium.jpg',
        'thumbnail-square' => get_template_directory_uri() . '/inc/customize/images/thumbnail-square.jpg',
        'thumbnail-portrait' => get_template_directory_uri() . '/inc/customize/images/thumbnail-portrait.jpg',
        'thumbnail-large' => get_template_directory_uri() . '/inc/customize/images/thumbnail-large.jpg',
        'medium' => get_template_directory_uri() . '/inc/customize/images/medium.jpg',
        'large' => get_template_directory_uri() . '/inc/customize/images/large.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/full.jpg',
        'custom' => get_template_directory_uri() . '/inc/customize/images/custom.jpg',
    ],
    'refresh' => 'toparea',
    'condition' => [ 'toparea_layout' => [ 'list', 'grid', 'carousel' ] ],

    'hint' => 'toparea thumbnail',
]);
$fox56_customize->add_field([
    'id' => 'toparea_thumbnail_position',
    'type' => 'radio',
    'title' => 'Post list: thumbnail position',
    'std' => 'left',
    'options' => [
        'left' => 'Left',
        'right' => 'Right',
        'alternative' => 'Alternative',
    ],
    'refresh' => 'toparea',
    'condition' => [ 'toparea_layout' => 'list' ],

    'hint' => 'toparea thumbnail align',
]);

$fox56_customize->add_field([
    'id' => 'toparea_thumbnail_width_type',
    'type' => 'radio',
    'title' => 'Thumbnail width',
    'options' => [
        'percent' => 'Percent (%)',
        'pixel' => 'Pixel (px)',
    ],
    'std' => 'percent',
    'refresh' => 'toparea',
    'condition' => [ 'toparea_layout' => 'list' ],

    'hint' => 'toparea thumbnail width',
]);

$fox56_customize->add_field([
    'id' => 'toparea_thumbnail_width_percent',
    'type' => 'group',
    'title' => 'Thumbnail width (%)',
    'hint' => 'toparea thumbnail width percent',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'max' => 100,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'max' => 100,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'max' => 100,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 40,
        'tablet' => 40,
        'mobile' => 30,
    ],
    'css' => [
        /**
         * THUMBNAIL
         */
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
    'condition' => [
        'toparea_layout' => 'list',
        "toparea_thumbnail_width_type" => 'percent',
    ],
]);

$fox56_customize->add_field([
    'id' => 'toparea_thumbnail_width_px',
    'hint' => 'toparea thumbnail width pixel',
    'type' => 'group',
    'title' => 'Thumbnail width (px)',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'max' => 1000,
            'min' => 40,
            'step' => 10,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'max' => 1000,
            'min' => 40,
            'step' => 10,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'max' => 1000,
            'min' => 40,
            'step' => 10,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 400,
        'tablet' => 300,
        'mobile' => 100,
    ],
    'css' => [
        /**
         * THUMBNAIL
         */
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    /* IMPORTANT: we must pust the option toparea_layout BEFORE, not sure why  */
    'condition' => [
        'toparea_layout' => 'list',
        "toparea_thumbnail_width_type" => 'pixel',
    ],
]);

$fox56_customize->add_field([
    'id' => 'toparea_thumbnail_text_gap',
    'hint' => 'toparea thumbnail - text gap',
    'type' => 'group',
    'title' => 'Thumbnail - Text gap',

    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'max' => 100,
            'min' => 0,
            'step' => 2,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'max' => 100,
            'min' => 0,
            'step' => 2,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'max' => 100,
            'min' => 0,
            'step' => 2,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 24,
        'tablet' => 16,
        'mobile' => 8,
    ],
    
    'css' => [
        /**
         * PADDING RIGHT
         */
        [
            'selector' => ".toparea56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * PADDING LEFT
         */
        [
            'selector' => ".toparea56 > .container > .blog56--list .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".toparea56 > .container > .blog56--list .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".toparea56 > .container > .blog56--list .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [ 'toparea_layout' => 'list' ],
]);

/* ------------------------------------ query */
$fox56_customize->add_field([
    'hint' => 'toparea query',
    'heading' => 'Query',
    'type' => 'checkbox',
    'id' => 'toparea_not_excluded',
    'name' => 'Do not exclude top area posts from main stream',
]);

/* ------------------------------------ custom params */
$fox56_customize->add_field([
    'hint' => 'toparea custom params',
    'heading' => 'Custom params',
    'type' => 'textarea',
    'placeholder' => 'Eg. components = standalone_category, thumbnail, title, excerpt; excerpt_length = 32;',
    'id' => 'toparea_custom_params',
    'name' => 'Custom params',
    'refresh' => 'toparea',
    'desc' => 'SYNTAX: key = value; key2 = value2;',
]);