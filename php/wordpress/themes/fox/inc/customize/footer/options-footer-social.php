<?php
$fox56_customize->add_section( 'footer_social',[
    'title' => 'Footer Social',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'msg_before' => 'To enter social URLs, please visit the <strong><a href="javascript:wp.customize.section(\'social\').focus()">Social Panel</a></strong>',
    'type' => 'number',
    'id' => 'footer_social_icon_spacing',
    'title'  => 'Icon spacing',
    'std'     => 6,
    'css' => [
        [
            'selector' => '.footer56__social li + li',
            'property' => 'margin-left',
            'unit' => 'px',
        ],
    ],
    'section' => 'footer_social',

    'hint' => 'footer social icon spacing',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'footer_social_icon_size',
    'title'  => 'Icon container size',
    'hint' => 'footer social icon size',
    'std'     => 32,
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.footer56__social a',
            'property' => 'height',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'footer_social_icon_font',
    'hint' => 'footer social icon font size',
    'title'  => 'Icon size',
    'std'     => 18,
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'font-size',
            'unit' => 'px',
        ],
        [
            'selector' => '.footer56__social a img',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'footer_social_icon_border_radius',
    'hint' => 'footer social border radius',
    'title'  => 'Border radius',
    'std'     => 30,
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'footer_social_icon_border',
    'hint' => 'footer social icon border',
    'title'  => 'Icon border width',
    'std'     => 0,
    'choices' => [
        'min' => 0,
        'max' => 6,
        'step' => 1,
    ],
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ]
]);

/* ------------------ tabs */
$fox56_customize->add_field([
    'type' => 'tabs',
    'id' => 'footer_social_tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_background',
    'hint' => 'footer social icon background',
    'title'  => 'Icon background',
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'background',
        ],
    ],
    'tabs' => 'footer_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_color',
    'hint' => 'footer social icon color',
    'title'  => 'Icon text color',
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'color',
        ],
    ],
    
    'tabs' => 'footer_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_border_color',
    'hint' => 'footer social icon border color',
    'title'  => 'Icon border color',
    'css' => [
        [
            'selector' => '.footer56__social a',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'footer_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_hover_background',
    'hint' => 'footer social icon hover background',
    'title'  => 'Icon hover background',
    'css' => [
        [
            'selector' => '.footer56__social a:hover',
            'property' => 'background',
        ],
    ],
    'tabs' => 'footer_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_hover_color',
    'hint' => 'footer social icon hover color',
    'title'  => 'Icon hover text color',
    'css' => [
        [
            'selector' => '.footer56__social a:hover',
            'property' => 'color',
        ],
    ],
    'tabs' => 'footer_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_social_icon_hover_border_color',
    'hint' => 'footer social icon hover border color',
    'title'  => 'Icon hover border color',
    'css' => [
        [
            'selector' => '.footer56__social a:hover',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'footer_social_tabs',
    'tab' => 'hover',
]);

// footer_social_text deprecated56