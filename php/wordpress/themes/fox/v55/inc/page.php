<?php
if ( ! function_exists( 'fox_page_header' ) ) :
/**
 * Page Header
 * @since 4.3
------------------------------------------------------------------------------------ */
function fox_page_header( $params ) {
    
    $params = wp_parse_args( $params, [
        
        'style' => '1',
        'sidebar_state' => 'right',
        'thumbnail_stretch' => 'stretch-none',
        'content_width' => 'full',
        'image_stretch' => 'stretch-none',
        
        'column_layout' => 1,
        'title_align' => '',
        
    ] );
    
    extract( $params );
    
    if ( ! $post_header_show ) {
        return;
    }
    
    // legacy
    $class = [
        'single-header',
        'post-header',
        'entry-header',
        'page-header',
    ];
    
    if ( 'left' == $title_align || 'center' == $title_align || 'right' == $title_align ) {
        $class[] = 'align-' . $title_align;
    }
    
    // depending on the layout, it'll be a section or a big-section
    if ( '2' == $style ) {
        $class[] = 'single-big-section';
    } elseif ( '1' == $style || '1b' == $style || '3' == $style ) {
        $class[] = 'single-section';
    }
    
    $main_class = [
        'header-main'
    ];
    
    /**
     * content narrow
     */
    $narrow = false;
    if ( 'narrow' == $content_width ) {
        $narrow = true;
    }
    
    if ( $narrow ) {
        $main_class[] = 'narrow-area';
    }
    
    ?>
    <header class="<?php echo esc_attr( join( ' ', $class ) ); ?>" itemscope itemtype="https://schema.org/WPHeader">
    
        <div class="container">
            
            <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">

                <?php echo fox_format( '<h1 class="page-title">{}</h1>', get_the_title() ); ?>
                
                <?php echo fox_get_subtitle(); ?>
                
            </div><!-- .header-main -->

        </div><!-- .container -->
    
    </header><!-- .single-header -->

<?php
    
}
endif;

/**
 * Page Body
 * @since 4.3
------------------------------------------------------------------------------------ */
function fox_page_body( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        
        'style' => '1',
        'sidebar_state' => 'right',
        'thumbnail_stretch' => 'stretch-none',
        'content_width' => 'full',
        'image_stretch' => 'stretch-none',
        'column_layout' => 1,

        'dropcap' => false,
        'text_column' => 1,
        
        'share_show' => false,
        'comment_show' => false,
    ]);
    
    extract( $params );
    
    $class = [
        'single-section', 
        'single-main-content' 
    ];
    
    /**
     * Narrow
     */
    $main_class = [
        'content-main',
    ];
    
    if ( 'narrow' == $content_width ) {
        $main_class[] = 'narrow-area';
    }
    
    /**
     * cases that allow stretch
     * narrow content: left, right, bigger
     * no-sidebar: bigger, full
     *
     * to keep it simple, stretch bigger is only allowed with narrow content
     */
    $allow_stretch = [];
    if ( 'no-sidebar' == $sidebar_state ) {
        $allow_stretch[] = 'stretch-full';
    }
    if ( 'narrow' == $content_width ) {
        $allow_stretch[] = 'stretch-left';
        $allow_stretch[] = 'stretch-right';
        $allow_stretch[] = 'stretch-bigger';
    }
    
    $allow_stretch = array_unique( $allow_stretch );
    
    /**
     * STRETCH ALL
     * stretch-full will become stretch-bigger in case it has sidebar
     * and in case it has sidebar + content full, no stretch at all
     */
    if ( 'no-sidebar' != $sidebar_state ) {
        if ( 'stretch-full' == $image_stretch ) {
            $image_stretch = 'stretch-bigger';
        }
        if ( 'full' == $content_width ) {
            $image_stretch = 'stretch-none';
        }
    }
    
    if ( in_array( $image_stretch, $allow_stretch ) ) {
        
        $class[] = 'content-all-' . $image_stretch;
        
    }
    
    /**
     * Body layout: if boxed, then we disabllow stretch bigger, left, right for full content
     */
    if ( 'boxed' == $body_layout && 'full' == $content_width ) {
        $allow_stretch = array_diff( $allow_stretch, [ 'stretch-bigger', 'stretch-right', 'stretch-left' ] );
    }
    
    if ( $image_stretch == 'stretch-bigger' ) {
        // $allow_stretch = array_diff( $allow_stretch, [ 'stretch-left', 'stretch-right' ] );
    }
    
    // if 2 column text, disallow stretch
    if ( 2 == $text_column ) {
        $allow_stretch = [];
    }
    
    foreach ( $allow_stretch as $str ) {
        
        $class[] = 'allow-' . $str;
        
    }
    
    /**
     * share side
     */
    $share_positions = [];
    $share_positions = get_theme_mod( 'wi_page_share_positions', 'after' );
    $share_positions = explode( ',', $share_positions );
    $share_positions = array_map( 'trim', $share_positions );
    
    if ( 'narrow' != $content_width && $params[ 'share_show' ] ) {
        
        if ( in_array( 'side', $share_positions ) ) {
            $class[] = 'side-share';
        }
        
    }
    
    /**
     * drop cap
     */
    if ( $dropcap ) {
        $class[] = 'enable-dropcap';
    } else {
        $class[] = 'disable-dropcap';
    }
    
    /**
     * text column
     */
    if ( 2 == $text_column ) {
        $class[] = 'enable-2-columns';
    }
    
?>    
<div class="single-body single-section">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
        
        <?php if ( 'narrow' != $content_width && $params[ 'share_show' ] && in_array( 'side', $share_positions ) ) {
            fox_share([
                'extra_class' => 'vshare',
                'style' => 'custom',
            ]);
        } ?>
        
        <div class="entry-container">
            
            <div class="<?php echo esc_attr( join( ' ', $main_class ) ); ?>">
            
                <div class="dropcap-content columnable-content article-content entry-content single-component">

                    <?php the_content(); fox_page_links(); ?>

                </div><!-- .entry-content -->

                <?php
    
    /**
     * Share
     */
    if ( $params[ 'share_show' ] ) {
        
        if ( in_array( 'after', $share_positions ) ) {
            echo '<div class="single-component single-component-share">';
            fox_share();
            echo '</div>';
        }

        // when we have side share, we need a fallback
        if ( in_array( 'side', $share_positions ) && ! in_array( 'after', $share_positions ) && ! in_array( 'before', $share_positions ) ) {
            echo '<div class="single-component single-component-share hide_on_desktop show_on_tablet">';
            fox_share();
            echo '</div>';
        }
        
    }
    
    /**
     * COMMENT
     */
    if ( $params[ 'comment_show' ] ) {
        
        fox_page_comment();
        
    } 
    ?>
                
            </div>
            
        </div><!-- .container -->
    
    </div><!-- .single-section -->

</div><!-- .single-body -->

<?php
    
}

/**
 * Page Comment
------------------------------------------------------------------------------------ */
function fox_page_comment() {
    
    // to implement via PHP
    do_action( 'fox_commment', 'page' );

}