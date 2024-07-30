<?php
function fox_builder_heading_options() {
    
    $heading_options = [
        
        /* Heading
        --------------------------------------------------------------------------- */
        'heading' => [
            'name'      => 'Heading text',
            'type'      => 'text',
            'tab'       => 'heading',
        ],
        
        'heading_empty' => [
            'name'      => 'Empty text',
            'type'      => 'checkbox',
            'desc'      => 'Sometimes we just need an empty heading, it shows only a line.',
            'tab'       => 'heading',
        ],

        'heading_color' => [
            'name'      => 'Heading color',
            'type'      => 'color',
            'tab'       => 'heading',
        ],

        'heading_style' => [
            'name'      => 'Heading style',
            'type'      => 'select',
            'options'   => [
                '' => 'Inherit',
                'plain' => 'Plain',

                '1a' => 'Border Top',
                '1b' => 'Border Bottom',

                '2a' => '2 thin lines middle',
                '2b' => '2 thin lines bottom',

                '3a' => '2 thick lines middle',
                '3b' => '2 thick lines bottom',

                '4a' => '2 wavy lines middle',
                '4b' => '2 wavy lines bottom',

                '5' => 'Border around',

                '6' => 'Wave bottom',

                '7a' => 'Diagonal Stripes',
                '8a' => 'Pixelate dot band'
            ],
            'std' => '',
            'tab'       => 'heading',
        ],

        'heading_line_stretch' => [
            'type'      => 'select',
            'name'      => 'Heading Line Stretch',
            'options'   => [
                '' => 'Default',
                'content' => 'Content width',
                'content-half' => 'Half content width',
                'full' => 'Stretch full screen width',

            ],
            'std' => '',
            'tab'       => 'heading',
        ],

        'heading_align' => [
            'name'      => 'Heading align',
            'type'      => 'select',
            'options'   => [
                '' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std'       => '',
            'tab'       => 'heading',
        ],

        'heading_size' => [
            'name'      => 'Heading size',
            'type'      => 'select',
            'options'   => [
                '' => 'Default',
                'ultra' => 'Ultra Large',
                'extra' => 'Extra Large',
                'large' => 'Large',
                'medium' => 'Medium',
                'normal' => 'Normal',
                'small' => 'Small',
                'tiny' => 'Tiny',
            ],
            'std' => '',
            'tab'       => 'heading',
        ],

        'viewall_link' => [
            'name'      => 'Heading URL',
            'type'      => 'text',
            'placeholder' => 'https://',

            'tab'       => 'heading',
        ],
        
        'viewall_link_position' => [
            'name'      => 'Link position',
            'type'      => 'select',
            'options'   => [
                'inheading' => 'In heading',
                'separated' => 'Separated',
            ],
            'tab'       => 'heading',
        ],
        
        'viewall_link_text' => [
            'name' => 'Link text',
            'desc' => 'In case you use separated link',
            'type' => 'text',
            'placeholder' => 'View all >',
            'tab' => 'heading'
        ]
        
    ];
    
    return apply_filters( 'fox_heading_options', $heading_options );
    
}