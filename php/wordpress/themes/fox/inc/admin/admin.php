<?php
include_once(dirname( __FILE__ ).'/framework/metabox.php');
include_once(dirname( __FILE__ ).'/framework/tax-metabox.php');
include_once(dirname( __FILE__ ).'/framework/widget.php');
include_once(dirname( __FILE__ ).'/framework/tgm.php');
include_once(dirname( __FILE__ ).'/framework/nav-custom-fields.php');

/**
 * Add editor style
 */
function fox56_add_classic_editor_styles() {

    // Load if using CLASSIC editor 
    add_editor_style('css56/editor.css');
}
add_action('admin_init', 'fox56_add_classic_editor_styles');

function fox56_add_block_editor_styles() {
    // Load if using BLOCK editor (Gutenberg)
    wp_enqueue_style( 'fox56-block-editor-styles', get_theme_file_uri('css56/editor.css'), array(), FOX_VERSION
    );
}
add_action( 'enqueue_block_editor_assets', 'fox56_add_block_editor_styles' );
/**
 * End Add editor style
 */

/* required plugins
================================================================================================== */
add_action( 'tgmpa_register', 'fox56_register_required_plugins' );
function fox56_register_required_plugins() {

    $plugin_arr = fox56_plugin_array();
        
    // the last fence
    if ( ! is_array( $plugin_arr ) ) {
        $plugin_arr = [];
    }
    
    $config = array(
        'id'           => 'tgmpa',
        'default_path' => '',
        'menu'         => 'tgma-install-plugins',
        'parent_slug'  => 'fox',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    );

    tgmpa( $plugin_arr, $config );

}
/**
 * RETURN array
 */
function fox56_plugin_array() {

    $arr = [
        [
            'name' => 'One Click Demo Import',
            'slug' => 'one-click-demo-import',
            'required' => true,
        ],
        [
            'name'      => 'Smash Balloon Social Photo Feed',
			'slug'      => 'instagram-feed',
			'required'  => false,
        ],
        [
            'name'      => 'MC4WP: Mailchimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
        ],
        [
            'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
        ],
        [
            'name' => 'Post Views Counter',
            'slug' => 'post-views-counter',
            'required' => false,
        ],
    ];

    if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
        $arr[] = [
            'name'      => 'Elementor Page Builder',
			'slug'      => 'elementor',
			'required'  => true,
        ];
        $arr[] = [
            'name'      => 'FOX Framework',
			'slug'      => 'fox-framework',
			'required'  => true,
            'source'    => get_template_directory() . '/inc/admin/plugins/fox-framework.zip',
            'version'   => '3.0',
        ];
    }

    return $arr;
    
}

/* admin scripts
================================================================================================== */
add_action( 'sidebar_admin_setup', 'wp_enqueue_media' );
add_action( 'admin_enqueue_scripts', 'fox56_admin_enqueue_scripts' );
function fox56_admin_enqueue_scripts() {

    // We need to upload image/media constantly
    wp_enqueue_media();
        
    // admin css
    $currentScreen = get_current_screen();
    if ( ! is_null( $currentScreen ) && 'jetpack_page_stats' != $currentScreen->id ) {
        wp_enqueue_style( 'wi-admin', FOX_ADMIN_URL . 'css/admin.css', array( 'wp-color-picker', 'wp-mediaelement' ), FOX_VERSION );
    }
    
    // admin javascript
    wp_enqueue_script( 'tooltipster', get_theme_file_uri( '/v55/js/tooltipster.bundle.min.js' ), array( 'jquery' ), '4.2.6' , true ); // 
    wp_enqueue_script( 'wi-admin', FOX_ADMIN_URL . 'js/admin.js', array( 'wp-color-picker', 'wp-mediaelement', 'tooltipster' ), FOX_VERSION, true );
    
    // localize javascript
    $jsdata = [];
    $jsdata[ 'l10n' ] =  array(
        
        'choose_image' => esc_html__( 'Choose Image', 'wi' ),
        'change_image' => esc_html__( 'Change Image', 'wi' ),
        'upload_image' => esc_html__( 'Upload Image', 'wi' ),
        
        'choose_images' => esc_html__( 'Choose Images', 'wi' ),
        'change_images' => esc_html__( 'Change Images', 'wi' ),
        'upload_images' => esc_html__( 'Upload Images', 'wi' ),
        
        'choose_file' => esc_html__( 'Choose File', 'wi' ),
        'change_file' => esc_html__( 'Change File', 'wi' ),
        'upload_file' => esc_html__( 'Upload File', 'wi' ),
    );
    wp_localize_script( 'wi-admin', 'WITHEMES_ADMIN' , $jsdata );

}

/**
 * disabled for maintainance
 */
