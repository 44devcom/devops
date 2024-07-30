<?php
/**
 * Builder Class
 *
 * @since 4.5
 */
class Fox_Builder {
    
    function __init__() {
    }
    
    /**
     * $sections is an array of section option values
     */
    function render( $sections ) {
        
        $builder_class = [
            'all-sections', 'wi-homepage-builder', 'wi-content'
        ];

        // since 4.3
        $section_spacing = get_theme_mod( 'wi_section_spacing', 'small' );
        $builder_class[] = 'sections-spacing-' . $section_spacing;

        ?>
        <div id="wi-bf" class="<?php echo esc_attr( join( ' ', $builder_class ) ); ?>">
            
            <?php
        
        /**
         * Back compat features
         */
        $show_on_paged = true;
        if ( 'false' == get_theme_mod( 'wi_builder_paged', 'true' ) ) {
            if ( is_front_page() ) {
                if ( get_query_var( 'paged' ) ) { $show_on_paged = false; }
            } else {
                if ( get_query_var( 'page' ) ) { $show_on_paged = false; }
            }
        }
        
        $count = -1;
        
        foreach ( $sections as $section ) {
            
            $count += 1;
            
            $section = wp_parse_args( $section, [
                
                'id' => '',
                'layout' => '',
                'visibility' => 'true',
                
                'shortcode' => '',
                
                'page' => '',
                
                'main_sidebar' => '',
                'sidebar_layout' => '',
                
                // sidebar
                'sidebar' => '',
                'sidebar_position' => 'right',
                'sidebar_sticky' => 'false',
                'sidebar_sep' => 'false',
                'sidebar_sep_color' => '',
                
                // design
                'section_id' => '',
                'class' => '',
                'text_color' => '',
                'background' => '',
                'stretch' => '',
                'border' => '',
                'section_visibility' => '',
                
            ] );
            
            // it's disabled for future use
            if ( false === $section[ 'visibility' ] || 'false' === $section[ 'visibility' ] ) {
                continue;
            }
            
            $layout = isset( $section[ 'layout' ] ) ? $section[ 'layout' ] : '';
            
            $c_params = fox_customize_params( $layout );
            
            if ( '' == $section[ 'id' ] ) {
                $section[ 'id' ] = $count;
            }
            
            /**
             * Case Main Blog
             */
            if ( $section[ 'id' ] && 'norm' == $section[ 'id' ] ) {
                
                global $wp_query;
                $query = $wp_query;
                foreach ( $c_params as $k => $v ) {
                    $section[ $k ] = $v;
                }
                
                // main always has pagination
                $section[ 'pagination' ] = true;
                
                
                
            } else {
            
                if ( ! $show_on_paged ) {
                    continue;
                }
                
                $query_args = $section;
                
                /**
                 * process a bit problem with custom taxonomy
                 */
                $tax_query = [];
                for ( $j = 1; $j <=2; $j++ ) {
                    if ( isset( $query_args[ 'tax_' . $j ] ) && $query_args[ 'tax_' . $j ] && isset( $query_args[ 'tax_' . $j . '_value' ] ) && $query_args[ 'tax_' . $j . '_value' ] ) {
                        
                        $terms = $query_args[ 'tax_' . $j . '_value' ];
                        $terms = explode( ',', $terms );
                        $terms = array_map( 'trim', $terms );
                        $tax_query[] = [
                            'taxonomy' => $query_args[ 'tax_' . $j ],
                            'field'    => 'name',
                            'terms'    => $terms,
                        ];
                        
                    }
                }
                
                $query_args[ 'tax_query' ] = $tax_query;
                
                /**
                 * unique reading problem
                 */
                $query_args[ 'unique_posts' ] = get_theme_mod( 'wi_unique_reading', 'false' ) == 'true' ? true : false;
                
                $query = fox_query( $query_args );
                
            }
            
            $section_class = [ 'wi-section', 'fox-section', 'section-layout-' . $layout ];
            $section_attrs = [];
            $html_inner = '';
            
            if ( $section[ 'class' ] ) {
                $section_class[] = $section[ 'class' ];
            }
            if ( $section[ 'section_id' ] ) {
                $section_attrs[] = 'id="' . esc_attr( $section[ 'section_id' ] ) . '"';
            }
            
            /* 
             * Color
             */
            $section_css = [];
            if ( $section[ 'background' ] ) {
                $section_css[] = 'background-color:' . $section[ 'background' ];
                $section_class[] = 'has-background';
            }
            if ( $section[ 'text_color' ] ) {
                $section_css[] = 'color:' . $section[ 'text_color' ];
                $section_class[] = 'custom-color';
            }
            
            /**
             * stretch
             */
            $stretch = $section[ 'stretch' ];
            if ( 'full' != $stretch && 'narrow' != $stretch ) {
                $stretch = 'content';
            }
            $section_class[] = 'section-stretch-' . $stretch;

            /**
             * Border
             */
            $border = $section[ 'border' ];
            if ( $border ) {
                $section_class[] = 'has-border';
                $section_class[] = 'section-border-' . $border;
            }
            
            /**
             * visibility
             */
            $section_visibility = $section[ 'section_visibility' ];
            if ( '' == $section_visibility ) {
                $section_visibility = 'desktop,tablet,mobile';
            }
            if ( is_string( $section_visibility ) ) {
                $section_visibility = explode( ',', $section_visibility );
            }
            if ( empty( $section_visibility ) ) {
                $section_visibility = [ 'desktop', 'tablet', 'mobile' ];
            }
            $section_visibility_classes = fox_visibility_class( $section_visibility );
            $section_class = array_merge( $section_class, $section_visibility_classes );
            
            /**
             * Sidebar
             * @since 4.3
             */
            $secondary_sidebar = $section[ 'sidebar' ];
            if ( $secondary_sidebar ) {

                $section_class[] = 'section-has-sidebar';

                // sidebar position
                $sidebar_position = $section[ 'sidebar_position' ];
                if ( 'left' != $sidebar_position ) {
                    $sidebar_position = 'right';
                }
                $section_class[] = 'section-sidebar-' . $sidebar_position;

                // sidebar sticky
                if ( 'true' == $section[ 'sidebar_sticky' ] ) {
                    $section_class[] = 'section-sidebar-sticky';
                }

            } else {

                $section_class[] = 'section-fullwidth';

            }
            
            /**
             * Heading
             */
            $heading = isset( $section[ 'heading'] ) ? $section[ 'heading'] : '';
            $heading = trim( $heading );
            if ( '' != $heading ) {
                $section_class[] = 'section-has-heading';
            }
            $heading_params = [
                'heading' => $heading,
                'heading_empty' => isset( $section[ 'heading_empty' ] ) ? $section[ 'heading_empty' ] : false,
                
                'url' => isset( $section[ 'viewall_link' ] ) ? $section[ 'viewall_link' ] : '',
                
                // since 4.6.5
                'link_position' => isset( $section[ 'viewall_link_position' ] ) ? $section[ 'viewall_link_position' ] : '',
                'link_text' => isset( $section[ 'viewall_link_text' ] ) ? $section[ 'viewall_link_text' ] : '',
                
                'target' => '_self',

                'color' => isset( $section[ 'heading_color' ] ) ? $section[ 'heading_color' ] : '',
                'section_id' => $section[ 'id' ],
            ];

            $heading_props = [
                'align' => 'center', 
                'style' => '1a',
                'line_stretch' => 'content',
                'size' => 'large', 
            ];
            foreach ( $heading_props as $prop => $std ) {
                $get = isset( $section[ 'heading_' . $prop ] ) ? $section[ 'heading_' . $prop ] : '';
                if ( ! $get ) {
                    $get = get_theme_mod( "wi_builder_heading_{$prop}", $std );
                }
                $heading_params[ $prop ] = $get;
            }
            
            /**
             * Ad & Banner
             */
            $ad_visibility = isset( $section[ 'ad_visibility' ] ) ? $section[ 'ad_visibility' ] : '';
            $visibility_class = fox_visibility_class( $ad_visibility );
            
            $ad_params = wp_parse_args( $section, [
                'ad_code' => '',
                'banner' => '',
                'banner_width' => '',
                'banner_tablet' => '',
                'banner_tablet_width' => '',
                'banner_mobile' => '',
                'banner_mobile_width' => '',
                'banner_url' => '',
            ]);
            
            /**
             * Final Wrapper
             */
            if ( $section_css ) {
                $section_attrs[] = 'style="' . esc_attr( join( ';', $section_css ) ) . '"';
            }
            $section_attrs[] = 'class="' . esc_attr( join( ' ', $section_class ) ). '"';
            $section_attrs[] = 'data-id="' . esc_attr( $section[ 'id' ] ) . '"';
            
            echo '<div ' . join( ' ', $section_attrs ) . '>';
            
            fox_ad([
                'code' => $ad_params[ 'ad_code' ],
                'image' => $ad_params[ 'banner' ],
                'width' => $ad_params[ 'banner_width' ],

                'tablet' => $ad_params[ 'banner_tablet' ],
                'tablet_width' => $ad_params[ 'banner_tablet_width' ],

                'phone' => $ad_params[ 'banner_mobile' ],
                'phone_width' => $ad_params[ 'banner_mobile_width' ],

                'url' => $ad_params[ 'banner_url' ],
                'extra_class' => 'section-ad ' . join( ' ', $visibility_class ),
            ]);
            
            fox_section_heading( $heading_params );
            
            $theiaStickySidebar = $secondary_sidebar ? '<div class="theiaStickySidebar">' : '';
            $theiaStickySidebar_close = $secondary_sidebar ? '</div><!-- .theiaStickySidebar -->' : '';
            echo '<div class="container"><div class="section-container"><div class="section-primary">' . $theiaStickySidebar ;
            
            /**
             * Now The Main Content
             */
            
            /* Shortcode
            ------------------------ */
            if ( 'shortcode' == $layout ) {
                
                $shortcode = trim( $section[ 'shortcode' ] );
                
                ob_start();
                echo '<div class="section-shortcode">';
                echo do_shortcode( $shortcode );
                // echo '<div class="clearfix"></div>';
                echo '</div>';
                
                $html_inner = ob_get_clean();
                
            /* Sidebar
            ------------------------ */    
            } elseif ( 'sidebar' == $layout ) {
                
                ob_start();
                    
                $sidebar_html = '';
                $sidebar = $section[ 'main_sidebar' ];
                if ( ! $sidebar ) {

                    echo fox_err( 'Please choose a sidebar to display' );

                } else {

                    if ( ! is_active_sidebar( $sidebar ) ) {

                        if ( current_user_can( 'administrator' ) ) {
                            echo fox_err( 'Your sidebar is currently empty. Please go to <strong>Appearance > Widgets</strong> to drop widgets there!' );
                        }

                    } else {

                        $sidebar_cl = [ 'main-section-sidebar' ];

                        $sidebar_layout = $section[ 'sidebar_layout' ];
                        if ( ! in_array( $sidebar_layout, [ '1', '2', '3', '4' ] ) ) {
                            $sidebar_layout = '3';
                        }
                        $sidebar_cl[] = 'main-section-sidebar-' . $sidebar_layout;

                        echo '<div class="' . esc_attr( join( ' ', $sidebar_cl ) ) . '"><div class="section-sidebar-inner">';

                        dynamic_sidebar( $sidebar );

                        echo '</div></div>';

                    }


                }
                
                $html_inner = ob_get_clean();
               
            /* Page
            ------------------------ */    
            } elseif ( 'page' == $layout ) {
                
                ob_start();
                
                $page_id = $section[ 'page' ];
                $page_id = str_replace( 'page_', '', $page_id );
                
                // we should use WP_Query instead of get_post
                // so that we can pass the_content instead of get_the_content
                $query = new WP_Query([
                    'p' => $page_id,
                    'post_type' => 'page',
                    'post_status' => 'publish',
                ]);
                
                if ( $query->have_posts() ) {
                    while( $query->have_posts() ) {
                        $query->the_post();
                        echo '<div class="section-page-content">';
                        the_content();
                        // echo '<div class="clearfix"></div>';
                        echo '</div>';
                    }
                }
                wp_reset_query();
                
                $html_inner = ob_get_clean();
                
            } else {
            
                ob_start();
                
                /**
                 * --------------------------------------------------------
                 * 01 - if fn_param is inherit then set it to customize value
                 * --------------------------------------------------------
                 * if '' == $v then it means it's inherit value
                 * we'll set it the the main blog value
                 */
                $fn_params = $c_params;
                foreach ( $section as $k => $v ) {
                    
                    // set it clear
                    if ( '' != $v ) {
                        $fn_params[ $k ] = $v;
                    }
                }
                
                /* --------------------------------------------------------
                 * 02 - components problem
                 * -------------------------------------------------------- */
                $customize_components = isset( $section[ 'customize_components' ] ) ? $section[ 'customize_components' ] : 'false';
                if ( 'true' == $customize_components ) {
                    $components = isset( $section[ 'components' ] ) ? $section[ 'components' ] : 'thumbnail,title,date,category,excerpt';
                    if ( ! is_array( $components ) ) {
                        $components = explode( ',', $components );
                        $components = array_map( 'trim', $components );
                    }
                } else {
                    $components = $c_params[ 'components' ];
                }
                $fn_params[ 'components' ] = $components;
                
                fox_blog( $fn_params, $query );
                
                $html_inner = ob_get_clean();
                
            }

            echo $html_inner;
            
            /**
             * End of Main
             */
            echo $theiaStickySidebar_close . '</div><!-- .section-primary -->';
                
            /**
             * The Sidebar
             */
            if ( $secondary_sidebar ) { ?>

                <aside class="section-secondary section-sidebar">

                    <div class="theiaStickySidebar">

                        <div class="widget-area">
                            
                            <?php dynamic_sidebar( $secondary_sidebar ); ?>
                            
                            <div class="gutter-sidebar"></div>
                            
                        </div><!-- .widget-area -->

                    </div><!-- .theiaStickySidebar -->

                </aside><!-- .section-secondary -->

            <?php if ( 'true' == $section[ 'sidebar_sep' ] ) {
                    $section_sep_css = '';
                    $section_sep_color = $section[ 'sidebar_sep_color' ];
                    if ( $section_sep_color ) {
                        $section_sep_css = ' style="color:' . esc_attr( $section_sep_color ) . '"';
                    }
                ?>
                
                <div class="section-sep"<?php echo $section_sep_css; ?>></div>
                
                <?php } ?>

                <?php }

            echo '</div><!-- .section-container --></div><!-- .container --></div><!-- .fox-section -->';

        } // each $section
        
        ?>

        </div><!-- #wi-bf -->
        
<?php
    }
    
}

