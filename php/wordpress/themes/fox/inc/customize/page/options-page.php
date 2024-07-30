<?php
$fox56_customize->add_section( 'page',[
    'title' => 'Page',
    'priority' => 45,
]);

if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    $fox56_customize->add_field([
        'id' => 'wi_page_layout_type',
        'title' => 'Page layout engine',
        'type' => 'radio',
        'name' => 'Page layout type',
        'section' => 'page',

        'options' => [
            'classic' => 'Default',
            'builder' => 'FOX Block + Elementor',
        ],
        'std' => 'classic',
    ]);

    $fox56_customize->add_field([
        'id' => 'wi_page_template',
        'title' => 'Page template',
        'type' => 'select',
        'std' => '',
        'options' => $fox_block_list,
        'condition' => [ 'wi_page_layout_type' => 'builder' ]
    ]);
}

$condition = [];
if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    $condition = [ 'wi_page_layout_type' => 'classic' ];
}

$fox56_customize->add_field([
    'id' => 'page_style',
    'title' => 'Page layout',
    'type' => 'radio_image',
    'std' => '1',
    'options' => [
        '1' => get_template_directory_uri() . '/inc/customize/images/1.png',
        '1b' => get_template_directory_uri() . '/inc/customize/images/1b.png',
        '2' => get_template_directory_uri() . '/inc/customize/images/2.png',
        '3' => get_template_directory_uri() . '/inc/customize/images/3.png',
        '4' => get_template_directory_uri() . '/inc/customize/images/4.png',
        '5' => get_template_directory_uri() . '/inc/customize/images/5.png',
        '6' => get_template_directory_uri() . '/inc/customize/images/6.png',
    ],
    'condition' => $condition,
    'section' => 'page',
]);

$fox56_customize->add_field([
    'id' => 'page_sidebar_state',
    'type' => 'radio_image',
    'options' => [
        'sidebar-left' => get_template_directory_uri() . '/inc/customize/images/sidebar-left.jpg',
        'sidebar-right' => get_template_directory_uri() . '/inc/customize/images/sidebar-right.jpg',
        'no-sidebar' => get_template_directory_uri() . '/inc/customize/images/no-sidebar.jpg',
    ],
    'std' => 'sidebar-right',
    'name' => 'Page Sidebar',
    'condition' => $condition,
]);

$fox56_customize->add_field([
    'id' => 'page_thumbnail_stretch',
    'type' => 'radio',
    'options' => [
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'name' => 'Thumbnail stretch',
    'hint' => 'page thumbnail stretch',
    'condition' => $condition,
]);

$fox56_customize->add_field([
    'id' => 'page_content_width',
    'type' => 'radio',
    'options' => [
        'full' => 'Full width',
        'narrow' => 'Narrow width',
    ],
    'std' => 'full',
    'name' => 'Content width',
    'hint' => 'page content width',
    'condition' => $condition,
]);

$fox56_customize->add_field([
    'id' => 'page_content_image_stretch',
    'type' => 'checkbox',
    'name' => 'Strech content images?',
    'hint' => 'page stretch content images',
    'condition' => $condition,
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'page_title_align',
    'name' => 'Page title align',
    'css' => [
        [
            'selector' => '.page56__header',
            'property' => 'text-align',
        ]
    ],
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'hint' => 'page title align',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'page_title_typography',
    'name' => 'Page title typography',
    'std' => [
        'face' => '',
        'weight' => '',
        'spacing' => '',
        'transform' => '',
    ],
    'selector' => '.page56__title.single56__title',
    'hint' => 'page title font',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'page_title_color',
    'name' => 'Page title color',
    'css' => [
        [
            'selector' => '.page56__title.single56__title',
            'property' => 'color'
        ]
    ],
    'hint' => 'page title color',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'page_content_typography',
    'name' => 'Page content typography',
    'std' => [
        'face' => '',
        'weight' => '',
        'spacing' => '',
        'transform' => '',
    ],
    'selector' => '.page56__content',
    'hint' => 'page content font',
]);

/*
$options[ 'page_comment' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Comment Area all pages',
    
    'hint' =>  'Page comment',
); */