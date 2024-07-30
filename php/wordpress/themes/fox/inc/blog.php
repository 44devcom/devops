<?php
/**
 * args from params string
 */
function fox56_args_from_string( $code ) {
    $std = fox56_blog_args_std();
    $explode = explode( ';', $code );
    $custom_params = [];
    foreach ( $explode as $line ) {
        $line_split = explode( '=', $line );
        if ( isset( $line_split[0]) && isset( $line_split[1]) ) {
            $k = trim( $line_split[0] );
            $v = trim( $line_split[1] );
            if ( ! isset( $std[$k] ) ) {
                continue;
            }
            $std_value = $std[$k];
            /* array case */
            if ( ! is_array( $std_value ) ) {
                $custom_params[ $k ] = $v;
                continue;
            }
            $v = explode( ',', $v );
            $v = array_map( 'trim', $v );
            if ( array_is_list( $std_value) ) {
                $custom_params[$k] = $v;
                continue;
            }
            $v_associative = [];
            $index = -1;
            foreach ( $std_value as $j ) {
                $index += 1;
                if ( ! isset( $v[$index] )) {
                    break;
                }
                $v_associative[ $j ] = $v[$index];
            }
            $custom_params[$k] = $v_associative;
        }
    }
    return $custom_params;
}

/**
 * return std args to parse
 */
if (!function_exists('array_is_list')) {
    function array_is_list(array $arr)
    {
        if ($arr === []) {
            return true;
        }
        return array_keys($arr) === range(0, count($arr) - 1);
    }
}
function fox56_blog_args_std() {
    $std = [
        'layout' => 'grid',
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
        'big_first_post' => false,
        'masonry_item_creative' => false,

        // carousel
        'carousel_hint' => false,
        'carousel_nav' => 'middle-inside',
        'carousel_nav_shape' => 'circle',
        'carousel_nav_style' => 'outline',
        'carousel_pager' => false,
        'carousel_pager_style' => 'circle',
        'carousel_autoplay' => false,
        'text_inner_width' => [ 'desktop' => '', 'tablet' => '', 'mobile' => '' ],
        'text_inner_background' => '',

        // post style
        'post_style' => 'normal',
        'ontop_height_style' => 'ratio',
        'ontop_valign' => 'middle',
        'align' => 'left',
        'valign' => 'top',

        // group
        'group_layout' => '2-1',
    ];
    $cols = [
        'big' => [
            'title' => 'Big col',
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'thumbnail-large',
            'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'primary',
        ],
        'medium' => [
            'title' => 'Small col',
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
        'small' => [
            'title' => 'Small col 2',
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'title', 'excerpt' ],
            'excerpt_length' => 12,
            'thumbnail' => 'thumbnail-medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
    ];
    foreach ( $cols as $col => $col_std ) {
        foreach ( $col_std as $k => $v ) {
            $std[ "{$col}_{$k}" ] = $v;
        }
    }
    $std = array_merge( $std, [
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt' ],
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
        'thumbnail_rich' => false,
        'thumbnail_components' => [],
        'thumbnail_position' => 'left',
        'thumbnail_width_type' => 'percent',
        'thumbnail_hover_effect' => 'none',
        'thumbnail_hover_logo' => 0,
        'title_tag' => 'h2',
        'excerpt_length' => 24,
        'date_format' => '',
        'author_avatar' => false,
        'category_tax' => '',
        'more_style' => 'primary',
    ]);
    return $std;
}
/**
 * return args with default values
 */
function fox56_blog_fill_args( $args ) {
    $std = fox56_blog_args_std();
    foreach ( $std as $k => $v ) {
        if ( ! isset( $args[$k])) {
            $args[$k] = $v;
        // if set but is array    
        } else {
            if ( is_array( $v ) && ! array_is_list( $v ) ) {
                $args[$k] = wp_parse_args( $args[$k], $v );
            }
        }
    }
    return $args;
}

/**
 * abstract: blog templates since v5.6
 */

/* elementary post
 * all other layouts will be built based on this post
 * so that we can update it at once for grid, masonry, carousel, list..
 
 * this function has no responsibility to adjust args, it just displays args as it's being provided
 * so before call fox56_post, we must prepare args carefully
============================================================================== */
function fox56_post( $args = [] ) {

    extract( wp_parse_args( $args, [

        // normal/ontop
        'post_style' => 'normal',
        
        // ontop ontions
        'ontop_height_style' => 'ratio',
        'ontop_valign' => 'middle',

        // grid / list / masonry / carousel
        'layout' => 'grid',

        // extra class
        'post_class' => '',

        // alignment
        'align' => 'left',
        
        // components: thumbnail, title, date, author, excerpt..
        'components' => [],

        'text_wrapper' => false,

    ]) );

    $cl = [ 'post56' ];

    // post class
    if ( ! empty( $post_class ) ) {
        if ( is_array( $post_class ) ) {
            $cl = array_merge( $cl, $post_class );
        } else {
            $cl[] = $post_class;
        }
    }

    // layout
    $cl[] = 'post56--' . $layout;

    /**
     * post style
     * if post style is ontop, we'll have to force certain settings
     */
    if ( 'ontop' != $post_style ) {
        $post_style = 'normal';
    }
    $cl[] = 'post56--' . $post_style;
    if ( 'ontop' == $post_style ) {
        
        // $args[ 'thumbnail_hover_effect' ] = 'none';
        $args[ 'thumbnail_review' ] = false; // review off
        $args[ 'thumbnail_view' ] = false; // view off
        $args[ 'thumbnail_caption' ] = false; // caption off
        $args[ 'thumbnail_border_radius' ] = '0'; // off thumbnail border radius

        // thumbnail can't be custom value
        if ( isset( $args[ 'thumbnail' ] ) && 'custom' == $args[ 'thumbnail' ] ) {
            $args[ 'thumbnail' ] = 'large';
        }

        /* thumbnail must be in the 1st place and forced to be enabled */
        $components = array_diff( $components, [ 'thumbnail' ] );
        $components = array_merge( [ 'thumbnail'], $components );
    }

    /**
     * height_style
     */
    if ( 'fixed' != $ontop_height_style ) {
        $ontop_height_style = 'ratio';
    }

    /**
     * align
     */
    if ( ! in_array( $align, [ 'left', 'center', 'right' ] ) ) {
        $align = 'left';
    }
    $cl[] = 'align-' . $align;

    /**
     * ontop valign
     */
    if ( 'ontop' == $post_style ) {
        if ( ! in_array( $ontop_valign, [ 'top', 'middle', 'bottom' ] ) ) {
            $ontop_valign = 'middle';
        }
        $cl[] = 'text--' . $ontop_valign;
    }
    ?>
<article <?php post_class( $cl ); ?> itemscope itemtype="https://schema.org/CreativeWork">
                    
    <?php
    // this is risky so please make sure that components are justified correctly by extensions
    if ( isset( $components[0] ) && 'thumbnail' == $components[0] ) {
        fox56_thumbnail( $args );
    } ?>
    <div class="post56__text">

        <?php if ( $text_wrapper ) echo '<div class="post56__text__inner">'; ?>
        
        <?php
        $meta_collect = [];
        $components[] = 'pseudo-element'; // added to make sure last meta_collect will be displayed
        if ( isset( $components[0] ) && 'thumbnail' == $components[0] ) {
            $flow = array_slice( $components, 1 );
        } else {
            $flow = $components;
        }

        foreach ( $flow as $component ) {
            if ( in_array( $component, [ 'date', 'live', 'category', 'standalone_category', 'author', 'view', 'reading_time', 'comment' ] ) ) {
                $meta_collect[] = $component;
                continue;
            } else {
                if ( ! empty( $meta_collect ) ) {
                    $args2 = $args;
                    $args2[ 'meta_items' ] = $meta_collect;
                    fox56_meta( $args2 );
                    $meta_collect = []; // reset it
                }
                if ( 'title' == $component ) {
                    fox56_title( $args );
                } elseif ( 'excerpt' == $component ) {
                    fox56_excerpt( $args );
                } elseif ( 'more' == $component ) {
                    fox56_readmore( $args );
                } elseif ( 'share' == $component ) {
                    fox56_share( $args );
                } elseif ( 'thumbnail' == $component ) {
                    fox56_thumbnail( $args );
                }
            }
        }
        ?>

        <?php if ( $text_wrapper ) echo '</div>'; ?>

    </div><!-- .post56__text -->

    <div class="post56__sep__line"></div>

    <?php if ( 'ontop' == $post_style ) { ?>
    <div class="post56__overlay"></div>
    
    <?php if ( 'fixed' == $ontop_height_style ) { ?>
    <div class="post56__height"></div>
    <?php } ?>

    <?php if ( 'ratio' == $ontop_height_style ) { ?>
    <div class="post56__padding"></div>
    <?php } ?>

    <?php } // if ontop ?>

</article><!-- .post56 -->
    <?php

    global $builder_posts;
    if ( is_array( $builder_posts ) ) {
        $builder_posts[] = get_the_ID();
    }

}

/* GRID
============================================================================== */
function fox56_blog_grid( $query, $args = [] ) {
    $args = fox56_blog_fill_args( $args );
    $container_cl = [ 'blog56', 'blog56--grid', 'widget56' ];
    extract( wp_parse_args( $args, [
        'container_class' => '',

        // COLUMN
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],

        'post_style' => 'normal',
    ]) );
    if ( $container_class ) {
        $container_cl[] = $container_class;
    }

    /**
     * COLUMN
     */
    if ( ! is_array( $column ) ) {
        $column = [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ];
    }
    $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ] );
    $container_cl[] = 'blog56--grid--' . $column[ 'desktop' ] . 'cols';
    $container_cl[] = 'blog56--grid--tablet--' . $column[ 'tablet' ] . 'cols';
    $container_cl[] = 'blog56--grid--mobile--' . $column[ 'mobile' ] . 'cols';

    /**
     * POST CLASS
     */
    $args[ 'post_class' ] = [ 'griditem56' ];
    ?>
    <div class="<?php echo esc_attr( join( ' ', $container_cl ) ); ?>">
        <?php 
        while ( $query->have_posts() ) {
            $query->the_post();
            fox56_post( $args );
        } ?>

        <?php if ( 'ontop' != $post_style ) { ?>
        <div class="blog56__sep">
            <div class="blog56__sep__line line--1"></div>
            <div class="blog56__sep__line line--2"></div>
            <div class="blog56__sep__line line--3"></div>
            <div class="blog56__sep__line line--4"></div>
            <div class="blog56__sep__line line--5"></div>
        </div>
        <?php } ?>

    </div>
    <?php if ( isset( $args['pagination'] ) && $args['pagination'] ) { ?>
        <?php echo fox56_pagination( $query, $args ); ?>
    <?php } ?>
    <?php
}

