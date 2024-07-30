<?php
$options[ 'archive_layout_type' ] = array(
    
    'type'      => 'radio',
    'options'   => [
        'builder' => 'Builder (by Elementor)',
        'classic' => 'Predefined (non-Elementor)',
    ],
    'std'       => 'classic',
    'name'      => 'Archive Layout Type',
    
    'section' => 'blog_general',
    'section_title' => 'General',
    'panel' => 'blog',
    'panel_title' => 'Blog / Archive',
    'panel_priority' => 135,
    
    'hint' => 'Archive Builder',
    
    'toggle' => [
        'builder' => [
            'archive_template',
            'category_template',
            'tag_template',
            'author_template',
            'search_template',
            '404_template',
        ],
    ]
    
);

$template_list = [ '' => 'Choose Template' ];
if ( function_exists( 'fox_get_block_list' ) ) {
    $list = fox_get_block_list( 'archive' );
    if ( empty( $list ) ) {
        $template_list = [ '' => 'You must create a template first' ];
    } else {
        $template_list += $list;
    }
} else {
    $template_list = [ '' => 'You must install Fox Framework plugin first' ];
}

$options[ 'archive_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Home & general archive template',
);

$options[ 'category_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Category template',
);

$options[ 'tag_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Tag template',
);

$options[ 'author_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Author template',
);

$options[ 'search_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Search template',
);

$options[ '404_template' ] = array(
    'type'      => 'select',
    'options'   => $template_list,
    'std'       => '',
    'name'      => 'Page 404 template',
);







$options[ 'home_layout' ] = array(
    'type'      => 'select',
    'options'   => [
        'standard' => 'Standard',
        'list' => 'List',
        'grid' => 'Grid',
        'masonry' => 'Masonry',
        'newspaper' => 'Newspaper',
        'vertical' => 'Post Vertical',
    ],
    'std'       => 'list',
    'name'      => 'Homepage Layout',
    
    'section' => 'blog_home',
    'section_title' => 'Homepage Layout',
    'panel' => 'blog',

    'hint' => 'Homepage layout',
);

$options[ 'home_sidebar_state' ] = array(
    'type'      => 'select',
    'options'   => [
        'sidebar-left'  => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
        'no-sidebar'    => 'No Sidebar',
    ],
    'std'       => 'sidebar-right',
    'name'      => 'Main Stream Sidebar',
    
    'hint' => 'Homepage sidebar',
);

$options[ 'home_number' ] = array(
    'type'      => 'text',
    'name'      => esc_html__( 'Custom number of posts to show on blog', 'wi' ),
    'placeholder' => 'Eg. 5',
    'desc'      => 'This option only works for the main blog. For a general setting of number of posts to show, please visit Dashboard > Settings > Reading',
    
    'hint' => 'Main stream number of posts',
);

$options[ 'offset' ] = array(
    'type'      => 'text',
    'name'      => 'Offset?',
    'placeholder' => 'Eg. 3',
    'desc'      => 'If you enter 3, your blog stream starts from 4th. This option only works for the main blog.',
    
    'hint' => 'Main stream offset',
);

$categories = get_categories( array(
    'fields' => 'id=>name',
    'orderby'=> 'slug',
    'hide_empty' => false,

    'number' => 2000, // prevent huge blogs
));

$options[ 'exclude_sticky' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Exclude sticky posts',
    'std'       => 'false',
    'options'   => [
        'true' => 'Yes please!',
        'false' => 'No thanks!'
    ],
    
    'hint' => 'Exclude sticky posts',
);

$options[ 'exclude_featured_posts' ] = array(
    'shorthand' => 'enable',
    'name'      => 'Exclude featured posts',
    'std'       => 'false',
    'options'   => [
        'true' => 'Yes please!',
        'false' => 'No thanks!'
    ],
    
    'hint' => 'Exclude featured posts',
);

// since 4.0
$options[ 'include_categories' ] = array(
    'type'      => 'multicheckbox',
    'name'      => 'Include only categories:',
    'std'       => '',
    'options'   => $categories,
    
    'hint' => 'Main stream include/exclude cats',
);

