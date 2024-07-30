<?php

/* 
 * Get single option via 2 steps:
 * 1 - get post meta
 * 2 - if post meta returns '' then it gets value from theme option
 * ------------------------------------------------------------------ */
function fox_get_single_option( $prop, $std = '' ) {
    
    $get = get_post_meta( get_the_ID(), '_wi_' . $prop, true );
    if ( ! $get ) {
        $get = get_theme_mod( 'wi_single_' . $prop, $std );
    }
    
    return $get;
    
}

/* 
 * Get single option via 2 steps:
 * 1 - get post meta
 * 2 - if post meta returns '' then it gets value from theme option
 * ------------------------------------------------------------------ */
function fox_get_page_option( $prop, $std = '' ) {
    
    $get = get_post_meta( get_the_ID(), '_wi_' . $prop, true );
    if ( ! $get ) {
        $get = get_theme_mod( 'wi_page_' . $prop, $std );
    }
    
    return $get;
    
}

/* 
 * return array of all possible archive layouts
 * used for single tax edit page
 * used for customizer options
 * @since 4.0
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_archive_layout_support' ) ) :
function fox_archive_layout_support() {
    
    return apply_filters( 'fox_archive_layouts', [
        
        'standard' => 'Standard',
        
        'grid-2' => 'Grid 2 columns',
        'grid-3' => 'Grid 3 columns',
        'grid-4' => 'Grid 4 columns',
        'grid-5' => 'Grid 5 columns',
        
        'masonry-2' => 'Masonry 2 columns',
        'masonry-3' => 'Masonry 3 columns',
        'masonry-4' => 'Masonry 4 columns',
        'masonry-5' => 'Masonry 5 columns',
        
        'newspaper' => 'Newspaper',
        'list'      => 'List',
        'vertical'  => 'Post Vertical',
        
    ] );

}
endif;

/* 
 * topbar layout supported
 * topbar supports same as builder layouts, except grid => grid-n, masonry => masonry-n
 * @since 4.0
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_topbar_layout_support' ) ) :
function fox_topbar_layout_support() {
    
    $layout_arr = [
        
        'standard'              =>  'Standard',
        
        'grid-2'                =>  'Grid 2 columns',
        'grid-3'                =>  'Grid 3 columns',
        'grid-4'                =>  'Grid 4 columns',
        'grid-5'                =>  'Grid 5 columns',
        
        'masonry-2'             =>  'Pinterest-like 2 columns',
        'masonry-3'             =>  'Pinterest-like 3 columns',
        'masonry-4'             =>  'Pinterest-like 4 columns',
        'masonry-5'             =>  'Pinterest-like 5 columns',
        
        'list'                  =>  'List',
        'newspaper'             =>  'Newspaper',
        'vertical'              => 'Vertical post',
        'big'                   => 'Big Post',
        'group-1'               => 'Post Group 1',
        'group-2'               => 'Post Group 2',
        'slider'                => 'Classic Slider',
        'slider-1'              => 'Slider Style 1',
        'slider-3'              => 'Carousel',
        
    ];
    
    // since 4.0
    return $layout_arr;
    
}
endif;

/**
 * social data
 * @since 4.6
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_social_data' ) ) :
function fox_social_data() {
    
    $dt = [
        'facebook' => [ 'title' => 'Facebook', 'icon' => 'facebook-square' ],
        'twitter' => [ 'title' => 'Twitter', 'icon' => 'twitter' ],
        'instagram' => [ 'title' => 'Instagram', 'icon' => 'instagram' ],
        'pinterest' => [ 'title' => 'Pinterest', 'icon' => 'pinterest-p' ],
        'linkedin' => [ 'title' => 'LinkedIn', 'icon' => 'linkedin-in' ],
        'youtube' => [ 'title' => 'YouTube', 'icon' => 'youtube' ],
        'snapchat' => [ 'title' => 'Snapchat', 'icon' => 'snapchat-ghost' ],
        'tiktok' => [ 'title' => 'Tiktok', 'icon' => 'tiktok' ],
        'medium' => [ 'title' => 'Medium', 'icon' => 'medium-m' ],
        'reddit' => [ 'title' => 'Reddit', 'icon' => 'reddit-alien' ],
        'whatsapp' => [ 'title' => 'WhatsApp', 'icon' => 'whatsapp' ],
        'soundcloud' => [ 'title' => 'SoundCloud', 'icon' => 'soundcloud' ],
        'spotify' => [ 'title' => 'Spotify', 'icon' => 'spotify' ],
        'tumblr' => [ 'title' => 'Tumblr', 'icon' => 'tumblr' ],
        'yelp' => [ 'title' => 'Yelp', 'icon' => 'yelp' ],
        'vimeo' => [ 'title' => 'Vimeo', 'icon' => 'vimeo-v' ],
        'telegram' => [ 'title' => 'Telegram', 'icon' => 'telegram' ],
        'vkontakte' => [ 'title' => 'VKontakte', 'icon' => 'vk' ],
        'google-play' => [ 'title' => 'Google Play', 'icon' => 'google-play' ],
        'twitch-tv' => [ 'title' => 'Twitch', 'icon' => 'twitch' ],
        'tripadvisor' => [ 'title' => 'TripAdvisor', 'icon' => 'tripadvisor' ],
        'behance' => [ 'title' => 'Behance', 'icon' => 'behance' ],
        'bitbucket' => [ 'title' => 'Bitbucket', 'icon' => 'bitbucket' ],
        'delicious' => [ 'title' => 'Delicious', 'icon' => 'delicious' ],
        'deviantart' => [ 'title' => 'DeviantArt', 'icon' => 'deviantart' ],
        'digg' => [ 'title' => 'Digg', 'icon' => 'digg' ],
        'dribbble' => [ 'title' => 'Dribbble', 'icon' => 'dribbble' ],
        'dropbox' => [ 'title' => 'Dropbox', 'icon' => 'dropbox' ],
        'etsy' => [ 'title' => 'Etsy', 'icon' => 'etsy' ],
        'flickr' => [ 'title' => 'Flickr', 'icon' => 'flickr' ],
        'foursquare' => [ 'title' => 'Foursquare', 'icon' => 'foursquare' ],
        'github' => [ 'title' => 'GitHub', 'icon' => 'github' ],
        'imdb' => [ 'title' => 'IMDb', 'icon' => 'imdb' ],
        'lastfm' => [ 'title' => 'LastFM', 'icon' => 'lastfm' ],
        'meetup' => [ 'title' => 'Meetup', 'icon' => 'meetup' ],
        'paypal' => [ 'title' => 'PayPal', 'icon' => 'paypal' ],
        'quora' => [ 'title' => 'Quora', 'icon' => 'quora' ],
        'rss-2' => [ 'title' => 'RSS', 'icon' => 'rss' ],
        'scribd' => [ 'title' => 'Scribd', 'icon' => 'scribd' ],
        'skype' => [ 'title' => 'Skype', 'icon' => 'skype' ],
        'slack' => [ 'title' => 'Slack', 'icon' => 'slack' ],
        'slideshare' => [ 'title' => 'SlideShare', 'icon' => 'slideshare' ],
        'stack-exchange' => [ 'title' => 'Stack Exchange', 'icon' => 'stack-exchange' ],
        'stackoverflow' => [ 'title' => 'Stack Overflow', 'icon' => 'stack-overflow' ],
        'steam' => [ 'title' => 'Steam', 'icon' => 'steam' ],
        'wordpress' => [ 'title' => 'WordPress', 'icon' => 'wordpress' ],
        'wordpress-com' => [ 'title' => 'WordPress.com', 'icon' => 'wordpress' ],
        'yahoo' => [ 'title' => 'Yahoo!', 'icon' => 'yahoo' ],
        'stumbleupon' => [ 'title' => 'StumbleUpon', 'icon' => 'stumbleupon' ],
        'amazon' => [ 'title' => 'Amazon', 'icon' => 'amazon' ],
        'vine' => [ 'title' => 'Vine', 'icon' => 'vine' ],
        '500px' => [ 'title' => '500px', 'icon' => '500px' ],
        'vero' => [ 'title' => 'Vero', 'icon' => 'vero' ],
        'weibo' => [ 'title' => 'Weibo', 'icon' => 'weibo' ],
    ];
    
    return apply_filters( 'fox_social_data', $dt );
    
}
endif;

/**
 * return array of all possible social styles
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_social_style_support' ) ) :
function fox_social_style_support() {
    
    return [
        'plain' => 'Plain',
        'black' => 'Black',
        'outline' => 'Outline',
        'fill' => 'Fill',
        'text_color' => 'Brand Color',
        'color' => 'Brand Background',
    ];
    
}
endif;

/**
 * return array of all possible social styles
 * @since 4.3
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_social_size_support' ) ) :
function fox_social_size_support() {
    
    return [
        'small' => 'Small',
        'normal' => 'Normal',
        'bigger' => 'Normal+',
        'medium' => 'Medium',
        'medium_plus' => 'Medium+',
    ];
    
}
endif;

/**
 * social spacing
 * @since 4.7.1
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_social_spacing_support' ) ) :
function fox_social_spacing_support() {
    
    return [
        'small' => 'Small',
        'normal' => 'Normal',
        'big' => 'Big',
    ];
    
}
endif;

/**
 * Orderby array
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_orderby_support' ) ) :    
function fox_orderby_support() {
    
    return array(
        'date' => 'Date',
        'modified' => 'Updated Date',
        
        'view' => 'View count',
        'view_week' => 'View count (Weekly)',
        'view_month' => 'View count (Monthly)',
        'view_year' => 'View count (Yearly)',
        
        'title' => 'Post title',
        'rand' => 'Random',
        'comment_count' => 'Comment count',
        
        'review_score' => 'Review Score',
        'review_date' => 'Recent Review',
    );
    
}
endif;

/**
 * Order array
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_order_support' ) ) :    
function fox_order_support() {
    
    return array(
        'asc' => 'Ascending',
        'desc' => 'Descending',
    );
    
}
endif;

/**
 * Return array of translation stirngs
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_quick_translation_support') ) :
function fox_quick_translation_support() {
    
    $strings = array(
        'more'                  =>  esc_html__( 'More', 'wi' ),
        'more_link'             =>  esc_html__( 'Keep Reading', 'wi' ),
        'read_more'             =>  esc_html__( 'Read More', 'wi' ),
        'previous'              =>  esc_html__( 'Previous', 'wi' ),
        'next'                  =>  esc_html__( 'Next', 'wi' ),
        'next_story'            =>  esc_html__( 'Next Story', 'wi' ),
        'previous_story'        =>  esc_html__( 'Previous Story', 'wi' ),
        'search'                =>  esc_html__( 'Type & hit enter', 'wi' ),
        'author'                =>  esc_html__( 'by %s', 'wi' ),
        'date'                  =>  esc_html__( 'Published on', 'wi' ),
        'latest_posts'          =>  esc_html__( 'Latest posts', 'wi' ),
        'viewall'               =>  esc_html__( 'View all', 'wi' ),
        'latest'                =>  esc_html__( 'Latest from %s', 'wi' ),
        'go'                    =>  esc_html__( 'Go to', 'wi' ),
        'top'                   =>  esc_html__( 'Top', 'wi' ),
        
        'related'               =>  esc_html__( 'You might be interested in', 'wi' ),
        'tag_label'             =>  esc_html__( 'Tags:', 'wi' ),
        'share_label'           =>  esc_html__( 'Share this', 'wi' ),
        'start'                 =>  esc_html__( 'Start', 'wi' ),
        
        'mins_read'             =>  esc_html__( '%s mins read', 'wi' ), // 4.1.1
        'min_read'              =>  esc_html__( '1 min read', 'wi' ), // 4.1.1
        'views'                 =>  esc_html__( '%s views', 'wi' ), // 4.1.1
        'sponsored'             =>  esc_html__( 'Sponsored', 'wi' ), // since 4.2
        
        'suggestions'           =>  esc_html__( 'Suggestions', 'wi' ), // since 4.6.2
        
        'live' => esc_html__( 'Live', 'wi' ), // since 4.4
        'ago' => esc_html_x( '%s ago', '%s = human-readable time difference', 'wi' ), // since 4.6.3.1
        'justnow' => esc_html__( 'Just now', 'wi' ),
        
        'search_result' => esc_html__('Search result','wi'),
        'result_found' => esc_html__('%s result(s) found.','wi'), // since 4.4
        'browse_category' => esc_html__( 'Browse Category' , 'wi' ),
        'browse_tag' => esc_html__('Browse Tag','wi'),
        'browse_author' => esc_html__( 'Author','wi' ),
        'paged' => esc_html__( ' - Page %d','wi' ),
        
        // comment words
        'name' => esc_html__('Name','wi'),
        'email' => esc_html__('Email','wi'),
        'website' => esc_html__('Website','wi'),
        'write_comment' => esc_html__('Write your comment...','wi'),
        
        'post_comment' => esc_html__( 'Post Comment' ),
        'title_reply'          => '<span>' . esc_html__( 'Leave a Reply' ) . '</span>',
        'title_reply_to'          => esc_html__( 'Leave a Reply to %s' ),
        'cancel_reply' => esc_html__( 'Cancel reply' ),

        // review words
        'review' => esc_html__( 'Review', 'wi' ),
        'overall' => esc_html__( 'Overall', 'wi' ),

        // Dark/Light
        'light' => esc_html__( 'Light', 'wi' ),
        'dark' => esc_html__( 'Dark', 'wi' ),
        
    );
    
    foreach ( $strings as $k => $str ) {
        if ( function_exists( 'pll__' ) ) {
            $strings[ $k ] = pll__( $str );
        }
    }
    
    return apply_filters( 'fox_translation_strings', $strings );
    
}
endif;

/**
 * Single Elements
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_single_element_support' ) ) :
function fox_single_element_support() {
    
    return [
        'post_header' => 'Title area',
        'thumbnail' => 'Thumbnail',
        'share' => 'Share icon',
        'tag' => 'Tags',
        'related' => 'Related Posts',
        'authorbox' => 'Author Box',
        'comment' => 'Comment Area',
        'nav' => 'Post Navigation',
        'bottom_posts' => 'Bottom Posts',
        'side_dock' => 'Sliding-up Box',
    ];
    
}
endif;

/**
 * Primary Font Position
 * @since 4.0
------------------------------------------------------------------------------------ */
function fox_primary_font_support() {
    
    return [
        'body' => [
            'name' => 'Body Font',
        ],
        'heading' => [
            'name' => 'Heading Font',
        ],
        'nav' => [
            'name' => 'Navigation Font',
        ],
    ];
    
}

