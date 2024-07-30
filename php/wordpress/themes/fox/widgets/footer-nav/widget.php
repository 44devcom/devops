<?php 
extract( $args );
if ( fox56() ) {
    echo $before_widget;
    echo '<div class="footer56__element footer56__nav">';
    echo fox56_footer_nav_inner();
    echo '</div>';
    echo $after_widget;
} else {
    if ( function_exists( 'fox_footer_nav' ) ) {
        echo $before_widget;
        fox_footer_nav();
        echo $after_widget;
    }
}