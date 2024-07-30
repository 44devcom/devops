<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

$post_class = [ 'wi-post', 'post-item', 'post-standard', 'fox-grid-item' ]; // since 4.4.4 we have fox-grid-item for 1st standard post

/**
 * header align
 */
$h_align = $args[ 'standard_header_align' ];
if ( 'right' != $h_align && 'center' != $h_align ) {
    $h_align = 'left';
}
$post_class[] = 'post-header-align-' . $h_align;
$header_class = [ 'post-header', 'align-' . $h_align ];

/**
 * Customized args for post standard
 */
$customized_args = $args;
$customized_args[ 'date_fashion' ] = 'long';

/**
 * Thumbnail params forced for standard post
 */
$customized_args[ 'thumbnail_type' ] = $args[ 'standard_thumbnail_type' ];
$customized_args[ 'thumbnail_extra_class' ] .= ' post-thumbnail';
$customized_args[ 'thumbnail' ] = 'original'; // thumbnail must be original
$customized_args[ 'thumbnail_placeholder' ] = false; // and no placeholder
$customized_args[ 'thumbnail_width' ] = ''; // make it safe

/**
 * title, meta params
 */
$customized_args[ 'title_extra_class' ] = 'post-title';
$customized_args[ 'meta_extra_class' ] = 'post-header-meta post-standard-meta';
$customized_args[ 'excerpt_show' ] = false; // disable excerpt here so that we can add it manually here
$customized_args[ 'excerpt_more' ] = $args[ 'standard_excerpt_more' ];

// ah, in case standard in grid/list
$customized_args[ 'excerpt_more_style' ] = $args[ 'standard_excerpt_more_style' ];
$customized_args[ 'excerpt_length' ] = $args[ 'standard_excerpt_length' ];

/**
 * drop cap
 */
$drop_cap = get_post_meta( get_the_ID(), '_wi_blog_dropcap', true );
if ( ! $drop_cap ) {
    $drop_cap = $args[ 'standard_dropcap' ] ? 'true' : 'false';
}
if ( 'true' == $drop_cap ) {
    $post_class[] = 'enable-dropcap';
} else {
    $post_class[] = 'disable-dropcap';
}

/**
 * column
 */
$text_column = $args[ 'standard_column_layout' ];
if ( 2 == $text_column ) {
    $post_class[] = 'enable-2-columns';
}

/**
 * more align
 */
$more_align = get_theme_mod( 'wi_standard_excerpt_more_align', 'center' );
$post_class[] = 'standard-more-align-' . $more_align;

/**
 * Order problem
 * @since 4.4
 */
$thumbnail_header_order = $args[ 'standard_thumbnail_header_order' ];
if ( 'thumbnail' != $thumbnail_header_order ) {
    $thumbnail_header_order = 'header';
}

ob_start();
?>
<header class="<?php echo esc_attr( join( ' ', $header_class ) ); ?>">

    <?php fox_post_body( $customized_args ); ?>

</header><!-- .post-header -->
<?php
$header_html = ob_get_clean();

ob_start();
if ( $args[ 'thumbnail_show' ] ) {
    fox_thumbnail( $customized_args );
}
$thumbnail_html = ob_get_clean();
?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php if ( $args[ 'standard_sep'] ) { ?>
    <div class="post-sep"></div>
    <?php } ?>
    
    <div class="post-body post-item-inner post-standard-inner">
        
        <?php
    
            if ( 'header' == $thumbnail_header_order ) {
                echo $header_html . $thumbnail_html;
            } else {
                echo $thumbnail_html;
            } ?>
        
        <div class="post-standard-text-outer">
        
            <div class="post-standard-text">

                <?php if ( 'header' != $thumbnail_header_order ) {
                    echo $header_html;
                } ?>

                <div class="post-content">

                <?php /* ---------      Content       --------- */ ?>
                <?php if ( 'excerpt' == $args[ 'standard_content_excerpt' ] ) { ?>

                    <div class="entry-excerpt">

                        <?php fox_post_excerpt( $customized_args ); ?>

                    </div><!-- .entry-excerpt -->

                <?php } else { // content ?>

                    <div class="entry-content dropcap-content columnable-content" itemprop="text">

                        <?php 
                              // .post-more class is just a legacy
                              the_content( '<span class="post-more">' . fox_word( 'more_link' ) . '</span>' );
                              fox_page_links();
                        ?>

                    </div><!-- .entry-content -->

                <?php } // content excerpt ?>

                </div><!-- .post-content -->

                <?php if ( $args[ 'share_show' ] ) fox_share(); ?>

                <?php if ( $args[ 'related_show' ] ) fox_blog_related(); ?>

            </div><!-- .post-standard-text -->
            
        </div><!-- .post-standard-text-outer -->
        
    </div><!-- .post-body -->

</article><!-- .post-standard -->