<?php
/* GENERAL
---------------------------------------------------- */
$options[ 'single_layout_type' ] = [
    'type' => 'radio',
    'name' => 'Single post layout type',
    'options' => [
        'classic' => 'Predefined (non-Elementor)',
        'builder' => 'Builder (by Elementor)',
    ],
    'std' => 'classic',
    'desc' => 'If you choose Custom Templates, you can use Elementor to import most creative and flexible layouts.',
    
    'hint' => 'Single Post Builder',
    
    'toggle' => [
        'classic' => [
            'single_style',
            'single_sidebar_state',
            'single_sidebar',
            'single_padding_top',
        ],
        'builder' => [
            'single_template',
        ],
    ],
    
    'section'   => 'single_general',
    'section_title' => 'General',
    'panel' => 'single',
    'panel_title' => 'Single Post',
    'panel_priority' => 137,
];

$options[ 'single_style' ] = [
    'type' => 'radio',
    'options' => [
        '1' => 'Layout 1',
        '1b' => 'Layout 1b',
        '2' => 'Layout 2',
        '3' => 'Layout 3',
        '4' => 'Layout 4 (Hero Full)',
        '5' => 'Layout 5 (Hero Half)',
        '6' => 'Layout 6 (Thumbnail -- Header)',
    ],
    'std' => '1',
    'name' => 'Predefined layouts',

    'hint' =>  'Single post layout',

];

$options[ 'single_sidebar_state' ] = [
    'type' => 'radio',
    'options' => [
        'sidebar-left' => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
        'no-sidebar' => 'No sidebar (fullwidth)',
    ],
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    
    'hint' =>  'Single post sidebar state',
];

$sidebar_list = [ '' => 'Default' ];
foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
    $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
}

$options[ 'single_sidebar' ] = [
    'type' => 'select',
    'options' => $sidebar_list,
    'std' => '',
    'name' => 'Sidebar',
    
    'hint' =>  'Single post sidebar',
];

$options[ 'single_padding_top' ] = [
    'shorthand' => 'padding-top',
    'name' => 'Single post padding top',
    'selector' => '.single .wi-content',
    'placeholder' => 'Eg. 20px',
    
    'hint' =>  'Single post padding top',
];


// single template, for Elementor custom build
$template_list = [ '' => 'Choose Template' ];
if ( function_exists( 'fox_get_block_list' ) ) {
    $template_list += fox_get_block_list();
} else {
    $template_list = [ '' => 'You must install FOX Framework plugin' ];
}

$options[ 'single_template' ] = [
    'type' => 'select',
    'options' => $template_list,
    'name' => 'Choose Template',
    'std' => '',
];

/* LAYOUT
---------------------------------------------------- *
$options[ 'single_style' ] = [
    'type' => 'image_radio',
    'options' => [
        '1' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 1',
        ],
        '1b' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/1b.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 1b',
        ],
        '2' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/2.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 2',
        ],
        '3' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/3.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Layout 3',
        ],
        '4' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/4.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Hero full',
        ],
        '5' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/5.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Hero half',
        ],
    ],
    'std' => '1',
    'name' => 'Single Post Layout',

    'section'   => 'single_layout',
    'section_title' => 'Single Post Layout',

    'panel' => 'single',
    'panel_title' => 'Single Post',
    'panel_priority' => 130,
    
    'hint' =>  'Single post layout',

];
*/

// COMPONENTS
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

$options[ 'single_components' ] = [
    'type' => 'multicheckbox',

    'options' => [
        'date' => 'Meta Date',
        'category' => 'Meta Category',
        'author' => 'Meta Author',
        'author_avatar' => 'Author avatar',
        'comment_link' => 'Meta comment link',
        'reading_time' => 'Meta Reading Time',
        'view' => 'Meta view count',

        'post_header' => 'Title area',
        'thumbnail' => 'Thumbnail',
        'share' => 'Share icon',
        'tag' => 'Tags',
        'related' => 'Related Posts',
        'authorbox' => 'Author Box',
        'comment' => 'Comment Area',
        'nav' => 'Post Navigation',
        'bottom_posts' => 'Bottom Posts',
        'side_dock' => 'Sliding-up Box',

    ],
    'std' => $std,
    'name' => 'Single post components',
    
    'section'   => 'single_layout',
    'section_title' => 'Single Post Layout',
    'panel' => 'single',
    
    'hint' =>  'Single post components',
];

/**
 * ---------------------------------------------
 * Post Header
 */
