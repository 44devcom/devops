<?php
/**
 * Template Name: Fox Elementor Blank Page
 * Template Description: Used to build page Elementor pages, no styles
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="wi-content" <?php post_class( 'no-sidebar' ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <div class="container2">

        <div class="blank-content">
        
            <?php the_content(); ?>
            
        </div><!-- .blank-content -->

    </div><!-- .container -->
    
</article><!-- .post -->

<?php endwhile; // End the loop. ?>

<?php get_footer();