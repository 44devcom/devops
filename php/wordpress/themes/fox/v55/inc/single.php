<?php
/**
 * abstract
 * this file contains:
 * functions used for single post such as fox_get_single_option
 * template for single post such as single_thumbnail, single_tags..
 * hooks for single such as before_entry_content
 */

/*
 * Single Post Thumbnail
 * @since 4.3
 *
 * We'll markup the thumbnail depending on situation
 * possibilities are: content width, bigger than content, fullwidth
 *
 * 2 problems are: stretch an narrow content
 * .thumbnail-stretch-area is the div to stretch the thumbnail
 * inside it, thumbnail always display as 100% and we don't need to worry about inside it anymore
 *
 * ------------------------------------------------------------------ */
function fox_single_thumbnail( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        
        'thumbnail_show' => true,
        'style' => '1',
        'sidebar_state' => 'right',
        'thumbnail_stretch' => 'stretch-none',
        'content_width' => 'full',
        'image_stretch' => 'stretch-none',
        'column_layout' => 1,
        'body_layout' => 'boxed',
        'size' => 'full',
        
    ] );
    
    extract( $params );
    
    if ( ! $thumbnail_show ) {
        return;
    }
    
    $thumbnail = fox_get_advanced_thumbnail([
        'size' => $size,
    ]);
    if ( ! $thumbnail ) return;
    
    $class = [
        'thumbnail-wrapper',
        'single-big-section-thumbnail',
    ];
    
    // depending on the layout, it'll be a section or a big-section
    if ( '2' == $style || '3' == $style ) {
        $class[] = 'single-big-section';
    } elseif ( '1' == $style || '1b' == $style ) {
        $class[] = 'single-section';
    }
    
    $main_class = [
        'thumbnail-main',
    ];
    
    /**
     * check if this post allow stretch
     */
    $allow_stretch = false;
    if ( '1' == $style || '1b' == $style ) {
        if ( 'no-sidebar' == $sidebar_state ) {
            $allow_stretch = true;
        }
    } elseif ( '2' == $style || '3' == $style ) {
        $allow_stretch = true;
    }
    
    /**
     * narrow
     * we only narrow down the thumbnail size in:
     * no sidebar mode
     * style 1, 1b, 2, 3
     */
    $narrow = false;
    if ( 'narrow' == $content_width && 'no-sidebar' == $sidebar_state ) {
        
        if ( '1' == $style || '1b' == $style || '2' == $style || '3' == $style ) {
            
            $narrow = true;
            
        }
        
    }
    
    /**
     * Body layout: if boxed, then we disabllow stretch bigger
     */
    if ( 'boxed' == $body_layout && ! $narrow && 'stretch-bigger' == $thumbnail_stretch ) {
        $allow_stretch = false;
    }
    
    // if allow stretch and stretch full, then no longer narrow
    if ( $allow_stretch && ( 'stretch-full' == $thumbnail_stretch || 'stretch-container' == $thumbnail_stretch ) ) {
        $narrow = false;
    }
    
    if ( $allow_stretch ) {
    
        /**
         * bigger means bigger than 120px
         * 60px for each side
         *
         * this applies for $style 1, 1b in fullwidth mode, and $style 2, 3
         */
        if ( 'stretch-bigger' == $thumbnail_stretch ) {
        
            $class[] = 'wrapper-thumbnail-stretch-bigger';
            
        } elseif ( 'stretch-full' == $thumbnail_stretch ) {
            
            $class[] = 'wrapper-thumbnail-stretch-full';
            
        }
        
    }
    
    if ( $narrow ) {
        
        $main_class[] = 'narrow-area';
    
    }
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <div class="thumbnail-container">
        
        <div class="container">
            
            <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">
                
                <div class="thumbnail-stretch-area">

                    <?php echo $thumbnail; ?>
                    
                </div><!-- .thumbnail-stretch-area -->
                
            </div><!-- .thumbnail-main -->

        </div><!-- .container -->
        
    </div><!-- .thumbnail-container -->
    
</div><!-- .thumbnail-wrapper -->

<?php
    
}

/* 
 * Get Advanced Thumbnail
 * @since 4.0
 * ------------------------------------------------------------------ */
function fox_get_advanced_thumbnail( $args = [] ) {
    
    ob_start();
    fox_advanced_thumbnail( $args );
    return ob_get_clean();
    
}

/* 
 * Advanced Thumbnail (with caption, video, gallery etc)
 * @since 4.0
 * ------------------------------------------------------------------ */
