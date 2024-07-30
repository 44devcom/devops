<?php
$fox56_customize->add_section( 'h2', [
    'title' => '(HOMEPAGE) Builder',
    'priority' => 30,
]);

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

/**
 * add builder option for page
 */
$fox56_customize->add_field([
    'id' => 'h2',
    'type' => 'builder',
    'setting_type' => 'theme_mod',
    'name' => 'Builder',
    'refresh_templates' => $refresh_templates,
    'section' => 'h2',
    'hint' => 'Builder',
]);

include( dirname( __FILE__ ).'/options-builder-settings.php' );