$options[] = [
    'type' => 'heading',
    'name' => 'Single Post Header',
];

$options[ 'single_breadcrumbs' ] = [
    'type'      => 'select',
    'options'   => [
        '' => 'None',
        'before' => 'Before all',
        'after_title' => 'After title',
        'after' => 'After all',
    ],
    'std'       => '',
    'name' => 'Breadcrumbs Position',
    'desc' => 'Note: You must install Yoast SEO plugin to have breadcrumbs',
    
    'hint' =>  'Breadcrumbs',
];

$options[ 'single_meta_template' ] = [
    'type'      => 'select',
    'options'   => [
        '1' => 'Title > Meta',
        '2' => 'Meta > Title',
        '4' => 'Category > Title > Meta',
    ],
    'std'       => '1',
    'name' => 'Post Header Elements Order',
    
    'hint' =>  'Single post title, meta order',
];

$options[ 'single_meta_align' ] = array(
    'type'      => 'select',
    'name'      => 'Post Header Alignment',
    'options'   => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std'       => 'center',
    
    'hint' =>  'Single post header align',
);

$options[ 'single_meta_border' ] = array(
    'type'      => 'select',
    'name'      => 'Post Header Border',
    'options'   => [

        'none' => 'None',

        'top-1' => 'Top 1px',
        'top-2' => 'Top 2px',

        'bottom-1' => 'Bottom 1px',
        'bottom-2' => 'Bottom 2px',

        'top-1|bottom-1' => 'Top 1px - Bottom 1px',
        'top-2|bottom-2' => 'Top 2px - Bottom 2px',
        'top-3|bottom-1' => 'Top 3px - Bottom 1px',

    ],
    'std'       => 'none',
    
    'hint' =>  'Single post header border',
);

$options[ 'single_meta_border_color' ] = array(
    'shorthand' => 'border-color',
    'name'      => 'Post Header Border Color',
    'selector'  => '.single-header .container',
);

$options[ 'subtitle_position' ] = array(
    'type'      => 'radio',
    'options'   => [
        'after_title' => 'After title',
        'before_content' => 'Before content',
    ],
    'std'       => 'after_title',
    'name'      => 'Subtitle position',
    
    'hint' =>  'Subtitle position',
);

$options[ 'subtitle_display' ] = array(
    'type'      => 'radio',
    'options'   => [
        'subtitle' => 'Subtitle',
        'excerpt' => 'Excerpt',
    ],
    'std'       => 'subtitle',
    'name'      => 'At subtitle position, display:',
    
    'hint' =>  'Subtitle/Excerpt',
);

/**
 * ---------------------------------------------
 * Post Content
 */
$options[] = [
    'type' => 'heading',
    'name' => 'Single Post Content',
];

