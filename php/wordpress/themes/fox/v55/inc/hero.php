<?php
/**
 * abstract: template tags of hero posts (ie. layout 4, 5)
 * hooks related to single hero posts
 */

/**
 * return full / half / false (if not hero post)
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
function fox_hero_type() {
    
    if ( is_single() ) {
        $style = fox_get_single_option( 'style' );
    } elseif ( is_page() ) {
        $style = fox_get_page_option( 'style' );
    } else {
        return false;
    }
    
    if ( 4 == $style ) return 'full';
    elseif ( 5 == $style ) return 'half';
    else return false;
    
}

/**
 * is hero or not, return true/false
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_is_hero' ) ) :
function fox_is_hero() {
    
    if ( is_single() ) {
        if ( function_exists('fox_framework_single_block_id') && fox_framework_single_block_id()) {
            return false;
        }
    } elseif ( is_page() ) {
        if ( function_exists('fox_framework_page_block_id') && fox_framework_page_block_id() ) {
            return false;
        }
    }
    
    return is_singular() && ( false !== fox_hero_type() );
    
}
endif;

/**
 * check whether this page should display minimal header or not
 * @since 4.6
 * ------------------------------------------------------------------------------------------------ */
function fox_is_minimal_header() {
    
    return ( 'minimal' == get_theme_mod( 'wi_single_hero_header', 'minimal' ) && fox_is_hero() );
    
}

/**
 * disable header for hero posts in case we use minimal header
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_filter( 'fox_show_header', 'fox_disable_header_hero', 10 );
function fox_disable_header_hero( $show ) {
    
    if ( fox_is_minimal_header() ) return false;
    return $show;
        
}

/**
 * display a minimal header for hero posts
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_action( 'fox_wrapper', 'fox_display_hero_min_header', 10 );
function fox_display_hero_min_header() {
    
    if ( ! fox_is_minimal_header() ) return;
    get_template_part( 'parts/header', 'min' );
    
}

/**
 * hero content after body
 * in case we use minimal header
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_action( 'fox_after_body', 'fox_hero_content_init' );
function fox_hero_content_init() {
    
    if ( ! fox_is_minimal_header() ) return; // we only use this hero type for minimal header
    
    $hero_type = fox_hero_type();
    
    if ( 'full' == $hero_type ) {
        fox_hero_full();
    } elseif ( 'half' == $hero_type ) {
        fox_hero_half();
    }
    
}

/**
 * scroll btn html
 * @since 4.3
 * ------------------------------------------------------------------------------------------------ */
function fox_hero_scroll_btn() {
    
    if ( 'true' != get_theme_mod( 'wi_single_hero_scroll', 'false' ) ) {
        return;
    }
    
    if ( 'arrow' != get_theme_mod( 'wi_single_hero_scroll_style', 'arrow' ) ) {
        return;
    }
    
    ?>
    <a href="#" class="scroll-down-btn scroll-down-btn-arrow">
        <span><?php echo fox_word( 'start' ); ?></span>
        <i class="feather-chevron-down"></i>
    </a>
    <?php
}

/**
 * hero full
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_hero_full' ) ) :
function fox_hero_full() {
    
    $cl = [ 'hero-full hero-section single-big-section' ];
    
    $hero_full_text_layout = get_theme_mod( 'wi_single_hero_full_text_layout', 'bottom-left' );
    if ( ! in_array( $hero_full_text_layout, [ 'center', 'bottom-center' ] ) ) {
        $hero_full_text_layout = 'bottom-left';
    }
    $cl[] = 'hero-text--' . $hero_full_text_layout;

?>

<div id="masthead-mobile-height"></div>
<div id="hero" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        
    <div class="hero-background">

        <?php fox_thumbnail([
        
           'thumbnail' => 'full',
            'thumbnail_extra_class' => 'hero-thumbnail hero-full-thumbnail',
            'thumbnail_link' => false,
        
            'thumbnail_format_indicator' => false,
            'thumbnail_view' => false,
            'thumbnail_index' => false,
            'thumbnail_review_score' => false,
        
            'thumbnail_placeholder' => true,
            'thumbnail_caption' => true,
            'thumbnail_shape' => 'acute',
        
            'thumbnail_hover' => 'none',
            'thumbnail_showing_effect' => 'none',
        
            'custom_blog_thumbnail' => false,
        ]); ?>

    </div><!-- .hero-background -->

    <div class="hero-content">

        <?php fox_hero_header(); ?>

    </div><!-- .hero-content -->
    
    <div class="hero-overlay"></div>
    
    <?php fox_hero_scroll_btn(); ?>

</div><!-- #hero -->

<?php }
endif;

/**
 * hero half
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_hero_half' ) ) :
function fox_hero_half() {
    
    $class = [
        'hero-half',
        'hero-section',
        'single-big-section',
    ];
    
    ?>

<div id="masthead-mobile-height"></div>
<div id="hero" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
    <div class="hero-background">
        
        <?php fox_thumbnail([
            'thumbnail' => 'full',
            'thumbnail_extra_class' => 'hero-thumbnail hero-half-thumbnail',
            'thumbnail_link' => false,
        
            'thumbnail_format_indicator' => false,
            'thumbnail_view' => false,
            'thumbnail_index' => false,
            'thumbnail_review_score' => false,
        
            'thumbnail_hover' => 'none',
            'thumbnail_placeholder' => true,
            'thumbnail_caption' => true,
            'thumbnail_shape' => 'acute',
            'thumbnail_showing_effect' => 'none',
        
            'custom_blog_thumbnail' => false,
        ]); ?>

    </div><!-- .hero-background -->

    <div class="hero-content">
        
        <?php fox_hero_header(); ?>
        <?php fox_hero_scroll_btn(); ?>

    </div><!-- .hero-content -->

</div><!-- #hero -->

<?php }
endif;

/**
 * Single Hero Header
 * @since 4.5
 * ------------------------------------------------------------------------------------------------ */
