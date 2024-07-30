<?php
class Fox56_Builder_Post_Carousel extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'post-carousel';
	}

	public function get_title() {
		return 'Post Carousel';
	}

	public function get_icon() {
		return 'images-alt2';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/post-carousel.jpg';
	}

	function fields() {
		$fields = [];
		global $fox56_customize;

		/* general 
		--------------------------------------------------------------- */
		$fields[ 'column' ] = [
			'type' => 'group',
			'title' => 'Column',
			'fields' => [
				'desktop' => [
					'name' => 'Desktop',
					'type' => 'number',
					// 'std' => 3,
					'max' => 6,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
				'tablet' => [
					'name' => 'Tablet',
					'type' => 'number',
					// 'std' => 2,
					'max' => 4,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
				'mobile' => [
					'name' => 'Mobile',
					'type' => 'number',
					// 'std' => 2,
					'max' => 4,
					'min' => 1,
					'step' => 1,
					'col' => '1-3',
				],
			],
			'std' => [
				'desktop' => 3,
				'tablet' => 2,
				'mobile' => 1,
			],
		
			'tab' => 'general',
			'tab_name' => 'General',

			'section' => 'general',
			'section_name' => 'General',
		];

		$fields = array_merge( $fields, fox56_builder_query_options() );

		/**
		 * CAROUSEL CONTROLS
		 * ========================================================================================
		 */
		$fields[ 'carousel_hint' ] = [
			'type' => 'checkbox',
			'std' => false,
			'title' => 'Show little hint of next item?',
			
			'section' => 'carousel_settings',
			'section_name' => 'Carousel Settings',
		];

		// nav and position
		$fields[ 'carousel_nav' ] = [
			'type' => 'select',
			'std' => 'middle-inside',
			'options' => [
				'middle-inside' => 'Middle + Inside',
				'middle-edge' => 'Middle + Edge',
				'top-right' => 'Top right',
				'none' => 'None',
			],
			'title' => 'Arrows',
		];

		$fields[ 'carousel_nav_shape' ] = [
			'type' => 'select',
			'std' => 'circle',
			'options' => [
				'circle' => 'Circle',
				'square' => 'Square',
				'high-square' => 'High square',
			],
			'title' => 'Arrows shape',
		];

		$fields[ 'carousel_nav_style' ] = [
			'type' => 'select',
			'std' => 'outline',
			'options' => [
				'outline' => 'Outline',
				'fill' => 'Fill',
				'primary' => 'Primary',
				'dark' => 'Dark',
			],
			'title' => 'Arrows style',
		];

		$fields[ 'carousel_pager' ] = [
			'type' => 'checkbox',
			'std' => false,
			'title' => 'Pager?',
		];

		$fields[ 'carousel_pager_style' ] = [
			'type' => 'select',
			'options' => [
				'circle' => 'Circle',
				'square' => 'Square',
				'big-circle' => 'Big circle',
				'big-square' => 'Big Square',
			],
			'std' => 'circle',
			'title' => 'Pager style',
		];

		$fields[ 'carousel_autoplay' ] = [
			'type' => 'checkbox',
			'title' => 'Autoplay?',
		];

		$style_fields = fox56_builder_post_style_options();
		unset( $style_fields[ 'post_style' ]['section'] );
		unset( $style_fields[ 'post_style' ]['section_name'] );

		$style_fields[ 'text_inner_width' ] = [
			'type' => 'group',
			'title' => '[On Top] Inner text width',
			'condition' => [
				'post_style' => 'ontop',
			],

			'fields' => [
				'desktop' => [
					'col' => '1-3',
					'name' => 'Desktop',
					'type' => 'text',
				],
				'tablet' => [
					'col' => '1-3',
					'name' => 'Tablet',
					'type' => 'text',
				],
				'mobile' => [
					'col' => '1-3',
					'name' => 'Mobile',
					'type' => 'text',
				],
			],
			'css' => [
				[
					'selector' => '{{wrapper}} .post56--ontop .post56__text__inner',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}} .post56--ontop .post56__text__inner',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}} .post56--ontop .post56__text__inner',
					'property' => 'width',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]
		];

		$style_fields[ 'text_inner_background' ] = [
			'type' => 'color',
			'title' => '[On Top] Inner text background',
			'condition' => [
				'post_style' => 'ontop',
			],
			'css' => [
				[
					'selector' => '{{wrapper}} .post56--ontop .post56__text__inner',
					'property' => 'background',
				]
			]
		];

		$fields[ 'align' ] = [
			'type' => 'radio',
			'title' => 'Item Align',
			'options' => [
				'' => 'Default',
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			],
			'std' => '',
			'transport' => 'postMessage',

			'section' => 'post_style',
			'section_name' => 'Post Style',
		];

		$fields = array_merge( $fields, $style_fields );
		$fields = array_merge( $fields, fox56_builder_item_box_options() );

		$fields[ 'carousel_h_spacing' ] = [
			'section' => 'spacing_border',
			'section_name' => 'Spacing/Border',

			'type' => 'group',
			'id' => 'carousel_item_spacing',
			'title' => 'Gap between items',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'min' => 0,
					'max' => 100,
					'col' => '1-3',
				],
			],
			'std' => [ 
				'desktop' => 16,
				'tablet' => 8,
				'mobile' => 8,
			],
			'css' => [
				[
					'property' => 'padding',
					'value_pattern' => '0 $',
					'selector' => "{{wrapper}} .carousel-cell",
					'use' => 'desktop',
					'unit' => 'px',
				],
				[
					'property' => 'padding',
					'value_pattern' => '0 $',
					'selector' => "{{wrapper}} .carousel-cell",
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'property' => 'padding',
					'value_pattern' => '0 $',
					'selector' => "{{wrapper}} .carousel-cell",
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
					'unit' => 'px',
				],
		
		
				[
					'property' => 'margin',
					'value_pattern' => '0 -$',
					'selector' => "{{wrapper}} .carousel56__container",
					'use' => 'desktop',
					'unit' => 'px',
				],
				[
					'property' => 'margin',
					'value_pattern' => '0 -$',
					'selector' => "{{wrapper}} .carousel56__container",
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
					'unit' => 'px',
				],
				[
					'property' => 'margin',
					'value_pattern' => '0 -$',
					'selector' => "{{wrapper}} .carousel56__container",
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
					'unit' => 'px',
				],
				
			]
		];

		$fields = array_merge( $fields, fox56_builder_component_spacing_options() ) ;
		$fields = array_merge( $fields, fox56_builder_component_options() );
		
		/**
		 * -----------------------------------------------      THUMBNAIL
		 */
		$fields[ 'thumbnail' ] = [
			'type' => 'radio_image',
			'std' => 'thumbnail-medium',
			'options' => $fox56_customize->thumbnail_options,
			'title' => 'Thumbnail',

			'section' => 'thumbnail',
			'section_name' => 'Thumbnail',
		];

		$fields[ 'thumbnail_custom' ] = [
			'type' => 'group',
			'std' => [
				'width' => 400,
				'height' => 300,
			],
			'fields' => [
				'width' => [
					'name' => 'Width',
					'type' => 'number',
					'col' => '1-2',
					'step' => 10,
					'min' => 50,
					'max' => 1000,
				],
				'height' => [
					'name' => 'Height',
					'type' => 'number',
					'col' => '1-2',
					'step' => 10,
					'min' => 50,
					'max' => 1000,
				],
			],
			'title' => 'Custom Thumbnail',
			'condition' => [
				"thumbnail" => 'custom',
			],
		];

		$fields[ 'thumbnail_rich' ] = [
			'type' => 'checkbox',
			'title' => 'Rich thumbnail if possible?',
			'desc' => 'If you check this, It\'ll display video/audio media for video/audio posts',
		];

		$fields[ 'thumbnail_components' ] = [
			'type' => 'multicheckbox',
			'title' => 'Thumbnail stuffs',
			'std' => [ 'format_indicator' ],
			'options' => [
				'format_indicator' => 'Format Indicator',
				'caption' => 'Caption',
				'review' => 'Review Sccore',
				'view' => 'Post view',
			],
		];

		$fields[ 'thumbnail_border_radius' ] = [
			'type' => 'select',
			'std' => '0px',
			'options' => [
				'0px' => '0',
				'2px' => '2',
				'4px' => '4',
				'6px' => '6',
				'10px' => '10',
				'30px' => '30',
				'50%' => 'Circle',
			],
			'title' => 'Thumbnail Roundness',
			'css' => [
				[
					'selector' => "{{wrapper}} .thumbnail56 img",
					'property' => 'border-radius',
					'unit' => 'px',
				],
			],
		];

		$fields[ 'thumbnail_hover_effect' ] = [
			'type' => 'select',
			'options' => [
				'' => 'Default',
				'none'      => 'None',
				'fade'      => 'Image Fade',
				'grayscale' => 'Grayscale',
				'sepia'     => 'Sepia',
				'dark'      => 'Dark',
				'letter'    => 'Title First Letter',
				'zoomin'    => 'Image Zoom In',
				'logo'      => 'Custom Logo',
			],
			'std' => '',
			'title' => 'Thumbnail hover effect',
		];

		$fields[ 'thumbnail_hover_logo' ] = [
			'type' => 'image',
			'title' => 'Thumbnail logo',
			'condition' => [
				"thumbnail_hover_effect" => 'logo',
			],
		];

		$fields[ 'thumbnail_hover_logo_width' ] = [
			'type' => 'number',
			'title' => 'Thumbnail logo width (%)',
			'std' => 40,
			'min' => 10,
			'max' => 100,
			'step' => 5,
			'css' => [
				[
					'selector' => "{{wrapper}} .thumbnail56 .thumbnail56__hover-img",
					'property' => 'width',
					'unit' => '%',
				],
			],
			'condition' => [
				"thumbnail_hover_effect" => 'logo',
			],
		];

		$fields = array_merge( $fields, fox56_builder_title_options() );
		$fields = array_merge( $fields, fox56_builder_excerpt_options() );
		$fields = array_merge( $fields, fox56_builder_meta_options() );
		$fields = array_merge( $fields, fox56_builder_color_options() );
		$fields = array_merge( $fields, fox56_builder_typography_options() );

		return $fields;

	}

	function render( $args ) {
		
		$query = fox56_builder_query( $args );
		if ( ! $query ) {
			return;
		}
		fox56_blog_carousel( $query, $args );

	}

}