<?php
class Fox56_Builder_Spacer extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'spacer';
	}

	public function get_title() {
		return 'Spacer';
	}

	public function get_icon() {
		return 'editor-break';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/spacer.jpg';
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$fields[ 'height' ] = [
			'type' => 'group',
			'title' => 'Height',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Desktop',
				],
				'tablet' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'number',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'height',
					'selector' => '{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'height',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'use' => 'mobile',
					'property' => 'height',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
				],
			],
			'std' => [
				'desktop' => 30,
				'tablet' => 20,
				'mobile' => 20,
			]
		];

		return $fields;
	}

	function render( $args ) {
		extract( wp_parse_args( $args, [
			'widget_id' => '',
		]));

		$cl = [ 'spacer56', $widget_id ];
		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>"></div>
		<?php
	}

}