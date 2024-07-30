<article id="wi-content" <?php post_class( $args[ 'post_class' ] ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php if ( ! fox_is_minimal_header() ) { fox_hero_full(); } ?>
    
    <div class="single-big-section single-big-section-content">
    
        <div class="container">

            <div id="primary" class="primary content-area">

                <div class="theiaStickySidebar">

                    <?php fox_page_body( $args ); ?>

                </div><!-- .theiaStickySidebar -->

            </div><!-- #primary -->

            <?php fox_sidebar( 'page' ); ?>

        </div><!-- .container -->
        
    </div><!-- .single-big-section -->
    
</article><!-- .post -->