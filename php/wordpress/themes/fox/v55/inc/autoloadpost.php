<?php
/**
 * abstract: all functions/hooks and problems about autoload next post
 */

/**
 * Check if auto load post module enabled
 * return true/false
 * @since 4.0
 * ------------------------------------------------------------------------------------------------
 */
function fox_autoload() {
    
    if ( ! is_single() ) return false;
    
    // a mechanism to disable autoload feature on some particle post
    $get = get_post_meta( get_the_ID(), '_wi_autoload', true );
    if ( 'false' == $get ) return false;
    if ( 'true' == $get ) return true;
    
    $get = get_theme_mod( 'wi_autoload_post', 'false' );
        
    return (bool) ( 'true' === $get );
    
}

/**
 * add nav for autoload
 * ------------------------------------------------------------------------------------------------
 */
add_action( 'fox_single_bottom', 'fox_autoload_single_nav' );
function fox_autoload_single_nav() { 
    if ( ! fox_autoload() ) return;
?>
<div class="autoload-nav">
    
    <div class="container">
        
        <?php the_post_navigation([
            'in_same_term' => ( 'true' == get_theme_mod( 'wi_autoload_post_nav_same_term', 'false' ) ),
        ]); ?>
        
    </div><!-- .container -->
    
</div><!-- .autoload-nav -->
<?php
}

/**
 * Add the endpoint for the call to get the post html only
 * ------------------------------------------------------------------------------------------------
 */
function fox_alnp_add_endpoint() {
    add_rewrite_endpoint( 'partial', EP_PERMALINK );
}

add_action( 'init', 'fox_alnp_add_endpoint' );

/**
 * When /partial endpoint is used on a post, get just the post html
 * ------------------------------------------------------------------------------------------------
 */
function fox_alnp_template_redirect() {
    global $wp_query;
 
    // if this is not a request for partial or a singular object then bail
    if ( ! isset( $wp_query->query_vars['partial'] ) || ! is_singular() )
        return;
 
	// include custom template
    include get_parent_theme_file_path( '/v55/content-partial.php' );

    exit;
}

add_action( 'template_redirect', 'fox_alnp_template_redirect' );