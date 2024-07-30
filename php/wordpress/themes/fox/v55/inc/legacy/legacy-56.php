<?php
/**
 * things will be deprecated since version 5.6
 * we put code here to keep backward compatibility and to make it safe
 */

/**
 * Add Facebook share photo property into <head /> tag
 * @since 4.0
------------------------------------------------------------------------------------ */
// add_action( 'wp_head','fox_facebook_share_picture' );
// removed since this will be supported by SEO plugin
if ( ! function_exists( 'fox_facebook_share_picture' ) ) :
function fox_facebook_share_picture() {
    
    if ( ! is_singular() ) return;
    
    if ( ! has_post_thumbnail() ) return;

    $thumbnail = wp_get_attachment_url( get_post_thumbnail_id(),'full' );
?>

<meta property="og:image" content="<?php echo esc_url($thumbnail);?>"/>
<meta property="og:image:secure_url" content="<?php echo esc_url($thumbnail);?>" />

    <?php
}
endif;

/**
 * @hook to add font output
 * @since 4.0
 * removed since 5.6 
 * we have Typography by Kirki and var(--font-body)
------------------------------------------------------------------------------------ */
// add_filter( 'fox_css', 'fox_add_typography_output', 1, 2 );
function fox_add_typography_output( $css, $mode ) {
    
    $css .= fox_typography_output( $mode );
    return $css;
    
}

/**
 * Typography Engine to generate typography correctly
 * this generates all typography values but font family
 * @since 4.0
 */
function fox_typography_output( $mode = 'frontend' ) {
    
    $all = fox_all_font_support();
    
    $ipad1 = fox_get_query_screen_string_from_text( 'ipad1' );
    $iphone1 = fox_get_query_screen_string_from_text( 'iphone1' );
    
    $media_query_arr = [
        'all' => [],
        $ipad1 => [],
        $iphone1 => [],
    ];
    
    foreach ( $all as $id => $fontdata ) {
        
        extract( wp_parse_args( $fontdata, [
            'selector' => '',
            'backend_selector' => '',
            'typo_selector' => '', // the selector only for typo, if set the selector will be skipped
            'typo' => '',
            'fields' => []
        ]  ) );
        
        if ( 'backend' == $mode ) {
            $selector = $backend_selector;
        }
        
        if ( $typo_selector ) {
            $selector = $typo_selector;
        }
        if ( ! $selector ) continue;
        $typography = get_theme_mod( 'wi_' . $id . '_typography', $typo );
        
        if ( ! $typography ) continue;
        
        try {
            $typography = json_decode( $typography, true );
        } catch ( Exception $err ) {
            $typography = [];
        }
        
        if ( ! $typography ) continue;
        
        $typography = wp_parse_args( $typography, [
            'font-size' => '',
            'font-size-tablet' => '',
            'font-size-phone' => '',
            
            'font-weight' => '',
            'font-style' => '',
            'text-transform' => '',
            'letter-spacing' => '',
            'line-height' => '',
        ] );
        
        foreach ( $typography as $prop => $val ) {
            
            $val = trim( $val );
            if ( '' === $val ) continue;
            
            // unit
            if ( in_array( $prop, [ 'font-size', 'font-size-tablet', 'font-size-phone', 'letter-spacing' ] ) ) {
                if ( is_numeric( $val ) ) $val .= 'px';
            }
            
            if ( 'font-size-tablet' == $prop ) {
                
                if ( ! isset( $media_query_arr[ $ipad1 ][ $selector ] ) ) {
                    $media_query_arr[ $ipad1 ][ $selector ] = [];
                }
                $media_query_arr[ $ipad1 ][ $selector ][] = 'font-size:' . $val;
                
            } elseif ( 'font-size-phone' == $prop ) {
                
                if ( ! isset( $media_query_arr[ $iphone1 ][ $selector ] ) ) {
                    $media_query_arr[ $iphone1 ][ $selector ] = [];
                }
                
                $media_query_arr[ $iphone1 ][ $selector ][] = 'font-size:' . $val;
            } else {
                
                if ( ! isset( $media_query_arr[ 'all' ][ $selector ] ) ) {
                    $media_query_arr[ 'all' ][ $selector ] = [];
                }
                
                $media_query_arr[ 'all' ][ $selector ][] = "{$prop}:{$val}";
            }
            
        }
    
    }
    
    $return = '';
    foreach ( $media_query_arr as $query => $css_pieces ) {
        $inner = '';
        foreach ( $css_pieces as $selector => $props ) {
            $inner .= $selector . '{' . join( ';', $props ) . '}';
        }
        if ( 'all' == $query ) {
            $return .= $inner;
        } else {
            $return .= $query . '{' . $inner . '}';
        }
    }
    
    return $return;
    
}

