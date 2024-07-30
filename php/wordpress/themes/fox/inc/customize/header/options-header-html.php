<?php
$fox56_customize->add_section( 'header_html', [
    'title' => 'HTML',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'header_html1',
    'title' => 'HTML 1',
    'hint' => 'header html 1',
    'desc' => 'You can enter HTML or shortcode here',
    
    'section' => 'header_html',
    
    'refresh' => [
        'selector' => '.header56__html1',
        'render_callback' => 'fox56_header_html1_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'header_html2',
    'hint' => 'header html 2',
    'title' => 'HTML 2',
    'desc' => 'You can enter HTML or shortcode here',
    
    'section' => 'header_html',
    
    'refresh' => [
        'selector' => '.header56__html2',
        'render_callback' => 'fox56_header_html2_inner',
    ]
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'header_html3',
    'hint' => 'header html 3',
    'title' => 'HTML 3',
    'desc' => 'You can enter HTML or shortcode here',
    
    'section' => 'header_html',
    
    'refresh' => [
        'selector' => '.header56__html3',
        'render_callback' => 'fox56_header_html3_inner',
    ]
]);