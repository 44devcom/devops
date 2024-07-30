<?php
$fox56_customize->add_section( 'fox_woocommerce', [
    'title' => 'FOX Options',
    'panel' => 'woocommerce',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'shop_sidebar_state',
    'name' => 'WooCommerce Sidebar',
    'std' => 'no-sidebar',
    'options' => [
        'sidebar-left' => 'Sidebar left',
        'sidebar-right' => 'Sidebar right',
        'no-sidebar' => 'No sidebar',
    ],
    'section' => 'fox_woocommerce',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'products_per_page',
    'name' => 'Custom number of products per page',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'shop_column',
    'name' => 'Default Catalog Column Layout',
    'std' => '3',
    'options' => array(
        '2' => esc_html__( '2 Columns', 'wi' ),
        '3' => esc_html__( '3 Columns', 'wi' ),
        '4' => esc_html__( '4 Columns', 'wi' ),
    ),
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'product_align',
    'name' => 'Product align',
    'std' => 'left',
    'options' => array(
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ),
    'css' => [
        [
            'selector' => '.woocommerce ul.products li.product h3,.woocommerce ul.products li.product .price, .product-thumbnail-inner',
            'property' => 'text-align',
        ]
    ]
]);