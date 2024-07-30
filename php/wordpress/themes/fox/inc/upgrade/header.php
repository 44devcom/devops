<?php
$this->log([
    'header_sticky_height', // now we have sticky elements, no longer requires sticky height
    'header_sticky_logo',
    'header_sticky_logo_height',

    'header_transparent',
    'transparent_logo',
    'transparent_mobile_logo',

    'logo_box',
    'mega_category_loading',

    'before_header_sidebar',
    'before_header_container',
    'before_header_align',
    'before_header_box',
    'before_header_background_color',
    'after_header_sidebar',
    'after_header_container',
    'after_header_align',
    'after_header_box',
    'after_header_background_color',

], 'deprecated' );

/* BUILDER - ELEMENTOR
====================================================================================================== */
$old_header_builder = get_theme_mod( 'wi_header_builder', 'false' );
if ( 'true' == $old_header_builder ) {
    $this->set_theme_mod( 'header_engine', 'classic' );
} elseif ( 'elementor' == $old_header_builder ) {
    $this->set_theme_mod( 'header_engine', 'fox_block' );
} else {
    $this->set_theme_mod( 'header_engine', 'classic' );
}
$this->log([
    'header_builder',
    'header_elementor',
    'single_header_template',
    'page_header_template',
    'category_header_template',
    'tag_header_template',
    'author_header_template',
    'search_header_template',
    '404_header_template',
]);

/* WIDGET HEADER BUILDER - DEPRECATED
====================================================================================================== */
$this->log([
    'header_builder_float_right_from',
    'header_builder_center_logo',
    'header_builder_center_logo_height',
    'header_builder_stretch_container',
    'header_builder_valign',
    'main_header_box',
    'main_header_background_color',
    'sticky_header_element',
], 'deprecated' );

/* HEADER LAYOUT, ELEMENTS ORDER, ELEMENT SHOW/HIDE
====================================================================================================== */
$header_layout = get_theme_mod( 'wi_header_layout', 'stack1' );
if ( ! in_array( $header_layout, [ 'stack1', 'stack2', 'stack3', 'stack4', 'inline' ] ) ) {
    $header_layout = 'stack1';
}
$sticky_parts = [];
$bar = 'topbar'; // the bar of main navigation
if ( 'stack1' == $header_layout ) {
    $bar = 'topbar';
} elseif ( 'stack2' == $header_layout ) {
    $bar = 'header_bottom';
} elseif ( 'stack3' == $header_layout ) {
    $bar = 'header_bottom';
} elseif ( 'stack4' == $header_layout ) {
    $bar = 'topbar';
} elseif ( 'inline' == $header_layout ) {
    $bar = 'main_header';
}

$has_social = ( 'true' == get_theme_mod( 'wi_header_social', 'true' ) );
$has_search = ( 'true' == get_theme_mod( 'wi_header_search', 'true' ) );
$has_cart = class_exists( 'woocommerce' ) && ( 'true' == get_theme_mod( 'wi_header_cart', 'true' ) );
$has_menu = ( 'true' == get_theme_mod( 'wi_header_nav', 'true' ) );
$has_hamburger = ( 'true' == get_theme_mod( 'wi_header_hamburger', 'false' ) );
$inline_html = get_theme_mod( 'wi_header_inline_element_shortcode' );

if ( $has_menu ) {
    $sticky_parts = [ $bar ];
} else {
    $sticky_parts = [ 'main_header' ];
}

if ( in_array( $header_layout, [ 'stack1', 'stack2' , 'stack3' , 'stack4' ]  ) ) {
    $left_part = [];
    $right_part = [];
    
    if ( $has_hamburger ) {
        $left_part[] = 'hamburger';
    }
    if ( $has_social ) {
        $right_part[] = 'social';
    }
    if ( $has_cart ) {
        $right_part[] = 'cart';
    }
    
    if ( $has_search ) {
        if ( ! $left_part && ! $right_part ) {
            $right_part[] = 'search';
        } elseif ( ! $left_part ) {
            $left_part[] = 'search';
        } elseif ( ! $right_part ) {
            $right_part[] = 'search';
        } else {
            $left_part[] = 'search';
        }
    }
    
    $bar_part = [];
    if ( $has_menu ) {
        $bar_part[] = 'nav';
    }
}