$options[ 'exclude_categories' ] = array(
    'type'      => 'multicheckbox',
    'name'      => 'Exclude categories:',
    'options'   => $categories,
);

/* Layout
----------------------------------- */
$pages = [
    'category' => 'Category',
    'tag' => 'Tag',
    'archive' => 'Date / Month / Year',
    'author' => 'Author',
    'search' => 'Search',
];

$sidebar_list = [ '' => 'Default' ];
foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
    $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
}

foreach ( $pages as $page => $name ) {

    $options[] = [
        'type' => 'heading',
        'name' => $name,

        'section' => 'blog_archive',
        'section_title' => 'Archive Layouts (Category, Tag..)',
        'panel' => 'blog',
    ];

    $options[ $page . '_layout' ] = array(
        'type'      => 'select',
        'options'   => $layout_options,
        'std'       => 'list',
        'name'      => $name . ' Layout',
        
        'hint' =>  $name . ' layout',
    );

    $options[ $page . '_sidebar_state' ] = array(
        'type'      => 'select',
        'options'   => [
            'sidebar-left'  => 'Sidebar Left',
            'sidebar-right' => 'Sidebar Right',
            'no-sidebar'    => 'No Sidebar',
        ],
        'std'       => 'sidebar-right',
        'name'      => $name . ' Sidebar State',
        
        'hint' =>  $name . ' sidebar state',
    );
    
    $options[ $page . '_sidebar' ] = array(
        'type'      => 'select',
        'options'   => $sidebar_list,
        'std'       => '',
        'name'      => 'Choose ' . $name . ' Sidebar',
        
        'hint' =>  $name . ' sidebar',
    );

}

/* Category / Tag top area
----------------------------------- */
$archive_types = [
    'category' => 'Category',
    'tag' => 'Tag',
    'author' => 'Author',
];

$options[ 'top_area_non_duplicate' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name' => 'Non-duplicate posts?',
    'desc' => 'Ie. if a post is shown in top area, it won\'t be displayed again in the main stream',
    
    'section' => 'blog_toparea',
    'section_title' => 'Archive Top Area',
    'panel' => 'blog',
);

foreach ( $archive_types as $slug => $name ) {

    $prefix = $slug . '_top_area_';

    $options[] = array(
        'type'      => 'heading',
        'name'      => $name . ' Top Area',

        'section' => 'blog_toparea',
        'section_title' => 'Archive Top Area',
        'panel' => 'blog',
        
        'hint' =>  $name . ' top area',
    );

    $options[ $prefix . 'display' ] = array(
        'type'      => 'select',
        'options'   => [
            '' => 'None',
            'view' => 'Most Viewed Posts',
            'comment_count' => 'Most Commented Posts',
            'featured' => 'Featured Posts (Starred Posts)',
        ],
        'std'       => '',
        'name'      => 'Top area of ' . $name . ' shows:',
    );

    $options[ $prefix . 'layout' ] = array(
        'type'      => 'select',
        'options'   => fox_topbar_layout_support(),
        'std'       => 'group-1',
        'name'      => 'Top area layout',
    );

    $options[ $prefix . 'number' ] = array(
        'type'      => 'text',
        'std'       => '4',
        'placeholder' => '4',
        'name'      => 'Number of posts to show',
    );

}

/* Pagination
----------------------------------- */
$options[ 'pagination_style' ] = array(
    'type'      => 'radio',
    'std'       => '1',
    'name' => 'Pagination Style',
    'options'   => [
        '1'     => 'Style 1 (Minimal)',
        '2'     => 'Style 2 (Square border)',
        '3'     => 'Style 3 (Square gray)',
        '4'     => 'Style 4 (Circle)',
    ],
    
    'section' => 'blog_pagination',
    'section_title' => 'Pagination',
    'panel' => 'blog',
    
    'hint' => 'Pagination style',
);

$post_layout_options = fox_customize_post_layout_options();

$options += $post_layout_options;