<?php
/**
 * upgrade typography options
 * body, heading, nav options
 * font set
 * other position options: blog post title, archive title, blockquote, caption, input..
 */

/**
 * challenges: custom font
 */

/* step 1: migrate main typography positions: body, heading, nav
=================================================================================================== */
$positions = [ 'body', 'heading', 'nav' ];
$i = 0;
foreach ( $positions as $position ) {
    $source = get_theme_mod( 'wi_' . $position . '_font_source', 'standard' );
    $typography_str = get_theme_mod( 'wi_' . $position . '_typography', '[]' );
    $typography = json_decode( $typography_str, true );
    if ( ! is_array( $typography ) ) {
        $typography = [];
    }

    if ( 'local' == $source ) {

        $woff2 = get_theme_mod( 'wi_' . $position . '_font_upload_woff2' );
        $woff = get_theme_mod( 'wi_' . $position . '_font_upload_woff' );
        $custom_font = get_theme_mod( 'wi_' . $position . '_custom_font', '' );
        $fallback_font = get_theme_mod( 'wi_' . $position . '_fallback_font' );

        if ( ! is_string( $custom_font ) ) {
            $custom_font = '';
        }
        $custom_font = trim( $custom_font );
        if ( $custom_font === '' ) {
            $custom_name = '';
            if ( $woff2 ) {
                $custom_name = basename( $woff2, '.woff2' );
            }
            if ( ! $custom_name ) {
                if ( $woff ) {
                    $custom_name = basename( $woff, '.woff' );
                }
            }
            if ( ! $custom_name ) {
                $custom_name = 'Custom font ' . rand( 1000, 9999 );
            }
            $custom_font = $custom_name;
        }
        
        $result = wp_insert_term( $custom_font, 'bsf_custom_fonts' );
        if ( ! is_wp_error( $result ) ) {
            $term_id = $result[ 'term_id' ];
            
            /**
             * set font data
             */
            $font_data = [
                'font_fallback' => $fallback_font,
                'font-display' => 'swap',
                'font-weight-0' => isset( $typography['font-weight'] ) ? $typography['font-weight'] : 400,
                'font_woff_2-0' => '',
                'font_woff-0' => '',
                'font_eot-0' => '',
                'font_ttf-0' => '',
                'font_svg-0' => '',
                'font_otf-0' => '',
            ];
            if ( $woff2 ) {
                $font_data[ 'font_woff_2-0' ] = $woff2;
            }
            if ( $woff ) {
                $font_data[ 'font_woff-0' ] = $woff;
            }
            $option_key = 'taxonomy_bsf_custom_fonts_' . $term_id;
            update_option( $option_key, $font_data );

        }

        $font_family = '"' . $custom_font . '"';

    } else {
        $font = get_theme_mod( 'wi_' . $position . '_font', 'Helvetica Neue' );
        $face_explode = explode( ':', $font );
        $face = isset( $face_explode[0] ) ? $face_explode[0] : '';

        $font_family = $face;
    
    }
    $this->set_theme_mod( $this->PREFIX . $position . '_font', $font_family );
    
    /**
     * TYPOGRAPHY
     */
    // text transform
    $typography_arr = [
        'transform' => isset( $typography[ 'text-transform' ] ) ? trim($typography[ 'text-transform' ]) : '',
        'spacing' => isset( $typography[ 'letter-spacing' ] ) ? trim($typography[ 'letter-spacing' ]) : '',
        'weight' => isset( $typography[ 'font-weight' ] ) ? trim($typography[ 'font-weight' ]) : 400,
        'style' =>  isset( $typography[ 'font-style' ] ) ? trim($typography[ 'font-style' ]) : '',
    ];

    // line-height
    if ( isset( $typography['line-height'] ) ) {
        $typography_arr[ 'line_height' ] = $typography['line-height'];
        
        /**
         * nav line height will become menu height
         */
        if ( 'nav' == $position ) {
            $height = $typography_arr[ 'line_height' ];
            if ( strpos( $height, 'px') > 0 ) {
                $this->set_theme_mod( 'nav_item_height', $height );
            }
        }
    }
    
    /**
     * FONT SIZE
     */
    if ( 'body' == $position || 'nav' == $position ) {
        if ( isset( $typography['font-size'] ) && $typography['font-size'] ) {
            $size = absint( $typography['font-size'] );
            if ( $size < 5 ) {
                $size = 16;
            }
            $typography_arr[ 'size' ] = $size;
        }
        if ( isset( $typography['font-size-tablet'] ) && $typography['font-size-tablet'] ) {
            $size = absint( $typography['font-size-tablet'] );
            if ( $size < 5 ) {
                $size = 16;
            }
            $typography_arr[ 'size_tablet' ] = $size;
        }
        if ( isset( $typography['font-size-phone'] ) && $typography['font-size-phone'] ) {
            $size = absint( $typography['font-size-phone'] );
            if ( $size < 5 ) {
                $size = 16;
            }
            $typography_arr[ 'size_mobile' ] = $size;
        }
    }

    $this->set_theme_mod( $this->PREFIX . $position . '_typography', $typography_arr );

    $this->log([
        $position . '_font',
        $position . '_typography',
        $position . '_font_source',
        $position . '_font_upload_woff2',
        $position . '_font_upload_woff',
        $position . '_custom_font',
    ]);
    $this->log( $position . '_fallback_font', 'deprecated' );

}

