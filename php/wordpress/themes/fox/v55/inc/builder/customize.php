<?php
/**
 * return array of customize options to use in Customize
 * @since 4.5
 */
function fox_customize_post_layout_options() {
    
    // ------------------------------------------------------------------------------------------------------------------------
    $options = [
        
        'components' => [
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
                'share' => 'Share icons (only for standard layout)',
                'related' => 'Related posts (for standard/newspaper)',
            ],
            'std' => 'thumbnail,title,date,category,excerpt,excerpt_more,share',
            'name' => 'Components',
            
            'section' => 'blog_general',
            'section_title' => 'Post Item (Grid, Masonry, List)',
            
            'panel' => 'blog',
            
            'hint' => 'Blog item components',
        ],
        
        /**
         * General option for the layout
         */
        'column' => [
            'type'      => 'select',
            'name'      => 'Column?',
            'options'   => fox_column_support(),
            'std'       => '3',
            
            'hint' => 'Grid/Masonry layout column',
        ],
        
        'first_standard' => [
            'type'      => 'select',
            'name'      => 'First post is standard layout?',
            'desc'      => 'This applies for layout Grid, List',
            'options'   => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std'       => 'false',
            
            'hint' => 'First post standard?',
        ],
        
        'big_first_post' => [
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'true',
            
            'name' => '[MASONRY] First post big?',
            
            'desc'      => 'This applies for layout Masonry',
            
            'hint' => 'First post big?',
        ],
        
        'masonry_item_creative' => [
            'shorthand' => 'enable',
            'name'      => '[MASONRY] Creative Item',
            'desc'      => 'This applies for layout Masonry. For posts having portrait-sized thumbnail, it will set item layout creatively, with thumbnail on the left.',
            'options'   => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std'       => 'false',
            
            'hint' => 'Masonry Creative Item',
        ],
        
        'item_card' => [

            'name' => 'Card Style',

            'type' => 'select',
            'options' => fox_card_style_support(),
            'std' => 'none',

            'desc'      => 'This applies for layout Grid, List, Masonry',
            
            'hint' => 'Post item card style?',

        ],

        'item_spacing' => [

            'name' => 'Item Spacing',

            'type' => 'select',
            'options' => fox_item_spacing_support(),
            'std' => 'normal',

            'desc'      => 'This applies for layout Grid, Masonry',
            
            'hint' => 'Post item spacing',

        ],

        'item_template' => [

            'name' => 'Elements order',
            'type' => 'select',

            'options' => fox_item_template_support(),

            'std' => '1',

            'desc'      => 'This applies for layout Grid, List, Masonry',
            
            'hint' => 'Post item elements order',

        ],

        'item_border' => [

            'name' => 'Grid border?',
            'desc' => 'The vertical border between grid items?',
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'false',

            'desc'      => 'This applies for layout Grid, Masonry',
            
            'hint' => 'Post item border',

        ],

        'item_border_color' => [

            'name' => 'Border color?',
            'type' => 'color',
            'desc'      => 'This applies for layout Grid, Masonry',

        ],
        
        'align' => [

            'name' => 'Item Align',
            'type' => 'select',

            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),

            'std' => 'left',

            'desc'      => 'This applies for layout Grid, Masonry',
            
            'hint' => 'Post item align',

        ],
        
        'list_spacing' => [
            'type' => 'select',
            'name' => 'Spacing between list items',
            'options' => fox_list_spacing_support(),
            'std' => 'normal',

            'desc'      => 'This applies for layout List',
            
            'hint' => 'Post list spacing',
        ],
        
        'list_sep' => [
            'type' => 'select',
            'std' => 'true',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'name' => 'Use separator line between list posts',

            'desc'      => 'This applies for layout List',
            
            'hint' => 'Post list separator',
        ],
        
        'list_sep_style' => [
            'type' => 'select',
            'options' => fox_list_sep_style_support(),
            'std' => 'solid',
            'name' => 'List sep border style',
            
            'desc'      => 'This applies for layout List',
        ],

        'list_sep_color' => [
            'type'      => 'color',
            'name' => 'Separator color',
            'desc'      => 'This applies for layout List',
        ],
        
        'list_valign' => [
            'type' => 'select',
            'options' => [
                'top' => 'Top',
                'middle' => 'Middle',
                'bottom' => 'Bottom',
            ],
            'std' => 'top',
            'name' => 'Item vertical alignment',
            
            'desc'      => 'This applies for layout List',
            
            'hint' => 'Post list vertical align',
        ],
        
        'list_mobile_layout' => [
            'type' => 'select',
            'options' => [
                'grid' => 'Stack',
                'list' => 'List',
            ],
            'std' => 'grid',
            'name' => 'List item layout on mobile:',

            'desc'      => 'This applies for layout List',
            
            'hint' => 'Post list mobile layout',
        ],
        
        /**
         * Thumbnail
         */
        'heading_thumbnail' => [
            'type' => 'heading',
            'name' => 'Thumbnail',
        ],
        
        'thumbnail' => [
            'type' => 'select',
            'options' => fox_thumbnail_support(),
            'std' => 'landscape',
            'toggle' => [
                'custom' => [ 'thumbnail_custom' ],
            ],
            'name' => 'Thumbnail',
            
            'desc'      => 'This applies for layout Grid, List',
            'hint' => 'Thumbnail size',
            
            'hint' => 'Post general thumbnail',
        ],

        'thumbnail_custom' => [
            'type' => 'text',
            'placeholder' => 'Eg. 420x560',
            'name' => 'Custom thumbnail size',
            
            'desc'      => 'This applies for layout Grid, List',
            
            'hint' => 'Post thumbnail custom',
        ],
        
        'thumbnail_placeholder' => [
            'type' => 'select',
            'options' => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            'std' => 'true',
            'name' => 'Use default thumbnail?',
            
            'toggle' => [
                'true' => [ 'thumbnail_placeholder_id' ],
            ],
            
            'desc'      => 'In case your post doesn\'t have featured image.',
            
            'hint' => 'Post thumbnail placeholder',
        ],
        
        'thumbnail_placeholder_id' => [
            'type' => 'image',
            'name' => 'Upload default thumbnail',
        ],
        
        'thumbnail_border_width' => [
            'shorthand' => 'border-width',
            'name' => 'Thumbnail border',
            'selector' => '.post-item-thumbnail',
            
            'hint' => 'Thumbnail border',
        ],
        
        'thumbnail_border_color' => [
            'shorthand' => 'border-color',
            'name' => 'Thumbnail border color',
            'selector' => '.post-item-thumbnail',
        ],

        'thumbnail_shape' => [
            'type' => 'select',
            'std'   => '',
            'options' => fox_thumbnail_shape_support(),
            'name' => 'Thumbnail shape',
            
            'hint' => 'Post thumbnail shape',
        ],

        'thumbnail_hover' => [
            'type' => 'select',
            'options' => fox_thumbnail_hover_support(),
            'std' => 'none',
            'name' => 'Thumbnail hover effect?',
            
            'desc'      => 'This applies for layout Grid, List, Masonry',
            'hint' => 'Post Thumbnail hover effect',
        ],
        
        'thumbnail_hover_overlay' => [
            'shorthand' => 'background-color',
            'selector' => '.image-overlay',
            'std' => '#000',
            'name' => 'Thumbnail overlay custom color',
            'desc'      => 'This applies for hover effects having an overlay.',
        ],

        'thumbnail_hover_logo' => [
            'type' => 'image',
            'name' => 'Thumbnail hover logo',
            'desc' => 'Should be a white transparent logo',
            
            'hint' => 'Post thumbnail hover logo',
        ],

        'thumbnail_hover_logo_width' => [
            'type'  => 'text',
            'std'   => '40%',
            'placeholder' => '40%',
            'name' => 'Thumbnail hover logo width',
            'desc' => 'Please enter a number in percentage.',
        ],

            // since 4.3
        'thumbnail_showing_effect' => [
            'type' => 'select',
            'options' => fox_thumbnail_showing_effect_support(),
            'std'   => 'none',
            'name' => 'Thumbnail on showing effect?',
          
            'hint' => 'Post thumbnail showing effect',
        ],
        
        'thumbnail_background' => [
            'shorthand' => 'background-color',
            'selector' => '.post-item-thumbnail',
            'name' => 'Thumbnail background',
            'desc' => 'When image not loaded yet, the thumbnail background will be visible. This option will make sense.',
            
            'hint' => 'Post thumbnail background',
        ],
        
        'thumbnail_components' => [
            'type' => 'multicheckbox',
            'options' => [
                'format_indicator' => 'Format indicator',
                'index' => 'Thumbnail index',
                'view' => 'View count',
                'review' => 'Review Score',
            ],
            'std' => 'format_indicator',
            'name' => 'Thumbnail additional components',
            
            'hint' => 'Post thumbnail components',
        ],
        
        'thumbnail_position' => [
            'type' => 'select',
            'options' => fox_thumbnail_position_support(),
            'std' => 'left',
            'name' => 'Thumbnail position',
        
            'desc'      => 'This applies for layout List',
            'hint' => 'List thumbnail position',
        ],

        'thumbnail_width' => [
            'type' => 'text',
            'placeholder' => 'Eg. 40% or 450px',
            'name' => 'Thumbnail width',
            'property' => 'width',
            'selector' => '.list-thumbnail',

            'hint' =>  'Post list thumbnail width',
            
            'desc'      => 'This applies for layout List',
        ],
        
        /**
         * Title
         */
        'heading_title' => [
            'type' => 'heading',
            'name' => 'Title',
        ],
        
        'title_tag' => [
            'type' => 'select',
            'options' => fox_title_tag_support(),
            'std' => 'h2',
            'name' => 'Title tag',
            
            'hint' => 'Blog post title tag',
        ],

        'title_size' => [
            'type' => 'select',
            'std'   => 'normal',
            'options' => fox_title_size_support(),
            'name' => 'Title size',
            
            'hint' => 'Blog post title size',
        ],
        
        /**
         * Excerpt
         */
        'heading_excerpt' => [
            'type' => 'heading',
            'name' => 'Excerpt',
        ],
        
        'display_excerpt_html' => [
            'type' => 'radio',
            'options' => [
                'true' => 'Yes Please',
                'false' => 'No Thanks',
            ],
            'std' => 'false',
            'name' => 'Excerpt HTML?',
            'hint' => 'Blog post excerpt HTML',
        ],
        
        'excerpt_length' => [
            'type' => 'text',
            'std' => '22',
            'placeholder' => 'Eg. 22',
            'name' => 'Excerpt length',
            
            'hint' => 'Blog post excerpt length',
        ],
        
        'excerpt_color' => [
            'shorthand' => 'color',
            'name' => 'Excerpt color',
            'selector' => '.post-item-excerpt',
            
            'hint' => 'Blog post excerpt color',
        ],

        'excerpt_size' => [
            'type' => 'select',
            'options' => fox_excerpt_size_support(),
            'name' => 'Excerpt font size',
            'std'   => 'normal',
            
            'hint' => 'Blog post excerpt size',
        ],
        
        'excerpt_hellip' => [
            'type' => 'select',
            'options' => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            'std' => 'false',
            'name' => 'Add "..." after excerpt',
        ],

        'excerpt_more_style' => [
            'options' => fox_excerpt_more_style_support(),
            'std' => 'simple',
            'type' => 'select',
            'name' => 'More link style?',
            
            'hint' => 'Blog excerpt more style',
        ],

        'excerpt_more_text' => [
            'type' => 'text',
            'placeholder' => 'Eg. Continue Reading..',
            'name' => 'Excerpt more text',
            
            'hint' => 'Blog post excerpt more text',
        ],
        
        'masonry_dropcap' => [
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'false',
            'name' => 'Drop cap for masonry posts',
            'desc' => 'This option only applies to Masonry layout'
        ],
        
    ];
    
    // OTHERS
    // ------------------------------------------------------------------------------------------------------------------------
    $options = $options + [
        
        /**
         * POST STANDARD
         * --------------------------------
         */
        'standard_thumbnail_type' => [
            'name' => 'Thumbnail Type',
            'type' => 'radio',
            'options' => [
                'advanced' => 'Rich thumbnail (video, gallery..)',
                'simple' => 'Only Image thumbnail',
            ],
            'std' => 'simple',

            'desc' => 'Rich thumbnail includes gallery, video.. for format posts',

            'section' => 'blog_standard',
            'section_title' => 'Post Standard',
            'panel' => 'blog',
            
            'hint' => 'Standard post thumbnail type',
        ],
        
        'standard_thumbnail_header_order' => [
            'name' => 'Thumbnail & title Order',
            'type' => 'radio',
            'options' => [
                'thumbnail' => 'Thumbnail then title',
                'header' => 'Title then thumbnail',
            ],
            'std' => 'header',
            
            'hint' => 'Standard post thumbnail/title order',
        ],
        
        'standard_sep' => [
            'name' => 'Separator between posts',
            'shorthand' => 'enable',
            'std' => 'true',
            
            'hint' => 'Standard post separator',
        ],
        
        'standard_spacing' => [
            'name' => 'Spacing between posts',
            'type' => 'select',
            'options' => [
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
            ],
            'std' => 'normal',
            
            'hint' => 'Standard post item spacing',
        ],
        
        'standard_content_excerpt' => [
            'name' => 'Standard post show:',
            'type' => 'radio',
            'options' => [
                'content' => 'Content',
                'excerpt' => 'Excerpt',
            ],
            'std' => 'content',
            
            'toggle' => [
                'excerpt' => [ 'standard_excerpt_more', 'standard_excerpt_more_style' ]
            ],

            'hint' =>  'Standard post content/excerpt',
        ],
        
        'standard_title_size' => [
            'name' => 'Post Standard Title size',
            'shorthand' => 'font-size',
            'selector' => '.post-item-title.post-title',
            'std'   => '3em',
            
            'hint' => 'Standard post title size',
        ],

        'standard_excerpt_length' => [
            'name'  => 'Standard post excerpt length',
            'type'  => 'text',
            'std'   => 55,
            'desc' => 'Enter number of words',
            'placeholder' => 'Eg. 55',
            
            'hint' => 'Standard post excerpt length',
        ],
        
        'standard_excerpt_more' => [
            'name'  => 'More link?',
            'type'  => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std'   => 'true',
            
            'hint' => 'Standard post excerpt more',
        ],
        
        'standard_excerpt_more_align' => [
            'name'  => 'More button align',
            'type'  => 'select',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std'   => 'center',
            
            'hint' => 'Standard post excerpt more align',
        ],
        
        'standard_excerpt_more_style' => [
            'name'  => 'More link style?',
            'type'  => 'select',
            'options' => [
                'simple' => 'Plain Link',
                'simple-btn' => 'Minimal Link', // simple button
                'btn' => 'Fill Button', // default btn
                'btn-outline' => 'Button outline',
                'btn-black' => 'Solid Black Button',
                'btn-primary' => 'Primary Button',
            ],
            'std'   => 'btn-black',
            
            'hint' => 'Standard post excerpt more style',
        ],

        'standard_header_align' => [
            'name' => 'Header text align',
            'type' => 'select',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),
            'std' => 'left',
            
            'hint' => 'Standard post header align',
        ],
        
        'standard_column_layout' => [
            'type' => 'radio',
            'name' => 'Text Column Layout',
            'desc' => 'This only works when you use content instead of excerpt',
            'options' => [
                '1' => '1 column',
                '2' => '2 columns',
            ],
            'std' => '1',
        ],
        
        'standard_dropcap' => [
            'type' => 'select',
            'name' => 'Enable drop cap automatically?',
            'desc' => 'This only works when you use content instead of excerpt',
            'options' => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            'std' => 'false',
        ],
        
        /**
         * NEWSPAPER
         * --------------------------------
         */
        'newspaper_thumbnail_type' => [
            'name' => 'Thumbnail Type',
            'type' => 'radio',
            'options' => [
                'advanced' => 'Rich thumbnail (video, gallery..)',
                'simple' => 'Only Image thumbnail',
            ],
            'std' => 'simple',

            'desc' => 'Rich thumbnail includes gallery, video.. for format posts',

            'section' => 'blog_newspaper',
            'section_title' => 'Post Newspaper',
            'panel' => 'blog',
        ],
        
        'newspaper_content_excerpt' => [
            'name' => 'Newspaper post show:',
            'type' => 'radio',
            'options' => [
                'content' => 'Content',
                'excerpt' => 'Excerpt',
            ],
            'std' => 'content',
            
            'hint' =>  'Post newspaper content/excerpt',
        ],

        'newspaper_header_align' => [
            'name' => 'Header text align',
            'type' => 'select',
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),
            'std' => 'left',
        ],
        
        'newspaper_column_layout' => [
            'type' => 'radio',
            'name' => 'Text Column Layout',
            'desc' => 'This only works when you use content instead of excerpt',
            'options' => [
                '1' => '1 column',
                '2' => '2 columns',
            ],
            'std' => '1',
        ],
        
        'newspaper_dropcap' => [
            'type' => 'select',
            'name' => 'Newspaper post drop cap?',
            'desc' => 'This only works when you use content instead of excerpt',
            'options' => [
                'true' => 'Yes please',
                'false' => 'No thanks',
            ],
            'std' => 'false',
        ],
        
        /**
         * VERTICAL
         * --------------------------------
         */
        'vertical_thumbnail_type' => [
            'name' => 'Thumbnail Type',
            'type' => 'radio',
            'options' => [
                'advanced' => 'Rich thumbnail (video, gallery..)',
                'simple' => 'Only Image thumbnail',
            ],
            'std' => 'simple',

            'desc' => 'Rich thumbnail includes gallery, video.. for format posts',

            'section' => 'blog_vertical',
            'section_title' => 'Post Vertical',
            'panel' => 'blog',
            
            'hint' => 'Vertical post thumbnail type',
        ],
        
        'vertical_thumbnail_position' => [
            'name' => 'Thumbnail position',
            'type' => 'select',
            'options' => [
                'left' => 'Left',
                'right' => 'Right',
                'alternative' => 'Alternative',
            ],
            'std' => 'left',
            'name' => 'Thumbnail position',
            
            'hint' => 'Vertical post thumbnail position',
        ],
        
        'vertical_excerpt_size' => [
            'name' => 'Excerpt size',
            'type' => 'select',
            'options' => [
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
            ],
            'std'   => 'medium',
            
            'hint' => 'Vertical post excerpt size',
        ],
        
        /**
         * BIG
         * --------------------------------
         */
        'big_content_excerpt' => [
            'name' => 'Post Big shows:',
            'type' => 'radio',
            'options' => [
                'content' => 'Post Content',
                'excerpt' => 'Post Excerpt',
            ],
            'std' => 'content',

            'section' => 'blog_big',
            'section_title' => 'Post Big',
            'panel' => 'blog',
            
            'hint' => 'Big post content/excerpt',
        ],
        
        'big_align' => [
            'name' => 'Big post align',
            'type' => 'select',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => 'left',
            
            'hint' => 'Big post alignment',
        ],
        
        'big_date_format' => [
            'name' => 'Big post date format',
            'type' => 'text',
            'std' => 'd.m.Y',
            'placeholder' => 'd.m.Y',
            
            'hint' => 'Big post date format',
        ],
        
        'big_meta_background' => [
            'name' => 'Big post meta background',
            'type' => 'color',
            'std' => '#ffffff',
        ],
        
        /**
         * SLIDER
         * --------------------------------
         */
        'slider_effect' => [
            
            'name' => 'Post Slider Effect',
            'type' => 'radio',
            'options' => [
                'fade' => 'Fade',
                'slide' => 'Slide',
            ],
            'std' => 'fade',

            'section' => 'blog_slider',
            'section_title' => 'Classic Slider',
            'panel' => 'blog',

            'hint' =>  'Post slider options',

        ],

        'slider_nav_style' => [
            'name' => 'Navigation Style',
            'type' => 'radio',
            'options' => [
                'text' => 'Text',
                'arrow' => 'Arrow',
            ],
            'std' => 'text',

            'hint' =>  'Post slider navigation type',
        ],

        'slider_size' => [
            'name' => 'Slider size',
            'type' => 'text',
            'placeholder' => '1020x510',
            'std' => '1020x510',

            'hint' =>  'Post slider size',
        ],

        'slider_title_background' => [
            'name' => 'Title background?',
            'shorthand' => 'enable',
            'std' => 'false',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
        ],
        
        /**
         * SLIDER 1
         * --------------------------------
         */
        // slider-1 options
        'slider1_height' => [
            'name'    => 'Slide Height',
            'type'     => 'select',
            'options'   => [
                'short' => 'Short', // 2:1
                'tall' => 'Tall',
                'fullscreen' => 'Fullscreen',
            ],
            'std' => 'short',
            
            'section' => 'blog_slider1',
            'section_title' => 'Slider 1',
            'panel' => 'blog',
            
            'hint' => 'Post slider 1 options',
        ],

        'slider1_content_color' => [
            'name'    => 'Slide Text Color',
            'type'     => 'color',
        ],

        'slider1_content_background' => [
            'name'    => 'Slide Text Background',
            'type'     => 'color',
        ],

        'slider1_content_background_opacity' => [
            'name'    => 'Background Opacity',
            'type'     => 'text',
            'placeholder' => 'Number 0 - 1, eg. 0.7',
        ],

    ];
                           
    // ------------------------------------------------------------------------------------------------------------------------
    $options = $options + [

        /**
         * GROUP 1
         * --------------------------------
         */
        'group1_big_position' => [
            'name'    => 'Big Post Position',
            'type'     => 'select',
            'options'   => [
                'left' => 'Left',
                'right' => 'Right',
            ],
            'std' => 'left',
            
            'section' => 'blog_group1',
            'section_title' => 'Post Group 1',
            'panel' => 'blog',
            
            'hint' => 'Post group 1 options',
        ],
        
        'group1_big_ratio' => [
            'name' => 'Big Post Ratio',
            'type' => 'radio',
            'options' => fox_group1_ratio_support(),
            'std' => '2/3',
        ],
        
        'group1_spacing' => [
            'name' => 'Column spacing',
            'type' => 'select',
            'options' => fox_group_spacing_support(),
            'std' => 'normal',
        ],

        'group1_sep_border' => [
            'name' => 'Separator?',
            'shorthand' => 'enable',
            'std' => 'false',

            'hint' =>  'Post group 1 border',
        ],

        'group1_sep_border_color' => [
            'name' => 'Separator color',
            'type' => 'color',
        ],

        // BIG POST OPTIONS
        'group1_big_post_heading_h' => [
            'name' => 'Big Post',
            'type' => 'heading',
        ],
        
    ];
    
    $prefix = 'group1_big_';
    
    // we have to repeat here
    $big_post_options = [
        'components' => [
            'name' => 'Components',
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
            ],
            'std' => 'thumbnail,title,date,category,excerpt,excerpt_more',
            'hint' =>  'Post group 1: big post options',
        ],
        
        'align' => [
            'name' => 'Align',
            'type' => 'radio',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => 'center',
        ],
        
        'item_template' => [
            'name' => 'Elements Order',
            'type' => 'select',
            'options' => array(
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),
            'std' => '2',
        ],
        
        'thumbnail' => [
            'name' => 'Thumbnail',
            'type' => 'select',
            'options' => fox_basic_thumbnail_support(),
            'std' => 'large',
        ],
        
        'excerpt_length' => [
            'name' => 'Excerpt length',
            'type' => 'text',
            'placeholder' => 'Eg. 32',
            'std' => '44',
        ],
        
        'excerpt_more_text' => [
            'name' => 'Excerpt more text',
            'type' => 'text',
            'placeholder' => 'Eg. Read More',
            'std' => '',
        ],
        
        'excerpt_more_style' => [
            'name' => 'More Style',
            'type' => 'select',
            'options' => [
                'simple' => 'Plain Link',
                'simple-btn' => 'Minimal Link', // simple button
                'btn' => 'Fill Button', // default btn
                'btn-black' => 'Solid Black Button',
                'btn-primary' => 'Primary Button',
            ],
            'std' => 'btn',
        ],
        
    ];
    
    foreach ( $big_post_options as $k => $dt ) {
        $options[ $prefix . $k ] = $dt;
    }
    
    // SMALL POST OPTIONS
    $options[ 'group1_small_post_heading_h' ] = [
        'name' => 'Small Posts',
        'type' => 'heading',
    ];
    
    $prefix = 'group1_small_';
    $small_post_options = [
        'components' => [
            'name' => 'Components',
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
            ],
            'std' => 'thumbnail,title,date,excerpt',

            'hint' =>  'Post group 1: small post options',
        ],
        
        'item_template' => [
            'name' => 'Elements Order',
            'type' => 'select',
            'options' => array(
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),
            'std' => '2',
        ],
        
        'list_spacing' => [
            'name' => 'List spacing',
            'type' => 'select',
            'options' => [
                'none' => 'No Spacing',
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
                'large' => 'Large',
            ],
            'std' => 'normal',
        ],
        
        'thumbnail' => [
            'name' => 'Thumbnail',
            'type' => 'select',
            'std' => 'landscape',
            'options' => fox_basic_thumbnail_support()
        ],
        
        'excerpt_length' => [
            'name' => 'Excerpt length',
            'type' => 'text',
            'placeholder' => 'Eg. 12',
            'std' => '12',
        ],
        
    ];
    
    foreach ( $small_post_options as $k => $dt ) {
        $options[ $prefix . $k ] = $dt;
    }
    
    /**
     * GROUP 2
     * --------------------------------
     */
    $options = $options + [
        
        'group2_columns_order' => [
            'name' => 'Columns Order',
            'type' => 'select',
            'options' => array(
                '1a-1b-3'  => 'Big / Medium / Small posts',
                '1b-1a-3'  => 'Medium / Big / Small posts',

                '1a-3-1b'  => 'Big / Small posts / Medium',
                '1b-3-1a'  => 'Medium / Small posts / Big',

                '3-1a-1b'  => 'Small posts / Big / Medium',
                '3-1b-1a'  => 'Small posts / Medium / Big',
            ),
            'std' => '1a-3-1b',

            'section' => 'blog_group2',
            'section_title' => 'Post Group 2',
            'panel' => 'blog',

            'hint' => 'Post group 2 options',
        ],
        
        'group2_spacing' => [
            'name' => 'Column spacing',
            'type' => 'select',
            'options' => fox_group_spacing_support(),
            'std' => 'normal',
        ],

        'group2_sep_border' => [
            'name' => 'Separator?',
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'false',

            'hint' =>  'Post group 2 border',
        ],

        'group2_sep_border_color' => [
            'name' => 'Separator color',
            'type' => 'color',
        ],
        
    ];
    
    $options[ 'group2_big_heading_h' ] = [
        'name' => 'Big Post',
        'type' => 'heading',
    ];
    
    $prefix = 'group2_big_';
    $big_post_options = [
        'components' => [
            'name' => 'Components',
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
            ],
            'std' => 'thumbnail,title,date,category,excerpt,excerpt_more',

            'hint' =>  'Post group 2: big post options',
        ],
        
        'align' => [
            'name' => 'Align',
            'type' => 'radio',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => 'center',
        ],
        
        'item_template' => [
            'name' => 'Elements Order',
            'type' => 'select',
            'options' => array(
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),
            'std' => '2',
        ],
        
        'title_size' => [
            'name' => 'Big post title size',
            'type' => 'select',
            'std' => 'medium',
            'options' => fox_title_size_support()
        ],
        
        'excerpt_length' => [
            'name' => 'Excerpt length',
            'type' => 'text',
            'placeholder' => 'Eg. 32',
            'std' => '32',
        ],
        
        'excerpt_more_text' => [
            'name' => 'Excerpt More Text',
            'type' => 'text',
            'placeholder' => 'Eg. Read More',
            'std' => '',
        ],
        
        'excerpt_more_style' => [
            'name' => 'Excerpt More Style',
            'type' => 'select',
            'options' => [
                'simple' => 'Plain Link',
                'simple-btn' => 'Minimal Link', // simple button
                'btn' => 'Fill Button', // default btn
                'btn-black' => 'Solid Black Button',
                'btn-primary' => 'Primary Button',
            ],
            'std' => 'btn',
        ],
        
    ];
    
    foreach ( $big_post_options as $k => $dt ) {
        $options[ $prefix . $k ] = $dt;
    }
    
    $options[ 'group2_medium_heading_h' ] = [
        'name' => 'Medium Post',
        'type' => 'heading',
    ];
    
    $prefix = 'group2_medium_';
    $medium_post_options = [
        'components' => [
            'name' => 'Medium Posts Components',
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
            ],
            'std' => 'thumbnail,title,date,excerpt,excerpt_more',

            'hint' =>  'Post group 2: medium post options',
        ],
        
        'item_template' => [
            'name' => 'Elements Order',
            'type' => 'select',
            'options' => array(
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),
            'std' => '2',
        ],

        'thumbnail' => [
            'name' => 'Post Thumbnail',
            'type' => 'select',
            'options' => [
                'medium' => 'Medium',
                'thumbnail-medium' => 'Landscape (480x384)',
                'thumbnail-square' => 'Square (480x480)',
                'thumbnail-portrait' => 'Portrait (480x600)',
            ],
            'std' => 'medium',
        ],
        
        'title_size' => [
            'name' => 'Medium post title size',
            'type' => 'select',
            'std' => 'normal',
            'options' => fox_title_size_support()
        ],

        'excerpt_length' => [
            'name' => 'Medium Post Excerpt length',
            'type' => 'text',
            'placeholder' => 'Eg. 40',
            'std' => '40',
        ],
        
    ];
    
    foreach ( $medium_post_options as $k => $dt ) {
        $options[ $prefix . $k ] = $dt;
    }
    
    $options[ 'group2_small_heading_h' ] = [
        'name' => 'Small Posts',
        'type' => 'heading',
    ];
    
    $prefix = 'group2_small_';
    $small_post_options = [
        'components' => [
            'name' => 'Components',
            'type' => 'multicheckbox',
            'options' => [
                'thumbnail' => 'Thumbnail',
                'title' => 'Title',
                'date' => 'Date',
                'category' => 'Category',
                'author' => 'Author',
                'author_avatar' => 'Author avatar',
                'excerpt' => 'Excerpt',
                'excerpt_more' => 'More link',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
            ],
            'std' => 'thumbnail,title,date',

            'hint' =>  'Post group 2: small post options',
        ],

        'item_template' => [
            'name' => 'Small Posts Elements Order',
            'type' => 'select',
            'options' => array(
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),
            'std' => '2',
        ],
        
        'title_size' => [
            'name' => 'Small Posts title size',
            'type' => 'select',
            'std' => 'small',
            'options' => fox_title_size_support()
        ],

        'excerpt_length' => [
            'name' => 'Small Posts Excerpt length',
            'type' => 'text',
            'placeholder' => 'Eg. 12',
            'std' => '12',
        ],
        
    ];
    
    foreach ( $small_post_options as $k => $dt ) {
        $options[ $prefix . $k ] = $dt;
    }

    /* Post Grid Options
    ----------------------------------- */
    $pre = "blog_grid_"; // due to backward-compatibility reason

    return $options;
    
}