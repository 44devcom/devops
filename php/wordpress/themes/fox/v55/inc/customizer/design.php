<?php
/* ------------------------------------------   GENERAL ------------------------------------------ */
$options[] = [
    'type' => 'heading',
    'name' => 'Body Typography',
    
    'section'     => 'design_general',
    'section_title'=> 'General',

    'panel'         => 'design',
    'panel_title'   => 'DESIGN',
    'panel_priority' => 140,
];

$id = 'body';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

/* --------------   LOCAL FONT SUPPORT --------------- */

$options[ $id . '_font_source' ] = array(
    'type'      => 'select',
    'options'   => [
        'standard' => 'Google Font',
        'local' => 'Upload Your Font',
    ],
    'std'       => 'standard',
    'toggle'    => [
        'standard' => [ $id . '_font' ],
        'local' => [ $id . '_font_upload_notice', $id. '_font_upload_woff2', $id . '_font_upload_woff', $id. '_custom_font', $id . '_fallback_font' ],
    ],

    'name'      => $name . ' Source',
    'hint' =>  'Body font',
);

/* Standard font
------------------ */
$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => $name,
    'std'       => $std,
    'inherit_options' => false,
);

/* Local font
------------------ */
$options[ $id . '_font_upload_notice' ] = [
    'type' => 'html',
    'std' => '<p class="fox-message"><strong>IMPORTANT</strong>: If you get error message <strong>"Sorry, this file type is not permitted for security reasons"</strong>, please install <strong>Fox Framework</strong> plugin in <em>Dashboard > Appearance > Install Plugins</em> to resolve it.</p>',
];

$options[ $id . '_font_upload_woff2' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff2 font file',
    'mime_type' => 'woff2',
];

$options[ $id . '_font_upload_woff' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff font file',
    'mime_type' => 'woff',
];

$options[ $id . '_custom_font' ] = [
    'type' => 'text',
    'name' => 'Font name (optional)',
];

$options[ $id . '_fallback_font' ] = [
    'type' => 'select',
    'options' => [
        'sans-serif' => 'Sans Serif',
        'serif' => 'Serif',
        'cursive' => 'Cursive',
        'monospace' => 'Monospace',
    ],
    'std' => 'sans-serif',
    'name' => 'Fallback font',
    'desc' => 'For characters your font doesn\'t support',
];

/* --------------   TYPOGRAPHY OPTIONS   --------------- */
$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

/* --------------   HEADING --------------- */
$options[] = [
    'type' => 'heading',
    'name' => 'H1, H2, H3.. Typography',
];

$id = 'heading';
$fontdata = $all[ $id ];
$name = $fontdata[ 'name' ];
$std = $fontdata[ 'std' ];

/* --------------   LOCAL FONT SUPPORT --------------- */
$options[ $id . '_font_source' ] = array(
    'type'      => 'select',
    'options'   => [
        'standard' => 'Google Font',
        'local' => 'Upload Your Font',
    ],
    'std'       => 'standard',
    'toggle'    => [
        'standard' => [ $id . '_font' ],
        'local' => [ $id . '_font_upload_notice', $id. '_font_upload_woff2', $id . '_font_upload_woff', $id. '_custom_font', $id . '_fallback_font' ],
    ],

    'name'      => $name . ' Source',
    
    'hint' =>  'Heading font',
);

/* Standard font
------------------ */
$options[ $id . '_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => $name,
    'std'       => $std,
    'inherit_options' => false,
);

/* Local font
------------------ */
$options[ $id . '_font_upload_notice' ] = [
    'type' => 'html',
    'std' => '<p class="fox-message"><strong>IMPORTANT</strong>: If you get error message <strong>"Sorry, this file type is not permitted for security reasons"</strong>, please install <strong>Fox Framework</strong> plugin in <em>Dashboard > Appearance > Install Plugins</em> to resolve it.</p>',
];

$options[ $id . '_font_upload_woff2' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff2 font file',
    'mime_type' => 'woff2',
];

$options[ $id . '_font_upload_woff' ] = [
    'type' => 'upload',
    'name' => 'Upload *woff font file',
    'mime_type' => 'woff',
];

$options[ $id . '_custom_font' ] = [
    'type' => 'text',
    'name' => 'Font name (optional)',
];