function fox_advanced_thumbnail( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        'postid' => null,
        'extra_class' => '',
        'size' => 'full',
    ] ) );
    
    $class = [];
    if ( $extra_class ) {
        $class[] = $extra_class;
    }
    
    if ( ! $postid ) $postid = get_the_ID();
    
    $format = get_post_format( $postid );
    
    global $content_width;
    
    /**
     * Video Thumbnail
     * @since 4.0
     * ------------------------------------------------------ */
    if ( 'video' === $format ) {
        
        $class[] = 'post-thumbnail thumbnail-video';
        
        // the self-hosted video
        $video = get_post_meta( $postid, '_format_video', true );
        $video_url = '';
        $media_attempt = '';
        $caption = '';
        
        // still can't have a result
        // try to embed code
        if ( ! $video_url ) {
            
            $media_code = get_post_meta( $postid, '_format_video_embed', true );
            
            // if we have iframe, take it
            if ( stripos( $media_code,'<iframe') > -1 ) {
                
                $media_attempt = $media_code;
                
            } elseif ( substr( $media_code, 0, 1 ) == '[' ) {
                
                $media_attempt = do_shortcode( $media_code );
            
            // otherwise, it's a URL    
            } else {
                
                $url = $media_code;
                $parse = parse_url( home_url( '/' ) );
                $host = preg_replace('#^www\.(.+\.)#i', '$1', $parse['host']);
                
                // it's not a self-hosted video
                // just a backward compatibility
                if ( strpos( $url, $host ) === false ) {
                    
                    global $wp_embed;
                    $media_attempt = $wp_embed->run_shortcode( '[embed width="640" height="360"]' . $url . '[/embed]' );
                    
                } else {
                    
                    $video_url = $url;
                    
                }
            
            }
            
        }
        
        if ( $video ) {
            $video_url = wp_get_attachment_url( $video );
        }
        
        // atempt when we have self-hosted URL
        if ( $video_url ) {
            
            $height = $content_width * 9 / 16;
                
            $args = [
                'src' => $video_url,
                'loop' => 'on',
                'autoplay' => true,
                'width' => $content_width,
                'height' => $height,
            ];

            if ( has_post_thumbnail( $postid ) ) {
                $args[ 'poster' ] = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
            }

            $media_attempt = wp_video_shortcode( $args );
            
            // try to get video ID from its URL
            if ( ! $video ) $video = attachment_url_to_postid( $video_url );
            if ( $video ) {
                $get_caption = wp_get_attachment_caption( $video );
                if ( $get_caption ) {
                    
                    $caption .= '<figcaption class="post-thumbnail-caption video-caption">';
                    $caption .= wp_kses( $get_caption, fox_allowed_html() );
                    $caption .= '</figcaption>';
                    
                }
            }
            
        }
        
        if ( $media_attempt ) {
        
            echo '<figure class="' . esc_attr( join( ' ', $class ) ) . '"><div class="media-container">' . $media_attempt . $caption . '</div></figure>';
        
        } else {
        
            echo '<div class="fox-error">Please go to your post editor > Post Settings > Post Formats tab below your editor to enter video URL.</div>';    
        
        }
        
    /**
     * Audio Thumbnail
     * @since 4.0
     * ------------------------------------------------------ */
    } elseif ( 'audio' === $format ) {
        
        $class[] = 'post-thumbnail thumbnail-audio';
        
        // the self-hosted audio
        $audio = get_post_meta( $postid, '_format_audio', true );
        $audio_url = '';
        $media_attempt = '';
        $cover_img = '';
        $caption = '';
        
        // still can't have a result
        // try to embed code
        if ( ! $audio_url ) {
            
            $media_code = get_post_meta( $postid, '_format_audio_embed', true );
            
            // if we have iframe, take it
            if ( stripos( $media_code,'<iframe') > -1 ) {
                
                $media_attempt = $media_code;
                
            } elseif ( substr( $media_code, 0, 1 ) == '[' ) {
                
                $media_attempt = do_shortcode( $media_code );
            
            // otherwise, it's a URL    
            } else {
                
                $url = $media_code;
                $parse = parse_url( home_url( '/' ) );
                if ( ! is_string( $parse['host'] ) ) {
                    $parse['host'] = '';
                }
                $host = preg_replace('#^www\.(.+\.)#i', '$1', $parse['host']);
                
                // it's not a self-hosted audio
                // just a backward compatibility
                if ( strpos( $url, $host ) === false ) {
                    
                    global $wp_embed;
                    $media_attempt = $wp_embed->run_shortcode( '[embed]' . $url . '[/embed]' );
                    
                } else {
                    
                    $audio_url = $url;
                    
                }
            
            }
            
        }
        
        if ( $audio ) {
            
            $audio_url = wp_get_attachment_url( $audio );
            
        }
        
        // atempt when we have self-hosted URL
        if ( $audio_url ) {
            
            $args = [
                'src' => $audio_url,
                'loop' => 'on',
                'autoplay' => true,
            ];
            
            if ( has_post_thumbnail( $postid ) ) {
                $figclass = [
                    'wi-self-hosted-audio-poster self-hosted-audio-poster'
                ];
                $cover_img = '<div class="' . esc_attr( join( ' ', $figclass ) ) . '">' . wp_get_attachment_image( get_post_thumbnail_id( $postid ), 'full' ). '</div>';
            }

            $media_attempt = wp_audio_shortcode( $args );
            
            // try to get audio ID from its URL
            if ( ! $audio ) $audio = attachment_url_to_postid( $audio_url );
            if ( $audio ) {
                $get_caption = wp_get_attachment_caption( $audio );
                if ( $get_caption ) {
                    
                    $caption .= '<figcaption class="post-thumbnail-caption audio-caption">';
                    $caption .= wp_kses( $get_caption, fox_allowed_html() );
                    $caption .= '</figcaption>';
                    
                }
            }
            
        }
        
        if ( $media_attempt ) {
        
            echo '<div class="' . esc_attr( join( ' ', $class ) ) . '"><div class="media-container">' . $cover_img . $media_attempt . $caption . '</div></div>';
        
        } else {
        
            echo '<div class="fox-error">Please go to your post editor > Post Settings > Post Formats tab below your editor to enter audio URL.</div>';    
        
        }
        
    /**
     * Gallery Thumbnail
     * @since 4.0
     * ------------------------------------------------------ */    
    } elseif ( 'gallery' === $format ) {
        
        /**
         * get image
         */
        $images = get_post_meta( $postid , '_format_gallery_images', true );
        if ( empty( $images ) ) return;
        if ( ! is_array( $images ) ) {
            $images = explode( ',', $images );
            $images = array_map( 'trim', $images );
        }
        
        /**
         * get style
         */
        $args = [
            'images' => $images,
            'lightbox' => ( 'true' == fox_get_single_option( 'format_gallery_lightbox' ) )
        ];
        
        $class[] = 'post-thumbnail';
        
        $style = fox_get_single_option( 'format_gallery_style' );
        
        $args[ 'style' ] = $style;
        
        if ( 'slider' == $style ) {
            
            $args[ 'mode' ] = 'img';
            
            $args[ 'effect' ] = fox_get_single_option( 'format_gallery_slider_effect' );
            $size = fox_get_single_option( 'format_gallery_slider_size' );
            
            // cropped 2:1
            if ( 'original' != $size ) {
                
                $args[ 'thumbnail' ] = 'custom';
                $args[ 'thumbnail_custom' ] = '2000x1000';
                
            } else {
                
                $args[ 'thumbnail' ] = 'original';
                
            }
            
            $args[ 'extra_class' ] = join( ' ', $class );
            
        } elseif ( 'stack' == $style ) {
            
            $args[ 'mode' ] = 'img';
            
            $args[ 'extra_class' ] = join( ' ', $class );
        
        } elseif ( 'carousel' == $style ) {
            
            $args[ 'size' ] = 'large';
            $args[ 'mode' ] = 'img';
            
            $args[ 'extra_class' ] = join( ' ', $class );
        
        } elseif ( 'slider-rich' == $style ) {
            
            $args[ 'size' ] = 'large';
            $args[ 'mode' ] = 'img';
            
            $args[ 'extra_class' ] = join( ' ', $class );
        
        } elseif ( 'grid' == $style ) {
            
            $args[ 'column' ] = fox_get_single_option( 'format_gallery_grid_column' );
            $args[ 'extra_outer_class' ] = join( ' ', $class );
        
        } elseif ( 'masonry' == $style ) {
            
            $column = fox_get_single_option( 'format_gallery_grid_column' );
            $args[ 'column' ] = $column;
            
            $args[ 'extra_outer_class' ] = join( ' ', $class );
        
        } elseif ( 'metro' == $style ) {
            
            $args[ 'extra_outer_class' ] = join( ' ', $class );
            
        }
        
        fox_gallery( $args );
    
    /**
     * Standard Thumbnail
     * @since 4.0
     * ------------------------------------------------------ */    
    } else {
        
        $class[] = 'post-thumbnail post-thumbnail-standard';
        $id = get_post_thumbnail_id( $postid );
        if ( ! $id ) return;
        
        $imagedata = [
            'id' => $id,
        ];
        
        fox_image([
            'id' => $id,
            'link' => is_singular() ? '' : 'single',
            'postid' => $postid,
            'figure_class' => join( ' ', $class ),
            'thumbnail' => $size,
        ]);

    }
    
}

if ( ! function_exists( 'fox_breadcrumbs' ) ) :
/**
 * RETURN str
 * @since 4.7.1.2
 */
function fox_breadcrumbs() {
    
    if ( function_exists('yoast_breadcrumb') ) {
        return yoast_breadcrumb( '<p class="breadcrumbs">','</p>', false );
    }
    
    return '';
    
}
endif;

/* 
 * Header
 * @since 4.0
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_single_header' ) ) :
function fox_single_header( $params ) {
    
    $params = wp_parse_args( $params, [
        
        'style' => '1',
        'sidebar_state' => 'right',
        'thumbnail_stretch' => 'stretch-none',
        'content_width' => 'full',
        'image_stretch' => 'stretch-none',
        'column_layout' => 1,

        'header_align' => 'center',
        'header_item_template' => '1',
        
        'subtitle_position' => 'after_title',
        
    ] );
    
    extract( $params );
    
    if ( ! $post_header_show ) {
        return;
    }
    
    // legacy
    $class = [
        'single-header',
        'post-header',
        'entry-header',
    ];
    
    // depending on the layout, it'll be a section or a big-section
    if ( '2' == $style ) {
        $class[] = 'single-big-section';
    } elseif ( '1' == $style || '1b' == $style || '3' == $style ) {
        $class[] = 'single-section';
    }
    
    $main_class = [
        'header-main'
    ];
    
    /**
     * align
     */
    if ( 'left' != $header_align && 'right' != $header_align ) {
        $header_align = 'center';
    }
    $class[] = 'align-' . $header_align;
    
    /**
     * content narrow
     */
    $narrow = false;
    if ( 'narrow' == $content_width && 'no-sidebar' == $sidebar_state ) {
        $narrow = true;
    }
    
    if ( $narrow ) {
        $main_class[] = 'narrow-area';
    }
    
    /**
     * item_template
     */
    if ( '2' != $header_item_template && '4' != $header_item_template ) {
        $header_item_template = '1';
    }
    $class[] = 'single-header-template-' . $header_item_template;
    
    /**
     * setup params for post body
     */
    $body_params = $params;
    $body_params[ 'live' ] = true;
    $body_params[ 'item_template' ] = $header_item_template;
    
    $subtitle = $params[ 'subtitle_position' ] == 'after_title' ? fox_get_subtitle() : '';
    
    $breadcrumbs_position = get_theme_mod( 'wi_single_breadcrumbs' );
    $breadcrumbs = in_array( $breadcrumbs_position, [ 'before', 'after_title', 'after' ] ) ? fox_breadcrumbs() : '';
    
    $title_html = fox_format( '<h1 class="post-title post-item-title">{}</h1>', get_the_title() );
    if ( 'after_title' == $breadcrumbs_position ) {
        $title_html .= $breadcrumbs;
    }
    
    $body_params[ 'title_html' ] = 
        '<div class="title-subtitle">' . $title_html . $subtitle . '</div>';
    
    $body_params[ 'title_show' ] = true;
    $body_params[ 'excerpt_show' ] = false;
    
    /**
     * header border
     */
    $single_header_border = get_theme_mod( 'wi_single_meta_border' );
    if ( $single_header_border ) {
        $borders = explode( '|', $single_header_border );
        foreach ( $borders as $bor ) {
            $class[] = 'post-header-' . $bor;
        }
    }
    
    ?>
    <header class="<?php echo esc_attr( join( ' ', $class ) ); ?>" itemscope itemtype="https://schema.org/WPHeader">
    
        <div class="container">
            
            <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">
                
                <?php if ( 'before' == $breadcrumbs_position ) { echo $breadcrumbs; } ?>
                
                <?php fox_post_body( $body_params ); ?>
                
                <?php if ( 'after' == $breadcrumbs_position ) { echo $breadcrumbs; } ?>
                
            </div><!-- .header-main -->

        </div><!-- .container -->
    
    </header><!-- .single-header -->
    <?php
    
}
endif;

