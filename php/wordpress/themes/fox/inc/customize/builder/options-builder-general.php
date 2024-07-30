<?php
/**
 * IMPORTANT: h_spacing is column-gap but h_sep is horizontal line
 * 
 * logic for active_callback
 * ontop options:
 *      + post style: on top
 *      + layout: grid, carousel, group
 * column options:
 *      + layout: grid, list, masonry, carousel
 * 
 * columns gap:
 *      + layout: grid, list, masonry, carousel, group
 * row gap:
 *      + layout: grid, list, masonry, group (applied for inner posts)
 * align:
 *      + layout: grid, list, masonry, carousel
 * valign:
 *      + layout: list
 *      or
 *      + post style: on top
 * horizontal border:
 *      + layout: grid, list, masonry, group (for inner posts)
 *      - post stype NOT ontop
 * vertical border:
 *      + layout: grid, list, masonry, group, carousel
 *      - post stype NOT ontop
 * post box
 *      + layout: grid, list, masonry, group, carousel
 * big col:
 *      + layout: group
 * medium col: 
 *      + layout: group
 * small col:
 *      + layout: group
 * carousel settings:
 *      + layout: carousel
 * custom sidebar settings:
 *      + layout: sidebar
 * HTML code:
 *      + layout: html/shortcode
 * page ID:
 *      + layout: custom page content
 */

/**
 * LAYOUT
 */
$fields[ 'layout' ] = [
    'type' => 'radio_image',
    'name' => 'Display',
    'options' => [
        'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
        'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
        'masonry' => get_template_directory_uri() . '/inc/customize/images/masonry.jpg',
        'group' => get_template_directory_uri() . '/inc/customize/images/group.jpg',
        'carousel' => get_template_directory_uri() . '/inc/customize/images/carousel.jpg',
        'html' => get_template_directory_uri() . '/inc/customize/images/html.jpg',
        'sidebar' => get_template_directory_uri() . '/inc/customize/images/sidebar.jpg',
        'page' => get_template_directory_uri() . '/inc/customize/images/page.jpg',
    ],
    'std' => 'grid',
    'tab' => 'general',
    'transport' => 'postMessage',

    'refresh' => 'primary',
    'std_affects' => [
        'list' => [
            'column' => [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ],
        ],
        'grid' => [
            'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ]
        ],
        'masonry' => [
            'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ]
        ],
        'carousel' => [
            'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ]
        ],
    ]
];

$fields[ 'big_first_post' ] = [
    'type' => 'checkbox',
    'name' => 'First post big?',
    'condition' => [
        'layout' => 'masonry',
    ],
    'refresh' => 'primary',
];

$fields[ 'masonry_item_creative' ] = [
    'type' => 'checkbox',
    'name' => 'Vertical thumbnail compact?',
    'condition' => [
        'layout' => 'masonry',
    ],
    'refresh' => 'primary',
];

/**
 * COLUMN
 */
$fields[ 'column' ] = [
    'type' => 'group',
    'title' => 'Column',
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'carousel' ]
    ],
    'fields' => [
        'desktop' => [
            'name' => 'Column',
            'type' => 'number',
            // 'std' => 3,
            'max' => 6,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            // 'std' => 2,
            'max' => 4,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            // 'std' => 2,
            'max' => 4,
            'min' => 1,
            'step' => 1,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 3,
        'tablet' => 2,
        'mobile' => 1,
    ],

    'refresh' => 'primary',
];

/**
 * LIST
 */
$fields[ 'list_mobile_layout' ] = [
    'type' => 'radio',
    'std' => '',
    'options' => [
        '' => 'Default',
        'list' => 'List',
        'grid' => 'Stack',
    ],
    'name' => '[LIST] Mobile layout',
    'refresh' => 'primary',

    'condition' => [
        "layout" => [ 'list' ] 
   ],
];

/**
 * CAROUSEL CONTROLS
 * ========================================================================================
 */
