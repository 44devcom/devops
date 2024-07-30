<?php
// google font list: https://usefulangle.com/post/260/google-fonts-api-php
// my console: https://console.cloud.google.com/apis/api/webfonts.googleapis.com/metrics?project=project-name-stmp-thefox&authuser=2
// https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBp5eLYgPzsce1ifARkg61nxhHH1P70bB8&sort=popularity

/**
 * take care everything about TYPOGRAPHY
 * since 5.6
 */
add_filter( 'fox_css56', 'fox56_root_vars' );
function fox56_root_vars( $css ) {

    global $fox56_customize;

    if ( ! $fox56_customize ) {
        return $css;
    }

    $fontlist = $fox56_customize->fontlist;
    $fontlist = array_merge( $fontlist, [
        'Helvetica Neue' => [
            'category' => 'sans-serif',
        ],
        'Helvetica' => [
            'category' => 'sans-serif',
        ],
        'Arial' => [
            'category' => 'sans-serif',
        ],
        'Times' => [
            'category' => 'serif',
        ],
        'Georgia' => [
            'category' => 'serif',
        ],
    ]);

    $root_css = '';

    /* body font */
    $body_font = get_theme_mod( 'body_font', '' );
    if ( $body_font ) {
        if (isset($fontlist[$body_font])) {
            $body_font = '"' . $body_font . '", ' . $fontlist[$body_font]['category'];
        }
        $root_css .= ':root{--font-body:' . $body_font  .';}';
    }

    /* heading font */
    $heading_font = get_theme_mod( 'heading_font', '' );
    if ( $heading_font ) {
        if (isset($fontlist[$heading_font])) {
            $heading_font = '"' . $heading_font . '", ' . $fontlist[$heading_font]['category'];
        }
        $root_css .= ':root{--font-heading:' . $heading_font  .';}';
    }

    /* nav font */
    $nav_font = get_theme_mod( 'nav_font', [] );
    if ( $nav_font ) {
        if (isset($fontlist[$nav_font])) {
            $nav_font = '"' . $nav_font . '", ' . $fontlist[$nav_font]['category'];
        }
        $root_css .= ':root{--font-nav:' . $nav_font  .';}';
    }

    /* custom 1 font */
    $custom_1_font = get_theme_mod( 'custom_1_font' );
    if ( ! is_string( $custom_1_font ) ) {
        $custom_1_font = '';
    }
    if ( $custom_1_font ) {
        if (isset($fontlist[$custom_1_font])) {
            $custom_1_font = '"' . $custom_1_font . '", ' . $fontlist[$custom_1_font]['category'];
        }
        $root_css .= ':root{--font-custom-1:' . $custom_1_font  .';}';
    }

    /* custom 2 font */
    $custom_2_font = strval( get_theme_mod( 'custom_2_font', '' ) );
    if ( $custom_2_font ) {
        if (isset($fontlist[$custom_2_font])) {
            $custom_2_font = '"' . $custom_2_font . '", ' . $fontlist[$custom_2_font]['category'];
        }
        $root_css .= ':root{--font-custom-2:' . $custom_2_font  .';}';
    }

    return $root_css . $css;

}

/**
 * collect font and weight
 */
add_action( 'wp_enqueue_scripts', 'fox56_enqueue_fonts' );
function fox56_enqueue_fonts() {

    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }

    $fontlist = $fox56_customize->fontlist;

    $map_arr = [
        'var(--font-body)' => get_theme_mod( 'body_font', '' ),
        'var(--font-heading)' => get_theme_mod( 'heading_font', '' ),
        'var(--font-nav)' => get_theme_mod( 'nav_font', '' ),
        'var(--font-custom-1)' => get_theme_mod( 'custom_1_font', '' ),
        'var(--font-custom-2)' => get_theme_mod( 'custom_2_font', '' ),
    ];
    $weight_arr = [];

    foreach ( $fox56_customize->typography as $css ) {
        $face = $weight = $style = null;
        foreach ( $css as $css_arr ) {
            $prop = $css_arr[ 'property'];
            $value = $css_arr['value'];
            $selector = $css_arr['selector'];
            if ( 'font-family' == $prop ) {
                $face = $value;
                if ( isset( $map_arr[$face] ) ) {
                    $face = $map_arr[$face];
                }
                if ( ! is_string($face) ) {
                    $face = '';
                }
                continue;
            } elseif ( 'font-weight' == $prop ) {
                $weight = $value;
                continue;
            } elseif ( 'font-style' == $prop ) {
                $style = $value;
                continue;
            }
        }
        if ( 'italic' != $style ) {
            $style = '';
        }
        if ( ! $weight ) {
            $weight = 400;
        }
        $weight = intval( $weight );
        if ( $weight ) {
            $weight .= $style;
        }
        if ( ! $face ) {
            continue;
        }

        if ( ! isset( $weight_arr[$face] ) ) {
            $weight_arr[$face] = []; 
        }
        // final:
        if ( 400 == $weight ) {
            $weight = 'regular';
        } elseif ( '400italic' == $weight ) {
            $weight = 'italic';
        }
        $weight_arr[$face][] = $weight;
    }

    /**
     * select default font face
     */
    foreach( $weight_arr as $face => $weights ) {
        $variants = get_theme_mod( $face . '_variants', [] );
        if ( ! is_array( $variants ) ) {
            $variants = explode( ',', $variants );
            $variants = array_map( 'trim', $variants );
        }
        $weight_arr = array_merge( $weight_arr, $variants );
    }

    /**
     * ok, now we have array of faces => necessary weights
     * we'll compare with the existing weights
     */
    $ul = [];
    foreach ( $weight_arr as $face => $weights ) {
        $weights = array_unique( $weights );
        // if this is not google font, do not load it
        if ( ! isset( $fontlist[$face] ) ) {
            continue;
        }
        $weights = array_intersect( $weights, $fontlist[$face]['variants'] );
        $weights = join(',',$weights);
        $li = "{$face}:{$weights}";
        $ul[] = $li;
    }
    if ( ! $ul ) {
        return;
    }

    $query_args = [
        'family' => urlencode( join( '|', $ul ) )
    ];
    $subsets = get_theme_mod( 'font_subsets', [] );
    if ( ! empty( $subsets ) ) {
        $query_args[ 'subset' ] = urlencode( join( ',', $subsets ) );
    }
    $font_display = get_theme_mod( 'font_display', 'swap' );
    if ( 'auto' != $font_display)  {
        $font_display = 'swap';
    }
    $query_args[ 'display' ] = $font_display;

    $fonts_url = add_query_arg( $query_args , 'https://fonts.googleapis.com/css' );

    if ( get_theme_mod( 'css_critical', false ) ) {
        $device = 'fox56_async';
    } else {
        $device = 'all';
    }

    wp_enqueue_style( 'fox-google-fonts', esc_url_raw( $fonts_url ), [], FOX_VERSION, $device );

}