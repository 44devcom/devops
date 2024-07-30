<?php
$fox56_customize->add_section( 'header_mobile',[
    'title' => 'Header Mobile',
    'panel' => 'header',
]);

$possible_layouts = [
    '12-12' => get_template_directory_uri() . '/inc/customize/images/group-1-1.jpg',
    '14-34' => get_template_directory_uri() . '/inc/customize/images/group-1-3.jpg',
    '13-23' => get_template_directory_uri() . '/inc/customize/images/group-1-2.jpg',
    '23-13' => get_template_directory_uri() . '/inc/customize/images/group-2-1.jpg',
    '34-14' => get_template_directory_uri() . '/inc/customize/images/group-3-1.jpg',
    
    '35-25' => get_template_directory_uri() . '/inc/customize/images/group-3-2.jpg',
    '25-35' => get_template_directory_uri() . '/inc/customize/images/group-2-3.jpg',
    
    '25-15-25' => get_template_directory_uri() . '/inc/customize/images/group-2-1-2.jpg',
    '13-13-13' => get_template_directory_uri() . '/inc/customize/images/group-1-1-1.jpg',
    '14-12-14' => get_template_directory_uri() . '/inc/customize/images/group-1-2-1.jpg',
    '15-35-15' => get_template_directory_uri() . '/inc/customize/images/group-1-3-1.jpg',
    '16-23-16' => get_template_directory_uri() . '/inc/customize/images/group-1-4-1.jpg',
    
    '11' => get_template_directory_uri() . '/inc/customize/images/group-1.jpg',
];

$fox56_customize->add_partial( 'header_mobile', [
    'selector' => '.header_mobile56',
    'render_callback' => 'fox56_header_mobile_inner',
]);

$fox56_customize->settings[ 'header_mobile_left_elements' ] = [
    'default' => [ 'hamburger' ],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'header_mobile_center_elements' ] = [
    'default' => [ 'logo' ],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'header_mobile_right_elements' ] = [
    'default' => [ 'cart' ],
    'transport' => 'postMessage',
];
$fox56_customize->add_partial( 'header_mobile_left',[
    'selector' => '.header_mobile56 .header56__part--left',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_mobile', 'left' );
    },
    'settings' => [ 'header_mobile_left_elements' ]
]);
$fox56_customize->add_partial( 'header_mobile_center',[
    'selector' => '.header_mobile56 .header56__part--center',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_mobile', 'center' );
    },
    'settings' => [ 'header_mobile_center_elements' ]
]);
$fox56_customize->add_partial( 'header_mobile_right',[
    'selector' => '.header_mobile56 .header56__part--right',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_mobile', 'right' );
    },
    'settings' => [ 'header_mobile_right_elements' ]
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'header_mobile_layout',
    'title' => 'Header mobile layout',
    'std'     => '16-23-16',
    'options' => $possible_layouts,
    'refresh' => 'header_mobile',
    'section' => 'header_mobile'
]);

$fox56_customize->add_field([
    'id' => 'mobile_header_sticky',
    'title' => 'Sticky Header Mobile?',
    'std' => true,
    'type' => 'checkbox',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_mobile_height',
    'title' => 'Header mobile height',
    'std'     => 54,
    'css' => [
        [
            'selector' => '.header_mobile56 .container .row, .header_mobile56__height',
            'property' => 'height',
            'unit' => 'px',
        ],
        [
            'selector' => '.offcanvas56',
            'property' => 'top',
            'unit' => 'px',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => '.minimal-header',
            'property' => 'height',
            'unit' => 'px',
            'media_query' => $fox56_customize->tablet,
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_mobile_background',
    'title' => 'Header mobile background',
    'std'     => '#fff',
    'css' => [
        [
            'selector' => '.header_mobile56',
            'property' => 'background-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_mobile_color',
    'title' => 'Header mobile text color',
    'css' => [
        [
            'selector' => '.header_mobile56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'header_mobile_border',
    'name' => 'Border', 
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
            'selector' => '.header_mobile56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.header_mobile56',
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
    'id' => 'header_mobile_border_color',
    'title' => 'Border color',
    'hint' => 'mobile header border color',
    'css' => [
        [
            'selector' => '.header_mobile56',
            'property' => 'border-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_mobile_shadow',
    'title' => 'Shadow',
    'hint' => 'mobile header shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => '.header_mobile56',
            'property' => 'box-shadow',
            'value_pattern' => '0 4px 10px rgba(0,0,0,0.$)',
        ]
    ]
]);