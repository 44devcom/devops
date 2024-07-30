<?php
$fox56_customize->add_section( 'footer_copyright',[
    'title' => 'Footer Copyright',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'footer_copyright',
    'title' => 'Footer copyright text',
    'std' => '&copy; [today format="Y"] All rights reserved. Powered by <a href="https://themeforest.net/item/the-fox-contemporary-magazine-theme-for-creators/11103012" target="_blank">The Fox</a>.',
    'section' => 'footer_copyright',
    'refresh' => [
        'selector' => '.footer56__copyright',
        'render_callback' => 'fox56_footer_copyright_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'copyright_typography',
    'name' => 'Copyright Typography',
    'hint' => 'copyright font',
    'std' => [
    ],
    'selector' => '.footer56__copyright',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_copyright_color',
    'title' => 'Footer copyright color',
    'css' => [
        [
            'selector' => '.footer56__copyright',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'footer_copyright_link_color',
    'title' => 'Footer copyright link color',
    'css' => [
        [
            'selector' => '.footer56__copyright a',
            'property' => 'color',
        ]
    ],
]);