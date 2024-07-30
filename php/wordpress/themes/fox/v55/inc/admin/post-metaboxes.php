<?php
$fields = [];

/* GENERAL
-------------------------------------------------------------------------------- */
/**
 * General
 */
$fields[] = array(
    'id' => 'subtitle',
    'name' => 'Subtitle',
    'type' => 'textarea',
    'desc' => 'Enter post subtitle',
    'tab' => 'general',
);

$fields[] = array(
    'id' => '_is_featured',
    'name' => 'Feature This Post?',
    'prefix'=> false,
    'type' => 'checkbox',
    'desc' => 'Check this to make this post become a featured post.',
    'value' => 'yes',

    'tab' => 'general',
);

$fields[] = array(
    'id' => '_is_live',
    'name' => 'LIVE Post?',
    'prefix'=> false,
    'type' => 'checkbox',
    'desc' => 'Live post is a post with live update for breaking news. It will be indicated on frontpage and in the post header that it\'s a live post',
    'value' => 'true',

    'tab' => 'general',
);

$fields[] = array(
    'id' => 'background_color',
    'name' => 'Background color',
    'type' => 'color',
    'desc' => 'Post background color',
    'tab' => 'general',
);

$fields[] = array(
    'id' => 'text_color',
    'name' => 'Text color',
    'type' => 'color',
    'desc' => 'Post text color',
    'tab' => 'general',
    'desc' => 'Please note: text color can be affected by other mechanism, for instance: color of your post content you set in Customizer. Hence, if you change text color here but it doesnt affect your post, please check other mechanisms.',
);

$categories = get_categories( array(
    'fields' => 'id=>name',
    'orderby'=> 'slug',
    'hide_empty' => false,

    'number' => 300, // prevent huge blogs
));

$categories = [ '' => 'Auto' ] + $categories;

$fields[] = array(
    'id' => 'primary_cat',
    'name' => 'Primary Category',
    'type' => 'select',
    'options' => $categories,
    'std' => '',
    'desc' => 'Primary category will be used to render related posts and bottom posts when possible. If your post has only 1 category, that\'s primary one. Otherwise, primary category will be picked by the first category alphabetically.',

    'tab' => 'general',
);

/* BUILDER
-------------------------------------------------------------------------------- */
$default = [ '' => 'Default' ];

if ( function_exists( 'fox_get_block_list' ) ) {
    $block_list = $default + fox_get_block_list();
    /*
    $single_list = $default + fox_get_block_list( 'single' );
    $header_list = $default + fox_get_block_list( 'header' );
    $footer_list = $default + fox_get_block_list( 'footer' ); */
} else {
    $block_list = [ '' => 'You must install FOX Framework' ];
    // $single_list = $header_list = $footer_list = [ '' => 'You must install FOX Framework' ];
}

$fields[] = [
    'id' => 'header_template',
    'name' => 'Custom Header',
    'type' => 'select',
    'std' => '',
    'options' => $block_list,
    'tab' => 'builder',
];

$fields[] = [
    'id' => 'footer_template',
    'name' => 'Custom Footer',
    'type' => 'select',
    'std' => '',
    'options' => $block_list,
    'tab' => 'builder',
];

/* LAYOUT
-------------------------------------------------------------------------------- */
$uri = get_template_directory_uri() . '/v55';
$classic = [
    '' => [
        'src' => $uri . '/inc/customizer/assets/img/0.png',
        'title' => 'Default',
    ],
    '1' => [
        'src' => $uri . '/inc/customizer/assets/img/1.png',
        'title' => 'Layout 1',
    ],
    '1b' => [
        'src' => $uri . '/inc/customizer/assets/img/1b.png',
        'title' => 'Layout 1b',
    ],
    '2' => [
        'src' => $uri . '/inc/customizer/assets/img/2.png',
        'title' => 'Layout 2',
    ],
    '3' => [
        'src' => $uri . '/inc/customizer/assets/img/3.png',
        'title' => 'Layout 3',
    ],
    '4' => [
        'src' => $uri . '/inc/customizer/assets/img/4.png',
        'title' => 'Hero full',
    ],
    '5' => [
        'src' => $uri . '/inc/customizer/assets/img/5.png',
        'title' => 'Hero half',
    ],
    '6' => [
        'src' => $uri . '/inc/customizer/assets/img/6.png',
        'title' => 'Layout 6',
    ],
];

$my_templates = [];
$query_args = [
    'post_type' => 'fox_block',
    'posts_per_page' => 100,
    'orderby' => 'name',
    'order' => 'ASC',
    
    'meta_key' => '_wi_role',
    'meta_value' => 'single_template',
];
$get_list = get_posts( $query_args );
foreach( $get_list as $p ) {
    $my_templates[ $p->post_name ] = [
        'title' => strip_tags( $p->post_title ),
        'edit_link' => admin_url( 'post.php?post=' . $p->ID . '&action=elementor' ),
    ];
}

