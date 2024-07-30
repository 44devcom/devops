<?php
$fields[ 'number' ] = [
    'type' => 'number',
    'min' => -1,
    'std' => 3,
    'title' => 'Number of posts?',
    'tab' => 'query',
];

$fields[ 'orderby' ] = [
    'type' => 'select',
    'std' => '',
    'options' => [
        '' => 'Default',
        'date'  =>'Published Date',
        'modified'  =>'Modified Date',
        'title'  =>'Post title',
        'comment_count'=>'Comment count',
        'view'=>'View count',
        'view_week' =>'View count (Weekly)',
        'view_month'=>'View count (Monthly)',
        'view_year'=>'View count (Yearly)',
        
        'menu_order' => 'Menu Order',

        'review_score' => 'Review Score',
        'review_date' => 'Recent Review',
        'rand' => 'Random',
    ],
    'title' => 'Order by',
];

$fields[ 'order' ] = [
    'type' => 'radio',
    'std' => 'DESC',
    'options' => [
        'ASC' => 'ASC',
        'DESC' => 'DESC',
    ],
    'title' => 'Order',
];

$fields[ 'featured' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Only featured posts?',
];

$fields[ 'categories' ] = [
    'type' => 'multiselect',
    'title' => 'Category',
    'options' => $category_list,
];

$fields[ 'exclude_categories' ] = [
    'type' => 'multiselect',
    'title' => 'Exclude Category',
    'options' => $category_list,
];

$fields[ 'tags' ] = [
    'type' => 'text',
    'title' => 'Include only tags:',
    'desc' => 'Use tag IDs, eg. 5, 291, 67',
];

$fields[ 'exclude_tags' ] = [
    'type' => 'text',
    'title' => 'Exclude following tags:',
    'desc' => 'Use tag IDs, eg. 5, 291, 67',
];

$fields[ 'authors' ] = [
    'type' => 'multiselect',
    'title' => 'Include only author:',
    'multiple' => true,
    'options' => $author_list,
];

$fields[ 'format' ] = [
    'type' => 'select',
    'title' => 'Post Format',
    'options' => [
        '' => 'All',
        'standard' => 'Only Standard',
        'video' => 'Only Video',
        'audio' => 'Only Audio',
        'gallery' => 'Only Gallery',
        'link' => 'Only Link',
    ],
    'std' => '',

];

$fields[ 'include' ] = [
    'type' => 'text',
    'title' => 'Include only post IDs:',
    'desc' => 'Eg. 5, 17, 211',
];

$fields[ 'exclude' ] = [
    'type' => 'text',
    'title' => 'Exclude post IDs:',
    'desc' => 'Eg. 5, 17, 211',
];

$fields[ 'exclude_displayed' ] = [
    'type' => 'select',
    'title' => 'Exclude previously displayed posts',
    'options' => [
        '' => 'Inherit from Builder Settings',
        'true' => 'Yes',
        'false' => 'No',
    ],
    'std' => '',
    'tab' => 'query',
    'desc' => 'If you choose Yes, It will skip posts have been displayed by previous sections. This is for Non-duplicated posts.',
];

$fields[ 'offset' ] = [
    'type' => 'number',
    'std' => 0,
    'title' => 'Offset',
    'desc' => 'Number of posts to pass by',
];

$fields[ 'exclude_sticky' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Exclude sticky posts?',
    'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
];

$fields[ 'exclude_featured_posts' ] = [
    'type' => 'checkbox',
    'std' => false,
    'title' => 'Exclude featured posts?',
    'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
];

$fields[ 'pagination' ] = [
    'type' => 'checkbox',
    'title' => 'Pagination?',
];

$fields[ 'disable_paged' ] = [
    'type' => 'checkbox',
    'title' => 'Disable this section from 2nd pages?',
];

$fields[ 'custom_query' ] = [
    'type' => 'textarea',
    'title' => 'Custom Query String',
    'desc' => 'Do not enter if you don\'t understand what are you doing.',
];

/* ---------------------------------        cpt         */
$fields[ 'cpt__heading' ] = [
    'type' => 'heading',
    'heading' => 'Custom post type',
];

$fields[ 'post_type' ] = [
    'type' => 'text',
    'title' => 'Enter custom post type',
    'desc' => 'Eg. my_movie. You can enter several post types, separated by comma: post, my_movie, my_book',
];

$fields[ 'tax_1' ] = [
    'type' => 'text',
    'title' => 'Enter custom taxonomy 1',
    'desc' => 'Eg. movie_genre',
];

$fields[ 'tax_1_value' ] = [
    'type' => 'text',
    'title' => 'Taxonomy 1 value (name)',
    'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
];

$fields[ 'tax_2' ] = [
    'type' => 'text',
    'title' => 'Enter custom taxonomy 2',
    'desc' => 'Eg. movie_genre',
];

$fields[ 'tax_2_value' ] = [
    'type' => 'text',
    'title' => 'Taxonomy 2 value (name)',
    'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
];