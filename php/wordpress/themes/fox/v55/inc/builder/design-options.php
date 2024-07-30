<?php
function fox_builder_design_options() {
    
    $sidebar_list = [ '' => '--- NONE ---' ];
    foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
        $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
    }
    
    $design_options = [
        
        /* Design
        --------------------------------------------------------------------------- */
        'visibility' => [
            'name' => 'Visibility',
            'type' => 'select',
            'options'   => [
                'true' => 'Display this section',
                'false' => 'Hide it temporarily',
            ],
            'std' => 'true',
            'desc' => 'You can hide it temporarily for future use if you need.',
            'tab' => 'design',
        ],
        
        'section_visibility' => [
            'name' => 'Show section on:',
            'type' => 'multicheckbox',
            'options'   => [
                'desktop' => 'Desktop',
                'tablet' => 'Tablet',
                'mobile' => 'Mobile',
            ],
            'std' => 'desktop,tablet,mobile',
            'tab' => 'design',
        ],
        
        'stretch' => [
            'name'      => 'Stretch',
            'type'      => 'select',
            'options'   => [
                'narrow' => 'Narrow width',
                'content' => 'Content width',
                'full' => 'Full width (edge of screen)'
            ],
            'std'       => 'content',
            'tab' => 'design',
        ],

        'background' => [
            'name'      => 'Background',
            'type'      => 'color',
            'tab' => 'design',
        ],

        'text_color' => [
            'name'      => 'Text Color',
            'type'      => 'color',
            'tab' => 'design',
        ],

        'border' => [
            'name'      => 'Border',
            'type'      => 'select',
            'options' => [
                ''    => 'None',
                'shadow' => '3D-like',
                '1px' => 'Border 1px',
                '2px' => 'Border 2px',
                '3px' => 'Border 3px',
                '4px' => 'Border 4px',
                '5px' => 'Border 5px',
                '6px' => 'Border 6px',
                '8px' => 'Border 8px',
                '10px' => 'Border 10px',
                'dotted' => 'Dotted',
                'dashed' => 'Dashed',
            ],
            'std'    => '',
            'tab' => 'design',
        ],
        
        // SIDEBAR
        [
            'name' => 'Sidebar',
            'type' => 'heading',
            'tab' => 'design',
        ],
        
        'sidebar' => [
            'name'    => 'Sidebar?',
            'type'     => 'select',
            'options'   => $sidebar_list,
            'std'       => '',
            'tab' => 'design',
        ],

        'sidebar_position' => [
            'name'    => 'Sidebar position',
            'type'     => 'select',
            'options'   => [
                'left' => 'Left',
                'right' => 'Right',
            ],
            'std'       => 'right',
            'tab' => 'design',
        ],

        'sidebar_sticky' => [
            'name'    => 'Sticky Sidebar?',
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'std' => 'false',
            'tab' => 'design',
        ],

        'sidebar_sep' => [
            'name'    => 'Separator between main & sidebar',
            'type' => 'select',
            'options' => [
                'true' => 'Yes please!',
                'false' => 'No thanks!',
            ],
            'toggle' => [
                'true' => 'sidebar_sep_color',
            ],
            'std' => 'false',
            'tab' => 'design',
        ],

        'sidebar_sep_color' => [
            'name'    => 'Separator color',
            'type'    => 'color',
            'tab' => 'design',
        ],
        
        // Extra
        [
            'name' => 'Extra',
            'type' => 'heading',
            'tab' => 'design',
        ],
        
        'section_id' => [
            'name' => 'Section ID',
            'type' => 'text',
            'desc' => 'Only letters, numbers and dash (-)',
            'tab' => 'design',
            
            'available' => 'builder',
        ],
        
        'class' => [
            'name' => 'Extra CSS Class',
            'type' => 'text',
            'desc' => 'Only letters, numbers and dash (-)',
            'tab' => 'design',
        ],
        
    ];
    
    return apply_filters( 'fox_design_options', $design_options );
    
}