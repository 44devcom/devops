<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/index.php'); return; } ?>
<?php get_header(); ?>

<?php
$block_id = function_exists( 'fox_framework_archive_block_id' ) ? fox_framework_archive_block_id() : false;

if ( $block_id && function_exists( 'fox_block' ) ) { ?>

<div class="archive-builder">
    
    <div class="container2">
        
        <?php fox_block( $block_id ); ?>
        
    </div>
    
</div><!-- .archive-builder -->

<?php } else {
    fox56_archive();
} ?>

<?php get_footer(); ?>