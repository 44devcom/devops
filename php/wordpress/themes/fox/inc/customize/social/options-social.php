<?php
$fox56_customize->add_section( 'social', [
    'title' => 'Social',
]);
$social_arr = fox56_social_array();
$fields = [];
foreach ( $social_arr as $k => $icon_info ) {
    $explode = explode('|',$icon_info);
    $placeholder = 'email' == $k ? 'email@domain.com' : 'https://';
    $fields[ $k ] = [
        'type' => 'text',
        'placeholder' => $placeholder,
        'name' => $explode[1],
        'col' => '1-1',
    ];
}

$fox56_customize->add_field([
    'id' => 'social',
    'type' => 'group',
    'name' => 'Social URLs',
    'section' => 'social',
    'fields' => $fields,
    'std' => [
        'facebook' => 'https://facebook.com/withemes/',
        'twitter' => 'https://twitter.com/withemes/',
        'instagram' => 'https://instagram.com/iamwithemes/'
    ],
    'refresh' => [
        'selector' => '.fox56-social-list',
        'render_callback' => function(){
            return fox56_social_list([ 'tooltip_position' => 'bottom' ]);
        },
    ]
]);

/*
@deprecated56
$fox56_customize->add_field([
    'type' => 'heading',
    'heading' => 'Custom Link',
    'id' => 'social_custom__heading',
]);

$options[ 'social_custom_1' ] = [
];

$options[ 'social_custom_1' ] = [
    'type'  => 'text',
    'placeholder' => 'eg. mastodon',
    'desc' => 'Enter your custom social icon, eg. mastodon. Select from <a href="https://fontawesome.com/v5/search?o=r&f=brands" target="_blank">this list</a>.',
    'name'  => 'Social Custom Icon 1',
    'hint' =>  'Social custom icon',
];

$options[ 'social_custom_1_url' ] = [
    'type'  => 'text',
    'placeholder' => 'https://',
    'name'  => 'Social Custom Icon 1 URL',
];

$options[ 'social_custom_1_name' ] = [
    'type'  => 'text',
    'placeholder' => 'Mastodon',
    'name'  => 'Social Custom Icon 1 Name',
];

$options[ 'social_custom_2' ] = [
    'type'  => 'text',
    'placeholder' => 'eg. mastodon',
    'desc' => 'Enter your custom social icon, eg. mastodon. Select from <a href="https://fontawesome.com/v5/search?o=r&f=brands" target="_blank">this list</a>.',
    'name'  => 'Social Custom Icon 2',
    'hint' =>  'Social custom icon',
];

$options[ 'social_custom_2_url' ] = [
    'type'  => 'text',
    'placeholder' => 'https://',
    'name'  => 'Social Custom Icon 2 URL',
];

$options[ 'social_custom_2_name' ] = [
    'type'  => 'text',
    'placeholder' => 'Mastodon',
    'name'  => 'Social Custom Icon 2 Name',
];
*/