$options[ 'single_thumbnail_stretch' ] = [
    'type' => 'radio',
    'options' => [
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'name' => 'Thumbnail stretch',
    'desc'  => 'Option for Layout 1, 1b, 2, 3',

    'hint' =>  'Post thumbnail stretch',
];

$options[ 'single_content_width' ] = [
    'type' => 'radio',
    'options' => [
        'full' => 'Full width',
        'narrow' => 'Narrow width',
    ],
    'std' => 'full',
    'name' => 'Content width',
    
    'hint' =>  'Single post content width',
];

$options[ 'single_content_narrow_width' ] = [
    'name' => 'Narrow width',
    'shorthand' => 'width',
    'selector' => '.post-content-narrow .narrow-area,.wi-content .narrow-area',
    'placeholder' => '660px',
    
    'hint' =>  'Single narrow content custom width',
];

// since 4.1
$options[ 'content_link_style' ] = array(
    'type'      => 'select',
    'options'   => array(
        '1' => 'Grey underline',
        '2' => 'Same color underline',
        '3' => 'Black underline',
        '4' => 'No style',
    ),
    'std'       => '1',
    'name'      => 'Post Content Link Style',
    
    'hint' =>  'Post content link underline style',
);

$options[ 'link_hovercard' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Link hovercard',
    'desc'  => 'Preview post content when hover the link',
    
    'hint' =>  'Link Hovercard',
);

$options[ 'single_column_layout' ] = [
    'name' => 'Post Text Column Layout',
    'type' => 'select',
    'options' => array(
        '1' => '1 column',
        '2' => '2 columns',
    ),
    'std' => '1',
    
    'hint' =>  'Post content text column',
];

$options[ 'single_dropcap' ] = [
    'shorthand' => 'enable',
    'std' => 'false',
    'name' => 'Drop cap?',
    
    'hint' =>  'Enable drop cap',
];

$options[ 'single_content_image_stretch' ] = [
    'name' => 'Stretch All Content Images',
    'type' => 'radio',
    'options' => [
        'stretch-none' => 'No strech',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => 'stretch-none',
    'desc' => 'Each photo has its own option for stretching. By using this option. you stretch ALL alignnone, aligncenter images in your post.',
    
    'hint' =>  'Post content image stretch',
];

/**
 * ---------------------------------------------
 * After Content
 */
$options[] = [
    'type' => 'heading',
    'name' => 'After Post Content',
];

$options[ 'after_content_order' ] = [
    'type' => 'radio',
    'name' => 'After post content order',
    'options' => [
        'share-tag-related-authorbox-comment-nav' => 'Share > Tag > Related > Author > Comment > Nav',
        'nav-tag-share-authorbox-related-comment' => 'Nav > Tag > Share > Author > Related > Comment',
        'share-related-authorbox-comment-tag-nav' => 'Share > Related > Author > Comment > Tag > Share',
    ],
    'std' => 'share-tag-related-authorbox-comment-nav',
    
    'hint' =>  'After single content elements order',
];

$options[ 'single_related_position' ] = array(
    'type'      => 'radio',
    'options'   => [
        'after_main_content' => 'After post content',
        'after_container' => 'Bottom of the post',
    ],
    'std'       => 'after_main_content',
    'name'      => 'Where to display Related Posts?',
    
    'hint' =>  'Related posts position',
);

$options[ 'single_nav_position' ] = array(
    'type'      => 'radio',
    'options'   => [
        'after_main_content' => 'After post content',
        'after_container' => 'Bottom of the post',
    ],
    'std'       => 'after_container',
    'name'      => 'Where to display Navigation?',
    
    'hint' =>  'Single post navigation position',
);

/**
 * ---------------------------------------------
 * Hero Posts
 */
$options[] = [
    'type' => 'heading',
    'name' => 'Hero Posts (layout 4, 5)',
];

$options[ 'single_hero_header' ] = [
    'type' => 'select',
    'options' => [
        'normal' => 'Normal Header',
        'minimal' => 'Minimal Header (Logo & Hamburger)',
    ],
    'std' => 'minimal',
    'name' => 'Hero Header Type',
    
    'hint' =>  'Hero post: header type',
];

$options[ 'min_logo' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Use a minimal logo?',
    'desc'      => 'This logo will be used for the minimal header.',
    
    'hint' =>  'Hero post: minimal logo',
);

$options[ 'min_logo_type' ] = array(
    'type'      => 'select',
    'options'   => [
        'text'  => 'Text Logo',
        'image' => 'Image Logo',
    ],
    'std'       => 'text',
    'name'      => 'Minimal Logo Type',
    
    'hint' =>  'Hero post: minimal logo type',
);

$options[ 'logo_minimal' ] = array(
    'type'      => 'image',
    'name'      => 'Minimal Logo',
    'desc'      => 'This logo will be used for the minimal header.',
);

$options[ 'logo_minimal_white' ] = array(
    'type'      => 'image',
    'name'      => 'Minimal Logo (White Version)',
    'desc'      => 'Will be used on dark background',
);

$options[ 'logo_minimal_height' ] = array(
    'shorthand' => 'height',
    'selector'  => '.minimal-logo img',
    'name'      => 'Minimal Logo Height',
);

$options[ 'single_hero_full_overlay_bg' ] = [
    'shorthand' => 'background-color',
    'selector'  => '.hero-text--center .hero-overlay',
    'name'      => 'Hero Full Overlay Color',
    'std'       => '#000',
    
    'hint' =>  'Hero post: Overlay color',
];

$options[ 'single_hero_full_overlay_opacity' ] = [
    'shorthand' => 'opacity',
    'selector'  => '.hero-text--center .hero-overlay',
    'name'      => 'Hero Full Overlay Opacity',
    'std'       => '0.3',
    
    'hint' =>  'Hero post: Overlay opacity',
];

$options[ 'single_hero_full_text_layout' ] = [
    'type'      => 'select',
    'options'   => [
        'bottom-left' => 'Bottom Left',
        'bottom-center' => 'Bottom Center',
        'center' => 'Center',
    ],
    'std'       => 'bottom-left',
    'name' => 'Hero full text position',
    
    'hint' =>  'Hero post: text layout position',
];

$options[ 'single_hero_half_skin' ] = [
    'type'      => 'select',
    'options'   => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std'       => 'light',
    'name' => 'Hero half default skin',
    'hint' =>  'Hero half post skin',
];

$options[ 'single_hero_scroll' ] = [
    'shorthand' => 'enable',
    'std'       => 'false',
    'name' => '"Scroll down" button?',
    
    'hint' =>  'Hero post: scroll button',
];

$options[ 'single_hero_scroll_style' ] = [
    
    'type'      => 'select',
    'options'   => [
        'arrow' => 'Start + Arrow Down',
        'btn-outline' => 'Button Outline',
        'btn-fill' => 'Button Fill',
        'btn-primary' => 'Button Primary',
    ],
    'std'       => 'arrow',
    'name' => '"Scroll down" button style',
    
];

$options[ 'single_hero_scroll_btn_text' ] = [
    'type' => 'text',
    'name' => '"Scroll Down" button text',
    'placeholder' => 'Eg. Start Reading',
    'std'       => 'Start Reading',
];

$options[ 'single_hero_meta_1_category_style' ] = [
    'type'      => 'select',
    'options'   => [
        'plain' => 'Plain Text',
        'box' => 'Box',
    ],
    'std' => 'plain',
    'name' => 'Category in thumbnail style',
];

$options[ 'single_hero_meta_1_elements' ] = [
    'type'      => 'multicheckbox',
    'std'       => 'category',
    'name'      => 'Meta elements in thumbnail:',
    'options'   => [
        'category' => 'Category',
        'date' => 'Date',
        'author' => 'Author',
        'author_avatar' => 'Author Avatar',
        'view' => 'View count',
        'comment' => 'Comment link',
        'reading' => 'Reading time',
    ],
    'std' => 'category',
    
    'hint' =>  'Hero post: meta elements',
];

$options[ 'single_hero_meta_2_elements' ] = [
    'type'      => 'multicheckbox',
    'std'       => 'category',
    'name'      => 'Meta elements in post:',
    'options'   => [
        'category' => 'Category',
        'date' => 'Date',
        'author' => 'Author',
        'author_avatar' => 'Author Avatar',
        'view' => 'View count',
        'comment' => 'Comment link',
        'reading' => 'Reading time',
    ],
    'std' => 'author,date',
];

/* SHARE
---------------------------------------------------- */
$options[ 'share_icons' ] = array(
    'type'      => 'multicheckbox',
    'name'      => esc_html__( 'Icons', 'wi' ),
    'options'   => array(
        'facebook' => 'Facebook',
        'messenger' => 'Messenger',
        'twitter' => 'Twitter',
        'pinterest' => 'Pinterest',
        'linkedin' => 'Linked In',
        'whatsapp' => 'Whatsapp',
        'reddit'    => 'Reddit',
        'email'     => 'Email',
    ),
    'std'       => 'facebook,messenger,twitter,pinterest,whatsapp,email',

    'section'   => 'single_share',
    'section_title' => 'Social Share',
    'panel'     => 'single',
    
    'hint' =>  'Social Share',
);

$options[ 'share_positions' ] = array(
    'type'      => 'multicheckbox',
    'name'      => 'Share Positions',
    'options'   => array(
        'before'    => 'Before content',
        'side'      => 'Left Side of content',
        'after'     => 'After content',
    ),
    'std'       => 'after',
    'desc'      => 'Note that "side share" is not available for content narrow.',
    
    'hint' =>  'Share positions',
);

$options[ 'share_icon_style' ] = array(
    'name'      => 'Icon style',
    'type'      => 'select',
    'options'   => [
        'default'   => 'Style 1',
        'custom'    => 'Customize Design',
    ],
    'toggle' => [
        'custom' => [
            
            'share_layout',
            
            'share_icon_shape',
            'share_icon_size',

            'share_icon_color',
            'share_icon_custom_color',
            'share_icon_background',
            'share_icon_custom_background',

            'share_icon_hover_color',
            'share_icon_hover_custom_color',
            'share_icon_hover_background',
            'share_icon_hover_custom_background',
            
        ],
    ],
    'std'       => 'default',
    
    'hint' =>  'Share icon styles',
);

// since 4.3
$options[ 'share_layout' ] = array(
    'type'      => 'radio',
    'name'      => 'Share Layout',
    'options'   => array(
        'inline'     => 'Left Label - Right Icons',
        'stack'    => 'Icons center',
    ),
    'std'       => 'inline',
);

$options[ 'share_lines' ] = array(
    'name'      => '2 lines around icons',
    'shorthand' => 'enable',
    'options'   => [
        'true' => 'Yes please!',
        'false' => 'No thanks!',
    ],
    'std'       => 'false',
    'desc'      => 'This option only applies for "Icons center".'
);

$options[ 'share_icon_shape' ] = array(
    'name'      => 'Icon shape',
    'type'      => 'select',
    'options'   => [
        'acute' => 'Acute',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std'       => 'circle'
);

$options[ 'share_icon_size' ] = array(
    'name'      => 'Icon Size (px)',
    'shorthand' => 'width',
    'std'       => '32px',
    'selector'  => '.share-style-custom a',
);

$options[ 'share_icon_color' ] = array(
    'name'      => 'Icon Color',
    'type'      => 'select',
    'options'   => [
        'custom' => 'Custom color',
        'brand' => 'Brand color',
    ],
    'toggle'    => [
        'custom' => [ 'share_icon_custom_color' ]
    ],
    'std'       => 'custom',
);

$options[ 'share_icon_custom_color' ] = array(
    'name'      => 'Icon Custom Color',
    'shorthand' => 'color',
    'selector'  => '.fox-share.color-custom a',
);

$options[ 'share_icon_background' ] = array(
    'name'      => 'Icon Background',
    'type'      => 'select',
    'options'   => [
        'custom' => 'Custom color',
        'brand' => 'Brand color',
    ],
    'toggle'    => [
        'custom' => [ 'share_icon_custom_background' ]
    ],
    'std'       => 'custom',
);

$options[ 'share_icon_custom_background' ] = array(
    'name'      => 'Icon Custom Background',
    'shorthand' => 'background-color',
    'selector'  => '.fox-share.background-custom a',
);

$options[ 'share_icon_hover_color' ] = array(
    'name'      => 'Icon Hover Color',
    'type'      => 'select',
    'options'   => [
        'custom' => 'Custom color',
        'brand' => 'Brand color',
    ],
    'toggle'    => [
        'custom' => [ 'share_icon_hover_custom_color' ]
    ],
    'std'       => 'custom',
);

$options[ 'share_icon_hover_custom_color' ] = array(
    'name'      => 'Icon Custom Hover Color',
    'shorthand' => 'color',
    'selector'  => '.fox-share.hover-color-custom a:hover',
);

$options[ 'share_icon_hover_background' ] = array(
    'name'      => 'Icon Hover Background',
    'type'      => 'select',
    'options'   => [
        'custom' => 'Custom color',
        'brand' => 'Brand color',
    ],
    'toggle'    => [
        'custom' => [ 'share_icon_hover_custom_background' ]
    ],
    'std'       => 'custom',
);

$options[ 'share_icon_hover_custom_background' ] = array(
    'name'      => 'Icon Custom Hover Background',
    'shorthand' => 'background-color',
    'selector'  => '.fox-share.hover-background-custom a:hover',
);

/* TAG
---------------------------------------------------- */
$options[ 'tag_style' ] = array(
    'type'      => 'select',
    'options'   => array(
        'block' => 'Block style 1',
        'block-2' => 'Block style 2',
        'block-3' => 'Block style 3',
        'plain' => 'Minimal',
    ),
    'std'       => 'block',
    'name'      => 'Tag style',

    'section'   => 'single_tags',
    'section_title' => 'Post Tags',
    'panel'     => 'single',
    
    'hint' =>  'Post tag styles',
);

$options[ 'tags_align' ] = array(
    'type'      => 'select',
    'options'   => array(
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ),
    'std'       => 'center',
    'name'      => 'Tags align',
    
    'hint' =>  'Tags align',
);

$options[ 'tag_label_show' ] = [
    'options' => [
        'show' => 'Show it',
        'hide' => 'Hide it',
    ],
    'std' => 'hide',
    'type' => 'radio',
    'name' => 'Tag label',
];

/* RELATED POSTS
---------------------------------------------------- */
$options[ 'single_related_number' ] = array(
    'type'      => 'text',
    'std'       => '3',
    'placeholder' => '3',
    'name'      => 'Number of related posts',

    'section'   => 'single_related',
    'section_title' => 'Related Posts',
    'panel'     => 'single',
    
    'hint' =>  'Related posts',
);

$options[ 'single_related_source' ] = array(
    'type'      => 'select',
    'std'       => 'tag',
    'options'   => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Related posts source',
);

$options[ 'single_related_orderby' ] = array(
    'type'      => 'select',
    'std'       => 'date',
    'options'   => fox_orderby_support(),
    'name'      => 'Order by?',
);

$options[ 'single_related_order' ] = array(
    'type'      => 'select',
    'std'       => 'desc',
    'options'   => fox_order_support(),
    'name'      => 'Order?',
);

// since 4.6.7.2
$options[ 'single_related_exclude_categories' ] = array(
    'type'      => 'text',
    'name'      => 'Exclude categories from related posts',
    'placeholder'=>'Eg. 145, 32',
    'desc'      => 'Enter cat IDs, separate them by commas',
);

$options[ 'single_related_layout' ] = array(
    'type'      => 'select',
    'std'       => 'grid-3',
    'options'   => [
        'grid-2' => 'Grid 2 columns',
        'grid-3' => 'Grid 3 columns',
        'grid-4' => 'Grid 4 columns',
        'list'  => 'List',
    ],
    'name'      => 'Layout',
);

$options[ 'single_related_title_size' ] = array(
    'type'      => 'select',
    'options'   => [ '' => 'Default' ] + fox_title_size_support(),
    'std'       => '',
    'name'      => 'Related post title size',
);

/* AUTHOR BOX
---------------------------------------------------- */
$options[ 'authorbox_style' ] = array(
    'type'      => 'select',
    'options'   => array(
        'simple'    => 'Simple',
        'box'       => 'Box',
    ),
    'std'       => 'simple',
    'name'      => 'Author box style',

    'section'   => 'single_authorbox',
    'section_title' => 'Author Box',
    'panel'     => 'single',
    
    'hint' =>  'Author box',
);

$options[ 'single_authorbox_avatar_shape' ] = array(
    'type'      => 'select',
    'options'   => [
        'acute' => 'Acute',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std'       => 'circle',
    'name'      => 'Author avatar shape',
    
    'hint' =>  'Author box avatar shape',
);

$options[ 'single_authorbox_width' ] = array(
    'type'      => 'select',
    'options'   => [
        'full' => 'Full',
        'narrow' => 'Narrow',
    ],
    'std'       => 'narrow',
    'name'      => 'Author box width',
);

/* SINGLE NAVIGATION
---------------------------------------------------- */
$options[ 'single_post_navigation_style' ] = array(
    'type'      => 'select',
    'options'   => [
        'minimal-1'    => 'Minimal 1',
        'minimal-2'    => 'Minimal 2',
        'minimal-3'    => 'Minimal 3',
        
        'simple'    => 'Simple 1',
        'simple-2'    => 'Simple 2',
        
        'advanced'  => 'Title Over Image',
    ],
    'std'       => 'advanced',
    'name'      => 'Post Navigation Style',
    
    'toggle'    => [
        'advanced' => [ 'single_nav_image_ratio' ]
    ],

    'section'   => 'single_navigation',
    'section_title' => 'Post Navigation',
    'panel'     => 'single',
    
    'hint' =>  'Single post navigation',
);

$options[ 'single_nav_image_ratio' ] = [
    'type' => 'radio',
    'options'   => [
        '1000x450' => '100:45',
        '1000x600' => '100:60',
    ],
    'std' => '1000x450',
    'name' => 'Tile Ratio',
];

$options[ 'single_post_navigation_same_term' ] = array(
    'shorthand' => 'enable',
    'options'   => [
        'true'    => 'Yes',
        'false'  => 'No',
    ],
    'std'       => 'false',
    'name'      => 'Next/Prev post in same categroy',
);

/* BOTTOM POSTS
---------------------------------------------------- */
$options[ 'single_bottom_posts_number' ] = array(
    'type'      => 'text',
    'std'       => '5',
    'placeholder' => '5',
    'name'      => 'Number of bottom posts',

    'desc' => 'To enable/disable bottom posts, please go to <a href="javascript:wp.customize.control( \'wi_single_components\' ).focus();">Single Post Layout > Show/Hide Components
</a> then check/uncheck this component.',

    'section'   => 'single_bottom_posts',
    'section_title' => 'Bottom Posts',
    'panel'     => 'single',
    
    'hint' =>  'Single 5 bottom posts',
);

$options[ 'single_bottom_posts_source' ] = array(
    'type'      => 'select',
    'std'       => 'category',
    'options'   => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Bottom posts source',
);

$options[ 'single_bottom_posts_orderby' ] = array(
    'type'      => 'select',
    'std'       => 'date',
    'options'   => fox_orderby_support(),
    'name'      => 'Order by?',
);

$options[ 'single_bottom_posts_order' ] = array(
    'type'      => 'select',
    'std'       => 'desc',
    'options'   => fox_order_support(),
    'name'      => 'Order?',
);

// since 4.6.7.2
$options[ 'single_bottom_posts_exclude_categories' ] = array(
    'type'      => 'text',
    'name'      => 'Exclude categories from bottom posts',
    'placeholder'=>'Eg. 145, 32',
    'desc'      => 'Enter cat IDs, separate them by commas',
);

$options[ 'single_bottom_posts_excerpt' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Excerpt?',
);

/* FOOTER SLIDING BOX
---------------------------------------------------- */
$options[ 'single_side_dock_number' ] = array(
    'type'      => 'text',
    'std'       => '2',
    'placeholder' => '2',
    'name'      => 'Number of posts in Sliding box',

    'desc' => 'To enable/disable sliding box, please go to <a href="javascript:wp.customize.control( \'wi_single_components\' ).focus();">Single Post Layout > Show/Hide Components
</a> then check/uncheck this component.',

    'section'   => 'single_side_dock',
    'section_title' => 'Footer Sliding Box',
    'panel'     => 'single',
    
    'hint' =>  'Single footer side dock',
);

$options[ 'single_side_dock_source' ] = array(
    'type'      => 'select',
    'std'       => 'tag',
    'name'      => 'Post Source',
    'options'   => [
        'date' => 'Latest posts',
        'category' => 'Posts in same category',
        'tag' => 'Posts with same tags',
        'author' => 'Posts by same author',
        'featured' => 'Featured posts',
    ],
    'name'      => 'Sliding box posts from:',
);

$options[ 'single_side_dock_orderby' ] = array(
    'type'      => 'select',
    'std'       => 'date',
    'options'   => fox_orderby_support(),
    'name'      => 'Order by?',
);

$options[ 'single_side_dock_order' ] = array(
    'type'      => 'select',
    'std'       => 'desc',
    'options'   => fox_order_support(),
    'name'      => 'Order?',
);

$options[ 'single_side_dock_orientation' ] = array(
    'type'      => 'select',
    'std'       => 'up',
    'options'   => [
        'up' => 'Bottom up',
        'right' => 'Left to right',
    ],
    'name'      => 'Sliding Orientation',
);

$options[ 'single_side_dock_title_size' ] = array(
    'type'      => 'select',
    'std'       => 'tiny',
    'options'   => [
        'supertiny' => 'Super Tiny',
        'tiny' => 'Tiny',
        'small' => 'Small',
    ],
    'name'      => 'Title size',
);

$options[ 'single_side_dock_excerpt_length' ] = array(
    'type'      => 'text',
    'std'       => '0',
    'name'      => 'Excerpth length',
);

/* FORMAT OPTIONS
---------------------------------------------------- */
$options[ 'video_indicator_style' ] = array(
    'name'      => 'Video indicator style',
    'type'      => 'select',
    'options'   => [
        'minimal'   => 'Minimal',
        'solid'     => 'Solid',
        'outline'   => 'Outline',
    ],
    'std'       => 'outline',

    'section' => 'single_format',
    'section_title' => 'Post Format Options',
    'panel' => 'single',
    
    'hint' =>  'Video icon style',
);

$options[ 'single_format_link_target' ] = [
    'name'      => 'Post format Link: opens link in:',
    'type'      => 'select',
    'options'   => [
        '_self'   => 'Same tab',
        '_blank'   => 'New tab',
    ],
    'std'       => '_self',
    'hint' =>  'Format link, opens new tab',
];

$options[ 'single_format_gallery_style' ] = [
    'type' => 'image_radio',
    'options' => [
        'metro' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/metro.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Metro',
        ],
        'stack' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/stack.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Stack Images',
        ],
        'slider' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/slider.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Slider',
        ],
        'slider-rich' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/slider-rich.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Rich Content Slider',
        ],
        'carousel' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/carousel.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Carousel',
        ],
        'grid' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/grid.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Grid',
        ],
        'masonry' => [
            'src' => get_template_directory_uri() . '/v55/inc/customizer/assets/img/masonry.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Masonry',
        ],
    ],
    'std' => 'metro',
    'name' => 'Gallery Default Style',
    
    'hint' =>  'Default post gallery type',
];

