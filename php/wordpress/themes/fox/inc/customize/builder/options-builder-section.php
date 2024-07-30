<?php
/* SECTION
======================================================================== */
$fields[ 'section__heading' ] = [
    'type' => 'heading',
    'heading' => 'Section',
    'tab' => 'section',
];

$fields[ 'hide' ] = [
    'type' => 'checkbox',
    'title' => 'Hide this section',
    // 'transport' => 'postMessage',
    
    'inner_tabs' => false,
    'inner_tab' => false,
];

$fields[ 'class' ] = [
    'type' => 'text',
    'title' => 'Section CSS Class',
    'desc' => 'Only letters, number, no spacing, eg. my-section__1, Section-most-popular_3. It takes effect only after closing the Customizer.',
    
    // 'transport' => 'postMessage',
];

$fields[ 'id' ] = [
    'type' => 'text',
    'title' => 'Section ID',
    'desc' => 'Only letters, number, no spacing, eg. my-section__1, Section-most-popular_3. It takes effect only after closing the Customizer.',

    // 'transport' => 'postMessage',
];

$fields[ 'after_code' ] = [
    'type' => 'textarea',
    'title' => 'After Section Custom Code',
    'desc' => 'You can enter [button /] shortcode here for instance.',
];

$fields[ 'background_color' ] = [
    'type' => 'color',
    'title' => 'Section background',
    'css' => [
        [
            'selector' => '.{{section}}',
            'property' => 'background-color',
        ]
    ]
];

$fields[ 'container_background_color' ] = [
    'type' => 'color',
    'title' => 'Inner background',
    'css' => [
        [
            'selector' => '.{{section}} .container--main',
            'property' => 'background-color',
        ]
    ]
];

$fields[ 'stretch' ] = [
    'type' => 'radio_image',
    'title' => 'Section stretch',
    'options'=> [
        'fullwidth' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'narrow' => get_template_directory_uri() . '/inc/customize/images/narrow.jpg',
    ],
    'std' => 'content',
    'transport' => 'postMessage',
];

$fields[ 'padding' ] = [
    'type' => 'group',
    'title' => 'Padding',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Desktop',
            'placeholder' => 'Eg. 10px',
        ],
        'tablet' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Tablet',
        ],
        'mobile' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Mobile',
        ],
    ],
    'css' => [
        [
            'use' => 'desktop',
            'property' => 'padding',
            'selector' => '.{{section}}',
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'padding',
            'unit' => 'px',
            'selector' => '.{{section}}',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'use' => 'mobile',
            'property' => 'padding',
            'unit' => 'px',
            'selector' => '.{{section}}',
            'media_query' => $fox56_customize->tablet,
        ],
    ],
    'std' => [
    ]
];

$fields[ 'margin' ] = [
    'type' => 'group',
    'title' => 'Margin',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Desktop',
            'placeholder' => 'Eg. 10px',
        ],
        'tablet' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Tablet',
        ],
        'mobile' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Mobile',
        ],
    ],
    'css' => [
        [
            'use' => 'desktop',
            'property' => 'margin-top',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'unit' => 'px',
        ],
        [
            'use' => 'desktop',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'margin-top',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'mobile',
            'property' => 'margin-top',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],
        [
            'use' => 'mobile',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],
    ],
    'std' => [
    ]
];

$fields[ 'margin_bottom' ] = [
    'type' => 'group',
    'title' => 'Margin Bottom',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Desktop',
            'placeholder' => 'Eg. 10px',
        ],
        'tablet' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Tablet',
        ],
        'mobile' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Mobile',
        ],
    ],
    'css' => [
        [
            'use' => 'desktop',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'mobile',
            'property' => 'margin-bottom',
            'selector' => '.builder56 .builder56__section.{{section}}',
            'media_query' => $fox56_customize->mobile,
            'unit' => 'px',
        ],
    ],
    'std' => [
    ]
];

$fields[ 'border' ] = [
    'type' => 'group',
    'title' => 'Border',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Desktop',
            'placeholder' => 'Eg. 1px',
        ],
        'tablet' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        'mobile' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        'color' => [
            'type' => 'color',
            'col' => '1-1',
            'name' => 'Border color',
        ]
    ],
    'css' => [
        [
            'use' => 'desktop',
            'property' => 'border-width',
            'selector' => '.{{section}}',
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'border-width',
            'selector' => '.{{section}}',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'mobile',
            'property' => 'border-width',
            'selector' => '.{{section}}',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'color',
            'property' => 'border-color',
            'selector' => '.{{section}}',
        ],
    ],
    'std' => [
    ]
];