switch( $header_layout ) {
    case 'stack1' :
        
        /**
         * topbar
         */
        // $this->set_theme_mod( 'topbar_left_elements', $left_part );
        // $this->set_theme_mod( 'topbar_right_elements', $right_part );
        $this->set_theme_mod( 'topbar_center_elements', [] );
        $this->set_theme_mod( 'topbar_height', 40 );
        $this->set_theme_mod( 'topbar_layout', '35-25' );
        
        /**
         * main
         */
        $this->set_theme_mod( 'main_header_layout', '11' );
        $this->set_theme_mod( 'main_header_center_elements', [ 'logo' ]);
        
        /**
         * bottom
         */
        $this->set_theme_mod( 'header_bottom_left_elements', [] );
        $this->set_theme_mod( 'header_bottom_center_elements', [] );
        $this->set_theme_mod( 'header_bottom_right_elements', [] );
        break;
        
    case 'stack2':
        
        /**
         * topbar
         */
        $this->set_theme_mod( 'topbar_left_elements', [] );
        $this->set_theme_mod( 'topbar_center_elements', [] );
        $this->set_theme_mod( 'topbar_right_elements', [] );
        
        /**
         * main header
         */
        $this->set_theme_mod( 'main_header_layout', '11' );
        $this->set_theme_mod( 'main_header_center', [ 'logo' ]);
        
        /**
         * header bottom
         */
        // $this->set_theme_mod( 'header_bottom_left_elements', $left_part );
        // $this->set_theme_mod( 'header_bottom_right_elements', $right_part );
        $this->set_theme_mod( 'header_bottom_center_elements', [] );
        $this->set_theme_mod( 'header_bottom_layout', '35-25' );
        $this->set_theme_mod( 'header_bottom_height', 40 );
        
        break;
        
    case 'stack3' :
        
        /**
         * topbar
         */
        $this->set_theme_mod( 'topbar_left_elements', [] );
        $this->set_theme_mod( 'topbar_center_elements', [] );
        $this->set_theme_mod( 'topbar_right_elements', [] );
        
        /**
         * main
         */
        $this->set_theme_mod( 'main_header_layout', '16-23-16' );
        $this->set_theme_mod( 'main_header_center', [ 'logo' ]);
        $this->set_theme_mod( 'main_header_left_elements', $left_part );
        $this->set_theme_mod( 'main_header_right_elements', $right_part );
        
        /**
         * header bottom
         */
        // $this->set_theme_mod( 'header_bottom_enable', true );
        $this->set_theme_mod( 'header_bottom_left_elements', [] );
        $this->set_theme_mod( 'header_bottom_right_elements', [] );
        $this->set_theme_mod( 'header_bottom_layout', '11' );
        $this->set_theme_mod( 'header_bottom_center_elements', $bar_part );
        $this->set_theme_mod( 'header_bottom_height', 40 );
        
        break;
        
    case 'stack4' :
        
        /**
         * topbar
         */
        // $this->set_theme_mod( 'topbar_enable', true );
        $this->set_theme_mod( 'topbar_left_elements', [] );
        $this->set_theme_mod( 'topbar_right_elements', [] );
        $this->set_theme_mod( 'topbar_layout', '11' );
        $this->set_theme_mod( 'topbar_center_elements', $bar_part );
        $this->set_theme_mod( 'topbar_height', 40 );
        
        /**
         * main
         */
        $this->set_theme_mod( 'main_header_layout', '16-23-16' );
        $this->set_theme_mod( 'main_header_center', [ 'logo' ] );
        $this->set_theme_mod( 'main_header_left_elements', $left_part );
        $this->set_theme_mod( 'main_header_right_elements', $right_part );
        
        /**
         * header bottom
         */
        // $this->set_theme_mod( 'header_bottom_enable', false );
        $this->set_theme_mod( 'header_bottom_left_elements', [] );
        $this->set_theme_mod( 'header_bottom_center_elements', [] );
        $this->set_theme_mod( 'header_bottom_right_elements', [] );
        
        break;
        
    case 'inline':
        
        // right elements
        $inline_right = [];
        if ( $has_menu ) {
            $inline_right[] = 'nav';
        }
        if ( $has_social ) {
            $inline_right[] = 'social';
        }
        if ( $has_cart ) {
            $inline_right[] = 'cart';
        }
        if ( $has_search ) {
            $inline_right[] = 'search';
        }
        if ( $has_hamburger ) {
            $inline_right[] = 'hamburger';
        }
        
        // INLINE SHORTCODE
        if ( $inline_html = get_theme_mod( 'wi_header_inline_element_shortcode' ) ) {
            $inline_right[] = 'html1';
            $this->set_theme_mod( 'header_html1', $inline_html );
        }
        
        $this->set_theme_mod( 'topbar_left_elements', [] );
        $this->set_theme_mod( 'topbar_center_elements', [] );
        $this->set_theme_mod( 'topbar_right_elements', [] );
        $this->set_theme_mod( 'header_bottom_left_elements', [] );
        $this->set_theme_mod( 'header_bottom_center_elements', [] );
        $this->set_theme_mod( 'header_bottom_right_elements', [] );
        
        /**
         * main
         */
        $this->set_theme_mod( 'main_header_layout', '14-34' );
        $this->set_theme_mod( 'main_header_left_elements', [ 'logo' ] );
        $this->set_theme_mod( 'main_header_right_elements', $inline_right );
        
        break;
}

