<article id="wi-content" <?php post_class( $args[ 'post_class' ] ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php fox_single_thumbnail( $args ); ?>
    
    <div class="single-big-section single-big-section-content">
    
        <div class="container">

            <div id="primary" class="primary content-area">

                <div class="theiaStickySidebar">

                    <?php fox_page_header( $args ); ?>
                    <?php fox_page_body( $args ); ?>

                </div><!-- .theiaStickySidebar -->

            </div><!-- #primary -->

            <?php fox_sidebar( 'page' ); ?>

        </div><!-- .container -->
        
    </div>
    
</article><!-- .post -->