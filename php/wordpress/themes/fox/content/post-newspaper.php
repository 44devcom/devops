<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

// classes
$post_class = [ 'wi-post', 'post-item', 'post-newspaper', 'fox-grid-item', 'fox-masonry-item' ];

/**
 * Header Class
 */
$h_align = $args[ 'newspaper_header_align' ];
if ( 'right' != $h_align && 'center' != $h_align ) {
    $h_align = 'left';
}
$post_class[] = 'post-header-align-' . $h_align;
$header_class = [ 'post-header', 'align-' . $h_align ];

/**
 * Only options for Newspaper Layout
 */
$customized_args = $args;
$customized_args[ 'date_fashion' ] = 'short';
$customized_args[ 'extra_class' ] = [ 'newspaper-meta' ];
$customized_args[ 'title_extra_class' ] = 'newspaper-title';
$customized_args[ 'title_size' ] = 'medium';

// thumbnail args
$customized_args[ 'thumbnail_extra_class' ] .= ' post-thumbnail newspaper-thumbnail';
$customized_args[ 'thumbnail' ] = 'original';
$customized_args[ 'thumbnail_placeholder' ] = false;

// excerpt args
$customized_args[ 'excerpt_extra_class' ] = 'small-dropcap-content dropcap-content columnable-content columnable-content-small';
$customized_args[ 'excerpt_length' ] = -1;
$customized_args[ 'excerpt_more' ] = false;

/**
 * drop cap
 */
$drop_cap = get_post_meta( get_the_ID(), '_wi_blog_dropcap', true );
if ( ! $drop_cap ) {
    $drop_cap = $args[ 'newspaper_dropcap' ] ? 'true' : 'false';
}
if ( 'true' == $drop_cap ) {
    $post_class[] = 'enable-dropcap';
} else {
    $post_class[] = 'disable-dropcap';
}

/**
 * column
 */
$text_column = $args[ 'newspaper_column_layout' ];
if ( 2 == $text_column ) {
    $post_class[] = 'enable-2-columns';
}

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">

    <div class="post-sep"></div>

    <div class="post-body post-item-inner post-newspaper-inner masonry-animation-element">

        <header class="<?php echo esc_attr( join( ' ', $header_class ) ); ?>">

            <?php if ( $args[ 'title_show' ] ) {  fox_post_title( $customized_args ); } ?>
            
            <?php fox_post_meta( $customized_args ); ?>

            <?php fox_live_indicator(); ?>

        </header><!-- .post-header -->

        <?php /* ---------      Thumbnail       --------- */ ?>
        <?php if ( $args[ 'thumbnail_show' ] ) { fox_thumbnail( $customized_args ); } ?>

        <div class="post-content newspaper-content">

        <?php /* ---------      Content       --------- */ ?>
        <?php if ( 'excerpt' == $args[ 'newspaper_content_excerpt' ] ) { ?>

            <div class="entry-excerpt">

                <?php fox_post_excerpt( $customized_args ); ?>

                <?php if ( $args[ 'excerpt_more' ] ) { ?>
                <p class="p-readmore">
                    <a href="<?php echo fox_permalink();?>" class="more-link">
                        <span class="post-more"><?php echo fox_word( 'read_more' ); ?></span>
                    </a>
                </p><!-- .p-readmore -->
                <?php } ?>

            </div><!-- .entry-excerpt -->

        <?php } else { // content ?>

            <div class="entry-content small-dropcap-content dropcap-content columnable-content columnable-content-small" itemprop="text">

                <?php 
                      // .post-more class is just a legacy
                      the_content( '<span class="post-more">' . fox_word( 'more_link' ) . '</span>' );
                      fox_page_links();
                ?>

            </div><!-- .entry-content -->

        <?php } // content excerpt ?>

        </div><!-- .post-content -->

        <?php if ( $args[ 'share_show' ] ) fox_share(); ?>

        <?php if ( $args[ 'related_show' ] ) fox_blog_related( 'newspaper' ); ?>

    </div><!-- .post-body -->

</article><!-- .post-newspaper -->