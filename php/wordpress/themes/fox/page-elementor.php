<?php
/**
 * Template Name: Fox Elementor Blank Page
 * Template Description: Used to build page Elementor pages, no styles
 */ ?>
<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/page-elementor.php'); return; } ?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="wi-content" <?php post_class( 'no-sidebar' ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php the_content(); ?>
    
</article><!-- .post -->

<?php endwhile; // End the loop. ?>

<?php get_footer();