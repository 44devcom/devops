<?php
if ( ! defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    return;
}
$fox56_customize->add_section( 'blog_engine', [
    'title' => 'Render Engine',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'id' => 'wi_archive_layout_type',
    'type'      => 'radio',
    'options'   => [
        'classic' => 'Default (Recommended)',
        'builder' => 'Builder (by Elementor)',
    ],
    'std'       => 'classic',
    'name'      => 'Render Engine',
    'section' => 'blog_engine',
]);

$fox56_customize->add_field([
    'id'        => 'wi_archive_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => 'Home & general archive template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);

$fox56_customize->add_field([
    'id'        => 'wi_category_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => 'Category template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);

$fox56_customize->add_field([
    'id'        => 'wi_tag_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => 'Tag template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);

$fox56_customize->add_field([
    'id'        => 'wi_author_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => 'Author template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);

$fox56_customize->add_field([
    'id'        => 'wi_search_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => 'Search template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);

$fox56_customize->add_field([
    'id'        => 'wi_404_template',
    'type'      => 'select',
    'options'   => $fox_block_list,
    'std'       => '',
    'name'      => '404 template',
    'condition' => [ 'wi_archive_layout_type' => 'builder' ],
]);