<?php
class Fox56_Builder_Page extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'page';
	}

	public function get_title() {
		return 'Page Content';
	}

	public function get_icon() {
		return 'media-text';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/page.jpg';
	}

	function fields() {

		if ( ! is_customize_preview() ) {
			$page_arr = [];
		} else {
			// pages
			$page_arr = [ '' => '--- NONE ---'];
			$pages = get_posts( 'posts_per_page=-1&post_type=page&orderby=name&order=asc' );
			foreach ( $pages as $page ) {
				$page_arr[ 'page_' . $page->ID ] = $page->post_title;
			}
		}

		$fields[ 'page' ] = [
			'name' => 'Choose page content of',
			'type' => 'select',
			'options' => $page_arr,
			'std' => '',
		];

		return $fields;
	}

	function render( $args ) {

		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'page' => '',
		]));
	
		$page_id = $page;
		$page_id = str_replace( 'page_', '', $page_id );
		if ( ! $page_id ) {
			return;
		}

		$cl = [ 'section-page-content', $widget_id ];
		
		if ( $page_id ) {
			
			$query = new WP_Query([
				'p' => $page_id,
				'post_type' => 'page',
				'post_status' => 'publish',
			]);
			
			if ( $query->have_posts() ) {
				while( $query->have_posts() ) {
					$query->the_post();
					echo '<div class="' . esc_attr( join( ' ', $cl ) ).'">';
					the_content();
					echo '</div>';
				}
			}
			wp_reset_query();

		} else {

			echo '<div class="' . esc_attr( join( ' ', $cl ) ).'">Please select your page</div>';

		}
		
	}

}