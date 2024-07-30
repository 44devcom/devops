<?php
$forms = [];
$std = '';
$args = array(
    'post_type' => 'mc4wp-form',
    'posts_per_page' => 100,
    'ignore_sticky_posts' => true,
);
$get_forms = get_posts( $args );
foreach ( $get_forms as $form ) {
    if ( ! $std ) $std = strval($form->ID);
    $forms[ strval($form->ID) ] = $form->post_title;
}

if ( ! $forms ) $forms = array( '' => 'Please go to Dashboard > MailChimp for WP > Forms to create at least a form.' );

$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => 'Title',
    ),
    
    array(
        'id' => 'form_id',
        'name' => 'Select Form',
        'type' => 'select',
        'options' => $forms,
    ),
    
    array(
        'id' => 'layout',
        'name' => 'Input Layout',
        'std'   => 'inline',
        'options' => [
            'inline' => 'Inline',
            'stack' => 'Stack',
        ],
        'type' => 'select',
    ),
    
    array(
        'id' => 'heading_position',
        'name' => 'Heading position',
        'std'   => 'inline',
        'options' => [
            'inline' => 'Inline',
            'stack' => 'Stack',
        ],
        'type' => 'select',
    ),
    
    array(
        'id' => 'heading',
        'name' => 'Heading text',
        'std'   => 'Join our mailing list',
        'placeholder' => 'Join our mailing list',
        'type' => 'text',
    ),
    
    array(
        'id' => 'mail_icon',
        'name' => 'Mail icon before heading?',
        'std'   => true,
        'type' => 'checkbox',
    ),
    
    array(
        'id' => 'subtitle',
        'name' => 'Subtitle',
        'std'   => 'We hate spams like you do',
        'placeholder' => 'We hate spams like you do',
        'type' => 'text',
    ),
    
    array(
        'id' => 'text_color',
        'name' => 'Text Color',
        'type' => 'color',
    ),
    
    array(
        'id' => 'background_color',
        'name' => 'Background Color',
        'type' => 'color',
        'std' => '#f0f0f0',
    ),
    
    array(
        'id' => 'background_image',
        'name' => 'Background Image',
        'type' => 'image',
    ),
    
    array(
        'id' => 'border_color',
        'name' => 'Border Color',
        'type' => 'color',
        'std' => '#cccccc',
    ),
    
    array(
        'id' => 'button_style',
        'type' => 'select',
        'name' => 'Submit button style',
        'type' => 'select',
        'options' => [
            'black' => 'Black',
            'fill' => 'Fill',
            'outline' => 'Outline',
            'primary' => 'Primary',
        ],
        'std' => 'black',
    ),
    
);