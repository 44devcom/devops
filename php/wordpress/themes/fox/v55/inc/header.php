<?php
/**
 * Site Branding (Logo + Site Description)
 * problem 1: display or not the tagline
 * problem 2: <h1> tag
 * problem 3: text/image logo
 * problem 4: sticky logo
 * 
 * since 4.3
 * -------------------------------------------------------------------------------- */
if ( ! function_exists( 'fox_site_branding' ) ) :
function fox_site_branding( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        'layout' => 'stack1',
        'header_sticky' => true,
        'header_transparent' => false,
    ]);
    
    $layout = $params['layout'];
    
    $class = [
        'wi-logo-main',
        'fox-logo'
    ];
    
    /**
     * logo tag
     * h1 or h2
     * @since 4.0
     */
    $htag = 'h2';
    if ( is_home() ) $htag = 'h1';
    if ( is_page() ) {
        if ( 'true' != fox_get_page_option( 'post_header', 'true' ) ) {
            $htag = 'h1';
        }
    } elseif ( is_single() ) {
        if ( 'true' != fox_get_single_option( 'post_header', 'true' ) ) {
            $htag = 'h1';
        }
    }
    
    /**
     * show description
     */
    $show_description = ( 'true' == get_theme_mod( 'wi_header_slogan', 'false' ) );
    if ( $layout == 'inline' ) {
        $show_description = false;
    }
    
    /**
     * logo type
     */
    $logo_type = get_theme_mod( 'wi_logo_type', 'text' );
    if ( 'image' != $logo_type ) $logo_type = 'text';
    $class[] = 'logo-type-' . $logo_type;
    
    $logo_html = '';
    if ( 'text' == $logo_type ) {
        
        $logo_html = fox_format( '<span class="text-logo">{}</span>', get_bloginfo( 'title' ) );
        
    } else {
        
        $logo_html = '';
        $logo_url = get_theme_mod( 'wi_logo' );
        if ( $logo_url ) {
            $logo_id = attachment_url_to_postid( $logo_url );
            if ( $logo_id ) {
                $logo_html = wp_get_attachment_image( $logo_id, 'full', false, [ 'class' => 'main-img-logo' ] );
            }
        } else {
            $logo_url = get_template_directory_uri() . '/images/logo.png';
        }
        
        if ( ! $logo_html ) {
            
            $logo_html = '<img src="' . esc_url( $logo_url ) .'" alt="' . esc_html__( 'Logo', 'wi' ) . '" class="main-img-logo" />';
            
        }
        
        // sticky header logo
        if ( $params[ 'header_sticky' ] && 'inline' == $layout ) {
            
            $logo_html = fox_get_sticky_logo_html() . $logo_html;
            
        }
        
        if ( $params[ 'header_transparent' ] && 'inline' == $layout ) {
            
            $transparent_logo_url = get_theme_mod( 'wi_transparent_logo' );
            $transparent_logo_html = '';
            if ( $transparent_logo_url ) {
                $transparent_logo_id = attachment_url_to_postid( $transparent_logo_url );
                if ( $transparent_logo_id ) {
                    $transparent_logo_html = wp_get_attachment_image( $transparent_logo_id, 'full', false, [ 'class' => 'transparent-img-logo' ] );
                }
            }
            
            if ( $transparent_logo_html ) {
                $logo_html = $transparent_logo_html . $logo_html;
            }
            
        }
        
    }
    
    /**
     * custom logo url
     * @since 4.0
     */
    $url = get_theme_mod( 'wi_logo_custom_link' );
    if ( ! $url ) {
        $url = home_url( '/' );
    }
    
    ?>

    <div id="logo-area" class="fox-logo-area fox-header-logo site-branding">
        
        <div id="wi-logo" class="fox-logo-container">
            
            <?php echo '<' . $htag . ' class="' . esc_attr( join( ' ',  $class ) ) . '" id="site-logo">'; ?>
                
                <a href="<?php echo esc_url( $url ); ?>" rel="home">
                    
                    <?php echo $logo_html; ?>
                    
                </a>
                
            <?php echo '</' . $htag . '>'; ?>

        </div><!-- .fox-logo-container -->

        <?php if ( $show_description ) fox_site_description(); ?>

    </div><!-- #logo-area -->

    <?php
    
}
endif;