/* LIST
============================================================================== */
function fox56_blog_list( $query, $args = [] ) {
    $args = fox56_blog_fill_args( $args );
    $container_cl = [ 'blog56', 'blog56--list' ];
    extract( wp_parse_args( $args, [
        'container_class' => '',

        // COLUMN
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],

        // CUSTOM SIZE
        'title_custom_size' => false,
        'thumbnail_position' => 'left',
    ]) );
    if ( $container_class ) {
        $container_cl[] = $container_class;
    }

    /**
     * custom size
     */
    if ( $title_custom_size ) {
        $container_cl[] = 'custom--title-size';
    }

    /**
     * COLUMN
     */
    if ( ! is_array( $column ) ) {
        $column = [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ];
    }
    $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ] );
    $container_cl[] = 'blog56--grid--' . $column[ 'desktop' ] . 'cols';
    $container_cl[] = 'blog56--grid--tablet--' . $column[ 'tablet' ] . 'cols';
    $container_cl[] = 'blog56--grid--mobile--' . $column[ 'mobile' ] . 'cols';

    /**
     * MOBILE LAYOUT
     */
    $list_mobile_layout = 'list';
    if ( isset( $args[ 'list_mobile_layout'] ) && 'grid' == $args[ 'list_mobile_layout'] ) {
        $list_mobile_layout = 'grid';
    }
    $container_cl[] = 'list56--mobile-' . $list_mobile_layout;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $container_cl ) ); ?>">
        <?php
        $count = 0;
        while ( $query->have_posts() ) {
            $query->the_post();

            $count++;
            if ( 'alternative' == $thumbnail_position ) {
                $args[ 'thumbnail_position' ] = $count % 2 ? 'left' : 'right';
            }

            fox56_post_list( $args );
        } ?>

        <div class="blog56__sep">
            <div class="blog56__sep__line line--1"></div>
            <div class="blog56__sep__line line--2"></div>
            <div class="blog56__sep__line line--3"></div>
            <div class="blog56__sep__line line--4"></div>
            <div class="blog56__sep__line line--5"></div>
        </div>

    </div>
    <?php if ( isset( $args['pagination'] ) && $args['pagination'] ) { ?>
        <?php echo fox56_pagination( $query, $args ); ?>
    <?php } ?>
    <?php
}

/**
 * this is the loop of list
 */
function fox56_post_list( $args = [] ) {

    /**
     * we only work with params that post list requires
     */
    extract( wp_parse_args( $args, [
        'valign' => 'top',
        'thumbnail_width_type' => 'percent',
        'thumbnail_position' => 'left',
        'components' => [],
    ]) );
    
    /**
     * valign
     */
    if ( ! in_array( $valign, [ 'top', 'middle', 'bottom' ] ) ) {
        $valign = 'top';
    }
    $cl[] = 'valign-' . $valign;

    // force post_style to be normal for list layout
    $args[ 'post_style' ] = 'normal';

    /**
     * thumbnail width type
     */
    if ( 'pixel' != $thumbnail_width_type ) {
        $thumbnail_width_type = 'percent';
    }
    $cl[] = 'post56--list--thumb-' . $thumbnail_width_type;

    /**
     * thumbnail_position
     */
    if ( 'right' != $thumbnail_position ) {
        $thumbnail_position = 'left';
    }
    $cl[] = 'post56--list--thumb-' . $thumbnail_position;
    if ( ! isset( $args[ 'post_class' ] ) ) {
        $args[ 'post_class' ] = [];
    }
    if ( is_string( $args[ 'post_class' ] ) ) {
        $args[ 'post_class' ] = [ $args[ 'post_class' ] ];
    }
    if ( ! is_array( $args[ 'post_class' ] ) ) {
        $args[ 'post_class' ] = [];
    }
    $args[ 'post_class' ] = array_merge( $args[ 'post_class' ], $cl );

    /**
     * force thumbnail to be 1st position
     * we don't consider thumbnail as flow
     */
    if ( in_array( 'thumbnail', $components ) )  {
        $components = array_diff( $components, [ 'thumbnail' ] );
        array_unshift( $components, 'thumbnail' );
    }
    $args[ 'components' ] = $components;

    $args['post_class'][] = 'griditem56';

    // now call the main
    fox56_post( $args );
}

