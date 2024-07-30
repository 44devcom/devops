<?php
$fox56_customize->add_section( 'title_tagline',[
    'title' => 'Logo',
    'panel' => 'header',
]);

/* ---------------------------------------------        logo */
$fox56_customize->add_field([
    'id' => 'logo__heading',
    'type' => 'heading',
    'heading' => 'Logo',
    'section' => 'title_tagline',
] );

$fox56_customize->add_partial( 'logo', [
    'selector' => '.header_desktop56 .logo56',
    'render_callback' => function() {
        return fox56_header_logo_inner( 'desktop' );
    },
    'settings' => [ 'logo' ]
]);

$fox56_customize->add_partial( 'logo_mobile', [
    'selector' => '.header_mobile56 .logo56',
    'render_callback' => function() {
        return fox56_header_logo_inner( 'mobile' );
    },
    'settings' => [ 'logo', 'mobile_logo' ]
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'logo_type',
    'title' => 'Logo type',
    'std' => 'text',
    'options'     => [
        'text'    => 'Text Logo',
        'image'    => 'Image Logo',
    ],
    'priority' => 300,
    
    'section' => 'title_tagline',
    'refresh' => 'logo',
] );

$fox56_customize->add_field([
    'id' => 'logo',
    'type' => 'image',
    'name' => 'Upload your logo', 
    'hint' => 'image logo',
    
    // 'refresh' => 'logo',
    'transport' => 'postMessage',
    
    'condition' => [
        'logo_type' => 'image',
    ],
]);

$fox56_customize->add_field([
    'id' => 'mobile_logo',
    'type' => 'image',
    'name' => 'Tablet/Mobile logo',
    'desc' => 'In case you want tablet/mobile logo different from desktop logo',
    
    // 'refresh' => 'logo',
    'transport' => 'postMessage',
    
    'condition' => [
        'logo_type' => 'image',
    ],
]);

$fox56_customize->add_field([
    'type' => 'text',
    'placeholder' => 'Eg. 320px',
    'id' => 'logo_width',
    'name' => 'Logo width (Desktop)',
    'std' => 100,
    'css' => [
        [
            'property' => 'width',
            'selector' => '.header_desktop56 .logo56 img',
            'unit' => 'px',
        ]
    ],
    'condition' => [
        'logo_type' => 'image',
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'mobile_logo_height',
    'name' => 'Logo height (Mobile)',
    'std' => 32,
    'css' => [
        [
            'property' => 'height',
            'selector' => '.header_mobile56 .logo56 img',
            'unit' => 'px',
        ]
    ],
    'condition' => [
        'logo_type' => 'image',
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'logo_typography',
    'heading' => 'Logo typography',
    'hint' => 'logo font',
    'desc' => 'Skip this option if you use Image logo',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => 700,
        'spacing' => 0,
        'transform' => 'none',
        'line_height' => '1.2',
        'size' => 64,
        'size_tablet' => 40,
        'size_mobile' => 32,
    ],
    'selector' => '.text-logo',
]);

$fox56_customize->add_field([
    'id' => 'logo_custom_link',
    'type' => 'text',
    'placeholder' => 'https://',
    'name'      => 'Logo Custom Link',
    'description'      => 'By default your logo will link to your homepage.',
    
    'refresh' => 'logo',
]);

$fox56_customize->add_field([
    'id' => 'logo_box',
    'type' => 'text',
    'name'      => 'Logo Margin',
    'placeholder' => 'Eg. 10px',
    'css' => [
        [
            'selector' => '.logo56',
            'property' => 'margin',
            'unit' => 'px',
        ]
    ],
    'description' => 'You can enter Top | Right | Bottom | Left',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'logo_color',
    'title' => 'Logo color',
    'css' => [
        [
            'selector' => '.text-logo',
            'property' => 'color',
        ]
    ],
    'condition' => [
        'logo_type' => 'text',
    ],
]);

/* ----------------------------------------------------------------     tagline */
$fox56_customize->add_field([
    'heading' => 'Tagline',
    'id' => 'tagline_enable',
    'type' => 'checkbox',
    'std' => false,
    'name' => 'Show Tagline',
    
    'refresh' => 'logo',
]);

$fox56_customize->add_field([
    'id' => 'tagline_margin_top',
    'type' => 'number',
    'name' => 'Tagline - Logo spacing',
    'condition' => [
        'tagline_enable' => true,
    ],
    'std' => 0,
    'css' => [
        [
            'selector' => '.site-description',
            'property' => 'margin-top',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'id' => 'tagline_color',
    'type' => 'color',
    'name' => 'Tagline color',
    'condition' => [
        'tagline_enable' => true,
    ],
    
    'css' => [
        [
            'selector' => '.site-description',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'tagline_typography',
    'hint' => 'tagline font',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => 400,
        'spacing' => 6,
        'transform' => 'uppercase',
        'line_height' => '1.2',
        'size' => 12,
    ],
    'selector' => '.slogan',
]);

/* ----------------------------------------------------------------     Site Icon */
$fox56_customize->add_field([
    'id' => 'site_icon__heading',
    'type' => 'heading',
    'heading' => 'Site Icon',
]);