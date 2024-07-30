<?php
$fox56_customize->add_section( 'blog_item', [
    'title' => 'Post Item',
    'panel' => 'blog',
]);

/* ----------------------------------       components */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'components',
    'std' => [ 'thumbnail', 'standalone_category', 'live', 'title', 'date', 'author', 'excerpt', 'more' ],
    'options' => [
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
    ],
    'name' => 'Components',
    'section' => 'blog_item',
    
    'refresh' => 'blog',

    'hint' => 'blog post components',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'big_first_post',
    'std' => true,
    'name' => '[MASONRY] Big First Post',
    'section' => 'blog_item',
    'refresh' => 'blog',
    'hint' => 'masonry big first post',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'masonry_item_creative',
    'std' => false,
    'name' => '[MASONRY] Creative Item',
    'refresh' => 'blog',
    'hint' => 'masonry creative item',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'list_mobile_layout',
    'std' => 'list',
    'options' => [
        'list' => 'List',
        'grid' => 'Stack',
    ],
    'name' => '[LIST] Mobile layout',
    'hint' => 'list mobile layout',
]);

/* ----------------------------------       post style */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'post_color',
    'css' => [
        [
            'selector' => '',
            'property' => 'color'
        ]
    ],
    'title' => 'Post color',
    'heading' => 'Post style',

    'hint' => 'blog post color',
]);

$fox56_customize->add_field([
    'id' => 'post_style',
    'type' => 'radio_image',
    'std' => 'normal',
    'options' => [
        'normal' => get_template_directory_uri() . '/inc/customize/images/post-style-normal.jpg',
        'ontop' => get_template_directory_uri() . '/inc/customize/images/post-style-ontop.jpg',
    ],
    'title' => 'Post text style',
    'refresh' => 'blog',
    'std_affects' => [
        'item_padding' => [
            'normal' => [ 'desktop' => 0, 'tablet' => 0, 'mobile' => 0 ],
            'ontop' => [ 'desktop' => 30, 'tablet' => 20, 'mobile' => 10 ],
        ]
    ],

    'hint' => 'blog post style',
]);

/* -----------------------  ON TOP OPTIONS */
$fox56_customize->add_field([
    'id' => 'ontop_height_style',
    'type' => 'radio',
    'std' => 'ratio',
    'options' => [
        'fixed' => 'Fixed height',
        'ratio' => 'By ratio',
    ],
    'title' => '[On Top] Post height by?',
    'refresh' => 'blog',

    'hint' => 'post on top: height',
]);

$fox56_customize->add_field([
    'id' => 'ontop_padding',
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'col' => '1-3',
            'placeholder' => 'Eg. 80%',
            'name' => 'Desktop', 
        ],
        'tablet' => [
            'type' => 'number',
            'col' => '1-3',
            'name' => 'Tablet', 
        ],
        'mobile' => [
            'type' => 'number',
            'col' => '1-3',
            'name' => 'Mobile', 
        ],
    ],
    'std' => [
        'desktop' => 80,
        'tablet' => 80,
        'mobile' => 80,
    ],
    'css' => [
        [
            'property' => 'padding-bottom',
            'selector' => '.post56__padding',
            'unit' => '%',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-bottom',
            'selector' => '.post56__padding',
            'unit' => '%',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-bottom',
            'selector' => '.post56__padding',
            'unit' => '%',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'desc' => 'Post ratio height/width. If any devices value missing, it will take value from bigger device.',
    'title' => '[On top] Padding (%)',
    'condition' => [
        'ontop_height_style' => 'ratio',
    ],

    'hint' => 'post on top: height percent',
]);

$fox56_customize->add_field([
    'id' => 'ontop_height',
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'col' => '1-3',
            'placeholder' => 'Eg. 320',
            'name' => 'Desktop', 
        ],
        'tablet' => [
            'type' => 'number',
            'col' => '1-3',
            'name' => 'Tablet', 
        ],
        'mobile' => [
            'type' => 'number',
            'col' => '1-3',
            'name' => 'Mobile', 
        ],
    ],
    'desc' => 'Post fixed. If any devices value missing, it will take value from bigger device.',
    'title' => '[On Top] Post height',
    'condition' => [
        'ontop_height_style' => 'fixed',
    ],
    'std' => [
        'desktop' => 320,
        'tablet' => 320,
        'mobile' => 320,
    ],
    'css' => [
        [
            'property' => 'height',
            'selector' => '.post56__height',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'height',
            'selector' => '.post56__height',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'height',
            'selector' => '.post56__height',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],

    'hint' => 'post on top: height pixel',
]);

$fox56_customize->add_field([
    'id' => 'ontop_overlay',
    'type' => 'color',
    'name' => '[On Top] Overlay background',
    'std' => 'rgba(0,0,0,.3)',
    'css' => [
        [
            'selector' => '.post56__overlay',
            'property' => 'background',
        ]
    ],

    'hint' => 'post on top: overlay',
]);

$fox56_customize->add_field([
    'id' => 'ontop_valign',
    'type' => 'radio',
    'title' => '[On Top] Text Position',
    'options' => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std' => 'middle',
    'refresh' => 'blog',

    'hint' => 'post on top: position',
]);

/* ----------------------------------       align */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'align',
    'type' => 'radio',
    'title' => 'Item Align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'refresh' => 'blog',
    'heading' => 'Item align',

    'hint' => 'post text align',
]);

