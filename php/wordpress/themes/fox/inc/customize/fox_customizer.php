<?php
class Fox56_Customizer {

    public $fields = [];
    public $settings = []; // settings that $wp_customze will add later
    public $controls = []; // controls that $wp_customize will add later
    public $sections = []; // sections that $wp_customize will add later
    public $panels = []; // sections that $wp_customize will add later
    public $partials = []; // selective refresh partial pieces
    public $current_tab = false;
    public $current_field_tab = false;
    public $current_inner_tab = false;
    public $current_inner_tabs = false;

    public $tablet = '@media(max-width:1024px)';
    public $mobile = '@media(max-width:600px)';
    public $thumbnail_options = [];
    public $thumbnail_select = [
        'thumbnail' => 'Thumbnail (150x150)',
        'thumbnail-medium' => 'Landscape (480x384)',
        'thumbnail-square' => 'Square (480x480)',
        'thumbnail-portrait' => 'Portrait (480x600)',
        'thumbnail-large' => 'Large (720x480)',
        'medium' => 'Medium (no crop)',
        'large' => 'Large (no crop)',
        'full' => 'Full (original)',
        'custom' => 'Custom',
    ];
    public $typo_fields = [
        'face' => [
            'type' => 'select',
            'options' => [
                '' => '-- select --',
                'var(--font-heading)' => 'Font Heading',
                'var(--font-body)' => 'Font Body',
                'var(--font-nav)' => 'Font Menu',
                'var(--font-custom-1)' => 'Font Custom 1',
                'var(--font-custom-2)' => 'Font Custom 2',
    
                'Helvetica Neue' => 'Helvetica Neue',
                'Helvetica' => 'Helvetica',
                'Arial' => 'Arial',
                'Times' => 'Times',
                'Georgia' => 'Georgia',
                'monospace' => 'Monospace',
            ],
            'std' => '',
            'name' => 'Font',
            'col' => '1-1',
        ],
        'weight' => [
            'type' => 'select',
            'name' => 'Weight',
            'options' => [
                '' => '-- select --',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => 'Normal',
                '500' => '500',
                '600' => '600',
                '700' => 'Bold',
                '800' => '800',
                '900' => '900',
            ],
            'std' => '',
            'col' => '1-2',
        ],
        'style' => [
            'type' => 'select',
            'name' => 'Style',
            'options' => [
                '' => '-- select --',
                'normal' => 'Normal',
                'italic' => 'Italic',
            ],
            'std' => '',
            'col' => '1-2',
        ],
        /*
        'size_template' => [
            'type' => 'select',
            'name' => 'Size',
            'col' => '1-1',
            'options' => [
                '' => '-- select --',
                'supertiny' => 'Super Tiny',
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
                'large' => 'Large',
                'huge' => 'Huge',
                'custom' => 'Custom',
            ],
            'std' => '',
        ],
        */
        'size' => [
            'type' => 'text',
            'name' => 'Font size',
            'placeholder' => 'Eg. 20px',
            'col' => '2-5',
        ],
        'size_tablet' => [
            'type' => 'text',
            'name' => 'Font tablet',
            'col' => '2-5',
        ],
        'size_mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'col' => '1-5',
        ],
        'line_height' => [
            'type' => 'text',
            'name' => 'Line height',
            'placeholder' => 'Eg. 1.5',
            'col' => '1-3',
        ],
        'spacing' => [
            'type' => 'text',
            'name' => 'Spacing',
            'placeholder' => 'Eg. 1.5',
            'col' => '1-3',
        ],
        'transform' => [
            'type' => 'select',
            'name' => 'Transform',
            'col' => '1-3',
            'options' => [
                '' => '-- select --',
                'uppercase' => 'UPPERCASE',
                'lowercase' => 'lowercase',
                'capitalize' => 'Capitalize',
            ],
            'std' => '',
        ],
    ];
    public $builder;
    public $fontlist;

    public $conditional = []; // to run conditional for Customizer 
    public $tabs = []; // run tabs globally
    public $std_affects = []; // to run std_affects for Customizer 

    public $custom_fonts = []; // this will be extended AFTER init

    // autoincrement
    public $current_section = null;
    public $priority = 0;

    public $css = []; // css output will be printed later
    public $typography = []; // face, weights, font style..
    public $category_list = [];
    public $author_list = [];
    public $sidebar_list;

    function __construct() {

        /**
         * this will be used in wp_enequeue_scripts to detect which one is google font
         * this will be used in css to add fallback fonts
         */
        $json = file_get_contents( get_template_directory() . '/inc/customize/google-fonts-29062023.json' );
        $json_data = json_decode($json,true);
        $json_data['items'];
        $fontlist = [];
        foreach ( $json_data['items'] as $item ) {
            $fontlist[$item['family']] = [
                'category' => $item['category'],
                'subsets' => $item['subsets'],
                'variants' => $item['variants'],
            ];
        }
        $this->fontlist = $fontlist;

        $this->thumbnail_options = [
            'thumbnail' => get_template_directory_uri() . '/inc/customize/images/thumbnail.jpg',
            'thumbnail-medium' => get_template_directory_uri() . '/inc/customize/images/thumbnail-medium.jpg',
            'thumbnail-square' => get_template_directory_uri() . '/inc/customize/images/thumbnail-square.jpg',
            'thumbnail-portrait' => get_template_directory_uri() . '/inc/customize/images/thumbnail-portrait.jpg',
            'thumbnail-large' => get_template_directory_uri() . '/inc/customize/images/thumbnail-large.jpg',
            'medium' => get_template_directory_uri() . '/inc/customize/images/medium.jpg',
            'large' => get_template_directory_uri() . '/inc/customize/images/large.jpg',
            'full' => get_template_directory_uri() . '/inc/customize/images/full.jpg',
            'custom' => get_template_directory_uri() . '/inc/customize/images/custom.jpg',
        ];

        $sidebar_list = [ '' => '--- NONE ---' ];
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
        }
        $this->sidebar_list = $sidebar_list;

        if ( is_customize_preview() ) {
            $get = get_categories([
                'number' => 400,
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false,
            ]);
            foreach ( $get as $get_cat ) {
                $this->category_list[ 'cat--' . $get_cat->slug ] = $get_cat->name;
            }
        
            $get = get_users([
                'has_published_posts' => true,
            ]);
            foreach ( $get as $get_author ) {
                $this->author_list[ 'author--' . $get_author->ID ] = $get_author->display_name;
            }
        }
    }

    function add_panel( $name, $args = [] ) {
        $this->panels[ $name ] = $args;
    }

    function add_section( $name, $args = [] ) {
        $this->sections[ $name ] = $args;
    }

    /**
     * this function is to add common partial group for many elements
     */
    function add_partial( $id, $args ) {
        if ( ! isset( $args['settings'])) {
            $args['settings'] = [];
        }
        $this->partials[ $id ] = $args;
    }

    // std = [ desktop => 12, mobile => 20, tablet => 16 ], key = bulider[section1[blah[ desktop]]]
    // we wanna return 12
    function helper_std( $std, $key ) {
        $key = str_replace( ']', '', $key );
        $explode = explode( '[', $key );
        $k = $explode[ count( $explode ) -1 ];
        return isset( $std[$k] ) ? $std[$k] : null;
    }

    /**
     * process args to make it easier
     * RETURN args
     */
    function pre_add_field( $args ) {

        /**
         * rule: no tab needed
         */
        if ( ! isset( $args['tab'] ) && $this->current_tab ) {
            $args['tab'] = $this->current_tab;
        } elseif ( isset( $args['tab'])) {
            $this->current_tab = $args['tab'];
        }
        if ( isset( $args['endtab'])) {
            $this->current_tab = false;
        }

        /**
         * rule: no section needed
         */
        if ( ! isset( $args['section'] ) && $this->current_section ) {
            $args['section'] = $this->current_section;
        } elseif ( isset( $args['section'])) {
            $this->current_section = $args['section'];
        }

        /**
         * priority: auto increment
         */
        if ( ! isset( $args[ 'priority' ] ) ) {
            $this->priority += 2;
            $args[ 'priority' ] = $this->priority;
        } else {
            $this->priority = $args[ 'priority' ];
        }

        /**
         * heading
         */
        $type = isset( $args['type'] ) ? $args['type'] : '';
        if ( 'heading' == $type ) {
            $heading = isset( $args['heading'] ) ? $args['heading'] : 'Place heading here';
            $args['std'] = $heading;
        }

        /**
         * title vs name
         */
        if ( isset( $args['title'])) {
            $args['name'] = $args['title'];
        }

        /**
         * desc
         */
        if ( isset( $args['desc'])) {
            $args['description'] = $args[ 'desc' ];
        }

        /**
         * --------------------------------------   HTML
         */
        if ( 'heading' == $type ) {

            $args['type'] = 'html';
            $heading = isset( $args['heading'] ) ? $args['heading'] : 'Place heading here';
            $args['html'] = '<div class="sep--customizer">' . $heading . '</div>';

        } elseif ( 'message' == $type ) {

            $args['type'] = 'html';
            $msg = isset( $args['msg'] ) ? $args['msg'] : 'Place msg here';
            $args['html'] = '<div class="sep--message">' . $msg . '</div>';

        } elseif ( 'tabs' == $type ) {
            
            $id = isset( $args['id'] ) ? $args['id'] : '';
            $args['type'] = 'html';
            $tabs = isset( $args['tabs'] ) ? $args['tabs'] : [];
            $ul = [];
            $first = true;
            if ( ! isset( $this->tabs[ $id ] ) ) {
                $this->tabs[ $id ] = [];
            }
            foreach ( $tabs as $tab_key => $tab_name ) {
                $active_cl = $first ? ' class="active"' : '';
                if ( $first ) {
                    $this->tabs[ $id ]['tab_active'] = $tab_key;
                }
                $first = false;
                $li = '<a data-tab="' . esc_attr( $tab_key ) . '"' . $active_cl . '>' . esc_html( $tab_name ) . '</a>';
                $ul[] = $li;

                if ( ! isset( $this->tabs[ $id ][ $tab_key] )) {
                    $this->tabs[ $id ][$tab_key] = [];
                }
            }
            $ul = join( "\n", $ul );
            $ul = '<div class="tabs56" data-tabs="' . esc_attr( $id ) . '">' . $ul . '</div>';
            $args['html'] = $ul;
            unset( $args['tabs'] );

        }

        /**
         * --------------------------------------   typography
         */
        if ( 'typography' == $type ) {

            $args['type'] = 'group';
            $args['typography'] = true; // THIS IS IMPORTANT
            $selector = isset( $args[ 'selector' ] ) ? $args[ 'selector' ] : '';
            if ( ! $selector ) {
                throw new Exception( 'Typography type must have a selector' );
            }
            $include = isset( $args[ 'include' ] ) ? $args[ 'include' ] : [];
            $exclude = isset( $args[ 'exclude' ] ) ? $args[ 'exclude' ] : [];

            $faces = [
                '' => '-- select --',
                'var(--font-heading)' => 'Font Heading',
                'var(--font-body)' => 'Font Body',
                'var(--font-nav)' => 'Font Menu',
                'var(--font-custom-1)' => 'Font Custom 1',
                'var(--font-custom-2)' => 'Font Custom 2',

                'Helvetica Neue' => 'Helvetica Neue',
                'Helvetica' => 'Helvetica',
                'Arial' => 'Arial',
                'Times' => 'Times',
                'Georgia' => 'Georgia',
                'monospace' => 'Monospace',
            ];
            $faces = array_merge( $faces, $this->custom_fonts );

            $fields = [
                'face' => [
                    'type' => 'select',
                    'options' => $faces,
                    'std' => '',
                    'name' => 'Font',
                    'col' => '1-1',
                ],
                'weight' => [
                    'type' => 'select',
                    'name' => 'Weight',
                    'options' => [
                        '' => '-- select --',
                        '100' => '100',
                        '200' => '200',
                        '300' => '300',
                        '400' => 'Normal',
                        '500' => '500',
                        '600' => '600',
                        '700' => 'Bold',
                        '800' => '800',
                        '900' => '900',
                    ],
                    'std' => '',
                    'col' => '1-2',
                ],
                'style' => [
                    'type' => 'select',
                    'name' => 'Style',
                    'options' => [
                        '' => '-- select --',
                        'normal' => 'Normal',
                        'italic' => 'Italic',
                    ],
                    'std' => '',
                    'col' => '1-2',
                ],
                'size' => [
                    'type' => 'text',
                    'name' => 'Font size',
                    'placeholder' => 'Eg. 20px',
                    'col' => '2-5',
                ],
                'size_tablet' => [
                    'type' => 'text',
                    'name' => 'Font tablet',
                    'col' => '2-5',
                ],
                'size_mobile' => [
                    'type' => 'text',
                    'name' => 'Mobile',
                    'col' => '1-5',
                ],
                'line_height' => [
                    'type' => 'text',
                    'name' => 'Line height',
                    'placeholder' => 'Eg. 1.5',
                    'col' => '1-3',
                ],
                'spacing' => [
                    'type' => 'text',
                    'name' => 'Spacing',
                    'placeholder' => 'Eg. 1.5',
                    'col' => '1-3',
                ],
                'transform' => [
                    'type' => 'select',
                    'name' => 'Transform',
                    'col' => '1-3',
                    'options' => [
                        '' => '-- select --',
                        'uppercase' => 'UPPERCASE',
                        'lowercase' => 'lowercase',
                        'capitalize' => 'Capitalize',
                        'none' => 'None',
                    ],
                    'std' => '',
                ],
            ];

            if ( ! empty( $include ) ) {
                foreach ( $fields as $k => $field ) {
                    if ( ! in_array( $k, $include ) ) {
                        unset( $fields[$k]);
                    }
                }
            }

            if ( ! empty( $exclude ) ) {
                foreach ( $fields as $k => $field ) {
                    if ( in_array( $k, $exclude ) ) {
                        unset( $fields[$k]);
                    }
                }
            }

            $css = [
                [
                    'selector' => $selector,
                    'property' => 'font-family',
                    'use' => 'face',
                ],
                [
                    'selector' => $selector,
                    'property' => 'font-weight',
                    'use' => 'weight',
                ],
                [
                    'selector' => $selector,
                    'property' => 'font-style',
                    'use' => 'style',
                ],
                [
                    'selector' => $selector,
                    'property' => 'font-size',
                    'use' => 'size',
                    'unit' => 'px',
                ],
                [
                    'selector' => $selector,
                    'property' => 'font-size',
                    'use' => 'size_tablet',
                    'unit' => 'px',
                    'media_query' => $this->tablet,
                ],
                [
                    'selector' => $selector,
                    'property' => 'font-size',
                    'use' => 'size_mobile',
                    'unit' => 'px',
                    'media_query' => $this->mobile,
                ],
                [
                    'selector' => $selector,
                    'property' => 'line-height',
                    'use' => 'line_height',
                ],
                [
                    'selector' => $selector,
                    'property' => 'letter-spacing',
                    'use' => 'spacing',
                    'unit' => 'px',
                ],
                [
                    'selector' => $selector,
                    'property' => 'text-transform',
                    'use' => 'transform',
                ],
            ];

            if ( ! empty( $include ) ) {
                foreach ( $css as $k => $css_piece ) {
                    if ( ! in_array( $css_piece['use'], $include ) ) {
                        unset( $css[$k]);
                    }
                }
            }

            if ( ! empty( $exclude ) ) {
                foreach ( $css as $k => $css_piece ) {
                    if ( in_array( $css_piece['use'], $exclude ) ) {
                        unset( $css[$k]);
                    }
                }
            }

            $args[ 'css' ] = array_values( $css );
            $args[ 'fields' ] = $fields;

            /**
             * std
             */
            $std = isset( $args['std'] ) ? $args['std'] : [];
            $std = wp_parse_args( $std, [
                'face' => '',
                'weight' => '',
                'style' => '',
                'size' => '',
                'size_tablet' => '',
                'size_mobile' => '',
                'line_line' => '',
                'spacing' => '',
                'transform' => '',
            ]);
            $args['std'] = $std;

        }

        /**
         * --------------------------------------   background
         */
        if ( 'background' == $type ) {

            $args['type'] = 'group';
            $selector = isset( $args[ 'selector' ] ) ? $args[ 'selector' ] : '';
            if ( ! $selector ) {
                throw new Exception( 'background type must have a selector' );
            }
            $include = isset( $args[ 'include' ] ) ? $args[ 'include' ] : [];
            $exclude = isset( $args[ 'exclude' ] ) ? $args[ 'exclude' ] : [];

            $fields = [
                'color' => [
                    'type' => 'color',
                    'name' => 'Background Color',
                    'col' => '1-1',
                ],
                'image' => [
                    'type' => 'image',
                    'name' => 'Background image',
                    'col' => '1-1',
                ],
                'size' => [
                    'type' => 'select',
                    'name' => 'Background size',
                    'col' => '1-2',
                    'options' => [
                        'cover' => 'Cover',
                        'contain' => 'Contain',
                        'auto' => 'Auto',
                    ],
                ],
                'position' => [
                    'type' => 'select',
                    'name' => 'Background position',
                    'col' => '1-2',
                    'options' => [
                        'left top' => 'Top left',
                        'center top' => 'Top center',
                        'right top' => 'Top right',

                        'left center' => 'Center left',
                        'center center' => 'Center center',
                        'right center' => 'Center right',

                        'left bottom' => 'Bottom left',
                        'center bottom' => 'Bottom center',
                        'right bottom' => 'Bottom right',
                    ],
                ],
                'repeat' => [
                    'type' => 'select',
                    'name' => 'Repeat',
                    'col' => '1-2',
                    'options' => [
                        'no-repeat' => 'No repeat',
                        'repeat' => 'Repeat',
                        'repeat-x' => 'Repeat X',
                        'repeat-y' => 'Repeat Y',
                    ],
                ],
                'attachment' => [
                    'type' => 'select',
                    'col' => '1-2',
                    'name' => 'Scroll',
                    'options' => [
                        'scroll' => 'Scroll',
                        'fixed' => 'Fixed',
                    ],
                ],
            ];

            $css = [
                [
                    'property' => 'background-color',
                    'selector' => $selector,
                    'use' => 'color',
                ],
                /**
                 * yes, we have image ID but we'll use image__src
                 */
                [
                    'property' => 'background-image',
                    'selector' => $selector,
                    'use' => 'image__src',
                    'value_pattern' => 'url($)',
                ],
                /*
                [
                    'property' => 'background-image',
                    'selector' => $selector,
                    'use' => 'image',
                    'value_pattern' => 'url($)',
                    'compute' => function( $id ) {
                        return wp_get_attachment_url( intval( $id ) );
                    }
                ],
                */
                [
                    'property' => 'background-size',
                    'selector' => $selector,
                    'use' => 'size',
                ],
                [
                    'property' => 'background-position',
                    'selector' => $selector,
                    'use' => 'position',
                ],
                [
                    'property' => 'background-attachment',
                    'selector' => $selector,
                    'use' => 'attachment',
                ],
                [
                    'property' => 'background-repeat',
                    'selector' => $selector,
                    'use' => 'repeat',
                ],
            ];

            $std = isset( $args[ 'std' ] ) ? $args[ 'std' ] : [];
            $std = wp_parse_args( $std, [
                'color' => '',
                'size' => 'cover',
                'position' => 'center center',
                'repeat' => 'no-repeat',
                'attachment' => 'scroll'
            ]);

            $args[ 'fields' ] = $fields;
            $args[ 'std' ] = $std;
            $args[ 'css' ] = $css;

        }

        return $args;
    }

    /**
     * return $field after processed
     */
    function pre_builder_field( $field = [] ) {

        /**
         * rule: no tab needed
         */
        if ( ! isset( $field['tab'] ) && $this->current_field_tab ) {
            $field['tab'] = $this->current_field_tab;
        } elseif ( isset( $field['tab'])) {
            $this->current_field_tab = $field['tab'];
        }
        if ( isset( $field['endtab'])) {
            $this->current_field_tab = false;
        }

        /**
         * rule: no innertab needed
         */
        if ( ! isset( $field['inner_tab'] ) && $this->current_inner_tab ) {
            $field['inner_tab'] = $this->current_inner_tab;
        } elseif ( isset( $field['inner_tab'])) {
            $this->current_inner_tab = $field['inner_tab'];
        }
        if ( isset( $field['end_inner_tab'])) {
            $this->current_inner_tab = false;
        }

        /**
         * rule: no inner_tabs needed
         */
        if ( ! isset( $field['inner_tabs'] ) && $this->current_inner_tabs ) {
            $field['inner_tabs'] = $this->current_inner_tabs;
        } elseif ( isset( $field['inner_tabs'])) {
            $this->current_inner_tabs = $field['inner_tabs'];
        }
        if ( isset( $field['end_inner_tabs'])) {
            $this->current_inner_tabs = false;
        }

        /**
         * rule: heading
         */
        $type = isset( $field['type'] ) ? $field['type'] : '';
        if ( 'heading' == $type ) {
            $field['type'] = 'html';
            $heading = isset( $field['heading'] ) ? $field['heading'] : 'Place heading here';
            $field['std'] = '<h2 class="sep--builder">' . $heading . '</h2>';
        }

        /**
         * title/name
         */
        if ( isset( $field['title']) ) {
            $field['name'] = $field['title'];
        }

        return $field;

    }

    /**
     * so this function does 2 things simultaneously
     * add_settings
     * add_control
     * 
     * for normal types: text, textarea, select, radio.. only 1 setting being added
     * for advanced types: builder, group, dimensions, responsive.. several settings will be added
     * but each time, only 1 control will be added
     *
     * this function will output 4 things: $settings / $control_args / $css / $partials
     * 
     */
    function add_field( $args ) {

        $args = $this->pre_add_field( $args );

        extract(wp_parse_args( $args, [
            'id' => '',
            'type' => '',
            'name' => '',
            'desc' => '',
            'section' => '',
            'options' => [],
            'std' => null,
            'tab' => '',
            'transport' => null,
            'fields' => [],
        ]));

        $control_args = [];
        if ( ! $type ) {
            throw new Exception( "No type for: $id" );
        }

        switch( $type ) {

            /* Normal Fields
            ------------------------------------------------------------------------ */
            case 'text' :
            case 'textarea' :
            case 'select' :
            case 'checkbox';
            case 'radio' :
            case 'select' :
            case 'number' :
            case 'group' :
            case 'heading' :
            case 'fonts' :
            case 'color' :
            case 'image' :
            case 'radio_image' :
            case 'html' :
            case 'sortable' :
            case 'multicheckbox' :

                /**
                 * setting
                 */
                $setting_args = [];

                if ( isset( $args[ 'std' ] ) ) {
                    $setting_args['default'] = $args['std'];
                }
                if ( isset( $args[ 'refresh' ] ) ) {
                    $setting_args[ 'transport' ] = 'postMessage';
                }
                if ( isset( $args[ 'transport' ]) ) {
                    $setting_args['transport'] = $args['transport'];
                }
                
                $setting_name = $id;
                $settings = [ 'default' => $setting_name ];

                $type_arr = [
                    'heading' => 'fox56_heading',
                    'fonts' => 'fox56_fonts',
                    'color' => 'fox56_color',
                    'image' => 'fox56_image',
                    'radio_image' => 'fox56_radio_image',
                    'html' => 'fox56_html',
                    'multicheckbox' => 'fox56_multicheckbox',
                    
                    'text' => 'fox56_text',
                    'textarea' => 'fox56_textarea',
                    'select' => 'fox56_select',
                    'radio' => 'fox56_radio',
                    'number' => 'fox56_number',
                    'checkbox' => 'fox56_checkbox',
                ];

                /**
                 * control
                 */
                $control_args = [
                    'data-id' => $id,
                    'label' => $name,
                    'description' => $desc,
                    'section' => $section,
                    'settings' => $settings,
                    'type' => isset( $type_arr[ $type] ) ? $type_arr[ $type] : $type,
                ];

                /**
                 * group fields, image src problem
                 */
                if ( 'group' == $type && is_customize_preview() ) {
                    foreach ( $fields as $k => $field ) {
                        if ( 'image' == $field['type'] ) {
                            $value = get_theme_mod( $id, [] );
                            $image_id = isset( $value[ $k ] ) ? $value[ $k ] : 0;
                            if ( $image_id ) {
                                $image_src = wp_get_attachment_url( $image_id );
                                if ( $image_src ) {
                                    $field[ 'src' ] = $image_src;
                                    $fields[ $k ] = $field;
                                }
                            }
                        }
                    }
                }
                
                /**
                 * CSS
                 */
                if ( isset( $args['css']) ) {
                    $setting_args[ 'transport' ] = 'postMessage';
                    $value = get_theme_mod( $id, $std );

                    // in case we have range for values
                    if ( isset( $args['range'] ) && is_array( $value ) ) {
                        $range = $args['range'];
                        foreach ( $range as $key => $range_value ) {
                            $key_std = $range[ $key ][0];
                            $key_min = $range[ $key ][1];
                            $key_max = $range[ $key ][2];
                            $particular_value = isset( $value[ $key ] ) && $value[ $key ] ? $value[ $key ] : $key_std;
                            $particular_value = max( $particular_value, $key_min );
                            $particular_value = min( $particular_value, $key_max );
                            $value[ $key ] = $particular_value;
                        }
                    }
                    foreach ( $args['css'] as $i => $arr ) {
                        if ( 'group' != $type ) {
                            $arr[ 'value'] = $value;
                        } else {
                            $use = isset( $arr['use'] ) ? $arr['use'] : '';
                            $arr['value'] = isset( $value[$use] ) ? $value[$use] : '';
                        }
                        $arr[ 'id' ] = $id;
                        $args['css'][ $i ] = $arr;
                    }
                    $this->css = array_merge( $this->css, $args['css'] );

                    /**
                     * TYPOGRAPHY
                     */
                    if ( isset( $args['typography'] ) && $args['typography'] ) {
                        /**
                         * case body, heading, nav, we alter a little bit
                         * this is to load weight
                         */
                        if ( 'body_typography' == $id ) {
                            $args['css'][] = [
                                'selector' => $selector,
                                'property' => 'font-family',
                                'value' => 'var(--font-body)',
                            ];
                        } elseif ( 'heading_typography' == $id ) {
                            $args['css'][] = [
                                'selector' => $selector,
                                'property' => 'font-family',
                                'value' => 'var(--font-heading)',
                            ];
                        } elseif ( 'nav_typography' == $id ) {
                            $args['css'][] = [
                                'selector' => $selector,
                                'property' => 'font-family',
                                'value' => 'var(--font-nav)',
                            ];
                        }
                        $this->typography[] = $args['css'];
                    }
                }

                /**
                 * Choices
                 */
                if ( isset( $args['options'])) {
                    $control_args[ 'choices' ] = $args['options'];
                }

                /**
                 * partial refresh
                 */
                if ( isset( $args[ 'refresh' ] ) ) {
                    $setting_args[ 'transport' ] = 'postMessage';
                    /**
                     * case str
                     * it's an existing partial
                     */
                    if ( is_string( $args['refresh'] ) ) {
                        $partial_id = $args['refresh'];
                        if ( isset( $this->partials[$partial_id] ) ) {
                            $this->partials[ $partial_id ]['settings'][] = $id;
                        }
                    } else {
                        $this->partials[ $id ] = $args[ 'refresh' ];
                    }
                }

                /**
                 * json
                 */
                $json = [];
                if ( isset( $args[ 'css' ] ) ) {
                    $json['css'] = $args[ 'css' ];
                }
                if ( isset( $args[ 'hint' ] ) ) {
                    $json['hint'] = $args[ 'hint' ];
                }
                if ( 'group' == $type ) {
                    $json[ 'fields' ] = $fields;
                }
                if ( isset( $args['heading'] ) ) {
                    $json['heading' ] = $args['heading'];
                }
                if ( isset( $args['msg'] ) ) {
                    $json['msg' ] = $args['msg'];
                }
                if ( isset( $args['msg_before'] ) ) {
                    $json['msg_before' ] = $args['msg_before'];
                }
                if ( 'fonts' == $type || 'radio_image' == $type || 'sortable' == $type || 'multicheckbox' ) {
                    $json['choices'] = $options;
                }
                if ( 'html' == $type ) {
                    $json['html'] = isset( $args['html'] ) ? $args['html'] : '';
                }
                if ( isset( $args['tabs'] ) && isset( $args['tab'] ) ) {
                    $tabs_name = $args['tabs'];
                    $tab = $args['tab'];
                    if ( ! isset( $this->tabs[ $tabs_name ] ) ) {
                        $this->tabs[ $tabs_name ] = [];
                    }
                    if ( ! isset( $this->tabs[ $tabs_name ][ $tab ] ) ) {
                        $this->tabs[ $tabs_name ][ $tab ] = []; // list of settings in this tab
                    }
                    $this->tabs[ $tabs_name ][ $tab ][] = $id; // add this settings
                }
                if ( 'image' == $type && is_customize_preview() ) {
                    $img_id = get_theme_mod( $id );
                    if ( $img_id ) {
                        $img = wp_get_attachment_image( $img_id, 'medium' );
                        $json[ 'image' ] = $img;
                    }
                }
                // multiselect
                if ( 'select' == $type && isset( $args['multiple'] ) ) {
                    $json['multiple'] = $args['multiple'];
                }
                if ( isset( $args['placeholder'] ) ) {
                    $json[ 'placeholder' ] = $args['placeholder'];
                }
                // min, max, step
                if ( 'number' == $type ) {
                    if ( isset( $args['min']) ) {
                        $json['min'] = $args['min'];
                    }
                    if ( isset( $args['max']) ) {
                        $json['max'] = $args['max'];
                    }
                    if ( isset( $args['step']) ) {
                        $json['step'] = $args['step'];
                    }
                }

                if ( ! empty( $json ) ) {
                    $control_args[ 'json' ] = $json;
                }

                /**
                 * correct control
                 */
                if ( 'color' == $type ) {
                    $control_args[ 'type' ] = 'fox56_color';
                } elseif ( 'image' == $type ) {
                    $control_args[ 'type' ] = 'fox56_image';
                } elseif ( 'group' == $type ) {
                    $control_args['control'] = 'Fox56_Group_Control';
                } elseif ( 'heading' == $type ) {
                    $control_args['control'] = 'Fox56_Heading_Control';
                }

                // final
                $this->settings[ $id ] = $setting_args;
 
            break;

            /* Builder
             * the model here:
             *      we'll have 2 builder settings: id[sectionlist], id[preload_sectionlist]
             *      for each section_id in the id[sectionlist], it's SINGLE setting instead of multiple
             *      ie. we don't have id[section_1] but we have the setting id__section1
             *      get_theme_mod( id__section ) is a separated thing from id
             *      each section manage its own, they're joined by id[sectionlist] to hold the order of sections
            ------------------------------------------------------------------------ */
            case 'builder' :

                /*
                $this->settings[ "{$id}[structure]" ] = [
                    'transport' => 'postMessage',
                    'default' => [
                        'sectionlist' => []
                    ]
                ];
                */

                $this->settings[ "{$id}[css]" ] = [
                    'transport' => 'postMessage',
                    'default' => [
                        'pseudo_id' => [
                            'pseudo_field_id' => 'pseudo_value'
                        ]
                    ]
                ];

                /*
                $this->settings[ "{$id}[sectionlist]" ] = [
                    'transport' => 'postMessage',
                    'default' => []
                ];
                */

                $preload_prefix = 'widget56--id--';
                $h2 = get_theme_mod( $id );

                $widget_id = 'sectionlist';
                $all_ids = fox56_builder_cone_ids( $widget_id );

                // $structure = isset( $h2[ 'structure' ] ) ? $h2[ 'structure' ] : [ 'sectionlist' => [] ];
                // $all_ids = array_keys( $structure );

                /**
                 * we cover 100 more
                 */
                $preload_ids = [];
                for( $i = 1; $i <= 100; $i++ ) {
                    $preload_ids[] = $preload_prefix . $i;
                }

                $mix_ids = array_merge( $all_ids, $preload_ids );
                $mix_ids = array_unique( $mix_ids );

                foreach( $mix_ids as $widget_id ) {
                    $this_std = [
                        'widget_id' => $widget_id,
                        'content' => []
                    ];
                    if ( 'sectionlist' == $widget_id ) {
                        $this_std = [
                            'type' => 'builder',
                            'widget_id' => 'sectionlist',
                            'content' => [],
                        ];
                    }
                    $this->settings[ $widget_id ] = [
                        'transport' => 'postMessage',
                        'default' => $this_std,
                    ];
                    $this->add_partial( $widget_id, [
                        'selector' => '.' . $widget_id,
                        'render_callback' => function() use ( $widget_id ) {
                            $widget_settings = get_theme_mod( $widget_id, [] );
                            $type = isset( $widget_settings['type'] ) ? $widget_settings['type'] : '';
                            global $builder_widgets;
                            // render it correspondingly according to its type
                            if ( ! isset( $builder_widgets[ $type ] ) ) {
                                return;
                            }
                            $instance = $builder_widgets[ $type ];
                            $widget_settings = $instance->process( $widget_settings );
                            $instance->render( $widget_settings );
                        },
                        'settings' => [ $widget_id ],
                        'fallback_refresh' => false,
                        'container_inclusive' => true,
                    ]);
                }

                $this->settings[ $id . '__css' ] = [
                    'transport' => 'postMessage',
                    'default' => []
                ];

                /*
                $this->settings[ $id . '[sectionlist]' ] = [
                    'transport' => 'postMessage',
                    'default' => []
                ];
                $this->settings[ "{$id}[foo]" ] = [
                    'transport' => 'postMessage',
                    'default' => [ 'cuong' ]
                ];
                */

                $control_args = [
                    'data-id' => $id,
                    'json' => [
                        'id' => $id,
                    ],
                    'label' => $name,
                    'section' => $section,
                    'settings' => [

                        // 'structure' => "{$id}[structure]",
                        'css' => "{$id}[css]",

                        // 'h2_widget_ids' => "{$id}[widget_ids]",
                        // $id . '__css' => $id . '__css',
                        // 'preload_prefix' => "{$id}[preload_prefix]",
                        
                        // 'sectionlist' => "{$id}[sectionlist]",
                        // 'preload_sectionlist' => "{$id}[foo]",
                    ],
                    'control' => 'Fox56_Builder_Control',
                ];

                /*

                $settings = [];
                $refresh_templates = isset( $args[ 'refresh_templates' ] ) ? $args[ 'refresh_templates' ] : [];
                
                /* -------------------------------------        this builder -- settings *
                $setting_args = [
                    'default' => [],
                    'type' => isset( $args[ 'setting_type'] ) ? $args[ 'setting_type'] : 'theme_mod',
                ];
                $this->settings[ "{$id}[sectionlist]" ] = [
                    'transport' => 'postMessage',
                ];
                $this->settings[ "{$id}[foo]" ] = [
                    'transport' => 'postMessage',
                    'default' => 'foo',
                ];
                $this->settings[ "{$id}[preload_sectionlist]" ] = [
                    'transport' => 'postMessage',
                ];

                $this->settings[ $id . '__css' ] = [
                    'transport' => 'postMessage',
                    'default' => [
                        'pseudo_id' => [
                            'pseudo_prop' => 'pseudo_value'
                        ],
                    ],
                ];

                /* -------------------------------------        this builder -- control *
                $control_args = [
                    'data-id' => $id,
                    'json' => [
                        'id' => $id,
                    ],
                    'label' => $name,
                    'section' => $section,
                    'settings' => [
                        'sectionlist' => "{$id}[sectionlist]",
                        'preload_sectionlist' => "{$id}[preload_sectionlist]",
                    ],
                    'control' => 'Fox56_Builder_Control',
                ];

                /* -------------------------------------        section list - preload *
                $section_data = get_theme_mod( $id, [] );
                $section_data = wp_parse_args( $section_data, [
                    'sectionlist' => [],
                    'preload_sectionlist' => []
                ]);
                $sectionlist = $section_data['sectionlist'];
                $preload_sectionlist = $section_data['preload_sectionlist'];
                $combined_sections = array_merge( $sectionlist, $preload_sectionlist );
                foreach ( $combined_sections as $section_id ) {
                    $this->settings[ $section_id ] = [
                        'transport' => 'postMessage',
                        'default' => [],
                    ];

                    /* -------------------------------------        refresh *
                    foreach ( $refresh_templates as $refresh_template_key => $refresh_template ) {
                        $selector = $refresh_template['selector'];
                        $selector = str_replace( '{{section}}', $section_id, $selector );
                        $render_callback = $refresh_template['render_callback' ];

                        $this->add_partial( "{$section_id}_{$refresh_template_key}", [
                            'selector' => $selector,
                            'render_callback' => function() use ( $render_callback, $section_id ) {
                                $render_callback( $section_id );
                            },
                            'settings' => [ $section_id ],
                            'fallback_refresh' => false,
                            'container_inclusive' => isset( $refresh_template['container_inclusive'] ) ? $refresh_template['container_inclusive'] : false,
                        ]);
                    }

                }
                */

            break;    

            default :
                print_r( $args );
            break;

        }

        /**
         * condition collector
         */
        if ( isset( $args['condition'] ) ) {
            $this->conditional[ $id ] = $args['condition'];
        }

        /**
         * std_affects collector
         */
        if ( isset( $args['std_affects'] ) ) {
            $this->std_affects[ $id ] = $args['std_affects'];
        }

        $this->controls[] = $control_args;

    }

    /**
     * add legacy fields
     * we convert args into args v5.6 then run $this->add_field
     */
    function add_field_legacy( $args ) {

        /**
         * shorthand
         */
        if ( isset( $args['shorthand'])) {
            $shorthand = $args['shorthand'];
            $this->shorthands[] = $shorthand;
            return;
        }
        switch( $shorthand ) {

            /* ----------------------------- enable */
            case 'enable' :
                $args = wp_parse_args( $args, [
                    'type' => 'select',
                    'options' => [
                        'true' => 'Yes',
                        'false' => 'No',
                    ],
                    'std' => 'true',
                ]);
            break;

            /* ----------------------------- enable */
            case 'padding-top' :
                $args = wp_parse_args( $args, [
                    'type' => 'select',
                    'options' => [
                        'true' => 'Yes',
                        'false' => 'No',
                    ],
                    'std' => 'true',
                ]);
            break;

        }

        /**
         * name
         */
        if ( isset( $args[ 'name']) ) {
            $args56['name'] = $args['name'];
        } elseif ( isset( $args['title'])) {
            $args56['name'] = $args['title'];
        }

        /**
         * description
         */
        if ( isset( $args[ 'desc']) ) {
            $args56['desc'] = $args['desc'];
        } elseif ( isset( $args['description'])) {
            $args56['desc'] = $args['description'];
        }

        /**
         * type is mandatory
         */
        $type = $args['type'];
        if ( in_array( $type, [ 'text', 'color', 'textarea', 'number', 'select', 'radio', 'checkbox' ] )) {
            $args56[ 'type' ] = $type;
        } else {
            echo "DEVELOP THIS: $type <br><br>";
            return;
        }

        /**
         * options
         */
        if ( isset( $args['options'] ) ) {
            $args56['options'] = $args['options'];
        }

        /**
         * std
         */
        if ( isset( $args[ 'std' ]) ) {
            $args56['std'] = $args['std'];
        }

        /**
         * CSS
         */
        if ( isset( $args[ 'selector' ] ) ) {
            
        }

        $this->add_field( $args56 );

    }

}