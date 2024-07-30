<?php
class Fox56_Builder_Sidebar extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'sidebar';
	}

	public function get_title() {
		return 'Widgets Grid';
	}

	public function get_icon() {
		return 'align-pull-right';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/sidebar.jpg';
	}

	function fields() {

		global $fox56_customize;

		$sidebar_list = [ '' => '--- NONE ---' ];
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
        }

		$fields = [];
		$fields[ 'main_sidebar' ] = [
			'type' => 'select',
			'name' => 'Choose Sidebar',
			'options' => $sidebar_list,
			'std' => '',
			'desc' => 'Go to <a href="' . admin_url( 'admin.php?page=sidebar-manager' ) . '" target="_blank">Dashboard &raquo; Fox Magazine &raquo; Sidebar Manager</a> to create your custom sidebar then it\'ll appear in this list',
		];
		$fields[ 'sidebar_layout' ] = [
			'name'    => 'Widgets Layout',
			'type'     => 'radio_image',
			'options'   => [
				'1' => get_template_directory_uri() . '/inc/customize/images/1-cols.jpg',
				'2' => get_template_directory_uri() . '/inc/customize/images/2-cols.jpg',
				'3' => get_template_directory_uri() . '/inc/customize/images/3-cols.jpg',
				'4' => get_template_directory_uri() . '/inc/customize/images/4-cols.jpg',
			],
			'std'       => '3',
			'desc'      => 'If you have 3 columns, please use 3 widgets in your sidebar',
		];

		return $fields;
	}

	function render( $args ) {

		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'main_sidebar' => '',
			'sidebar_layout' => '3',
		]));
	
		$cl = [ 'main-section-sidebar', $widget_id ];
		if ( ! in_array( $sidebar_layout, [ '1', '2', '3', '4' ] ) ) {
			$sidebar_layout = '3';
		}
		$cl[] = 'main-section-sidebar-' . $sidebar_layout;
	
		echo '<div class="' . esc_attr( join( ' ', $cl ) ) . '">';
	
		if ( ! $main_sidebar ) {
			if ( current_user_can( 'manage_options' ) ) {
				$content = '<p class="fox-error">Please choose a sidebar to display</p>';
				echo $content;
			}
		} elseif ( ! is_active_sidebar( $main_sidebar ) ) {
			if ( current_user_can( 'manage_options' ) ) {
				$content = '<p class="fox-error">Your sidebar is currently empty. Please go to <strong>Appearance > Widgets</strong> to drop widgets there!</p>';
				echo $content;
			}
		} else {
			echo '<div class="section-sidebar-inner">';
			dynamic_sidebar( $main_sidebar );
			echo '</div>';
		}
	
		echo '</div>';
		
	}

}