$options[ $id . '_fallback_font' ] = [
    'type' => 'select',
    'options' => [
        'sans-serif' => 'Sans Serif',
        'serif' => 'Serif',
        'cursive' => 'Cursive',
        'monospace' => 'Monospace',
    ],
    'std' => 'sans-serif',
    'name' => 'Fallback font',
    'desc' => 'For characters your font doesn\'t support',
];

/* --------------   TYPOGRAPHY OPTIONS   --------------- */
$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$fontdata = $all[ 'h2' ];
$options[ 'h2_typography' ] = [
    'shorthand' => 'typography',
    'name'      => 'H2 size',
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$fontdata = $all[ 'h3' ];
$options[ 'h3_typography' ] = [
    'shorthand' => 'typography',
    'name'      => 'H3 size',
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$fontdata = $all[ 'h4' ];
$options[ 'h4_typography' ] = [
    'shorthand' => 'typography',
    'name'      => 'H4 size',
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

/* --------------   FONT SUBSETS   --------------- */
$options[] = [
    'type' => 'heading',
    'name' => 'Font Subsets',
];

// Font Subsets
// 
$options[ 'font_subsets' ] = array(
    'type'      => 'multicheckbox',
    'name'      => esc_html__( 'Font Subsets', 'wi' ),
    'options'   => array(
        "latin" => 'Latin',
        "latin-ext" => 'Latin Extended',
        'greek' => 'Greek',
        "greek-ext" => 'Greek Extended',
        "cyrillic" => 'Cyrillic',
        "cyrillic-ext" => 'Cyrillic Extended',
        'vietnamese' => 'Vietnamese',
    ),
    'desc' => esc_html__( 'Note that not each font supports only certain languages, not all.', 'wi' ),
    
    'hint' =>  'Font subsets',
);

/* --------------   COLOR   --------------- */
$options[] = [
    'type' => 'heading',
    'name' => 'Color',
];

$options[ 'text_color' ] = [
    'shorthand' => 'color',
    'std' => '#000000',
    'name' => 'Body Text Color',
    'selector'  => 'body',
    
    'hint' =>  'Body text color',
];

$options[ 'heading_color' ] = [
    'shorthand' => 'color',
    'name' => 'Heading Color',
    'selector'  => 'h1, h2, h3, h4, h5, h6',
    
    'hint' =>  'Heading text color',
];

$options[ 'link_color' ] = [
    'shorthand' => 'color',
    'std' => '#db4a37',
    'name' => 'Link Color',
    'selector'  => 'a',
    'backend_selector' => 'a',
    
    'hint' =>  'Link color',
];

$options[ 'link_hover_color' ] = [
    'shorthand' => 'color',
    'std' => '#db4a37',
    'name' => 'Link Hover Color',
    'selector'  => 'a:hover',
    'backend_selector' => 'a:hover',
    
    'hint' =>  'Link hover color',
];

$options[ 'accent' ] = [
    'shorthand' => 'color',
    'std'       => '#db4a37',
    'name'      => 'Accent Color',
    'transport' => '',
    
    'hint' =>  'Accent color',
];

$options[ 'border_color' ] = array(

    'name'      => 'General Border Color',
    'shorthand' => 'border-color',
    'std'       => '#e1e1e1',
    'selector'  => fox_border_selector(),
    'desc'      => 'This is the general-purpose border line will be used in many area.',
    
    'hint' =>  'General border color',

);

$options[ 'selection_background' ] = [
    'shorthand' => 'color',
    'name'      => 'Selection Background Color',
    'transport' => '',
    
    'hint' =>  'Selection color',
];

$options[ 'selection_text_color' ] = [
    'shorthand' => 'color',
    'name'      => 'Selection Text Color',
    'transport' => '',
];

/* ------------------------------------------   DARK MODE ------------------------------------------ */
$options[ 'mode' ] = [
    'type' => 'radio',
    'options' => [
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std' => 'light',
    'name' => 'Light/Dark Mode',
    
    'section'     => 'design_darkmode',
    'section_title'=> 'Dark Mode',
    'panel' => 'design',
    
    'hint' => 'Dark Mode',
];

$options[ 'darkmode_note' ] = [
    'type' => 'html',
    'std' => '<p class="fox-info">Dark Mode is a <em>developing feature</em>. It\'s safe to use dark mode but if you run into any troubles, inconsistency of dark mode style, please let us know at <a href="https://withemes.ticksy.com/" target="_blank">our support desk</a>.</p>',
];

$options[ 'mode_btn' ] = [
    'type' => 'html',
    'std' => '<a href="#" class="button button-primary load_dark_style">Load Additional Dark Mode Styles</a>
    <br>
    <p class="fox-info">By clicking this button, it sets pleasing & appropriate border color, background color.. options to fit dark mode.</p>
    ',
];

$options[ 'darkmode_text_color' ] = [
    'shorthand' => 'color',
    'selector' => '.darkmode',
    'std' => '#fff',
    'name' => 'Dark Mode Text color',
];

$options[ 'darkmode_background_color' ] = [
    'shorthand' => 'background-color',
    'selector' => '.darkmode, .darkmode .wrapper-bg-element',
    'name' => 'Dark Mode Custom Background',
];

/* ------------------------------------------   LAYOUT ------------------------------------------ */
$options[ 'content_width' ] = array(
    'name'      => esc_html__( 'Content width (px)', 'wi' ),
    'desc'      => 'Enter a number. Default is 1080px.',
    'type'      => 'text',
    'std'       => 1080,

    'section'     => 'design_layout',
    'section_title'=> 'Site Layout',
    'panel' => 'design',
    
    'hint' =>  'Site content width',
);

$options[ 'sidebar_width' ] = array(
    'name'      => esc_html__( 'Sidebar width (px)', 'wi' ),
    'desc'      => 'Enter a number. Default is 265px.',
    'type'      => 'text',
    'std'       => 265,
    
    'hint' =>  'Sidebar width',
);

$options[ 'sticky_sidebar' ] = array(
    'name'      => esc_html__( 'Sticky sidebar?', 'wi' ),
    'shorthand' => 'enable',
    'std'       => 'false',
    
    'hint' =>  'Sticky sidebar',
);

$options[ 'body_layout' ] = array(
    'name'      => 'Site Layout',
    'type'      => 'select',
    'options'   => [
        'wide'  => 'Wide',
        'boxed' => 'Boxed',
    ],
    'std'       => 'wide',
    
    'hint' =>  'Boxed layout',
);

$options[ 'all_box' ] = array(
    'name'      => 'Box Outer Margin',
    'shorthand' => 'box',
    'fields'    => [ 'margin' ],
    
    'hint' =>  'Box outer margin',
);

$options[ 'wrapper_box' ] = array(
    'name'      => 'Box Outer Border',
    'shorthand' => 'box',
    'fields'    => [ 'padding', 'border', 'border-color' ],
    
    'hint' =>  'Box outer border',
);

// since 4.4.4
$options[ 'hand_drawn' ] = array(
    'name'      => 'Hand drawn border?',
    'shorthand' => 'enable',
    'options'   => [
        'true'  => 'Yes please!',
        'false' => 'No thanks!',
    ],
    'std'       => 'false',
);

// Body Background
//
$options[] = array(
    'name'      => 'Boxed Body Background',
    'type'      => 'heading',
    'desc'      => 'To set content background, scroll down to "Inner Content Background" section',

    'section'     => 'design_background',
    'section_title'=> 'Background',
    'panel' => 'design',
    
    'hint' =>  'Site Background',
);

$options[ 'body_background' ] = array(
    'shorthand' => 'background',
    'selector'  => 'body.layout-boxed',
    'name'      => 'Boxed Layout Background',
);

// Inner Content Background
//
$options[] = array(
    'name'      => 'Inner Content Background',
    'type'      => 'heading',
);

$options[ 'content_background' ] = array(
    'shorthand' => 'background-color',
    'selector'  => '.wrapper-bg-element',
    'name'      => 'Inner content background',
    'std'       => '#ffffff',
);

$options[ 'content_background_opacity' ] = array(
    'type'      => 'text',
    'name'      => 'Inner content background opacity',
    'desc'       => 'Enter a number from 0 - 100. Default is 100%.',
);

/* ------------------------------------------   FORM ELEMENTS ------------------------------------------ */
$options[] = [
    'type' => 'heading',
    'name' => 'Button',

    'section' => 'design_form',
    'section_title' => 'Form Input + Button',
    'panel' => 'design',
    
    'hint' =>  'Button design options',
];

$id = 'button';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Button font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_border_radius' ] = [
    'shorthand' => 'border-radius',
    'selector'  => fox_btn_selector(),
    'name'      => 'Button border radius',
    
    'hint' =>  'Button border radius',
];

// INPUT
//
$options[] = [
    'type' => 'heading',
    'name' => 'Form Input',
    
    'hint' =>  'Form input design options',
];

$id = 'input';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Form input font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_box' ] = [
    'shorthand' => 'box',
    'name'      => $fontdata[ 'name' ] . ' border',
    'fields'    => [ 'border', 'border-width', 'border-color' ],
    
    'hint' =>  'Form input border',
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' color',
    'selector'  => $fontdata[ 'selector' ],
    
    'hint' =>  'Form input text color',
];

$options[ $id . '_background' ] = [
    'shorthand' => 'background-color',
    'name'      => $fontdata[ 'name' ] . ' background',
    'selector'  => $fontdata[ 'selector' ],
    
    'hint' =>  'Form input background',
];

$options[ $id . '_focus_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' focus color',
    'selector'  => fox_input_focus_selector(),
];

$options[ $id . '_focus_background' ] = [
    'shorthand' => 'background-color',
    'name'      => $fontdata[ 'name' ] . ' focus background',
    'selector'  => fox_input_focus_selector(),
];

/* ------------------------------------------   WIDGET TITLE ------------------------------------------ */
$options[ 'widget_sep' ] = [
    'shorthand' => 'enable',
    'name' => 'A line between 2 widgets',
    'std'       => 'false',
    'options'   => [
        'true'  => 'Yes please!',
        'false'  => 'No thanks!',
    ],

    'section'   => 'design_widget',
    'section_title' => 'Widget',
    'panel' => 'design',
    
    'hint' =>  'Widget design',
];

$options[] = [
    'type' => 'heading',
    'name' => 'Widget Title',

    'hint' =>  'Widget title design',
];

$id = 'widget_title';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Widget title font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
    
    'hint' =>  'Widget title color',
];

$options[ $id . '_background_color' ] = [
    'shorthand' => 'background-color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' background',
    
    'hint' =>  'Widget title background',
];

$options[ $id . '_align' ] = [
    'type'      => 'select',
    'options'   => fox_align_options(),
    'name'      => $fontdata[ 'name' ] . ' align',
    'css'       => 'text-align',
    'selector'  => '.widget-title',
    
    'hint' =>  'Widget title text align',
];

$options[ $id . '_box' ] = [
    'shorthand' => 'box',
    'name'      => $fontdata[ 'name' ] . ' box',
    
    'hint' =>  'Widget title padding/margin',
];

$options[] = [
    'type' => 'heading',
    'name' => 'List Widgets',
];

$options[ 'widget_list_style' ] = [
    'name' => 'List Widgets Style',
    'type' => 'select',
    'options' => [
        '1' => 'Style 1',
        '2' => 'Style 2',
        '3' => 'Style 3',
    ],
    'std' => '1',
    'desc' => 'List Widgets are: Widget Categories, Archives, Menu..'
];

$options[] = [
    'type' => 'heading',
    'name' => 'Tag Cloud',
];

$options[ 'tagcloud_style' ] = [
    'name' => 'Tag Cloud Style',
    'type' => 'select',
    'options' => [
        '1' => 'Style 1 (Plain text)',
        '2' => 'Style 2',
        '3' => 'Style 3',
    ],
    'std' => '1',
];

/* ------------------------------------------   BLOCKQUOTE ------------------------------------------ */
$options[] = [
    'type' => 'heading',
    'name' => 'Blockquote',

    'section' => 'design_blockquote',
    'section_title' => 'Blockquote',
    'panel' => 'design',
    
    'hint' =>  'Block quote design',
];

$id = 'blockquote';
$fontdata = $all[ $id ];

$options[ 'blockquote_quote_icon' ] = [
    'shorthand' => 'enable',
    'name'      => 'Blockquote icon',
    'std'       => 'true',
    'toggle'    => [
        'true' => [ 'blockquote_quote_icon_icon', 'blockquote_quote_icon_style' ],
    ],
    
    'hint' =>  'Block quote icon',
];

$options[ 'blockquote_quote_icon_icon' ] = [
    'type'      => 'image_radio',
    'options'   => [
        '1' => [
            'src' => get_template_directory_uri() . '/images/quote.png',
            'width' => 40,
            'height' => 'auto',
        ],
        '2' => [
            'src' => get_template_directory_uri() . '/images/quote2.png',
            'width' => 40,
            'height' => 'auto',
        ],
        '3' => [
            'src' => get_template_directory_uri() . '/images/quote3.png',
            'width' => 40,
            'height' => 'auto',
        ],
        '4' => [
            'src' => get_template_directory_uri() . '/images/quote4.png',
            'width' => 40,
            'height' => 'auto',
        ],
    ],
    'name'      => 'Select icon',
    'std'       => '1',
];

$options[ 'blockquote_quote_icon_style' ] = [
    'type'      => 'select',
    'name'      => 'Blockquote icon style',
    'options'   => [
        'above' => 'Above text',
        'overlap' => 'Overlap the text',
    ],
    'std'       => 'above',
];

$options[ $id . '_align' ] = [
    'shorthand' => 'text-align',
    'name'      => $fontdata[ 'name' ] . ' text align',
    'std'       => 'left',
    'selector'  => $fontdata[ 'selector' ],
];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Block quote font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'name'      => $fontdata[ 'name' ] . ' color',
    'selector'       => $fontdata[ 'selector' ],
    
    'hint' =>  'Block quote color',
];