$options[ 'single_format_gallery_lightbox' ] =  array(
    'name' => 'Open lightbox?',
    'type' => 'select',

    'options' => [
        'true' => 'Yes Please',
        'false' => 'No Thanks',
    ],
    'std' => 'true',

    'hint' =>  'Post gallery lightbox',
);

$options[ 'single_format_gallery_slider_effect' ] = [
    'name' => 'Slider Effect?',
    'type' => 'select',
    'options' => [
        'fade' => 'Fade',
        'slide' => 'Slide',
    ],
    'std' => 'fade',
];

$options[ 'single_format_gallery_slider_size' ] = array(
    'name' => 'Image Crop',
    'type' => 'select',
    'options' => [
        'original' => 'Original Size',
        'crop' => 'Crop',
    ],
    'std' => 'crop',
);

$options[ 'single_format_gallery_grid_column' ] = array(
    'name' => 'Gallery Grid Column',
    'type' => 'select',
    'options' => [
        '2' => '2 Columns',
        '3' => '3 Columns',
        '4' => '4 Columns',
        '5' => '5 Columns',
    ],
    'std' => '3',
);

$options[ 'single_format_gallery_grid_size' ] = array(
    'name' => 'Gallery Grid Image Size',
    'type' => 'select',
    'options' => [
        'landscape' => 'Landscape',
        'square' => 'Square',
        'portrait' => 'Portrait',
        'original' => 'Original',
        'custom' => 'Custom Size',
    ],
    'std' => 'landscape',
);

