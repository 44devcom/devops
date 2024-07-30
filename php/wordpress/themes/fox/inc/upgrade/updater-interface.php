<?php
/* add admin_menu
======================================================== */
add_action( 'admin_menu', 'fox56_add_upgrade_theme_engine_submenu', 100 );
if ( ! function_exists( 'fox56_add_upgrade_theme_engine_submenu' ) ) :
function fox56_add_upgrade_theme_engine_submenu() {

    if ( fox56_has_activated_6() ) {
        $title = 'Switch back Theme Engine to v5';
    } else {
        $title = 'Upgrade Theme Engine to Version 6';
    }

    add_submenu_page(
        'fox',
        $title,
        $title,
        'manage_options',
        'fox-updater',
        'fox56_upgrade_theme_engine_page',
    );
}
endif;

/* upgrade theme engine page
======================================================== */
if ( ! function_exists( 'fox56_upgrade_theme_engine_page' ) ) :
function fox56_upgrade_theme_engine_page() {
    if ( ! current_user_can( 'manage_options') ) {
        wp_die();
    }

    if ( ! fox56() ) {
        fox56_upgrade_theme_engine_page_style();
        fox56_upgrade_theme_engine_page_upgrade();
    } else {
        fox56_upgrade_theme_engine_page_style();
        fox56_upgrade_theme_engine_page_downgrade();
    }
}
endif;

function fox56_upgrade_theme_engine_page_style() { ?>
    <style>
        .updater56 {
            max-width: 1000px;
        }
        .updater56__msg {
            display: none;
        }
        .updater56 .message {
            background: white;
            border: 1px solid #d0d0d0;
            padding: 24px;
            margin: 0 0 24px;
        }
        .updater56 .message p {
            font-size: 16px;
            margin: 0;
        }
        .updater56 .updater56__success {
            background: #eeffee;
            border-color: #d2f0d2;
        }
        .updater56 .updater56__success p {
            color: #1d5e1d;
        }
        .updater56 .updater56__error {
            background: #ffe4e4;
            border: 1px solid #dec7c7;
        }
        .updater56 .updater56__error p {
            color: #581212;
        }

        /* the button */
        .updater56 button.button.button-primary,
        .updater56 button.button {
            width: 100%;
            font-size: 20px;
            text-align: center;
        }
        .updater56__log {
            border: 1px solid rgba(0,0,0,.1);
            padding:10px;
            padding-left: 30px;
            background: white;
            display: none;
            width: 100%;
        }
        .updater56__log * {
            box-sizing: border-box;
        }
        .updater56__log ol {
            margin: 0;
            padding: 0;
            display: flex;
            flex-flow: row wrap;
        }
        .updater56__log ol li {
            width: 33.33%;
            border-bottom: 1px solid rgba(0,0,0,.1);
            padding: 10px;
        }
        .updater56__log .red {
            color: red;
        }
        .updater56__log .green {
            color: green;
        }
        .updater56__log .orange {
            color: orange;
        }
        .updater56__log .gray {
            color: #555;
            background: #eee6e6;
        }
    </style>
    <?php
}

function fox56_upgrade_theme_engine_page_upgrade() {

    /*
    if ( ! fox56() ) {
        $upgrader = new Fox56_Upgrade_Theme_Engine();
        $upgrader->just_run();
    }
    */

    ?>
    <div class="wrap">
        <h1><span>Upgrade Theme Engine to v6</span></h1>

        <div class="updater56">

            <div class="message">
                <p style="color: red;">Before process, please <a href="https://docs.withemes.com/thefox/the-fox-v5/theme-engine" target="_blank" style="color: red;">read the details about Theme Engine here &rarr;</a></p>
            </div>

            <div class="message">
                <p>Your Current Theme Engine: <strong><?php echo FOX_VERSION; ?></strong></p>
            </div>

            <div class="message">
                <button class="button button-primary button-upgrade">Upgrade Theme Engine to v6</button>
            </div>

            <div class="message updater56__msg"></div>
            <div class="updater56__log" onClick="this.select()"></div>

        </div><!-- .updater56 -->

    </div><!-- .wrap -->
    <?php
}

function fox56_upgrade_theme_engine_page_downgrade() {
    ?>
    <div class="wrap">
        <h1><span>Switch back Theme Engine to v5</span></h1>

        <div class="updater56">

            <div class="message">
                <p>Your Current Theme Engine: <strong><?php echo FOX_VERSION; ?></strong></p>
            </div>

            <div class="message">
                <button class="button button-downgrade">Switch back to v5</button>
            </div>

        </div><!-- .updater56 -->

    </div><!-- .wrap -->
    <?php
}

/* javascript
======================================================== */
add_action( 'admin_footer', 'fox56_updater_js' );
function fox56_updater_js() {
    if ( ! current_user_can( 'manage_options') ) {
        return;
    }
    ?>
    <script type="text/javascript" >
        if ( undefined === ajaxurl ) {
            var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
        }
        jQuery(".button-upgrade").on( "click", function( e ) {
            jQuery( this ).attr("disabled", true).text( 'Theme Engine is upgrading...' );
            var btn = jQuery( this )
            e.preventDefault();
            var data = {
                'action': 'fox56_upgrade_engine',
            };
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                success: function( response ) {
                    jQuery( '.updater56__msg' ).html( '<p>' + response.message + '</p>' ).show()
                    jQuery( '.updater56__log' ).html( response.log ).show()
                    if ( response.status == 'success' ) {
                        btn.parent().remove()
                        jQuery( '.updater56__msg' ).show().removeClass( 'updater56__error' ).addClass( 'updater56__success' )
                    } else {
                        btn.text( 'Re-upgrade' ).removeAttr( 'disabled' )
                        jQuery( '.updater56__msg' ).show().removeClass( 'updater56__success' ).addClass( 'updater56__error' )
                    }
                    
                }
            })
        });

        jQuery(".button-downgrade").on( "click", function( e ) {
            jQuery( this ).attr("disabled", true).text( 'Theme Engine is switching back to v5...' );
            var btn = jQuery( this )
            e.preventDefault();
            var data = {
                'action': 'fox56_downgrade_engine',
            };
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                success: function( response ) {
                    btn.text( 'Reloading...' )
                    setTimeout(function(){
                        window.location.reload()
                    }, 200 )
                }
            })
        });

    </script>
    <?php
}

add_action( 'wp_ajax_fox56_upgrade_engine', 'fox56_upgrade_engine_callback' );
function fox56_upgrade_engine_callback() {
    if ( ! current_user_can( 'manage_options') ) {
        wp_die();
    }

    $upgrader = new Fox56_Upgrade_Theme_Engine();
    $upgrader->run();

    // if we success
    if ( '6.0' == get_option( 'fox56_version' ) ) {
        wp_send_json([
            'status' => 'success',
            'message' => 'Congratulations! Your Theme Engine is now v6. Below is the Update Log:',
            'log' => $upgrader->get_log(),
        ]);
    } else {
        wp_send_json([
            'status' => 'fail',
            'message' => $upgrader->message,
            'log' => $upgrader->get_log(),
        ]);

    }
    wp_die();
}

add_action( 'wp_ajax_fox56_downgrade_engine', 'fox56_downgrade_engine_callback' );
function fox56_downgrade_engine_callback() {
    if ( ! current_user_can( 'manage_options') ) {
        wp_die();
    }

    update_option( 'fox56_version', '5.5' );

    wp_send_json([
        'status' => 'success',
    ]);    wp_die();
}