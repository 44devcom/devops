<?php
$fox56_customize->add_section( 'footer_html',[
    'title' => 'Footer HTML',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'desc' => 'You can enter HTML and shortcode here',
    'id' => 'footer_html1',
    'title' => 'HTML 1',
    'hint' => 'footer html 1',
    'section' => 'footer_html',
    'refresh' => [
        'selector' => '.footer56__html1',
        'render_callback' => 'fox56_footer_html1_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'desc' => 'You can enter HTML and shortcode here',
    'id' => 'footer_html2',
    'hint' => 'footer html 2',
    'title' => 'HTML 2',
    'refresh' => [
        'selector' => '.footer56__html2',
        'render_callback' => 'fox56_footer_html2_inner',
    ]
]);