$fields[ 'container_border' ] = [
    'type' => 'group',
    'title' => 'Container Border',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Desktop',
            'placeholder' => 'Eg. 1px',
        ],
        'tablet' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        'mobile' => [
            'type' => 'text',
            'col' => '1-3',
            'name' => 'Mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        'color' => [
            'type' => 'color',
            'col' => '1-1',
            'name' => 'Border color',
        ]
    ],
    'css' => [
        [
            'use' => 'desktop',
            'property' => 'border-width',
            'selector' => '.{{section}} .container--main',
            'unit' => 'px',
        ],
        [
            'use' => 'tablet',
            'property' => 'border-width',
            'selector' => '.{{section}} .container--main',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'mobile',
            'property' => 'border-width',
            'selector' => '.{{section}} .container--main',
            'media_query' => $fox56_customize->tablet,
            'unit' => 'px',
        ],
        [
            'use' => 'color',
            'property' => 'border-color',
            'selector' => '.{{section}} .container--main',
        ],
    ],
    'std' => [
    ]
];

$fields[ 'responsiveness' ] = [
    'type' => 'multicheckbox',
    'std' => [
        'desktop', 'tablet', 'mobile'
    ],
    'options' => [
        'desktop' => 'Desktop',
        'tablet' => 'Tablet',
        'mobile' => 'Mobile',
    ],
    'title' => 'Visibility',
    'transport' => 'postMessage',
];

/* SIDEBAR
======================================================================== */
$fields[ 'sidebar__heading' ] = [
    'type' => 'heading',
    'heading' => 'Sidebar',
];

$fields[ 'sidebar' ] = [
    'type' => 'select',
    'std' => '',
    'options' => $sidebar_list,
    'title' => 'Sidebar',
    'refresh' => 'secondary',
];

$fields[ 'sidebar_position' ] = [
    'type' => 'radio',
    'std' => 'right',
    'options' => [
        'left' => 'Left',
        'right' => 'Right',
    ],
    'title' => 'Sidebar position',
];

$fields[ 'sidebar_sticky' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Sidebar sticky?',
    'desc' => 'You will see "Sticky sidebar" takes action when close the Customizer',
];

$fields[ 'sidebar_width'] = [
    'type' => 'text',
    'std' => '260px',
    'title' => 'Sidebar width',

    'css' => [
        [
            'property' => 'width',
            'unit' => 'px',
            'selector' => ".builder56 .{{section}} .secondary56",
            'media_query' => '@media only screen and (min-width: 840px)',
        ],
        [
            'property' => 'width',
            'unit' => 'px',
            'selector' => ".builder56 .{{section}}.hassidebar > .container > .primary56",
            'value_pattern' => 'calc(100% - $)',
            'media_query' => '@media only screen and (min-width: 840px)'
        ]
    ],
];

$fields[ 'sidebar_main_sep' ] = [
    'type' => 'radio',
    'std' => '0px',
    'options' => [
        '0px' => 'No',
        '1px' => 'Yes',
    ],
    'title' => 'Sidebar - Content separator border',
    'css' => [
        [
            'property' => 'border-left-width',
            'selector' => ".builder56 .{{section}} .secondary56__sep",
        ]
    ],
];

$fields[ 'sidebar_main_sep_color' ] = [
    'type' => 'color',
    'title' => 'Sep color',
    'css' => [
        [
            'property' => 'border-color',
            'selector' => ".builder56 .{{section}} .secondary56__sep",
        ]
    ],
];

/* HEADING
======================================================================== */
$fields[ 'heading__heading' ] = [
    'type' => 'heading',
    'heading' => 'Heading',
    'tab' => 'section',
];

$fields[ 'heading_tabs' ] = [
    'type' => 'html',
    'std' => '
    <div class="section56__inner-tabs" data-tabs="heading">
        <a class="active" data-tab="heading">Heading</a>
        <a data-tab="link">Link</a>
    </div>
    ',
];

