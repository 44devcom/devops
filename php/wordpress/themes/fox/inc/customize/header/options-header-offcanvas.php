<?php
$fox56_customize->add_section( 'header_offcanvas',[
    'title' => 'Offcanvas',
    'panel' => 'header',
]);

$fox56_customize->add_partial( 'offcanvas', [
    'selector' => '.offcanvas56',
    'render_callback' => 'fox56_offcanvas_inner',
]);

/* --------------------------------------------------------------------------------     OFF CANVAS */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'offcanvas_elements',
    'title' => 'Off-Canvas Elements',
    'std' => [
        'search',
        'nav',
        'social',
        'sidebar',
    ],
    'options' => [
        'search' => 'Search',
        'nav' => 'Menu',
        'social' => 'Social icons',
        'sidebar' => 'Offcanvas Sidebar',
        
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
        'html3' => 'HTML 3',

        'button1' => 'BUTTON 1',
        'button2' => 'BUTTON 2',
    ],
    'refresh' => 'offcanvas',
    'section' => 'header_offcanvas',
    'msg' => 'To add/remove Off-canvas widgets, you can go to Dashboard > Appearance > Widgets > Off-canvas',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'offcanvas_width',
    'title' => 'Off-Canvas Width',
    'std' => 320,
    'css' => [
        [
            'selector' => '.offcanvas56',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'background',
    'id' => 'offcanvas_background',
    'title' => 'Off-Canvas Background',
    'selector' => '.offcanvas56',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_text_color',
    'title' => 'Off-Canvas Text color',
    'css' => [
        [
            'selector' => '.offcanvas56',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'offcanvas_padding',
    'title' => 'Offcanvas Padding',
    'fields' => [
        'top' => [
            'type' => 'number',
            'name' => 'Top/bottom',
            'col' => '1-2', 
        ],
        'left' => [
            'type' => 'number',
            'name' => 'Left/right',
            'col' => '1-2', 
        ]
    ],
    'std' => [
        'top' => 16,
        'left' => 16,
    ],
    'css' => [
        [
            'selector' => '.offcanvas56',
            'unit' => 'px',
            'property' => 'padding-top',
            'use' => 'top',
        ],
        [
            'selector' => '.offcanvas56',
            'unit' => 'px',
            'property' => 'padding-bottom',
            'use' => 'top',
        ],
        [
            'selector' => '.offcanvas56',
            'unit' => 'px',
            'property' => 'padding-left',
            'use' => 'left',
        ],
        [
            'selector' => '.offcanvas56',
            'unit' => 'px',
            'property' => 'padding-right',
            'use' => 'left',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'offcanvas_item_spacing',
    'title' => 'Spacing between items',
    'hint' => 'offcanvas item spacing',
    
    'css' => [
        [
            'selector' => '.offcanvas56__element + .offcanvas56__element',
            'property' => 'margin-top',
            'unit' => 'px',
        ],
    ],
    'std' => 20,
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'offcanvas_animation',
    'title' => 'Items showing animation',
    'hint' => 'offcanvas item animation',
]);

/* --------------------------------------------------------------------------------     OFF CANVAS MENU */
$fox56_customize->add_field([
    'heading' => 'Off-canvas Menu',
    'type' => 'radio',
    'id' => 'offcanvas_nav_sep',
    'hint' => 'offcanvas menu item sep',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '1px',
    'title' => 'Separator betweeen items?',
    'css' => [
        [
            'selector' => '.offcanvasnav56 ul.sub-menu, .offcanvasnav56 li + li',
            'property' => 'border-top-width',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_sep_color',
    'title' => 'Separator color',
    'hint' => 'offcanvas menu item sep color',
    'css' => [
        [
            'selector' => '.offcanvasnav56 ul.sub-menu, .offcanvasnav56 li + li',
            'property' => 'border-top-color',
        ],
    ],
    'condition' => [ 'offcanvas_nav_sep' => '1px' ]
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'offcanvas_nav_col',
    'title' => 'Menu Column',
    'hint' => 'offcanvas menu column',
    'std' => '1',
    'options' => [
        '1' => '1 column',
        '2' => '2 columns',
    ],
    
    'refresh' => [
        'selector' => '.offcanvas56-mainnav', 
        'render_callback' => 'fox56_offcanvas_mainnav_inner',
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'offcanvas_nav_typography',
    'name' => 'Offcanvas typography',
    'hint' => 'offcanvas menu font',
    'std' => [
        'face' => 'var(--font-nav)',
    ],
    'exclude' => [ 'line_height' ],
    'selector' => '.offcanvasnav56',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'offcanvas_nav_item_height',
    'title' => 'Menu item height',
    'hint' => 'offcanvas menu item height',
    'std' => 46,
    'css' => [
        [
            'selector' => '.offcanvasnav56 a, .offcanvasnav56 .mk',
            'property' => 'line-height',
            'unit' => 'px',
        ],
        [
            'selector' => '.offcanvasnav56 .mk',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.offcanvasnav56 .mk',
            'property' => 'height',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_item_color',
    'title' => 'Menu item color',
    'hint' => 'offcanvas menu item color',
    'css' => [
        [
            'selector' => '.offcanvasnav56 a',
            'property' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_item_hover_color',
    'title' => 'Menu item hover color',
    'hint' => 'offcanvas menu item hover color',
    'css' => [
        [
            'selector' => '.offcanvasnav56 a:hover',
            'property' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_item_active_color',
    'title' => 'Menu item active color',
    'hint' => 'offcanvas menu item active color',
    'css' => [
        [
            'selector' => '.offcanvasnav56 .current-menu-item > a, .offcanvasnav56 .current-menu-ancestor > a, .offcanvasnav56 li.active > a',
            'property' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'offcanvas_nav_item_padding',
    'title' => 'Menu item padding',
    'hint' => 'offcanvas menu item padding',
    'std' => 0,
    'css' => [
        [
            'selector' => '.offcanvasnav56 a',
            'property' => 'padding-left',
            'unit' => 'px',
        ],
        [
            'selector' => '.offcanvasnav56 a',
            'property' => 'padding-right',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_item_hover_background',
    'title' => 'Menu item hover background',
    'hint' => 'offcanvas menu item hover background',
    'css' => [
        [
            'selector' => '.offcanvasnav56 a:hover',
            'property' => 'background-color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'offcanvas_nav_item_active_background',
    'title' => 'Menu item active background',
    'hint' => 'offcanvas menu item active background',
    'css' => [
        [
            'selector' => '.offcanvasnav56 .current-menu-item > a, .offcanvasnav56 .current-menu-ancestor > a, .offcanvasnav56 li.active > a',
            'property' => 'background-color',
        ],
    ],
]);