/**
 * return all possible font positions
 * and their values
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_all_font_support' ) ) :
function fox_all_font_support() {
    
    $return = [
        
        /* ---------------------     GENERAL    -------------------- */
        'body' => [
            
            'name' => 'Body Font',
            'std' => 'Helvetica Neue',
            'selector' => fox_body_selector(),
            'backend_selector' => '.wp-block-post-content',
            
            'primary' => true,
            
            'typo' => [
                
                'font-size' => '16',
                'font-size-phone' => '14',
                
                'font-weight' => '400',
                'font-style' => 'normal',
                'text-transform' => 'none',
                'letter-spacing' => '0',
                'line-height' => '1.8',
                
            ],
            
        ],
        
        'heading' => [
            'name' => 'Heading Font',
            'std' => 'Helvetica Neue',
            'selector' => fox_heading_selector(), // selector for font-family property
            'backend_selector' => 'h1, h2, h3, h4, h5, h6, .editor-post-title',
            
            'typo_selector' => 'h2, h1, h3, h4, h5, h6', // typo selector applies only for "real" heading elements
            
            'primary' => true,
            
            'typo' => [
                
                'font-weight' => '700',
                'font-style' => '',
                'text-transform' => 'none',
                'letter-spacing' => '',
                'line-height' => '1.3',
                
            ],
            
            'exclude' => [ 'size' ],
            
        ],
        
        'h2' => [
            'selector' => 'h2',
            'typo' => [
                'font-size' => '2.0625em',
            ],
            'include' => [ 'size' ],
        ],
        
        'h3' => [
            'selector' => 'h3',
            'typo' => [
                'font-size' => '1.625em',
            ],
            'include' => [ 'size' ],
        ],
        
        'h4' => [
            'selector' => 'h4',
            'typo' => [
                'font-size' => '1.25em',
            ],
            'include' => [ 'size' ],
        ],
        
        'logo' => [
            'name' => 'Logo Font',
            'std' => 'font_heading',
            'selector' => fox_logo_selector(),
            
            'primary' => true,
            
            'typo' => [
                
                'font-size' => '60',
                'font-size-tablet' => '40',
                'font-size-phone' => '20',
                'font-weight' => '400',
                'font-style' => 'normal',
                'text-transform' => 'uppercase',
                'letter-spacing' => '0',
                'line-height' => '1.1',
                
            ],
            
        ],
        
        'tagline' => [
            'name' => 'Tagline Font',
            'std' => 'font_heading',
            'selector' => '.slogan',
            
            'typo' => [
                
                'font-size' => '0.8125em',
                'font-weight' => '400',
                'font-style' => 'normal',
                'text-transform' => 'uppercase',
                'letter-spacing' => '6',
                'line-height' => '1.1',
                
            ],
            
        ],
        
        /* ---------------------     NAVIGATION    -------------------- */
        'nav' => [
            'name' => 'Navigation Font',
            'std' => 'Helvetica Neue',
            'selector' => fox_nav_selector(),
            
            'primary' => true,
            
            'typo' => [
                
                'font-size' => '16',
                'font-weight' => '',
                'font-style' => '',
                'text-transform' => 'none',
                'letter-spacing' => '0',
                'line-height' => '',
                
            ],
            
        ],
        
        'nav_submenu' => [
            'name' => 'Submenu Typography',
            'std' => 'font_nav',
            'selector' => fox_nav_submenu_selector(),
            'typo' => [
            ],
            
        ],
        
        /* ---------------------     BLOG    -------------------- */
        'post_title' => [
            'name' => 'Blog Post Title',
            'std' => 'font_heading',
            'selector' => '.post-item-title',
            'typo' => [
            ],
            'exclude' => [ 'size' ],
            
            'section' => 'design_blog',
            'section_title' => 'Blog',
        ],
        
        'post_meta' => [
            'name' => 'Post Item Meta',
            'std' => 'font_body',
            'selector' => '.post-item-meta',
            'typo' => [
            ],
        ],
        
        'standalone_category' => [
            'name' => 'Standalone meta category',
            'std' => 'font_heading',
            'selector' => '.standalone-categories',
            'typo' => [
            ],
            
        ],
        
        'archive_title' => [
            
            'name' => 'Archive Title',
            'std' => 'font_heading',
            'selector' => '.archive-title',
            'typo' => [
            ],
            
        ],
        
        /* ---------------------     SINGLE    -------------------- */
        'single_post_title' => [
            'name' => 'Single Post Title',
            'std' => 'font_heading',
            'selector' => '.single .post-item-title.post-title, .page-title',
            'backend_selector' => '.editor-post-title',
            'typo' => [
            ],
        ],
        
        'single_post_subtitle' => [
            'name' => 'Post Subtitle',
            'std' => 'font_body',
            'selector' => '.post-item-subtitle',
            'typo' => [
            ],
        ],
        
        'single_content' => [
            'name' => 'Single Post Content',
            'std' => 'font_body',
            'selector' => 'body.single:not(.elementor-page) .entry-content, body.page:not(.elementor-page) .entry-content',
            'backend_selector' => '.wp-block-post-content',
            'typo' => [
            ],
        ],
        
        'single_heading' => [
            'name' => 'Single Small Headings',
            'std' => 'font_heading',
            'selector' => '.single-heading',
            'typo' => [
                'font-size' => '1.5em',
                'font-weight' => '400',
                'font-style' => 'normal',
            ],
        ],
        
        /* ---------------------     OTHER ELEMENTS    -------------------- */
        'widget_title' => [
            'name' => 'Widget title',
            'std' => 'font_heading',
            'selector' => '.widget-title',
            'typo' => [
            ],
            
        ],
        
        // elementor for legacy from 4.2
        'elementor_heading' => [
            'name' => 'Builder Heading',
            'std' => 'font_heading',
            'selector' => '.section-heading h2, .fox-heading .heading-title-main',
            'typo' => [
            ],
            'exclude' => [ 'size' ],
        ],
        
        'button' => [
            'name' => 'Button',
            'std' => 'font_heading',
            'selector' => fox_btn_selector(),
            'typo' => [
            ],
            'exclude' => [ 'line-height' ],
        ],
        
        'input' => [
            'name' => 'Input',
            'std' => 'font_body',
            'selector' => fox_input_selector(),
            'typo' => [
            ],
            'exclude' => [ 'line-height' ],
        ],
        
        'blockquote' => [
            'name' => 'Blockquote',
            'std' => 'font_body',
            'selector' => 'blockquote',
            'typo' => [
            ],
            'exclude' => [ 'line-height' ],
        ],
        
        'dropcap' => [
            'selector' => fox_dropcap_selector(),
            'std' => 'font_body',
        ],
        
        'caption' => [
            'name' => 'Caption',
            'std' => 'font_body',
            'selector' => '.wp-caption-text, .post-thumbnail-standard figcaption, .wp-block-image figcaption, .blocks-gallery-caption',
            'typo' => [
            ],
            'exclude' => [],
        ],
        
        /* ---------------------     COPYRIGHT    -------------------- */
        'copyright' => [
            'name' => 'Copyright text',
            'std' => 'font_body',
            'selector' => '.footer-copyright',
            'typo' => [
            ],
            'exclude' => [],
        ],
        
        /* ---------------------     FOOTER NAV    -------------------- */
        'footernav' => [
            'name' => 'Footer Menu',
            'std' => 'font_nav',
            'selector' => '.footer-bottom .widget_nav_menu a, #footernav a',
            'typo' => [
                'text-transform' => 'uppercase',
                'letter-spacing' => '1px',
                'font-size' => '11px',
            ],
            'exclude' => [],
        ],
        
        /* ---------------------     MOBILE    -------------------- */
        'offcanvas_nav' => [
            'name' => 'Offcanvas Menu',
            'std' => 'font_nav',
            'selector' => '.offcanvas-nav',
            'exclude' => [ 'line-height' ],
        ],
        
    ];
    
    /**
     * turn it into "useable" form
     */
    $all_fields = [ 'size', 'weight', 'style', 'text-transform', 'letter-spacing', 'line-height' ];
    foreach ( $return as $id => $fontdata ) {
        
        // fields to include/exclude in typography
        $include = isset( $fontdata[ 'include' ] ) ? $fontdata[ 'include' ] : [];
        $exclude = isset( $fontdata[ 'exclude' ] ) ? $fontdata[ 'exclude' ] : [];
        $typo = isset( $fontdata[ 'typo' ] ) ? $fontdata[ 'typo' ] : [];
        
        if ( ! empty( $include ) ) {
            
            $fontdata[ 'fields' ] = $include;
            
        } elseif ( ! empty( $exclude ) ) {
            
            $fields = array_values( array_diff( $all_fields, $exclude ) );
            $fontdata[ 'fields' ] = $fields;
            
        } else {
            
            $fontdata[ 'fields' ] = $all_fields;
        
        }
        
        // typo default select values
        if ( ! isset( $typo[ 'font-style' ] ) ) {
            $typo[ 'font-style' ] = 'normal';
        }
        
        // and typo std value
        $typo = json_encode( $typo );
        $fontdata[ 'typo' ] = $typo;
        
        $return[ $id ] = $fontdata;
    
    }
    
    return $return;
    
}
endif;

