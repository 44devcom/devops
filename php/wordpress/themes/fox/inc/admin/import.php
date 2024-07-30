<?php
/**
 * since 5.5.1.5
 * to make it safer when we delete demo
 */
// add_action( 'save_post', 'fox_import_save_foxdemo_meta', 10, 3 );
function fox_import_save_foxdemo_meta( $postid, $post, $update ) {
    if ( defined( 'FOX_DEVELOPER' ) && FOX_DEVELOPER ) {
        return;
    }   
    // if this is update action, leave it as it is
    if ( ! $update ) {
        return;
    }

    // in case this is a post demo
    $delete = delete_post_meta( $postid, '_foxdemo' );

    /**
     * get post terms to remove their things
     */
    $things = [ 'category', 'post_tag', 'product_cat', 'product_tag', 'nav_menu' ];
    foreach ( $things as $thing ) {
        $terms = get_the_terms( $postid, $thing );
        if ( $terms  && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $t ) {
                delete_term_meta( $t->term_id, '_foxdemo' );   
            }
        }
    }
}

// add_action( 'edited_terms', 'fox_import_save_foxdemo_meta_terms', 10, 2 );
function fox_import_save_foxdemo_meta_terms( $term_id, $taxonomy ) {
    if ( defined( 'FOX_DEVELOPER' ) && FOX_DEVELOPER ) {
        $updated = update_term_meta( $term_id, '_foxdemo', true );
        if ( ! $updated ) {
            add_term_meta( $term_id, '_foxdemo', true );
        }
    } else {
        delete_term_meta( $term_id, '_foxdemo' );
    }
}

add_action( 'ocdi/plugin_page_header', 'fox_register_notice_import_demo' );
function fox_register_notice_import_demo() {
    if ( ! fox_is_registered() ) {
        ?>

<div class="fox-notice fox-error fox-demo-notice">
    <p>To access the demo list, please <a href="<?php echo admin_url( 'admin.php?page=fox' ); ?>">enter the license first</a>.</p>
</div>

<?php
    }
}

add_filter( 'admin_body_class', 'fox_demo_add_body_class' );
function fox_demo_add_body_class( $classes ) {
    
    // if not registered
    if ( ! fox_is_registered() ) {
        $classes .= ' fox-not-registered';
    } else {
        $classes .= ' fox-registered';
    }
    
    // if demo exists
    $demo = get_theme_mod( 'wi_demo' );
    if ( $demo ) {
        $classes .= ' already-imported';
    }

    // if Actived SiteGround Center plugin
    if( function_exists( 'is_plugin_active' ) && is_plugin_active('wordpress-starter/siteground-wizard.php') ) {
        $classes .= ' siteground-cent-plugin';
    }
    
    return $classes;
}

/* UNINSTALL DEMO
---------------------------------------------------------------------------------------------------- */
add_action( 'wp_ajax_uninstall_demo', 'fox_demo_uninstall' );
function fox_demo_uninstall() {
    /**
     * nonce check
     */
    $nonce = isset( $_POST[ 'nonce' ] ) ? $_POST[ 'nonce' ] : '';
    if ( ! wp_verify_nonce( $nonce, 'uninstall_demo_nonce' ) ) {
        die ( 'Busted!');   
    }
    
    /**
     * delete posts
     */
    $args = array(
        'post_type'      => array( 'any', 'post', 'page', 'attachment', 'revision', 'product', 'fox_block', 'nav_menu_item' ),
        'meta_key'       => '_foxdemo',
        'post_status'    => array( 'publish', 'auto-draft', 'private', 'any' ),
        'posts_per_page' => 1000,
        'fields'         => 'ids',
    );
    $q = new WP_Query( $args );
    while ( $q->have_posts() ) {
        $q->the_post();
        $post_type = get_post_type();
        if ( in_array( $post_type, [ 'post', 'page', 'fox_block', 'product' ] ) ) {
            wp_delete_post( get_the_ID(), false );
        } else {
            wp_delete_post( get_the_ID(), true );
        }
        
    }
    wp_reset_query();
    
    /**
     * delete terms
     */
    $args = array(
        'hide_empty' => false,
        'meta_key'   => '_foxdemo',
    );
    $terms = get_terms( $args );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            wp_delete_term( $term->term_id, $term->taxonomy );
        }
    }
    
    /**
     * delete menus
     * this is because we don't have _foxdemo for menu
     */
    
    /**
     * history
     */
    fox_restore_history();
    
    /**
     * restore history
     */
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Uninstall successfully. It is <a href="' . admin_url( 'admin.php?page=import-demo' ) . '">ready to import the demo</a>.',
    ]);
    die();
    
}

