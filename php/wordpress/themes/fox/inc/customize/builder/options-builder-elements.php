<?php
$fields[ 'components__heading' ] = [
    'type' => 'heading',
    'heading' => 'Components',
    'tab' => 'elements',
    'condition' => [ 'layout' => [
        'grid', 'list', 'masonry', 'carousel',
    ] ]
];

/**
 * COMPONENTS
 */
$fields[ 'components' ] = [
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
    'title' => 'Components to display',
    'std' => [ 'thumbnail', 'standalone_category', 'live', 'title', 'date', 'excerpt' ],
    
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],

    'refresh' => 'primary',
];

/**
 * -----------------------------------------------      THUMBNAIL
 */
$fields[ 'thubnail__heading' ] = [
    'type' => 'heading',
    'heading' => 'Thumbnail',

    'inner_tabs' => false,
    'inner_tab' => false,
];

$fields[ 'thumbnail' ] = [
    'type' => 'radio_image',
    'std' => 'thumbnail-medium',
    'options' => $thumbnail_options,
    'title' => 'Thumbnail',
    'refresh' => 'primary',

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'thumbnail_custom' ] = [
    'type' => 'group',
    'std' => [
        'width' => 400,
        'height' => 300,
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
    'title' => 'Custom Thumbnail',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
        "thumbnail" => 'custom',
    ],
    'refresh' => 'primary',
];

$fields[ 'thumbnail_rich' ] = [
    'type' => 'checkbox',
    'title' => 'Rich thumbnail if possible?',
    'desc' => 'If you check this, It\'ll display video/audio media for video/audio posts',
    'refresh' => 'primary',

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'thumbnail_components' ] = [
    'type' => 'multicheckbox',
    'title' => 'Thumbnail stuffs',
    'std' => [ 'format_indicator' ],
    'options' => [
        'format_indicator' => 'Format Indicator',
        'caption' => 'Caption',
        'review' => 'Review Sccore',
        'view' => 'Post view',
    ],
    
    'refresh' => 'primary',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'thumbnail_position' ] = [
    'type' => 'radio',
    'title' => 'Post list: thumbnail position',
    'std' => 'left',
    'options' => [
        'left' => 'Left',
        'right' => 'Right',
        'alternative' => 'Alternative',
    ],
    'refresh' => 'primary',
    'condition' => [
        "layout" => [ 'list', 'group' ],
    ],
];

$fields[ 'thumbnail_width_type' ] = [
    'type' => 'radio',
    'title' => 'Thumbnail width',
    'options' => [
        'percent' => 'Percent (%)',
        'pixel' => 'Pixel (px)',
    ],
    'std' => 'percent',
    
    'refresh' => 'primary',
    'condition' => [
        "layout" => 'list',
    ],
];

$fields[ 'thumbnail_width_percent' ] = [
    'type' => 'group',
    'title' => 'Thumbnail width (%)',
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
    'range' => [
        'desktop' => [ 40, 20, 80 ],
        'tablet' => [ 40, 20, 80 ],
        'mobile' => [ 30, 20, 80 ],
    ],
    'css' => [
        /**
         * THUMBNAIL
         */
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
    'condition' => [
        "layout" => 'list',
        "thumbnail_width_type" => 'percent',
    ],
];

$fields[ 'thumbnail_width_px' ] = [
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
    'range' => [
        'desktop' => [ 400, 40, 1000 ],
        'tablet' => [ 300, 40, 800 ],
        'mobile' => [ 100, 30, 160 ],
    ],
    'css' => [
        /**
         * THUMBNAIL
         */
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "layout" => 'list',
        "thumbnail_width_type" => 'pixel',
    ],
];

$fields[ 'thumbnail_text_gap' ] = [
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
            'selector' => ".{{section}} .primary56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * PADDING LEFT
         */
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "layout" => [ 'list' ]
    ],
];

$fields[ 'thumbnail_border_radius' ] = [
    'type' => 'select',
    'std' => '0px',
    'options' => [
        '0px' => '0',
        '2px' => '2',
        '4px' => '4',
        '6px' => '6',
        '10px' => '10',
        '30px' => '30',
        '50%' => 'Circle',
    ],
    'title' => 'Thumbnail Roundness',
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .thumbnail56 img",
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'thumbnail_hover_effect' ] = [
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'none'      => 'None',
        'fade'      => 'Image Fade',
        'grayscale' => 'Grayscale',
        'sepia'     => 'Sepia',
        'dark'      => 'Dark',
        'letter'    => 'Title First Letter',
        'zoomin'    => 'Image Zoom In',
        'logo'      => 'Custom Logo',
    ],
    'std' => '',
    'title' => 'Thumbnail hover effect',
    'refresh' => 'primary',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'thumbnail_hover_logo' ] = [
    'type' => 'image',
    'title' => 'Thumbnail logo',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
        "thumbnail_hover_effect" => 'logo',
    ],
    'refresh' => 'primary',
];

$fields[ 'thumbnail_hover_logo_width' ] = [
    'type' => 'number',
    'title' => 'Thumbnail logo width (%)',
    'std' => 40,
    'min' => 10,
    'max' => 100,
    'step' => 5,
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .thumbnail56 .thumbnail56__hover-img",
            'property' => 'width',
            'unit' => '%',
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
        "thumbnail_hover_effect" => 'logo',
    ],
];

