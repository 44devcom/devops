<?php
$fox56_customize->add_section( 'single_thumbnail',[
    'title' => 'Single Thumbnail',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_thumbnail',[
    'selector' => '.single56__thumbnail',
    'render_callback' => 'fox56_single_thumbnail_inner',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_single_thumbnail',
    'name' => 'Hide single thumbnail?',
    'desc' => 'Each individual post has its own option to show/hide thumbnail',
    'refresh' => 'single',
    'section' => 'single_thumbnail',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_thumbnail_stretch',
    'name' => 'Single thumbnail stretch',
    'refresh' => 'single',
    'options' => [
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'desc' => 'Note that Thumbnail will stretch depends on the post layout. For some layouts, it can\'t stretch',
]);