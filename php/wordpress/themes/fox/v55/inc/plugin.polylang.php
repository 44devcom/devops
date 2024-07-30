<?php
if ( function_exists( 'pll_register_string' ) ) :

    /**
     * Register some string from the customizer to be translated with Polylang
     */
    function fox_theme_name_pll_register_string() {
        
        $sections = fox_builder_data();
        
        foreach ( $sections as $i => $section ) {
            
            $heading = isset( $section[ 'heading' ] ) ? $section[ 'heading' ] : '';
            $section_id = isset( $section[ 'id' ] ) && $section[ 'id' ] ? $section[ 'id' ] : $i;
            if ( '' != $heading ) {
                pll_register_string( 'homepage_builder_heading_' . $section_id, $heading, 'Fox', true );
            }
            
        }
        
        /*
        // builder heading
        for ( $i = 1; $i <= 40; $i++ ) {
            $prefix = "bf_". $i . '_';
            $heading = get_theme_mod( $prefix . 'heading' );
            if ( '' != $heading ) {
                pll_register_string( 'homepage_builder_heading_' . $i, $heading, 'Fox', true );
            }
        }
        
        // main stream heading
        $prefix = 'main_stream_';
        $heading = get_theme_mod( $prefix . 'heading' );
        if ( '' != $heading ) {
            pll_register_string( 'homepage_builder_heading_mainstream', $heading, 'Fox', true );
        }
        
        */
        
        // copyright
        $copyright = get_theme_mod( 'wi_copyright' );
        if ( '' != $copyright ) {
            pll_register_string( 'copyright', $copyright, 'Fox', true );
        }
        
        // 404 message
        $msg = get_theme_mod( 'wi_page_404_message', 'It seems we can\'t find what you\'re looking for.' );
        if ( '' != $msg ) {
            pll_register_string( 'message_404', $msg, 'Fox', true );
        }
        
        // quick translate strings
        $strings = fox_quick_translation_support();
        foreach ( $strings as $k => $str ) {
            pll_register_string( $k, $str, 'Fox', true );
        }
        
    }

    add_action( 'after_setup_theme', 'fox_theme_name_pll_register_string' );

endif;