<?php
$category_list = [];
$author_list = [];
if ( is_customize_preview() ) {
    $get = get_categories([
        'number' => 400,
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    ]);
    foreach ( $get as $get_cat ) {
        $category_list[ 'cat--' . $get_cat->slug ] = $get_cat->name;
    }

    $get = get_users([
        'has_published_posts' => true,
    ]);
    foreach ( $get as $get_author ) {
        $author_list[ 'author--' . $get_author->ID ] = $get_author->display_name;
    }
}

$sidebar_list = [ '' => '--- NONE ---' ];
foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
    $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
}

$thumbnail_options = [
    'thumbnail' => get_template_directory_uri() . '/inc/customize/images/thumbnail.jpg',
    'thumbnail-medium' => get_template_directory_uri() . '/inc/customize/images/thumbnail-medium.jpg',
    'thumbnail-square' => get_template_directory_uri() . '/inc/customize/images/thumbnail-square.jpg',
    'thumbnail-portrait' => get_template_directory_uri() . '/inc/customize/images/thumbnail-portrait.jpg',
    'thumbnail-large' => get_template_directory_uri() . '/inc/customize/images/thumbnail-large.jpg',
    'medium' => get_template_directory_uri() . '/inc/customize/images/medium.jpg',
    'large' => get_template_directory_uri() . '/inc/customize/images/large.jpg',
    'full' => get_template_directory_uri() . '/inc/customize/images/full.jpg',
    'custom' => get_template_directory_uri() . '/inc/customize/images/custom.jpg',
];
$thumbnail_select = [
    'thumbnail' => 'Thumbnail (150x150)',
    'thumbnail-medium' => 'Landscape (480x384)',
    'thumbnail-square' => 'Square (480x480)',
    'thumbnail-portrait' => 'Portrait (480x600)',
    'thumbnail-large' => 'Large (720x480)',
    'medium' => 'Medium (no crop)',
    'large' => 'Large (no crop)',
    'full' => 'Full (original)',
    'custom' => 'Custom',
];
$cols = [
    'big' => [
        'title' => 'Big col',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
        'excerpt_length' => 32,
        'thumbnail' => 'thumbnail-large',
        'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
        'align' => 'left',
        'more_style' => 'primary',
    ],
    'medium' => [
        'title' => 'Small col',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
        'excerpt_length' => 32,
        'thumbnail' => 'medium',
        'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
        'align' => 'left',
        'more_style' => 'plain',
    ],
    'small' => [
        'title' => 'Small col 2',
        'layout' => 'grid',
        'column' => '1',
        'number' => 1,
        'components' => [ 'thumbnail', 'title', 'excerpt' ],
        'excerpt_length' => 12,
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
        'align' => 'left',
        'more_style' => 'plain',
    ],
];

$fields = [];
$refresh_templates = [
    'section' => [
        'selector' => '.{{section}}',
        'render_callback' => function( $section_id ) {
            $section = get_theme_mod( $section_id, [] );
            $section[ 'section_id' ] = $section_id;
            fox56_builder_render_widget( $section );
        },
        'settings' => [],
        'container_inclusive' => true,
    ],
];

if ( ! function_exists( 'fox56_customize_builder_typo_css' ) ) :
function fox56_customize_builder_typo_css( $selector ){
    global $fox56_customize;
    return [
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-family',
            'use' => 'face',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-weight',
            'use' => 'weight',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-style',
            'use' => 'style',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-size',
            'use' => 'size',
            'unit' => 'px',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-size',
            'use' => 'size_tablet',
            'unit' => 'px',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'font-size',
            'use' => 'size_mobile',
            'unit' => 'px',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'line-height',
            'use' => 'line_height',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'letter-spacing',
            'use' => 'spacing',
            'unit' => 'px',
        ],
        [
            'selector' => "{{wrapper}} $selector",
            'property' => 'text-transform',
            'use' => 'transform',
        ],
    ];
}
endif;

$typo_fields = [
    'face' => [
        'type' => 'select',
        'options' => [
            '' => '-- select --',
            'var(--font-heading)' => 'Font Heading',
            'var(--font-body)' => 'Font Body',
            'var(--font-nav)' => 'Font Menu',
            'var(--font-custom-1)' => 'Font Custom 1',
            'var(--font-custom-2)' => 'Font Custom 2',

            'Helvetica Neue' => 'Helvetica Neue',
            'Helvetica' => 'Helvetica',
            'Arial' => 'Arial',
            'Times' => 'Times',
            'Georgia' => 'Georgia',
            'monospace' => 'Monospace',
        ],
        'std' => '',
        'name' => 'Font',
        'col' => '1-1',
    ],
    'weight' => [
        'type' => 'select',
        'name' => 'Weight',
        'options' => [
            '' => '-- select --',
            '100' => '100',
            '200' => '200',
            '300' => '300',
            '400' => 'Normal',
            '500' => '500',
            '600' => '600',
            '700' => 'Bold',
            '800' => '800',
            '900' => '900',
        ],
        'std' => '',
        'col' => '1-2',
    ],
    'style' => [
        'type' => 'select',
        'name' => 'Style',
        'options' => [
            '' => '-- select --',
            'normal' => 'Normal',
            'italic' => 'Italic',
        ],
        'std' => '',
        'col' => '1-2',
    ],
    'size' => [
        'type' => 'text',
        'name' => 'Font size',
        'placeholder' => 'Eg. 20px',
        'col' => '2-5',
    ],
    'size_tablet' => [
        'type' => 'text',
        'name' => 'Font tablet',
        'col' => '2-5',
    ],
    'size_mobile' => [
        'type' => 'text',
        'name' => 'Mobile',
        'col' => '1-5',
    ],
    'line_height' => [
        'type' => 'text',
        'name' => 'Line height',
        'placeholder' => 'Eg. 1.5',
        'col' => '1-3',
    ],
    'spacing' => [
        'type' => 'text',
        'name' => 'Spacing',
        'placeholder' => 'Eg. 1.5',
        'col' => '1-3',
    ],
    'transform' => [
        'type' => 'select',
        'name' => 'Transform',
        'col' => '1-3',
        'options' => [
            '' => '-- select --',
            'uppercase' => 'UPPERCASE',
            'lowercase' => 'lowercase',
            'capitalize' => 'Capitalize',
        ],
        'std' => '',
    ],
];

/*
 * builder fields
 *
include( dirname( __FILE__ ).'/options-builder-general.php' );
include( dirname( __FILE__ ).'/options-builder-elements.php' );
include( dirname( __FILE__ ).'/options-builder-query.php' );
include( dirname( __FILE__ ).'/options-builder-section.php' );
include( dirname( __FILE__ ).'/options-builder-ad.php' );
*/

$fox56_customize->add_section( 'h2', [
    'title' => '(HOMEPAGE) Builder',
    'priority' => 30,
]);

$fox56_customize->add_partial( 'h2', [
    'selector' => '.builder56',
    'render_callback' => 'fox56_builder_inner',
    'settings' => [ 'h2[sectionlist]' ]
]);

/**
 * add builder option for page
 */
$fox56_customize->add_field([
    'id' => 'h2',
    'type' => 'builder',
    'setting_type' => 'theme_mod',
    'name' => 'Builder',
    'fields' => $fields,
    'refresh_templates' => $refresh_templates,
    'tabs'  => [
        'general' => 'General',
        'elements' => 'Elements',
        'query' => 'Query',
        'section' => 'Section',
        'ad' => 'Ad',
    ],
    'section' => 'h2',
    'hint' => 'Builder',
]);

include( dirname( __FILE__ ).'/options-builder-settings.php' );