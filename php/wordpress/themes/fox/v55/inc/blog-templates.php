<?php
/**
 * abstract: this file only does one thing: tempalte function for different blog layouts
 * fox_blog
 * fox_blog_grid
 * fox_blog_group_1
 ..
 
 2 more helper functions:
 
 * fox_pagination
 * fox_component_to_show
 
 */

/**
 * fn_params is the final params we use to render blog
 * we don't input unprocessed fn_params
 *
 * @since 4.5
 */
function fox_blog( $fn_params, $query ) {
    
    $fn_params = wp_parse_args( $fn_params, [
        'pagination' => '',
        
        'layout' => '',
        'column' => '',
        'first_standard' => '',
        'item_card' => '',
        'item_card_background' => '',
        'item_border' => '',
        'item_border_color' => '',
        'item_spacing' => '',
        'color' => '',
        'big_first_post' => true, // for masonry
        'align' => '',
        'item_template' => '',
        'live' => true,
        'components' => '',
        'thumbnail_components' => '',
        
        // component params
        'thumbnail_show' => '',
        'title_show' => '',
        'date_show' => '',
        'category_show' => '',
        'author_show' => '',
        'author_avatar_show' => '',
        'excerpt_show' => '',
        'excerpt_more_show' => '',
        'view_show' => '',
        'reading_time_show' => '',
        'comment_link_show' => '',
        'share_show' => '',
        
        // thumbnail options
        'thumbnail' => 'landscape',
        'thumbnail_custom' => '',
        'thumbnail_placeholder' => true,
        'thumbnail_placeholder_id' => '',
        'thumbnail_shape' => '',
        'thumbnail_hover' => '',
        'thumbnail_hover_logo' => '',
        'thumbnail_hover_logo_width' => '',
        'thumbnail_showing_effect' => '',
        
        'thumbnail_format_indicator' => '',
        'thumbnail_index' => '',
        'thumbnail_view' => '',
        'thumbnail_review_score' => '',
        
        'thumbnail_extra_class' => '',
        
        // since 4.6.7
        'thumbnail_caption' => '', // show caption or not in case the thumbnail has caption
        'thumbnail_order' => '', // if 'after' then display the thumbnail after post content
        
        // title options
        'title_tag' => '',
        'title_color' => '',
        'title_size' => '',
        'title_weight' => '',
        
        // excerpt options
        'excerpt_length' => 22,
        'excerpt_size' => '',
        'excerpt_color' => '',
        'excerpt_hellip' => '',
        'excerpt_more' => '',
        'excerpt_more_style' => '',
        'excerpt_more_text' => '',
        
        /**
         * LIST
         */
        'list_spacing' => '',
        'list_sep' => true,
        'list_sep_style' => 'solid',
        'list_sep_color' => '',
        'thumbnail_position' => 'left',
        'thumbnail_width' => '',
        'list_mobile_layout' => 'grid',
        'list_valign' => 'top',
        
        'list_index' => '', // since 4.6.2
        
        /**
         * MASONRY
         */
        'masonry_dropcap' => '',
        'masonry_item_creative' => '',
        
        /**
         * STANDARD
         */
        'thumbnail_type' => 'simple', // simple or rich
        'share_show' => '',
        'related_show' => '',
        
        'standard_sep' => true, // since 4.6.2.3
        'standard_thumbnail_type' => '',
        'standard_thumbnail_header_order' => '',
        'standard_content_excerpt' => '',
        'standard_excerpt_length' => '',
        'standard_excerpt_more' => '',
        'standard_excerpt_more_style' => '',
        'standard_header_align' => '',
        'standard_column_layout' => '',
        'standard_dropcap' => '',
        
        /**
         * NEWSPAPER
         */
        'newspaper_header_align' => '',
        'newspaper_dropcap' => '',
        'newspaper_content_excerpt' => '',
        'newspaper_column_layout' => '',
        
        /**
         * VERTICAL
         */
        'vertical_thumbnail_type' => '',
        'vertical_thumbnail_position' => '',
        'vertical_excerpt_size' => '',
        
        /**
         * BIG
         */
        'big_content_excerpt' => '',
        'big_align' => '',
        'big_meta_background' => '',
        
        /**
         * SLIDER
         */
        'slider_effect' => 'slide',
        'slider_nav_style' => 'text',
        'slider_dot_style' => 'disabled',
        'slider_size' => '1020x510',
        'slider_title_background' => '',
        
        'slider_autoplay' => '',
        
        /**
         * SLIDER 1
         */
        'slider1_height' => '',
        'slider1_content_color' => '',
        'slider1_content_background' => '',
        'slider1_content_background_opacity' => '',
        
        /**
         * SLIDER 2
         */
        'slider2_text_background' => '',
        
        /**
         * SLIDER 3
         */
        'slider3_text_background' => '',
        
        /**
         * GROUP 1
         */
        'group1_big_position' => '',
        'group1_big_ratio' => '',
        'group1_spacing' => '',
        'group1_sep_border' => '',
        'group1_sep_border_color' => '',
        
        // since 4.7.2
        'group1_big_number' => '',
        'group1_small_display' => '',
        'group1_small_column' => '',
        
        'group1_big_components' => '',
        'group1_big_align' => '',
        'group1_big_item_template' => '',
        'group1_big_thumbnail' => '',
        'group1_big_excerpt_length' => '',
        'group1_big_excerpt_more_text' => '',
        'group1_big_excerpt_more_style' => '',
        
        'group1_small_components' => '',
        'group1_small_item_template' => '',
        'group1_small_list_spacing' => '',
        'group1_small_thumbnail' => '',
        'group1_small_excerpt_length' => '',
        
        /**
         * GROUP 2
         */
        'group2_spacing' => '', // 4.6.8
        'group2_columns_order' => '',
        'group2_sep_border' => '',
        'group2_sep_border_color' => '',
        
        // since 4.7.2
        'group2_big_number' => '',
        'group2_medium_number' => '',
        'group2_small_display' => '',
        
        'group2_big_components' => '',
        'group2_big_align' => '',
        'group2_big_item_template' => '',
        'group2_big_excerpt_length' => '',
        'group2_big_excerpt_more_text' => '',
        'group2_big_excerpt_more_style' => '',
        
        'group2_medium_components' => '',
        'group2_medium_item_template' => '',
        'group2_medium_thumbnail' => '',
        'group2_medium_excerpt_length' => '',
        
        'group2_small_components' => '',
        'group2_small_item_template' => '',
        'group2_small_excerpt_length' => '',
        'group2_small_title_size' => '',
        
        // extra
        'extra_class' => '',
        
    ]);
    
    // no posts found
    // don't waste my time
    if ( ! $query ) {
        return;
    }
    
    if ( ! $query->have_posts() ) {
        wp_reset_query();
        return;
    }
    
    // only validate the layout
    $layout = $fn_params[ 'layout' ];
    
    $layout_to_function = [
        
        'standard' => 'fox_blog_standard',
        'grid' => 'fox_blog_grid',
        'masonry' => 'fox_blog_masonry',
        'list' => 'fox_blog_list',
        'newspaper' => 'fox_blog_newspaper',
        'vertical' => 'fox_blog_vertical',
        'big' => 'fox_blog_big',
        'slider' => 'fox_blog_slider',
        'slider-1' => 'fox_blog_slider1',
        'slider-2' => 'fox_blog_slider2',
        'slider-3' => 'fox_blog_slider3',
        'group-1' => 'fox_blog_group_1',
        'group-2' => 'fox_blog_group_2',
        
    ];
    
    if ( ! isset( $layout_to_function[ $layout ] ) ) {
        $layout = 'list';
    }
    $fn_params[ 'layout' ] = $layout;
    
    /**
     * @since 4.5
     
     10 - fox_justify_params
     */
    $fn_params = apply_filters( 'fox_final_params', $fn_params, $query );
    
    call_user_func( $layout_to_function[ $layout ], $fn_params, $query );
    
    wp_reset_query();
    
}