$fields[ 'heading' ] = [
    'type' => 'text',
    'name' => 'Heading',
    'placeholder' => 'My section',
    'refresh' => 'heading',

    'inner_tabs' => 'heading',
    'inner_tab' => 'heading',
];

$fields[ 'heading_empty' ] = [
    'type' => 'checkbox',
    'name' => 'Empty heading?',
    'desc' => 'This option allows you to enable an empty heading but still keep its decoration (ie. lines)',
    'refresh' => 'heading',
];

$fields[ 'heading_style' ] = [
    'type' => 'select',
    'name' => 'Style',
    'options' => [
        'plain' => 'Plain',
        'border-top' => 'Border top',
        'border-bottom' => 'Border bottom',
        'middle-line' => 'Line middle',
        'border-around' => 'Border around',
        'diagonal-stripe' => 'Diagonal Stripe',
        'pixelate-dots' => 'Pixelate dots',
    ],
    'std' => 'middle-line',
    'refresh' => 'heading',

    'inner_tabs' => 'heading',
    'inner_tab' => 'heading',
];

$fields[ 'heading_padding' ] = [
    'type' => 'group',
    'name' => 'Padding',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'text',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .heading56',
            'property' => 'padding',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56',
            'property' => 'height',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56',
            'property' => 'height',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => '',
        'tablet' => '',
        'mobile' => '',
    ]
];

$fields[ 'heading_border_width' ] = [
    'type' => 'group',
    'name' => 'Border thickness',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '2-5',
            'max' => 50,
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '2-5',
            'max' => 50,
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-5',
            'max' => 50,
        ],
    ],
    'std' => [
        'desktop' => 3,
        'tablet' => 2,
        'mobile' => 2,
    ],
    'css' => [

        /**
         * MIDDLE LINE
         */
        [
            'selector' => '.builder56 .{{section}} .heading56--middle-line .heading56__line',
            'property' => 'height',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--middle-line .heading56__line',
            'property' => 'height',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--middle-line .heading56__line',
            'property' => 'height',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BORDER TOP
         */
        [
            'selector' => '.builder56 .{{section}} .heading56--border-top',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-top',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-top',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BORDER BOTTOM
         */
        [
            'selector' => '.builder56 .{{section}} .heading56--border-bottom',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-bottom',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-bottom',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        /**
         * BORDER AROUND
         */
        [
            'selector' => '.builder56 .{{section}} .heading56--border-around .heading56__text',
            'property' => 'border-width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-around .heading56__text',
            'property' => 'border-width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .heading56--border-around .heading56__text',
            'property' => 'border-width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ]
];

$fields[ 'heading_stretch' ] = [
    'type' => 'radio',
    'name' => 'Stretch',
    'options' => [
        'half' => 'Half',
        'content' => 'Content',
        'full' => 'Full',
    ],
    'std' => 'content',
    'condition' => [
        'heading_style' => [ 'middle-line', 'diagonal-stripe', 'pixelate-dots' ]
    ],
    'refresh' => 'heading',
];

$fields[ 'heading_align' ] = [
    'type' => 'radio',
    'name' => 'Align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'center',
    'refresh' => 'heading',
];

$selector = '.heading56';
$fields[ 'heading_typography' ] = [
    'type' => 'group',
    'name' => 'Typography',
    'fields' => [
        'face' => [
            'type' => 'select',
            'options' => [
                '' => '-- select --',
                'var(--font-heading)' => 'Font Heading',
                'var(--font-body)' => 'Font Body',
                'var(--font-nav)' => 'Font Menu',
                'var(--font-custom-1)' => 'Font Custom 1',
                'var(--font-custom-2)' => 'Font Custom 2',

                'Helvetica Neue' => 'Helvetica Neue',
                'Helvetica' => 'Helvetica',
                'Arial' => 'Arial',
                'Times' => 'Times',
                'Georgia' => 'Georgia',
                'monospace' => 'Monospace',
            ],
            'std' => '',
            'name' => 'Font',
            'col' => '1-1',
        ],
        'weight' => [
            'type' => 'select',
            'name' => 'Weight',
            'options' => [
                '' => '-- select --',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => 'Normal',
                '500' => '500',
                '600' => '600',
                '700' => 'Bold',
                '800' => '800',
                '900' => '900',
            ],
            'std' => '',
            'col' => '1-2',
        ],
        'style' => [
            'type' => 'select',
            'name' => 'Style',
            'options' => [
                '' => '-- select --',
                'normal' => 'Normal',
                'italic' => 'Italic',
            ],
            'std' => '',
            'col' => '1-2',
        ],
        'size' => [
            'type' => 'text',
            'name' => 'Font size',
            'placeholder' => 'Eg. 20px',
            'col' => '2-5',
        ],
        'size_tablet' => [
            'type' => 'text',
            'name' => 'Font tablet',
            'col' => '2-5',
        ],
        'size_mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'col' => '1-5',
        ],
        'line_height' => [
            'type' => 'text',
            'name' => 'Line height',
            'placeholder' => 'Eg. 1.5',
            'col' => '1-3',
        ],
        'spacing' => [
            'type' => 'text',
            'name' => 'Spacing',
            'placeholder' => 'Eg. 1.5',
            'col' => '1-3',
        ],
        'transform' => [
            'type' => 'select',
            'name' => 'Transform',
            'col' => '1-3',
            'options' => [
                '' => '-- select --',
                'uppercase' => 'UPPERCASE',
                'lowercase' => 'lowercase',
                'capitalize' => 'Capitalize',
            ],
            'std' => '',
        ],
    ],
    'css' => [
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-family',
            'use' => 'face',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-weight',
            'use' => 'weight',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-style',
            'use' => 'style',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-size',
            'use' => 'size',
            'unit' => 'px',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-size',
            'use' => 'size_tablet',
            'unit' => 'px',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'font-size',
            'use' => 'size_mobile',
            'unit' => 'px',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'line-height',
            'use' => 'line_height',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'letter-spacing',
            'use' => 'spacing',
            'unit' => 'px',
        ],
        [
            'selector' => ".builder56 .{{section}} $selector",
            'property' => 'text-transform',
            'use' => 'transform',
        ],
    ],
];

$fields[ 'heading_color' ] = [
    'type' => 'color',
    'name' => 'Color',
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .heading56',
            'property' => 'color',
        ]
    ]
];

