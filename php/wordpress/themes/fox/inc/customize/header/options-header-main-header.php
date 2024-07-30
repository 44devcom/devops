<?php
$fox56_customize->add_section( 'main_header',[
    'title' => 'Main Header',
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

$fox56_customize->add_partial( 'main_header', [
    'selector' => '.main_header56',
    'render_callback' => 'fox56_header_main_inner',
]);

$fox56_customize->settings[ 'main_header_left_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'main_header_center_elements' ] = [
    'default' => [ 'logo' ],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'main_header_right_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->add_partial( 'main_header_left',[
    'selector' => '.main_header56 .header56__part--left',
    'render_callback' => function() {
        return fox56_header_part_inner( 'main_header', 'left' );
    },
    'settings' => [ 'main_header_left_elements' ]
]);
$fox56_customize->add_partial( 'main_header_center',[
    'selector' => '.main_header56 .header56__part--center',
    'render_callback' => function() {
        return fox56_header_part_inner( 'main_header', 'center' );
    },
    'settings' => [ 'main_header_center_elements' ]
]);
$fox56_customize->add_partial( 'main_header_right',[
    'selector' => '.main_header56 .header56__part--right',
    'render_callback' => function() {
        return fox56_header_part_inner( 'main_header', 'right' );
    },
    'settings' => [ 'main_header_right_elements' ]
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'main_header_layout',
    'title' => 'Main Header layout',
    'std'     => '11',
    'options' => $possible_layouts,
    'refresh' => 'main_header',
    'section' => 'main_header',

    'hint' => 'main header layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'main_header_stretch',
    'title' => 'Stretch?',
    'std'     => 'content',
    'options'     => [
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
    ],
    'transport' => 'postMessage',

    'hint' => 'main header stretch',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'main_header_padding',
    'title' => 'Main Header Padding',
    'hint' => 'main header padding',
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
    'std'     => [
        'top' => 14,
        'bottom' => 14,
    ],
    'css' => [
        [
            'selector' => '.main_header56 .container',
            'property' => 'padding-top',
            'use' => 'top',
            'unit' => 'px',
        ],
        [
            'selector' => '.main_header56 .container',
            'property' => 'padding-bottom',
            'use' => 'bottom',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'background',
    'id' => 'main_header_background',
    'title' => 'Main Header background',
    'selector' => '.main_header56',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'options' => [
        'light' => get_template_directory_uri() . '/inc/customize/images/text-light.jpg',
        'dark' => get_template_directory_uri() . '/inc/customize/images/text-dark.jpg',
    ],
    'std' => 'light',
    'id' => 'main_header_text_skin',
    'title' => 'Main Header text skin',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'main_header_text_color',
    'title' => 'Custom text color',
    'hint' => 'main header text color',
    'css' => [
        [
            'selector' => '.main_header56__container, .main_header56__container.textskin--dark',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'main_header_border_bottom',
    'title' => 'Main Header border bottom',
    'std'     => 0,
    'css' => [
        [
            'selector' => '.main_header56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'main_header_container_border_bottom',
    'title' => 'Main Header container border bottom',
    'std'     => 0,
    'css' => [
        [
            'selector' => '.main_header56__container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'main_header_border_color',
    'title' => 'Border color',
    'hint' => 'main header border color',
    'css' => [
        [
            'selector' => '.main_header56, .main_header56 .container',
            'property' => 'border-color',
        ],
    ],
]);