/**
 *
 * Font Output
 * return [
    'css' => 'the final CSS to add after CSS string',
    '@font-face' => 'CSS RULE string TO add to before of CSS string',
 ]
 * if we don't use local fonts, fontface will be empty
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_css_font_output' ) ) :
    function fox_css_font_output( $mode = 'frontend' ) {
        
        $google_fonts = fox_google_fonts();
        $normal_fonts = fox_normal_fonts();
        $return = [];
        $css = [];
        $fontface = [];
        $font_css_array = [];
        
        $selector_to_value = [];
        
        $all_positions = fox_all_font_support();
        $primary_positions = fox_primary_font_support();
        $primary_array = [];
        foreach ( $primary_positions as $key => $val ) {
            $primary_array[] = 'font_' . $key;
        }
        
        $font_face_rules = '';
        $local_fonts = [];
        
        $font_faces = [];
        
        foreach ( $all_positions as $id => $fontdata ) {
            
            extract( wp_parse_args( $fontdata, [
                'std' => '',
                'selector' => '',
                'backend_selector' => '',
            ] ) );
            
            if ( 'backend' == $mode ) {
                $selector = $backend_selector;
            }
            
            if ( ! $selector ) {
                continue;
            }
            
            $selector_arr = explode( ',', $selector );
            $selector_arr = array_map( 'trim', $selector_arr );
            
            $source = 'standard';
            
            // this means it's not a font face element, may be font size element
            if ( ! $std ) continue;
            
            /**
             * for important positions: body, heading, nav, logo
             * we allow to upload custom font
             */
            if ( isset( $fontdata[ 'primary' ] ) && $fontdata[ 'primary' ] ) {
                
                $source = get_theme_mod( "wi_{$id}_font_source", 'standard' );
                
                /* Local Font
                ------------------------------------ */
                if ( 'local' == $source ) {
                
                    $woff2 = trim( get_theme_mod( "wi_{$id}_font_upload_woff2" ) );
                    $woff = trim( get_theme_mod( "wi_{$id}_font_upload_woff" ) );
                    $fontface = '';
                    
                    if ( $woff2 && $woff ) {
    
                        $fontface = trim( get_theme_mod( "wi_{$id}_custom_font" ) );
                        
                        if ( ! $fontface ) {
                            
                            $pathinfo = pathinfo( $woff2 );
                            $fontface = sanitize_title_with_dashes ( $pathinfo[ 'filename' ] );
                            if ( ! $fontface ) {
                                $pathinfo = pathinfo( $woff );
                                $font = sanitize_title_with_dashes ( $pathinfo[ 'filename' ] );
                            }
                        }
                        
                        // we create a random name
                        if ( ! $fontface ) {
                            $fontface = 'fox-' . $id . '-font';
                        }
    
                        $fallback = get_theme_mod( "wi_{$id}_fallback_font" );
                        if ( 'serif' != $fallback && 'cursive' != $fallback && 'monospace' != $fallback ) $fallback = 'sans-serif';
    
                        /* prevent duplication from loading font twice */
                        if ( ! in_array( $fontface, $local_fonts ) ) {
                            $font_face_rules .= "@font-face {font-family: {$fontface}; src: url({$woff2}) format('woff2'), url({$woff}) format('woff');}";
                        }
                        
                        // add to local font array
                        $local_fonts[] = $fontface;
                        
                        $fontface = '"' . $fontface . '"' . ", {$fallback}";
                        
                    }
                
                }
                
            }
            
            if ( 'standard' == $source ) {
                
                // if google font
                $value = trim( get_theme_mod( "wi_{$id}_font", $std ) );
                
                // if it's font_heading, font_body then just leave it
                // to treat it later
                if ( in_array( $value, $primary_array ) ) {
                    if ( ! isset( $font_css_array[ $value ] ) ) {
                        $font_css_array[ $value ] = [];
                    }
                    $font_css_array[ $value ][] = $selector;
                    
                    foreach ( $selector_arr as $selector_item ) {
                        $selector_to_value[ $selector_item ] = $value;
                    }
                    
                    continue;
                }
    
                // now start analyze it,
                // value is like: Open Sans:400, 400i
                $explode = explode( ':', $value );
                $face = $explode[0];
                $styles = isset( $explode[1] ) ? $explode[1] : '';
    
                if ( ! is_string(  $face  ) ) {
                    $face = '';
                }
                $face = str_replace('+', ' ', $face );
                $face = preg_replace( '/\s/', ' ', $face ); // replace all white spaces by simple white space
                $face = ucwords( $face ); // open sans ==> Open Sans
                
                // now we get font face
                $fontface = $face;
                
                if ( isset( $normal_fonts[ $fontface ] ) ) {
                    
                    $fontface = '"' . $normal_fonts[ $fontface ][ 'face' ] . '",' . $normal_fonts[ $fontface ][ 'category' ] ;
                    
                } elseif ( isset( $google_fonts[ $fontface ] ) ) {
                    
                    $cat = $google_fonts[ $fontface ][ 'category' ];
                    if ( 'handwriting' == $cat || 'display' == $cat ) {
                        $fallback = 'cursive';
                    } else {
                        $fallback = $cat;
                    }
                    
                    $fontface = '"' . $fontface . '",' . $fallback;
                    
                }
            
            }
            
            // now assign it for reuse later
            $font_faces[ $id ] = $fontface;
            
            if ( ! isset( $font_css_array ) ) {
                $font_css_array[ $fontface ] = [];
            }
            $font_css_array[ $fontface ][] = $selector;
            
            foreach ( $selector_arr as $selector_item ) {
                $selector_to_value[ $selector_item ] = $fontface;
            }
            
            
        } // each ID
        
        $final_css_array = [];
        foreach ( $selector_to_value as $selector_item => $value ) {
            $face = '';
            if ( 'font_body' == $value ) {
                $face = isset( $selector_to_value[ '.font-body' ] ) ? $selector_to_value[ '.font-body' ] : '';
            } elseif ( 'font_heading' == $value ) {
                $face = isset( $selector_to_value[ '.font-heading' ] ) ? $selector_to_value[ '.font-heading' ] : '';
            } elseif ( 'font_nav' == $value ) {
                $face = isset( $selector_to_value[ '.wi-mainnav ul.menu > li > a' ] ) ? $selector_to_value[ '.wi-mainnav ul.menu > li > a' ] : '';
            } else {
                $face = $value;
            }
            
            if ( ! isset( $final_css_array[ $face ] ) ) $final_css_array[ $face ] = [];
            $final_css_array[ $face ][] = $selector_item;
            
        }
        
        $css = '';
        foreach ( $final_css_array as $face => $selectors ) {
            $selectors = join( ',', $selectors );
            $css .= $selectors . '{font-family:' . $face . '}';
        }
        
        return [
            'css' => $css,
            '@font-face' => $font_face_rules,
        ];
        
    }
