<?php
$fox56_customize->add_section( 'design_darkmode',[
    'title' => 'Dark Mode',
    'panel' => 'design'
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'darkmode',
    'name' => 'Dark Mode?',
    'section' => 'design_darkmode',

    'hint' => 'dark mode',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'darkmode_text_color',
    'name' => 'Dark Mode: Text color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--darkmode-text-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'darkmode_background_color',
    'std' => '#000',
    'name' => 'Dark Mode: Body Background Color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--darkmode-bg',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'darkmode_logo',
    'name' => 'Dark Mode: White Logo',
    'desc' => 'If your site uses image logo, please upload a white logo version so It displays this logo when visitor switches to dark mode.',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'darkmode_footer_logo',
    'name' => 'Dark Mode: Footer White Logo',
    'desc' => 'If your site uses footer image logo, please upload a white logo version so It displays this logo when visitor switches to dark mode.',
]);