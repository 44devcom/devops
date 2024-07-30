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

/* HEADER
---------------------------------------------------------------------------------------------------- */
add_action( 'ocdi/plugin_page_header', function() {
    if ( ! fox_is_registered() ) {
        return;
    }
    $demos = fox_demo_array();
    $demo_array_by_slug = [];
    foreach ( $demos as $dm ) {
        $demo_array_by_slug[ $dm['slug'] ] = $dm;
    }
    $get_demo = get_theme_mod( 'wi_demo' );
    
    ?>
<div class="import_settings_guide">
    
    <div class="import-settings-guide-header">
        
        <div class="row">
            <div class="col col-left">
                <h1 class="h1"><span>Import Demo Data</span></h1>
            </div>

            <div class="col col-right">
                <button class="button button-primary">Import Demo Settings Only</button>
            </div>
        </div>
        
    </div><!-- .import-settings-guide-header -->
    
    <div class="import-settings-guide-content">
        
        <p>If your site has content already or you wish to import only theme settings instead of the full content (posts, pages, images..) then here's the guide.</p>
        
        <h4>Step 1: Download the demo settings</h4>
        <p>Click on the demo you want, It opens in a new tab a settings file. Use Ctrl S (Windows) or Cmd S (MacOS) to save the file as <strong>demo_name.dat</strong>. <a href="https://withemes.com/updates/wp-content/uploads/sites/3/2023/03/save_settings_file_guide.jpg" target="_blank" title="Open in new tab">See the guide here</a>.</p>
        
        <ul class="demo-settings-list">
            <?php foreach ( $demos as $demo_item ) { ?>
            <li>
                <a href="<?php echo $demo_item['import_customizer_file_url']; ?>" target="_blank" download="<?php echo $demo_item['slug'] . '.dat'; ?>"><?php echo $demo_item['import_file_name']; ?></a>
            </li>
            <?php } ?>
        </ul>
        
        <h4>Step 2: Import the settings</h4>

        <p>Hit <strong>Switch to Manual Import</strong> below, find <strong>Import Customizer</strong> box and upload the <strong>demo_name.dat</strong> file. <a href="https://withemes.com/updates/wp-content/uploads/sites/3/2023/03/fox_manual_import_guide.jpg" target="_blank" title="Open in new tab">See the guide here</a>.</p>
        
    </div><!-- .import-settings-guide-content -->
    
    <?php if ( $get_demo ) {
        if ( isset( $demo_array_by_slug[ $get_demo ] ) ) {
            $demo_name = $demo_array_by_slug[ $get_demo ][ 'import_file_name' ];
        } else {
            $demo_name = ucfirst( $get_demo );
        }
    ?>
    <div class="uninstall-guide">
    
        <form class="uninstall-demo-form fox-form" method="get">

            <p>You have demo <strong><?php echo $demo_name; ?></strong> installed. To import another demo, you must uninstall the current demo first.
                <br>
            <span style="color:red">IMPORTANT NOTE: After uninstalling, all demo posts go to Trash and the system does not delete any current content. However if you worry about it, please check your Trash after uninstalling to make sure it doesn't delete anything wrong.</span>
            </p>

            <input type="hidden" value="uninstall_demo" name="action" />
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'uninstall_demo_nonce' ); ?>" />

            <div class="fox-message"></div>

            <button type="submit" class="button">Uninstall Demo</button>

            <span class="loading-icon"></span>
            <div class="loading-cover"></div>
        </form>
        
    </div><!-- .uninstall-guide -->
    <?php } ?>
    
</div><!-- .import_settings_guide -->
<?php
} );

add_action( 'ocdi/plugin_page_header', 'fox_register_notice_import_demo' );
function fox_register_notice_import_demo() {
    if ( ! fox_is_registered() ) {
        ?>

<div class="fox-notice fox-error fox-demo-notice">
    <p>You see an EMPTY list of demos here because your site hasn't been registered. To access the demo list, please register the license first. Please <a href="<?php echo admin_url( 'admin.php?page=fox' ); ?>">register your site here &raquo;</a>.</p>
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
---------------------------------------------------------------------------------------------------- *
function fox_demo_register_plugins( $plugins ) {
    
    $demo_list = fox_demo_array();
    $plugin_list = fox_plugin_array();
    $plugin_list_by_slug = [];
    foreach ( $plugin_list as $plugin_data ) {
        $plugin_list_by_slug[ $plugin_data['slug'] ] = $plugin_data;
    }
 
    // Required: List of plugins used by all theme demos.
    $theme_plugins = [];

    // Check if user is on the theme recommeneded plugins step and a demo was selected.
    if (
        isset( $_GET['step'] ) &&
        $_GET['step'] === 'import' &&
        isset( $_GET['import'] )
    ) {
      $index = absint( $_GET['import'] );
      $demo_item = isset ( $demo_list[ $index ] ) ? $demo_list[ $index ] : [];
      $plugins = isset( $demo_item[ 'plugins' ] ) ? $demo_item[ 'plugins' ] : [];

      foreach ( $plugins as $k => $name ) {
          $required = in_array( $k, [ 'elementor', 'fox-framework' ] ) ? true : false;
          $plugin_args = [
              'name'     => $name,
              'slug'     => $k,
              'required' => $required,
              'preselected' => true,
          ];
          
          if ( isset( $plugin_list_by_slug[ $k ] ) ) {
              if ( isset( $plugin_list_by_slug[ $k ][ 'source' ] ) ) {
                $plugin_args[ 'source' ] = $plugin_list_by_slug[ $k ][ 'source' ];
              }
          }
          
          $theme_plugins[] = $plugin_args;
      }
    }
 
    /**
     * recommend only theme plugins
     *
    return $theme_plugins;
    
}
add_filter( 'ocdi/register_plugins', 'fox_demo_register_plugins', 100 );
*/

/* DEMO ARRAY
---------------------------------------------------------------------------------------------------- */
function fox_demo_array() {
    
    if ( ! fox_is_registered() ) {
        return [];
    }
    
    $url = 'https://thefox.withemes.com/wp-json/demos/v1/list/?version=' . time();
    $cache_time = YEAR_IN_SECONDS;
    $key = FOX_DEMOS_KEY;
    $body = get_transient( $key );
    
    $demos = [];
    if ( false === $body ) {

        $response = wp_remote_get( $url );

        if ( ! is_wp_error( $response ) ) {

            $body = wp_remote_retrieve_body( $response );
            $demos = json_decode( $body, true );

            if ( ! empty( $demos ) ) {
                set_transient( $key , $body, $cache_time );
            } else {
                $demos = [];
            }

        } else {
            $demos = [];
        }
    } else {

        $demos = json_decode( $body, true );

    }
    
    if ( ! is_array( $demos ) ) {
        $demos = [];
    }

    return $demos;
    
}

/* switch demo guide
 * removed since v5.5
------------------------------------ */
add_filter( 'ocdi/plugin_intro_text', 'fox_switch_demo_guide' );
function fox_switch_demo_guide( $text ) {
    return '';
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

/**
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