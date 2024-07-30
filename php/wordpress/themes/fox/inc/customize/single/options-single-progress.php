<?php
$fox56_customize->add_section( 'single_progress', [
    'title' => 'Reading Progress',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_reading_progress',
    'std'       => true,
    'name'      => 'Enable reading progress bar',
    'section' => 'single_progress',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'reading_progress_position',
    'std'       => 'top',
    'options' => [
        'top' => 'Top',
        'bottom' => 'Bottom',
        'header' => 'Lower edge of sticky header',
    ],
    'name'      => 'Progress bar position',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'reading_progress_height',
    'std'       => 5,
    'name'      => 'Progress bar thickness',
    'css' => [
        [
            'selector' => '.progress56',
            'property' => 'height',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'reading_progress_color',
    'name'      => 'Progress bar color',
    'desc' => 'It will be the primary color by default',
    'css' => [
        [
            'selector' => '.progress56::-webkit-progress-value',
            'property' => 'background-color',
        ],
        [
            'selector' => '.progress56::-moz-progress-value',
            'property' => 'background-color',
        ],
    ],
]);