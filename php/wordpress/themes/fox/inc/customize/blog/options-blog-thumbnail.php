<?php
$fox56_customize->add_section( 'blog_thumbnail', [
    'title' => 'Thumbnail',
    'panel' => 'blog',
]);

/* ----------------------------------       archive */
$fox56_customize->add_field([
    'hint' => 'general thumbnail',
    'type' => 'radio_image',
    'id' => 'thumbnail',
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
    'name' => 'Thumbnail',
    'section' => 'blog_thumbnail',

    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'hint' => 'custom thumbnail',
    'type' => 'group',
    'id' => 'thumbnail_custom',
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
    'condition' => [ 'thumbnail' => 'custom' ],
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'hint' => 'video thumbnail',
    'type' => 'checkbox',
    'id' => 'thumbnail_rich',
    'name' => 'Rich Thumbnail: Video/Audio',
    'desc' => 'If you check this, It\'ll display video/audio media for video/audio posts',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'placeholder_thumbnail',
    'name' => 'Default Thumbnail',
    'desc' => 'This is placeholder thumbnail in case your post doesn\'t have one.',
    'hint' => 'default thumbnail',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'thumbnail_border',
    'fields' => [
        'top' => [
            'type' => 'number',
            'name' => 'Top',
            'col' => '1-5',
        ],
        'right' => [
            'type' => 'number',
            'name' => 'Right',
            'col' => '1-5',
        ],
        'bottom' => [
            'type' => 'number',
            'name' => 'Bottom',
            'col' => '1-5',
        ],
        'left' => [
            'type' => 'number',
            'name' => 'Left',
            'col' => '1-5',
        ],
        'color' => [
            'type' => 'color',
            'name' => 'Color',
            'col' => '1-5',
        ]
    ],
    'css' => [
        [
            'selector' => '.thumbnail56 img',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.thumbnail56 img',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => '.thumbnail56 img',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.thumbnail56 img',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => '.thumbnail56 img',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
    'name' => 'Thumbnail Border',
    'hint' => 'thumbnail border',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_components',
    'type' => 'multicheckbox',
    'title' => 'Thumbnail stuffs',
    'std' => [],
    'options' => [
        'format_indicator' => 'Format Indicator',
        'caption' => 'Caption',
        'review' => 'Review Sccore',
        'view' => 'Post view',
    ],
    'refresh' => 'blog',
    'hint' => 'thumbnail components',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_position',
    'type' => 'radio',
    'title' => 'Post list: thumbnail position',
    'std' => 'left',
    'options' => [
        'left' => 'Left',
        'right' => 'Right',
        'alternative' => 'Alternative',
    ],
    'refresh' => 'blog',
    'hint' => 'thumbnail align left/right',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_width_type',
    'type' => 'radio',
    'title' => 'Post list: Thumbnail width',
    'options' => [
        'percent' => 'Percent (%)',
        'pixel' => 'Pixel (px)',
    ],
    'std' => 'percent',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_width_percent',
    'type' => 'group',
    'title' => 'Post list: Thumbnail width (%)',
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
            'selector' => ".post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-percent .thumbnail56",
            'property' => 'width',
            'unit' => '%',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-percent .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => '%',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
    'condition' => [
        "thumbnail_width_type" => 'percent',
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_width_px',
    'type' => 'group',
    'title' => 'Post list: Thumbnail width (px)',
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
            'selector' => ".post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-pixel .thumbnail56",
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * TEXT
         */
        [
            'selector' => ".post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-pixel .thumbnail56 + .post56__text",
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'condition' => [
        "thumbnail_width_type" => 'pixel',
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_text_gap',
    'type' => 'group',
    'title' => 'Post list: Thumbnail - Text gap',

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
            'selector' => ".post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-left .thumbnail56",
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * PADDING LEFT
         */
        [
            'selector' => ".post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => ".post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".post56--list--thumb-right .thumbnail56",
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_border_radius',
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
            'selector' => ".thumbnail56 img, .thumbnail56__overlay",
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_hover_effect',
    'type' => 'select',
    'std' => 'none',
    'options' => [
        'none'      => 'None',
        'fade'      => 'Image Fade',
        'grayscale' => 'Grayscale',
        'sepia'     => 'Sepia',
        'dark'      => 'Dark',
        'letter'    => 'Title First Letter',
        'zoomin'    => 'Image Zoom In',
        'logo'      => 'Custom Logo',
    ],
    'title' => 'Thumbnail hover effect',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_hover_overlay',
    'type' => 'color',
    'std' => '#000',
    'name' => 'Hover Overlay Color',
    'css' => [
        [
            'selector' => '.thumbnail56__overlay',
            'property' => 'background',
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_hover_logo',
    'type' => 'image',
    'title' => 'Thumbnail logo',
    'condition' => [
        "thumbnail_hover_effect" => 'logo',
    ],
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_hover_logo_width',
    'type' => 'number',
    'title' => 'Thumbnail logo width (%)',
    'std' => 40,
    'min' => 10,
    'max' => 100,
    'step' => 5,
    'css' => [
        [
            'selector' => ".thumbnail56 .thumbnail56__hover-img",
            'property' => 'width',
            'unit' => '%',
        ],
    ],
    'condition' => [
        "thumbnail_hover_effect" => 'logo',
    ],
]);

$fox56_customize->add_field([
    'id' => 'thumbnail_showing_effect',
    'type' => 'select',
    'std' => 'none',
    'name' => 'Showing effect',
    'options' => [
        'none'      => 'None',
        'fade'      => 'Image Fade',
        'slide'     => 'Slide',
        'popup'     => 'Pop up',
        'zoomin'    => 'Zoom In',
    ],
]);