/* 
 * Single Subtitle
 * @since 4.3
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_get_subtitle' ) ) :
function fox_get_subtitle() {
    
    if ( 'post' == get_post_type( get_the_ID() ) ) {
        $subtitle_display = get_theme_mod( 'wi_subtitle_display', 'subtitle' );
    } else {
        $subtitle_display  = 'subtitle';
    }
    
    if ( 'excerpt' != $subtitle_display ) {
        $subtitle_display = 'subtitle';
    }
    
    if ( 'excerpt' == $subtitle_display ) {
        $subtitle = trim( get_the_excerpt( get_the_ID() ) );
    } else {
        $subtitle = trim( get_post_meta( get_the_ID(), '_wi_subtitle', true ) );    
    }
    
    if ( ! $subtitle ) return;

    return '<div class="post-item-subtitle post-header-section"><p>' . $subtitle . '</p></div>';
    
}
endif;

/* 
 * Page Links
 * ------------------------------------------------------------------ */
function fox_page_links() {
    
    wp_link_pages( array(
        'before'      => '<div class="page-links-container"><div class="page-links"><span class="page-links-label">' . esc_html__( 'Pages:', 'wi' ) . '</span>',
        'after'       => '</div></div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );
    
}

/* 
 * Tags
 * ------------------------------------------------------------------ */
if ( !function_exists( 'fox_single_tags' ) ) :
function fox_single_tags() {
    
    $tags = get_the_tag_list( '<ul><li>','</li><li>','</li></ul>' );
    if ( ! $tags ) return;
    
    $tags_class = [ 'single-tags entry-tags post-tags' ];
    
    $align = get_theme_mod( 'wi_tags_align', 'center' );
    if ( $align ) {
        $tags_class[] = 'align-' . $align;
    }
    
    $tag_label_show = get_theme_mod( 'wi_tag_label_show', 'hide' );
    $tags_class[] = 'tag-label-' . $tag_label_show;
    
    ?>
<div class="single-component single-component-tag">
    
    <div class="<?php echo esc_attr( join( ' ', $tags_class ) ); ?>">

        <h3 class="single-heading tag-label">
            <span>
                <?php echo fox_word( 'tag_label' ); ?>
            </span>
        </h3>
        
        <div class="fox-term-list">

            <?php echo $tags; ?>

        </div><!-- .fox-term-list -->

    </div><!-- .single-tags -->
    
</div>
    <?php
}
endif;

/* 
 * Author box
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_single_authorbox' ) ) :
function fox_single_authorbox() {
    
    if ( function_exists( 'get_coauthors' ) ) {
        $authors = get_coauthors();
    } else {
        $authors = [ get_userdata( get_the_author_meta( 'ID' ) ) ];
    }
    
    foreach ( $authors as $user ) :
    
    // class
    $class = [ 'fox-authorbox' ];
    
    // style
    $style = get_theme_mod( 'wi_authorbox_style', 'simple' );
    if ( 'box' != $style ) $style = 'simple';
    $class[] = 'authorbox-' . $style;
    
    // width
    $width = get_theme_mod( 'wi_single_authorbox_width', 'narrow' );
    if ( 'full' != $width ) {
        $width = 'narrow';
    }
    $class[] = 'authorbox-' . $width;
    
    $link = get_author_posts_url( $user->ID, $user->user_nicename );
    
    $tabs = ( 'box' == $style );
    $avatar_shape = get_theme_mod( 'wi_single_authorbox_avatar_shape', 'circle' );
    if ( 'acute' != $avatar_shape && 'round' != $avatar_shape ) $avatar_shape = 'circle';
    
    if ( $tabs ) {
        $class[] = 'has-tabs';
    }
    
    ?>

<div class="single-component single-component-authorbox">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
        <div class="authorbox-inner">

            <?php /* ---------      AVATAR      -------------- */ ?>
            <div class="user-item-avatar authorbox-avatar avatar-<?php echo esc_attr( $avatar_shape ); ?>">

                <a href="<?php echo $link; ?>">

                    <?php echo get_avatar( $user->ID, 300 ); ?>

                </a>

            </div><!-- .user-item-avatar -->

            <div class="authorbox-text">

                <?php /* ---------      NAV TABS      -------------- */ ?>

                <?php if ( $tabs ) { ?>

                <div class="authorbox-nav">

                    <ul>

                        <li class="active">
                            <a class="authorbox-nav-author" data-tab="author"><?php echo $user->display_name; ?></a>
                        </li><!-- .active -->
                        <li>
                            <a class="authorbox-nav-posts" data-tab="latest"><?php echo fox_word( 'latest_posts' );?></a>
                        </li>

                    </ul>

                </div><!-- .authorbox-nav -->

                <?php } ?>

                <?php /* ---------      MAIN CONTENT      -------------- */ ?>

                <div class="fox-user-item authorbox-tab active authorbox-content" data-tab="author">

                    <div class="user-item-body">

                        <?php if ( ! $tabs ) { ?>

                        <h3 class="user-item-name">

                            <a href="<?php echo $link; ?>"><?php echo $user->display_name; ?></a>

                        </h3>

                        <?php } ?>

                        <?php if ( $user->description ) { ?>

                        <div class="user-item-description">

                            <?php echo wpautop( $user->description ); ?>

                        </div><!-- .user-item-description -->

                        <?php } ?>

                        <?php fox_user_social([ 'user' => $user->ID, 'style' => 'plain' ] ); ?>

                    </div><!-- .user-item-body -->

                </div><!-- .fox-user-item -->

                <?php if ( $tabs ) {
        
                    $args = array(
                        'posts_per_page'    => 4,
                        // use this instead of author ID for co-authors plus plugin
                        'author_name'       => $user->user_nicename,
                        'no_found_rows'     => true, // no need for pagination
                    );

                    $same_author_query = new WP_QUery ( $args );

                    if ( $same_author_query->have_posts() ) : ?>

                    <div class="authorbox-tab same-author-posts fox-post-list" data-tab="latest">

                        <ul class="same-author-list">

                            <?php while ( $same_author_query->have_posts() ) : $same_author_query->the_post(); ?>

                            <li>
                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            </li>

                            <?php endwhile; ?>

                        </ul><!-- .same-author-list -->

                        <?php fox_btn([
                            'text' => fox_word( 'viewall' ),
                            'style' => 'fill',
                            'size'  => 'small',
                            'url' => get_author_posts_url( $user->ID, $user->user_nicename ),
                            'attrs' => 'rel="author"',
                            'extra_class' => 'viewall',
                        ]); ?>

                    </div><!-- .same-author-posts -->

                    <?php endif; // get_posts
                    wp_reset_query();

                } // if tabs ?>

            </div><!-- .authorbox-text -->

        </div><!-- .authorbox-inner -->

    </div><!-- .fox-authorbox -->

</div><!-- .single-authorbox-section -->
    <?php
    
    endforeach;
    
}
endif;

/* 
 * Comment
 * ------------------------------------------------------------------ */
function fox_post_comment() {
    
    // to implement via PHP
    do_action( 'fox_commment', 'post' );

}

function fox_single_comment() {
    
    ?>

<div class="single-component single-component-comment">
    
    <?php fox_post_comment(); ?>

</div><!-- .single-component-comment -->
    <?php
    
}

add_action( 'fox_commment', 'fox_implement_comment_shortcode' );

/**
 * Implement custom comment plugin via shortcode
 * @since 4.0
 */
function fox_implement_comment_shortcode( $page ) {
    
    $shortcode = trim( get_theme_mod( 'wi_comment_shortcode' ) );
    if ( $shortcode ) {
        $shortcode = do_shortcode( $shortcode );
    }
    
    // if shortcode not empty, standard comment will be replaced
    if ( $shortcode ) {
        
        echo '<div class="single-component single-section">' . $shortcode  . '</div>';
        
    } else {
        
        if ( 'post' == $page ) {
            
            if ( ! fox_autoload() ) {
                fox_comment();
            } else {
                fox_comment_hidden();
            }
            
        } elseif ( 'page' == $page ) {
            
            fox_comment();
            
        }
    
    }
    
}

function fox_comment() {
    
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
    
        comments_template();
    
    endif;
    
}

function fox_comment_hidden() {
?>

<div class="comment-hidden">
    
    <button class="show-comment-btn fox-btn btn-small btn-fill"><?php echo esc_html__( 'Show comments', 'wi' ); ?></button>
    
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
    ?>
    
</div><!-- .comment-hidden -->

<?php
    
}

/* 
 * Comment Nav
 * ------------------------------------------------------------------ */
function fox_comment_nav( $pos ) {
    
    if ( get_comment_pages_count() > 1 && get_theme_mod( 'page_comments' ) ) : // Are there comments to navigate through? ?>

    <nav id="comment-nav-<?php echo esc_attr( $pos ); ?>" class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wi' ); ?></h2>
        <div class="nav-links">

            <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'wi' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wi' ) ); ?></div>

        </div><!-- .nav-links -->
    </nav><!-- #comment-nav-# -->

    <?php endif; // Check for comment navigation.

}

/*
 * Post Nav
 * ------------------------------------------------------------------ */
function fox_post_navigation() {
    
    $style = get_theme_mod( 'wi_single_post_navigation_style', 'advanced' );
    if ( ! in_array( $style, [ 'minimal-1', 'minimal-2', 'minimal-3', 'simple', 'simple-2', 'advanced' ] ) ) {
        $style = 'advanced';
    }
    
    $same_term = ( 'true' == get_theme_mod( 'wi_single_post_navigation_same_term', 'false' ) );
    
    $class = [ 'fox-post-nav', 'post-nav-' . $style ];
    
    /* SIMPLE
    -------------------------------- */
    if ( 'simple' == $style || 'simple-2' == $style ) {
        
        if ( 'simple-2' == $style ) {
            $class[] = 'post-nav-simple';
        }
        
    ?>
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
        <div class="container">
            
            <?php
                // Previous/next post navigation.
                the_post_navigation( array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' . fox_word( 'next_story' ) . '<i class="fa fa-caret-right"></i></span> ' .
                        '<span class="screen-reader-text">' . __( 'Next post:', 'wi' ) . '</span> ' .
                        '<h4 class="post-title font-heading">%title</h4>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="fa fa-caret-left"></i>' . fox_word( 'previous_story' ) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Previous post:', 'wi' ) . '</span> ' .
                        '<h4 class="post-title font-heading">%title</h4>',
                    'in_same_term' => $same_term,
                ) );
            ?>
        </div><!-- .container -->
        
    </div><!-- .fox-post-nav -->

<?php 
        
    /* MINIMAL
    -------------------------------- */
    } elseif ( 'minimal-1' == $style || 'minimal-2' == $style || 'minimal-3' == $style ) { ?>

    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
        <div class="container">
            
            <?php
                // Previous/next post navigation.
                the_post_navigation( array(
                    'next_text' => '<span class="text font-heading">' . fox_word( 'next_story' ) . '</span>' . '<i class="feather-arrow-right"></i>',
                    'prev_text' => '<i class="feather-arrow-left"></i>' . '<span class="font-heading">' . fox_word( 'previous_story' ) . '</span>',
                    'in_same_term' => $same_term,
                ) );
            ?>
        </div><!-- .container -->
        
    </div><!-- .fox-post-nav -->
<?php
    
    /* ADVANCED
    -------------------------------- */
    } else {

              $prev_post = get_previous_post( $same_term );
              $next_post = get_next_post( $same_term );
              
              $column = 0;
              if ( $prev_post ) $column++;
              if ( $next_post ) $column++;
              
              if ( ! $column ) return;
              
              $class[] = 'column-' . $column;
        
        $single_nav_image_ratio = get_theme_mod( 'wi_single_nav_image_ratio', '1000x450' );
        
        if ( '1000x450' == $single_nav_image_ratio ) {
            if ( $column == 2 ) {
                $size = '1000x450';
            } else {
                $size = '1000x250';
            }
        } else {
            if ( $column == 2 ) {
                $size = '1000x600';
            } else {
                $size = '1000x340';
            }
        }
        
        global $post;
              
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <div class="post-nav-wrapper">
        
        <?php if ( $prev_post ) : $post = $prev_post; setup_postdata( $post ); ?>
        
        <article class="post-nav-item post-nav-item-previous" itemscope itemtype="https://schema.org/CreativeWork">
            
            <div class="post-nav-item-inner">
            
                <?php fox_thumbnail([
                  'thumbnail' => 'custom',
                  'thumbnail_custom' => $size,
                  'thumbnail_placeholder' => true,
                  'thumbnail_placeholder_id' => get_theme_mod( 'wi_thumbnail_placeholder_id' ),
                  'thumbnail_etra_class' => 'post-nav-item-thumbnail',
                  'thumbnail_format_indicator' => false,
                  'thumbnail_view' => false,
                  'thumbnail_index' => false,
                  'thumbnail_review_score' => false,
                  'thumbnail_hover' => '',
                  'thumbnail_showing_effect' => '',
                  'thumbnail_type' => 'simple',
                  'thumbnail_shape' => 'acute',
              ]); ?>

                <div class="post-nav-item-body">

                    <div class="post-nav-item-label"><?php echo fox_word( 'previous_story' ); ?></div>
                    <h3 class="post-item-title post-nav-item-title" itemprop="headline"><?php echo get_the_title(); ?></h3>

                </div><!-- .post-nav-item-body -->

                <div class="post-nav-item-overlay"></div>

                <a class="wrap-link" href="<?php echo get_permalink(); ?>"></a>
                
            </div>
        
        </article><!-- .post-nav-item -->
        
        <?php wp_reset_postdata(); endif; // prev_post ?>
        
        <?php if ( $next_post ) : $post = $next_post; setup_postdata( $post ); ?>
        
        <article class="post-nav-item post-nav-item-next" itemscope itemtype="https://schema.org/CreativeWork">
            
            <div class="post-nav-item-inner">
            
                <?php fox_thumbnail([
                  'thumbnail' => 'custom',
                  'thumbnail_custom' => $size,
                  'thumbnail_placeholder' => true,
                  'thumbnail_placeholder_id' => get_theme_mod( 'wi_thumbnail_placeholder_id' ),
                  'thumbnail_etra_class' => 'post-nav-item-thumbnail',
                  'thumbnail_format_indicator' => false,
                  'thumbnail_view' => false,
                  'thumbnail_index' => false,
                  'thumbnail_review_score' => false,
                  'thumbnail_hover' => '',
                  'thumbnail_showing_effect' => '',
                  'thumbnail_type' => 'simple',
                  'thumbnail_shape' => 'acute',
              ]); ?>

                <div class="post-nav-item-body">

                    <div class="post-nav-item-label"><?php echo fox_word( 'next_story' ); ?></div>
                    <h3 class="post-item-title post-nav-item-title" itemprop="headline"><?php echo get_the_title(); ?></h3>

                </div><!-- .post-nav-item-body -->

                <div class="post-nav-item-overlay"></div>

                <a class="wrap-link" href="<?php echo get_permalink(); ?>"></a>
                
            </div>
        
        </article><!-- .post-nav-item -->
        
        <?php wp_reset_postdata(); endif; // prev_post ?>
    
    </div><!-- .post-nav-wrapper -->
    
</div><!-- .fox-post-nav -->

<?php    
        
    } // style
}

