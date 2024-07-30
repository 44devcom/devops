<?php
$fox56_customize->add_section( 'blog_pagination',[
    'title' => 'Pagination',
    'panel' => 'blog'
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'pagination_item_border',
    'name' => 'Pagination item border',
    'hint' => 'pagination border',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ],
    'std' => 0,

    'section' => 'blog_pagination'
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'pagination_item_border_radius',
    'hint' => 'pagination border radius',
    'name' => 'Pagination item border radius',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'std' => 0,
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_color',
    'hint' => 'pagination color',
    'name' => 'Pagination item color',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers',
            'property' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_background',
    'hint' => 'pagination item background',
    'name' => 'Pagination item background',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers',
            'property' => 'background',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_border_color',
    'name' => 'Pagination item border color',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers',
            'property' => 'border-color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_hover_color',
    'name' => 'Pagination item hover color',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers:hover, .pagination56 .page-numbers.current',
            'property' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_hover_background',
    'name' => 'Pagination item hover background',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers:hover, .pagination56 .page-numbers.current',
            'property' => 'background',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'pagination_item_hover_border_color',
    'name' => 'Pagination item hover border color',
    'css' => [
        [
            'selector' => '.pagination56 .page-numbers:hover, .pagination56 .page-numbers.current',
            'property' => 'border-color',
        ],
    ],
]);