/* Elements Order
------------------------------------ */
$elements_order = get_theme_mod( 'wi_header_stack12_elements_order', '1' );
if ( in_array( $header_layout, [ 'stack1', 'stack2' ]) ) {
    
    $group_search_cart = [];
    $group_social = [];
    $group_menu = [];
    
    if ( $has_hamburger ) {
        if ( $elements_order == 1 ) {
            $group_menu[] = 'hamburger';
        } elseif ( $elements_order == 2 ) {
            $group_social[] = 'hamburger';
        } elseif ( $elements_order == 3 ) {
            $group_search_cart[] = 'hamburger';
        }
    }
    
    if ( $has_cart ) {
        $group_search_cart[] = 'cart';
    }
    if ( $has_search ) {
        $group_search_cart[] = 'search';
    }
    if ( $has_social ) {
        $group_social[] = 'social';
    }
    if ( $has_menu ) {
        $group_menu[] = 'nav';
    }
    
    switch( $elements_order ) {
            
        // search - menu -social    
        case '3' :

            // left - center - right
            $this->set_theme_mod( $bar . '_layout', '16-23-16' );
            
            // left: search & cart
            $this->set_theme_mod( $bar . '_left_elements', $group_search_cart );

            // right: social
            $this->set_theme_mod( $bar . '_right_elements', $group_social );
            
            // center: primary menu
            $this->set_theme_mod( $bar . '_center_elements', $group_menu );

            break;

        // social -menu - search    
        case '2':

            // left - center - right
            $this->set_theme_mod( $bar . '_layout', '16-23-16' );

            // left: social
            $this->set_theme_mod( $bar . '_left_elements', $group_social );

            // right: search & cart
            $this->set_theme_mod( $bar . '_right_elements', $group_search_cart );

            // center: primary menu
            $this->set_theme_mod( $bar . '_center_elements', $group_menu );

            break;

        // menu - social/search    
        case '1':

            // left - right
            $this->set_theme_mod( $bar . '_layout', '35-25' );

            // left: menu
            $this->set_theme_mod( $bar . '_left_elements', $group_menu );
            
            $group_right = array_merge( $group_social, $group_search_cart );

            // right: social & search & cart
            $this->set_theme_mod( $bar . '_right_elements', $group_right );

            break;
    }
}

$this->log([
    'header_social',
    'header_search',
    'header_cart',
    'header_nav',
    'header_hamburger',
    'header_inline_element_shortcode',
]);

$this->log([
    'header_layout',
    'header_stack12_elements_order',
]);

