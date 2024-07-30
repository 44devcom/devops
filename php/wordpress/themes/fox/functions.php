<?php
if ( ! defined( 'WITHEMES_UPDATES_URL' ) ) {
    define( 'WITHEMES_UPDATES_URL', 'https://withemes.com/updates/' );
}

/* functions for classification
    theme engine currently being used
    old/new customer
==================================================================================================== */
function fox56_purchase_after_v6() {
    $fox_item_purchase_data = get_option( 'fox_item_purchase_data', [] );
    if ( ! $fox_item_purchase_data ) {
        $fox_item_purchase_data = get_site_option( 'fox_item_purchase_data', [] );
    }
    if ( isset( $fox_item_purchase_data[ 'sold_at'] ) && $fox_item_purchase_data[ 'sold_at'] ) {
        $sold_at = $fox_item_purchase_data[ 'sold_at'];
        $sold_at_time = strtotime( $sold_at );
        $v6_release = strtotime("2023-07-25");
        if ( $sold_at_time > $v6_release ) {
            return true;
        } else {
            return false;
        }
    }
    return null;
}

if ( ! function_exists( 'fox56_is_old_customer') ) :
/**
 * this function checks this is old or new customer
 * It's not related to theme engine
 * RETURN bool
 */
function fox56_is_old_customer() {

    /**
     * if we confirm 100% this's new customer, quickly disprove regardless wi_ things
     */
    if ( true === fox56_purchase_after_v6() ) {
        return false;
    }

    /**
     * case 1: purchase date < v6
     * case 2: no purchase date
     */
    $test_options = [
        'wi_logo',
        'wi_body_font',
        'wi_heading_font',
        /*
        'wi_body_background',
        'wi_content_width',
        'wi_site_border',
        'wi_home_layout',
        'wi_main_stream_order',
        'wi_max_sections', */
    ];
    foreach ( $test_options as $option ) {
        if ( get_theme_mod( $option ) ) {
            return apply_filters( 'fox56_old_customer', true );
        }
    }
    if ( '4' == get_option( 'fox_version' ) ) {
        return apply_filters( 'fox56_old_customer', true );
    }
    
    return apply_filters( 'fox56_old_customer', false );
}
endif;

if ( ! function_exists( 'fox56_is_new_customer' ) ) :
/**
 * RETURN bool
 */
function fox56_is_new_customer() {

    if ( true === fox56_purchase_after_v6() ) {
        return true;
    }

    /**
     * case 1: purchase date < v6
     * case 2: no purchase date
     */

    return ! fox56_is_old_customer();
}
endif;

/**
 * RETURN bool
 */
function fox56_has_activated_6() {
    $compare = '6.0' == get_option( 'fox56_version' );
    return apply_filters( 'fox56_activated_6', $compare );
}

if ( ! function_exists( 'fox56_theme_engine' ) ) :
/**
 * RETURN bool
 */
function fox56_theme_engine() {
    // new customer --> v6
    if ( fox56_is_new_customer() ) {
        return apply_filters( 'fox56_theme_engine', 'v6' );
    }
    // old customer but activated theme engine --> v6
    if ( fox56_has_activated_6() ) {
        return apply_filters( 'fox56_theme_engine', 'v6' );
    }
    return apply_filters( 'fox56_theme_engine', 'v5' );
}
endif;

/**
 * RETURN bool
 */
function fox56_has_framework() {
    return defined( 'FOX_FRAMEWORK_VERSION' );
}

if ( ! function_exists( 'fox56' ) ) :
/**
 * fox56 when theme engine is v6
 */
function fox56() {
    return 'v6' == fox56_theme_engine();
}
endif;

if ( ! function_exists( 'fox56_prefix' ) ) :
function fox56_prefix() {
    if ( fox56() ) {
        return '';
    } else {
        return 'wi_';
    }
}
endif;

/*  upgrade area for CONFIRMED old customers
only for verified customers
==================================================================================================== */
if ( fox56_is_old_customer() ) {
    $fox_item_purchase_data = get_option( 'fox_item_purchase_data', [] );
    if ( ! $fox_item_purchase_data ) {
        $fox_item_purchase_data = get_site_option( 'fox_item_purchase_data', [] );
    }
    if ( isset( $fox_item_purchase_data[ 'sold_at'] ) && $fox_item_purchase_data[ 'sold_at'] ) {
        include_once(dirname( __FILE__ ). '/inc/upgrade-theme-engine.php');
    }
}

/* include stuffs for corresponding theme engine
==================================================================================================== */
if ( fox56() ) {
    include_once(dirname( __FILE__ ).'/fox56.php' );
} else {
    include_once(dirname( __FILE__ ).'/v55/functions.php' );
}

