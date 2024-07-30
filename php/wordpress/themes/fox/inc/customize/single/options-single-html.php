<?php
$fox56_customize->add_section( 'single_html', [
    'title' => 'HTML',
    'panel' => 'single',
]);

for ( $i = 1; $i <= 3; $i++ ) {
    $fox56_customize->add_field([
        'type' => 'textarea',
        'id' => 'single_html' . $i,
        'section' => 'single_html',
        'name' => 'HTML ' . $i,
        'hint' => 'single html ' . $i,
        'desc' => 'You can enter shortcode and HTML here',
        'refresh' => [
            'selector' => '.single56__html' . $i,
            'render_callback' => 'fox56_single_html' . $i . '_inner',
        ],
    ]);
}