/* HEADER SOCIAL
====================================================================================================== */
// #header_social_size
$social_size = get_theme_mod( 'wi_header_social_size', 'medium' );
$social_style = get_theme_mod( 'wi_header_social_style', 'plain' );
if ( 'small' == $social_size ) {
    $size = 24; $font = 14;
} elseif ( 'normal' == $social_size ) {
    $size = 30; $font = 16;
} elseif ( 'bigger' == $social_size ) {
    $size = 30; $font = 17;
} elseif ( 'medium' == $social_size ) {
    $size = 36; $font = 18;
} elseif ( 'medium_plus' == $social_size ) {
    $size = 36; $font = 21;
} else {
    $size = 30; $font = 16; // safe values
}
$this->set_theme_mod( 'header_social_icon_size', $size );
$this->set_theme_mod( 'header_social_icon_font', $font );
$this->set_theme_mod( 'header_social_icon_spacing', 3 );

if ( 'plain' == $social_style ) {
    
    $this->set_theme_mod( 'header_social_icon_size', 24 );
    $this->set_theme_mod( 'header_social_icon_background', '' );
    $this->set_theme_mod( 'header_social_icon_color', '' );
    $this->set_theme_mod( 'header_social_icon_hover_background', '' );
    $this->set_theme_mod( 'header_social_icon_hover_color', '' );
    $this->set_theme_mod( 'header_social_icon_border', 0 );
    $this->set_theme_mod( 'header_social_icon_border_radius', 0 );
    
} elseif ( 'black' == $social_style ) {
    
    $this->set_theme_mod( 'header_social_icon_background', '#000' );
    $this->set_theme_mod( 'header_social_icon_color', '#fff' );
    $this->set_theme_mod( 'header_social_icon_hover_background', '#000' );
    $this->set_theme_mod( 'header_social_icon_hover_color', '#fff' );
    $this->set_theme_mod( 'header_social_icon_border', 0 );
    $this->set_theme_mod( 'header_social_icon_border_radius', 30 );
    
} elseif ( 'outline' == $social_style ) {

    $this->set_theme_mod( 'header_social_icon_background', '#fff' );
    $this->set_theme_mod( 'header_social_icon_color', '#111' );
    $this->set_theme_mod( 'header_social_icon_border_color', '#111' );
    
    $this->set_theme_mod( 'header_social_icon_hover_background', '#fff' );
    $this->set_theme_mod( 'header_social_icon_hover_color', '#111' );
    $this->set_theme_mod( 'header_social_icon_hover_border_color', '#111' );
    
    $this->set_theme_mod( 'header_social_icon_border', 1 );
    $this->set_theme_mod( 'header_social_icon_border_radius', 30 );
    
} elseif ( 'fill' == $social_style ) {
    
    $this->set_theme_mod( 'header_social_icon_background', '#fff' );
    $this->set_theme_mod( 'header_social_icon_color', '#111' );
    $this->set_theme_mod( 'header_social_icon_border_color', '#111' );
    $this->set_theme_mod( 'header_social_icon_hover_background', '#111' );
    $this->set_theme_mod( 'header_social_icon_hover_color', '#fff' );
    $this->set_theme_mod( 'header_social_icon_hover_border_color', '#111' );
    $this->set_theme_mod( 'header_social_icon_border', 1 );
    $this->set_theme_mod( 'header_social_icon_border_radius', 30 );
    
}

$this->log([
    'header_social_size',
    'header_social_style'
]);

/* HEADER STICKY
====================================================================================================== */
if ( 'true' == get_theme_mod( 'wi_header_sticky', 'true' ) ) {
    $this->set_theme_mod( 'header_sticky_parts', $sticky_parts );
} else {
    $this->set_theme_mod( 'header_sticky_parts', [] );
}
$this->set( 'header_sticky_background', '', 'header_sticky_background_color' );

$this->log([
    'header_sticky',
]);
$this->log( 'header_sticky_background_opacity', 'deprecated' );