$template_list = wi_single_template_list();
$elementor = [];
foreach ( $template_list as $template_info ) {
    $slug = $template_info['slug'];
    $elementor[ $slug ] = [
        'src' => $template_info[ 'img' ],
        'title' => $template_info[ 'title' ],
        'preview' => $template_info[ 'url' ],
    ];
    if ( isset( $my_templates[ $slug ] ) ) {
        $elementor[ $slug ][ 'downloaded' ] = true;
        $elementor[ $slug ][ 'edit_link' ] = $my_templates[ $slug ]['edit_link'];
        
        // remove from my template list
        unset( $my_templates[ $slug ] );
    }
}

/**
 * local fox_block
 *
$fields[] = [
    'id' => 'single_template',
    'name' => 'Single Template',
    'type' => 'select',
    'std' => '',
    'options' => $block_list,
    'tab' => 'builder',
];
*/

$fields[] = [
    'id'    => 'style',
    'type'  => 'layout',
    'classic' => $classic,
    'elementor' => $elementor,
    'local' => $my_templates,
    
    'tab'   => 'top-layout',
];

// since 4.3
$fields[] = [
    'id' => 'hero_half_skin',
    'name' => 'Hero Half Theme',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std' => '',
    'tab' => 'layout',

    'dependency' => [
        'element' => 'style',
        'value' => '5',
    ],
];  

$fields[] = [
    'id' => 'sidebar_state',
    'name' => 'Sidebar',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'sidebar-left' => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
        'no-sidebar' => 'No Sidebar',
    ],
    'std' => '',
    'tab' => 'layout',
];

$fields[] = [
    'id' => 'thumbnail_stretch',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => '',
    'name' => 'Thumbnail stretch',

    'tab' => 'layout',
];

$fields[] = [
    'type' => 'select',
    'id' => 'content_width',
    'options' => [
        '' => 'Default',
        'full' => 'Full width',
        'narrow' => 'Narrow width',
    ],
    'std' => '',
    'name' => 'Content width',

    'tab' => 'layout',
];

$fields[] = [
    'type' => 'select',
    'id' => 'content_image_stretch',
    'options' => [
        '' => 'Default',
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => '',
    'name' => 'Content image stretch',
    'desc' => 'If you choose "Stretch Wide", it stretches all possible images in the post.',

    'tab' => 'layout',
];

/* COMPONENTS
-------------------------------------------------------------------------------- */
$components = [
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
];

foreach ( $components as $com => $name ) {

    $fields[] = [
        'id' => $com,
        'name' => 'Show ' . $name,
        'type' => 'select',
        'options' => array(
            '' => esc_html__( 'Default', 'wi' ),
            'true' => esc_html__( 'Show it', 'wi' ),
            'false' => esc_html__( 'Hide it', 'wi' ),
        ),
        'std' => '',
        'tab' => 'component',
    ];

}

$fields[] = [
    'id' => 'show_header',
    'name' => 'Show Header',
    'type' => 'select',
    'options' => array(
        '' => esc_html__( 'Default', 'wi' ),
        'true' => esc_html__( 'Show it', 'wi' ),
        'false' => esc_html__( 'Hide it', 'wi' ),
    ),
    'std' => '',
    'tab' => 'component',
];

$fields[] = [
    'id' => 'show_footer',
    'name' => 'Show Footer',
    'type' => 'select',
    'options' => array(
        '' => esc_html__( 'Default', 'wi' ),
        'true' => esc_html__( 'Show it', 'wi' ),
        'false' => esc_html__( 'Hide it', 'wi' ),
    ),
    'std' => '',
    'tab' => 'component',
];

/* FORMAT
-------------------------------------------------------------------------------- */
$fields[] = array(
    'id' => 'post_format',
    'prefix' => false,
    'name' => 'Post Format',
    'type' => 'select',
    'std' => '',
    'options' => [
        '' => 'Standard',
        'video' => 'Video',
        'audio' => 'Audio',
        'gallery' => 'Gallery',
        'link' => 'Link',
    ],
    'save' => false,

    'tab' => 'format',
);

/* Video
-------------------------------- */
$fields[] = array(
    'id' => '_format_video_embed',
    'name' => 'Video Embed Code',
    'desc' => 'Paste <strong>YouTube</strong>, <strong>Facebook</strong>, <strong>Vimeo</strong> video URL',
    'type' => 'textarea',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'video',
    ],

    'tab' => 'format',
);

