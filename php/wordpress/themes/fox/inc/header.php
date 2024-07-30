<?php
/** 
 * HEADER MINIMAL
 * ================================================================
 */
function fox56_header_minimal() {
    fox56_header_minimal_desktop();
    fox56_header_mobile();
}
function fox56_header_minimal_desktop() {
    get_template_part( 'parts/header', 'min' ); // temporary
}

/** 
 * HEADER NORMAL
 * ================================================================
 */
function fox56_header() {
    fox56_header_desktop();
    fox56_header_mobile();
    fox56_after_header_mobile();
}

/** 
 * HEADER DESKTOP
 * * ================================================================
 */
function fox56_header_desktop() {
    $is_header_sticky = get_theme_mod( 'header_sticky', true );
    $cl = [ 'masthead', 'header_desktop56' ];
    if ( $is_header_sticky ) {
        $cl[] = 'masthead--sticky';
    }
    // determine which part should be sticky: all of them
    $sticky_parts = get_theme_mod( 'header_sticky_parts', [ 'topbar', 'main_header', 'header_bottom' ] );
    $topbar_cl = [ 'topbar56', 'header56__section' ];
    if ( ! in_array( 'topbar', $sticky_parts ) ) { $topbar_cl[] = 'disable--sticky'; }

    $main_header_cl = [ 'main_header56', 'header56__section' ];
    if ( ! in_array( 'main_header', $sticky_parts ) ) { $main_header_cl[] = 'disable--sticky'; }

    $header_bottom_cl = [ 'header_bottom56', 'header56__section' ];
    if ( ! in_array( 'header_bottom', $sticky_parts ) ) { $header_bottom_cl[] = 'disable--sticky'; }
    ?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <div class="masthead__wrapper">
        <?php fox56_before_header(); ?>
        <div id="topbar56" class="<?php echo esc_attr( join( ' ', $topbar_cl ) ); ?>">
            <?php echo fox56_header_topbar_inner(); ?>
        </div>
        <div id="header56" class="<?php echo esc_attr( join( ' ', $main_header_cl ) ); ?>">
            <?php echo fox56_header_main_inner(); ?>
        </div>
        <div id="header_bottom56" class="<?php echo esc_attr( join( ' ', $header_bottom_cl ) ); ?>">
            <?php echo fox56_header_bottom_inner(); ?>
        </div>
        <?php fox56_after_header(); ?>
    </div>
    
</div>
    <?php
}

/** 
 * before header
 * * ================================================================
 */
function fox56_before_header() {
    if ( ! is_active_sidebar( 'before-header' ) ) {
        return;
    }
    ?>
    <div class="before-header disable--sticky">
        <div class="container">
            <?php dynamic_sidebar( 'before-header' ); ?>
        </div>
    </div>
    <?php
}

/** 
 * after header
 * * ================================================================
 */
function fox56_after_header() {
    if ( ! is_active_sidebar( 'after-header' ) ) {
        return;
    }
    ?>
    <div class="after-header disable--sticky">
        <div class="container">
            <?php dynamic_sidebar( 'after-header' ); ?>
        </div>
    </div>
    <?php
}
function fox56_after_header_mobile() {
    if ( ! is_active_sidebar( 'after-header-mobile' ) ) {
        return;
    }
    ?>
    <div class="after-header after-header-mobile disable--sticky">
        <div class="container">
            <?php dynamic_sidebar( 'after-header-mobile' ); ?>
        </div>
    </div>
    <?php
}

/** 
 * PART
 * section: topbar / main header / header bottom
 * part: left / center / right
 * RETURN, not echo
 * * ================================================================
 */
function fox56_header_part_inner( $section, $part, $part_std = [] ) {
    $elements = get_theme_mod( "{$section}_{$part}_elements", $part_std );
    if ( ! is_array( $elements ) ) {
        $elements = explode( ',', strval( $elements ) );
    }
    if ( ! is_array( $elements ) ) {
        return;
    }
    $function_map = [
        'logo' => 'fox56_header_logo_inner',
        'nav' => 'fox56_header_nav_inner',
        'hamburger' => 'fox56_header_hamburger_inner',
        'cart' => 'fox56_header_cart_inner',
        'darkmode' => 'fox56_header_darkmode_inner',
        'social' => 'fox56_header_social_inner',
        'search' => 'fox56_header_search_inner',
        'html1' => 'fox56_header_html1_inner',
        'html2' => 'fox56_header_html2_inner',
        'html3' => 'fox56_header_html3_inner',
        'button1' => 'fox56_header_button1_inner',
        'button2' => 'fox56_header_button2_inner',
    ];
    
    foreach ( $elements as $ele ) {
        if ( ! is_scalar( $ele ) ) {
            print_r( $ele );
            continue;
        }
        $func = isset( $function_map[ $ele ] ) ? $function_map[ $ele ] : null;
        if ( ! $func ) {
            continue;
        } ?>
        <div class="header56__element header56__<?php echo esc_attr( $ele ); ?>">
            <?php 
            if ( 'header_mobile' == $section && 'logo' == $ele ) {
                $value = fox56_header_logo_inner( 'mobile' );
            } else {
                $value = call_user_func( $func ); 
            }
            echo $value; ?>
        </div>
        <?php
    }
}

