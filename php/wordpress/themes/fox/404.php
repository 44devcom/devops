<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/404.php'); return; } ?>
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

    <?php fox56_titlebar(); ?>
    <div class="page404__content">
        <div class="container">

            <?php
            $msg = trim( get_theme_mod( 'page_404_message', '' ) );
            if ( '' !== $msg )  { ?>
            <div class="page404__message">
                <?php echo $msg; ?>
            </div>
            <?php } ?>

            <?php if ( get_theme_mod( 'page_404_searchform', true ) ) { ?>
            <?php get_search_form(); ?>
            <?php } ?>
            
        </div>
    </div>

<?php } ?>

<?php get_footer(); ?>