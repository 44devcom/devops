<?php
$fox56_customize->add_section( 'design_form',[
    'title' => 'Form Input & Button',
    'panel' => 'design'
]);

/* ---------------------------------------------        BUTTON */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'button_typography',
    'heading' => 'Button',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => 700,
        'spacing' => 1,
        'transform' => 'uppercase',
        'size' => 12,
    ],
    'selector' => 'button,input[type="submit"],.btn56',
    'section' => 'design_form',

    'hint' => 'button font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'button_border_radius',
    'name' => 'Button border radius', 
    'css' => [
        [
            'selector' => ':root',
            'property' => '--button-border-radius',
            'unit' => 'px',
        ]
    ],
    'std' => 0,

    'hint' => 'button border radius',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'button_height',
    'title' => 'Button Height',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--button-height',
            'unit' => 'px',
        ],
    ],
    'step' => 2,
    'std' => 48,

    'hint' => 'button height',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'button_padding',
    'title' => 'Button Padding',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--button-padding',
            'unit' => 'px',
        ],
    ],
    'step' => 4,
    'std' => 28,
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'button_shadow',
    'title' => 'Button shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => ':root',
            'property' => '--button-shadow',
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'button_hover_shadow',
    'title' => 'Button hover shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => ':root',
            'property' => '--button-hover-shadow',
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ]
    ],
]);

/* ---------------------------------------------        INPUT */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'input_typography',
    'title' => 'Input typography',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => 400,
        'spacing' => 1,
        'transform' => 'uppercase',
        'size' => 16,
    ],
    'selector' => 'input[type="text"], input[type="number"], input[type="email"], input[type="url"], input[type="date"], input[type="password"], textarea, .fox-input',
    'heading' => 'Input',

    'hint' => 'input font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_border_width',
    'title' => 'Border width',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-border-width',
            'unit' => 'px',
        ],
    ],
    'std' => 1,
    'heading' => 'Input Design',

    'hint' => 'input border width',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_border_radius',
    'title' => 'Border radius',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-border-radius',
            'unit' => 'px',
        ],
    ],
    'std' => 1,
    'hint' => 'input border radius',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_height',
    'title' => 'Input Height',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-height',
            'unit' => 'px',
        ],
    ],
    'step' => 2,
    'std' => 46,
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_placeholder_opacity',
    'title' => 'Placeholder opacity',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-placeholder-opacity',
            'value_pattern' => '0.$',
        ],
    ],
    'std' => 6,

    'hint' => 'input placeholder opacity',
]);

$fox56_customize->add_field([
    'type' => 'tabs',
    'tabs' => [
        'normal' => 'Normal',
        'focus' => 'Focus',
    ],
    'id' => 'input__tabs',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_background',
    'title' => 'Input background',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-background',
        ],
    ],
    'tabs' => 'input__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_color',
    'title' => 'Input text color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-color',
        ],
    ],

    'tabs' => 'input__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_border_color',
    'title' => 'Input border color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-border-color',
        ],
    ],

    'tabs' => 'input__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_shadow',
    'title' => 'Input shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-shadow',
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ]
    ],

    'tabs' => 'input__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_focus_background',
    'title' => 'Focus background',
    'hint' => 'input focus background',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-focus-background',
        ],
    ],

    'tabs' => 'input__tabs',
    'tab' => 'focus',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_focus_color',
    'title' => 'Focus text color',
    'hint' => 'input focus text color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-focus-color',
        ],
    ],
    'tabs' => 'input__tabs',
    'tab' => 'focus',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'input_focus_border_color',
    'title' => 'Focus border color',
    'hint' => 'input focus border color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-focus-border-color',
        ],
    ],
    'tabs' => 'input__tabs',
    'tab' => 'focus',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'input_focus_shadow',
    'title' => 'Input focus shadow',
    'std' => 0,
    'css' => [
        [
            'selector' => ':root',
            'property' => '--input-focus-shadow',
            'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
        ]
    ],
    'tabs' => 'input__tabs',
    'tab' => 'focus',
]);