endif;

/**
 * Background CSS Engine to generate background css properties: color, image etc
 * @since 4.0
 */
function fox_background_css_output() {
    
    $all = fox_all_background_elements_support();
    $media_query_arr = [
        'all' => []
    ];
    
    foreach ( $all as $id => $boxdata ) {
        
        extract( wp_parse_args( $boxdata, [
            'selector' => '',
            'std' => [],
        ]  ) );
        
        if ( ! $selector ) continue;
        $std = (array) $std;
        $std = json_encode( $std );
        
        $box = get_theme_mod( 'wi_' . $id . '_background', $std );
        if ( ! $box ) continue;
        
        try {
            $box = json_decode( $box, true );
        } catch ( Exception $err ) {
            $box = [];
        }
        
        if ( ! $box ) continue;
        
        foreach ( $box as $prop => $val ) {
            
            if ( is_null( $val ) ) {
                continue;
            }
            $val = trim( $val );
            if ( '' === $val ) continue;
            
            $query = 'all';
            if ( 'background-image' == $prop ) {
                if ( is_numeric( $val ) ) {
                    $val = wp_get_attachment_url( $val ); // try to get image URL from ID
                }
                if ( ! $val ) continue;
                $val = 'url(' . esc_url( $val ) . ')';
            }
            
            if ( 'background-size' == $prop && 'custom' == $val ) {
                continue;
            }
            if ( 'background-size-custom' == $prop ) {
                $prop = 'background-size';
            }
            
            if ( ! isset( $media_query_arr[ $query ][ $selector ] ) ) {
                $media_query_arr[ $query ][ $selector ] = [];
            }
            $media_query_arr[ $query ][ $selector ][] = $prop . ':' . $val;
            
        }
    
    }
    
    $return = '';
    foreach ( $media_query_arr as $query => $css_pieces ) {
        $inner = '';
        foreach ( $css_pieces as $selector => $props ) {
            $inner .= $selector . '{' . join( ';', $props ) . '}';
        }
        if ( 'all' == $query ) {
            $return .= $inner;
        } else {
            $return .= $query . '{' . $inner . '}';
        }
    }
    
    return $return;
    
}


