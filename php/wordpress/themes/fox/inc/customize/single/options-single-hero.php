<?php
$fox56_customize->add_section( 'single_hero',[
    'title' => 'HERO Post',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'hero_full', [
    'selector' => '.hero56-placement-full',
    'render_callback' => 'fox56_single_hero_full',
    // 'settings' => [ 'single_hero_scroll', 'single_hero_scroll_style' ]
]);

$fox56_customize->add_partial( 'hero_half', [
    'selector' => '.hero56-placement-half',
    'render_callback' => 'fox56_single_hero_half',
    // 'settings' => [ 'single_hero_scroll', 'single_hero_scroll_style' ]
]);

/* common
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'hero_header_elements',
    'options' => [
        'standalone_category' => 'Fancy Category',
        'title' => 'Post title',
        'subtitle' => 'Post subtitle',
        'date' => 'Date',
        'author' => 'Author',
        'view' => 'View count',
        'comment' => 'Comment link',
        'category' => 'Category',
        'reading_time' => 'Reading time',
    ],
    'std' => [ 'standalone_category', 'title', 'subtitle' ],
    'name' => 'Hero post header elements',
    'refresh' => [
        'selector' => '.hero56__content',
        'render_callback' => 'fox56_hero_header',
    ],
    'msg_before' => 'Note: If you wan to change logo of HERO posts, please visit the <strong><a href="javascript:wp.customize.section(\'header_minimal\').focus()">Header &raquo; Header Hero Post</a></strong>',
    'section' => 'single_hero',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'hero_header_category_style',
    'options' => [
        'plain' => 'Plain',
        'box' => 'Box',
    ],
    'std' => 'plain',
    'name' => 'Fancy category style',
    'refresh' => [
        'selector' => '.hero56__content',
        'render_callback' => 'fox56_hero_header',
    ],

    'hint' => 'hero header fancy category style',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'hero_content_meta_elements',
    'options' => [
        'standalone_category' => 'Fancy Category',
        'date' => 'Date',
        'author' => 'Author',
        'view' => 'View count',
        'comment' => 'Comment link',
        'category' => 'Category',
        'reading_time' => 'Reading time',
    ],
    'std' => [ 'author', 'date' ],
    'name' => 'Hero post meta after hero area',
    'refresh' => [
        'selector' => '.hero56__content',
        'render_callback' => 'fox56_hero_header',
    ],
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_hero_scroll',
    'name' => 'Scroll button?',
    'hint' => 'hero scroll button',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_hero_scroll_style',
    'name' => 'Scroll down style',
    'hint' => 'hero scroll down style',
    'options' => [
        'arrow' => 'Arrow',
        'outline' => 'Button Outline',
        'fill' => 'Button Fill',
        'primary' => 'Button Primary',
    ],
    'std' => 'arrow',
    // 'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_hero_scroll_btn_text',
    'hint' => 'hero scroll button text',
    'name' => 'Button text',
    'placeholder' => 'Start Reading',
    'std' => 'Start Reading',
    'refresh' => 'hero',
]);

/* full
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'hero_full_text_position',
    'options' => [
        'bottom-left' => 'Bottom Left',
        'bottom-center' => 'Bottom Center',
        'center' => 'Center',
    ],
    'std' => 'bottom-left',
    'name' => 'HERO Full text position',
    'heading' => 'HERO Full',
    'refresh' => 'hero_full',
]);

/* half
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_hero_half_skin',
    'options' => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std' => 'light',
    'name' => 'HERO Half skin',
    'heading' => 'HERO Half',
    'refresh' => 'hero_half',
]);