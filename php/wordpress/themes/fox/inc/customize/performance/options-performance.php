<?php
$fox56_customize->add_section( 'performance', [
    'title' => 'Performance',
    'priority' => 120,
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'css_critical',
    'name' => 'Optimize CSS Load?',
    'std' => false,
    'desc' => 'Strongly recommended. If you enable this, your site loads only necessary CSS parts it need. It\'s also called "Critical CSS" or "Above the fold CSS" in articles about optimization. Note: This may cause conflict with some of your optimization plugin. If you see conflict, please disable this option.',
    'transport' => 'postMessage',

    'section' => 'performance',
    
    'hint' => 'critical CSS/remove unused CSS',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_dashicons',
    'name' => 'Disable Dashicons',
    'std' => false,
    'transport' => 'postMessage',
    'desc' => 'Disabling dashicons might affect certain plugins that require it. Please make sure you understand what you are doing before doing it.',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_woocommerce_css',
    'name' => 'Disable WooCommerce CSS for non-woocommerge pages',
    'std' => false,
    'transport' => 'postMessage',
    'desc' => 'If your homepage, archive page, single post doesn\'t require WooCommerce CSS, you can enable this option to make your site faster.',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'disable_contactform7_css',
    'name' => 'Disable Contact Form 7 CSS for non-pages',
    'std' => false,
    'transport' => 'postMessage',
    'desc' => 'Normally, Contact Form 7 is only being used for the contact page hence if you do not it else where, you can enable this option to reduce CSS loaded.',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'js_async',
    'name' => 'Load Javascript async',
    'std' => false,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'js_defer',
    'name' => 'Load Javascript defer',
    'std' => false,
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'font_display',
    'options' => [
        'swap' => 'Swap',
        'auto' => 'Auto',
    ],
    'desc' => 'If you care about performace, choose "swap"',
    'std' => 'swap',
    'transport' => 'postMessage',
    'name' => 'Font display',
]);