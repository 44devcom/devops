<?php
/**
 * all shortcodes for the theme
 */

/* 
 * Blog Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'fox_posts', 'fox56_blog_shortcode' );
add_shortcode( 'fox_blog', 'fox56_blog_shortcode' );
function fox56_blog_shortcode( $atts, $content ) {

    if ( ! is_array( $atts ) ) {
        $atts = [];
    }

    /**
     * convert string into array
     */
    $args = [];
    foreach ( $atts as $k => $v ) {
        $final_v = $v;
        /* ----------------------- devices */
        if ( in_array( $k, [ 'column' ] ) ) {
            $v = explode( ',', $v );
            $final_v = [];
            if ( isset( $v[0] ) ) {
                $final_v['desktop'] = $v[0];
            }
            if ( isset( $v[1] ) ) {
                $final_v['tablet'] = $v[1];
            }
            if ( isset( $v[2] ) ) {
                $final_v['mobile'] = $v[2];
            }
        }

        /* ----------------------- categories */
        if ( in_array( $k, [ 'categories', 'exclude_categories' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'trim', $final_v );
            foreach ( $final_v as $j => $final_v_value ) {
                $final_v[ $j ] = 'cat--' . $final_v_value;
            }
        }

        /* ----------------------- authors */
        if ( in_array( $k, [ 'authors' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'absint', $final_v );
        }

        /* ----------------------- components */
         if ( in_array( $k, [ 'components', 'thumbnail_components' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'trim', $final_v );
        }
        
        $args[$k] = $final_v;
    }

    /**
     * query
     */
    $query = fox56_builder_query( $args );
    if ( ! $query ) {
        if ( current_user_can( 'manage_options' ) ) {
            return '<em style="color:red;">message for admin only: No posts found for this query</em>';
        }
        return;
    }

    /**
     * $layout
     */
    $layout = isset( $args['layout'] ) ? $args['layout'] : 'grid';
    if ( ! in_array( $layout, [ 'grid', 'list' ] ) ) {
        $layout = 'grid';
    }

    ob_start();

    if ( 'list' == $layout ) {
        fox56_blog_list( $query, $args );
    } else {
        fox56_blog_grid( $query, $args );
    }

    wp_reset_query();

    return ob_get_clean();
    
}

/* 
 * Button Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'button', 'fox56_button_shortcode' );
add_shortcode( 'btn', 'fox56_button_shortcode' );
add_shortcode( 'fox_button', 'fox56_button_shortcode' );
add_shortcode( 'fox_btn', 'fox56_button_shortcode' );

function fox56_button_shortcode( $atts, $content = null ) {
    ob_start();
    fox56_btn( $atts );
    return ob_get_clean();
}

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