/* Sticky border/shadow
#sticky_header_element_style
------------------------------------ */
$sticky_header_element_style = get_theme_mod( 'wi_sticky_header_element_style', 'shadow' );
if ( 'shadow' == $sticky_header_element_style ) {
    $this->set_theme_mod( 'header_sticky_shadow', 1 );

} elseif ( 'heavy-shadow' == $sticky_header_element_style ) {
    $this->set_theme_mod( 'header_sticky_shadow', 3 );

} elseif ( 'border' == $sticky_header_element_style ) {
    $this->set_theme_mod( 'header_sticky_border', [
        'bottom' => 1,
        'color' => $general_border_color,
    ]);
    $this->set_theme_mod( 'header_sticky_shadow', 0 );
} else {
    $this->set_theme_mod( 'header_sticky_border', [
        'top' => 0,
        'bottom' => 0,
    ]);
    $this->set_theme_mod( 'header_sticky_shadow', 0 );
}
$this->log( 'sticky_header_element_style' );

/* BRANDING PADDING TOP/BOTTOM
====================================================================================================== */
$this->set_theme_mod( 'main_header_padding', [
    'top' => get_theme_mod( 'wi_branding_padding_top', 14 ),
    'bottom' => get_theme_mod( 'wi_branding_padding_bottom', 14 )
]);
$this->log([
    'branding_padding_top',
    'branding_padding_bottom',
]);

/* NAV BAR HEIGHT/STRETCH
====================================================================================================== */
if ( $header_layout == 'stack1' || $header_layout == 'stack2' ) {
    // stretch
    $old_navbar_stretch = get_theme_mod( 'wi_navbar_stretch', 'content' );
    $this->set_theme_mod( $bar . '_stretch', $old_navbar_stretch );
    
}
$this->log( 'navbar_stretch' );

/* navbar stretch, height
------------------------------------ */
$old_navbar_height = get_theme_mod( 'wi_navbar_height', '' );
if ( $old_navbar_height ) {
    $old_navbar_height = absint( $old_navbar_height );
    if ( $old_navbar_height > 20 && $old_navbar_height < 200 ) {
        $this->set_theme_mod( $bar . '_height', $old_navbar_height );
    }
}

$this->log( 'navbar_height' );

/* SEARCH
====================================================================================================== */
$this->set( 'header_search_style', 'classic' );
$this->set( 'header_search_btn_size', '', 'header_search_size' );
$this->set( 'header_cart_font_size', '', 'header_search_size' );
$this->set( 'hamburger_size', '', 'header_search_size' );

$this->set( 'header_search_modal_background', null, 'search_modal_background' );
$this->set( 'header_search_modal_text_color', null, 'search_modal_color' );

$this->log([
    'header_search_style',
    'header_search_size',
    'search_modal_background',
    'search_modal_color',
]);

$this->log( 'search_modal_showing_effect', 'deprecated' );

/* LOGO
====================================================================================================== */
/* Logo
------------------------------------ */
// #logo_type
$this->set( 'logo_type', 'text' );
$logo_img_url = get_theme_mod( 'wi_logo', 0 );
if ( ! is_numeric( $logo_img_url ) ) {
    $logo_img_id = attachment_url_to_postid( $logo_img_url );
} else {
    $logo_img_id = $logo_img_url;
}
if ( $logo_img_id ) {
    $this->set_theme_mod( 'logo', $logo_img_id );
}
$this->log( 'logo' );
$this->set( 'logo_custom_link' );
$this->set( 'logo_color' );
$this->set( 'tagline_color' );
$this->set( 'logo_width', 600 );

/**
    * tagline enable
    */
if ( 'true' == get_theme_mod( 'wi_header_slogan', 'false' ) ) {
    $this->set_theme_mod( 'tagline_enable', true );
} else {
    $this->set_theme_mod( 'tagline_enable', false );
}
$this->log( 'header_slogan' );

/* NAV SKIN
====================================================================================================== */
/**
 * if it dark, then set the bar dark
 * if it light, 'restore' everything to light mode
 */
