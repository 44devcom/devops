<?php
/*
 * stack 1: main header + logo
 * stack 2: logo + main header
 * stack 3: logo & other elements inline, navigation below
 * inline: main header
---------------------------------------------------------------- */
$layout = get_theme_mod( 'wi_header_layout', 'stack1' );
$class = [
    'header-container'
];

if ( ! in_array( $layout, [ 'stack2', 'stack3', 'stack4', 'inline' ] ) ) {
    $layout = 'stack1';
}
$class[] = 'header-' . $layout;

// since 4.3
$class = apply_filters( 'header_classic_class', $class );

$params = [
    'layout' => $layout,
    'header_sticky' => ( 'true' == get_theme_mod( 'wi_header_sticky', 'true' ) ),
    'header_transparent' => fox_is_transparent_header(),
];

/**
 * logo
 */
$logo = '';

ob_start();
fox_site_branding( $params );
$logo = ob_get_clean();

/**
 * nav
 */
$nav = '';
if ( 'false' != get_theme_mod( 'wi_header_nav', 'true' ) ) {
    ob_start();
    fox_header_nav();
    $nav = ob_get_clean();
}

/**
 * social icons
 */
$social = '';
if ( 'false' != get_theme_mod( 'wi_header_social', 'true' ) ) {
    ob_start();
    fox_header_social();
    $social = ob_get_clean();
}

/**
 * cart icon
 */
$cart = fox_woocommerce_header_cart();

/**
 * search btn
 */
$search_btn = '';
if ( 'false' != get_theme_mod( 'wi_header_search', 'true' ) ) {
    ob_start();
    fox_header_search();
    $search_btn = ob_get_clean();
}

/**
 * hamburger
 */
$hamburger_btn = '';
if ( 'true' == get_theme_mod( 'wi_header_hamburger', 'false' ) ) {
    ob_start();
    fox_hamburger_btn();
    $hamburger_btn = ob_get_clean();
}

/**
 * sticky header logo
 */