function fox_restore_history() {
    
    /**
     * reset theme mod
     */
    $theme = get_option( 'stylesheet' );
    delete_option( 'theme_mods_'. $theme );

    // get history
    $history = get_option( 'fox_history', [] );
    if ( ! $history ) {
        return;
    }

    $history = wp_parse_args( $history, array(
        'options'       => [],
        'widgets'       => '',
        'show_on_front' => 'posts',
        'page_on_front' => '',
        'mods'          => '',
    ) );

    update_option( 'sidebars_widgets',   $history[ 'widgets' ] );
    update_option( 'show_on_front',      $history[ 'show_on_front' ] );
    update_option( 'page_on_front',      $history[ 'page_on_front' ] );
    update_option( 'theme_mods_'.$theme, $history[ 'mods' ] );
    delete_option( 'fox_history' );
    
    // reset theme mode demo
    remove_theme_mod( 'wi_demo' );
}

/* RECOMMEND PLUGINS
---------------------------------------------------------------------------------------------------- */
function fox_demo_register_plugins( $plugins ) {

    $theme_plugins = [
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
    ];
 
    /**
     * recommend only theme plugins
     */
    return $theme_plugins;
    
}
add_filter( 'ocdi/register_plugins', 'fox_demo_register_plugins', 100 );

/* DEMO ARRAY
---------------------------------------------------------------------------------------------------- */
function fox_demo_array() {

    $cache_time = YEAR_IN_SECONDS;

    if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
        $key = 'fox_v63_demos_elementor';
    } else {
        $key = 'fox_v63_demos_no_elementor';
    }

    /**
     * if this is the main demo page, we will REFRESH it, always retrieve the latest and set transient
     */
    global $pagenow;
    if( is_admin() && 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'import-demo' == $_GET['page'] ) {
        // without following params:
        if ( ! isset( $_GET['import-mode'] ) && ! isset( $_GET['step'] ) ) {
            $demo_arr = fox_get_remote_demo_array();
            set_transient( $key, $demo_arr, $cache_time );
        } else {
            $demo_arr = get_transient( $key );
        }
    } else {
        $demo_arr = get_transient( $key );
    }

    if ( ! is_array( $demo_arr ) ) {
        $demo_arr = [];
    }

    return $demo_arr;

}

function fox_get_remote_demo_array() {

    if ( ! fox_is_registered() ) {
        return [];
    }

    if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
        $url = 'https://thefox.withemes.com/wp-json/demos/v1/list/?version=' . time();
    } else {
        $url = 'https://thefox.withemes.com/wp-json/non_elementor_demos/v1/list/?version=' . time();
    }

    /**
     * we try to get demo every single time we visit the import demo page
     */
    $response = wp_remote_get( $url );
    if ( is_wp_error( $response ) ) {
        return [];
    }

    $body = wp_remote_retrieve_body( $response );
    $demos = json_decode( $body, true );
    
    // final guard
    if ( ! is_array( $demos ) ) {
        $demos = [];
    }

    // Notice minimum required for FOX
    $import_notice = '';
    $minimum_required = array(
        'max_execution_time'    => 120,
        'post_max_size'         => '128M',
        'upload_max_filesize'   => '128M',
        'memory_limit'          => '512M',
        'max_input_vars'        => 1000,
        'max_input_time'        => 60
    );
    foreach( $minimum_required as $k => $v ) {
        $server_value = ini_get( $k );
        // unlimit value
        if( $server_value == -1 || $server_value == 0 ) { continue; }

        if( fox56_compare_serverconfig( $v, $server_value ) > 0 ) {
            if( !$import_notice ) { $import_notice = '<big style="color:#e68a00"><strong>Minimum Required:</strong></big>'; }
            $import_notice .= "<br/><big>{$k}</big>: {$v} --(Current: {$server_value})";
        }
    }
    
    if( $import_notice && $demos ) {
        foreach( $demos as $k => $demo ) {
            $demos[$k]['import_notice'] = $import_notice;
        }
    }

    return $demos;
}

