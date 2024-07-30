<?php if ( ! fox56() ) { include_once(dirname( __FILE__ ).'/v55/header.php'); return; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
    
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
    
    <?php wp_body_open(); // since 4.9 ?>
    
    <div id="wi-all" class="fox-outer-wrapper fox-all wi-all">

        <?php
        if ( apply_filters( 'fox_show_header', true ) ) {
            $is_minimal = fox56_is_minimal_header();
            if ( $is_minimal ) {
                fox56_minimal_header();
            } else {
                $block_id = function_exists( 'fox_framework_header_block_id' ) ? fox_framework_header_block_id() : false;
                if ( $block_id && function_exists( 'fox_block' ) ) { ?>
                    <header id="masthead" class="site-header header-elementor">
                        <div class="the-regular-header">
                            <?php
                                fox_block( $block_id );
                            ?>
                        </div>
                    </header>
                    <div id="masthead-height"></div>
                <?php } else {
                    fox56_header(); // this is for both desktop & mobile
                }
            }
        }
        ?>
        
        <div id="wi-main" class="wi-main fox-main">