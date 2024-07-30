<?php
extract( $args );
if ( fox56() ) {
    echo $before_widget;
    echo '<div class="footer56__element footer56__copyright">';
    echo fox56_footer_copyright_inner();
    echo '</div>';
    echo $after_widget;
} else {
    if ( function_exists( 'fox_footer_copyright' ) ) {
        echo $before_widget;
        fox_footer_copyright();
        echo $after_widget;
    }
}