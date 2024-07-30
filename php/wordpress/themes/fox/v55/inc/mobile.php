<?php
/**
 * Off-canvas Menu
 * @since 4.0
------------------------------------------------------------------------------------ */
add_action( 'wp_footer', 'fox_offcanvas', 0 );
function fox_offcanvas() {
    
    // if ( ! apply_filters( 'fox_show_header', true ) ) return;
    $class = [
        'offcanvas',
    ];
    
    // skin
    $skin = get_theme_mod( 'wi_offcanvas_skin', 'light' );
    if ( 'dark' != $skin ) $skin = 'light';
    $class[] = 'offcanvas-' . $skin;
    
    // border
    // since 4.3
    $has_border = 'true' == get_theme_mod( 'wi_offcanvas_nav_border', 'false' );
    if ( $has_border ) {
        $class[] = 'offcanvas-style-has-border';
    }
?>

<div id="offcanvas" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

    <div class="offcanvas-inner">
        
        <?php do_action( 'fox_offcanvas_start' ); // since 4.0 ?>
        
        <?php /* ----------------------------   SEARCH ---------------------------- */ ?>
        <?php if ( 'true' == get_theme_mod( 'wi_offcanvas_search', 'true' ) ) { ?>
        
        <div class="offcanvas-search offcanvas-element">
            <?php get_search_form(); ?>
        </div>
        
        <?php } ?>
        
        <?php /* ----------------------------   MOBILE NAV ---------------------------- */ ?>
        <?php
    $cached_value = false; // get_transient( 'fox_mobile_menu' );
    if ( ! $cached_value ) {
        ob_start();
        if ( has_nav_menu( 'mobile' ) ) {
                $location = 'mobile'; 
            } elseif ( has_nav_menu( 'primary' ) ) { $location = 'primary'; } else { $location = ''; }
        
        ?>

            <?php if ( $location == 'mobile' ) { ?>
            <nav id="mobilenav" class="offcanvas-nav offcanvas-element">

                <?php wp_nav_menu(array(
                    'theme_location'	=>	$location,
                    'depth'				=>	4,
                    'container_class'	=>	'menu',
                    // 'after' => '<span class="indicator"><i class="indicator-ic"></i></span>',
                ));?>

            </nav><!-- #mobilenav -->
            <?php } else if ( $location == 'primary' ) { // get it from cache ?>

                <?php $menu_html = wp_cache_get( 'primary_menu', 'fox_theme' );
                if ( $menu_html ) {
                    echo $menu_html;
                } else { ?>
        
            <nav id="mobilenav" class="offcanvas-nav offcanvas-element">

                <?php wp_nav_menu(array(
                    'theme_location'	=>	$location,
                    'depth'				=>	4,
                    'container_class'	=>	'menu',
                    // 'after' => '<span class="indicator"><i class="indicator-ic"></i></span>',
                ));?>

            </nav><!-- #mobilenav -->
                    
                <?php }
            ?>
        
        <?php }
        
        $cached_value = ob_get_clean();
        // set_transient( 'fox_mobile_menu' ,$cached_value, DAY_IN_SECONDS );
    }
    echo $cached_value; ?>
        
        <?php /* ----------------------------   SOCIAL ---------------------------- */ ?>
        <?php if ( 'true' == get_theme_mod( 'wi_offcanvas_social', 'true' ) ) { ?>
        
        <?php fox_social_icons([
        
            'style' => get_theme_mod( 'wi_offcanvas_social_style', 'plain' ),
            'shape' => get_theme_mod( 'wi_offcanvas_social_shape', 'circle' ),
            'size' => get_theme_mod( 'wi_offcanvas_social_size', 'bigger' ),
            'spacing' => get_theme_mod( 'wi_offcanvas_social_spacing', 'small' ),
        
            'align' => 'left',
        
            'extra_class' => 'offcanvas-element',
        ]); ?>
        
        <?php } ?>
        
        <?php do_action( 'fox_offcanvas_end' ); // since 4.0 ?>
    
    </div><!-- .offcanvas-inner -->

</div><!-- #offcanvas -->

<div id="offcanvas-bg" class="offcanvas-bg"></div>
<div class="offcanvas-overlay" id="offcanvas-overlay"></div>

<?php
    
}

add_action( 'fox_offcanvas_start', 'fox_add_offcanvas_widgets_start' );
add_action( 'fox_offcanvas_end', 'fox_add_offcanvas_widgets_end' );
function fox_add_offcanvas_widgets_start() {
    
    $offcanvas_widgets_position = get_theme_mod( 'wi_offcanvas_widgets_position', 'after' );
    if ( 'before' != $offcanvas_widgets_position ) {
        $offcanvas_widgets_position = 'after';
    }
    if ( 'before' != $offcanvas_widgets_position ) {
        return;
    }
    
    fox_add_offcanvas_widgets( 'before' );
    
}
function fox_add_offcanvas_widgets_end() {
    
    $offcanvas_widgets_position = get_theme_mod( 'wi_offcanvas_widgets_position', 'after' );
    if ( 'before' != $offcanvas_widgets_position ) {
        $offcanvas_widgets_position = 'after';
    }
    if ( 'after' != $offcanvas_widgets_position ) {
        return;
    }
    
    fox_add_offcanvas_widgets( 'after' );
    
}

