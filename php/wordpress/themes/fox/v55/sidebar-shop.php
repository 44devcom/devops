<aside id="secondary" class="secondary">
    
    <div class="theiaStickySidebar">

        <div class="widget-area">
            
            <?php if ( is_active_sidebar( 'shop' ) ) { dynamic_sidebar( 'shop' ); } else { ?>
            
            <?php if ( current_user_can( 'administrator' ) ) { ?>
            
                <p class="fox-error">Please go to your <a href="<?php echo get_admin_url( '','widgets.php' ); ?>">Dashboard > Appearance > Widgets</a> to drop your widgets into the sidebar.</p>
            
            <?php } ?>
            
            <?php } ?>
            
            <div class="gutter-sidebar"></div>
            
        </div><!-- .widget-area -->
        
    </div><!-- .theiaStickySidebar -->

</aside><!-- #secondary -->