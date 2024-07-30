<?php
/* your custom php code goes here */

/**
 * define your child theme version here
 * DO NOT REMOVE THIS
 */
define( 'FOX_CHILD_VERSION', '1.0' );

/**
 * enqueue CSS & Javascript for your child theme
 */
add_action( 'wp_enqueue_scripts', 'fox_child_enqueue_scripts', 1000 ); // as late as possible
function fox_child_enqueue_scripts() {
    /**
     * enqueue child theme style
     * write CSS in your fox-child-theme/style.css file
     */
    wp_enqueue_style( 'fox-child-style', get_stylesheet_uri(), null, FOX_CHILD_VERSION, 'all' );

    /**
     * enqueue custom javascript
     * please uncomment it to load
     */
    // wp_register_script( 'fox-child-script', get_stylesheet_directory_uri() . '/js/child-theme-script.js', [ 'jquery' ], FOX_CHILD_VERSION, true );
    // wp_enqueue_script( 'fox-child-script' );

}