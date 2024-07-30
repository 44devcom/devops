<?php get_header(); ?>

<?php
$block_id = function_exists( 'fox_framework_archive_block_id' ) ? fox_framework_archive_block_id() : false;

if ( $block_id && function_exists( 'fox_block' ) ) { ?>

<div class="archive-builder">
    
    <div class="container2">
        
        <?php fox_block( $block_id ); ?>
        
    </div>
    
</div><!-- .archive-builder -->

<?php } else { ?>

<?php get_template_part( 'parts/404', 'classic' ); ?>

<?php } ?>

<?php get_footer(); ?>