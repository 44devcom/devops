<?php
/**
 * abstract: template tags to use on blog loops like thumbnail, title, meta, excerpt ..
 *
 fox_image
 fox_thumbnail
 fox_format_indicator
 
 fox_is_live
 fox_live_indicator
 
 fox_post_title
 fox_post_excerpt
 fox_post_categories
 fox_post_date
 fox_post_author
 
 fox_post_view
 fox_comment_link
 fox_reading_time
 fox_post_meta
 fox_post_body
 */

/**
 * Literally any Image
 * image in the figure with advanced features
 * ------------------------------------------------------------------ */
function fox_image( $args = [], $echo = true ) {
    
    extract( wp_parse_args( $args, [
        
        // image id
        'id' => 0,
        'image_post' => null,

        'thumbnail' => '',
        'thumbnail_custom' => '',
        'thumbnail_placeholder' => '',
        'hover_effect' => 'none',
        'letter' => '', // additional info for hover effect

        'logo' => '', // must be <img /> in html form, not ID or URL
        'logo_width' => '',

        'shape' => 'acute',

        // try to get from postid
        'postid' => 0,

        // link
        // possible values: lightbox, single, none
        // default: none
        'link' => '',

        // display caption or not
        // default is true
        'caption' => true,

        'attr' => [], // extra img attr [ 'data-foo' => 'blah' ]

        'extra_class' => '', // container class
        'figure_class' => '', // extra figclass
        'link_class' => '',
        'caption_class' => '', // extra caption class

        /**
         * special options of post thumbnail id
         */
        'extra_css' => '',

        'format_indicator' => true,
        'inside' => '',
        'view' => false,
        'review_score' => false,

    ] ) );

    /**
     * TRY TO GET FULL URL
     */
    $full_url = '';
    // if image id provided
    if ( $id ) {

        $full_url = wp_get_attachment_url( $id );

        // media doesn't exist
        if ( ! $full_url ) return;

    } elseif ( $postid ) {

        // attempt 1: custom blog thumbnail
        $id = get_post_meta( $postid, '_wi_blog_thumbnail', true );
        if ( $id ) {
            $full_url = wp_get_attachment_url( $id );
        }

        // attempt 2: post thumbnail
        if ( ! $full_url ) {
            $id = get_post_thumbnail_id( $postid );
            if ( $id ) {
                $full_url = wp_get_attachment_url( $id );
            }
        }

        // attempt 3: any attachment to the post
        if ( ! $full_url ) {
            $attachments = get_posts( array(
                'post_type' => 'attachment',
                'posts_per_page' => 1,
                'post_parent' => $postid,
            ) );
            if ( ! empty( $attachments ) ) {
                $id = $attachments[0]->ID;
                $full_url = wp_get_attachment_url( $id );
            }

        }

        // media doesn't exist
        if ( ! $full_url ) {
            if ( ! $thumbnail_placeholder ) {
                return;
            } else {

                $full_url = get_theme_mod( 'wi_default_thumbnail' );
                if ( ! $full_url ) {
                    $full_url = get_template_directory_uri() . '/images/placeholder.jpg';
                    $id = 0;
                } else {
                    $id = attachment_url_to_postid( $full_url );
                }

            }
        }

    }

    /**
     * TRY TO GET IMG
     */
    $padding = $height_element = '';
    if ( 'landscape' ==  $thumbnail ) {
        $size = 'thumbnail-medium';
        $thumbnail_custom = '480x384';
    } elseif ( 'square' == $thumbnail ) {
        $size = 'thumbnail-square';
        $thumbnail_custom = '480x480';
    } elseif ( 'portrait' == $thumbnail ) {
        $size = 'thumbnail-portrait';
        $thumbnail_custom = '480x600';
    } elseif ( 'original' == $thumbnail ) {
        $size = 'full';
    } elseif ( 'thumbnail-large' == $thumbnail ) {
        $size = $thumbnail;
        $thumbnail_custom = '720x480';
    } elseif ( 'custom' == $thumbnail ) {
        // now it depends to get an appropriate thumbnail size
        $size = '';
        $thumbnail_custom = strtolower( $thumbnail_custom );
        $explode = explode( 'x', $thumbnail_custom );
        if ( count( $explode ) < 2 ) $explode = explode( ':', $thumbnail_custom ); // another attempt
        if ( count( $explode ) < 2 ) $explode = [ 600, 600 ]; // just a random default number

        $w = absint( $explode[0] ); $h = absint( $explode[1] );
        if ( $w < 1 || $h < 1 ) $w = $h = 600; // default fallback value

        $padding = $h/$w * 100;
        if ( $padding < 10 || $padding > 1000 ) $padding = 100; // in case wrong value

        if ( $w < 120 ) {
            if ( $h < 150 ) {
                $size = 'thumbnail';
            } else {
                $size = 'medium';
            }
        } elseif ( $w < 300 ) {
            $size = 'medium';
        } elseif ( $w < 440 ) {
            if ( $h < 380 ) {
                $size = 'thumbnail-medium';
            } elseif ( $h < 440 ) {
                $size = 'thumbnail-square';
            } else {
                $size = 'thumbnail-portrait';
            }
        } elseif ( $w < 720 ) {
            if ( $h < 440 ) {
                $size = 'thumbnail-large';
            } else {
                $size = 'large';
            }
        } elseif ( $w < 900 ) {
            $size = 'large';
        } else {
            $size = 'full';
        }

    } else {
        $size = $thumbnail;
    }

    /**
     * try to have thumbnail_custom to calculate width, height
     * in case placeholder thumbnail
     */
    if ( $thumbnail_custom ) {
        $thumbnail_custom = strtolower( $thumbnail_custom );
        $explode = explode( 'x', $thumbnail_custom );
        if ( count( $explode ) < 2 ) $explode = explode( ':', $thumbnail_custom ); // another attempt
        if ( count( $explode ) < 2 ) $explode = [ 600, 600 ]; // just a random default number

        $w = absint( $explode[0] ); $h = absint( $explode[1] );
        if ( $w < 1 || $h < 1 ) $w = $h = 600; // default fallback value

        $padding = $h/$w * 100;
        if ( $padding < 10 || $padding > 1000 ) $padding = 100; // in case wrong value
    }

    $attrs = [];
    $attr = ( array ) $attr;
    $attrs = array_merge( $attrs, $attr );

    // has id
    if ( $id ) {

        $img_html = wp_get_attachment_image( $id, $size, false, $attrs );

    // placeholder thumbnail    
    } else {

        $clone_attrs = $attrs;
        if ( isset( $clone_attrs[ 'src' ] ) ) unset( $clone_attrs[ 'src' ] );

        $img_attrs = [];
        foreach ( $clone_attrs as $k => $v ) {
            $img_attrs[] = $k . '="' . esc_attr( $v ) .'"';
        }
        $img_html = '<img src="' . esc_url( $full_url ) . '" alt="' . esc_html__( 'Default thumbnail', 'wi' ) . '" ' . join( ' ', $img_attrs ). ' />';

    }

    if ( $padding ) {

        $height_element = '<span class="height-element" style="padding-bottom:' . $padding . '%;"></span>';
        $figure_class .= ' custom-thumbnail';

    }

    /**
     * LINK PROBLEM
     */
    $url = $url_class = '';
    if ( $link == 'lightbox' ) {
        $url = $full_url;
        $url_class = [ 'fox-lightbox-gallery-item' ];
    } elseif ( $link == 'single' ) {
        $url_class = [ 'post-link' ];
        $url = get_permalink( $postid );
    }
    if ( $url ) {
        if ( $link_class ) {
            $url_class[] = $link_class;
        }
        $open = '<a href="' . esc_url( $url ) . '" class="' . esc_attr( join( ' ', $url_class ) ). '">';
        $close = '</a>';
    } else {
        $open = $close = '';
    }

    /**
     * CAPTION PROBLEM
     */
    $caption_html = '';
    if ( $caption ) {
        if ( $id ) {
            $get = wp_get_attachment_caption( $id );
            if ( ! empty( $get ) ) {
                $cl = [ 'fox-figcaption' ];
                if ( $caption_class ) {
                    $cl[] = $caption_class;
                }
                $caption_html = '<figcaption class="' . esc_attr( join( ' ', $cl ) ) . '">' . $get . '</figcaption>';
            }
        }
    }

    /**
     * INSIDE
     * custom html inside the figure element
     */
    if ( $postid ) {

        // format indicator
        if ( $format_indicator ) {
            $inside .= fox_format_indicator( $postid );
        }

        // view count
        if ( $view ) {
            $viewcount = fox_get_view();
            if ( $viewcount > 0 ) {
                $inside .= '<span class="thumbnail-view">' . sprintf( fox_word( 'views' ), fox_number( $viewcount ) ) . '</span>';
            }
        }

        // review score
        if ( $review_score ) {
            $score = fox_get_review_score();
            $inside .= '<span class="thumbnail-score">' . $score . '</span>';
        }

    }

    /**
     * HOVER EFFECT
     */
    if ( ! in_array( $hover_effect, [ 'fade', 'dark', 'letter', 'zoomin', 'logo' ] ) ) {
        $hover_effect = 'none';
    }
    $figure_class .= ' hover-' . $hover_effect;
    if ( 'dark' == $hover_effect || 'letter' == $hover_effect || 'logo' == $hover_effect ) {
        $figure_class .= ' hover-dark';
        $inside .= '<span class="image-overlay"></span>';
    }
    if ( 'letter' == $hover_effect && $letter != '' ) {

        $inside .= '<span class="image-letter font-heading"><span class="main-letter">' . $letter . '</span><span class="l-cross l-left"></span><span class="l-cross l-right"></span></span>';

    } elseif ( 'logo' == $hover_effect && $logo != '' ) {

        $image_logo_style = '';
        if ( isset( $logo_width ) ) {
            $logo_width = absint( $logo_width );
            if ( $logo_width <= 100 && $logo_width > 0 ) {
                $image_logo_style = ' style="width:' . $logo_width . '%"';
            }
        }

        $inside .= '<span class="image-logo"' . $image_logo_style . '>' . $logo . '</span>';

    }

    /**
     * CSS
     */
    $css = [];
    if ( ! empty( $extra_css ) ) {
        if ( is_array( $extra_css ) ) $css = $extra_css;
        else $css[] = $extra_css;
    }
    $css = join( ';', $css );
    if ( ! empty( $css ) ) {
        $css = ' style="' . esc_attr( $css ) . '"';
    }

    // shape
    if ( 'circle' != $shape && 'round' != $shape ) {
        $shape = 'acute';
    }
    $figure_class .= ' thumbnail-' . $shape;

    /**
     * OUTER FIGURE
     */
    $cl = [ 'fox-figure' ];
    if ( $figure_class ) {
        $cl[] = $figure_class;
    }
    $figure_open = '<figure class="' . esc_attr( join( ' ', $cl ) ). '" ' . $css . ' itemscope itemtype="https://schema.org/ImageObject">';
    $figure_close = '</figure>';

    $output = $figure_open . '<div class="image-element thumbnail-inner">' . $open . $img_html . $height_element . $inside . $close . '</div>' . $caption_html . $figure_close;

    if ( $echo ) echo $output;
    
    return $output;
    
}

