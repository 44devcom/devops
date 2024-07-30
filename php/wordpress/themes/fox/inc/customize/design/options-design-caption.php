<?php
$fox56_customize->add_section( 'design_caption',[
    'title' => 'Image caption',
    'panel' => 'design'
]);

/* ---------------------------------------------        CAPTION */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'caption_typography',
    'hint' => 'image caption font',
    'std' => [
        'face' 
        => 'var(--font-body)',
        'variant' => '400',
        'transform' => 'none',
        'spacing' => '',
        'line_height' => '',
        'size' => 14,
        'size_mobile' => 12,
    ],
    'selector' => '.wp-caption-text, .single_thumbnail56 figcaption, .thumbnail56 figcaption, .wp-block-image figcaption, .blocks-gallery-caption',

    'heading' => 'Caption',

    'section' => 'design_caption',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'caption_color',
    'hint' => 'image caption color',
    'css' => [
        [
            'selector' => '.wp-caption-text, .wp-element-caption, .single_thumbnail56 figcaption, .thumbnail56 figcaption, .wp-block-image figcaption, .blocks-gallery-caption',
            'property' => 'color',
        ]
    ],
    'name' => 'Caption text color',
]);