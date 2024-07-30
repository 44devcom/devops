<?php
function fox_builder_query_options() {
    
    // orderby array
    $orderby_arr = array(
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
    );

    // author array
    $author_arr = [];
    $authors = get_users([
        'capability' => ['edit_posts'],
        'orderby' => 'display_name',
        'order' => 'ASC',
        'number' => 100,
    ]);
    foreach ( $authors as $user ) {
        $author_arr[ $user->user_nicename ] = $user->display_name;
    }

    // cat array
    $cat_arr = [];
    $cats = get_categories();
    foreach ( $cats as $cat ) {
        $cat_arr[ 'cat_' . $cat->slug ] = $cat->name;
    }
    
    $query_options = [
        'number' => [
            'type' => 'text',
            'placeholder' => 'Eg. 3',
            'name' => 'Number of posts',
            'std' => '3',
            'tab' => 'query',
        ],

        'featured' => [
            'type' => 'checkbox',
            'name' => 'Display only featured posts?',
            'desc' => 'Featured posts are posts starred in "Dashboard > Posts" list.',
            'tab' => 'query',
        ],
        
        'sticky' => [
            'type' => 'checkbox',
            'name' => 'Display only sticky posts?',
            'desc' => 'This is a deprecated feature added for backward compatibility so you shouldn\'t use it.',
            'tab' => 'query',
        ],

        'orderby' => [
            'type' => 'select',
            'options' => $orderby_arr,
            'std' => 'date',
            'name' => 'Order by?',
            'tab' => 'query',
        ],

        'order' => [
            'type' => 'select',
            'options' => [
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ],
            'std' => 'desc',
            'name' => 'Order?',
            'tab' => 'query',
        ],

        'categories' => [
            'type' => 'multiselect',
            'name' => 'Include only categories',
            'options' => $cat_arr,
            'std' => '',
            'tab' => 'query',
        ],

        'exclude_categories' => [
            'type' => 'multiselect',
            'name' => 'Exclude categories',
            'options' => $cat_arr,
            'std' => '',
            'tab' => 'query',
        ],
        
        'tags' => [
            'type' => 'text',
            'placeholder' => 'Eg. 28, 192',
            'name' => 'Include only tags:',
            'std' => '',
            'desc' => 'Enter tag IDs, separate them by commas',
            'tab' => 'query',
        ],

        'authors' => [
            'type' => 'multiselect',
            'name' => 'Include only authors',
            'options' => $author_arr,
            'std' => '',
            'tab' => 'query',
        ],

        'format' => [
            'type' => 'select',
            'name' => 'Format',
            'options' => [
                'all' => 'All',
                'gallery' => 'Gallery',
                'video' => 'Video',
                'audio' => 'Audio',
                'link' => 'Link',
            ],
            'std' => 'all',
            'tab' => 'query',
        ],

        'include' => [
            'type' => 'text',
            'name' => 'Include only following posts:',
            'placeholder' => 'Eg. 23, 125, 16',
            'desc' => 'Enter post IDs, separate them by commas',
            'tab' => 'query',
        ],

        'exclude' => [
            'type' => 'text',
            'name' => 'Exclude following posts:',
            'placeholder' => 'Eg. 23, 125, 16',
            'desc' => 'Enter post IDs, separate them by commas',
            'tab' => 'query',
        ],

        'offset' => [
            'name'    => 'Offset',
            'desc'      => 'Number of posts to pass by',
            'type'     => 'text',
            'tab' => 'query',
        ],

        'pagination' => [
            'name'    => 'Pagination',
            'type'    => 'checkbox',
            'tab'     => 'query',
        ],

        'custom_query' => [
            'name'      => 'Custom Query',
            'type'      => 'textarea',
            'tab' => 'query',
            'placeholder' => 'Eg. posts_per_page=1&order=asc',
            'desc'      => 'Never use unless you know exactly what are you doing.',
        ],
        
        'cpt_heading' => [
            'name'      => 'Custom Post Type',
            'type'      => 'heading',
            
            'tab' => 'query',
        ],
        
        'post_type' => [
            'type' => 'text',
            'placeholder' => 'Eg. movie',
            'name' => 'Post Type',
            'desc' => 'Enter your post type slug, eg. movie. If you have few post types, use commas to separate them. Enter "any" (without quotes) to display any post type.',
            
            'tab' => 'query',
        ],
        
        'tax_1' => [
            'type' => 'text',
            'placeholder' => 'Eg. genre',
            'name' => 'Taxonomy 1 slug',
            'desc' => 'If your taxonomy is Genre, the slug is probably genre but sometimes it may have prefix. Make sure you enter correct the taxonomy slug. Otherwise it won\'t work as expected',
            
            'tab' => 'query',
        ],
        
        'tax_1_value' => [
            'type' => 'text',
            'placeholder' => 'Eg. Comedy, Fiction',
            'name' => 'Taxonomy 1 values',
            'desc' => 'Enter name values for your taxonomy. Separate them by commas.',
            
            'tab' => 'query',
        ],
        
        'tax_2' => [
            'type' => 'text',
            'placeholder' => 'Eg. director',
            'name' => 'Taxonomy 2 slug',
            'desc' => 'If your taxonomy is Genre, the slug is probably genre but sometimes it may have prefix. Make sure you enter correct the taxonomy slug. Otherwise it won\'t work as expected',
            
            'tab' => 'query',
        ],
        
        'tax_2_value' => [
            'type' => 'text',
            'placeholder' => 'Eg. Nolan, Spielberg',
            'name' => 'Taxonomy 2 values',
            'desc' => 'Enter name values for your taxonomy. Separate them by commas.',
            
            'tab' => 'query',
        ],
        
    ];
    
    return apply_filters( 'fox_query_options', $query_options );
    
}