<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/single.php'); return; } ?>
<?php
get_header(); ?>

<?php
while ( have_posts() ) : the_post();

$block_id = function_exists( 'fox_framework_single_block_id' ) ? fox_framework_single_block_id() : false;
    if ( $block_id && function_exists( 'fox_block' ) ) {
        
            ?>
<div class="single-builder">
    
    <div class="container2">
        
        <?php fox_block( $block_id ); ?>
        
    </div>
    
</div><!-- .single-builder -->
<?php
    } else {
        fox56_single();
    }

endwhile;
?>

<?php get_footer();