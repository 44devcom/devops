<?php
/**
 * ImageText
 */
if ( !class_exists( 'Wi_Widget_ImageText' ) ) :

add_action( 'widgets_init', 'wi_widget_imagetext_init' );
function wi_widget_imagetext_init() {
    register_widget( 'Wi_Widget_ImageText' );
}

class Wi_Widget_ImageText extends Wi_Widget {
	
    // initialize the widget
	function __construct() {
		$widget_ops = array(
            'classname' => 'widget_imagetext', 
            'description' => 'ImageText',
        );
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct( 'imagetext', esc_html__( '(FOX) ImageText' , 'wi' ), $widget_ops, $control_ops );
	}
    
    // register fields
    function fields() {
        include get_theme_file_path( '/widgets/imagetext/fields.php' );
        return $fields;
    }
	
    // render it to frontend
	function widget( $args, $instance) {
        
        include get_theme_file_path( '/widgets/imagetext/widget.php' );
        
	}
	
}

endif;