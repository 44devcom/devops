<?php
$fox56_customize->add_section( 'blog_404', [
    'title' => 'Page 404',
    'panel' => 'blog',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'page_404_title',
    'name' => 'Page 404 title',
    'section' => 'blog_404',
    'hint' => 'Page 404 title',
]);

$fox56_customize->add_field([
    'type' => 'textarea',
    'id' => 'page_404_message',
    'name' => 'Page 404 message',
    'desc' => 'You can use HTML/Shortcode here',
    'hint' => 'Page 404 message/content',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'page_404_searchform',
    'name' => 'Page 404 search form?',
    'hint' => 'Page 404 search form',
]);