add_filter( 'fox_final_params', 'fox_justify_params', 10, 1 );
/**
 * adjust minor problems on fn_params
 * @since 4.5
 */
function fox_justify_params( $fn_params ) {
    
    // only apply for list layout
    if ( 'list' != $fn_params[ 'layout' ] ) {
        $fn_params[ 'thumbnail_width' ] = '';
    }
    
    if ( ! in_array( $fn_params[ 'layout' ], [ 'standard', 'newspaper', 'vertical' ] ) ) {
        $fn_params[ 'thumbnail_type' ] = 'simple';
    }
    
    if ( 'false' == get_theme_mod( 'wi_live_grid_list', 'false' ) ) {
        if ( in_array( $fn_params[ 'layout' ], [ 'list', 'grid' ] ) ) {
            $fn_params[ 'live' ] = false;
        }
    } else {
        $fn_params[ 'live' ] = true;
    }
    
    /**
     * 01 - components
     */
    $components_to_show = fox_component_to_show( $fn_params[ 'components' ] );
    $fn_params = array_merge( $fn_params, $components_to_show );

    /**
     * 02 - thumbnail components
     */
    $components = isset( $fn_params[ 'thumbnail_components' ] ) ? $fn_params[ 'thumbnail_components' ] : 'format_indicator';
    if ( ! is_array( $components ) ) {
        $components = explode( ',', $components );
        $components = array_map( 'trim', $components );
    }
    $fn_params[ 'thumbnail_format_indicator' ] = in_array( 'format_indicator', $components );
    $fn_params[ 'thumbnail_index' ] = in_array( 'index', $components );
    $fn_params[ 'thumbnail_view' ] = in_array( 'view', $components );
    $fn_params[ 'thumbnail_review_score' ] = in_array( 'review', $components );

    /**
     * 03 - true/false
     */
    foreach ( $fn_params as $k => $v ) {
        if ( 'true' == $v ) {
            $fn_params[ $k ] = true;
        } elseif ( 'false' == $v ) {
            $fn_params[ $k ] = false;
        }
    }
    
    return $fn_params;
    
}

