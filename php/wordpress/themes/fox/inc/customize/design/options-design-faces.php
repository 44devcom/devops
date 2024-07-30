<?php
$fox56_customize->add_section( 'design_faces', [
    'panel' => 'design',
    'title' => 'Choose fonts',
]);

$variants = [
    '100' => '100',
    '100itatlic' => '100italic',

    '200' => '200',
    '200itatlic' => '200italic',
    
    '300' => '300',
    '300itatlic' => '300italic',
    
    'regular' => 'regular',
    'itatlic' => 'italic',
    
    '500' => '500',
    '500itatlic' => '500italic',

    '600' => '600',
    '600itatlic' => '600italic',

    '700' => '700',
    '700itatlic' => '700italic',

    '800' => '800',
    '800itatlic' => '800italic',

    '900' => '900',
    '900itatlic' => '900italic',
];

$fox56_customize->add_field([
    'section' => 'design_faces',
    'id' => 'body_font',
    'type' => 'fonts',
    'title' => 'Body font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'body_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Body font variants',
    'options' => $variants,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'section' => 'design_faces',
    'id' => 'heading_font',
    'type' => 'fonts',
    'title' => 'Heading font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'heading_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Heading font variants',
    'options' => $variants,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'section' => 'design_faces',
    'id' => 'nav_font',
    'type' => 'fonts',
    'title' => 'Menu font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'nav_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Menu font variants',
    'options' => $variants,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'section' => 'design_faces',
    'id' => 'custom_1_font',
    'type' => 'fonts',
    'title' => 'Custom font 1',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'custom_1_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Custom font 1 variants',
    'options' => $variants,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'section' => 'design_faces',
    'id' => 'custom_2_font',
    'type' => 'fonts',
    'title' => 'Custom font 2',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'custom_2_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Custom font 2 variants',
    'options' => $variants,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'font_subsets',
    'type'      => 'multicheckbox',
    'name'      => 'Font Subsets',
    'options'   => array(
        "latin" => 'Latin',
        "latin-ext" => 'Latin Extended',
        'greek' => 'Greek',
        "greek-ext" => 'Greek Extended',
        "cyrillic" => 'Cyrillic',
        "cyrillic-ext" => 'Cyrillic Extended',
        'vietnamese' => 'Vietnamese',
    ),
    'desc' => 'Note that not each font supports only certain languages, not all.',
]);