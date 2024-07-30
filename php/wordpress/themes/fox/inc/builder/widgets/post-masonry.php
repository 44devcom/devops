<?php
class Fox56_Builder_Post_Masonry extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'post-masonry';
	}

	public function get_title() {
		return 'Post Masonry';
	}

	public function get_icon() {
		return 'schedule';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/masonry.jpg?v=' . FOX_VERSION;
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

		$fields[ 'big_first_post' ] = [
			'type' => 'checkbox',
			'name' => 'First post big?',
		];

		$fields[ 'big_first_post_background' ] = [
			'type' => 'color',
			'std' => '#FFFFFF',
			'name' => 'First post background color?',
			'css' => [
				[
					'selector' => '{{wrapper}}.masonry56--bigfirst .masonry-cell:first-child',
					'property' => 'background',
				]
			],
			'desc' => 'If you have separator between columns, you might need this option.',
		];
		
		$fields[ 'masonry_item_creative' ] = [
			'type' => 'checkbox',
			'name' => 'Vertical thumbnail on side',
		];

		$fields = array_merge( $fields, fox56_builder_query_options() );

		/*
		$style_fields = fox56_builder_post_style_options();
		unset( $style_fields[ 'post_style' ]['section'] );
		unset( $style_fields[ 'post_style' ]['section_name'] );
		*/

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

		// $fields = array_merge( $fields, $style_fields );
		$fields = array_merge( $fields, fox56_builder_item_box_options() );

		/* Spacing / Border
		--------------------------------------------------------------- */
		// col gap + layout: grid, list, masonry, group
		$fields[ 'h_spacing' ] = [
			'section' => 'spacing_border',
			'section_name' => 'Spacing/Border',

			'type' => 'group',
			'title' => 'Gap between columns',
			'choices' => [
				'min' => 0,
				'max' => 100,
				'step' => 2,
			],
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
				'desktop' => 32,
				'tablet' => 20,
				'mobile' => 10,
			],
			'css' => [
				
				/**
				 * BLOG MASONRY
				 */
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-left',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-right',
					'selector' => "{{wrapper}} .masonry-cell",
					'value_pattern' => 'calc($/2)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
				
				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-left',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-right',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			],
		];

		// row gap + layout: grid, list, masonry, group
		// for group: this applies to its inner posts
		$fields[ "v_spacing" ] = [
			'type' => 'group',
			'title' => 'Gap between rows',
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
				'desktop' => 32,
				'tablet' => 20,
				'mobile' => 10,
			],
			'css' => [

				/**
				 * BLOG MASONRY
				 */
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .masonry-cell",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .masonry-cell",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'padding-top',
					'selector' => "{{wrapper}} .masonry-cell",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
				
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .main-masonry",
					'value_pattern' => '-$',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				/**
				 * BORDER TOP MOVED
				 */
				[
					'property' => 'top',
					'selector' => "{{wrapper}} .post56__sep__line",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'top',
					'selector' => "{{wrapper}} .post56__sep__line",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'top',
					'selector' => "{{wrapper}} .post56__sep__line",
					'value_pattern' => 'calc(-$/2)',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			],
			
		];

		$fields = array_merge( $fields, fox56_builder_component_spacing_options() ) ;
		$fields = array_merge( $fields, fox56_builder_border_options() ) ;
		$fields = array_merge( $fields, fox56_builder_component_options() );

		/**
		 * -----------------------------------------------      THUMBNAIL
		 */
		$fields[ 'thumbnail' ] = [
			'type' => 'radio_image',
			'std' => 'large',
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

		/**
		 * -----------------------------------------------      TITLE
		 */
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
		$args['layout'] = 'masonry';
		fox56_blog_masonry( $query, $args );
	}

}