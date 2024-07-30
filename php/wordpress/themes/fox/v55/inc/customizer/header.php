<?php
$instruction = '
The Fox Header Builder uses Elementor to build custom header for flexibility. If you are not familiar with Elementor, we highly recommend you to use Classic Header (the default option) instead.

<br>
<br>

<a href="https://docs.withemes.com/thefox/the-fox-v5/fox-block-explained" target="_blank">Here is the guide to use header builder by Elementor</a>.
<br>
<br>
To customize the classic header, <a href="javascript:wp.customize.section( \'wi_header_classic\' ).focus();">go to section Classic Header</a>
';
/* Header General
-------------------------------------- */
$options[ 'header_builder_intro' ] = array(

    'type'      => 'html',
    'std'       => '<p class="fox-info">' . $instruction . '</p>',
    
    'section' => 'header_layout',
    'section_title' => 'General',

    'panel'   => 'header',
    'panel_title'=> esc_html__( 'Header', 'wi' ),
    'panel_priority' => 127,

);

$options[ 'header_builder' ] = array(

    'type'      => 'radio',
    'options'   => array(
        'elementor' => 'Header Builder (by Elementor)',
        'false' => 'Classic Header (Non-Elementor)',
        'true'  => '[Deprecated soon] Header Builder by widgets',
    ),
    'std'       => 'false',
    'name'      => 'Header Engine',
    
    'hint' => 'Header Builder',
    
    'toggle'    => [
        'true' => [
            'header_widget_builder_intro',
            'header_builder_float_right_from',
            'header_builder_center_logo',
            'header_builder_center_logo_height',
            'header_builder_stretch_container',
            'header_builder_stretch_container',
            'header_builder_valign',
            'main_header_box',
            'main_header_background_color',
            'sticky_header_element',
        ],
        'elementor' => [
            'header_elementor',
            'single_header_template',
            'page_header_template',
            'category_header_template',
            'tag_header_template',
            'author_header_template',
            'search_header_template',
            '404_header_template',
        ],
    ],

);

$header_list = [ '' => 'Choose Header' ];
$desc = '';
if ( function_exists( 'fox_get_block_list' ) ) {
    $header_list += $fox_block_list;
    if ( empty( $fox_block_list ) ) {
        $desc = 'Create or Import Predefined Headers <a href="' . admin_url( 'post-new.php?post_type=fox_block' ) . '" target="_blank" title="Open in new tab">HERE &raquo;</a>';
    } else {
        $desc = '';
    }
} else {
    $header_list = [ '' => 'You have to install FOX Framework plugin' ];
}

$options[ 'header_elementor' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'desc'      => $desc,
    'name'      => 'Global Header Template',
);

$options[ 'single_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Single Post',
);

$options[ 'page_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Page',
);

$options[ 'category_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Category',
);

$options[ 'tag_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Tag',
);

$options[ 'author_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Author',
);

$options[ 'search_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Search',
);

$options[ '404_header_template' ] = array(
    'type'      => 'select',
    'options'   => $header_list,
    'std'       => '',
    'name'      => 'Custom Header for Page 404',
);

$options[ 'header_widget_builder_intro' ] = array(
    'type'      => 'html',
    'std'      => '<p class="fox-info"><strong>Header Builder by widgets</strong> is introduced since Fox v4.0 but WON\'T be supported in the future, using widgets as header element so you can reorder much things easider. To use header builder, please enable it and go to "Customizer > Widgets" and drag widgets into "MAIN HEADER BUILDER" sidebar. "Before Header" and "After Header" sidebars display widgets before the main builder and after the main builder respectively.</p>',
);

$options[ 'header_builder_float_right_from' ] = array(
    'type'      => 'select',
    'options'   => [
        '-1' => 'No, all to the left',
        '1' => '1st element',
        '2' => '2nd element',
        '3' => '3rd element',
        '4' => '4th element',
        '5' => '5th element',
        '6' => '6th element',
    ],
    'std'       => '-1',
    'name'      => 'Float right from element?',
    'desc'      => 'Please note: If you have "center logo" enable, logo element won\'t be affected by this option.',
);

