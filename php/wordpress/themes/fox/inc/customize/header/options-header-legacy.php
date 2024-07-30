<?php
/* Header widgets builder
---------------------------------------------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'header_widgets_builder',
    'title' => 'Use Header Builder by widgets?',
    'std'     => false,
    'desc' => 'This option will be deprecated soon.',
    
    'section' => 'header_legacy',
    'section_title' => 'Legacy',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'type' => 'message',
    'html' => '<strong>Header Builder by widgets</strong> is introduced since Fox v4.0 but WON\'T be supported in the future, using widgets as header element so you can reorder much things easider. To use header builder, please enable it and go to "Customizer > Widgets" and drag widgets into "MAIN HEADER BUILDER" sidebar. "Before Header" and "After Header" sidebars display widgets before the main builder and after the main builder respectively.',
]);

$fox56_customize->add_field([
    'id' => 'header_builder_float_right_from',
    
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
]);

$fox56_customize->add_field([
    'id' => 'header_builder_center_logo',
    
    'type'      => 'select',
    'options'   => [
        'true' => 'Yes',
        'false' => 'No',
    ],
    'std'       => 'false',
    'name'      => 'Center Logo',
]);

$fox56_customize->add_field([
    'id' => 'header_builder_center_logo_height',
    'type' => 'slider',
    'sdt' => 80,
    'choices' => [
        'min' => 20,
        'max' => 200,
        'step' => 2,
    ],
    
    'name'      => 'Header Height',
    'desc'      => 'This only applies when you choose to centerize logo',
    
    'output' => [
        [
            'element'  => '.main-header.has-logo-center .container',
            'property' => 'height',
        ]
    ],
    
    'condition' => [ 'header_builder_center_logo', 'true' ]
]);

$fox56_customize->add_field([
    'id' => 'header_builder_stretch_container',
    'type' => 'select',
    'options'   => [
        'true' => 'Stretch it to screen width',
        'false' => 'No, just content width',
    ],
    'std'       => 'false',
    'name'      => 'Main header width',
]);

$fox56_customize->add_field([
    'id' => 'header_builder_valign',
    'type' => 'select',
    'options'   => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std'       => 'middle',
    'name'      => 'Items vertical align',
]);

$fox56_customize->add_field([
    'id' => 'main_header_background_color',
    'type' => 'color',
    'name' => 'Main Header Background',
    'output' => [
        [
            'element' => '#main-header',
            'property' => 'background-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'id' => 'sticky_header_element',
    'type' => 'select',
    'name' => 'Sticky Header Element?',
    'std'       => 'main-header',
    'options'   => [
        'before-header' => 'Before Header',
        'main-header' => 'Main Header',
        'after-header' => 'After Header',
    ],
]);

$fox56_customize->add_field([
    'id' => 'main_header_box',
    'type' => 'box',
    'selector' => '#main-header .container',
    'name' => 'Header Padding/Margin/Border',
    'include' => [ 'padding', 'margin', 'border' ],
    
    'responsive' => true,
]);

$fox56_customize->add_field([
    'id' => 'main_header_border_color',
    'type' => 'color',
    'name' => 'Header Border color',
    'output' => [
        [
            'element' => '#main-header .container',
            'property' => 'border-color'
        ]
    ]
]);

/* Before header sidebar
---------------------------------------------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'heading',
    'html' => 'Before Header',
]);

$fox56_customize->add_field([
    'id' => 'before_header_sidebar',
    'type'      => 'multicheckbox',
    'name'      => '"Before Main Header" shows on:',

    'options' => [
        'home'      => 'Homepage',
        'archive'   => 'Archive pages',
        'post'   => 'Single posts',
        'page'   => 'Single pages',
        'all'   => 'All',
    ],
    'std' => [ 'all' ],
]);

$fox56_customize->add_field([
    'id' => 'before_header_container',
    'name'      => '"Before Main Header" width',
    'type' => 'radio',
    'options' => [
        'true'      => 'Content width',
        'false'     => 'Stretch to full screenwidth',
    ],
    'std' => 'true',
]);

$fox56_customize->add_field([
    'id' => 'before_header_align',
    'type'      => 'select',
    'name'      => 'Alignment',
    'options' => [
        'left'      => 'Left',
        'center'     => 'Center',
        'right'     => 'Right',
    ],
    'std' => 'center',
]);

$fox56_customize->add_field([
    'id' => 'before_header_background_color',
    'type' => 'color',
    'name' => 'Before Header Background',
    'output' => [
        [
            'element' => '#before-header',
            'property' => 'background-color'
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'before_header_box',
    'type' => 'box',
    'name' => 'Before Header Margin/Paddin/Border',
    'selector' => '#before-header .container',
    
    'include' => [ 'padding', 'margin', 'border' ],
    'responsive' => true,
]);

$fox56_customize->add_field([
    'id' => 'before_header_border_color',
    'type' => 'color',
    
    'name' => 'Header Border color',
    'output' => [
        [
            'element' => '#before-header .container',
            'property' => 'border-color'
        ]
    ]
]);


/* After header sidebar
---------------------------------------------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'heading',
    'html' => 'After Header',
]);

$fox56_customize->add_field([
    'id' => 'after_header_sidebar',
    'type'      => 'multicheckbox',
    'name'      => '"After Main Header" shows on:',

    'options' => [
        'home'      => 'Homepage',
        'archive'   => 'Archive pages',
        'post'   => 'Single posts',
        'page'   => 'Single pages',
        'all'   => 'All',
    ],
    'std' => [ 'all' ],
]);

$fox56_customize->add_field([
    'id' => 'after_header_container',
    'name' => '"After Main Header" width',
    'type' => 'radio',
    'options' => [
        'true'      => 'Content width',
        'false'     => 'Stretch to full screenwidth',
    ],
    'std' => 'true',
]);

$fox56_customize->add_field([
    'id' => 'after_header_align',
    'type'      => 'select',
    'name'      => 'Alignment',
    'options' => [
        'left'      => 'Left',
        'center'     => 'Center',
        'right'     => 'Right',
    ],
    'std' => 'center',
]);

$fox56_customize->add_field([
    'id' => 'after_header_background_color',
    'type' => 'color',
    'name' => 'After Header Background',
    'output' => [
        [
            'element' => '#after-header',
            'property' => 'background-color'
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'after_header_box',
    'type' => 'box',
    'name' => 'After Header Margin/Paddin/Border',
    'selector' => '#after-header .container',
    
    'include' => [ 'padding', 'margin', 'border' ],
    'responsive' => true,
]);

$fox56_customize->add_field([
    'id' => 'after_header_border_color',
    'type' => 'color',
    
    'name' => 'Header Border color',
    'output' => [
        [
            'element' => '#after-header .container',
            'property' => 'border-color'
        ]
    ]
]);