function fox_builder_fields() {
    
    // layout
    $layout_arr = [
        
        'standard'              =>  'Standard',
        'grid'                  =>  'Grid',
        'masonry'               =>  'Pinterest-like (Masonry)',
        'list'                  =>  'List',
        'newspaper'             =>  'Newspaper',
        'vertical'              => 'Vertical post',
        'big'                   => 'Big Post',
        'group-1'               => 'Post Group 1',
        'group-2'               => 'Post Group 2',
        'slider'                => 'Classic Slider',
        'slider-1'              => 'Slider Style 1',
        'slider-3'              => 'Carousel',
        
        'shortcode' => 'A Shortcode',
        'sidebar' => 'A custom sidebar',
        'page' => 'A Page Content',
        
    ];
    
    $sidebar_list = [ '' => '--- NONE ---' ];
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
    }
    
    // pages
    $page_arr = [ '' => '--- NONE ---'];
    $pages = get_posts( 'posts_per_page=-1&post_type=page&orderby=name&order=asc' );
    foreach ( $pages as $page ) {
        $page_arr[ 'page_' . $page->ID ] = $page->post_title;
    }
    
    $fields = [
        
        /* Display what?
        --------------------------------------------------------------------------- */
        'layout' => [
            'type' => 'select',
            'options' => $layout_arr,
            'std' => 'slider',
            'name' => 'Display?',
            
            'toggle' => [
                'shortcode' => [ 'shortcode' ],
                'sidebar' => [ 'main_sidebar', 'sidebar_layout' ],
                'page' => [ 'page' ],
            ],
        ],
        
        'shortcode' => [
            'type' => 'textarea',
            'name' => 'Enter Shortcode',
            'placeholder' => 'Eg. [author_grid number=3 column=3 /]',
        ],
        
        'main_sidebar' => [
            'type' => 'select',
            'name' => 'Choose Sidebar',
            'desc'   => 'Go to <a href="' . admin_url( 'admin.php?page=sidebar-manager' ) . '" target="_blank">Dashboard > Fox Magazine > Sidebar Manager</a> to create your custom sidebar then it\'ll appear in this list',
            
            'options'   => $sidebar_list,
            'std'       => '',
        ],
        
        'sidebar_layout' => [
            'name'    => 'Widgets Layout',
            'type'     => 'image_radio',
            'options'   => [
                '1' => [
                    'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1-col.jpg',
                    'width' => '100',
                    'height' => 'auto',
                    'title' => 'Fullwidth',
                ],
                '2' => [
                    'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2-cols.jpg',
                    'width' => '100',
                    'height' => 'auto',
                    'title' => '2 columns',
                ],
                '3' => [
                    'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/3-cols.jpg',
                    'width' => '100',
                    'height' => 'auto',
                    'title' => '3 columns',
                ],
                '4' => [
                    'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/4-cols.jpg',
                    'width' => '100',
                    'height' => 'auto',
                    'title' => '4 columns',
                ],
            ],
            'std'       => '3',
            'desc'      => 'If you have 3 columns, please use 3 widgets in your sidebar',
        ],
        
        'page' => [
            'name' => 'Choose page content of',
            'type' => 'select',
            'options' => $page_arr,
            'std' => '',
        ]
        
    ];
    
    $fields += fox_builder_layout_options();
    $fields += fox_builder_query_options(); // done56
    $fields += fox_builder_heading_options();
    $fields += fox_builder_ad_options();
    $fields += fox_builder_design_options();
    
    // default tab
    foreach ( $fields as $k => $v ) {
        if ( is_array( $v ) && ! isset( $v['tab'] ) ) {
            $v['tab'] = 'layout';
            $fields[ $k ] = $v;
        }
        
        // this means this option applies for only some layouts
        if ( isset( $v[ 'layout' ] ) ) {
            if ( is_string( $v[ 'layout' ] ) ) {
                $v[ 'layout' ] = [ $v[ 'layout' ] ];
            }
            foreach ( $v[ 'layout' ] as $l ) {
                $fields[ 'layout' ][ 'toggle' ][ $l ][] = $k;
            }
        }
    }
    
    return apply_filters( 'fox_builder_fields', $fields );
    
}

