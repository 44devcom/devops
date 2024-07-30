<?php
$fox56_customize->add_section( 'header_nav',[
    'title' => 'Navigation Menu',
    'panel' => 'header',
]);

$fox56_customize->add_partial( 'header_nav',[
    'selector' => '.header56__nav',
    'render_callback' => 'fox56_header_nav_inner',
]);

/* Size
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_item_spacing',
    'title' => 'Item Spacing',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a',
            'property' => 'padding-left',
            'unit' => 'px',
        ],
        [
            'selector' => '.mainnav ul.menu > li > a',
            'property' => 'padding-right',
            'unit' => 'px',
        ],
    ],
    'std' => 12,
    'section' => 'header_nav',
    'hint' => 'menu item spacing',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'nav_typography',
    'name' => 'Menu typography',
    'std' => [
        'weight' => 400,
        'spacing' => 0,
        'transform' => 'uppercase',
        'size' => 14,
    ],
    'exclude' => [ 'face', 'line_height' ],
    'selector' => '.mainnav ul.menu > li > a',
    'hint' => 'menu item font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_item_height',
    'title' => 'Item height',
    'hint' => 'menu item height',
    
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a',
            'property' => 'line-height',
            'unit' => 'px',
        ],
    ],
    'std' => 40,
    'choices' => [
        'min' => 16,
        'max' => 80,
        'step' => 2,
    ],
]);

/* Separator
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'nav_item_sep',
    'title' => 'Item separator?',
    'hint' => 'menu item sep?',
    
    // 'heading' => 'Item Separator',
    // 'heading_size' => 'small',
    
    'refresh' => 'header_nav',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_item_sep_color',
    'title' => 'Separator color',
    'hint' => 'menu item sep color',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li + li > a:before',
            'property' => 'border-color',
        ]
    ],
    
    'condition' => [ 'nav_item_sep' => true ]
]);

/* Item
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
        'active' => 'Active',
    ],
    'id' => 'header_nav__tabs',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_color',
    'title' => 'Menu item color',
    
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a',
            'property' => 'color',
        ]
    ],
    'tabs' => 'header_nav__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_background',
    'title' => 'Menu item background',
    
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a',
            'property' => 'background',
        ]
    ],
    'tabs' => 'header_nav__tabs',
    'tab' => 'normal',
]);

/* Item Hover
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_hover_color',
    'title' => 'Menu item hover color',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a:hover',
            'property' => 'color',
        ]
    ],
    
    'tabs' => 'header_nav__tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_hover_background',
    'title' => 'Menu item hover background',

    'tabs' => 'header_nav__tabs',
    'tab' => 'hover',
    
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a:hover',
            'property' => 'background',
        ]
    ]
]);


/* Active
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_active_color',
    'title' => 'Menu item active color',
    
    'tabs' => 'header_nav__tabs',
    'tab' => 'active',
    
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li.current-menu-item > a, .mainnav ul.menu > li.current-menu-ancestor > a',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_active_background',
    'title' => 'Menu item active background',

    'tabs' => 'header_nav__tabs',
    'tab' => 'active',

    'css' => [
        [
            'selector' => '.mainnav ul.menu > li.current-menu-item > a, .mainnav ul.menu > li.current-menu-ancestor > a',
            'property' => 'background',
        ]
    ]
]);

/* Active Style
------------------------------------------------------------ */
$fox56_customize->add_field([
    'heading' => 'Item active style',
    'type' => 'radio',
    'id' => 'nav_active_style',
    'title' => 'Item active style',
    'hint' => 'menu item active style',
    'options' => [
        'bar-top' => 'Bar top',
        'bar-bottom' => 'Bar bottom',
        'none' => 'None',
    ],
    'std' => 'none',
    'refresh' => 'header_nav',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_active_style_border_width',
    'title' => 'Active bar width (%)',
    'hint' => 'menu item active bar width',
    
    'std' => 90,
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a:after',
            'property' => 'width',
            'unit' => '%',
        ],
        [
            'selector' => '.mainnav ul.menu > li > a:after',
            'property' => 'left',
            'value_pattern' => 'calc((100% - $%)/2)', 
        ],
    ],
    
    'condition' => [ 'nav_active_style' => [ 'bar-top', 'bar-bottom' ] ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_active_style_border_height',
    'title' => 'Active bar thickness',
    'hint' => 'menu item active bar thickness',
    
    'std' => 2,
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a:after',
            'property' => 'height',
            'unit' => 'px',
        ]
    ],
    
    'condition' => [ 'nav_active_style' => [ 'bar-top', 'bar-bottom' ] ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_active_style_border_color',
    'title' => 'Active bar color',
    'hint' => 'menu item active bar color',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li > a:after',
            'property' => 'background',
        ]
    ],
    'condition' => [ 'nav_active_style' => [ 'bar-top', 'bar-bottom' ] ]
]);