/**
 * Box Element Support
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_all_box_elements_support' ) ) :
function fox_all_box_elements_support() {
    
    $return = [];
    
    $return[ 'logo' ] = [
        'selector' => '.fox-logo',
    ];    
    
    $return[ 'before_header' ] = [
        'selector' => '#before-header .container',
    ];
    
    $return[ 'after_header' ] = [
        'selector' => '#after-header .container',
    ];
    
    $return[ 'main_header' ] = [
        'selector'  => '#main-header .container',
    ];
    
    $return[ 'footer_sidebar' ] = [
        'selector'  => '#footer-widgets',
    ];
    
    $return[ 'footer_col' ] = [
        'selector'  => '.footer-col',
    ];
    
    $return[ 'footer_bottom' ] = [
        'selector'  => '#footer-bottom',
    ];
    
    $return[ 'titlebar' ] = [
        'selector' => '#titlebar .container',
    ];
    
    $return[ 'titlebar_outer' ] = [
        'selector' => '#titlebar',
    ];
    
    $return[ 'post_header' ] = [
        'selector' => '.single-header .container',
    ];
    
    /*
    @deprecated since 4.6
    $return[ 'single_heading' ] = [
        'selector' => '.single-authorbox-section, .related-heading, .comments-title, .comment-reply-title',
    ];
    */
    
    $return[ 'all' ] = [
        'selector' => '.wi-all',
    ];
    
    $return[ 'wrapper' ] = [
        'selector'  => 'body.layout-boxed .wi-wrapper, body.layout-wide',
    ];
    
    $return[ 'nav_submenu' ] = [
        'selector'  => '.wi-mainnav ul.menu ul',
    ];
    
    $return[ 'nav_submenu_item' ] = [
        'selector'  => '.wi-mainnav ul.menu ul a',
    ];
    
    $return[ 'widget_title' ] = [
        'selector'  => '.widget-title',
    ];
    
    $return[ 'input' ] = [
        'selector'  => fox_input_selector(),
    ];
    
    $return[ 'blockquote' ] = [
        'selector'  => 'blockquote',
    ];
    
    return $return;
    
}
endif;

