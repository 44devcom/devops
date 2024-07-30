<?php
return;
/**
 * Use this every time we want to migrate old options to new options
 * (for consistency in namespace or we just changed the mechanism)
 *
 * @since 4.0
 * @improved in 4.6
 */
class Fox_Updater {
    
    /**
     * Construct
     * ----------------------------------------*/
    function __construct() {
        
        // check to run update automatically without permission
        // add_action( 'init', [ $this, 'check_run_update' ], 0 );
        // add_action( 'admin_menu', array( $this, 'admin_menu' ), 0 );
        
    }
    
    /**
     * Create admin menu
     * ----------------------------------------*/
    function admin_menu() {
        
        // create an admin interface to run update
        add_submenu_page(
            '',
            'The Updater',
            'The Updater',
            'manage_options',
            'fox-updater',
            array( $this, 'create_update_page')
        );
        
    }
    
    /**
     * Update page
     * ----------------------------------------*/
    function create_update_page() {
        
        $run_update = isset( $_GET[ 'run_update' ] ) ? $_GET[ 'run_update' ] : '';
        if ( 'yes' == $run_update ) {

            $back_compat = new Fox_Updater();
            $back_compat->run_update( 'all' );

            echo '<div class="message notice notice-success"><p>Thank you! The updater has been run successfully</p></div>';

        }

        $fix_images = isset( $_GET[ 'fix_featured_images' ] ) ? $_GET[ 'fix_featured_images' ] : '';
        if ( 'yes' == $fix_images ) {

            $query = new WP_Query([
                'posts_per_page' => 10000,
                'fields' => 'ids',
            ]);

            if ( $query->have_posts() ) {
                while( $query->have_posts() ) {
                    $query->the_post();
                    delete_post_meta( get_the_ID(), '_wi_thumbnail' );
                }
            }

            wp_reset_query();

            echo '<div class="message notice notice-success"><p>Thank you! "Featured Images issue" has been fixed.</p></div>';

        }
        
        
        if ( defined( 'FOX_ADMIN_PATH' ) ) {
            
            include_once FOX_ADMIN_PATH . 'update.php';
            
        } else {
            
            include_once 'update.php';
            
        }
        
    }
    
    /**
     * Check things to update  from versions
     * ----------------------------------------*/
    function check_run_update() {

        // $updates is the array of things need to update
        $updates = [];
        if ( ! get_theme_mod( 'wi_migrated_to_29' ) ) {
            $updates[] = '29';
        }
        
        if ( ! get_theme_mod( 'wi_migrated_to_43' ) ) {
            $updates[] = '43';
        }
        
        if ( ! get_theme_mod( 'wi_migrated_to_45' ) ) {
            $updates[] = '45';
        }
        
        if ( ! get_theme_mod( 'wi_migrated_to_46' ) ) {
            $updates[] = '46';
        }
        
        /**
         * detect any signal from ppl using fox before
         * signal: any theme mod with prefix wi_
         */
        $mods = get_theme_mods();
        $has_wi = false;
        if ( is_array( $mods ) ) {
            foreach ( $mods as $k => $v ) {
                if ( 0 === strpos( $k, 'wi_' ) ) {
                    $has_wi = true;
                    break;
                }
            }
        }
        
        $fox_version = get_option( 'fox_version' );
        
        // signal for Fox3
        // since 6.0
        if ( '4' != $fox_version && $has_wi ) {
            $updates[] = '4.1';
        } else {
            // add_option( 'fox_version', '4.1' );
        }

        $this->run_update( $updates );
        
    }
    
    /**
     * Run Update
     * This function runs immedately after update
     * And it can be re-run when we request
     *
     * $updates is array of things we need to do
     * ----------------------------------------*/
    function run_update( $updates = [] ) {
        
        if ( 'all' == $updates ) {
            $updates = [ '29', '4.1', '43', '45' ];
        }
        
        foreach ( $updates as $key ) {
            
            
            switch( $key ) {
            
                /**
                 * CASE 29
                 * ----------------------------------------*/
                case '29' :
                    
                    $this->update_29();
                    
                    break;
                    
                /**
                 * CASE 4
                 * since 6.0, we set it 4.1
                 * ----------------------------------------*/
                case '4.1':
                    
                    $this->update_4();
                    
                    break;
                    
                /**
                 * CASE 43
                 * ----------------------------------------*/
                case '43':
                    
                    $this->update_43();
                    break;
                    
                /**
                 * CASE 45
                 * ----------------------------------------*/
                case '45':
                    
                    $this->update_45();
                    break;
                
                /**
                 * CASE 46
                 * ----------------------------------------*/
                case '46' :
                    
                    $this->update_46();
                    break;
                    
                default :
                    break;
                    
                    
            }
            
            
        }
        
    }
    
    
    /**
     * v2.9
     * ----------------------------------------*/
    function update_29() {
        
        $custom_css = get_theme_mod( 'wi_custom_css' );
        if ( $custom_css && function_exists( 'wp_update_custom_css_post' ) ) {
            wp_update_custom_css_post( $custom_css );
        }

        set_theme_mod ( 'wi_migrated_to_29', true );
        
    }
    