/* GROUP
============================================================================== */
/**
 * BIG COL: the column with biggest size
 * MEDIUM COL: after removing big col, the most-left col is the medium
 * SMALL COL: the remanning one
 * 
 * posts are distributed in order big > medium > small
 * this means: we can't distribute posts in previous order: medium right and small left
 */
function fox56_blog_group( $query, $args = [] ) {
    $args = fox56_blog_fill_args( $args );
    $container_cl = [ 'blog56', 'blog56--group', 'group56', 'row56' ];
    
    extract( wp_parse_args( $args, [
        'container_class' => '',

        // GROUP LAYOUT
        'group_layout' => '2-1',
        
        // NUMBERS
        'big_number' => 1,
        'medium_number' => 1,

        // COMPONENTS
        'components' => [],
        'post_stype' => 'normal',
    ]) );
    if ( $container_class ) {
        $container_cl[] = $container_class;
    }

    $big_order = 1; // by default
    $small = null;
    switch( $group_layout ) {

        // 2 COLS
        case '1-1':
            $big = '1-1';
            $medium = '2';
        break;

        case '1-2':
            $big = '2';
            $big_order = 3;
            $medium = '1-1';
        break;
        
        case '2-1':
            $big = '1-2';
            $medium = '3';
        break;

        case '1-3':
            $big = '2';
            $big_order = 3;
            $medium = '1-1';
        break;

        case '3-1':
            $big = '1-3';
            $medium = '4';
        break;

        case '2-3':
            $big = '3';
            $big_order = 3;
            $medium = '1-2';
        break;

        case '3-2':
            $big = '1-3';
            $medium = '4';
        break;

        // 3 COLS
        case '3-1-1':
            $big = '1-3';
            $medium = '4-1';
            $small = '5';
        break;

        case '1-3-1':
            $big = '2-3';
            $big_order = 3;
            $medium = '1-1';
            $small = '5';
        break;

        case '1-1-3':
            $big = '3-3';
            $big_order = 5;
            $medium = '1-1';
            $small = '2-1';
        break;

        case '2-1-1':
            $big = '1-2';
            $medium = '3-1';
            $small = '4';
        break;

        case '1-2-1':
            $big = '2-2';
            $big_order = 3;
            $medium = '1-1';
            $small = '4';
        break;

        case '1-1-2':
            $big = '3-2';
            $big_order = 5;
            $medium = '1-1';
            $small = '2-1';
        break;

    }

    $big_cl = [ 'row56__col', 'row56__col--big', 'col--' . $big, 'order--' . $big_order ];
    $medium_cl = [ 'row56__col', 'row56__col--medium', 'col--' . $medium, 'order--2' ];
    $last = 'medium';
    if ( $big_order > 2 ) {
        $last = 'big';
    }
    if ( $small ) {
        $small_cl = [ 'row56__col', 'row56__col--small', 'col--' . $small, 'order--4' ];
        if ( $big_order > 4 ) {
            $last = 'big';
        } else {
            $last = 'small';
        }
    }
    if ( 'big' == $last ) {
        $big_cl[] = 'col--last';
    } elseif ( 'medium' == $last ) {
        $medium_cl[] = 'col--last';
    } else {
        $small_cl[] = 'col--last';
    }

    // we layout based on this var
    $group_layout_split = explode( '-', $group_layout );
    $cols = count( $group_layout_split );
    if ( $cols != 2 && $cols != 3 ) {
        return; // and why?
    }
    $group_layout_split = array_map( 'absint', $group_layout_split );
    $sum = array_sum( $group_layout_split );
    $container_cl[] = 'row56--' . $sum . 'cols';
    $container_cl[] = 'row56--real--' . count( $group_layout_split ) . 'cols';

    $big = [];
    $medium = [];
    $small = [];

    $count = 0;
    while ( $query->have_posts() ) {
        $query->the_post();
        $count += 1;
        ob_start();

        if ( $count <= $big_number ) {
            $sort = 'big';
        } elseif ( $count <= $big_number + $medium_number ) {
            $sort = 'medium';
        } else {
            $sort = 'small';
        }

        // in case we have only 2 cols
        if ( 2 == count( $group_layout_split ) && 'small' == $sort ) {
            $sort = 'medium';
        } 

        // code goes here
        $local_args = [
            'layout' => $args[ "{$sort}_layout" ],
            'column' => $args[ "{$sort}_column" ],
            'align' => $args[ "{$sort}_align" ],
            'components' => $args[ "{$sort}_components" ],
            'excerpt_length' => $args[ "{$sort}_excerpt_length" ],
            'thumbnail' => $args[ "{$sort}_thumbnail" ],
            'thumbnail_position' => isset( $args[ "{$sort}_thumbnail_position" ] ) ? $args[ "{$sort}_thumbnail_position" ] : 'right',
            'thumbnail_custom' => $args[ "{$sort}_thumbnail_custom" ],
            'thumbnail_rich' => $args[ "{$sort}_thumbnail_rich" ],
            'more_style' => $args[ "{$sort}_more_style" ],
        ];
        $local_args = wp_parse_args( $local_args, $args );

        /* some special options for small posts */
        if ( 'medium' == $sort || 'small' == $sort ) {
            $local_args[ 'thumbnail_caption' ] = false;
        }

        if ( 'list' == $local_args['layout'] ) {
            fox56_post_list( $local_args );
        } else {
            fox56_post( $local_args );
        }

        if ( 'big' == $sort ) {
            $big[] = ob_get_clean();
        } elseif ( 'medium' == $sort ) {
            $medium[] = ob_get_clean();
        } elseif( 'small' == $sort ) {
            $small[] = ob_get_clean();
        }
        
    } // endwhile

    /**
     * now we have to markup it correctly for post grid / post list container
     */
    if ( 3 == count( $group_layout_split ) ) {
        $cols = [ 'big', 'medium', 'small' ];
    } else {
        $cols = [ 'big', 'medium' ];
    }
    $inner_cls = [
        'big' => [],
        'medium' => [],
        'small' => []
    ];

    foreach ( $cols as $col ) {

        $col_layout = $args[ "{$col}_layout" ];
        $col_column = $args[ "{$col}_column" ];
        if ( ! is_array( $col_column ) ) {
            $col_column = [];
        }
        $col_column = wp_parse_args( $col_column, [
            'desktop' => 1, 'tablet' => 1, 'mobile' => 1
        ]);
        $col_container_cl = [ 'blog56', 'blog56--' . $col_layout ];
        
        /**
         * COLUMN
         */
        if ( 'grid' == $col_layout ) {
            $col_container_cl[] = 'blog56--grid--' . $col_column['desktop'] . 'cols';
            $col_container_cl[] = 'blog56--grid--tablet--' . $col_column['tablet'] . 'cols';
            $col_container_cl[] = 'blog56--grid--mobile--' . $col_column['mobile'] . 'cols';
        }
        $inner_cls[ $col ] = $col_container_cl;
    } ?>

    <div class="<?php echo esc_attr( join( ' ', $container_cl ) ); ?>">
    
        <div class="<?php echo esc_attr( join( ' ', $big_cl )); ?>">

            <div class="<?php echo esc_attr( join( ' ', $inner_cls[ 'big' ] )); ?>">
                <?php echo join( "\n", $big ); ?>
            </div>

            <div class="blog56__sep__line"></div>
        </div>

        <div class="<?php echo esc_attr( join( ' ', $medium_cl )); ?>">
            
            <div class="<?php echo esc_attr( join( ' ', $inner_cls[ 'medium' ] )); ?>">
                <?php echo join( "\n", $medium ); ?>
            </div>

            <div class="blog56__sep__line"></div>
        </div>

        <?php if ( 3 == count( $group_layout_split ) ) { ?>
        <div class="<?php echo esc_attr( join( ' ', $small_cl )); ?>">
            
            <div class="<?php echo esc_attr( join( ' ', $inner_cls[ 'small' ] )); ?>">
                <?php echo join( "\n", $small ); ?>
            </div>

            <div class="blog56__sep__line"></div>
        </div>
        <?php } ?>

    </div>
    <?php if ( isset( $args['pagination'] ) && $args['pagination'] ) { ?>
        <?php echo fox56_pagination( $query, $args ); ?>
    <?php } ?>
    <?php
}