if ( ! is_customize_preview() ) {
    add_action( 'enqueue_block_editor_assets', 'fox56_enqueue_editor', 80 );
}
function fox56_enqueue_editor() {
    // @todo57
    return;
        
    $gg_fonts = fox_fonts();
    if ( $gg_fonts ) {
        wp_enqueue_style( 'wi-fonts', fox_fonts(), array(), FOX_VERSION, 'all' );
    }
    
    wp_enqueue_style( 'wi-editor-style', get_theme_file_uri( 'css/editor.css' ), [], FOX_VERSION, 'all' );
    $css = fox_customizer_css_output( 'backend' );
    wp_add_inline_style( 'wi-editor-style', $css );

}

/* fox activation welcome
================================================================================================== */
add_action( 'after_switch_theme', 'fox56_redirect_welcome' );
function fox56_redirect_welcome() {
    
    global $pagenow;
    if ( is_admin() && ! is_network_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url( 'admin.php?page=fox' ) );
    }

}

add_action( 'admin_init', 'wi_redirect_welcome' ); 
function wi_redirect_welcome() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated']) && $pagenow == "themes.php" ) {
        wp_redirect('admin.php?page=fox');
    }
}

/* metaboxes
================================================================================================== */
// metabox
add_filter( 'fox_metaboxes', 'fox56_metaboxes' );
add_filter( 'fox_term_metaboxes', 'fox56_term_metaboxes' );

// post, page
function fox56_metaboxes( $metaboxes ) {

    include_once(dirname( __FILE__ ).'/page-metaboxes.php');
    include_once(dirname( __FILE__ ).'/post-metaboxes.php');
    
    return $metaboxes;

}

// term: category, tag
function fox56_term_metaboxes( $metaboxes ) {

    include_once(dirname( __FILE__ ).'/term-metaboxes.php');
    
    $metaboxes[ 'term-settings' ] = array (
        'id' => 'term-settings',
        'screen' => array( 'category', 'post_tag' ),
        'fields' => $fields,
    );
    
    return $metaboxes;
    
}

/* registration helper
================================================================================================== */
function fox_is_registered() {
    if ( get_site_option( 'fox_registration' ) ) {
        return true;
    }
    return get_option( 'fox_registration', null );
}

function fox_admin_safe_site() {
    $site_url = get_site_url();
    $host = parse_url( $site_url, PHP_URL_HOST );
    $host = str_replace( '/', '@', $host );
    return $host;
}

// ajax
add_action( 'wp_ajax_fox_add_license', 'fox56_ajax_add_license' );
add_action( 'wp_ajax_fox_revoke_license', 'fox56_ajax_revoke_license' );

function fox56_ajax_add_license() {
        
    $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    if ( ! wp_verify_nonce( $nonce, 'fox_license_nonce' ) )
        die ( 'Busted!');
    
    $purchase_code = isset( $_POST['purchase_code'] ) ? $_POST['purchase_code'] : '';
    if ( ! $purchase_code ) {
        die( 'No purchase code' );
    }
    
    // FOX ITEM ID
    $item_id = '11103012';
    
    $site_url = get_site_url();
    $site_url = str_replace( '://', '$', $site_url );
    $site_url = str_replace( '/', '@', $site_url );
    
    $remote_url = WITHEMES_UPDATES_URL . 'wp-json/withemes-purchase/v1/add/' . $purchase_code . '/' . $item_id . '/' . $site_url;
    
    $response = wp_remote_get( $remote_url );
    
    if ( ! is_wp_error( $response ) ) {

        $body = wp_remote_retrieve_body( $response );
        $json = json_decode( $body, true );
        
        /**
         * everything goes right
         * it returns success means on the server, the license and site have been added actually
         */
        if ( isset( $json['status'] ) && 'success' == $json['status'] ) {
            /* net work */
            $update = update_site_option( 'fox_license', $purchase_code );
            if ( ! $update ) {
                $update = add_site_option( 'fox_license', $purchase_code );
            }
            
            /* per site */
            $update = update_option( 'fox_license', $purchase_code );
            if ( ! $update ) {
                add_option( 'fox_license', $purchase_code );
            }
            
            /* network */
            $update = update_site_option( 'fox_registration', true );
            if ( !$update ) {
                add_site_option( 'fox_registration', true );
            }
            
            /* per site */
            $update = update_option( 'fox_registration', true );
            if ( !$update ) {
                add_option( 'fox_registration', true );
            }

            /**
             * license info
             * since 6.2.1
             */
            $info = isset( $json['info'] ) ? $json['info'] : [];
            if ( isset( $info['sold_at'] ) && $info['sold_at'] ) {
                update_option( 'fox_item_purchase_data', $info );
                update_site_option( 'fox_item_purchase_data', $info );
            }
        }
        
        echo $body;
        die();

    } else {
        echo json_encode([
            'status' => 'fail',
            'message' => 'problem connecting the server',
        ]);
    }
    die();
    
}