$nav_skin = get_theme_mod( 'wi_nav_skin', 'light' );
if ( 'dark' == $nav_skin ) {

    $nav_background = get_theme_mod( 'wi_nav_background' );
    if ( ! $nav_background ) {
        $nav_background = '#111';
    }
    
    // make the bar dark
    if ( $bar == 'main_header' ) {
        $this->set_theme_mod( 'main_header_background', [
            'color' => $nav_background,
        ]);
        $this->set_theme_mod( 'main_header_text_skin', 'dark' );
        
        $this->set_theme_mod( 'topbar_background', '' );
        $this->set_theme_mod( 'topbar_text_skin', 'light' );
        $this->set_theme_mod( 'header_bottom_background', '' );
        $this->set_theme_mod( 'header_bottom_text_skin', 'light' );
        
    // topbar or below header
    } else {
        $this->set_theme_mod( $bar . '_background', $nav_background );
        $this->set_theme_mod( $bar . '_text_skin', 'dark' );
        
        $this->set_theme_mod( 'main_header_background', [] );
        $this->set_theme_mod( 'main_header__text_skin', 'light' );
        
        // @note: kill the border - so border will be disabled since 6.x unless being set
        $this->set_theme_mod( $bar . '_border', [ 'top' => 0, 'bottom' => 0 ] );
        $this->set_theme_mod( $bar . '_container_border', [ 'top' => 0, 'bottom' => 0 ] );
    }

    // set default menu colors
    $this->set_color( 'nav_color', 'rgba(255,255,255,.8)' );
    $this->set_color( 'nav_hover_color', '#fff' );
    $this->set_color( 'nav_active_color', '#fff' );

} else {

    $this->set_theme_mod( 'topbar_text_skin', 'light' );
    $this->set_theme_mod( 'main_header_text_skin', 'light' );
    $this->set_theme_mod( 'header_bottom_text_skin', 'light' );
    
    $nav_background = get_theme_mod( 'wi_nav_background' );
    if ( ! $nav_background ) {
        $nav_background = '#fff';
    }

    if ( $nav_background ) {
        if ( $bar == 'main_header' ) {
            $this->set_theme_mod( 'main_header_background', [
                'color' => $nav_background,
            ]);
        } else {
            $this->set_theme_mod( $bar . '_background', $nav_background );
            
            // @note: kill the border - so border will be disabled since 6.x unless being set
            $this->set_theme_mod( $bar . '_border', [ 'top' => 0, 'bottom' => 0 ] );
            $this->set_theme_mod( $bar . '_container_border', [ 'top' => 0, 'bottom' => 0 ] );
        }
    }

    $this->set_color( 'nav_color', '#000' );
    $this->set_color( 'nav_hover_color', '#000' );
    $this->set_color( 'nav_active_color', '#000' );

}

$this->log([
    'nav_skin',
    'nav_background',
    'nav_color',
    'nav_hover_color',
    'nav_active_color',
]);

/* BRANDING BACKGROUND
====================================================================================================== */
$get = get_theme_mod( 'wi_branding_background', '' );
if ( $get && in_array( $header_layout, [ 'stack1', 'stack2', 'stack3', 'stack4' ] ) ) {
    $this->set_theme_mod( 'main_header_background', [
        'color' => $get
    ]);
}
$this->log( 'branding_background' );

/* NAV
====================================================================================================== */
$nav_active_style = get_theme_mod( 'wi_nav_active_style', '1' );
if ( '2' == $nav_active_style ) { // underline
    $this->set_theme_mod( 'nav_active_style', 'bar-bottom' );
    $this->set_theme_mod( 'nav_active_style_border_width', 100 );
    $this->set_theme_mod( 'nav_active_style_border_height', 2 );
    $this->set_theme_mod( 'nav_active_style_border_color', '' ); // currentColor
    $this->set_theme_mod( 'nav_hover_background', '' );
    $this->set_theme_mod( 'nav_active_background', '' );
} elseif ( '3' == $nav_active_style ) { // overline
    $this->set_theme_mod( 'nav_active_style', 'bar-top' );
    $this->set_theme_mod( 'nav_active_style_border_width', 100 );
    $this->set_theme_mod( 'nav_active_style_border_height', 2 );
    $this->set_theme_mod( 'nav_active_style_border_color', '' ); // currentColor
    $this->set_theme_mod( 'nav_hover_background', '' );
    $this->set_theme_mod( 'nav_active_background', '' );
} elseif ( '1' == $nav_active_style ) {
    $nav_active_bg_color = get_theme_mod( 'wi_nav_active_bg_color', '#111' );
    if ( $nav_active_bg_color ) {
        $this->set_theme_mod( 'nav_active_style', 'none' );
        $this->set_theme_mod( 'nav_hover_background', $nav_active_bg_color );
        $this->set_theme_mod( 'nav_active_background', $nav_active_bg_color );
    }
} else {
    $this->set_theme_mod( 'nav_hover_background', '' );
    $this->set_theme_mod( 'nav_active_background', '' );
}

