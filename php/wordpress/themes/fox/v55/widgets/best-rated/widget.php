<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    
    'title' => '',
    'number' => '4',
    'category' => '',
    'tag' => '',
    'orderby' => '',
    
) ) );
echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

if ( !empty( $title ) ) {
    echo $before_title . $title . $after_title;
}

echo fox_err( 'This widget has been deprecated since Fox v4.5. Please use <strong>(FOX) Post List</strong> widget instead.' );

echo $after_widget;