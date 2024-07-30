<?php
include( dirname( __FILE__ ).'/fox_customizer.php' );

global $fox56_customize;
$fox56_customize = new Fox56_Customizer();

add_action( 'init', 'fox56_start_include_options', 2000000 ); // added after init to get all custom post types, taxes
function fox56_start_include_options() {
    
    global $fox56_customize;

    if ( function_exists( 'fox_get_block_list' ) && is_customize_preview() ) {
        $fox_block_list = [ '' => '-- Choose FOX Block --' ] + fox_get_block_list();
    } else {
        $fox_block_list = [ '' => '-- Choose FOX Block --' ];
    }
    $sidebar_list = [ '' => '--- NONE ---' ];
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
    }

    include( dirname( __FILE__ ).'/general/options-general.php' ); // 10
    include( dirname( __FILE__ ).'/header/options-header.php' ); // 20
    include( dirname( __FILE__ ).'/builder/options-builder.php' ); // 30

    include( dirname( __FILE__ ).'/blog/options-blog.php' ); // 35
    include( dirname( __FILE__ ).'/single/options-single.php' ); // 40
    
    include( dirname( __FILE__ ).'/page/options-page.php' ); // 45 
    include( dirname( __FILE__ ).'/footer/options-footer.php' ); // 50
    include( dirname( __FILE__ ).'/design/options-design.php' ); // 70
    include( dirname( __FILE__ ).'/social/options-social.php' ); // 80

    include( dirname( __FILE__ ).'/performance/options-performance.php' ); // 120
    include( dirname( __FILE__ ).'/misc/options-misc.php' ); // 150
    include( dirname( __FILE__ ).'/translation/options-translation.php' ); // 200

    // export/import
    include( dirname( __FILE__ ).'/options-export.php' ); // 220
    
    // woocommerce
    if ( class_exists( 'WooCommerce' ) ) {
        include( dirname( __FILE__ ).'/woocommerce/options-woocommerce.php' );
    }

}

/**
 * everything about customization
 * keep in mind that settings and controls are different
 * one control is for several settings
 */
add_action( 'customize_register', 'fox56_customize_init' );
function fox56_customize_init( $wp_customize ) {

    include( dirname( __FILE__ ).'/custom-controls.php' );

    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }

    // 01 - add settings
    foreach ( $fox56_customize->settings as $setting_id => $setting_args ) {
        $wp_customize->add_setting( $setting_id, $setting_args );
    }

    // 02 - add panel, sections
    foreach ( $fox56_customize->panels as $panel_id => $panel_args ) {
        $wp_customize->add_panel( $panel_id, $panel_args );
    }
    foreach ( $fox56_customize->sections as $sections_id => $section_args ) {
        $wp_customize->add_section( $sections_id, $section_args );
    }

    // 03 - add controls
    foreach ( $fox56_customize->controls as $control_args ) {
        // basic types: text, select..
        if ( ! isset( $control_args['control'] ) ) {
            $wp_customize->add_control( $control_args[ 'data-id' ], $control_args );
        } else {
            $class_name = $control_args[ 'control' ];
            if ( class_exists( $class_name ) ) {
                $control = new $class_name( $wp_customize, $control_args[ 'data-id'], $control_args );
                $wp_customize->add_control( $control );
            }
        }
    }

    // 04 - add partials
    foreach ( $fox56_customize->partials as $partial_name => $partial_args ) {
        $wp_customize->selective_refresh->add_partial( $partial_name, $partial_args );
    }

}

/**
 * enqueue scripts for preview screen 
 */
add_action( 'customize_preview_init', 'fox56_customizer_live_preview' );
function fox56_customizer_live_preview() {
    wp_enqueue_style( 'fox-fontawesome' ); // Add to generate icon.
    wp_enqueue_script ( 
        'fox-themecustomizer56',			//Give the script an ID
        get_template_directory_uri().'/inc/customize/assets/js/theme-customizer.js', //Point to file
        array(
            'jquery',
            'customize-preview',
        ),
        FOX_VERSION,						// Define a version (optional) 
        true						// Put script in footer?
    );

    global $builder_widgets;
    $widgets_info = [];
    foreach ( $builder_widgets as $ele => $instance ) {
        $widgets_info[ $ele ] = [
            'title' => $instance->get_title(),
            'icon' => $instance->get_icon(),
            'image_url' => $instance->get_preview_image_url(),
            'fields' => $instance->fields()
        ];
    }

    wp_localize_script( 'fox-themecustomizer56', 'FOX_CUSTOMIZE_BUILDER', [
        'widgets_info' => $widgets_info,
    ]);

}
        