// since 4.7.2
$options[ $id . '_background' ] = [
    'shorthand' => 'background-color',
    'name'      => $fontdata[ 'name' ] . ' background color',
    'selector'       => $fontdata[ 'selector' ],
    
    'hint' =>  'Block quote background',
];

$options[ $id . '_box' ] = [
    'shorthand' => 'box',
    'name'      => $fontdata[ 'name' ] . ' box',
];

/* ------------------------------------------   DROP CAP ------------------------------------------ */
$options[ 'dropcap_style' ] = array(
    'type'      => 'select',
    'options'   => array(
        'default' => 'Default',
        'dark' => 'Dark',
        'color' => 'Color',
    ),
    'std'       => 'default',
    'name'      => esc_html__( 'Dropcap Style', 'wi' ),
    
    'section' => 'design_dropcap',
    'section_title' => 'Drop cap',
    'panel' => 'design',
    
    'hint' =>  'Drop cap style',
);

$options[ 'dropcap_font' ] = array(
    'shorthand' => 'select-font',
    'name'      => 'Drop cap font',
    'type'      => 'select',
    'options'   => [
        'font_body' => 'Same as body font',
        'font_heading' => 'Same as heading font',
        'font_nav' => 'Same as navigation font',
        'font_gothic' => 'Gothic font', // since 4.3
    ],
    'std'       => 'font_body',
    
    'hint' =>  'Drop cap font',
);

