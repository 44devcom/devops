<div class="fox-wrap">
    
    <div class="wrap about-wrap full-width-layout fox-welcome">

        <h1 class="h1"><span>Welcome to The Fox Magazine (v<?php echo FOX_VERSION; ?>)</span></h1>

        <p class="about-text">Thank you once again for purchasing The Fox! Below is few tips for getting started with The Fox.<br>
            While using the item, if you have any problem don't hesitate to <a href="https://withemes.ticksy.com/" target="_blank">reach us</a>.</p>
        
        <?php if ( is_child_theme() ) { ?>
        <div class="child-theme-message fox-warning">
            <p>You're using a child theme of The Fox theme. If you have switched from main them to child theme and your customization is lost (ie. your site looks plain), please <a href="https://withemes-docs.com/fox/14+.+Miscellaneous/Child+theme" target="_blank">read this article &raquo;</a>.</p>
        </div>
        <?php } ?>

        <nav class="nav-tab-wrapper wp-clearfix" aria-label="Secondary menu">

            <a href="<?php echo admin_url( 'admin.php?page=tgma-install-plugins' ); ?>" class="nav-tab">Install Plugins</a>

            <?php if ( defined( 'OCDI_VERSION' ) ) { ?>
            <a href="<?php echo admin_url( 'admin.php?page=import-demo' ); ?>" class="nav-tab">Import Demo</a>
            <?php } ?>

            <a href="<?php echo admin_url( 'admin.php?page=fox-theme-options' ); ?>" class="nav-tab">Theme Options</a>

            <a href="https://withemes-docs.com/fox/01+.+Getting+started/1+.+Getting+started" target="_blank" class="nav-tab">Documentation</a>

            <a href="https://withemes.ticksy.com/" target="_blank" class="nav-tab">Support</a>
            
            <a href="https://withemes-docs.com/fox/Change+Log" target="_blank" class="nav-tab">Change Log</a>

        </nav>

        <div class="fox-welcome-boards">
            
            <div class="fox-welcome-board fox-board-registration fox-board">
                <?php if ( fox_is_registered() ) { ?>
                
                <?php $purchase_code = get_site_option( 'fox_license' );
                                                  if ( ! $purchase_code ) {
                                                      $purchase_code = get_option( 'fox_license', '' );
                                                  }
    
                                                  $purchase_code_censor = substr( $purchase_code, 0, 8 ) . '-****-****-****-********' . substr( $purchase_code, strlen( $purchase_code) - 4 ) ; ?>
                
                <h3 class="">Registration</h3>
                <form class="fox-form license_form_v2 success" method="get">

                    <?php
                    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';
                    if ( 'unregister' == $action ) {
                        $status = isset( $_GET['status'] ) ? $_GET['status'] : '';
                        $code = isset( $_GET['code'] ) ? $_GET['code'] : '';
                        if ( 'fail' == $status ) {
                            $code_msg = [
                                100 => 'Invalid purchase code or the server cant fetch purchase code data',
                                200 => 'This is a valid purchase code but not of The Fox theme',
                                300 => 'This purchase code has been used for the website: ' . $being_used, 
                            ];
                            $msg = isset( $code_msg[ $code] ) ? $code_msg[ $code] : 'Something wrong..';
                            echo '<div class="fox-form-error">' . $msg . '</div>';
                        } elseif ( 'success' == $status ) {
                            if ( '5ZB7eI8nAFAwG3vcHl9vetNEBmJM' == $code ) {

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
                                echo "<script type='text/javascript'>window.location=document.location.href;</script>";
                                die();
                            }
                        }
                    }
                    ?>
                    
                    <input type="hidden" name="action" value="unregister" />
                    
                    <?php 
                    $dollar_url = get_site_url();
                    $dollar_url = str_replace( '://', '$', $dollar_url );
                    $dollar_url = str_replace( '/', '@', $dollar_url );
                    ?>
                    <input type="hidden" name="dollar_url" value="<?php echo esc_attr( $dollar_url ); ?>" />
                    <input type="hidden" name="route" value="https://withemes.com/updates/wp-json/withemes-purchase/v2/" />
                    <input type="hidden" name="item_id" value="11103012" />
                    
                    <input type="hidden" readonly name="purchase_code" class="board-input" value="<?php echo esc_attr( $purchase_code ); ?>" />
                    
                    <input type="text" readonly name="purchase_code_censor" class="board-input" placeholder="Your Purchase Code: ********-****-****-****-************" value="<?php echo esc_attr( $purchase_code_censor ); ?>" />
                    <input type="submit" class="button board-button board-submit revoke-license" value="Unregister" />
                    
                    <div class="fox-message license-message"></div>
                    
                    <span class="loading-icon"></span>
                    <div class="loading-cover"></div>
                    
                </form>
                
                <p>
                    <small>You can see the guide to <a href="https://withemes-docs.com/fox/01+.+Getting+started/5+.+Manage+licenses" target="_blank">manage your purchase codes</a> here.</small>
                </p>
                
                <?php } else { ?>
                
                <h3>Registration</h3>
                
                <p>Please enter your purchase code below. <a href="<?php echo get_template_directory_uri(); ?>/images/purchase_code_guide.jpg" target="_blank">Here's the guide</a>.</p>
                
                <form class="fox-form license_form_v2" method="get">

                    <?php
                    $status = isset( $_GET['status'] ) ? $_GET['status'] : '';
                    $code = isset( $_GET['code'] ) ? $_GET['code'] : '';
                    $being_used = isset( $_GET['being_used'] ) ? $_GET['being_used'] : '';
                    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';
                    if ( 'register' == $action ) {
                        if ( 'fail' == $status ) {
                            $code_msg = [
                                100 => 'Invalid purchase code or the server cant fetch purchase code data',
                                200 => 'This is a valid purchase code but not of The Fox theme',
                                300 => 'This purchase code has been used for the website: ' . $being_used, 
                            ];
                            $msg = isset( $code_msg[ $code] ) ? $code_msg[ $code] : 'Something wrong..';
                            echo '<div class="fox-form-error">' . $msg . '</div>';
                        } elseif ( 'success' == $status ) {
                            if ( '5ZB7eI8nAFAwG3vcHl9vetNEBmJM' == $code ) {

                                $purchase_code = isset( $_GET['purchase_code'] ) ? $_GET['purchase_code'] : '';

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
                                echo "<script type='text/javascript'>window.location=document.location.href;</script>";
                                die();
                            }
                        }
                    }
                    ?>
                    
                    <input type="hidden" name="action" value="register" />
                    <?php 
                    $dollar_url = get_site_url();
                    $dollar_url = str_replace( '://', '$', $dollar_url );
                    $dollar_url = str_replace( '/', '@', $dollar_url );
                    ?>
                    <input type="hidden" name="dollar_url" value="<?php echo esc_attr( $dollar_url ); ?>" />
                    <input type="hidden" name="route" value="https://withemes.com/updates/wp-json/withemes-purchase/v2/" />
                    <input type="hidden" name="item_id" value="11103012" />
                    
                    <input type="text" name="purchase_code" class="board-input" placeholder="Your Purchase Code: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" />
                    <input type="submit" class="button button-primary board-button board-submit check-license" value="Register" />
                    
                    <div class="fox-message license-message"></div>
                    
                    <span class="loading-icon"></span>
                    <div class="loading-cover"></div>
                    
                </form>
                
                <?php } ?>
                
                <p>
                    <small>A purchase code (license) is only valid for One Domain. Are you using this theme on a new domain? <a href="https://themeforest.net/item/the-fox-contemporary-magazine-theme-for-creators/11103012?utm_source=backend&utm_medium=registration_form&utm_campaign=<?php echo esc_attr( fox_admin_safe_site() ); ?>" target="_blank">Purchase a new license here</a> to get a new purchase code.</small>
                </p>
                
            </div>

            <div class="fox-welcome-board fox-board-links">
                <h3>Helpful Link</h3>
                <ol>
                    <li>
                        <a href="<?php echo admin_url( 'admin.php?page=tgma-install-plugins' ); ?>">Install Plugins</a>
                    </li>

                    <?php if ( defined( 'OCDI_VERSION' ) ) { ?>
                    <li>
                        <a href="<?php echo admin_url( 'admin.php?page=import-demo' ); ?>">Import Demo Data</a>
                    </li>
                    <?php } else { ?>
                    
                    <li class="warning">
                        <span style="color:red; text-decoration: underline;">Import Demo Data</span><br>
                        <small style="backgrond:#f5ecec; color: #c00;">You must install <strong>One Click Import Demo plugin</strong> first. After installing that plugin, the Demo Importer menu will appear. <a href="<?php echo admin_url( 'admin.php?page=tgma-install-plugins' ); ?>">Click Here</a> to install it.</small>
                    </li>
                    
                    <?php } ?>
                    
                    <li>
                        <a href="<?php echo admin_url( 'admin.php?page=fox-theme-options' ); ?>">Theme Options</a>
                    </li>

                    <li>
                        <a href="https://withemes-docs.com/fox/01+.+Getting+started/1+.+Getting+started/" target="_blank">Online Documentation &rarr;</a>
                    </li>

                    <li>
                        <a href="https://withemes.ticksy.com/" target="_blank">Dedicated Support &rarr;</a>
                    </li>
                    
                    <li>
                        <a href="https://withemes-docs.com/fox/Change+Log" target="_blank">Change Log &rarr;</a>
                    </li>

                </ol>
            </div>

            <div class="fox-welcome-board fox-board-info">
                <h3>System Info</h3>
                
                <?php
                // we'll set values here in the FOX Framework plugin
                do_action( 'fox_system_info' ); ?>
            </div>
            
            <div class="fox-welcome-board fox-board-info">
                <h3>Tools</h3>
                
                <?php
                // flusk cache, clear transient.. for instance
                do_action( 'fox_tools' ); ?>
            </div>

            <div class="fox-welcome-board fox-board-marketing">

                <h3>Buy Another License</h3>
                <p>Each theme license can be used only for 1 project. If you have 2 projects, please purchase another license</p>

                <a class="button button-primary" href="https://themeforest.net/item/the-fox-contemporary-magazine-theme-for-creators/11103012?utm_source=backend&utm_medium=buy_board&utm_campaign=<?php echo esc_attr( fox_admin_safe_site() ); ?>" target="_blank">Purchase Another License</a>

            </div>

        </div><!-- .fox-welcome-boards -->

    </div>
    
</div>