/**
 * enqueue scripts for customize controls
 */
add_action( 'customize_controls_enqueue_scripts', 'fox56_customize_controls_enqueue_scripts' );
function fox56_customize_controls_enqueue_scripts() {

    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }
    
    wp_enqueue_style( 'fox-jquery-ui', get_template_directory_uri() . '/inc/customize/assets/css/jquery-ui.css', null, '1.12.1' );

    /**
     * we separate it into new file so next time we'll check which one is necessary
     */
    wp_enqueue_style( 'fox-customizer56', get_template_directory_uri() . '/inc/customize/assets/css/customizer56.css', [ 'fox-jquery-ui' ], FOX_VERSION );

    /**
     * develop on its own
     */
    wp_enqueue_style( 'fox-customizer56-builder', get_template_directory_uri() . '/inc/customize/assets/css/builder.css', [ 'fox-jquery-ui' ], FOX_VERSION );
    
    wp_enqueue_script( 'fox-select2',
        get_template_directory_uri() . '/inc/customize/assets/js/select2.js',
        [],
        FOX_VERSION,
        true
    );

    wp_enqueue_style( 'pickr', get_template_directory_uri() . '/inc/customize/assets/css/pickr.nano.min.css', [], FOX_VERSION, 'all' );

    wp_enqueue_script( 'fox-pickr',
        get_template_directory_uri() . '/inc/customize/assets/js/pickr.min.js',
        [],
        FOX_VERSION,
        true
    );

    wp_enqueue_script( 'tooltipster',
    get_template_directory_uri() . '/inc/customize/assets/js/tooltipster.bundle.js',
        [],
        FOX_VERSION,
        true
    );

    wp_enqueue_script( 'fox_easing',
    get_template_directory_uri() . '/inc/customize/assets/js/easing.min.js',
        [],
        FOX_VERSION,
        true
    );
    
    wp_enqueue_script( 'fox-customizer56',
        get_template_directory_uri() . '/inc/customize/assets/js/customizer.js',
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

            // more
            'fox-select2',
            'tooltipster',
            'fox-pickr',
            'fox_easing',
        ), 
        FOX_VERSION,
        true 
    );

    wp_localize_script( 'fox-customizer56', 'FOX_CUSTOMIZE', [
        'google_fonts_json_url' => get_template_directory_uri() . '/inc/customize/google-fonts-29062023.json',
        'conditional' => $fox56_customize->conditional,
        'tabs' => $fox56_customize->tabs,
        'std_affects' => $fox56_customize->std_affects,
    ]);

    wp_enqueue_script( 'fox-builder56',
        get_template_directory_uri() . '/inc/customize/assets/js/builder.js',
        array(
            'fox-customizer56'
        ), 
        FOX_VERSION,
        true 
    );

    global $builder_widgets;
    $widgets_info = [];
    foreach ( (array) $builder_widgets as $ele => $instance ) {
        $widgets_info[ $ele ] = [
            'title' => $instance->get_title(),
            'icon' => $instance->get_icon(),
            'image_url' => $instance->get_preview_image_url(),
            'fields' => $instance->fields()
        ];
    }

    /**
     * convert legacy sections into new section style
     */
    
    wp_localize_script( 'fox-customizer56', 'FOX_CUSTOMIZE_BUILDER', [
        'widgets_info' => $widgets_info,
    ]);

    wp_enqueue_script( 'fox-header-builder56',
        get_template_directory_uri() . '/inc/customize/assets/js/header-builder.js',
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

            // more
            'fox-select2',
            'tooltipster',
            'fox-pickr',
        ), 
        FOX_VERSION,
        true 
    );

}

/**
 * Frontend CSS goes here
 */
