<?php
$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
    ),
    
    array(
        'id' => 'layout',
        'type' => 'select',
        'name' => 'Layout',
        'options' => [
            'stack' => 'Stack',
            'inline' => 'Inline',
        ],
        'std' => 'stack',
    ),
    
    array(
        'id' => 'align',
        'type' => 'select',
        'name' => 'Align',
        'options' => [
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right',
        ],
        'std' => 'left',
    ),
    
);