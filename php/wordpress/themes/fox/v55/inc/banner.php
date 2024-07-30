<?php
/**
 * abstract: all functions & problems about Ad/Banner
 - fox_ad: template function for displaying ad
 - hooks: insert ad before entry content, after entry content.. for single post
 */

/**
 * Display ad
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_ad' ) ) :
function fox_ad( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        
        // they are all attachment IDs, not url
        'img' => '',
        'image' => '', // alias
        'tablet' => '',
        'phone' => '',
        
        'width' => '',
        'tablet_width' => '',
        'phone_width' => '',
        
        'url' => '',
        'target' => '_blank',
        'code' => '',
        
        'extra_class' => '',
        'attrs' => '',
        
    ] ) );
    
    $class = [ 'fox-ad', 'responsive-ad', 'ad-container' ];
    if ( $extra_class ) {
        $class[] = $extra_class;
    }
    $ad_html = '';
    
    if ( $image && ! $img ) $img = $image;
    
    $has_source = false;
    
    if ( ! empty( $code ) ) {
        $ad_html = do_shortcode( $code );
        $class[] = 'ad-code';
    } else {
        
        $class[] = 'ad-banner';
        $open = $close = $img_html = $alt = '';
        $srcset = [];
        
        if ( $url ) {
            
            if ( '_self' != $target ) $target = '_blank';
            $open = '<a href="' . esc_url( $url ). '" target="' . $target . '"' . $attrs . '>';
            $close = '</a>';
            
        }

        if ( $phone ) {
            
            $phone_id = 0;
            
            if ( is_array( $phone ) ) {
                $phone = $phone[ 'url' ];
                $phone_id = attachment_url_to_postid( $phone );
            } elseif ( is_numeric( $phone ) ) {
                $phone_id = $phone;           
            } elseif ( is_string( $phone ) ) {
                $phone_id = attachment_url_to_postid( $phone );
            }
            
            if ( $phone_id ) {
                
                $phone_src = wp_get_attachment_url( $phone_id );
                
                if ( $phone_src ) {
                    // was 568px before version 4.3
                    $img_html .= '<source srcset="' . esc_url( $phone_src ) . '" media="(max-width: 600px)" />';
                    $has_source = true;
                }
            }

        }
        
        if ( $tablet ) {
            $tablet_id = 0;
            if ( is_array( $tablet ) ) {
                $tablet = $tablet[ 'url' ];
                $tablet_id = attachment_url_to_postid( $tablet );
            } elseif ( is_numeric( $tablet ) ) {
                $tablet_id = $tablet;
            } elseif ( is_string( $tablet ) ) {
                $tablet_id = attachment_url_to_postid( $tablet );
            }
            
            if ( $tablet_id ) {
                
                $tablet_src = wp_get_attachment_url( $tablet_id );
                
                if ( $tablet_src ) {
                    // was 768px before version 4.3
                    // was 782px before version 4.4
                    $img_html .= '<source srcset="' . esc_url( $tablet_src ) . '" media="(max-width: 840px)" />';
                    $has_source = true;
                }
            }

        }
        
        if ( $img ) {
            
            $img_id = 0;
            if ( is_array( $img ) ) {
                
                $img = $img[ 'url' ];
                $img_id = attachment_url_to_postid( $img );
                
            } elseif ( is_numeric( $img ) ) {
                
                $img_id = $img;
                
            } elseif ( is_string( $img ) ) {
                
                $img_id = attachment_url_to_postid( $img );
                
            }
            
            if ( $img_id ) {
                $img_src = wp_get_attachment_image( $img_id, 'full' );
                if ( $img_src ) {
                    $img_html .= $img_src;
                }
            }
        }

        if ( $img_html ) {
            $id = uniqid( 'fox-ad-' );
            if ( $has_source ) {
                $img_html = '<picture id="' . esc_attr( $id ) . '">' . $img_html . '</picture>';
            } else {
                $img_html = '<div id="' . esc_attr( $id ) . '" class="ad-wrapper">' . $img_html . '</div>';
            }
            
            // custom css
            $css = [];
            if ( $width ) {
                if ( is_numeric( $width ) ) $width .= 'px';
                $css[] = "#{$id}{width:{$width}}";
            }
            if ( $tablet_width ) {
                if ( is_numeric( $tablet_width ) ) $tablet_width .= 'px';
                $css[] = fox_get_query_screen_string_from_text( 'ipad1' ) . "{#{$id}{width:{$tablet_width}}}";
            }
            if ( $phone_width ) {
                if ( is_numeric( $phone_width ) ) $phone_width .= 'px';
                $css[] = fox_get_query_screen_string_from_text( 'iphone1' ) . "{#{$id}{width:{$phone_width}}}";
            }
            if ( $css ) {
                $img_html = '<style>' . join( '', $css ) . '</style>' . $img_html;
            }
            
        }
        
        if ( $img_html ) {
            $ad_html = $open . $img_html . $close;
        }
    
    }
    
    if ( ! $ad_html ) return;
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <div class="banner-inner">

        <?php echo $ad_html; ?>
        
    </div><!-- .banner-inner -->
    
</div>
<?php
    
}
endif;

/**
 * Append ad into single post
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_action( 'fox_before_entry_content', 'fox_append_single_ad_before', 10 );
function fox_append_single_ad_before() {
    
    $args = [
        'code' => get_theme_mod( 'wi_single_before_code' ),
        'image' => get_theme_mod( 'wi_single_before_banner' ),
        'width' => get_theme_mod( 'wi_single_top_before_width' ),
        'tablet' => get_theme_mod( 'wi_single_before_banner_tablet' ),
        'phone' => get_theme_mod( 'wi_single_before_banner_phone' ),
        'url' => get_theme_mod( 'wi_single_before_banner_url' ),
        'target' => get_theme_mod( 'wi_single_before_banner_url_target', '_blank' ),
        
        'extra_class' => 'fox-ad-before single-component'
    ];
    
    fox_ad( $args );
    
}

/**
 * Append ad into single post
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_action( 'fox_after_entry_content', 'fox_append_single_ad_after', 10 );
function fox_append_single_ad_after() {
    
    $args = [
        'code' => get_theme_mod( 'wi_single_after_code' ),
        'image' => get_theme_mod( 'wi_single_after_banner' ),
        'width' => get_theme_mod( 'wi_single_after_banner_width' ),
        'tablet' => get_theme_mod( 'wi_single_after_banner_tablet' ),
        'phone' => get_theme_mod( 'wi_single_after_banner_phone' ),
        'url' => get_theme_mod( 'wi_single_after_banner_url' ),
        'target' => get_theme_mod( 'wi_single_after_banner_url_target', '_blank' ),
        
        'extra_class' => 'fox-ad-after single-component'
    ];
    
    fox_ad( $args );
    
}

/**
 * Ad at the very top of post
 * @since 4.3
 * ------------------------------------------------------------------------------------------------ */
add_action( 'fox_single_top', 'fox_single_top_ad', 20 );
function fox_single_top_ad( $params ) {
    
    $args = [
        'code' => get_theme_mod( 'wi_single_top_code' ),
        'image' => get_theme_mod( 'wi_single_top_banner' ),
        'width' => get_theme_mod( 'wi_single_top_banner_width' ),
        'tablet' => get_theme_mod( 'wi_single_top_banner_tablet' ),
        'phone' => get_theme_mod( 'wi_single_top_banner_phone' ),
        'url' => get_theme_mod( 'wi_single_top_banner_url' ),
        'target' => get_theme_mod( 'wi_single_top_banner_url_target', '_blank' ),
        
        'extra_class' => 'fox-ad-top'
    ];
    
    ob_start();
    fox_ad( $args );
    $ad = ob_get_clean();
    
    if ( $ad ) {
        echo fox_format( '<div class="single-big-section single-big-section-ad single-big-section-top-ad"><div class="container">{ad}</div></div>', [
            'ad' => $ad,
        ] );
    }
    
}