$fields[] = array(
    'id' => '_format_video',
    'name' => 'Upload your own video',
    'type' => 'upload',
    'file_type' => 'video',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'video',
    ],

    'tab' => 'format',
);

/* Audio
-------------------------------- */
/**
 * Format Audio
 */
$fields[] = array(
    'id' => '_format_audio_embed',
    'name' => 'Audio Embed Code',
    'type' => 'textarea',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'audio',
    ],

    'tab' => 'format',
);

// self-hosted audio
$fields[] = array(
    'id' => '_format_audio',
    'name' => 'Upload your own audio',
    'type' => 'upload',
    'file_type' => 'audio',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'audio',
    ],

    'tab' => 'format',
);

/* Link
-------------------------------- */
$fields[] = array(
    'id' => '_format_link_url',
    'name' => 'Format link URL',
    'type' => 'text',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'link',
    ],

    'tab' => 'format',
);

$fields[] = array(
    'id' => '_format_link_target',
    'name' => 'Link opens in:',
    'type' => 'select',
    'options' => [
        '' => 'Default (as in Customizer)',
        '_self' => 'Same tab',
        '_blank' => 'New tab',
    ],
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'link',
    ],

    'tab' => 'format',
);

/* Gallery
-------------------------------- */
$fields[] = array (
    'id' => '_format_gallery_images',
    'name' => 'Gallery Images',
    'type' => 'images',
    'prefix' => false,

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'gallery',
    ],

    'tab' => 'format',
);

$fields[] = [
    'id' => 'format_gallery_style',
    'type' => 'image_radio',

    'tab' => 'format',

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'gallery',
    ],

    'options' => [
        '' => [
            'src' => get_template_directory_uri() . '/v55/inc/admin/images/default.png',
            'width' => 80,
            'height' => 80,
            'title' => 'Default',
        ],
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
    'std' => '',
    'name' => 'Gallery Default Style',
];

$fields[] = [
    'id' => 'format_gallery_lightbox',
    'name' => 'Open lightbox?',
    'type' => 'select',

    'options' => [
        '' => 'Default',
        'true' => 'Yes Please',
        'false' => 'No Thanks',
    ],
    'std' => 'true',

    'dependency' => [
        'element' => 'post_format',
        'element_prefix' => false,
        'value' => 'gallery',
    ],

    'tab' => 'format',
    
];

// slider
$fields[] = [
    
    'id' => 'format_gallery_slider_effect',
    'name' => 'Slider Effect?',
    'type' => 'select',
    'options' => [
        ''   => 'Default',
        'fade' => 'Fade',
        'slide' => 'Slide',
    ],
    'std' => '',
    'dependency' => [
        'element' => 'format_gallery_style',
        'value' => 'slider',
    ],
    'tab' => 'format',
    
];

$fields[] = array(
    'id' => 'format_gallery_slider_size',
    'name' => 'Image Crop',
    'type' => 'select',
    'options' => [
        ''   => 'Default',
        'original' => 'Original Size',
        'crop' => 'Crop',
    ],
    'std' => '',

    'dependency' => [
        'element' => 'format_gallery_style',
        'value' => 'slider',
    ],

    'tab' => 'format',
);

// grid
$fields[] = array(
    'id' => 'format_gallery_grid_column',
    'name' => 'Gallery Grid Column',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        '2' => '2 Columns',
        '3' => '3 Columns',
        '4' => '4 Columns',
        '5' => '5 Columns',
    ],
    'std' => '',

    'dependency' => [
        'element' => 'format_gallery_style',
        'value' => [ 'grid', 'masonry' ],
    ],

    'tab' => 'format',
);

$fields[] = array(
    'id' => 'format_gallery_grid_size',
    'name' => 'Gallery Grid Image Size',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'landscape' => 'Landscape',
        'square' => 'Square',
        'portrait' => 'Portrait',
        'original' => 'Original',
        'custom' => 'Custom Size',
    ],
    'std' => '',

    'dependency' => [
        'element' => 'format_gallery_style',
        'value' => 'grid',
    ],

    'tab' => 'format',
);

$fields[] = array(
    'id' => 'format_gallery_grid_size_custom',
    
    'name' => 'Grid Image Custom Size',
    'type' => 'text',
    'placeholder' => 'Eg. 600x320',
    'desc' => 'Syntax: WxH',

    'dependency' => [
        'element' => 'format_gallery_grid_size',
        'value' => 'custom',
    ],

    'tab' => 'format',
);

/* REVIEW
-------------------------------------------------------------------------------- */
$fields[] = array(
    'id' => 'review',
    'name' => esc_html__( 'Review', 'wi' ),
    'type' => 'review',

    'tab' => 'review',
);

