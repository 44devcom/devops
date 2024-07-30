<?php
/**
 * User contact methods supported
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_user_social_support' ) ) :
function fox_user_social_support() {
    
    return [
        'facebook',
        'youtube',
        'twitter',
        'instagram',
        'tiktok',
        'pinterest',
        'linkedin',
        'tumblr',
        'snapchat',
        'vimeo',
        'soundcloud',
        'flickr',
        'vkontakte',
        'spotify',
        'reddit',
        'whatsapp',
        'wechat',
        'weibo',
        'telegram',
    ];
    
}
endif;

/**
 * Contact Methods
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_contactmethods' ) ) :
add_filter( 'user_contactmethods' , 'fox_contactmethods' );
function fox_contactmethods( $contactmethods ) {
    
    $all = fox_social_data();
    foreach( fox_user_social_support() as $brand ) {
        
        $brand_data = isset( $all[ $brand ] ) ? $all[ $brand ] : [];
        if ( $brand_data ) {
            $contactmethods[ $brand ] = $brand_data[ 'title' ] . ' URL';
        }
        
    }

	return $contactmethods;
}
endif;

/**
 * Displays user social array
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_user_social' ) ) :
function fox_user_social( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        
        'user' => null,
        'style' => 'plain',
        'extra_class' => '',
        
    ] ) );
    
    if ( ! in_array( $style, [ 'plain', 'black', 'outline', 'fill', 'color' ] ) ) {
        $style = 'plain';
    }
    
    // in case no user set
    if ( ! $user ) {
        if ( is_single() ) {
            $user = get_the_author_meta( 'ID' );
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata( $author );
            $user = $userdata->ID;
        }
    }
    
    $class = [
        'social-list',
        'user-item-social',
        'shape-circle',
        
        'style-' . $style,
    ];
    if ( $extra_class ) {
        $class[] = $extra_class;
    }
    
    $legacy = [
        'facebook' => 'facebook-square',
        'pinterest' => 'pinterest-p',
        'vimeo' => 'vimeo-square',
        'vkontakte' => 'vk',
    ];
    
    $social_arr = fox_social_data();
    
    ?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <ul>
    
        <?php foreach ( fox_user_social_support() as $brand ) : $url = get_user_meta( $user, $brand, true ); 

        // legacy, try to get value from old key
        if ( ! $url ) {
            if ( isset( $legacy[ $brand ] ) ) {
                $url = get_user_meta( $user, $legacy[ $brand ], true );
            }
        }
        if ( ! $url ) continue;
    
        // this icon not supported
        if ( ! isset( $social_arr[ $brand ] ) ) {
            continue;
        }

            $title = $social_arr[ $brand ][ 'title' ];
            $icon = $social_arr[ $brand ][ 'icon' ];

        if ( 'facebook' == $brand ) {
            $icon = 'facebook-square'; // legacy
        }
            
        ?>

        <li class="li-<?php echo esc_attr( $brand ); ?>">
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" title="<?php echo esc_attr( $title ); ?>">
                <i class="fab fa-<?php echo $icon; ?>"></i>
            </a>
        </li>

        <?php endforeach; ?>
        
        <?php $userdata = get_userdata( $user ); $url = isset( $userdata->user_url ) ? $userdata->user_url : ''; if ( $url ) { ?>
        
        <li class="li-website">
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" title="<?php echo esc_html__( 'Website', 'wi' ); ?>">
                <i class="fa fa-link"></i>
            </a>
        </li>
        
        <?php } ?>
        
    </ul>
    
</div><!-- .user-item-social -->

<?php
    
}
endif;

/**
 * Displays a user
 * @since 4.0
------------------------------------------------------------------------------------ */
if ( ! function_exists( 'fox_user' ) ) :
function fox_user( $args = [] ) {
    
    extract( wp_parse_args( $args, [
        
        'user' => null,
        
        'avatar' => true,
        'avatar_shape' => 'circle',
        
        'name' => true,
        'post_count' => true,
        'description' => true,
        
        'social' => true,
        'social_style' => 'plain',
        
        'extra_class' => '',
        'after_body' => '',
        'after_desc' => '',
        
        'author_page' => false,
        'name_tag' => 'h3',
        
    ] ) );
    
    // in case no user set
    if ( ! $user ) {
        if ( is_single() ) {
            $user = get_userdata( get_the_author_meta( 'ID' ) );
        } elseif ( is_author() ) {
            
            $user_id = get_the_author_meta( 'ID' );
            global $coauthors_plus;
            if ( $coauthors_plus ) {
                $user = $coauthors_plus->get_coauthor_by( 'id', $user_id );
            } else {
                $user = get_userdata( $user_id );
            }
            
        }
    }
    
    if ( ! is_object( $user ) ) return;
    
    $link = get_author_posts_url( $user->ID, $user->user_nicename );
    
    $class = [
        'fox-user-item',
        'fox-author',
        'fox-user',
    ];
    
    if ( $extra_class ) $class[] = $extra_class;
    ?>
    <div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

        <?php if ( $avatar ) { ?>

        <div class="user-item-avatar avatar-<?php echo esc_attr( $avatar_shape ); ?>">

            <a href="<?php echo $link; ?>">

                <?php echo get_avatar( $user->ID, 300 ); ?>

            </a>

        </div><!-- .user-item-avatar -->

        <?php } ?>

        <div class="user-item-body">

            <?php if ( $name ) { ?>

            <div class="user-item-header">

                <div class="user-item-name-wrapper">
                    
                    <?php if ( ! $author_page ) { ?>
                    <h3 class="user-item-name">

                        <a href="<?php echo $link; ?>"><?php echo $user->display_name; ?></a>

                    </h3>
                    <?php } else { ?>
                    
                    <h1 class="user-item-name"><?php echo $user->display_name; ?></h1>
                    
                    <?php } ?>
                    
                </div><!-- .user-item-name-wrapper -->

            </div><!-- .user-item-header -->

            <?php } ?>

            <?php if ( $description && $user->description ) { ?>

            <div class="user-item-description">

                <?php echo wpautop( do_shortcode( $user->description ) ); ?>

            </div><!-- .user-item-description -->

            <?php } ?>
            
            <?php if ( $social ) { ?>

            <?php fox_user_social([ 'user' => $user->ID, 'style' => $social_style, 'extra_class' => 'user-item-name-meta' ] ); ?>

            <?php } ?>
            
            <?php if ( $after_desc ) { echo $after_desc; } ?>

        </div><!-- .user-item-body -->
        
        <?php if ( $after_body ) { echo $after_body; } ?>

    </div><!-- .fox-user-item -->

    <?php

}
endif;