/* fox demo guide - since 6.3.1
------------------------------------ */
add_filter( 'ocdi/plugin_intro_text', 'fox_demo_guide' );
function fox_demo_guide( $text ) {
    $texts = [];
    $demos = fox_demo_array();
    $demo_array_by_slug = [];
    foreach ( $demos as $dm ) {
        $demo_array_by_slug[ $dm['slug'] ] = $dm;
    }
    if ( empty( $demos ) ) {
        $texts[] = 'Somehow we can\'t fetch the demo list from The Fox server. See <a href="https://withemes-docs.com/fox/01+.+Getting+started/3+.+Import+Demo+Content#Import+demo+content+manually" target="_blank">this instruction</a> to import demo data manually. If you cant import demo anyway, please <a href="https://withemes.ticksy.com/" target="_blank">contact us for support</a>.';
    } else {
        // import only settings
        $texts[] = 'By default, importing the demo below will import dummy content (posts, images) and the demo settings. If you want to import theme settings only, please see <a href="https://withemes-docs.com/fox/01+.+Getting+started/3+.+Import+Demo+Content#Import+Only+Settings" target="_blank">this guide</a>.';
    }

    $get_demo = get_theme_mod( 'wi_demo' );
    if ( $get_demo ) {
        if ( isset( $demo_array_by_slug[ $get_demo ] ) ) {
            $demo_name = $demo_array_by_slug[ $get_demo ][ 'import_file_name' ];
        } else {
            $demo_name = ucfirst( $get_demo );
        }
        $uninstall_form = '<span>You currently have the demo <strong>' . $demo_name . '</strong> installed. To import another demo, you must uninstall the current demo first.</span>';
        $uninstall_form .= '<span style="color:red">IMPORTANT NOTE: After uninstalling, all demo posts go to Trash and the system does not delete any current content. However if you worry about it, please check your Trash after uninstalling to make sure it doesn\'t delete anything wrong.</span>';
        $uninstall_form .= '<a href="#" class="uninstall-demo-btn" data-nonce="' . wp_create_nonce( 'uninstall_demo_nonce' ) . '" data-action="uninstall_demo">Uninstall Demo</button>';

        $uninstall_form .= '<span class="loading-icon"></span><div class="loading-cover"></div>';

        $texts[] = $uninstall_form;
    }

    $ul = [];
    foreach( $texts as $t ) {
        $ul[] = '<div class="fox__demo__text">' . $t . '</div>';
    }
    $text = join( "\n", $ul );
    return $text;
}

/* IMPORT LOCATION UNDER FOX MENU
---------------------------------------------------------------------------------------------------- */
add_filter( 'ocdi/plugin_page_setup', 'fox_ocdi_plugin_page_setup' );
function fox_ocdi_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'fox';
	$default_settings['page_title']  = 'Import Demo Data';
	$default_settings['menu_title']  = 'Import Demo Data';
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'import-demo';

	return $default_settings;
}

/* SIDEBAR PROBLEM
---------------------------------------------------------------------------------------------------- */
add_action( 'ocdi/before_widgets_import', 'fox_setsidebar', 5 );
add_action( 'ocdi/customizer_import_execution', 'fox_setsidebar', 5 );
function fox_setsidebar() {

    global $wp_registered_sidebars;
    
    // added by @withemes
    $fox_sidebars = get_theme_mod( 'fox_sidebars' );
    if ( is_array( $fox_sidebars ) ) {
        $wp_registered_sidebars += $fox_sidebars;
    }
    
}

/*
 * define demo files
 ------------------------------------ */
add_filter( 'pt-ocdi/import_files', 'fox_ocdi_import_files' );
function fox_ocdi_import_files () {
    return fox_demo_array();
}

/* AFTER IMPORT
---------------------------------------------------------------------------------------------------- */
add_action('pt-ocdi/after_import', 'fox_ocdi_after_import_setup');
function fox_ocdi_after_import_setup( $selected_import ) {
    /**
     * 01 - set up frontpage, blog
     */
    if ( isset( $selected_import[ 'frontpage' ] ) ) {
        
        $frontpage = get_page_by_path( $selected_import[ 'frontpage' ] );
        $blog = null;
        if ( isset( $selected_import[ 'blog' ] ) ) {
            $blog = get_page_by_path( $selected_import[ 'blog' ] );   
        }
        if ( $frontpage ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $frontpage->ID );
            
            if ( $blog ) {
                update_option( 'page_for_posts', $blog->ID );
            }
        } else {
            update_option( 'show_on_front', 'posts' );
        }
        
    } else {
        update_option( 'show_on_front', 'posts' );
    }
    
    /**
     * 02 - set up menu to locations
     */
    $nav_menu_locations = [];
    $locations = [ 'primary', 'footer', 'mobile', 'search-menu' ];
    foreach ( $locations as $lo ) {
        $menu_name = isset( $selected_import[ $lo ] ) ? $selected_import[ $lo ] : '';
        if ( ! $menu_name ) {
            continue;
        }
        
        $get_menu = get_term_by( 'name', $menu_name, 'nav_menu' );
        if ( ! $get_menu ) {
            continue;
        }
        $nav_menu_locations[ $lo ] = $get_menu->term_id;
    }
    set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
    
    /**
     * 03 - WooCommerce shop ID
     */
    $shop = get_page_by_path( 'shop' );
    if ( $shop ) {
        update_option( 'woocommerce_shop_page_id', $shop->ID );
    }
    $cart = get_page_by_path( 'cart' );
    if ( $cart ) {
        update_option( 'woocommerce_cart_page_id', $cart->ID );
    }
    $checkout = get_page_by_path( 'checkout' );
    if ( $checkout ) {
        update_option( 'woocommerce_checkout_page_id', $checkout->ID );
    }
    $my_account = get_page_by_path( 'my-account' );
    if ( $my_account ) {
        update_option( 'woocommerce_myaccount_page_id', $my_account->ID );
    }
    
    /**
     * 04 - Permalink
     */
    //Set permalink
    global $wp_rewrite;
    $wp_rewrite->flush_rules( true );

    /**
     * 05 - Elementor Settings
     * @todo
     */
    
    /**
     * 06 - set theme mod
     * @todo
     */
    $slug = isset( $selected_import['slug'] ) ? $selected_import['slug'] : '';
    set_theme_mod( 'wi_demo', $slug );
    
    
    /**
     * 07 - delete hello-world
     * @since 4.9.2
     */
    $hello_world_post = get_page_by_path('hello-world',OBJECT,'post');
    if ( $hello_world_post ) {
        wp_delete_post( $hello_world_post->ID );
    }

    /**
     * 08 - create the-fox-demo category and Add set for Post Demo
     * @since 6.2.8
     */
    fox56_set_demo_post_timestamp();
}

