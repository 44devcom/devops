<?php
/* SINGLE POST RENDER
=============================================================== */
if ( ! function_exists( 'fox56_single' ) ) :
function fox56_single() {
    ?>
<div class="single-placement"><?php fox56_single_inner(); ?></div>
    <?php
}
endif;
function fox56_single_inner() {

    $cl = [ 'single56' ];

    /* ---------------------    layout */
    $layout = get_post_meta( get_the_ID(), '_wi_style', true );
    if ( ! $layout ) {
        $layout = get_theme_mod( 'single_style', '1' );
    }
    if ( ! in_array( $layout, ['1','2','3','4','5','6','1b'])) {
        $layout = '1';
    }
    $cl[] = 'single56--' . $layout;
    
    /* ---------------------    sidebar state */
    $sidebar_state = get_post_meta( get_the_ID(), '_wi_sidebar_state', true );
    if ( ! $sidebar_state ) {
        $sidebar_state = get_theme_mod( 'single_sidebar_state', 'sidebar-right' );
    }
    $has_sidebar = false;
    if ( $sidebar_state == 'sidebar-left' ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--left';
        $has_sidebar = true;
    } elseif ( $sidebar_state == 'sidebar-right' ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--right';
        $has_sidebar = true;
    } else {
        $cl[] = 'no-sidebar';
    }
    if ( $has_sidebar ) {
        if ( get_theme_mod( 'sticky_sidebar' ) ) {
            $cl[] = 'hassidebar--sticky';
        }
    }

    /* ---------------------    content width */
    $single_content_width = get_post_meta( get_the_ID(), '_wi_content_width', true );
    if ( ! $single_content_width ) {
        $single_content_width = get_theme_mod( 'single_content_width', 'full' );
    }
    if ( 'narrow' != $single_content_width ) {
        $single_content_width = 'full';
    }
    $cl[] = 'single56--' . $single_content_width;

    /* ---------------------    thumbnail stretch
    logic goes here, when thumbnail should strech?
    */
    // thumbnail being trapped by sidebar
    $single_thumbnail_stretch = get_post_meta( get_the_ID(), '_wi_thumbnail_stretch', true );
    if ( ! $single_thumbnail_stretch ) {
        $single_thumbnail_stretch = get_theme_mod( 'single_thumbnail_stretch', 'stretch-none' );
    }
    if ( $layout == 1 || $layout == '1b' ) {
        // this case, we forces its strech to be container
        if ( $has_sidebar ) {
            $single_thumbnail_stretch = 'stretch-container';
        // otherwise, the strech can be anything    
        } else {
        }
    // this case, thumbnail is not trapped, it can be streched to anything   
    } elseif ( $layout == 2 || $layout == 3 ) {
        
    // other cases: thumbnail should not stretch    
    } else {
        $single_thumbnail_stretch = 'stretch-none';
    }
    
    $cl[] = 'single56--thumbnail-' . $single_thumbnail_stretch;

    /* ---------------------    content link style */
    $content_link_style = get_theme_mod( 'content_link_style', '1' );
    if ( ! in_array( $content_link_style, [ '1', '2', '3', '4' ])) {
        $content_link_style = '1';
    }
    $cl[] = 'single56--link-' . $content_link_style;

    /* ---------------------    stretch content images */
    if ( get_theme_mod( 'single_content_image_stretch' ) ) {
        // we'll strech content when:
            // narrow content
            // or no sidebar
        if ( 'narrow' == $single_content_width || ! $has_sidebar ) {
            $cl[] = 'single56--content-image-stretch';
        }    
    }

    /* ---------------------    single_small_heading_style */
    $single_small_heading_style = get_theme_mod( 'single_heading_style', 'normal' );
    if ( 'around' != $single_small_heading_style ) {
        $single_small_heading_style = 'normal';
    }
    $cl[] = 'single56--small-heading-' . $single_small_heading_style;

    /* ---------------------    should stretch */
    $can_stretch_wide = true;
    $can_stretch_full = true;
    if ( $has_sidebar && 'narrow' != $single_content_width ) {
        $can_stretch_wide = false;
    }
    if ( $has_sidebar ) {
        $can_stretch_full = false;
    }
    if ( $can_stretch_full ) {
        $cl[] = 'can-stretch-full';
    }
    if ( $can_stretch_wide ) {
        $cl[] = 'can-stretch-wide';
    }
    ?>
<article id="wi-content" <?php post_class( $cl ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <?php switch( $layout ) {

        /* ---------------------- layout 1 */
        case '1' : ?>
        <?php fox56_single_top(); ?>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_single_thumbnail(); ?>
                <?php fox56_single_header(); ?>
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>

        <?php break;

        /* ---------------------- layout 1b */
        case '1b': ?>

        <?php fox56_single_top(); ?>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_single_header(); ?>
                <?php fox56_single_thumbnail(); ?>
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>
        <?php break; ?>

        <?php /* ---------------------- layout 2 */
        case '2': ?>

        <?php fox56_single_top(); ?>
        <div class="container container--single-header single56__outer">
            <?php fox56_single_header(); ?>
            <?php fox56_single_thumbnail(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>

        <?php break; ?>

        <?php /* ---------------------- layout 3 */
        case '3': ?>

        <?php fox56_single_top(); ?>
        <div class="container container--single-header single56__outer">
            <?php fox56_single_thumbnail(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_single_header(); ?>
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>
        <?php break; ?>

        <?php /* ---------------------- layout 4 */
        case '4': ?>

        <div class="hero56-placement-full">
            <?php fox56_single_hero_full(); ?>
        </div>
        <?php fox56_single_top(); ?>
        <div class="container container--main">
            <div class="primary56">
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>
        <?php break; ?>

        <?php /* ---------------------- layout 5 */
        case '5': ?>

        <div class="hero56-placement-half">
            <?php fox56_single_hero_half(); ?>
        </div>
        <?php fox56_single_top(); ?>
        <div class="container container--main">
            <div class="primary56">
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>
        <?php break; ?>

        <?php /* ---------------------- layout 6 */
        case '6': ?>

        <?php fox56_single_top(); ?>
        <div class="container container--6 single56__outer">
            <?php fox56_single_thumbnail(); ?>
            <?php fox56_single_header(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_single_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_single_sidebar(); } ?>
        </div>
        <?php fox56_single_bottom(); ?>
        <?php break; ?>

    <?php } // end switch ?>
    
</article><!-- .post -->
<?php
}

/* HERO HALF
=============================================================== */
function fox56_single_hero_half() {
    $cl = [ 'hero56', 'hero56--half' ];

    /* ----------------     skin - since 4.3 */
    $skin = get_post_meta( get_the_ID(), '_wi_hero_half_skin', true );
    if ( ! $skin ) {
        $skin = get_theme_mod( 'single_hero_half_skin', 'light' );
    }
    if ( 'dark' != $skin ) {
        $skin = 'light';
    }
    $cl[] = 'hero56--' . $skin;

    /* ----------------     caption */
    $caption_text = '';
    $thumbnail_id = get_post_thumbnail_id();
    if ( $thumbnail_id ) {
        $caption_text = wp_get_attachment_caption( $thumbnail_id );
    }
?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <figure class="hero56__image">
        <?php the_post_thumbnail( 'large' ); ?>
        <?php if ( $caption_text ) { ?>
        <figcaption class="wp-caption-text thumbnail56__caption"><?php echo $caption_text; ?></figcaption>
        <?php } ?>
    </figure>
    <div class="hero56__half_content container">
        <?php fox56_hero_header(); ?>
        <?php fox56_hero_btn(); ?>
    </div>
</div>
<?php
}

/* HERO FULL
=============================================================== */
function fox56_single_hero_full() {

    $cl = [ 'hero56', 'hero56--full' ];

    /* ----------------     text position */
    $text_position = get_post_meta( get_the_ID(), '_wi_hero_full_text_position', true );
    if ( ! $text_position ) {
        $text_position = get_theme_mod( 'hero_full_text_position', 'bottom-left' );
    }
    $cl[] = 'hero56--full--' . $text_position;

    /* ----------------     caption */
    $caption_text = '';
    $thumbnail_id = get_post_thumbnail_id();
    if ( $thumbnail_id ) {
        $caption_text = wp_get_attachment_caption( $thumbnail_id );
    }
?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <div class="hero56__overlay"></div>
    <div class="hero56__background">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <?php if ( $caption_text ) { ?>
    <div class="hero56__background__caption wp-caption-text thumbnail56__caption"><?php echo $caption_text; ?></div>
    <?php } ?>
    <div class="hero56__content container">
        <?php fox56_hero_header(); ?>
    </div>
    <?php fox56_hero_btn(); ?>
</div>
<?php
}

function fox56_hero_btn() {
    if ( ! get_theme_mod( 'single_hero_scroll' ) ) {
        return;
    }

    if ( 'arrow' != get_theme_mod( 'single_hero_scroll_style', 'arrow' ) ) {
        return;
    }

    ?>
    <a href="#" class="scroll-down-btn scroll-down-btn-arrow">
        <span><?php echo fox_word( 'start' ); ?></span>
        <i class="ic56-chevron-thin-down"></i>
    </a>
    <?php
}

function fox56_hero_header( $post_type = 'post' ) {
    $components = get_theme_mod( 'hero_header_elements', [ 'standalone_category', 'title', 'subtitle' ] );
    if ( is_page() ) {
        $components = [ 'title', 'subtitle' ];
    }
    ?>
    <div class="hero56__header">
    <?php 
        $meta_collect = [];
        $components[] = 'pseudo-element'; // added to make sure last meta_collect will be displayed
        foreach ( $components as $component ) {
            if ( in_array( $component, [ 'date', 'category', 'standalone_category', 'author', 'view', 'reading_time', 'comment' ] ) ) {
                $meta_collect[] = $component;
                continue;
            } else {
                if ( ! empty( $meta_collect ) ) {
                    $args2 = [];
                    $args2[ 'meta_items' ] = $meta_collect;
                    $args2[ 'author_avatar' ] = get_theme_mod( 'single_header_author_avatar', true );
                    $args2[ 'fancy_category_style' ] = get_theme_mod( 'hero_header_category_style', 'plain' );
                    fox56_meta( $args2 );
                    $meta_collect = []; // reset it
                }
                if ( 'title' == $component ) {
                    fox56_live_indicator();
                    fox56_single_title();
                } elseif ( 'subtitle' == $component ) {
                    fox56_subtitle();
                }
            }
        }

        /* ------------------ scroll down button */
        if ( get_theme_mod( 'single_hero_scroll' ) && ( 'arrow' != get_theme_mod( 'single_hero_scroll_style' ) ) ) {
            $btn_style = get_theme_mod( 'single_hero_scroll_style' );
            ?>
            <div class="hero56__scrolldown">
                <a href="#" class="scroll-down-btn btn56 btn56--<?php echo esc_attr( $btn_style ); ?>">
                    <?php echo get_theme_mod( 'single_hero_scroll_btn_text', 'Start Reading' ); ?>
                    <i class="ic56-chevron-small-down"></i>
                </a>
            </div>
            <?php
        } ?>
    </div>
    <?php
}

function fox56_hero_content_meta() {
    if ( ! fox56_hero_type() ) {
        return;
    }
    $meta_items = get_theme_mod( 'hero_content_meta_elements', [ 'author', 'date' ] );
    if ( empty($meta_items)) {
        return;
    }
    ?>
    <div class="hero56__content_meta">
        <?php 
            $args2 = [];
            $args2[ 'meta_items' ] = $meta_items;
            $args2[ 'author_avatar' ] = get_theme_mod( 'single_header_author_avatar', true );
            fox56_meta( $args2 );
        ?>
    </div>
    <?php
}

/* SIDEBAR
=============================================================== */
function fox56_single_sidebar() {
    $sidebar = get_post_meta( get_the_ID(), '_wi_sidebar_sidebar', true );
    if ( ! $sidebar ) {
        $sidebar = get_theme_mod( 'single_sidebar', 'sidebar' );
    }
    if ( ! $sidebar ) {
        $sidebar = 'sidebar';
    }
    ?>
    <div class="secondary56">
        <?php dynamic_sidebar( $sidebar ); ?>
    </div>
    <?php
}

/* SINGLE TOP - ad goes here
=============================================================== */
function fox56_single_top() {
    $inner_content = fox56_single_top_inner();
    if ( ! $inner_content ) {
        return;
    }
    ?>
    <div class="singletop56 single56__outer"><?php echo $inner_content; ?></div>
    <?php
}
function fox56_single_top_inner() {
    ob_start();
    fox56_ad( 'single_top' );
    return ob_get_clean();
}

/* SINGLE BOTTOM - ad goes here
=============================================================== */
function fox56_single_bottom() {
    $inner_content = fox56_single_bottom_inner();
    if ( ! $inner_content ) { 
        return;
    }
    ?>
    <div class="singlebottom56 single56__outer"><div class="singlebottom56__inner"><?php echo $inner_content; ?></div></div>
    <?php
}
function fox56_single_bottom_inner() {
    ob_start();

    $show_hide = [];
    $postid = get_the_ID();
    $show_hide[ 'related' ] = 'false' != get_post_meta( $postid, '_wi_related', true );
    $show_hide[ 'nav' ] = 'false' != get_post_meta( $postid, '_wi_nav', true );
    $show_hide[ 'bottom_posts' ] = 'false' != get_post_meta( $postid, '_wi_bottom_posts', true );
    
    /* ---------------------------------        after content area */
    $components = get_theme_mod( 'single_bottom_elements', [ 'nav', 'bottom_posts', 'ad' ] );
    $map = [
        'bottom_posts' => 'fox56_bottom_posts',
        'related' => 'fox56_related',
        'nav' => 'fox56_single_nav',
        'html1' => 'fox56_single_html1',
        'html2' => 'fox56_single_html2',
        'html3' => 'fox56_single_html3',
    ];
    foreach ( $components as $component ) {
        if ( 'ad' == $component ) {
            fox56_ad( 'single_bottom' );
            continue;
        }
        if ( isset( $show_hide[$component] ) && ! $show_hide[$component] ) {
            continue;
        }
        $func = isset( $map[$component] ) ? $map[$component] : false;
        if ( $func ) {
            call_user_func( $func );
        }
    }
    return ob_get_clean();

}

/* SINGLE HEADER
=============================================================== */
function fox56_single_header() {

    $show = true;
    $show_hide = get_post_meta( get_the_ID(), '_wi_post_header', true );
    if ( 'true' == $show_hide ) {
        $show = true;
    } elseif ( 'false' == $show_hide ) {
        $show = false;
    }
    if ( ! $show ) {
        return;
    }

    $cl = [ 'single56__header', 'single56__block' ];
    $align = get_theme_mod( 'single_header_align', 'left' );
    if ( in_array( $align, [ 'left', 'center', 'right']) ) {
        $cl[] = 'align-' . $align;
    }
    /**
     * border problem
     */
    $border = get_theme_mod( 'single_header_border' );
    if ( isset( $border['top'] ) && is_numeric( $border['top']) && $border['top'] > 0 ) {
        $cl[] = 'single56__header--has-border-top';
    }
    if ( isset( $border['bottom'] ) && is_numeric( $border['bottom']) && $border['bottom'] > 0 ) {
        $cl[] = 'single56__header--has-border-bottom';
    }
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php fox56_single_header_inner(); ?>
    </div>
    <?php
}
function fox56_single_header_inner() {
    $components = get_theme_mod( 'single_header_elements', [ 'standalone_category', 'title', 'subtitle', 'date', 'author' ] );
    
    $meta_collect = [];
    $components[] = 'pseudo-element'; // added to make sure last meta_collect will be displayed
    foreach ( $components as $component ) {
        if ( in_array( $component, [ 'date', 'category', 'standalone_category', 'author', 'view', 'reading_time', 'comment' ] ) ) {
            $meta_collect[] = $component;
            continue;
        } else {
            if ( ! empty( $meta_collect ) ) {
                $args2 = [];
                $args2[ 'meta_items' ] = $meta_collect;
                $args2[ 'author_avatar' ] = get_theme_mod( 'single_header_author_avatar', true );
                fox56_meta( $args2 );
                $meta_collect = []; // reset it
            }
            if ( 'title' == $component ) {
                fox56_live_indicator();
                fox56_single_title();
            } elseif ( 'subtitle' == $component ) {
                fox56_subtitle();
            } elseif ( 'share' == $component ) {
                fox56_share();
            }
        }
    }
}

/* SINGLE BODY
=============================================================== */
function fox56_single_body() {
    ?>
    <div class="single56__body single56__block">
    <?php

    /* ---------------------------------        show/hide problem */
    $show_hide = [];
    $postid = get_the_ID();
    $show_hide[ 'share' ] = 'false' != get_post_meta( $postid, '_wi_share', true );
    $show_hide[ 'tags' ] = 'false' != get_post_meta( $postid, '_wi_tag', true );
    $show_hide[ 'related' ] = 'false' != get_post_meta( $postid, '_wi_related', true );
    $show_hide[ 'authorbox' ] = 'false' != get_post_meta( $postid, '_wi_authorbox', true );
    $show_hide[ 'comments' ] = 'false' != get_post_meta( $postid, '_wi_comment', true );
    $show_hide[ 'nav' ] = 'false' != get_post_meta( $postid, '_wi_nav', true );
    $show_hide[ 'bottom_posts' ] = 'false' != get_post_meta( $postid, '_wi_bottom_posts', true );
    $show_hide[ 'side_dock' ] = 'false' != get_post_meta( $postid, '_wi_side_dock', true );

    /* ---------------------------------        hero before */
    fox56_hero_content_meta();

    /* ---------------------------------        before content area */
    $single_before_content_elements = get_theme_mod( 'single_before_content_elements', [ 'ad', 'sponsor', 'review' ] );
    if ( ! empty( $single_before_content_elements ) ) {
        $single_before_content_elements[] = 'fake-element';
        $meta_collect = [];
        ob_start();
        foreach ( $single_before_content_elements as $ele ) {
            if ( ! empty($meta_collect) && ! in_array( $ele, [ 'date', 'author' ]) ) {
                $args2 = [];
                $args2[ 'meta_items' ] = $meta_collect;
                $args2[ 'author_avatar' ] = get_theme_mod( 'single_header_author_avatar', true );
                fox56_meta( $args2 );
                $meta_collect = [];
            }
            switch( $ele ) {
                case 'ad' : fox56_ad( 'single_before_content' ); break;
                case 'review' : fox56_review(); break;
                case 'sponsor' : fox56_sponsor(); break;
                case 'share' : if ( $show_hide['share'] ) { fox56_share(); } break;
                case 'subtitle' : fox56_subtitle(); break;
                case 'date' : $meta_collect[] = 'date'; break;
                case 'author' : $meta_collect[] = 'author'; break;
            }
        }
        $before_content_inner = ob_get_clean();
        if ( $before_content_inner ) {
            echo '<div class="single56__before_content single56__body_area">' . $before_content_inner . '</div>';
        }
    }

    /* ---------------------------------        the main content */
    fox56_single_content();

    /* ---------------------------------        after content area */
    $components = get_theme_mod( 'single_after_content_elements', [ 'ad', 'share', 'related', 'tags', 'authorbox', 'comments' ] );
    $map = [
        'review' => 'fox56_review',
        'share' => 'fox56_share',
        'related' => 'fox56_related',
        'tags' => 'fox56_single_tags',
        'authorbox' => 'fox56_authorbox',
        'comments' => 'fox56_comments',
        'nav' => 'fox56_single_nav',
        'html1' => 'fox56_single_html1',
        'html2' => 'fox56_single_html2',
        'html3' => 'fox56_single_html3',
    ];
    echo '<div class="single56__after_content single56__body_area">';
    foreach ( $components as $component ) {
        if ( 'ad' == $component ) {
            fox56_ad( 'single_after_content' );
            continue;
        }
        if ( isset( $show_hide[ $component ] ) && ! $show_hide[ $component ] ) {
            continue;
        }
        $func = isset( $map[$component] ) ? $map[$component] : false;
        if ( $func ) {
            call_user_func( $func );
        }
    }
    echo '</div>';
    ?>
    </div><!-- .single56__body -->
    <?php
}
function fox56_single_html1() {
    ?>
    <div class="single56__html single56__html1">
        <?php echo fox56_single_html1_inner(); ?>
    </div>
    <?php
}
function fox56_single_html1_inner() {
    return do_shortcode( get_theme_mod( 'single_html1' ) );
}

function fox56_single_html2() {
    ?>
    <div class="single56__html single56__html2">
        <?php echo fox56_single_html2_inner(); ?>
    </div>
    <?php
}
function fox56_single_html2_inner() {
    return do_shortcode( get_theme_mod( 'single_html2' ) );
}

function fox56_single_html3() {
    ?>
    <div class="single56__html single56__html3">
        <?php echo fox56_single_html3_inner(); ?>
    </div>
    <?php
}
function fox56_single_html3_inner() {
    return do_shortcode( get_theme_mod( 'single_html3' ) );
}

/* READING PROGRESS
=============================================================== */
// place it in the footer
add_action( 'wp_footer', 'fox56_single_progress_bar_footer_implement' );
function fox56_single_progress_bar_footer_implement() {
    if ( ! is_single() ) {
        return;
    }
    $show = get_post_meta( get_the_ID(), '_wi_reading_progress', true );
    if ( 'true' == $show ) {
        $show = true;
    } elseif ( 'false' == $show ) {
        return;
    } else {
        $show = get_theme_mod( 'single_reading_progress', true );
    }
    if ( ! $show ) {
        return;
    }
    $cl = [ 'progress56' ];

    /* ------------------   position */
    $position = get_theme_mod( 'reading_progress_position', 'top' );
    $cl[] = 'progress56--' . $position;
    ?>
    <progress value="0" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <div class="progress56__container">
            <span class="progress56__bar"></span>
        </div>
    </progress>
    <?php
}

/* FOOTER SIDE DOCK
=============================================================== */
add_action( 'wp_footer', 'fox56_single_sidedock_implement' );
function fox56_single_sidedock_implement() {
    if ( ! is_single() ) {
        return;
    }
    // only for post
    if ( 'post' != get_post_type() ) {
        return;
    }
    $show = get_post_meta( get_the_ID(), '_wi_side_dock', true );
    if ( 'true' == $show ) {
        $show = true;
    } elseif ( 'false' == $show ) {
        return;
    } else {
        $show = get_theme_mod( 'single_side_dock', true );
    }
    if ( ! $show ) {
        return;
    }
    ?>
    <div class="sidedock56-placement"><?php fox56_sidedock_inner(); ?></div>
    <?php
}
function fox56_sidedock_inner() {

    $cl = [ 'sidedock56' ];

    /* -----------------        orientation */
    $orientation = get_theme_mod( 'single_side_dock_orientation', 'up' );
    if ( 'right' == $orientation ) {
        $cl[] = 'sidedock56--siding-right';
    }

    /* -----------------        query */
    $query_args = [
        'number' => get_theme_mod( 'single_side_dock_number', 2 ),
        'orderby' => get_theme_mod( 'single_side_dock_orderby', 'date' ),
        'order' => get_theme_mod( 'single_side_dock_order', 'DESC' ),
        'source' => get_theme_mod( 'single_side_dock_source', 'tag' ),
        'exclude_categories' => get_theme_mod( 'single_side_dock_exclude_categories', '' ),
    ];
    $query = fox56_related_query( $query_args );
    if ( ! $query || ! $query->have_posts() ) {
        wp_reset_query();
        return;
    }
    $heading = get_theme_mod( 'single_side_dock_heading', 'Don\'t Miss' );
    ?>

<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    
    <?php if ( $heading ) { ?>
    <h4 class="sidedock56__heading"><?php echo $heading; ?></h4>
    <?php } ?>
    
    <div class="sidedock56__content">
        <?php while ( $query->have_posts() ) { $query->the_post(); ?>
        <div class="sidedock56__post">
            <?php if ( has_post_thumbnail() ) { ?>
            <figure class="sidedock56__post__thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'thumbnail' );?>
                </a>
            </figure>
            <?php } ?>
            <div class="sidedock56__post__text">
                <h3 class="sidedock56__post__title title56"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php fox56_excerpt([
                    'excerpt_length' => get_theme_mod( 'single_side_dock_excerpt_length', 0 )
                ]); ?>
            </div>
        </div>
        <?php } ?>
    </div><!-- .sidedock56__content -->

    <span class="close">
        <i class="ic56-x"></i>
    </span>

</div>
<?php
    wp_reset_query();
}

/* PAGE RENDER
=============================================================== */
function fox56_page() { ?>
    <div class="page-placement"><?php fox56_page_inner(); ?></div>
    <?php
}
function fox56_page_inner() {

    $cl = [ 'single56', 'page56' ];
    
    /* ---------------------    layout */
    $layout = get_post_meta( get_the_ID(), '_wi_style', true );
    if ( ! $layout ) {
        $layout = get_theme_mod( 'page_style', '1' );
    }
    if ( ! in_array( $layout, ['1','2','3','1b', '4', '5','6'])) {
        $layout = '1';
    }
    $cl[] = 'single56--' . $layout;
    
    /* ---------------------    sidebar state */
    $sidebar_state = get_post_meta( get_the_ID(), '_wi_sidebar_state', true );
    if ( ! $sidebar_state ) {
        $sidebar_state = get_theme_mod( 'page_sidebar_state', 'sidebar-right' );
    }
    $has_sidebar = false;
    if ( $sidebar_state == 'sidebar-left' ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--left';
        $has_sidebar = true;
    } elseif ( $sidebar_state == 'sidebar-right' ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--right';
        $has_sidebar = true;
    } else {
        $cl[] = 'no-sidebar';
    }
    if ( $has_sidebar ) {
        if ( get_theme_mod( 'sticky_sidebar' ) ) {
            $cl[] = 'hassidebar--sticky';
        }
    }

    /* ---------------------    content width */
    $single_content_width = get_post_meta( get_the_ID(), '_wi_content_width', true );
    if ( ! $single_content_width ) {
        $single_content_width = get_theme_mod( 'page_content_width', 'full' );
    }
    if ( 'narrow' != $single_content_width ) {
        $single_content_width = 'full';
    }
    $cl[] = 'single56--' . $single_content_width;

    /* ---------------------    thumbnail stretch
    logic goes here, when thumbnail should strech?
    */
    // thumbnail being trapped by sidebar
    $single_thumbnail_stretch = get_theme_mod( 'page_thumbnail_stretch', 'stretch-none' );
    if ( $layout == 1 || $layout == '1b' ) {
        // this case, we forces its strech to be container
        if ( $has_sidebar ) {
            $single_thumbnail_stretch = 'stretch-container';
        // otherwise, the strech can be anything    
        } else {
        }
    // this case, thumbnail is not trapped, it can be streched to anything   
    } elseif ( $layout == 2 || $layout == 3 ) {
        
    // other cases: thumbnail should not stretch    
    } else {
        $single_thumbnail_stretch = 'stretch-none';
    }
    
    $cl[] = 'single56--thumbnail-' . $single_thumbnail_stretch;

    /* ---------------------    content link style */
    $content_link_style = get_theme_mod( 'content_link_style', '1' );
    if ( ! in_array( $content_link_style, [ '1', '2', '3', '4' ])) {
        $content_link_style = '1';
    }
    $cl[] = 'single56--link-' . $content_link_style;

    /* ---------------------    stretch content images */
    if ( get_theme_mod( 'page_content_image_stretch' ) ) {
        // we'll strech content when:
            // narrow content
            // or no sidebar
        if ( 'narrow' == $single_content_width || ! $has_sidebar ) {
            $cl[] = 'single56--content-image-stretch';
        }
    }

    /* ---------------------    single_small_heading_style */
    $single_small_heading_style = get_theme_mod( 'single_heading_style', 'normal' );
    if ( 'around' != $single_small_heading_style ) {
        $single_small_heading_style = 'normal';
    }
    $cl[] = 'single56--small-heading-' . $single_small_heading_style;

    /* ---------------------    should stretch */
    $can_stretch_wide = true;
    $can_stretch_full = true;
    if ( $has_sidebar && 'narrow' != $single_content_width ) {
        $can_stretch_wide = false;
    }
    if ( $has_sidebar ) {
        $can_stretch_full = false;
    }
    if ( $can_stretch_full ) {
        $cl[] = 'can-stretch-full';
    }
    if ( $can_stretch_wide ) {
        $cl[] = 'can-stretch-wide';
    }
    ?>
<article id="wi-content" <?php post_class( $cl ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <?php switch( $layout ) {

        /* ---------------------- layout 1 */
        case '1' : ?>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_page_thumbnail(); ?>
                <?php fox56_page_header(); ?>
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>

        <?php break;

        /* ---------------------- layout 1b */
        case '1b': ?>

        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_page_header(); ?>
                <?php fox56_page_thumbnail(); ?>
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>
        <?php break; ?>

        <?php /* ---------------------- layout 2 */
        case '2': ?>

        <div class="container container--single-header single56__outer">
            <?php fox56_page_header(); ?>
            <?php fox56_page_thumbnail(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>

        <?php break; ?>

        <?php /* ---------------------- layout 3 */
        case '3': ?>

        <div class="container container--single-header single56__outer">
            <?php fox56_page_thumbnail(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_page_header(); ?>
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>
        <?php break; ?>

        <?php /* ---------------------- layout 4 */
        case '4': ?>

        <div class="hero56-placement-full">
            <?php fox56_single_hero_full(); ?>
        </div>
        <div class="container container--main">
            <div class="primary56">
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>
        <?php break; ?>

        <?php /* ---------------------- layout 5 */
        case '5': ?>

        <div class="hero56-placement-half">
            <?php fox56_single_hero_half(); ?>
        </div>
        <div class="container container--main">
            <div class="primary56">
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>
        <?php break; ?>

        <?php /* ---------------------- layout 6 */
        case '6': ?>

        <div class="container container--6 single56__outer">
            <?php fox56_page_thumbnail(); ?>
            <?php fox56_page_header(); ?>
        </div>
        <div class="container container--main single56__outer">
            <div class="primary56">
                <?php fox56_page_body(); ?>
            </div>
            <?php if ( $has_sidebar ) { fox56_page_sidebar(); } ?>
        </div>
        <?php break; ?>

    <?php } // end switch ?>
    
</article><!-- .post -->
<?php
}

/* SIDEBAR
=============================================================== */
function fox56_page_sidebar() {
    $sidebar = get_post_meta( get_the_ID(), '_wi_sidebar_sidebar', true );
    if ( ! $sidebar ) {
        $sidebar = get_theme_mod( 'page_sidebar', 'page-sidebar' );
    }
    if ( ! $sidebar ) {
        $sidebar = 'page-sidebar';
    }
    ?>
    <div class="secondary56">
        <?php dynamic_sidebar( $sidebar ); ?>
    </div>
    <?php
}

/* PAGE HEADER
=============================================================== */
function fox56_page_header() {
    if ( 'false' == get_post_meta( get_the_ID(), '_wi_post_header', true ) ) {
        return;
    }
    
    $cl = [ 'single56__header', 'page56__header', 'single56__block' ];
    $align = get_post_meta( get_the_ID(), '_wi_title_align', true );
    if ( ! $align ) {
        $align = get_theme_mod( 'page_title_align', 'left' );
    }
    $cl[] = 'align-' . $align;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <?php fox56_page_header_inner(); ?>
    </div>
    <?php
}
function fox56_page_header_inner() {
    fox56_page_title();
    fox56_page_subtitle();
}

function fox56_page_title() {
    
    ?>
    <h1 class="page56__title single56__title"><?php the_title(); ?></h1>
    <?php
}

function fox56_page_subtitle() {
    $subtitle = trim( strval( get_post_meta( get_the_ID(), '_wi_subtitle', true ) ) );
    if ( empty( $subtitle ) ) {
        return;
    }
    ?>
    <div class="post-subtitle single56__subtitle page56__subtitle component56"><?php echo do_shortcode( $subtitle ); ?></div>
    <?php
}

/* PAGE BODY
=============================================================== */
function fox56_page_body() {
    ?>
<div class="single56__block single56__body page56__body">
    <?php
    /* ---------------------------------        the main content */
    fox56_page_content();
    fox56_comments();
    ?>
</div>
    <?php
}

function fox56_page_content( $args = [] ) { ?>
    <div class="entry-content single56__post_content page56__content single56__body_area">
        <?php
            the_content();
            fox56_page_links(); ?>
    </div>
    <?php
}