/**
 * Blog List
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_list( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-list' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-list' ];
    
    /**
     * first standard
     */
    if ( $fn_params[ 'first_standard' ] ) {
        $class[] = 'has-standard-first';
    }
    
    /**
     * extra class
     */
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
        
    /**
     * spacing
     */
    $list_spacing = $fn_params[ 'list_spacing' ];
    if ( ! in_array( $list_spacing, [ 'none', 'tiny', 'small', 'normal', 'medium', 'large' ] ) ) {
        $list_spacing = 'normal';
    }
    $class[] = 'v-spacing-' . $list_spacing;
    
    /**
     * card layout
     */
    if ( strpos( $fn_params[ 'item_card' ], 'no_shadow' ) === false ) {
        $class[] = 'blog-card-has-shadow';
    } else {
        $class[] = 'blog-card-no-shadow';
    }
    $fn_params[ 'item_card' ] = str_replace( '_no_shadow', '', $fn_params[ 'item_card' ] );
        
    if ( in_array( $fn_params[ 'item_card' ], [ 'normal', 'overlap' ] ) ) {
        $class[] = 'blog-card-' . $fn_params[ 'item_card' ];
    }
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        if ( $fn_params[ 'first_standard' ] && 1 == $count ) {
            
            get_template_part( 'content/post', 'standard', $params );
            
        } else {
        
            get_template_part( 'content/post', 'list', $params );
        }
        
        do_action( 'fox_after_render_post' );
        
    } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Grid
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_grid( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-grid' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-grid', 'fox-grid' ];
    
    $grid_line_class = [ 'fox-grid', 'grid-lines' ];
    
    /**
     * first standard
     */
    if ( $fn_params[ 'first_standard' ] ) {
        $class[] = 'has-standard-first';
    }
    
    /**
     * extra class
     */
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
    
    /**
     * card layout
     */
    if ( strpos( $fn_params[ 'item_card' ], 'no_shadow' ) === false ) {
        $class[] = 'blog-card-has-shadow';
    } else {
        $class[] = 'blog-card-no-shadow';
    }
    $fn_params[ 'item_card' ] = str_replace( '_no_shadow', '', $fn_params[ 'item_card' ] );
        
    if ( in_array( $fn_params[ 'item_card' ], [ 'normal', 'overlap' ] ) ) {
        $class[] = 'blog-card-' . $fn_params[ 'item_card' ];
    }
    
    /**
     * border
     */
    if ( 'true' == $fn_params[ 'item_border' ] ) {
        $container_class[] = 'blog-container-has-border';
    }
    
    /**
     * column
     */
    $class[] = 'column-' . $fn_params['column'];
    $grid_line_class[] = 'column-' . $fn_params['column'];
    
    /**
     * item spacing
     */
    $item_spacing = $fn_params[ 'item_spacing' ];
    if ( ! in_array( $item_spacing, [ 'none', 'tiny', 'small', 'normal', 'medium', 'wide', 'wider' ] ) ) {
        $item_spacing = 'normal';
    }
    $class[] = 'spacing-' . $item_spacing;
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    /**
     * border css
     * @since 4.4.2
     */
    $border_css = '';
    if ( $fn_params[ 'item_border_color' ] ) {
        $border_css = ' style="color:' . esc_attr( $fn_params[ 'item_border_color' ] ) . '"';
    }
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        if ( $fn_params[ 'first_standard' ] && 1 == $count ) {
            
            get_template_part( 'content/post', 'standard', $params );
            
        } else {
        
            get_template_part( 'content/post', 'grid', $params );
        }
        
        do_action( 'fox_after_render_post' );
        
    } ?>
        
        <?php if ( 'true' == $fn_params[ 'item_border' ] ) { ?>
        
        <div class="<?php echo esc_attr( join( ' ', $grid_line_class ) ); ?>"<?php echo $border_css; ?>>
            
            <?php for ( $i = 1; $i <= $fn_params['column']; $i++ ) { ?>
            
            <div class="grid-line fox-grid-item"><div class="grid-line-inner"></div></div>
            
            <?php } ?>
            
        </div><!-- .grid-lines -->
        
        <?php } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Masonry
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_masonry( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-masonry' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-masonry', 'fox-grid', 'fox-masonry' ];
    
    $grid_line_class = [ 'fox-grid', 'grid-lines' ];
    
    /**
     * extra class
     */
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
    
    /**
     * creative item
     */
    if ( $fn_params[ 'masonry_item_creative' ] ) {
        $class[] = 'blog-item-creative';
    }
    
    /**
     * card layout
     */
    if ( strpos( $fn_params[ 'item_card' ], 'no_shadow' ) === false ) {
        $class[] = 'blog-card-has-shadow';
    } else {
        $class[] = 'blog-card-no-shadow';
    }
    $fn_params[ 'item_card' ] = str_replace( '_no_shadow', '', $fn_params[ 'item_card' ] );
        
    if ( in_array( $fn_params[ 'item_card' ], [ 'normal', 'overlap' ] ) ) {
        $class[] = 'blog-card-' . $fn_params[ 'item_card' ];
    }
    
    /**
     * column
     */
    $class[] = 'column-' . $fn_params['column'];
    $grid_line_class[] = 'column-' . $fn_params['column'];
    
    /**
     * big first post
     */
    if ( $fn_params[ 'big_first_post' ] ) {
        $class[] = 'fox-masonry-featured-first';
    }
    
    /**
     * item spacing
     */
    $item_spacing = $fn_params[ 'item_spacing' ];
    if ( ! in_array( $item_spacing, [ 'none', 'tiny', 'small', 'normal', 'medium', 'wide', 'wider' ] ) ) {
        $item_spacing = 'normal';
    }
    $class[] = 'spacing-' . $item_spacing;
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    /**
     * border
     */
    if ( 'true' == $fn_params[ 'item_border' ] ) {
        $container_class[] = 'blog-container-has-border';
    }
    
    /**
     * border css
     * @since 4.4.2
     */
    $border_css = '';
    if ( $fn_params[ 'item_border_color' ] ) {
        $border_css = ' style="color:' . esc_attr( $fn_params[ 'item_border_color' ] ) . '"';
    }
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        get_template_part( 'content/post', 'masonry', $params );
        
        do_action( 'fox_after_render_post' );
        
    } ?>
        
        <div class="grid-sizer fox-grid-item"></div>
        
        <?php if ( 'true' == $fn_params[ 'item_border' ] ) { ?>
        
        <div class="<?php echo esc_attr( join( ' ', $grid_line_class ) ); ?>"<?php echo $border_css; ?>>
            
            <?php for ( $i = 1; $i <= $fn_params['column']; $i++ ) { ?>
            
            <div class="grid-line fox-grid-item"><div class="grid-line-inner"></div></div>
            
            <?php } ?>
            
        </div><!-- .grid-lines -->
        
        <?php } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Standard
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_standard( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-grid' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-standard' ];
    
    /**
     * extra class
     */
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
    
    /**
     * card layout
     */
    if ( strpos( $fn_params[ 'item_card' ], 'no_shadow' ) === false ) {
        $class[] = 'blog-card-has-shadow';
    } else {
        $class[] = 'blog-card-no-shadow';
    }
    $fn_params[ 'item_card' ] = str_replace( '_no_shadow', '', $fn_params[ 'item_card' ] );
        
    if ( in_array( $fn_params[ 'item_card' ], [ 'normal', 'overlap' ] ) ) {
        $class[] = 'blog-card-' . $fn_params[ 'item_card' ];
    }
    
    /**
     * spacing
     * @since 4.6.2
     */
    $standard_spacing = get_theme_mod( 'wi_standard_spacing', 'normal' );
    if ( ! in_array( $standard_spacing, [ 'tiny', 'small' ] ) ) {
        $standard_spacing = 'normal';
    }
    $class[] = 'standard-spacing-' . $standard_spacing;
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
            
        get_template_part( 'content/post', 'standard', $params );
        
        do_action( 'fox_after_render_post' );
        
    } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Newspaper
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_newspaper( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-newspaper' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-newspaper' ];
    
    $class[] = 'fox-masonry fox-grid column-2 spacing-normal';
    
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        get_template_part( 'content/post', 'newspaper', $params );
        
    } ?>
        
        <div class="grid-sizer fox-grid-item"></div>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
}

