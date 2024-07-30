<?php
extract( $args );
if ( function_exists( 'fox_site_branding' ) ) {
    echo $before_widget;
    fox_site_branding();
    echo $after_widget;
}