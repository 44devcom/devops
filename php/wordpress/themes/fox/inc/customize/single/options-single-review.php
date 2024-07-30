<?php
$fox56_customize->add_section( 'single_review', [
    'title' => 'Post Review',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'review_overall_color',
    'std'       => '',
    'name'      => 'Overall text color',
    'hint' => 'review overall text color',
    'css' => [
        [
            'selector' => '.review56__item.overall .review56__item__score',
            'property' => 'color',
        ]
    ],
    'section' => 'single_review',
    'msg_before' => 'If you need to enable/disable the post review, please go to <strong>Single &raquo; Sinlge Post Content</strong> panel.',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'review_overall_background',
    'std'       => '',
    'hint' => 'review overall background',
    'name'      => 'Overall background',
    'css' => [
        [
            'selector' => '.review56__item.overall .review56__item__score',
            'property' => 'background-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'review_custom_text_color',
    'name'      => 'Review custom text color',
    'css' => [
        [
            'selector' => '.review56__text',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'review_custom_text_background',
    'name'      => 'Review custom text background',
    'css' => [
        [
            'selector' => '.review56__text',
            'property' => 'background-color',
        ]
    ],
]);