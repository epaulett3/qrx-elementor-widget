<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No access of directly access.
}

class Elementor_Woo_ProdCat_List_Widget extends \Elementor\Widget_Base {

 /**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'qrx-woo-prodcat-list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Woocommerce Category List', QRXEW_TXT_DOMAIN );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'qrx', 'product', 'category', 'list' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

        // CONTENT TAB

        $this->start_controls_section(
            'title_section',
            [
                'label'     => esc_html('Title', QRXEW_TXT_DOMAIN),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
                'label_block' => true,
				'placeholder' => esc_html__( 'Type your title here', QRXEW_TXT_DOMAIN ),
                'description'  => esc_html( 'Leave empty to hide the title.', QRXEW_TXT_DOMAIN )
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', QRXEW_TXT_DOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        // Hide empty categories control
        $this->add_control(
            'hide_empty_cat',
            [
                'label'     => esc_html( 'Hide empty categories', QRXEW_TXT_DOMAIN ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html( 'Show', QRXEW_TXT_DOMAIN ),
                'label_off' => esc_html( 'Hide', QRXEW_TXT_DOMAIN ),
                'return_value' => 'yes',
                'default'   => 'yes',

                
            ]
        );

        // Product Count Control
        $this->add_control(
            'show_prod_count',
            [
                'label'     => esc_html( 'Show Product Count', QRXEW_TXT_DOMAIN ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html( 'Show', QRXEW_TXT_DOMAIN ),
                'label_off' => esc_html( 'Hide', QRXEW_TXT_DOMAIN ),
                'return_value' => 'yes',
                'default'   => 'yes',

                
            ]
        );

        // Enable Category Link control
        $this->add_control(
            'enable_category_link',
            [
                'label'     => esc_html( 'Enable category link?', QRXEW_TXT_DOMAIN ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html( 'yes', QRXEW_TXT_DOMAIN ),
                'label_off' => esc_html( 'no', QRXEW_TXT_DOMAIN ),
                'return_value' => 'yes',
                'default'   => 'no',

                
            ]
        );

        // Display Categories in Hierarchical way
        $this->add_control(
            'enable_category_hierarchy',
            [
                'label'     => esc_html( 'Display cateories in Hierarchical way?', QRXEW_TXT_DOMAIN ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => esc_html( 'yes', QRXEW_TXT_DOMAIN ),
                'label_off' => esc_html( 'no', QRXEW_TXT_DOMAIN ),
                'return_value' => 'yes',
                'default'   => 'no',

                
            ]
        );

        // Exclude Product Categories Control
        $this->add_control(
			'exclude_prodcat_list',
			[
				'label' => esc_html__( 'Exclude Product categories', QRXEW_TXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->getExcludeProductCatgories(),
				'default' => [ ],
			]
		);


		$this->end_controls_section();

        // STYLE TAB

        // Title Section
        $this->start_controls_section(
            'title_style_section',
            [
                'label'     => esc_html( 'Title', QRXEW_TXT_DOMAIN ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );        

        // Title Color Control
        $this->add_control(
            'title_style_color',
            [
                'label' => esc_html__( 'Title Color', QRXEW_TXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qrx-elementor-widget .qrx-prodcat-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .qrx-elementor-widget .qrx-prodcat-title',
			]
		);

        // Title Margin Control
        // $this->add_control(
		// 	'title_margin',
		// 	[
		// 		'label' => esc_html__( 'Margin', QRXEW_TXT_DOMAIN ),
		// 		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .qrx-elementor-widget .qrx-prodcat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

        // Title Margin Responsive Control
        $this->add_responsive_control(
            'title_margin', 
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Margin', 'textdomain' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .qrx-elementor-widget .qrx-prodcat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
        
        $this->end_controls_section();


        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Content', QRXEW_TXT_DOMAIN ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
			'text_style_tabs'
		);

        $this->start_controls_tab(
			'text_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', QRXEW_TXT_DOMAIN ),
			]
		);

        // Text Color Control
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', QRXEW_TXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item > .qrx-prodcat-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Typography Control
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item > .qrx-prodcat-label',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'text_style_active_tab',
			[
				'label' => esc_html__( 'Active', QRXEW_TXT_DOMAIN ),
			]
		);

        // Active Category Color Control
        $this->add_control(
            'active_category_color',
            [
                'label' => esc_html__( 'Text Color', QRXEW_TXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item.qrx-prodcat-active > .qrx-prodcat-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Typography Control
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'active_category_typography',
                'label' => esc_html( 'Typography', QRXEW_TXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item.qrx-prodcat-active > .qrx-prodcat-label',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
			'text_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', QRXEW_TXT_DOMAIN ),
			]
		);

        // Hover Text Color Control
        $this->add_control(
            'hover_text_color',
            [
                'label' => esc_html__( 'Text Color', QRXEW_TXT_DOMAIN ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item:hover > .qrx-prodcat-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Hover Text Typography Control
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hover_text_typography',
                'label' => esc_html( 'Typography', QRXEW_TXT_DOMAIN ),
				'selector' => '{{WRAPPER}} .qrx-prodcat-items .qrx-prodcat-item:hover > .qrx-prodcat-label',
			]
		);

        $this->end_controls_tab();


        $this->end_controls_tab();



        $this->end_controls_section();

	}

    /**
     * Get Woocommerce Product Categories,
     * 
     */
    private function getProductCategories($args = []){

        // $set_hide_empty = filter_var($hide_empty, FILTER_VALIDATE_BOOLEAN);

        $default_args = array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'taxonomy' => 'product_cat',
        );
        $args = wp_parse_args( $args, $default_args );
        