/**
 * Thumbnail
 * ------------------------------------------------------------------ */
function fox_thumbnail( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        
        'thumbnail_type' => 'simple',
        
        'thumbnail_shape' => 'acute',
        'thumbnail_extra_class' => '',
        
        'thumbnail' => 'landscape',
        'thumbnail_custom' => '',
        'thumbnail_placeholder' => '',
        'thumbnail_placeholder_id' => '',
        'thumbnail_hover' => '',
        'thumbnail_hover_logo' => '',
        'thumbnail_hover_logo_width' => '',
        
        'thumbnail_showing_effect' => '',
        
        'thumbnail_format_indicator' => '',
        'thumbnail_view' => '',
        'thumbnail_index' => '',
        'thumbnail_review_score' => '',
        
        'count' => '',
        
        'thumbnail_extra_css' => '',
        
        // since 4.6.7
        'thumbnail_caption' => '',
        
        'custom_blog_thumbnail' => true,
        
    ]);
    
    /**
     * @since 4.4.1
     */
    $params = apply_filters( 'fox_thumbnail_final_params', $params );
    
    $extra_class = '';
    if ( isset( $params['thumbnail_extra_class'] ) ) {
        $extra_class = $params['thumbnail_extra_class'];
    }
    
    if ( isset( $params[ 'thumbnail_type'] ) && 'advanced' == $params[ 'thumbnail_type'] ) {
        
        fox_advanced_thumbnail([ 'extra_class' => $extra_class ]);
        return;
        
    }
    
    $class = [
        
        'wi-thumbnail',
        'fox-thumbnail',
        'post-item-thumbnail',
        'fox-figure',
        $extra_class,
        
    ];
    
    if ( $params[ 'thumbnail_review_score' ] ) {
        $params[ 'thumbnail_index' ] = false;
    }
    
    /**
     * shape
     */
    $shape = $params[ 'thumbnail_shape' ];
    if ( 'circle' != $shape && 'round' != $shape ) {
        $shape = 'acute';
    }
    $class[] = 'thumbnail-' . $shape;
    
    /**
     * thumbnail
     */
    $name_to_size_adapter = [
        'landscape' => 'thumbnail-medium',
        'square' => 'thumbnail-square',
        'portrait' => 'thumbnail-portrait',
        'original' => 'large',
        'original_fixed' => 'large',
    ];
    $size = '';
    $thumbnail = $params[ 'thumbnail' ];
    if ( isset( $name_to_size_adapter[ $thumbnail ] ) ) {
        $size = $name_to_size_adapter[ $thumbnail ];
    } else {
        $size = $thumbnail;
    }
    
    /**
     * custom size
     */
    $height_element = '';
    if ( 'custom' == $thumbnail ) {
        
        $thumbnail_custom = $params[ 'thumbnail_custom' ];
        
        $size = '';
        $thumbnail_custom = strtolower( $thumbnail_custom );
        $explode = explode( 'x', $thumbnail_custom );
        if ( count( $explode ) < 2 ) $explode = explode( ':', $thumbnail_custom ); // another attempt
        if ( count( $explode ) < 2 ) $explode = [ 600, 600 ]; // just a random default number

        $w = absint( $explode[0] ); $h = absint( $explode[1] );
        if ( $w < 1 || $h < 1 ) $w = $h = 600; // default fallback value

        $padding = $h/$w * 100;
        if ( $padding < 10 || $padding > 1000 ) $padding = 100; // in case wrong value

        if ( $w < 120 ) {
            if ( $h < 150 ) {
                $size = 'thumbnail';
            } else {
                $size = 'medium';
            }
        } elseif ( $w < 300 ) {
            $size = 'medium';
        } elseif ( $w < 440 ) {
            if ( $h < 380 ) {
                $size = 'thumbnail-medium';
            } elseif ( $h < 440 ) {
                $size = 'thumbnail-square';
            } else {
                $size = 'thumbnail-portrait';
            }
        } elseif ( $w < 720 ) {
            if ( $h < 440 ) {
                $size = 'thumbnail-large';
            } else {
                $size = 'large';
            }
        } elseif ( $w < 900 ) {
            $size = 'large';
        } else {
            $size = 'full';
        }
        
        $class[] = 'custom-thumbnail thumbnail-custom';
        $height_element = '<span class="height-element" style="padding-bottom:' . $padding . '%;"></span>';
        
    }
    
    /**
     * original fixed
     */
    if ( 'original_fixed' == $thumbnail ) {
        $padding = 100;
        $class[] = 'custom-thumbnail thumbnail-custom custom-thumbnail-contain';
        $height_element = '<span class="height-element" style="padding-bottom:' . $padding . '%;"></span>';
    }
    
    $img_html = '';
    /**
     * get the img_html
     */
    
    // first attempt: custom blog thumbnail
    if ( false !== $params[ 'custom_blog_thumbnail' ] ) {
        $custom_blog_thumbnail_id = get_post_meta( get_the_ID(), '_wi_blog_thumbnail', true );
        if ( $custom_blog_thumbnail_id ) {
            $img_html = wp_get_attachment_image( $custom_blog_thumbnail_id, $size );
        }
    }
    
    // second attempt: the post thumbnail
    if ( ! $img_html && has_post_thumbnail() ) {
        $img_html = wp_get_attachment_image( get_post_thumbnail_id(), $size );
    }
    
    if ( ! $img_html ) {
        // third attempt: attachments attached to the post
        $attachments = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => 1,
            'post_parent' => get_the_ID(),
            'post_status' => 'publish',
            'now_found_row' => true,
        ) );
        if ( ! empty( $attachments ) ) {
            $img_html = wp_get_attachment_image( $attachments[0]->ID, $size );
        }
    }
    
    // forth attempt: in case we use placeholder
    if ( ! $img_html && $params[ 'thumbnail_placeholder' ] ) {
        
        $thumbnail_placeholder_img_html = '';
        $thumbnail_placeholder_id = isset( $params[ 'thumbnail_placeholder_id' ] ) ? $params[ 'thumbnail_placeholder_id' ] : null;
        if ( $thumbnail_placeholder_id ) {
            if ( ! is_numeric( $thumbnail_placeholder_id ) ) {
                $get_id = attachment_url_to_postid( $thumbnail_placeholder_id );
                if ( $get_id ) {
                    $thumbnail_placeholder_img_html = wp_get_attachment_image( $get_id, $size );
                } else {
                    $thumbnail_placeholder_img_html = '<img src="' . esc_url( $thumbnail_placeholder_id ) . '" alt="Placeholder Photo" />';
                }
            } else {
                $thumbnail_placeholder_img_html = wp_get_attachment_image( $thumbnail_placeholder_id, $size );
            }
            
        }
        if ( ! $thumbnail_placeholder_img_html ) {
            $thumbnail_placeholder_img_html = '<img src="' . get_template_directory_uri() . '/images/placeholder.jpg' . '" alt="Placeholder Photo" />';
        }
        
        $img_html = $thumbnail_placeholder_img_html;
        
    }
    
    // no image found, render nothing
    if ( ! $img_html ) return;
    
    // @todo, get width, height by WP function
    $array = array();
    // $img_html = str_replace( 'width', 'foo', $img_html );
    preg_match( '/width="([^"]*)"/i', $img_html, $array ) ;
    $w = isset( $array[1] ) ? $array[1] : 0;
    preg_match( '/height="([^"]*)"/i', $img_html, $array ) ;
    $h = isset( $array[1] ) ? $array[1] : 0;
    $w = absint( $w ) + 1;
    $h = absint( $h ) + 1;
    
    if ( ( $w / $h ) > 0.9 ) {
        $class[] = 'ratio-landscape';
    } else {
        $class[] = 'ratio-portrait';
    }
    
    /**
     * hover effect
     */
    $hover_markup = '';
    $hover_effect = $params[ 'thumbnail_hover' ];
    if ( ! in_array( $hover_effect, [ 'fade', 'dark', 'grayscale', 'sepia', 'letter', 'zoomin', 'logo' ] ) ) {
        $hover_effect = 'none';
    }
    $class[] = 'hover-' . $hover_effect;
    
    if ( 'dark' == $hover_effect || 'letter' == $hover_effect || 'logo' == $hover_effect ) {
        $class[] = ' hover-dark';
        $hover_markup .= '<span class="image-overlay"></span>';
    }
    if ( 'letter' == $hover_effect ) {
        
        $title = strip_tags( get_the_title() );
        $letter = substr( $title, 0, 1 );

        if ( '' != $letter ) {
            $hover_markup .= '<span class="image-letter font-heading"><span class="main-letter">' . $letter . '</span><span class="l-cross l-left"></span><span class="l-cross l-right"></span></span>';
        }

    } elseif ( 'logo' == $hover_effect ) {
        
        $logo = $params[ 'thumbnail_hover_logo' ]; // logo ID
        $logo_html = '';
        if ( $logo ) {
            
            if ( is_numeric( $logo ) ) {
                $logo_id = $logo;    
            } else {
                $logo_id = attachment_url_to_postid( $logo );
            }
            if ( $logo_id ) {
                $logo_html = wp_get_attachment_image( $logo_id, 'large' );
            } else {
                $logo_html = '<img src="' . esc_url( $logo ). '" alt="' . esc_html__( 'Hover Logo', 'wi' ). '" />';
            }
        }
        
        if ( $logo_html ) {
            
            $logo_width = absint( $params[ 'thumbnail_hover_logo_width' ] ); // in percent

            $image_logo_style = '';
            $logo_width = absint( $logo_width );
            if ( $logo_width <= 100 && $logo_width > 0 ) {
                $image_logo_style = ' style="width:' . $logo_width . '%"';
            }

            $hover_markup .= '<span class="image-logo"' . $image_logo_style . '>' . $logo_html . '</span>';
            
        }

    }
    
    /**
     * Thumbnail Showing Effect
     * @since 4.3
     */
    $showing_effect = $params[ 'thumbnail_showing_effect' ];
    if ( in_array( $showing_effect, [ 'fade', 'slide', 'popup', 'zoomin' ] ) ) {
        $class[] = 'thumbnail-loading';
        $class[] = 'effect-' . $showing_effect;
    }
    
    $css = [];
    
    /**
     * thumbnail width
     */
    $thumbnail_width = isset( $params[ 'thumbnail_width' ] ) ? trim( $params[ 'thumbnail_width' ] ) : null;
    if ( $thumbnail_width ) {
        if ( is_numeric( $thumbnail_width ) ) $thumbnail_width .= 'px';
        if ( $thumbnail_width ) {
            $params[ 'thumbnail_extra_css' ] = 'width:' . $thumbnail_width;
        }
    }
    
    /**
     * extra CSS
     */
    $extra_css = isset( $params[ 'thumbnail_extra_css' ] ) ? $params[ 'thumbnail_extra_css' ] : '';
    if ( ! empty( $extra_css ) ) {
        if ( is_array( $extra_css ) ) $css = $extra_css;
        else $css[] = $extra_css;
    }
    $css = join( ';', $css );
    if ( ! empty( $css ) ) {
        $css = ' style="' . esc_attr( $css ) . '"';
    }
    
    /**
     * $target_attr
     * since 4.7.3
     */
    $target_attr = '';
    if ( 'link' == get_post_format() ) {
        
        $target = get_post_meta( get_the_ID(), '_format_link_target', true );
        if ( ! $target ) {
            $target = get_theme_mod( 'wi_single_format_link_target', '_self' );
        }
        
        if ( '_blank' == $target ) {
            $target_attr = ' target="' . esc_attr( $target ) . '"';
        }
        
    }
    
    ?>
    