/* step 2: other typography positions
=================================================================================================== */
/* general elements
============================================== */
// logo
$this->set_typography( 'logo', [
    'font-family' => 'font_heading',
    'letter-spacing' => '0px',
    'line-height' => '1.1',
    'text-transform' => 'uppercase',
    'font-weight' => '400',
    'font-style' => 'normal',
    'font-size' => 60,
    'font-size-tablet' => 40,
    'font-size-phone' => 20,
]);

// tagline
$this->set_typography( 'tagline', [
    'font-family' => 'font_heading',
    'font-size' => '0.8125em',
    'font-weight' => '400',
    'font-style' => 'normal',
    'text-transform' => 'uppercase',
    'letter-spacing' => '6',
    'line-height' => '1.1',
]);

// submenu
$this->set_typography( 'nav_submenu', []);

// copyright
$this->set_typography( 'copyright', [
]);

// footer menu
$this->set_typography( 'footernav', [
    'text-transform' => 'uppercase',
    'letter-spacing' => '1px',
    'font-size' => '11px',
]);

$this->set_typography( 'offcanvas_nav', [
    'font-size' => 16,
    'font-family' => 'font_nav',
]);

/* design
============================================== */
$this->set_typography( 'heading' );
$this->set_typography( 'h2', [ 'font-size' => '2.0625em' ] );
$this->set_typography( 'h3', [ 'font-size' => '1.625em' ] );
$this->set_typography( 'h4', [ 'font-size' => '1.25em' ] );

// button
$this->set_typography( 'button', [
    'font-family' => 'font_heading',
    'letter-spacing' => '1px',
    'text-transform' => 'uppercase',
    'font-weight' => '600',
    'font-style' => 'normal',
    'font-size' => 14,
    'font-size-phone' => 12,
]);

// input
$this->set_typography( 'input', [
    'font-family' => 'font_body',
    'letter-spacing' => '0px',
    'text-transform' => 'none',
    'font-weight' => '400',
    'font-style' => 'normal',
    'font-size' => 16,
    'font-size-phone' => 16,
]);

// widget title
$this->set_typography( 'wid_title', [
    'font-family' => 'font_heading',
    'letter-spacing' => '2px',
    'text-transform' => 'uppercase',
    'font-weight' => '400',
    'font-style' => 'normal',
    'line-height' => '',
    'font-size' => 12,
    'font-size-phone' => 12,
], 'widget_title' );

// caption
$this->set_typography( 'caption', [
    'font-family' => 'font_body',
    'letter-spacing' => '0',
    'text-transform' => 'none',
    'font-weight' => '400',
    'font-style' => 'normal',
    'line-height' => '',
    'font-size' => 14,
    'font-size-phone' => 12,
]);

// blockquote
$this->set_typography( 'blockquote', [
    'font-family' => 'font_body',
    'letter-spacing' => '0',
    'text-transform' => 'none',
    'font-weight' => '400',
    'font-style' => 'italic',
    'line-height' => '',
    'font-size' => 20,
    'font-size-phone' => 12,
]);

