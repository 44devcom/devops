<?php
$fox56_customize->add_section( 'header_minimal', [
    'title' => 'Header Hero Post',
    'panel' => 'header',
]);

$fox56_customize->add_partial( 'minimal_header', [
    'selector' => '.minimal-header',
    'render_callback' => 'fox56_minimal_header_inner',
]);

$fox56_customize->add_field([
    'msg_before' => 'This is the header being used for HERO posts.',
    'id' => 'single_hero_header',
    'type' => 'radio',
    'name' => 'Hero Header Type',
    'options' => [
        'normal' => 'Normal',
        'minimal' => 'Minimal (Logo + Hamburger)',
    ],
    'std' => 'minimal',
    'section' => 'header_minimal',
]);

$fox56_customize->add_field([
    'id' => 'min_logo',
    'type' => 'checkbox',
    'name' => 'Use minimal logo?',
    'std' => true,
    'refresh' => 'minimal_header',
]);

$fox56_customize->add_field([
    'id' => 'min_logo_type',
    'type' => 'radio',
    'name' => 'Minimal logo type',
    'options' => [
        'text' => 'Text',
        'image' => 'Image',
    ],
    'std' => 'text',
    'refresh' => 'minimal_header',
]);

$fox56_customize->add_field([
    'id' => 'logo_minimal',
    'type' => 'image',
    'name' => 'Minimal logo',
    'desc' => 'This logo will be used for the minimal header.',
    'condition' => [ 'min_logo_type' => 'image' ],
    'refresh' => 'minimal_header',
]);

$fox56_customize->add_field([
    'id' => 'logo_minimal_white',
    'type' => 'image',
    'name' => 'Minimal Logo (White Version)',
    'desc' => 'Will be used on dark background',
    'condition' => [ 'min_logo_type' => 'image' ],
    'refresh' => 'minimal_header',
]);

$fox56_customize->add_field([
    'id' => 'logo_minimal_height',
    'type' => 'number',
    'name' => 'Minimal Logo Height',
    'css' => [
        [
            'selector' => '.minimal-logo img',
            'property' => 'height',
            'unit' => 'px',
        ]
    ],
    'std' => 24,
    'condition' => [ 'min_logo_type' => 'image' ],
]);