<?php
function fox_builder_ad_options() {
    
    $ad_options = [
        'ad_code' => [
            'name'      => 'Advertisement Code',
            'type'      => 'textarea',
            'desc'      => 'Note that the ad will appear BEFORE this section. You can insert HTML, Javascript, Adsense code... If you use image banner, you can use upload button below.',

            'tab'       => 'ad',
        ],

        'banner' => [
            'name'      => 'Image Banner',
            'type'      => 'image',
            'desc'      => 'This banner appears before posts',

            'tab'       => 'ad',
        ],

        'banner_width' => [
            'name'      => 'Banner width',
            'type'      => 'text',
            'placeholder' => 'Eg. 728',
            
            'tab'       => 'ad',
        ],

        'banner_tablet' => [
            'name'      => 'Tablet Image',
            'type'      => 'image',
            'desc'      => 'This banner appears before posts',

            'tab'       => 'ad',
        ],

        'banner_tablet_width' => [
            'name'      => 'Banner tablet width',
            'type'      => 'text',
            'placeholder' => 'Eg. 600',
            
            'tab'       => 'ad',
        ],

        'banner_mobile' => [
            'name'      => 'Mobile Image',
            'type'      => 'image',

            'tab'       => 'ad',
        ],

        'banner_mobile_width' => [
            'name'      => 'Banner mobile width',
            'type'      => 'text',
            'placeholder' => 'Eg. 300',
            
            'tab'       => 'ad',
        ],

        'banner_url' => [
            'name'      => 'Banner URL',
            'type'      => 'text',
            'placeholder' => 'https://',

            'tab'       => 'ad',
        ],

        'ad_visibility' => [
            'name'      => 'Ad Visibility',
            'type'      => 'multicheckbox',
            'options'   => [
                'desktop' => 'Desktop',
                'tablet' => 'Tablet',
                'mobile' => 'Mobile',
            ],
            'std' => 'desktop,tablet,mobile',

            'tab'       => 'ad',
        ],
        
    ];
    
    return apply_filters( 'fox_ad_options', $ad_options );
    
}