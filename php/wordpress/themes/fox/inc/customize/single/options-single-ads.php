<?php
$fox56_customize->add_section( 'single_ads', [
    'title' => 'Advertisement',
    'panel' => 'single',
]);

$positions = [
    'single_top' => 'Top of single post',
    'single_before_content' => 'Before post content',
    'single_after_content' => 'After post content',
    'single_bottom' => 'Bottom of single post',
];

foreach ( $positions as $pos => $name ) {

    $fox56_customize->add_partial( "ad_{$pos}",[
        'selector' => ".ad56--{$pos}",
        'render_callback' => function() use ( $pos ) {
            return fox56_ad_inner( $pos );
        },
    ]);

    $fox56_customize->add_field([
        'section' => 'single_ads',
        'heading' => 'Ad ' . $name,
        'type' => 'textarea',
        'id' => "ad_{$pos}_code",
        'name' => 'Ad code',
        'desc' => 'If you use ad code, please skip below image upload',
        'refresh' => "ad_{$pos}",

        'hint' => 'ad/banner: ' . $name,
    ]);

    $fox56_customize->add_field([
        'type' => 'image',
        'id' => "ad_{$pos}_image",
        'name' => 'Banner image',
        'refresh' => "ad_{$pos}",
        'hint' => 'ad/banner image: ' . $name,
    ]);

    $fox56_customize->add_field([
        'type' => 'text',
        'placeholder' => 'Eg. 728',
        'id' => "ad_{$pos}_image_width",
        'name' => 'Banner width',
        'hint' => 'ad/banner width: ' . $name,
        'css' => [
            [
                'selector' => ".ad56--{$pos} img",
                'property' => 'width',
                'unit' => 'px',
            ]
        ],
    ]);

    $fox56_customize->add_field([
        'type' => 'image',
        'id' => "ad_{$pos}_tablet",
        'name' => 'Tablet image',
        'refresh' => "ad_{$pos}",
        'hint' => 'tablet banner: ' . $name,
    ]);

    $fox56_customize->add_field([
        'type' => 'image',
        'id' => "ad_{$pos}_mobile",
        'name' => 'Mobile image',
        'refresh' => "ad_{$pos}",
        'hint' => 'mobile banner: ' . $name,
    ]);

    $fox56_customize->add_field([
        'type' => 'text',
        'id' => "ad_{$pos}_url",
        'name' => 'Banner URL',
        'refresh' => "ad_{$pos}",
        'hint' => 'banner URL: ' . $name,
    ]);
    
}