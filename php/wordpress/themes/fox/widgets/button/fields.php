<?php
$fields = [];
    
$fields[] = [
    'id' => 'text',
    'type' => 'text',
    'name' => 'Button',
    'std' => 'Click here',
];
$fields[] = [
    'id' => 'url',
    'type' => 'text',
    'name' => 'URL',
];

$fields[] = [
    'id' => 'target',
    'type' => 'select',
    'name' => 'Open link in',
    'options' => [
        '_self' => 'Current tab',
        '_blank' => 'New tab',
    ],
    'std' => '_self',
];

$fields[] = [
    'id' => 'icon',
    'name' => 'Icon',
    'type' => 'text',
    'desc' => 'Enter fontawesome icon from <a href="https://fontawesome.com/icons/" target="_blank">this list</a> or feather icon from <a href="https://feathericons.com/" target="_blank">this list</a>',
    'placeholder' => 'Eg. arrow-right',
];

$fields[] = [
    'id' => 'size',
    'name' => 'Size',
    'type' => 'select',
    'options' => array(
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
        'large' => 'Large',
    ),
    'std' => 'normal',
];

$fields[] = [
    'id' => 'style',
    'name' => 'Style',
    'type' => 'select',
    'options' => array(
        'primary' => 'Primary',
        'outline' => 'Outline',
        'fill' => 'Fill',
        'black' => 'Black',
    ),
    'std' => 'black',
];

$fields[] = [
    'id' => 'border_width',
    'name' => 'Border Width',
    'type' => 'select',
    'options' => array(
        '' => 'Default',
        '0' => 'None',
        '1px' => '1px',
        '2px' => '2px',
        '3px' => '3px',
        '4px' => '4px',
        '5px' => '5px',
    ),
    'std' => '',
];

$fields[] = [
    'id' => 'shape',
    'name' => 'Shape',
    'type' => 'select',
    'options' => array(
        'square' => 'Square',
        'round' => 'Round',
        'pill' => 'Pill',
    ),
    'std' => 'square',
];

$fields[] = [
    'id' => 'align',
    'name' => 'Align',
    'type' => 'select',
    'options' => array(
        'inline' => 'Inline',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ),
    'std' => 'inline',
];

$fields[] = [
    'id' => 'block',
    'name' => 'Block Button',
    'type' => 'select',
    'options' => array(
        'none' => 'None',
        'full' => 'Full-width',
        'half' => 'Half-width',
        'third' => 'Third-width',
    ),
    'std' => 'none',
];

$fields[] = [
    'id' => 'extra_class',
    'name' => 'Extra Class',
    'type' => 'text',
    'desc' => 'Enter your custom CSS class',
];

$fields[] = [
    'id' => 'attr',
    'name' => 'Additional Attributes',
    'type' => 'textarea',
    'desc' => 'Enter your custom attributes here. Make sure you know what you are doing.',
];

/**
 * Custom Color Options
 */
$fields[] = [
    'id' => 'text_color',
    'name' => 'Text Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'bg_color',
    'name' => 'Background Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'border_color',
    'name' => 'Border Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'text_color_hover',
    'name' => 'Hover Text Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'bg_color_hover',
    'name' => 'Hover Background Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'border_color_hover',
    'name' => 'Hover Border Color',
    'type' => 'color',
];