    /**
     * v4
     * -------------------------------------------------------------------------------- */
    function update_4() {
        
        $mods = get_theme_mods();
        
        /**
         * make a back up for Fox 3 theme mods
         */
        $mods_3 = get_option( 'fox_mods_3' );
        if ( ! $mods_3 ) {
            add_option( 'fox_mods_3', $mods );
        }
        
        /* GENERAL PROBLEMS
        ------------------------------------------------------------------------------------------------ */
        $collect_social_array = [];
        $collect_translate_array = [];
        foreach ( $mods as $id => $value ) {
            
            /**
             * 01 - disable type
             */
            if ( 0 === strpos( $id, 'wi_disable_' ) ) {
                
                $new_id = str_replace( 'wi_disable_', '', $id );
                if ( $value ) {
                    set_theme_mod( $new_id, 'false' );
                } else {
                    set_theme_mod( $new_id, 'true' );
                }
                
            }
            
            /**
             * 02 - multiple text options
             */
            if ( 0 === strpos( $id, 'wi_social_' ) ) {
                $new_id = str_replace( 'wi_social_', '', $id );
                if ( $value ) {
                    $collect_social_array[ $new_id ] = $value;
                }
            }
            
            if ( 0 === strpos( $id, 'wi_translate_' ) ) {
                $new_id = str_replace( 'wi_translate_', '', $id );
                if ( $value ) {
                    $collect_translate_array[ $new_id ] = $value;
                }
            }
            
        }
        
        /* Enable Options
        ------------------------------------------------------------------------------------------------ */
        $enable_options = [
            'sticky_sidebar',
            'enable_hand_lines',
            'autoload_post',
            'exclude_pages_from_search',
        ];
        
        foreach ( $enable_options as $id ) {
            
            $value = get_theme_mod( 'wi_' . $id );
            $new_id = 'wi_' . $id;
            
            if ( isset( $mods[ 'wi_' . $id ] ) && ( 'true' == $mods[ 'wi_' . $id ] || 'false' == $mods[ 'wi_' . $id ] ) ) {
                continue;
            }
            
            if ( isset( $mods[ 'wi_' . $id ] ) && $mods[ 'wi_' . $id ] ) {
                set_theme_mod( $new_id, 'true' );
            } else {
                set_theme_mod( $new_id, 'false' );
            }
            
        }
        
        /* LAYOUT
        ------------------------------------------------------------------------------------------------ */
        $positions = [
            'home', 'category', 'archive', 'tag', 'author', 'search', 'all-featured',
        ];
        foreach ( $positions as $position ) {
            
            $id = 'wi_' . $position . '_layout';
            
            // not set yet, it means standard in old system
            if ( ! isset( $mods[ $id ] ) ) {
                set_theme_mod( $id, 'standard' );
            }
            
        }
        
        /* LOGO
        ------------------------------------------------------------------------------------------------ */
        set_theme_mod( 'wi_logo_type', 'image' );
        // in old theme, header slogan is enabled by default
        // not set yet
        if ( ! isset( $mods[ 'wi_disable_header_slogan' ]  ) ) {
            set_theme_mod( 'wi_header_slogan', 'true' );
        }
        
        /* FOOTER
        ------------------------------------------------------------------------------------------------ */
        // scroll up type
        set_theme_mod( 'wi_backtotop_type', 'text' );
        
        /* DESIGN
        ------------------------------------------------------------------------------------------------ */
        $old_design = [
            'logo_width' => 1170,
        ];
        
        foreach ( $old_design as $k => $v ) {
            if ( ! isset( $mods[ 'wi_' . $k ] ) ) {
                set_theme_mod( 'wi_' . $k, $v );
            }
        }
        
        // nav size
        if ( ! isset( $mods[ 'wi_nav_size' ] ) ) {
            $nav_size = 26;
        } else {
            $nav_size = $mods[ 'wi_nav_size' ];
        }
        set_theme_mod( 'wi_nav_typography', json_encode([
            'font-size' => $nav_size,
        ]));
        
        // body font
        if ( ! isset( $mods[ 'wi_body_font' ] ) ) {
            $body_font = 'Merriweather:400';
        } else {
            $body_font = $mods[ 'wi_body_font' ] . ':300,400,700';
        }
        set_theme_mod( 'wi_body_font', $body_font );
        
        // heading font
        if ( ! isset( $mods[ 'wi_heading_font' ] ) ) {
            $heading_font = 'Oswald:300,400,700';
        } else {
            $heading_font = $mods[ 'wi_heading_font' ] . ':300,400,700';
        }
        set_theme_mod( 'wi_heading_font', $heading_font );
        
        // nav font
        if ( ! isset( $mods[ 'wi_nav_font' ] ) ) {
            $nav_font = 'Oswald:300,400,700';
        } else {
            $nav_font = $mods[ 'wi_nav_font' ] . ':300,400,700';
        }
        set_theme_mod( 'wi_nav_font', $nav_font );
        
        // general color
        set_theme_mod( 'wi_border_color', '#000' );
        set_theme_mod( 'wi_nav_submenu_box', json_encode([
            'border-color' => '#000000',
            'border-width' => 1,
            'border-style' => 'solid',
        ]));
        set_theme_mod( 'wi_nav_submenu_sep_color', '#000' );
        set_theme_mod( 'wi_nav_submenu_typography', json_encode([
            'font-size' => 11,
            'letter-spacing' => 2,
            'font-weight' => 400,
            'text-transform' => 'uppercase',
        ]));
        set_theme_mod( 'wi_blog_standard_header_align', 'center' );
        set_theme_mod( 'wi_offcanvas_nav_typography', json_encode([
            'text-transform' => 'uppercase',
            'font-size'     => 16,
            'letter-spacing' => 1,
        ]) );
        
        set_theme_mod( 'wi_button_typography', json_encode([
            'text-transform' => 'uppercase',
            'font-size'     => 13,
            'letter-spacing' => 1,
        ]) );
        
        set_theme_mod( 'wi_titlebar_box', json_encode([
            'border-top-color' => '#000',
            'border-bottom-color' => '#000',
        ]) );
        set_theme_mod( 'wi_footer_sidebar_sep_color', '#000' );
        set_theme_mod( 'wi_backtotop_border_color', '#000' );
        set_theme_mod( 'wi_sticky_header_element_style', 'border' );
        set_theme_mod( 'wi_blockquote_box', json_encode([
            'border-top-width' => '2px',
            'border-bottom-width' => '2px',
        ]) );
        
        // accent color
        if ( isset( $mods[ 'wi_primary_color' ] )  ) set_theme_mod( 'wi_accent', $mods[ 'wi_primary_color' ] );
        
        // widget title background
        if ( isset( $mods[ 'wi_widget_title_text_color' ] )  ) {
            set_theme_mod( 'wi_widget_title_color', $mods[ 'wi_widget_title_text_color' ] );
        } else {
            set_theme_mod( 'wi_widget_title_color', '#ffffff' );
        }
        if ( isset( $mods[ 'wi_widget_title_bg_color' ] )  ) {
            set_theme_mod( 'wi_widget_title_background_color', $mods[ 'wi_widget_title_bg_color' ] );
        } else {
            set_theme_mod( 'wi_widget_title_background_color', '#000000' );
        }
        
        // selection
        if ( isset( $mods[ 'wi_selection_color' ] )  ) {
            set_theme_mod( 'wi_selection_background', $mods[ 'wi_selection_color' ] );
            if ( ! isset( $mods[ 'wi_selection_text_color' ] ) ) {
                set_theme_mod( 'wi_selection_text_color', '#ffffff' );
            }
        }
        
        /**
         * background to background customizer new type
         */
        $prefix = 'wi_body_';
        $props = [
            'background_color',
            'background',
            'background_position',
            'background_size',
            'background_repeat',
            'background_attachment',
        ];
        $bg_collect = [];
        foreach ( $props as $prop ) {
            if  ( ! isset( $mods[ $prefix . $prop ] ) ) continue;
            $value = $mods[ $prefix . $prop ];
            if ( 'background' == $prop ) {
                $prop = 'background-image';
                $value = attachment_url_to_postid( $value );
            }
            $bg_collect[ $prop ] = $value;
        }
        if ( ! empty( $bg_collect ) ) {
            set_theme_mod( 'wi_body_background', json_encode( $bg_collect ) );
        } else {
            // prevent weird value from old body_background property
            set_theme_mod( 'wi_body_background', '' );
        }
        
        // old content width, if not set it's 1020
        if ( ! isset( $mods[ 'wi_content_width' ] ) ) {
            set_theme_mod( 'wi_content_width', 1020 );
        }
        
        // now re-build old fashion on elements
        $border = false;
        if ( isset( $mods[ 'wi_site_border' ] ) ) {
            if ( 'true' == $mods[ 'wi_site_border' ] ) {
                $border = true;
            } elseif ( 'false' == $mods[ 'wi_site_border' ] ) {
                $border = false;
            }
        }
        
        if ( $border ) {
            
            set_theme_mod( 'wi_body_layout', 'boxed' );
            
            $wrapper_box = [
                'border-top-width' => 2,
                'border-bottom-width' => 2,
                'border-left-width' => 2,
                'border-right-width' => 2,
                'border-style' => 'solid',
            ];
            $all_box = [
                'margin-top' => '24',
                'margin-bottom' => '24',
            ];
            
            set_theme_mod( 'wi_wrapper_box', json_encode( $wrapper_box ) );
            set_theme_mod( 'wi_all_box', json_encode( $all_box ) );
            
        } else {
        
            set_theme_mod( 'wi_body_layout', 'wide' );
        
        }
        
        /* BLOG
        ------------------------------------------------------------------------------------------------ */
        if ( isset( $mods[ 'wi_disable_blog_image' ] ) && $mods[ 'wi_disable_blog_image' ] ) {
            // disable blog image, it means, hmm, no standard image
            set_theme_mod( 'wi_blog_standard_thumbnail', 'false' );
        } else {
            set_theme_mod( 'wi_blog_standard_thumbnail', 'true' );
        }
        
        $components = [
            'image' => 'show_thumbnail',
            'date' => 'show_date',
            'categories' => 'show_category', 
            'author' => 'show_author',
            'view_count' => 'show_view',
            'comment' => 'show_comment_link',
            'share' => 'show_share',
            'related' => 'show_related',
            'standard_display' => 'content_excerpt',
        ];
        
        foreach ( $components as $com => $new_com ) {
            
            if ( isset( $mods[ 'wi_disable_blog_' . $com ] ) && $mods[ 'wi_disable_blog_' . $com ] ) {
                set_theme_mod( 'wi_blog_standard_' . $new_com, 'false' );
            } else {
                set_theme_mod( 'wi_blog_standard_' . $new_com, 'true' );
            }
            
        }
        
        if ( isset( $mods[ 'wi_grid_excerpt_length' ] ) ) set_theme_mod( 'wi_blog_grid_excerpt_length', $mods[ 'wi_grid_excerpt_length' ] );
        
        if ( isset( $mods[ 'wi_grid_excerpt_length' ] ) ) set_theme_mod( 'wi_blog_grid_excerpt_length', $mods[ 'wi_grid_excerpt_length' ] );
        
        if ( isset( $mods[ 'wi_disable_blog_readmore' ] ) && $mods[ 'wi_disable_blog_readmore' ] ) {
            
            set_theme_mod( 'wi_blog_grid_excerpt_more', 'false' );
            
        } else {
            
            set_theme_mod( 'wi_blog_grid_excerpt_more', 'true' );
            
        }
        
        /* COOL POST - HERO POST
        ------------------------------------------------------------------------------------------------ */
        /**
         * cool post problem
         * cool post means: single content width narrow and no sidebar
         */
        if ( get_theme_mod( 'wi_cool_post_all' ) ) {
        
            set_theme_mod( 'wi_single_style', 3 );
            set_theme_mod( 'wi_single_content_width', 'narrow' );
            set_theme_mod( 'wi_single_sidebar_state', 'none' );
            
            // thumbnail stretch now has 2 values
            $thumbnail_stretch = get_theme_mod( 'wi_cool_thumbnail_size', 'big' );
            if ( 'full' == $thumbnail_stretch ) {
                set_theme_mod( 'wi_single_thumbnail_stretch', 'stretch-full' );
            } else {
                set_theme_mod( 'wi_single_thumbnail_stretch', 'stretch-none' );
            }
        
        }
        
        $cool_post_stretch = get_theme_mod( 'wi_cool_post_stretch', 'bit' );
        if ( 'full' == $cool_post_stretch ) {
            set_theme_mod( 'wi_single_content_image_stretch', 'stretch-full' );
        } else {
            set_theme_mod( 'wi_single_content_image_stretch', 'stretch-bigger' );
        }
        
        $hero = get_theme_mod( 'wi_hero' );
        if ( 'full' == $hero ) {
            
            set_theme_mod( 'wi_single_style', 4 );
            
        } elseif ( 'half' == $hero ) {
            
            set_theme_mod( 'wi_single_style', 5 );
        
        } else {
            
            if ( get_theme_mod( 'wi_cool_post_all' ) ) {
                set_theme_mod( 'wi_single_style', 3 );
            } else {
                set_theme_mod( 'wi_single_style', 1 );
            }
        
        }
        
        $components = [
            'image' => 'thumbnail',
            'share' => 'share',
            'tag' => 'tag', 
            'related' => 'related',
            'author' => 'authorbox',
            'comment' => 'comment',
            'nav' => 'nav',
            'same_category' => 'bottom_posts',
            'side_dock' => 'side_dock',
        ];
        
        foreach ( $components as $com => $new_com ) {
            
            if ( isset( $mods[ 'wi_disable_single_' . $com ] ) && $mods[ 'wi_disable_single_' . $com ] ) {
                set_theme_mod( 'wi_single_' . $new_com, 'false' );
            } else {
                set_theme_mod( 'wi_single_' . $new_com, 'true' );
            }
            
        }
        
        /* SOCIAL, TRANSLATE - MULTIPLE TEXT OPTIONS
        ------------------------------------------------------------------------------------------------ */
        /**
         * Social collection
         */
        if ( ! empty( $collect_social_array ) ) {
            set_theme_mod( 'wi_social', json_encode( $collect_social_array ) );
        }
        
        if ( ! empty( $collect_translate_array ) ) {
            set_theme_mod( 'wi_translate', json_encode( $collect_translate_array ) );
        }
        
        /* MISC
        ------------------------------------------------------------------------------------------------ */
        if ( isset( $mods[ 'wi_blog_content_column' ] ) ) {
            set_theme_mod( 'wi_blog_column_layout', $mods[ 'wi_blog_content_column' ] );
        } else {
            set_theme_mod( 'wi_blog_column_layout', 1 );
        }
        
        if ( isset( $mods[ 'wi_disable_blog_dropcap' ] ) && $mods[ 'wi_disable_blog_dropcap' ] ) {
            set_theme_mod( 'wi_blog_dropcap', 'false' );
        } else {
            set_theme_mod( 'wi_blog_dropcap', 'true' );
        }
        
        /* FINAL KEEP THE OLD DESIGN AT SOME POINTS
        ------------------------------------------------------------------------------------------------ */
        $old_design = [
            
            'authorbox_style' => 'box',
            'video_indicator_style' => 'solid',
            'tag_style' => 'block',
            
            // 01 - widget title
            'widget_title_align' => 'center',
            'widget_title_font' => 'font_heading',
            'widget_title_typography' => json_encode([
                'text-transform' => 'uppercase',
                'letter-spacing' => 8,
                'font-weight' => 'normal',
                'font-size' => 12,
            ]),
            'widget_title_box' => json_encode([
                'margin-bottom' => 16,
                'padding-top' => 4,
                'padding-bottom' => 4,
                'padding-left' => 0,
                'padding-right' => 0,
            ]),
            
            
            // 02 - post meta
            'post_meta_font' => 'font_heading',
            'post_meta_typography' => json_encode([
                'text-transform' => 'uppercase',
                'font-size' => '11',
                'font-weight' => 'normal',
                'letter-spacing' => '1.5px',
            ]),
            
            // 03 - slogan
            'tagline_font' => 'font_heading',
            'tagline_typography' => json_encode([
                'letter-spacing' => '8',
                'font-size' => '0.8125em',
            ]),
            
            // 04 - single heading
            'single_heading_typography' => json_encode([
                'text-transform' => 'uppercase',
                'font-weight' => 300,
                'letter-spacing' => 6,
            ]),
        ];
        
        foreach ( $old_design as $k => $v ) {
            
            set_theme_mod( 'wi_' . $k, $v );
            
        }
        
        /**
         * batch on posts and terms
         */
        $this->update_4_batch();
        
        /**
         * Final set version 4
         * Just a legacy
         */
        $fox_version = get_option( 'fox_version' );
        if ( $fox_version !== false ) {
            // The option already exists, so we just update it.
            if ( 4 != $fox_version ) {
                update_option( 'fox_version', '4.1' );
            }
        } else {
            // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
            $deprecated = null;
            $autoload = 'no';
            update_option( 'fox_version', '4.1', $deprecated, $autoload );
        }
        
    }
    