$options[ 'header_builder_center_logo' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Center Logo',
    'toggle'    => [ 
        'true' => [ 'header_builder_center_logo_height' ]
    ],
);

$options[ 'header_builder_center_logo_height' ] = array(
    'shorthand' => 'height',
    'std'       => '80',
    'name'      => 'Header Height',
    'desc'      => 'This only applies when you choose to centerize logo',
    'selector'  => '.main-header.has-logo-center .container',
);

$options[ 'header_builder_stretch_container' ] = array(
    'type' => 'select',
    'options'   => [
        'true' => 'Stretch it to screen width',
        'false' => 'No, just content width',
    ],
    'std'       => 'false',
    'name'      => 'Main header width',
);

$options[ 'header_builder_valign' ] = array(
    'type' => 'select',
    'options'   => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std'       => 'middle',
    'name'      => 'Items vertical align',
);

$options[ 'main_header_box' ] = array(
    'shorthand' => 'box',
    'name' => 'Main Header Box',
);

$options[ 'main_header_background_color' ] = array(
    'shorthand' => 'background-color',
    'name' => 'Main Header Background',
    'selector'  => '#main-header',
);

$options[ 'sticky_header_element' ] = array(
    'type'      => 'select',
    'name'      => 'Sticky Header Element?',
    'std'       => 'main-header',
    'options'   => [
        'before-header' => 'Before Header',
        'main-header' => 'Main Header',
        'after-header' => 'After Header',
    ],
    'std' => 'main-header',
);

/* Classic Header
------------------------------------ */
$options[ 'header_classic_intro' ] = array(

    'type'      => 'html',
    'std'       => '<p class="fox-info">If you use Header builder by Elementor, please skip this section</p>',
    
    'section' => 'header_layout',
    'panel' => 'header',
    'section' => 'header_classic',
    'section_title' => 'Classic Header',

);

$options[ 'header_layout' ] = array(
    'type'      => 'image_radio',
    'options'   => array(
        'stack1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/header-stack1.jpg',
            'width' => '120',
            'height' => 'auto',
            'title' => 'Stack 1',
        ],
        'stack2' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/header-stack2.jpg',
            'width' => '120',
            'height' => 'auto',
            'title' => 'Stack 2',
        ],
        'stack3' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/header-stack3.jpg',
            'width' => '120',
            'height' => 'auto',
            'title' => 'Stack 3',
        ],
        'stack4' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/header-stack4.jpg',
            'width' => '120',
            'height' => 'auto',
            'title' => 'Stack 4',
        ],
        'inline' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/header-inline.jpg',
            'width' => '120',
            'height' => 'auto',
            'title' => 'Inline',
        ],
    ),
    'std'       => 'stack1',
    'name'      => esc_html__( 'Header Layout', 'wi' ),
    
    'toggle' => [
        'stack1' => [ 'stack12_elements_order', 'navbar_height' ],
        'stack2' => [ 'stack12_elements_order', 'navbar_height' ],
    ],

    'hint' => 'Header classic layout',
);

$options[ 'branding_padding_top' ] = [
    'shorthand' => 'padding-top',
    'name' => 'Logo Area padding top',
    'desc' => 'Applied for Header layouts: Stack 1, 2, 3, 4',
    'selector' => '.header-row-branding',
    
    'hint' => 'Branding area padding top',
];

$options[ 'branding_padding_bottom' ] = [
    'shorthand' => 'padding-bottom',
    'name' => 'Logo Area padding bottom',
    'desc' => 'Applied for Header layouts: Stack 1, 2, 3, 4',
    'selector' => '.header-row-branding',
    
    'hint' => 'Branding area padding bottom',
];

$options[ 'branding_background' ] = [
    'shorthand' => 'background-color',
    'name' => 'Logo Area Background',
    'desc' => 'Applied for Header layouts: Stack 1, 2, 3, 4',
    'selector' => '.header-row-branding',
    
    'hint' => 'Branding area background',
];