/**
 * Returns the builder data
 */
function fox_builder_data() {
    
    $data = get_theme_mod( 'wi_home_builder', '' );
    $data_arr = json_decode( $data, true );
    if ( ! is_array( $data_arr ) ) {
        $data_arr = [];
    }
    
    if ( empty( $data_arr ) ) {
        
        /**
         * Backward compatibility to old versions
         */
        $old_sections = [];
        $section_info = fox_builder_section_info();

        foreach ( $section_info[ 'sections_order' ] as $i ) {

            // we'll need to fill this array
            $old_section = [ 'visibility' => true ];

            $prefix = "bf_{$i}_";
            if ( 'main' == $i ) {
                $prefix = 'main_stream_';
            }

            /**
             * simple migration properties
             */
            $migration_arr = [
                'shortcode' => 'shortcode',
                'main_sidebar' => 'main_sidebar',
                'sidebar_layout' => 'sidebar_layout',

                // query options
                'number' => 'number',
                'cat_include' => 'categories',
                'cat_exclude' => 'exclude_categories',
                'authors' => 'authors',
                'orderby' => 'orderby',
                'order' => 'order',
                'offset' => 'offset',
                'custom_query' => 'custom_query',

                // layout
                'customize_components' => 'customize_components',
                'components' => 'components',

                // general
                'item_card' => 'item_card',
                'item_spacing' => 'item_spacing',
                'item_template' => 'item_template',
                'item_border' => 'item_border',
                'item_border_color' => 'item_border_color',
                'item_align' => [
                    'align',
                    'big_align',
                ],
                'color' => 'color',

                // thumbnail
                'thumbnail' => 'thumbnail',
                'thumbnail_custom' => 'thumbnail_custom',
                'thumbnail_position' => 'thumbnail_position',
                'thumbnail_shape' => 'thumbnail_shape',

                // title
                'title_size' => 'title_size',

                // excerpt
                'excerpt_length' => 'excerpt_length',
                'excerpt_more_style' => 'excerpt_more_style',
                'excerpt_more_text' => 'excerpt_more_text',
                'excerpt_size' => 'excerpt_size',

                // standard
                'content_excerpt' => [
                    'standard_content_excerpt',
                    'newspaper_content_excerpt',
                    'big_content_excerpt',
                ],

                // slider-1
                'slide_height' => 'slider1_height',
                'slide_content_color' => 'slider1_content_color',
                'slide_content_background' => 'slider1_content_background',
                'slide_content_background_opacity' => 'slider1_content_background_opacity',

                // group-1
                'big_post_position' => 'group1_big_position',
                
                // group-2
                'columns_order' => 'group2_columns_order',


                // heading
                'heading' => 'heading',
                'heading_color' => 'heading_color',
                'heading_style' => 'heading_style',
                'heading_line_stretch' => 'heading_line_stretch',
                'heading_align' => 'heading_align',
                'heading_size' => 'heading_size',
                'viewall_link' => 'viewall_link',

                // sidebar
                'sidebar' => 'sidebar',
                'sidebar_position' => 'sidebar_position',
                'sidebar_sticky' => 'sidebar_sticky',
                'sidebar_sep' => 'sidebar_sep',
                'sidebar_sep_color' => 'sidebar_sep_color',

                // ad
                'ad_code' => 'ad_code',
                'banner' => 'banner',
                'banner_width' => 'banner_width',

                'banner_tablet' => 'banner_tablet',
                'banner_tablet_width' => 'banner_tablet_width',

                'banner_mobile' => 'banner_mobile',
                'banner_mobile_width' => 'banner_mobile_width',

                'banner_url' => 'banner_url',
                'ad_visibility' => 'ad_visibility',

                // design
                'section_visibility' => 'section_visibility',
                'stretch' => 'stretch',
                'background' => 'background',
                'text_color' => 'text_color',
                'border' => 'border',

            ];
            $std_arr = [
                'sidebar_layout' => '3',
                'customize_components' => 'false',
                'sidebar_position' => 'right',
                'section_visibility' => 'desktop,tablet,mobile',
                'ad_visibility' => 'desktop,tablet,mobile',
                'stretch' => 'content',
            ];

            $main_stream_options = [
                'heading', 'heading_color', 'heading_style', 'heading_line_stretch', 'heading_align', 'heading_size', 'viewall_link',

                'sidebar_sticky', 'sidebar_sep', 'sidebar_sep_color',

                'ad_code', 'banner', 'banner_width', 'banner_tablet', 'banner_tablet_width', 'banner_mobile', 'banner_mobile_width', 'banner_url', 'ad_visibility',

                'section_visibility', 'stretch', 'background', 'text_color', 'border',
            ];

            $main_stream_migration_arr = [];
            foreach ( $main_stream_options as $k ) {
                $main_stream_migration_arr[ $k ] = $migration_arr[ $k ];
            }

            if ( 'main' == $i ) {
                $migration_arr = $main_stream_migration_arr;
            }

            foreach ( $migration_arr as $mod_key => $new_key ) {
                
                $std = isset( $std_arr[ $mod_key ] ) ? $std_arr[ $mod_key ] : '';

                if ( is_string( $new_key) ) {
                    $old_section[ $new_key ] = get_theme_mod( $prefix . $mod_key, $std );
                } elseif ( is_array( $new_key ) ) {
                    foreach ( $new_key as $new_key_item ) {
                        $old_section[ $new_key_item ] = get_theme_mod( $prefix . $mod_key, $std );
                    }
                }
                
                // image problem
                if ( in_array( $mod_key, [ 'banner', 'banner_tablet', 'banner_mobile' ] ) ) {
                    if ( $old_section[ $new_key ] ) {
                        $try_id = attachment_url_to_postid( $old_section[ $new_key ] );
                        if ( $try_id ) {
                            $old_section[ $new_key ] = $try_id;
                        }
                    }
                }

            }

            if ( 'main' != $i ) {
                /**
                 * complicated migration properties
                 */
                $layout = get_theme_mod( $prefix . 'layout', 'slider' );
                $source = get_theme_mod( $prefix . 'cat', '' );
                
                $old_section[ 'section_name' ] = get_theme_mod( $prefix . 'heading', '' );

                if ( 'shortcode' == $source || 'sidebar' == $source ) {

                    $old_section[ 'layout' ] = $source;

                } else {

                    // 01 - layout
                    if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {

                        $old_section[ 'layout' ] = 'grid';
                        $old_section[ 'column' ] = intval( str_replace( 'grid-', '', $layout ) );

                    } elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {

                        $old_section[ 'layout' ] = 'masonry';
                        $old_section[ 'column' ] = intval( str_replace( 'grid-', '', $layout ) );

                    } else {

                        $old_section[ 'layout' ] = $layout;
                        $old_section[ 'column' ] = 3;

                    }

                    // 02 - source
                     if ( ! $source || 'none' == $source ) continue;

                    /**
                     * old cat value before v3.0
                     */
                    if ( is_numeric( $source ) ) {
                        $cat_term = get_term( $source, 'category' );
                        if ( ! $cat_term ) continue;
                        $source = 'cat_' . $cat_term->slug;
                    }

                    // post type
                    // sticky
                    if ( $source == 'featured' ) {

                        $old_section[ 'featured' ] = true;

                    } elseif ( 'sticky' == $source ) {

                        $old_section[ 'sticky' ] = true;

                    } elseif ( $source == 'video' || $source == 'gallery' || $source == 'audio' || $source == 'link' ) {

                        $old_section[ 'format' ] = $source;

                    } elseif ( 'post_type_' === substr( $source, 0, 10 ) ) {

                        $post_type = substr( $source, 10 );
                        $old_section[ 'post_type' ] = $post_type;

                        $taxes = get_object_taxonomies( $post_type );
                        $tax_query = [];

                        foreach ( $taxes as $tax ) {

                            $terms = trim( get_theme_mod( "{$prefix}tax_{$tax}" ) );
                            if ( ! $terms ) continue;
                            $terms = explode( ',', $terms );
                            $terms = array_map( 'trim', $terms );
                            $tax_query[] = [
                                'taxonomy' => $tax,
                                'field'    => 'name',
                                'terms'    => $terms,
                            ];

                        }

                        if ( ! empty( $tax_query ) ) {
                            $old_section[ 'tax_query' ] = $tax_query;
                        }

                    } elseif ( 'all' != $source ) {

                        $old_section[ 'categories' ] = $source;

                    }

                }

            }

            if ( 'main' == $i ) {
                $old_section[ 'id' ] = 'norm';
                $old_section[ 'section_name' ] = 'Main Blog';
                
                if ( 'false' == get_theme_mod( 'wi_main_stream', 'true' ) ) {
                    $old_section[ 'visibility' ] = 'false';
                } else {
                    $old_section[ 'visibility' ] = 'true';
                }
            }

            // final
            $old_sections[] = $old_section;

        }
        
        // final result
        $data_arr = $old_sections;
        
    }
    
    // if norm not in the builder, force to add it
    $norm_section = [];
    $has_norm = false;
    foreach ( $data_arr as $section_data ) {
        if ( isset( $section_data[ 'id' ] ) && 'norm' == $section_data[ 'id' ] ) {
            $norm_section = $section_data;
            $has_norm = true;
            break;
        }
    }
    
    // now set default values
    $default_section = [
        'column' => '3',
        'first_standard' => 'false',
        'big_first_post' => 'true',
        'item_card' => 'none',
        'item_spacing' => 'normal',
        'item_template' => '1',
        'item_border' => 'false',
        'align' => 'left',
        'list_spacing' => 'normal',
        'list_sep' => 'true',
        'list_sep_style' => 'solid',
        'list_valign' => 'top',
        'list_mobile_layout' => 'grid',
        'thumbnail' => 'landscape',
        'thumbnail_placeholder' => 'true',
        'thumbnail_shape' => 'acute',
        'thumbnail_hover' => 'none',
        'thumbnail_showing_effect' => 'none',
        'thumbnail_components' => 'format_indicator',
        'thumbnail_position' => 'left',
        'title_tag' => 'h2',
        'title_size' => 'normal',
        'title_weight' => '',
        'title_text_transform' => '',
        'excerpt_hellip' => 'false',
        'excerpt_size' => 'normal',
        'excerpt_more' => 'true',
        'excerpt_more_style' => 'simple',
        
        'visibility' => 'true',
    ];
    foreach ( $default_section as $k => $v ) {
        if ( ! isset( $norm_section[ $k ] ) || ! $norm_section[ $k ] ) {
            $norm_section[ $k ] = $v;
        }
    }
    
    // set fixed value
    $norm_section[ 'id' ] = 'norm';
    $norm_section[ 'section_name' ] = 'Main Blog'; // forced
    $sidebar_state = get_theme_mod( 'wi_home_sidebar_state', 'sidebar-right' );
    if ( 'sidebar-left' == $sidebar_state || 'sidebar-right' == $sidebar_state ) {
        $norm_section[ 'sidebar' ] = 'sidebar'; // it must be this sidebar    
        $norm_section[ 'sidebar_position' ] = 'sidebar-left' == $sidebar_state ? 'left' : 'right';
    } else {
        $norm_section[ 'sidebar' ] = '';
    }
    
    $layout = get_theme_mod( 'wi_home_layout', 'list' );
    if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {

        $norm_section[ 'layout' ] = 'grid';
        $norm_section[ 'column' ] = intval( str_replace( 'grid-', '', $layout ) );

    } elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {

        $norm_section[ 'layout' ] = 'masonry';
        $norm_section[ 'column' ] = intval( str_replace( 'grid-', '', $layout ) );

    } else {

        $norm_section[ 'layout' ] = $layout;

    }
    
    // now reset the norm
    if ( ! $has_norm ) {
        
        $data_arr[] = $norm_section;
        
    } else {
        
        foreach ( $data_arr as $j => $section_data ) {
            if ( isset( $section_data[ 'id' ] ) && 'norm' == $section_data[ 'id' ] ) {
                $data_arr[ $j ] = $norm_section;
                break;
            }
        }
        
    }
    
    // finally, make it numeric array instead of associate array
    $data_arr = array_values( $data_arr );

    return $data_arr;
    
}

