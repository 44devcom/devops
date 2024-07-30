<?php
/**
 * file purpose: class Fox56_Upgrade_Theme_Engine
 */
/* some helpful functions
================================================================================= */
if ( ! function_exists( 'fox56_builder_section_info' ) ) :
    function fox56_builder_section_info() {
        
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
endif;

if ( ! function_exists( 'fox56_builder_data' ) ) :

    function fox56_builder_data() {
        
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
            $section_info = fox56_builder_section_info();
    
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
endif;

/* the main class
================================================================================= */
class Fox56_Upgrade_Theme_Engine {

    /* running main part
    ================================================================================= */
    protected $PREFIX = '';
    protected $PREV_PREFIX = 'wi_';
    protected $VERSION = '6.0';

    function __construct() {
        $this->_log = [];
        $this->_blog = [];
        $this->error = '';
        $this->message = 'Upgrading failed. You can copy the below log and <a href="https://withemes.ticksy.com/" target="_blank">open a support ticket</a> to get help.';
    }

    function log( $setting, $value = true ) {
        if ( ! is_array( $setting ) ) {
            $settings = [ $setting ];
        } else {
            $settings = $setting;
        }
        foreach ( $settings as $setting ) {
            $this->_log[ $setting ] = $value;
        }
    }

    function blog( $setting, $value = true ) {
        if ( ! is_array( $setting ) ) {
            $settings = [ $setting ];
        } else {
            $settings = $setting;
        }
        foreach ( $settings as $setting ) {
            $this->_blog[ $setting ] = $value;
        }
    }

    function get_log() {

        $result = '';
        /**
         * options
         */
        $ul = [];
        $reg_options = Fox_Register::instance()->options();
        foreach ( $reg_options as $option_key => $info ) {
            if ( $info['type'] == 'heading' ) {
                continue;
            }
            $option = substr( $option_key, 3 );
            if ( 'mode_btn' == $option ) {
                continue;
            }
            if ( is_numeric( $option ) ) {
                continue;
            }
            if ( substr( $option_key, -4 ) == 'info' || substr( $option_key, -4 ) == 'note' ) {
                continue;
            }
            if ( substr( $option_key, -5 ) == 'intro' ) {
                continue;
            }
            if ( substr( $option_key, -6 ) == 'notice' ) {
                continue;
            }
            $std = isset( $info['std'] ) ? $info['std'] : '';
            
            /**
             * now set its status
             */
            $cl = [];
            if ( isset( $this->_log[ $option] ) ) {
                $value = $this->_log[ $option ];
                if ( true === $value ) {
                    $val = 'Ok';
                    $cl[] = 'green';
                } elseif ( 'deprecated' == $value ) {
                    $val = 'Deprecated';
                    $cl[] = 'orange';
                } elseif ( false === $value ) {
                    $cl[] = 'red';
                    $val = 'Not updated';
                } else {
                    $cl[] = 'gray';
                    $val = 'Why??';
                }
            } else {
                $cl[] = 'gray';
                $val = 'N/A';
            }

            $li = '<li class="' . join( ' ', $cl ). '"><strong>' . $option . '</strong>: <span>' . $val . '</span></li>';
            $ul[] = $li;
        }
        $ul = join( "\n", $ul );
        $result = '<ol>' . $ul . '</ol>';
        $result = '<h3>Updating Customizer Settings</h3>' . $result;
        
        /**
         * builder
         */
        $builder_data = fox56_builder_data();
        $ul = [];
        $fields = fox_builder_fields();
        $std_arr = [
            'id' => 0,
            'section_name' => 'Untitled',
        ];
        foreach ( $fields as $key => $field_data ) {
            if ( is_numeric( $key ) ) {
                continue;
            }
            if ( 'heading' == $field_data['type'] ) {
                continue;
            }
            $std_arr[ $key ] = isset( $field_data[ 'std' ] ) ? $field_data[ 'std' ] : null;
        }
        foreach ( $builder_data as $old_section ) {
            $li = '<div class="section" style="margin: 0 0 30px;">';
            $section_data = wp_parse_args( $old_section, $std_arr );
            $sub_ul = [];
            foreach ( $std_arr as $key => $std_val ) {
                $cl = [];
                if ( isset( $this->_blog[ $key] ) ) {
                    $value = $this->_blog[ $key ];
                    if ( true === $value ) {
                        $val = 'Ok';
                        $cl[] = 'green';
                    } elseif ( 'deprecated' == $value ) {
                        $val = 'Deprecated';
                        $cl[] = 'orange';
                    } elseif ( false === $value ) {
                        $cl[] = 'red';
                        $val = 'Not updated';
                    } else {
                        $cl[] = 'gray';
                        $val = 'Why??';
                    }
                } else {
                    $cl[] = 'gray';
                    $val = 'N/A';
                }

                $sub_li = '<li class="' . join( ' ', $cl ).'"><strong>' . $key . '</strong>: <span>' . $val. '</span></li>';
                $sub_ul[] = $sub_li;
            }
            $sub_ul = join( "\n", $sub_ul );
            $sub_ul = '<ol>' . $sub_ul . '</ol>';
            $li .= $sub_ul;
            $li .= '</div>';
            $ul[] = $li;

            // hmm, only need to do it for 1 section
            break;
        }
        $ul = join( "\n", $ul );
        $result = $ul . $result;

        $result = '<h3>Updating Homepage Builder Settings</h3>' . $result;

        if ( $this->error ) {
            $result = '<p class="red">' . $this->error . '</p>' . $result;
        }

        return $result;
    }

    function just_run() {
        $this->process_typography();
        $this->process_customizer();
        $this->process_builder();
    }

    function run() {
        /**
         * backup the current theme mod
         */
        $mods = get_theme_mods();
        update_option( 'theme_mods_upgrade_v5_to_v6', $mods );
        $this->mods = $mods;

        $this->just_run();
        update_option( 'fox56_version', '6.0' );
    }

    function set_theme_mod( $key, $value ) {
        // don't set things have been set
        if ( isset( $this->mods[ $key ] ) ) {
            return;
        }
        set_theme_mod( $key, $value );
    }

    function process_builder() {
        include(dirname( __FILE__ ).'/builder.php' );
    }

    function process_typography() {
        include(dirname( __FILE__ ).'/typography.php' );
    }

    function process_customizer() {
        include(dirname( __FILE__ ).'/customizer.php' );
    }

    /* helper functions
    ================================================================================= */
    /**
     * provide necessary data to determine components
     * item_template
     * components
     * RETURN component_str version 5.6 for migration
     */
    function components_from_data( $args = [] ) {
        extract( wp_parse_args( $args, [
            'item_template' => '2',
            'components' => '',
        ]));
        if ( ! in_array( $item_template, [ '1', '2', '3', '4', '5' ] ) ) {
            $item_template = '2';
        }
        if ( '1' == $item_template ) {
            $components_order = [ 'thumbnail', 'standalone_category', 'title', 'author', 'date', 'category', 'view', 'reading_time', 'comment', 'excerpt', 'more', 'share' ];
        } elseif ( '2' == $item_template ) {
            $components_order = [ 'thumbnail', 'standalone_category', 'author', 'date', 'category', 'view', 'reading_time', 'comment', 'title', 'excerpt', 'more', 'share' ];
        } elseif ( '3' == $item_template ) {
            $components_order = [ 'thumbnail', 'standalone_category', 'title', 'excerpt', 'more', 'author', 'date', 'category', 'view', 'reading_time', 'comment', 'share' ];
        } elseif ( '4' == $item_template ) {
            $components_order = [ 'thumbnail', 'standalone_category', 'title', 'author', 'date', 'category', 'view', 'reading_time', 'comment', 'excerpt', 'more', 'share' ];
        } elseif ( '5' == $item_template ) {
            $components_order = [ 'thumbnail', 'standalone_category', 'title', 'excerpt', 'more', 'author', 'date', 'category', 'view', 'reading_time', 'comment', 'share' ];
        }
        if ( ! is_array( $components ) ) {
            $components = explode( ',', strval( $components ) );
        }

        /**
         * CONVERT IT TO components v5.6
         */
        $map = [
            'more' => 'excerpt_more',
            'comment' => 'comment_link',
            'standalone_category' => 'category',
        ];
        if ( ! in_array( $item_template, [ '4', '5' ] ) ) {
            $map[ 'standalone_category' ] = 'false';
        } else {
            $map[ 'category' ] = 'false';
        }
        $final_components = [];
        foreach ( $components_order as $com ) {
            if ( 'share' == $com ) {
                continue;
            }
            $com_old_value = isset( $map[ $com ] ) ? $map[ $com ] : $com;
            if ( in_array( $com_old_value, $components ) ) {
                $final_components[] = $com;
            }
        }
        return $final_components;

    }

    // RETURN version 5.6 of more style
    function more_style( $excerpt_more_style ) {

        $more_style = 'plain';
        if ( 'btn' == $excerpt_more_style ) {
            $more_style = 'fill';
        } elseif ( 'btn-outline' == $excerpt_more_style ) {
            $more_style = 'outline';
        } elseif ( 'btn-black' == $excerpt_more_style ) {
            $more_style = 'black';
        } elseif ( 'btn-primary' == $excerpt_more_style ) {
            $more_style = 'primary';
        } elseif ( 'simple-btn' == $excerpt_more_style ) {
            $more_style = 'minimal';
        } else {
            $more_style = 'plain';
        }
        return $more_style;
        
    }

    function thumbnail_map( $thumbnail ) {
        $map = [
            'landscape' => 'thumbnail-medium',
            'square' => 'thumbnail-square',
            'portrait' => 'thumbnail-portrait',
            'original' => 'full',
            'original_fixed' => 'full', // deprecated56
        ];
        $thumbnail = isset( $map[ $thumbnail] ) ? $map[ $thumbnail] : $thumbnail;
        return $thumbnail;
    }

    function title_typo_map( $title_size ) {
        if ( 'supertiny' == $title_size ) {
            return [
                'size' => '1em',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        } elseif ( 'tiny' == $title_size ) {
            return [
                'size' => '1.1em',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        } elseif ( 'small' == $title_size ) {
            return [
                'size' => '1.3em',
                'size_tablet' => '1.2em',
                'size_mobile' => '1.3em',
            ];
        } elseif ( 'normal' == $title_size ) {
            return [
                'size' => '1.625em',
                'size_tablet' => '1.4em',
                'size_mobile' => '1.3em',
            ];
        } elseif ( 'medium' == $title_size ) {
            return [
                'size' => '2.1em',
                'size_tablet' => '1.8em',
                'size_mobile' => '1.625em',
            ];
        } elseif ( 'large' == $title_size ) {
            return [
                'size' => '2.8em',
                'size_tablet' => '2.3em',
                'size_mobile' => '1.625em',
            ];
        }
        return [];
    }

    function excerpt_typo_map( $excerpt_size ) {
        if ( 'medium' == $excerpt_size ) {
            return [
                'size' => '1.1em',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        } elseif ( 'small' == $excerpt_size ) {
            return [
                'size' => '0.85em',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        } else {
            return [
                'size' => '',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        }
    }

    function builder_heading_typo_map( $size ) {
        if ( 'ultra' == $size ) {
            return [
                'size' => '8em',
                'size_tablet' => '6em',
                'size_mobile' => '4em',
            ];
        } elseif ( 'extra' == $size ) {
            return [
                'size' => '6.4em',
                'size_tablet' => '4.2em',
                'size_mobile' => '3.2em',
            ];
        } elseif ( 'large' == $size ) {
            return [
                'size' => '5em',
                'size_tablet' => '3.3em',
                'size_mobile' => '2.5em',
            ];
        } elseif ( 'medium' == $size ) {
            return [
                'size' => '4em',
                'size_tablet' => '3em',
                'size_mobile' => '2.4em',
            ];
        } elseif ( 'normal' == $size ) {
            return [
                'size' => '3em',
                'size_tablet' => '2.4em',
                'size_mobile' => '2em',
            ];
        } elseif ( 'small' == $size ) {
            return [
                'size' => '2em',
                'size_tablet' => '1.8em',
                'size_mobile' => '1.5em',
            ];
        } elseif ( 'tiny' == $size ) {
            return [
                'size' => '1.1em',
                'size_tablet' => '1.05em',
                'size_mobile' => '1em',
            ];
        } else {
            return [
                'size' => '',
                'size_tablet' => '',
                'size_mobile' => '',
            ];
        }
    }

    function section_spacing_map( $spacing ) {
        if ( 'large' == $spacing ) {
            return [
                'desktop' => '8em',
                'tablet' => '6em',
                'mobile' => '4em',
            ];
        } elseif ( 'medium' == $spacing ) {
            return [
                'desktop' => '6em',
                'tablet' => '4em',
                'mobile' => '2em',
            ];
        } elseif ( 'normal' == $spacing ) {
            return [
                'desktop' => '4em',
                'tablet' => '2.8em',
                'mobile' => '1.8em',
            ];
        } elseif ( 'small' == $spacing ) {
            return [
                'desktop' => '2em',
                'tablet' => '1.6em',
                'mobile' => '1.2em',
            ];
        } else {
            return [
                'desktop' => '',
                'tablet' => '',
                'mobile' => '',
            ];
        }
    }

    /**
     * this is for list only
     */
    function v_spacing_map( $list_spacing ) {
        if ( 'none' == $list_spacing ) {
            return [
                'desktop' => 0,
                'tablet' => 0,
                'mobile' => 0,
            ];
        } elseif ( 'tiny' == $list_spacing ) {
            return [
                'desktop' => 16,
                'tablet' => 12,
                'mobile' => 8,
            ];
        } elseif ( 'small' == $list_spacing ) {
            return [
                'desktop' => 32,
                'tablet' => 30,
                'mobile' => 20,
            ];
        } elseif ( 'normal' == $list_spacing ) {
            return [
                'desktop' => 64,
                'tablet' => 48,
                'mobile' => 32,
            ];
        } elseif ( 'medium' == $list_spacing ) {
            return [
                'desktop' => 100,
                'tablet' => 66,
                'mobile' => 40,
            ];
        } elseif ( 'large' == $list_spacing ) {
            return [
                'desktop' => 160,
                'tablet' => 120,
                'mobile' => 60,
            ];
        }
        return [];
    }

    /**
     * only for standard layout
     */
    function standard_spacing_map( $standard_spacing ) { 
        if ( 'tiny' == $standard_spacing ) {
            return [
                'desktop' => '1em',
                'tablet' => '0.8em',
                'mobile' => '',
            ];
        } elseif ( 'small' == $standard_spacing ) {
            return [
                'desktop' => '2.2em',
                'tablet' => '1.6em',
                'mobile' => '',
            ];
        // normal
        } else {
            return [
                'desktop' => '3.4em',
                'tablet' => '2em',
                'mobile' => '',
            ];
        }
    }

    function spacing_arr( $item_spacing ) {
        if ( 'none' == $item_spacing ) {
            $v = [
                'desktop' => 0,
                'tablet' => 0,
                'mobile' => 0,
            ];
            $h = [
                'desktop' => 0,
                'tablet' => 0,
                'mobile' => 0,
            ];
        } elseif ( 'tiny' == $item_spacing ) {
            $h = [
                'desktop' => 10,
                'tablet' => 10,
                'mobile' => 10,
            ];
            $v = [
                'desktop' => 40,
                'tablet' => 30,
                'mobile' => 10,
            ];
        } elseif ( 'small' == $item_spacing ) {
            $h = [
                'desktop' => 20,
                'tablet' => 16,
                'mobile' => 10,
            ];
            $v = [
                'desktop' => 40,
                'tablet' => 30,
                'mobile' => 10,
            ];
        } elseif ( 'normal' == $item_spacing ) {
            $h = [
                'desktop' => 32,
                'tablet' => 24,
                'mobile' => 16,
            ];
            $v = [
                'desktop' => 32,
                'tablet' => 24,
                'mobile' => 16,
            ];
        } elseif ( 'medium' == $item_spacing ) {
            $h = [
                'desktop' => 48,
                'tablet' => 36,
                'mobile' => 24,
            ];
            $v = [
                'desktop' => 48,
                'tablet' => 36,
                'mobile' => 24,
            ];
        } elseif ( 'wide' == $item_spacing ) {
            $h = [
                'desktop' => 64,
                'tablet' => 40,
                'mobile' => 20,
            ];
            $v = [
                'desktop' => 64,
                'tablet' => 40,
                'mobile' => 20,
            ];
        } elseif ( 'wider' == $item_spacing ) {
            $h = [
                'desktop' => 80,
                'tablet' => 60,
                'mobile' => 40,
            ];
            $v = [
                'desktop' => 80,
                'tablet' => 60,
                'mobile' => 40,
            ];
        } else {
            // normal scale, in worst case
            $h = [
                'desktop' => 32,
                'tablet' => 24,
                'mobile' => 16,
            ];
            $v = [
                'desktop' => 32,
                'tablet' => 24,
                'mobile' => 16,
            ];
        }
        return [ 'h' => $h, 'v' => $v ];
    }

    function cat_to_id( $cat ) {
        if ( 0 === strpos( $cat, 'cat_' ) ) {
            $cat_slug = substr( $cat, 4 );
            $get_cat = get_term_by( 'slug', $cat_slug, 'category' );
            if ( $get_cat && ! is_wp_error( $get_cat ) ) {
                return $get_cat->term_id;
            }
        }
        return;
    }

    /**
     * fox v5 use: cat_lifestyle, cat_culture,..
     * fox v6 use: cat--business
     */
    function cat_to_slug( $cat ) {
        if ( 0 === strpos( $cat, 'cat_' ) ) {
            $cat_slug = substr( $cat, 4 );
            return $cat_slug;
        }
        return;
    }

    /**
     * input: cat_lifestyle, cat_culture
     * output: [ cat--lifestyle, cat--culture ]
     */
    function mapcats( $categories ) {
        if ( ! is_array( $categories ) ) {
            $categories = strval( $categories );
            $categories = explode(',',$categories);
        }
        $converted_categories = [];
        foreach ( $categories as $cat ) {
            $cat_slug = $this->cat_to_slug( trim( $cat ) );
            if ( $cat_slug ) {
                $converted_categories[] = 'cat--' . $cat_slug;
            }
        }
        return $converted_categories;
    }

    function mapcat_ids( $categories ) {
        if ( is_string( $categories ) ) {
            $categories = explode(',', $categories );
        }
        if ( ! is_array( $categories ) ) {
            $categories = [];
        }
        $cat_arr = [];
        foreach ( $categories as $cat_id ) {
            $c = get_term_by( 'id', intval( $cat_id ), 'category' );
            if ( $c && ! is_wp_error( $c ) ) {
                $cat_arr[] = 'cat--' . $c->slug;
            }
        }
        return $cat_arr;
    }

    /**
     * v5: username
     * v6: author--1
     */
    function map_authors( $authors ) {
        if ( ! is_array( $authors ) ) {
            $authors = strval( $authors );
            $authors = explode(',',$authors);
        }
        $converted_authors = [];
        foreach ( $authors as $author_nicename ) {
            $author_id = $this->author_nicename_to_id( trim( $author_nicename ) );
            if ( $author_id ) {
                $converted_authors[] = 'author--' . $author_id;
            }
        }
        return $converted_authors;
    }

    function author_nicename_to_id( $user_nicename ) {
        $user = get_user_by( 'slug', $user_nicename );
        if ( $user && ! is_wp_error( $user ) ) {
            return $user->ID;
        }
    }

    function group_layout_from_group1( $group1_big_position, $group1_big_ratio ) {
        $group_layout = '';
        if ( $group1_big_position == 'left' ) {
            if ( $group1_big_ratio == '2/3' ) {
                $group_layout = '2-1';
            } elseif ( $group1_big_ratio == '3/4' ) {
                $group_layout = '3-1';
            } elseif ( $group1_big_ratio == '1/2' ) {
                $group_layout = '1-1';
            }
        } else {
            if ( $group1_big_ratio == '2/3' ) {
                $group_layout = '1-2';
            } elseif ( $group1_big_ratio == '3/4' ) {
                $group_layout = '1-3';
            } elseif ( $group1_big_ratio == '1/2' ) {
                $group_layout = '1-1';
            }
        }
        if ( ! $group_layout ) {
            $group_layout = '2-1';
        }
        return $group_layout;
    }

    function group_layout_from_group2( $group2_columns_order ) {
        $group_layout = '';
        $group_layout = str_replace( '3', '1', $group2_columns_order ); // small
        $group_layout = str_replace( '1b', '1', $group_layout ); // medium
        $group_layout = str_replace( '1a', '3', $group_layout ); // big
        return $group_layout;
    }

    /**
     * set PREFIX + foo from PREV_PREFIX + foo
     */
    function set( $option_key, $std = null, $from = '' ) {
        if ( ! $from ) {
            $from = $option_key;
        }
        $value = get_theme_mod( $this->PREV_PREFIX . $from, $std );
        $this->log( $from );
        if ( is_null( $value ) ) {
            return;
        }
        if ( 'true' == $value ) {
            $value = true;
        } elseif ( 'false' == $value ) {
            $value = false;
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $value );
    }

    /**
     * the difference is, if value === '', we set it as default
     */
    function set_color( $option_key, $std = null, $from = '' ) {
        if ( ! $from ) {
            $from = $option_key;
        }
        $this->log( $from );
        $value = get_theme_mod( $this->PREV_PREFIX . $from, $std );
        if ( is_null( $value ) ) {
            return;
        }
        if ( 'true' == $value ) {
            $value = true;
        } elseif ( 'false' == $value ) {
            $value = false;
        }
        if ( '' === $value ) {
            $value = $std;
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $value );
    }

    function set_image( $option_key, $std = null, $from = '' ) {
        if ( ! $from ) {
            $from = $option_key;
        }
        $value = get_theme_mod( $this->PREV_PREFIX . $from, $std );
        if ( $value ) {
            if ( ! is_numeric( $value ) ) {
                $value = attachment_url_to_postid( $value );
            }
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $value );
        $this->log( $from );
    }

    function set_number( $option_key, $std = null, $from = '' ) {
        if ( ! $from ) {
            $from = $option_key;
        }
        $value = get_theme_mod( $this->PREV_PREFIX . $from, $std );
        if ( $value ) {
            $value = intval( $value );
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $value );
        $this->log( $from );
    }

    /**
     * migrate the multicheckbox option
     */
    function set_multicheck( $option_key, $std = null ) {
        $old_value = get_theme_mod( $this->PREV_PREFIX . $option_key, $std );
        if ( ! is_array( $old_value ) ) {
            $old_value = explode( ',', $old_value );
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $old_value );
    }

    function set_background( $option_key, $std = '[]', $from = '' ) {
        if ( ! $from ) {
            $from = $option_key;
        }
        $old_value = get_theme_mod( $this->PREV_PREFIX . $from, $std );
        $old_value = json_decode( $old_value, true );
        if ( ! is_array( $old_value ) ) {
            $old_value = [];
        }
        $new_value = [];
        
        // the final array
        $transfer_arr = [
            'background-color' => 'color',
            'background-image' => 'image',
            'background-size' => 'size',
            'background-position' => 'position',
            'background-repeat' => 'repeat',
            'background-attachment' => 'attachment',
        ];
        foreach ( $transfer_arr as $k => $v ) {
            if ( isset( $old_value[$k] ) ) {
                $new_value[$v] = $old_value[$k];
            } else {
                continue;
            }
            if ( 'image' == $v ) {
                $img_id = $old_value[$k];
                if ( $img_id ) {
                    $img_url = wp_get_attachment_url( $img_id );
                    if ( $img_url ) {
                        $new_value[ $v . '__src' ] = $img_url; 
                    }
                }
            }
        }
        $this->set_theme_mod( $this->PREFIX . $option_key, $new_value );
        $this->log( $from );
    }

    /**
     * migrate typography options
     * we only set options in key of $std
     */
    function set_typography( $option_key, $std = [], $from = '' ) {
        
        if ( ! $from ) {
            $from = $option_key;
        }
        
        // the final array
        $typography_arr = [];
        
        /**
         * font family
         */
        if ( isset( $std[ 'font-family']) ) {
            $face = get_theme_mod( $this->PREV_PREFIX . $from . '_font', $std['font-family'] );
        } else {
            $face = get_theme_mod( $this->PREV_PREFIX . $from . '_font', '' );
        }
        if ( 'font_heading' == $face ) {
            $face = 'var(--font-heading)';
        } elseif ( 'font_body' == $face ) {
            $face = 'var(--font-body)';
        } elseif ( 'font_nav' == $face ) {
            $face = 'var(--font-nav)';
        } else {
            // do nothing
        }
        // not sure why, but the case Rubik:900
        if ( strpos( $face, ':' ) !== false ) {
            $explode = explode( ':', $face );
            $face = $explode[0];
        }
        $typography_arr[ 'face' ] = $face;
        
        /**
         * typography
         */
        $get = get_theme_mod( $this->PREV_PREFIX . $from . '_typography', null );
        if ( is_null( $get ) ) {
            $typography = $std;
        } else {
            $typography = json_decode( $get, true );
        }
        if ( ! is_array( $typography ) ) {
            $typography = [];
        }

        // font weight, font style
        if ( isset( $typography['font-weight'] ) ) {
            $typography_arr[ 'weight' ] = $typography['font-weight'];
        }
        if ( isset( $typography['font-style'] ) ) {
            $typography_arr[ 'style' ] = $typography['font-style'];
        }

        // letter-spacing
        if ( isset( $typography['letter-spacing'] ) && '' !== $typography['letter-spacing'] ) {
            $size = trim($typography['letter-spacing']);
            if ( is_numeric( $size ) ) {
                $size .= 'px';
            }
            $typography_arr['spacing'] = $size;
        }

        // line-height
        if ( isset( $typography['line-height'] ) && '' !== $typography['line-height'] ) {
            $typography_arr['line_height'] = $typography['line-height'];
        }

        // text transform
        if ( isset( $typography['text-transform'] ) && '' !== $typography['text-transform'] ) {
            $typography_arr['transform'] = $typography['text-transform'];
        }

        // font size desktop
        $size = isset( $typography[ 'font-size' ] ) ? $typography[ 'font-size' ] : '';
        if ( isset( $std['font-size'] ) && '' === $size ) {
            $size = $std['font-size'];
        }
        if ( $size ) {
            // $size = $this->tonumber( $size );
            $typography_arr[ 'size' ] = $size;
        }

        // font size tablet
        $size = isset( $typography[ 'font-size-tablet' ] ) ? $typography[ 'font-size-tablet' ] : '';
        if ( isset( $std['font-size-tablet'] ) && '' === $size ) {
            $size = $std['font-size-tablet'];
        }
        if ( $size ) {
            // $size = $this->tonumber( $size );
            $typography_arr[ 'size_tablet' ] = $size;
        }

        // font size mobile
        $size = isset( $typography[ 'font-size-phone' ] ) ? $typography[ 'font-size-phone' ] : '';
        if ( isset( $std['font-size-phone'] ) && '' === $size ) {
            $size = $std['font-size-phone'];
        }
        if ( $size ) {
            // $size = $this->tonumber( $size );
            $typography_arr[ 'size_mobile' ] = $size;
        }

        if ( ! empty( $typography_arr ) ) {
            $this->set_theme_mod( $this->PREFIX . $option_key . '_typography', $typography_arr );
        }

        // log
        $this->log( $from . '_font' );
        $this->log( $from . '_typography' );

    }

    // convert str size 0.9em -> 0.9 * 16 = 14px
    public function tonumber( $size ) {
        $size = trim( strval( $size ) );
        if ( strpos( $size, 'em' ) !== false ) {
            $size = floatval( str_replace( 'em', '', $size ) ) * 16;
        }
        return absint( $size );
    }

    /**
     * FROM 'box' type option --> array( padding => [ desktop => , tablet => , mobile => ], margin => .. )
     */
    function get_nice_box( $option_key ) {
        try {
            $old_box = json_decode( get_theme_mod(  $this->PREV_PREFIX . $option_key . '_box', '[]' ), true );
        } catch ( Exception $e ) {
            $old_box = [];
        }
        if ( ! is_array( $old_box ) ) {
            return;
        }
        $collect = [
            'padding' => [],
            'margin' => [],
            'border' => [],
            'border-color' => '',
        ];
        foreach ( $old_box as $k => $v ) {
            if ( $k == 'border-color' ) {
                $collect[$k] = $v;
                continue;
            }
            if ( substr( $k, 0, 6 ) == 'tablet' ) {
                $prop = substr( $k, 7 );
                $device = 'tablet';
            } elseif ( substr( $k, 0, 5 ) == 'phone' ) {
                $prop = substr( $k, 6 );
                $device = 'mobile';
            } else {
                $prop = $k;
                $device = 'desktop';
            }
            
            if ( substr( $prop, 0, 7 ) == 'padding' ) {
                $main_prop = 'padding';
                $pos = substr( $prop, 8 );
            } elseif ( substr( $prop, 0, 6 ) == 'margin' ) {
                $main_prop = 'margin';
                $pos = substr( $prop, 7 );
            } else {
                $main_prop = 'border';
                $pos = substr( $prop, 7 );
                $pos = str_replace( '-width', '', $pos );
            }

            $collect[ $main_prop ][ $device ][ $pos ] = $v;
        }
        return $collect;
    }

    /**
     * migrate the box option
     */
    function set_box( $option_key, $std = null ) {
    
        /* main header box
        ---------------------------------------------------------------------- */
        try {
            $old_main_header_box = json_decode( get_theme_mod(  $this->PREV_PREFIX . $option_key . '_box', strval( $std ) ), true );
        } catch ( Exception $e ) {
            $old_main_header_box = [];
        }
        if ( ! is_array( $old_main_header_box ) ) {
            return;
        }
        $collect = [
            'desktop' => [],
            'mobile' => [],
            'tablet' => [],
            'border-color' => '',
        ];
        foreach ( $old_main_header_box as $k => $v ) {
    
            if ( $k == 'border-color' ) {
                $collect[$k] = $v;
                continue;
            }
    
            if ( substr( $k, 0, 6 ) == 'tablet' ) {
                $prop = substr( $k, 7 );
                $device = 'tablet';
            } elseif ( substr( $k, 0, 5 ) == 'phone' ) {
                $prop = substr( $k, 6 );
                $device = 'mobile';
            } else {
                $prop = $k;
                $device = 'desktop';
            }
    
            $collect[ $device ][ $prop ] = $v;
        }
    
        foreach ( $collect as $device => $v ) {
            if ( 'border-color' == $device ) {
                $this->set_theme_mod( $this->PREFIX . $option_key . '_border_color', $v );
                continue;
            }
            $this->set_theme_mod(  $this->PREFIX . $device . '_' . $option_key . '_box', $v );
        }
    }

}