if ( ! function_exists('fox_share') ) :
/**
 * Post Share
 * ------------------------------------------------------------------ */
function fox_share( $args = [] ) {
    
    $extra_class = isset( $args[ 'extra_class' ] ) ? $args[ 'extra_class' ] : '';
    $style = isset( $args[ 'style' ] ) ? $args[ 'style' ] : '';
    
    $url = get_permalink();
    $title = trim( get_the_title() );
    $title = strip_tags( $title );
    
    $image = '';
    if ( has_post_thumbnail() ) {
        $image = wp_get_attachment_thumb_url();
    }
    
    $via = trim( get_theme_mod( 'wi_twitter_username' ) );
    
    $share_icons = get_theme_mod( 'wi_share_icons', 'facebook,messenger,twitter,pinterest,whatsapp,email' );
    $share_icons = explode( ',',$share_icons );
    $share_icons = array_map( 'trim', $share_icons );
    
    // get style and shape
    if ( ! $style ) {
        $style = get_theme_mod( 'wi_share_icon_style', 'default' );
    }
    if ( 'custom' != $style ) {
        $style = 'default';
    }
    
    $class = [
        'fox-share',
    ];
    if ( 'default' == $style ) {
        $class[] = 'share-style-2b'; // backward compat reason
    }
    $class[]  = 'share-style-' . $style;
    $class[] = $extra_class;
    
    $share_layout = 'stack';
    if ( 'custom' == $style ) {
        
        /**
         * share layout
         */
        $share_layout = get_theme_mod( 'wi_share_layout', 'inline' );
        if ( 'stack' != $share_layout ) {
            $share_layout = 'inline';
        }
        
        /**
         * COLOR PROBLEM
         */
        $share_icon_color = get_theme_mod( 'wi_share_icon_color' );
        if ( 'brand' == $share_icon_color ) {
            $class[] = 'color-brand';
        } else {
            $class[] = 'color-custom';
        }
        
        $share_icon_background = get_theme_mod( 'wi_share_icon_background' );
        if ( 'brand' == $share_icon_background ) {
            $class[] = 'background-brand';
        } else {
            $class[] = 'background-custom';
        }
        
        $share_icon_hover_color = get_theme_mod( 'wi_share_icon_hover_color' );
        if ( 'brand' == $share_icon_hover_color ) {
            $class[] = 'hover-color-brand';
        } else {
            $class[] = 'hover-color-custom';
        }
        
        $share_icon_hover_background = get_theme_mod( 'wi_share_icon_hover_background' );
        if ( 'brand' == $share_icon_hover_background ) {
            $class[] = 'hover-background-brand';
        } else {
            $class[] = 'hover-background-custom';
        }
        
        /**
         * SHAPE
         */
        $shape = get_theme_mod( 'wi_share_icon_shape' );
        if ( 'acute' != $shape && 'round' != $shape ) $shape = 'circle';
        $class[] = 'share-icons-shape-' . $shape;
        
        /**
         * SIZE
         */
        $size = absint( get_theme_mod( 'wi_share_icon_size', 40 ) );
        if ( $size >= 48 ) {
            $class[] = 'size-medium';
        } elseif ( $size >= 36 ) {
            $class[] = 'size-normal';
        } else {
            $class[] = 'size-small';
        }
        
        /**
         * share_lines
         */
        if ( 'true' == get_theme_mod( 'wi_share_lines', 'false' ) && $share_layout == 'stack' ) {
            $class[] = 'share-has-lines';
        }
        
    } else {
    
        $class[] = 'background-brand';
    
    }
    
    // since 4.3
    $class[] = 'share-layout-' . $share_layout;

?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <?php if ( fox_word( 'share_label' ) ) { ?>
    
    <span class="share-label"><i class="fa fa-share-alt"></i><?php echo fox_word( 'share_label' ); ?></span>
    
    <?php } ?>
    
    <?php fox_share_icon_list([
        'share_icons' => $share_icons,
        'url' => $url,
        'via' => $via,
        'title' => $title,
        'image' => $image,
    ]); ?>
    
</div><!-- .fox-share -->
<?php
    
}
endif;