$fields[ 'carousel_hint' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Show little hint of next item?',
    'heading' => 'Carousel Settings',

    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

// nav and position
$fields[ 'carousel_nav' ] = [
    'type' => 'select',
    'std' => 'middle-inside',
    'options' => [
        'middle-inside' => 'Middle + Inside',
        'middle-edge' => 'Middle + Edge',
        'top-right' => 'Top right',
        'none' => 'None',
    ],
    'title' => 'Arrows',

    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
    
];

$fields[ 'carousel_nav_shape' ] = [
    'type' => 'select',
    'std' => 'circle',
    'options' => [
        'circle' => 'Circle',
        'square' => 'Square',
        'high-square' => 'High square',
    ],
    'title' => 'Arrows shape',
    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

$fields[ 'carousel_nav_style' ] = [
    'type' => 'select',
    'std' => 'outline',
    'options' => [
        'outline' => 'Outline',
        'fill' => 'Fill',
        'primary' => 'Primary',
        'dark' => 'Dark',
    ],
    'title' => 'Arrows style',
    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

$fields[ 'carousel_pager' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Pager?',
    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

$fields[ 'carousel_pager_style' ] = [
    'type' => 'select',
    'options' => [
        'circle' => 'Circle',
        'square' => 'Square',
        'big-circle' => 'Big circle',
        'big-square' => 'Big Square',
    ],
    'std' => 'circle',
    'title' => 'Pager style',
    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

$fields[ 'carousel_autoplay' ] = [
    'type' => 'checkbox',
    'title' => 'Autoplay?',
    'condition' => [
         "layout" => [ 'carousel' ] 
    ],
];

$fields[ 'text_inner_width' ] = [
    'type' => 'group',
    'title' => 'Inner text width',
    'condition' => [
        "layout" => [ 'carousel' ],
        'post_style' => 'ontop',
    ],

    'fields' => [
        'desktop' => [
            'col' => '1-3',
            'name' => 'Desktop',
            'type' => 'text',
        ],
        'tablet' => [
            'col' => '1-3',
            'name' => 'Tablet',
            'type' => 'text',
        ],
        'mobile' => [
            'col' => '1-3',
            'name' => 'Mobile',
            'type' => 'text',
        ],
    ],
    'css' => [
        [
            'selector' => '.{{section}} .primary56 .post56--ontop .post56__text__inner',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.{{section}} .primary56 .post56--ontop .post56__text__inner',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.{{section}} .primary56 .post56--ontop .post56__text__inner',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ]
];

$fields[ 'text_inner_background' ] = [
    'type' => 'color',
    'title' => 'Inner text background',
    'condition' => [
        "layout" => [ 'carousel' ],
        'post_style' => 'ontop',
    ],
    'css' => [
        [
            'selector' => '.{{section}} .primary56 .post56--ontop .post56__text__inner',
            'property' => 'background',
        ]
    ]
];

/**
 * POST STYLE
 * ========================================================================================
 */
$fields[ 'post_style__heading' ] = [
    'type' => 'heading',
    'heading' => 'Post style',

    'condition' => [
        "layout" => [ 'grid', 'group', 'carousel' ]
    ],
];

$fields[ 'color' ] = [
    'type' => 'color',
    'title' => 'Custom Text color',
    'css' => [
        [
            'selector' => "
            .{{section}} .primary56,
            .{{section}} .primary56 .post56,
            .{{section}} .primary56 .title56, 
            .{{section}} .primary56 .excerpt56, 
            .{{section}} .primary56 .meta56,
            .{{section}} .primary56 .meta56 a, 
            .{{section}} .primary56 .meta56__category--fancy,
            .{{section}} .primary56 .btn56--outline,
            .{{section}} .primary56 .btn56--fill",
            'property' => 'color',
        ],
        [
            'selector' => ".{{section}} .primary56 .btn56--outline,
            .{{section}} .primary56 .btn56--fill",
            'property' => 'border-color',
        ],
        [
            'selector' => ".{{section}} .primary56 .btn56--fill:hover",
            'property' => 'background-color',
        ],
        // make this always white when hovered
        [
            'selector' => ".{{section}} .primary56 .btn56--fill:hover",
            'property' => 'color',
            'value_pattern' => 'white',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'post_style' ] = [
    'type' => 'radio_image',
    'std' => 'normal',
    'options' => [
        'normal' => get_template_directory_uri() . '/inc/customize/images/post-style-normal.jpg',
        'ontop' => get_template_directory_uri() . '/inc/customize/images/post-style-ontop.jpg',
    ],
    'title' => 'Post text style',

    'condition' => [
        "layout" => [ 'grid', 'group', 'carousel' ]
    ],

    'refresh' => 'primary',
];

    /* -----------------------  ON TOP OPTIONS */
    $fields[ 'ontop_height_style' ] = [
        'type' => 'radio',
        'std' => 'ratio',
        'options' => [
            'fixed' => 'Fixed height',
            'ratio' => 'By ratio',
        ],
        'title' => 'Post height by?',
        
        'condition' => [
            "layout" => [ 'grid', 'group', 'carousel' ],
            "post_style" => 'ontop',
        ],
        
        'refresh' => 'primary',
    ];

    $fields[ 'ontop_padding' ] = [
        'type' => 'group',
        'fields' => [
            'desktop' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '80%',
                'placeholder' => 'Eg. 80%',
                'name' => 'Desktop', 
            ],
            'tablet' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '80%',
                'name' => 'Tablet', 
            ],
            'mobile' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '80%',
                'name' => 'Mobile', 
            ],
        ],
        'std' => [
            'desktop' => '80',
            'tablet' => '80',
            'mobile' => '80',
        ],
        'css' => [
            [
                'property' => 'padding-bottom',
                'selector' => '.{{section}} .primary56 .post56__padding',
                'unit' => '%',
                'use' => 'desktop',
            ],
            [
                'property' => 'padding-bottom',
                'selector' => '.{{section}} .primary56 .post56__padding',
                'unit' => '%',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'padding-bottom',
                'selector' => '.{{section}} .primary56 .post56__padding',
                'unit' => '%',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'desc' => 'Post ratio height/width. If any devices value missing, it will take value from bigger device.',
        'title' => 'Padding (%)',
        'condition' => [
            "layout" => [ 'grid', 'group', 'carousel' ],
            "post_style" => 'ontop',
            'ontop_height_style' => 'ratio',
        ],
    ];

    $fields[ 'ontop_height' ] = [
        'type' => 'group',
        'fields' => [
            'desktop' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '320',
                'placeholder' => 'Eg. 320',
                'name' => 'Desktop', 
            ],
            'tablet' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '320',
                'name' => 'Tablet', 
            ],
            'mobile' => [
                'type' => 'text',
                'col' => '1-3',
                'std' => '320',
                'name' => 'Mobile', 
            ],
        ],
        'desc' => 'Post fixed. If any devices value missing, it will take value from bigger device.',
        'title' => 'Post height',
        'condition' => [
            "layout" => [ 'grid', 'group', 'carousel' ],
            "post_style" => 'ontop',
            'ontop_height_style' => 'fixed',
        ],
        'std' => [
            'desktop' => '320',
            'tablet' => '320',
            'mobile' => '320',
        ],
        'css' => [
            [
                'property' => 'height',
                'selector' => '.{{section}} .primary56 .post56__height',
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'height',
                'selector' => '.{{section}} .primary56 .post56__height',
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'height',
                'selector' => '.{{section}} .primary56 .post56__height',
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    $fields[ 'ontop_overlay' ] = [
        'type' => 'color',
        'name' => 'Overlay background',
        'std' => 'rgba(0,0,0,.3)',
        'css' => [
            [
                'selector' => '.{{section}} .primary56 .post56__overlay',
                'property' => 'background',
            ]
        ],
        'condition' => [
            "layout" => [ 'grid', 'group', 'carousel' ],
            "post_style" => 'ontop',
        ],
    ];

/**
 * ALIGNMENT
 * ================================================
 */
$fields[ 'align__heading' ] = [
    'type' => 'heading',
    'heading' => 'Align',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ]
];

$fields[ 'ontop_valign' ] = [
    'type' => 'radio',
    'title' => 'Text Position',
    'options' => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std' => 'middle',
    'transport' => 'postMessage',
    'condition' => [
        "layout" => [ 'grid', 'group', 'carousel' ],
        "post_style" => 'ontop',
    ]
];

$fields[ 'align' ] = [
    'type' => 'radio',
    'title' => 'Item Align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'transport' => 'postMessage',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ]
];

$fields[ 'valign' ] = [
    'type' => 'radio',
    'title' => 'Vertical Align',
    'options' => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std' => 'top',
    'transport' => 'postMessage',
    
    'condition' => [
        "layout" => [ 'list' ],
    ]
];

/**
 * ------------------------ COL 1
 */
$fields[ 'group__heading' ] = [
    'type' => 'heading',
    'heading' => 'Group Options',
    'condition' => [
        "layout" => 'group',
    ],
];

$fields[ 'group_layout' ] = [
    'type' => 'radio_image',
    'title' => 'Group layout',
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
    'std' => '2-1',
    'condition' => [
        "layout" => 'group',
    ],
    
    'refresh' => 'primary',
];

$fields[ 'group_tabs' ] = [
    'type' => 'html',
    'std' => '
    <div class="section56__inner-tabs" data-tabs="group_tabs">
        <a class="active" data-tab="big">Big col</a>
        <a data-tab="medium">Small col</a>
        <a data-tab="small">Small col 2</a>
    </div>
    ',
    'condition' => [
        "layout" => 'group',
        // 'group_layout' => [ '3-1-1', '1-3-1', '1-1-3', '2-1-1', '1-2-1', '1-1-2' ],
    ],
];

/*
$fields[ 'group_tabs_2cols' ] = [
    'type' => 'html',
    'std' => '
    <div class="section56__inner-tabs" data-tabs='group_tabs'>
        <a class="active" data-tab="big">Big col</a>
        <a data-tab="medium">Small col</a>
        <a data-tab="small">Small col 2</a>
    </div>
    ',
    'condition' => [
        "layout" => 'group',
        'group_layout' => [ '1-1', '2-1', '1-2', '1-3', '3-1', '2-3', '3-2' ],
    ],
];
*/

$small_condition = [ "group_layout" => [ '3-1-1', '1-3-1', '1-1-3', '2-1-1', '1-2-1', '1-1-2' ] ];

foreach ( $cols as $col => $std ) {
    
    $colname = $std['title'];

    $base_condition = [
        "layout" => 'group',
    ];
    if ( 'small' == $col ) {
        $base_condition = array_merge( $base_condition, $small_condition );
    }
    
    if ( $col == 'big' || $col == 'medium' ) {
        if ( 'medium' == $col ) {
            $condition = array_merge( $base_condition, $small_condition );
        } else {
            $condition = $base_condition;
        }

        $fields[ "{$col}_number" ] = [
            'type' => 'number',
            'title' => "$colname number of posts",
            'std' => $std[ 'number' ],
            'condition' => $condition,
            'refresh' => 'primary',
            'inner_tab' => $col,
            'inner_tabs' => 'group_tabs',
        ];
    }

    $fields[ "{$col}_layout" ] = [
        'type' => 'radio_image',
        'title' => "{$colname} layout",
        'options' => [
            'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
            'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
        ],
        'std' => $std[ 'layout' ],
        
        'condition' => $base_condition,
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    $fields[ "{$col}_column" ] = [
        'type' => 'group',
        'title' => "$colname post columns",
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 1,
                'max' => 2,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 1,
                'max' => 2,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 1,
                'max' => 2,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 1,
            'tablet' => 1,
            'mobile' => 1,
        ],
        
        'condition' => $base_condition,
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    if ( 'big' == $col ) {
        $fields[ "{$col}_align" ] = [
            'type' => 'radio',
            'title' => "$colname align",
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => $std[ 'align' ],
            
            'condition' => $base_condition,
            'refresh' => 'primary',
            'inner_tab' => $col,
            'inner_tabs' => 'group_tabs',
        ];
    }

    $fields[ "{$col}_components" ] = [
        'type' => 'sortable',
        'options' => [
            'thumbnail' => 'Post Thumbnail',
            'standalone_category' => [
                'display' => 'inline',
                'name' => 'Fancy Category'
            ],
            'live' => [
                'display' => 'inline',
                'name' => 'LIVE Indicator'
            ],
            'title' => 'Post Title',
            'date' => [
                'display' => 'inline',
                'name' => 'Date'
            ],
            'author' => [
                'display' => 'inline',
                'name' => 'Author'
            ],
            'category' => [
                'display' => 'inline',
                'name' => 'Category'
            ],
            'comment' => [
                'display' => 'inline',
                'name' => 'Comment'
            ],
            'reading_time' => [
                'display' => 'inline',
                'name' => 'Read time'
            ],
            'view' => [
                'display' => 'inline',
                'name' => 'View'
            ],
            'excerpt' => 'Excerpt',
            'more' => 'ReadMore button',
            'share' => 'Social share icons',
        ],
        'std' => $std[ 'components' ],
        
        'condition' => $base_condition,
        
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',

        'refresh' => 'primary',
    ];

    $fields[ "{$col}_thumbnail" ] = [
        'type' => 'select',
        'title' => "$colname thumbnail",
        'std' => $std[ 'thumbnail' ],
        'options' => $thumbnail_select,
        
        'condition' => $base_condition,
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    $fields[ "{$col}_thumbnail_custom" ] = [
        'type' => 'group',
        'std' => [
            'width' => 480,
            'height' => 320,
        ],
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
        'desc' => 'Enter a thumbnail_name or custom size like: 420x360',
        'title' => 'Custom Thumbnail',
        
        'condition' => array_merge( $base_condition, [
            "{$col}_thumbnail" => 'custom',
        ]),

        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
        
    ];

    $fields[ "{$col}_thumbnail_rich" ] = [
        'type' => 'checkbox',
        'title' => "$colname rich thumbnail?",
        'std' => '',
        'desc' => 'If you check this, It\'ll display video/audio media for video/audio posts',

        'condition' => $base_condition,
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    if ( $col == 'medium' || $col == 'small' ) {

        $fields[ "{$col}_thumbnail_width_px" ] = [
            'type' => 'group',
            'std' => [
                'desktop' => 120,
                'tablet' => 120,
                'mobile' => 90,
            ],
            'fields' => [
                'desktop' => [
                    'name' => 'Desktop',
                    'type' => 'number',
                    'col' => '1-3',
                    'step' => 5,
                    'min' => 40,
                    'max' => 300,
                ],
                'tablet' => [
                    'name' => 'Tablet',
                    'type' => 'number',
                    'col' => '1-3',
                    'step' => 5,
                    'min' => 40,
                    'max' => 300,
                ],
                'mobile' => [
                    'name' => 'Mobile',
                    'type' => 'number',
                    'col' => '1-3',
                    'step' => 5,
                    'min' => 40,
                    'max' => 300,
                ],
            ],
            'css' => [
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
                    'property' => 'width',
                    'unit' => 'px',
                    'use' => 'desktop',
                ],
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
                    'property' => 'width',
                    'unit' => 'px',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
                    'property' => 'width',
                    'unit' => 'px',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
        
                /**
                 * TEXT
                 */
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
                    'property' => 'width',
                    'unit' => 'px',
                    'value_pattern' => 'calc(100% - $)',
                    'use' => 'desktop',
                ],
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
                    'property' => 'width',
                    'unit' => 'px',
                    'value_pattern' => 'calc(100% - $)',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'selector' => ".{{section}} .primary56 .row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
                    'property' => 'width',
                    'unit' => 'px',
                    'value_pattern' => 'calc(100% - $)',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
            ],
            'title' => 'Thumbnail width',
            'condition' => $base_condition,

            'inner_tab' => $col,
            'inner_tabs' => 'group_tabs',
            
        ];

    }

    $fields[ "{$col}_excerpt_length" ] = [
        'type' => 'number',
        'title' => "$colname excerpt length",
        'std' => $std[ 'excerpt_length' ],
        'min' => 0,
        'max' => 60,
        'step' => 1,
        'condition' => $base_condition,
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    $fields[ "{$col}_more_style" ] = [
        'type' => 'radio_image',
        'options' => [
            'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
            'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
            'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
            'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
            'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
            'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
        ],
        'title' => "$colname ReadMore style",
        'std' => $std[ 'more_style' ],
        'condition' => $base_condition,
        
        'refresh' => 'primary',
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    $fields[ "{$col}_title_typography" ] = [
        'type' => 'group',
        'title' => "$colname title typography",
        'condition' => $base_condition,

        'fields' => $typo_fields,
        'css' => fox56_customize_builder_typo_css( '.row56__col--' . $col . ' .title56' ),
        
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

    $fields[ "{$col}_excerpt_typography" ] = [
        'type' => 'group',
        'title' => "$colname excerpt typography",
        'condition' => $base_condition,

        'fields' => $typo_fields,
        'css' => fox56_customize_builder_typo_css( '.row56__col--' . $col . ' .excerpt56' ),
        
        'inner_tab' => $col,
        'inner_tabs' => 'group_tabs',
    ];

}

/**
 * SPACING
 * ========================================
 */
$fields[ 'gap__heading' ] = [
    'type' => 'heading',
    'heading' => 'Gap / Spacing',
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'carousel', 'group' ]
    ],

    // finish the tab
    'inner_tab' => false,
    'inner_tabs' => false,
];

$fields[ 'carousel_h_spacing' ] = [
    'type' => 'group',
    'condition' => [ 'layout' => 'carousel' ],
    'id' => 'carousel_item_spacing',
    'title' => 'Gap between items',
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
            'selector' => ".{{section}} .primary56 .carousel-cell",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'padding',
            'value_pattern' => '0 $',
            'selector' => ".{{section}} .primary56 .carousel-cell",
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'property' => 'padding',
            'value_pattern' => '0 $',
            'selector' => ".{{section}} .primary56 .carousel-cell",
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],


        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".{{section}} .primary56 .carousel56__container",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".{{section}} .primary56 .carousel56__container",
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'property' => 'margin',
            'value_pattern' => '0 -$',
            'selector' => ".{{section}} .primary56 .carousel56__container",
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],
        
    ]
];

// col gap + layout: grid, list, masonry, group
$fields[ 'h_spacing' ] = [
    'type' => 'group',
    'title' => 'Gap between columns',
    'choices' => [
        'min' => 0,
        'max' => 100,
        'step' => 2,
    ],
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
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-left',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-left',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-left',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'padding-right',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-right',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-right',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'value_pattern' => 'calc($/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-left',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-left',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-left',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-right',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-right',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-right',
            'selector' => ".{{section}} .primary56 .main-masonry",
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
            'selector' => ".{{section}} .primary56 .row56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .row56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .row56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        /**
         * sep (list, grid, group)
         */
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56__sep",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56__sep",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'column-gap',
            'selector' => ".{{section}} .primary56 .blog56__sep",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * vertical border move right little bit
         */
        [
            'property' => 'transform',
            'selector'=> ".{{section}} .primary56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'transform',
            'selector'=> ".{{section}} .primary56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'transform',
            'selector'=> ".{{section}} .primary56 .blog56__sep__line",
            'value_pattern' => 'translate( calc($/2), 0 )',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        // post border top: left, right to make them fit
        /*
        [
            'property' => 'left',
            'selector'=> ".{{section}} .primary56 .post56__sep__line",
            'value_pattern' => 'calc(-$px/2)',
            'units' => '',
        ],
        [
            'property' => 'right',
            'selector'=> ".{{section}} .primary56 .post56__sep__line",
            'value_pattern' => 'calc(-$px/2)',
            'units' => '',
        ],
        */
    ],
    
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ]
    ],
];

// row gap + layout: grid, list, masonry, group
// for group: this applies to its inner posts
$fields[ "v_spacing" ] = [
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
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".{{section}} .primary56 .blog56--grid",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG LIST
         */
        [
            'property' => 'row-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'row-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'row-gap',
            'selector' => ".{{section}} .primary56 .blog56--list",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG MASONRY
         */
        [
            'property' => 'padding-top',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-top',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-top',
            'selector' => ".{{section}} .primary56 .masonry-cell",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .main-masonry",
            'value_pattern' => '-$',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BLOG GROUP
         */
        /*
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .row56__col + .row56__col",
            'use' => 'desktop',
            'unit' => 'px',
        ],
        
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .row56__col + .row56__col",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        */
        
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .row56__col + .row56__col",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BORDER TOP MOVED
         */
        [
            'property' => 'top',
            'selector' => ".{{section}} .primary56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'top',
            'selector' => ".{{section}} .primary56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'top',
            'selector' => ".{{section}} .primary56 .post56__sep__line",
            'value_pattern' => 'calc(-$/2)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ]
    ],
    
];

$fields[ 'component_spacing' ] = [
    'type' => 'group',
    'title' => 'Component spacing',
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
            'selector' => ".{{section}} .primary56 .component56 + .component56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .component56 + .component56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => ".{{section}} .primary56 .component56 + .component56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'carousel', 'group' ]
    ],
];

$fields[ 'thumbnail_margin_bottom' ] = [
    'type' => 'group',
    'title' => 'Thumbnail gap bottom',
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
            'selector' => ".{{section}} .primary56 .thumbnail56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .thumbnail56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .thumbnail56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'carousel', 'group' ],
        "post_style" => 'normal',
    ],
];

$fields[ 'title_margin_bottom' ] = [
    'type' => 'group',
    'title' => 'Title margin bottom',
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
            'selector' => ".{{section}} .primary56 .title56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .title56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .title56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'carousel', 'group' ]
    ],
];

$fields[ 'excerpt_margin_bottom' ] = [
    'type' => 'group',
    'title' => 'Excerpt margin bottom',
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
            'selector' => ".{{section}} .primary56 .excerpt56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .excerpt56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => ".{{section}} .primary56 .excerpt56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'carousel', 'group' ]
    ],
];

/* BORDER
================================================ */
$fields[ 'border__heading' ] = [
    'type' => 'heading',
    'heading' => 'Border / Sep',
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ]
    ]
];