/**
 * Blog Vertical
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_vertical( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-vertical' ];
    
    $class = [ 'wi-blog', 'fox-blog', 'blog-vertical' ];
    
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php 
    $count = 0;
    while ( $query->have_posts() ) {
        
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        get_template_part( 'content/post', 'vertical', $params );
        
        do_action( 'fox_after_render_post' );
        
    } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Big
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_big( $fn_params, $query ) {
    
    $container_class = [ 'blog-container', 'blog-container-big' ];
    $class = [ 'wi-blog', 'fox-blog', 'blog-big' ];
    
    if ( $fn_params[ 'extra_class' ] ) {
        $class[] = $fn_params[ 'extra_class' ];
    }

    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

    <?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>
    
    <?php
    $count = 0;
    while( $query->have_posts() )  {
    
        $query->the_post();
        $count++;
        
        $params = $fn_params;
        $params[ 'count' ] = $count;
        
        get_template_part( 'content/post', 'big', $params );
        
        do_action( 'fox_after_render_post' );
        
    } ?>
    
    </div><!-- .fox-blog -->
    
    <?php if ( $fn_params[ 'pagination' ] ) { fox_pagination( $query ); } ?>
    
</div><!-- .fox-blog-container -->

    <?php
    
}

/**
 * Blog Slider
 *
 * @since 4.4
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_slider( $fn_params, $query ) {
    
    $class = [
        'wi-flexslider',
        'fox-flexslider',
        'blog-slider',
    ];
    
    /**
     * nav class
     */
    $nav_style = $fn_params[ 'slider_nav_style' ];
    if ( ! in_array( $nav_style, fox_slider_nav_style_support() ) ) {
        $nav_style = 'circle-1';
    }
    $class[] = 'style--slider-nav-' . $nav_style;
    
    $slider_options = [
        'slideshow' => $fn_params[ 'slider_autoplay' ],
        'animationSpeed' => 1000,
        'slideshowSpeed' =>	5000,
        'easing' => 'easeOutCubic',
    ];
    
    /**
     * arrow
     */
    if ( 'text' == $nav_style ) {
        $slider_options[ 'prevText' ] = '<i class="fa fa-chevron-left"></i>' . '<span>' . fox_word( 'previous' ) . '</span>';
        $slider_options[ 'nextText' ] = '<span>' . fox_word( 'next' ) . '</span>' . '<i class="fa fa-chevron-right"></i>';
    } else {
        $slider_options[ 'prevText' ] = '<i class="fa fa-angle-left"></i>';
        $slider_options[ 'nextText' ] = '<i class="fa fa-angle-right"></i>';
    }
    
    // effect
    if ( 'fade' != $fn_params[ 'slider_effect' ] ) $fn_params[ 'slider_effect' ] = 'slide';
    $slider_options[ 'animation' ] = $fn_params[ 'slider_effect' ];
    
    // nav style
    if ( 'arrow' != $fn_params[ 'slider_nav_style' ] ) $fn_params[ 'slider_nav_style' ] = 'text';
    $class[] = 'style--slider-nav' . $fn_params[ 'slider_nav_style' ];
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?> data-options='<?php echo json_encode( $slider_options ); ?>'>
            
    <div class="flexslider">
        
        <ul class="slides">
            
            <?php 
            $count = 0;
            while( $query->have_posts()) {
                $query->the_post();
                $params = $fn_params;
                $count++;
                $params[ 'count' ] = $count;

                get_template_part( 'content/post', 'slider', $params );

                do_action( 'fox_after_render_post' );

            } ?>
            
        </ul>
        
    </div><!-- .flexslider -->
    
    <?php echo fox_loading_element(); ?>

</div><!-- .wi-flexslider -->
    
<?php
}