// add_filter( 'fox_css', 'fox_add_background_css_output', 0, 2 );
function fox_add_background_css_output( $css, $mode ) {
    
    if ( 'backend' == $mode ) {
        return $css;
    }
    
    $css .= fox_background_css_output();
    return $css;
    
}

if ( ! function_exists( 'fox_customizer_css_output' ) ) :
    function fox_customizer_css_output( $mode = 'frontend' ) {
        
        $css = '';
        $unit_arr = fox_unit_array();
        $style_arr = array();
        
        // this will be the most outer wrapper of array
        // like: standard => CSS rules, max-1024 => CSS rules...
        $media_query_arr = array();
        $css = '';
        
        $options = fox_css_options();
        
        $defaults = array(
            'selector'  => '',
            'backend_selector' => '',
            'property'  => '',
            'unit'      => '',
            'conditional' => null,
            'screen'    => '',
            'max_screen'=> '',
            'std'       => null,
        );
        
        /*
        removed since 5.6 by Kirki mechanism
        $font_output = fox_css_font_output( $mode );
        
        // add font face first
        $css .= $font_output[ '@font-face' ]; */
        
        /* Normal Options
        --------------------- */
        foreach ( $options as $id => $css_arr ) {
        
            if ( is_numeric( $id ) ) continue;
        
            // array detect
            if ( isset( $css_arr[ 'property' ] ) ) {
                $css_arr = array( $css_arr );
            }
        
            foreach ( $css_arr as $option ) {
    
                extract( wp_parse_args( $option, $defaults ) );
    
                // Conditional CSS
                if ( is_callable( $conditional ) && ! call_user_func( $conditional ) ) continue;
    
                if ( in_array( $property, $unit_arr ) && '' == $unit )
                    $unit = 'px';
    
                // just a convenstion
                // id with custom at its tag has been processed
                // adjust value accordingly
                $value = null;
    
                if ( null === $value ) {
                    if ( null !== $std ) {
                        $value = trim( get_theme_mod( $id, $std ) );
                    } else {
                        $value = trim( get_theme_mod( $id ) );
                    }
                }
    
                if ( '' === $value ) continue;
    
                if ( 'backend' == $mode ) {
                    $selector = $backend_selector;
                }
                if ( ! $selector || ! $property ) {
                    continue;
                }
                if ( '' != $unit && is_numeric( $value ) ) {
                    $value .= $unit;
                }
                if ( 'background-image' == $property ) {
                    $value = "url({$value})";
                }
    
                if ( 'content' == $property ) {
                    $value = str_replace( '"', '', $value );
                    $value = str_replace( "'", '', $value );
                    $value = '"' . $value . '"';
                }
    
                // css3
                $properties = array( $property );
                switch( $property ) {
                    case 'background-size':
                        $properties = array( '-webkit-background-size', 'background-size' );
                    break;
                    case 'transition':
                        $properties = array( '-webkit-transition', 'transition' );
                    break;
                    case 'transform':
                        $properties = array( '-webkit-transform', 'transform' );
                    break;
                    default:
                    break;
                }
                
                // screen
                $query = 'all';
                if ( $screen && $max_screen ) {
                    $query = "@media only screen and (min-width: {$screen}) and (max-width: {$max_screen})";
                } elseif ( $screen ) {
                    $query = "@media only screen and (min-width: {$screen})";
                } elseif ( $max_screen ) {
                    $query = "@media only screen and (max-width: {$max_screen})";
                }
    
                if ( ! isset( $media_query_arr[ $query ] ) ) {
                    $media_query_arr[ $query ] = array();
                }
                if ( ! isset( $media_query_arr[ $query ][ $selector ] ) ) {
                    $media_query_arr[ $query ][ $selector ] = array();
                }
    
                foreach ( $properties as $property ) {
                    $media_query_arr[ $query ][ $selector ][] = "{$property}:{$value}";
                }
    
            }
        
        } // foreach $option
        
        /* Slogan letter spacing
        --------------------- */
        $slogan_spacing = get_theme_mod( 'wi_slogan_spacing' );
        if ( '' != $slogan_spacing ) {
            $slogan_spacing = floatval( $slogan_spacing );
            $media_query_arr[ fox_get_query_screen_string_from_text( 'ipad1' ) ][ '.slogan' ][] = 'letter-spacing:' . ( $slogan_spacing * .9 ) . 'px';
            $media_query_arr[ fox_get_query_screen_string_from_text( 'ipad2' ) ][ '.slogan' ][] = 'letter-spacing:' . ( $slogan_spacing * .5 ) . 'px';
        }
        
        /* Content BG Opacity
        --------------------- */
        $opacity = trim( get_theme_mod( 'wi_content_background_opacity' ) );
        if ( $opacity != '' ) {
            $media_query_arr[ 'all' ][ '.wrapper-bg-element' ][] = 'opacity:' . absint( $opacity ) / 100 . ';';
        }
        
        /* Content Width
        --------------------- */
        $get_content_width = trim( get_theme_mod( 'wi_content_width', '' ) );
        if ( $get_content_width == '' ) {
            $get_content_width = 1080;
        }
        $get_content_width = str_replace( 'px', '', $get_content_width );
        
        if ( is_numeric( $get_content_width ) ) {
            
            $content_width = absint( $get_content_width );
            if ( $content_width < 800 ) $content_width = 800;
            if ( $content_width > 1280 ) $content_width = 1280;
    
            if ( $content_width > 1100 ) {
                $media_query_arr[ 'all' ][ 'body .elementor-section.elementor-section-boxed>.elementor-container' ] = [
                    'max-width:' . ( $content_width + 40 ) . 'px'
                ];
            }
            
            $content_width_display = $content_width . 'px';
            $content_width_display_padding = ( $content_width + 60 ) . 'px';
            
        // percent maybe
        } else {
            
            $media_query_arr[ 'all' ][ 'body .elementor-section.elementor-section-boxed > .elementor-container' ] = [
                'max-width:none',
            ];
            
            $content_width_display = $get_content_width;
            $content_width_display_padding = 'calc(' . $get_content_width . ' + 60px)';
            
        }
        
        $media_query_arr[ '@media (min-width: 1200px)' ][ '.container,.cool-thumbnail-size-big .post-thumbnail' ][] = 'width:' . $content_width_display;
        $media_query_arr[ '@media (min-width: 1200px)' ][ 'body.layout-boxed .wi-wrapper' ][] = 'width:' . $content_width_display_padding;
        
        /*
        $media_query_arr[ '@media (min-width: 1200px)' ][ '.thumbnail-stretch-bigger .thumbnail-container' ][] = 'width:' . ( $content_width + 120 ) . 'px';
        */
        
        $sidebar_w = get_theme_mod( 'wi_sidebar_width', 265 );
        if ( $sidebar_w ) {
            
            $sidebar_w = absint( $sidebar_w );
            $primary_w = 'calc(100% - '.$sidebar_w.'px)';
            $media_query_arr[ '@media (min-width:1024px)' ][ '.secondary, .section-secondary' ][] = 'width:' . $sidebar_w . 'px';
            $media_query_arr[ '@media (min-width:1024px)' ][ '.has-sidebar .primary, .section-has-sidebar .section-primary, .section-sep' ][] = 'width:' . $primary_w;
            
        }
        
        /* Join CSS pieces
        --------------------- */
        foreach ( $media_query_arr as $query => $style_arr ) {
            
            if ( 'all' === $query ) {
                $open = $close = '';
            } else {
                $open = "{$query} {";
                $close = "}";
            }
            
            $css .= $open;
            
            foreach ( $style_arr as $selector => $pairs ) {
                $inside = join( ';', $pairs );
                $css .= "{$selector}{{$inside}}";
            }
            
            $css .= $close;
            
        }
        
        /* Selection Color
        ----------------------- */
        $selection_color = trim ( get_theme_mod( 'wi_selection_background' ) );
        if ( $selection_color ) {
            
            $selection_text_color = trim( get_theme_mod( 'wi_selection_text_color' ) );
            
            $css .= '::-moz-selection {';
            $css .= "background:{$selection_color};";
            if ( $selection_text_color ) $css .= "color:{$selection_text_color};";
            $css .= '}';
            
            $css .= '::selection {';
            $css .= "background:{$selection_color};";
            if ( $selection_text_color ) $css .= "color:{$selection_text_color};";
            $css .= '}';
            
        }
        
        /* CSS Hook
        --------------------- */
        // $css = apply_filters( 'fox_css', $css, $mode );
        
        return $css;
        
    }
    endif;
    
    // add_filter( 'fox_css', 'fox_customizer_css' );
    function fox_customizer_css( $css ) {
    
        $css .= fox_customizer_css_output();
        return $css;
    
    }

    if ( ! function_exists( 'fox_css_options' ) ) :
        /**
         * Lists of css properties
         *
         * We'll render this function by tool 
         * so plz do not edit this function in your child theme
         *
         * @since 1.0
         */
        function fox_css_options() {
            
            include get_template_directory() . '/v55/inc/customizer/css-options.php';
            include get_template_directory() . '/v55/inc/customizer/toggles.php';
            
            // list of elements will be ignored by toggle conditional
            $ignores = array();
            $options = array();
            
            foreach ( $toggles as $id => $option ) {
                
                $toggle = $option[ 'toggle' ];
                $choices = $option[ 'options' ];
                
                $real_value = get_theme_mod( $id );
                if ( '' == $real_value && isset( $option[ 'std' ] ) ) $real_value = $option[ 'std' ];
                
                $not_exclude = array();
                if ( isset( $toggle[ $real_value ] ) ) {
                    $not_exclude = $toggle[ $real_value ];
                    if ( is_string( $not_exclude ) ) $not_exclude = array( $not_exclude );
                }
        
                foreach ( $toggle as $val => $dependent_elements ) {
        
                    // don't care about real value
                    if ( $val === $real_value ) continue;
        
                    if ( is_string( $dependent_elements ) ) $dependent_elements = array( $dependent_elements );
                    foreach ( $dependent_elements as $dependent_element ) {
        
                        // not intersect with the real value
                        if ( ! in_array( $dependent_element, $not_exclude ) ) {
                            $ignores[] = $dependent_element;
                        }
        
                    }
                }
            
            }
            
            foreach ( $reg_options as $id => $option ) {
                
                if ( in_array( $id, $ignores ) ) continue;
                $options[ $id ] = $option;
                
            }
            
            return $options;
            
        }
    endif;