/* Indicator
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'nav_dropdown_indicator',
    'title' => 'Dropdown indicator',
    'options' => [
        'angle-down' => 'Angle down',
        'caret-down' => 'Caret down',
        'plus' => 'Plus (+)',
        'none' => 'None',
    ],
    'std' => 'angle-down',
    
    'refresh' => 'header_nav',
    
    'heading' => 'Has children indicator',
    'heading_size' => 'small',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_indicator_color',
    'title' => 'Dropdown indicator color',
    
    'css' => [
        [
            'selector' => '.mainnav .mk',
            'property' => 'color',
        ]
    ],
    
    'active_callback' => [
        [
            'setting' => 'fox56_nav_dropdown_indicator',
            'operator' => '!=',
            'value' => 'none',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_indicator_size',
    'title' => 'Dropdown indicator size',
    
    'css' => [
        [
            'selector' => '.mainnav .mk',
            'property' => 'font-size',
            'unit' => 'px',
        ]
    ],
    'std' => 14,
    'choices' => [
        'min' => 6,
        'max' => 30,
        'step' => 1,
    ],
    
    'active_callback' => [
        [
            'setting' => 'fox56_nav_dropdown_indicator',
            'operator' => '!=',
            'value' => 'none',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_indicator_spacing',
    'title' => 'Dropdown indicator spacing',
    
    'css' => [
        [
            'selector' => '.mainnav .mk',
            'property' => 'margin-left',
            'unit' => 'px',
        ]
    ],
    'std' => 3,
    'choices' => [
        'min' => 0,
        'max' => 20,
        'step' => 1,
    ],
    
    'active_callback' => [
        [
            'setting' => 'fox56_nav_dropdown_indicator',
            'operator' => '!=',
            'value' => 'none',
        ]
    ]
]);

/* Dropdown Menu
------------------------------------------------------------ */
$fox56_customize->add_field([
    'heading' => 'Dropdown',
    'type' => 'number',
    'id' => 'nav_dropdown_width',
    'title' => 'Dropdown width',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.mega.column-2 > .sub-menu',
            'property' => 'width',
            'value_pattern' => 'calc(2*$)',
            'unit' => 'px',
        ],
        [
            'selector' => '.mega.column-3 > .sub-menu',
            'property' => 'width',
            'value_pattern' => 'calc(3*$)',
            'unit' => 'px',
        ],
    ],
    'std' => 180,
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_background',
    'title' => 'Dropdown background',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'background',
        ],
    ],
    'std' => '#fff',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_padding_top',
    'title' => 'Padding top/bottom',
    'hint' => 'dropdown padding top/bottom',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'padding-top',
            'unit' => 'px',
        ],
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'padding-bottom',
            'unit' => 'px',
        ],
    ],
    
    'std' => 0,
    'choices' => [
        'min' => 0,
        'max' => 40,
        'step' => 2,
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_padding_left',
    'title' => 'Padding left/right',
    'hint' => 'dropdown padding left/right',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'padding-left',
            'unit' => 'px',
        ],
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'padding-right',
            'unit' => 'px',
        ],
    ],
    
    'std' => 0,
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'nav_dropdown_border',
    'title' => 'Dropdown border width',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-4',
        ],
        'right' => [
            'name' => 'Right',
            'type' => 'number',
            'col' => '1-4',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-4',
        ],
        'left' => [
            'name' => 'Left',
            'type' => 'number',
            'col' => '1-4',
        ],
    ],
    'std' => [
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'left' => 0,
    ],
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
    ],
    'std' => 0,
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_border_radius',
    'title' => 'Dropdown border radius',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'std' => 0,
    'choices' => [
        'min' => 0,
        'max' => 30,
        'step' => 2,
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_border_color',
    'title' => 'Dropdown border color',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'border-color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_shadow',
    'title' => 'Dropdown shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu',
            'property' => 'box-shadow',
            'value_pattern' => '0 5px 20px rgba(0,0,0,0.$)',
        ]
    ],
]);

/* Dropdown arrow
-------------------------------- */
$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'nav_dropdown_arrow',
    'title' => 'Enable dropdown arrow?',
    'refresh' => 'header_nav',
    
    'heading' => 'Dropdown arrow',
    'heading_size' => 'small',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_arrow_inner_color',
    'title' => 'Dropdown arrow inner',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li.menu-item-has-children:after,.mainnav ul.menu > li.mega:after',
            'property' => 'border-bottom-color',
        ],
    ],
    'std' => '#fff',
    
    'condition' => [ 'nav_dropdown_arrow' => true ],
]);
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_arrow_outer_color',
    'title' => 'Dropdown arrow inner',
    'css' => [
        [
            'selector' => '.mainnav ul.menu > li.menu-item-has-children:before,.mainnav ul.menu > li.mega:before',
            'property' => 'border-bottom-color',
        ],
    ],
    'std' => '#ccc',
    
    'condition' => [ 'nav_dropdown_arrow' => true ],
]);