    /**
     * batch update for posts, terms
     * v4
     * -------------------------------------------------------------------------------- */
    function update_4_batch() {
        
        /**
         * POST
         ------------------------------------------ */
        $get_posts = get_posts([
            'posts_per_page' => 10000,
            'no_found_rows' => true,
            'post_type' => [ 'post', 'page' ]
        ]);
        
        foreach ( $get_posts as $p ) {
            
            // cool post
            $postid = $p->ID;
            $style = '';

            /**
             * cool
             */
            if ( $cool = get_post_meta( $postid, '_wi_cool', true ) ) {
                
                if ( true === $cool || 'true' === $cool ) {
                    
                    $style = 3;
                    add_post_meta( $postid, '_wi_content_width', 'narrow', true );
                    add_post_meta( $postid, '_wi_sidebar_state', 'none', true );

                    $cool_thumbnail_size = get_post_meta( $postid, '_wi_cool_thumbnail_size', true );
                    $thumbnail_stretch = '';
                    if ( 'big' == $cool_thumbnail_size ) {
                        $thumbnail_stretch = 'stretch-bigger';
                    } elseif ( 'full' == $cool_thumbnail_size ) {
                        $thumbnail_stretch = 'stretch-full';
                    }
                    if ( $thumbnail_stretch ) {
                        add_post_meta( $postid, '_wi_thumbnail_stretch', $thumbnail_stretch, true );
                    }
                    
                }

            }
            
            /**
             * hero post
             */
            if ( $hero = get_post_meta( $postid, '_wi_hero', true ) ) {
                if ( 'full' == $hero ) {
                    $style = 4;
                } elseif ( 'half' == $hero ) {
                    $style = 5;
                } elseif ( 'none' == $hero ) {

                    // if style not set yet, it should be 1, otherwise it's 3
                    if ( ! $style ) $style = 1;

                }

            }

            if ( $style ) {
                add_post_meta( $postid, '_wi_style', $style, true );
            }

            /**
             * sidebar layout
             */
            $sidebar_layout = get_post_meta( $postid, '_wi_sidebar_layout', true );
            if ( $sidebar_layout ) {

                add_post_meta( $postid, '_wi_sidebar_state', $sidebar_layout, true );

            }

            /**
             * text column layout
             */
            $column_layout = get_post_meta( $postid, '_wi_column_layout', true );
            if ( $column_layout ) {
                if ( 'single-column' == $column_layout ) {
                    update_post_meta( $postid, '_wi_column_layout', 1, true );
                } elseif ( 'two-column' == $column_layout ) {
                    update_post_meta( $postid, '_wi_column_layout', 2, true );
                }
            }

            /**
             * hide featured thumbnail
             */
            if ( 'true' == get_post_meta( $postid, '_wi_hide_featured_image', true ) ) {
                add_post_meta( $postid, '_wi_thumbnail', 'false', true );
            }

            /**
             * disable share
             */
            if ( 'true' == get_post_meta( $postid, '_wi_disable_share', true ) ) {
                add_post_meta( $postid, '_wi_share', 'false', true );
            }
            
            /**
             * gallery type
             */
            if ( is_single() && 'gallery' == get_post_format() ) {
                
                $effect = get_post_meta( $postid, '_format_gallery_effect', true );
                if ( 'carousel' == $effect ) {
                    add_post_meta( $postid, '_wi_format_gallery_style', 'carousel', true );
                } elseif ( 'fade' == $effect || 'slide' == $effect ) {
                    add_post_meta( $postid, '_wi_format_gallery_style', 'slider', true );
                    add_post_meta( $postid, '_wi_format_gallery_slider_effect', $effect , true );
                }
                
                delete_post_meta( $postid, '_format_gallery_effect' );
                
            }

            // and finally, delete old meta
            delete_post_meta( $postid, '_wi_hero' );
            delete_post_meta( $postid, '_wi_cool' );
            delete_post_meta( $postid, '_wi_cool_thumbnail_size' );
            delete_post_meta( $postid, '_wi_sidebar_layout' );
            delete_post_meta( $postid, '_wi_hide_featured_image' );
            delete_post_meta( $postid, '_wi_disable_share' );
            
        }
        
        wp_reset_query();
        
        /**
         * TERMS
         ------------------------------------------ */
        $terms = new WP_Term_Query([
            'taxonomy' => [ 'category', 'post_tag' ],
            'number' => 10000,
        ]);
        
        /**
         * singular terms
         * luckily we have only layout and sidebar state :))
         * @since 4.0
         */
        foreach ( $terms->get_terms() as $t ) {
            
            $term_id = $t->term_id;
            
            $term_meta = get_option( "taxonomy_{$term_id}" );
            $layout = isset($term_meta['layout']) ? $term_meta['layout'] : '';
            $sidebar_state = isset($term_meta['sidebar_state']) ? $term_meta['sidebar_state'] : '';
            
            if ( $layout ) {
                add_term_meta( $term_id, 'layout', $layout, true );
            }
            if ( $sidebar_state ) {
                add_term_meta( $term_id, 'sidebar_state', $sidebar_state, true );
            }
            
            // remove it
            delete_option( "taxonomy_{$term_id}" );
            
        }
        
    }
    