function fox_hero_header() {
    
    $components = get_theme_mod( 'wi_single_hero_meta_1_elements', 'category' );
    if ( ! is_array( $components ) ) {
        $components = explode( ',', $components );
        $components = array_map( 'trim', $components );
    }
    
    // since 4.6
    $subtitle_position = get_theme_mod( 'wi_subtitle_position', 'after_title' );
    
    ?>
<div class="hero-header">
    
    <div class="container">
        
        <div class="hero-main-header narrow-area">
    
            <?php
    
            do_action( 'fox_hero_header_before' );
                
            if ( in_array( 'category', $components ) ) {

                    fox_post_categories([
                        'extra_class' => 'standalone-categories hero-meta-categories',
                        'style' => get_theme_mod( 'wi_single_hero_meta_1_category_style', 'plain' ),
                    ]);

            }
    
            echo fox_format( '<h1 class="post-title post-item-title hero-title">{}</h1>', get_the_title() );
    
            if ( 'after_title' == $subtitle_position ) {
                echo '<div class="header-subtitle">';
                echo fox_get_subtitle();
                echo '</div>';
            }
    
            fox_post_meta([
                'category_show' => false,
                'date_show' => in_array( 'date', $components ),

                'author_show' => in_array( 'author', $components ),
                'author_avatar_show' => in_array( 'author_avatar', $components ),
                'view_show' => in_array( 'view', $components ),
                'comment_link_show' => in_array( 'comment', $components ),
                'reading_time_show' => in_array( 'reading', $components ),

                'meta_extra_class' => 'hero-meta-1',
            ]);
    
            if ( 'true' == get_theme_mod( 'wi_single_hero_scroll', 'false' ) && 'arrow' != get_theme_mod( 'wi_single_hero_scroll_style', 'arrow' ) ) {
            $btn_style = get_theme_mod( 'wi_single_hero_scroll_style', 'arrow' );
            ?>
            
            <div class="hero-scrolldown-button">
                
                <a href="#" class="scroll-down-btn fox-btn <?php echo esc_attr( $btn_style ); ?>">
                    <?php echo get_theme_mod( 'wi_single_hero_scroll_btn_text', 'Start Reading' ); ?>
                    <i class="fa fa-angle-down"></i>
                </a>
            
            </div>
                
            <?php } ?>
            
        </div><!-- .narrow-area -->
        
    </div><!-- .container -->
        
</div><!-- .hero-header -->
    <?php 
}

/**
 * add post-hero class into body class
 * @since 4.0
 * ------------------------------------------------------------------------------------------------ */
add_action( 'body_class', 'fox_add_hero_body_class' );
function fox_add_hero_body_class( $classes ) {
    
    if ( ! is_singular() ) return $classes;
    
    $type = fox_hero_type();
    
    if ( 'full' == $type ) {
        
        $classes[] = 'post-hero post-hero-full';
        
    } elseif ( 'half' == $type ) {
        
        $classes[] = 'post-hero post-hero-half';
        
        // since 4.3
        $skin = get_post_meta( get_the_ID(), '_wi_hero_half_skin', true );
        if ( ! $skin ) {
            $skin = get_theme_mod( 'wi_single_hero_half_skin', 'light' );
        }
        if ( 'dark' != $skin ) {
            $skin = 'light';
        }

        $classes[] = 'post-hero-half-' . $skin;
        
    } else {
        
        return $classes;
        
    }
    
    /**
     * narrow problem
     */
    $content_width = fox_get_single_option( 'content_width', 'full' );
    if ( 'narrow' == $content_width ) {
        $classes[] = 'post-content-narrow';
    }
    
    return $classes;
    
}