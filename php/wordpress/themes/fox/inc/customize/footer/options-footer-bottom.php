<?php
$fox56_customize->add_section( 'footer_bottom',[
    'title' => 'Footer Bottom',
    'panel' => 'footer',
]);

$fox56_customize->add_partial( 'footer_bottom', [
    'selector' => '#footer-bottom-placement',
    'render_callback' => 'fox56_footer_bottom_inner',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'footer_bottom',
    'title' => 'Enable footer bottom?',
    'std' => true,
    'section' => 'footer_bottom',
    'refresh' => 'footer_bottom',

    'hint' => 'footer bottom',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'footer_bottom_layout',
    'title' => 'Footer bottom layout',
    'options' => [
        'stack' => 'Stack',
        'inline' => 'Inline',
    ],
    'std' => 'stack',
    'section' => 'footer_bottom',
    'refresh' => 'footer_bottom',

    'hint' => 'footer bottom layout',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'footer_stack_elements',
    'title' => 'Footer stack elements',
    'options' => [
        'logo' => 'Logo',
        'social' => 'Social icons',
        'search' => 'Search',
        'copyright' => 'Copyright',
        'nav' => 'Footer Menu',
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
    ],
    'std' => [ 'logo', 'social', 'search', 'copyright', 'nav' ],
    'refresh' => 'footer_bottom',
    'condition' => [ 'footer_bottom_layout' => 'stack' ],

    'hint' => 'footer stack components',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'footer_left_elements',
    'title' => 'Footer inline left',
    'options' => [
        'logo' => 'Logo',
        'social' => 'Social icons',
        'search' => 'Search',
        'copyright' => 'Copyright',
        'nav' => 'Footer Menu',
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
    ],
    'std' => [ 'logo', 'copyright' ],
    'refresh' => 'footer_bottom',
    'condition' => [ 'footer_bottom_layout' => 'inline' ],

    'hint' => 'footer inline left',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'footer_right_elements',
    'title' => 'Footer inline right',
    'options' => [
        'logo' => 'Logo',
        'social' => 'Social icons',
        'search' => 'Search',
        'copyright' => 'Copyright',
        'nav' => 'Footer Menu',
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
    ],
    'std' => [ 'nav', 'social' ],
    'refresh' => 'footer_bottom',
    'condition' => [ 'footer_bottom_layout' => 'inline' ],

    'hint' => 'footer inline right',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'footer_bottom_stretch',
    'title' => 'Stretch?',
    'std'     => 'content',
    'options'     => [
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
    ],
    'refresh' => 'footer_bottom',

    'hint' => 'footer bottom stretch',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'footer_bottom_skin',
    'title' => 'Skin?',
    'std'     => 'light',
    'options'     => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'refresh' => 'footer_bottom',

    'hint' => 'footer bottom skin',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_bottom_color',
    'title' => 'Footer bottom text color',
    'css' => [
        [
            'selector' => '.footer_bottom56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'background',
    'id' => 'footer_bottom_background',
    'title' => 'Footer bottom background',
    'selector' => '.footer_bottom56',
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
    'id' => 'footer_bottom_padding',
    'title' => 'Footer bottom padding',
    'css' => [
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'padding',
            'value_pattern' => '$ 0',
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
    'id' => 'footer_bottom_border',
    'title' => 'Footer bottom border',
    'css' => [
        [
            'selector' => '.footer_bottom56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.footer_bottom56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.footer_bottom56',
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
    'id' => 'footer_bottom_container_border',
    'title' => 'Footer bottom container border',
    'css' => [
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.footer_bottom56 .container',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ]
]);