// vertical border
$fields[ 'v_sep' ] = [
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
            'selector' => ".{{section}} .primary56 .blog56__sep__line",
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ]
    ]
];

$fields[ 'v_sep_color' ] = [
    'type' => 'color',
    'title' => 'Vertical border color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".{{section}} .primary56 .blog56__sep__line",
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ],
    ],
];

// if group, it applies to sub-items
$fields[ 'h_sep' ] = [
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
            'selector' => ".{{section}} .primary56 .post56__sep__line",
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ],
    ]
    
];

$fields[ 'h_sep_color' ] = [
    'type' => 'color',
    'title' => 'Horizontal border color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".{{section}} .primary56 .post56__sep__line",
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group' ],
    ],
];

/* POST BOX
================================================ */
$fields[ 'postbox__heading' ] = [
    'type' => 'heading',
    'heading' => 'Post Box',
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group', 'carousel' ],
    ]
];

$fields[ 'item_border_radius' ] = [
    'type' => 'text',
    'std' => '0',
    'id' => "item_border_radius",
    'title' => 'Post box border radius',
    'css' => [
        [
            'property' => 'border-radius',
            'selector' => ".{{section}} .primary56 .post56",
            'unit' => 'px',
        ],
        /*
        this affect thumbnail radius option
        [
            'property' => 'border-radius',
            'selector' => ".{{section}} .primary56 .post56--normal > .thumbnail56",
            'value_pattern' => '$px $px 0 0',
            'units' => '',
        ]
        */
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group', 'carousel' ],
    ],
];

