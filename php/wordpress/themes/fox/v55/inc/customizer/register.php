<?php
define( 'FOX_REGISTER_URL', get_template_directory_uri() . '/v55/inc/customizer/' );
define( 'FOX_REGISTER_PATH', get_template_directory() . '/v55/inc/customizer/' );

if ( !class_exists( 'Fox_Register' ) ) :
/**
 * Register Options
 * @since 1.0
 */
class Fox_Register {
    
    private static $prefix = 'wi_';
    
    /**
	 * Construct
	 */
	public function __construct() {
	}
    
    /**
	 * The one instance of Fox_Register
	 *
	 * @since 1.0
	 */
	private static $instance;

	/**
	 * Instantiate or return the one Fox_Register instance
	 *
	 * @since 1.0
	 *
	 * @return Fox_Register
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
    
    /**
     * Initiate the class
     * contains action & filters
     *
     * @since 1.0
     */
    public function init() {
    }
    
    /**
     * List of all options
     *
     * shorthand is a replacement for property, type and preview way. For instance, if you type shorthand: width then
     * preview should be css, type should be text, property should be width & unit often be px
     *
     * @since 1.0
     */
    public function options() {
        
        // Var
        $options = array();
        
        $all = fox_all_font_support();
        
        $layout_options = fox_archive_layout_support();
        
        if ( function_exists( 'fox_get_block_list' ) ) {
            $fox_block_list = fox_get_block_list();
        } else {
            $fox_block_list = [];
        }
        
        include FOX_REGISTER_PATH. 'home.php';
        include FOX_REGISTER_PATH . 'header.php';
        include FOX_REGISTER_PATH. 'footer.php';
        include FOX_REGISTER_PATH. 'blog.php';
        include FOX_REGISTER_PATH. 'single.php';
        include FOX_REGISTER_PATH. 'page.php';
        include FOX_REGISTER_PATH. 'design.php';
        
        /* SOCIAL - 150
        -------------------------------------------------------------------------------- */
        $fields = [];
        $dt = fox_social_data();
        foreach ( $dt as $b => $b_dt ) {
            $fields[ $b ] = $b_dt[ 'title' ];
        }
        $fields[ 'home' ] = esc_html( 'Home', 'wi' );
        $fields[ 'email' ] = esc_html( 'Email', 'wi' );
        
        $options[ 'social' ] = [
            'type'  => 'multiple_text',
            'name'  => 'Social URLs',
            
            'fields' => $fields,
            
            'section'     => 'social',
            'section_title'=> 'Social URLs',
            'section_priority'=> 150,
            
            'hint' =>  'Social profile urls',
        ];
        
        $options[ 'social_custom_1' ] = [
            'type'  => 'text',
            'placeholder' => 'eg. mastodon',
            'desc' => 'Enter your custom social icon, eg. mastodon. Select from <a href="https://fontawesome.com/v5/search?o=r&f=brands" target="_blank">this list</a>.',
            'name'  => 'Social Custom Icon 1',
            'hint' =>  'Social custom icon',
        ];
        
        $options[ 'social_custom_1_url' ] = [
            'type'  => 'text',
            'placeholder' => 'https://',
            'name'  => 'Social Custom Icon 1 URL',
        ];
        
        $options[ 'social_custom_1_name' ] = [
            'type'  => 'text',
            'placeholder' => 'Mastodon',
            'name'  => 'Social Custom Icon 1 Name',
        ];
        
        $options[ 'social_custom_2' ] = [
            'type'  => 'text',
            'placeholder' => 'eg. mastodon',
            'desc' => 'Enter your custom social icon, eg. mastodon. Select from <a href="https://fontawesome.com/v5/search?o=r&f=brands" target="_blank">this list</a>.',
            'name'  => 'Social Custom Icon 2',
            'hint' =>  'Social custom icon',
        ];
        
        $options[ 'social_custom_2_url' ] = [
            'type'  => 'text',
            'placeholder' => 'https://',
            'name'  => 'Social Custom Icon 2 URL',
        ];
        
        $options[ 'social_custom_2_name' ] = [
            'type'  => 'text',
            'placeholder' => 'Mastodon',
            'name'  => 'Social Custom Icon 2 Name',
        ];
        
        /* PERFORMANCE - since 5.5.2
        -------------------------------------------------------------------------------- */
        $options[] = array(
            'type' => 'html',
            'std'      => '<p class="fox-info">Please read <a href="https://docs.withemes.com/thefox/advanced-usage/optimize-your-site-performance/">this article</a> about optimizing your site and to have better score on Core Web Vitals</p>',
            
            'section' => 'performance',
            'section_title' => 'Performance',
            'section_priority'=> 153,
            
            'hint' => 'Performance'
        );
        
        $options[ 'font_display' ] = array(
            'type'      => 'select',
            'name'      => 'Font Display',
            'options'   => array(
                "auto" => 'auto',
                "swap" => 'swap',
            ),
            'std'  => 'auto',
            'desc' => 'If you care about performace, choose "swap".',
            
            'hint' =>  'Font display',
        );
        
        $options[ 'compress_files' ] = array(
            'name'      => 'Compress CSS & JS',
            'shorthand' => 'enable',
            'std'       => 'true',
            
            'hint' =>  'Compress CSS & JS',
        );
        
        $options[ 'disable_dashicons' ] = array(
            'name'      => 'Disable Dashicons?',
            'desc'      => 'Some 3rd party plugins will load this font icon. Disable it if you have not plan to use it.',
            'shorthand' => 'enable',
            'std'       => 'false',
            'options'   => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            
            'hint' =>  'Disable dashicons',
        );
        
        $options[ 'disable_polyfill' ] = array(
            'name'      => 'Disable Polyfill?',
            'shorthand' => 'enable',
            'std'       => 'false',
            'options'   => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            
            'hint' =>  'Disable polyfill',
        );
        
        /* QUICK TRANSLATION - 155
        -------------------------------------------------------------------------------- */
        $options[ 'translate' ] = [
            'type'  => 'multiple_text',
            'name'  => 'Quick Translation',
            
            'fields' => fox_quick_translation_support(),
            
            'section'     => 'translation',
            'section_title'=> esc_html__( 'Quick Translation', 'wi' ),
            'section_priority'=> 155,
            
            'hint' =>  'Translation',
        ];
        
        include FOX_REGISTER_PATH. 'mobile.php';
        
        /* AD
        -------------------------------------------------------------------------------- */
        $positions = [
            'single_top' => 'Top of single post',
            'single_before' => 'Before post content',
            'single_after' => 'After post content',
        ];
        
        foreach ( $positions as $pos => $label ) {
            
            $options[] = array(
                'type' => 'heading',
                'name'      => $label,

                'section'   => 'ad',
                'section_title' => 'Advertisement',
                'section_priority'=> 163,
                
                'hint' =>  'Advertisement: ' . $label,
            );
            
            $options[ $pos . '_code' ] = array(
                'type' => 'textarea',
                'name'      => 'Ad Code',
            );

            $options[ $pos . '_banner' ] = array(
                'type'      => 'image',
                'name'      => 'Banner',
            );
            
            $options[ $pos . '_banner_width' ] = array(
                'type'      => 'text',
                'placeholder'=> 'Eg. 728',
                'name'      => 'Banner width (px)',
            );

            $options[ $pos . '_banner_tablet' ] = array(
                'type'      => 'image',
                'name'      => 'Tablet image',
            );

            $options[ $pos . '_banner_phone' ] = array(
                'type'      => 'image',
                'name'      => 'Mobile image',
            );

            $options[ $pos . '_banner_url' ] = array(
                'type'      => 'text',
                'placeholder'=> 'https://',
                'name'      => 'Banner URL',
            );

            $options[ $pos . '_banner_url_target' ] = array(
                'type'      => 'select',
                'options'   => [
                    '_self' => 'Same tab',
                    '_blank' => 'New tab',
                ],
                'std' => '_blank',
                'name'      => 'Open link in',
            );
            
        }
        
        // OTHERS
        //
        $options[] = array(
            'type' => 'html',
            'std'      => '<p class="fox-info">For other positions, please drop (FOX) Ad widget in sidebars in Dashboard > Appearance > Widgets. It can be either before header, after header, 4 footer columns or the main sidebar. In each homepage builder section, it has option to insert ad too.</p>',
        );
        
        /* MISC - 170
        --------------------------------------------------------------------------------------------------------------- */
        // TWITTER USERNAME
        //
        $options[ 'twitter_username' ] = array(
            'type'      => 'text',
            'name'      => esc_html__( 'Twitter Username', 'wi' ),
            'desc'      => 'This option will be used for @via in tweet share button.',
            
            'section'     => 'misc',
            'section_title' => esc_html__( 'Miscellaneous', 'wi' ),
            'section_priority'=> 170,
            
            'hint' =>  'Twitter username',
        );
        
        $options[ 'exclude_pages_from_search' ] = array(
            'shorthand' => 'enable',
            'options'   => [
                'true' => 'Yes, please',
                'false' => 'No, thanks',
            ],
            'std'       => 'false',
            'name'      => 'Exclude pages from your site search result',
            'desc'      => 'Note: just your site search function, not Google search result.',

            'hint' =>  'Page in search result',
        );
        
        // LIVE
        //
        $options[ 'live_grid_list' ] = array(
            'shorthand' => 'enable',
            'name'      => 'Live Indicator for post grid, list',
            'std'       => 'false',
            
            'hint' =>  'Live Post Grid/List',
        );
        
        // TIME FASHION
        //
        $options[ 'time_style' ] = array(
            'type'      => 'select',
            'name'      => 'Time Fashion',
            'options'   => array(
                'standard' => 'March 22, 2019',
                'human' => '5 days ago',
            ),
            'std'       => 'standard',
            
            'hint' =>  'Time style: standard or ago',
        );
        
        // PUBLISH DATE
        //
        $options[ 'publish_update' ] = array(
            'type'      => 'select',
            'name'      => 'Display publishing/updated date',
            'options'   => array(
                'publish' => 'Publishing date',
                'update' => 'Updated date',
                'updated_recently' => 'Updated recently',
            ),
            'std'       => 'publish',
            'desc'      => 'If you site has fresh content updated frequently/recently, you might want to display updated date instead of publishing date.',
            
            'hint' =>  'Publishing/Updated date',
        );
        
        // SENTENCE BASE
        //
        $options[ 'sentence_base' ] = array(
            'name'      => 'Sentence Base',
            'type'      => 'select',
            'options'   => [
                'word' => 'Word',
                'char' => 'Character',
            ],
            'std'       => 'word',
            
            'hint' =>  'Sentence base: word or character',
        );
        
        // READING SPEED, since 5.1.2
        $options[ 'reading_speed' ] = array(
            'name'      => 'Reading Speed',
            'desc'      => 'Number of words per minute',
            'type'      => 'text',
            'std'       => '250',
            
            'hint'      =>  'Reading speed',
        );
        
        
        // AUTHOR AVATAR SIZE
        //
        $options[ 'author_avatar_width' ] = array(
            'shorthand' => 'width',
            'name'      => 'Author avatar size',
            'std'       => '32',
            'selector'  => '.meta-author-avatar',
            
            'hint' =>  'Author avatar size',
        );
        
        // LIGHTBOX
        //
        $options[ 'lightbox' ] = array(
            'name'      => 'Fox Image Lightbox?',
            'type'      => 'select',
            'options'   => [
                'true' => 'Yes, use it please!',
                'false' => 'No, disable theme lightbox!',
            ],
            'std'       => 'true',
            
            'hint' =>  'Enable/Disable Lightbox',
        );
        
        // ICON STYLE
        //
        $options[ 'icon_style' ] = [
            'type' => 'radio',
            'options' => [
                'smooth' => 'Smooth',
                'sharp' => 'Sharp',
            ],
            'std' => 'smooth',
            'name' => 'Icon style',
            
            'hint' => 'Icon smooth/sharp style',
        ];
        
        $options[ 'social_icon_shape' ] = [
            'type' => 'radio',
            'options' => [
                'light' => 'Simple Light',
                'square' => 'Square',
            ],
            'std' => 'light',
            'name' => 'Social icons shape?',
            
            'hint' => 'Social icon shape',
        ];
        
        // CODE
        //
        $options[ 'header_code' ] = array(
            'type'      => 'textarea',
            'name'      => 'Custom header code',
            'desc'      => 'Add any code inside <head> tag. Don\'t write anything unless you understand what you\'re doing.',
            
            'hint' =>  'Header code',
        );
        
        // COMMENT SHORTCODE
        //
        $options[ 'comment_shortcode' ] = array(
            'type'      => 'textarea',
            'name'      => 'Comment Shortcode',
            'desc'      => 'If your comment plugin (like Facebook Comments or Disqus Comments) supports a shortcode, please put it here. If you need to disable post normal comments, go to "Single Post > Show/Hide"',
            
            'hint' => 'Comment shortcode',
        );
        
        /* Page 404
        ---------------------------------------------------- */
        $options[] = [
            'type' => 'heading',
            'name' => 'Page 404',
        ];
        
        $options[ '404_title' ] = array(
            'type'      => 'text',
            'name'      => 'Page 404 title',
            'placeholder' => 'Page Not Found',

            'hint' =>  'Page 404',
        );

        $options[ 'page_404_message' ] = array(
            'type'      => 'textarea',
            'name'      => 'Page 404 message',
        );

        $options[ 'page_404_searchform' ] = array(
            'shorthand' => 'enable',
            'std'       => 'true',
            'name'      => 'Page 404 search form',
        );
        
        /* Elementor
        ---------------------------------------------------- */
        $options[] = [
            'type' => 'heading',
            'name' => 'Elementor',
        ];
        
        $options[ 'revert_elementor_heading' ] = [
            'shorthand' => 'enable',
            'std' => 'false',
            'name' => 'Revert Elementor Heading',
            'desc' => 'Fox theme overrides Elementor Heading widget by mistake but for backward compatibility, we couldn\'t change that. By enabling this option, you will have both Fox Heading and Elementor Heading widgets.',
            'hint' => 'Revert Elementor Heading'
        ];
        
        // @hook `fox_options` so that outer options are welcome
        $options = apply_filters( 'fox_options', $options );
        
        require get_template_directory() . '/v55/inc/customizer/processor.php';
        
        return $final;
        
    }
    
}

endif; // class exists