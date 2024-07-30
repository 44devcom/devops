<div class="fox-wrap">
    
    <div class="wrap about-wrap full-width-layout fox-welcome">

        <?php $my_theme = wp_get_theme( 'fox' );
        if ( $my_theme->exists() ) {
            $version = '(v' . $my_theme->Version . ')';
        } else {
            $version = '';
        } ?>
        <h1 class="h1"><span>Welcome to The Fox Magazine <?php echo $version; ?></span></h1>

        <div style="background: beige;padding: 10px; color: #a10000;border: 1px solid #cbcbb5; margin-top: 10px;">
            
            <p style="margin: 0;font-size:1.1em;">You see this message because your current Theme Engine is: <strong><?php echo FOX_VERSION; ?></strong>.
            <br>
            Everything is still working well. However the latest The Fox theme engine is V6. You can <a href="<?php echo admin_url( 'admin.php?page=fox-updater' ); ?>" class="button button-primary" style="font-size:1em">Update Theme Engine</a> Note that you must enter the license below to upgrade theme engine.</p>
        </div>

        <p class="about-text">Thank you once again for purchasing The Fox! Below is few tips for getting started with The Fox.<br>
            While using the item, if you have any problem don't hesitate to <a href="https://withemes.ticksy.com/" target="_blank">reach us</a>.</p>
        
        <?php if ( is_child_theme() ) { ?>
        <div class="child-theme-message fox-warning">
            <p>You're using a child theme of The Fox theme. If you have switched from main them to child theme and your customization is lost (ie. your site looks plain), please <a href="https://docs.withemes.com/fox/#child_theme" target="_blank">read this article &raquo;</a>.</p>
        </div>
        <?php } ?>

        <nav class="nav-tab-wrapper wp-clearfix" aria-label="Secondary menu">

            <a href="<?php echo admin_url( 'admin.php?page=tgma-install-plugins' ); ?>" class="nav-tab">Install Plugins</a>

            <?php if ( defined( 'OCDI_VERSION' ) ) { ?>
            <a href="<?php echo admin_url( 'admin.php?page=import-demo' ); ?>" class="nav-tab">Import Demo</a>
            <?php } ?>

            <a href="<?php echo admin_url( 'admin.php?page=fox-theme-options' ); ?>" class="nav-tab">Theme Options</a>

            <a href="https://docs.withemes.com/thefox/" target="_blank" class="nav-tab">Documentation</a>

            <a href="https://withemes.ticksy.com/" target="_blank" class="nav-tab">Support</a>
            
            <a href="https://docs.withemes.com/thefox/change-log/" target="_blank" class="nav-tab">Change Log</a>

        </nav>

        <div class="fox-welcome-boards">
            
            <div class="fox-welcome-board fox-board-registration fox-board">
                <?php if ( fox_is_registered() ) { ?>
                
                <?php $purchase_code = get_site_option( 'fox_license' );
                                                  if ( ! $purchase_code ) {
                                                      $purchase_code = get_option( 'fox_license', '' );
                                                  }
    
                                                  $purchase_code_censor = substr( $purchase_code, 0, 8 ) . '-****-****-****-********' . substr( $purchase_code, strlen( $purchase_code) - 4 ) ; ?>
                
                <h3 class="green">Registration Completed</h3>
                <form class="fox-form license_form success" method="get">
                    
                    <input type="hidden" name="action" value="fox_revoke_license" />
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'fox_license_nonce' ); ?>" />
                    
                    <input type="hidden" readonly name="purchase_code" class="board-input" value="<?php echo esc_attr( $purchase_code ); ?>" />
                    
                    <input type="text" readonly name="purchase_code_censor" class="board-input" placeholder="Your Purchase Code: ********-****-****-****-************" value="<?php echo esc_attr( $purchase_code_censor ); ?>" />
                    <input type="submit" class="button board-button board-submit revoke-license" value="Unregister" />
                    
                    <div class="fox-message license-message"></div>
                    
                    <span class="loading-icon"></span>
                    <div class="loading-cover"></div>
                    
                </form>
                
                <p>
                    <small>You can <a href="https://withemes.com/updates/wp-admin/" target="_blank">manage your purchase codes here</a> (remove it manually) with username is your themeforest username and password is your purchase code. See the detailed guide <a href="https://docs.withemes.com/thefox/get-started/installation-the-fox/#Manage_Licenses" target="_blank">here</a>.</small>
                </p>
                
                <?php } else { ?>
                
                <?php if ( time() > strtotime( '01 December 2023' ) ) { ?>
                <div class="license-notice"><p>From April 02 - 2023, you will need to enter The Fox purchase code by to keep receiving updates of The Fox Framework plugin and access future demos or FOX Studio. Luckily, It's extremely easy to find your purchase code.</p></div>
                <?php } ?>
                
                <h3>Registration</h3>
                
                <p>Please enter your purchase code below. <a href="https://withemes.com/updates/wp-content/uploads/sites/3/2023/03/fox_purchase_code_guide.jpg" target="_blank">Here's the guide</a>.</p>
                
                <form class="fox-form license_form fail" method="get">
                    
                    <input type="hidden" name="action" value="fox_add_license" />
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'fox_license_nonce' ); ?>" />
                    
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

            <div class="fox-welcome-board fox-board-info">
                <h3>System Info</h3>
                <?php
                // we'll set values here in the FOX Framework plugin
                do_action( 'fox_system_info' ); ?>
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
                        <a href="https://docs.withemes.com/thefox/" target="_blank">Online Documentation &rarr;</a>
                    </li>

                    <li>
                        <a href="https://withemes.ticksy.com/" target="_blank">Dedicated Support &rarr;</a>
                    </li>
                    
                    <li>
                        <a href="https://docs.withemes.com/thefox/change-log/" target="_blank">Change Log &rarr;</a>
                    </li>

                </ol>
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