/**
 * Background Element Support
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_all_background_elements_support' ) ) :
function fox_all_background_elements_support() {
    
    $return = [];
    
    $return[ 'body' ] = [
        'selector' => 'body.layout-boxed',
    ];
    
    $return[ 'footer_sidebar' ] = [
        'selector' => '#footer-widgets',
    ];
    
    $return[ 'footer_bottom' ] = [
        'selector' => '#footer-bottom',
    ];
    
    $return[ 'offcanvas' ] = [
        'selector' => '#offcanvas-bg',
    ];
    
    return $return;
    
}
endif;

/**
 * Slider Navigation Style List
 * @since 4.6
------------------------------------------------------------------------------------ */
function fox_slider_nav_style_support() {
    
    return [
        'circle-1',
        'square-1',
        'square-2',
        'square-3',
        'text',
    ];
    
}

/**
 * Blog Components Support
 * @since 4.6.6
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_column_support' ) ) :
function fox_column_support() {
    return [
        '1' => '1 column',
        '2' => '2 columns',
        '3' => '3 columns',
        '4' => '4 columns',
        '5' => '5 columns',
        '6' => '6 columns',
    ];
}
endif;

if ( ! function_exists( 'fox_thumbnail_showing_effect_support' ) ) :
function fox_thumbnail_showing_effect_support() {
    
    return [
        'none'      => 'None',
        'fade'      => 'Image Fade',
        'slide'     => 'Slide',
        'popup'     => 'Pop up',
        'zoomin'    => 'Zoom In',
    ];
    
}
endif;

if ( ! function_exists( 'fox_card_style_support' ) ) :
function fox_card_style_support() {
    
    return [
        'none' => 'None',
        'normal' => 'Normal',
        'normal_no_shadow' => 'Normal + no shadow',
        'overlap' => 'Text Overlaps Image',
        'overlap_no_shadow' => 'Overlap + no shadow',
    ];
    
}
endif;

if ( ! function_exists( 'fox_item_spacing_support' ) ) :
function fox_item_spacing_support() {
    
    return [
        'none' => 'No spacing',
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'wide' => 'Wide',
        'wider' => 'Wider',
    ];
    
}
endif;

if ( ! function_exists( 'fox_list_spacing_support' ) ) :
function fox_list_spacing_support() {
    
    return [
        'none' => 'No Spacing',
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
        'large' => 'Large',
    ];
    
}
endif;

if ( ! function_exists( 'fox_item_template_support' ) ) :
function fox_item_template_support() {
    
    return [
        '1' => 'Title > Meta > Excerpt',
        '2' => 'Meta > Title > Excerpt',
        '3' => 'Title > Excerpt > Meta',

        '4' => 'Category > Title > Meta > Excerpt',
        '5' => 'Category > Title > Excerpt > Meta',
    ];
    
}
endif;

if ( ! function_exists( 'fox_thumbnail_support' ) ) :
function fox_thumbnail_support() {
    
    return [
        'thumbnail' => 'Thumbnail (150x150)',
        
        'landscape' => 'Medium crop (480x384)',
        'square' => 'Square crop (480x480)',
        'portrait' => 'Portrait crop (480x600)',
        'thumbnail-large' => 'Large crop (720x480)',
        
        'medium' => 'Medium (no crop)',
        'large' => 'Large (no crop)',

        'original' => 'Original ratio (Fullwidth)',
        'original_fixed' => 'Original ratio (Fixed height)',
        'custom' => 'Custom',
    ];
    
}
endif;

if ( ! function_exists( 'fox_basic_thumbnail_support' ) ) :
/**
 * since 4.6.9
 */
