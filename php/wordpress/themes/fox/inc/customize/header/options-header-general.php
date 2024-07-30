<?php
if ( ! defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    return;
}

$fox56_customize->add_section( 'header_general', [
    'title' => 'General',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'id' => 'wi_header_builder', // this ID is for legacy reason
    'type'      => 'radio',
    'options' => [
        'false' => 'Default', // not using widgets header builder, ie. classic header
        'elementor' => 'Elementor', // elementor header
    ],
    'std' => 'false',
    'name'      => 'Header Engine',
    'section' => 'header_general',
]);

/* ---------------------------------------------        classic header preset */
/* @todo57
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'header_preset',
    'title'       => 'Header preset',
    'desc' => 'Choose among predefined presets of header',
    'std'     => 'stack1',
    'options'     => [
        'stack1'    => get_template_directory_uri() . '/inc/customizer/assets/img/header-stack1.jpg',
        'stack2'    => get_template_directory_uri() . '/inc/customizer/assets/img/header-stack2.jpg',
        'stack3'    => get_template_directory_uri() . '/inc/customizer/assets/img/header-stack3.jpg',
        'stack4'    => get_template_directory_uri() . '/inc/customizer/assets/img/header-stack4.jpg',
        'inline'    => get_template_directory_uri() . '/inc/customizer/assets/img/header-inline.jpg',
    ],
    
    'condition' => [ 'wi_header_builder' => 'false' ],
    'heading' => 'Predefined Layouts',
]);
*/

$fox56_customize->add_field([
    'id' => 'header_elementor__msg',
    'type'      => 'message',
    'msg' => 'If you use FOX Block + Elementor for building header, you can skip all options in this Header Panel of Customizer.',
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_header_elementor',
    'name' => 'Global header template',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
    
    'heading' => 'Header by FOX Block',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_single_header_template',
    'name' => 'Custom header for single post',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_page_header_template',
    'name' => 'Custom header for page',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_category_header_template',
    'name' => 'Custom header for category',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_tag_header_template',
    'name' => 'Custom header for tag',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_author_header_template',
    'name' => 'Custom header for author',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_search_header_template',
    'name' => 'Custom header for search page',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_404_header_template',
    'name' => 'Custom header for page 404',
    'std'     => '',
    'options'     => $fox_block_list,
    'condition' => [ 'wi_header_builder' => 'elementor' ],
]);