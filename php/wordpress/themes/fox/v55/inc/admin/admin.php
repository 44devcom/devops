<?php
if ( ! class_exists( 'Fox_Admin' ) ) :
/**
 * Admin Class
 *
 * @since Fox 2.2
 * @improved from Fox 4.0
 */
class Fox_Admin {   
    
    /**
	 *
	 */
	public function __construct() {
	}
    
    /**
	 * The one instance of Fox_Admin
	 *
	 * @since Fox 2.2
	 */
	private static $instance;

	/**
	 * Instantiate or return the one Fox_Admin instance
	 *
	 * @since Fox 2.2
	 * @return Fox_Admin
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
     * @since Fox 2.2
     */
    public function init() {
        
        if ( ! defined( 'WITHEMES_UPDATES_URL' ) ) {
            define( 'WITHEMES_UPDATES_URL', 'https://withemes.com/updates/' );
        }
        
        /**
         * 01 - INTERFACE
         */
        // since 4.0
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 0 );
        add_filter( 'admin_footer_text', [ $this, 'admin_footer_text' ] );
        
        /**
         * Add a thumbnail column in edit.php
         * Thank to: http://wordpress.org/support/topic/adding-custum-post-type-thumbnail-to-the-edit-screen
         * @since 1.0
         */
        add_action( 'manage_posts_custom_column', array( $this, 'add_thumbnail_value_editscreen' ), 10, 2 );
        add_filter( 'manage_edit-post_columns', array( $this, 'columns_filter' ) , 10, 1 );
        
        add_filter( 'manage_post_demo_posts_columns', array( $this, 'columns_filter' ) , 10, 1 );
        
        add_filter( 'manage_edit-category_columns', [ $this, 'edit_term_columns' ], 10, 3 );
        add_filter( 'manage_category_custom_column', [ $this, 'manage_term_custom_column' ], 10, 3 );
        add_filter( 'manage_edit-post_tag_columns', [ $this, 'edit_term_columns' ], 10, 3 );
        add_filter( 'manage_post_tag_custom_column', [ $this, 'manage_term_custom_column' ], 10, 3 );
        
        /**
         * 02 - FRAMEWORK
         */
        
        // metabox framework
        require_once FOX_ADMIN_PATH . 'framework/metabox.php';
        require_once FOX_ADMIN_PATH . 'framework/tax-metabox.php';
        
        // widgets
        require_once FOX_ADMIN_PATH . 'framework/widget.php';
        
        // TGM
        require_once FOX_ADMIN_PATH . 'framework/tgm.php';
        
        /**
         * 03 - FUNCTIONALITY
         */
        // register plugins needed for theme
        add_action( 'tgmpa_register', array ( $this, 'register_required_plugins' ) );
        
        // Include media upload to sidebar area
        // This will be used when we need to upload something
        add_action( 'sidebar_admin_setup', array( $this, 'wp_enqueue_media' ) );
        
        // nav custom fields
        require_once get_template_directory() . '/v55/inc/admin/framework/nav-custom-fields.php';
        
        // enqueue scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
        
        // localization
        add_action( 'wiadminjs', array( $this, 'l10n' ) );
        
        // metabox
        add_filter( 'fox_metaboxes', array( $this, 'metaboxes' ) );
        add_filter( 'fox_term_metaboxes', array( $this, 'term_metaboxes' ) );
        
        /**
         * since 5.5.1
         * check registration
         */
        add_action( 'wp_ajax_fox_add_license', [ $this, 'ajax_add_license' ] );
        add_action( 'wp_ajax_fox_revoke_license', [ $this, 'ajax_revoke_license' ] );
        
        /**
         * since 5.5.1
         */
        add_action( 'fox_tools', [ $this, 'clear_cache_tool' ] );
        add_action( 'wp_ajax_fox_transients', [ $this, 'clear_transients' ] );
        
        /**
         * since 5.5.1.4
         */
        add_action( 'after_switch_theme', [ $this, 'redirect_welcome' ] );
        
