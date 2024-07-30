<?php
$fox56_customize->add_panel( 'blog', [
    'title' => 'Blog / Archive',
    'priority' => 35,
]);

$layouts = [
    'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
    'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
    'masonry' => get_template_directory_uri() . '/inc/customize/images/masonry.jpg',
];
$sidebar_states = [
    'sidebar-left' => get_template_directory_uri() . '/inc/customize/images/sidebar-left.jpg',
    'sidebar-right' => get_template_directory_uri() . '/inc/customize/images/sidebar-right.jpg',
    'no-sidebar' => get_template_directory_uri() . '/inc/customize/images/no-sidebar.jpg',
];

$fox56_customize->add_partial( 'blog', [
    'selector' => '.archive56__main',
    'render_callback' => 'fox56_archive_main_inner',
]);

$fox56_customize->add_partial( 'toparea', [
    'selector' => '.archive56__toparea',
    'render_callback' => 'fox56_toparea_inner',
]);

include_once(dirname( __FILE__ ).'/options-blog-engine.php');
include_once(dirname( __FILE__ ).'/options-blog-archive.php');
include_once(dirname( __FILE__ ).'/options-blog-category.php');
include_once(dirname( __FILE__ ).'/options-blog-tag.php');
include_once(dirname( __FILE__ ).'/options-blog-author.php');
include_once(dirname( __FILE__ ).'/options-blog-search.php');
include_once(dirname( __FILE__ ).'/options-blog-404.php');
include_once(dirname( __FILE__ ).'/options-blog-titlebar.php');
include_once(dirname( __FILE__ ).'/options-blog-toparea.php');
include_once(dirname( __FILE__ ).'/options-blog-pagination.php');
include_once(dirname( __FILE__ ).'/options-blog-item.php');
include_once(dirname( __FILE__ ).'/options-blog-thumbnail.php');
include_once(dirname( __FILE__ ).'/options-blog-title.php');
include_once(dirname( __FILE__ ).'/options-blog-excerpt.php');
include_once(dirname( __FILE__ ).'/options-blog-meta.php');