/**
 * Blog Slider 1
 *
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_slider1( $fn_params, $query ) {
    
    $class = [
        'fox-flexslider',
        'modern-slider1',
    ];
    
    /**
     * nav class
     */
    $nav_style = $fn_params[ 'slider_nav_style' ];
    if ( ! in_array( $nav_style, fox_slider_nav_style_support() ) ) {
        $nav_style = 'circle-1';
    }
    $class[] = 'style--slider-nav-' . $nav_style;
    
    $slider_options = [
        'slideshow' => $fn_params[ 'slider_autoplay' ],
        'animationSpeed' => 1000,
        'slideshowSpeed' =>	5000,
        'easing' => 'easeOutCubic',
        'effect' => 'fade',
        'directionNav' => true,
    ];
    
    /**
     * arrow
     */
    if ( 'text' == $nav_style ) {
        
        $slider_options[ 'prevText' ] = '<i class="fa fa-chevron-left"></i>' . '<span>' . fox_word( 'previous' ) . '</span>';
        $slider_options[ 'nextText' ] = '<span>' . fox_word( 'next' ) . '</span>' . '<i class="fa fa-chevron-right"></i>';
        
    } elseif ( 'square-3' == $nav_style ) {
        
        $slider_options[ 'prevText' ] = '<i class="feather-chevron-left"></i>';
        $slider_options[ 'nextText' ] = '<i class="feather-chevron-right"></i>';
        
    } else {
        
        $slider_options[ 'prevText' ] = '<i class="fa fa-angle-left"></i>';
        $slider_options[ 'nextText' ] = '<i class="fa fa-angle-right"></i>';
        
    }
    
    /**
     * controls
     */
    $dot_style = $fn_params[ 'slider_dot_style' ];
    if ( $dot_style && 'disabled' != $dot_style ) {
        $slider_options[ 'controlNav' ] = true;
        $class[] = 'style--slider-dot-' . $dot_style;
    }    
    
    /**
     * height
     */
    if ( 'fullscreen' != $fn_params[ 'slider1_height' ] && 'tall' != $fn_params[ 'slider1_height' ] ) {
        $fn_params[ 'slider1_height' ] = 'short';
    }

    $class[] = 'slider-height-' . $fn_params[ 'slider1_height' ];
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?> data-options='<?php echo json_encode( $slider_options ); ?>'>
            
    <div class="flexslider">
        
        <ul class="slides">
            
            <?php 
            $count = 0;
            while( $query->have_posts()) {
                $query->the_post();
                $params = $fn_params;
                $count++;
                $params[ 'count' ] = $count;

                get_template_part( 'content/post', 'slider1', $params );

                do_action( 'fox_after_render_post' );

            } ?>
            
        </ul><!-- .slides -->
        
    </div><!-- .flexslider -->
    
    <div class="post-slide1-height"></div>
    
</div><!-- .fox-slider -->
    
<?php
}

/**
 * Blog Slider 2
 *
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_slider2( $fn_params, $query ) {
    
    $class = [
        'fox-flexslider',
        'fox-slider2',
        'style--slider-navcircle',
    ];
    
    $slider_options = [
        'slideshow' => true,
        'animationSpeed' => 1000,
        'slideshowSpeed' =>	5000,
        'easing' => 'easeOutCubic',
        'effect' => 'fade',
        'prevText' => '<span class="slider-nav-circle"><i class="feather-chevron-left"></i></span>',
        'nextText' => '<span class="slider-nav-circle"><i class="feather-chevron-right"></i></span>',
    ];
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?> data-options='<?php echo json_encode( $slider_options ); ?>'>
            
    <div class="flexslider">
        
        <ul class="slides">
            
            <?php 
            $count = 0;
            while( $query->have_posts()) {
                $query->the_post();
                $params = $fn_params;
                $count++;
                $params[ 'count' ] = $count;

                get_template_part( 'content/post', 'slider2', $params );

                do_action( 'fox_after_render_post' );

            } ?>
            
        </ul><!-- .slides -->
        
    </div><!-- .flexslider -->
    
    <div class="post-slider2-height"></div>
    
</div><!-- .fox-slider -->
    
<?php
    
}

/**
 * Blog Slider 3
 *
 * @since 4.6
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_slider3( $fn_params, $query ) {
    
    $class = [
        'fox-carousel',
        'fox-carousel-fixed',
        'fox-slider3',
    ];
    
    /**
     * nav class
     */
    $nav_style = $fn_params[ 'slider_nav_style' ];
    if ( ! in_array( $nav_style, fox_slider_nav_style_support() ) ) {
        $nav_style = 'circle-1';
    }
    $class[] = 'style--slider-nav-' . $nav_style;
    
    $slider_options = [
        'slidesToShow' => 3,
        'slidesToScroll' => 3,
        'variableWidth' => false,
        
        'autoplay' => $fn_params[ 'slider_autoplay' ],
        'autoplaySpeed' => 5000,
        
        'responsive' => [ 
            [
                'breakpoint' => 1024,
                'settings' => [
                    'slidesToShow' => 2,
                    'slidesToScroll' => 2,
                ],
            ],
            [
                'breakpoint' => 600,
                'settings' => [
                    'slidesToShow' => 1,
                    'slidesToScroll' => 1,
                ],
            ],
        ],
    ];
    
    /**
     * arrow
     */
    if ( 'text' == $nav_style ) {
        $slider_options[ 'prevArrow' ] = '<button type="button" class="slick-prev slick-nav"><i class="fa fa-chevron-left"></i>' . '<span>' . fox_word( 'previous' ) . '</span></button>';
        $slider_options[ 'nextArrow' ] = '<button type="button" class="slick-next slick-nav"><span>' . fox_word( 'next' ) . '</span>' . '<i class="fa fa-chevron-right"></i></button>';
    } else {
        $slider_options[ 'prevArrow' ] = '<button type="button" class="slick-prev slick-nav"><i class="fa fa-angle-left"></i></button>';
        $slider_options[ 'nextArrow' ] = '<button type="button" class="slick-next slick-nav"><i class="fa fa-angle-right"></i></button>';
    }
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?> data-options='<?php echo json_encode( $slider_options ); ?>'>
            
    <div class="fox-slick">
        
        <?php 
        $count = 0;
        while( $query->have_posts()) {
            $query->the_post();
            $params = $fn_params;
            $count++;
            $params[ 'count' ] = $count;

            get_template_part( 'content/post', 'slider3', $params );

            do_action( 'fox_after_render_post' );

        } ?>
        
    </div><!-- .fox-slick -->
    