if ( ! function_exists( 'fox_site_description' ) ) :
/**
 * Site Description / Tagline
 * since 4.0
 * -------------------------------------------------------------------------------- */
function fox_site_description() {
    
    $class = [ 'slogan', 'site-description' ];
    ?>  
    <h3 class="<?php echo esc_attr( join( ' ', $class ) ); ?>"><?php echo do_shortcode( get_bloginfo('description') );?></h3>
    <?php
}
endif;

/**
 * minimal logo
 * @since 4.0
 * -------------------------------------------------------------------------------- */
function fox_min_logo() {
    
    if ( 'true' != get_theme_mod( 'wi_min_logo', 'true' ) ) return;
    
    $class = [ 'minimal-logo', 'min-logo' ];
    $html = '';
    $type = get_theme_mod( 'wi_min_logo_type', 'text' );
    
    if ( 'text' == $type ) {
        
        $class[] = 'min-logo-text';
        $html = '<span class="text-logo min-text-logo">' . get_bloginfo( 'name' ) . '</span>';
        
    } else {
        
        $class[] = 'min-logo-image';
        
        $logo_minimal = get_theme_mod( 'wi_logo_minimal' );
        $logo_white = get_theme_mod( 'wi_logo_minimal_white' );
        
        $logo_minimal_id = attachment_url_to_postid( $logo_minimal );
        if ( $logo_minimal_id ) {
            $html .= wp_get_attachment_image( $logo_minimal_id, 'full', false, [ 'class' => 'minimal-logo-img' ] );
        }
        
        $logo_white_id = attachment_url_to_postid( $logo_white );
        if ( $logo_white_id ) {
            $html .= wp_get_attachment_image( $logo_white_id, 'full', false, [ 'class' => 'minimal-logo-img-white' ] );
        }
        
    }
    ?>

    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

            <?php echo $html; ?>

        </a>

    </div><!-- .minimal-logo -->

    <?php
    
}

/**
 * sticky logo
 * @since 4.3
 * -------------------------------------------------------------------------------- */
function fox_get_sticky_logo_html() {
    
    $sticky_logo_html = '';
    $sticky_logo_url = get_theme_mod( 'wi_header_sticky_logo' );

    if ( $sticky_logo_url ) {

        $sticky_logo_id = attachment_url_to_postid( $sticky_logo_url );
        if ( $sticky_logo_id ) {
            $sticky_logo_html = wp_get_attachment_image( $sticky_logo_id, 'full', false, [ 'class' => 'sticky-img-logo' ] );
        } else {
            $sticky_logo_html = '<img src="' . esc_url( $sticky_logo_url ) .'" alt="' . esc_html__( 'Sticky Logo', 'wi' ) . '" class="sticky-img-logo" />';
        }

        $sticky_logo_html;

    }
    
    return $sticky_logo_html;
    
}

/**
 * main navigation
 * @since 4.0
 * -------------------------------------------------------------------------------- */
function fox_header_nav() {
    
    if ( 'true' != get_theme_mod( 'wi_header_nav', 'true' ) ) return;
    
    $cached_value = false; // get_transient( 'fox_primary_menu' );
    if ( ! $cached_value ) {
        ob_start();
    
        $indicator_content = get_theme_mod( 'wi_nav_has_children_indicator_content', 'angle-down' );
        $container_class = [ 'menu', 'style-indicator-' . $indicator_content ];

        if ( has_nav_menu('primary') ): ?>

        <nav id="wi-mainnav" class="navigation-ele wi-mainnav" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">

            <?php wp_nav_menu(array(
                'theme_location'	=>	'primary',
                'depth'				=>	0,
                'container_class'	=>	join( ' ', $container_class ),
            ));?>

        </nav><!-- #wi-mainnav -->

        <?php else: ?>

        <?php echo '<div id="wi-mainnav"><em class="no-menu">'.sprintf(__('Go to <a href="%s">Appearance > Menu</a> to set "Primary Menu"','wi'),get_admin_url('','nav-menus.php')).'</em></div>'; ?>

        <?php endif;
        
        $cached_value = ob_get_clean();
        
        // set_transient( 'fox_primary_menu', $cached_value, DAY_IN_SECONDS );
        
    }
    
    echo $cached_value;
    
}