function fox56_set_demo_post_timestamp() {
    
    /**
     * create the-fox-demo category and Add set for Post Demo
     */
    // $the_fox_demo_cat = wp_create_category( '--The-Fox-Demo--' );
    $timestamp = current_time( 'timestamp', false );
    $timestamp_gmt = current_time( 'timestamp', true );
    $args = array(
        'post_type'      => array( 'post', 'page' ),
        'meta_key'       => '_foxdemo',
        'post_status'    => array( 'publish' ),
        'posts_per_page' => 1000,
        'fields'         => 'ids',
        'orderby'        => 'post_date',
        'order'          => 'DESC'
    );
    $q = new WP_Query( $args );
    while ( $q->have_posts() ) {
        $q->the_post();
        //Change post_date to current time
        wp_update_post( array(
            'ID' => get_the_ID(),
            'post_date' => date( 'Y-m-d H:i:s', $timestamp-- ),
            'post_date_gmt' => date( 'Y-m-d H:i:s', $timestamp_gmt-- ),
        ) );

    }
    wp_reset_query();
}

/* BEFORE IMPORT
---------------------------------------------------------------------------------------------------- */
function fox_demo_before_import( $selected_import ) {
    
    /**
     * delete all _foxdemo posts in trash from uninstall process
     */
    $args = array(
        'post_type'      => array( 'any', 'post', 'page', 'attachment', 'revision', 'product', 'fox_block', 'nav_menu_item' ),
        'meta_key'       => '_foxdemo',
        'post_status'    => array( 'trash' ),
        'posts_per_page' => 1000,
        'fields'         => 'ids',
    );
    $q = new WP_Query( $args );
    while ( $q->have_posts() ) {
        $q->the_post();
        wp_delete_post( get_the_ID(), true );
    }
    wp_reset_query();
    
    $theme = get_option( 'stylesheet' );

    // SAVE CURRENT SITE SETTINGS
    if( ! get_option( 'fox_history' ) ){

        $history = array(
            'widgets'       => get_option( 'sidebars_widgets' ),
            'show_on_front' => get_option( 'show_on_front' ),
            'page_on_front' => get_option( 'page_on_front' ),
            'mods'          => get_option( 'theme_mods_'. $theme ),
            'demo'          => get_theme_mod( 'wi_demo' ),
        );

        update_option( 'fox_history', $history, 'no' );
    }

    // delete theme mods first to make sure things go well 
    delete_option( 'theme_mods_'.$theme );
    
}
add_action( 'ocdi/before_content_import', 'fox_demo_before_import' );

/* SET SIDEBARS BEFORE IMPORTING WIDGETS
---------------------------------------------------------------------------------------------------- */
add_action( 'ocdi/before_content_import', 'fox56_import_sidebars' );
function fox56_import_sidebars( $selected_import ) {

    global $wp_registered_sidebars;

    $current_sidebars = get_theme_mod( 'fox_sidebars', [] );
    $custom_sidebars = isset( $selected_import[ 'custom_sidebars' ] ) ? $selected_import[ 'custom_sidebars' ] : [];
    if ( ! empty( $custom_sidebars ) && is_array( $custom_sidebars ) ) {
        if ( is_array( $current_sidebars ) ) {
            $current_sidebars = array_merge( $current_sidebars, $custom_sidebars );
        } else {
            $current_sidebars = $custom_sidebars;
        }
        set_theme_mod( 'fox_sidebars', $current_sidebars );
    }

    // set it globally for later importing
    $fox_sidebars = get_theme_mod( 'fox_sidebars', [] );
    foreach ( $fox_sidebars as $slug => $sidebar_info ) {
        $wp_registered_sidebars[ $slug ] = $sidebar_info;
    }

}