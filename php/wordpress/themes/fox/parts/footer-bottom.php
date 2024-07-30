<?php
if ( 'false' == get_theme_mod( 'wi_footer_bottom', 'true' ) ) return;
$class = [
    'footer-bottom'
];

// stretch
$stretch = get_theme_mod( 'wi_footer_bottom_stretch', 'content' );
if ( 'full' != $stretch ) $stretch = 'content';
$class[] = 'stretch-' . $stretch;

// skin
$skin = get_theme_mod( 'wi_footer_bottom_skin', 'light' );
if ( 'dark' != $skin ) $skin = 'light';
$class[] = 'skin-' . $skin;
?>

<div id="footer-bottom" role="contentinfo" class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

    <div class="container">
        
        <?php /* ------------       USING FOOTER BOTTOM BUILDER         ------------ */ ?>
        <?php if ( 'true' == get_theme_mod( 'wi_footer_bottom_builder', 'false' ) ) : ?>
        
        <?php $layout = get_theme_mod( 'wi_footer_bottom_layout', 'stack' );
        if ( 'inline' != $layout ) $layout = 'stack'; ?>
        
        <?php if ( 'stack' == $layout ) : ?>
        
        <div class="footer-bottom-stack align-center">
            
            <?php if ( is_active_sidebar( 'footer-bottom-stack' ) ) : ?>
            
            <?php dynamic_sidebar( 'footer-bottom-stack' ); ?>
            
            <?php else : ?>
            
            <?php if ( current_user_can( 'administrator' ) ) { ?>
            <div class="fox-error">
                
                Please go to <a href="<?php echo get_admin_url('','widgets.php'); ?>">Appearance > Widgets</a> and drag/drop widgets into <strong>Footer Bottom</strong> sidebar.
                
            </div><!-- .fox-error -->
            <?php } ?>
            
            <?php endif; ?>
            
        </div><!-- .footer-bottom-stack -->
        
        <?php else : // inline ?>
        
        <div class="footer-bottom-inline">
            
            <div class="footer-bottom-div footer-bottom-left">
                
                <?php if ( is_active_sidebar( 'footer-bottom-left' ) ) : ?>
            
                <?php dynamic_sidebar( 'footer-bottom-left' ); ?>

                <?php endif; ?>
            
            </div><!-- .footer-bottom-left -->
            
            <div class="footer-bottom-div footer-bottom-right">
                
                <?php if ( is_active_sidebar( 'footer-bottom-right' ) ) : ?>
            
                <?php dynamic_sidebar( 'footer-bottom-right' ); ?>

                <?php endif; ?>
            
            </div><!-- .footer-bottom-right -->
            
        </div><!-- .footer-bottom-inline -->
        
        <?php endif; // stack or inline layout ?>
        
        <?php /* ------------       CLASSIC FOOTER BOTTOM         ------------ */ ?>
        <?php else : ?>
        
        <?php 
        $class = [ 'classic-footer-bottom' ];
        $layout = get_theme_mod( 'wi_footer_bottom_classic_layout', 'stack' );
        if ( ! in_array( $layout, [ 'inline' ] ) ) $layout = 'stack';
        $class[] = 'classic-footer-bottom-' . $layout;
        ?>
        
        <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
            
            <?php 
            /* ----------------     FOOTER STACK    ---------------- */
            if ( 'stack' === $layout ) { ?>
        
                <?php if ( 'false' != get_theme_mod( 'wi_footer_logo_show', 'true' ) ) fox_footer_logo(); ?>

                <?php if ( 'false' != get_theme_mod( 'wi_footer_social', 'true' ) ) { fox_footer_social(); } ?>

                <?php if ( 'false' != get_theme_mod( 'wi_footer_search', 'true' ) ) { fox_footer_search(); } ?>

                <?php if ( 'false' != get_theme_mod( 'wi_footer_copyright', 'true' ) ) { fox_footer_copyright(); } ?>

                <?php fox_footer_nav(); ?>
            
            <?php /* ----------------     FOOTER INLINE    ---------------- */
            } elseif ( 'inline' == $layout ) { ?>
            
            <div class="footer-bottom-row footer-bottom-row-main">
                
                <div class="footer-bottom-col-left footer-bottom-col">

                    <?php if ( 'false' != get_theme_mod( 'wi_footer_logo_show', 'true' ) ) fox_footer_logo(); ?>
                    <?php if ( 'false' != get_theme_mod( 'wi_footer_copyright', 'true' ) ) { fox_footer_copyright(); } ?>

                </div><!-- .footer-bottom-col -->

                <div class="footer-bottom-col footer-bottom-col-right">

                    <?php fox_footer_nav(); ?>
                    <?php if ( 'false' != get_theme_mod( 'wi_footer_social', 'true' ) ) { fox_footer_social(); } ?>

                </div><!-- .footer-bottom-col -->
                
            </div><!-- .footer-bottom-row -->
            
            <?php } ?>
            
        </div><!-- .classic-footer-bottom -->
        
        <?php endif; // CLASSIC BUILDER ?>

    </div><!-- .container -->

</div><!-- #footer-bottom -->