/**
 * header social
 * @since 4.0
 * -------------------------------------------------------------------------------- */
function fox_header_social() {

    // size since 4.3
    $size = get_theme_mod( 'wi_header_social_size', 'medium' );
    
    // style since 4.3
    $style = get_theme_mod( 'wi_header_social_style', 'plain' );
    
    fox_social_icons([
        'extra_class' => 'header-social',
        'style' => $style,
        'size'  => $size,
    ]);

}

/**
 * header search
 * @since 4.0
 * -------------------------------------------------------------------------------- */
function fox_header_search() {
    
    $style = get_theme_mod( 'wi_header_search_style', 'classic' );
    if ( 'modal' != $style ) $style = 'classic';
    
    $class = [
        'header-search-wrapper',
        'header-search-' . $style
    ];
    
if ( 'classic' == $style ) :
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <span class="search-btn-classic search-btn">
        <?php echo fox_icon_search(); ?>
    </span>
    
    <div class="header-search-form header-search-form-template">
        
        <div class="container">
    
            <?php get_search_form(); ?>
            
        </div><!-- .header-search-form -->
    
    </div><!-- #header-search -->
    
</div><!-- .header-search-wrapper -->

<?php else : // MODAL SEARCH

    // more options, since 4.6.2
    $modal_class = [ 'modal-search-wrapper' ];
    $showing_effect = get_theme_mod( 'wi_search_modal_showing_effect', 'slide-right' );
    $modal_class[] = 'modal-showing-' . $showing_effect;
    
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <span class="search-btn search-btn-modal">
        <?php echo fox_icon_search(); ?>
    </span>
    
    <div class="<?php echo esc_attr( join( ' ', $modal_class ) ); ?>">
        
        <div class="container">
            
            <div class="modal-search-container">
    
                <?php get_search_form(); ?>
                
                <?php fox_search_nav(); ?>
                
            </div><!-- .modal-search-container -->
            
        </div><!-- .header-search-form -->
        
        <span class="close-modal"><i class="feather-x"></i></span>
    
    </div><!-- .modal-search-wrapper -->
    
</div><!-- .header-search-wrapper -->

<?php
    
    endif; // header search style

}

/**
 * search menu
 * @since 4.0
 * -------------------------------------------------------------------------------- */
function fox_search_nav() {
    
    if ( has_nav_menu( 'search-menu' ) ) { ?>

    <h3 class="search-nav-heading small-heading"><?php echo fox_word( 'suggestions' ); ?></h3>

    <nav id="search-menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
        
        <?php wp_nav_menu( array (
            'theme_location'	=>	'search-menu',
            'depth'				=>	1,
            'container_class'	=>	'menu',
        ) ); ?>
        
    </nav><!-- #search-menu -->

    <?php }
    
}

/**
 * check if use transparent header
 * return true/false
 * @since 4.4.4
 * -------------------------------------------------------------------------------- */
function fox_is_transparent_header() {
    
    $layout = get_theme_mod( 'wi_header_layout', 'stack1' );
    if ( 'inline' != $layout ) {
        return false;
    }
    
    if ( 'true' != get_theme_mod( 'wi_header_transparent', 'false' ) ) {
        return false;
    }
    
    // it happens the homepage
    if ( is_home() ) {
        return true;
    }
    
    // it happens on hero items
    // when we don't use minimal header
    if ( is_single() ) {
        return 'full' == fox_hero_type() && ! fox_is_minimal_header();
    }
    
    // false for other cases
    return false;
    
}

/**
 * Header Transparent
 * @since 4.4.4
 */
add_filter( 'body_class', 'fox_header_transparent_class' );
function fox_header_transparent_class( $cl ) {
    
    if ( fox_is_transparent_header() ) {
        $cl[] = 'site-header-transparent';
    }
    
    return $cl;
}