/**
 * -----------------------------------------------      TITLE
 */
$fields[ 'title__heading' ] = [
    'type' => 'heading',
    'heading' => 'Post Title',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'title_tag' ] = [
    'id' => "title_tag",
    'type' => 'radio',
    'options' => [
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
    ],
    'std' => 'h2',
    'title' => 'Title heading',
    'refresh' => 'primary',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'title_color' ] = [
    'id' => 'title_color',
    'type' => 'color',
    'title' => 'Title color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .post56 .title56 a",
            'property' => 'color',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'title_hover_color' ] = [
    'type' => 'color',
    'title' => 'Title hover color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .post56 .title56 a:hover",
            'property' => 'color',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'title_typography' ] = [
    'type' => 'group',
    'title' => "Title Typography",
    'fields' => $typo_fields,
    'css' => fox56_customize_builder_typo_css( '.title56' ),
    "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
];

/**
 * -----------------------------------------------      EXCERPT
 */
$fields[ 'excerpt__heading' ] = [
    'type' => 'heading',
    'heading' => 'Post Excerpt',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'excerpt_content' ] = [
    'type' => 'radio',
    'title' => 'Excerpt/content?',
    'options' => [
        'excerpt' => 'Excerpt',
        'content' => 'Content',
    ],

    'std' => 'excerpt',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'excerpt_length' ] = [
    'type' => 'number',
    'title' => 'Excerpt length',
    
    'std' => 24,
    'min' => 0,
    'max' => 60,
    'step' => 1,
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'excerpt_color' ] = [
    'type' => 'color',
    'title' => 'Excerpt color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .post56 .excerpt56",
            'property' => 'color',
        ],
    ],
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'excerpt_typography' ] = [
    'type' => 'group',
    'title' => "Excerpt Typography",
    'fields' => $typo_fields,
    'css' => fox56_customize_builder_typo_css( '.excerpt56' ),
    "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
];

$fields[ 'more_style' ] = [
    'type' => 'radio_image',
    'title' => 'More button style',
    
    'options' => [
        'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
        'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
        'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
        'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
        'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
        'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
    ],
    'std' => 'primary',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'more_typography' ] = [
    'type' => 'group',
    'title' => "More Typography",
    'fields' => $typo_fields,
    'css' => fox56_customize_builder_typo_css( '.readmore56 a' ),
    "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
];

/**
 * -----------------------------------------------      META
 */
$fields[ 'meta__heading' ] = [
    'type' => 'heading',
    'heading' => 'Post Meta',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel' ],
    ],
];

$fields[ 'date_format' ] = [
    'type' => 'text',
    'title' => 'Date format',
    'desc' => 'Learn about date format <a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank">here</a>. By default, It will display date based on your general date format setting.',
    
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'date_type' ] = [
    'type' => 'radio',
    'title' => 'Date type',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    'refresh' => 'primary',
    'options' => [
        '' => 'Default',
        'publish' => 'Published date',
        'updated' => 'Updated date',
    ],
    'std' => '',
];

$fields[ 'author_avatar' ] = [
    'type' => 'checkbox',
    'title' => 'Author avatar?',
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'author_avatar_size' ] = [
    'type' => 'group',
    'title' => 'Author avatar size',
    'css' => [
        [
            'selector' => ".{{section}} .primary56 .meta56__author img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".{{section}} .primary56 .meta56__author img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".{{section}} .primary56 .meta56__author img",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'max' => 100,
            'min' => 20,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'max' => 100,
            'min' => 20,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'max' => 100,
            'min' => 10,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 32,
        'tablet' => 28,
        'mobile' => 24,
    ],
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'category_tax' ] = [
    'type' => 'text',
    'title' => 'Custom Taxonomy in place of category',
    'desc' => 'Please use precisely the taxonomy slug, eg. post_tag, product_cat or my_movie',
    
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    'refresh' => 'primary',
];

$fields[ 'meta_color' ] = [
    'type' => 'color',
    'title' => 'Post meta color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56  .post56 .meta56",
            'property' => 'color',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    
];

$fields[ 'meta_link_color' ] = [
    'type' => 'color',
    'title' => 'Meta link color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56  .post56 .meta56 a",
            'property' => 'color',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    
];

$fields[ 'meta_link_hover_color' ] = [
    'type' => 'color',
    'title' => 'Meta link hover color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56  .post56 .meta56 a:hover",
            'property' => 'color',
        ],
    ],

    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
    
];

$fields[ 'standalone_category_color' ] = [
    'type' => 'color',
    'title' => 'Fancy category color',
    'css' => [
        [
            'selector' => ".{{section}} .primary56  .post56 .meta56__category--fancy a",
            'property' => 'color',
        ],
    ],
    
    'condition' => [
        "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
    ],
];

$fields[ 'meta_typography' ] = [
    'type' => 'group',
    'title' => "Meta Typography",
    'fields' => $typo_fields,
    'css' => fox56_customize_builder_typo_css( '.meta56' ),
    "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
];

$fields[ 'standalone_category_typography' ] = [
    'type' => 'group',
    'title' => "Fancy Category Typography",
    'fields' => $typo_fields,
    'css' => fox56_customize_builder_typo_css( '.meta56__category--fancy' ),
    "layout" => [ 'grid', 'list', 'masonry', 'carousel', 'group' ],
];