add_action( 'fox_system_info', 'fox56_system_info_report' );
if ( ! function_exists( 'fox56_system_info_report' ) ) :
function fox56_system_info_report() {
    $info = array(
        'php_version' => array(
            'value' => phpversion(),
            'title' => 'PHP Version',
            'passed'  => ( version_compare( phpversion(), '7.0.0' ) >= 0 ) ? true : false,
            'warning' => 'The Fox theme requires PHP version >= 5.4 but we recommend PHP at least 7.0. You can ask your hosting provider to upgrade PHP version.'
        ),
        'theme_engine' => array(
            'value' => FOX_VERSION,
            'title' => 'Theme Engine Version',
            'passed'  => fox56(),
            'warning' => 'You are currently using <em style="color:red;font-weight:bold">Theme Engine v' . FOX_VERSION . '</em>.<br>You can <a href="' . admin_url( 'admin.php?page=fox-updater' ) . '">update the theme engine to v6 there &rarr;</a>',
        ),
        'memory_limit'    => array(
            'title'   => 'Memory Limit',
            'value'   => size_format( wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) ) ),
            'passed'  => ( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) >= 67108864 ) ? true : false,
            'warning' => 'The memory_limit value is set low. We recommend this value to be at least 64MB. You can ask your hosting provider to change this value.'
        ),
        'max_execution_time'    => array(
            'title'   => 'Max Execution Time',
            'value'   => ini_get( 'max_execution_time' ),
            'passed'  => ( ini_get( 'max_execution_time' ) >= 60 ) ? true : false,
            'warning' => 'The max_execution_time value is set low. We recommend this value to be at least 60. You can ask your hosting provider to change this value.'
        ),
        'max_input_vars'  => array(
            'title'   => 'Max Input Vars',
            'value'   => ini_get( 'max_input_vars' ),
            'passed'  => ( ini_get( 'max_input_vars' ) >= 2000 ) ? true : false,
            'warning' => 'The max_input_vars value is set low. We recommend this value to be at least 2000. You can ask your hosting provider to change this value.',
        ),
        'post_max_size'   => array(
            'title'   => 'Post Max Size',
            'value'   => ini_get( 'post_max_size' ),
            'passed'  => ( (int) ini_get( 'post_max_size' ) >= 32 ) ? true : false,
            'warning' => 'The post_max_size value is set low. We recommended this value to be at least 32M. You can ask your hosting provider to change this value.',
        ),
        'max_upload_size' => array(
            'title'   => 'Max Upload Size',
            'value'   => size_format( wp_max_upload_size() ),
            'passed'  => ( wp_max_upload_size() >= 33554432 ) ? true : false,
            'warning' => 'The max_upload_size value is set low. We recommended this value to be at least 32M. You can ask your hosting provider to change this value.',
        ),
    );
                                             
?>    

    <ul>
        <?php foreach ( $info as $k => $infodata ) {
            $li_cl = [ 'info-item' ]; if ( ! $infodata['passed'] ) { $li_cl[] = 'info-item-warning'; }
        ?>
        
        <li class="<?php echo esc_attr( join( ' ', $li_cl ) ); ?>">
            <span><?php echo $infodata[ 'title' ]; ?></span>
            <strong><?php echo $infodata[ 'value']; ?></strong>
            
            <?php if ( ! $infodata['passed'] ) { ?>
            <small><?php echo $infodata[ 'warning' ]; ?></small>
            <?php } ?>
        </li>
        
        <?php } ?>

    </ul>
    <?php
}
endif;

/* debug info
==================================================================================================== */
add_action( 'wp_footer', 'fox56_v6_debug_status' );
function fox56_v6_debug_status() {
    ?>
    <span fox56_is_new_customer="<?php echo fox56_is_new_customer(); ?>"></span>
    <span fox56_has_activated_6="<?php echo fox56_has_activated_6(); ?>"></span>
    <span fox56_has_framework="<?php echo fox56_has_framework(); ?>"></span>
    <?php
}

/* backup theme_mods_fox
==================================================================================================== */
/**
 * weekly backup
 */
add_action( 'fox_weekly_backup_cron_hook', 'fox_weekly_backup_cron_exec' );
if ( ! wp_next_scheduled( 'fox_weekly_backup_cron_hook' ) ) {
    wp_schedule_event( time(), 'weekly', 'fox_weekly_backup_cron_hook' );
}

function fox_weekly_backup_cron_exec() {
    $mods = get_theme_mods();

    $backups = get_option( 'fox_weekly_backup', [] );
    if ( ! is_array( $backups ) ) {
        $backups = [];
    }
    $option_name = 'fox_weekly_backup_' . time();
    $backups[] = [
        'option_name' => $option_name,
        'time' => time(),
    ];

    $final_backups = [];
    $backups_count = count( $backups );
    foreach ( $backups as $i => $backup_data ) {
        if ( $i < $backups_count - 10 ) {
            delete_option( $backup_data[ 'option_name' ] );
        } else {
            $final_backups[] = $backup_data;
        }
    }

    update_option( 'fox_weekly_backup', $final_backups, false );
    update_option( $option_name, $mods, false );
}

