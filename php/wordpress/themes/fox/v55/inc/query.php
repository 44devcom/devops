<?php
/**
 * abstract: everything about the query
 */

/* 
 * Main Query Function
 * @since 4.0
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_query' ) ) :
function fox_query( $args ) {
    
    global $rendered_articles;
    if ( ! isset( $rendered_articles ) || ! is_array( $rendered_articles ) ) {
        $rendered_articles = [];
    }
    
    extract( wp_parse_args( $args, array(
        
        'number' => null,
        
        'offset' => '',
        
        'orderby' => 'date',
        'order' => 'desc',
        
        'categories' => null,
        'exclude_categories' => null,
        
        'tags' => null,
        'exclude_tags' => null,
        
        'format' => 'all',
        
        'author' => '',
        'authors' => null, // since 4.5

        'include' => null,
        'exclude' => null,
        
        'featured' => null,
        
        'custom_query' => null,
        
        'unique_posts' => false,
        
        'pagination' => false,
        
        // since 4.5
        'post_type' => '',
        'tax_query' => null,
        'sticky' => false,
        
        'paged_disable' => false,
        
    ) ) );
    
    if ( $custom_query && is_string( $custom_query ) && trim( $custom_query ) ) {
        
        $query = new WP_Query( esc_sql( $custom_query ) );
        
    } else {
        
        $query_args = array(
            
            'ignore_sticky_posts' => true,
            'post_status' => 'publish',
            
        );
        
        $query = new WP_Query( $args ); 
        
        // ----------- posts per page
        $query_args[ 'posts_per_page' ] = $number;
        
        // ----------- offset
        $query_args[ 'offset' ] = $offset;
        
        // ----------- orderby
        $orderby = strtolower( strval( $orderby ) );
        if ( ! in_array( $orderby, array( 'date', 'modified', 'title', 'comment_count', 'rand', 'view', 'view_week', 'view_month', 'view_year', 'review_score', 'review_date', 'menu_order' ) ) ) {
            $orderby = 'date';
        }
        if ( is_string( $order ) ){
            $order = strtolower( $order );
        }
        if ( 'asc' !== $order ) $order = 'desc';
        
        if ( 'view' === $orderby ) {
            
            $query_args[ 'orderby' ] = 'post_views';
            $query_args[ 'order' ] = $order;
            
        } elseif ( 'view_week' == $orderby ) {
            
            $query_args[ 'orderby' ] = 'post_views';
            $query_args[ 'views_query' ] = [
                'year' => date('Y'),
                'week' => date('W'),
            ];
            $query_args[ 'order' ] = $order;
            
        } elseif ( 'view_month' == $orderby ) {
            
            $query_args[ 'orderby' ] = 'post_views';
            $query_args[ 'views_query' ] = [
                'year' => date('Y'),
                'month' => date('n'),
            ];
            $query_args[ 'order' ] = $order;
            
        } elseif ( 'view_year' == $orderby ) {
            
            $query_args[ 'orderby' ] = 'post_views';
            $query_args[ 'views_query' ] = [
                'year' => date('Y'),
            ];
            $query_args[ 'order' ] = $order;
            
        } elseif ( 'review_score' == $orderby || 'review_date' == $orderby ) {
            
            $query_args[ 'orderby' ] = 'meta_value_num';
            $query_args[ 'meta_key' ] = '_wi_review_average';
            $query_args[ 'meta_value_num' ] = 0;
            $query_args[ 'meta_compare' ] = '>';
            
            if ( 'review_date' == $orderby ) {
                $query_args[ 'orderby' ] = 'date';
            }
            
            $query_args[ 'order' ] = $order;
            
        } else {
            
            $query_args[ 'orderby' ] = $orderby;
            $query_args[ 'order' ] = $order;
            
        }
        
        // ----------- sticky
        // since 4.5
        if ( true === $sticky || 'true' === $sticky ) {
            
            $sticky_posts = get_option( 'sticky_posts' );
            if ( ! empty( $sticky_posts ) ) {
                $query_args[ 'post__in' ] = $sticky_posts;
                $query_args[ 'post_type' ] = 'any';
            }
            
        }
        
        // ----------- featured
        if ( 'yes' === $featured || 'true' === $featured || true === $featured ) {
            
            $query_args[ 'featured' ] = true;
            
        }
        
        // ----------- author
        if ( $author && 'all' !== $author ) {
            
            $author = str_replace( 'author_', '', $author );
            $author = strval( $author );
            if ( ! is_numeric( $author ) ) {
                $query_args[ 'author_name' ] = $author;
            } else {
                
                // @todo, check guest or not
                $query_args[ 'author_name' ] = get_the_author_meta('user_nicename', $author ); //FILTER POSTS BY CO-AUTH
                
            }
            
        }
        
        // ----------- authors
        // since 4.5
        if ( $authors ) {
            
            if ( is_string( $authors ) ) {
                $authors = explode( ',', $authors ); // just in case
                $authors = array_map( 'trim', $authors );
            }
            
            $collect_author_ids = [];
            foreach( $authors as $user_nicename ) {
                $user = get_user_by( 'slug', $user_nicename );
                if ( ! $user ) continue; 
                $collect_author_ids[] = $user->ID;
            }
            if ( ! empty( $collect_author_ids ) ) {
                $query_args[ 'author__in' ] = $collect_author_ids;
            }
            
        }
        
        // ----------- categories
        if ( $categories ) {
            $cat_ids = array();
            if ( is_string( $categories ) ) {
                $categories = explode( ',', $categories ); // just in case
                $categories = array_map( 'trim', $categories );
            }
            foreach ( $categories as $id ) {
                
                $term_id = 0;
                
                if ( is_numeric( $id ) ) {
                    $term_id = $id;
                }
                
                if ( ! $term_id && strpos( $id, 'cat_' ) !== 0 ) {
                    continue;
                }
                
                $id = substr( $id, 4 );
                
                // ie. slug
                if ( ! $term_id && ! is_numeric( $id ) ) {
                    
                    $term_qr_args = [
                        'slug' => $id,
                        'number' => 1,
                        'taxonomy' => 'category',
                    ];
                    
                    if ( function_exists( 'pll_default_language' ) ) {
                        $term_qr_args[ 'lang' ] = pll_default_language();
                    }
                    
                    $qr_terms = get_terms( $term_qr_args );
                    if ( $qr_terms ) {
                        $term_id = $qr_terms[0]->term_id;
                        if ( function_exists( 'pll_get_term' ) ) {
                            $term_id = pll_get_term( $term_id );
                        }
                    }
                    
                } elseif ( ! $term_id ) {
                    $term_id = $id;
                }
                
                if ( $term_id ) {
                    $cat_ids[] = $term_id;
                }
                
            }
            if ( 1 == count( $cat_ids ) ) {
                $query_args[ 'cat' ] = $cat_ids[0];
            } elseif ( ! empty( $cat_ids ) ) {
                $query_args[ 'category__in' ] = $cat_ids;
                
            // if those categories don't exist, return
            } else {
                return;
            }
        }
        
        // ----------- exclude categories
        if ( $exclude_categories ) {
            $cat_ids = array();
            if ( is_string( $exclude_categories ) ) {
                $exclude_categories = explode( ',', $exclude_categories ); // just in case
                $exclude_categories = array_map( 'trim', $exclude_categories );
            }
            foreach ( $exclude_categories as $id ) {
                
                $term_id = 0;
                
                if ( is_numeric( $id ) ) {
                    $term_id = $id;
                }
                
                if ( ! $term_id && strpos( $id, 'cat_' ) !== 0 ) {
                    continue;
                }
                
                $id = substr( $id, 4 );
                // ie. slug
                if ( ! $term_id && ! is_numeric( $id ) ) {
                    
                    $term_qr_args = [
                        'slug' => $id,
                        'number' => 1,
                        'taxonomy' => 'category',
                    ];
                    
                    if ( function_exists( 'pll_default_language' ) ) {
                        $term_qr_args[ 'lang' ] = pll_default_language();
                    }
                    
                    $qr_terms = get_terms( $term_qr_args );
                    if ( $qr_terms ) {
                        $term_id = $qr_terms[0]->term_id;
                        if ( function_exists( 'pll_get_term' ) ) {
                            $term_id = pll_get_term( $term_id );
                        }
                    }
                    
                } elseif ( ! $term_id ) {
                    $term_id = $id;
                }
                
                if ( $term_id ) {
                    $cat_ids[] = $term_id;
                }
                
            }
            
            if ( ! empty( $cat_ids ) ) $query_args[ 'category__not_in' ] = $cat_ids;
        }
        
        // ----------- tags
        if ( $tags ) {
            if ( is_string( $tags ) ) {
                $tags = explode( ',', $tags );
                $tags = array_map( 'trim', $tags );
            }
            $cat_ids = array();
            foreach ( $tags as $id ) {
                
                $term_id = 0;
                // case 1: numeric
                if ( is_numeric( $id ) ) {
                    $term_id = $id;
                
                // case 2: it has form tag_number, then number will be the ID
                } elseif ( preg_match( '/^tag_(\d+)$/', $id, $match ) ) {
                    $term_id = $match[1];
                    
                // case 3: what we enter is tag name
                } else {
                    
                    $term_qr_args = [
                        'name' => $id,
                        'number' => 1,
                        'taxonomy' => 'post_tag',
                    ];
                    
                    if ( function_exists( 'pll_default_language' ) ) {
                        $term_qr_args[ 'lang' ] = pll_default_language();
                    }
                    
                    $qr_terms = get_terms( $term_qr_args );
                    if ( $qr_terms ) {
                        $term_id = $qr_terms[0]->term_id;
                        if ( function_exists( 'pll_get_term' ) ) {
                            $term_id = pll_get_term( $term_id );
                        }
                    }
                    
                }
                
                if ( $term_id ) {
                    $cat_ids[] = $term_id;
                }
            }
            if ( 1 == count( $cat_ids ) ) {
                $query_args[ 'tag_id' ] = $cat_ids[0];   
            } elseif ( ! empty( $cat_ids ) ) $query_args[ 'tag__in' ] = $cat_ids;
        }
        
        // ----------- exclude tags
        if ( $exclude_tags ) {
            if ( is_string( $exclude_tags ) ) {
                $exclude_tags = explode( ',', $exclude_tags );
                $exclude_tags = array_map( 'trim', $exclude_tags );
            }
            $cat_ids = array();
            foreach ( $exclude_tags as $id ) {
                
                $term_id = 0;
                // case 1: numeric
                if ( is_numeric( $id ) ) {
                    $term_id = $id;
                
                // case 2: it has form tag_number, then number will be the ID
                } elseif ( preg_match( '/^tag_(\d+)$/', $id, $match ) ) {
                    $term_id = $match[1];
                    
                // case 3: what we enter is tag name
                } else {
                    
                    $term_qr_args = [
                        'name' => $id,
                        'number' => 1,
                        'taxonomy' => 'post_tag',
                    ];
                    
                    if ( function_exists( 'pll_default_language' ) ) {
                        $term_qr_args[ 'lang' ] = pll_default_language();
                    }
                    
                    $qr_terms = get_terms( $term_qr_args );
                    if ( $qr_terms ) {
                        $term_id = $qr_terms[0]->term_id;
                        if ( function_exists( 'pll_get_term' ) ) {
                            $term_id = pll_get_term( $term_id );
                        }
                    }
                    
                }
                
                if ( $term_id ) {
                    $cat_ids[] = $term_id;
                }
                
            }
            if ( ! empty( $cat_ids ) ) $query_args[ 'tag__not_in' ] = $cat_ids;
        }
        
        // ----------- format
        if ( in_array( $format, [ 'video', 'audio', 'gallery', 'link' ] ) ) {
            
            $query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-' . $format ),
                ),
            );
            
        }
        
        // ----------- tax query (since 4.5)
        if ( ! empty( $tax_query ) ) {
            $query_args[ 'tax_query' ] = $tax_query;
        }
        
        // ----------- post type (since 4.5)
        if ( ! empty( $post_type ) ) {
            if ( 'any' == $post_type ) {
                $query_args[ 'post_type' ] = 'any';
            } else {
                if ( ! is_array( $post_type ) ) {
                    $post_type = explode( ',', $post_type );
                    $post_type = array_map( 'trim', $post_type );
                }
                $query_args[ 'post_type' ] = $post_type;
            }
        }
        
        // ----------- pagination
        if ( 'yes' == $pagination || 'true' == $pagination || true === $pagination ) {
            
            if ( is_front_page() ) {
                $query_args[ 'paged' ] = intval( get_query_var( 'page' ) );
            } else {
                $query_args[ 'paged' ] = get_query_var( 'paged' );
            }
            
            // adjust offset accordingly
            $offset = absint( $offset );
            if ( $offset > 0 ) {
                $offset = $offset + ( ( absint( $query_args[ 'paged' ] ) - 1 ) * absint( $query_args[ 'posts_per_page' ] ) );
                $query_args[ 'offset' ] = $offset;
            }
            
        } else {
        
            $query_args[ 'no_found_rows' ] = true;
        
        }
        
        // ----------- posts in
        if ( is_array( $include ) ) $include = join( ',', $include );
        if ( $include ) {
            $ids = explode( ',', $include );
            $ids = array_map( 'trim', $ids );
            $ids = array_map( 'intval', $ids );
            if ( ! empty( $ids ) ) {
                $query_args[ 'post__in' ] = $ids;
                $query_args[ 'orderby' ] = 'post__in';
                $query_args[ 'order' ] = 'ASC';
            }
        }
        
        // ----------- posts not in
        $excluded_ids = array();
        if ( $unique_posts ) {
            $excluded_ids = $rendered_articles;
        }
        
        if ( is_array( $exclude ) ) $exclude = join( ',', $exclude );
        if ( $exclude ) {
            $ids = explode( ',', $exclude );
            $ids = array_map( 'trim', $ids );
            $ids = array_map( 'intval', $ids );
            $excluded_ids = array_merge( $excluded_ids, $ids );
        }
        if ( ! empty( $excluded_ids ) ) {
            
            $query_args[ 'post__not_in' ] = $excluded_ids;
            
        }
        
        $query = new WP_Query( $query_args );
        
    }
    
    return $query;

}

endif;

/**
 * return cat_ID
 * @since 4.6.9
 */
