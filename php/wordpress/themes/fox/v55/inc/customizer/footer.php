<?php
$instruction = '';
/* Footer General
-------------------------------------- */
$options[ 'footer_builder_intro' ] = array(

    'type'      => 'html',
    'std'       => '<p class="fox-info">' . $instruction . '</p>',
    
    'section' => 'footer_layout',
    'section_title' => 'General',

    'panel'   => 'footer',
    'panel_title'=> esc_html__( 'Footer', 'wi' ),
    'panel_priority' => 129,

);

/* since 4.9 */
$options[ 'footer_builder' ] = array(
    'type'      => 'radio',
    'options'   => [
        'true' => 'Footer Builder (by Elementor)',
        'false' => 'Classic Footer (non-Elementor)',
    ],
    'name'      => 'Footer Engine',
    'std'       => 'false',

    'hint' => 'Footer Builder',
    
    'toggle' => [
        'true' => [
            'footer_block_id',
            'single_footer_template',
            'page_footer_template',
            'category_footer_template',
            'tag_footer_template',
            'author_footer_template',
            'search_footer_template',
            '404_footer_template',
        ]
    ]
);

$footer_list = [ '' => 'Choose Footer' ];
$desc = '';
if ( function_exists( 'fox_get_block_list' ) ) {
    $footer_list += $fox_block_list;
    if ( empty( $fox_block_list ) ) {
        $desc = 'Create or Import Predefined Headers <a href="' . admin_url( 'post-new.php?post_type=fox_block' ) . '" target="_blank" title="Open in new tab">HERE &raquo;</a>';
    } else {
        $desc = '';
    }
} else {
    $footer_list = [ '' => 'You have to install FOX Framework plugin' ];
}

$options[ 'footer_block_id' ] = array(
    'name'      => 'Footer Builder Template',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
    'desc'      => $desc,
);

$options[ 'single_footer_template' ] = array(
    'name'      => 'Footer Template for Single Post',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ 'page_footer_template' ] = array(
    'name'      => 'Footer Template for Page',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ 'category_footer_template' ] = array(
    'name'      => 'Footer Template for Category',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ 'tag_footer_template' ] = array(
    'name'      => 'Footer Template for Tag',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ 'author_footer_template' ] = array(
    'name'      => 'Footer Template for Author',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ 'search_footer_template' ] = array(
    'name'      => 'Footer Template for Search',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

$options[ '404_footer_template' ] = array(
    'name'      => 'Footer Template for Page 404',
    'type'      => 'select',
    'options'   => $footer_list,
    'std'       => '',
);

/* Footer Instagram
-------------------------------------- */
$options[ 'footer_instagram_bg' ] = array(
    'shorthand' => 'background-color',
    'name'      => 'Footer Instagram Area Background Color',
    'selector'  => '#footer-instagram',

    'section'   => 'footer-instagram',
    'section_title' => 'Footer Instagram',
    'panel' => 'footer',
    
);
        
/* Footer Sidebar
-------------------------------------- */
$options[ 'footer_sidebar' ] = array(
    'shorthand' => 'enable',
    'name'      => esc_html__( 'Footer Sidebar', 'wi' ),
    'std'       => 'true',

    'section'   => 'footer-sidebar',
    'section_title' => 'Footer Sidebar',
    'panel' => 'footer',
    
    'hint' => 'Footer sidebar, widgets',
);

$options[ 'footer_sidebar_layout' ] = array(
    'type'      => 'image_radio',
    'name'      => 'Footer Sidebar Layout',
    'std'       => '1-1-1-1',
    'options'   => [
        '1-1-1-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/4-cols.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/4 + 1/4 + 1/4 + 1/4',
        ],
        
        '2-1-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2-1-1.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '2/4 + 1/4 + 1/4',
        ],
        
        '1-2-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-2-1.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/4 + 2/4 + 1/4',
        ],
        
        '1-1-2' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-1-2.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/4 + 1/4 + 2/4',
        ],
        
        '3-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/3-1.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '3/4 + 1/4',
        ],
        
        '1-3' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-3.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/4 + 1/3',
        ],

        '1-1-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/3-cols.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/3 + 1/3 + 1/3',
        ],
        
        '2-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2-1.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '2/3 + 1/3',
        ],
        
        '1-3' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-2.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/3 + 2/3',
        ],

        '1-1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2-cols.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => '1/2 + 1/2',
        ],

        '1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-col.jpg',
            'width' => '80',
            'height' => 'auto',
            'title' => 'Fullwidth',
        ],
        
    ],
    
    'hint' => 'Footer sidebar layout',
);

