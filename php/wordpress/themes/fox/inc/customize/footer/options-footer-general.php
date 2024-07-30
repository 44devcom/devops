<?php
if ( ! defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    return;
}
$fox56_customize->add_section( 'footer_general',[
    'title' => 'General',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'wi_footer_builder',
    'options' => [
        'false' => 'Default (Recommended)',
        'true' => 'Footer Builder (Elementor)',
    ],
    'std' => 'false',
    'title' => 'Footer Engine',
    'section' => 'footer_general',
]);

$fox56_customize->add_field([
    'id' => 'footer_elementor__msg',
    'type' => 'message',
    'msg' => 'If you use FOX Block + Elementor for building footer, you can skip all options in this Footer Panel of Customizer.',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_footer_block_id',
    'options' => $fox_block_list,
    'std' => '',
    'title' => 'Footer Builder Template',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_single_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'title' => 'Footer Template for Single Post',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_page_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'title' => 'Footer Template for Page',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_category_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'name'      => 'Footer Template for Category',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_tag_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'name'      => 'Footer Template for Tag',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_author_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'name'      => 'Footer Template for Author',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_search_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'name'      => 'Footer Template for Search',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'wi_404_footer_template',
    'options' => $fox_block_list,
    'std' => '',
    'name'      => 'Footer Template for Page 404',
    'condition' => [ 'wi_footer_builder' => 'true' ],
]);