function fox_primary_cat( $postid ) {
    
    $terms = wp_get_post_terms( $postid, 'category', array( 'fields' => 'ids' ) );
    if ( ! $terms ) {
        return;
    }
    
    $primary_cat = get_post_meta( $postid, '_wi_primary_cat', true );
    if ( in_array( $primary_cat, $terms ) ) {
        $cat = $primary_cat;
    } else {
        $chosen_one = false;
        $highest_priority = -1;
        foreach( $terms as $term ) {
            $priority = intval( get_term_meta( $term, '_wi_priority', true ) );
            if ( $priority > $highest_priority ) {
                $chosen_one = $term;
                $highest_priority = $priority;
            }
        }
        $cat = $chosen_one;
        // $cat = $terms[0];
    }
    
    return $cat;
    
}

/* 
 * returns instance of WP_Query or null in case no related posts found
 * $args is list of parameters
 * @since 4.5
 * ------------------------------------------------------------------ */
function fox_related_query( $args = [] ) {
   
    extract( wp_parse_args( $args, array(
        
        'number' => null,
        
        'orderby' => 'date',
        'order' => 'desc',
        
        // tag, category, author or custom post type
        'source' => 'tag',
        
        'exclude_categories' => [],
        
    ) ) );
    
    if ( ! is_array( $exclude_categories ) ) {
        $exclude_categories = explode( ',', $exclude_categories );
    }
    $e_cats = [];
    foreach ( $exclude_categories as $c ) {
        $c = trim( $c );
        if ( is_numeric( $c ) ) {
            $e_cats[] = $c;
        } else {
            if ( substr( $c, 0, 4 ) == 'cat_' ) {
                $c = substr( $c, 4 );
            }
            $get_cat = get_term_by( 'slug', $c, 'category' );
            if ( $get_cat ) {
                $e_cats[] = $get_cat->term_id;
            }
        }
    }
    $exclude_categories = $e_cats;
    
    $query_args = [
        'number' => $number,
        'orderby' => $orderby,
        'order' => $order,
        'exclude' => get_the_ID(),
        'pagination' => false,
        'unique_posts'=> false
    ];
    
    if ( 'author' == $source ) {
        
        $query_args[ 'author' ] = get_the_author_meta( 'ID' );
        
    } elseif ( 'category' == $source ) {
        
        $terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
        if ( ! $terms ) {
            return;
        }
        
        $cat = fox_primary_cat( get_the_ID() );
        
        $primary_cat = get_post_meta( get_the_ID(), '_wi_primary_cat', true );
        if ( in_array( $primary_cat, $terms ) ) {
            $cat = $primary_cat;
        } else {
            $terms = array_diff( $terms, $exclude_categories );
            if ( $terms ) {
                
                $chosen_one = false;
                $highest_priority = -1;
                foreach( $terms as $term ) {
                    $priority = intval( get_term_meta( $term, '_wi_priority', true ) );
                    if ( $priority > $highest_priority ) {
                        $chosen_one = $term;
                        $highest_priority = $priority;
                    }
                }
                $cat = $chosen_one;
                
            } else {
                $cat = $exclude_categories[0];
                $exclude_categories = [];
            }
        }
        $query_args[ 'categories' ] = [ $cat ];
        
    } elseif ( 'tag' == $source ) {
        
        $terms = wp_get_post_terms( get_the_ID(), 'post_tag', array( 'fields' => 'ids' ) );
        if ( empty( $terms ) ) return;
        
        $query_args[ 'tags' ] = $terms;
    
    } elseif ( 'date' == $source ) {
        
        $query_args[ 'orderby' ] = 'date';
        $query_args[ 'order' ] = 'desc';
        
    } elseif ( 'featured' == $source ) {
        
        $query_args[ 'featured' ] = true;
        
    }
    
    if ( $exclude_categories ) {
        
        $query_args[ 'exclude_categories' ] = $exclude_categories;
            
    }
    
    // since 4.6.7.2
    $query_args = apply_filters( 'fox_related_query_args', $query_args, $args );
    
    return fox_query( $query_args );
    
}