    /**
     * v4.3
     * -------------------------------------------------------------------------------- */
    function update_43() {
        
        $props = [
            'single_meta_date', 'single_meta_category', 'single_meta_author', 'single_meta_author_avatar', 'single_meta_comment_link', 'single_meta_reading_time', 'single_meta_view', 'single_post_header', 'single_thumbnail', 'single_share', 'single_tag', 'single_authorbox', 'single_related', 'single_comment', 'single_bottom_posts', 'single_nav', 'single_side_dock',
            
        ];
        
        $std = [
            'date', 
            'category',
            'post_header',
            'thumbnail',
            'share',
            'tag',
            'related',
            'authorbox',
            'comment',
            'nav',
            'bottom_posts',
            'side_dock',
        ];
        
        foreach ( $props as $prop ) {
            
            $get = get_theme_mod( 'wi_' . $prop, '' );
            
            $k = str_replace( 'single_meta_', '', $prop );
            $k = str_replace( 'single_', '', $k );
            
            if ( 'true' == $get ) {
                
                if ( ! in_array( $k, $std ) ) {
                    $std[] = $k;
                }
                
            } elseif ( 'false' == $get ) {
                
                $std = array_diff( $std, [$k] );
                
            }
        }
        
        $std = join( ',', $std );
        
        set_theme_mod ( 'wi_single_components', $std );
        set_theme_mod ( 'wi_migrated_to_43', true );
        
    }
    