/**
 * return array of settings from the customizer
 * only for layout options, eg. layout, column, item_template..
 *
 * @since 4.5
 */
function fox_customize_params( $layout = '' ) {
    
    if ( ! $layout ) {
        $layout = get_theme_mod( 'wi_home_layout', 'list' );
    }
    $column = get_theme_mod( 'wi_column', '3' );
    if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
        $column = str_replace( 'grid-', '', $layout );
        $layout = 'grid';
    } elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
        $column = str_replace( 'masonry-', '', $layout );
        $layout = 'masonry';
    }
    
    $options = fox_customize_post_layout_options();
    
    foreach ( $options as $key => $option_data ) {
        
        $option_data = wp_parse_args( $option_data, [
            'name' => '',
            'std' => '',
            'type' => '',
        ]);
        
        $val = get_theme_mod( 'wi_' . $key, $option_data[ 'std' ] );
        
        if ( isset( $option_data[ 'options' ] ) && ( $option_data[ 'type' ] == 'select' || $option_data[ 'type' ] == 'radio' || $option_data[ 'type' ] == 'image_radio' ) ) {
            if ( ! isset( $option_data[ 'options' ][ $val ] ) ) {
                $val = $option_data[ 'std' ];
            }
        }
        
        $c_params[ $key ] = $val;
        
    }
    
    /**
     * append 2 more options: layout and sidebar
     */
    $c_params[ 'layout' ] = $layout;
    $c_params[ 'column' ] = $column;
    
    /**
     * we'll adjust customize params here correctly, according to the layout
     * $c_params[ 'thumbnail_position' ] = 'left'
     * $c_params[ 'vertical_thumbnail_position' ] = 'right'
     * $c_params[ 'layout' ] = 'vertical'
     
     * then set $c_params[ 'thumbnail_position' ] = 'right' instead
     */
    if ( 'vertical' == $layout ) {
        
        $c_params[ 'thumbnail_type' ] = $c_params[ 'vertical_thumbnail_type' ];
        $c_params[ 'thumbnail_position' ] = $c_params[ 'vertical_thumbnail_position' ];
        $c_params[ 'thumbnail_type' ] = $c_params[ 'vertical_thumbnail_type' ];
        $c_params[ 'excerpt_size' ] = $c_params[ 'vertical_excerpt_size' ];
        $c_params[ 'title_size' ] = 'large';
        $c_params[ 'thumbnail_shape' ] = 'acute';
        
    } elseif ( 'newspaper' == $layout ) {
        
        $c_params[ 'thumbnail_type' ] = $c_params[ 'newspaper_thumbnail_type' ];
        
    } elseif ( 'standard' == $layout ) {
        
        // $c_params[ 'standard_sep' ] = true;
        $c_params[ 'thumbnail_type' ] = $c_params[ 'standard_thumbnail_type' ];
        $c_params[ 'excerpt_length' ] = $c_params[ 'standard_excerpt_length' ];
        $c_params[ 'excerpt_more_style' ] = $c_params[ 'standard_excerpt_more_style' ];
        
    } elseif ( 'big' == $layout ) {
        
        $c_params[ 'excerpt_length' ] = -1;
        $c_params[ 'excerpt_size' ] = 'medium';
        $c_params[ 'title_size' ] = 'extra';
        $c_params[ 'excerpt_more' ] = true;
        $c_params[ 'components' ] = 'thumbnail,title,date,excerpt,excerpt_more';
        
    } elseif ( 'slider' == $layout ) {
        
        $c_params[ 'title_size' ] = 'large';
        $c_params[ 'align' ] = 'left';
        $c_params[ 'excerpt_color' ] = 'white';
        
        $c_params[ 'components' ] = 'thumbnail,title,date,excerpt,excerpt_more';
        
    } elseif ( 'slider-1' == $layout ) {
        
        $c_params[ 'title_size' ] = 'medium';
        $c_params[ 'slider_nav_style' ] = 'circle-1';
        
        $c_params[ 'components' ] = 'thumbnail,title,category,date,excerpt_more';
        $c_params[ 'excerpt_more_style' ] = 'fill';
        
    } elseif ( 'slider-3' == $layout ) {
        
        $c_params[ 'components' ] = 'thumbnail,title,category,date';
        $c_params[ 'title_size' ] = 'small';
        
    } elseif ( 'group-1' == $layout ) {
        
        $c_params[ 'group1_big_title_size' ] = 'medium';
        // $c_params[ 'group1_big_thumbnail' ] = 'thumbnail-large'; // original size
        $c_params[ 'group1_big_thumbnail_placeholder' ] = false;
        
        $c_params[ 'group1_small_title_size' ] = 'small';
        $c_params[ 'group1_small_excerpt_size' ] = 'small';
        // $c_params[ 'group1_small_excerpt_length' ] = 12;
        $c_params[ 'group1_small_excerpt_more_style' ] = 'simple';
        // $c_params[ 'group1_small_thumbnail' ] = 'landscape';
        $c_params[ 'group1_small_thumbnail_type' ] = 'simple';
        $c_params[ 'group1_small_thumbnail_position' ] = 'right';
        $c_params[ 'group1_small_thumbnail_placeholder' ] = false;
        $c_params[ 'group1_small_thumbnail_hover' ] = '';
        
        $c_params[ 'group1_small_thumbnail_index' ] = false;
        $c_params[ 'group1_small_thumbnail_review_score' ] = false;
        $c_params[ 'group1_small_thumbnail_format_indicator' ] = true;
        
    } elseif ( 'group-2' == $layout ) {
        
        // $c_params[ 'group2_big_title_size' ] = 'medium';
        $c_params[ 'group2_big_thumbnail_placeholder' ] = true;
        $c_params[ 'group2_big_thumbnail' ] = 'thumbnail-large'; // original size
        $c_params[ 'group2_big_thumbnail_index' ] = false;
        
        // $c_params[ 'group2_medium_title_size' ] = 'normal';
        $c_params[ 'group2_medium_align' ] = 'left';

        $c_params[ 'group2_medium_thumbnail_placeholder' ] = false;
        $c_params[ 'group2_medium_thumbnail_review_score' ] = false;
        $c_params[ 'group2_medium_excerpt_more_style' ] = 'simple';
        
        // $c_params[ 'group2_small_title_size' ] = 'small';
        $c_params[ 'group2_small_align' ] = 'left';
        $c_params[ 'group2_small_thumbnail' ] = 'landscape';
        $c_params[ 'group2_small_excerpt_more_style' ] = 'simple';
        $c_params[ 'group2_small_excerpt_size' ] = 'small';
        $c_params[ 'group2_small_thumbnail_review_score' ] = false;
        
    }
    
    return $c_params;
    
}