/* CAROUSEL
============================================================================== */
function fox56_blog_carousel( $query, $args = [] ) {
    $args = fox56_blog_fill_args( $args );
    $container_cl = [ 'blog56', 'blog56--carousel', 'carousel56' ];
    extract( wp_parse_args( $args, [
        'container_class' => '',

        // carousel options
        'carousel_hint' => false,
        'carousel_nav' => '',
        'carousel_nav_shape' => 'circle',
        'carousel_nav_style' => 'outline',
        'carousel_pager' => false,
        'carousel_pager_style' => 'circle',
        'carousel_autoplay' => false,

        // COLUMN
        'column' => [],
    ]) );

    if ( $container_class ) {
        $container_cl[] = $container_class;
    }

    $options = [
        'cellAlign' => 'left',
        'groupCells' => '100%',
        'imagesLoaded' => true,
        'wrapAround' => true, // infinte scroll
        'dragThreshold' => 5,
        'pageDots' => false,
        'autoPlay' => $carousel_autoplay,
        'pauseAutoPlayOnHover' => true,
    ];

    /* -------------------- nav */
    if ( 'none' == $carousel_nav ) {
        $options['prevNextButtons'] = false;
    } else {
        $container_cl[] = 'nav--' . $carousel_nav;
    }

    /* -------------------- nav shape */
    $container_cl[] = 'nav--' . $carousel_nav_shape;

    /* -------------------- nav style */
    $container_cl[] = 'nav--' . $carousel_nav_style;

    /* -------------------- pager */
    if ( $carousel_pager ) {
        $options['pageDots'] = true;
        $container_cl[] = 'pager--' . $carousel_pager_style;
    }

    /* -------------------- hint */
    $hint = $carousel_hint ? 'hint--' : '';

    /* -------------------- column */
    if ( ! is_array( $column ) ) {
        $column = [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ];
    }
    $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ] );

    /**
     * COLUMN
     */
    $container_cl[] = 'carousel56--' . $hint . $column[ 'desktop' ] . 'cols';
    $container_cl[] = 'carousel56--tablet--' . $hint . $column[ 'tablet' ] . 'cols';
    $container_cl[] = 'carousel56--mobile--' . $hint . $column[ 'mobile' ] . 'cols';

    // custom to add another wrapper
    $args[ 'text_wrapper' ] = true;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $container_cl ) ); ?>" data-options='<?php echo json_encode( $options ); ?>'>
        <div class="carousel56__container">
            <div class="main-carousel">
                <?php
                $count = 0;
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $count ++;

                    $args2 = $args;
                    if ( isset( $args['thumbnail_loading'] ) && 'eager' == $args['thumbnail_loading'] ) {
                        if ( $count > $column['desktop'] ) {
                            $args2['thumbnail_loading'] = 'lazy';
                        } else {
                            $args2['thumbnail_loading'] = 'eager';
                        }
                    }
                    ?>
                <div class="carousel-cell">
                    <?php fox56_post( $args2 ); ?>
                </div>
                <?php } // endwhile ?>
            </div> 
        </div>       
    </div>
    <?php
}

/* MAONSRY
============================================================================== */
function fox56_blog_masonry( $query, $args = [] ) {
    $args = fox56_blog_fill_args( $args );
    $container_cl = [ 'blog56', 'blog56--masonry', 'masonry56' ];
    extract( wp_parse_args( $args, [
        'container_class' => '',
        
        // post style
        'post_style' => 'normal', 

        // COLUMN
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
    ]) );

    if ( $container_class ) {
        $container_cl[] = $container_class;
    }

    /**
     * COLUMN
     */
    if ( ! is_array( $column ) ) {
        $column = [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ];
    }
    $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ] );
    $container_cl[] = 'masonry56--' . $column[ 'desktop' ] . 'cols';
    $container_cl[] = 'masonry56--tablet--' . $column[ 'tablet' ] . 'cols';
    $container_cl[] = 'masonry56--mobile--' . $column[ 'mobile' ] . 'cols';

    // GRID COLUMNS (for seps to work)
    $container_cl[] = 'blog56--grid--' . $column[ 'desktop' ] . 'cols';
    $container_cl[] = 'blog56--grid--tablet--' . $column[ 'tablet' ] . 'cols';
    $container_cl[] = 'blog56--grid--mobile--' . $column[ 'mobile' ] . 'cols';

    /**
     * BIG FIRST POST
     */
    if ( isset( $args[ 'big_first_post'] ) && $args[ 'big_first_post' ] ) {
        $container_cl[] = 'masonry56--bigfirst';
    }

    /**
     * FORCE ARGS
     */
    // $args[ 'thumbnail' ] = 'tiny';
    // $args[ 'post_style' ] = 'normal';
    ?>
<div class="<?php echo esc_attr( join( ' ', $container_cl ) ); ?>">

    <div class="main-masonry">
        <?php
        while ( $query->have_posts() ) {
            $query->the_post(); ?>
        <div class="masonry-cell griditem56">
            <?php fox56_post_masonry( $args ); ?>
        </div>
        <?php } ?>
        <div class="grid-sizer"></div>
    </div>

    <div class="blog56__sep">
        <div class="blog56__sep__line line--1"></div>
        <div class="blog56__sep__line line--2"></div>
        <div class="blog56__sep__line line--3"></div>
        <div class="blog56__sep__line line--4"></div>
        <div class="blog56__sep__line line--5"></div>
    </div>

</div>
<?php if ( isset( $args['pagination'] ) && $args['pagination'] ) { ?>
    <?php echo fox56_pagination( $query, $args ); ?>
<?php } ?>
        <?php
}