/**
 * Author Background Image
------------------------------------------------------------------------------------ */
add_action( 'show_user_profile', 'fox_profile_background_field' );
add_action( 'edit_user_profile', 'fox_profile_background_field' );

function fox_profile_background_field( $user ) {
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_background';
    
    $image_id = '';
    $image = get_user_meta( $user->ID, $field_id , true );
    if ( $image ) {
        $image_id = $image;
        $image = wp_get_attachment_image_src( $image, 'medium' );
        if ( $image ) {
            $image = $image[0];
        }
    }
    $upload_button_name = $image ? esc_html__( 'Change Image','wi' ) : esc_html__( 'Upload Image','wi' );
	?>
	<h3><?php esc_html_e( 'Upload Cover Photo', 'wi' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="<?php echo esc_attr( $field_id ); ?>"><?php esc_html_e( 'Cover Photo', 'wi' ); ?></label></th>
			<td>
                
                <div class="wi-upload-wrapper">
    
                    <figure class="image-holder">

                        <?php if ( $image ) : ?>
                        <img src="<?php echo esc_url($image);?>" />
                        <?php endif; ?>

                        <a href="#" rel="nofollow" class="remove-image-button" title="<?php esc_html_e( 'Remove Image', 'wi' );?>">&times;</a>

                    </figure>

                    <input type="hidden" class="media-result" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $image_id ); ?>" />
                    <input type="button" class="upload-image-button button button-primary" value="<?php echo $upload_button_name;?>" />

                </div><!-- .wi-upload-wrapper -->
                
            </td>
		</tr>
	</table>
	<?php
}

add_action( 'personal_options_update', 'fox_profile_background_field_update' );
add_action( 'edit_user_profile_update', 'fox_profile_background_field_update' );

function fox_profile_background_field_update( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_background';

	update_user_meta( $user_id, $field_id, intval( $_POST[ $field_id ] ) );
}

/**
 * Avatar problem
 * @since 4.3
------------------------------------------------------------------------------------ */
add_action( 'show_user_profile', 'fox_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'fox_show_extra_profile_fields' );

function fox_show_extra_profile_fields( $user ) {
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_avatar';
    
    $image_id = '';
    $image = get_user_meta( $user->ID, $field_id , true );
    if ( $image ) {
        $image_id = $image;
        $image = wp_get_attachment_image_src( $image, 'medium' );
        if ( $image ) {
            $image = $image[0];
        }
    }
    $upload_button_name = $image ? esc_html__( 'Change Image','wi' ) : esc_html__( 'Upload Image','wi' );
	?>
	<h3><?php esc_html_e( 'Upload Avatar', 'wi' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="<?php echo esc_attr( $field_id ); ?>"><?php esc_html_e( 'Avatar', 'wi' ); ?></label></th>
			<td>
                
                <div class="wi-upload-wrapper">
    
                    <figure class="image-holder">

                        <?php if ( $image ) : ?>
                        <img src="<?php echo esc_url($image);?>" />
                        <?php endif; ?>

                        <a href="#" rel="nofollow" class="remove-image-button" title="<?php esc_html_e( 'Remove Image', 'wi' );?>">&times;</a>

                    </figure>

                    <input type="hidden" class="media-result" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $image_id ); ?>" />
                    <input type="button" class="upload-image-button button button-primary" value="<?php echo $upload_button_name;?>" />

                </div><!-- .wi-upload-wrapper -->
                
            </td>
		</tr>
	</table>
	<?php
}


add_action( 'personal_options_update', 'fox_update_profile_fields' );
add_action( 'edit_user_profile_update', 'fox_update_profile_fields' );
function fox_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_avatar';

    update_user_meta( $user_id, $field_id, intval( $_POST[ $field_id ] ) );
    
}

add_filter( 'get_avatar_url', 'fox_custom_avatar_url', 10, 3 );
function fox_custom_avatar_url( $url, $id_or_email, $args ) {
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_avatar';
    
    $id = 0;
    if ( $id_or_email instanceof WP_User ) {
        
        $id = $id_or_email->ID;
        
    } elseif ( $id_or_email instanceof WP_Comment ) {
        
        $id = $id_or_email->user_id;
        
    } elseif ( is_numeric( $id_or_email ) ) {
    
        $id = $id_or_email;
        
    } elseif ( is_string( $id_or_email ) && is_email( $id_or_email ) ) {
        
        $user = get_user_by( $id_or_email, 'email' );
        if ( $user ) {
            $id = $user->ID;
        }
    
    }
    
    if ( $id ) {
        
        $image = get_user_meta( $id, $field_id, true );
        if ( $image ) {
            
            $image_id = $image;
            $image = wp_get_attachment_image_src( $image, 'thumbnail' );
            if ( $image ) {
                $image = $image[0];
            }
            
        }
        if ( $image ) {
            $url = $image;
        }
            
    }
        
    return $url;
    
}