if ( ! function_exists( 'fox_share_icon_list' ) ) :
function fox_share_icon_list( $args = [] ) {
    extract( wp_parse_args( $args, [
        'share_icons' => [],
        'url' => '',
        'via' => '',
        'title' => '',
        'image' => '',
    ]));
    ?>
    <ul>
        
        <?php foreach ( $share_icons as $icon ) :
    
            $href = '#';
    
            if ( 'facebook' == $icon ) {
                
                $href = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $url );
                if ( $image ) {
                    $href .= '&amp;p[images][0]=' . urlencode( $image );
                }
                
            } elseif ( 'twitter' == $icon ) {
                
                $href = 'https://twitter.com/intent/tweet?url=' . urlencode($url) .'&amp;text=' . urlencode( html_entity_decode( $title ) );
                
                if ( $via ) {
                    $href .= '&amp;via=' . urlencode( $via );
                }
                
            } elseif ( 'pinterest' == $icon ) {
                
                $href = 'https://pinterest.com/pin/create/button/?url=' . urlencode($url) . '&amp;description=' . urlencode( html_entity_decode( $title ) );
                if ( $image ) {
                    $href .= '&amp;media=' . urlencode($image);
                }
                
            } elseif ( 'linkedin' == $icon ) {
                
                $href = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( $url ) . '&amp;title=' . urlencode( html_entity_decode( $title ) );
            
            } elseif ( 'whatsapp' == $icon ) {
            
                $href = 'https://api.whatsapp.com/send?phone=&text=' . urlencode( $url );
                
            } elseif ( 'reddit' == $icon ) {
            
                $href = 'https://www.reddit.com/submit?url=' . urlencode( $url ) . '&title=' . urlencode( html_entity_decode( $title ) );
            
            } elseif ( 'email' == $icon ) {
            
                $href = 'mailto:?subject=' . rawurlencode( html_entity_decode( $title ) )  . '&amp;body=' . rawurlencode($url);
            
            } else {
                continue;
            }
    
            $icon_map = [
                'facebook' => 'fab fa-facebook-f',
                'messenger' => 'fab fa-facebook-messenger',
                'twitter'   => 'fab fa-twitter',
                'pinterest' => 'fab fa-pinterest-p',
                'linkedin' => 'fab fa-linkedin-in',
                'whatsapp' => 'fab fa-whatsapp',
                'reddit'   => 'fab fa-reddit-alien',
                'email' => 'feather-mail',
            ];
    
            if ( 'email' == $icon ) {
                $a_class = 'email-share';
            } else {
                $a_class = 'share share-' . $icon;
            }
            $ic = $icon_map[ $icon ];
            $li_class = 'li-share-' . $icon;
            $label = ucfirst( $icon );
            ?>
        
        <li class="<?php echo esc_attr( $li_class ); ?>">
            
            <a href="<?php echo esc_url( $href ); ?>" title="<?php echo esc_attr( $label ); ?>" class="<?php echo esc_attr( $a_class ); ?>">
                
                <i class="<?php echo esc_attr( $ic ); ?>"></i>
                <span><?php echo esc_html( $label ); ?></span>
                
            </a>
            
        </li>
        
        <?php endforeach; ?>
        
    </ul>
    <?php
}
endif;
    
/**
 * Displays related posts in single post
 * note: it doesn't care about the position
 */
