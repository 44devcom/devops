<?php
$options[ 'page_layout_type' ] = [
    'type' => 'radio',
    'name' => 'Page layout type',
    'options' => [
        'classic' => 'Predefined (non-Elementor)',
        'builder' => 'Builder (by Elementor)',
    ],
    'std' => 'classic',
    'desc' => 'If you choose Custom Templates, you can use Elementor to import most creative and flexible layouts.',
    
    'hint' => 'Single Page Builder',
    
    'toggle' => [
        'builder' => [
            'page_template',
        ],
        'classic' => [
            'page_style',
            'page_sidebar_state',
            'page_thumbnail_stretch',
            'page_content_width',
            'page_content_image_stretch',
            'page_column_layout',
            'page_dropcap',
            'page_share',
            'page_share_positions',
            'page_comment',
        ],
    ],
    
    'section'   => 'page',
    'section_title' => 'Page',
    'section_priority' => 139,
];

$template_list = [ '' => 'Choose Template' ];
if ( function_exists( 'fox_get_block_list' ) ) {
    $template_list += fox_get_block_list( 'page' );
} else {
    $template_list = [ '' => 'You must install FOX Framework plugin' ];
}

$options[ 'page_template' ] = [
    'type' => 'select',
    'options' => $template_list,
    'name' => 'Choose Template',
    'std' => '',
];


/* PAGE - 135
--------------------------------------------------------------------------------------------------------------------- */
$options[ 'page_style' ] = [
    'type' => 'image_radio',
    'options' => [
        '1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 1',
        ],
        '1b' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1b.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 1b',
        ],
        '2' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 2',
        ],
        '3' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/3.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 3',
        ],
        '4' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/4.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Hero full',
        ],
        '5' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/5.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Hero half',
        ],
    ],
    'std' => '1',
    'name' => 'Predefined Page Layout',
    'hint' =>  'Page layout',

];

$options[ 'page_sidebar_state' ] = [
    'type' => 'radio',
    'options' => [
        'sidebar-left' => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
        'no-sidebar' => 'No sidebar (fullwidth)',
    ],
    'std' => 'sidebar-right',
    'name' => 'Page Sidebar',
    
    'hint' =>  'Page sidebar',
];

$options[ 'page_thumbnail_stretch' ] = [
    'type' => 'radio',
    'options' => [
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'name' => 'Thumbnail stretch',
    
    'hint' =>  'Page thumbnail stretch',
];

$options[ 'page_content_width' ] = [
    'type' => 'radio',
    'options' => [
        'full' => 'Full width',
        'narrow' => 'Narrow width',
    ],
    'std' => 'full',
    'name' => 'Content width',
    
    'hint' =>  'Page narrow content',
];

$options[ 'page_content_image_stretch' ] = [
    'name' => 'Stretch All Content Images',
    'type' => 'radio',
    'options' => [
        'stretch-none' => 'No strech',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'desc' => 'Each photo has its own option for stretching. By using this option. you stretch ALL alignnone, aligncenter images in your post.',
    
    'hint' =>  'Page content image stretch',
];

$options[ 'page_column_layout' ] = [
    'type' => 'select',
    'options' => array(
        '1' => '1 column',
        '2' => '2 columns',
    ),
    'std' => '1',
    
    'name' => 'Page Text Column Layout',
    'hint' =>  'Page text column layout',
];

$options[ 'page_dropcap' ] = [
    'shorthand' => 'enable',
    'std' => 'false',
    'name' => 'Drop cap?',
    
    'hint' =>  'Page content drop cap',
];

$options[ 'page_share' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Display share icons on page',
    'toggle'    => [
        'true' => [ 'page_share_positions' ],
    ],
    
    'hint' =>  'Page social share',
);

$options[ 'page_share_positions' ] = array(
    'type'      => 'multicheckbox',
    'options'   => [
        'before' => 'Before content',
        'side' => 'Left side of content',
        'after' => 'After content',
    ],
    'std'       => 'after',
);

$options[ 'page_comment' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Comment Area all pages',
    
    'hint' =>  'Page comment',
);