/**
 * Fetch Tax Mega Items
 * @since 4.0
 * -------------------------------------------------------------------------------- */
add_action( 'wp_ajax_nav_item_mega', 'fox_fetch_tax_item_data' );
add_action( 'wp_ajax_nopriv_nav_item_mega', 'fox_fetch_tax_item_data' );
function fox_fetch_tax_item_data( ) {
    
    $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    
    // Verify nonce field passed from javascript code
    if ( ! wp_verify_nonce( $nonce, 'nav_mega_nonce' ) )
        die ( 'Busted!');
    
    $item_id = isset( $_POST[ 'item_id' ] ) ? $_POST[ 'item_id' ] : [];
    
    $tax_id = get_post_meta( $item_id, '_menu_item_object_id', true );
    if ( ! $tax_id ) {
        return;
    }
    
    $args = [
        'post_type'             => 'post',
        'post_status'           => 'publish',
        'posts_per_page'        => 3,
        'no_found_rows'         => true,
        'ignore_sticky_posts'   => 1,
        'cat'                   => $tax_id,
    ];
    
    $query = new WP_Query( $args );
    
    $json = [];
    
    if ( $query->have_posts() ) {
        
        // echo '<ul class="sub-menu submenu-display-items">';
        
        while( $query->have_posts() ) {
            
            $query->the_post();
            
            $item_data = [
                'thumbnail' => '',
                'title' => '',
            ];
            
            ob_start();
            fox_thumbnail([
                'thumbnail' => get_theme_mod( 'wi_thumbnail', 'landscape' ),
                'thumbnail_custom' => false,
                'thumbnail_extra_class' => 'post-nav-item-thumbnail',
                
                'thumbnail_format_indicator' => true,
                'thumbnail_view' => false,
                'thumbnail_index' => false,
                'thumbnail_review_score' => false,
                
                'thumbnail_hover' => 'none',
                'thumbnail_showing_effect' => 'none',
                
                'thumbnail_placeholder' => true,
                'thumbnail_shape' => 'acute',
            ]);
            
            $item_data[ 'thumbnail' ] = ob_get_clean();
            
            ob_start();
            
            fox_post_title([ 'title_extra_class' => 'post-nav-item-title', 'title_tag' => 'h3', ]);
            
            $item_data[ 'title' ] = ob_get_clean();
            
            $json[] = $item_data;
            
        }
        
    }
    
    wp_reset_query();
    
    echo json_encode( $json );
    die();
    
}

/**
 * Menu item class
 * @since 2.0
 * -------------------------------------------------------------------------------- */
