<?php
/**
 * Instagram
 * displays instagram feed based on $args
 * @since 4.6
 * ------------------------------------------------------------------ */
function fox_instagram( $params = [] ) {
    
    $params = wp_parse_args( $params, [
        
        'number' => '6',
        'column' => '',
        'item_spacing' => '',

        'show_header' => true,
        
        'profile_url' => '',
        'hover_style' => '',
        
        // heading
        'heading_text' => '',
        'heading_text_icon' => true,
        'heading_subtitle' => '',
        
        // follow
        'follow_text' => '',
        'follow_text_style' => 'insta',
        'follow_text_position' => 'after',
        
        'images' => '', // for demo version
        
    ] );
    
    if ( ! defined( 'SBIVER' ) && ! fox_is_demo() ) {
        
        if ( current_user_can( 'manage_options') ) {
            
            echo fox_err( fox_format( 'To display Instagram, please install & activate <a href="{link}">Instagram Feed</a> plugin.', [
                'link' => esc_url( admin_url( 'admin.php?page=tgma-install-plugins' ) )
            ] ) );
            
        }
        return;
        
    }
    
    // shortcode params
    $sc_params = [
        'header' => $params[ 'show_header' ] ? 'true' : 'false',
        'number' => $params[ 'number' ],
        'column' => $params[ 'column' ],
    ];
    
    // class
    $class = [ 'fox-instagram' ];
    
    /**
     * column
     */
    $column = absint( $params[ 'column' ] );
    if ( $column < 1 ) $column = 3;
    if ( $column > 10 ) $column = 10;

    $class[] = 'icolumn-' . $column; // to make sure we don't lose this info

    /**
     * spacing
     */
    $item_spacing = $params[ 'item_spacing' ];
    if ( ! in_array( $item_spacing, [ 'none', 'tiny', 'small', 'normal', 'wide', 'wider' ] ) ) {
        $item_spacing = 'normal';
    }
    $spacing_adapter = [
        'none' => 0,
        'tiny' => 5,
        'small' => 10,
        'normal' => 16,
        'medium' => 24,
        'wide' => 32,
        'wider' => 40,
    ];
    if ( isset( $spacing_adapter[ $item_spacing] ) ) {
        $sc_params[ 'padding' ] = $spacing_adapter[ $item_spacing];
    }
    $class[] = 'ispacing-' . $item_spacing;
    
    /**
     * hover style
     */
    $hover_style = $params[ 'hover_style' ];
    if ( ! in_array( $hover_style, [ 'fade', 'border' ] ) ) {
        $hover_style = 'none';
    }
    $class[] = 'style-hover-' . $hover_style;
    
    /**
     * the final sc
     */
    $sc = fox_format( '[instagram-feed imageres="medium" num={number} cols={column} showfollow="false" showheader="{header}" imagepadding={padding} showbutton="false" showbio="true"]', $sc_params );
    
    ?>

<div class="fox-instagram-outer">

    <?php fox_instagram_heading([
        'text' => $params[ 'heading_text' ],
        'subtitle' => $params[ 'heading_subtitle' ],
        'icon' => $params[ 'heading_text_icon' ],
        'url' => $params[ 'profile_url' ],
    ]); ?>

    <div class="fox-instagram-wrapper">

        <?php if ( ! fox_is_demo() ) { ?>

        <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">    

            <?php echo do_shortcode( $sc ); ?>

        </div><!-- .fox-instagram -->

        <?php } else { fox_demo_instagram( $params ); } ?>

        <?php fox_instagram_follow_btn([
            'text' => $params[ 'follow_text' ],
            'url' => $params[ 'profile_url' ],
            'position' => $params[ 'follow_text_position' ],
            'style' => $params[ 'follow_text_style' ],
        ]); ?>

    </div><!-- .fox-instagram-wrapper -->
    
</div><!-- .fox-instagram-outer -->

    <?php
    
}

/**
 * The Demo Instagram
 * @since 4.6
 * ------------------------------------------------------------------ */
