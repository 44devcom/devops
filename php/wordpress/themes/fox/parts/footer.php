<?php
// since 4.0 - if you wanna disable header for some purpose
if ( ! apply_filters( 'fox_show_footer', true ) ) return; ?>

<?php
$block_id = function_exists( 'fox_framework_footer_block_id' ) ? fox_framework_footer_block_id() : false;

if ( $block_id && function_exists( 'fox_block' ) ) { ?>

<footer class="site-footer footer-elementor">
    <div class="footer-builder-container">
    
    <?php
        fox_block( $block_id );
    ?>
    </div><!-- .footer-builder-container -->
</footer>
    
<?php } else { ?>

<footer id="wi-footer" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    
    <?php if ( is_active_sidebar( 'footer-instagram' ) ) { ?>
    <aside id="footer-instagram" class="footer-section">
        <?php dynamic_sidebar( 'footer-instagram' ); ?>
    </aside>
    <?php } ?>
    
    <?php if ( is_active_sidebar( 'footer-newsletter' ) ) { ?>
    <aside id="footer-newsletter" class="footer-section">
        <?php dynamic_sidebar( 'footer-newsletter' ); ?>
    </aside>
    <?php } ?>
    
    <?php get_template_part( 'parts/footer', 'sidebar' ); ?>
    <?php get_template_part( 'parts/footer', 'bottom' ); ?>

</footer><!-- #wi-footer -->

<?php } ?>