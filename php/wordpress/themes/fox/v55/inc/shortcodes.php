<?php
/**
 * all shortcodes for the theme
 */

/* 
 * Blog Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'fox_posts', 'fox_blog_shortcode' );
add_shortcode( 'fox_blog', 'fox_blog_shortcode' );
function fox_blog_shortcode( $atts, $content ) {
    
    ob_start();
    
    $layout = isset( $atts[ 'layout' ] ) ? $atts[ 'layout' ] : 'list';
    
    $c_params = fox_customize_params( $layout );
    $fn_params = wp_parse_args( $atts, $c_params );
    
    /**
     * query part
     */
    $query_args = $atts;
    $query = fox_query( $query_args );
    
    fox_blog( $fn_params, $query );
    
    return ob_get_clean();
    
}

/* 
 * Button Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'button', 'fox_button_shortcode' );
add_shortcode( 'btn', 'fox_button_shortcode' );
add_shortcode( 'fox_button', 'fox_button_shortcode' );
add_shortcode( 'fox_btn', 'fox_button_shortcode' );

if ( ! function_exists( 'fox_button_shortcode' ) ) :
function fox_button_shortcode( $atts, $content = null ) {
    
    ob_start();
    
    fox_btn( $atts );
    
    return ob_get_clean();
    
}
endif;

/* 
 * Dropcap Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'dropcap', 'fox_dropcap_shortcode' );
add_shortcode( 'fox_dropcap', 'fox_dropcap_shortcode' );
add_shortcode( 'wi_dropcap', 'fox_dropcap_shortcode' );

if ( ! function_exists( 'fox_dropcap_shortcode' ) ) :
function fox_dropcap_shortcode( $atts, $content = null ) {
    
    extract( wp_parse_args( $atts, [
        'style' => ''
    ] ) );
    
    $class = [
        'wi-dropcap',
        'fox-dropcap',
    ];
    
    if ( $style != 'dark' && $style != 'color' ) $style = 'default';
    $class[] = 'dropcap-' . $style;
    
    $html = '<span class="' . esc_attr( join( ' ', $class ) ) . '">' . trim( $content ) . '</span>';
    
    return $html;
    
}
endif;
add_shortcode( 'blockquote', 'fox_blockquote_shortcode' );
add_shortcode( 'fox_blockquote', 'fox_blockquote_shortcode' );
add_shortcode( 'wi_blockquote', 'fox_blockquote_shortcode' );

/* 
 * Blockquote Shortcode
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_blockquote_shortcode' ) ) :
function fox_blockquote_shortcode( $atts, $content = null ) {
    
    extract( shortcode_atts( array(
        'align' => 'center',
        'author' => '',
    ), $atts ) );
    
    if ( $align != 'left' && $align != 'right' ) $align = 'center';
    
    if ( $author ) $author = '<cite>' . $author . '</cite>';
    
    return '<blockquote class="wi-blockquote align-' . esc_attr( $align ) . '">' . trim( $content ) .  $author . '</blockquote>';
    
}
endif;


/* 
 * Today Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'today', 'fox_today_shortcode' );
add_shortcode( 'fox_today', 'fox_today_shortcode' );

if ( ! function_exists( 'fox_today_shortcode' ) ) :
function fox_today_shortcode( $atts, $content = null ) {
    
    extract( wp_parse_args( $atts, [
        'format' => '',
    ] ) );
    
    if ( ! $format ) {
        $format = get_option( 'date_format' );
    }
    
    return '<span class="tody">' . wp_date( $format ) . '</span>';
    
}
endif;