</div><!-- .fox-carousel -->
    
<?php
    
}

/**
 * Blog Group 1
 *
 * @since 4.5
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_group_1( $fn_params, $query ) {
    
    $container_class = [
        'blog-container',
        'blog-container-group',
        'blog-container-group-1'
    ];
    
    $class = [
        'wi-blog',
        'fox-blog',
        'blog-group',
        'blog-group-1',
        'post-group-row',
        
        // legacy
        'wi-newsblock',
        'newsblock-1',
    ];
    
    /**
     * big position
     */
    if ( 'right' != $fn_params[ 'group1_big_position' ] ) {
        $fn_params[ 'group1_big_position' ] = 'left';
    }
    $class[] = 'big-post-' . $fn_params[ 'group1_big_position' ];
    
    /**
     * big ratio
     */
    if ( ! in_array( $fn_params[ 'group1_big_ratio' ], [ '3/4', '1/2' ] ) ) $fn_params[ 'group1_big_ratio' ] = '2/3';
    $class[] = 'big-post-ratio-' . str_replace( '/', '-', $fn_params[ 'group1_big_ratio' ] );
    
    /**
     * number of big posts
     * @since 4.7.2
     */
    $big_number = intval( $fn_params[ 'group1_big_number' ] );
    if ( ! $big_number ) {
        $big_number = 1;
    }
    
    /**
     * small display
     */
    $small_display = $fn_params[ 'group1_small_display' ];
    if ( 'grid' != $small_display ) {
        $small_display = 'list';
    }
    $small_column = intval( $fn_params[ 'group1_small_column' ] );
    if ( 2 != $small_column ) {
        $small_column = 1;
    }
    
    /**
     * spacing
     */
    $class[] = 'post-group-spacing-' . $fn_params[ 'group1_spacing' ];
    
    /**
     * sep border
     */
    $sep_border_css = [];
    if ( $fn_params[ 'group1_sep_border' ] ) {
        $class[] = 'has-border';
    }
    if ( $fn_params[ 'group1_sep_border_color' ] ) {
        $sep_border_css[] = 'color:' . $fn_params[ 'group1_sep_border_color' ];
    }
    $sep_border_css = join( ';', $sep_border_css );
    if ( ! empty( $sep_border_css ) ) {
        $sep_border_css = ' style="' . esc_attr( $sep_border_css ) . '"';
    }
    
    /**
     * vertical spacing
     */
    $small_post_list_spacing = $fn_params[ 'group1_small_list_spacing' ];
    if ( ! in_array( $small_post_list_spacing, [ 'none', 'tiny', 'small', 'normal', 'medium', 'large' ] ) ) {
        $small_post_list_spacing = 'normal';
    }
    $class[] = 'v-spacing-' . $small_post_list_spacing;
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    /**
     * collecting
     */
    $big = [];
    $small = [];
    
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>

    <?php 
    $count = 0;
    while ( $query->have_posts() ) : $query->the_post(); $count++; $big_post = ( 1 == $count ); ?>
        
        <?php
    
    $params = $fn_params;
    $params[ 'count' ] = $count;
    
            /* BIG POST
            -------------------- */
            if ( $count <= $big_number ) {
                
                $prefix = 'group1_big_';
                
                $copy_big_params = $fn_params;
                foreach ( $fn_params as $k => $v ) {
                    if ( substr( $k, 0, 11 ) == 'group1_big_' ) {
                        $copy_big_params[ substr( $k, 11 ) ] = $v;
                    }
                }
                
                // fixed params due to desgin
                $copy_big_params[ 'post_extra_class' ] = 'article-big';
                $copy_big_params[ 'layout' ] = 'grid';
                $copy_big_params[ 'column' ] = 1;
                
                $copy_big_params[ 'thumbnail_index' ] = false;
                $copy_big_params[ 'thumbnail_format_indicator' ] = true;
                
                // show/hide components
                $copy_big_params = wp_parse_args( fox_component_to_show( $fn_params[ 'group1_big_components' ] ), $copy_big_params );
                
                $copy_big_params = fox_justify_params( $copy_big_params );
                
                ob_start();
                get_template_part( 'content/post', 'grid', $copy_big_params );
                $big[] = ob_get_clean();
    
        ?>
        
        
        
        <?php
    
            /* SMALL POST
            -------------------- */
            } else { // small posts
                
                $prefix = 'group1_small_';
                
                $copy_small_params = $fn_params;
                foreach ( $fn_params as $k => $v ) {
                    if ( substr( $k, 0, 13 ) == 'group1_small_' ) {
                        $copy_small_params[ substr( $k, 13 ) ] = $v;
                    }
                }
                
                // fixed params due to desgin
                $copy_small_params[ 'post_extra_class' ] = 'article-small-' . $small_display;
                $copy_small_params[ 'layout' ] = 'list';
                $copy_small_params[ 'live' ] = false;
                $copy_small_params[ 'list_mobile_layout' ] = 'list';
                
                // show/hide components
                $copy_small_params = wp_parse_args( fox_component_to_show( $fn_params[ 'group1_small_components' ] ), $copy_small_params );
                
                // forced
                $copy_small_params[ 'layout' ] = $small_display;
                $copy_small_params[ 'column' ] = $small_column;
                
                $copy_small_params = fox_justify_params( $copy_small_params );
                
                ob_start();
                get_template_part( 'content/post', $small_display, $copy_small_params );
                $small[] = ob_get_clean();
        
            } // big or small post
            
            do_action( 'fox_after_render_post' );
            endwhile;
        
        ?>
    
        <div class="post-group-col post-group-col-big article-big-wrapper">
            
            <?php echo join( "\n", $big ); ?>
            
        </div><!-- .post-group-col -->
        
        <div class="post-group-col post-group-col-small article-small-wrapper">
            
            <?php if ( 'grid' == $small_display ) { ?>
            <div class="blog-grid spacing-small fox-grid column-<?php echo $small_column; ?>">
                <?php echo join( "\n", $small ); ?>
            </div>
            <?php } else { ?>
            <?php echo join( "\n", $small ); ?>
            <?php } ?>
            
        </div><!-- .post-group-col -->
        
        <?php if ( $fn_params[ 'group1_sep_border' ] ) { ?>
        <div class="sep-border"<?php echo $sep_border_css; ?>></div>
        <?php } ?>

    </div><!-- .wi-newsblock -->
    
