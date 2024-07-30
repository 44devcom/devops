<?php
/**
 * Authorbox
 * @since 4.6.2
 */

if ( !class_exists( 'Wi_Widget_Authorbox' ) ) :

add_action( 'widgets_init', 'wi_widget_authorbox_init' );
function wi_widget_authorbox_init() {
    register_widget( 'Wi_Widget_Authorbox' );
}

class Wi_Widget_Authorbox extends Wi_Widget {
	
    // initialize the widget
	function __construct() {
        
		$widget_ops = array(
            'classname' => 'widget_authorbox', 
            'description' => 'Authorbox. This widget only shows on single posts.',
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'wi-authorbox', esc_html__( '(FOX) Authorbox' , 'wi' ), $widget_ops, $control_ops );
        
	}
    
    // register fields
    function fields() {
        include get_theme_file_path( '/widgets/authorbox/fields.php' );
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_theme_file_path( '/widgets/authorbox/widget.php' );
        
	}
	
}

endif;