for ( $i = 1; $i<=4; $i++ ) {
    
    $options[ 'footer_' . $i . '_align' ] = array(
        'type'      => 'select',
        'name'      => 'Footer ' . $i . ' align',
        'std'       => '',
        'options'   => [
            '' => 'Default',
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right',
        ],
        
        'hint' => sprintf( 'Footer %s align', $i ),
    );
    
}

$options[ 'footer_sidebar_sep' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Footer Col Separator',
    'std'       => 'true',
    
    'hint' => 'Footer sidebar separator',
);

$options[ 'footer_sidebar_sep_color' ] = array(
    'shorthand' => 'border-color',
    'name'      => 'Separator Color',
    'selector'  => '.footer-col-sep',
);

$options[ 'footer_sidebar_stretch' ] = array(
    'type'      => 'select',
    'options'   => [
        'content'   => 'Content Width',
        'full'      => 'Stretch to Full-width',
    ],
    'name'      => 'Footer Sidebar Stretch',
    'std'       => 'content',
    
    'hint' => 'Footer sidebar stretch',
);

// since 4.3
$options[ 'footer_sidebar_valign' ] = array(
    'type' => 'radio',
    'options'   => [
        'stretch'   => 'Stretch',
        'top'      => 'Top',
        'middle'      => 'Middle',
        'bottom'      => 'Bottom',
    ],
    'std'       => 'stretch',
    'name'      => 'Footer Sidebar Vertical Align',
    
    'hint' => 'Footer sidebar vertical align',
);

$options[ 'footer_sidebar_skin' ] = array(
    'type' => 'select',
    'options'   => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std'       => 'light',
    'name'      => 'Footer Sidebar Skin',
    
    'hint' => 'Footer sidebar skin',
);

$options[ 'footer_sidebar_color' ] = array(
    'shorthand' => 'color',
    'name'      => 'Footer Sidebar Text Color',
    'selector'  => '#footer-widgets',
    
    'hint' => 'Footer sidebar text color',
);

$options[ 'footer_sidebar_background' ] = array(
    'shorthand' => 'background',
    'name'      => 'Footer Sidebar Background',
    'selector'  => '#footer-widgets',
    
    'hint' => 'Footer sidebar background',
);

$options[ 'footer_sidebar_box' ] = array(
    'shorthand' => 'box',
    'name'      => 'Footer Sidebar Box',
);

$options[ 'footer_col_box' ] = array(
    'shorthand' => 'box',
    'name'      => 'Footer Column Padding',
    'fields'    => [ 'padding' ],
);

/* Footer Bottom
-------------------------------------- */
$options[ 'footer_bottom' ] = array(
    'shorthand'      => 'enable',
    'std' => 'true',
    'name'      => 'Footer Bottom',

    'section'   => 'footer',
    'section_title' => esc_html__( 'Footer Bottom', 'wi' ),
    'panel' => 'footer',
    
    'hint' => 'Footer bottom',
);

$options[ 'footer_bottom_classic_layout' ] = array(
    'type' => 'select',
    'name'      => 'Footer Bottom Layout',
    'options'   => [
        'stack' => 'Stack',
        'inline' => 'Inline Left - Right',
    ],
    'std' => 'stack',
    'hint' => 'Footer bottom layout',
);

$options[ 'footer_bottom_skin' ] = array(
    'type' => 'select',
    'options'   => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std'       => 'light',
    'name'      => 'Footer Bottom Skin',
    
    'hint' => 'Footer bottom skin',
);

$options[ 'footer_text_color' ] = array(
    'shorthand' => 'color',
    'name'      => 'Footer Text Color',
    'selector'  => '#footer-bottom',
    
    'hint' => 'Footer bottom text color',
);

$options[ 'footer_bottom_background' ] = array(
    'shorthand' => 'background',
    'name'      => 'Footer Bottom Background',
    
    'hint' => 'Footer bottom background',
);

