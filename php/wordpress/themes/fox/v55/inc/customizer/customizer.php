<?php
if ( !class_exists( 'Fox_Customize' ) ) :
/**
 * Customizer
 *
 * @package Fox
 * @since 1.0
 */
class Fox_Customize {
    
    /**
	 *
	 */
	public function __construct() {
	}
    
    /**
	 * The one instance of class
	 *
	 * @since 1.0
	 */
	private static $instance;

	/**
	 * Instantiate or return the one class instance
	 *
	 * @since 1.0
	 * @return $instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
    
    /**
     * Initiate the class
     * contains action & filters
     *
     * @since 1.0
     */
    public function init() {
        
        // Registers Settings here
        add_action( 'customize_register', array( $this , 'register' ), 1000 );
        
        // Live Preview JS, for page
        add_action( 'customize_preview_init', array( $this, 'customizer_live_preview' ) );
        
        // Javascript for Customizer, for iframe
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
        
        // Customize Preview
        add_action( 'wp_head', array( $this, 'customizer_color_style' ), 1000 );
        
        add_action( 'init', array( $this, 'migrate_29' ) );
        
        add_action( 'init', array( $this, 'migrate_43' ) );
        
        add_action( 'init', array( $this, 'migrate_45' ) );
        
    }
    
    private static $prefix = 'wi_';
    
    // since 2.9
    function migrate_29() {
        
        if ( get_theme_mod( 'wi_migrated_to_29' ) ) return;
        
        
        
    }
    
    /**
     * old options to v4.3
     */
    function migrate_43() {
        
        if ( get_theme_mod( 'wi_migrated_to_43' ) ) return;
        
        
        
    }
    
    /**
     * old options to v4.5
     */
    function migrate_45() {
        
        if ( get_theme_mod( 'wi_migrated_to_45', false ) ) return;
        
        
        
    }
    