$options[ 'header_stack12_elements_order' ] = [
    'type'  => 'select',
    'options' => [
        '1' => 'Left: Menu -- Right: Social/Search/Cart',
        '2' => 'Social -- Menu -- Search/Cart',
        '3' => 'Search/Cart -- Menu -- Social',
    ],
    'std' => '1',
    'name' => 'Navbar elements Order',
    'desc' => 'Applied for Header layous: Stack 1, 2',
    
    'hint' => 'Header Stack Elements order',
];

$options[ 'navbar_height' ] = [
    'type'  => 'text',
    'name' => 'Navbar height',
    'desc' => 'Applied for Header layous: Stack 1, 2',
    
    'hint' => 'Menu bar height',
];

$options[ 'navbar_stretch' ] = [
    'type'  => 'select',
    'options' => [
        'content' => 'Content width',
        'full' => 'Fullwidth',
    ],
    'std' => 'content',
    'name' => 'Navbar stretch',
    
    'hint' => 'Menu bar stretch',
];

/*
// SKIN
// it seems this is only for inline layout
@todo
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Header Skin',
);

$options[ 'header_skin' ] = array(
    'type'      => 'radio',
    'name'      => 'Header Skin',
    'options'   => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std' => 'light',
);
*/

// OTHER ELEMENTS
//
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Header Components',
);

$options[ 'header_social' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Header social icons',
    'desc' => 'To set up social URLs, please go to <a href="javascript:wp.customize.section( \'wi_social\' ).focus();">Social Profile section</a>.',
    
    'hint' => 'Header social icons',
);

$options[ 'header_social_size' ] = array(
    'type'      => 'select',
    'options'   => fox_social_size_support(),
    'std'       => 'medium',
    'name'      => 'Social icon size',
);

$options[ 'header_social_style' ] = array(
    'type'      => 'select',
    'options'   => fox_social_style_support(),
    'std'       => 'plain',
    'name'      => 'Social icon style',
);

$options[ 'header_search' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Header search',
    
    'hint' => 'Header search',
);

$options[ 'header_search_size' ] = array(
    'shorthand' => 'font-size',
    'std'       => '18px',
    'placeholder' => '18px',
    'selector' => '.header-search-wrapper .search-btn, .header-cart-icon, .hamburger-btn',
    'name'      => 'Header search icon size',
);

$options[ 'header_search_style' ] = array(
    'type'      => 'select',
    'options'   => [
        'classic'   => 'Classic',
        'modal'     => 'Modal',
    ],
    'std'       => 'classic',
    'name'      => 'Header search style',
    
    'toggle'    => [
        'modal' => [
            'search_modal_background',
            'search_modal_color',
            'search_modal_showing_effect',
        ],
    ],
    
    'hint' => 'Header search style',
);

$options[ 'search_modal_background' ] = array(
    'shorthand' => 'background-color',
    'std'       => '#fff',
    'selector'  => '.modal-search-wrapper',
    'name'      => 'Modal Search Background',
    
    'hint' => 'Search modal background',
);

$options[ 'search_modal_color' ] = array(
    'shorthand' => 'color',
    'std'       => '#000',
    'selector'  => '.modal-search-wrapper,.modal-search-wrapper .searchform .s,.modal-search-wrapper .close-modal,.modal-search-wrapper .searchform .submit',
    'name'      => 'Modal Search Text Color',
);

$options[ 'search_modal_showing_effect' ] = array(
    'type'      => 'select',
    'options'   => [
        'slide-right' => 'Slide right',
        'slide-down' => 'Slide down',
        'fade' => 'Fade In',
    ],
    'std'       => 'slide-right',
    'name'      => 'Modal Search Showing Effect',
);

$options[ 'header_inline_element_shortcode' ] = [
    'type' => 'textarea',
    'placeholder' => '[btn text="Login" url="#" /]',
    'name'      => 'Header custom element shortcode',
    
    'hint' => 'Header shortcode',
];

// STICKY HEADER
//
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Sticky Header',
);

$options[ 'header_sticky' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Sticky Header?',
    'std'       => 'true',
    
    'hint' => 'Sticky Header',
);

$options[ 'header_sticky_height' ] = array(
    'shorthand' => 'height',
    'name'      => 'Sticky Header Height',
    'std'       => '40',
    'selector'  => '.sticky-element-height, .header-sticky-element.before-sticky',
);