</div><!-- .blog-container-group -->

<?php
    
}

/**
 * Blog Group 2
 *
 * @since 4.4
 * ------------------------------------------------------------------------------------------------
 */
function fox_blog_group_2( $fn_params, $query ) {
    
    $container_class = [
        'blog-container',
        'blog-container-group',
        'blog-container-group-2'
    ];
    
    $class = [
        'wi-blog',
        'fox-blog',
        'blog-group',
        'blog-group-2',
        'post-group-row',
        
        // legacy
        'newsblock-2',
    ];
    
    /**
     * columns order
     */
    $class[] = 'post-group-row-' . $fn_params[ 'group2_columns_order' ];
    
    $explode = explode( '-', $fn_params[ 'group2_columns_order' ] );
    $big_order = 1 + array_search( '1a', $explode );
    $small_order = 1 + array_search( '3', $explode );
    $tall_order = 1 + array_search( '1b', $explode );
    
    $class[] = 'big-order-' . $big_order;
    $class[] = 'small-order-' . $small_order;
    $class[] = 'tall-order-' . $tall_order;
    
    /**
     * partition of posts
     */
    $big_number = intval( $fn_params[ 'group2_big_number' ] );
    if ( !$big_number ) {
        $big_number = 1;
    }
    $medium_number = intval( $fn_params[ 'group2_medium_number' ] );
    if ( ! $medium_number ) {
        $medium_number = 1;
    }
    
    /**
     * small displayed as:
     * @since 4.7.2
     */
    $group2_small_display = $fn_params[ 'group2_small_display' ];
    if ( 'list' != $group2_small_display ) {
        $group2_small_display = 'grid';
    }
    
    /**
     * spacing
     */
    $class[] = 'post-group-spacing-' . $fn_params[ 'group2_spacing' ];
    
    /**
     * sep border
     */
    $sep_border_css = [];
    if ( $fn_params[ 'group2_sep_border' ] ) {
        $class[] = 'has-border';
    }
    if ( $fn_params[ 'group2_sep_border_color' ] ) {
        $sep_border_css[] = 'color:' . $fn_params[ 'group2_sep_border_color' ];
    }
    $sep_border_css = join( ';', $sep_border_css );
    if ( ! empty( $sep_border_css ) ) {
        $sep_border_css = ' style="' . esc_attr( $sep_border_css ) . '"';
    }
    
    /**
     * color
     */
    $css_str = '';
    $id_attr = '';
    $color = trim( $fn_params[ 'color' ] );
    if ( $color ) {
        $class[] = 'blog-custom-color';
        $unique_id = uniqid( 'blog-' );
        $id_attr = ' id="' . esc_attr( $unique_id ) . '"';
        $css_str = '<style type="text/css">#' . $unique_id . '{color:' . esc_html( $color ). ';}</style>';
    }
    
    // collecting HTML
    $big = [];
    $medium = [];
    $small = [];
    ?>

<?php echo $css_str; ?>

<div class="<?php echo esc_attr( join( ' ', $container_class ) ); ?>">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $id_attr; ?>>

    <?php 
    $count = 0;
    while ( $query->have_posts() ) : 
    
        $query->the_post(); $count++;
    
        $params = $fn_params;
        $params[ 'count' ] = $count;
    
            /* BIG POST
            -------------------- */
            if ( 1 <= $count && $count <= $big_number ) {
                
                $prefix = 'group2_big_';
                
                $copy_params = $fn_params;
                foreach ( $fn_params as $k => $v ) {
                    if ( substr( $k, 0, 11 ) == 'group2_big_' ) {
                        $copy_params[ substr( $k, 11 ) ] = $v;
                    }
                }
                
                // fixed params due to desgin
                $copy_params[ 'post_extra_class' ] = 'article-big';
                $copy_params[ 'layout' ] = 'grid';
                $copy_params[ 'column' ] = 1;
                
                $copy_params[ 'thumbnail_index' ] = false;
                $copy_params[ 'thumbnail_format_indicator' ] = true;
                
                // show/hide components
                $copy_params = wp_parse_args( fox_component_to_show( $fn_params[ 'group2_big_components' ] ), $copy_params );
                
                $copy_params = fox_justify_params( $copy_params );
                
                ob_start();
                get_template_part( 'content/post', 'grid', $copy_params );
                $big[] = ob_get_clean();
    
            /* TALL POST / OR WE CALL MEDIUM POST
            -------------------- */
            } elseif ( $big_number < $count && $count <= ( $big_number + $medium_number ) ) {
                
                $prefix = 'group2_medium_';
                
                $copy_params = $fn_params;
                foreach ( $fn_params as $k => $v ) {
                    if ( substr( $k, 0, 14 ) == 'group2_medium_' ) {
                        $copy_params[ substr( $k, 14 ) ] = $v;
                    }
                }
                
                // fixed params due to desgin
                $copy_params[ 'post_extra_class' ] = 'article-tall article-medium';
                $copy_params[ 'layout' ] = 'grid';
                $copy_params[ 'column' ] = 1;
                
                $copy_params[ 'thumbnail_index' ] = false;
                $copy_params[ 'thumbnail_format_indicator' ] = true;
                
                // show/hide components
                $copy_params = wp_parse_args( fox_component_to_show( $fn_params[ 'group2_medium_components' ] ), $copy_params );
                
                $copy_params = fox_justify_params( $copy_params );
                
                ob_start();
                get_template_part( 'content/post', 'grid', $copy_params );
                $medium[] = ob_get_clean();
                
            } else { // small posts 
    
                $prefix = 'group2_small_';
                
                $copy_params = $fn_params;
                foreach ( $fn_params as $k => $v ) {
                    if ( substr( $k, 0, 13 ) == 'group2_small_' ) {
                        $copy_params[ substr( $k, 13 ) ] = $v;
                    }
                }
                
                // fixed params due to desgin
                $copy_params[ 'post_extra_class' ] = 'article-small article-small-' . $group2_small_display;
                $copy_params[ 'layout' ] = 'grid';
                $copy_params[ 'column' ] = 1;
                
                $copy_params[ 'thumbnail_index' ] = false;
                $copy_params[ 'thumbnail_format_indicator' ] = true;
                
                // show/hide components
                $copy_params = wp_parse_args( fox_component_to_show( $fn_params[ 'group2_small_components' ] ), $copy_params );
                
                // forced
                if ( 'list' == $group2_small_display ) {
                    $copy_params[ 'layout' ] = 'list';
                    $copy_params[ 'thumbnail_width' ] = 75;
                }
                
                $copy_params = fox_justify_params( $copy_params );
                
                ob_start();
                get_template_part( 'content/post', $group2_small_display, $copy_params );
                $small[] = ob_get_clean();
            
            } // big or small post
            
            do_action( 'fox_after_render_post' );
    
            endwhile; // have_posts 
        
        ?>
        
        <div class="post-group-col post-group-col-big article-col-big">
            
            <?php echo join( "\n", $big ); ?>
            
        </div><!-- .post-group-col -->
        
        <div class="post-group-col post-group-col-tall article-col-tall">
            
            <?php echo join( "\n", $medium ); ?>
            
        </div><!-- .post-group-col -->
        
        <div class="post-group-col post-group-col-small article-col-small">
            
            <?php echo join( "\n", $small ); ?>
            
        </div><!-- .post-group-col -->
        
        <?php if ( $fn_params[ 'group2_sep_border' ] ) { ?>
        
        <div class="sep-border line1"<?php echo $sep_border_css; ?>></div>
        <div class="sep-border line2"<?php echo $sep_border_css; ?>></div>
        
        <?php } ?>

    </div><!-- .wi-newsblock -->
    
</div><!-- .blog-container-group -->
<?php
    
}