<figure class="<?php echo esc_attr( join( ' ', $class ) ); ?>" itemscope itemtype="https://schema.org/ImageObject"<?php echo $css; ?>>
    
    <div class="thumbnail-inner">
    
        <?php if ( ! isset( $params[ 'thumbnail_link' ] ) || $params[ 'thumbnail_link' ] ) { ?>
        
        <a href="<?php echo fox_permalink(); ?>" class="post-link"<?php echo $target_attr; ?>>
            
        <?php } ?>

            <div class="image-element">

                <?php echo $img_html . $height_element; ?>

            </div><!-- .image-element -->

            <?php echo $hover_markup; ?>

            <?php /* other HTML stuffs inside thumbnail */ 
            if ( $params[ 'thumbnail_index' ] ) {
                echo '<span class="thumbnail-index">' . sprintf( '%02d' , $params[ 'count' ] ) . '</span>';
            }

            if ( $params[ 'thumbnail_format_indicator' ] ) {
                echo fox_format_indicator();
            }

            if ( $params[ 'thumbnail_view' ] ) {
                $viewcount = fox_get_view();
                if ( $viewcount > 0 ) {
                    echo '<span class="thumbnail-view">' . sprintf( fox_word( 'views' ), fox_number( $viewcount ) ) . '</span>';
                }
            }

            if ( $params[ 'thumbnail_review_score' ] ) {
                if ( fox_get_review_score_number() ) {
                    $score = fox_get_review_score();
                    echo '<span class="thumbnail-score">' . $score . '</span>';
                }
            }

            ?>

        <?php if ( ! isset( $params[ 'thumbnail_link' ] ) || $params[ 'thumbnail_link' ] ) { ?>
            
        </a>
        
        <?php } ?>
        
    </div><!-- .thumbnail-inner -->
    
    <?php if ( $params[ 'thumbnail_caption' ] && $the_caption = get_the_post_thumbnail_caption() ) {
    ?>
    
    <figcaption class="wp-caption-text fox-figcaption">
        <?php echo $the_caption; ?>
    </figcaption>
    
    <?php } ?>

