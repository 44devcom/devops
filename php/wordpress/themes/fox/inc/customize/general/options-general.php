<?php
$fox56_customize->add_section( 'static_front_page', [
    'title' => 'General',
    'priority' => 10,
]);

$fox56_customize->add_field([
    'type' => 'heading',
    'heading' => 'Custom thumbnail dimensions',
    'id' => 'thumbnail_dimensions__heading',
    'section' => 'static_front_page',
]);
    
$fox56_customize->add_field([
    'msg_before' => 'IMPORTANT NOTE: This change applies from this moment so that your existing images won\'t be cropped to new dimensions. To apply new dimensions to your old images, please install <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin then go to <strong>Dashboard > Tools > Regenerate Thumbnails</strong> to run.
        <br>
    
        NOTE 2: Enter 9999 to Height to keep original proportion instead of cropping.',
    'type' => 'group',
    'id' => 'thumbnail_medium',
    'name' => 'Thumbnail Landscape',
    'fields' => [
        'width' => [
            'name' => 'Width',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
        'height' => [
            'name' => 'Height',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
    ],
    'std' => [
        'width' => 480,
        'height' => 384,
    ],
    'transport' => 'postMessage',
    'priority' => 100,

    'hint' => 'thumbnail crop: medium',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'thumbnail_square',
    'name' => 'Thumbnail Square',
    'fields' => [
        'width' => [
            'name' => 'Width',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
        'height' => [
            'name' => 'Height',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
    ],
    'std' => [
        'width' => 480,
        'height' => 480,
    ],
    'transport' => 'postMessage',
    'hint' => 'thumbnail crop: square',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'thumbnail_portrait',
    'name' => 'Thumbnail Square',
    'fields' => [
        'width' => [
            'name' => 'Width',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
        'height' => [
            'name' => 'Height',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
    ],
    'std' => [
        'width' => 480,
        'height' => 600,
    ],
    'transport' => 'postMessage',
    'hint' => 'thumbnail crop: portrait',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'thumbnail_large',
    'name' => 'Thumbnail Large',
    'fields' => [
        'width' => [
            'name' => 'Width',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
        'height' => [
            'name' => 'Height',
            'type' => 'number',
            'step' => 2,
            'col' => '1-2',
        ],
    ],
    'std' => [
        'width' => 720,
        'height' => 480,
    ],
    'transport' => 'postMessage',
    'hint' => 'thumbnail crop: large landscape',
]);

/* ---------------------------------------------        icons to load */