/**
 * helper function
 *
 * $components is an array of components by multicheckbox control
 * @since 4.4
 * ------------------------------------------------------------------------------------------------
 */
function fox_component_to_show( $components ) {
    
    $show_params = [];
    
    if ( ! is_array( $components ) ) {
        $coms = explode( ',', $components );
        $coms = array_map( 'trim', $coms );
    } else {
        $coms = $components;
    }
    
    $possible_components = [
        'thumbnail',
        'title',
        'date',
        'category',
        'author',
        'author_avatar',
        'excerpt', 
        'excerpt_more', 
        'reading_time',
        'comment_link',
        'view',
        'share',
        'related',
    ];
    foreach ( $possible_components as $com ) {
        $show_params[ $com . '_show' ] = in_array( $com, $coms );
    }
    $show_params[ 'excerpt_more' ] = in_array( 'excerpt_more', $coms );
    
    return $show_params;
    
}

/**
 * pagination
 * @since 4.0
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fox_pagination' ) ) :
function fox_pagination( $query = false ) {
    
    if ( ! $query ) {
        global $wp_query;
        $query = $wp_query;
    }
    
    $prev_label = fox_word( 'previous' );
    $next_label = fox_word( 'next' );
    
    $big = 9999; // need an unlikely integer
    
    $paged = ( is_front_page() && ! is_home() ) ? get_query_var( 'page' ) : get_query_var( 'paged' );
    
	$pagination = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $query->max_num_pages,
		'type'			=> 'plain',
		'before_page_number'	=>	'<span>',
		'after_page_number'	=>	'</span>',
		'prev_text'    => '<span>' . $prev_label . '</span>',
		'next_text'    => '<span>' . $next_label . '</span>',
	) );
    
    /**
     * since 4.6.2
     */
    $pagination_style = get_theme_mod( 'wi_pagination_style', '1' );
    $class = [ 'wi-pagination', 'fox-pagination', 'font-heading' ];
    $class[] = 'pagination-' . $pagination_style;
    
    if ( $pagination ) {
        
        echo '<div class="' . esc_attr( join( ' ', $class ) ) .'"><div class="pagination-inner">' . $pagination  . '</div></div>';
        
	}

}
endif;