// revoke license
function fox56_ajax_revoke_license() {
    
    $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    if ( ! wp_verify_nonce( $nonce, 'fox_license_nonce' ) )
        die ( 'Busted!');
    
    $purchase_code = isset( $_POST['purchase_code'] ) ? $_POST['purchase_code'] : '';
    if ( ! $purchase_code ) {
        die( 'No purchase code' );
    }
    
    $item_id = '11103012';
    
    $site_url = get_site_url();
    $site_url = str_replace( '://', '$', $site_url );
    $site_url = str_replace( '/', '@', $site_url );
    
    $remote_url = WITHEMES_UPDATES_URL . 'wp-json/withemes-purchase/v1/revoke/' . $purchase_code . '/' . $item_id . '/' . $site_url;
    
    $response = wp_remote_get( $remote_url );
    
    if ( ! is_wp_error( $response ) ) {

        $body = wp_remote_retrieve_body( $response );
        $json = json_decode( $body, true );
        
        /**
         * everything goes right
         * success means the site url doesn't exist any more from the server
         */
        if ( isset( $json['status'] ) && 'success' == $json['status'] ) {
            /* network */
            delete_site_option( 'fox_license' );
            delete_site_option( 'fox_item_purchase_data' );
            $update = update_site_option( 'fox_registration', false );
            if ( ! $update ) {
                add_site_option( 'fox_registration', false );
            }
            
            /* per site */
            delete_option( 'fox_license' );
            delete_option( 'fox_item_purchase_data' );
            $update = update_option( 'fox_registration', false );
            if ( ! $update ) {
                add_option( 'fox_registration', false );
            }
        }
        
        echo $body;
        die();

    } else {
        echo json_encode([
            'status' => 'fail',
            'message' => 'problem connecting the server',
        ]);
    }
    die();
    
}

/* admin class
================================================================================================== */
class Fox56_Admin {   
	public function __construct() {
        
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 0 );
        add_filter( 'admin_footer_text', [ $this, 'admin_footer_text' ] );

        add_action( 'manage_posts_custom_column', array( $this, 'add_thumbnail_value_editscreen' ), 10, 2 );
        add_filter( 'manage_edit-post_columns', array( $this, 'columns_filter' ) , 10, 1 );
        
        add_filter( 'manage_post_demo_posts_columns', array( $this, 'columns_filter' ) , 10, 1 );
        
        add_filter( 'manage_edit-category_columns', [ $this, 'edit_term_columns' ], 10, 3 );
        add_filter( 'manage_category_custom_column', [ $this, 'manage_term_custom_column' ], 10, 3 );
        add_filter( 'manage_edit-post_tag_columns', [ $this, 'edit_term_columns' ], 10, 3 );
        add_filter( 'manage_post_tag_custom_column', [ $this, 'manage_term_custom_column' ], 10, 3 );
        
        add_action( 'fox_tools', [ $this, 'clear_cache_tool' ] );
        add_action( 'wp_ajax_fox_transients', [ $this, 'clear_transients' ] );

	}
    
    function clear_cache_tool() {
        ?>
        <p>The demo list and plugin list are being cached. Hit <strong>Clear Cache</strong> to update the latest plugin list and latest theme demo list.</p>
<form class="fox-form clear-transients-form" method="get">
    <div class="fox-message"></div>
    <input type="hidden" name="action" value="fox_transients" />
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'clear_transients_nonce' ); ?>" />
    <input type="submit" value="Clear Cache" class="button button-primary" />