$options[ 'dropcap_font_weight' ] = array(
    'shorthand' => 'font-weight',
    'std'       => '700',
    'name'      => 'Drop cap font weight',
    'selector'  => fox_dropcap_selector(),
);

/* ------------------------------------------   CAPTION ------------------------------------------ */
$options[] = [
    'type' => 'heading',
    'name' => 'Image Caption',

    'section' => 'design_caption',
    'section_title' => 'Image Caption',
    'panel' => 'design',
    
    'hint' =>  'Image caption design',
];

$id = 'caption';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Image caption font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
    
    'hint' =>  'Image caption color',
];

$options[ $id . '_align' ] = [
    'shorthand' => 'align',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' align',
    // 'std'       => 'left',
    
    'options'   => [
        ''      => 'Default',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std'   => '',
    
    'hint' =>  'Image caption align',
];

/* Archive Page Design
---------------------------------------------------- */
$options[ 'archive_label' ] = array(
    'shorthand' => 'enable',
    'std'       => 'false',
    'name'      => 'Archive Label: category, tag..',

    'section' => 'design_archive',
    'section_title' => 'Archive Page Design',
    'panel' => 'design',
    
    'hint' =>  'Archive label',
);

$options[ 'archive_description' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Archive description',
);

$options[ 'titlebar_user_max_width' ] = array(
    'shorthand' => 'width',
    'std'       => '600px',
    'selector'  => '.titlebar-user',
    'name'      => 'User titlebar width',
); 

$options[ 'titlebar_user_social_style' ] = array(
    'type'      => 'select',
    'std'       => 'plain',
    'options'   => fox_social_style_support(),
    'name'      => 'User profile social icon style',
);    

$options[ 'titlebar_subcategories' ] = array(
    'shorthand' => 'enable',
    'std'       => 'true',
    'name'      => 'Shows subcategories for category archive',
);

$options[ 'titlebar_background' ] = [
    'shorthand' => 'background-color',
    'selector'  => '.wi-titlebar',
    'name'      => 'Titlebar background',
    
    'hint' =>  'Archive title bar background',
];

$options[ 'titlebar_overlay_opacity' ] = [
    'shorthand' => 'opacity',
    'name'      => 'Titlebar Overlay Opacity',
    'selector'  => '.titlebar-bg-overlay',
];

$options[ 'titlebar_align' ] = [
    'type'      => 'select',
    'options'   => fox_align_options(),
    'std'       => 'center',
    'name'      => 'Titlebar Align',
    
    'hint' =>  'Archive title bar align',
];

$id = 'archive_title';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Archive title font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ', .archive-description, .titlebar-user',
    'name'      => $fontdata[ 'name' ] . ' color',
    
    'hint' =>  'Archive title color',
];

