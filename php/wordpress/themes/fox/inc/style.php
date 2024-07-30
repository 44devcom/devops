<?php
/* hook fox_css
================================================================================================ */
add_action( 'wp_enqueue_scripts', 'fox56_inline_style', 20000 );
function fox56_inline_style() {

    $css = apply_filters( 'fox_css56', '', 'frontend' );
    
    // attach it to <head />
    wp_add_inline_style( 'style56', $css );

}

/* single css
================================================================================================ */
add_action( 'fox_custom_css', 'fox56_single_css' );
function fox56_single_css() {
    if ( ! is_single() ) {
        return;
    }
    $css = [];
    $id = get_the_ID();

    /* padding
    --------------------------------------- */
    $padding_top = get_post_meta( $id, '_wi_padding_top', true );
    if ( '' !== $padding_top ) {
        if ( is_numeric( $padding_top ) ) {
            $padding_top .= 'px';
        }
        $css[] = 'body.single .single56{padding-top:'.$padding_top.'}';
    }
    $padding_bottom = get_post_meta( $id, '_wi_padding_bottom', true );
    if ( '' !== $padding_bottom ) {
        if ( is_numeric( $padding_bottom ) ) {
            $padding_bottom .= 'px';
        }
        $css[] = 'body.single .single56{padding-bottom:'.$padding_bottom.'}';
    }

    /* background
    --------------------------------------- */
    $background = get_post_meta( $id, '_wi_background_color', true );
    if ( $background ) {
        $css[] = 'body.single {background:' . $background . ';}';
    }

    /* color
    --------------------------------------- */
    $color = get_post_meta( $id, '_wi_text_color', true );
    if ( $color ) {
        $css[] = 'body.single {color:' . $color . ';}';
    }

    echo join( '', $css );
}

/* page css
================================================================================================ */
add_action( 'fox_custom_css', 'fox56_page_css' );
function fox56_page_css() {
    if ( ! is_page() ) {
        return;
    }
    if ( is_page_template( 'page-elementor.php' ) ) {
        return;
    }
    $css = [];
    $id = get_the_ID();

    /* padding
    --------------------------------------- */
    $padding_top = get_post_meta( $id, '_wi_padding_top', true );
    if ( '' !== $padding_top ) {
        if ( is_numeric( $padding_top ) ) {
            $padding_top .= 'px';
        }
        $css[] = 'body.page .page56{padding-top:'.$padding_top.'}';
    }
    $padding_bottom = get_post_meta( $id, '_wi_padding_bottom', true );
    if ( '' !== $padding_bottom ) {
        if ( is_numeric( $padding_bottom ) ) {
            $padding_bottom .= 'px';
        }
        $css[] = 'body.page .page56{padding-bottom:'.$padding_bottom.'}';
    }

    /* background
    --------------------------------------- */
    $background = get_post_meta( $id, '_wi_background_color', true );
    if ( $background ) {
        $css[] = 'body.page {background:' . $background . ';}';
    }

    /* color
    --------------------------------------- */
    $color = get_post_meta( $id, '_wi_text_color', true );
    if ( $color ) {
        $css[] = 'body.page {color:' . $color . ';}';
    }

    echo join( '', $css );
}

/* body_class for options
 * this will be the class to control global CSS
================================================================================================ */
add_filter( 'body_class', 'fox56_style_body_class' );
function fox56_style_body_class( $class ) {

    /* LAYOUT
    ------------------------------------------------------- */
    if ( get_theme_mod( 'layout_boxed' ) ) {
        $class[] = 'layout-boxed';

        // hand drawn legacy
        if ( get_theme_mod( 'hand_drawn' ) ) {
            $class[] = 'body--hand-drawn';
        }
    }

    /* TAG CLOUD
    ------------------------------------------------------- */
    $tagcloud_style = get_theme_mod( 'tagcloud_style', '1' );
    $class[] = 'style--tagcloud-' . $tagcloud_style ;

    /* DARK MODE
    ------------------------------------------------------- */
    $darkmode = get_theme_mod( 'darkmode', false );
    if ( $darkmode ) {
        $class[] = 'darkmode';
    }

    /* BLOCKQUOTE ICON
    ------------------------------------------------------- */
    $blockquote_icon = get_theme_mod( 'blockquote_icon' );
    $class[] = 'style--blockquote-' . $blockquote_icon;
    $blockquote_icon_icon = get_theme_mod( 'blockquote_icon_icon', '1' );
    if ( $blockquote_icon == 'above' || $blockquote_icon == 'overlap' ) {
        $class[] = 'style--blockquote--icon-' . $blockquote_icon_icon;
    }

    /* RETURN
    ------------------------------------------------------- */
    return $class;
}