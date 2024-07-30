<?php
$fox56_customize->add_section( 'export', [
    'title' => 'Backup Settings',
    'priority' => 220,
]);

$fox56_customize->add_field([
    'type' => 'html',
    'html' => '<a download href="' . get_rest_url( null, 'fox/v1/theme_mods' ) . '" class="button button-primary">Download Settings</a>',
    'id' => 'export_button',
    'name' => 'Export Settings',
    'section' => 'export',
]);