$options[ 'titlebar_box' ] = [
    'shorthand' => 'box',
    'name'      => 'Titlebar Box',
    
    'hint' =>  'Archive title bar margin/padding',
];

/* Blog Post Design
---------------------------------------------------- */
$options[] = [
    'type' => 'heading',
    'name' => 'Blog Post Title',

    'section'   => 'post_design',
    'section_title' => 'Blog Post',
    'panel' => 'design',
    
    'hint' =>  'Post item design',
];

$id = 'post_title';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Post title font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ' a',
    'name'      => $fontdata[ 'name' ] . ' color',
    
    'hint' =>  'Post title color',
];

$options[ $id . '_hover_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ' a:hover',
    'name'      => $fontdata[ 'name' ] . ' hover color',
];

$options[ $id . '_hover_text_decoraction' ] = [
    'shorthand' => 'text-decoration',
    'selector'  => $fontdata[ 'selector' ] . ' a:hover',
    'name'      => $fontdata[ 'name' ] . ' hover',
    'std'       => 'none',
    
    'hint' =>  'Post title underline',
];

$options[ $id . '_hover_text_decoraction_color' ] = [
    'shorthand' => 'text-decoration-color',
    'selector'  => $fontdata[ 'selector' ] . ' a:hover',
    'name'      => $fontdata[ 'name' ] . ' hover decoration color',
];

