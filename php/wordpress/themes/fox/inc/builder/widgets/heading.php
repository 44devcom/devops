<?php
class Fox56_Builder_Heading extends Fox56_Builder_Widget_Base {

    public function get_name() {
		return 'heading';
	}

	public function get_title() {
		return 'Heading';
	}

	public function get_icon() {
		return 'heading';
	}

	public function get_preview_image_url() {
		return get_template_directory_uri() . '/inc/builder/images/heading.jpg';
	}

	function fields() {

		global $fox56_customize;
		$fields = [];
		
		$fields[ 'heading' ] = [
			'type' => 'text',
			'name' => 'Heading',
			'std' => 'My Heading',
			'placeholder' => 'My section',
		
			'section' => 'heading',
			'section_name' => 'Heading',
		];
		
		$fields[ 'heading_empty' ] = [
			'type' => 'checkbox',
			'name' => 'Empty heading?',
			'desc' => 'This option allows you to enable an empty heading but still keep its decoration (ie. lines)',
		];
		
		$fields[ 'heading_style' ] = [
			'type' => 'select',
			'name' => 'Style',
			'options' => [
				'plain' => 'Plain',
				'border-top' => 'Border top',
				'border-bottom' => 'Border bottom',
				'middle-line' => 'Line middle',
				'border-around' => 'Border around',
				'diagonal-stripe' => 'Diagonal Stripe',
				'pixelate-dots' => 'Pixelate dots',
			],
			'std' => 'middle-line',
		
			'inner_tabs' => 'heading',
			'inner_tab' => 'heading',
		];
		
		$fields[ 'heading_padding' ] = [
			'type' => 'group',
			'name' => 'Padding',
			'fields' => [
				'desktop' => [
					'type' => 'text',
					'name' => 'Desktop',
					'col' => '1-3',
				],
				'tablet' => [
					'type' => 'text',
					'name' => 'Tablet',
					'col' => '1-3',
				],
				'mobile' => [
					'type' => 'text',
					'name' => 'Mobile',
					'col' => '1-3',
				],
			],
			'css' => [
				[
					'selector' => '{{wrapper}}.heading56',
					'property' => 'padding',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.heading56',
					'property' => 'height',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.heading56',
					'property' => 'height',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			],
			'std' => [
				'desktop' => '',
				'tablet' => '',
				'mobile' => '',
			]
		];
		
		$fields[ 'heading_border_width' ] = [
			'type' => 'group',
			'name' => 'Border thickness',
			'fields' => [
				'desktop' => [
					'type' => 'number',
					'name' => 'Desktop',
					'col' => '2-5',
					'max' => 50,
				],
				'tablet' => [
					'type' => 'number',
					'name' => 'Tablet',
					'col' => '2-5',
					'max' => 50,
				],
				'mobile' => [
					'type' => 'number',
					'name' => 'Mobile',
					'col' => '1-5',
					'max' => 50,
				],
			],
			'std' => [
				'desktop' => 3,
				'tablet' => 2,
				'mobile' => 2,
			],
			'css' => [
		
				/**
				 * MIDDLE LINE
				 */
				[
					'selector' => '{{wrapper}}.heading56--middle-line .heading56__line',
					'property' => 'height',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.heading56--middle-line .heading56__line',
					'property' => 'height',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.heading56--middle-line .heading56__line',
					'property' => 'height',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
		
				/**
				 * BORDER TOP
				 */
				[
					'selector' => '{{wrapper}}.heading56--border-top',
					'property' => 'border-top-width',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.heading56--border-top',
					'property' => 'border-top-width',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.heading56--border-top',
					'property' => 'border-top-width',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
		
				/**
				 * BORDER BOTTOM
				 */
				[
					'selector' => '{{wrapper}}.heading56--border-bottom',
					'property' => 'border-bottom-width',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.heading56--border-bottom',
					'property' => 'border-bottom-width',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.heading56--border-bottom',
					'property' => 'border-bottom-width',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
		
				/**
				 * BORDER AROUND
				 */
				[
					'selector' => '{{wrapper}}.heading56--border-around .heading56__text',
					'property' => 'border-width',
					'unit' => 'px',
					'use' => 'desktop',
				],
				[
					'selector' => '{{wrapper}}.heading56--border-around .heading56__text',
					'property' => 'border-width',
					'unit' => 'px',
					'use' => 'tablet',
					'media_query' => $fox56_customize->tablet,
				],
				[
					'selector' => '{{wrapper}}.heading56--border-around .heading56__text',
					'property' => 'border-width',
					'unit' => 'px',
					'use' => 'mobile',
					'media_query' => $fox56_customize->mobile,
				],
			]
		];
		
		$fields[ 'heading_stretch' ] = [
			'type' => 'radio',
			'name' => 'Stretch',
			'options' => [
				'half' => 'Half',
				'content' => 'Content',
				'full' => 'Full',
			],
			'std' => 'content',
		];
		
		$fields[ 'heading_align' ] = [
			'type' => 'radio',
			'name' => 'Align',
			'options' => [
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			],
			'std' => 'center',
		];
		
		$fields[ 'heading_typography' ] = [
			'type' => 'group',
			'name' => 'Typography',
			'fields' => $fox56_customize->typo_fields,
        	'css' => fox56_builder_typo_css( '{{wrapper}}.heading56', false ),
		];
		
		$fields[ 'heading_color' ] = [
			'type' => 'color',
			'name' => 'Color',
			'css' => [
				[
					'selector' => '{{wrapper}}.heading56',
					'property' => 'color',
				]
			]
		];
		
		$fields[ 'heading_line_color' ] = [
			'type' => 'color',
			'name' => 'Line Color',
			'css' => [
				// the middle line style
				[
					'selector' => '{{wrapper}}.heading56--middle-line .heading56__line',
					'property' => 'background-color',
				],
		
				// the border top, left
				[
					'selector' => '{{wrapper}}.heading56--border-top, {{wrapper}}.heading56--border-bottom',
					'property' => 'border-color',
				],
		
				// the border around
				[
					'selector' => '{{wrapper}}.heading56--border-around .heading56__text',
					'property' => 'border-color',
				],
			],
		];
		
		/**
		 * LINK
		 */
		$fields[ 'heading_link' ] = [
			'type' => 'group',
			'name' => 'Heading URL',
			'fields' => [
				'url' => [
					'name' => 'Link',
					'type' => 'text',
					'placeholder' => 'https://',
					'col' => '2-3',
				],
				'target' => [
					'name' => 'Target',
					'type' => 'select',
					'options' => [
						'_self' => 'Same tab',
						'_blank' => 'New tab',
					],
					'std' => '_blank',
					'col' => '1-3',
				],
			],
			'std' => [
				'url' => '',
				'target' => '_self',
			],

			'section' => 'link',
			'section_name' => 'Link',
		];
		
		$fields[ 'heading_link_position' ] = [
			'type' => 'radio',
			'name' => 'Link position',
			'options' => [
				'inheading' => 'In heading',
				'separated' => 'Separated',
			],
			'std' => 'inheading',
		];
		
		$fields[ 'heading_link_text' ] = [
			'type' => 'text',
			'placeholder' => 'View all >>',
			'name' => 'Link text',
			'desc' => 'In case you use separated link',
		];
		
		$fields[ 'heading_link_color' ] = [
			'type' => 'color',
			'name' => 'Link color',
			'css' => [
				[
					'selector' => '{{wrapper}} + .heading56__link--separated',
					'property' => 'color',
				],
			],
		];

		return $fields;
	}

	function render( $args ) {
		
		extract( wp_parse_args( $args, [
			'widget_id' => '',
			'heading' => 'My Heading',
			'heading_empty' => false,
			'heading_style' => 'middle-line',
			'heading_stretch' => 'content',
			'heading_align' => 'center',
			'heading_link' => [],
			'heading_link_position' => 'inheading',
			'heading_link_text' => '',
		] ) );
	
		if ( ! $heading && ! $heading_empty ) {
			return;
		}
		if ( $heading_empty ) {
			$heading = '';
		}
		if ( function_exists( 'pll__' ) ) {
			$heading = pll__( $heading );
		}
		
		$cl = [ 'heading56', 'section56__heading', $widget_id ];
	
		/**
		 * STYLE
		 */
		if ( $heading_style ) {
			$cl[] = 'heading56--' . $heading_style;
		}
		if ( in_array( $heading_style, [ 'middle-line', 'pixelate-dots', 'diagonal-stripe' ] ) ) {
			$cl[] = 'heading56--decorate-middle';
		}
	
		/**
		 * STRETCH
		 */
		if ( ! in_array( $heading_stretch, [ 'half', 'full' ] ) ) {
			$heading_stretch = 'content';
		}
		$cl[] = 'heading56--stretch-' . $heading_stretch;
	
		/**
		 * ALIGN
		 */
		if ( 'left' != $heading_align && 'right' != $heading_align ) {
			$heading_align = 'center';
		}
		$cl[] = 'heading56--' . $heading_align;
	
		/**
		 * LINK
		 */
		extract( wp_parse_args( $heading_link, [ 'url' => '', 'target' => '_self' ] ) );
		$a = ''; $a_close = '';
		$a_cl = [ 'heading56__link' ];
		if ( 'separated' != $heading_link_position ) {
			$heading_link_position = 'inheading';
		}
		$a_cl[] = 'heading56__link--' . $heading_link_position;
		if ( $url ) {
			if ( function_exists( 'pll__' )) {
				$url = pll__( $url );
			}
			$a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '" class="' . esc_attr( join( ' ', $a_cl ) ) . '">';
			$a_close = '</a>';
		}
		$separated_link = '';
		if ( 'inheading' != $heading_link_position ) {
			if ( ! $heading_link_text ) {
				$heading_link_text = esc_html__( 'View', 'wi' );
			}
			if ( function_exists( 'pll__' )) {
				$heading_link_text = pll__( $heading_link_text );
			}
			if ( $a && $a_close ) {
				$separated_link = $a . $heading_link_text . $a_close;
			}
		}
		?>
	<div class="heading56__wrapper">    
		<h2 class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
			<?php if ( 'inheading' == $heading_link_position ) { echo $a; } ?>
			<?php echo '<span class="heading56__text">'
				 . $heading . 
				'<span class="heading56__line heading56__line--left"></span>
				<span class="heading56__line heading56__line--right"></span>
			</span>'; ?>
			<?php if ( 'inheading' == $heading_link_position ) { echo $a_close; } ?>
		</h2>
		<?php echo $separated_link; ?>
	</div>
		<?php

	}

}