$options[ 'header_sticky_background_color' ] = array(
    'shorthand' => 'background-color',
    'name'      => 'Sticky Header Background',
    'selector'  => 'html .fox-theme .sticky-header-background',
);

$options[ 'header_sticky_background_opacity' ] = array(
    'shorthand' => 'opacity',
    'name'      => 'Sticky Header Background Opacity',
    'std'       => '1',
    'selector'  => 'html .fox-theme .sticky-header-background',
);

$options[ 'sticky_header_element_style' ] = array(
    'type'      => 'select',
    'name'      => 'Sticky Header Bottom Style',
    'options'   => [
        'border' => 'Border',
        'shadow' => 'Shadow',
        'heavy-shadow' => 'Heavy Shadow',
        'none' => 'None',
    ],
    'std'       => 'shadow',
);

$options[ 'header_sticky_logo' ] = array(
    'type'      => 'image',
    'name'      => 'Sticky Logo',
    
    'hint' => 'Sticky header logo',
);

$options[ 'header_sticky_logo_height' ] = array(
    'shorthand' => 'height',
    'name'      => 'Sticky Logo Height',
    'std'       => '40px',
    'selector'  => '.header-sticky-element.before-sticky #wi-logo img, .header-sticky-element.before-sticky .wi-logo img',
);

// TRANSPAPRENT HEADER
//
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Transparent Header',
);

$options[ 'header_transparent' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Transparent header?',
    'std'       => 'false',
    
    'desc' => 'We highly recommend you to use transparent header with fullscreen slider/carousel for best performance & display. This transparent header is only availble on homepage.',
    
    'hint' => 'Transparent Header',
);

$options[ 'transparent_logo' ] = array(
    'type'      => 'image',
    'name'      => 'Transparent header logo',
    
    'desc' => 'Should be a white png logo to replace normal logo in case you use image logo. For text logo, skip this.',
    
    'hint' => 'Transparent Logo',
);

$options[ 'transparent_mobile_logo' ] = array(
    'type'      => 'image',
    'name'      => 'Transparent mobile logo',
    
    'desc' => 'Should be a white png logo to replace normal mobile logo in case you use image logo for mobile version. If you dont have a custom mobile logo, skip it.',
);

/* Logo
-------------------------------------- */
$options[ 'logo_type' ] = [
    'type'  => 'select',
    'options' => [
        'text' => 'Text Logo',
        'image' => 'Image Logo',
    ],
    'std' => 'text',

    'toggle' => [
        'text' => [
            'logo_font',
            'logo_typography',
            'logo_color',
        ],
        'image' => [
            'logo', 
            // 'logo_retina', deprecated
            'logo_width',
        ],
    ],

    'section' => 'header_logo',
    'section_title' => 'Header Logo',
    'panel'   => 'header',
    
    'hint' => 'Header logo',
];

$options[ 'logo' ] = array(
    'type'      => 'image',
    'name'      => esc_html__( 'Upload your logo', 'wi' ),
    
    'hint' => 'Image Logo',
);

$options[ 'logo_width' ] = array(
    'shorthand' => 'width',
    'selector'  => '.fox-logo img',
    'name'      => esc_html__( 'Logo width (px)', 'wi' ),
    'placeholder' => 'Eg. 600px',
    
    'hint' => 'Logo width',
);

// since 4.0
$options[ 'logo_custom_link' ] = array(
    'type'      => 'text',
    'placeholder' => 'https://',
    'name'      => 'Logo Custom Link',
    'desc'      => 'By default your logo will link to your homepage.',
);

$id = 'logo';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

/* Standard font
------------------ */
$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => $name,
    'std'       => $std,
    'inherit_options' => true,

    'desc'       => 'Logo typography options are designed for text logo',
    
    'hint' => 'Logo font',
);

/* --------------   TYPOGRAPHY OPTIONS   --------------- */
$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ 'logo_color' ] = [
    'shorthand' => 'color',
    'name'      => 'Logo Color',
    'selector'  => fox_logo_selector(),
    
    'hint' => 'Logo color',
];