// POST META
//
$options[] = [
    'type' => 'heading',
    'name' => 'Post Meta',
];

$id = 'post_meta';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Post meta font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
    
    'hint' =>  'Post meta color',
];

$options[ $id . '_link_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ' a',
    'name'      => $fontdata[ 'name' ] . ' link color',
];

$options[ $id . '_link_hover_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ' a:hover',
    'name'      => $fontdata[ 'name' ] . ' link hover color',
];

// STANDALONE CATEGORY
//
$options[] = [
    'type' => 'heading',
    'name' => 'Standalone Category',
];

$id = 'standalone_category';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Post category standalone options',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ 'standalone_category_style' ] = [
    'type' => 'radio',
    'options'   => [
        'plain' => 'Plain',
        'box' => 'Box',
        'solid' => 'Solid',
    ],
    'std' => 'plain',
    'name' => 'Style',
    
    'toggle' => [
        'solid' => [ $id . '_background' ]
    ]
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ] . ' a',
    'name'      => $fontdata[ 'name' ] . ' color',
];

$options[ $id . '_background' ] = [
    'shorthand' => 'background-color',
    'selector'  => '.categories-solid a',
    'name'      => $fontdata[ 'name' ] . ' background',
];

/* Single Post Design
---------------------------------------------------- */
$id = 'single_post_title';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Single post title font',
    
    'section' => 'design_single',
    'section_title' => 'Single Post Design',
    'panel' => 'design',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
];

// SUBTITLE
//
$options[] = [
    'type'      => 'heading',
    'name'      => 'Single Post Subtitle',
];

