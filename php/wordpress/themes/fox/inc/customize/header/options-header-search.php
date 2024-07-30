<?php
$fox56_customize->add_section( 'header_search', [
    'title' => 'Search',
    'panel' => 'header',
]);

$fox56_customize->add_partial( 'header_search', [
    'selector' => '.header56__search',
    'render_callback' => 'fox56_header_search_inner',
]);

/* ---------------------------------------------        header preset */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'header_search_style',
    'title' => 'Search style',
    'std' => 'classic',
    'options'     => [
        'classic' => 'Icon + Dropdown',
        'toggle' => 'Icon + Toggle',
        'modal' => 'Icon + Flying Fullscreen',
        'visible' => 'Standard Visible Form',
    ],
    
    'section' => 'header_search',
    'refresh' => 'header_search',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'search_icon_image',
    'title' => 'Custom search icon image',
    'refresh' => [
        'render_callback' => 'fox56_icon_search',
        'selector' => [
            '.search-btn, .searchform button',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'search_icon_image_width',
    'title' => 'Custom search icon width',
    'std' => 32,
    'css' => [
        [
            'selector' => '.search-btn img, .searchform button img',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_search_btn_size',
    'title' => 'Search button size',
    'std' => 18,
    'css' => [
        [
            'selector' => '.header56__search .search-btn',
            'property' => 'font-size',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_search_btn_color',
    'title' => 'Search button color',
    'css' => [
        [
            'selector' => '.header56__search .search-btn',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_search_btn_hover_color',
    'title' => 'Search button hover color',
    'css' => [
        [
            'selector' => '.header56__search .search-btn:hover',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_search_modal_background',
    'title' => 'Modal search background',
    'css' => [
        [
            'selector' => '.search-wrapper-modal',
            'property' => 'background-color',
        ]
    ],
    'condition' => [ 'header_search_style' => 'modal' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_search_modal_text_color',
    'title' => 'Modal search text color',
    'css' => [
        [
            'selector' => '.search-wrapper-modal',
            'property' => 'color',
        ],
        [
            'selector' => '.modal-search-content .s',
            'property' => 'color',
        ],
        [
            'selector' => '.modal-search-content .s',
            'property' => 'border-color',
        ],
        [
            'selector' => '.modal-search-content .s::-webkit-input-placeholder',
            'property' => 'color',
        ],
        [
            'selector' => '.modal-search-content .s:focus::-webkit-input-placeholder',
            'property' => 'color',
        ],
        [
            'selector' => '.modal-search-content .s::-moz-placeholder',
            'property' => 'color',
        ],
    ],
    
    'condition' => [ 'header_search_style' => 'modal' ],
    'msg' => 'To enable Search suggestion items, please go to <strong><a href="' . get_admin_url( false, 'nav-menus.php' ) . '" target="_blank">Dashboard &raquo; Appearance &raquo; Menus</a></strong> and create a new menu then assign it as "Flying Search Suggestions"',
]);