<?php
$fox56_customize->add_section( 'topbar',[
    'title' => 'Topbar',
    'panel' => 'header',
]);
$possible_layouts = [
    '12-12' => get_template_directory_uri() . '/inc/customize/images/group-1-1.jpg',
    '15-45' => get_template_directory_uri() . '/inc/customize/images/group-1-4.jpg',
    '14-34' => get_template_directory_uri() . '/inc/customize/images/group-1-3.jpg',
    '13-23' => get_template_directory_uri() . '/inc/customize/images/group-1-2.jpg',
    '23-13' => get_template_directory_uri() . '/inc/customize/images/group-2-1.jpg',
    '34-14' => get_template_directory_uri() . '/inc/customize/images/group-3-1.jpg',
    '45-15' => get_template_directory_uri() . '/inc/customize/images/group-4-1.jpg',
    
    '35-25' => get_template_directory_uri() . '/inc/customize/images/group-3-2.jpg',
    '25-35' => get_template_directory_uri() . '/inc/customize/images/group-2-3.jpg',
    
    '25-15-25' => get_template_directory_uri() . '/inc/customize/images/group-2-1-2.jpg',
    '13-13-13' => get_template_directory_uri() . '/inc/customize/images/group-1-1-1.jpg',
    '14-12-14' => get_template_directory_uri() . '/inc/customize/images/group-1-2-1.jpg',
    '15-35-15' => get_template_directory_uri() . '/inc/customize/images/group-1-3-1.jpg',
    '16-23-16' => get_template_directory_uri() . '/inc/customize/images/group-1-4-1.jpg',
    
    '11' => get_template_directory_uri() . '/inc/customize/images/group-1.jpg',
];

$fox56_customize->add_partial( 'topbar', [
    'selector' => '.topbar56',
    'render_callback' => 'fox56_header_topbar_inner',
]);

$fox56_customize->settings[ 'topbar_left_elements' ] = [
    'default' => [ 'nav' ],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'topbar_center_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'topbar_right_elements' ] = [
    'default' => [ 'social', 'search' ],
    'transport' => 'postMessage',
];
$fox56_customize->add_partial( 'topbar_left',[
    'selector' => '.topbar56 .header56__part--left',
    'render_callback' => function() {
        return fox56_header_part_inner( 'topbar', 'left' );
    },
    'settings' => [ 'topbar_left_elements' ]
]);
$fox56_customize->add_partial( 'topbar_center',[
    'selector' => '.topbar56 .header56__part--center',
    'render_callback' => function() {
        return fox56_header_part_inner( 'topbar', 'center' );
    },
    'settings' => [ 'topbar_center_elements' ]
]);
$fox56_customize->add_partial( 'topbar_right',[
    'selector' => '.topbar56 .header56__part--right',
    'render_callback' => function() {
        return fox56_header_part_inner( 'topbar', 'right' );
    },
    'settings' => [ 'topbar_right_elements' ]
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'topbar_layout',
    'title' => 'Topbar layout',
    'std'     => '12-12',
    'options' => $possible_layouts,
    'refresh' => 'topbar',

    'section' => 'topbar',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'topbar_stretch',
    'title' => 'Stretch?',
    'hint' => 'topbar stretch',
    'std'     => 'content',
    'options'     => [
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
    ],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'topbar_height',
    'title' => 'Topbar Height',
    'std'     => 32,
    'css' => [
        [
            'selector' => '.topbar56 .container .row',
            'property' => 'height',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'topbar_background',
    'title' => 'Topbar background',
    
    'css' => [
        [
            'selector' => '.topbar56',
            'property' => 'background-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'options' => [
        'light' => get_template_directory_uri() . '/inc/customize/images/text-light.jpg',
        'dark' => get_template_directory_uri() . '/inc/customize/images/text-dark.jpg',
    ],
    'std' => 'light',
    'id' => 'topbar_text_skin',
    'title' => 'Topbar text skin',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'topbar_text_color',
    'title' => 'Custom text color',
    'hint' => 'topbar text color',
    'css' => [
        [
            'selector' => '.topbar56__container, .topbar56__container.textskin--dark',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'topbar_border',
    'title' => 'Topbar border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.topbar56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.topbar56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ]
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'topbar_container_border',
    'title' => 'Topbar Container border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.topbar56__container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.topbar56__container',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ]
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'topbar_border_color',
    'hint' => 'topbar border color',
    'title' => 'Border color',
    'css' => [
        [
            'selector' => '.topbar56, .topbar56 .container',
            'property' => 'border-color',
        ],
    ],
]);