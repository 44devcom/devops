<?php
$fields = [];
$fields[] = [
    'id' => 'title',
    'type' => 'text',
    'name' => 'Widget Title',
];

$fields[] = [
    'id' => 'layout',
    'type' => 'select',
    'options' => [
        'imagetop' => 'Image top',
        'imageleft' => 'Image left',
    ],
    'std' => 'imagetop',
    'name' => 'Layout',
];

$fields[] = [
    'id' => 'align',
    'type' => 'select',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'center',
    'name' => 'Align',
];

$fields[] = [
    'id' => 'image',
    'type' => 'image',
    'name' => 'Upload image',
];

$fields[] = [
    'id' => 'image_size',
    'type' => 'select',
    'options' => [
        'thumbnail' => 'Thumbnail (150x150)',
        'medium' => 'Medium',
        'large' => 'Large',
        'full' => 'Full',
        'thumbnail-medium' => 'Medium (480x384)',
        'thumbnail-square' => 'Square (480x480)',
        'thumbnail-portrait' => 'Portrait (480x600)',
        'thumbnail-large' => 'Landscape (720x480)'
    ],
    'std' => 'medium',
    'name' => 'Image size',
];

$fields[] = [
    'id' => 'image_width',
    'type' => 'text',
    'placeholder' => 'Eg. 240px',
    'name' => 'Image width',
];

$fields[] = [
    'id' => 'image_shape',
    'type' => 'select',
    'options' => [
        'acute' => 'Acute',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std' => 'acute',
    'name' => 'Image shape',
];

$fields[] = [
    'id' => 'heading',
    'placeholder' => 'Eg. About me',
    'type' => 'text',
    'name' => 'Heading text',
];

$fields[] = [
    'id' => 'url',
    'type' => 'text',
    'name' => 'URL',
    'placeholder' => 'https://',
];

$fields[] = [
    'id' => 'target',
    'type' => 'select',
    'name' => 'Open URL in',
    'options' => [
        '_self' => 'Current tab',
        '_blank' => 'New tab',
    ],
    'std' => '_self',
];

$fields[] = [
    'id' => 'description',
    'type' => 'textarea',
    'name' => 'Description',
];