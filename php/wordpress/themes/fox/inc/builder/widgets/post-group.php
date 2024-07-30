<?php
class Fox56_Builder_Post_Group extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'post-group';
	}

	public function get_title() {
		return 'Post Group';
	}

	public function get_icon() {
		return 'text';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/post-group.jpg';
	}

	function fields() {
		
		global $fox56_customize;
		$fields = [];

		$cols = [
			'big' => [
				'title' => 'Big column',
				'layout' => 'grid',
				'column' => '1',
				'number' => 1,
				'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
				'excerpt_length' => 32,
				'thumbnail' => 'thumbnail-large',
				'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
				'align' => '',
				'more_style' => 'primary',
			],
			'medium' => [
				'title' => 'Medium column',
				'layout' => 'grid',
				'column' => '1',
				'number' => 1,
				'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
				'excerpt_length' => 32,
				'thumbnail' => 'medium',
				'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
				'align' => '',
				'more_style' => 'plain',
			],
			'small' => [
				'title' => 'Small column',
				'layout' => 'grid',
				'column' => '1',
				'number' => 1,
				'components' => [ 'thumbnail', 'title', 'excerpt' ],
				'excerpt_length' => 12,
				'thumbnail' => 'thumbnail-medium',
				'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
				'align' => '',
				'more_style' => 'plain',
			],
		];

		$fields[ 'group_layout' ] = [
			'type' => 'radio_image',
			'title' => 'Group layout',
			'options' => [
		
				// 2 COLS
				'1-1' => get_template_directory_uri() . '/inc/customize/images/group-1-1.jpg',
				'2-1' => get_template_directory_uri() . '/inc/customize/images/group-2-1.jpg',
				'1-2' => get_template_directory_uri() . '/inc/customize/images/group-1-2.jpg',
				'1-3' => get_template_directory_uri() . '/inc/customize/images/group-1-3.jpg',
				'3-1' => get_template_directory_uri() . '/inc/customize/images/group-3-1.jpg',
				'2-3' => get_template_directory_uri() . '/inc/customize/images/group-2-3.jpg',
				'3-2' => get_template_directory_uri() . '/inc/customize/images/group-3-2.jpg',
		
				// 3 COLS
				'3-1-1' => get_template_directory_uri() . '/inc/customize/images/group-3-1-1.jpg',
				'1-3-1' => get_template_directory_uri() . '/inc/customize/images/group-1-3-1.jpg',
				'1-1-3' => get_template_directory_uri() . '/inc/customize/images/group-1-1-3.jpg',
		
				'2-1-1' => get_template_directory_uri() . '/inc/customize/images/group-2-1-1.jpg',
				'1-2-1' => get_template_directory_uri() . '/inc/customize/images/group-1-2-1.jpg',
				'1-1-2' => get_template_directory_uri() . '/inc/customize/images/group-1-1-2.jpg',
		
			],
			'std' => '2-1',
		];

		$fields = array_merge( $fields, fox56_builder_query_options() );
		
		foreach ( $cols as $col => $std ) {
			
			$colname = $std['title'];
			
			if ( $col == 'big' || $col == 'medium' ) {
				
				$fields[ "{$col}_number" ] = [
					'type' => 'number',
					'title' => "$colname number of posts",
					'std' => $std[ 'number' ],

					'section' => $col,
					'section_name' => $colname,
				];

			}
		
			$fields[ "{$col}_layout" ] = [
				'type' => 'radio_image',
				'title' => "{$colname} layout",
				'options' => [
					'grid' => get_template_directory_uri() . '/inc/customize/images/grid.jpg',
					'list' => get_template_directory_uri() . '/inc/customize/images/list.jpg',
				],
				'std' => $std[ 'layout' ],
			];

			if ( 'small' == $col ) {
				$fields[ "{$col}_layout" ]['section'] = $col;
				$fields[ "{$col}_layout" ]['section_name'] = $colname;
			}
		
			$fields[ "{$col}_column" ] = [
				'type' => 'group',
				'title' => "$colname post columns",
				'fields' => [
					'desktop' => [
						'type' => 'number',
						'name' => 'Desktop',
						'min' => 1,
						'max' => 2,
						'col' => '1-3',
					],
					'tablet' => [
						'type' => 'number',
						'name' => 'Tablet',
						'min' => 1,
						'max' => 2,
						'col' => '1-3',
					],
					'mobile' => [
						'type' => 'number',
						'name' => 'Mobile',
						'min' => 1,
						'max' => 2,
						'col' => '1-3',
					],
				],
				'std' => [
					'desktop' => 1,
					'tablet' => 1,
					'mobile' => 1,
				],
			];
		
			if ( 'big' == $col ) {
				$fields[ "{$col}_align" ] = [
					'type' => 'radio',
					'title' => "$colname align",
					'options' => [
						'' => 'Default',
						'left' => 'Left',
						'center' => 'Center',
						'right' => 'Right',
					],
					'std' => $std[ 'align' ],
				];
			}
		
			$fields[ "{$col}_components" ] = [
				'title' => 'Components',
				'type' => 'sortable',
				'options' => [
					'thumbnail' => 'Post Thumbnail',
					'standalone_category' => [
						'display' => 'inline',
						'name' => 'Fancy Category'
					],
					'live' => [
						'display' => 'inline',
						'name' => 'LIVE Indicator'
					],
					'title' => 'Post Title',
					'date' => [
						'display' => 'inline',
						'name' => 'Date'
					],
					'author' => [
						'display' => 'inline',
						'name' => 'Author'
					],
					'category' => [
						'display' => 'inline',
						'name' => 'Category'
					],
					'comment' => [
						'display' => 'inline',
						'name' => 'Comment'
					],
					'reading_time' => [
						'display' => 'inline',
						'name' => 'Read time'
					],
					'view' => [
						'display' => 'inline',
						'name' => 'View'
					],
					'excerpt' => 'Excerpt',
					'more' => 'ReadMore button',
					'share' => 'Social share icons',
				],
				'std' => $std[ 'components' ],
			];
		
			$fields[ "{$col}_thumbnail" ] = [
				'type' => 'select',
				'title' => "$colname thumbnail",
				'std' => $std[ 'thumbnail' ],
				'options' => $fox56_customize->thumbnail_select,
			];
		
			$fields[ "{$col}_thumbnail_custom" ] = [
				'type' => 'group',
				'std' => [
					'width' => 480,
					'height' => 320,
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
				'desc' => 'Enter a thumbnail_name or custom size like: 420x360',
				'title' => 'Custom Thumbnail',
			];
		
			$fields[ "{$col}_thumbnail_rich" ] = [
				'type' => 'checkbox',
				'title' => "$colname rich thumbnail?",
				'std' => '',
				'desc' => 'If you check this, It\'ll display video/audio media for video/audio posts',
			];
		
			if ( $col == 'medium' || $col == 'small' ) {
		
				$fields[ "{$col}_thumbnail_width_px" ] = [
					'type' => 'group',
					'std' => [
						'desktop' => 120,
						'tablet' => 120,
						'mobile' => 90,
					],
					'fields' => [
						'desktop' => [
							'name' => 'Desktop',
							'type' => 'number',
							'col' => '1-3',
							'step' => 5,
							'min' => 40,
							'max' => 300,
						],
						'tablet' => [
							'name' => 'Tablet',
							'type' => 'number',
							'col' => '1-3',
							'step' => 5,
							'min' => 40,
							'max' => 300,
						],
						'mobile' => [
							'name' => 'Mobile',
							'type' => 'number',
							'col' => '1-3',
							'step' => 5,
							'min' => 40,
							'max' => 300,
						],
					],
					'css' => [
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
							'property' => 'width',
							'unit' => 'px',
							'use' => 'desktop',
						],
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
							'property' => 'width',
							'unit' => 'px',
							'use' => 'tablet',
							'media_query' => $fox56_customize->tablet,
						],
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56",
							'property' => 'width',
							'unit' => 'px',
							'use' => 'mobile',
							'media_query' => $fox56_customize->mobile,
						],
				
						/**
						 * TEXT
						 */
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
							'property' => 'width',
							'unit' => 'px',
							'value_pattern' => 'calc(100% - $)',
							'use' => 'desktop',
						],
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
							'property' => 'width',
							'unit' => 'px',
							'value_pattern' => 'calc(100% - $)',
							'use' => 'tablet',
							'media_query' => $fox56_customize->tablet,
						],
						[
							'selector' => "{{wrapper}}.row56__col--{$col} .post56--list--thumb-pixel .thumbnail56 + .post56__text",
							'property' => 'width',
							'unit' => 'px',
							'value_pattern' => 'calc(100% - $)',
							'use' => 'mobile',
							'media_query' => $fox56_customize->mobile,
						],
					],
					'title' => 'Thumbnail width',
				];
		
			}
		
			$fields[ "{$col}_excerpt_length" ] = [
				'type' => 'number',
				'title' => "$colname excerpt length",
				'std' => $std[ 'excerpt_length' ],
				'min' => 0,
				'max' => 60,
				'step' => 1,
			];
		
			$fields[ "{$col}_more_style" ] = [
				'type' => 'radio_image',
				'options' => [
					'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
					'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
					'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
					'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
					'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
					'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
				],
				'title' => "$colname ReadMore style",
				'std' => $std[ 'more_style' ],
			];
		
			$fields[ "{$col}_title_typography" ] = [
				'type' => 'group',
				'title' => "$colname title typography",
				'fields' => $fox56_customize->typo_fields,
				'css' => fox56_builder_typo_css( '.row56__col--' . $col . ' .title56' ),
			];
		
			$fields[ "{$col}_excerpt_typography" ] = [
				'type' => 'group',
				'title' => "$colname excerpt typography",
				'fields' => $fox56_customize->typo_fields,
				'css' => fox56_builder_typo_css( '.row56__col--' . $col . ' .excerpt56' ),
			];
		
		}

		$fields = array_merge( $fields, fox56_builder_post_style_options() );
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
				 * GROUP
				 */
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}}.row56",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}}.row56",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}}.row56",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
				
				/**
				 * sep (list, grid, group)
				 */
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}} .blog56__sep",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}} .blog56__sep",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'column-gap',
					'selector' => "{{wrapper}} .blog56__sep",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				/**
				 * vertical border move right little bit
				 */
				[
					'property' => 'transform',
					'selector'=> "{{wrapper}} .blog56__sep__line",
					'value_pattern' => 'translate( calc($/2), 0 )',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'transform',
					'selector'=> "{{wrapper}} .blog56__sep__line",
					'value_pattern' => 'translate( calc($/2), 0 )',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'transform',
					'selector'=> "{{wrapper}} .blog56__sep__line",
					'value_pattern' => 'translate( calc($/2), 0 )',
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

				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--grid",
					'use' => 'desktop',
					'unit' => 'px',
				],
				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--grid",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--grid",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],

				[
					'property' => 'margin-top',
					'selector' => "{{wrapper}} .row56__col + .row56__col",
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

				/**
				 * BLOG LIST
				 */
				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--list",
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--list",
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'property' => 'row-gap',
					'selector' => "{{wrapper}} .blog56--list",
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			],
			
		];

		$fields = array_merge( $fields, fox56_builder_component_spacing_options() ) ;
		$fields = array_merge( $fields, fox56_builder_border_options() ) ;
		
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

			'section' => 'thumbnail',
			'section_name' => 'Thumbnail',
		];

		/*
		$fields[ 'thumbnail_position' ] = [
			'type' => 'radio',
			'title' => 'Post list: thumbnail position',
			'std' => 'left',
			'options' => [
				'left' => 'Left',
				'right' => 'Right',
				'alternative' => 'Alternative',
			],
		];
		*/

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
		// $fields = array_merge( $fields, fox56_builder_excerpt_options() );
		$fields = array_merge( $fields, fox56_builder_meta_options() );
		$fields = array_merge( $fields, fox56_builder_color_options() );

		$typo_fields = fox56_builder_typography_options();
		unset( $typo_fields['title_typography'] );
		unset( $typo_fields['excerpt_typography'] );
		$typo_fields['more_typography']['section'] = 'typography';
		$typo_fields['more_typography']['section_name'] = 'Typography';
		$fields = array_merge( $fields, $typo_fields );

		return $fields;

	}

	function render( $args ) {
		$query = fox56_builder_query( $args );
		if ( ! $query ) {
			return;
		}
		$args['layout'] = 'group';

		// @todo63
		$args[ 'thumbnail_text_gap' ] = [ 'desktop' => 12, 'tablet' => 10, 'mobile' => 8 ];
		$args[ 'thumbnail_width_type' ] = 'pixel';
		$args[ 'thumbnail_position' ] = 'right';

		fox56_blog_group( $query, $args );
	}

}