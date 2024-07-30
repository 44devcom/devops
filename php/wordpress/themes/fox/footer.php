<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/footer.php'); return; } ?>
    </div><!-- #wi-main -->

    <?php
    if ( apply_filters( 'fox_show_footer', true ) ) {
        $block_id = function_exists( 'fox_framework_footer_block_id' ) ? fox_framework_footer_block_id() : false;
        if ( $block_id && function_exists( 'fox_block' ) ) { ?>
        <footer class="site-footer footer-elementor">
            <div class="footer-builder-container">
            
            <?php
                fox_block( $block_id );
            ?>
            </div><!-- .footer-builder-container -->
        </footer>
            
        <?php } else {
            fox56_footer();
        }

    } ?>

    <div class="handborder handborder--top"></div>
    <div class="handborder handborder--right"></div>
    <div class="handborder handborder--bottom"></div>
    <div class="handborder handborder--left"></div>
</div><!-- #wi-all -->

<?php wp_footer(); ?>

</body>
</html>