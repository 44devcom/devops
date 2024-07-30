<?php
$fox56_customize->add_section( 'header_social',[
    'title' => 'Social',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'msg_before' => 'To enter social URLs, please visit the <strong><a href="javascript:wp.customize.section(\'social\').focus()">Social Panel</a></strong>',
    'type' => 'number',
    'id' => 'header_social_icon_spacing',
    'title'  => 'Icon spacing',
    'std'     => 6,
    'css' => [
        [
            'selector' => '.header56__social li + li',
            'property' => 'margin-left',
            'unit' => 'px',
        ],
    ],
    'section' => 'header_social',
    'hint' => 'header social icon spacing',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_size',
    'title'  => 'Icon container size',
    'hint' => 'header social icon size',
    'std'     => 32,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.header56__social a',
            'property' => 'height',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_font',
    'hint' => 'header social icon font size',
    'title'  => 'Icon size',
    'std'     => 18,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'font-size',
            'unit' => 'px',
        ],
        [
            'selector' => '.header56__social a img',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_border_radius',
    'title'  => 'Border radius',
    'hint' => 'header social icon border radius',
    'std'     => 30,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_border',
    'title'  => 'Icon border width',
    'hint' => 'header social icon border width',
    'std'     => 0,
    'choices' => [
        'min' => 0,
        'max' => 6,
        'step' => 1,
    ],
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ]
]);

/* ------------------ tabs */
$fox56_customize->add_field([
    'type' => 'tabs',
    'id' => 'header_social_tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_background',
    'title'  => 'Icon background',
    'hint' => 'header social icon background',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'background',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_color',
    'title'  => 'Icon text color',
    'hint' => 'header social icon color',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'color',
        ],
    ],
    
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_border_color',
    'title'  => 'Icon border color',
    'hint' => 'header social icon border color',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_background',
    'title'  => 'Icon hover background',
    'hint' => 'header social icon hover background',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'background',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_color',
    'title'  => 'Icon hover text color',
    'hint' => 'header social icon hover color',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_border_color',
    'title'  => 'Icon hover border color',
    'hint' => 'header social icon hover border color',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);