$options[ 'single_format_gallery_grid_size_custom' ] = array(
    
    'name' => 'Grid Image Custom Size',
    'type' => 'text',
    'placeholder' => 'Eg. 600x320',
    'desc' => 'Syntax: WxH',
    
);

/* Reading Progress Indicator
 * since 4.1
---------------------------------------------------- */
$options[ 'single_reading_progress' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Reading progress indicator?',
    'desc'      => 'Reading progress indicator won\'t be shown for articles that are too short (ie. shorter than screen height)',
    
    'hint' =>  'Reading progress',
    
    'section'   => 'single_reading_progress',
    'section_title' => 'Reading Progress',
    'panel'     => 'single',
);

$options[ 'reading_progress_position' ] = array(
    'type'      => 'select',
    'options'   => [
        'top' => 'Top page',
        'header' => 'Navigation lower edge',
        'bottom' => 'Bottom page',
    ],
    'std'       => 'top',
    'name'      => 'Progress Bar Position',
);

$options[ 'reading_progress_height' ] = array(
    'shorthand' => 'height',
    'selector'  => '.reading-progress-wrapper',
    'std'       => '5px',
    'placeholder' => '5px',
    'name'      => 'Progress Bar Height',
);

$options[ 'reading_progress_color' ] = array(
    'type'      => 'color',
    'name'      => 'Progress Bar Color',
);