        $product_categories = get_terms( $args );

        return $product_categories;
    }

    /**
     * Get Product Cat List for Exclude Control options
     */

    private function getExcludeProductCatgories(){
        $product_categories = $this->getProductCategories();
        $return_value = [];

        foreach($product_categories as $key => $category){
            $return_value[$category->term_id] = esc_html( $category->name, QRXEW_TXT_DOMAIN );
        }

        return $return_value;
    }

    /**
     * Check if Current page is in the product category list
     * @return integer Product Category ID
     */

    private function isProductCategory($category_id = 0){
        $queried_object = get_queried_object();
        $term_id = $queried_object !== null ? $queried_object->term_id : 0 ;

        if($term_id === $category_id){
            return true;
        } else{
            return false;
        }
    }

    /**
     * DISPLAY THE LIST OF CATEGORIES
     */
    private function display_categorylist( $categories = [], $parent_id = 0, $level = 0 ) {
        if( count($categories) == 0) return;

        $settings = $this->get_settings_for_display();
        $show_prod_count = $settings['show_prod_count'];
        $enable_category_link = $settings['enable_category_link'];
        $hide_empty_cat = $settings['hide_empty_cat'];
        $exclude_category_ids = $settings['exclude_prodcat_list'];


        $enable_category_hierarchy = filter_var($settings['enable_category_hierarchy'], FILTER_VALIDATE_BOOLEAN);
        $category_level_class = $enable_category_hierarchy ? 'qrx-prodcat-level-'.$level : '';

        ?>
        <ul class="qrx-prodcat-items <?php echo $category_level_class; ?>">
        <?php
        foreach($categories as $key => $category) {
            // if(in_array($category->term_id, $exclude_category_ids) ) continue;
            if($enable_category_hierarchy && $category->parent != $parent_id) continue;

            $category_label = $category->name . ($show_prod_count === 'yes' ? ' ('. $category->count .')' : '' );
            $category_label_html = sprintf('<span class="qrx-prodcat-label">%s</span>',  $category_label );
            if($enable_category_link === 'yes'){
                $category_label_html =  sprintf('<a class="qrx-prodcat-label" href="%s">%s</a>', esc_attr( get_term_link( $category) ), $category_label  );
                
            }
            echo '<li class="qrx-prodcat-item qrx-prodcat-'. $category->term_id .' '. ($this->isProductCategory($category->term_id) ? 'qrx-prodcat-active' : '' ) .'">'. $category_label_html;
            
            // check if hierarchy is enabled
            if($enable_category_hierarchy) {
                $sub_args = [
                    'taxonomy' => 'product_cat',
                    'hide_empty' => $hide_empty_cat,
                    'exclude' => $exclude_category_ids,
                    'hierarchical' => filter_var($enable_category_hierarchy, FILTER_VALIDATE_BOOLEAN),
                    'parent' => $category->term_id,
                ];
                $subCategories = $this->getProductCategories($sub_args);
                $nextlevel = $level++;
                $this->display_categorylist($subCategories, $category->term_id, $nextlevel);
        
            }

            echo '</li>';
        }
        ?>
        </ul>
        <?php 
        
    }


	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
        
        // get data
        $hide_empty_cat = $settings['hide_empty_cat'];
        $exclude_category_ids = $settings['exclude_prodcat_list'];
        $enable_category_hierarchy = $settings['enable_category_hierarchy'];

        $args = [
            'taxonomy' => 'product_cat',
            'hide_empty' => $hide_empty_cat,
            'exclude' => $exclude_category_ids,
            'hierarchical' => filter_var($enable_category_hierarchy, FILTER_VALIDATE_BOOLEAN),
        ];
        $productCategories = $this->getProductCategories($args);

        

        ?>
        <div class="qrx-elementor-widget <?php echo $this->get_name(); ?>"> 
            <?php
            if(!empty($settings['title'])) {
                echo '<h2 class="qrx-prodcat-title">'. $settings['title'] .'</h2>';
            }
            // display categories
            $this->display_categorylist($productCategories);
            ?>
        </div>
        <?php 

	}   

}