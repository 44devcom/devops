<?php
class Fox56_Builder_Row extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'row';
	}

	public function get_title() {
		return 'Row';
	}

	public function get_icon() {
		return 'columns';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/row.jpg';
	}

	function fields() {
		global $fox56_customize;
		$fields = [];

		$sidebar_list = [ '' => '--- NONE ---' ];
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[ $sidebar['id'] ] = $sidebar['name'];
        }
		
		$fields[ 'sidebar' ] = [
			'type' => 'select',
			'std' => '',
			'options' => $sidebar_list,
			'title' => 'Sidebar',
			'refresh' => 'secondary',
		];
		
		$fields[ 'sidebar_position' ] = [
			'type' => 'radio',
			'std' => 'right',
			'options' => [
				'left' => 'Left',
				'right' => 'Right',
			],
			'title' => 'Sidebar position',
		];
		
		$fields[ 'sidebar_sticky' ] = [
			'type' => 'checkbox',
			'std' => false,
			'title' => 'Sidebar sticky?',
			'desc' => 'You will see "Sticky sidebar" takes action when close the Customizer',
		];
		
		$fields[ 'sidebar_width'] = [
			'type' => 'text',
			'std' => '260px',
			'title' => 'Sidebar width',
		
			'css' => [
				[
					'property' => 'width',
					'unit' => 'px',
					'selector' => "{{wrapper}} .secondary56",
					'media_query' => '@media only screen and (min-width: 840px)',
				],
				[
					'property' => 'width',
					'unit' => 'px',
					'selector' => "{{wrapper}}.widget56__row--hassidebar > .primary56",
					'value_pattern' => 'calc(100% - $)',
					'media_query' => '@media only screen and (min-width: 840px)'
				]
			],
		];
		
		$fields[ 'sidebar_main_sep' ] = [
			'type' => 'radio',
			'std' => '0px',
			'options' => [
				'0px' => 'No',
				'1px' => 'Yes',
			],
			'title' => 'Sidebar - Content separator border',
			'css' => [
				[
					'property' => 'border-left-width',
					'selector' => "{{wrapper}} .secondary56__sep",
				]
			],
		];
		
		$fields[ 'sidebar_main_sep_color' ] = [
			'type' => 'color',
			'title' => 'Sep color',
			'css' => [
				[
					'property' => 'border-color',
					'selector' => "{{wrapper}} .secondary56__sep",
				]
			],
		];

		return $fields;
	}

	function render( $args ) {
		$content = isset( $args['content'] ) ? $args['content'] : [];
		$widget_id = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
		$cl = [ 'widget56__row', 'widget56', $widget_id ];
		extract( wp_parse_args( $args,[
			'sidebar' => false,
			'sidebar_position' => 'right',
			'sidebar_sticky' => false,
		]));

		if ( $sidebar ) {
			$cl[] = 'widget56__row--hassidebar';
			$cl[] = 'hassidebar--' . $sidebar_position;

			if (  $sidebar_sticky ) {
				$cl[] = 'hassidebar--sticky';
			}
		}
		?>
		<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
			<?php if ( $sidebar ) { echo '<div class="primary56">'; } ?>
				<div class="row">
					<?php fox56_builder_render_widget_content( $content ); ?>
				</div><!-- .row -->
			<?php if ( $sidebar ) { echo '</div>'; } ?>
			<?php if ( $sidebar ) { ?>
			<div class="secondary56">
				
				<?php fox56_builder_sidebar_inner( $args['sidebar'] ); ?>
				<div class="secondary56__sep"></div>
				
			</div>
			<?php } ?>
		</div><!-- .widget56__row -->
		<?php
	}

}