        /**
         * block editor
         * since 5.5.1.4
         */
        if ( ! is_customize_preview() ) {
            add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor' ], 80 );
        }
        
    }
    
    function redirect_welcome() {
        
        global $pagenow;

		if ( is_admin() && ! is_network_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) ) {
			wp_safe_redirect( admin_url( 'admin.php?page=fox' ) );
		}
        
    }
    
    function enqueue_editor() {

        return;
        
        $gg_fonts = fox_fonts();
        if ( $gg_fonts ) {
            wp_enqueue_style( 'wi-fonts', fox_fonts(), array(), FOX_VERSION, 'all' );
        }
        
		wp_enqueue_style( 'wi-editor-style', get_theme_file_uri( 'css/editor.css' ), [], FOX_VERSION, 'all' );
        $css = fox_customizer_css_output( 'backend' );
        wp_add_inline_style( 'wi-editor-style', $css );
        
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
        if ( get_transient( FOX_PLUGINS_KEY ) ) {
            $result2 = delete_transient( FOX_PLUGINS_KEY );
        } else {
            $result2 = true;
        }
        
        if ( $result1 && $result2 ) {
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
    
    function ajax_add_license() {
        
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
    
    function ajax_revoke_license() {
        
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
                $update = update_site_option( 'fox_registration', false );
                if ( ! $update ) {
                    add_site_option( 'fox_registration', false );
                }
                
                /* per site */
                delete_option( 'fox_license' );
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
        
        include_once FOX_ADMIN_PATH . 'welcome.php';
        
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
            
            <img src="<?php echo get_template_directory_uri() . '/v55/inc/admin/images/customizer.jpg'; ?>" alt="Customizer" width="500" style="width:500px; background: white; padding: 10px; border: 1px solid #e0e0e0" />
            
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
    
    /**
     * Register Plugins
     * @since 1.0
     * ------------------------------------------------------------ */
    function register_required_plugins () {
        
        $plugin_arr = fox_plugin_array();
        
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
     * Enqueue Media
     * ------------------------------------------------------------ */
    function wp_enqueue_media() {
        wp_enqueue_media();
    }
    
    /**
     * Enqueue javascript & style for admin
     * @since Fox 2.2
     * ------------------------------------------------------------ */
    function enqueue() {
        
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
        $jsdata = apply_filters( 'wiadminjs', array(
        ) );
        wp_localize_script( 'wi-admin', 'WITHEMES_ADMIN' , $jsdata );
        
    }
    
    /**
     * Localization some text
     * @since Fox 2.2
     * ------------------------------------------------------------ */
    function l10n( $jsdata ) {
    
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
        
        return $jsdata;
    
    }
    
    /**
     * Metaboxes
     * @return $metaboxes
     *
     * @modified since 2.4
     * @since Fox 2.2
     * ------------------------------------------------------------ */
    function metaboxes( $metaboxes ) {
    
        include FOX_ADMIN_PATH . 'page-metaboxes.php';
        include FOX_ADMIN_PATH . 'post-metaboxes.php';
        
        return $metaboxes;
    
    }
    
    /**
     * Term Metaboxes
     * @since Fox 4.0
     * ------------------------------------------------------------ */
    function term_metaboxes( $metaboxes ) {
        
        $sidebars = [
            '' => 'Default',
            'sidebar-left' => 'Sidebar Left',
            'sidebar-right' => 'Sidebar Right',
            'no-sidebar' => 'No Sidebar',
        ];
        
        $layouts = array_merge( [ '' => 'Default' ], fox_archive_layout_support() );
        $toparea_layouts = array_merge( [ '' => 'Default' ], fox_topbar_layout_support() );
        
        $fields = [];
        
        $fields[] = [
            'id' => 'layout',
            'name' => 'Layout',
            'type' => 'select',
            'options' => $layouts,
            'std' => '',
        ];
        
        $fields[] = [
            'id' => 'sidebar_state',
            'name' => 'Sidebar State',
            'type' => 'select',
            'options' => $sidebars,
            'std' => '',
        ];
        
        $fields[] = [
            'id' => 'toparea_display',
            'name' => 'Toparea displays',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'none' => 'None',
                'view' => 'Most Viewed Posts',
                'comment_count' => 'Most Commented Posts',
                'featured' => 'Featured Posts (Starred Posts)',
            ],
            'std' => '',
        ];
        
        $fields[] = [
            'id' => 'toparea_layout',
            'name' => 'Toparea Layout',
            'type' => 'select',
            'options' => $toparea_layouts,
            'std' => '',
        ];
        
        $fields[] = [
            'id' => 'toparea_number',
            'name' => 'Toparea number of posts to show',
            'type' => 'text',
            'std' => '',
        ];

        $fields[] = [
            'id' => 'toparea_include',
            'name' => 'Specify post IDs to display for top area',
            'type' => 'text',
            'placeholder' => 'Eg. 16, 292',
            'std' => '',
        ];
        
        $fields[] = [
            'id' => 'thumbnail',
            'name' => 'Thumbnail',
            'desc' => 'Used in grid of categories.',
            'type' => 'image',
        ];
        
        $fields[] = [
            'id' => 'background_image',
            'name' => 'Background Image',
            'desc' => 'Used in category page as the header background.',
            'type' => 'image',
        ];
        
        $fields[] = [
            'id' => 'priority',
            'name' => 'Priority',
            'desc' => 'If post has simultaneously cateogry A - priority 5 and category B - priority 10 then B will be chosen as primary category',
            'type' => 'text',
        ];
        
        $metaboxes[ 'term-settings' ] = array (
            
            'id' => 'term-settings',
            'screen' => array( 'category', 'post_tag' ),
            'fields' => $fields,
        
        );
        
        return $metaboxes;
        
    }
    
}

Fox_Admin::instance()->init();

endif; // class exists

/**
 * RETURN array
 */
function fox_plugin_array() {
    
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
            'version'   => '2.2.0.5',
        ];
    }

    return $arr;
    
}

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

/**
 * since 4.6
 */
add_action( 'admin_init', 'wi_redirect_welcome' ); 
function wi_redirect_welcome() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated']) && $pagenow == "themes.php" ) {
        wp_redirect('admin.php?page=fox');
    }
}