$fields[ 'heading_line_color' ] = [
    'type' => 'color',
    'name' => 'Line Color',
    'css' => [
        // the middle line style
        [
            'selector' => '.builder56 .{{section}} .heading56--middle-line .heading56__line',
            'property' => 'background-color',
        ],

        // the border top, left
        [
            'selector' => '.builder56 .{{section}} .heading56--border-top, .builder56 .{{section}} .heading56--border-bottom',
            'property' => 'border-color',
        ],

        // the border around
        [
            'selector' => '.builder56 .{{section}} .heading56--border-around .heading56__text',
            'property' => 'border-color',
        ],
    ],
];

/**
 * LINK
 */
$fields[ 'heading_link' ] = [
    'type' => 'group',
    'name' => 'Heading URL',
    'fields' => [
        'url' => [
            'name' => 'Link',
            'type' => 'text',
            'placeholder' => 'https://',
            'col' => '2-3',
        ],
        'target' => [
            'name' => 'Target',
            'type' => 'select',
            'options' => [
                '_self' => 'Same tab',
                '_blank' => 'New tab',
            ],
            'std' => '_blank',
            'col' => '1-3',
        ],
    ],
    'std' => [
        'url' => '',
        'target' => '_self',
    ],

    'refresh' => 'heading',
    'inner_tabs' => 'heading',
    'inner_tab' => 'link',
];

$fields[ 'heading_link_position' ] = [
    'type' => 'radio',
    'name' => 'Link position',
    'options' => [
        'inheading' => 'In heading',
        'separated' => 'Separated',
    ],
    'std' => 'inheading',
    'refresh' => 'heading',
];

$fields[ 'heading_link_text' ] = [
    'type' => 'text',
    'placeholder' => 'View all >>',
    'name' => 'Link text',
    'desc' => 'In case you use separated link',
    'refresh' => 'heading',
];

$fields[ 'heading_link_color' ] = [
    'type' => 'color',
    'name' => 'Link color',
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .heading56__link--separated',
            'property' => 'color',
        ],
    ],

    'end_inner_tabs' => true,
    'end_inner_tab' => true,
];