/* Builder Section Info
 * @since 4.4
------------------------------------------------------------------------------------ */
function fox_builder_section_info() {
    
    /**
     * problem 1: max_sections
     */
    $max_sections = get_theme_mod( 'wi_max_sections', '' );
    // it means it hasn't been changed yet
    if ( '' == $max_sections ) {
        $max = 6;
        for ( $i = 7 ; $i <= 10; $i++ ) {
            $display = get_theme_mod( 'bf_' . $i . '_cat' );
            if ( $display && 'none' != $display ) {
                $max = $i;
            }
        }
    } else {
        $max = absint( $max_sections );
    }
    if ( $max < 2 || $max > 40 ) $max = 10;
    $max_sections = $max;
    
    /**
     * problem 2: sections_order
     */
    $sections_order = get_theme_mod( 'wi_sections_order', '' );
    $sections_order = explode( ',', $sections_order );
    $sections_order = array_map( 'trim', $sections_order );
    
    $main_last = false;
    if ( count( $sections_order ) && 'main' == $sections_order[ count( $sections_order ) - 1 ] ) {
        $main_last = true;
    }
    
    $sections_order_without_main = [];
    $has_main = false;
    $valid = true;
    $prev_item = 0;
    $main_after = 0;
    foreach ( $sections_order as $item ) {
        if ( $item != 'main' ) {
            
            if ( ! is_numeric( $item ) ) {
                $valid = false;
            }
            $item = absint( $item );
            if ( $item > $max_sections ) continue;
            
            $sections_order_without_main[] = $item;
            $prev_item = $item;
        } else {
            $has_main = true;
            $main_after = $prev_item;
        }
    }
    
    $max = max( $sections_order_without_main );
    // in case we have not enough
    if ( $max < $max_sections ) {
        for ( $i = $max+1; $i <= $max_sections; $i++ ) {
            $sections_order_without_main[] = $i;
            $sections_order[] = $i;
        }
    }
    if ( $main_last ) {
        $main_after = 1000;
        $sections_order = $sections_order_without_main;
        $sections_order[] = 'main';
    }
    
    if ( ! $has_main ) {
        $valid = false;
    }
    
    /**
     * problem 3: main_stream_order fallback
     * deprecated since 4.4
     *
    $main_stream_order = get_theme_mod( 'wi_main_stream_order', '' );
    */
    
    /**
     * if $valid = false for any reason, reset it to default
     */
    if ( ! $valid ) {
        
        $default_sections_order = range( 1, $max_sections );
        $default_sections_order_without_main = $default_sections_order;
        $default_sections_order[] = 'main';
        $main_after = 1000;
        
        return [
            'valid' => false,
            'max_sections' => $max_sections,
            'sections_order' => $default_sections_order,
            'sections_order_without_main' => $default_sections_order_without_main,
            'main_after' => $main_after,
        ];
        
    }
    
    return [
        'valid' => true,
        'max_sections' => $max_sections,
        'sections_order' => $sections_order,
        'sections_order_without_main' => $sections_order_without_main,
        'main_after' => $main_after,
    ];
    
}