/** 
 * TOPBAR
 * * ================================================================
 */
// this RETURN, not echo
function fox56_header_topbar_inner() {
    $layout = get_theme_mod( 'topbar_layout', '12-12' );
    $cols = explode( '-', $layout );
    if ( 1 == count( $cols ) ) {
        $cols = array_merge( [ '01' ], $cols, [ '01' ] );
    } elseif ( 2 == count( $cols ) ) {
        array_splice( $cols, 1, 0, '01' );
    }
    if ( 3 != count( $cols ) ) {
        return;
    }
    $parts = [
        'left' => [ 'nav' ],
        'center' => [],
        'right' => [ 'social', 'search' ]
    ];
    $actual_parts = [
        'left' => get_theme_mod( 'topbar_left_elements', $parts['left'] ),
        'center' => get_theme_mod( 'topbar_center_elements', $parts['center'] ),
        'right' => get_theme_mod( 'topbar_right_elements', $parts['right'] ),
    ];
    if ( empty( $actual_parts['left'] ) && empty( $actual_parts['center'] ) && empty( $actual_parts['right'] ) ) {
        return;
    }
    $i = -1;
    /**
     * classes goes here
     */
    $cl = [ 'container', 'topbar56__container', 'header56__section__container' ];
    
    /**
     * stretch
     */
    $stretch = get_theme_mod( 'topbar_stretch', 'content' );
    if ( 'full' != $stretch )  {
        $stretch = 'content';
    }
    $cl[] = 'stretch--' . $stretch;

    /**
     * text skin
     */
    $topbar_text_skin = get_theme_mod( 'topbar_text_skin', 'light' );
    if ( 'dark' != $topbar_text_skin ) {
        $topbar_text_skin = 'light';
    }
    $cl[] = 'textskin--' . $topbar_text_skin;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <div class="row">
            <?php foreach ( $parts as $part => $part_std ) {
                $i += 1;

                /** ---------------------- layout */
                $cl = [ 'col', 'topbar56__part', 'header56__part', 'header56__part--' . $part ];
                $col = $cols[$i];
                $col = str_split($col);
                $cl[] = 'col-' . $col[0] . '-' . $col[1];

                ?>
            <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
                <?php echo fox56_header_part_inner( 'topbar', $part, $part_std ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

/** 
 * MAIN
 * * ================================================================
 */
function fox56_header_main_inner() {
    $layout = get_theme_mod( 'main_header_layout', '11' );
    $cols = explode( '-', $layout );
    if ( 1 == count( $cols ) ) {
        $cols = array_merge( [ '01' ], $cols, [ '01' ] );
    } elseif ( 2 == count( $cols ) ) {
        array_splice( $cols, 1, 0, '01' );
    }
    if ( 3 != count( $cols ) ) {
        return;
    }
    $parts = [
        'left' => [],
        'center' => [ 'logo' ],
        'right' => []
    ];
    if ( empty( $parts['left'] ) && empty( $parts['center'] ) && empty( $parts['right'] ) ) {
        return;
    }
    $i = -1;
    /**
     * classes goes here
     */
    $cl = [ 'container', 'main_header56__container', 'header56__section__container' ];
    
    /**
     * stretch
     */
    $stretch = get_theme_mod( 'main_header_stretch', 'content' );
    if ( 'full' != $stretch )  {
        $stretch = 'content';
    }
    $cl[] = 'stretch--' . $stretch;

    /**
     * text skin
     */
    $text_skin = get_theme_mod( 'main_header_text_skin', 'light' );
    if ( 'dark' != $text_skin ) {
        $text_skin = 'light';
    }
    $cl[] = 'textskin--' . $text_skin;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <div class="row">
            <?php foreach ( $parts as $part => $part_std ) {
                $i += 1;

                /** ---------------------- layout */
                $cl = [ 'col', 'main_header56__part', 'header56__part', 'header56__part--' . $part ];
                $col = $cols[$i];
                $col = str_split($col);
                $cl[] = 'col-' . $col[0] . '-' . $col[1];

                ?>
            <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
                <?php echo fox56_header_part_inner( 'main_header', $part, $part_std ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

/** 
 * BOTTOM
 * * ================================================================
 */
function fox56_header_bottom_inner() {
    $layout = get_theme_mod( 'header_bottom_layout', '16-23-16' );
    $cols = explode( '-', $layout );
    if ( 1 == count( $cols ) ) {
        $cols = array_merge( [ '01' ], $cols, [ '01' ] );
    } elseif ( 2 == count( $cols ) ) {
        array_splice( $cols, 1, 0, '01' );
    }
    if ( 3 != count( $cols ) ) {
        return;
    }
    $parts = [
        'left' => [],
        'center' => [],
        'right' => []
    ];
    $actual_parts = [
        'left' => get_theme_mod( 'header_bottom_left_elements', $parts['left'] ),
        'center' => get_theme_mod( 'header_bottom_center_elements', $parts['center'] ),
        'right' => get_theme_mod( 'header_bottom_right_elements', $parts['right'] ),
    ];
    if ( empty( $actual_parts['left'] ) && empty( $actual_parts['center'] ) && empty( $actual_parts['right'] ) ) {
        return;
    }
    $i = -1;
    /**
     * classes goes here
     */
    $cl = [ 'container', 'header_bottom56__container', 'header56__section__container' ];
    
    /**
     * stretch
     */
    $stretch = get_theme_mod( 'header_bottom_stretch', 'content' );
    if ( 'full' != $stretch )  {
        $stretch = 'content';
    }
    $cl[] = 'stretch--' . $stretch;

    /**
     * text skin
     */
    $topbar_text_skin = get_theme_mod( 'header_bottom_text_skin', 'light' );
    if ( 'dark' != $topbar_text_skin ) {
        $topbar_text_skin = 'light';
    }
    $cl[] = 'textskin--' . $topbar_text_skin;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <div class="row">
            <?php foreach ( $parts as $part => $part_std ) {
                $i += 1;

                /** ---------------------- layout */
                $cl = [ 'col', 'header_bottom56__part', 'header56__part', 'header56__part--' . $part ];
                $col = $cols[$i];
                $col = str_split($col);
                $cl[] = 'col-' . $col[0] . '-' . $col[1];

                ?>
            <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
                <?php echo fox56_header_part_inner( 'header_bottom', $part, $part_std ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

/** 
 * HEADER MOBILE
 * * ================================================================
 */
function fox56_header_mobile() {
    $cl = [ 'header_mobile56', 'header56__section' ];
    if ( get_theme_mod( 'mobile_header_sticky', true ) ) {
        $cl[] = 'header_mobile56--sticky';
    }
    ?>
    <div id="header_mobile56" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo fox56_header_mobile_inner(); ?>
    </div>
    <div class="header_mobile56__height"></div>
<?php }

function fox56_header_mobile_inner() {
    $layout = get_theme_mod( 'header_mobile_layout', '16-23-16' );
    $cols = explode( '-', $layout );
    if ( 1 == count( $cols ) ) {
        $cols = array_merge( [ '01' ], $cols, [ '01' ] );
    } elseif ( 2 == count( $cols ) ) {
        array_splice( $cols, 1, 0, '01' );
    }
    if ( 3 != count( $cols ) ) {
        return;
    }
    $parts = [
        'left' => [ 'hamburger' ],
        'center' => [ 'logo' ],
        'right' => [ 'cart' ]
    ];
    $i = -1;
    /**
     * classes goes here
     */
    $cl = [ 'container', 'header_mobile56__container', 'header56__section__container' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <div class="row">
            <?php foreach ( $parts as $part => $part_std ) {
                $i += 1;

                /** ---------------------- layout */
                $cl = [ 'col', 'header_mobile56__part', 'header56__part', 'header56__part--' . $part ];
                $col = $cols[$i];
                $col = str_split($col);
                $cl[] = 'col-' . $col[0] . '-' . $col[1];

                ?>
            <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
                <?php echo fox56_header_part_inner( 'header_mobile', $part, $part_std ); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

/** 
 * LOGO
 * * ================================================================
 */
function fox56_header_logo_inner( $mode = 'desktop' ) {
    ob_start();
    
    $class = [
        'wi-logo-main',
        'fox-logo'
    ];
    
    /**
     * logo type
     */
    $logo_type = get_theme_mod( 'logo_type', 'text' );
    if ( 'image' != $logo_type ) $logo_type = 'text';
    $class[] = 'logo-type-' . $logo_type;
    
    $logo_html = '';
    if ( 'text' == $logo_type ) {
        
        $logo_html = '<span class="text-logo">' . get_bloginfo( 'title' ) . '</span>';
        
    } else {
        
        $logo_html = '';
        /**
         * if we're getting mobile logo, we'll have another attempt
         */
        if ( 'mobile' == $mode ) {
            $logo_id = get_theme_mod( 'mobile_logo' );
            if ( $logo_id ) {
                $logo_html = wp_get_attachment_image( $logo_id, 'full', false, [ 'class' => 'main-img-logo', 'loading' => 'eager' ]);
            }
        }
        if ( ! $logo_html ) {
            $logo_id = get_theme_mod( 'logo' );
            if ( $logo_id ) {
                $logo_html = wp_get_attachment_image( $logo_id, 'full', false, [ 'class' => 'main-img-logo', 'loading' => 'eager' ]);
            }
            $darkmode_logo_id = get_theme_mod( 'darkmode_logo' );
            if ( $darkmode_logo_id ) {
                $logo_html = wp_get_attachment_image( $darkmode_logo_id, 'full', false, [ 'class' => 'darkmode-img-logo', 'loading' => 'eager' ]) . $logo_html ;
            }
        }
        if ( ! $logo_html ) {
            $logo_html = '<img src="' . esc_url( get_template_directory_uri() . '/images/logo-default.png' ) .'" alt="' . esc_html__( 'Logo', 'wi' ) . '" class="main-img-logo" loading="eager" />';
        }
        
    }
    
    /**
     * custom logo url
     * @since 4.0
     */
    $url = get_theme_mod( 'logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }
    
    ?>

    <div class="fox-logo-container logo56">
        
        <div class="<?php echo esc_attr( join( ' ',  $class ) ); ?>">
            <a href="<?php echo esc_url( $url ); ?>" rel="home">
                <?php echo $logo_html; ?>
            </a>
        </div>

        <?php if ( 'desktop' == $mode && get_theme_mod( 'tagline_enable' ) ) { ?>
        
        <p class="site-description slogan site-tagline"><?php echo do_shortcode( get_bloginfo('description') );?></p>
        
        <?php } ?>

    </div><!-- .fox-logo-container -->

    <?php
    return ob_get_clean();
}

/** 
 * SOCIAL
 * * ================================================================
 */
function fox56_header_social_inner() {
    return '<div class="fox56-social-list">' . fox56_social_list(['tooltip_position'=>'bottom']) . '</div>';
}

/** 
 * NAV
 * * ================================================================
 */
function fox56_header_nav_inner() {
    
    if ( ! has_nav_menu('primary') ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return '';
        }
        return '<p class="fox-error">Primary menu not set. Go to <a href="' . get_admin_url('','nav-menus.php') . '">Dashboard \ Appearance \ Menus</a> to set one.</p>';
    }
    
    $cl = [ 'mainnav' ];
    /**
     * based on theme options, we add necessary classes here
     */
    
    /* --------------   children dropdown */
    $dropdown_indicator = get_theme_mod( 'nav_dropdown_indicator', 'angle-down' );
    $cl[] = 'nav--dropdown-indicator-' . $dropdown_indicator;
    
    /* --------------   dropdown shadow level */
    $dropdown_shadow_level = get_theme_mod( 'nav_dropdown_shadow', 'none' );
    $cl[] = 'nav--dropdown-shadow-' . $dropdown_shadow_level;
    
    /* --------------   item hover/active style */
    $active_style = get_theme_mod( 'nav_active_style', 'none' );
    $cl[] = 'nav--active-' . $active_style;
    
    /* --------------   separator */
    if ( get_theme_mod( 'nav_item_sep' ) ) {
        $cl[] = 'nav--has-item-sep';
    }
    
    /* --------------   dropdown arrow */
    if ( get_theme_mod( 'nav_dropdown_arrow' ) ) {
        $cl[] = 'nav--dropdown-has-arrow';
    }
    
    /* --------------   item separator */
    if ( get_theme_mod( 'nav_dropdown_item_sep' ) ) {
        $cl[] = 'nav--dropdown-has-sep';
    }
    
    /* --------------   preload mega menu items */

    return '<nav class="' . esc_attr( join( ' ', $cl ) ) . '" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">' . fox56_cached_menu( 'primary' ) . '</nav>';

}

/** 
 * HAMBURGER
 * * ================================================================
 */
function fox56_header_hamburger_inner() {
    $icon_type = get_theme_mod( 'hamburger_icon_type', 'icon' );
    $img_html = '';
    $close_html = '';
    $menu_html = '';
    $cl = [ 'hamburger' ];

    if ( 'image' == $icon_type ) {
        $menu_url_id = get_theme_mod( 'hamburger_image', 0 );
        if ( $menu_url_id ) {
            $menu_html = wp_get_attachment_image( $menu_url_id, 'thumbnail', false, [ 'class' => 'icon-menu' ] );
            if ( $menu_html ) {
                $cl[] = 'hamburger--type-image';
            }
        }
    }
    if ( ! $menu_html ) {
        $menu_html = '<i class="ic56-menu1 icon-menu"></i>';
    }
    
    if ( 'image' == $icon_type ) {
        $close_url_id = get_theme_mod( 'hamburger_close_image', 0 );
        if ( $close_url_id ) {
            $close_html = wp_get_attachment_image( $close_url_id, 'thumbnail', false, [ 'class' => 'icon-close' ] );
        }
    }
    if ( ! $close_html ) {
        $close_html = '<i class="ic56-x icon-close"></i>';
    }

    /**
     * icon type
     */
    if ( ! in_array( 'hamburger--type-image', $cl ) ) {
        $cl[] = 'hamburger--type-icon';
    }
    
    return '<span class="' . esc_attr( join( ' ', $cl ) ) . '">' . $menu_html . $close_html . '</span>';
    
}

/** 
 * SEARCH
 * * ================================================================
 */
function fox56_header_search_inner() {
    ob_start();
    $style = get_theme_mod( 'header_search_style', 'classic' );
    if ( 'classic' == $style ) { ?>

    <span class="search-btn-classic search-btn">
        <?php echo fox56_icon_search(); ?>
    </span>

    <div class="search-wrapper-classic">
        <?php get_search_form(); ?>
    </div><!-- .search-wrapper-classic -->
    <?php } elseif ( 'toggle' == $style ) {?>
    
    <div class="header56__search__inner">
        <span class="search-btn-toggle search-btn">
            <?php echo fox56_icon_search(); ?>
        </span>

        <div class="search-wrapper-toggle">
            <?php get_search_form(); ?>
        </div>
    </div><!-- .search-wrapper-toggle -->
    <?php } elseif ( 'modal' == $style ) {?>

    <span class="search-btn-modal search-btn">
    <?php echo fox56_icon_search(); ?>
    </span>

    <div class="search-wrapper-modal">
        
        <div class="container">
            <div class="modal-search-content">
    
                <?php get_search_form(); ?>
                <?php fox56_search_modal_suggestion(); ?>
                
            </div><!-- .modal-search-content -->
        </div><!-- .header-search-form -->
        
        <span class="search-modal-close-btn"><i class="ic56-x"></i></span>
        
    </div><!-- .search-wrapper-modal -->
        
    <?php } elseif ( 'visible' == $style ) { ?>

    <div class="search-wrapper-visible">
        
        <?php get_search_form(); ?>
        
    </div><!-- .search-wrapper-modal -->
    
    <?php 
    }
    
    return ob_get_clean();
}

function fox56_search_modal_suggestion() {
    if ( ! has_nav_menu( 'search-menu' ) ) {
        return;
    }
    ?>
<div class="search-suggestion">
    <h4><?php echo fox_word( 'suggestions' ); ?></h4>
    <nav role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        
        <?php echo fox56_cached_menu( 'search-menu', 1 ); ?>
        
    </nav>
</div><!-- .search-suggestion -->

    <?php
}

/** 
 * CART
 * * ================================================================
 */
function fox56_header_cart_inner() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        if ( current_user_can( 'manage_options' ) ) {
            // return '<span class="fox-error">WooCommerce not installed hence the cart displays nothing here. You should remove it in <strong>Customize &raquo; Header &raquo; Cart</strong></span>';
        }
        return;
    }
    
    $count = WC()->cart->get_cart_contents_count();
    $url = wc_get_cart_url();
    
    return '<a href="' . esc_url( $url ) . '" class="header_cart56"><span class="num">' . $count . '</span>' . fox56_icon_cart() . '</a>';
}

/** 
 * DARK MODE TOGGLE
 * * ================================================================
 */
function fox56_header_darkmode_inner() {
    ?>
    <div class="lamp56">
        <div class="lamp56__dark">
            <svg aria-hidden="true" viewBox="0 0 512 512">
                <title>lightmode</title>
                <path fill="currentColor" d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"></path>
            </svg>
            <span><?php echo fox_word( 'dark' ); ?></span>
        </div>
        <div class="lamp56__light">
            <svg aria-hidden="true" viewBox="0 0 512 512">
                <title>darkmode</title>
                <path fill="currentColor" d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z"></path>
            </svg>
            <span><?php echo fox_word( 'light' ); ?></span>
        </div>
    </div>
    <?php
}
add_shortcode( 'darkmode_toggle', 'fox56_darkmode_toggle_shortcode' );
function fox56_darkmode_toggle_shortcode() {
    ob_start();
    fox56_header_darkmode_inner();
    return ob_get_clean();
}

/** 
 * HTML
 * * ================================================================
 */
function fox56_cached_html( $position = 1 ) {
    $cache = wp_cache_get( 'html' . $position, 'header' );
    if ( $cache === false ) {
        $cache = do_shortcode( get_theme_mod( 'header_html' . $position, '' ) );
        wp_cache_set( 'html' . $position, $cache, 'header' );
    }
    return $cache;
}
function fox56_header_html1_inner() {
    return fox56_cached_html(1);
}
function fox56_header_html2_inner() {
    return fox56_cached_html(2);
}
function fox56_header_html3_inner() {
    return fox56_cached_html(3);
}

/** 
 * Button
 * * ================================================================
 */
function fox56_header_button_inner( $i = 1 ) {
    
    $atts = array(
        'text' => get_theme_mod( "header_button{$i}_text", "Button{$i}" ),
        'icon' => get_theme_mod( "header_button{$i}_icon", "" ),
        'url' => get_theme_mod( "header_button{$i}_url", "" ),
        'target' => ( get_theme_mod( "header_button{$i}_target", "" ) ) ? '_blank' : '',
        'size' => get_theme_mod( "header_button{$i}_size", "" ),
        'style' => get_theme_mod( "header_button{$i}_style", "black" ),
        'border_radius' => get_theme_mod( "header_button{$i}_border_radius", "" ),
        'block' => get_theme_mod( "header_button{$i}_block", "" ),
        'extra_class' => get_theme_mod( "header_button{$i}_extra_class", "" ),
    );

    if( 'fill' != $atts['style'] ) {
        return fox56_btn( $atts, false );
    }

    //Custom attrs
    $atts2 = array(
        // Color
        'text_color' => get_theme_mod( "header_button{$i}_text_color", "" ),
        'bg_color' => get_theme_mod( "header_button{$i}_bg_color", "" ),
        'border_color' => get_theme_mod( "header_button{$i}_border_color", "" ),
        'text_color_hover' => get_theme_mod( "header_button{$i}_text_color_hover", "" ),
        'bg_color_hover' => get_theme_mod( "header_button{$i}_bg_color_hover", "" ),
        'border_color_hover' => get_theme_mod( "header_button{$i}_border_color_hover", "" ),
        //border width
        'border_width' => get_theme_mod( "header_button{$i}_border_width", "" ),
    );
    $atts = array_merge($atts, $atts2);

    return fox56_btn( $atts, false );
}
function fox56_header_button1_inner() {
    return fox56_header_button_inner(1);
}
function fox56_header_button2_inner() {
    return fox56_header_button_inner(2);
}

/* offcanvas menu
------------------------------------------------------------------------------------ */
function fox56_offcanvas_mainnav() {
    return '<div class="offcanvas56__element offcanvas56-mainnav">' . fox56_offcanvas_mainnav_inner() . '</div>';
}
function fox56_offcanvas_mainnav_inner() {
    
    $the_menu = '';
    if ( has_nav_menu( 'mobile' ) ) {
        $the_menu = fox56_cached_menu( 'mobile' );
    } elseif ( has_nav_menu( 'primary' ) ) {
        $the_menu = fox56_cached_menu( 'primary' );
    } else {
        if ( ! current_user_can( 'manage_options' ) ) {
            return '';
        }
        return '<p class="fox-error">Both Mobile and Primary menu not set. Go to <a href="' . get_admin_url('','nav-menus.php') . '">Dashboard \ Appearance \ Menus</a> to set one.</p>';
    }
    
    $cl = [ 'offcanvasnav56' ];
    
    /*------------------------------    nav col */
    $cols = get_theme_mod( 'offcanvas_nav_col', 1 );
    if ( $cols != 2 ) { $cols = 1; }
    $cl[] = 'nav--cols-' . $cols;
    
    return '<nav class="' . esc_attr( join( ' ', $cl ) ) . '" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">' . $the_menu . '</nav>';
    
}

/* off canvas search
------------------------------------------------------------------------------------ */
function fox56_offcanvas_search() {
    return '<div class="offcanvas56__element offcanvas56__search">' . get_search_form(['echo'=> false]) . '</div>';
}
function fox56_offcanvas_social() {
    return '<div class="offcanvas56__element offcanvas56__social fox56-social-list">' . fox56_social_list() . '</div>';
}
function fox56_offcanvas_sidebar() {
    
    return '<div class="offcanvas56__element offcanvas56__sidebar">' . fox56_offcanvas_sidebar_inner() . '</div>';
    
}

function fox56_offcanvas_sidebar_inner() {
    
    if ( ! is_active_sidebar( 'off-canvas' ) ) {
        return '';
    }
    
    ob_start();
    dynamic_sidebar( 'off-canvas' );
    return ob_get_clean();
    
}

/* HTML
------------------------------------------------------------------------------------ */
function fox56_offcanvas_html1() {
    return '<div class="offcanvas56__element offcanvas56__html1 header56__html1">' . fox56_cached_html(1) . '</div>';
}
function fox56_offcanvas_html2() {
    return '<div class="offcanvas56__element offcanvas56__html2 header56__html2">' . fox56_cached_html(2) . '</div>';
}
function fox56_offcanvas_html3() {
    return '<div class="offcanvas56__element offcanvas56__html3 header56__html3">' . fox56_cached_html(3) . '</div>';
}

/* Button
------------------------------------------------------------------------------------ */
function fox56_offcanvas_button1() {
    return '<div class="offcanvas56__element offcanvas56__button1 header56__button1">' . fox56_header_button_inner(1) . '</div>';
}
function fox56_offcanvas_button2() {
    return '<div class="offcanvas56__element offcanvas56__button2 header56__button2">' . fox56_header_button_inner(2) . '</div>';
}

/* OFF CANVAS
------------------------------------------------------------------------------------ */
add_action( 'wp_footer', function() {
    echo fox56_offcanvas();
});
function fox56_offcanvas( $args = [] ) {
    return '<div class="offcanvas56">' . fox56_offcanvas_inner() . '</div><div class="offcanvas56__overlay"></div>';
}
function fox56_offcanvas_inner() {
    $cl = [ 'offcanvas56__container' ];
    /**
     * animation
     */
    if ( get_theme_mod( 'offcanvas_animation' ) ) {
        $cl[] = 'offcanvas56--hasanimation';
    }
    $ul = [];
    $elements = get_theme_mod( 'offcanvas_elements', [ 'search', 'nav', 'social', 'sidebar' ]);
    $map = [
        'mainnav' => 'fox56_offcanvas_mainnav',
        'nav' => 'fox56_offcanvas_mainnav',
        'search' => 'fox56_offcanvas_search',
        'social' => 'fox56_offcanvas_social',
        'sidebar' => 'fox56_offcanvas_sidebar',
        
        'html1' => 'fox56_offcanvas_html1',
        'html2' => 'fox56_offcanvas_html2',
        'html3' => 'fox56_offcanvas_html3',

        'button1' => 'fox56_offcanvas_button1',
        'button2' => 'fox56_offcanvas_button2',
    ];
    foreach ( $elements as $ele ) {
        $func = $map[ $ele ];
        $ul[] = call_user_func( $func );
    }
    $ul = join( "\n", $ul );
    
    return '<div class="' . esc_attr( join( ' ', $cl ) ) . '">' . $ul . '</div>';
}

/* Icon search 
=============================================================== */
function fox56_icon_search() {

    $img_html = '';
    $img_id = get_theme_mod( 'search_icon_image' );
    if ( $img_id ) {
        $img_html = wp_get_attachment_image( $img_id, 'medium' );
    }
    
    if ( ! $img_html ) {
        $img_html = '<i class="ic56-search"></i>';
    }
    
    return $img_html;

}

/* Icon cart
=============================================================== */
function fox56_icon_cart() {
    $img_html = '';
    $img_id = get_theme_mod( 'header_cart_icon_image' );
    if ( $img_id ) {
        $img_html = wp_get_attachment_image( $img_id, 'medium' );
    }
    
    if ( ! $img_html ) {
        $img_html = '<i class="ic56-shopping-cart"></i>';
    }
    
    return $img_html;
}


/* Mega item class
=============================================================== */
add_filter( 'nav_menu_css_class', 'fox56_nav_menu_css_class', 10, 4 );
function fox56_nav_menu_css_class( $classes, $item, $args, $depth ) {

    if ( ! $depth && get_post_meta( $item->ID, 'menu-item-mega', true ) ) {

        $classes[] = 'mega';
        
        // since 4.0, just a backup class
        $classes[] = 'mega-item';
        
        /**
         * item for category
         */
        if ( 'taxonomy' == $item->type && 'category' == $item->object ) {
            $classes[] = 'mega-for-category';
        }
        
        if ( 'post_type' == $item->type && 'fox_block' == $item->object ) {
            $classes[] = 'mega-custom';
        }

    }

    return $classes;

}

/**
 * Mega menu by FOX Block
 * @since 5.4
 * -------------------------------------------------------------------------------- */
add_filter( 'nav_menu_link_attributes', 'fox56_fox_block_mega_adjust_url', 10, 4 );
function fox56_fox_block_mega_adjust_url( $atts, $item, $args, $depth ) {
    
    if ( 'post_type' == $item->type && 'fox_block' == $item->object ) {
        $atts[ 'href' ] = '#';
    }
    return $atts;
    
}

/**
 * Menu Icon
 * @since 2.0
 * @since 4.0, we allow to use an image as icon
 * allow to use feather icon as menu icon
 * -------------------------------------------------------------------------------- */
add_filter( 'nav_menu_item_title', 'fox56_nav_menu_item_title', 10, 4 );
function fox56_nav_menu_item_title( $title, $item, $args, $depth ) {

    if ( $icon = trim( get_post_meta( $item->ID, 'menu-item-menu-icon', true ) ) ) {

        $icon_html = '';
        // check if it's an image
        if ( 'http' == strtolower( substr( $icon, 0, 4 ) ) ) {
            $icon_html = '<span class="menu-icon-img"><img src="' . esc_url( $icon ). '" /></span>';
        } else {
            $icon = strtolower( $icon );
            if ( substr( $icon, 0, 7 ) == 'feather' ) {
                wp_enqueue_style( 'fox-feather' );
            } elseif ( substr( $icon, 0, 6 ) == 'fa fa-' ) {
                wp_enqueue_style( 'fox-fontawesome' );
            } else {
                wp_enqueue_style( 'fox-fontawesome' );
                $icon = 'fa fa-' . $icon;
            }
            $icon_html = '<span class="menu-icon-icon"><i class="' . esc_attr( $icon ) . '"></i></span>';
        }
        
        $title = $icon_html . $title;

    }

    return $title;

}

/**
 * Mark up for FOX Block as Mega Menu
 * @since 5.4
 * -------------------------------------------------------------------------------- */
add_filter( 'walker_nav_menu_start_el', 'fox56_nav_block_mega_markup', 0, 5 );
function fox56_nav_block_mega_markup( $item_output, $item, $depth, $args ) {
    
    if ( ! $depth && 'post_type' == $item->type && 'fox_block' == $item->object && get_post_meta( $item->ID, 'menu-item-mega', true ) ) {
        
        $block_id = $item->object_id;
        ob_start();
        fox_block( $block_id );
        $markup = ob_get_clean();
        
        $markup = '<div class="fox_block_dropdown mega-full">' . $markup . '</div>';
        $item_output .= $markup;
        
    }
    
    return $item_output;
    
}

/**
 * Mark up for mega category menu
 * @since 4.3
 * -------------------------------------------------------------------------------- */
add_filter( 'walker_nav_menu_start_el', 'fox56_nav_category_mega_markup', 0, 4 );
function fox56_nav_category_mega_markup( $item_output, $item, $depth, $args ) {
    if ( $depth) {
        return $item_output;
    }
    if ( 'taxonomy' != $item->type ) {
        return $item_output;
    }
    if ( 'category' != $item->object ) {
        return $item_output;
    }
    if ( ! get_post_meta( $item->ID, 'menu-item-mega', true ) ) {
        return $item_output;
    }

    $thumbnail_size = get_theme_mod( 'nav_mega_thumbnail', 'thumbnail-medium' );
    $thumbnail_size_custom = get_theme_mod( 'nav_mega_thumbnail_custom', [] );

    $markup = '';
    ob_start();
    $mega_q = new WP_Query([
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
        'no_found_rows'         => true,
        'ignore_sticky_posts'   => 1,
        'cat'                   => $item->object_id,
    ]);

    
    if ( $mega_q->have_posts() ) {
        
        while ( $mega_q->have_posts() ) {
            
            $mega_q->the_post();
            ?>
            <li class="menu-item post-nav-item">

                <article class="wi-post post-item post-nav-item-inner" itemscope itemtype="https://schema.org/CreativeWork">
                    <div class="nav-thumbnail-wrapper">
                        <?php fox56_thumbnail([
                            'thumbnail' => $thumbnail_size,
                            'thumbnail_custom' => $thumbnail_size_custom,
                            'thumbnail_caption' => false,
                            'thumbnail_hover_effect' => 'none',
                            'thumbnail_review' => false,
                            'thumbnail_view' => false,
                        ]); ?>
                    </div>
                    <div class="post-nav-item-text">
                        <?php fox56_title([ 'title_extra_class' => 'post-nav-item-title', 'title_tag' => 'h4', ]); ?>
                    </div><!-- .post-nav-item-text -->
                </article><!-- .post-nav-item-inner -->

            </li><!-- .post-nav-item.menu-item -->
            <?php
            
        }
        
    }
    wp_reset_query();
    
    $markup = ob_get_clean();
    $markup = '<ul class="sub-menu submenu-display-items">' . $markup . '</ul>';
    
    $item_output .= $markup;
    return $item_output;
    
}

/* HERO HEADER CONDITION
=============================================================== */
function fox56_is_minimal_header() {
    return ( 'minimal' == get_theme_mod( 'single_hero_header', 'minimal' ) && fox56_is_hero() );
}

/**
 * RETURN bool
 */
function fox56_is_hero() {

    if ( is_single() ) {
        if ( function_exists('fox_framework_single_block_id') && fox_framework_single_block_id()) {
            return false;
        }
    } elseif ( is_page() ) {
        if ( function_exists('fox_framework_page_block_id') && fox_framework_page_block_id()) {
            return false;
        }
    }
    
    return is_singular() && ( false !== fox56_hero_type() );

}

/**
 * hero type
 */
function fox56_hero_type() {

    $style = false;
    if ( is_singular() ) {
        $style = get_post_meta( get_the_ID(), '_wi_style', true );
    }
    if ( ! $style ) {
        if ( is_single() ) {
            $style = get_theme_mod( 'single_style', '1' );
        } elseif ( is_page() ) {
            $style = get_theme_mod( 'page_style', '1' );
        }
    }
    if ( 4 == $style ) {
        return 'full';
    } elseif ( 5 == $style ) {
        return 'half';
    } else {
        return false;
    }

}

// this is the class for us to control minimal header logo
add_action( 'body_class', 'fox56_add_hero_body_class' );
function fox56_add_hero_body_class( $classes ) {
    if ( ! is_singular() ) {
        return $classes;
    }
    $type = fox56_hero_type();
    
    if ( 'full' == $type ) {
        $classes[] = 'body--hero body--hero--full';
    } elseif ( 'half' == $type ) {
        $classes[] = 'body--hero body--hero--half';

        // since 4.3
        $skin = get_post_meta( get_the_ID(), '_wi_hero_half_skin', true );
        if ( ! $skin ) {
            $skin = get_theme_mod( 'single_hero_half_skin', 'light' );
        }
        if ( 'dark' != $skin ) {
            $skin = 'light';
        }

        $classes[] = 'body--hero--half--' . $skin;
        
    } else {
        
        return $classes;
        
    }
    
    return $classes;
    
}

/* HERO HEADER
=============================================================== */
function fox56_minimal_header() { ?>
<div class="minimal-header top-mode" id="minimal-header">
    <?php echo fox56_minimal_header_inner(); ?>
</div>
<?php }

function fox56_minimal_header_inner() { ?>
    <div class="minimal-header-inner">
        <?php echo fox56_header_hamburger_inner(); ?>
        <?php fox56_minimal_logo(); ?>
    </div><!-- .minimal-header-inner -->
<?php }

function fox56_minimal_logo() {

    if ( ! get_theme_mod( 'min_logo', true ) ) {
        return;
    }
    
    $class = [ 'minimal-logo', 'min-logo' ];
    $html = '';
    $type = get_theme_mod( 'min_logo_type', 'text' );
    
    if ( 'text' == $type ) {
        
        $class[] = 'min-logo-text';
        $html = '<span class="text-logo min-text-logo">' . get_bloginfo( 'name' ) . '</span>';
        
    } else {
        
        $class[] = 'min-logo-image';
        
        $logo_minimal_id = get_theme_mod( 'logo_minimal' );
        $logo_white_id = get_theme_mod( 'logo_minimal_white' );
        
        if ( $logo_minimal_id ) {
            $html .= wp_get_attachment_image( $logo_minimal_id, 'full', false, [ 'class' => 'minimal-logo-img' ] );
        }
        
        if ( $logo_white_id ) {
            $html .= wp_get_attachment_image( $logo_white_id, 'full', false, [ 'class' => 'minimal-logo-img-white' ] );
        }
        
    }

    $url = get_theme_mod( 'logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }
    ?>

    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <a href="<?php echo esc_url( $url ); ?>" rel="home">

            <?php echo $html; ?>

        </a>

    </div><!-- .minimal-logo -->

    <?php

}