$fox56_customize->add_field([
    'id' => 'valign',
    'type' => 'radio',
    'title' => 'Vertical Align (list layout)',
    'options' => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std' => 'top',
    'refresh' => 'blog',

    'hint' => 'post vertical align',
]);

/* ----------------------------------       gap / spacing */
$fox56_customize->add_field([
    'id' => 'h_spacing',
    'type' => 'group',
    'heading' => 'Gap / Spacing',
    'title' => 'Gap between columns',
    'hint' => 'post column item spacing',
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
            'selector' => ".blog56--grid",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'column-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-left',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-left',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-left',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'padding-right',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-right',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-right',
            'selector' => ".masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-left',
            'selector' => ".main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-left',
            'selector' => ".main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-left',
            'selector' => ".main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-right',
            'selector' => ".main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-right',
            'selector' => ".main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-right',
            'selector' => ".main-masonry",
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
            'selector' => ".row56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".row56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".row56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        /**
         * sep (list, grid, group)
         */
        [
            'property' => 'column-gap',
            'selector' => ".blog56__sep",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56__sep",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".blog56__sep",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * vertical border move right little bit
         */
        [
            'property' => 'transform',
            'selector'=> ".blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'transform',
            'selector'=> ".blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'transform',
            'selector'=> ".blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'v_spacing',
    'type' => 'group',
    'title' => 'Gap between rows',
    'hint' => 'post row item spacing',
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
            'selector' => ".blog56--grid",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'row-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-top',
            'selector' => ".masonry-cell",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-top',
            'selector' => ".masonry-cell",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-top',
            'selector' => ".masonry-cell",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-top',
            'selector' => ".main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => ".main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => ".main-masonry",
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
            'selector' => ".post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'top',
            'selector' => ".post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'top',
            'selector' => ".post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
]);

$fox56_customize->add_field([
    'id' => 'component_spacing',
    'type' => 'group',
    'title' => 'Component spacing',
    'hint' => 'post components spacing',
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
        'desktop' => 8,
        'tablet' => 8,
        'mobile' => 6,
    ],

    'css' => [
        [
            'property' => 'margin-top',
            'selector' => ".component56 + .component56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => ".component56 + .component56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => ".component56 + .component56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_margin_bottom',
    'type' => 'group',
    'title' => 'Thumbnail gap bottom',
    'hint' => 'post thumbnail margin',
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
        'desktop' => 10,
        'tablet' => 8,
        'mobile' => 6,
    ],
    'css' => [
        [
            'property' => 'margin-bottom',
            'selector' => ".thumbnail56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".thumbnail56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".thumbnail56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'title_margin_bottom',
    'type' => 'group',
    'title' => 'Title margin bottom',
    'hint' => 'post title margin',
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
        'desktop' => 10,
        'tablet' => 8,
        'mobile' => 6,
    ],
    'css' => [
        [
            'property' => 'margin-bottom',
            'selector' => ".title56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".title56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".title56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'excerpt_margin_bottom',
    'type' => 'group',
    'title' => 'Excerpt margin bottom',
    'hint' => 'post excerpt margin',
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
        'desktop' => 10,
        'tablet' => 8,
        'mobile' => 6,
    ],
    'css' => [
        [
            'property' => 'margin-bottom',
            'selector' => ".excerpt56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".excerpt56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".excerpt56",
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
    'heading' => 'Border / Sep',
    'id' => 'v_sep',
    'type' => 'radio',
    'title' => 'Vertical border between cols?',
    'hint' => 'post vertical border line',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '0px',
    'css' => [
        [
            'property' => 'border-right-width',
            'selector' => ".blog56__sep__line",
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'v_sep_color',
    'type' => 'color',
    'title' => 'Vertical border color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".blog56__sep__line",
        ],
    ],
    'hint' => 'post vertical border line color',
]);

// if group, it applies to sub-items
$fox56_customize->add_field([
    'id' => 'h_sep',
    'type' => 'radio',
    'title' => 'Horizontal border between items?',
    'hint' => 'post horizontal border line',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '0px',
    'css' => [
        [
            'property' => 'border-top-width',
            'selector' => ".post56__sep__line",
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'h_sep_color',
    'type' => 'color',
    'title' => 'Horizontal border color',
    'hint' => 'post horizontal border line color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".post56__sep__line",
        ],
    ],
]);

/* ----------------------------------       post box */
$fox56_customize->add_field([
    'heading' => 'Post box',
    'id' => 'item_border_radius',
    'hint' => 'post item border radius',
    'type' => 'text',
    'std' => '0',
    'title' => 'Post box border radius',
    'css' => [
        [
            'property' => 'border-radius',
            'selector' => ".post56",
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'item_background',
    'type' => 'color',
    'title' => 'Post box background',
    'hint' => 'post box background',
    'css' => [
        [
            'property' => 'background-color',
            'selector' => ".post56",
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'item_shadow',
    'type' => 'number',
    'title' => 'Post box shadow',
    'hint' => 'post shadow',
    'std' => 0,
    'css' => [
        [
            'property' => 'box-shadow',
            'selector' => ".post56",
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'item_padding',
    'type' => 'group',
    'hint' => 'post box padding',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'name' => 'Desktop',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'text',
            'name' => 'Tablet',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 0,
        'tablet' => 0,
        'mobile' => 0,
    ],
    'title' => 'Post box padding',
    'css' => [
        [
            'property' => 'padding',
            'selector' => ".post56 .post56__text",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding',
            'selector' => ".post56 .post56__text",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding',
            'selector' => ".post56 .post56__text",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
]);