$options[ 'logo_box' ] = array(
    'shorthand' => 'box',
    'name'      => 'Logo margin',
    'fields'    => [ 'margin' ],
);

/**
 * Tagline
 */
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Tagline',
);

/* Sloggan Options
------------------ */
$options[ 'header_slogan' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Site Tagline',
    
    'hint' => 'Header tagline',
);

$id = 'tagline';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => $name,
    'std'       => $std,
    'inherit_options' => true,
);

/* --------------   TYPOGRAPHY OPTIONS   --------------- */
$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ 'tagline_color' ] = [
    'shorthand' => 'color',
    'name'      => 'Tagline Color',
    'selector'  => '.slogan',
];

/* ------------------------------------------   NAVIGATION ------------------------------------------ */
$options[ 'header_nav' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Header menu',

    'section'     => 'design_nav',
    'section_title'=> 'Header Menu',
    'panel'         => 'header',
    
    'hint' => 'Header menu',
);

$options[ 'header_hamburger' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Off-canvas hamburger button',
    'desc'      => 'To config off-canvas menu, please go to <a href="javascript:wp.customize.section( \'wi_mobile\' ).focus();">Mobile section</a>',
    
    'hint' => 'Header hamburger button',
);

$options[ 'mega_category_loading' ] = array(
    'type'      => 'radio',
    'name'      => 'Category mega loading method',
    'options'   => [
        'intime' => 'In time when hovered',
        'preload' => 'Preload',
    ],
    'std'       => 'preload',
    'hint' => 'Category mega menu loading method',
);

$options[ 'nav_skin' ] = array(
    'type' => 'radio',
    'options'   => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std'       => 'light',
    'name'      => 'Navigation bar skin',
    
    'hint' => 'Header menu skin',
);

$options[ 'nav_background' ] = array(
    'type'      => 'color',
    'property'  => 'background-color',
    'selector'  => '.header-row-nav, .header-row-nav.row-nav-dark, .sticky-header-background, .masthead-mobile-bg',
    'name'      => 'Navigation bar background',
    
    'hint' => 'Header menu background',
);

$options[ 'nav_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu > li > a, .header-social.style-plain:not(.style-text_color) a, .header-search-wrapper .search-btn, .header-cart-icon a, .hamburger-btn',
    'name'      => 'Menu Item Color',
    
    'hint' => 'Header menu color',
);

$options[ 'nav_hover_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu > li:hover > a',
    'name'      => 'Menu Item Hover Color',
);

$options[ 'nav_active_style' ] = array(
    'type'      => 'radio',
    'options'   => [
        '1' => 'Boxed background',
        '2' => 'Underline',
        '3' => 'Overline',
        '4' => 'None, just color',
    ],
    'std'       => '1',
    'toggle'    => [
        '1' => 'nav_active_bg_color',
    ],
    'name'      => 'Menu Item hover/active style',
);

$options[ 'nav_active_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu > li.current-menu-item > a, .wi-mainnav ul.menu > li.current-menu-ancestor > a,
    .row-nav-style-active-1 .wi-mainnav ul.menu > li.current-menu-item > a, .row-nav-style-active-1 .wi-mainnav ul.menu > li.current-menu-ancestor > a ',
    'name'      => 'Menu Item Active Color',
);

$options[ 'nav_active_bg_color' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '.row-nav-style-active-1 .wi-mainnav ul.menu > li.current-menu-item > a, .row-nav-style-active-1 .wi-mainnav ul.menu > li.current-menu-ancestor > a',
    'name'      => 'Item Active Background',
);

$options[ 'nav_border' ] = array(
    'type'      => 'select',
    'options'   => [
        '' => 'Default',
        'none'  => 'No border',
        'top-1'   => 'Top 1px',
        'top-2'   => 'Top 2px',
        'bottom-1'   => 'Bottom 1px',
        'bottom-2'   => 'Bottom 2px',
        'top-1|bottom-1'   => 'Top 1px - bottom 1px',
        'top-2|bottom-2'   => 'Top 2px - bottom 2px',
        'top-3|bottom-1'   => 'Top 3px - bottom 1px',
    ],
    'name'      => 'Navigation bar border',
    'std'       => '',
    
    'hint' => 'Header menu border',
);

