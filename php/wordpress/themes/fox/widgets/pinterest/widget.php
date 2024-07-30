<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'username' => 'pinterest',
    'boardname' => '',
    'maxfeeds' => 6,
    'follow' => 'Follow Us',
) ) );
echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

if ( empty( $username ) ) return;

?>

<div class="wi-widget-pinterest">

    <ul class="wi-pin-list">
        
        <?php $this->get_pins_feed_list( $username, $boardname, $maxfeeds ); ?>
        
        <li class="grid-sizer"></li>
    
    </ul>
    
    <?php if ( $follow ) { ?>
    
        <?php if ( fox56() ) { ?>
    <div class="widget-pin__follow button56 button56--block button56--block-ful">
        
        <a href="<?php echo esc_url( 'https://pinterest.com/' . $username ) ; ?>" target="_blank" class="btn56 btn56--primary btn56--small">
            <?php echo esc_html( $follow ); ?>
            <i class="ic56-pinterest"></i>
        </a>
        
    </div>
        <?php } else { ?>
    <div class="widget-pin-follow fox-button button-block button-block-full">
        
        <a href="<?php echo esc_url( 'https://pinterest.com/' . $username ) ; ?>" target="_blank" class="fox-btn btn-primary btn-small">
            <?php echo esc_html( $follow ); ?>
            <i class="fab fa-pinterest-p"></i>
        </a>
        
    </div>
    <?php } ?>
    
    <?php } ?>

</div><!-- .wi-widget-pinterest -->

<?php echo $after_widget;