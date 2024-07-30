<?php
$this->log( 'page_layout_type' );
$this->log( 'page_template', 'deprecated' );

/* ========================================================================     PAGE */
// #page_style
// #page_sidebar_state
// #page_thumbnail_stretch
// #page_content_width
$this->set( 'page_style', '1' );
$this->set( 'page_sidebar_state', 'sidebar-right' );
$this->set( 'page_thumbnail_stretch', 'stretch-none' );
$this->set( 'page_content_width', 'full' );

// #page_content_image_stretch
if ( 'stretch-none' != get_theme_mod( 'wi_page_content_image_stretch', 'stretch-none' ) ) {
    $this->set_theme_mod( 'page_content_image_stretch', true );
} else {
    $this->set_theme_mod( 'page_content_image_stretch', false );
}

$this->log([
    'page_content_image_stretch'
]);

$this->log([
    'page_column_layout',
    'page_dropcap',
    'page_share',
    'page_share_positions',
    'page_comment',
], 'deprecated' );