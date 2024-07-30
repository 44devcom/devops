<?php
/**
 * Register some string from the customizer to be translated with Polylang
 */
function wi_wpml_register_strings() {
    
    /* Part 1: Homepage Builder
    ----------------------------------------------------------------- */
    $sections = fox_builder_data();
    foreach ( $sections as $i => $section ) {

        $heading = isset( $section[ 'heading' ] ) ? $section[ 'heading' ] : '';
        $section_id = isset( $section[ 'id' ] ) && $section[ 'id' ] ? $section[ 'id' ] : $i;
        if ( '' != $heading ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_heading_' . $section_id, $heading );
        }
        
        $link_text = isset( $section[ 'viewall_link_text' ] ) ? $section[ 'viewall_link_text' ] : '';
        if ( '' != $link_text ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_link_text_' . $section_id, $link_text );
        }
        
        $url = isset( $section[ 'viewall_link' ] ) ? $section[ 'viewall_link' ] : '';
        if ( '' != $url ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_url_' . $section_id, $url );
        }

    }
    
    $prefix = 'main_stream_';
    $heading = get_theme_mod( $prefix . 'heading' );
    if ( '' != $heading ) {
        do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_heading_norm', $heading );
    }
    
    /* Part 2: Quick Translation
    ----------------------------------------------------------------- *
    // quick translate strings
    $strings = fox_quick_translation_support();
    foreach ( $strings as $k => $str ) {
        do_action( 'wpml_register_single_string', 'FOX Strings', 'fox_quick_' . $k, $str );
    }
    */

}

add_action( 'after_setup_theme', 'wi_wpml_register_strings' );