<?php
if ( fox56() ) {
    include( dirname( __FILE__ ).'/widget56.php' );
    return;
}
if ( ! is_single() ) {
    return;
}

extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'layout' => 'stack',
    'align' => 'left',
) ) );
echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

if ( function_exists( 'get_coauthors' ) ) {
    $authors = get_coauthors();
} else {
    $authors = [ get_userdata( get_the_author_meta( 'ID' ) ) ];
}

foreach ( $authors as $user ) :

// $user = get_userdata( get_the_author_meta( 'ID' ) );
$link = get_author_posts_url( $user->ID, $user->user_nicename );

$class = [ 'authorbox-widget' ];

if ( 'inline' != $layout ) {
    $layout = 'stack';
}
$class[] = 'authorbox-widget-' . $layout;

// stack align
if ( 'stack' == $layout && $align ) {
    $class[] = 'align-' . $align;
}

?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <?php /* ---------      AVATAR      -------------- */ ?>
    <div class="authorbox-widget-avatar">

        <a href="<?php echo $link; ?>">

            <?php echo get_avatar( $user->ID, 150 ); ?>

        </a>

    </div><!-- .authorbox-widget-avatar -->

    <div class="authorbox-widget-text">

        <h3 class="authorbox-widget-name">

            <a href="<?php echo $link; ?>"><?php echo $user->display_name; ?></a>

        </h3>

        <?php if ( $user->description ) { ?>

        <div class="authorbox-widget-description">

            <?php echo wpautop( $user->description ); ?>

        </div><!-- .authorbox-widget-description -->

        <?php } ?>

        <?php fox_user_social([ 'user' => $user->ID, 'style' => 'plain' ] ); ?>
        
    </div><!-- .authorbox-text -->

</div><!-- .fox-authorbox -->

<?php endforeach; ?>

<?php echo $after_widget;