function fox56_post_masonry( $args = [] ) {

    // special thumbnail_html
    $thumbnail_id = get_post_thumbnail_id();
    if ( ! $thumbnail_id ) {
        $args[ 'thumbnail_html' ] = '';
        fox56_post( $args );
        return;
    }

    $w = $h = 0;
    $get = wp_get_attachment_image_src( $thumbnail_id, 'large' );
    if ( $get && isset($get[1]) && $get[1] && isset($get[2]) && $get[2] ) {
        $w = $get[1];
        $h = $get[2];
        // $padding_css = ' style="padding-bottom:' . ( $h/$w * 100 ) . '%;"';
    } else {
        // $padding_css = '';
    }
    
    /*
    $attrs = [];
    // eager load for at least 5 posts
    if ( isset( $args['thumbnail_loading']) && 'eager' == $args['thumbnail_loading'] ) {
        $attrs['loading'] = 'eager';
    } else {
        $attrs['loading'] = 'lazy';
    }

    $html = '<div class="thumbnail56__padding"' . $padding_css . '></div>
            <noscript>
                ' . wp_get_attachment_image( $thumbnail_id, 'large', false, $attrs ) . '
            </noscript>';
    $args[ 'thumbnail_img_html' ] = $html;
    $args[ 'thumbnail_class'] = 'thumbnail56--delay';
    */

    /**
     * masonry_item_creative problem
     */
    if ( isset( $args['masonry_item_creative'] ) && $args['masonry_item_creative'] && $w && $h ) {
        // vertical
        if ( $h > $w ) {
            $args['post_class'] = [ 'post56--portrait' ];
        }
    }
    $args['thumbnail'] = 'large';
    $args['post_style'] = 'normal';

    fox56_post( $args );

}

/* DEFAULT
=============================================================== */
// return default args from theme mode
function fox56_default_args() {
    $args = [];
    
    /* ---------------------------------------------------  item */
    $components = get_theme_mod( 'components', [ 'thumbnail', 'standalone_category', 'live', 'title', 'date', 'author', 'excerpt', 'more' ] );
    $args[ 'components' ] = $components;

    $args[ 'big_first_post' ] = get_theme_mod( 'big_first_post', true );
    $args[ 'masonry_item_creative' ] = get_theme_mod( 'masonry_item_creative', false );
    $args[ 'list_mobile_layout' ] = get_theme_mod( 'list_mobile_layout', 'list' );
    $args[ 'post_style' ] = get_theme_mod( 'post_style', 'normal' );
    $args[ 'ontop_height_style' ] = get_theme_mod( 'ontop_height_style', 'ratio' );
    $args[ 'ontop_valign' ] = get_theme_mod( 'ontop_valign', 'middle' );
    
    $args[ 'align' ] = get_theme_mod( 'align', 'left' );
    $args[ 'valign' ] = get_theme_mod( 'valign', 'top' );

    /* ---------------------------------------------------  thumbnail */
    $args[ 'thumbnail' ] = get_theme_mod( 'thumbnail', 'thumbnail-medium' );
    $args[ 'thumbnail_custom' ] = get_theme_mod( 'thumbnail_custom', [ 'width' => 400, 'height' => 300 ] );
    $args[ 'thumbnail_rich' ] = get_theme_mod( 'thumbnail_rich' );
    $thumbnail_components = get_theme_mod( 'thumbnail_components', [] );
    $args[ 'thumbnail_format_indicator' ] = in_array( 'format_indicator', $thumbnail_components );
    $args[ 'thumbnail_view' ] = in_array( 'view', $thumbnail_components );
    $args[ 'thumbnail_review' ] = in_array( 'review', $thumbnail_components );
    $args[ 'thumbnail_caption' ] = in_array( 'caption', $thumbnail_components );
    $args[ 'thumbnail_position' ] = get_theme_mod( 'thumbnail_position', 'left' );
    $args[ 'thumbnail_width_type' ] = get_theme_mod( 'thumbnail_width_type', 'percent' );
    $args[ 'thumbnail_hover_effect' ] = get_theme_mod( 'thumbnail_hover_effect', 'none' );
    $args[ 'thumbnail_hover_logo' ] = get_theme_mod( 'thumbnail_hover_logo' );
    $args[ 'thumbnail_showing_effect' ] = get_theme_mod( 'thumbnail_showing_effect', 'none' );

    /* ---------------------------------------------------  title - excerpt */
    $args[ 'title_tag' ] = get_theme_mod( 'title_tag', 'h2' );
    $args[ 'excerpt_content' ] = get_theme_mod( 'excerpt_content', 'excerpt' );
    $args[ 'excerpt_hellip' ] = get_theme_mod( 'excerpt_hellip', false );
    $args[ 'display_excerpt_html' ] = get_theme_mod( 'display_excerpt_html', false );
    $args[ 'excerpt_length' ] = get_theme_mod( 'excerpt_length', 24 );
    $args[ 'more_style' ] = get_theme_mod( 'more_style', 'primary' );

    /* ---------------------------------------------------  meta */
    $args[ 'date_format' ] = get_theme_mod( 'date_format' );
    $args[ 'author_avatar' ] = get_theme_mod( 'author_avatar' );
    return $args;
}

/* ARCHIVE
=============================================================== */
function fox56_archive() {
    fox56_titlebar();
    fox56_toparea();
    fox56_archive_main();
}