$options[ 'nav_border_color' ] = array(
    'shorthand' => 'border-color',
    'selector'  => '.header-row-nav .container',
    'name'      => 'Navigation bar border color',
);

$id = 'nav';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

/* --------------   LOCAL FONT SUPPORT --------------- */
$options[ $id . '_font_source' ] = array(
    'type'      => 'select',
    'options'   => [
        'standard' => 'Google Font',
        'local' => 'Upload Your Font',
    ],
    'std'       => 'standard',
    'toggle'    => [
        'standard' => [ $id . '_font' ],
        'local' => [ $id . '_font_upload_notice', $id. '_font_upload_woff2', $id . '_font_upload_woff', $id. '_custom_font', $id . '_fallback_font' ],
    ],

    'name'      => $name . ' Source',
    
    'hint' => 'Header menu font',
);

/* Standard font
------------------ */
$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => $name,
    'std'       => $std,
    'inherit_options' => false,
);

/* Local font
------------------ */
$options[ $id . '_font_upload_notice' ] = [
    'type' => 'html',
    'std' => '<p class="fox-message"><strong>IMPORTANT</strong>: If you get error message <strong>"Sorry, this file type is not permitted for security reasons"</strong>, please install <strong>Fox Framework</strong> plugin in <em>Dashboard > Appearance > Install Plugins</em> to resolve it.</p>',
];

$options[ $id . '_font_upload_woff2' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff2 font file',
    'mime_type' => 'woff2',
];

$options[ $id . '_font_upload_woff' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff font file',
    'mime_type' => 'woff',
];

$options[ $id . '_custom_font' ] = [
    'type' => 'text',
    'name' => 'Font name (optional)',
];

$options[ $id . '_fallback_font' ] = [
    'type' => 'select',
    'options' => [
        'sans-serif' => 'Sans Serif',
        'serif' => 'Serif',
        'cursive' => 'Cursive',
        'monospace' => 'Monospace',
    ],
    'std' => 'sans-serif',
    'name' => 'Fallback font',
    'desc' => 'For characters your font doesn\'t support',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

// COLOR OPTIONS
//

$options[ 'nav_has_children_indicator' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu > li.menu-item-has-children > a:after, .wi-mainnav ul.menu > li.mega > a:after',
    'name'      => 'Item has children indicator color',
);

$options[ 'nav_has_children_indicator_content' ] = array(
    'type'      => 'select',
    'options'   => [
        'none' => 'None',
        'angle-down' => 'Angle down',
        'caret-down' => 'Caret down',
        'plus' => 'Plus (+)',
    ],
    'std'       => 'angle-down',
    'name'      => 'Item has children indicator content',
);

/* ------------------------------------------   DROPDOWN ------------------------------------------ */
// DROPDOWN
//
$options[] = array(
    'type'      => 'heading',
    'name'      => 'Submenu',
);

$id = 'nav_submenu';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

$options[ 'submenu_style' ] = array(
    'type'      => 'radio',
    'name'      => 'Submenu Skin',
    'options'  =>  array(
        'light'=>'Light',
        'dark'=>'Dark'
    ),
    'std'       => 'light',
    
    'hint' => 'Header menu dropdown skin',
);

$options[ $id . '_background' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '.wi-mainnav ul.menu ul',
    'name'      => 'Submenu Background',
);

/* deprecated
$options[ $id . '_caret_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu > li > ul > .caret',
    'name'      => 'Submenu Caret Color',
);
*/

// COLOR OPTIONS
//
$options[ $id . '_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu ul',
    'name'      => 'Submenu Item Color',
);

$options[ $id . '_hover_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu ul li:hover > a, .wi-mainnav ul.menu .post-nav-item-title:hover a, .wi-mainnav ul.menu > li.mega ul ul a:hover',
    'name'      => 'Submenu Item Hover Color',
);

$options[ $id . '_hover_background' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '.wi-mainnav ul.menu ul li:hover > a, .wi-mainnav ul.menu > li.mega ul ul a:hover',
    'name'      => 'Submenu Item Hover Background',
);

$options[ $id . '_active_color' ] = array(
    'shorthand' => 'color',
    'selector'  => '.wi-mainnav ul.menu ul li.current-menu-item > a, .wi-mainnav ul.menu ul li.current-menu-ancestor > a',
    'name'      => 'Submenu Item Active Color',
);

$options[ $id . '_active_background' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '.wi-mainnav ul.menu ul li.current-menu-item > a, .wi-mainnav ul.menu ul li.current-menu-ancestor > a',
    'name'      => 'Submenu Item Active Background',
);

$options[ $id . '_sep_color' ] = array(
    'shorthand' => 'border-color',
    'selector'  => '.wi-mainnav ul.menu ul > li, .mega-sep',
    'name'      => 'Seperator color between items',
);

$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => 'Submenu Font',
    'std'       => $std,
    'inherit_options'   => true,
);

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_box' ] = array(
    'shorthand' => 'box',
    'selector'  => '.wi-mainnav ul.menu ul',
    'fields'    => [ 'padding', 'margin', 'border', 'border-color', 'border-width', 'border-radius' ],
    'name'      => 'Submenu Box',
);