$this->log([
    'nav_active_style',
    'nav_active_bg_color',
]);

/* #nav_has_children_indicator
------------------------------------------------------ */
$nav_has_children_indicator = get_theme_mod( 'wi_nav_has_children_indicator', '' );
$nav_has_children_indicator_content = get_theme_mod( 'wi_nav_has_children_indicator_content', 'angle-down' );
$this->set_theme_mod( 'nav_dropdown_indicator', $nav_has_children_indicator_content );
$this->set_theme_mod( 'nav_dropdown_indicator_color', $nav_has_children_indicator );

$this->log([
    'nav_has_children_indicator',
    'nav_has_children_indicator_content',
]);

/* #nav_border
------------------------------------ */
$nav_border = get_theme_mod( 'wi_nav_border', '' );
$nav_border_color = get_theme_mod( 'wi_nav_border_color' );
$nav_border_std = [
    'stack1' => 'bottom-1',
    'stack2' => 'top-3|bottom-1',
    'stack3' => 'top-3|bottom-1',
    'stack4' => 'bottom-1',
    'inline' => 'none',
];
if ( ! $nav_border && isset( $nav_border_std[ $header_layout ] ) ) {
    $nav_border = $nav_border_std[ $header_layout ];
}
// reset all borders
$this->set_theme_mod( 'topbar_container_border', [ 'top' => 0, 'bottom' => 0 ] );
$this->set_theme_mod( 'topbar_container_border', [ 'top' =>0, 'bottom' => 0 ] );

$this->set_theme_mod( 'header_bottom_container_border', [ 'top' => 0, 'bottom' => 0 ] );

if ( 'top-1' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 1, 'bottom' => 0 ] );
} elseif ( 'top-2' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 2, 'bottom' => 0 ] );
} elseif ( 'bottom-1' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 0, 'bottom' => 1 ] );
} elseif ( 'bottom-2' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 0, 'bottom' => 2 ] );
} elseif ( 'top-1|bottom-1' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 1, 'bottom' => 1 ] );
} elseif ( 'top-2|bottom-2' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 2, 'bottom' => 2 ] );
} elseif ( 'top-3|bottom-1' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 3, 'bottom' => 1 ] );
} elseif ( 'none' == $nav_border ) {
    $this->set_theme_mod(  $bar . '_container_border', [ 'top' => 0, 'bottom' => 0 ] );
}

// border color
if ( $nav_border_color ) { $this->set_theme_mod(  $bar . '_border_color', $nav_border_color ); }

$this->log([
    'nav_border',
    'nav_border_color',
]);

/* DROP DOWN
====================================================================================================== */
$submenu_style = get_theme_mod( 'wi_submenu_style', 'light' );
if ( 'dark' == $submenu_style ) {
    
    $this->set_color( 'nav_dropdown_background', '#111', 'nav_submenu_background' );
    $this->set_color( 'nav_dropdown_item_color', '#ddd', 'nav_submenu_color' );
    $this->set_color( 'nav_dropdown_item_hover_color', '#eee', 'nav_submenu_hover_color' );
    $this->set_color( 'nav_dropdown_item_hover_background', '#333', 'nav_submenu_hover_background' );
    $this->set_color( 'nav_dropdown_item_active_color', '#fff', 'nav_submenu_active_color' );
    $this->set_color( 'nav_dropdown_item_active_background', '#333', 'nav_submenu_active_background' );
    $this->set_color( 'nav_dropdown_item_sep_color', '#333', 'nav_submenu_sep_color' );

    // force no dropdown border
    $this->set_theme_mod( 'nav_dropdown_border', [ 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0 ]);
    
} else {

    $this->set_color( 'nav_dropdown_background', '#fff', 'nav_submenu_background' );
    $this->set_color( 'nav_dropdown_item_color', '#111', 'nav_submenu_color' );
    $this->set_color( 'nav_dropdown_item_hover_color', '#111', 'nav_submenu_hover_color' );
    $this->set_color( 'nav_dropdown_item_hover_background', '#f0f0f0', 'nav_submenu_hover_background' );
    $this->set_color( 'nav_dropdown_item_active_color', '#111', 'nav_submenu_active_color' );
    $this->set_color( 'nav_dropdown_item_active_background', '#f0f0f0', 'nav_submenu_active_background' );
    $this->set_color( 'nav_dropdown_item_sep_color', '#111', 'nav_submenu_sep_color' );

}

