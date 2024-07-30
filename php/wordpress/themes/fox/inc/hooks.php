<?php
/* POST LINK FORMAT
================================================================================================== */
add_filter( 'post_link', 'fox56_post_format_link', 10, 2 );
function fox56_post_format_link( $url, $post ) {
    
    if ( ! is_admin() ) {
        
        $link = '';

        if ( 'link' === get_post_format( $post->ID ) ) {

            $link = trim( get_post_meta( $post->ID, '_format_link_url', true ) );

        }

        if ( $link ) $url = $link;
        
    }
    
    return $url;

}

/* Remove #more-link scroll
Just another stupid thing
================================================================================================== */
add_filter( 'the_content_more_link', 'fox56_remove_more_link_scroll' );
function fox56_remove_more_link_scroll( $link ) {
    
    if ( ! empty( $link ) ) {
        $link = preg_replace( '|#more-[0-9]+|', '', $link );
    }
    return $link;
    
}

/* remove ...
================================================================================================== */
add_filter( 'excerpt_more','fox56_remove_bracket_in_excerpt' );
function fox56_remove_bracket_in_excerpt( $excerpt ) {
    
    // since 4.0, we return empty string
    // because excerpt will be sliced by other function
    return '';
    //return '&hellip;'; // former
}

/* trim white space
================================================================================================== */
add_filter( 'get_the_excerpt', 'fox56_trim_excerpt_whitespace', 1 );
function fox56_trim_excerpt_whitespace( $excerpt ) {
    return trim( $excerpt );
}

/* return maximum excerpt length for use
================================================================================================== */
add_filter( 'excerpt_length', 'fox56_excerpt_length_100' ); 
function fox56_excerpt_length_100($length) {
    return 100;
}

/* show/hide footer
================================================================================================== */
add_filter( 'fox_show_footer', 'fox56_single_show_hide_footer' );
function fox56_single_show_hide_footer( $show ) {
    
    if ( is_singular() ) {
        
        $single_show = get_post_meta( get_the_ID(), '_wi_show_footer', true );
        if ( 'true' == $single_show ) {
            $show = true;
        } elseif ( 'false' == $single_show ) {
            $show = false;
        }
        
    }
    return $show;
    
}

/* show/hide header
================================================================================================== */
add_filter( 'fox_show_header', 'fox56_single_show_hide_header' );
function fox56_single_show_hide_header( $show ) {
    
    $postid = fox56_page_id();
    if ( ! $postid ) return $show;
        
    $single_show = get_post_meta( $postid, '_wi_show_header', true );
    if ( 'true' == $single_show ) {
        $show = true;
    } elseif ( 'false' == $single_show ) {
        $show = false;
    }
    
    return $show;
    
}

/*
 * add post count in span for categories, archive
 * @since 4.6
================================================================================================== */
function fox56_cat_count_span( $links, $args ) {
    
    // only for category, to prevent woocommerce troubles
    if ( ! isset( $args[ 'taxonomy' ] ) || $args[ 'taxonomy' ] == 'category' ) {
    
        $links = str_replace( '</a> (', '</a><span class="fox-post-count">', $links );
        $links = str_replace( ')', '</span>', $links );
        
    }
        
	return $links;
}
add_filter( 'wp_list_categories', 'fox56_cat_count_span', 10, 2 );

/**
 * Filter the archives widget to add a span around post count
 */
function fox56_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="fox-post-count">', $links );
    if ( false !== strpos( $links, '/a>' ) ) {
	   $links = str_replace( ')', '</span>', $links );
    }
	return $links;
}
add_filter( 'get_archives_link', 'fox56_archive_count_span' );

/*
 * Post View Plugin Concerning
 * since 4.0
================================================================================================== */
add_filter( 'pvc_most_viewed_posts_html', 'fox56_custom_most_viewed_posts_html', 10, 2 );
function fox56_custom_most_viewed_posts_html( $html, $args ) {
    
    if ( ! current_user_can( 'manage_options' )) {
        return '';
    }

    return '<p class="fox-error">This widget has been deprecated since Fox v4.5. Please use <strong>(FOX) Post List</strong> widget instead.</p>';

}

/*
 * Disable classic widgets
 * since 5.6
================================================================================================== */
function fox56_remove_widgets_block_editor() {
    if ( get_theme_mod( 'classic_widgets', true ) ) {
        remove_theme_support( 'widgets-block-editor' );
    }
}
add_action( 'after_setup_theme', 'fox56_remove_widgets_block_editor' );

/* head code
================================================================================================== */
add_action( 'wp_head' , 'fox56_add_head_code' );
function fox56_add_head_code() {
	echo trim( get_theme_mod( 'header_code' ) );
}

/* exclude pages from search
================================================================================================== */
function fox56_page_in_search_result( $args, $post_type ) {
    if ( 'page' === $post_type ) {
        if ( get_theme_mod( 'exclude_pages_from_search' ) ) {
            $args[ 'exclude_from_search' ] = true;
        }
    } 
    return $args;
}
add_filter( 'register_post_type_args', 'fox56_page_in_search_result', 10, 2 );

/* fix: unique post for Fox Framework previous version
================================================================================================== */
add_action( 'fox_after_render_post', 'fox56_add_rendered_article' );
function fox56_add_rendered_article() {
    
    global $post, $rendered_articles;
    if ( is_array($rendered_articles) ) {
        $rendered_articles[] = $post->ID;
    }
    
}

/*
 * Disable post meta, since v4.6.2
================================================================================================== */
if ( get_theme_mod( 'disable_metaboxes' ) ) {
    function fox56_disable_fox_metaboxes( $m ) {
        return [];
    }
    add_filter ( 'fox_metaboxes', 'fox56_disable_fox_metaboxes', 10000000 );
}