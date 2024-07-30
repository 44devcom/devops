<?php
$fields = array();
    
$fields[] = array(
    'id' => 'title',
    'type' => 'text',
    'name' => esc_html__( 'Title', 'wi' ),
    'std' => '',
);

$fields[] = array(
    'id' => 'feed_id',
    'type' => 'text',
    'name' => 'Feed ID',
    'desc' => 'Since version 6.0, Feed ID is required. Normally, your feed ID is 1. If It\'s not the case, please check <a href="' . get_admin_url( '', 'admin.php?page=sbi-feed-builder' ) . '" target="_blank">your feed list</a> to see what is your feed ID.',
    'std' => '1',
);

/*
$numbers = array( '1' => esc_html__( '1 Photo', 'wi' ) );
for ( $i = 2; $i <= 12; $i++ ) {
    $numbers[ (string) $i ] = sprintf( esc_html__( '%d Photos', 'wi' ), $i );
}

$columns = array( '1' => esc_html__( '1 Column', 'wi' ) );
for ( $i = 2; $i <= 9; $i++ ) {
    $columns[ (string) $i ] = sprintf( esc_html__( '%d Columns', 'wi' ), $i );
}

$fields[] = array(
    'id' => 'number',
    'type' => 'select',
    'options'=> $numbers,
    'std'   => '9',
    'name' => esc_html__( 'Number of photos', 'wi' ),
);

$fields[] = array(
    'id' => 'column',
    'type' => 'select',
    'options'=> $columns,
    'std'   => '3',
    'name' => esc_html__( 'Columns?', 'wi' ),
);

$fields[] = array(
    'id' => 'item_spacing',
    'type' => 'select',
    'name' => 'Item Spacing',
    'std' => 'tiny',
    'options' => [
        'none' => 'No spacing',
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'wide' => 'Wide',
        'wider' => 'Wider',
    ],
);
*/

$fields[] = [
    'id' => 'hover_style',
    'type' => 'select',
    'options' => [
        'none' => 'None',
        'fade' => 'Fade',
        'border' => 'Border',
    ],
    'std'   => 'none',
    'name'  => 'Hover style',
];

/*
$fields[] = array(
    'id' => 'show_header',
    'type' => 'checkbox',
    'std' => true,
    'name' => 'Show Header?',
);
*/

$fields[] = array(
    'id' => 'heading_text',
    'type' => 'text',
    'placeholder' => 'WiThemes',
    'name' => 'Heading Text',
);

$fields[] = array(
    'id' => 'heading_text_icon',
    'type' => 'checkbox',
    'std' => true,
    'name' => 'Instagram Icon?',
);

$fields[] = array(
    'id' => 'heading_subtitle',
    'type' => 'text',
    'name' => 'Heading text subtitle',
    'placeholder' => 'Follow us on Instagram',
);

$fields[] = array(
    'id' => 'profile_url',
    'type' => 'text',
    'placeholder' => 'https://instagram.com/your_username/',
    'name' => 'Instagram Profile URL',
);

$fields[] = array(
    'id' => 'follow_text',
    'type' => 'text',
    'std'   => esc_html__( 'Follow Us', 'wi' ),
    'name'  => esc_html__( 'Follow Text', 'wi' ),
);

$fields[] = [
    'id' => 'follow_text_style',
    'type' => 'select',
    'options' => [
        'black' => 'Black',
        'outline' => 'Outline',
        'fill' => 'Fill',
        'primary' => 'Primary',
        'white' => 'White',
        'insta' => 'Instagram button'
    ],
    'std'   => 'insta',
    'name'  => 'Follow button style',
];

$fields[] = [
    'id' => 'follow_text_position',
    'type' => 'select',
    'options' => [
        'after' => 'After photos',
        'overlap' => 'Overlap photos',
    ],
    'std'   => 'after',
    'name'  => 'Follow button position',
];

/*
if ( fox_is_demo() ) {
    
    $fields[] = [
        'name' => 'Upload your images',
        'type' => 'images',
        'id' => 'images',
    ];
    
}
*/