function fox_basic_thumbnail_support() {
    
    return [
        'thumbnail'  => 'Thumbnail 150x150',
        'medium' => 'Medium',
        'landscape'  => 'Landscape 480x384',
        'square'  => 'Square 480x480',
        'portrait'  => 'Portrait 480x600',
        'thumbnail-large'  => 'Wide 720x480',
        'large'  => 'Large (original ratio)',
        'full' => 'Full (original ratio)'
    ];
    
}
endif;

if ( ! function_exists( 'fox_thumbnail_position_support' ) ) :
function fox_thumbnail_position_support() {
    
    return [
        'left' => 'Left',
        'right' => 'Right',
        'alternative' => 'Alternative',
    ];
    
}
endif;    

if ( ! function_exists( 'fox_thumbnail_shape_support' ) ) :
function fox_thumbnail_shape_support() {
    
    return [
        'acute'     => 'Acute',
        'round'     => 'Round',
        'circle'    => 'Circle',
    ];
    
}
endif;

if ( ! function_exists( 'fox_thumbnail_hover_support' ) ) :
function fox_thumbnail_hover_support() {
    
    return [
        'none'      => 'None',
        'fade'      => 'Image Fade',
        'grayscale' => 'Grayscale',
        'sepia'     => 'Sepia',
        'dark'      => 'Dark',
        'letter'    => 'Title First Letter',
        'zoomin'    => 'Image Zoom In',
        'logo'      => 'Custom Logo',
    ];
    
}
endif;

