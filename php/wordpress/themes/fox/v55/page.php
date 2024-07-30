<?php
get_header(); ?>

<?php
while ( have_posts() ) : the_post();

$block_id = function_exists( 'fox_framework_page_block_id' ) ? fox_framework_page_block_id() : false;

    if ( $block_id && function_exists( 'fox_block' ) ) {
            ?>
<div class="single-builder single-page-builder">
    
    <div class="container2">
        
        <?php fox_block( $block_id ); ?>
        
    </div>
    
</div><!-- .single-builder -->
<?php
    } else {
        get_template_part( 'parts/page', 'classic' );
    }

endwhile;
?>

<?php get_footer();