</figure><!-- .fox-thumbnail -->

<?php
    
}

/**
 * Format Indicator
 * ------------------------------------------------------------------ */
function fox_format_indicator( $postid = 0 ) {
    
    if ( ! $postid ) $postid = get_the_ID();
    
    $format = get_post_format( $postid );
    
    if ( 'video' === $format ) {
        $video_format_indicator_style = get_theme_mod( 'wi_video_indicator_style', 'outline' );
        
        $cl = [ 'video-format-indicator' ];
        $cl[] = 'video-indicator-' . $video_format_indicator_style;
        
        return '<span class="' . esc_attr( join( ' ', $cl )). '"><i class="fa fa-play"></i></span>';
    }
    
    if ( 'gallery' === $format ) {
        return '<span class="post-format-indicator gallery-format-indicator"><i class="fa fa-clone"></i></span>';
    }
    
    if ( 'link' === $format ) {
        return '<span class="post-format-indicator link-format-indicator"><i class="fa fa-share"></i></span>';
    }
    
    if ( 'audio' === $format ) {
        return '<span class="post-format-indicator audio-format-indicator"><i class="fa fa-music"></i></span>';
    }
    
    return '';
    
}

/**
 * Check if this is a live post
 * ------------------------------------------------------------------ */
function fox_is_live() {
    return 'true' == get_post_meta( get_the_ID(), '_is_live', true );
}

function fox_live_indicator() {
    
    if ( ! fox_is_live() ) {
        return;
    }
    
    $diff = (int) abs( get_post_modified_time( 'U' ) - current_time( 'timestamp' ) );
    
    if ( $diff < 60 ) {
        
        $time = fox_word( 'justnow' );
        
    } else {
    
        $time = sprintf( fox_word( 'ago' ), human_time_diff( get_post_modified_time( 'U' ), current_time( 'timestamp' ) ) );
        
    }
    
    ?>

<span class="live-indicator">
    
    <span class="live-circle"></span>
    
    <span class="live-word"><?php echo fox_word( 'live' ); ?></span>
    
    <span class="live-updated">
    
        <time class="published" itemprop="dateModified" datetime="<?php echo get_the_modified_date( DATE_W3C ); ?>">
            
            <?php echo $time ;?>
    
        </time>
        
    </span>

</span>
      
    <?php
    
}

/**
 * Permalink
 * to support AMP
 * @since 4.8
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_permalink' ) ) :
function fox_permalink() {
    
    if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() && function_exists( 'amp_loop_permalink' ) ) {
        $permalink = amp_loop_permalink();
    } else {
        $permalink = get_permalink();
    }
    
    return $permalink;
    
}
endif;

/**
 * Title
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_post_title' ) ) :
function fox_post_title( $params ) {
    
    if ( is_string( $params ) ) $params = [ 'extra_class' => $params ];
    
    extract( wp_parse_args( $params, [
        'title_html' => '',
        
        'title_extra_class' => '', 
        'title_tag' => 'h2', 
        'title_size' => '',
        'title_weight' => '',
        'title_color' => '',
        'title_text_transform' => '',
        'title_link' => true,
    ] ) );
    
    // custom title html
    if ( $title_html ) {
        echo $title_html;
        return;
    }
    
    $title_attrs = [ 'itemprop="headline"' ];
    
    /**
     * class
     */
    $class = [ 'post-item-title', 'wi-post-title', 'fox-post-title', 'post-header-section' ];
    if ( $title_extra_class ) {
        $class[] = $title_extra_class;
    }
    
    /**
     * size
     */
    if ( ! in_array( $title_size, [ 'extra', 'large', 'medium', 'small', 'tiny', 'supertiny' ] ) ) $title_size = 'normal';
    $class[] = 'size-' . $title_size;
    
    /**
     * weight
     */
    if ( $title_weight == 300 || $title_weight == 400 || $title_weight == 700 || $title_weight == 900 ) {
        $class[] = 'weight-' . $title_weight;
    }
    
    /**
     * text transform
     */
    if ( $title_text_transform == 'none' || $title_text_transform == 'uppercase' || $title_text_transform == 'lowercase' || $title_text_transform == 'capitalize' ) {
        $class[] = 'text-transform-' . $title_text_transform;
    }
    
    /**
     * tag
     */
    if ( 'h1' != $title_tag && 'h3' != $title_tag && 'h4' != $title_tag ) $title_tag = 'h2';
    
    /**
     * color
     */
    if ( $title_color ) {
        $class[] = 'custom-color';
        $title_attrs[] = 'style="color:' . esc_attr( $title_color ). '"';
    }
    
    /**
     * since 4.7.3
     */
    $target_attr = '';
    if ( 'link' == get_post_format() ) {
        
        $target = get_post_meta( get_the_ID(), '_format_link_target', true );
        if ( ! $target ) {
            $target = get_theme_mod( 'wi_single_format_link_target', '_self' );
        }
        
        if ( '_blank' == $target ) {
            $target_attr = ' target="' . esc_attr( $target ) . '"';
        }
        
    }
    ?>

<?php echo '<' . $title_tag . ' class="' . esc_attr( join( ' ', $class ) ) . '" ' . join( ' ', $title_attrs ) . '>'; ?>

    <?php if ( $title_link ) { ?><a href="<?php echo fox_permalink();?>" rel="bookmark"<?php echo $target_attr; ?>><?php } ?>
        
        <?php the_title();?>

    <?php if ( $title_link ) { ?></a><?php } ?>

<?php 
    // since Fox v5.3
    do_action( 'fox_after_title_link' ); ?>

<?php echo '</' . $title_tag . '>';
    
}
endif;

/**
 * Excerpt
 * ------------------------------------------------------------------ */