function fox_demo_instagram( $params = [] ) {
    
    
    extract( wp_parse_args( $params, [
        
        'number' => '6',
        'column' => '',
        'item_spacing' => '',

        'show_header' => true,
        
        'profile_url' => '',
        'hover_style' => '',
        
        // heading
        'heading_text' => '',
        'heading_text_icon' => true,
        'heading_subtitle' => '',
        
        // follow
        'follow_text' => '',
        'follow_text_style' => 'insta',
        'follow_text_position' => 'after',
        
        'images' => '', // for demo version
        
    ] ) );
    
    if ( ! is_array( $images ) ) {
        
        $images = explode( ',', $images );
        $images = array_map( 'absint', $images );
        
    }
    
    if ( empty( $images ) ) {
        return;
    }
    
    $attachments = get_posts([
        'post_type' => 'attachment',
        'post__in' => $images,
        'posts_per_page' => -1,
        'no_found_rows' => true,
        // 'post_status' => 'publish',
    ]);
    
    $class = [
        'fox-instagram',
        'fox-grid',
        'fox-grid-gallery',
    ];
        
    /**
     * column
     */
    if ( $column < 1 ) $column = 3;
    if ( $column > 10 ) $column = 10;

    $class[] = 'icolumn-' . $column;
        
    /**
     * spacing
     */
    if ( ! in_array( $item_spacing, [ 'none', 'tiny', 'small', 'normal', 'wide', 'wider' ] ) ) {
        $item_spacing = 'normal';
    }
    $class[] = 'spacing-' . $item_spacing;
        
    /**
     * hover style
     */
    if ( ! in_array( $hover_style, [ 'fade', 'border' ] ) ) {
        $hover_style = 'none';
    }
    $class[] = 'style-hover-' . $hover_style;
        
        
?>

<div class="fox-instagram-container">
    
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <?php foreach ( $attachments as $attachment ) : ?>

        <div class="fox-grid-item insta-item">

            <figure class="fox-figure insta-item-inner custom-thumbnail" itemscope itemtype="https://schema.org/ImageObject">

                <a href="https://www.instagram.com/iamwithemes/" target="_blank">

                    <?php echo wp_get_attachment_image( $attachment->ID, 'thumbnail' ); ?>

                </a>

            </figure>

        </div><!-- .fox-grid-item -->

        <?php endforeach ; ?>

    </div><!-- .fox-instagram -->
    
</div><!-- .fox-instagram-container -->

<?php
}

/**
 * Instagram Heading
 * @since 4.6
 * ------------------------------------------------------------------ */
function fox_instagram_heading( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        'text' => '',
        'url' => '',
        'subtitle' => '',
        'icon' => true,
    ]) );
    
    if ( ! $text ) {
        return;
    }
    ?>

    <div class="fox-instagram-heading">
        
        <?php if ( $subtitle ) { ?>
        <p class="fox-instagram-heading-subtitle"><?php echo $subtitle; ?></p>
        <?php } ?>
        
        <h2 class="fox-instagram-heading-h">
            
            <?php if ( $url ) { ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank">
            <?php } ?>
            
                <?php if ( $icon ) { ?>
                <i class="fab fa-instagram"></i>
                <?php } ?>
                <span><?php echo $text; ?></span>
             
            <?php if ( $url ) { ?>    
            </a>
            <?php } ?>
            
        </h2>
        
    </div><!-- .fox-instagram-heading -->
    <?php
}

/**
 * Instagram Follow Button
 * @since 4.6
 * ------------------------------------------------------------------ */
function fox_instagram_follow_btn( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        'text' => '',
        'url' => '',
        'style' => '',
        'position' => '',
    ]) );
    
    if ( ! $text || ! $url ) {
        return;
    }
                
    $wrapper_cl = [
        'follow-text',
        'fox-button',
    ];
    $cl = [
        'follow-us',
        'fox-btn',
    ];

    // style
    $cl[] = 'btn-' . $style;        

    // position
    $wrapper_cl[] = 'follow-text-' . $position;
    ?>

    <div class="<?php echo esc_attr( join( ' ', $wrapper_cl ) ); ?>">

        <a href="<?php echo esc_url( $url ); ?>" target="_blank" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>"><?php echo esc_html( $text ) ?></a>

    </div><!-- .follow-text -->

<?php
    
}