$options[ 'footer_bottom_stretch' ] = array(
    'type'      => 'select',
    'options'   => [
        'content' => 'Content Width',
        'full' => 'Stretch to fullwidth',
    ],
    'std'       => 'content',
    'name'      => 'Footer Bottom Stretch',
);

// FOOTER LOGO
//
$options[] = array(
    'type'      => 'heading',
    'name'      => esc_html__( 'Footer Logo', 'wi' ),
    
    'hint' => 'Footer logo',
);

$options[ 'footer_logo_show' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Show footer logo?',
);

$options[ 'footer_logo' ] = array(
    'type'      => 'image',
    'name'      => esc_html__( 'Footer Logo', 'wi' ),
);

$options[ 'footer_logo_width' ] = array(
    'shorthand' => 'width',
    'placeholder' => 'Eg. 120px',
    'selector'  => '#footer-logo img',
    'name'      => esc_html__( 'Footer logo width (px)', 'wi' ),
);

$options[ 'footer_logo_custom_link' ] = array(
    'type'      => 'text',
    'placeholder' => 'https://',
    'name'      => 'Footer Logo Custom Link',
    'desc'      => 'By default your footer logo will link to your homepage.',
);

$options[ 'footer_social_heading' ] = array(
    'type'      => 'heading',
    'name'      => esc_html__( 'Footer Social', 'wi' ),
);

$options[ 'footer_social' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Footer social icons',
    
    'hint' => 'Footer social',
);

$social_options = fox_social_style_support();

$options[ 'footer_social_skin' ] = array(
    'type'      => 'select',
    'options'   => fox_social_style_support(),
    'std'       => 'black',
    'name'      => 'Social Icons Style',
);

$options[ 'footer_social_shape' ] = array(
    'type'      => 'select',
    'options'   => [
        'square' => 'Square',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std'       => 'circle',
    'name'      => 'Social Icons Shape',
);

$options[ 'footer_social_size' ] = array(
    'type'      => 'select',
    'options'   => fox_social_size_support(),
    'std'       => 'normal',
    'name'      => 'Social Icons Size',
);

$options[ 'footer_social_spacing' ] = array(
    'type'      => 'select',
    'options'   => fox_social_spacing_support(),
    'std'       => 'small',
    'name'      => 'Social Icons Spacing',
);

$options[ 'footer_social_color' ] = array(
    'type'      => 'color',
    'name'      => 'Social Icons Color',
);

$options[ 'footer_social_background' ] = array(
    'type'      => 'color',
    'name'      => 'Social Icons Background',
);

$options[ 'footer_social_text' ] = array(
    'type'      => 'select',
    'options'   => [
        'none' => 'No text',
        'text-1' => 'Text 1',
        'text-2' => 'Text 2',
    ],
    'std'       => 'none',
    'name'      => 'Social Icons Text',
    
    'toggle' => [
        'text-1' => [ 'footer_social_text_size' ],
        'text-2' => [ 'footer_social_text_size' ],
    ],
);

$options[ 'footer_social_text_size' ] = array(
    'shorthand' => 'font-size',
    'selector'  => '.footer-social-list .scl-text',
    'name'      => 'Text size',
);

$options[ 'footer_search_heading' ] = array(
    'type'      => 'heading',
    'name'      => esc_html__( 'Footer Search', 'wi' ),
);

$options[ 'footer_search' ] = array(
    'name'      => 'Footer search box',
    'shorthand' => 'enable',
    'std'       => 'true',
    'desc'      => 'Footer Search Form is only available for Footer Bottom Stack Layout.',
    
    'hint' => 'Footer search',
);

$options[] = array(
    'type'      => 'heading',
    'name'      => esc_html__( 'Footer Copyright', 'wi' ),
);

$options[ 'footer_copyright' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Copyright',
    
    'hint' => 'Copyright text',
);    

$options[ 'copyright' ] = array(
    'type'      => 'textarea',
    'name'      => 'Copyright Text',
    'desc'      => 'You can use insert HTML as well.',
);

$id = 'copyright';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Copyright text font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' color',
    'selector'  => $fontdata[ 'selector' ],
    
    'hint' =>  'Copyright text color',
];