$sticky_logo = '';
if ( $params[ 'header_sticky' ] ) {
    $sticky_logo = fox_get_sticky_logo_html();
    
    /**
     * custom logo url
     * @since 4.0
     */
    $url = get_theme_mod( 'wi_logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }
    if ( $sticky_logo ) {
        $sticky_logo = '<a href="' . esc_url( $url ) . '" class="wi-logo">' . $sticky_logo . '</a>';
    }
    
}

/**
 * sidebar after logo
 */
$sidebar_after_logo = '';
if ( is_active_sidebar( 'header' ) ) {
    
    ob_start();
    echo '<aside id="header-area" class="widget-area">';
    dynamic_sidebar( 'header' );
    echo '</aside><!-- .widget-area -->';
    
    $sidebar_after_logo = ob_get_clean();
    
}

/**
 * more nav options
 * @since 4.4
 */
$row_nav_class = [];
$nav_background = trim( get_theme_mod( 'wi_nav_background' ) );
if ( $nav_background ) {
    $row_nav_class[] = 'row-nav-has-background';
}

$nav_skin = get_theme_mod( 'wi_nav_skin', 'light' );
if ( 'dark' != $nav_skin ) {
    $nav_skin = 'light';
}
if ( 'dark' == $nav_skin ) {
    $row_nav_class[] = 'row-nav-has-background';
}
$row_nav_class[]= 'row-nav-' . $nav_skin;

$nav_active_style = get_theme_mod( 'wi_nav_active_style', '1' );
if ( 2 != $nav_active_style && 3 != $nav_active_style && 4 != $nav_active_style ) {
    $nav_active_style = 1;
}
$row_nav_class[] = 'row-nav-style-active-' . $nav_active_style;

/**
 * nav border class
 */
if ( 'inline' != $layout ) {
    
    $nav_border = get_theme_mod( 'wi_nav_border', '' );
    $nav_border_std = [
        'stack1' => 'bottom-1',
        'stack2' => 'top-3|bottom-1',
        'stack3' => 'top-3|bottom-1',
        'stack4' => 'bottom-1',
        'inline' => 'none',
    ];
    // default nav border
    // we'll determine it depending on the header layout
    if ( ! $nav_border ) {

        // if nav_border is default, then we disable it for dark layouts
        if ( ! in_array( 'row-nav-has-background', $row_nav_class ) && 'light' == $nav_skin ) {

            $nav_border = isset( $nav_border_std[ $layout ] ) ? $nav_border_std[ $layout ] : 'none';

        }

    }

    if ( $nav_border ) {
        $nav_borders = explode( '|', $nav_border );
        foreach ( $nav_borders as $bor ) {
            $class[] = 'header-nav-' . $bor;
        }
    }
    
} else {
    
    $nav_border = 'none';
    
}

$params[ 'nav_border' ] = $nav_border;

?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

<?php /* ---------------------------        STACK 1, 2       ------------------------------------ */ ?>

<?php switch ( $layout ) {
    
    case 'stack1' :
    case 'stack2' :
    
        $row_nav = '';
        ob_start();
        
        $row_nav_class[] = 'header-classic-row header-row-nav header-row-flex main-header classic-main-header header-sticky-element';
        
        /**
         * stretch
         * @since 4.5
         */
        $stretch = get_theme_mod( 'wi_navbar_stretch', 'content' );
        if ( 'full' != $stretch ) {
            $stretch = 'content';
        }
        $row_nav_class[] = 'header-row-stretch-' . $stretch;
        
        /**
         * element order
         */
        $elements_order = get_theme_mod( 'wi_header_stack12_elements_order', '1' );
        if ( ! in_array( $elements_order, [ '2', '3' ] ) ) {
            $elements_order = '1';
        }
        $row_nav_class[] = 'header-row-nav-' . $elements_order;
        if ( in_array( $elements_order, [ '2', '3' ] ) ) {
            $row_nav_class[] = 'header-row-nav-center';
        }
        
        $extra_element = apply_filters( 'fox_header_extra_element', '' );
        
    ?>
    
<div class="<?php echo esc_attr( join( ' ', $row_nav_class ) ); ?>">
    
    <div id="topbar-wrapper">
        
        <div id="wi-topbar" class="wi-topbar">
        
            <div class="container">
                
                <?php if ( 1 == $elements_order ) { ?>
                <div class="header-row-left header-row-part">
                    
                    <?php echo $hamburger_btn . $sticky_logo . $nav ; ?>
                
                </div>
                
                <div class="header-row-right header-row-part">
                    
                    <?php echo $social . $search_btn . $cart . $extra_element ; ?>
                    
                </div>
                
                <?php } elseif ( 2 == $elements_order ) { ?>
                
                <div class="navbar-group navbar-group-left">
                    
                    <?php echo $hamburger_btn . $social ; ?>
                    
                </div>
                
                <?php echo $nav; ?>
                
                <div class="navbar-group navbar-group-right">
                    
                    <?php echo $search_btn . $cart . $extra_element ; ?>
                    
                </div>
                
                <?php } elseif ( 3 == $elements_order ) { ?>
                
                <div class="navbar-group navbar-group-left">
                    
                    <?php echo $search_btn . $cart ; ?>
                    
                </div>
                
                <?php echo $nav; ?>
                
                <div class="navbar-group navbar-group-right">
                    
                    <?php echo $hamburger_btn . $social . $extra_element ; ?>
                    
                </div>
                
                <?php } ?>

            </div><!-- .container -->
            
            <?php do_action( 'fox_after_header_classic_row' ); ?>
            
        </div><!-- #wi-topbar -->
        
    </div><!-- #topbar-wrapper -->

</div><!-- .header-row-nav -->
    
    <?php $row_nav = ob_get_clean(); ?>
    
    <?php $row_branding = ''; ob_start(); ?>

<div class="header-classic-row header-row-branding classic-after-header align-center">

    <div id="wi-header" class="wi-header">

        <div class="container">

            <?php echo $logo; ?>
            
            <?php echo $sidebar_after_logo; ?>
            
        </div><!-- .container -->

    </div><!-- #wi-header -->

</div><!-- .header-row-branding -->
    
    <?php $row_branding = ob_get_clean(); ?>
    
    <?php if ( 'stack1' == $layout ) {
        echo $row_nav . $row_branding;
    } else {
        echo $row_branding . $row_nav;
    } ?>
    
<?php /* ---------------------------        STACK 3, 4       ------------------------------------ */ ?>
    
    <?php break;
        
    case 'stack3' :
    case 'stack4' :
        
        $extra_element = apply_filters( 'fox_header_extra_element', '' );
        
        $left_part = [];
        $right_part = [];
        
        if ( $hamburger_btn ) {
            $left_part[] = $hamburger_btn;
        }
        if ( $social ) {
            $right_part[] = $social;
        }
        if ( $cart ) {
            $right_part[] = $cart;
        }
        
        if ( $extra_element ) {
            $right_part[] = $extra_element;
        }
        
        if ( $search_btn ) {
            if ( ! $left_part && ! $right_part ) {
                $right_part[] = $search_btn;
            } elseif ( ! $left_part ) {
                $left_part[] = $search_btn;
            } elseif ( ! $right_part ) {
                $right_part[] = $search_btn;
            } else {
                $left_part[] = $search_btn;
            }
        }
        
        $right_part = join( "\n", $right_part );
        $left_part = join( "\n", $left_part );
        
        $nav_html = '';
        if ( $nav ) {
    
            ob_start();

            $row_nav_class[] = 'header-classic-row header-row-nav header-sticky-element';
        
    ?>

<div class="<?php echo esc_attr( join( ' ', $row_nav_class ) ); ?>">

    <div class="container">

        <?php echo $sticky_logo . $nav; ?>

    </div><!-- .container -->
    
    <?php do_action( 'fox_after_header_classic_row' ); ?>

</div><!-- .header-element-nav -->

<?php
        
    $nav_html = ob_get_clean();
        
    } ?>
    
    <?php if ( 'stack4' == $layout ) echo $nav_html; ?>

<div class="header-classic-row header-row-branding header-row-main header-stack3-main">

    <div class="container">
        
        <?php echo $logo; ?>
        
        <?php if ( $left_part ) { ?>
        <div class="header-stack3-left header-stack3-part">
            
            <?php echo $left_part; ?>
            
        </div><!-- .header-stack3-part -->
        <?php } ?>
        
        <?php if ( $right_part ) { ?>
        <div class="header-stack3-right header-stack3-part">
            
            <?php echo $right_part; ?>
            
        </div><!-- .header-stack3-part -->
        <?php } ?>

    </div><!-- .container -->
    
    <?php echo $sidebar_after_logo; ?>

</div><!-- .header-row-main -->
    
    <?php if ( 'stack3' == $layout ) echo $nav_html; ?>

<?php /* ---------------------------        INLINE       ------------------------------------ */ ?>

<?php break;
        
    case 'inline' :
        
        $row_nav_class[] = 'header-classic-row header-row-flex header-sticky-element header-row-common header-row-nav';
        
    ?>

<div class="<?php echo esc_attr( join( ' ', $row_nav_class ) ); ?>">

    <div class="container">

        <div class="header-row-part header-row-left">

            <?php echo $logo; ?>
            
        </div><!-- .header-row-part -->
        
        <div class="header-row-part header-row-right">
            
            <?php echo $nav . $social . $cart . $search_btn . $hamburger_btn; ?>
            
            <?php do_action( 'fox_header_inline_element' ); ?>
            
        </div><!-- .header-row-part -->

    </div><!-- .container -->
    
    <?php do_action( 'fox_after_header_classic_row' ); ?>

</div><!-- .main-header -->
    
<?php 
        
        break;
        
    default : break;

} // end switch $layout ?>
    
</div><!-- .header-container -->