$fields[] = array(
    'id' => 'review_text',
    'name' => esc_html__( 'Custom Text', 'wi' ),
    'type' => 'textarea',

    'tab' => 'review',
);

for ( $i = 1; $i <= 2; $i++ ) {
    $fields[] = array(
        'id' => "review_btn{$i}_url",
        'name' => "Button {$i} URL",
        'type' => 'text',
        'placeholder' => 'https://',
        'tab' => 'review',
    );

    $fields[] = array(
        'id' => "review_btn{$i}_text",
        'name' => "Button {$i} Text",
        'type' => 'text',
        'placeholder' => 'Click Here',

        'tab' => 'review',
    );
}

/* SPONSORED POST
 * @since 4.2
-------------------------------------------------------------------------------- */
$fields[] = array(
    'id' => 'sponsored',
    'name' => 'This is sponsored Post?',
    'type' => 'select',
    'options' => [
        'true' => 'Yes',
        'false' => 'No',
    ],
    'std' => 'false',
    'tab' => 'sponsor',
);

$fields[] = array(
    'id' => 'sponsor_name',
    'name' => 'Sponsor Name',
    'type' => 'text',
    'tab' => 'sponsor',
);

$fields[] = array(
    'id' => 'sponsor_url',
    'name' => 'Sponsor URL',
    'type' => 'text',
    'placeholder' => 'https://',
    'tab' => 'sponsor',
);

$fields[] = array(
    'id' => 'sponsor_image',
    'name' => 'Sponsor Image',
    'type' => 'image',
    'tab' => 'sponsor',
);

$fields[] = array(
    'id' => 'sponsor_image_width',
    'name' => 'Sponsor Image Width',
    'type' => 'text',
    'tab' => 'sponsor',
);

$fields[] = array(
    'id' => 'sponsor_label',
    'name' => 'Sponsor Label',
    'type' => 'text',
    'placeholder' => 'Sponsored',
    'tab' => 'sponsor',
);

/* MISC
-------------------------------------------------------------------------------- */
$fields[] = [
    'id' => 'padding_top',
    'name' => 'Padding top',
    'type' => 'text',
    'placeholder' => '20px',
    'tab' => 'misc',
];

$fields[] = [
    'id' => 'padding_bottom',
    'name' => 'Padding bottom',
    'type' => 'text',
    'placeholder' => '20px',
    'tab' => 'misc',
];

$fields[] = array(
    'id' => 'blog_thumbnail',
    'name' => 'Custom Blog Thumbnail',
    'type' => 'image',
    'desc' => 'Upload custom blog thumbnail if you want your blog thumbnail different from your single post thumbnail',

    'tab' => 'misc',
);

$fields[] = [
    'id' => 'autoload',
    'name' => 'Autoload on this post',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'true' => 'Enable',
        'false' => 'Disable',
    ],
    'desc' => 'Use this option if you wanna disable "autoload next post" feature just on this post.',

    'tab' => 'misc',
];

// since 4.1
$fields[] = [
    'id' => 'reading_progress',
    'name' => 'Reading Progress Bar',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'true' => 'Enable',
        'false' => 'Disable',
    ],

    'tab' => 'misc',
];

$fields[] = [
    'type' => 'select',
    'id' => 'column_layout',
    'name' => 'Colunn layout',
    'options' => [
        '' => 'Default',
        '1' => '1 column',
        '2' => '2 columns',
    ],
    'std' => '',
    
    'tab' => 'misc',
    
];

$fields[] = [
    'type' => 'select',
    'id' => 'blog_dropcap',
    'name' => 'Dropcap on blog posts',
    'options' => [
        '' => 'Default',
        'true' => 'Yes please!',
        'false' => 'No thanks!',
    ],
    'std' => '',
    
    'tab' => 'misc',
];

$fields[] = [
    'type' => 'select',
    'id' => 'dropcap',
    'name' => 'Dropcap on single post',
    'options' => [
        '' => 'Default',
        'true' => 'Yes please!',
        'false' => 'No thanks!',
    ],
    'std' => '',
    
    'tab' => 'misc',
];

$metaboxes[ 'post-settings' ] = array (

    'id' => 'post-settings',
    'screen' => array( 'post' ),
    'title' => esc_html__( 'Post Settings', 'wi' ),
    'context' => 'advanced',
    'tabs' => [

        'top-layout' => 'Layout',
        'layout' => 'Classic Layout',
        'general' => 'General',
        'builder' => 'Builder',
        'component' => 'Show/Hide',
        'format' => 'Format Options',
        'review' => 'Review',
        'sponsor' => 'Sponsor',
        'misc' => 'Miscellaneous',

    ],
    'fields' => $fields,

);