$options[ 'copyright' ] = array(
    'type'      => 'textarea',
    'name'      => 'Copyright Text',
    'desc'      => 'You can use insert HTML as well.',
);

$options[] = array(
    'type'      => 'heading',
    'name'      => esc_html__( 'Footer Menu', 'wi' ),
);

$id = 'footernav';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Footer menu font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' color',
    'selector'  => $fontdata[ 'selector' ],
    
    'hint' =>  'Footer menu color',
];

$options[ $id . '_hover_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' hover color',
    'selector' => '.footer-bottom .widget_nav_menu a:hover, #footernav a:hover',
];

$options[ 'footer_bottom_box' ] = array(
    'shorthand' => 'box',
    'name'      => 'Footer Bottom Box',
);

$options[ 'footer_bottom_builder' ] = array(
    'type'      => 'select',
    'options'   => [
        'true' => 'Yes Please',
        'false' => 'No Thanks!',
    ],
    'std' => 'false',
    'toggle' => [
        'true' => [ 'footer_bottom_layout' ],
    ],
    'name'      => 'Footer Bottom Builder',
);

$options[ 'footer_bottom_layout' ] = array(
    'type'      => 'select',
    'options'   => [
        'stack' => 'Stack',
        'inline' => 'Left - Right',
    ],
    'std'       => 'stack',
    'name'      => 'Footer Bottom Layout',
    'desc'      => 'If you choose "Stack", please add widgets to "Footer Bottom Stack" sidebar. If you choose "Left - Right", please add widgets to "Footer Bottom Left" and "Footer Bottom Right"',
);

/* Back To Top Button
-------------------------------------- */
$options[ 'backtotop' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => '"Back to top" button',

    'section'   => 'backtotop',
    'section_title' => 'Go To Top Button',
    'panel'     => 'footer',
    
    'hint' => 'Go to top/Scroll up',
);

$options[ 'backtotop_type' ] = array(
    'type' => 'select',
    'options' => [
        'text' => 'Text Button',
        'icon-arrow-up' => 'Arrow Up',
        'icon-chevron-up' => 'Chevron Up',
        'icon-chevrons-up' => 'Double Chevron Up'
    ],
    'std' => 'icon-chevron-up',
    'name'      => 'Button Type',
    
    'desc' => 'Note: If you want to use image for scroll up button, please head to <a href="javascript:wp.customize.section( \'wi_icon_images\' ).focus();">Customize > DESIGN > Icon Images</a>',

);

$options[ 'backtotop_shape' ] = array(
    'type' => 'select',
    'options' => [
        'square' => 'Square',
        'circle' => 'Circle',
    ],
    'std'       => 'circle',
    'name'      => 'Button Shape',
    'desc'      => 'Note: circle button only uses icon, it doesn\'t have text.',
);

$options[ 'backtotop_border_width' ] = array(
    'type' => 'select',
    'options' => [
        '' => 'Default',
        '0px' => 'No border',
        '1px' => '1px',
        '2px' => '2px',
        '3px' => '3px',
        '4px' => '4px',
    ],
    'std' => '',
    'property' => 'border-width',
    'selector' => '#backtotop.backtotop-circle, #backtotop.backtotop-square',
    'name'      => 'Border width',
);

$options[ 'backtotop_border_radius' ] = array(
    'shorthand' => 'border-radius',
    'selector' => '#backtotop.backtotop-circle, #backtotop.backtotop-square',
    'name'      => 'Custom Border radius',
);

$options[ 'backtotop_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '#backtotop',
    'name'      => 'Button Color',
);

$options[ 'backtotop_background_color' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '#backtotop',
    'name'      => 'Button Background Color',
);

$options[ 'backtotop_border_color' ] = array(
    'shorthand' => 'border-color',
    'selector'  => '#backtotop',
    'name'      => 'Button Border Color',
);

$options[ 'backtotop_hover_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '#backtotop:hover',
    'name'      => 'Button Hover Color',
);

$options[ 'backtotop_hover_background_color' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '#backtotop:hover',
    'name'      => 'Button Hover Background Color',
);

$options[ 'backtotop_hover_border_color' ] = array(
    'shorthand' => 'border-color',
    'selector'  => '#backtotop:hover',
    'name'      => 'Button Hover Border Color',
);