    /**
     * Enqueue script for customizer
     *
     * @since 1.0
     */
    function enqueue() {
        
        wp_enqueue_style( 'fox-jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
        wp_enqueue_style( 'fox-customizer', get_template_directory_uri() . '/v55/inc/customizer/assets/css/customizer.css', [ 'fox-jquery-ui' ], FOX_VERSION );
        
        wp_enqueue_script( 'fox-customizer',
            get_template_directory_uri() . '/v55/inc/customizer/assets/js/customizer.js',
            array(
              'customize-controls',
              'iris',
              'underscore',
              'wp-util',

              // jQuery UI for Autocomplete, Drag, Sortable
              'jquery-ui-core',
              'jquery-ui-widget',
              'jquery-ui-mouse',
                
                'jquery-ui-draggable',
                'jquery-ui-sortable',
                
                'jquery-ui-position',
                'jquery-ui-menu',
                'jquery-ui-autocomplete',
            ), 
            FOX_VERSION,
            true );
        
        $fontlist = [];
        
        // array fontname => styles
        foreach( fox_normal_fonts() as $font => $fontdata ) {
            $fontlist[ $font ] = [];
        }

        $all_fonts = fox_google_fonts();
        foreach ( $all_fonts as $font => $fontdata ) {
            $fontlist[ $font ] = $fontdata[ 'styles' ];
        }
        
        $primary_positions = fox_primary_font_support();
        $primary_fonts = [];
        foreach ( $primary_positions as $key => $value ) {
            $primary_fonts[] = 'font_' . $key;
        }
        
        $hintlist = [];
        // Get Registered Options
        $reg_options = Fox_Register::instance()->options();
        foreach ( $reg_options as $id => $option ) {
            $hint = isset( $option[ 'hint' ] ) ? $option[ 'hint' ] : '';
            if ( ! $hint ) continue;
            $hintlist[ $id ] = $hint;
        }
        
        wp_localize_script( 'fox-customizer', 'FOX_CUSTOMIZER', [
            'fonts' => $fontlist,
            'primary_fonts' => $primary_fonts,
            
            // hint, since 4.4
            'hint' => $hintlist,
            
            // builder data since 4.5
            'builder_fields' => fox_builder_fields(),
            'builder_data' => fox_builder_data(),
            
            'darkmode' => [
                'border_color' => '#333',
                'excerpt_color' => '#999',
                'grid_color' => '#999',
                'item_border_color' => '#333',
                'list_sep_color' => '#333',
                'group1_sep_border_color' => '#333',
                'group2_sep_border_color' => '#333',
                'footer_sidebar_sep_color' => '#333',
                'nav_border_color' => '#333',
                'nav_color' => '#999',
                'nav_hover_color' => '#fff',
                'nav_active_color' => '#fff',
            ]
        ] );
        
    }
    
    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings 
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     * 
     * Used by hook: 'customize_preview_init'
     *
     * @source: https://codex.wordpress.org/Plugin_API/Action_Reference/customize_preview_init
     */
    public static function customizer_live_preview()
    {
        wp_enqueue_script ( 
              'fox-themecustomizer',			//Give the script an ID
              get_template_directory_uri().'/v55/inc/customizer/assets/js/theme-customizer.js', //Point to file
              array( 'jquery','customize-preview' ),	//Define dependencies
              FOX_VERSION,						// Define a version (optional) 
              true						// Put script in footer?
        );
    }
    
    /**
     * Customizer Color Style
     *
     * @since 1.0
     */
    function customizer_color_style() {
        ?>

<style id="color-preview"></style>

        <?php
    }
    
    /**
     * Register Settings
     *
     * @since 1.0
     */
	function register( $wp_customize ) {
        
        // Include Custom Controls
        require_once get_template_directory() . '/v55/inc/customizer/custom-controls.php';
        
        // Vars
        $prev_panel = $prev_section = '';
        
        // prefix
        $prefix = self::$prefix;
        
        // Get Registered Options
        $reg_options = Fox_Register::instance()->options();
        
        // Loop through all registered options
        foreach ( $reg_options as $id => $option ) {
            
            $defaults = array(
                'type' => null,
                'name' => null,
                'desc' => null,
                'options' => null,
                'priority' => null,
                'placeholder' => null,
                'json' => array(),
                'toggle' => null,
                'input_attrs' => array(),
                'active_callback' => null,
                'std' => null,
                'transport' => '',
                'selector'  => '',
                'css'       => '',
                
                'unit' => '',
                
                'section' => null,
                'section_title' => null,
                'section_desc' => null,
                'section_priority' => null,
                
                'panel' => null,
                'panel_title' => null,
                'panel_desc' => null,
                'panel_priority' => null,
            );
            
            extract( wp_parse_args( $option, $defaults ) );
            
            // 01 - PANEL
            // new panel appears
            if ( $panel ) {
                $panel_args = array();
                $panel_args[ 'title' ] = $panel_title ? $panel_title : $panel;
                if ( $panel_desc ) $panel_args[ 'description' ] = $panel_desc;
                if ( $panel_priority ) $panel_args[ 'priority' ] = $panel_priority;
                
                // add panel
                $prev_panel = $panel;
                if ( ! $wp_customize->get_panel( $panel ) ) {
                    $wp_customize->add_panel( $panel, $panel_args );
                }
            }
            
            // 02 - SECTION
            // new section appears
            if ( $section ) {
                $section_args = array();
                $section_args[ 'title' ] = $section_title ? $section_title : $section;
                if ( $section_desc ) $section_args[ 'description' ] = $section_desc;
                if ( $section_priority ) $section_args[ 'priority' ] = $section_priority;
                
                // we take previous panel unless panel specify to be false
                if ( $panel ) $section_args[ 'panel' ] = $panel;
                
                // add section
                $prev_section = $section;
                if ( ! $wp_customize->get_section( $section ) ) {
                    $wp_customize->add_section( $section, $section_args );
                }
            }
            
            // type is mandatory
            if ( ! $type ) continue;
            
            // OPTIONS IN DETAILS
            // Transport
            if ( 'postMessage' != $transport ) $transport = 'refresh';
            
            if ( $toggle ) {
                $json[ 'toggle' ] = $toggle;
            }
            
            // color preview
            // selector & property
            if ( 'postMessage' == $transport && 'color' == $type ) {
                if ( $css && ! $selector ) {
                    $selector = isset( $css[ 'selector' ] ) ? $css[ 'selector' ] : '';
                }
                if ( $selector ) $json[ 'selector' ] = $selector;
                
                if ( is_string( $css ) ) {
                    $json[ 'property' ] = $css;
                } elseif ( isset( $css[ 'property' ] ) ) {
                    $json[ 'property' ] = $css[ 'property' ];
                }
            }
            if ( $placeholder ) {
                $input_attrs[ 'placeholder' ] = $placeholder;
            }
            
            if ( 'select_font' == $type ) {
                $json[ 'inherit_options' ] = isset( $option[ 'inherit_options' ] ) ? $option[ 'inherit_options' ] : true;
            }
            
            if ( 'typography' == $type ) {
                $json[ 'fields' ] = isset( $option[ 'fields' ] ) ? $option[ 'fields' ] : [
                    'size', 'weight', 'style', 'text-transform', 'letter-spacing', 'line-height',
                ];
            }
            
            if ( 'background' == $type ) {
                $json[ 'fields' ] = isset( $option[ 'fields' ] ) ? $option[ 'fields' ] : [
                    'color', 'image', 'size', 'size_custom', 'repeat', 'position',
                ];
            }
            
            if ( 'box' == $type ) {
                $json[ 'fields' ] = isset( $option[ 'fields' ] ) ? $option[ 'fields' ] : [
                    'margin',
                    'padding',
                    'border',
                    'border-color',
                    'border-style',
                ];
            }
            
            if ( 'multiple_text' == $type ) {
                $json[ 'fields' ] = isset( $option[ 'fields' ] ) ? $option[ 'fields' ] : [];
            }
            
            /**
             * Callback
             */
            if ( 'checkbox' === $type ) $callback = array( $this, 'sanitize_checkbox' );
            elseif ( 'number' === $type ) $callback = array( $this, 'sanitize_number' );
            elseif ( 'color' === $type ) $callback = array( $this, 'sanitize_hex_color' );
            else $callback = array( $this, 'no_sanitize' );
            
            
            // 01 - ADD SETTING
            //  
            $setting_args = array (
                'sanitize_callback' => $callback,
                'type'      => 'theme_mod',
                'default' => $std,
                'transport' => $transport,
            );
            $wp_customize->add_setting ( $id , $setting_args );
            
            // 02 - ADD CONTROL
            // 
            $control_args = array(
                'settings'      => $id,
                'section'       => $prev_section,
                'type'          => $type,
            );
            if ( $name ) $control_args[ 'label' ] = $name;
            if ( $desc ) $control_args[ 'description' ] = $desc;
            if ( $options ) $control_args[ 'choices' ] = $options;
            if ( $placeholder ) $control_args[ 'placeholder' ] = $placeholder;
            if ( $input_attrs ) $control_args[ 'input_attrs' ] = $input_attrs;
            if ( $active_callback ) $control_args[ 'active_callback' ] = $active_callback;
            if ( $json ) $control_args[ 'json' ] = $json;
            
            // mime type
            if ( 'upload' == $type ) {
                if ( isset( $option[ 'mime_type' ] ) ) {
                    $control_args[ 'mime_type' ] = $option[ 'mime_type' ];
                }
            }
            
            $custom_controls = array (
                // built in
                'image'         => 'WP_Customize_Image_Control',
                'color'         => 'WP_Customize_Color_Control',
                'upload'        => 'WP_Customize_Upload_Control',
                
                // added
                'heading'       => 'Fox_Heading_Control',
                'message'       => 'Fox_Message_Control',
                'html'          => 'Fox_HTML_Control',
                'multicheckbox' => 'Fox_Multicheckbox_Control',
                'multiselect'   => 'Fox_Multiselect_Control',
                'select_font'   => 'Fox_Select_Font_Control',
                'typography'    => 'Fox_Typography_Control',
                'multiple_text' => 'Fox_Multiple_Text_Control',
                'box'           => 'Fox_Box_Control',
                'fox_background'=> 'Fox_Background_Control',
                'image_radio'   => 'Fox_Image_Radio_Control',
                'home_builder'  => 'Fox_Home_Builder_Control',
                
                'hidden'        => 'Fox_Hidden_Control', // since 4.4
            );
            
            if ( isset( $custom_controls[ $type ] ) ) {
                
                $control_class = $custom_controls[ $type ];
                $wp_customize->add_control ( new $control_class ( $wp_customize , $id, $control_args ) );
                
            } else {
                
                $wp_customize->add_control( $id, $control_args );
            
            }
            
        } // Foreach Registered Options
        
        // remove static front page section while we can set it in Settings > Reading
        // And we only set it once
        // $wp_customize->remove_section( 'static_front_page' );
        
    }
    
    /**
     * Callback function for checkbox
     *
     * @since 1.0
     */
    function sanitize_checkbox( $checked ) {
        return ( ( isset( $checked ) && ( true == $checked || 'on' == $checked ) ) ? true : false );
    }
    
    /**
     * Callback function for number
     *
     * @since 1.0
     */
    function sanitize_number( $value ) {
        return ( is_numeric( $value ) ) ? $value : intval( $value );
    }
    
    /**
     * Callback function in general cases
     *
     * @since 1.0
     */
    function no_sanitize( $value ) {
        return $value;
    }
    
    /**
     * Callback function for color
     *
     * @since 1.0
     */
    function sanitize_hex_color( $color ) {
        if ( '' === $color )
            return '';

        // 3 or 6 hex digits, or the empty string.
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
            return $color;
    }
    
}

Fox_Customize::instance()->init();

endif;