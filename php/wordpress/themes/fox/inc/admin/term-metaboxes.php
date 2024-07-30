<?php
$sidebars = [
    '' => 'Default',
    'sidebar-left' => 'Sidebar Left',
    'sidebar-right' => 'Sidebar Right',
    'no-sidebar' => 'No Sidebar',
];

$toparea_layouts = array_merge( [ '' => 'Default' ], fox_topbar_layout_support() );

$fields = [];

$fields[] = [
    'id' => 'layout',
    'name' => 'Layout',
    'type' => 'select',
    'options' => [
        '' => '-- Default --',
        'grid-1' => 'Grid 1 col',
        'grid-2' => 'Grid 2 cols',
        'grid-3' => 'Grid 3 cols',
        'grid-4' => 'Grid 4 cols',
        'grid-5' => 'Grid 5 cols',
        'masonry-1' => 'Masonry 1 col',
        'masonry-2' => 'Masonry 2 cols',
        'masonry-3' => 'Masonry 3 cols',
        'masonry-4' => 'Masonry 4 cols',
        'masonry-5' => 'Masonry 5 cols',
        'list'      => 'List',
    ],
    'std' => '',
];

$fields[] = [
    'id' => 'sidebar_state',
    'name' => 'Sidebar State',
    'type' => 'select',
    'options' => $sidebars,
    'std' => '',
];

$sidebarlist = [ '' => '-- Default --' ];
$all_sidebars = get_theme_mod( 'fox_sidebars', [] );
foreach ( $all_sidebars as $slug => $sidebar_data ) {
    $name = isset( $sidebar_data[ 'name' ] ) ? $sidebar_data[ 'name' ] : '';
    $sidebarlist[ $slug ] = $name;
}

$fields[] = [
    'id' => 'sidebar_sidebar',
    'name' => 'Select Sidebar',
    'type' => 'select',
    'options' => $sidebarlist,
    'std' => '',
];

$fields[] = [
    'id' => 'toparea_layout',
    'name' => 'Toparea Layout',
    'type' => 'select',
    'options' => [
        '' => '-- Default --',
        'grid-1' => 'Grid 1 col',
        'grid-2' => 'Grid 2 cols',
        'grid-3' => 'Grid 3 cols',
        'grid-4' => 'Grid 4 cols',
        'grid-5' => 'Grid 5 cols',

        'masonry-1' => 'Masonry 1 col',
        'masonry-2' => 'Masonry 2 cols',
        'masonry-3' => 'Masonry 3 cols',
        'masonry-4' => 'Masonry 4 cols',
        'masonry-5' => 'Masonry 5 cols',
        
        'list'      => 'List',

        'carousel-2' => 'Carousel 2 cols',
        'carousel-3' => 'Carousel 3 cols',
        'carousel-4' => 'Carousel 4 cols',
        'slider' => 'Slider',
        'group' => 'Group',
    ],
    'std' => '',
];

$fields[] = [
    'id' => 'toparea_group_layout',
    'name' => 'Toparea Group Layout',
    'type' => 'radio_image',
    'options' => [
        '' => '-- Default --',
        
        // 2 COLS
        '1-1' => '1-1',
        '2-1' => '2-1',
        '1-2' => '1-2',
        '1-3' => '1-3',
        '3-1' => '3-1',
        '2-3' => '2-3',
        '3-2' => '3-2',

        // 3 COLS
        '3-1-1' => '3-1-1',
        '1-3-1' => '1-3-1',
        '1-1-3' => '1-1-3',

        '2-1-1' => '2-1-1',
        '1-2-1' => '1-2-1',
        '1-1-2' => '1-1-2',
    ],
    'std' => '',
];

$fields[] = [
    'id' => 'toparea_number',
    'name' => 'Toparea number of posts to show',
    'type' => 'text',
    'std' => '',
];

$fields[] = [
    'id' => 'toparea_include',
    'name' => 'Specify post IDs to display for top area',
    'type' => 'text',
    'placeholder' => 'Eg. 16, 292',
    'std' => '',
    'desc' => 'Those posts don\'t need to belong to this category',
];

$fields[] = [
    'id' => 'toparea_display',
    'name' => 'Toparea displays',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'none' => 'None',
        'view' => 'Most Viewed Posts',
        'comment_count' => 'Most Commented Posts',
        'featured' => 'Featured Posts (Starred Posts)',
        'latest' => 'Latest posts',
    ],
    'std' => '',
];

$fields[] = [
    'id' => 'thumbnail',
    'name' => 'Thumbnail',
    'desc' => 'Used in grid of categories.',
    'type' => 'image',
];

$fields[] = [
    'id' => 'background_image',
    'name' => 'Background Image',
    'desc' => 'Used in category page as the header background.',
    'type' => 'image',
];

$fields[] = [
    'id' => 'priority',
    'name' => 'Priority',
    'desc' => 'If post has simultaneously cateogry A - priority 5 and category B - priority 10 then B will be chosen as primary category',
    'type' => 'text',
];
?>