<?php
$fox56_customize->add_section( 'footer_sidebar',[
    'title' => 'Footer Sidebar',
    'panel' => 'footer',
]);

$fox56_customize->add_partial( 'footer_sidebar', [
    'selector' => '#footer-sidebar-placement',
    'render_callback' => 'fox56_footer_sidebar_inner',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'footer_sidebar',
    'title' => 'Enable footer sidebar?',
    'std' => true,
    'section' => 'footer_sidebar',
    'refresh' => 'footer_sidebar',

    'hint' => 'footer sidebar',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'footer_sidebar_layout',
    'title' => 'Footer sidebar layout',
    'options' => [
        '1-1-1-1' => get_template_directory_uri() . '/inc/customize/images/4-cols.jpg',
        '2-1-1-1' => get_template_directory_uri() . '/inc/customize/images/2-1-1-1.jpg',
        '2-1-1' => get_template_directory_uri() . '/inc/customize/images/2-1-1.jpg',
        '1-2-1' => get_template_directory_uri() . '/inc/customize/images/1-2-1.jpg',
        '1-1-2' => get_template_directory_uri() . '/inc/customize/images/1-1-2.jpg',
        '3-1' => get_template_directory_uri() . '/inc/customize/images/3-1.jpg',
        '1-3' => get_template_directory_uri() . '/inc/customize/images/1-3.jpg',
        '1-1-1' => get_template_directory_uri() . '/inc/customize/images/3-cols.jpg',
        '2-1' => get_template_directory_uri() . '/inc/customize/images/2-1.jpg',
        '1-2' => get_template_directory_uri() . '/inc/customize/images/1-2.jpg',
        '1-1' => get_template_directory_uri() . '/inc/customize/images/2-cols.jpg',
        '1' => get_template_directory_uri() . '/inc/customize/images/1-col.jpg',
    ],
    'std' => '1-1-1-1',
    'section' => 'footer_sidebar',
    'refresh' => 'footer_sidebar',

    'hint' => 'footer sidebar layout',
]);

for ( $j = 1; $j <=4; $j++ ) {
    $fox56_customize->add_field([
        'type' => 'select',
        'id' => 'footer_' . $j . '_align',
        'title' => 'Footer ' . $j . ' align',
        'options' => [
            '' => 'Default',
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right',
        ],
        'std' => '',
        'refresh' => 'footer_sidebar',
    ]);
}

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'footer_sidebar_sep',
    'title' => 'Separator between cols?',
    'refresh' => 'footer_sidebar',

    'hint' => 'footer sidebar sep',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_sidebar_sep_color',
    'hint' => 'footer sidebar sep color',
    'title' => 'Separator color',
    'css' => [
        [
            'selector' => '.footer56__col__sep',
            'property' => 'border-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'footer_sidebar_valign',
    'hint' => 'footer sidebar vertical align',
    'title' => 'Vertical align?',
    'options' => [
        'stretch'   => 'Stretch',
        'top'      => 'Top',
        'middle'      => 'Middle',
        'bottom'      => 'Bottom',
    ],
    'std' => 'stretch',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'footer_sidebar_stretch',
    'hint' => 'footer sidebar stretch',
    'title' => 'Stretch?',
    'std'     => 'content',
    'options'     => [
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
    ],
    'refresh' => 'footer_sidebar',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'footer_sidebar_skin',
    'hint' => 'footer sidebar skin',
    'title' => 'Skin?',
    'std'     => 'light',
    'options'     => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'refresh' => 'footer_sidebar',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_sidebar_color',
    'hint' => 'footer sidebar text color',
    'title' => 'Text Color',
    'css' => [
        [
            'selector' => '.footer_sidebar56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'background',
    'id' => 'footer_sidebar_background',
    'hint' => 'footer sidebar background',
    'title' => 'Background',
    'selector' => '.footer_sidebar56',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'id' => 'footer_sidebar_padding',
    'title' => 'Footer sidebar padding',
    'css' => [
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0px',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0px',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0px',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 30,
        'tablet' => 20,
        'mobile' => 10,
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'id' => 'footer_sidebar_col_padding',
    'title' => 'Footer sidebar column padding',
    'css' => [
        [
            'selector' => '.footer56__row .footer56__col',
            'property' => 'padding',
            'value_pattern' => '$ 20px',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.footer56__row .footer56__col',
            'property' => 'padding',
            'value_pattern' => '$ 20px',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.footer56__row .footer56__col',
            'property' => 'padding',
            'value_pattern' => '$ 20px',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 0,
        'tablet' => 0,
        'mobile' => 0,
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'fields' => [
        'top' => [
            'type' => 'number',
            'name' => 'Top',
            'col' => '2-5',
        ],
        'bottom' => [
            'type' => 'number',
            'name' => 'Bottom',
            'col' => '2-5',
        ],
        'color' => [
            'type' => 'color',
            'name' => 'Color',
            'col' => '1-5',
        ],
    ],
    'id' => 'footer_sidebar_border',
    'title' => 'Footer sidebar border',
    'css' => [
        [
            'selector' => '.footer_sidebar56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.footer_sidebar56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.footer_sidebar56',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'fields' => [
        'top' => [
            'type' => 'number',
            'name' => 'Top',
            'col' => '2-5',
        ],
        'bottom' => [
            'type' => 'number',
            'name' => 'Bottom',
            'col' => '2-5',
        ],
        'color' => [
            'type' => 'color',
            'name' => 'Color',
            'col' => '1-5',
        ],
    ],
    'id' => 'footer_sidebar_container_border',
    'title' => 'Footer sidebar container border',
    'css' => [
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.footer_sidebar56 .container',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ]
]);