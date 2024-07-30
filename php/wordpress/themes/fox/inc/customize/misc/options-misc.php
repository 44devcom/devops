<?php
$fox56_customize->add_section( 'misc',[
    'title' => 'Miscellaneous',
    'priority' => 150,
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'classic_widgets',
    'title' => 'Use Classic Widgets?',
    'desc' => 'The <a href="https://wordpress.org/documentation/article/block-based-widgets-editor/" target="_blank">Block-based Widgets Editor</a> was introduced in WordPress v5.8 but It\'s not intuitive for many customers hence The Fox keeps using Classic Widgets interface (Dashboard > Appearance > Widgets). If you want to use Block-based Widgets Editor, please disable this option.',
    
    'std' => true,
    'transport' => 'postMessage',
    'section' => 'misc',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_metaboxes',
    'name' => 'Disable post/page meta',
    'desc' => 'Everytime you create a post, some post meta values will be created along: _style, _layout.. Check the box if you DO NOT want to create them. Please make sure you understand what are you doing. <a href="' . get_template_directory_uri() .  '/inc/customize/images/post_meta_no.jpg" target="_blank">See this.</a>',
    'hint' => 'disable post meta',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_theme_lightbox',
    'name' => 'Disable theme lightbox?',
    'desc' => 'This option is useful if you have your own lightbox plugin',
    'hint' => 'disable lightbox',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'twitter_username',
    'name' => 'X Username (Twiter Username)',
    'desc' => 'Used for @via in X share button',
    'hint' => 'twitter username',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'exclude_pages_from_search',
    'name' => 'Exclude pages from search',
    'desc' => 'Check this if you don\'t want pages (eg. About, Contact..) to appear in site search result (not Google search)',
    'hint' => 'exclude pages from search',
]);

$fox56_customize->add_field([
    'id' => 'sentence_base',
    'name'      => 'Sentence Base',
    'type'      => 'select',
    'options'   => [
        'word' => 'Word',
        'char' => 'Character',
    ],
    'std'       => 'word', 
    'hint' =>  'Sentence base: word or character',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'reading_speed',
    'name' => 'Reading speed (words per minute)',
    'std' => 250,
    'desc' => 'Enter number of words per minute',
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'header_code',
    'name' => 'Head Code',
    'desc' => 'Enter Javascript code here to place it in &lt;head /&gt; tag',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'options' => [
        'true' => 'Yes',
        'false' => 'No',
    ],
    'std' => 'false',
    'id' => 'wi_revert_elementor_heading',
    'name' => 'Revert Elementor Heading',
    'desc' => '<strong>If you dont use Elementor or FOX Framework plugin, simply ignore this option.</strong>
    <br> Fox theme overrides Elementor Heading widget by mistake but for backward compatibility, we couldn\'t change that. By enabling this option, you will have both Fox Heading and Elementor Heading widgets.',
    'hint' => 'Revert Elementor Heading'
]);