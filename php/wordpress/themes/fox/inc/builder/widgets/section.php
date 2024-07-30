<?php
class Fox56_Builder_Section extends Fox56_Builder_Widget_Base {

	public function get_name() {
		return 'section';
	}

    public function get_title() {
		return 'Section';
	}

	public function get_icon() {
		return '';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/section.jpg?v=' . FOX_VERSION;
	}

	function fields() {

		global $fox56_customize;

		$fields = [];
		$fields[ 'section_name' ] = [
			'type' => 'text',
			'title' => 'Section Name',
			'std' => 'Untitled',
			'placeholder' => 'My Section',
		];

		$fields[ 'hide' ] = [
			'type' => 'checkbox',
			'title' => 'Hide this section temporarily',
			'desc' => 'By hiding, It\'s being hidden in the frontend. You can still edit it in the builder.'
		];
		
		$fields[ 'class' ] = [
			'type' => 'text',
			'title' => 'Section CSS Class',
			'desc' => 'Only letters, number, no spacing, eg. my-section__1, Section-most-popular_3. It takes effect only after closing the Customizer.',
		];

		$fields[ 'id' ] = [
			'type' => 'text',
			'title' => 'Section ID',
			'desc' => 'Only letters, number, no spacing, eg. my-section__1, Section-most-popular_3. It takes effect only after closing the Customizer.',
		];

		$fields[ 'stretch' ] = [
			'type' => 'radio_image',
			'title' => 'Section stretch',
			'options'=> [
				'fullwidth' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
				'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
				'narrow' => get_template_directory_uri() . '/inc/customize/images/narrow.jpg',
			],
			'std' => 'content',
		];

		$fields[ 'responsiveness' ] = [
			'type' => 'multicheckbox',
			'std' => [
				'desktop', 'tablet', 'mobile'
			],
			'options' => [
				'desktop' => 'Desktop',
				'tablet' => 'Tablet',
				'mobile' => 'Mobile',
			],
			'title' => 'Responsiveness',
		];

		$fields[ 'disable_paged' ] = [
			'type' => 'checkbox',
			'title' => 'Disable this section from 2nd pages?',
		];

		/* STYLE
		------------------------------------------------ */
		$fields[ 'background_color' ] = [
			'type' => 'color',
			'title' => 'Section background',
			'css' => [
				[
					'selector' => '{{wrapper}}',
					'property' => 'background-color',
				]
			],
			
			'section' => 'style',
			'section_name' => 'Style',
		];
		
		$fields[ 'container_background_color' ] = [
			'type' => 'color',
			'title' => 'Inner background',
			'css' => [
				[
					'selector' => '{{wrapper}} .container--main',
					'property' => 'background-color',
				]
			]
		];

		$fields[ 'padding' ] = [
			'type' => 'group',
			'title' => 'Padding',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Desktop',
					'placeholder' => 'Eg. 10px',
				],
				'tablet' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'padding',
					'selector' => '{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'padding',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'use' => 'mobile',
					'property' => 'padding',
					'unit' => 'px',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
				],
			],
			'std' => [
			]
		];
		
		$fields[ 'margin' ] = [
			'type' => 'group',
			'title' => 'Margin',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Desktop',
					'placeholder' => 'Eg. 10px',
				],
				'tablet' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'margin-top',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'desktop',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'margin-top',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'mobile',
					'property' => 'margin-top',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->mobile,
					'unit' => 'px',
				],
				[
					'use' => 'mobile',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->mobile,
					'unit' => 'px',
				],
			],
			'std' => [
			]
		];
		
		$fields[ 'margin_bottom' ] = [
			'type' => 'group',
			'title' => 'Margin Bottom',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Desktop',
					'placeholder' => 'Eg. 10px',
				],
				'tablet' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Tablet',
				],
				'mobile' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Mobile',
				],
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'mobile',
					'property' => 'margin-bottom',
					'selector' => '.builder56 .builder56__section{{wrapper}}',
					'media_query' => $fox56_customize->mobile,
					'unit' => 'px',
				],
			],
			'std' => [
			]
		];
		
		$fields[ 'border' ] = [
			'type' => 'group',
			'title' => 'Border',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Desktop',
					'placeholder' => 'Eg. 1px',
				],
				'tablet' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Tablet',
					'media_query' => $fox56_customize->tablet,
				],
				'mobile' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Mobile',
					'media_query' => $fox56_customize->mobile,
				],
				'color' => [
					'type' => 'color',
					'col' => '1-1',
					'name' => 'Border color',
				]
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'border-width',
					'selector' => '{{wrapper}}',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'border-width',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'mobile',
					'property' => 'border-width',
					'selector' => '{{wrapper}}',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'color',
					'property' => 'border-color',
					'selector' => '{{wrapper}}',
				],
			],
			'std' => [
			]
		];
		
		$fields[ 'container_border' ] = [
			'type' => 'group',
			'title' => 'Container Border',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Desktop',
					'placeholder' => 'Eg. 1px',
				],
				'tablet' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Tablet',
					'media_query' => $fox56_customize->tablet,
				],
				'mobile' => [
					'type' => 'text',
					'col' => '1-3',
					'name' => 'Mobile',
					'media_query' => $fox56_customize->mobile,
				],
				'color' => [
					'type' => 'color',
					'col' => '1-1',
					'name' => 'Border color',
				]
			],
			'css' => [
				[
					'use' => 'desktop',
					'property' => 'border-width',
					'selector' => '{{wrapper}} .container--main',
					'unit' => 'px',
				],
				[
					'use' => 'tablet',
					'property' => 'border-width',
					'selector' => '{{wrapper}} .container--main',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'mobile',
					'property' => 'border-width',
					'selector' => '{{wrapper}} .container--main',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'use' => 'color',
					'property' => 'border-color',
					'selector' => '{{wrapper}} .container--main',
				],
			],
			'std' => [
			]
		];

		return $fields;

	}

	function render( $args ) {

		extract( wp_parse_args( $args, [
			'widget_id',
			'hide' => false,
			'disable_paged' => false,
			'stretch' => 'content',
			'responsiveness' => 'desktop,tablet,mobile',
			'class' => '', // custom class
			'id' => '', // custom ID

			'content' => []
		]));

		// hide it in frontend
		if ( $hide && ! is_customize_preview() ) {
			return;
		}
		
		// hide it when paged
		if ( $disable_paged && ! is_customize_preview() ) {
			$paged = get_query_var( 'paged' );
			if ( $paged && $paged > 1 ) {
				return;
			}
		}
		
		$cl = [ 'builder56__section', 'section56', $widget_id, 'section56--stretch-' . $stretch ];
	
		/**
		 * RESPONSIVENESS VISIBILITY
		*/
		if ( ! is_array( $responsiveness ) ) {
			$responsiveness = explode( ',', $responsiveness );
		}
		if ( ! is_customize_preview() ) {
			$cl[] = in_array( 'desktop', $responsiveness ) ? 'show--desktop' : 'hide--desktop';
			$cl[] = in_array( 'tablet', $responsiveness ) ? 'show--tablet' : 'hide--tablet';
			$cl[] = in_array( 'mobile', $responsiveness ) ? 'show--mobile' : 'hide--mobile';
		} else {
			$cl[] = in_array( 'desktop', $responsiveness ) ? 'show--desktop' : 'disable--desktop';
			$cl[] = in_array( 'tablet', $responsiveness ) ? 'show--tablet' : 'disable--tablet';
			$cl[] = in_array( 'mobile', $responsiveness ) ? 'show--mobile' : 'disable--mobile';
		}
	
		/**
		 * hide it temporarily
		*/
		if ( $hide ) {
			$cl[] = 'section56--disable';
		}
	
		/**
		 * class
		*/
		if ( $class ) {
			$cl[] = $class;
		}
	
		/**
		 * attr_id
		 */
		$attr_id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		?>
	
	<div class="<?php echo esc_attr( join( ' ', $cl )); ?>"<?php echo $attr_id; ?>>

		<?php if ( 'fullwidth' != $stretch || is_customize_preview() ) { echo '<div class="container container--main">'; } ?>
	
		<?php fox56_builder_render_widget_content( $content ); ?>

		<?php if ( 'fullwidth' != $stretch || is_customize_preview() ) { echo '</div>'; } ?>
	
	</div>
		<?php

	}

}