$options[ $id . '_item_box' ] = array(
    'shorthand' => 'box',
    'selector'  => '.wi-mainnav ul.menu ul a',
    'fields'    => [ 'padding' ],
    'name'      => 'Submenu item padding',
);

/* ------------------------------------------   HEADER BEFORE ------------------------------------------ */
$options[ 'before_header_sidebar' ] = array(
    'type'      => 'multicheckbox',
    'name'      => '"Before Main Header" shows on:',

    'options' => [
        'home'      => 'Homepage',
        'archive'   => 'Archive pages',
        'post'   => 'Single posts',
        'page'   => 'Single pages',
        'all'   => 'All',
    ],
    'std' => 'all',

    'section' => 'header_before',
    'section_title' => 'Before Header Sidebar',
    'panel' => 'header',
);

$options[ 'before_header_container' ] = array(
    'shorthand' => 'enable',
    'name'      => '"Before Main Header" width',

    'options' => [
        'true'      => 'Content width',
        'false'     => 'Stretch to full screenwidth',
    ],
    'std' => 'true',
);

$options[ 'before_header_align' ] = array(
    'type'      => 'select',
    'name'      => 'Alignment',
    'options' => [
        'left'      => 'Left',
        'center'     => 'Center',
        'right'     => 'Right',
    ],
    'std' => 'center',
);

$options[ 'before_header_box' ] = array(
    'shorthand' => 'box',
    'name' => 'Before Header Box',
);

$options[ 'before_header_background_color' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '#before-header',
    'name' => 'Before Header Background',
);

/* ------------------------------------------   AFTER HEADER ------------------------------------------ */

$options[ 'after_header_sidebar' ] = array(
    'type'      => 'multicheckbox',
    'name'      => '"After Main Header" shows on:',

    'options' => [
        'home'      => 'Homepage',
        'archive'   => 'Archive pages',
        'post'   => 'Single posts',
        'page'   => 'Single pages',
        'all'   => 'All',
    ],
    'std' => 'all',

    'section' => 'header_after',
    'section_title' => 'After Header Sidebar',
    'panel' => 'header',
);

$options[ 'after_header_container' ] = array(
    'shorthand' => 'enable',
    'name'      => '"After Main Header" width',

    'options' => [
        'true'      => 'Content width',
        'false'     => 'Stretch to full screenwidth',
    ],
    'std' => 'true',
);

$options[ 'after_header_align' ] = array(
    'type'      => 'select',
    'name'      => 'Alignment',
    'options' => [
        'left'      => 'Left',
        'center'     => 'Center',
        'right'     => 'Right',
    ],
    'std' => 'center',
);

$options[ 'after_header_box' ] = array(
    'shorthand' => 'box',
    'name' => 'After Header Box'
);

$options[ 'after_header_background_color' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '#after-header',
    'name' => 'After Header Background',
);