if ( !function_exists( 'wi_nav_menu_css_class' ) ) :
add_filter( 'nav_menu_css_class', 'wi_nav_menu_css_class', 10, 4 );
function wi_nav_menu_css_class( $classes, $item, $args, $depth ) {

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
endif;

/**
 * Mega menu by FOX Block
 * @since 5.4
 * -------------------------------------------------------------------------------- */
add_filter( 'nav_menu_link_attributes', 'wi_fox_block_mega_adjust_url', 10, 4 );
function wi_fox_block_mega_adjust_url( $atts, $item, $args, $depth ) {
    
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
if ( !function_exists( 'wi_nav_menu_item_title' ) ) :
add_filter( 'nav_menu_item_title', 'wi_nav_menu_item_title', 10, 4 );
function wi_nav_menu_item_title( $title, $item, $args, $depth ) {

    if ( $icon = trim( get_post_meta( $item->ID, 'menu-item-menu-icon', true ) ) ) {

        $icon_html = '';
        // check if it's an image
        if ( 'http' == strtolower( substr( $icon, 0, 4 ) ) ) {
            $icon_html = '<span class="menu-icon-img"><img src="' . esc_url( $icon ). '" /></span>';
        } else {
            $icon = strtolower( $icon );
            if ( substr( $icon, 0, 7 ) == 'feather' || substr( $icon, 0, 6 ) == 'fa fa-' ) {
                
            } else {
                $icon = 'fa fa-' . $icon;
            }
            $icon_html = '<span class="menu-icon-icon"><i class="' . esc_attr( $icon ) . '"></i></span>';
        }
        
        $title = $icon_html . $title;

    }

    return $title;

}
endif;

/**
 * Mark up for FOX Block as Mega Menu
 * @since 5.4
 * -------------------------------------------------------------------------------- */
add_filter( 'walker_nav_menu_start_el', 'fox_nav_block_mega_markup', 0, 5 );
function fox_nav_block_mega_markup( $item_output, $item, $depth, $args ) {
    
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
add_filter( 'walker_nav_menu_start_el', 'fox_nav_category_mega_markup', 0, 4 );
function fox_nav_category_mega_markup( $item_output, $item, $depth, $args ) {
    
    if ( ! $depth && 'taxonomy' == $item->type && 'category' == $item->object && get_post_meta( $item->ID, 'menu-item-mega', true ) ) {
        
        $markup = '';
        
        $pseudo_thumbnail_cl = [ 'nav-thumbnail-wrapper' ];
        $std_size = get_theme_mod( 'wi_blog_grid_thumbnail', 'landscape' );
        if ( in_array( $std_size, [ 'landscape', 'square', 'portrait', 'large' ] ) ) {
            $pseudo_thumbnail_cl[] = 'pseudo-thumbnail-' . $std_size;
        }
            
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
                            <?php fox_thumbnail([
                                    'thumbnail' => 'landscape',
                                    'thumbnail_custom' => false,
                                    'thumbnail_extra_class' => 'post-nav-item-thumbnail',

                                    'thumbnail_format_indicator' => true,
                                    'thumbnail_view' => false,
                                    'thumbnail_index' => false,
                                    'thumbnail_review_score' => false,

                                    'thumbnail_hover' => 'none',
                                    'thumbnail_showing_effect' => 'none',

                                    'thumbnail_placeholder' => true,
                                    'thumbnail_shape' => 'acute',
                                ]);
                            ?>
                        </div>

                        <div class="post-nav-item-text">
                            <?php fox_post_title([ 'title_extra_class' => 'post-nav-item-title', 'title_tag' => 'h4', ]); ?>
                        </div><!-- .post-nav-item-text -->

                    </article><!-- .post-nav-item-inner -->

                </li><!-- .post-nav-item.menu-item -->
                <?php
                
            }
            
        }
        wp_reset_query();
        
        $markup = ob_get_clean();
        $markup = '<ul class="sub-menu submenu-display-items">' . $markup . '<span class="caret"></span></ul>';
        
        $item_output .= $markup;
        
    }
    
    return $item_output;
    
}

/**
 * Before Header
 * @since 4.0
 * -------------------------------------------------------------------------------- */
add_action( 'fox_before_header', 'fox_before_header_sidebar' );
function fox_before_header_sidebar() {
    
    $show_on = get_theme_mod( 'wi_before_header_sidebar', 'all' );
    $show_on = explode( ',', $show_on );
    
    $show = ( in_array( 'all', $show_on ) ) ||
        ( in_array( 'home', $show_on ) && is_home() ) ||
        ( in_array( 'archive', $show_on ) && is_archive() ) ||
        ( in_array( 'post', $show_on ) && is_singular( 'post' ) ) ||
        ( in_array( 'page', $show_on ) && is_page() );
    
    $show = apply_filters( 'show_before_header_sidebar', $show );
    if ( ! $show ) return;
    
    $container = get_theme_mod( 'wi_before_header_container', 'true' );
    
    $align = get_theme_mod( 'wi_before_header_align', 'center' );
    if ( 'left' != $align && 'right' != $align ) $align = 'center';
    
    $class = [
        'widget-area',
        'header-sidebar',
        'wide-sidebar',
        'header-row',
        'before-header'
    ];
    $class[] = 'align-' . $align;
    
    if ( 'before-header' == fox_get_sticky_header_element() ) $class[] = 'header-sticky-element';
    
    /**
     * Before header sidebar
     */
    if ( is_active_sidebar( 'before-header' ) ) { ?>

    <div id="before-header" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
        <?php if ( 'true' == $container ) echo '<div class="container">' ?>

        <?php dynamic_sidebar( 'before-header' ); ?>
        
        <?php if ( 'true' == $container ) echo '</div><!-- .container -->' ?>

    </div><!-- .widget-area -->

    <?php }
    
}

/**
 * After Header
 * @since 4.0
 * -------------------------------------------------------------------------------- */
add_action( 'fox_after_header', 'fox_after_header_sidebar' );
function fox_after_header_sidebar() {
    
    $show_on = get_theme_mod( 'wi_after_header_sidebar', 'all' );
    $show_on = explode( ',', $show_on );
    
    $show = ( in_array( 'all', $show_on ) ) ||
        ( in_array( 'home', $show_on ) && is_home() ) ||
        ( in_array( 'archive', $show_on ) && is_archive() ) ||
        ( in_array( 'post', $show_on ) && is_singular( 'post' ) ) ||
        ( in_array( 'page', $show_on ) && is_page() );
    
    $show = apply_filters( 'show_after_header_sidebar', $show );
    if ( ! $show ) return;
    
    $container = get_theme_mod( 'wi_after_header_container', 'true' );
    
    $align = get_theme_mod( 'wi_after_header_align', 'center' );
    if ( 'left' != $align && 'right' != $align ) $align = 'center';
    
    $class = [
        'widget-area',
        'header-sidebar',
        'wide-sidebar',
        'header-row',
        'after-header',
    ];
    $class[] = 'align-' . $align;
    
    if ( 'after-header' == fox_get_sticky_header_element() ) $class[] = 'header-sticky-element';
    
    /**
     * Below header sidebar
     */
    if ( is_active_sidebar( 'after-header' ) ) { ?>

    <div id="after-header" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <?php if ( 'true' == $container ) echo '<div class="container">' ?>

        <?php dynamic_sidebar( 'after-header' ); ?>
        
        <?php if ( 'true' == $container ) echo '</div><!-- .container -->' ?>

    </div><!-- .widget-area -->

    <?php }
    
}

/**
 * Show/Hide Header on singular
 * @since 4.0
 * -------------------------------------------------------------------------------- */
add_filter( 'fox_show_header', 'fox_single_show_hide_header' );
function fox_single_show_hide_header( $show ) {
    
    $postid = fox_page_id();
    if ( ! $postid ) return $show;
        
    $single_show = get_post_meta( $postid, '_wi_show_header', true );
    if ( 'true' == $single_show ) {
        $show = true;
    } elseif ( 'false' == $single_show ) {
        $show = false;
    }
    
    return $show;
    
}

/**
 * Header Builder Problems
 * @since 4.0
 * -------------------------------------------------------------------------------- */
add_filter( 'fox_css', 'fox_header_builder_float_right_from' );
function fox_header_builder_float_right_from( $css ) {
    
    $float_right = intval( get_theme_mod( 'wi_header_builder_float_right_from', '-1' ) );
    if ( $float_right > 0 ) {
        $css .= '.main-header .widget:nth-child(' . $float_right . '){margin-left: auto;}';
    }
    
    return $css;
    
}

/**
 * return the sticky header element
 * @since 4.0
 */
function fox_get_sticky_header_element() {
    
    $element = get_theme_mod( 'wi_sticky_header_element', 'main-header' );
    return apply_filters( 'fox_sticky_header_element', $element );
    
}

/**
 * header inline custom element
 * @since 4.6.8
 */
add_action( 'fox_header_inline_element', 'fox_header_inline_element_hook' );
function fox_header_inline_element_hook() {
    
    $sc = get_theme_mod( 'wi_header_inline_element_shortcode' );
    echo do_shortcode( $sc );
    
}

/**
 * since 4.7.2
 */
add_filter( 'fox_header_extra_element', 'fox_header_extra_element_hook' );
function fox_header_extra_element_hook( $ele ) {
    
    $sc = get_theme_mod( 'wi_header_inline_element_shortcode' );
    return do_shortcode( $sc );
    
}

/**
 * Header Elementor
 * @since 4.9
 * -------------------------------------------------------------------------------- */
if ( ! function_exists( 'fox_header_block' ) ) :
function fox_header_block( $block_id ) {
    return fox_block( $block_id );
}
endif;