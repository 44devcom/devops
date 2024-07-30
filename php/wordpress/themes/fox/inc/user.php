<?php
/* USER SOCIAL
======================================================= */
function fox56_user_social_support() {
    return [
        'facebook' => 'Facebook',
        'youtube' => 'YouTube',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'tiktok' => 'Tiktok',
        'pinterest' => 'Pinterest',
        'linkedin' => 'LinkedIn',
        'tumblr' => 'Tumblr',
        'snapchat' => 'Snapchat',
        'vimeo' => 'Vimeo',
        'soundcloud' => 'Soundcloud',
        'flickr' => 'Flickr',
        'vkontakte' => 'VK',
        'spotify' => 'Spotify',
        'reddit' => 'Reddit',
        'whatsapp' => 'Whatsapp',
        'wechat' => 'Wechat',
        'weibo' => 'Weibo',
        'telegram' => 'Telegram',
    ];
    
}

/* ADD USER OPTIONS
======================================================= */
add_filter( 'user_contactmethods' , 'fox56_contactmethods' );
function fox56_contactmethods( $contactmethods ) {
    foreach( fox56_user_social_support() as $brand => $name ) {
        $contactmethods[ $brand ] = $name . ' URL';
    }
	return $contactmethods;
}

/* COVER OPTIONS
======================================================= */
add_action( 'show_user_profile', 'fox56_profile_background_field' );
add_action( 'edit_user_profile', 'fox56_profile_background_field' );

function fox56_profile_background_field( $user ) {
    
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

add_action( 'personal_options_update', 'fox56_profile_background_field_update' );
add_action( 'edit_user_profile_update', 'fox56_profile_background_field_update' );

function fox56_profile_background_field_update( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_background';

	update_user_meta( $user_id, $field_id, intval( $_POST[ $field_id ] ) );
}

/* AVAR
======================================================= */
add_action( 'show_user_profile', 'fox56_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'fox56_show_extra_profile_fields' );

function fox56_show_extra_profile_fields( $user ) {
    
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


add_action( 'personal_options_update', 'fox56_update_profile_fields' );
add_action( 'edit_user_profile_update', 'fox56_update_profile_fields' );
function fox56_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
    
    // so it becomes a local property
    $blog_id = get_current_blog_id();
    $field_id = '_wi_' . $blog_id . '_avatar';

    update_user_meta( $user_id, $field_id, intval( $_POST[ $field_id ] ) );
    
}

/* AVATAR FRONTEND
======================================================= */
add_filter( 'get_avatar_url', 'fox56_custom_avatar_url', 10, 3 );
function fox56_custom_avatar_url( $url, $id_or_email, $args ) {
    
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