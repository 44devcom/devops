<?php
class Fox56_Builder_HTML extends Fox56_Builder_Widget_Base {

    public function get_title() {
		return 'HTML/Shortcode';
	}

	public function get_icon() {
		return 'shortcode';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/html.jpg';
	}

	function fields() {
		global $fox56_customize;
		$fields = [];
		$fields[ 'html' ] = [
			'type' => 'textarea',
			'name' => 'Enter Code',
			'desc' => 'You can enter shortcode or any HTML code',
			'placeholder' => 'Eg. [author_grid number=3 column=3 /]',
		];

		return $fields;
	}

	function render( $args ) {

		extract( wp_parse_args( $args, [
			'html' => '',
			'widget_id' => '',
		]));
		
		$cl = [ 'section-shortcode', $widget_id ];

		echo '<div class="' . esc_attr( join( ' ', $cl ) ). '">';
		echo do_shortcode( $html );
		echo '</div>';

	}

}