function fox_single_related( $args = [] ) {
    
    $args = wp_parse_args( $args, [
        'wrapper_class' => '',
    ] );
    
    $query_args = [
        'number' => get_theme_mod( 'wi_single_related_number', 3 ),
        'orderby' => get_theme_mod( 'wi_single_related_orderby', 'date' ),
        'order' => get_theme_mod( 'wi_single_related_order', 'desc' ),
        'source' => get_theme_mod( 'wi_single_related_source', 'tag' ),
        'exclude_categories' => get_theme_mod( 'wi_single_related_exclude_categories' ),
    ];
    
    $related_query = fox_related_query( $query_args );
    
    if ( ! $related_query || ! $related_query->have_posts() ) {
        wp_reset_query();
        return;
    }
    
    $related_layout = get_theme_mod( 'wi_single_related_layout', 'grid-3' );
    if ( in_array( $related_layout, [ 'grid-2', 'grid-3', 'grid-4' ] ) ) {
        $column = str_replace( 'grid-', '', $related_layout );
        $layout = 'grid';
    } else {
        $column = '';
        $layout = 'list';
    }

    $fn_params = [
        // 'thumbnail_components' => 'format_indicator,review',
        'item_template' => 2,
        'layout' => $layout,
        'column' => $column,
        
        'pagination' => false,
        'live' => false,
        'title_tag' => 'h3',
        
        'first_standard' => false,
    ];

    if ( 'list' == $layout ) {
        
        $fn_params[ 'components' ] = 'title,thumbnail,date,excerpt';
        $fn_params[ 'title_size' ] = 'normal';
        $fn_params[ 'excerpt_length' ] = 24;
        $fn_params[ 'excerpt_more' ] = false;
        $fn_params[ 'excerpt_size' ] = 'normal';
        $fn_params[ 'list_sep' ] = false;
        $fn_params[ 'list_spacing' ] = 'normal';
        $fn_params[ 'thumbnail_width' ] = '';
        $fn_params[ 'thumbnail_position' ] = 'left';

    } else {
        
        $fn_params[ 'components' ] = 'title,thumbnail,date';
        $fn_params[ 'item_spacing' ] = 'small';
        
        /**
         * column problem
         */
        if ( 2 == $column ) {
            $fn_params[ 'title_size' ] = 'normal';
            $fn_params[ 'item_spacing' ] = 'normal';
        } elseif ( 3 == $column ) {
            $fn_params[ 'title_size' ] = 'small';
        } elseif ( 4 == $column ) {
            $fn_params[ 'title_size' ] = 'tiny';
            $fn_params[ 'item_spacing' ] = 'small';
        } elseif ( 5 == $column ) {
            $fn_params[ 'title_size' ] = 'tiny';
        }

    }
    
    if ( get_theme_mod( 'wi_single_related_title_size' ) ) {
        $fn_params[ 'title_size' ] = get_theme_mod( 'wi_single_related_title_size' );
    }

    $c_params = fox_customize_params( $layout );
    $fn_params = wp_parse_args( $fn_params, $c_params );
    
    /**
     * wrapper class
     */
    $cl = [ 'single-related-wrapper' ];
    if ( $args[ 'wrapper_class' ] ) {
        $cl[] = $args[ 'wrapper_class' ];
    }

    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ) ;?>">

        <div class="fox-related-posts">

            <div class="container">

                <h3 class="single-heading related-label related-heading">
                    <span><?php echo fox_word( 'related' ); ?></span>
                </h3>

                <?php fox_blog( $fn_params, $related_query ); ?>

            </div><!-- .container -->

        </div><!-- .fox-related-posts -->

    </div><!-- .single-component -->

<?php
    
}

/**
 * bottom posts of a single post
 * @since 4.5
 */
function fox_single_bottom_posts() {
    
    // since 4.0
    if ( fox_autoload() ) return;
    
    $query_args = [
        'number' => get_theme_mod( 'wi_single_bottom_posts_number', 5 ),
        'orderby' => get_theme_mod( 'wi_single_bottom_posts_orderby', 'date' ),
        'order' => get_theme_mod( 'wi_single_bottom_posts_order', 'desc' ),
        'source' => get_theme_mod( 'wi_single_bottom_posts_source', 'category' ),
        'exclude_categories' => get_theme_mod( 'wi_single_bottom_posts_exclude_categories' ),
    ];
    
    $related_query = fox_related_query( $query_args );
    
    if ( ! $related_query || ! $related_query->have_posts() ) {
        wp_reset_query();
        return;
    }
    
    $components = 'title,thumbnail';
    if ( 'true' == get_theme_mod( 'wi_single_bottom_posts_excerpt', 'true' ) ) {
        $components .= ',excerpt';
    }
    
    $c_params = fox_customize_params( 'grid' );
    $fn_params = [
        'layout' => 'grid',
        'column' => 5,
        'first_standard' => false,
        
        'item_card' => 'none',
        'item_spacing' => 'small',
        'excerpt_length' => 16,
        
        'title_size' => 'tiny',
        'excerpt_size' => 'small',
        
        'components' => $components,
        'thumbnail_components' => 'format_indicator,review',
    ];
    
    $fn_params = wp_parse_args( $fn_params, $c_params );
    
    $source = get_theme_mod( 'wi_single_bottom_posts_source', 'category' );
    $name = '';
    if ( 'author' == $source ) {
        
        $name = get_the_author();
        
    } elseif ( 'tag' == $source ) {
        
        $name = esc_html__( 'Same Tags', 'wi' );
        
    } elseif ( 'date' == $source ) {
        
        // just nothing
        $name = esc_html__( 'Blog', 'wi' );
        
    } elseif ( 'featured' == $source ) {
        
        $name = esc_html__( 'Featured Posts', 'wi' );
        
    // category by default    
    } else {
        
        $terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
        if ( ! $terms ) {
            return;
        }
        
        $cat = fox_primary_cat( get_the_ID() );
        $name = get_cat_name( $cat );
    
    }

?>

<div class="single-big-section single-bottom-section single-bottom-posts-section">
    
    <div class="fox-bottom-posts">
    
        <div class="container">

            <h3 id="posts-small-heading" class="bottom-posts-heading single-heading">

                <span><?php printf( fox_word( 'latest' ), $name ); ?></span>

            </h3>

            <?php fox_blog( $fn_params, $related_query ); ?>

        </div><!-- .container -->

    </div><!-- .fox-bottom-posts -->

</div><!-- .single-bottom-posts-section -->
    <?php
    
}

/**
 * single side dock
 * @since 4.5
 */
add_action( 'fox_single_bottom', 'fox_single_sidedock' );
function fox_single_sidedock( $params ) {
    
    if ( ! $params[ 'side_dock_show' ] ) return;
    
    // disable on footer
    if ( ! apply_filters( 'fox_show_footer', true ) ) return;
    
    if ( ! is_single() ) return;
    
    // disable on autoload
    if ( fox_autoload() ) return;
    
    $query_args = [
        'number' => get_theme_mod( 'wi_single_side_dock_number', 2 ),
        'orderby' => get_theme_mod( 'wi_single_side_dock_orderby', 'date' ),
        'order' => get_theme_mod( 'wi_single_side_dock_order', 'desc' ),
        'source' => get_theme_mod( 'wi_single_side_dock_source', 'tag' ),
    ];
    
    $related_query = fox_related_query( $query_args );
    
    if ( ! $related_query || ! $related_query->have_posts() ) {
        wp_reset_query();
        return;
    }
    
    $c_params = fox_customize_params( 'list' );
    $fn_params = [
        'layout' => 'list',
        'item_card' => 'none',
        
        'first_standard' => false,
        'thumbnail' => 'thumbnail',
        'thumbnail_width' => '',
        'thumbnail_extra_class' => 'post-dock-thumbnail',
        'thumbnail_position' => 'left',
        'thumbnail_format_indicator' => false,
        
        'thumbnail_components' => '',
        
        'components' => 'title,thumbnail,excerpt', // excerpt removed since 4.3 // added again since 4.6.2.4
        
        'header_extra_class' => 'post-dock-header',
        
        'title_size' => get_theme_mod( 'wi_single_side_dock_title_size', 'tiny' ),
        'title_extra_class' => 'post-dock-title',
        
        'excerpt_extra_class' => 'post-dock-excerpt',
        'excerpt_length' => get_theme_mod( 'wi_single_side_dock_excerpt_length', '0' ),
        'excerpt_more' => false,
        'excerpt_size' => 'small',
        
        'extra_class' => 'post-dock',
        'list_sep' => false,
        'list_valign' => 'top',
        'list_spacing' => 'small',
        'list_mobile_layout' => 'list',
    ];
    
    $fn_params = wp_parse_args( $fn_params, $c_params );
    
    // adjust the thumbnail_hover
    $thumbnail_hover = isset( $fn_params[ 'thumbnail_hover' ] ) ? $fn_params[ 'thumbnail_hover' ] : '';
    if ( 'letter' == $thumbnail_hover || 'logo' == $thumbnail_hover ) {
        $thumbnail_hover = 'dark';
        $fn_params[ 'thumbnail_hover' ] = $thumbnail_hover;
    }
    
    $class = [ 'content-dock', 'sliding-box' ];
    
    // since 4.3
    $orientation = get_theme_mod( 'wi_single_side_dock_orientation', 'up' );
    $class[] = 'sliding-' . $orientation;
    
    ?>

<aside id="content-dock" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <h3 class="dock-title widget-title"><?php echo fox_word( 'related' ); ?></h3>
    
    <div class="dock-posts">
        
        <?php fox_blog( $fn_params, $related_query ); ?>
        
    </div><!-- .dock-posts -->

    <button class="close">
        <i class="feather-x"></i>
    </button>

</aside><!-- #content-dock -->
    
<?php
    
}

