<?php
/**
 * Instagram
 *
 * @package Fox
 */

if ( !class_exists( 'Wi_Widget_Instagram' ) ) :

add_action( 'widgets_init', 'wi_widget_instagram_init' );
function wi_widget_instagram_init() {
    register_widget( 'Wi_Widget_Instagram' );
}

class Wi_Widget_Instagram extends Wi_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_instagram', 
            'description' => esc_html__( 'Displays Instagram Grid','wi' )
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'wi-instagram', esc_html__( '(FOX) Instagram' , 'wi' ), $widget_ops, $control_ops );
	}
    
    // register fields
    function fields() {
        include(dirname( __FILE__ ).'/fields.php');
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include(dirname( __FILE__ ).'/widget.php');
        
	}
	
}

endif;