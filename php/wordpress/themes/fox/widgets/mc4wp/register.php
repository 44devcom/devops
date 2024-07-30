<?php
/**
 * Mailchimp For WP
 * @since 4.6
 */
if ( !class_exists( 'Wi_MP4WP' ) ) :

add_action( 'widgets_init', 'wi_widget_mc4wp_init' );
function wi_widget_mc4wp_init() {
    register_widget( 'Wi_MP4WP' );
}

class Wi_MP4WP extends Wi_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_fox_mc4wp', 
            'description' => 'Advanced Mailchimp Form with advanced layout options by Fox theme.',
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'fox-mc4wp', esc_html__( '(FOX) Mailchimp Form' , 'wi' ), $widget_ops, $control_ops );
	}
    
    // register fields
    function fields() {
        include get_theme_file_path( '/widgets/mc4wp/fields.php' );
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_theme_file_path ( '/widgets/mc4wp/widget.php' );
        
	}
	
}

endif;