function fox_single_body( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        
        'style' => '1',
        'sidebar_state' => 'right',
        'thumbnail_stretch' => 'stretch-none',
        'content_width' => 'full',
        'image_stretch' => 'stretch-none',
        'column_layout' => 1,

        'header_align' => 'center',
        'header_item_template' => '1',
        'subtitle_position' => 'after_title',
        
        'dropcap' => false,
        'text_column' => 1,
    ]);
    
    extract( $params );
    
    $class = [
        'single-section', 
        'single-main-content' 
    ];
    
    /**
     * Narrow
     */
    $main_class = [
        'content-main',
    ];
    
    if ( 'narrow' == $content_width ) {
        $main_class[] = 'narrow-area';
    }
    
    /**
     * cases that allow stretch
     * narrow content: left, right, bigger
     * no-sidebar: bigger, full
     *
     * to keep it simple, stretch bigger is only allowed with narrow content
     */
    $allow_stretch = [];
    if ( 'no-sidebar' == $sidebar_state ) {
        $allow_stretch[] = 'stretch-full';
    }
    if ( 'narrow' == $content_width ) {
        $allow_stretch[] = 'stretch-left';
        $allow_stretch[] = 'stretch-right';
        $allow_stretch[] = 'stretch-bigger';
    }
    
    $allow_stretch = array_unique( $allow_stretch );
    
    /**
     * STRETCH ALL
     * stretch-full will become stretch-bigger in case it has sidebar
     * and in case it has sidebar + content full, no stretch at all
     */
    if ( 'no-sidebar' != $sidebar_state ) {
        if ( 'stretch-full' == $image_stretch ) {
            $image_stretch = 'stretch-bigger';
        }
        if ( 'full' == $content_width ) {
            $image_stretch = 'stretch-none';
        }
    }
    
    /**
     * Body layout: if boxed, then we disabllow stretch bigger, left, right for full content
     */
    if ( 'boxed' == $body_layout && 'full' == $content_width ) {
        $allow_stretch = array_diff( $allow_stretch, [ 'stretch-bigger', 'stretch-right', 'stretch-left' ] );
    }
    
    if ( $image_stretch == 'stretch-bigger' ) {
        // $allow_stretch = array_diff( $allow_stretch, [ 'stretch-left', 'stretch-right' ] );
    }
    
    // if 2 column text, disallow stretch
    // FINAL GUARD
    if ( 2 == $text_column ) {
        $allow_stretch = [];
    }
    
    if ( in_array( $image_stretch, $allow_stretch ) ) {
        $class[] = 'content-all-' . $image_stretch;
    }
    
    foreach ( $allow_stretch as $str ) {
        
        $class[] = 'allow-' . $str;
        
    }
    
    /**
     * share side
     */
    $share_positions = [];
    if ( 'narrow' != $content_width ) {
        
        $share_positions = get_theme_mod( 'wi_share_positions', 'after' );
        $share_positions = explode( ',', $share_positions );
        $share_positions = array_map( 'trim', $share_positions );
        if ( in_array( 'side', $share_positions ) ) {
            $class[] = 'side-share';
        }
        
    }
    
    /**
     * drop cap
     */
    if ( $dropcap ) {
        $class[] = 'enable-dropcap';
    } else {
        $class[] = 'disable-dropcap';
    }
    
    /**
     * text column
     */
    if ( 2 == $text_column ) {
        $class[] = 'enable-2-columns';
    }
    
    ?>

<div class="single-body single-section">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
        <?php if ( 'narrow' != $content_width && in_array( 'side', $share_positions ) ) {
            fox_share([
                'extra_class' => 'vshare',
                'style' => 'custom',
            ]);
        } ?>
        
        <div class="entry-container">
            
            <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">
            
                <?php 
    
                    /**
                     * 10 - fox_append_single_ad_before: ad
                     * 15 - fox_hero_meta
                     * 20 - fox_share_before_content
                     * 50 - fox_sponsored_row: sponsor tag
                     * 70 - fox_subtitle_before_content
                     */
                    do_action( 'fox_before_entry_content', $params ); // since 4.0 ?>

                <div class="dropcap-content columnable-content article-content entry-content single-component">

                    <?php the_content(); fox_page_links(); ?>

                </div><!-- .entry-content -->

                <?php 
    
                    /**
                     * 10 - fox_append_single_ad_after: ad
                     * 20 - fox_after_entry_content: share, related, authorbox, tags.
                     */
                    do_action( 'fox_after_entry_content', $params ); // since 4.0 ?>
                
            </div><!-- .main-content -->
            
        </div><!-- .container -->
    
    </div><!-- .single-section -->
    
    <?php do_action( 'fox_after_single_content', $params ); ?>

</div><!-- .single-body -->

<?php
    
}

/* ------------------------------------
 * hero_meta
 * @since 4.6
 */
add_action( 'fox_before_entry_content', 'fox_hero_meta', 15 );
function fox_hero_meta( $params ) {
    
    if ( 4 != $params[ 'style' ] && 5 != $params[ 'style' ] ) {
        return;
    }
    
    $style = $params[ 'style' ];
    $header_item_template = $params[ 'header_item_template' ];
    $header_align = $params[ 'header_align' ];
    $content_width = $params[ 'content_width' ];
    
    $components = get_theme_mod( 'wi_single_hero_meta_2_elements', 'date,author' );
    if ( ! $components ) {
        $components = [];
    }
    if ( ! is_array( $components ) ) {
        $components = explode( ',', $components );
        $components = array_map( 'trim', $components );
    }
    
    if ( empty( $components ) ) {
        return;
    }
    
    $body_params = [
        'category_show' => in_array( 'category', $components ),
        'date_show' => in_array( 'date', $components ),
        'author_show' => in_array( 'author', $components ),
        'author_avatar_show' => in_array( 'author_avatar', $components ),
        'view_show' => in_array( 'view', $components ),
        'comment_link_show' => in_array( 'comment', $components ),
        'reading_time_show' => in_array( 'reading', $components ),
        
        'item_template' => 1,
        'live' => true,
        'title_show' => false,
        'excerpt_show' => false,
    ];
    
    // legacy
    $class = [
        'hero-meta',
        'single-component',
    ];
    
    $main_class = [
        'header-main'
    ];
    
    /**
     * content narrow
     */
    $narrow = false;
    if ( 'narrow' == $content_width ) {
        $narrow = true;
    }
    
    if ( $narrow ) {
        $main_class[] = 'narrow-area';
    }
    ?>
<header class="<?php echo esc_attr( join( ' ', $class ) ); ?>" itemscope itemtype="https://schema.org/WPHeader">

    <div class="container">

        <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">

            <?php fox_post_body( $body_params ); ?>

        </div>

    </div><!-- .container -->

</header>

<?php
    
}

/* ------------------------------------
 * share before content
 * @since 4.6
 */
add_action( 'fox_before_entry_content', 'fox_share_before_content', 20 );
function fox_share_before_content() {
    
    $share_positions = get_theme_mod( 'wi_share_positions', 'after' );
    $share_positions = explode( ',', $share_positions );
    $share_positions = array_map( 'trim', $share_positions );
    
    if ( in_array( 'before', $share_positions ) ) {
        fox_share([
            'extra_class' => 'fox-share-top single-component',
        ]);
    }
    
}

/* ------------------------------------
 * sponsor row
 * @since 4.6
 */
