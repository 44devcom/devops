<?php
$cl = array( 'site-footer', 'footer-elementor' );
$cl = join( ' ', $cl );
?>

<footer class="<?php echo esc_attr( $cl ); ?>">

    <?php
        $footer_block_id = get_theme_mod( 'wi_footer_block_id' );
        fox_block( $footer_block_id );
    ?>
    
</footer>