<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor image box widget.
 *
 * Elementor widget that displays an image, a headline and a text.
 *
 * @since 1.0.0
 */
class Widget_Image_Box_With_Button extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve image box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'qrx-image-box-with-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Image Box With Button', QRXEW_TXT_DOMAIN );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-box';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'qrx', 'image', 'photo', 'visual', 'box' ];
	}

	/**
	 * Register image box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image Box', QRXEW_TXT_DOMAIN ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Title & Description', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'This is the heading', QRXEW_TXT_DOMAIN ),
				'placeholder' => esc_html__( 'Enter your title', QRXEW_TXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => esc_html__( 'Content', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', QRXEW_TXT_DOMAIN ),
				'placeholder' => esc_html__( 'Enter your description', QRXEW_TXT_DOMAIN ),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => false,
			]
		);

		$this->add_control(
			'position',
			[
				'label' => esc_html__( 'Image Position', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Title HTML Tag', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'View', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', QRXEW_TXT_DOMAIN ),
				'separator' => 'before',
			]
		);
		

		$this->add_control(
			'enable_image_link',
			[
				'label' => esc_html__( 'Enable Image Link', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', QRXEW_TXT_DOMAIN ),
				'label_off' => esc_html__( 'No', QRXEW_TXT_DOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'enable_title_link',
			[
				'label' => esc_html__( 'Enable Title Link', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', QRXEW_TXT_DOMAIN ),
				'label_off' => esc_html__( 'No', QRXEW_TXT_DOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'enable_button_link',
			[
				'label' => esc_html__( 'Enable Button Link', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', QRXEW_TXT_DOMAIN ),
				'label_off' => esc_html__( 'No', QRXEW_TXT_DOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Me', QRXEW_TXT_DOMAIN ),
				'placeholder' => esc_html__( 'Button Text', QRXEW_TXT_DOMAIN ),
				'condition' 	=> [
					'enable_button_link' => 'yes'
				]
			]
		);

		$this->end_controls_section();


		// STYLE TAB
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', QRXEW_TXT_DOMAIN ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => esc_html__( 'Spacing', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Width', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'image_maxwidth',
			[
				'label' => esc_html__( 'Max Width', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'default' => [
					'size' => '',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image-box-img img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', QRXEW_TXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .elementor-image-box-img img',
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => esc_html__( 'Opacity', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-img img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', QRXEW_TXT_DOMAIN ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}}:hover .elementor-image-box-img img',
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-image-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', QRXEW_TXT_DOMAIN ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', QRXEW_TXT_DOMAIN ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => esc_html__( 'Vertical Alignment', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', QRXEW_TXT_DOMAIN ),
					'middle' => esc_html__( 'Middle', QRXEW_TXT_DOMAIN ),
					'bottom' => esc_html__( 'Bottom', QRXEW_TXT_DOMAIN ),
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__( 'Spacing', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-image-box-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_stroke',
				'selector' => '{{WRAPPER}} .elementor-image-box-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-image-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-image-box-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .elementor-image-box-description',
			]
		);

		// Button css
		$this->add_control(
			'heading_button',
			[
				'label' => esc_html__( 'Button', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'enable_button_link' => 'yes'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);


		$this->add_responsive_control(
			'button_padding', 
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// start of control tabs
		$this->start_controls_tabs(
			'button_style_tabs'
		);


        $this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', QRXEW_TXT_DOMAIN ),
			]
		);


		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Text Color', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'types' => [ 'classic', 'gradient', 'image' ],
				'selector' => '{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', QRXEW_TXT_DOMAIN ),
			]
		);

        // Hover Button Color Control
        $this->add_control(
            'hover_button_color',
            [
                'label' => esc_html__( 'Text Color', QRXEW_TXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button:hover' => 'color: {{VALUE}}',
                ],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'hover_button_bg',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button:hover',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'default' => Global_Colors::COLOR_ACCENT,
						],
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'button_border_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button:hover, {{WRAPPER}} .qrx-image-box-button .qrx-elementor-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		// end of control tabs
		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .qrx-image-box-button .qrx-elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_section();
	}

	/**
	 * Get Style dependencies for this widget
	 */
	public function get_style_depends(){
		return [QRXEW_TXT_DOMAIN .'-style'];
	}

	/**
	 * Render image box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        // load css 
        // wp_enqueue_style( QRXEW_TXT_DOMAIN.'-style' );
        
		$settings = $this->get_settings_for_display();

		$has_content = ! \Elementor\Utils::is_empty( $settings['title_text'] ) || ! \Elementor\Utils::is_empty( $settings['description_text'] );

		$html = '<div class="elementor-image-box-wrapper '. $this->get_name() .'">';

		if ( ! empty( $settings['link']['url'] ) && $settings['enable_image_link'] === 'yes' ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( ! empty( $settings['image']['url'] ) ) {

			$image_html = wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );

			if ( ! empty( $settings['link']['url'] ) ) {
				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			}

			$html .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
		}

		if ( $has_content ) {
			$html .= '<div class="elementor-image-box-content">';

			if ( ! \Elementor\Utils::is_empty( $settings['title_text'] ) ) {
				$this->add_render_attribute( 'title_text', 'class', 'elementor-image-box-title' );

				$this->add_inline_editing_attributes( 'title_text', 'none' );

				$title_html = $settings['title_text'];

				if ( ! empty( $settings['link']['url'] ) && $settings['enable_title_link'] === 'yes' ) {
					$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
				}

				$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $title_html );
			}

			if ( ! \Elementor\Utils::is_empty( $settings['description_text'] ) ) {
				$this->add_render_attribute( 'description_text', 'class', 'elementor-image-box-description' );

				$this->add_inline_editing_attributes( 'description_text' );

				$html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
			}

			if( ! empty( $settings['link']['url'] ) && $settings['enable_button_link'] === 'yes' &&  ! \Elementor\Utils::is_empty( $settings['button_text'] )){
				$html .= sprintf('<p class="qrx-image-box-button"><a class="elementor-button qrx-elementor-button" role="button" %s >%s</a></p>', 'href="'. esc_attr( $settings['link']['url'] ) .'"' , $settings['button_text']);
			}

			$html .= '</div>';
		}

		$html .= '</div>';

		\Elementor\Utils::print_unescaped_internal_string( $html );
	}

}