// sep is enabled by default
$this->set_theme_mod( 'nav_dropdown_item_sep', true );

$this->log([ 
    'submenu_style',
    'nav_submenu_background',
    'nav_submenu_color',
    'nav_submenu_hover_color',
    'nav_submenu_hover_background',
    'nav_submenu_active_color',
    'nav_submenu_active_background',
    'nav_submenu_sep_color'
]);

/* #nav_submenu_box
------------------------------------------------------ */
$submenu_box = json_decode( get_theme_mod( 'wi_nav_submenu_box', '' ), true );
if ( ! is_array( $submenu_box ) ) {
    $submenu_box = [];
}
if ( isset( $submenu_box[ 'padding-top' ] ) && '' !== $submenu_box[ 'padding-top' ] ) {
    $this->set_theme_mod( 'nav_dropdown_padding_top', absint( $submenu_box[ 'padding-top' ] ) );
}
if ( isset( $submenu_box[ 'padding-left' ] ) && '' !== $submenu_box[ 'padding-left' ] ) {
    $this->set_theme_mod( 'nav_dropdown_padding_left', absint( $submenu_box[ 'padding-left' ] ) );
} else {
    $this->set_theme_mod( 'nav_dropdown_padding_left', 0 );
}
$border_arr = [];
if ( isset( $submenu_box[ 'border-left-width' ] ) && '' !== $submenu_box[ 'border-left-width' ] ) {
    $border_arr[ 'left' ] = absint( $submenu_box[ 'border-left-width' ] );
}
if ( isset( $submenu_box[ 'border-right-width' ] ) && '' !== $submenu_box[ 'border-right-width' ] ) {
    $border_arr[ 'right' ] = absint( $submenu_box[ 'border-right-width' ] );
}
if ( isset( $submenu_box[ 'border-bottom-width' ] ) && '' !== $submenu_box[ 'border-bottom-width' ] ) {
    $border_arr[ 'bottom' ] = absint( $submenu_box[ 'border-bottom-width' ] );
}
if ( isset( $submenu_box[ 'border-top-width' ] ) && '' !== $submenu_box[ 'border-top-width' ] ) {
    $border_arr[ 'top' ] = absint( $submenu_box[ 'border-top-width' ] );
}
if ( ! empty($border_arr)) {
    $this->set_theme_mod( 'nav_dropdown_border', $border_arr );
}

if ( isset( $submenu_box[ 'border-color' ] ) ) {
    $this->set_theme_mod( 'nav_dropdown_border_color', $submenu_box[ 'border-color' ] );
}
if ( isset( $submenu_box[ 'border-top-left-radius' ] ) ) {
    $this->set_theme_mod( 'nav_dropdown_border_radius', absint( $submenu_box[ 'border-top-left-radius' ] ) );
}

/**
    * #nav_submenu_item_box
    */
$submenu_item_box = json_decode( get_theme_mod( 'wi_nav_submenu_item_box', '' ), true );
if ( ! is_array( $submenu_item_box ) ) {
    $submenu_item_box = [];
}
if ( isset( $submenu_item_box[ 'padding-left' ] ) && '' !== $submenu_item_box[ 'padding-left' ] ) {
    $this->set_theme_mod( 'nav_dropdown_item_padding', absint( $submenu_item_box[ 'padding-left' ] ) );
}

$this->log([
    'nav_submenu_box',
    'nav_submenu_item_box',
]);