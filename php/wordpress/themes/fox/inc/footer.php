<?php
/* FOOTER
=============================================================== */
function fox56_footer() {

    // since 4.0
    if ( ! apply_filters( 'fox_show_footer', true ) ) {
        return;
    }

    $block_id = function_exists( 'fox_framework_footer_block_id' ) ? fox_framework_footer_block_id() : false;
    if ( $block_id && function_exists( 'fox_block' ) ) { ?>

    <footer class="site-footer footer-elementor">
        <div class="footer-builder-container">
        
        <?php
            fox_block( $block_id );
        ?>
        </div><!-- .footer-builder-container -->
    </footer>
        
    <?php
        return;
    }
    ?>

    <footer id="wi-footer" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        
        <?php if ( is_active_sidebar( 'footer-instagram' ) ) { ?>
        <aside id="footer-instagram" class="footer-section">
            <?php dynamic_sidebar( 'footer-instagram' ); ?>
        </aside>
        <?php } ?>
        
        <?php if ( is_active_sidebar( 'footer-newsletter' ) ) { ?>
        <aside id="footer-newsletter" class="footer-section">
            <?php dynamic_sidebar( 'footer-newsletter' ); ?>
        </aside>
        <?php } ?>
        
        <?php fox56_footer_sidebar(); ?>
        <?php fox56_footer_bottom(); ?>

    </footer>

<?php 
}

/* FOOTER SIDEBAR
=============================================================== */
function fox56_footer_sidebar() { ?>
    <div id="footer-sidebar-placement">
        <?php echo fox56_footer_sidebar_inner(); ?>
    </div>
    <?php
}
function fox56_footer_sidebar_inner() {

    if ( ! get_theme_mod( 'footer_sidebar', true ) ) {
        return;
    }

    // no footer sidebar active
    if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) && ! is_active_sidebar( 'footer-4' ) ) {
        return;
    }

    ob_start();

    /* ---------------------------------        layout */
    $layout = get_theme_mod( 'footer_sidebar_layout', '1-1-1-1' );
    $explode = explode( '-', $layout );
    $max_col = count( $explode );

    if ( $max_col > 4 || $max_col < 1 ) {
        $max_col = 4;
    }
    $cols = 0;
    foreach ( $explode as $col ) {
        $cols += absint( $col );
    }
    $cl = [
        'footer-widgets',
        'footer-sidebar',
        'footer_sidebar56',
    ];
    $cl[] = 'footer-sidebar-' . $layout;

    /* ---------------------------------        skin */
    $skin = get_theme_mod( 'footer_sidebar_skin', 'light' ); 
    if ( 'dark' != $skin ) $skin = 'light';
    $cl[] = 'skin--' . $skin;

    /* ---------------------------------        stretch */
    $stretch = get_theme_mod( 'footer_sidebar_stretch', 'content' );
    if ( 'full' != $stretch ) $stretch = 'content';
    $cl[] = 'stretch--' . $stretch;

    /* ---------------------------------        valign - since 4.3 */
    $valign = get_theme_mod( 'footer_sidebar_valign', 'stretch' );
    if ( 'top' != $valign && 'middle' != $valign && 'bottom' != $valign ) {
        $valign = 'stretch';
    }
    $cl[] = 'valign--' . $valign;

    /* ---------------------------------        sep between cols */
    $footer_sidebar_sep = get_theme_mod( 'footer_sidebar_sep', false );
?>

<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">

    <div class="container">

        <div class="row footer56__row">

            <?php for ( $i = 1; $i <= $max_col; $i ++ ) : $col_class = [ 'widget-area', 'footer56__col' ];

                if ( $cols == 4 && $explode[ $i - 1 ] == 2 ) {
                    $col = '1-2';
                } else {
                    $col = $explode[ $i - 1 ] . '-' . $cols;
                }
                $col_class[] = 'col-' . $col;
            
                // align, since 4.4
                $align = get_theme_mod( 'footer_' . $i . '_align' );
                if ( in_array( $align, [ 'left', 'right', 'center' ] ) ) {
                    $col_class[] = 'footer__col--' . $align;
                }
            ?>

            <aside class="<?php echo esc_attr( join( ' ', $col_class ) ); ?>">

                <?php 
                if ( is_active_sidebar( 'footer-' . $i ) ) {
                    
                    echo '<div class="footer__col__inner">';

                    dynamic_sidebar( 'footer-' . $i );
                    
                    echo '</div>';

                } ?>

                <?php if ( $footer_sidebar_sep ) { ?>
                <div class="footer56__col__sep"></div>
                <?php } ?>

            </aside><!-- .footer-col -->

            <?php endfor; // for $i ?>

        </div><!-- .footer-widgets-inner -->

    </div><!-- .container -->

