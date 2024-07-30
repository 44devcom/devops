<?php
$fox56_customize->add_section( 'blog_excerpt', [
    'title' => 'Post excerpt',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'excerpt_content',
    'type' => 'radio',
    'title' => 'Excerpt/content?',
    'options' => [
        'excerpt' => 'Excerpt',
        'content' => 'Content',
    ],

    'section' => 'blog_excerpt',
    'std' => 'excerpt',
    'hint' => 'Excerpt/Content',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'display_excerpt_html',
    'type' => 'checkbox',
    'title' => 'Keep Excerpt HTML?',
    'desc' => 'By default, theme will strip all HTML from your excerpt. If you have HTML in your excerpt like strong tag, em tag, custom link.. you can use this option to keep HTML. If this is enabled, excerpt length won\'t work anymore',
    'hint' => 'Excerpt HTML',
]);

$fox56_customize->add_field([
    'id' => 'excerpt_length',
    'type' => 'number',
    'title' => 'Excerpt length',
    'std' => 24,
    'min' => 0,
    'max' => 60,
    'step' => 1,
    'refresh' => 'blog',
    'section' => 'blog_excerpt',

    'hint' => 'Excerpt length',
]);

$fox56_customize->add_field([
    'id' => 'excerpt_hellip',
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Add "..." after excerpt',
    'hint' => 'Excerpt hellip (...)',
]);

$fox56_customize->add_field([
    'id' => 'more_style',
    'type' => 'radio_image',
    'title' => 'More button style',
    'options' => [
        'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
        'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
        'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
        'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
        'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
        'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
    ],
    'std' => 'primary',
    'refresh' => 'blog',

    'hint' => 'more button style',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'excerpt_typography',
    'name' => 'Post excerpt typography',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '1.3',
        'size' => '',
        'size_mobile' => '',
    ],
    'selector' => '.excerpt56',

    'hint' => 'excerpt font',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'excerpt_color',
    'css' => [
        [
            'selector' => '.excerpt56',
            'property' => 'color',
        ]
    ],
    'name' => 'Excerpt color',

    'hint' => 'excerpt color',
]);