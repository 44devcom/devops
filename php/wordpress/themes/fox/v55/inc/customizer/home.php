<?php
/* HOMEPAGE BUILDER - 105
---------------------------------------------------------------------------------------------------------------------- */
$instruction = 'If you use Elementor to build your homepage, please skip this section. This is the built-in homepage builder. It can work without <em>Elementor</em> nor <em>FOX Framework</em> pluign.';

$options[ 'home_builder_info' ] = array(
    'type'      => 'html',
    'std'       => '<p class="fox-info">' . $instruction . '</p>',
    
    'section'   => 'homepage_builder',
    'section_title' => '(HOMEPAGE) Builder',
    'section_priority' => 125,
);

$options[ 'home_builder' ] = array(
    'type'      => 'home_builder',
    
    'hint' => 'Homepage builder',
);

/* HOMEPAGE BUILDER - 105
---------------------------------------------------------------------------------------------------------------------- */
$options[ 'home_builder_settings_info' ] = array(
    'type'      => 'html',
    'std'       => '<p class="fox-info">If you use Elementor to build your homepage, please skip this section. This is the built-in homepage builder.</p>',
    
    'section'   => 'builder_settings',
    'section_title' => 'Homepage Builder Settings',
    'section_priority' => 126,
);

$options[ 'builder_paged' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Builder Sections for pages 2, 3..?',
    'hint' => 'Homepage builder paged',
    
    'section'   => 'builder_settings',
    'section_title' => 'Homepage Builder Settings',
    'section_priority' => 126,
);

// a secret field
$options[ 'sections_order' ] = array(
    'type'      => 'hidden',
);

$options[ 'unique_reading' ] = array(
    'shorthand' => 'enable',
    'options'   => [
        'true' => 'Yes please!',
        'false' => 'No thanks!',
    ],
    'std'       => 'false',
    'name'      => 'Non-duplicating posts',
    'desc'      => 'If you enable, posts will not appear twice in different sections. Please note: This is non-duplicated only for builder sections, not main stream.',
    
    'hint' => 'Homepage builder non-duplicating posts',
);

$options[ 'home_padding_top' ] = array(
    'shorthand' => 'padding-top',
    'name'      => 'Homepage padding top',
    'selector'  => '.home.blog .wi-content',
    'placeholder' => 'Eg. 10px',
    
    'hint' => 'Homepage padding',
);

$options[ 'home_padding_bottom' ] = array(
    'shorthand' => 'padding-bottom',
    'name'      => 'Homepage padding bottom',
    'selector'  => '.home.blog .wi-content',
    'placeholder' => 'Eg. 10px',
);

/*
deprecated since 4.5 while we have a more flexible builder
$options[ 'max_sections' ] = array(
    'type'      => 'text',
    'std'       => 6,
    'name'      => 'Max number of sections allowed',
    'desc'      => 'You must RELOAD this customizer page after saving to see more sections.<br>
    NOTE: DO NOT enter the number more than you need.',
    
    'hint' => 'Homepage builder number of sections',
);
*/

$options[ 'section_spacing' ] = array(
    'type'      => 'radio',
    'options'   => [
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
        'large' => 'Large',
    ],
    'std'       => 'small',
    'name'      => 'Spacing between sections',
    
    'hint' => 'Homepage builder section spacing',
);

/* BUILDER HEADING
------------------------------------ */
$options[] = [
    'type' => 'heading',
    'name' => 'Builder Heading',
];

$options[ 'builder_heading_style' ] = [
    'type'      => 'radio',
    'name'      => 'Builder Heading Style',
    'options'   => [
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
    'std' => '1a',
    
    'hint' => 'Homepage builder heading options',
];

$options[ 'builder_heading_line_color' ] = [
    'shorthand' => 'border-color',
    'name'      => 'Heading line color',
    'selector'  => '.heading-1a .container, .heading-1b .container, .section-heading .line, .heading-5 .heading-inner',
];

$options[ 'builder_heading_size' ] = [
    'type'      => 'radio',
    'name'      => 'Builder Heading Size',
    'options'   => [

        'ultra' => 'Ultra Large',
        'extra' => 'Extra Large',
        'large' => 'Large',

        'medium' => 'Medium',
        'normal' => 'Normal',
        'small' => 'Small',
        'tiny' => 'Tiny',

    ],
    'std' => 'large',
];

$options[ 'builder_heading_line_stretch' ] = [
    'type'      => 'radio',
    'name'      => 'Builder Heading Line Stretch',
    'options'   => [

        'content' => 'Content width',
        'content-half' => 'Half content width',
        'full' => 'Stretch full screen width',

    ],
    'std' => 'content',
];

$options[ 'builder_heading_align' ] = [
    'type'      => 'radio',
    'name'      => 'Builder Heading Align',
    'options'   => [

        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',

    ],
    'std' => 'center',
];

$id = 'elementor_heading';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' => 'Homepage builder heading font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];