function fox_post_excerpt( $params = [] ) {
    
    extract( wp_parse_args( $params, [
        'excerpt_length' => 22,
        'excerpt_size' => '',
        'excerpt_color' => '',
        'excerpt_extra_class' => '',
        'excerpt_exclude_class' => [],
        'excerpt_base' => '',
        'excerpt_more' => false,
        'excerpt_more_style' => 'simple',
        'excerpt_more_text' => '', // custom text
    ] ) );
    
    $class = [
        'post-item-excerpt',
        'entry-excerpt',
    ];
    
    /**
     * size
     */
    if ( 'small' != $excerpt_size && 'medium' != $excerpt_size ) $excerpt_size = 'normal';
    $class[] = 'excerpt-size-' . $excerpt_size;
    
    /**
     * color
     */
    $excerpt_css = [];
    $excerpt_color = trim( $excerpt_color );
    if ( $excerpt_color ) {
        $class[] = 'custom-color';
        $excerpt_css[] = 'color:' . $excerpt_color;
    }
    
    /**
     * extra class
     */
    if ( ! empty( $excerpt_extra_class ) ) {
        
        if ( is_string( $excerpt_extra_class ) ) $excerpt_extra_class = [ $excerpt_extra_class ];
        $class = array_merge( $class, $excerpt_extra_class );
        
    }
    
    /**
     * exclude class
     */
    if ( ! empty( $excerpt_exclude_class ) && is_array( $excerpt_exclude_class ) ) {
        $class = array_diff( $class, $excerpt_exclude_class );
    }
    
    /**
     * base
     */
    if ( ! $excerpt_base ) {
        $excerpt_base = get_theme_mod( 'wi_sentence_base', 'word' );
    }
    if ( 'char' != $excerpt_base ) $excerpt_base = 'word';
    
    /**
     * finall css
     */
    $excerpt_css = join( ';', $excerpt_css );
    if ( ! empty( $excerpt_css ) ) {
        $excerpt_css = ' style="' . esc_attr( $excerpt_css ) . '"';
    }
    
    /**
     * since 4.7.3
     */
    $target_attr = '';
    if ( 'link' == get_post_format() ) {
        
        $target = get_post_meta( get_the_ID(), '_format_link_target', true );
        if ( ! $target ) {
            $target = get_theme_mod( 'wi_single_format_link_target', '_self' );
        }
        
        if ( '_blank' == $target ) {
            $target_attr = ' target="' . esc_attr( $target ) . '"';
        }
        
    }
    
    ?>
<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>" itemprop="text"<?php echo $excerpt_css; ?>>
    
    <?php
    if ( 'true' == get_theme_mod( 'wi_display_excerpt_html', 'false' ) ) {
        the_excerpt();
    } else {
        $excerpt = strip_tags( get_the_excerpt() );
        if ( $excerpt_length >= 0 ) {
            $excerpt = fox_substr( $excerpt, 0, $excerpt_length, $excerpt_base );
        }

        if ( 'true' == get_theme_mod( 'wi_excerpt_hellip', 'false' ) ) {
            $excerpt .= '&hellip;';
        }

        echo wpautop( $excerpt );
    }
    
    if ( is_string( $excerpt_more_text ) ) {
        $excerpt_more_text = trim( $excerpt_more_text );
    }
    if ( ! $excerpt_more_text ) {
        $excerpt_more_text = fox_word( 'more' );
    }
    $more_class = [ 'readmore' ];
    
    if ( in_array( $excerpt_more_style, [ 'btn-black', 'btn', 'btn-primary', 'btn-outline' ] ) ) {
        
        $more_class[] = 'fox-btn btn-tiny'; // why tiny?
        
        if ( 'btn' == $excerpt_more_style ) {
            $more_class[] = 'btn-fill';
        } else {
            $more_class[] = $excerpt_more_style;
        }
        
    }
    
    if ( 'simple-btn' == $excerpt_more_style ) {
        $more_class[] = 'minimal-link';
    }
    
    if ( $excerpt_more ) echo '<a href="' . get_permalink() . '"' . $target_attr . ' class="' . esc_attr( join( ' ', $more_class ) ) .'">' . $excerpt_more_text . '</a>';
    ?>
    
</div>
    <?php
}

if ( ! function_exists( 'fox_post_categories' ) ) :
/**
 * Categories
 * ------------------------------------------------------------------ */
function fox_post_categories( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        'tax' => 'category', 
        'extra_class' => '',
        'style' => '',
    ] ) );
    
    $class = [
        'entry-categories',
        'meta-categories'
    ];
    if ( ! in_array( $style, [ 'plain', 'box', 'solid' ] ) ) {
        $style = 'plain';
    }
    $class[] = 'categories-' . $style;
    
    if ( $extra_class ) $class[] = $extra_class;
    
    if ( 'category' == $tax && 'post' !== get_post_type() ) return;
    
    $separate_meta = '<span class="sep">' . esc_html__( '/', 'wi' ) . '</span>';
    ?>

    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <?php echo get_the_term_list( get_the_ID(), $tax, '', $separate_meta, '' ); ?>

    </div>

    <?php
    
}
endif;

/**
 * Post Date
 * since 4.6.6 we allow site to display updated time in place of published time
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_post_date' ) ) :
function fox_post_date( $args = [] ) {
    
    // since 4.3
    if ( fox_is_live() ) {
        return;
    }
    
    extract( wp_parse_args( $args, [
        'time_style' => '',
        'fashion' => 'long', // only for standard time style
        'format' => '',
    ] ) );
    
    if ( ! $time_style ) $time_style = get_theme_mod( 'wi_time_style', 'standard' );
    
    // since 4.6.6
    $display_update_time = get_theme_mod( 'wi_publish_update', 'publish' );
    
    $prefix = '';
    if ( 'updated_recently' == $display_update_time ) {
        $diff = get_the_modified_time( 'U' ) - get_the_time( 'U' );
        // echo ( $diff / 1000 ) / DAY_IN_SECONDS . '<br>';
        if ( $diff >= DAY_IN_SECONDS ) {
            $prefix = esc_html__( 'Updated', 'wi' );
        } else {
            $prefix = '';
        }
    }
    
    if ( 'human' === $time_style ) :
    
        echo '<div class="entry-date meta-time human-time">';
    
        if ( 'update' == $display_update_time ) {
            
            $posttime = get_the_modified_time( 'U' );
            
        } else if ( 'updated_recently' == $display_update_time ) {
            
            if ( $prefix ) {
                
                $posttime = get_the_modified_time( 'U' );
                
            } else {
                
                $posttime = get_the_time( 'U' );
                
            }
            
        } else {
            
            $posttime = get_the_time( 'U' );
            
        }
    
        echo $prefix . ' ';
    
        printf( fox_word( 'ago' ), human_time_diff( $posttime, current_time( 'timestamp' ) ) );
    
        echo '</div>';
    
    else :
    
        if ( 'update' == $display_update_time ) {
            
            $time_string = '<time class="published updated" itemprop="dateModified" datetime="%1$s">%2$s</time>';
            $time_string = sprintf( $time_string,
                get_the_modified_date( DATE_W3C ),
                get_the_modified_date( $format )
            );
            
        } else if ( 'updated_recently' == $display_update_time ) {
            
            if ( $prefix ) {
                
                $time_string = '<time class="published updated" itemprop="dateModified" datetime="%1$s">%2$s</time>';
                $time_string = $prefix . ' ' . sprintf( $time_string,
                    get_the_modified_date( DATE_W3C ),
                    get_the_modified_date( $format )
                );
                
            } else {
                
                $time_string = '<time class="published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
                $time_string = sprintf( $time_string,
                    get_the_date( DATE_W3C ),
                    get_the_date( $format ),
                    get_the_modified_date( DATE_W3C ),
                    get_the_modified_date( $format )
                );
                
            }
            
        } else {
            
            $time_string = '<time class="published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
            
            /*
            if ( get_the_modified_time( 'U' ) - get_the_time( 'U' ) > DAY_IN_SECONDS  ) {
                $time_string = '<time class="published" itemprop="datePublished" datetime="%1$s">%2$s</time><time class="updated" itemprop="dateModified" datetime="%3$s">%4$s</time>';
            }
            */

            $time_string = sprintf( $time_string,
                get_the_date( DATE_W3C ),
                get_the_date( $format ),
                get_the_modified_date( DATE_W3C ),
                get_the_modified_date( $format )
            );
            
        }
    
    if ( 'short' != $fashion ) $fashion = 'long'; 

        // Wrap the time string in a link, and preface it with 'Posted on'.
        echo '<div class="entry-date meta-time machine-time time-' . esc_attr( $fashion ) . '">';
    
        if ( 'short' == $fashion ) {
            
            echo $time_string;

        } else {
            printf(
                /* translators: %s: post date */
                wp_kses( '<span class="published-label">' . fox_word( 'date' ) . '</span> %s', fox_allowed_html() ),
                $time_string
            );

        }
    
        echo '</div>';
    
    endif;
    
}
endif;

