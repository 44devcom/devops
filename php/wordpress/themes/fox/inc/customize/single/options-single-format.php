<?php
$fox56_customize->add_section( 'single_format', [
    'title' => 'Post Format Options',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'id' => 'video_indicator_style',
    'name'      => 'Video indicator style',
    'type'      => 'select',
    'options'   => [
        'minimal'   => 'Minimal',
        'solid'     => 'Solid',
        'outline'   => 'Outline',
    ],
    'std'       => 'outline',

    'section' => 'single_format',
    'hint' =>  'Video icon style',
]);

$fox56_customize->add_field([
    'id' => 'single_format_link_target',
    'name'      => 'Post format Link: opens link in:',
    'type'      => 'select',
    'options'   => [
        '_self'   => 'Same tab',
        '_blank'   => 'New tab',
    ],
    'std'       => '_self',
    'hint' =>  'Format link, opens new tab',
]);

$fox56_customize->add_field([
    'id' => 'single_format_gallery_style',
    'type' => 'radio_image',
    'options' => [
        'metro' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/metro.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Metro',
        ],
        'stack' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/stack.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Stack Images',
        ],
        'slider' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/slider.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Slider',
        ],
        'slider-rich' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/slider-rich.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Rich Content Slider',
        ],
        'carousel' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/carousel.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Carousel',
        ],
        'grid' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/grid.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Grid',
        ],
        'masonry' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/masonry.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Masonry',
        ],
    ],
    'std' => 'metro',
    'name' => 'Gallery Default Style',
    'hint' =>  'Default post gallery type',
]);

$fox56_customize->add_field([
    'id' => 'single_format_gallery_lightbox',
    'name' => 'Open lightbox?',
    'type' => 'select',
    'options' => [
        'true' => 'Yes Please',
        'false' => 'No Thanks',
    ],
    'std' => 'true',
    'hint' =>  'Post gallery lightbox',
]);

$fox56_customize->add_field([
    'id' => 'single_format_gallery_grid_column',
    'name' => 'Gallery Grid Column',
    'type' => 'select',
    'options' => [
        '2' => '2 Columns',
        '3' => '3 Columns',
        '4' => '4 Columns',
        '5' => '5 Columns',
    ],
    'std' => '3',
]);

$fox56_customize->add_field([
    'id' => 'single_format_gallery_grid_size',
    'name' => 'Gallery Grid Image Size',
    'type' => 'select',
    'options' => [
        'landscape' => 'Landscape',
        'square' => 'Square',
        'portrait' => 'Portrait',
        'original' => 'Original',
        'custom' => 'Custom Size',
    ],
    'std' => 'landscape',
]);

$fox56_customize->add_field([
    'id' => 'single_format_gallery_grid_size_custom',
    'name' => 'Grid Image Custom Size',
    'type' => 'text',
    'placeholder' => 'Eg. 600x320',
    'desc' => 'Syntax: WxH',
]);