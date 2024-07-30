<article id="wi-content" <?php post_class( $args[ 'post_class' ] ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php if ( ! fox_is_minimal_header() ) { fox_hero_full(); } ?>
    
    <?php do_action( 'fox_single_top', $args ); // since 4.3 ?>
    
    <div class="single-big-section single-big-section-content">
    
        <div class="container">

            <div id="primary" class="primary content-area">

                <div class="theiaStickySidebar">

                    <?php fox_single_body( $args ); ?>

                </div><!-- .theiaStickySidebar -->

            </div><!-- #primary -->

            <?php fox_sidebar(); ?>

        </div><!-- .container -->
        
    </div><!-- .single-big-section -->
    
    <?php do_action( 'fox_single_bottom', $args ); ?>
    
</article><!-- .post -->