/* TITLEBAR
=============================================================== */
function fox56_titlebar() {
    ?>
    <div class="archive56__titlebar"><?php echo fox56_titlebar_inner(); ?></div>
    <?php
}
function fox56_titlebar_author() {

    $label = fox_word( 'browse_author' );
    
    $author = get_queried_object();
    $user_id = $author->ID;

    $cl = [ 'titlebar56', 'titlebar56--author' ];
    
    global $coauthors_plus;
    if ( $coauthors_plus ) {
        $user = $coauthors_plus->get_coauthor_by( 'id', $user_id );
    } else {
        $user = get_userdata( $user_id );
    }

    /* -------------------- ava shape */
    $shape = get_theme_mod( 'authorbox_avatar_shape', 'circle' );
    if ( 'acute' != $shape && 'round' != $shape ) {
        $shape = 'circle';
    }
    $cl[] = 'authorbox56--avatar-' . $shape;

    /* -------------------- background */
    $bg_img_html = '';
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_background';
    $bg_id = get_user_meta( $user_id, $field_id, true );
    if ( $bg_id ) {
        $bg_img_html = wp_get_attachment_image( $bg_id, 'full' );
    }
    if ( $bg_img_html ) {
        $cl[] = 'has-cover';
        $cl[] = 'skin--dark';
    }

    $is_guest_author = get_userdata( $user->ID );
    $is_guest_author = $is_guest_author === false;
    if ( $is_guest_author ) {
        $name = $user->display_name;
        $desc = $user->description;
    } else {
        $name = get_the_author_meta( 'display_name', $user->ID );
        $desc = get_the_author_meta( 'description', $user->ID );
    }
    $desc = wpautop( do_shortcode( $desc ) );
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <div class="container">
            <div class="titlebar56__main">
                <div class="titlebar56__author__avatar authorbox56__avatar">
                    <?php echo get_avatar( $user->ID, 300 ); ?>
                </div>
                <div class="titlebar56__author__text">
                    <h1 class="titlebar56__title"><?php echo $name; ?></h1>
                    <div class="titlebar56__description"><?php echo $desc; ?></div>
                    <?php echo fox56_user_social([ 'user' => $user ]); ?>
                </div>
            </div>
        </div>

        <?php if ( $bg_img_html ) { ?>
        <div class="titlebar56__bg"><?php echo $bg_img_html; ?></div>
        <div class="titlebar56__overlay"></div>
        <?php } ?>
    </div>
    <?php
}
if ( ! function_exists( 'fox56_titlebar_inner' ) ) :
function fox56_titlebar_inner() {
    ob_start();
    if ( is_author() ) {
        fox56_titlebar_author();
        return ob_get_clean();
    }
    $cl = [ 'titlebar56' ];
    $show_archive_description = get_theme_mod( 'titlebar_description', true );
    $title = $desc = $label = '';

    if ( is_category() || is_tag() ) {
        $term = get_queried_object();
        $title = $term->name;
        $desc = $term->description;
        if ( is_category() ) {
            $label = fox_word( 'browse_category' );
        } elseif ( is_tag() ) {
            $label = fox_word( 'browse_tag' );
        }
    } elseif ( is_search() ) {

        global $wp_query;
        
        $label = fox_word( 'search_result' );
        $title  = get_search_query();
        $subtitle = sprintf( fox_word( 'result_found' ), $wp_query->found_posts);
        
    } elseif ( is_day() ) {

        $label = esc_html__( 'Daily archive','wi' );
        $title = get_the_time( 'F d, Y' );

    } elseif ( is_month() ) {
        
        $label = esc_html__('Monthly archive','wi');
        $title = get_the_time('F Y');
        
    } elseif ( is_year() ) {
        
        $label = esc_html__('Yearly archive','wi');
        $title = get_the_time('Y');
        
    } elseif ( is_404() ) {
        
        $label = esc_html__( 'Not found','wi' );
        if ( ! $title ) {
            $title = get_theme_mod( 'page_404_title' );
            if ( ! $title ) {
                $title = esc_html__( 'Page Not Found', 'wi' );
            }
        } 
        
    } elseif ( is_archive() ) {
        
        $page = 'archive';
        $label = esc_html__( 'Archive', 'wi' );
        $title = get_the_archive_title();
        
    }
    $paged = get_query_var( 'paged' );
    if ( $paged ) {
        $page_text = '<span class="paged-label">' . sprintf( fox_word( 'paged' ), $paged ) . '</span>';
        if ( $title ) {
            $title = $title . $page_text;
        }
    }

    /* -------------------- align */
    $align = get_theme_mod( 'titlebar_align', 'center' );
    $cl[] = 'align-' . $align;

    /* -------------------- subcategories */
    $sub_cats_html = '';
    if ( is_category() && get_theme_mod( 'titlebar_subcategories', true ) ) {
        $list = wp_list_categories([
            'echo' => false,
            'child_of' => $term->term_id,
            'depth' => 1,
            'hide_empty' => false,
            'hide_title_if_empty' => true,
            'hierarchical' => true,
            'orderby' => 'name',
            'order' => 'asc',
            'separator' => '',
            'style' => 'list',
            'title_li' => '',
            'show_option_none' => '',
        ]);
        if ( $list ) {
            $sub_cats_html = '<div class="terms56"><ul>' . $list . '</ul></div>';
        }
    }

    /* -------------------- background */
    $bg_img_html = '';
    if ( is_category() || is_tag() ) {
        $bg_id = get_term_meta( $term->term_id, '_wi_background_image', true );
        if ( $bg_id ) {
            $bg_img_html = wp_get_attachment_image( $bg_id, 'full' );
        }
    }
    if ( $bg_img_html ) {
        $cl[] = 'has-cover';
        $cl[] = 'skin--dark';
    }
    ?>
    <div class="<?php echo esc_attr( join( ' ', $cl )); ?>">
        <div class="container">
            <div class="titlebar56__main">
                <?php if ( get_theme_mod( 'titlebar_label' ) && $label ) { ?>
                <span class="titlebar56__label"><?php echo $label; ?></span>
                <?php } ?>
                <h1 class="titlebar56__title"><?php echo $title; ?></h1>
                <?php if ( $show_archive_description && $desc ) { ?>
                <div class="titlebar56__description"><?php echo $desc; ?></div>
                <?php } ?>
                <?php echo $sub_cats_html; ?>
                <?php if ( is_search() ) { get_search_form(); } ?>
            </div>
        </div>
        <?php if ( $bg_img_html ) { ?>
        <div class="titlebar56__bg"><?php echo $bg_img_html; ?></div>
        <div class="titlebar56__overlay"></div>
        <?php } ?>
    </div>
    <?php
    return ob_get_clean();
}
endif;

/* TOP AREA
=============================================================== */
/**
 * RETURN null or WP_Query instance
 */
function fox56_toparea_query_args() {
    $term = '';
    if ( is_category() ) {
        $type = 'category';
        $term = get_queried_object();
    } elseif ( is_tag() ) {
        $type = 'tag';
        $term = get_queried_object();
    } elseif ( is_author() ) {
        $type = 'author';
    } else {
        return;
    }
    if ( is_null( $term ) ) {
        return;
    }

    /* ------------------------------       part 1: query */
    // ------- DISPLAY
    $display = '';
    if ( is_tag() || is_category() ) {
        $display = get_term_meta( $term->term_id, '_wi_toparea_display', true );
    }
    if ( ! $display ) {
        $display = get_theme_mod( "{$type}_toparea_display", 'none' );
    }
    if ( ! $display ) {
        $display = 'none';
    }
    if ( 'none' == $display ) {
        return;
    }

    // ------- NUMBER
    if ( is_tag() || is_category() ) {
        $number = get_term_meta( $term->term_id, '_wi_toparea_number', true );
    }
    $number = get_theme_mod( "{$type}_toparea_number", 4 );

    // ------- QUERY ARGS
    $query_args = [];
    if ( is_tag() || is_category() ) {
        $topbar_include = trim( strval( get_term_meta( $term->term_id, '_wi_toparea_include', true ) ) );
        if ( $topbar_include ) {
            $topbar_include = explode( ',', $topbar_include );
            $topbar_include = array_map( 'absint', $topbar_include );
            $query_args = [
                'post__in' => $topbar_include,
                'post_type' => 'any',
                'post_status' => 'any',
                'orderby' => 'post__in',
                'order' => 'ASC',
            ];
            return $query_args;
        }

        // display
        $personal_display = trim( strval( get_term_meta( $term->term_id, '_wi_toparea_display', true ) ) );
        if ( $personal_display ) {
            $display = $personal_display;
        }

        // $number
        $personal_number = trim( strval( get_term_meta( $term->term_id, '_wi_toparea_number', true ) ) );
        if ( '' !== $personal_number ) {
            $number = $personal_number;
        }
    }
    switch( $display ) {
        case 'featured' :
            $query_args = [
                'featured' => true,
                'orderby' => 'date',
                'order' => 'DESC',
            ];
        break;
        case 'view' :
            $query_args = [
                'orderby' => 'post_views',
                'order' => 'DESC',
            ];
        break;
        case 'latest' :
            $query_args = [
                'orderby' => 'date',
                'order' => 'DESC',
            ];
        break;
        case 'comment_count' :
            $query_args = [
                'orderby' => 'comment_count',
                'order' => 'DESC',
            ];
        break;
    }
    $query_args[ 'post_type' ] = 'post';
    $query_args[ 'posts_per_page' ] = $number;
    $query_args[ 'ignore_sticky_posts' ] = true;

    if ( is_category() ) {
        $query_args[ 'cat' ] = $term->term_id;
    } elseif ( is_tag() ) {
        $query_args[ 'tag_id' ] = $term->term_id;
    } elseif ( is_author() ) {
        $author = get_queried_object();
        $user_id = $author->ID;
        $query_args[ 'author' ] = $user_id;
    }

    return $query_args;
}