if ( ! function_exists( 'fox_post_author' ) ) :
/**
 * Author
 * ------------------------------------------------------------------ */
function fox_post_author( $show_avatar = false ) {
    
    // global $post;
	// $author_id = $post->post_author;
    
    // Finally, let's write all of this to the page.
	echo '<div class="fox-meta-author entry-author meta-author" itemprop="author" itemscope itemtype="https://schema.org/Person">';
    
    if ( function_exists( 'get_coauthors' ) ) {
        $authors = get_coauthors();
    } else {
        global $post;
        $author_id = $post->post_author;
        $authors = [ get_userdata( $author_id ) ];
    }
        
    $count = 0;
    foreach ( $authors as $user ) {
        
        $author_id = $user->ID;
        $count++;
        
        $link = get_author_posts_url( $user->ID, $user->user_nicename );
        
        // echo '<span class="byline"> ' . sprintf( fox_word( 'author' ), fox_coauthors_posts_links() ) . '</span>';
        // return;
        
        // echo '<span class="meta-author-item">';
    
        if ( $show_avatar ) {
            echo '<a class="meta-author-avatar" itemprop="url" rel="author" href="' . esc_url( $link ) . '">';
            echo get_avatar( $author_id, 80 );
            echo '</a>';
        }
        
        $by = 1 == $count ? fox_word( 'author' ) : '%s';

        echo '<span class="byline"> ' . sprintf(
            /* translators: %s: post author */
            $by,
            '<a class="url fn" itemprop="url" rel="author" href="' . esc_url( $link ) . '">' . $user->display_name . '</a>'
        ) . '</span>';
        
        // echo '</span><!-- .meta-author-item -->';
        
    }
    
    echo '</div>';
    
}
endif;

/**
 * Co-Authors
 * @since 4.6.2
 * ------------------------------------------------------------------ */
/**
 * Outputs the co-authors display names, without links to their posts.
 * Co-Authors Plus equivalent of the_author() template tag.
 *
 * @param string $between Delimiter that should appear between the co-authors
 * @param string $betweenLast Delimiter that should appear between the last two co-authors
 * @param string $before What should appear before the presentation of co-authors
 * @param string $after What should appear after the presentation of co-authors
 * @param bool $echo Whether the co-authors should be echoed or returned. Defaults to true.
 */
function fox_coauthors( $between = null, $betweenLast = null, $before = null, $after = null, $echo = true ){
    return coauthors__echo('display_name', 'field', array(
        'between' => $between,
        'betweenLast' => $betweenLast,
        'before' => $before,
        'after' => $after
    ), null, $echo );
}
 
/**
 * Outputs the co-authors display names, with links to their posts.
 * Co-Authors Plus equivalent of the_author_posts_link() template tag.
 *
 * @param string $between Delimiter that should appear between the co-authors
 * @param string $betweenLast Delimiter that should appear between the last two co-authors
 * @param string $before What should appear before the presentation of co-authors
 * @param string $after What should appear after the presentation of co-authors
 * @param bool $echo Whether the co-authors should be echoed or returned. Defaults to true.
 */
function fox_coauthors_posts_links( $between = null, $betweenLast = null, $before = null, $after = null, $echo = false ){
    return coauthors__echo('coauthors_posts_links_single', 'callback', array(
        'between' => $between,
        'betweenLast' => $betweenLast,
        'before' => $before,
        'after' => $after
    ), null, $echo );
}
 
/**
 * Outputs the co-authors display names, with links to their websites if they've provided them.
 *
 * @param string $between Delimiter that should appear between the co-authors
 * @param string $betweenLast Delimiter that should appear between the last two co-authors
 * @param string $before What should appear before the presentation of co-authors
 * @param string $after What should appear after the presentation of co-authors
 * @param bool $echo Whether the co-authors should be echoed or returned. Defaults to true.
 */
function fox_coauthors_links($between = null, $betweenLast = null, $before = null, $after = null, $echo = true ) {
    return coauthors__echo('coauthors_links_single', 'callback', array(
        'between' => $between,
        'betweenLast' => $betweenLast,
        'before' => $before,
        'after' => $after
    ), null, $echo );
}

/**
 * View
 * ------------------------------------------------------------------ */
function fox_get_view( $post_id = null ) {
    
    if ( ! function_exists( 'pvc_get_post_views' ) ) return null;
    
    if ( ! $post_id ) {
        global $post;
        $post_id =  $post->ID;
    }
    
    return pvc_get_post_views( $post_id );
    
}

function fox_post_view() {
    
    $count = fox_get_view();
    if ( is_null( $count ) ) return;
    
    echo '<div class="fox-view-count wi-view-count entry-view-count" title="' . sprintf( fox_word( 'views' ), $count ) . '"><span>' . sprintf( fox_word( 'views' ), fox_number( $count ) ) . '</span></div>';
    
}

/**
 * Comment Link
 * ------------------------------------------------------------------ */
function fox_comment_link() {
    
    $icon = 'fa fa-comment-alt';
    // $icon = 'feather-message-square';
    
    comments_popup_link( 
        '<span class="comment-icon"><i class="' . $icon . '"></i></span>',
        
        '<span class="comment-num">1</span> <span class="comment-icon"><i class="' . $icon . '"></i></span>', 
        '<span class="comment-num">%</span> <span class="comment-icon"><i class="' . $icon . '"></i></span>', 
        'comment-link',
        
        '<span class="comment-icon off"><i class="' . $icon . '"></i></span>'
    );
    
}

if ( ! function_exists( 'fox_reading_time' ) ) :
/**
 * Reading Time
 * ------------------------------------------------------------------ */
