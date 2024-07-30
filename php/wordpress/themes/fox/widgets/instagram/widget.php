<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    
    'title' => '',
    'feed_id' => '1',
    /*
    'username' => '',
    'number' => '',
    'column' => '',
    'size' => '',
    'item_spacing' => 'tiny',
    'show_header' => true,
    'show_meta' => '',
    'crop' => true,
    'cache_time' => '', */
    'hover_style' => '',
    'heading_text' => '',
    'heading_text_icon' => true,
    'heading_subtitle' => '',
    'profile_url' => '',
    'follow_text' => 'Follow Us',
    'follow_text_style' => 'insta',
    'follow_text_position' => 'after',
) ) );

/* previous version
--------------------------------------------- */
if ( ! fox56() ) { 
    echo $before_widget;

    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
    if ( !empty( $title ) ) {	
        echo $before_title . $title . $after_title;
    }

    fox_instagram( $instance );

    echo $after_widget;
    return;
}

/* current version
--------------------------------------------- */
if ( ! $feed_id ) {
    $feed_id = 1;
}
$shortcode = '[instagram-feed feed=' . esc_attr( $feed_id ). ']';

echo $before_widget;
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$cl = [ 'instagram56' ];

/* ------------- hover_style */
if ( $hover_style == 'fade' || $hover_style == 'border' ) {
    $cl[] = 'instagram56--' . $hover_style;
}
?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">

    <?php if ( $heading_text || $heading_subtitle ) { ?>
        <div class="instagram56__header">
            <?php if ( $heading_subtitle ) { ?>
            <p class="instagram56__header__subtitle"><?php echo $heading_subtitle; ?></p>
            <?php } ?>
            <?php if ( $heading_text ) { ?>
            <h3 class="instagram56__header__title">
                <?php if ( $heading_text_icon ) { ?><i class="ic56-instagram"></i><?php } ?>
                <span><?php echo $heading_text; ?></span>
            </h3>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="instagram56__main">
        <?php echo do_shortcode( $shortcode ); ?>

        <?php if ( $follow_text && $profile_url ) { ?>
        <div class="follow-text button56 follow-text--<?php echo esc_attr( $follow_text_position ); ?>">
            <a href="<?php echo esc_url( $profile_url ); ?>" target="_blank" class="follow-us btn56 btn56--<?php echo esc_attr( $follow_text_style ); ?>"><?php echo esc_html( $follow_text ) ?></a>
        </div><!-- .follow-text -->
        <?php } ?>
    </div>

</div>

<?php echo $after_widget; ?>