</form>
        <?php
    }
    
    function clear_transients() {
        
        $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
        if ( ! wp_verify_nonce( $nonce, 'clear_transients_nonce' ) )
            die ( 'Busted!');
        
        if ( get_transient( FOX_DEMOS_KEY ) ) {
            $result1 = delete_transient( FOX_DEMOS_KEY );
        } else {
            $result1 = true;
        }
        if ( get_transient( FOX_DEMOS_KEY . 'elementor' ) ) {
            $result2 = delete_transient( FOX_DEMOS_KEY . 'elementor' );
        } else {
            $result2 = true;
        }
        if ( get_transient( FOX_DEMOS_KEY . 'no_elementor' ) ) {
            $result3 = delete_transient( FOX_DEMOS_KEY . 'no_elementor' );
        } else {
            $result3 = true;
        }
        if ( get_transient( FOX_PLUGINS_KEY ) ) {
            $result4 = delete_transient( FOX_PLUGINS_KEY );
        } else {
            $result4 = true;
        }
        
        if ( $result1 && $result2 && $result3 && $result4 ) {
            echo json_encode([
                'status' => 'success',
                'message' => 'The cache has been cleared. Time: ' . wp_date( 'd M Y g:i A', time() ),
            ]);
        } else {
            echo json_encode([
                'status' => 'fail',
                'message' => 'something went wrong. error code 43297429',
            ]);
        }
        die();
    }
    
    /**
     * Admin Menu
     * @since 4.0
     * ------------------------------------------------------------ */
    function admin_menu() {
        
        // add admin page to Appearance
        $hook = add_menu_page(
            
            // title name
            'Welcome to The Fox',
            
            // menu name
            'Fox Magazine',
            
            // role
            'manage_options',
            
            // slug
            'fox',
            
            // function
            array( $this, 'create_admin_page'),
            
            // icon
            // 'dashicons-admin-site-alt3',
            // FOX_ADMIN_URL . 'images/fox.png',
            'dashicons-fox',
            
            // priority
            2
        );
        
        $hook = add_submenu_page(
            'fox',
            'Theme Options',
            'Theme Options',
            'manage_options',
            'fox-theme-options',
            array( $this, 'create_theme_options_page')
        );
    
    }
    
    /**
     * Welcome page
     * @since 4.0
     * ------------------------------------------------------------ */
    function create_admin_page() {
        include_once(dirname( __FILE__ ).'/welcome.php');
    }
    
    /**
     * theme options more clear
     * @since 4.4
     * ------------------------------------------------------------ */
    function create_theme_options_page() {
        ?>
        <div class="wrap about-wrap">
            
            <h1>Theme Options</h1>

            <p>The Fox uses the native WordPress Customizer which can be found under <strong>Appearance > Customize</strong></p>
            
            <img src="<?php echo get_template_directory_uri() . '/inc/admin/images/customizer.jpg'; ?>" alt="Customizer" width="500" style="width:500px; background: white; padding: 10px; border: 1px solid #e0e0e0" />
            
        </div>

    <?php
    
    }
    
    /**
     * Admin Footer Text
     * @since 4.0
     * ------------------------------------------------------------ */
    function admin_footer_text( $text ) {
        
        $screen = get_current_screen();
        if ( ! is_null( $screen ) && $screen->parent_base == 'fox' ) {
        
            $text = 'Enjoyed <strong>The Fox Magazine</strong>? Help us by <a href="https://withemes.com/updates/wp-content/uploads/sites/3/2023/03/fox_rating_guide.jpg" target="_blank">leaving a 5-star rating</a>. We really appreciate your support!';
            
        }
        
        return $text;
        
    }
    
    /**
     * Render thumbnail for post
     * @since 4.0
     * ------------------------------------------------------------ */
    function add_thumbnail_value_editscreen( $column_name, $post_id ) {

        $width = (int) 50;
        $height = (int) 50;

        if ( 'thumbnail' == $column_name ) {
            
            // thumbnail of WP 2.9
            $thumbnail = get_post_meta( $post_id, '_thumbnail_id', true );
            
            if ( $thumbnail ) {
                $thumbnail = wp_get_attachment_image( $thumbnail, [ 50, 50 ] );
            }
            
            if ( ! $thumbnail ) {
                $thumbnail = '<img src="' . get_template_directory_uri() . '/images/placeholder.png' . '" atl="No thumbnail" width="50" />';
            }
            $format = get_post_format( $post_id );
            $format_indicator = '';
            if ( $format ) {
                $format_indicator = '<i class="dashicons dashicons-format-' . $format . '"></i>';
            }
            
            echo '<div class="fox-column-thumbnail">' . $thumbnail . $format_indicator . '</div>';
            
        }
        
    }
    
    /**
     * Add Thumbnail column to post
     * @since 4.0
     * ------------------------------------------------------------ */
    function columns_filter( $columns ) {
        
        $column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
        
        $columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
        
        return $columns;
        
    }
    
    /**
     * Add Thumbnail column to category/tag
     * @since 4.0
     * ------------------------------------------------------------ */
    function edit_term_columns( $columns ) {
        
        $columns = array_merge( [ 'term_featured_image' => 'Thumbnail' ], $columns );
        return $columns;
        
    }
    
    /**
     * Render Thumbnail category/tag
     * @since 4.0
     * ------------------------------------------------------------ */
    function manage_term_custom_column( $out, $column, $term_id ) {
        
        if ( 'term_featured_image' === $column ) {
            
            $thumbnail  = get_term_meta( $term_id, '_wi_thumbnail', true );
            if ( $thumbnail ) {
                $thumbnail = wp_get_attachment_image( $thumbnail, [ 80, 80 ] );
            }
            if ( ! $thumbnail ) $thumbnail = '<img src="' . get_template_directory_uri() . '/images/placeholder.png' . '" atl="No thumbnail" width="80" />';
            
            $out = sprintf( '<div class="term-meta-thumbnail">%s</div>', $thumbnail );
            
        }
        
        return $out;
        
    }
    
}
new Fox56_Admin();