add_action( 'fox_before_entry_content', 'fox_sponsored_row', 50 );
function fox_sponsored_row( $params ) {
    
    if ( 'true' != get_post_meta( get_the_ID(), '_wi_sponsored', true ) ) return;
    
    $open = $close = '';
    $url = get_post_meta( get_the_ID(), '_wi_sponsor_url', true );
    if ( $url ) {
        $open = '<a href="' . esc_url( $url ) . '" target="_blank">';
        $close = '</a>';
    }
    $name = get_post_meta( get_the_ID(), '_wi_sponsor_name', true );
    
    $label = get_post_meta( get_the_ID(), '_wi_sponsor_label', true );
    if ( ! $label ) {
        $label = fox_word( 'sponsored' );
    }
    ?>

<div class="sponsor-row single-component">
    
    <?php if ( $label ) { ?>
    <div class="sponsor-label"><?php echo $label; ?></div>
    <?php } ?>
    
    <div class="sponsor-meta">
        
        <?php $img_id = get_post_meta( get_the_ID(), '_wi_sponsor_image', true ); if ( $img_id ) {
            $img = wp_get_attachment_image( $img_id, 'full' );
        
        $sponsor_image_style = '';
        if ( $sponsor_image_width = get_post_meta( get_the_ID(), '_wi_sponsor_image_width', true ) )  {
            if ( is_numeric( $sponsor_image_width ) ) $sponsor_image_width .= 'px';
            $sponsor_image_style = ' style="width:' . esc_attr( $sponsor_image_width ). '"';
        }
        ?>
        <figure class="sponsor-image"<?php echo $sponsor_image_style; ?>>
            
            <?php echo $open; ?>
            
            <?php echo $img; ?>
            
            <?php echo $close; ?>
            
        </figure>
        <?php } ?>
        
        <?php if ( $name ) { ?>
        <span class="sponsor-name"><?php echo $open . $name . $close ; ?></span>
        <?php } ?>
        
    </div>

</div><!-- .sponsor-row -->

<?php
    
}

/* ------------------------------------
 * subtitle before content
 * @since 4.6
 */
add_action( 'fox_before_entry_content', 'fox_subtitle_before_content', 70 );
function fox_subtitle_before_content( $params ) {
    
    if ( 'before_content' != $params[ 'subtitle_position' ] ) {
        return;
    }
    
    $subtitle = fox_get_subtitle();
    if ( $subtitle ) {
        echo '<div class="content-teaser single-component">';
        echo fox_get_subtitle();
        echo '</div>';
    }
    
}

/* ------------------------------------
 * distribute elements after the entry content
 * @since 4.6
 */
add_action( 'fox_after_entry_content', 'fox_after_entry_content', 20 );
function fox_after_entry_content( $params ) {
    
    $ele_to_func = [
        'share' => 'fox_single_ele_share',
        'tag' => 'fox_single_ele_tag',
        'related' => 'fox_single_ele_related',
        'authorbox' => 'fox_single_ele_authorbox',
        'comment' => 'fox_single_ele_comment',
        'nav' => 'fox_single_ele_nav',
    ];
    
    $elements_order = get_theme_mod( 'wi_after_content_order', 'share-tag-related-authorbox-comment-nav' );
    $elements_order = explode( '-', $elements_order );
    foreach ( $elements_order as $ele ) {
        
        $func = $ele_to_func[ $ele ];
        if ( function_exists( $func ) ) {
            call_user_func( $func, $params );
        }
        
    }
    
}

function fox_single_ele_share( $params ) {
    
    /**
     * SHARE
     */
    $share_positions = get_theme_mod( 'wi_share_positions', 'after' );
    $share_positions = explode( ',', $share_positions );
    $share_positions = array_map( 'trim', $share_positions );
    
    if ( in_array( 'after', $share_positions ) ) {
        echo '<div class="single-component single-component-share">';
        fox_share();
        echo '</div>';
    }
    
    // when we have side share, we need a fallback
    if ( in_array( 'side', $share_positions ) && ! in_array( 'after', $share_positions ) && ! in_array( 'before', $share_positions ) ) {
        echo '<div class="single-component single-component-share hide_on_desktop show_on_tablet">';
        fox_share();
        echo '</div>';
    }
    
}

function fox_single_ele_tag( $params ) {
    
    if ( ! $params[ 'tag_show' ] ) {
        return;
    }
    
    fox_single_tags();
    
}

function fox_single_ele_related( $params ) {
    
    if ( ! $params[ 'related_show' ] ) {
        return;
    }
    
    if ( 'after_main_content' != get_theme_mod( 'wi_single_related_position', 'after_main_content' ) ) {
        return;
    }
        
    fox_single_related([
        'wrapper_class' => 'single-component single-component-related',
    ]);
    
}

function fox_single_ele_authorbox( $params ) {
    
    if ( ! $params[ 'authorbox_show' ] ) {
        return;
    }
        
    fox_single_authorbox();
    
}

function fox_single_ele_comment( $params ) {
    
    if ( ! $params[ 'comment_show' ] ) {
        return;
    }
        
    fox_single_comment();
    
}

function fox_single_ele_nav( $params ) {
    
    if ( ! $params[ 'nav_show' ] ) {
        return;
    }
    
    if ( 'after_main_content' != get_theme_mod( 'wi_single_nav_position', 'after_container' ) ) {
        return;
    }
    
    if ( fox_autoload() ) {
        return;
    }
    ?>
<div class="single-component single-component-nav">
    
    <?php fox_post_navigation( $params ); ?>

</div>

<?php
    
}

/* ------------------------------------
 * distribute elements in single bottom
 * @since 4.6
 */
add_action( 'fox_single_bottom', 'fox_single_bottom' );
function fox_single_bottom( $params ) {
    
    fox_single_ele_bottom_related( $params );
    fox_single_ele_bottom_nav( $params );
    fox_single_ele_bottom_posts( $params );
    
}

function fox_single_ele_bottom_related( $params ) {
    
    if ( ! $params[ 'related_show' ] ) {
        return;
    }
    
    if ( 'after_container' != get_theme_mod( 'wi_single_related_position', 'after_main_content' ) ) {
        return;
    }
    
    fox_single_related([
        'wrapper_class' => 'single-big-section single-bottom-section single-big-section-related',
    ]);
    
}

function fox_single_ele_bottom_nav( $params ) {
    
    if ( ! $params[ 'nav_show' ] ) {
        return;
    }
    
    if ( 'after_container' != get_theme_mod( 'wi_single_nav_position', 'after_container' ) ) {
        return;
    }
    
    if ( fox_autoload() ) {
        return;
    }
    
    ?>
    
<div class="single-big-section single-bottom-section single-navigation-section">
    
    <?php fox_post_navigation( $params ); ?>

</div><!-- .single-navigation-section -->

<?php
}

function fox_single_ele_bottom_posts( $params ) {
    
    if ( ! $params[ 'bottom_posts_show' ] ) {
        return;
    }
        
    fox_single_bottom_posts();
    
}

/* ------------------------------------|        SINGLE PROGRESS     |------------------------------------ */

add_action( 'wp_footer', 'fox_single_progress_bar_footer_implement' );

// implement the progress bar into footer
function fox_single_progress_bar_footer_implement() {
    
    // position
    $position = get_theme_mod( 'wi_reading_progress_position', 'top' );
    if ( 'bottom' != $position && 'header' != $position ) {
        $position = 'top';
    }
    
    if ( 'top' != $position && 'bottom' != $position ) {
        return;
    }
    
    fox_single_progress_bar();
    
}

add_action( 'fox_after_header_classic_row', 'fox_single_progress_bar_header_implement' );

function fox_single_progress_bar_header_implement() {
    
    // position
    $position = get_theme_mod( 'wi_reading_progress_position', 'top' );
    if ( 'bottom' != $position && 'header' != $position ) {
        $position = 'top';
    }
    
    if ( 'header' != $position ) {
        return;
    }
    
    fox_single_progress_bar();
    
}

if ( ! function_exists( 'fox_single_progress_bar' ) ) :
/**
 * add reading progress bar to single posts
 * @since 4.0
 */
function fox_single_progress_bar() {
    
    if ( 'true' != fox_get_single_option( 'reading_progress' ) ) return;
    
    // position
    $position = get_theme_mod( 'wi_reading_progress_position', 'top' );
    if ( 'bottom' != $position && 'header' != $position ) {
        $position = 'top';
    }
    
    if ( ! is_single() ) return;
    
    $cl = [ 'reading-progress-wrapper', 'position-' . $position ];
    ?>

<progress value="0" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    
    <div class="progress-container">
        <span class="reading-progress-bar"></span>
    </div>
    
</progress>

    <?php
}
endif;

add_filter( 'fox_css', 'fox_single_progress_bar_color' );
function fox_single_progress_bar_color( $css ) {
    
    $color = get_theme_mod( 'wi_reading_progress_color' );
    if ( $color ) {
        $css .= '.reading-progress-wrapper::-webkit-progress-value {background-color:' . $color . '}';
        $css .= '.reading-progress-wrapper::-moz-progress-bar {background-color:' . $color . '}';
    }
    
    return $css;
    
}