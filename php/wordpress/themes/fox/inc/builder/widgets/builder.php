<?php
class Fox56_Builder_Builder extends Fox56_Builder_Widget_Base {

	public function get_name() {
		return 'builder';
	}

    public function get_title() {
		return 'Builder';
	}

	public function get_icon() {
		return '';
	}

	function fields() {
		return [];
	}

	function render( $args ) {
		extract( wp_parse_args( $args, [
			'widget_id' => 'sectionlist',
			'content' => []
		]));
		?>
		<div class="builder56 sectionlist">
			<?php fox56_builder_render_widget_content( $content ); ?>
		</div><!-- .builder56 -->
		<?php
	}

}