function fox56_toparea_query() {
    $query_args = fox56_toparea_query_args();
    if ( ! $query_args ) {
        return;
    }

    $query = new WP_Query( $query_args );
    return $query;
}

/**
 * exclude posts called in the top area
 */
add_action( 'pre_get_posts', function( $query ) {
    if ( get_theme_mod( 'toparea_not_excluded' ) ) {
        return;
    }

    if ( is_admin() ) {
        return;
    }
    if ( ! $query->is_main_query() ) {
        return;
    }
    $top_query_args = fox56_toparea_query_args();
    if ( ! $top_query_args ) {
        return;
    }
    $top_query = fox56_toparea_query();
    if ( $top_query && $top_query->have_posts() ) {
        $to_exclude = wp_list_pluck( $top_query->posts, 'ID' );
        if ( is_array( $to_exclude ) && ! empty($to_exclude)) {
            $query->set( 'post__not_in', $to_exclude );
        }
    }
});

function fox56_toparea() {
    ?>
    <div class="archive56__toparea"><?php fox56_toparea_inner(); ?></div>
    <?php
}

function fox56_toparea_layout_cols() {

    $column = get_theme_mod( 'toparea_column', [] );
    $layout = get_theme_mod( 'toparea_layout', 'group' );
    $group_layout = get_theme_mod( 'toparea_group_layout', '1-3-1' );

    if ( 'list' == $layout ) {
        $column = wp_parse_args( $column, [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ]);
    } else {
        $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ]);
    }

    // personal
    if ( is_category() || is_tag() ) {
        $obj_id = get_queried_object_id();
        $personal_layout = get_term_meta( $obj_id, '_wi_toparea_layout', true );
        $personal_group_layout = get_term_meta( $obj_id, '_wi_toparea_group_layout', true );
        if ( $personal_group_layout ) {
            $group_layout = $personal_group_layout;
        }

        if ( 'list' == $personal_layout || 'vertical' == $personal_layout ) {
            $layout = 'list';
            $column = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
        } elseif ( in_array( $personal_layout, [ 'grid-1', 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
            $layout = 'grid';
            $col = str_replace( 'grid-', '', $personal_layout );
            if ( 4 == $col || 5 == $col ) {
                $tablet_col = 3;
            } else {
                $tablet_col = $col;
            }
            $column = [ 'desktop' => $col, 'tablet' => $tablet_col, 'mobile' => 1 ];
        } elseif ( in_array( $personal_layout, [ 'masonry-1', 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
            $layout = 'masonry';
            $col = str_replace( 'masonry-', '', $personal_layout );
            if ( 4 == $col || 5 == $col ) {
                $tablet_col = 3;
            } else {
                $tablet_col = $col;
            }
            $column = [ 'desktop' => $col, 'tablet' => $tablet_col, 'mobile' => 1 ];
        } elseif ( 'standard' == $personal_layout || 'big' == $personal_layout ) {
            $layout = 'grid';
            $column = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
        } elseif ( 'newspaper' == $personal_layout ) {
            $layout = 'masonry';
            $column = [ 'desktop' => 2, 'tablet' => 2, 'mobile' => 1 ];
        } elseif ( 'group-1' == $personal_layout || 'group-2' == $personal_layout ) {
            $layout = 'group';

            // easy, quickly
            if ( 'group-1' == $personal_layout ) {
                $group_layout = '3-1';    
            } else {
                $group_layout = '1-3-1';
            }
        } elseif ( 'slider' == $personal_layout || 'slider-1' == $personal_layout ) {
            $layout = 'slider';
        } elseif ( 'slider-3' == $personal_layout ) {
            $layout = 'carousel';
            $column = [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ];
        } elseif ( in_array( $personal_layout, [ 'carousel-2', 'carousel-3', 'carousel-4', 'carousel-5' ] ) ) {
            $layout = 'carousel';
            $col = str_replace( 'carousel-', '', $personal_layout );
            if ( 4 == $col || 5 == $col ) {
                $tablet_col = 3;
            } else {
                $tablet_col = $col;
            }
            $column = [ 'desktop' => $col, 'tablet' => $tablet_col, 'mobile' => 1 ];
        }
    }

    return [
        'layout' => $layout,
        'group_layout' => $group_layout,
        'column' => $column,
    ];

}

function fox56_toparea_inner() {
    
    $query = fox56_toparea_query();
    if ( ! $query ) {
        wp_reset_query();
        return;
    }
    
    /* ------------------------------       part 2: layout */
    $args = fox56_default_args();
    $arr = fox56_toparea_layout_cols();
    $args[ 'layout' ] = $arr['layout'];
    $args[ 'column' ] = $arr['column'];
    $args[ 'group_layout' ] = $arr[ 'group_layout' ];

    $args[ 'components' ] = get_theme_mod( 'toparea_components', [ 'standalone_category', 'thumbnail', 'title', 'date', 'author', 'excerpt', 'more' ] );

    $cols = [
        'big' => [
            'title' => 'Big col',
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'thumbnail-large',
            'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
            'align' => 'left',
            'more_style' => 'primary',
        ],
        'medium' => [
            'title' => 'Small col',
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'align' => 'left',
            'more_style' => 'plain',
        ],
        'small' => [
            'layout' => 'grid',
            'column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'title', 'excerpt' ],
            'excerpt_length' => 12,
            'thumbnail' => 'thumbnail-medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'align' => 'left',
            'more_style' => 'plain',
        ],
    ];
    foreach ( $cols as $col => $coldata ) {
        if ( 'big' == $col || 'medium' == $col ) {
            $args[ "{$col}_number" ] = get_theme_mod( "toparea_{$col}_number", $coldata[ 'number' ] );
        }
        $args[ "{$col}_layout" ] = get_theme_mod( "toparea_{$col}_layout", $coldata[ 'layout' ] );
        $args[ "{$col}_components" ] = get_theme_mod( "toparea_{$col}_components", $coldata[ 'components' ] );
        $args[ "{$col}_thumbnail" ] = get_theme_mod( "toparea_{$col}_thumbnail", $coldata[ 'thumbnail' ] );
        $args[ "{$col}_excerpt_length" ] = get_theme_mod( "toparea_{$col}_excerpt_length", $coldata[ 'excerpt_length' ] );
        if ( 'big' == $col ) {
            $args[ "{$col}_align" ] = get_theme_mod( "toparea_{$col}_align", $coldata[ 'align' ] );
        }
        
        $args[ "{$col}_more_style" ] = get_theme_mod( "toparea_{$col}_more_style", $coldata[ 'more_style' ] );

        /* forced options */
        $args[ "{$col}_column" ] = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
        $args[ "{$col}_thumbnail_width_type" ] = 'pixel';
        $args[ "{$col}_thumbnail_position" ] = 'right';
    }

    $args['thumbnail'] = get_theme_mod( 'toparea_thumbnail', 'thumbnail-medium' );
    $args['thumbnail_rich'] = get_theme_mod( 'thumbnail_rich' );
    $args['thumbnail_width_type'] = get_theme_mod( 'toparea_thumbnail_width_type', 'pixel' );
    $args['thumbnail_position'] = get_theme_mod( 'toparea_thumbnail_position', 'left' );

    $layout = $args[ 'layout' ];

    /* ------------------------------       custom params */
    $custom_args = fox56_args_from_string( get_theme_mod( 'toparea_custom_params', '' ));
    $args = wp_parse_args( $custom_args, $args );

    ?>
<div class="toparea56">
    <div class="container">
<?php
    switch( $layout ) {
        case 'grid' :
            fox56_blog_grid( $query, $args );
        break;
        case 'list' :
            fox56_blog_list( $query, $args );
        break;
        case 'group' :
            fox56_blog_group( $query, $args );
        break;
        case 'masonry' :
            fox56_blog_masonry( $query, $args );
        break;
        case 'carousel' :
            fox56_blog_carousel( $query, $args );
        break;
        case 'slider' :
            $args['thumbnail'] = 'full';
            $args[ 'column' ] = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
            $args[ 'post_style' ] = 'ontop';
            $args[ 'align' ] = 'center';
            $args[ 'ontop_valign' ] = 'middle';
            $args[ 'container_class' ] = 'blog56--slider';
            $args[ 'ontop_height_style' ] = 'ratio';
            fox56_blog_carousel( $query, $args );
        break;
    }
    ?>
    </div>
</div>
    <?php
    wp_reset_query();
}

/* ARCHIVE MAIN
=============================================================== */
function fox56_archive_main() {
    ?>
    <div class="archive56__main"><?php fox56_archive_main_inner(); ?></div>
    <?php
}

/**
 * this will be used for loading the necessary javascript for this
 */
// return array of both layouts and columns
function fox56_get_archive_layout_cols() {
    if ( is_category() ) {
        $type = 'category';
    } elseif ( is_tag() ) {
        $type = 'tag';
    } elseif ( is_author() ) {
        $type = 'author';
    } elseif( is_search() ) {
        $type = 'search';
    } else {
        $type = 'archive';
    }
    $layout = get_theme_mod( "{$type}_layout", 'list' );
    $column = get_theme_mod( "{$type}_column", [] );
    if ( 'list' == $layout ) {
        $column = wp_parse_args( $column, [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ]);
    } else {
        $column = wp_parse_args( $column, [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ]);
    }

    // personal
    if ( is_category() || is_tag() ) {
        $obj_id = get_queried_object_id();
        $personal_layout = get_term_meta( $obj_id, '_wi_layout', true );
        if ( 'list' == $personal_layout || 'vertical' == $personal_layout ) {
            $layout = 'list';
            $column = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
        } elseif ( in_array( $personal_layout, [ 'grid-1', 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
            $layout = 'grid';
            $col = str_replace( 'grid-', '', $personal_layout );
            if ( 4 == $col || 5 == $col ) {
                $tablet_col = 3;
            } else {
                $tablet_col = $col;
            }
            $column = [ 'desktop' => $col, 'tablet' => $tablet_col, 'mobile' => 1 ];
        } elseif ( in_array( $personal_layout, [ 'masonry-1', 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
            $layout = 'masonry';
            $col = str_replace( 'masonry-', '', $personal_layout );
            if ( 4 == $col || 5 == $col ) {
                $tablet_col = 3;
            } else {
                $tablet_col = $col;
            }
            $column = [ 'desktop' => $col, 'tablet' => $tablet_col, 'mobile' => 1 ];
        } elseif ( 'standard' == $personal_layout ) {
            $layout = 'grid';
            $column = [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ];
        } elseif ( 'newspaper' == $personal_layout ) {
            $layout = 'masonry';
            $column = [ 'desktop' => 2, 'tablet' => 2, 'mobile' => 1 ];
        }
    }

    return [
        'layout' => $layout,
        'column' => $column,
    ];

}

function fox56_archive_main_inner() {
    $args = fox56_default_args();
    $cl = [];

    if ( is_category() ) {
        $type = 'category';
    } elseif ( is_tag() ) {
        $type = 'tag';
    } elseif ( is_author() ) {
        $type = 'author';
    } elseif( is_search() ) {
        $type = 'search';
    } else {
        $type = 'archive';
    }

    /* ---------------------------------------------------  layout - column */
    $arr = fox56_get_archive_layout_cols();
    $layout = $arr['layout'];
    $column = $arr['column'];
    $args[ 'layout' ] = $arr['layout'];
    $args[ 'column' ] = $arr['column'];

    /* ---------------------------------------------------  item */
    $obj_id = get_queried_object_id();
    
    /* --------------------------------------------------   sidebar */
    $sidebar_state = false;
    if ( is_tag() || is_category() ) {
        $sidebar_state = get_term_meta( $obj_id, '_wi_sidebar_state', true );
    }
    if ( ! $sidebar_state ) { 
        $sidebar_state = get_theme_mod( "{$type}_sidebar_state", 'sidebar-right' );
    }
    if ( 'sidebar-right' == $sidebar_state ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--right';
        $has_sidebar = true;
    } elseif ( 'sidebar-left' == $sidebar_state ) {
        $cl[] = 'hassidebar';
        $cl[] = 'hassidebar--left';
        $has_sidebar = true;
    } else {
        $has_sidebar = false;
    }
    if ( $has_sidebar ) {
        if ( get_theme_mod( 'sticky_sidebar' ) ) {
            $cl[] = 'hassidebar--sticky';
        }
    }
    global $wp_query;

    $args[ 'pagination' ] = true;
    ?>

<div class="<?php echo esc_attr( join(' ', $cl)); ?>">
    <div class="container container--main">
        <div class="primary56">
            <?php
            switch( $layout ) {
                case 'grid' :
                    fox56_blog_grid( $wp_query, $args );
                break;
                case 'list' :
                    fox56_blog_list( $wp_query, $args );
                break;
                case 'masonry' :
                    fox56_blog_masonry( $wp_query, $args );
                break;
            }   
            ?>
        </div>
        <?php if( $has_sidebar ) { fox56_blog_sidebar(); } ?>
    </div>
</div>
    <?php
}

function fox56_blog_sidebar() {
    $sidebar = false;
    if ( is_tag() || is_category() ) {
        $sidebar = get_term_meta( get_queried_object_id(), '_wi_sidebar_sidebar', true );
    }
    if ( ! $sidebar ) {
        if ( is_category() ) {
            $sidebar = get_theme_mod( 'category_sidebar' );
        } elseif ( is_tag() ) {
            $sidebar = get_theme_mod( 'tag_sidebar' );
        } elseif ( is_author() ) {
            $sidebar = get_theme_mod( 'author_sidebar' );
        } elseif ( is_search() ) {
            $sidebar = get_theme_mod( 'search_sidebar' );
        } else {
            $sidebar = get_theme_mod( 'archive_sidebar' );
        }
    }
    if ( ! $sidebar ) {
        $sidebar = 'sidebar';
    }
    ?>
    <div class="secondary56">
        <?php dynamic_sidebar( $sidebar ); ?>
    </div>
    <?php
}


/* PAGE ID
=============================================================== */
function fox56_page_id() {
    
    if ( is_singular() ) return get_the_ID();
    if ( is_page() ) return get_the_ID();
    
    $id = null;
    
    if ( is_home() && is_front_page() ) {
    
        $id = get_option( 'page_for_posts' );
    
    }
    
    return apply_filters( 'fox_page_id', $id );
    
}