</div><!-- #footer-widgets -->

<?php 
    return ob_get_clean();
}

/* FOOTER BOTTOM
footer bottom builder - deprecated56
=============================================================== */
function fox56_footer_bottom() { ?>
<div id="footer-bottom-placement">
    <?php echo fox56_footer_bottom_inner(); ?>
</div>
<?php }

function fox56_footer_bottom_inner() {

    if ( ! get_theme_mod( 'footer_bottom', true ) ) {
        return;
    }

    ob_start();

    $cl = [
        'footer_bottom56',
        'footer-bottom',
        'classic-footer-bottom'
    ];

    /* ---------------------------------        stretch */
    $stretch = get_theme_mod( 'footer_bottom_stretch', 'content' );
    if ( 'full' != $stretch ) $stretch = 'content';
    $cl[] = 'stretch--' . $stretch;

    /* ---------------------------------        skin */
    $skin = get_theme_mod( 'footer_bottom_skin', 'light' );
    if ( 'dark' != $skin ) $skin = 'light';
    $cl[] = 'skin--' . $skin;

    /* ---------------------------------        layout */
    $layout = get_theme_mod( 'footer_bottom_layout', 'stack' );
    if ( ! in_array( $layout, [ 'inline' ] ) ) {
        $layout = 'stack';
    }
    $cl[] = 'classic-footer-bottom-' . $layout;
    $cl[] = 'footer_bottom--' . $layout;

    /* ---------------------------------        elements map */
    $map = [
        'logo' => 'fox56_footer_logo_inner',
        'social' => 'fox56_footer_social_inner',
        'search' => 'fox56_footer_search_inner',
        'nav' => 'fox56_footer_nav_inner',
        'copyright' => 'fox56_footer_copyright_inner',
        'html1' => 'fox56_footer_html1_inner',
        'html2' => 'fox56_footer_html2_inner',
    ];
?>

<div role="contentinfo" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">

    <div class="container">

        <?php 
        /* ----------------     FOOTER STACK    ---------------- */
        if ( 'stack' === $layout ) {
            $elements = get_theme_mod( 'footer_stack_elements', [ 'logo', 'social', 'search', 'copyright', 'nav' ] );
            foreach ( $elements as $ele ) {
                $func = isset( $map[ $ele ] ) ? $map[ $ele ] : false;
                if ( ! $func ) {
                    continue;
                } ?>
                <div class="footer56__element footer56__element--<?php echo esc_attr( $ele ); ?> footer56__<?php echo esc_attr( $ele ); ?>">
                    <?php echo call_user_func( $func ); ?>
                </div>
            <?php }

        /* ----------------     FOOTER INLINE    ---------------- */    
        } else { ?>

        <div class="footer_bottom__row row">

            <div class="footer_bottom__col footer_bottom__col--left col col-1-2">
                <?php
                $elements = get_theme_mod( 'footer_left_elements', [ 'logo', 'copyright' ] );
                foreach ( $elements as $ele ) {
                    $func = isset( $map[ $ele ] ) ? $map[ $ele ] : false;
                    if ( ! $func ) {
                        continue;
                    } ?>
                    <div class="footer56__element footer56__element--<?php echo esc_attr( $ele ); ?> footer56__<?php echo esc_attr( $ele ); ?>">
                        <?php echo call_user_func( $func ); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="footer_bottom__col footer_bottom__col--right col col-1-2">
                <?php
                $elements = get_theme_mod( 'footer_right_elements', [ 'nav', 'social' ] );
                foreach ( $elements as $ele ) {
                    $func = isset( $map[ $ele ] ) ? $map[ $ele ] : false;
                    if ( ! $func ) {
                        continue;
                    } ?>
                    <div class="footer56__element footer56__element--<?php echo esc_attr( $ele ); ?> footer56__<?php echo esc_attr( $ele ); ?>">
                        <?php echo call_user_func( $func ); ?>
                    </div>
                <?php } ?>
            </div>

        </div><!-- .footer_bottom__row -->

        <?php } // footer bottom layout ?>

    </div><!-- .container -->

</div><!-- #footer-bottom -->
    <?php

    return ob_get_clean();
}

/* LOGO
=============================================================== */
function fox56_footer_logo_inner() {
    $footer_logo = get_theme_mod( 'footer_logo' );
    $footer_logo_html = '';
    if ( $footer_logo ) {
        $footer_logo_html = wp_get_attachment_image( $footer_logo, 'full', false, [ 'class' => 'main-footer-logo' ] );

        $darkmode_footer_logo_id = get_theme_mod( 'darkmode_footer_logo' );
        if ( $darkmode_footer_logo_id ) {
            $footer_logo_html = wp_get_attachment_image( $darkmode_footer_logo_id, 'full', false, [ 'class' => 'darkmode-footer-logo' ] ) . $footer_logo_html;
        }
    }
    if ( ! $footer_logo_html ) {
        return;
    }
    
    $url = get_theme_mod( 'footer_logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }

    return '<a href="' . esc_url( $url ) . '">' . $footer_logo_html . '</a>';
}

/* NAV
=============================================================== */
function fox56_footer_nav_inner() {
    if ( ! has_nav_menu('footer') ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return '';
        }
        return '<p class="fox-error">Footer menu not set. Go to <a href="' . get_admin_url('','nav-menus.php') . '">Dashboard \ Appearance \ Menus</a> to set one.</p>';
    }
    
    return '<nav class="footer-menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">' . fox56_cached_menu( 'footer' ) . '</nav>';
}

/* SOCIAL
=============================================================== */
function fox56_footer_social_inner() {
    return '<div class="fox56-social-list">' . fox56_social_list(['tooltip_position'=>'top']) . '</div>';
}

/* SEARCH
=============================================================== */
function fox56_footer_search_inner() {
    ob_start();
    get_search_form();
    return ob_get_clean();
}

/* COPYRIGHT
=============================================================== */
function fox56_footer_copyright_inner() {
    $copyright = get_theme_mod( 'footer_copyright', '&copy; [today format="Y"] All rights reserved. Powered by <a href="https://themeforest.net/item/the-fox-contemporary-magazine-theme-for-creators/11103012" target="_blank">The Fox</a>.' );
    
    if ( function_exists( 'pll__' ) ) {
        $copyright = pll__( $copyright );
    }    
    return wpautop( wp_kses( do_shortcode( $copyright ), fox_allowed_html() ) );
}

/* HTML1
=============================================================== */
function fox56_footer_html1_inner() {
    $html = get_theme_mod( 'footer_html1' );
    if ( ! $html ) {
        return;
    }
    return do_shortcode( $html );
}

function fox56_footer_html2_inner() {
    $html = get_theme_mod( 'footer_html2' );
    if ( ! $html ) {
        return;
    }
    return do_shortcode( $html );
}

/* Scroll top button
=============================================================== */
function fox56_icon_scrollup() {
    
    $img_html = '';
    $img_id = get_theme_mod( 'scrollup_icon_image' );
    if ( $img_id ) {
        $img_html = wp_get_attachment_image( $img_id, 'medium' );
    }
    
    if ( ! $img_html ) {
        $img_html = get_theme_mod( 'scrollup_icon' );
    }
    
    return $img_html;

}

/* Scroll top button
=============================================================== */
function fox56_scrollup_inner() {

    ob_start();
    $cl = [ 'scrollup56' ];

    /* type
    ---------------------------- */
    $ic_html = '';
    $type = get_theme_mod( 'scrollup_type', 'text' );
    if ( 'icon' == $type ) {
        $cl[] = 'scrollup56--icon';
        $ic = get_theme_mod( 'scrollup_icon', 'chevron-thin-up' );
        $ic_html = '<i class="ic56-' . esc_attr( $ic ). '"></i>';
    } elseif ( 'image' == $type ) {
        $cl[] = 'scrollup56--image';
        $img_id = get_theme_mod( 'scrollup_image' );
        if ( $img_id ) {
            $ic_html = wp_get_attachment_image( $img_id, 'medium' );
        }
    // text    
    } else {
        
        $cl[] = 'scrollup56--text';
        $text_above = '<span class="go">' . fox_word( 'go' ) . '</span>';
        $text_below = '<span class="top">' . fox_word( 'top' ) . '</span>';
        
        $ic_html = $text_above . $text_below;

    }

    /* shape
    ---------------------------- */
    if ( $type == 'text' || $type == 'icon' ) {
        $cl[] = 'scrollup56--noimage';
        $shape = get_theme_mod( 'scrollup_shape', 'square' );
        if ( 'circle' != $shape && 'round' != $shape ) {
            $shape = 'square';
        }
        $cl[] = 'scrollup56--' . $shape;
    }

    ?>
<div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
    <?php echo $ic_html; ?>
</div>
    <?php

    return ob_get_clean();
}

/** 
 * SCROLL UP
 * ================================================================
 */
add_action( 'wp_footer', 'fox56_scrollup_place' );
function fox56_scrollup_place() { ?>

<div class="scrollup__placeholder">
    <?php echo fox56_scrollup_render(); ?>
</div>
<?php
}

function fox56_scrollup_render() {
    if ( ! apply_filters( 'fox_show_footer', true ) ) { return; }
    if ( ! get_theme_mod( 'scrollup', 'true' ) ) { return; }

    return fox56_scrollup_inner();
}