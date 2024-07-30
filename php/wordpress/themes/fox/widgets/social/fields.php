<?php
$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
        'std' => '',
    ),
    [
        'id' => 'size',
        'type' => 'text',
        'placeholder' => 'Eg. 32',
        'name' => 'Icon container size',
    ],
    [
        'id' => 'font_size',
        'type' => 'text',
        'placeholder' => 'Eg. 17',
        'name' => 'Icon Size',
    ],
    [
        'id' => 'border_width',
        'type' => 'select',
        'options' => [
            '0px' => 'No border',
            '1px' => '1px',
            '2px' => '2px',
            '3px' => '3px',
        ],
        'std' => '0px',
        'name' => 'Border',
    ],
    [
        'id' => 'border_radius',
        'type' => 'text',
        'name' => 'Border radius',
        'placeholder' => 'Eg. 4px',
    ],
    [
        'id' => 'spacing',
        'type' => 'text',
        'name' => 'Spacing between icons',
        'placeholder' => 'Eg. 3px',
    ],
    /*
    array(
        'id' => 'style',
        'type' => 'select',
        'options' => [
            'plain'     => 'Plain Icons',
            'black'     => 'Black',
            'outline'   => 'Outline',
            'fill'      => 'Fill',
            'color'     => 'Brand Color',
        ],
        'name' => 'Style',
        'std' => 'black',
    ),
    
    array(
        'id' => 'shape',
        'type' => 'select',
        'options' => [
            'circle'     => 'Circle',
            'square'     => 'Square',
            'round'     => 'Round',
        ],
        'name' => 'Shape',
        'std' => 'shape',
    ),

    array(
        'id' => 'size',
        'type' => 'select',
        'options' => fox_social_size_support(),
        'name' => 'Size',
        'std' => 'normal',
    ),
    *
    
    array(
        'id' => 'spacing',
        'type' => 'select',
        'options' => fox_social_spacing_support(),
        'name' => 'Spacing between icons',
        'std' => 'small',
    ),
    */

    array(
        'id' => 'align',
        'type' => 'select',
        'options' => [
            'left'     => 'Left',
            'center'     => 'Center',
            'right'     => 'Right',
        ],
        'name' => 'Align',
        'std' => 'center',
    ),
    
    array(
        'id' => 'color',
        'type' => 'color',
        'name' => 'Icon color',
    ),
    
    array(
        'id' => 'background_color',
        'type' => 'color',
        'name' => 'Icon background',
    ),
    
    array(
        'id' => 'border_color',
        'type' => 'color',
        'name' => 'Icon border color',
    ),
    
    array(
        'id' => 'hover_color',
        'type' => 'color',
        'name' => 'Icon hover color',
    ),
    
    array(
        'id' => 'hover_background_color',
        'type' => 'color',
        'name' => 'Icon hover background',
    ),
    
    array(
        'id' => 'hover_border_color',
        'type' => 'color',
        'name' => 'Icon hover border color',
    ),
    
);