$dropcap_arr = [];
$dropcap_face = get_theme_mod( $this->PREV_PREFIX . 'dropcap_font', 'font_body' );
if ( 'font_body' == $dropcap_face ) {
    $dropcap_arr[ 'face' ] = 'var(--font-body)';
} elseif ( 'font_heading' == $dropcap_face ) {
    $dropcap_arr[ 'face' ] = 'var(--font-heading)';
} elseif ( 'font_nav' == $dropcap_face ) {
    $dropcap_arr[ 'face' ] = 'var(--font-nav)';
} else {
    // deprecate the case Gothic
    $dropcap_arr[ 'face' ] = 'var(--font-body)';
}
$dropcap_weight = get_theme_mod( $this->PREV_PREFIX . 'dropcap_font_weight', 700 );
$dropcap_arr[ 'weight' ] = $dropcap_weight;
$this->set_theme_mod( $this->PREFIX . 'dropcap_typography', $dropcap_arr );

$this->log([
    'dropcap_font',
    'dropcap_font_weight',
]);

/* post item
============================================== */
// post title
$title_size = get_theme_mod( 'wi_title_size', 'normal' );
$title_size_arr = $this->title_typo_map( $title_size );
$title_size_arr[ 'font-family' ] = 'font_heading';
$title_size_arr[ 'font-size' ] = $title_size_arr['size'];
$title_size_arr[ 'font-size-tablet' ] = $title_size_arr['size_tablet'];
$title_size_arr[ 'font-size-phone' ] = $title_size_arr['size_mobile'];
$this->set_typography( 'post_title', $title_size_arr );
$this->log( 'title_size' );

// post excerpt
$excerpt_size = get_theme_mod( 'wi_excerpt_size', 'normal' );
$excerpt_size_arr = $this->excerpt_typo_map( $excerpt_size );
$excerpt_size_arr[ 'font-size' ] = $excerpt_size_arr['size'];
$excerpt_size_arr[ 'font-size-tablet' ] = $excerpt_size_arr['size_tablet'];
$excerpt_size_arr[ 'font-size-phone' ] = $excerpt_size_arr['size_mobile'];
$this->set_typography( 'excerpt', $excerpt_size_arr );
$this->log( 'excerpt_size' );

// meta
$this->set_typography( 'post_meta', [
    'font-family' => 'font_body',
]);

// standalone category
$this->set_typography( 'standalone_category', [
    'font-family' => 'font_heading',
]);

/* blog/archive
============================================== */
// title bar
$this->set_typography( 'titlebar_title', [
    'font-family' => 'font_heading',
    'font-size' => 64,
], 'archive_title');

/* single
============================================== */
// single title
$this->set_typography( 'single_title', [
    'font-family' => 'font_heading',
], 'single_post_title');

// subtitle
$this->set_typography( 'subtitle', [
    'font-size' => '1.2em',
    'font-weight' => 300,
], 'single_post_subtitle' );
$this->set( 'subtitle_color', '', 'single_post_subtitle_color' );

// single content
$this->set_typography( 'single_content', [
]);

// single heading
$this->set_typography( 'single_heading', [
    'font-size' => '1.5em',
]);

/* buildder
============================================== */
$heading_size = get_theme_mod( 'wi_builder_heading_size', 'large' );
$heading_size_arr = $this->builder_heading_typo_map( $heading_size );
$heading_size_arr[ 'font-family' ] = 'font_heading';
$heading_size_arr[ 'font-size' ] = $heading_size_arr['size'];
$heading_size_arr[ 'font-size-tablet' ] = $heading_size_arr['size_tablet'];
$heading_size_arr[ 'font-size-phone' ] = $heading_size_arr['size_mobile'];
$heading_size_arr[ 'letter-spacing' ] = '1px';
$heading_size_arr[ 'text-transform' ] = 'uppercase';
$heading_size_arr[ 'font-weight' ] = '600';
$heading_size_arr[ 'font-style' ] = 'normal';

$this->log( 'builder_heading_size' );

$this->set_typography( 'builder_heading', $heading_size_arr, 'elementor_heading' );

/* step 3: font subsets
=================================================================================================== */
$font_subsets = trim( get_theme_mod( 'wi_font_subsets', '' ) );
if ( ! empty( $font_subsets ) ) {
    if ( ! is_array( $font_subsets ) ) {
        $font_subsets = explode( ',', $font_subsets );
    }
    $this->set_theme_mod( 'font_subsets', $font_subsets );
}
$this->log( 'font_subsets' );