    /**
     * v4.5
     * -------------------------------------------------------------------------------- */
    function update_45() {
        
        /**
         * home layout
         */
        $layout = get_theme_mod( 'wi_home_layout', 'list' );
        
        if ( in_array( $layout, [ 'grid-2', 'grid-3', 'grid-4', 'grid-5' ] ) ) {
            
            $column = str_replace( 'grid-', '', $layout );
            $layout = 'grid';
            set_theme_mod( 'wi_home_layout', $layout );
            set_theme_mod( 'wi_column', $column );
            
        } elseif ( in_array( $layout, [ 'masonry-2', 'masonry-3', 'masonry-4', 'masonry-5' ] ) ) {
            
            $column = str_replace( 'masonry-', '', $layout );
            $layout = 'masonry';
            set_theme_mod( 'wi_home_layout', $layout );
            set_theme_mod( 'wi_column', $column );
            
        }
        
        $old_to_new = [
            'blog_grid_item_card' => 'item_card',
            'blog_grid_item_spacing' => 'item_spacing',
            'blog_grid_item_template' => 'item_template',
            'blog_grid_item_align' => 'align',
            'blog_grid_item_border' => 'item_border',
            'blog_grid_item_border_color' => 'item_border_color',
            
            'blog_grid_thumbnail' => 'thumbnail',
            'blog_grid_thumbnail_custom' => 'thumbnail_custom',
            'blog_grid_thumbnail_placeholder' => 'thumbnail_placeholder',
            'blog_grid_default_thumbnail' => 'thumbnail_placeholder_id',
            'blog_grid_thumbnail_shape' => 'thumbnail_shape',
            'blog_grid_thumbnail_hover_effect' => 'thumbnail_hover',
            'blog_grid_thumbnail_hover_logo' => 'thumbnail_hover_logo',
            'blog_grid_thumbnail_hover_logo_width' => 'thumbnail_hover_logo_width',
            'blog_grid_thumbnail_showing_effect' => 'thumbnail_showing_effect',
            
            'blog_grid_title_tag' => 'title_tag',
            'blog_grid_title_size' => 'title_size',
            'blog_grid_excerpt_length' => 'excerpt_length',
            'blog_grid_excerpt_hellip' => 'excerpt_hellip',
            'blog_grid_excerpt_size' => 'excerpt_size',
            'blog_grid_excerpt_color' => 'excerpt_color',
            'blog_grid_excerpt_more_style' => 'excerpt_more_style',
            'blog_grid_excerpt_more_text' => 'excerpt_more_text',
            
            'blog_grid_big_first_post' => 'big_first_post',
            
            'blog_grid_list_spacing' => 'list_spacing',
            'blog_grid_list_sep' => 'list_sep',
            'blog_grid_list_sep_style' => 'list_sep_style',
            'blog_grid_list_sep_color' => 'list_sep_color',
            'blog_grid_list_valign' => 'list_valign',
            'blog_grid_thumbnail_position' => 'thumbnail_position',
            'blog_grid_thumbnail_width' => 'thumbnail_width',
            'blog_grid_list_mobile_layout' => 'list_mobile_layout',
            
            'blog_standard_thumbnail_type' => 'standard_thumbnail_type',
            'blog_standard_thumbnail_header_order' => 'standard_thumbnail_header_order',
            'blog_standard_content_excerpt' => 'standard_content_excerpt',
            'excerpt_length' => 'standard_excerpt_length',
            'blog_standard_header_align' => 'standard_header_align',
            'blog_column_layout' => 'standard_column_layout',
            'blog_dropcap' => 'standard_dropcap',
            
            'post_newspaper_thumbnail_type' => 'newspaper_thumbnail_type',
            'post_newspaper_content_excerpt' => 'newspaper_content_excerpt',
            'post_newspaper_header_align' => 'newpspaper_header_align',
            
            'vertical_post_thumbnail_type' => 'vertical_thumbnail_type',
            'vertical_post_thumbnail_position' => 'vertical_thumbnail_position',
            'vertical_post_excerpt_size' => 'vertical_excerpt_size',
            
            'big_post_content_excerpt' => 'big_content_excerpt',
            
            'post_group1_big_post_position' => 'group1_big_position',
            'post_group1_big_post_ratio' => 'group1_big_ratio',
            'post_group1_sep_border' => 'group1_sep_border',
            'post_group1_sep_border_color' => 'group1_sep_border_color',
            'post_group1_big_post_components' => 'group1_big_components',
            'post_group1_big_post_align' => 'group1_big_align',
            'post_group1_big_post_item_template' => 'group1_big_item_template',
            'post_group1_big_post_excerpt_length' => 'group1_big_excerpt_length',
            'post_group1_big_post_excerpt_more_text' => 'group1_big_excerpt_more_text',
            'post_group1_big_post_excerpt_more_style' => 'group1_big_excerpt_more_style',
            'post_group1_small_post_components' => 'group1_small_components',
            'post_group1_small_post_item_template' => 'group1_small_item_template',
            'post_group1_small_post_list_spacing' => 'group1_small_list_spacing',
            
            'post_group2_columns_order' => 'group2_columns_order',
            'post_group2_sep_border' => 'group2_sep_border',
            'post_group2_sep_border_color' => 'group2_sep_border_color',
            'post_group2_big_post_components' => 'group2_big_components',
            'post_group2_big_post_align' => 'group2_big_align',
            'post_group2_big_post_item_template' => 'group2_big_item_template',
            'post_group2_big_post_excerpt_length' => 'group2_big_excerpt_length',
            'post_group2_big_post_excerpt_more_text' => 'group2_big_excerpt_more_text',
            'post_group2_big_post_excerpt_more_style' => 'group2_big_excerpt_more_style',
            'post_group2_medium_post_components' => 'group2_medium_components',
            'post_group2_medium_post_item_template' => 'group2_medium_item_template',
            'post_group2_medium_post_thumbnail' => 'group2_medium_thumbnail',
            'post_group2_medium_post_excerpt_length' => 'group2_medium_excerpt_length',
            'post_group2_small_post_components' => 'group2_small_components',
            'post_group2_small_post_item_template' => 'group2_small_item_template',
            'post_group2_small_post_excerpt_length' => 'group2_small_excerpt_length',
            
            'post_slider_effect' => 'slider_effect',
            'post_slider_nav_style' => 'slider_nav_style',
            'post_slider_size' => 'slider_size',
            'post_slider_title_background' => 'slider_title_background',
        ];
        
        $old_std_arr = [
            'blog_grid_item_card' => 'none',
            'blog_grid_item_spacing' => 'normal',
            'blog_grid_item_template' => '1',
            'blog_grid_item_align' => 'left',
            'blog_grid_item_border' => 'false',
            'blog_grid_item_border_color' => '',
            
            'blog_grid_thumbnail' => 'landscape',
            'blog_grid_thumbnail_custom' => '',
            'blog_grid_thumbnail_placeholder' => 'true',
            'blog_grid_default_thumbnail' => '',
            'blog_grid_thumbnail_shape' => 'acute',
            'blog_grid_thumbnail_hover_effect' => 'none',
            'blog_grid_thumbnail_hover_logo' => '',
            'blog_grid_thumbnail_hover_logo_width' => '40%',
            'blog_grid_thumbnail_showing_effect' => 'none',
            
            'blog_grid_title_tag' => 'h2',
            'blog_grid_title_size' => 'normal',
            'blog_grid_excerpt_length' => '22',
            'blog_grid_excerpt_hellip' => 'false',
            'blog_grid_excerpt_size' => 'normal',
            'blog_grid_excerpt_color' => '',
            'blog_grid_excerpt_more_style' => 'simple',
            'blog_grid_excerpt_more_text' => '',
            
            'blog_grid_big_first_post' => 'true',
            
            'blog_grid_list_spacing' => 'normal',
            'blog_grid_list_sep' => 'true',
            'blog_grid_list_sep_style' => 'solid',
            'blog_grid_list_sep_color' => '',
            'blog_grid_list_valign' => 'top',
            'blog_grid_thumbnail_position' => 'left',
            'blog_grid_thumbnail_width' => '',
            'blog_grid_list_mobile_layout' => 'grid',
            
            'blog_standard_thumbnail_type' => 'simple',
            'blog_standard_thumbnail_header_order' => 'header',
            'blog_standard_content_excerpt' => 'content',
            'excerpt_length' => '55',
            'blog_standard_header_align' => 'left',
            'blog_column_layout' => '1',
            'blog_dropcap' => 'false',
            
            'post_newspaper_thumbnail_type' => 'simple',
            'post_newspaper_content_excerpt' => 'content',
            'post_newspaper_header_align' => 'left',
            
            'vertical_post_thumbnail_type' => 'simple',
            'vertical_post_thumbnail_position' => 'left',
            'vertical_post_excerpt_size' => 'medium',
            
            'big_post_content_excerpt' => 'excerpt',
            
            'post_group1_big_post_position' => 'left',
            'post_group1_big_post_ratio' => '2/3',
            'post_group1_sep_border' => 'false',
            'post_group1_sep_border_color' => '',
            'post_group1_big_post_components' => 'thumbnail,title,date,category,excerpt,excerpt_more',
            'post_group1_big_post_align' => 'center',
            'post_group1_big_post_item_template' => '2',
            'post_group1_big_post_excerpt_length' => '44',
            'post_group1_big_post_excerpt_more_text' => '',
            'post_group1_big_post_excerpt_more_style' => 'btn',
            'post_group1_small_post_components' => 'thumbnail,title,date,excerpt',
            'post_group1_small_post_item_template' => '2',
            'post_group1_small_post_list_spacing' => 'normal',
            
            'post_group2_columns_order' => '1a-3-1b',
            'post_group2_sep_border' => 'false',
            'post_group2_sep_border_color' => '',
            'post_group2_big_post_components' => 'thumbnail,title,date,category,excerpt,excerpt_more',
            'post_group2_big_post_align' => 'center',
            'post_group2_big_post_item_template' => '2',
            'post_group2_big_post_excerpt_length' => '32',
            'post_group2_big_post_excerpt_more_text' => '',
            'post_group2_big_post_excerpt_more_style' => 'btn',
            'post_group2_medium_post_components' => 'thumbnail,title,date,excerpt,excerpt_more',
            'post_group2_medium_post_item_template' => '2',
            'post_group2_medium_post_thumbnail' => 'medium',
            'post_group2_medium_post_excerpt_length' => '40',
            'post_group2_small_post_components' => 'thumbnail,title,date',
            'post_group2_small_post_item_template' => '2',
            'post_group2_small_post_excerpt_length' => '12',
            
            'post_slider_effect' => 'fade',
            'post_slider_nav_style' => 'text',
            'post_slider_size' => '1020x510',
            'post_slider_title_background' => 'false',
        ];
        
        $old_values = [];
        foreach ( $old_to_new as $old => $new ) {
            $old_values[ $new ] = get_theme_mod( 'wi_' . $old, $old_std_arr[ $old ] );
        }
        foreach ( $old_values as $new => $value ) {
            set_theme_mod( 'wi_' . $new, $value );
        }
        
        /**
         * components
         */
        $components = [
            'blog_grid_show_thumbnail' => 'thumbnail',
            'blog_grid_show_title' => 'title',
            'blog_grid_show_date' => 'date',
            'blog_grid_show_category' => 'category',
            'blog_grid_show_author' => 'author',
            'blog_grid_show_author_avatar' => 'author_avatar',
            'blog_grid_show_excerpt' => 'excerpt',
            'blog_grid_excerpt_more' => 'excerpt_more',
            'blog_grid_show_view' => 'view',
            'blog_grid_reading_time' => 'reading_time',
            'blog_grid_show_comment_link' => 'comment_link',
            'blog_standard_show_share' => 'share',
            'blog_standard_show_related' => 'related',
        ];
        
        $component_arr = [];
        $stds = [ 'thumbnail', 'title', 'date', 'category', 'excerpt', 'excerpt_more' ];
        foreach ( $components as $com_mod => $com ) {
            $std = in_array( $com, $stds ) ? 'true' : 'false';
            if ( get_theme_mod( 'wi_' . $com_mod, $std ) == 'true' ) {
                $component_arr[] =  $com;
            }
        }
        $component_arr = join( ',', $component_arr );
        set_theme_mod( 'wi_components', $component_arr );
        
        /**
         * thumbnail components
         */
        $components = [
            'blog_grid_format_indicator' => 'format_indicator',
            'blog_grid_thumbnail_index' => 'index',
            'blog_grid_thumbnail_view' => 'view',
            'blog_grid_thumbnail_review_score' => 'review',
        ];
        $stds = [ 'format_indicator' ];
        $component_arr = [];
        foreach ( $components as $com_mod => $com ) {
            $std = in_array( $com, $stds ) ? 'true' : 'false';
            if ( get_theme_mod( 'wi_' . $com_mod, $std ) == 'true' ) {
                $component_arr[] =  $com;
            }
        }
        $component_arr = join( ',', $component_arr );
        set_theme_mod( 'wi_thumbnail_components', $component_arr );
        
        set_theme_mod ( 'wi_migrated_to_45', true );
        
    }
    
    /**
     * v4.6
     * ----------------------------------------*/
    function update_46() {
        
        // move sidebars to theme_mod
        $sidebars = get_option( 'fox_sidebars' );
        if ( empty( $sidebars ) ) {
            $sidebars = [];
        }
        
        set_theme_mod( 'fox_sidebars', $sidebars );
        
        // final set
        set_theme_mod ( 'wi_migrated_to_46', true );
        
    }

}

new Fox_Updater();