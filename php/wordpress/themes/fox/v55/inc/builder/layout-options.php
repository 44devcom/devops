<?php
/**
 * this includes all layout options will be used for all possible layouts:
 *
 * grid
 * list
 * standard
 * newspaper
 * masonry
 * slider
 * slider1
 * vertical
 * big
 * group1
 * group2
 
 * and more in the future
 
 *
 * those options will also be options for Customizer? Or we shoud do it manually to prevent complicated logic?
 * but data consistency?
 * hmm, we should do it manually >< damn it
 */
function fox_builder_layout_options() {
    
    $layout_options = [
        
        // done
        'customize_components' => [
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'false',
            'name' => 'Customize components',
            'desc' => 'Choose which components of post to show/hide',
            'toggle' => [
                'true' => [ 'components' ],
            ],
            
            'layout' => [ 'grid', 'masonry', 'list', 'standard', 'newspaper', 'slider', 'slider-1', 'slider-3', 'big', 'vertical' ],
        ],
        
        // done
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
                'standard_excerpt_more' => 'More link (standard layout)',
                'view' => 'View count',
                'reading_time' => 'Reading time',
                'comment_link' => 'Comment link',
                'share' => 'Share icons (only for standard layout)',
                'related' => 'Related posts (only for standard layout)',
            ],
            'std' => 'thumbnail,title,date,category,excerpt',
            'name' => 'Components',
            
            'layout' => [ 'grid', 'masonry', 'list', 'standard', 'newspaper', 'slider', 'slider-1', 'big', 'vertical', 'slider-3' ],
        ],
        
        /**
         * General option for the layout
         */
        // done
        'column' => [
            'type'      => 'select',
            'name'      => 'Column?',
            'options'   => [
                '2' => '2 columns',
                '3' => '3 columns',
                '4' => '4 columns',
                '5' => '5 columns',
            ],
            'std'       => '3',
            
            'layout' => [ 'grid', 'masonry' ],
        ],
        
        // done
        'first_standard' => [
            'type'      => 'select',
            'name'      => 'First post is standard layout?',
            'options'   => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std'       => '',
            
            'layout' => [ 'grid', 'list' ],
        ],
        
        // done
        'big_first_post' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => '',
            
            'name' => 'First post big?',
            
            'layout' => 'masonry',
        ],
        
        // done
        'item_card' => [

            'name' => 'Card Style',

            'type' => 'select',
            'options' => [
                '' => 'Default',
                'none' => 'None',
                'normal' => 'Normal',
                'normal_no_shadow' => 'Normal + no shadow',
                'overlap' => 'Text Overlaps Image',
                'overlap_no_shadow' => 'Overlap + no shadow',
            ],
            'std' => '',

            'layout' => [ 'standard', 'grid', 'list', 'masonry' ],

        ],
        
        // done
        'item_card_background' => [
            'name' => 'Card Background',
            'type' => 'color',
            
            'layout' => [ 'grid', 'masonry' ],
        ],

        // done
        'item_spacing' => [

            'name' => 'Item Spacing',

            'type' => 'select',
            'options' => [
                '' => 'Default',
                'none' => 'No spacing',
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
                'wide' => 'Wide',
                'wider' => 'Wider',
            ],
            'std' => '',

            'layout' => [ 'grid', 'masonry' ],

        ],

        // done
        'item_template' => [

            'name' => 'Elements order',
            'type' => 'select',

            'options' => array(
                '' => 'Default',
                '1' => 'Title > Meta > Excerpt',
                '2' => 'Meta > Title > Excerpt',
                '3' => 'Title > Excerpt > Meta',

                '4' => 'Category > Title > Meta > Excerpt',
                '5' => 'Category > Title > Excerpt > Meta',
            ),

            'std' => '',

            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'slider-3' ],

        ],

        // done
        'item_border' => [

            'name' => 'Grid border?',
            'desc' => 'The vertical border between grid items?',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => '',

            'layout' => [ 'grid', 'masonry' ],

        ],

        // done
        'item_border_color' => [

            'name' => 'Border color?',
            'type' => 'color',
            'layout' => [ 'grid', 'masonry' ],

        ],
        
        // done
        'align' => [

            'name' => 'Item Align',
            'type' => 'select',

            'options' => array(
                '' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ),

            'std' => '',

            'layout' => [ 'grid', 'masonry', 'slider', 'slider-1' ],

        ],
        
        // done
        'color' => [
            'name' => 'Post Text Color',
            'type' => 'color',
            
            'layout' => [ 'grid', 'masonry', 'standard', 'list', 'big', 'vertical', 'newspaper', 'group-1', 'group-2', 'slider-3' ],
        ],
        
        // done
        'list_spacing' => [
            'type' => 'select',
            'name' => 'Spacing between list items',
            'options' => [
                '' => 'Default',
                'none' => 'No Spacing',
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
                'large' => 'Large',
            ],
            'std' => '',

            'norm_desc' => 'For List layout',
            
            'layout' => 'list',
        ],
        
        // done
        'list_sep' => [
            'type' => 'select',
            'std' => '',
            'options' => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'name' => 'Use separator line between list posts',

            'norm_desc' => 'For List layout',
            
            'layout' => 'list',
        ],
        
        // done
        'list_sep_style' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'solid' => 'Solid',
                'dashed' => 'Dashed',
                'dotted' => 'Dotted',
            ],
            'std' => '',
            'name' => 'List sep border style',
            
            'norm_desc' => 'For List layout',
            'layout' => 'list',
        ],

        // done
        'list_sep_color' => [
            'type'      => 'color',
            'property'  => 'border-color',
            'selector'  => '.post-list-sep',
            'name' => 'Separator color',
            'norm_desc' => 'For List layout',
            
            'layout' => 'list',
        ],
        
        // done
        'list_valign' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'top' => 'Top',
                'middle' => 'Middle',
                'bottom' => 'Bottom',
            ],
            'std' => '',
            'name' => 'Item vertical alignment',
            
            'layout' => 'list',
        ],
        
        // done
        'list_mobile_layout' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'grid' => 'Stack',
                'list' => 'List',
            ],
            'std' => '',
            'name' => 'List item layout on mobile:',

            'layout' => 'list',
        ],
        
        // deprecated56
        'big_content_excerpt' => [
            'name' => 'Post Big shows:',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'content' => 'Post Content',
                'excerpt' => 'Post Excerpt',
            ],
            'std' => '',

            'layout' => 'big',
        ],
        
        // done
        'big_align' => [
            'name' => 'Big post align',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'std' => '',
            
            'layout' => 'big',
        ],
        
        // deprecated56
        'big_meta_background' => [
            'name' => 'Big post meta background',
            'type' => 'color',
            
            'layout' => 'big',
        ],
        
        /**
         * CLASSIC SLIDER
         * --------------------------------
         */
        'slider_size' => [
            'name' => 'Slider size',
            'type' => 'text',
            'placeholder' => 'Eg. 1020x510',
            
            'layout' => 'slider',
        ],
        
        'slider_nav_style' => [
            'name' => 'Slider Next/Prev Style',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'circle-1' => 'Circle 1',
                'square-1' => 'Square 1',
                'square-2' => 'Square 2',
                'square-3' => 'Square 3',
                'text' => 'Text',
            ],
            
            'layout' => [ 'slider', 'slider-1', 'slider-3' ],
        ],
        
        'slider_dot_style' => [
            'name' => 'Slider Dots',
            'type' => 'select',
            'options' => [
                'disabled' => 'Disabled',
                'small' => 'Small Dots',
                'square-small' => 'Small Squares',
                'big' => 'Big Dots',
                'square-big' => 'Big Squares',
            ],
            
            'layout' => [ 'slider-1' ],
        ],
        
        'slider_autoplay' => [
            'name' => 'Slider Autoplay?',
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            
            'layout' => [ 'slider', 'slider-1', 'slider-3' ],
        ],
        
        /**
         * SLIDER 1
         * --------------------------------
         */
        'slider1_height' => [
            'name'    => 'Slide Height',
            'type'     => 'select',
            'options'   => [
                'short' => 'Short', // 2:1
                'tall' => 'Tall',
                'fullscreen' => 'Fullscreen',
            ],
            'std' => 'short',
            'desc' => 'If you set Fullscreen but your slider width is not fullscreen yet, please go to tab "Design" and choose Stretch "Full width (edge of screen)".',
            
            'layout' => 'slider-1',
        ],

        'slider1_content_color' => [
            'name'    => 'Slide Text Color',
            'type'     => 'color',
            
            'layout' => 'slider-1',
        ],

        'slider1_content_background' => [
            'name'    => 'Slide Text Background',
            'type'     => 'color',
            
            'layout' => 'slider-1',
        ],

        'slider1_content_background_opacity' => [
            'name'    => 'Text Background Opacity',
            'type'     => 'text',
            'placeholder' => 'Number 0 - 1, eg. 0.7',
            
            'layout' => 'slider-1',
        ],
        
        /**
         * SLIDER 3
         * --------------------------------
         */
        'slider3_text_background' => [
            'type' => 'color',
            'name' => 'Text Background',
            
            'layout' => 'slider-3',
        ],
        
        /**
         * GROUP 1
         * --------------------------------
         */
        'group1_big_position' => [
            'name'    => 'Big Post Position',
            'type'     => 'select',
            'options'   => [
                '' => 'Default',
                'left' => 'Left',
                'right' => 'Right',
            ],
            'std' => '',
            
            'layout' => 'group-1',
        ],
        
        'group1_big_ratio' => [
            'name' => 'Big Post Ratio',
            'type' => 'select',
            'options' => array_merge(
                [ '' => 'Default' ],
                fox_group1_ratio_support()
            ),
            'std' => '',
            
            'layout' => 'group-1',
        ],
        
        'group1_big_number' => [
            'name'      => 'Number of big posts',
            'type'      => 'text',
            'std' => '1',
            
            'layout' => 'group-1'
        ],
        
        'group1_small_display' => [
            'name'      => 'Small posts displayed as:',
            'type'      => 'select',
            'options'   => [
                'list' => 'List',
                'grid' => 'Grid',
            ],
            'std'       => 'list',
            
            'layout' => 'group-1',
        ],
        
        'group1_small_column' => [
            'name'      => 'Small posts column (if Grid)',
            'type'      => 'select',
            'options'   => [
                1 => '1 Column',
                2 => '2 Columns',
            ],
            'std'       => 1,
            
            'layout' => 'group-1',
        ],
        
        /**
         * GROUP 2
         * --------------------------------
         */
        'group2_columns_order' => [
            'name'    => 'Columns Order',
            'type'     => 'select',
            'options'   => [
                '' => 'Default',
                '1a-1b-3'  => 'Big / Medium / Small posts',
                '1b-1a-3'  => 'Medium / Big / Small posts',

                '1a-3-1b'  => 'Big / Small posts / Medium',
                '1b-3-1a'  => 'Medium / Small posts / Big',

                '3-1a-1b'  => 'Small posts / Big / Medium',
                '3-1b-1a'  => 'Small posts / Medium / Big',
            ],
            'std' => '',
            
            'layout' => 'group-2'
        ],
        
        'group2_big_number' => [
            'name'      => 'Number of big posts',
            'type'      => 'text',
            'std' => '1',
            
            'layout' => 'group-2'
        ],
        
        'group2_medium_number' => [
            'name'      => 'Number of medium posts',
            'type'      => 'text',
            'std'       => '1',
            
            'layout' => 'group-2'
        ],
        
        'group2_small_display' => [
            'name'      => 'Small posts displayed as:',
            'type'      => 'select',
            'options'   => [
                'grid' => 'Grid',
                'list' => 'List',
            ],
            'std'       => 'grid',
            
            'layout' => 'group-2'
        ],
        
        /**
         * THUMBNAIL
         * ------------------------------------------------------------------------------------------------
         */
        // done 
        'heading_thumbnail' => [
            'type' => 'heading',
            'name' => 'Thumbnail',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],
        
        'thumbnail_type' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'advanced' => 'Rich thumbnail (video, gallery..)',
                'simple' => 'Only Image thumbnail',
            ],
            'std' => '',

            'desc' => 'Rich thumbnail includes gallery, video.. for format posts',
            'name' => 'Thumbnail type',
            
            'layout' => [ 'standard', 'newspaper', 'vertical' ],
        ],
        
        // done
        'thumbnail' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'landscape' => 'Landscape (480x384)',
                'square' => 'Square (480x480)',
                'portrait' => 'Portrait (480x600)',
                'thumbnail-large' => 'Large (720x480)',
                'original' => 'Original size',
                'original_fixed' => 'Fixed height',
                'custom' => 'Enter Custom size',
            ],
            'std' => '',
            'toggle' => [
                'custom' => [ 'thumbnail_custom' ],
            ],
            'name' => 'Thumbnail',
            
            'layout' => [ 'grid', 'list' ],
        ],

        // done
        'thumbnail_custom' => [
            'type' => 'text',
            'placeholder' => 'Eg. 420x560',
            'name' => 'Custom thumbnail size',
            
            'layout' => [ 'grid', 'list' ],
        ],

        // done
        'thumbnail_shape' => [
            'type' => 'select',
            'std'   => '',
            'options' => [
                '' => 'Default',
                'acute'     => 'Acute',
                'round'     => 'Round',
                'circle'    => 'Circle',
            ],
            'name' => 'Thumbnail shape',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],

        // done
        'thumbnail_hover' => [
            'type' => 'select',
            'options' => [ '' => 'Default' ] + fox_thumbnail_hover_support(),
            'std' => '',
            'toggle' => [
                'logo' => [ 'thumbnail_hover_logo', 'thumbnail_hover_logo_width' ]
            ],
            'name' => 'Thumbnail hover effect?',
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],

        // done
        'thumbnail_hover_logo' => [
            'type' => 'image',
            'name' => 'Thumbnail hover logo',
            'desc' => 'Should be a white transparent logo',
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],

        // done
        'thumbnail_hover_logo_width' => [
            'type'  => 'text',
            'std'   => '40%',
            'placeholder' => '40%',
            'name' => 'Thumbnail hover logo width',
            'desc' => 'Please enter a number in percentage.',
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],

            // since 4.3
        // done    
        'thumbnail_showing_effect' => [
            'type' => 'select',
            'options' => [
                ''          => 'Default',
                'none'      => 'None',
                'fade'      => 'Image Fade',
                'slide'     => 'Slide',
                'popup'     => 'Pop up',
                'zoomin'    => 'Zoom In',
            ],
            'std'   => '',
            'name' => 'Thumbnail on showing effect?',
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'newspaper', 'standard', 'group-1', 'group-2' ],
        ],
        
        // done
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
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'newspaper', 'standard' ],
        ],
        
        // done
        'thumbnail_position' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'left' => 'Left',
                'right' => 'Right',
                'alternative' => 'Alternative',
            ],
            'std' => '',
            'name' => 'Thumbnail position (Layout List/Vertical)',
        
            'layout' => [ 'list', 'vertical' ],
        ],

        // done
        'thumbnail_width' => [
            'type' => 'text',
            'placeholder' => 'Eg. 40% or 450px',
            'name' => 'Thumbnail width (list layout)',
            'property' => 'width',
            'selector' => '.list-thumbnail',

            'layout' => 'list',
        ],
        
        /**
         * TITLE
         * ------------------------------------------------------------------------------------------------
         */
        // done
        'heading_title' => [
            'type' => 'heading',
            'name' => 'Title',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'vertical', 'newspaper', 'standard', 'slider', 'slider-1', 'slider-3', 'group-1', 'group-2' ],
        ],
        
        'title_tag' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
            ],
            'std' => '',
            'name' => 'Title tag',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'vertical', 'newspaper', 'standard', 'slider', 'slider-1', 'slider-3', 'group-1', 'group-2' ],
        ],

        'title_size' => [
            'type' => 'select',
            'std'   => '',
            'options' => [
                '' => 'Default',
                'supertiny' => 'Super Tiny',
                'tiny' => 'Tiny',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
                'large' => 'Large',
            ],
            'name' => 'Title size',
            
            'layout' => [ 'grid', 'list', 'masonry', 'vertical', 'slider', 'slider-1', 'big', 'slider-3' ],
        ],
        
        'title_color' => [
            'type' => 'color',
            'name' => 'Title color',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'vertical', 'newspaper', 'standard', 'slider', 'slider-1', 'slider-3', 'group-1', 'group-2' ],
        ],

        /**
         * EXCERPT
         * ------------------------------------------------------------------------------------------------
         */
        'heading_excerpt' => [
            'type' => 'heading',
            'name' => 'Excerpt',
            
            'layout' => [ 'grid', 'list', 'masonry', 'big', 'newspaper', 'standard', 'slider', 'group-1', 'group-2', 'slider-3' ],
        ],
        
        'standard_content_excerpt' => [
            'type' => 'select',
            'std' => '',
            'options' => [
                '' => 'Default',
                'content' => 'Content',
                'excerpt' => 'Excerpt',
            ],
            'name' => 'Display post content/excerpt?',
            
            'layout' => 'standard',
        ],
        
        'newspaper_content_excerpt' => [
            'type' => 'select',
            'std' => '',
            'options' => [
                '' => 'Default',
                'content' => 'Content',
                'excerpt' => 'Excerpt',
            ],
            'name' => 'Display post content/excerpt?',
            
            'layout' => 'newspaper',
        ],
        
        'excerpt_length' => [
            'type' => 'text',
            'std' => '',
            'placeholder' => 'Eg. 22',
            'name' => 'Excerpt length',
            
            'layout' => [ 'grid', 'list', 'masonry', 'standard', 'big', 'vertical', 'slider', 'slider-1', 'slider-3' ],
        ],

        'excerpt_size' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'small' => 'Small',
                'normal' => 'Normal',
                'medium' => 'Medium',
            ],
            'name' => 'Excerpt font size',
            'std'   => '',
            
            'layout' => [ 'grid', 'list', 'masonry', 'standard', 'big', 'newspaper', 'vertical', 'slider', 'slider-3', ],
        ],

        'excerpt_color' => [
            'type' => 'color',
            'name' => 'Excerpt color',
            
            'layout' => [ 'grid', 'list', 'masonry', 'standard', 'newspaper', 'big', 'vertical', 'slider', 'group-1', 'group-2', 'slider-3' ],
        ],

        'excerpt_more_style' => [
            'options' => [
                '' => 'Default',
                'simple' => 'Plain Link',
                'simple-btn' => 'Minimal Link', // simple button
                'btn' => 'Fill Button', // default btn
                'btn-outline' => 'Button outline',
                'btn-black' => 'Solid Black Button',
                'btn-primary' => 'Primary Button',
            ],
            'std' => '',
            'type' => 'select',
            'name' => 'More link style?',
            
            'layout' => [ 'grid', 'list', 'masonry', 'standard', 'vertical', 'slider-1', 'slider-3' ],
        ],

        'excerpt_more_text' => [
            'type' => 'text',
            'placeholder' => 'Eg. Continue Reading..',
            'name' => 'Excerpt more text',
            
            'layout' => [ 'grid', 'list', 'masonry', 'standard', 'big', 'vertical', 'slider-1', 'slider-3' ],
        ],
        
        'masonry_dropcap' => [
            'type' => 'select',
            'options' => [
                '' => 'Default',
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => '',
            'name' => 'Drop cap for masonry posts',
            'desc' => 'This option only applies to Masonry layout',
            
            'layout' => 'masonry',
        ],
        
    ];
    
    return apply_filters( 'fox_layout_options', $layout_options );
    
}