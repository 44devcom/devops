<?php
/* GENERAL
--------------------------------------------------------------------------------- */
$fields = [];

/* LAYOUT
--------------------------------------------------------------------------------- */
$uri = get_template_directory_uri();
$styles = [
    '' => [
        'src' => $uri . '/inc/customize/images/default.png',
        'title' => 'Default',
    ],
    '1' => [
        'src' => $uri . '/inc/customize/images/1.png',
        'title' => 'Layout 1',
    ],
    '1b' => [
        'src' => $uri . '/inc/customize/images/1b.png',
        'title' => 'Layout 1b',
    ],
    '2' => [
        'src' => $uri . '/inc/customize/images/2.png',
        'title' => 'Layout 2',
    ],
    '3' => [
        'src' => $uri . '/inc/customize/images/3.png',
        'title' => 'Layout 3',
    ],
    '4' => [
        'src' => $uri . '/inc/customize/images/4.png',
        'title' => 'Hero full',
    ],
    '5' => [
        'src' => $uri . '/inc/customize/images/5.png',
        'title' => 'Hero half',
    ],
    '6' => [
        'src' => $uri . '/inc/customize/images/6.png',
        'title' => 'Layout 6',
    ],
];

$fields[] = array(
    'id' => 'style',
    'name' => 'Page Layout',
    'type' => 'image_radio',
    'tab' => 'layout',
    'options' => $styles,
);

// since 4.3
$fields[] = [
    'id' => 'hero_half_skin',
    'name' => 'Hero Half Theme',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'light' => 'Light',
        'dark' => 'Dark',
    ],
    'std' => '',
    'tab' => 'layout',

    'dependency' => [
        'element' => 'style',
        'value' => '5',
    ],
];

// since 6.2
$fields[] = [
    'id' => 'hero_full_text_position',
    'name' => 'Hero Full Text Position',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'bottom-left' => 'Bottom Left',
        'bottom-center' => 'Bottom Center',
        'center' => 'Center',
    ],
    'std' => '',
    'tab' => 'layout',

    'dependency' => [
        'element' => 'style',
        'value' => '4',
    ],
];

$fields[] = [
    'id' => 'sidebar_state',
    'name' => 'Sidebar',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'sidebar-left' => 'Sidebar Left',
        'sidebar-right' => 'Sidebar Right',
        'no-sidebar' => 'No Sidebar',
    ],
    'std' => '',
    'tab' => 'layout',
];

$fields[] = [
    'id' => 'thumbnail_stretch',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-container' => 'Container Width',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => '',
    'name' => 'Thumbnail stretch',

    'tab' => 'layout',
];

$fields[] = [
    'type' => 'select',
    'id' => 'content_width',
    'options' => [
        '' => 'Default',
        'full' => 'Full width',
        'narrow' => 'Narrow width',
    ],
    'std' => '',
    'name' => 'Content width',

    'tab' => 'layout',
];

/*
$fields[] = [
    'type' => 'select',
    'id' => 'content_image_stretch',
    'options' => [
        '' => 'Default',
        'stretch-none' => 'No stretch',
        'stretch-bigger' => 'Stretch Wide',
        'stretch-full' => 'Stretch Fullwidth',
    ],
    'std' => '',
    'name' => 'Content image stretch',
    'desc' => 'If you choose "Stretch Wide", it stretches all possible images in the post.',

    'tab' => 'layout',
];
*/

$fields[] = array(
    'id' => 'subtitle',
    'name' => 'Subtitle',
    'type' => 'textarea',
    'desc' => 'Enter page subtitle',
    'tab' => 'layout',
);

$fields[] = array(
    'id' => 'title_align',
    'name' => 'Page title align',
    'type' => 'select',
    'options' => [
        '' => 'Default',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'tab' => 'layout',
);

$fields[] = array(
    'id' => 'background_color',
    'name' => 'Background color',
    'type' => 'color',
    'desc' => 'Page background color',
    'tab' => 'layout',
);

$fields[] = array(
    'id' => 'text_color',
    'name' => 'Text color',
    'type' => 'color',
    'desc' => 'Page text color',
    'tab' => 'layout',
    'desc' => 'Please note: text color can be affected by other mechanism, for instance: color of your post content you set in Customizer. Hence, if you change text color here but it doesnt affect your post, please check other mechanisms.',
);

$fields[] = [
    'id' => 'padding_top',
    'name' => 'Padding top',
    'type' => 'text',
    'placeholder' => '20px',
    'tab' => 'layout',
];

$fields[] = [
    'id' => 'padding_bottom',
    'name' => 'Padding bottom',
    'type' => 'text',
    'placeholder' => '20px',
    'tab' => 'layout',
];

/* SHOW/HIDE
--------------------------------------------------------------------------------- */
$components = [
    'post_header' => 'Title area',
    'thumbnail' => 'Thumbnail',
    // 'share' => 'Share icon',
];

foreach ( $components as $com => $name ) {
    $desc = '';
    if ( 'comment' == $com ) {
        $desc = 'If you wanna enable page comment, please enable it in "Discussion" section too (below Featured Image option on the right side)';
    }

    $fields[] = array(
        'id' => $com,
        'name' => 'Show/Hide ' . $name,
        'type' => 'select',
        'options' => array(
            '' => esc_html__( 'Default', 'wi' ),
            'true' => esc_html__( 'Show it', 'wi' ),
            'false' => esc_html__( 'Hide it', 'wi' ),
        ),
        'std' => '',
        'desc'  => $desc,
        'tab' => 'component',
    );
}

$fields[] = [
    'id' => 'show_header',
    'name' => 'Show Header',
    'type' => 'select',
    'options' => array(
        '' => esc_html__( 'Default', 'wi' ),
        'true' => esc_html__( 'Show it', 'wi' ),
        'false' => esc_html__( 'Hide it', 'wi' ),
    ),
    'std' => '',
    'tab' => 'component',
];

$fields[] = [
    'id' => 'show_footer',
    'name' => 'Show Footer',
    'type' => 'select',
    'options' => array(
        '' => esc_html__( 'Default', 'wi' ),
        'true' => esc_html__( 'Show it', 'wi' ),
        'false' => esc_html__( 'Hide it', 'wi' ),
    ),
    'std' => '',
    'tab' => 'component',
];

/* MISC
--------------------------------------------------------------------------------- *
$fields[] = array(
    'id' => 'column_layout',
    'name' => 'Text Column Layout',
    'type' => 'select',
    'options' => array(
        '' => esc_html__( 'Default', 'wi' ),
        '1' => '1 column',
        '2' => '2 columns',
    ),
    'std' => '',
    'tab' => 'misc',
);

$fields[] = array(
    'id' => 'dropcap',
    'name' => 'Dropcap first letter',
    'type' => 'select',
    'options' => array(
        '' => 'Default',
        'true' => 'Enable',
        'false' => 'Disable',
    ),
    'std' => '',

    'tab' => 'misc',
);
*/

$metaboxes[ 'page-settings' ] = array(

    'id' => 'page-settings',
    'screen' => array( 'page' ),
    'title' => esc_html__( 'Page Settings', 'wi' ),
    'tabs' => [
        'layout' => 'Layout',
        'component' => 'Components',
        // 'misc' => 'Miscellaneous',
    ],
    'fields' => $fields,

);