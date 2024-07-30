<?php if ( ! fox56() ) { include(dirname( __FILE__ ).'/v55/searchform.php'); return; } ?>
<div class="searchform">
    
    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction" class="form">
        
        <input type="text" name="s" class="s search-field" value="<?php echo get_search_query();?>" placeholder="<?php echo fox_word( 'search' ); ?>" />
        
        <button class="submit" role="button" title="<?php echo esc_html__( 'Go', 'wi' ); ?>">
            <?php echo fox56_icon_search(); ?>
        </button>
        
    </form><!-- .form -->
    
</div><!-- .searchform -->