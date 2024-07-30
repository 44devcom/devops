<?php
$fox56_customize->add_section( 'design_widget',[
    'title' => 'Sidebar Widget',
    'panel' => 'design'
]);

/* ---------------------------------------------        WIDGET */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'wid_sep',
    'name' => 'Border between widgets',
    'options' => [
        '1px' => 'Yes',
        '0px' => 'No',
    ],
    'std' => '0px',
    'css' => [
        [
            'selector' => '.widget + .widget',
            'property' => 'border-top-width',
        ]
    ],
    'section' => 'design_widget',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'wid_sep_color',
    'name' => 'Border color between widgets',
    'css' => [
        [
            'selector' => '.widget + .widget',
            'property' => 'border-top-color',
        ]
    ],
]);

/* ---------------------------------------------        WIDGET */
$fox56_customize->add_field([
    'type' => 'typography',
    /**
     * WOW, we're in big trouble if we name the setting by widget_SOMETHING
     */
    'id' => 'wid_title_typography',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '400',
        'spacing' => 2,
        'transform' => 'uppercase',
        'size' => 12,
    ],
    'selector' => '.widget-title, .secondary56 .wp-block-heading',

    'heading' => 'Widget title',
    'section' => 'design_widget',

    'hint' => 'widget title font',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'wid_title_align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'css' => [
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'text-align',
        ],
    ],
    'name' => 'Widget title align',

    'hint' => 'widget title align',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'wid_title_background',
    'css' => [
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'background',
        ],
    ],
    'name' => 'Widget title background',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'wid_title_color',
    'css' => [
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'color',
        ],
    ],
    'name' => 'Widget title color',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'wid_title_border',
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
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
    ],
    'name' => 'Widget title border',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'wid_title_border_color',
    'css' => [
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'border-color',
        ],
    ],
    'name' => 'Border color',

    'hint' => 'widget title border color',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'wid_title_padding',
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
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'padding-top',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'padding-right',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.widget-title, .secondary56 .wp-block-heading',
            'property' => 'padding-left',
            'unit' => 'px',
            'use' => 'left',
        ],
    ],
    'name' => 'Widget title padding',
]);

/* ---------------------------------------------        LIST WIDGET */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'list_widget_typography',
    'heading' => 'List Widgets',
    'desc' => 'List Widgets are: Categories, Navigation Menu, Archives..',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '400',
        'spacing' => '',
        'transform' => 'none',
        'line_height' => '',
        'size' => 16,
    ],
    'selector' => '.widget_archive, .widget_nav_menu, .widget_meta, .widget_recent_entries, .widget_categories, .widget_product_categories, .widget_recent_comments',

    'hint' => 'list widget font',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'list_widget_border_style',
    'options' => [
        'none' => 'None',
        'solid' => 'Solid',
        'dotted' => 'Dotted',
        'dashed' => 'Dashed',
    ],
    'std' => 'none',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--list-widget-border-style',
        ],
    ],
    'name' => 'Sep between items',
    'hint' => 'list widget item sep',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'list_widget_border_color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--list-widget-border-color',
        ],
    ],
    'name' => 'Sep color',
    'hint' => 'list widget item sep color',
]);

/* ---------------------------------------------        TAG CLOUD */
$fox56_customize->add_field([
    'heading' => 'Tagcloud',
    'type' => 'radio',
    'id' => 'tagcloud_style',
    'name' => 'Tagcloud style',
    'options' => [
        '1' => 'Style 1',
        '2' => 'Style 2',
        '3' => 'Style 3',
    ],
    'std' => '1',
    'hint' => 'tagcloud style',
]);