/**
 * Return array of visibility classes
 * @since 4.4
------------------------------------------------------------------------------------ */
function fox_visibility_class( $visibility ) {
    
    if ( ! is_array( $visibility ) ) {
        $visibility = explode( ',', $visibility );
    }
    
    $visibility = array_map( 'trim', $visibility );
    
    $class = [];
    
    if ( ! in_array( 'desktop', $visibility ) ) {
        $class[] = 'hide_on_desktop';
    } else {
        $class[] = 'show_on_desktop';
    }
    
    if ( in_array( 'tablet', $visibility ) ) {
        $class[] = 'show_on_tablet';
    } else {
        $class[] = 'hide_on_tablet';
    }
    
    if ( in_array( 'mobile', $visibility ) ) {
        $class[] = 'show_on_mobile';
    } else {
        $class[] = 'hide_on_mobile';
    }
    
    return $class;
    
}

/**
 * Unique Reading
 * @since 4.0
------------------------------------------------------------------------------------ */
add_action( 'fox_after_render_post', 'fox_add_rendered_article' );
function fox_add_rendered_article() {
    
    global $post, $rendered_articles;
    $rendered_articles[] = $post->ID;
    
}

if ( ! function_exists( 'fox_section_heading' ) ) :
/**
 * Builder Section Heading
 *
 * @since 4.3
 */