$id = 'single_post_subtitle';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Subtitle font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
];

// HEADER BOX
$options[] = [
    'type'      => 'heading',
    'name'      => 'Post Header Box',
];

$options[ 'post_header_box' ] = [
    'shorthand' => 'box',
    'name'      => 'Single post header box',
];

// CONTENT
$options[] = [
    'type' => 'heading',
    'name' => 'Single Post Content',
];

$id = 'single_content';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Single post content font',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_color' ] = [
    'shorthand' => 'color',
    'selector'  => $fontdata[ 'selector' ],
    'name'      => $fontdata[ 'name' ] . ' color',
];

// SINGLE LABELS
//
$options[] = [
    'type' => 'heading',
    'name' => 'Single Label',
    'desc'  => 'Share label, tag label, related post heading etc.',
];

$id = 'single_heading';
$fontdata = $all[ $id ];

$options[ $id . '_font' ] = [
    'shorthand' => 'select-font',
    'name'      => $fontdata[ 'name' ] . ' Font',
    'inherit_options' => true,
    'std'       => $fontdata[ 'std' ],
    
    'hint' =>  'Single labels design',
];

$options[ $id . '_typography' ] = [
    'shorthand' => 'typography',
    'name'      => $fontdata[ 'name' ],
    'fields'    => $fontdata[ 'fields' ],
    'std'       => $fontdata[ 'typo' ],
];

$options[ $id . '_align' ] = [
    'type'      => 'select',
    'options'   => fox_align_options(),
    'std'       => 'center',
    'name'      => $fontdata[ 'name' ] . ' align',
    'css'       => 'text-align',
    'selector'  => $fontdata['selector'],
];

/**
 * deprecated since 4.6
$options[ 'single_heading_box' ] = [
    'shorthand' => 'box',
    'name'      => 'Single label box',
    'fields'    => [ 'border', 'border-style', 'border-color' ],
];
*/
$options[ 'single_heading_style' ] = [
    'type' => 'select',
    'options' => [
        'border_top' => 'Border Top',
        'border_bottom' => 'Border Bottom',
        'border_around' => '2 lines around',
        'no_border' => 'No Border',
    ],
    'std' => 'border_top',
    'name' => 'Style',
];

/**
 * CUSTOM IMAGES
 * ------------------------------------------------------------------------
 */
$options[ 'hamburger_icon_image' ] = array(
    'type' => 'image',
    'name'  => 'Hamburger icon image',
    
    'panel' => 'design',
    'section' => 'icon_images',
    'section_title' => 'Icon Images',
    
    'hint' => 'Hamburger icon image',
);

$options[ 'hamburger_icon_image_width' ] = array(
    'shorthand'=> 'width',
    'name'  => 'Hamburger icon image width',
    'std'   => '32',
    'selector' => '.hamburger-open-icon img',
);

$options[ 'offcanvas_close_icon_image' ] = array(
    'type' => 'image',
    'name'  => 'Off canvas close icon image',
    
    'hint' => 'Offcanvas close icon image',
);

$options[ 'offcanvas_close_icon_image_width' ] = array(
    'shorthand'=> 'width',
    'name'  => 'Off canvas close icon image width',
    'selector' => '.hamburger-close-icon img',
);

$options[ 'search_icon_image' ] = array(
    'type' => 'image',
    'name'  => 'Search icon image',
    
    'hint' => 'Search icon image',
);

$options[ 'search_icon_image_width' ] = array(
    'shorthand'=> 'width',
    'name'  => 'Search icon image width',
    'selector' => '.search-btn img',
);

$options[ 'scrollup_icon_image' ] = array(
    'type' => 'image',
    'name'  => 'Scroll up icon image',
    
    'hint' => 'Scroll up icon image',
);

$options[ 'scrollup_icon_image_width' ] = array(
    'shorthand'=> 'width',
    'name'  => 'Scroll up icon image width',
    'selector' => '#backtotop img',
);

$options[ 'cart_icon_image' ] = array(
    'type' => 'image',
    'name'  => 'Cart icon image',
    
    'hint' => 'Cart icon image',
);

$options[ 'cart_icon_image_width' ] = array(
    'shorthand'=> 'width',
    'name'  => 'Cart icon image width',
    'selector' => '.header-cart-icon img',
);