<?php
$fox56_customize->add_panel( 'design', [
    'title' => 'DESIGN',
    'priority' => 70,
]);

$custom_font_children = [];
$custom_font_variants = [];

if ( taxonomy_exists( 'bsf_custom_fonts' ) ) {
    $custom_fonts = get_terms([
        'taxonomy' => 'bsf_custom_fonts',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    ]);
    if ( is_array( $custom_fonts ) ) {
        foreach ( $custom_fonts as $font_term ) {
            $custom_font_children[] = [
                'id' => $font_term->name,
                'text' => $font_term->name,
            ];
            $fox56_customize->custom_fonts[ $font_term->name ] = $font_term->name;
        }
    }
}

include_once(dirname( __FILE__ ) . '/options-design-layout.php');
include_once(dirname( __FILE__ ) . '/options-design-faces.php');
include_once(dirname( __FILE__ ) . '/options-design-darkmode.php');
include_once(dirname( __FILE__ ) . '/options-design-general.php');
include_once(dirname( __FILE__ ) . '/options-design-form.php');
include_once(dirname( __FILE__ ) . '/options-design-blockquote.php');
include_once(dirname( __FILE__ ) . '/options-design-widget.php');
include_once(dirname( __FILE__ ) . '/options-design-dropcap.php');
include_once(dirname( __FILE__ ) . '/options-design-caption.php');