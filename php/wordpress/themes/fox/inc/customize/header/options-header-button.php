<?php
// BUTTON 1
$fox56_customize->add_section( "header_button1", [
    "title" => "BUTTON 1",
    "panel" => "header",
]);
fox56_create_button_fields( 1, 'header_button1' );

// BUTTON 2
$fox56_customize->add_section( "header_button2", [
    "title" => "BUTTON 2",
    "panel" => "header",
]);
fox56_create_button_fields( 2, 'header_button2' );

/**
 * Create list fields of button
 */
function fox56_create_button_fields($i, $section) {

    global $fox56_customize;
    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_text",
        "title" => "Text",
        "hint" => "",
        "desc" => "",
        "std" => "Button {$i}",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_icon",
        "title" => "Icon",
        "hint" => "",
        // "desc" => 'Icon name. e.g: <strong>bell</strong>, <strong>file</strong>.. choose <a href="https://fontawesome.com/search" target="_blank">icon here</a>',
        "desc" => 'Icon name. e.g: <strong>bell</strong>, <strong>file</strong>.. choose <a href="https://fontawesome.com/v5/search?m=free" target="_blank">icon here</a>',
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    // $fox56_customize->add_field([
    //     "type" => "select",
    //     "id" => "header_button{$i}_icon",
    //     "title" => "Icon",
    //     "hint" => "",
    //     "desc" => "",
    //     "section" => $section,
    //     "options" => [
    //         ""  => "--No icon--",
    //         "check" => "Check",
    //         "phone" => "Phone",
    //         "image" => "Image",
    //     ],
    //     "subtype" => "icon",
    //     "std" => "",
    //     "refresh" => [
    //         "selector" => ".header56__button{$i}",
    //         "render_callback" => "fox56_header_button{$i}_inner",
    //     ]
    // ]);
    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_url",
        "title" => "URL",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    $fox56_customize->add_field([
        "type" => "checkbox",
        "id" => "header_button{$i}_target",
        "title" => "Open link in a new tab.",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    // size
    $fox56_customize->add_field([
        "type" => "select",
        "id" => "header_button{$i}_size",
        "title" => "Size",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "options" => [
            "tiny" => "Tiny",
            "small" => "Small",
            "normal" => "Normal",
            "medium" => "Medium",
            "large" => "Large",
        ],
        "std" => "small",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    // style
    $fox56_customize->add_field([
        "type" => "select",
        "id" => "header_button{$i}_style",
        "title" => "Style",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "options" => [
            "primary" => "Primary",
            "black" => "Black",
            "outline" => "Outline",
            //Custom style
            "fill" => "--Custom--",
        ],
        "std" => "fill",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
    ]);
    
    // Color
    $fox56_customize->add_field([
        "heading" => "Color",
        "type" => "color",
        "id" => "header_button{$i}_text_color",
        "title" => "Color",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [
            "header_button{$i}_style" => "fill"
        ]
    ]);
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_text_color_hover",
        "title" => "Text color hover",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [
            "header_button{$i}_style" => "fill"
        ]
    ]);
    // Background color
    $fox56_customize->add_field([
        "heading" => "Background color",
        "type" => "color",
        "id" => "header_button{$i}_bg_color",
        "title" => "Background color",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [
            "header_button{$i}_style" => "fill"
        ]
    ]);
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_bg_color_hover",
        "title" => "Background color hover",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [
            "header_button{$i}_style" => "fill"
        ]
    ]);
    // border
    $fox56_customize->add_field([
        "heading" => "Border",
        "type" => "number",
        "id" => "header_button{$i}_border_radius",
        "title" => "Border radius",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "std" => 0,
        "min" => 0,
        "max" => 50,
        "step" => 1,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        // "condition" => [
        //     "header_button{$i}_style" => "fill"
        // ]
    ]);
    $fox56_customize->add_field([
        "type" => "number",
        "id" => "header_button{$i}_border_width",
        "title" => "Border width",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "std" => 1,
        "min" => 0,
        "max" => 9,
        "step" => 1,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [
            "header_button{$i}_style" => "fill"
        ]
    ]);

    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_border_color",
        "title" => "Border color",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        'condition' => [
            "header_button{$i}_style" => "fill",
            // "header_button{$i}_border_width" => ["1","2","3","4","5","6","7","8","9"],
        ],
    ]);
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_border_color_hover",
        "title" => "Border color hover",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
        "condition" => [ 
            "header_button{$i}_style" => "fill",
            // "header_button{$i}_border_width" => ["1","2","3","4","5","6","7","8","9"],
        ],
    ]);
    // size
    $fox56_customize->add_field([
        'heading' => 'Additional options',
        "type" => "select",
        "id" => "header_button{$i}_block",
        "title" => "Block",
        "hint" => "",
        "desc" => "",
        "section" => $section,
        "options" => [
            "" => "Default",
            "full" => "Full",
            "half" => "Half",
            "third" => "Third",
        ],
        "std" => "",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    // extra_class
    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_extra_class",
        "title" => "CSS class",
        "hint" => "my-button",
        "desc" => "Add your custom class WITHOUT the dot. e.g: my-button",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
}