<?php
/**
 * Spicy Gallery Widget.
 *
 * @since 1.0.0
 */
class spicy_Gallery_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Gallery widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Gallery';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Gallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Gallery', 'spicy' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Gallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

    protected function register_controls_Classic_gallery(){
		$this->add_control(
			'spicy_images',
			[
				'label' => __( 'Add Images', 'spicy' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'separator' => 'default',
				'show_label' => false,
				'condition' => [
					'spicy_skin' => 'classic',
				],
				'dynamic' => [
					'active' => true,
					]
			]
		);
	}

	protected function register_controls_column_gap(){
		$this->add_responsive_control(
			'spicy_column_gap',
			[
				'label' => __( 'Column Gap', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%','em', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0.5,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-gallery' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	protected function register_controls_row_gap(){
		$this->add_responsive_control(
			'spicy_row_gap',
			[
				'label' => __( 'row Gap', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','em','%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-gallery' => ' grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	protected function register_controls_column_number(){
		$this->add_responsive_control(
			'spicy_columns',
			[
				'label' => __( 'Columns', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 3,
				'options' => ['1'=>1,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => '',
				],
				'tablet_default' => [
					'size' => '',
				],
				'mobile_default' => [
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .spicy-gallery' => 'grid-template-columns: repeat({{SIZE}},1fr);',
				],
			]
			
			);
	}

	protected function register_controls_pro_repeater(){
		$repeater = new \Elementor\Repeater();
		//add pro image control
		$repeater->add_control(
				'spicy_pro_image',
				[
					'label' => __( 'Choose Image', 'spicy' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
		);
		//add pro text control
		$repeater->add_control(
			'spicy_pro_text',
			[
				'label' => __( 'Text', 'spicy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Your Text', 'spicy' ),
				'default' => __( '', 'spicy' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		//add avatar image control
		$repeater->add_control(
			'spicy_pro_avatar',
			[
				'label' => __( 'Choose Avatar', 'spicy' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
	    );
		//pro textarea 
		$repeater->add_control(
			'spicy_pro_description',
			[
				'label' => __( 'Description', 'spicy' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( '', 'spicy' ),
				'placeholder' => __( 'Type your description here', 'spicy' ),
			]
		);

		//add repeatr control
		$this->add_control(
			'spicy_image_list',
			[
				'label' => __('Images','spicy'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'label_block' => true,
				'separator' => 'default',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{spicy_pro_text }}}',
				'condition' => [
					'spicy_skin' => 'pro',
				],
			]
		);
	}

	protected function register_controls_skin(){
		$this->add_control(
			'spicy_skin',
			[
				'label' => __( 'Skin', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'classic' => __( 'Classic', 'spicy' ),
					'pro' => __( 'Pro', 'spicy' ),
				],
				'default' => 'classic',
				
			]
		);
	}

	protected function register_controls_classic_style_image(){
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Image', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'classic'
				]
			]
		);
		//classic height image control
		$this->add_responsive_control(
			'spicy_height',
			[
				'label' => __( 'Height', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'after',
				'size_units' => [ 'px','vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px', 
					'size' => 150,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//image fitness classic
		$this->add_responsive_control(
			'spicy_image_fitness',
			[
				'label' => __( 'Image Size Behavior', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => ['cover'=> __( 'Cover', 'spicy' ),'fill'=>__( 'Fit', 'spicy' ),'contain'=>__( 'Contain', 'spicy' ),'scale-down'=>__( 'Scale Down', 'spicy' ),'none'=>__( 'None', 'spicy' )],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'val' => '',
				],
				'tablet_default' => [
					'val' => '',
				],
				'mobile_default' => [
					'val' => '',
				],
				'default' => 'cover',
				'selectors' => [
					'{{WRAPPER}} .spicy-img' => 'object-fit: {{val}};',
				],
			]
			
			);
		//border classic	
		$this->add_group_control(
			Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'spicy_border',
				'label' => __( 'Border', 'spicy' ),
				'selector' => '{{WRAPPER}} .spicy-img',
			]
		);
		//border radius classic 
		$this->add_responsive_control(
			'spicy_image_border_radius',
			[
				'label' => __( 'Border Radius', 'spicy' ),
				'type' => 'spicy-multi-unit-control',
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-img' => 'border-radius: {{TOP}}{{TOP_UNIT}} {{RIGHT}}{{RIGHT_UNIT}} {{BOTTOM}}{{BOTTOM_UNIT}} {{LEFT}}{{LEFT_UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		

	}

	protected function register_controls_pro_item(){
	    $this->start_controls_section(
			'spicy_pro_item',
			[
				'label' => __( 'Item', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'pro'
				]
			]
		);
		// pro item border
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'spicy_item_border',
				'label' => __( 'Border', 'spicy' ),
				'selector' => '{{WRAPPER}} .spicy-item',
			]
		);	
		//pro item border radius
		$this->add_responsive_control(
			'spicy_pro_item_border_radius',
			[
				'label' => __( 'Border Radius', 'spicy' ),
				'type' => Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls_pro_style_image(){
		$this->start_controls_section(
			'spicy_pro_style_image',
			[
				'label' => __( 'Image', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'pro'
				]
			]
		);
		//pro image size
		$this->add_responsive_control(
			'spicy_pro_image_height',
			[
				'label' => __( 'height', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','em','vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
						'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-img' => ' height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//pro image fitness
		$this->add_responsive_control(
			'spicy_pro_image_fitness',
			[
				'label' => __( 'Image Size Behavior', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => ['cover'=> __( 'Cover', 'spicy' ),'fill'=>__( 'Fill', 'spicy' ),'contain'=>__( 'Contain', 'spicy' ),'scale-down'=>__( 'Scale Down', 'spicy' ),'none'=>__( 'None', 'spicy' )],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'val' => '',
				],
				'tablet_default' => [
					'val' => '',
				],
				'mobile_default' => [
					'val' => '',
				],
				'default' => 'cover',
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-img' => 'object-fit: {{val}};',
				],
			]
			
			);
		$this->end_controls_section();
		
	}

	protected function register_controls_pro_style_text(){
		$this->start_controls_section(
			'spicy_pro_style_text',
			[
				'label' => __( 'Text', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'pro'
				]
			]
		);

		//pro text color control
		$this->add_control(
			'spicy_pro_text_color',
			[
				'label' => __( 'Color', 'spicy' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		//pro text typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'spicy_pro_text_typography',
				'selector' => '{{WRAPPER}} .spicy-pro-text',
				 'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		//pro text alignment
		$this->add_responsive_control(
			'spicy_pro_text-_align',
			[
				'label' => __( 'Alignment', 'spicy' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spicy' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'spicy' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spicy' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'spicy' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' =>'',
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-text' => 'text-align: {{VALUE}};',
				],
			]
		);
		//pro text spacing control
		$this->add_responsive_control(
			'spicy_text_margin',
			[
				'label' => __( 'Spacing', 'spicy' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls_pro_style_avatar(){
		$this->start_controls_section(
			'spicy_pro_style_avatar',
			[
				'label' => __( 'Avatar', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'pro'
				]
			]
		);
		//pro avatar height
		$this->add_responsive_control(
			'spicy_avatar_height',
			[
				'label' => __( 'height', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','em','vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-avatar' => ' height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//pro avatar width
		$this->add_responsive_control(
			'spicy_avatar_width',
			[
				'label' => __( 'Width', 'spicy' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','em','vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .spicy-avatar' => ' width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//pro avatar align control
		$this->add_responsive_control(
			'spicy_avatar_align',
			[
				'label' => __( 'Alignment', 'spicy' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spicy' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'spicy' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spicy' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .spicy-avatar-wrapper' => ' text-align: {{VALUE}};',
				],
			]
		);
		//pro avatar spacing control
		$this->add_responsive_control(
			'spicy_avatar_spacing',
			[
				'label' => __( 'Spacing', 'spicy' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//pro border avatar
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'spicy_avatar_border',
				'label' => __( 'Border', 'spicy' ),
				'selector' => '{{WRAPPER}} .spicy-avatar',
			]
		);
		//pro border radius 
		$this->add_responsive_control(
			'spicy_pro_border_radius',
			[
				'label' => __( 'Border Radius', 'spicy' ),
				'type' => Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls_pro_style_textarea(){
		$this->start_controls_section(
			'spicy_pro_style_textarea',
			[
				'label' => __( 'Textarea', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'=>[
					'spicy_skin' => 'pro'
				]
			]
		);
		//pro textarea color control
		$this->add_control(
			'spicy_pro_textarea-color',
			[
				'label' => __( 'Color', 'spicy' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);
		//pro texrarea typography control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'spicy_pro_textarea_typography',
				'selector' => '{{WRAPPER}} .spicy-pro-description',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		//pro textarea align control
		$this->add_responsive_control(
			'spicy_pro_textarea-align',
			[
				'label' => __( 'Alignment', 'spicy' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spicy' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'spicy' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spicy' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'spicy' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' =>'',
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-description' => 'text-align: {{VALUE}};',
				],
			]
		);
		//pro textarea spacing control
		$this->add_responsive_control(
			'spicy_textarea_spacing',
			[
				'label' => __( 'Spacing', 'spicy' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spicy-pro-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls_style_boxshadow(){
		$this->start_controls_section(
			'spicy_box_shadow',
			[
				'label' => __( 'Box Shadow', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
		 Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'spicy' ),
				'selector' => '{{WRAPPER}} .spicy-item',
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls_style_hoveranimation(){
		$this->start_controls_section(
			'spicy_hover',
			[
				'label' => __( 'Hover Animation', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'spicyhover',
			[
				'label' => __( 'Hover Animation', 'spicy' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'default'=>'',
			]
			
		);
		$this->end_controls_section();
	}
	/**
	 * Register Gallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

	//	start Content tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'spicy' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//add skin control
		$this->register_controls_skin();

		//add repeater for pro skin
		$this->register_controls_pro_repeater();

		//add gallery control
		$this->register_controls_Classic_gallery();

		//add column-gap slider
		$this->register_controls_column_gap();

		//add row-gap slider
		$this->register_controls_row_gap();

		//add columns number list
		$this->register_controls_column_number();

		$this->end_controls_section();
		// end content tab

		//start Style tab
		$this->register_controls_classic_style_image();

		//create pro item section
		$this->register_controls_pro_item();

		 //create pro style section-image
		$this->register_controls_pro_style_image();

		 //create pro style section-text
		$this->register_controls_pro_style_text();

		 //create pro style section-avatar
		$this->register_controls_pro_style_avatar();

		 //create pro style section-textarea
		$this->register_controls_pro_style_textarea();

		 //Box Shadow
		$this->register_controls_style_boxshadow();

		//hover animation
		$this->register_controls_style_hoveranimation();
		 //end style tab
	}

	/**
	 * Render Gallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	    
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="spicy-gallery" width="100%">
		<?php
	   
		if($settings['spicy_skin']=='classic'){
			$this->classic_render($settings);
		}else{
			$this->pro_render($settings);
		}
		?>
		</div>
		
		<?php
	}	
	/**
	 * Render Gallery widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="spicy-gallery">
		<#
		console.log(settings);
		if(settings.spicy_skin=='classic'){
		_.each( settings.spicy_images, function( image ) {
			 #>
		 <div class="spicy-item elementor-animation-{{settings.spicyhover}}">
		 <img  class="spicy-img" id="{{image.id}}" src="{{image.url}}"/>
		</div>
		<# }); } else{
			_.each( settings.spicy_image_list, function( image ) {
			#>
			<div class="spicy-item elementor-animation-{{settings.spicyhover}}">	
			 <div class="spicy-pro-container">
				<img class="spicy-pro-img" src="{{image.spicy_pro_image.url}}" >
			 </div>
				<p class="spicy-pro-text">{{image.spicy_pro_text}}</p>
				<div class="spicy-avatar-wrapper">
				   <img class="spicy-avatar" src="{{image.spicy_pro_avatar.url}}" alt="Avatar">
				</div>
				<p class="spicy-pro-description">{{image.spicy_pro_description}}</p>
			</div> 
		<# }); }#>
		</div>
		<?php
	}

	protected function classic_render($settings){
		if($settings['spicy_images']){
			foreach ( $settings['spicy_images'] as $image ) {
			   echo '<div class="spicy-item elementor-animation-' . $settings['spicyhover'] .' ">';
				echo '<img id="'. $image['id'].'" class="spicy-img" src="' . $image['url'] . '">';
				echo '</div>';
			}
		 }	
	}
	protected function pro_render($settings){
		if($settings['spicy_image_list']){
			foreach ( $settings['spicy_image_list'] as $image ) {
					echo '<div class="spicy-item elementor-animation-' . $settings['spicyhover'] .' ">';
					echo '<div class="spicy-pro-container">';	
						echo '<img class="spicy-pro-img" src="'.$image['spicy_pro_image']['url'].'" >';		
					echo '</div>';	
					echo '<p class="spicy-pro-text">'.$image['spicy_pro_text'].'</p>';
					echo'<div class="spicy-avatar-wrapper">';
						echo '<img class="spicy-avatar" src="'.$image['spicy_pro_avatar']['url'].'" alt="Avatar">';
					echo'</div>';
					echo '<p class="spicy-pro-description">'.$image['spicy_pro_description'].'</p>';
					
					
				echo '</div>';
			}
		}
	}
}?>