function fox_section_heading( $params = [] ) {
    
    extract( wp_parse_args( $params, [
        
        'heading' => '',
        'heading_empty' => false,
        'color' => '',
        'size' => 'large',
        'align' => 'center',
        'style' => '1a',
        'line_stretch' => 'content',
        
        'url' => '',
        'link_position' => '',
        'link_text' => '',
        'target' => '',
        
        'section_id' => 'norm',
        
        'extra_class' => '',
        
    ]) );
    
    $class = [ 'section-heading' ];
    if ( $extra_class ) {
        $class[] = $extra_class;
    }
    
    $heading = trim( $heading );
    if ( ! $heading && ! $heading_empty ) {
        return;
    }
    
    if ( $heading != '' ) {
        $heading = apply_filters( 'wpml_translate_single_string', $heading, 'FOX Homepage Builder', 'fox_builder_heading_' . $section_id );
    }
    if ( function_exists( 'pll__' ) && $heading != '' ) {
        $heading = pll__( $heading );
    }
    
    if ( $heading_empty ) {
        $heading = '';
        $class[] = 'heading-empty';
    }
    
    /**
     * $link_position
     */
    if ( 'separated' != $link_position ) {
        $link_position = 'inheading';
    }
    $class[] = 'heading-link--' . $link_position;
    
    /**
     * style
     */
    if ( ! in_array( $style, [ 'plain', '1a', '1b', '2a', '2b', '3a', '3b', '4a', '4b', '5', '6', '7a', '8a' ] ) ) {
        $style = '1a';
    }
    $number_index = substr( $style, 0, 1 );
    if ( in_array( $number_index, [ 2, 3, 4, 7, 8 ] ) ) {
        $main_style = 'line';
        $line_pos = substr( $style, 1, 1 ); // a or b, a means middle, b means bottom
        $line_pos = ( 'a' == $line_pos ) ? 'middle' : 'bottom';
    } else {
        $main_style = $style;
    }
    if ( $main_style == 'line' ) {
        $class[] = 'heading-line';
        $class[] = 'heading-line-' . $number_index;
        $class[] = 'heading-line-' . $line_pos;
        
        if ( 'full' != $line_stretch && 'content-half' != $line_stretch ) {
            $line_stretch = 'content';
        }
        
        $class[] = 'heading-line-stretch-' . $line_stretch;
            
    } else {
        $class[] = 'heading-' . $style;
    }
    
    /**
     * size
     */
    if ( ! in_array( $size, [ 'tiny', 'small', 'normal', 'medium', 'large', 'extra', 'ultra' ] ) ) {
        $size = 'large';
    }
    $class[] = 'heading-' . $size;
    
    /**
     * URL
     */
    $url = trim( $url );
    $open = $close = '';
    if ( $url ) {
        $url = apply_filters( 'wpml_translate_single_string', $url, 'FOX Homepage Builder', 'fox_builder_url_' . $section_id );
    }
    
    if ( $url && 'inheading' == $link_position ) {
        if ( '_blank' != $target ) $target = '_self';
        $open = '<a href="' . esc_url( $url ).'" target="' . esc_attr( $target ). '">';
        $close = '</a>';
    }
    $separated_link = '';
    if ( $url && 'separated' == $link_position ) {
        if ( $link_text ) {
            $link_text = apply_filters( 'wpml_translate_single_string', $link_text, 'FOX Homepage Builder', 'fox_builder_link_text_' . $section_id );
            
            $separated_link = '<a href="' . esc_url( $url ).'" target="' . esc_attr( $target ). '">' . $link_text . '</a>';
        }
    }
    
    /**
     * align
     */
    if ( 'left' != $align && 'right' != $align ) {
        $align = 'center';
    }
    $class[] = 'align-' . $align;
    
    /**
     * color
     */
    $css = [];
    if ( $color ) {
        $css[] = 'color:' . $color;
        $class[] = 'custom-color';
    }
    
    $css = join( ';', $css );
    if ( $css ) {
        $css = ' style="' . esc_attr( $css ). '"';
    }
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $css; ?>>
    
    <div class="container">
        
        <div class="heading-inner">
        
            <?php if ( $heading ) { ?>
            
            <h2 class="heading-text"><?php echo $open . $heading . $close; ?></h2>
            
            <?php } ?>
            
            <div class="line line-l"></div>
            <div class="line line-r"></div>
            
        </div><!-- .heading-inner -->
        
        <?php echo $separated_link; ?>
    
    </div><!-- .container -->
    
</div><!-- .section-heading -->

<?php
    
}
endif;