add_action( 'wp_head', 'fox56_customize_css', 10 );
function fox56_customize_css() {

    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }
    
    $queries = [ '' => [] ];

    foreach ( $fox56_customize->css as $css_arr ) {

        $prop = $css_arr[ 'property'];
        $selector = $css_arr[ 'selector' ];
        
        // get the updated value only in customize preview, when we refresh
        if ( is_customize_preview() ) {
            if ( isset( $css_arr[ 'id' ] ) ) {
                $value = get_theme_mod( $css_arr[ 'id' ] );
            } else {
                $value = $css_arr[ 'value' ];
            }
            if ( isset( $css_arr['field'])) {
                if ( ! isset( $value[ $css_arr['field'] ] ) ) {
                    continue;
                }
                $value = $value[ $css_arr['field'] ];
            }
            if ( isset( $css_arr['use'])) {
                if ( !isset( $value[ $css_arr['use'] ] ))  {
                    continue;
                }
                $value = $value[ $css_arr['use'] ];
            }
            $value = trim( strval( $value ) );
        } else {
            $value = trim( strval( $css_arr[ 'value' ] ) );
        }

        // if empty value
        if ( '' === $value ) {
            continue;
        }
        

        if ( isset( $css_arr['compute'] ) ) {
            $func = $css_arr['compute'];
            $value = call_user_func( $func, $value );
        }

        if ( isset( $css_arr['unit'] ) && $css_arr['unit'] && is_numeric( $value ) ) {
            $value .= $css_arr['unit'];
        }
        if ( isset( $css_arr['value_pattern'])) {
            $value = str_replace( '$', $value, $css_arr['value_pattern'] );
        }
        $query = isset( $css_arr[ 'media_query' ] ) ? $css_arr[ 'media_query' ] : '';
        if ( ! isset( $queries[ $query] ) ) {
            $queries[ $query ] = [];
        }
        $queries[ $query ][] = "$selector { $prop : $value ;}";
    }
    /**
     * sort queries by screen big -> small
     */
    uksort( $queries, function( $x, $y ) {
        if ( '' == $x ) {
            return -1;
        }
        $x1 = fox56_int( $x );
        $y1 = fox56_int( $y );
        if ($x1 == $y1) 
        return 0;
        return ($x1 > $y1) ? 1 : -1;
    });

    $ul = [];
    foreach ( $queries as $query => $query_css ) {
        $li = join( " ", $query_css );
        if ( $query != '' ) {
            $li = "$query { $li }";
        }
        $ul[] = $li;
    }
    ?>
    <style id="css-preview">
        <?php echo join( "\n", $ul ); ?>
        <?php do_action( 'fox_custom_css' ); ?>
    </style>
    <?php
}

/**
 * endpoint for settings - since v6.2
 */
add_action( 'rest_api_init', function () {
    register_rest_route( 'fox/v1', '/theme_mods/', array(
      'methods' => 'GET',
        'permission_callback' => '__return_true', /*function() {
            return current_user_can( 'manage_options' );
        }, */
      'callback' => 'fox56_return_site_theme_mods',
        'args' => array()
      ) );
});

function fox56_return_site_theme_mods( WP_REST_Request $request ) {
    
    $theme		= get_stylesheet();
    $template	= get_template();
    $charset	= get_option( 'blog_charset' );
    $mods		= get_theme_mods();
    $mods_without_wi = [];
    foreach ( $mods as $k => $v ) {
      if ( strpos( $k, 'wi_') === 0 ) {
        continue;
      }
      $mods_without_wi[$k] = $v;
    }
    $data = array(
        'template'  => $template,
        'mods'	  => $mods_without_wi ? $mods_without_wi : array(),
        'options'	  => array()
    );

    if( function_exists( 'wp_get_custom_css_post' ) ) {
        $data['wp_css'] = wp_get_custom_css();
    }

    $charset	= get_option( 'blog_charset' );
    $now = date("Y-m-d-H-i-s");
    header( 'Content-disposition: attachment; filename=settings-' . $template . '-' . $now . '.dat' );
    header( 'Content-Type: application/octet-stream; charset=' . $charset );
    
    // Serialize the export data.
    echo trim(serialize( $data ));
    
    // Start the download.
    die();

}