/* Dropdown item
-------------------------------- */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'nav_submenu_typography',
    'heading' => 'Menu Dropdown Item',
    'std' => [
        'face' => 'var(--font-nav)',
        'weight' => 400,
        'spacing' => 0,
        'transform' => 'uppercase',
        'size' => 12,
    ],
    'exclude' => [ 'line_height' ],
    'selector' => '.mainnav ul.sub-menu, .post-nav-item-title',
]);

$fox56_customize->add_field([
    'type' => 'tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
        'active' => 'Active',
    ],
    'id' => 'header_nav_dropdown__tabs',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_item_padding',
    'title' => 'Dropdown item padding',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a',
            'property' => 'padding-left',
            'unit' => 'px',
        ],
        [
            'selector' => '.mainnav ul.sub-menu a',
            'property' => 'padding-right',
            'unit' => 'px',
        ],
    ],
    'std' => 12,
    'choices' => [
        'min' => 0,
        'max' => 40,
        'step' => 2,
    ],
    
    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'normal',
]);
$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'nav_dropdown_item_height',
    'title' => 'Dropdown item height',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a',
            'property' => 'line-height',
            'unit' => 'px',
        ],
    ],
    'std' => 28,
    'choices' => [
        'min' => 12,
        'max' => 50,
        'step' => 2,
    ],

    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_color',
    'title' => 'Dropdown item color',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a',
            'property' => 'color',
        ],
    ],

    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_background',
    'title' => 'Dropdown item background',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a',
            'property' => 'background-color',
        ],
    ],

    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'normal',
]);

/* Dropdown hover
-------------------------------- */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_hover_color',
    'title' => 'Hover color',
    'hint' => 'dropdown item hover color',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a:hover',
            'property' => 'color',
        ],
    ],
    
    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_hover_background',
    'title' => 'Hover background',
    'hint' => 'dropdown item hover background',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu a:hover',
            'property' => 'background-color',
        ],
    ],

    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'hover',
]);

/* Dropdown active
-------------------------------- */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_active_color',
    'title' => 'Active color',
    'hint' => 'dropdown item active color',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu > li.current-menu-item > a, .mainnav ul.sub-menu > li.current-menu-ancestor > a',
            'property' => 'color',
        ],
    ],
    
    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'active',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_active_background',
    'title' => 'Active background',
    'hint' => 'dropdown item active background',
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu > li.current-menu-item > a, .mainnav ul.sub-menu > li.current-menu-ancestor > a',
            'property' => 'background-color',
        ],
    ],

    'tabs' => 'header_nav_dropdown__tabs',
    'tab' => 'active',
]);

/* Dropdown separator
-------------------------------- */
$fox56_customize->add_field([
    'heading' => 'Dropdown item separator',
    'type' => 'checkbox',
    'id' => 'nav_dropdown_item_sep',
    'title' => 'Item separator',
    'hint' => 'dropdown item sep',
    
    'refresh' => 'header_nav',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'nav_dropdown_item_sep_color',
    'title' => 'Separator color',
    'hint' => 'dropdown item sep color',
    
    'css' => [
        [
            'selector' => '.mainnav ul.sub-menu li',
            'property' => 'border-top-color',
        ],
        [
            'selector' => '.mainnav li.mega .sub-menu > li:before',
            'property' => 'border-left-color',
        ],
    ],
    
    'condition' => [ 'nav_dropdown_item_sep' => true ],
]);

/* Mega Menu
-------------------------------- */
$fox56_customize->add_field([
    'heading' => 'Mega Menu',
    'type' => 'select',
    'id' => 'nav_mega_thumbnail',
    'title' => 'Mega Menu post thumbnail',
    'options' => [
        'thumbnail' => 'Thumbnail (150x150)',
        'thumbnail-medium' => 'Landscape (480x384)',
        'thumbnail-square' => 'Square (480x480)',
        'thumbnail-portrait' => 'Portrait (480x600)',
        'thumbnail-large' => 'Large (720x480)',
        'medium' => 'Medium (no crop)',
        'large' => 'Large (no crop)',
        'full' => 'Full (original)',
        'custom' => 'Custom',
    ],
    'std' => 'thumbnail-medium',
    'refresh' => 'header_nav',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'nav_mega_thumbnail_custom',
    'title' => 'Mega Menu post thumbnail custom',
    'condition' => [ 'nav_mega_thumbnail' => 'custom' ],
    'fields' => [
        'width' => [
            'type' => 'number',
            'step' => 10,
            'name' => 'Width',
            'col' => '1-2',
        ],
        'height' => [
            'type' => 'number',
            'step' => 10,
            'name' => 'Height',
            'col' => '1-2',
        ],
    ],
    'std' => [
        'width' => 400,
        'height' => 300,
    ],
    'refresh' => 'header_nav',
]);