/* AUTOLOAD NEXT POST
 * since 2.9
---------------------------------------------------- */
$options[ 'autoload_post' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Auto load next post',
    'desc'      => 'If enabled, a new post will be loaded automatically when visitor reaches to the end of your single post.',
    
    'hint' =>  'Autoload Next Post',
    
    'section'   => 'single_autoload',
    'section_title' => 'Autoload Next post',
    'panel'     => 'single',
);

$options[ 'autoload_post_nav_same_term' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'options'   => [
        'true' => 'Yes',
        'false' => 'No',
    ],
    'name'      => 'Only load post in same category',
);

/* POST REVIEW POSITION (since 4.5)
---------------------------------------------------- */
$options[ 'review_positions' ] = array(
    'type'      => 'multicheckbox',
    'std'       => 'before',
    'options'   => [
        'before' => 'Before post content',
        'after' => 'After post content',
    ],
    'name'      => 'Review positions',
    
    'hint' =>  'Post Review',
    
    'section'   => 'single_review',
    'section_title' => 'Post Review Position',
    'panel'     => 'single',
);

$options[ 'review_overall_color' ] = [
    'shorthand' => 'color',
    'selector' => '.review-item.overall .review-score',
    'name' => 'Overall text color',
];

$options[ 'review_overall_background' ] = [
    'shorthand' => 'background-color',
    'selector' => '.review-item.overall .review-score',
    'name' => 'Overall background color',
];

$options[ 'review_text_color' ] = [
    'shorthand' => 'color',
    'selector' => '.review-text',
    'name' => 'Review Custom Text Color',
];

$options[ 'review_text_background' ] = [
    'shorthand' => 'background-color',
    'selector' => '.review-text',
    'name' => 'Review Custom Text Background',
];