if ( ! function_exists( 'fox_title_tag_support' ) ) :
function fox_title_tag_support() {
    
    return [
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
    ];
    
}
endif;

if ( ! function_exists( 'fox_title_size_support' ) ) :
function fox_title_size_support() {
    
    return [
        'supertiny' => 'Super Tiny',
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
        'large' => 'Large',
    ];
    
}
endif;

if ( ! function_exists( 'fox_title_weight_support' ) ) :
function fox_title_weight_support() {
    
    return [
        '' => 'Default',
        '300' => 'Light',
        '400' => 'Normal',
        '700' => 'Bold',
        '900' => 'Heavy',
    ];
    
}
endif;

if ( ! function_exists( 'fox_title_transform_support' ) ) :
function fox_title_transform_support() {
    
    return [
        '' => 'Default',
        'none' => 'None',
        'lowercase' => 'lowercase',
        'uppercase' => 'UPPERCASE',
        'capitalize' => 'Capitalize',
    ];
    
}
endif;

if ( ! function_exists( 'fox_excerpt_size_support' ) ) :
function fox_excerpt_size_support() {
    
    return [
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
    ];
    
}
endif;

if ( ! function_exists( 'fox_excerpt_more_style_support' ) ) :
function fox_excerpt_more_style_support() {
    
    return [
        'simple' => 'Plain Link',
        'simple-btn' => 'Minimal Link', // simple button
        'btn' => 'Fill Button', // default btn
        'btn-black' => 'Solid Black Button',
        'btn-primary' => 'Primary Button',
    ];
    
}
endif;

if ( ! function_exists( 'fox_list_sep_style_support' ) ) :
function fox_list_sep_style_support() {
    
    return [
        'solid' => 'Solid',
        'dashed' => 'Dashed',
        'dotted' => 'Dotted',
    ];
    
}
endif;

if ( ! function_exists( 'fox_group1_ratio_support' ) ) :
function fox_group1_ratio_support() {
    
    return [
        '1/2' => '1/2',
        '2/3' => '2/3',
        '3/4' => '3/4',
    ];
    
}
endif;

if ( ! function_exists( 'fox_group_spacing_support' ) ) :
function fox_group_spacing_support() {
    
    return [
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
    ];
    
}
endif;