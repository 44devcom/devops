<?php
$fox56_customize->add_section( 'footer_instagram',[
    'title' => 'Instagram',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'section' => 'footer_instagram',
    'id' => 'footer_instagram_bg',
    'type' => 'color',
    'name' => 'Footer Instagram area background',
    'css' => [
        [
            'selector' => '#footer-instagram',
            'property' => 'background-color',
        ]
    ],
    'msg_before' => 'To set up Footer Instagram, please go to <strong>Dashboard &raquo; Appearance &raquo; Widgets </strong>',
    'section' => 'footer_instagram',
]);