/**
 * daily backup
 * 2 days backup
 */
add_action( 'fox_daily_backup_cron_hook', 'fox_daily_backup_cron_exec' );
if ( ! wp_next_scheduled( 'fox_daily_backup_cron_hook' ) ) {
    wp_schedule_event( time(), 'daily', 'fox_daily_backup_cron_hook' );
}

function fox_daily_backup_cron_exec() {
    $mods = get_theme_mods();
    $mods[ 'backup_time' ] = time();

    $backups = get_option( 'fox_daily_backup' );
    if ( ! is_array( $backups ) ) {
        $backups = [];
    }
    $backups[] = $mods;
    if ( count( $backups ) > 2 ) {
        $backups = array_slice($backups, -2, 2, true);
    }

    update_option( 'fox_daily_backup', $backups, false );
}

/*
 * hourly backup
 * removed since 6.0.4
 *
add_action( 'fox_hour_backup_cron_hook', 'fox_hourly_backup_cron_exec' );
if ( ! wp_next_scheduled( 'fox_hour_backup_cron_hook' ) ) {
    wp_schedule_event( time(), 'hourly', 'fox_hour_backup_cron_hook' );
}
function fox_hourly_backup_cron_exec() {
    $mods = get_theme_mods();
    $mods[ 'backup_time' ] = time();

    $backups = get_option( 'fox_hourly_backup', [] );
    if ( ! is_array( $backups ) ) {
        $backups = [];
    }
    $backups[] = $mods;
    if ( count( $backups ) > 3 ) {
        $backups = array_slice($backups, -3, 3, true);
    }

    update_option( 'fox_hourly_backup', $backups );
}
*/

/**
 * disable hourly events
 */
$timestamp = wp_next_scheduled( 'fox_hour_backup_cron_hook' );
wp_unschedule_event( $timestamp, 'fox_hour_backup_cron_hook' );
update_option( 'fox_hourly_backup', [], false );

/**
 * remove events after deactivate theme
 */
add_action( 'switch_theme', 'fox56_stop_cron_jobs' );
function fox56_stop_cron_jobs() {
    $timestamp = wp_next_scheduled( 'fox_hour_backup_cron_hook' );
    wp_unschedule_event( $timestamp, 'fox_hour_backup_cron_hook' );

    $timestamp = wp_next_scheduled( 'fox_daily_backup_cron_hook' );
    wp_unschedule_event( $timestamp, 'fox_daily_backup_cron_hook' );

    $timestamp = wp_next_scheduled( 'fox_weekly_backup_cron_hook' );
    wp_unschedule_event( $timestamp, 'fox_weekly_backup_cron_hook' );
}

/* get purchase information
// why?
==================================================================================================== */
add_action( 'init', function() {

    return;

    $fox_item_purchase_data = get_option( 'fox_item_purchase_data', [] );
    if ( ! $fox_item_purchase_data ) {
        $fox_item_purchase_data = get_site_option( 'fox_item_purchase_data', [] );
    }
    if ( isset( $fox_item_purchase_data['sold_at'] ) && $fox_item_purchase_data['sold_at'] ) {
        return;
    }

    // if this site has a purchase code
    $purchase_code = get_option( 'fox_license', '' );
    if ( ! $purchase_code ) {
        $purchase_code = get_site_option( 'fox_license', '' );
    }
    if ( ! $purchase_code ) {
        return;
    }

    // FOX ITEM ID
    $item_id = '11103012';
    $remote_url = WITHEMES_UPDATES_URL . 'wp-json/withemes-purchase/v1/info/' . $purchase_code . '/' . $item_id;
    $response = wp_remote_get( $remote_url );
    
    if ( ! is_wp_error( $response ) ) {

        $body = wp_remote_retrieve_body( $response );
        $json = json_decode( $body, true );
        
        /**
         * everything goes right
         * it returns success means on the server, the license and site have been added actually
         */
        if ( isset( $json['status'] ) && 'success' == $json['status'] ) {
            update_option( 'fox_item_purchase_data', $json );
            update_site_option( 'fox_item_purchase_data', $json );
        }
        return;

    } else {
        /*
        echo json_encode([
            'status' => 'fail',
            'message' => 'problem connecting the server',
        ]);
        */
    }
    return;
});

/**
 * Add Twitter share image
 */
add_action( 'wp_head', function() {
    if ( ! is_singular() ) {
        return;
    }
    $img_url = get_the_post_thumbnail_url();
    if ( ! $img_url ) {
        return;
    }
    ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo esc_url($img_url); ?>">
    <?php
});
