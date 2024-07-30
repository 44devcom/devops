<?php
$fields[ 'ad_code' ] = [
    'type' => 'textarea',
    'name' => 'Ad Code',
    'tab' => 'ad',
    'refresh' => 'ad',
];

$fields[ 'banner_image' ] = [
    'tab' => 'ad',
    'type' => 'image',
    'name' => 'Image banner',
    'refresh' => 'ad',
];

$fields[ 'banner_image_tablet' ] = [
    'type' => 'image',
    'name' => 'Tablet image',
    'refresh' => 'ad',
];

$fields[ 'banner_image_mobile' ] = [
    'type' => 'image',
    'name' => 'Mobile image',
    'refresh' => 'ad',
];

$fields[ 'banner_width' ] = [
    'type' => 'group',
    'name' => 'Banner width',
    'fields' => [
        'desktop' => [
            'name' => 'Width',
            'type' => 'text',
            'placeholder' => 'Eg. 728',
            'col' => '2-5',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'text',
            'col' => '2-5',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'text',
            'col' => '1-5',
        ],
    ],
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .banner56',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .banner56',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .banner56',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ]
];

$fields[ 'banner_link' ] = [
    'type' => 'group',
    'name' => 'Banner URL',
    'fields' => [
        'url' => [
            'name' => 'Link',
            'type' => 'text',
            'placeholder' => 'https://',
            'col' => '2-3',
        ],
        'target' => [
            'name' => 'Target',
            'type' => 'select',
            'options' => [
                '_self' => 'Same tab',
                '_blank' => 'New tab',
            ],
            'std' => '_blank',
            'col' => '1-3',
        ],
    ],
    'std' => [
        'url' => '',
        'target' => '_self',
    ],
    'refresh' => 'ad',
];

$fields[ 'ad_visibility' ] = [
    'type' => 'multicheckbox',
    'name' => 'Shown on:',
    'options' => [
        'desktop' => 'Desktop',
        'tablet' => 'Tablet',
        'mobile' => 'Mobile',
    ],
    'std' => 'desktop,tablet,mobile',
    'refresh' => 'ad',
];

$fields[ 'ad_area_padding' ] = [
    'type' => 'group',
    'fields' => [
        'desktop' => [
            'name' => 'Padding',
            'type' => 'number',
            'col' => '2-5',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'col' => '2-5',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'col' => '1-5',
        ],
    ],
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .ad56__container',
            'property' => 'padding',
            'unit' => 'px',
            'value_pattern' => '$ 0',
            'use' => 'desktop',
        ],
        [
            'selector' => '.builder56 .{{section}} .ad56__container',
            'property' => 'padding',
            'unit' => 'px',
            'value_pattern' => '$ 0',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.builder56 .{{section}} .ad56__container',
            'property' => 'padding',
            'unit' => 'px',
            'value_pattern' => '$ 0',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 0,
        'tablet' => 0,
        'mobile' => 0,
    ],
    'name' => 'Ad area padding',
];
$fields[ 'ad_area_background' ] = [
    'type' => 'color',
    'name' => 'Ad area background',
    'css' => [
        [
            'selector' => '.builder56 .{{section}} .ad56__container',
            'property' => 'background-color',
        ]
    ] 
];