/* ----------------------------------------------------------------------
import single template
---------------------------------------------------------------------- */
if ( ! function_exists( 'wi_single_template_list' ) ) :
function wi_single_template_list() {
    
    $template_list = [];
    $url = 'https://thefox.withemes.com/studio/wp-json/fox-single-templates/v1/library/?version=' . time();
    $cache_time = DAY_IN_SECONDS;
    $key = 'remote_single_template17';
    $body = get_transient( $key );
    if ( false === $body ) {

        $response = wp_remote_get( $url );

        if ( ! is_wp_error( $response ) ) {

            $body = wp_remote_retrieve_body( $response );
            $template_list = json_decode( $body, true );

            if ( ! empty( $template_list ) ) {
                set_transient( $key , $body, $cache_time );
            } else {
                $template_list = [];
            }

        } else {
            $template_list = [];
        }
    } else {

        $template_list = json_decode( $body, true );

    }
    return $template_list;
    
}
endif;

add_action( 'wp_ajax_import_single_template', 'wi_ajax_import_single_template' );
add_action( 'wp_ajax_nopriv_import_single_template', 'wi_ajax_import_single_template' );
function wi_ajax_import_single_template() {
    
    $template_list = wi_single_template_list();
    
    /**
     * get post
     */
    $slug = isset( $_POST[ 'slug' ] ) ? $_POST[ 'slug' ] : [];
    if ( is_numeric( $slug ) || $slug == '1b' ) {
        die( json_encode([
            'status' => 'fail 1',
        ]) );
        return;
    }
    $info = isset( $template_list[ $slug ] ) ? $template_list[ $slug ] : [];
    if ( ! $info ) {
        die( json_encode([
            'status' => 'fail 2',
        ]) );
    }
    
    /**
     * if this slug has been existed
     */
    $try_get = new WP_Query([
        'posts_per_page' => 1,
        'name'        => $slug,
        'post_type'   => 'fox_block',
        'post_status' => 'any',
    ]);
    if ( $try_get->have_posts() ) {
        wp_reset_query();
        die( json_encode([
            'status' => 'fail 3',
        ]) );
    }
    
    $title = isset( $info[ 'title' ] ) ? $info[ 'title' ] : '';
    $data = isset( $info[ 'data' ] ) ? $info[ 'data' ] : '';
    
    $source = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );

    $block_id = wp_insert_post( array(
        'post_author' => get_current_user_id(),
        'post_status' => 'publish',
        'post_title' => $title,
        'post_type' => 'fox_block',
        'post_name' => $slug,
    ) );

    update_post_meta( $block_id, '_elementor_edit_mode', 'builder' );
    update_post_meta( $block_id, '_elementor_data', $data );
    update_post_meta( $block_id, '_elementor_version', ELEMENTOR_VERSION );

    update_post_meta( $block_id, '_wi_role', 'single_template' );

    $post_css = \Elementor\Core\Files\CSS\Post::create( $block_id );
    $post_css->update();
    
    $edit_link = admin_url( 'post.php?post=' . $block_id . '&action=elementor' );
    echo json_encode([
        'status' => 'success',
        'html' => '<i class="dashicons dashicons-yes-alt fox-admin-hastip green" title="This template has been downloaded and ready to use"></i>
            <a href="' . esc_url( $edit_link ) . '" class="template-edit-link fox-admin-hastip" target="_blank" title="This template has been downloaded to your site. You can edit it.">Edit</a>'
    ]);
    die();    
}