function fox_add_offcanvas_widgets( $position = 'after' ) {
    
    if ( ! is_active_sidebar( 'off-canvas' ) ) {
        return;
    }
    
    if ( 'before' != $position ) {
        $position = 'after';
    } 
    
    $classes = [ 'offcanvas-sidebar' ];
    $classes[] = 'offcanvas-sidebar-' . $position;
    
?>

<div class="<?php echo esc_attr( join( ' ', $classes ) ); ?>">

    <?php dynamic_sidebar( 'off-canvas' ); ?>
    
</div><!-- .offcanvas-sidebar -->
<?php
    
}

/**
 * Mobile Logo
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_mobile_logo' ) ) :
function fox_mobile_logo() {
    
    $logo_type = get_theme_mod( 'wi_logo_type', 'text' );
    if ( 'image' != $logo_type ) $logo_type = 'text';
    
    $url = get_theme_mod( 'wi_logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }
    ?>

<h4 id="mobile-logo" class="mobile-logo mobile-logo-<?php echo esc_attr( $logo_type ); ?>">
    
    <a href="<?php echo esc_url( $url ); ?>" rel="home">

        <?php if ( 'text' == $logo_type ) { ?>

        <span class="text-logo"><?php bloginfo( 'title' ); ?></span>

        <?php } else {
        
        $logo_html = '';
        $logo_url = get_theme_mod( 'wi_mobile_logo' );
        if ( ! $logo_url ) {
            $logo_url = get_theme_mod( 'wi_logo' );
        }
        
        if ( $logo_url ) {
            $logo_id = attachment_url_to_postid( $logo_url );
            if ( $logo_id ) {
                $logo_html = wp_get_attachment_image( $logo_id, 'full' );
            }
        } else {
            $logo_url = get_template_directory_uri() . '/images/logo.png';
        }
        if ( ! $logo_html ) {
            $logo_html = '<img src="' . esc_url( $logo_url ) .'" alt="' . esc_html__( 'Logo', 'wi' ) . '" />';
        }
        
        ?>
        
        <?php if ( fox_is_transparent_header() ) {
            
            $transparent_logo_url = get_theme_mod( 'wi_transparent_mobile_logo' );
            if ( ! $transparent_logo_url ) {
                $transparent_logo_url = get_theme_mod( 'wi_transparent_logo' );
            }
            $transparent_logo_html = '';
            if ( $transparent_logo_url ) {
                $transparent_logo_id = attachment_url_to_postid( $transparent_logo_url );
                if ( $transparent_logo_id ) {
                    $transparent_logo_html = wp_get_attachment_image( $transparent_logo_id, 'full', false, [ 'class' => 'transparent-img-logo' ] );
                }
                $transparent_logo_html = '<img src="' . esc_url ( $transparent_logo_url ) . '" class="transparent-img-logo" alt="Transparent Logo" />';
            }
            
            if ( $transparent_logo_html ) {
                echo $transparent_logo_html;
            }
            
        } ?>

        <?php echo $logo_html; ?>

        <?php } ?>

    </a>
    
</h4><!-- .mobile-logo -->

    <?php
    
}
endif;

/**
 * Hamburger Button
 * custom hamburger image since 4.7.1
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_hamburger_btn' ) ) :
function fox_hamburger_btn() { ?>

    <span class="toggle-menu hamburger hamburger-btn">
        <?php echo fox_icon_hamburger(); ?>
        <?php echo fox_icon_offcanvas_close(); ?>
    </span>

<?php    
}
endif;

/**
 * Header Mobile
 * @since 4.0
------------------------------------------------------------------------------------ */
add_action( 'fox_after_masthead', 'fox_header_mobile', 0 );
if ( ! function_exists( 'fox_header_mobile' ) ) :
function fox_header_mobile() {
    
    if ( ! apply_filters( 'fox_show_mobile_header', true ) ) {
        return;
    }
    
    $class = [ 'masthead-mobile' ];
    
    ?>

<div id="masthead-mobile" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <div class="container">
        
        <div class="masthead-mobile-left masthead-mobile-part">
            
            <?php fox_hamburger_btn(); ?>
            
            <?php do_action( 'fox_header_mobile_left' ); // since 4.0 ?>
            
        </div><!-- .masthead-mobile-part -->
    
        <?php fox_mobile_logo(); ?>
        
        <div class="masthead-mobile-right masthead-mobile-part">
        
            <?php do_action( 'fox_header_mobile_right' ); // since 4.0 ?>
            
        </div><!-- .masthead-mobile-part -->
    
    </div><!-- .container -->
    
    <div class="masthead-mobile-bg"></div>

</div><!-- #masthead-mobile -->
    
    <?php
}
endif;

/* header mobile static
 * @since 4.7
------------------------------------------------------------------------------------ */
add_filter( 'body_class', 'fox_header_mobile_scroll_class' );
function fox_header_mobile_scroll_class( $class ) {
    
    $mobile_header_scroll = get_theme_mod( 'wi_mobile_header_scroll', 'fixed' );
    if ( 'static' != $mobile_header_scroll ) {
        $mobile_header_scroll = 'fixed';
    }
    
    $class[] = 'masthead-mobile-' . $mobile_header_scroll;
    
    return $class;
    
}