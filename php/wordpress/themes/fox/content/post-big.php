<?php
if ( isset( $args[ 'skip_rendered' ] ) && $args[ 'skip_rendered' ] ) {
    global $rendered_articles;
    if ( is_array( $rendered_articles ) && in_array( get_the_ID() , $rendered_articles ) ) {
        return;
    }
}

$post_css = $meta_css = [];
$post_class = [ 'wi-post', 'post-item', 'post-big', 'has-thumbnail' ]; // has-thumbnail is a legacy

/**
 * align
 */
if ( 'left' == $args[ 'big_align' ] || 'center' == $args[ 'big_align' ] || 'right' == $args[ 'big_align' ] ) {
    $post_class[] = 'post-align-' . $args[ 'big_align' ];
}

/**
 * meta background
 */
if ( $args[ 'big_meta_background' ] ) {
    $post_class[] = 'post-has-meta-custom-bg';
    $meta_css[] = 'background:' . $args[ 'big_meta_background' ];
}
$meta_css = join( ';', $meta_css );
if ( ! empty( $meta_css ) ) {
    $meta_css = ' style="' . esc_attr( $meta_css ). '"';
}

$date_format = apply_filters( 'fox_big_date_format', get_theme_mod( 'wi_big_date_format', 'd.m.Y' ) );

/**
 * Customized args for this kinda post
 */
$args[ 'thumbnail_index' ] = false;
$args[ 'thumbnail_view' ] = false;
$args[ 'thumbnail_review_score' ] = false;
$args[ 'thumbnail_format_indicator' ] = false;
$args[ 'thumbnail' ] = 'original';
$args[ 'thumbnail_hover' ] = 'none';
$args[ 'thumbnail_showing_effect' ] = 'none';
$args[ 'thumbnail_placeholder' ] = false;
$args[ 'thumbnail_extra_class' ] .= ' post-thumbnail post-big-thumbnail';

// $args[ 'excerpt_size' ] = 'medium';
// $args[ 'excerpt_more' ] = true;
// $args[ 'title_size' ] = 'extra';
$args[ 'title_extra_class' ] = 'big-title';
    
/**
 * components
 */
$show_category = $args[ 'category_show' ];
$show_date = $args[ 'date_show' ];
$show_author = $args[ 'author_show' ];
$show_author_avatar = $args[ 'author_avatar_show' ];
$show_view = $args[ 'view_show' ];
$show_reading_time = $args[ 'reading_time_show' ];
$show_comment_link = $args[ 'comment_link_show' ];

?>

<article <?php post_class( $post_class ); ?> itemscope itemtype="https://schema.org/CreativeWork">
        
    <?php if ( $args[ 'thumbnail_show' ] ) { fox_thumbnail( $args ); } ?>

    <div class="big-body container">

        <header class="big-header post-item-header">

            <?php if ( $show_category || $show_date || $show_author || $show_view || $show_reading_time || $show_comment_link ) { ?>

            <div class="post-item-meta big-meta"<?php echo $meta_css; ?>>

                <?php if ( $show_category ) fox_post_categories([ 'extra_class' => 'big-cats' ]); ?>
                <?php if ( $show_date ) fox_post_date([ 'extra_class' => 'big-date', 'format' => $date_format, 'style' => 'standard', 'fashion' => 'short' ]); ?>
                <?php if ( $show_author ) fox_post_author( $show_author_avatar ); ?>
                <?php if ( $show_view ) fox_post_view(); ?>
                <?php if ( $show_reading_time ) fox_reading_time(); ?>
                <?php if ( $show_comment_link ) fox_comment_link(); ?>

            </div><!-- .big-meta -->

            <?php } ?>

            <?php 
                if ( $args[ 'title_show' ] ) {
                    fox_post_title( $args );
                    fox_live_indicator();

                } ?>

        </header><!-- .big-header -->

        <?php if ( $args[ 'excerpt_show' ] ) { ?>

            <?php if ( $args[ 'big_content_excerpt' ] == 'content' ) { ?>

            <div class="big-content" itemprop="text">

                <?php the_content( '<span class="big-more">'. fox_word( 'more_link' ) .'</span>' ); ?>

            </div>
            <?php } else { ?>
            <div class="big-content" itemprop="text">

                <?php $copy_args = $args; $copy_args[ 'excerpt_more' ] = false; fox_post_excerpt( $copy_args ); ?>

                <?php if ( $args[ 'excerpt_more' ] ) {
                    $more_text = $args[ 'excerpt_more_text' ] ? $args[ 'excerpt_more_text' ] : fox_word( 'more_link' );
                ?>

                <a href="<?php echo fox_permalink(); ?>" class="more-link readmore minimal-link">

                    <span class="big-more"><?php echo $more_text; ?></span>

                </a>

                <?php } ?>

            </div>
            <?php } ?>

        <?php } // show excerpt ?>

    </div><!-- .big-body -->

</article><!-- .post-big -->