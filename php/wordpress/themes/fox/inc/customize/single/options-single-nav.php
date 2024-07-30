<?php
$fox56_customize->add_section( 'single_nav', [
    'title' => 'Post Navigation',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_nav', [
    'selector' => '.single56__nav',
    'render_callback' => 'fox56_single_nav_inner',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'single_nav_style',
    'options' => [
        'minimal-1'    => 'Minimal 1',
        'minimal-2'    => 'Minimal 2',
        'minimal-3'    => 'Minimal 3',
        
        'simple'    => 'Simple 1',
        'simple-2'    => 'Simple 2',
        
        'advanced'  => 'Title Over Image',
    ],
    'std'       => 'advanced',
    'name'      => 'Post Navigation Style',
    'section' => 'single_nav',

    'refresh' => 'single_nav',
]);

$fox56_customize->add_field([
    'id' => 'single_nav_padding',
    'condition' => [ 'single_nav_style' => 'advanced' ],
    'type' => 'number',
    'std' => 60,
    'name' => 'Tile Ratio % (width/height)',
    'hint' => 'single nav tile ratio',
    'css' => [
        [
            'selector' => '.singlenav56__post__bg',
            'property' => 'padding-bottom',
            'unit' => '%',
        ],
        [
            'selector' => '.singlenav56--1cols .singlenav56__post__bg',
            'property' => 'padding-bottom',
            'unit' => '%',
            'value_pattern' => 'calc($/1.8)',
        ],
    ]
]);

$fox56_customize->add_field([
    'id' => 'single_nav_same_term',
    'type' => 'checkbox',
    'name'      => 'Next/Prev post in same category',
    'refresh' => 'single_nav',
]);