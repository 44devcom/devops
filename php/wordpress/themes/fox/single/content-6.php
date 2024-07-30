<article id="wi-content" <?php post_class( $args[ 'post_class' ] ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php do_action( 'fox_single_top', $args ); // since 4.3 ?>
    
    <div class="single-big-section single-big-section-content">
        
        <div class="container">

            <div id="primary" class="primary content-area">

                <div class="theiaStickySidebar">

                    <div class="thumbnail-header-area">
                        
                        <?php fox_single_thumbnail( $args ); ?>
                        <?php fox_single_header( $args ); ?>
                    
                    </div><!-- .thumbnail-header-area -->
                    
                    <?php fox_single_body( $args ); ?>

                </div><!-- .theiaStickySidebar -->

            </div><!-- #primary -->

            <?php fox_sidebar(); ?>

        </div><!-- .container -->
        
    </div>
    
    <?php do_action( 'fox_single_bottom', $args ); ?>
    
</article><!-- .post -->