function fox_reading_time() {
    
    global $post;
    
    $reading_speed = get_theme_mod( 'wi_reading_speed', 250 );
    $reading_speed = apply_filters( 'fox_reading_speed', $reading_speed );
    $reading_speed = absint( $reading_speed );
    if ( $reading_speed > 10000 || $reading_speed < 1 ) {
        $reading_speed = 250;
    }
    
    $words = str_word_count( strip_tags( $post->post_content ), 0, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя' );
    $mins = floor( $words / $reading_speed );

    if ( 1 < $mins ) {
        $estimated_time = sprintf( fox_word( 'mins_read' ), $mins );
    } else {
        $estimated_time = fox_word( 'min_read' );
    }

    echo '<div class="reading-time">' . $estimated_time . '</div>';
    
}
endif;

if ( ! function_exists( 'fox_post_meta' ) ) :
/**
 * Post meta
 * ------------------------------------------------------------------ */
function fox_post_meta( $params = [] ) {
    
    /**
     * in previous versions, we use show_category
     */
    $field_adapter = [
        'category_show' => 'show_category',
        'author_show' => 'show_author',
        'author_avatar_show' => 'show_author_avatar',
        'date_show' => 'show_date',
        'view_show' => 'show_view',
        'comment_link_show' => 'show_comment_link',
        'reading_time_show' => 'show_reading_time',
    ];
    foreach ( $field_adapter as $k => $v ) {
        if ( isset( $params[ $k ] ) ) {
            $params[ $v ] = $params[ $k ];
        }
    }
    
    extract( wp_parse_args( $params, [
            
        'show_category' => true,
        'show_date' => true,
        
        'show_author' => false,
        'show_author_avatar' => false,
        'show_view' => false,
        'show_comment_link' => false,
        'show_reading_time' => false,
        
        'meta_extra_class' => '',
        'meta_exclude_class' => [],
        'date_fashion' => 'short',
        
    ] ) );
    
    if ( ! $show_category && ! $show_date && ! $show_author && ! $show_author_avatar && ! $show_view && ! $show_comment_link && ! $show_reading_time ) return;
    
    $class = [
        'post-item-meta',
        'wi-meta',
        'fox-meta',
        'post-header-section'
    ];
    
    if ( is_array( $meta_extra_class ) ) $class = array_merge( $class, $meta_extra_class );
    elseif ( is_string( $meta_extra_class ) ) $class[] = $meta_extra_class;
    
    if ( is_array( $meta_exclude_class ) && ! empty( $meta_exclude_class ) ) {
        $class = array_diff( $class, $meta_exclude_class );
    }
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <?php if ( $show_author ) fox_post_author( $show_author_avatar ); ?>
    <?php if ( $show_date ) fox_post_date([ 'fashion' => $date_fashion ]); ?>
    <?php if ( $show_category ) fox_post_categories(); ?>
    <?php if ( $show_view ) { fox_post_view(); } ?>
    <?php if ( $show_reading_time ) fox_reading_time(); ?>
    <?php if ( $show_comment_link ) fox_comment_link(); ?>
    
</div>

<?php
    
}
endif;

/**
 * Post Body
 * ie. title, categories, meta, excerpt, more btn
 * ------------------------------------------------------------------ */
function fox_post_body( $params ) {
    
    $is_live = fox_is_live();
    
    $header_class = [
        'post-item-header',
    ];
    
    /**
     * item template
     */
    $item_template = absint( $params[ 'item_template' ] );
    if ( $item_template < 1 || $item_template > 5 ) $item_template = 1;
    
    /**
     * LIVE
     * @since 4.3
     */
    $live_html = '';
    if ( isset( $params[ 'live' ] ) && $params[ 'live' ] ) {
        ob_start();
        fox_live_indicator();
        $live_html = ob_get_clean();
    }
    
    /**
     * title html
     */
    $title_html = '';
    
    if ( $params[ 'title_show' ] ) {
            
        ob_start();

        fox_post_title( $params );

        $title_html = ob_get_clean();
        
    }
    
    /**
     * excerpt html
     */
    $excerpt_html = '';
    
    if ( $params[ 'excerpt_show' ] ) {
        
        $excerpt_html = isset( $params[ 'excerpt_html' ] ) ? $params[ 'excerpt_html' ] : '';
        
        if ( ! $excerpt_html ) {
            
            ob_start();

            fox_post_excerpt( $params );

            $excerpt_html = ob_get_clean();
            
        }
        
    }
    
    /**
     * meta html
     */
    if ( 4 == $item_template || 5 == $item_template ) {
        
        ob_start();
        
        $params_copy = $params;
        $params_copy[ 'category_show' ] = false;
        
        fox_post_meta( $params_copy );
        
        $meta_html = ob_get_clean();
        
        $cat_html = '';
        
        if ( $params[ 'category_show' ] ) {
            
            ob_start();
            
            fox_post_categories([ 
                'extra_class' => 'standalone-categories post-header-section',
                'style' => get_theme_mod( 'wi_standalone_category_style', 'plain' ),
            ]);
            
            $cat_html = ob_get_clean();
            
        }
        
    } else {
        
        ob_start();
        $meta_html = fox_post_meta( $params );
        $meta_html = ob_get_clean();
        
    }
    
    /**
     * CASES
     */
    
    switch( $item_template ) {
            
        // title > meta > excerpt
        case 1 :
            
            echo '<div class="' . esc_attr( join( ' ', $header_class ) ) . '">';
            echo $live_html . $title_html . $meta_html;
            echo '</div>';

            echo  $excerpt_html;
            
            break;
            
        // meta > title > excerpt
        case 2 :
            
            echo '<div class="' . esc_attr( join( ' ', $header_class ) ) . '">';
            echo $meta_html . $title_html . $live_html;
            echo '</div>';

            echo  $excerpt_html;
            
            break;
            
        // title > excerpt > meta    
        case 3:
            
            echo '<div class="' . esc_attr( join( ' ', $header_class ) ) . '">';
            echo $live_html . $title_html;
            echo '</div>';

            echo  $excerpt_html . $meta_html;
            
            break;
        
        // cateogry > title > meta > excerpt
        case 4 :
            
            echo '<div class="' . esc_attr( join( ' ', $header_class ) ) . '">';
            echo $cat_html . $live_html . $title_html . $meta_html;
            echo '</div>';

            echo $excerpt_html;
            
            break;
          
        // cateogry > title > excerpt > meta
        case 5 :
            
            echo '<div class="' . esc_attr( join( ' ', $header_class ) ) . '">';
            echo $cat_html . $live_html . $title_html;
            echo '</div>';

            echo $excerpt_html . $meta_html;
            
            break;
            
        default :
            break;
            
    }
    
}

/**
 * Blog Related Posts
 * $layout can be 'standard' or 'newspaper'
 * @since 4.0
 * ------------------------------------------------------------------ */
function fox_blog_related( $layout = 'standard', $override_args = [] ) {
    
    $query_args = [
        'number' => get_theme_mod( 'wi_single_related_number', 3 ),
        'orderby' => get_theme_mod( 'wi_single_related_orderby', 'date' ),
        'order' => get_theme_mod( 'wi_single_related_order', 'desc' ),
        'source' => get_theme_mod( 'wi_single_related_source', 'tag' ),
    ];
    
    $query_args = wp_parse_args( $override_args, $query_args );
    
    $related_query = fox_related_query( $query_args );
    
    if ( ! $related_query || ! $related_query->have_posts() ) {
        wp_reset_query();
        return;
    }
    
    $prefix = 'blog';
    
    if ( 'newspaper' == $layout ) $prefix = 'newspaper';
    
    if ( $related_query->have_posts() ) {
        
        ?>
        <div class="related-area">

            <h3 class="<?php echo $prefix; ?>-related-heading single-heading">
                <span><?php echo fox_word( 'related' ); ?></span>
            </h3>

            <div class="<?php echo $prefix; ?>-related">
                
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>

                    <?php
                    if ( 'newspaper' == $layout ) {
                        get_template_part( 'content/post', 'related-newspaper' );
                    } else {
                        get_template_part( 'content/post', 'related' );
                    } ?>

                <?php endwhile; ?>

                <div class="clearfix"></div>

                <div class="line line1"></div>
                <div class="line line2"></div>

            </div><!-- .<?php echo $prefix; ?>-related -->

        </div><!-- .related-area -->

        <?php	

    }
    
    wp_reset_query();
    
}

/**
 * Social Icons list template
 * @since 4.0
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_social_icons' ) ) :
function fox_social_icons( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        
        'style' => '',
        'shape' => '',
        'align' => '',
        'size'  => '',
        'spacing' => '',
        'extra_class' => '',
        'text' => 'none',
        
        'border_width' => '',
        
        'color' => '',
        'background_color' => '',
        'border_color' => '',
        
        'hover_color' => '',
        'hover_background_color' => '',
        'hover_border_color' => '',
        
    ] ) );
    
    $class = [
        'social-list',
    ];
    
    if ( ! empty( $extra_class ) ) $class[] = $extra_class;
    
    if ( ! in_array( $style, [ 'black', 'outline', 'fill', 'color', 'text_color', 'plain' ] ) ) $style = 'black';
    if ( ! in_array( $shape, [ 'square', 'round', 'circle' ] ) ) $shape = 'circle';
    if ( ! in_array( $align, [ 'left', 'center', 'right' ] ) ) $align = 'center';
    if ( ! in_array( $size, [ 'small', 'normal', 'bigger', 'medium', 'medium_plus' ] ) ) $size = 'normal';
    if ( ! in_array( $spacing, [ 'small', 'normal', 'big' ] ) ) $spacing = 'small';
    if ( ! in_array( $text, [ 'text-1', 'text-2' ] ) ) $text = 'none';

    $class[] = 'style-' . $style; if ( 'text_color' == $style ) $class[] = 'style-plain';
    $class[] = 'shape-' . $shape;
    $class[] = 'align-' . $align;
    $class[] = 'icon-size-' . $size;
    $class[] = 'icon-spacing-' . $spacing;
    $class[] = 'style-' . $text;
    
    $social = get_theme_mod( 'wi_social' );
    
    try {
        $social = json_decode( $social, true );
    } catch ( Exception $err ) {
        $social = [];
    }
    
    /**
     * custom icons
     * since 5.3.1
     */
    $custom_icon_1 = trim( get_theme_mod( 'wi_social_custom_1' ) );
    $custom_icon_1_url = trim( get_theme_mod( 'wi_social_custom_1_url' ) );
    if ( $custom_icon_1 && $custom_icon_1_url ) {
        $social[ $custom_icon_1 ] = $custom_icon_1_url;
    }
    $custom_icon_2 = trim( get_theme_mod( 'wi_social_custom_2' ) );
    $custom_icon_2_url = trim( get_theme_mod( 'wi_social_custom_2_url' ) );
    if ( $custom_icon_2 && $custom_icon_2_url ) {
        $social[ $custom_icon_2 ] = $custom_icon_2_url;
    }
        
    if ( ! $social ) return;    
    
    $css = [];
    $id = uniqid( 'social-id-' );
    
    /**
     * CSS
     */
    if ( '' != $border_width ) {
        if ( is_numeric( $border_width ) ) $border_width .= 'px';
        $css[] = 'border-width:' . $border_width;
    }
    if ( $color ) {
        $css[] = 'color:' . $color;
    }
    if ( $background_color ) {
        $css[] = 'background:' . $background_color;
    }
    if ( $border_color ) {
        $css[] = 'border-color:' . $border_color;
    }
    
    // CUSTOM COLOR
    $hover_css = [];
    if ( $hover_color ) {
        $hover_css[] = 'color:' . $hover_color;
    }
    if ( $hover_background_color ) {
        $hover_css[] = 'background:' . $hover_background_color;
    }
    if ( $hover_border_color ) {
        $hover_css[] = 'border-color:' . $hover_border_color;
    }
    
    $css_style = [];
    if ( $css ) $css_style[] = '#' . $id . ' a{' . join( ';', $css ). '}';
    if ( $hover_css ) $css_style[] = '#' . $id . ' a:hover{' . join( ';', $hover_css ) . '}';
    
    /**
     * social array
     */
    $social_square = [
        'facebook' => 'facebook-square',
        'twitter' => 'twitter-square',
        'pinterest' => 'pinterest-square',
        'instagram' => 'instagram',
        'linkedin' => 'linkedin',
        'reddit' => 'reddit-square',
        'snapchat' => 'snapchat-square',
        'medium' => 'medium',
        'whatsapp' => 'whatsapp-square',
    ];
    
    $social_light = [
        'facebook' => 'facebook-f',
        'twitter' => 'twitter',
        'pinterest' => 'pinterest-p',
        'instagram' => 'instagram',
        'linkedin' => 'linkedin-in',
        'reddit' => 'reddit',
        'snapchat' => 'snapchat-ghost',
        'medium' => 'medium-m',
        'whatsapp' => 'whatsapp',
    ];
    
    $social_shape = get_theme_mod( 'wi_social_icon_shape', 'light' );
    if ( 'light' == $social_shape ) {
        $social_alter_arr = $social_light;
    } else {
        $social_alter_arr = $social_square;
    }
    
    $social_arr = fox_social_data();
    $social_arr[ 'home' ] = [
        'icon' => 'home',
        'title' => 'Home',
    ];
    $social_arr[ 'email' ] = [
        'icon' => 'envelope',
        'title' => 'Email',
    ];
    
    /**
     * custom icon
     */
    if ( $custom_icon_1 && $custom_icon_1_url ) {
        $social_arr[ $custom_icon_1 ] = [
            'icon' => $custom_icon_1,
            'title' => get_theme_mod( 'wi_social_custom_1_name' ),
        ];
    }
    
    if ( $custom_icon_2 && $custom_icon_2_url ) {
        $social_arr[ $custom_icon_2 ] = [
            'icon' => $custom_icon_2,
            'title' => get_theme_mod( 'wi_social_custom_2_name' ),
        ];
    }
     
    ?>

<?php if ( $css_style ) {
        echo '<style type="text/css">';
        echo join( '', $css_style );
        echo '</style>';
    } ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>" id="<?php echo esc_attr( $id ); ?>">
    
    <ul>
    
        <?php foreach ( $social_arr as $k => $brand_dt ) : 
    
    $title = $brand_dt[ 'title' ];
    $ic = $brand_dt[ 'icon' ];
    
    $url = isset( $social[ $k ] ) ? $social[ $k ] : '';
    
    if ( ! $url ) continue;
        
    // helper for email
    if ( 'email' == $k && is_email( $url ) ) {
        $url = 'mailto:' . $url;
    }
    
    if ( isset( $social_alter_arr[ $k ] ) ) {
        $ic = $social_alter_arr[ $k ];
    }
    
    if ( 'email' == $k ) {
        $icon = 'feather-mail';
    } else {
        if ( false !== strpos( $ic, 'fa ' ) ) {
            $icon = $ic;
        } elseif ( 'home' == $k || 'rss-2' == $k ) {
            $icon = 'fa fa-' . $ic;
        } else {
            $icon = 'fab fa-' . $ic;
        }
    }
    
    if ( 'text_color' == $style ) {
        $li_cl = 'co-' . $k;
    } else {
        $li_cl = 'li-' . $k;
    }
        ?>
        
        <li class="<?php echo esc_attr( $li_cl ); ?>">
            <a href="<?php echo esc_attr( $url ); ?>" target="_blank" rel="noopener" title="<?php echo esc_attr( $title ); ?>">
                <i class="<?php echo esc_attr( $icon ); ?>"></i>
            </a>
            
            <?php if ( 'none' != $text ) { ?>
            <span class="scl-text font-heading">
                <a href="<?php echo esc_attr( $url ); ?>" target="_blank" rel="noopener" title="<?php echo esc_attr( $title ); ?>">
                    <?php echo esc_html( $title ); ?>
                </a>
            </span>
            <?php } ?>
        </li>
        
        <?php endforeach; ?>
    
    </ul>
    
</div><!-- .social-list -->

<?php
}
endif;