$fields[ 'item_background' ] = [
    'type' => 'color',
    'title' => 'Post box background',
    'css' => [
        [
            'property' => 'background-color',
            'selector' => ".{{section}} .primary56 .post56",
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group', 'carousel' ],
    ],
    
];

$fields[ 'item_shadow' ] = [
    'type' => 'number',
    'title' => 'Post box shadow',
    'std' => 0,
    'css' => [
        [
            'property' => 'box-shadow',
            'selector' => ".{{section}} .primary56 .post56",
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group', 'carousel' ],
    ],
];

$fields[ 'item_padding' ] = [
    'type' => 'group',
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
            'selector' => ".{{section}} .primary56 .post56__text",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding',
            'selector' => ".{{section}} .primary56 .post56__text",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding',
            'selector' => ".{{section}} .primary56 .post56__text",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'masonry', 'list', 'group', 'carousel' ],
    ],
    
];

/**
 * SIDEBAR
 * ========================================================================================
 */
$fields[ 'main_sidebar' ] = [
    'type' => 'select',
    'name' => 'Choose Sidebar',
    'options' => $sidebar_list,
    'std' => '',
    'desc' => 'Go to <a href="' . admin_url( 'admin.php?page=sidebar-manager' ) . '" target="_blank">Dashboard &raquo; Fox Magazine &raquo; Sidebar Manager</a> to create your custom sidebar then it\'ll appear in this list',

    'condition' => [
        'layout' => 'sidebar',
    ]
];
$fields[ 'sidebar_layout' ] = [
    'name'    => 'Widgets Layout',
    'type'     => 'radio_image',
    'options'   => [
        '1' => get_template_directory_uri() . '/inc/customize/images/1-cols.jpg',
        '2' => get_template_directory_uri() . '/inc/customize/images/2-cols.jpg',
        '3' => get_template_directory_uri() . '/inc/customize/images/3-cols.jpg',
        '4' => get_template_directory_uri() . '/inc/customize/images/4-cols.jpg',
    ],
    'std'       => '3',
    'desc'      => 'If you have 3 columns, please use 3 widgets in your sidebar',

    'condition' => [
        'layout' => 'sidebar',
    ]
];

/**
 * PAGE
 * ========================================================================================
 */
if ( ! is_customize_preview() ) {
    $page_arr = [];
} else {
    // pages
    $page_arr = [ '' => '--- NONE ---'];
    $pages = get_posts( 'posts_per_page=-1&post_type=page&orderby=name&order=asc' );
    foreach ( $pages as $page ) {
        $page_arr[ 'page_' . $page->ID ] = $page->post_title;
    }
}
$fields[ 'page' ] = [
    'name' => 'Choose page content of',
    'type' => 'select',
    'options' => $page_arr,
    'std' => '',

    'condition' => [
        'layout' => 'page',
    ],
];

 /**
 * HTML
 * ========================================================================================
 */
$fields[ 'html' ] = [
    'type' => 'textarea',
    'name' => 'Enter Code',
    'desc' => 'You can enter shortcode or any HTML code',
    'placeholder' => 'Eg. [author_grid number=3 column=3 /]',

    'condition' => [
        'layout' => 'html',
    ],
];