<?php
$fox56_customize->add_section( 'single_body',[
    'title' => 'Single Post Content',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_body', [
    'selector' => '.single56__post_content',
    'render_callback' => 'fox56_single_body_inner',
]);

/* content
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_before_content_elements',
    'options' => [
        'ad' => 'Ad',
        'share' => 'Share',
        'review' => 'Review',
        'sponsor' => 'Sponsor',
        'subtitle' => 'Subtitle',
        'author' => 'Author',
        'date' => 'Date',
    ],
    'std' => [ 'ad', 'sponsor', 'review' ],
    'name' => 'Before content elements',
    'refresh' => 'single',
    'section' => 'single_body',

    'hint' => 'single before post content',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_content_width',
    'options' => [
        'full' => 'Fullwdith',
        'narrow' => 'Narrow',
    ],
    'std' => 'full',
    'name' => 'Content width',
    'refresh' => 'single',

    'hint' => 'single content width',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_content_narrow_width',
    'std' => '660',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--narrow-width',
            'unit' => 'px',
        ]
    ],
    'name' => 'Content narrow width',
    'hint' => 'single narrow width',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_content_typography',
    'name' => 'Post content typography',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '1.5',
    ],
    'selector' => '.single56__post_content',
    'hint' => 'single content font',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_content_color',
    'name' => 'Post content color',
    'css' => [
        [
            'selector' => '.single56__post_content',
            'property' => 'color',
        ],
    ],
    'hint' => 'single content color',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'content_link_style',
    'std' => '1',
    'options'   => array(
        '1' => 'Grey underline',
        '2' => 'Same color underline',
        '3' => 'Black underline',
        '4' => 'No style',
    ),
    'refresh' => 'single',
    'name' => 'Content link style',
    'hint' => 'single content link style',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_content_image_stretch',
    'std' => false,
    'refresh' => 'single',
    'name' => 'Stretch content image?',
    'desc' => 'This option will stretch content images a little bit to the left/right',
]);

// deprecated56
// single_content_column
// single_dropcap

/* after content
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_after_content_elements',
    'title' => 'After content elements',
    'std'     => [ 'ad', 'share', 'related', 'tags', 'authorbox', 'comments' ],
    'options' => [
        'review' => 'Review',
        'ad' => 'Ad',
        'share' => 'Share',
        'related' => 'Related posts',
        'tags' => 'Post tags',
        'authorbox' => 'Author box',
        'nav' => 'Post navigation',
        'comments' => 'Post Comments',
        'html1' => 'HTML 1',
        'html2' => 'HTML 2',
        'html3' => 'HTML 3',
    ],
    'refresh' => 'single',
    'heading' => 'After content elements',
    'desc' => 'HTML elements help you to enter shortcode there, eg. a subscription form.',

    'hint' => 'single after content components',
]);


/* single headings
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_heading_typography',
    'title' => 'Typography',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '1.3',
        'size' => '1.5em',
        'size_mobile' => '1em',
    ],
    'selector' => '.single56__heading',
    'heading' => 'Related heading, comment heading',

    'hint' => 'single heading/label font',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_heading_color',
    'hint' => 'single heading color',
    'title' => 'Color',
    'css' => [
        [
            'selector' => '.single56__heading',
            'property' => 'color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_heading_align',
    'hint' => 'single heading align',
    'title' => 'Align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'center',
    'css' => [
        [
            'selector' => '.single56__heading',
            'property' => 'text-align',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_heading_style',
    'hint' => 'single heading border style',
    'title' => 'Border style',
    'options' => [
        'normal' => 'Top - Bottom',
        'around' => 'Line middle',
    ],
    'std' => 'normal',
    'refresh' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_heading_border',
    'hint' => 'single heading border',
    'title' => 'Border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '2-5',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '2-5',
        ],
        'color' => [
            'name' => 'Color',
            'type' => 'color',
            'col' => '1-5',
        ]
    ],
    'css' => [
        [
            'selector' => '.single56--small-heading-normal .single56__heading',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.single56--small-heading-normal .single56__heading',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.single56--small-heading-normal .single56__heading, .single56__heading span:before, .single56__heading span:after',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
        'color' => '',
    ],
]);