<?php
if ( function_exists( 'pll_register_string' ) ) :

    /**
     * Register some string from the customizer to be translated with Polylang
     */
    function fox_theme_name_pll_register_string() {
        
        /* -------------------------        builder heading      */
        $h = get_theme_mod( 'h', [] );
        extract( wp_parse_args( $h, [
            'sectionlist' => []
        ]));
        foreach ( $sectionlist as $section_id ) {
            $section = get_theme_mod( $section_id, [] );

            // heading
            $section_heading = isset( $section['heading'] ) ? $section['heading'] : '';
            if ( $section_heading ) {
                pll_register_string( 'builder_heading_' . $section_id, $section_heading, 'Fox', true );
            }

            // heading URL
            $heading_url = isset( $section['heading_link']['url'] ) ? $section['heading_link']['url'] : '';
            if ( $heading_url ) {
                pll_register_string( 'builder_heading_url_' . $section_id, $heading_url, 'Fox', true );
            }

            // heading link text
            $heading_link_text = isset( $section['heading_link_text'] ) ? $section['heading_link_text'] : 'View';
            if ( $heading_link_text ) {
                pll_register_string( 'builder_heading_link_text_' . $section_id, $heading_link_text, 'Fox', true );
            }

        }

        /* -------------------------        copyright      */
        $copyright = get_theme_mod( 'footer_copyright' );
        if ( '' != $copyright ) {
            pll_register_string( 'copyright', $copyright, 'Fox', true );
        }
        
        /* -------------------------        quick translation      */
        $strings = fox_quick_translation_support();
        foreach ( $strings as $k => $str ) {
            pll_register_string( $k, $str, 'Fox', true );
        }
        
    }

    add_action( 'after_setup_theme', 'fox_theme_name_pll_register_string' );

endif;