<?php

namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Bloglist extends \Elementor\Widget_Base {

    public function get_name() {
        return 'droit-bloglist';
    }

    public function get_title() {
        return esc_html__( 'Blog List', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-blog addons-icon';
    }

    public function get_keywords() {
        return [ 'blog', 'blogs', 'post', 'posts', 'blogs list', 'blog list', 'droit blogs list', 'droit blog list', 'dl blogs list', 'dl blog list', 'list blog', 'posts', 'post', 'posts list', 'post list', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type', 'droit blog', 'droit blogs', 'droit post', 'droit posts', 'dl blog', 'dl blogs', 'dl post', 'dl posts', 'addons', 'addon'  ];
    }

    public function get_categories() {
        return ['droit_addons'];
    }  

    public function get_script_depends()
    {
        return [];
    }

    protected function _register_controls(){
      $this->register_blog_list_preset_controls();
      $this->register_blog_list_query_controls();
      $this->register_blog_list_general_style_controls();
      $this->register_blog_list_title_style_controls();
      $this->register_blog_list_content_style_controls();
      $this->register_blog_list_author_style_controls();
      $this->register_blog_list_date_style_controls();
      $this->register_blog_list_read_more_style_controls();
      do_action('dl_widget/section/style/custom_css', $this);
    }
	
	// Get Control ID
	protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_blog_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    //Preset
    public function register_blog_list_preset_controls(){
    	$this->start_controls_section(
            '_blog_list_layout_section',
            [
                'label' => esc_html__('Preset', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                ],
            ]
        );
    	$this->register_blog_list_skin();
    	$this->register_blog_list_thumbnail_size_controls();
    	$this->register_blog_list_columns_controls();
    	$this->register_blog_list_show_hide_controls();
    	$this->register_blog_list_read_more_controls();
    	$this->register_blog_list_link_controls();
    	$this->register_blog_list_meta_data_controls();
        
        $this->end_controls_section();
    }

	//Skin
	protected function register_blog_list_skin(){ 
        $this->add_control(
            '_blog_list_skin',
            [
                'label' => esc_html__( 'Design Format', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options'   => [
                    '_skin_1' => 'Style 01',
                    '_skin_2' => 'Style 02',
                    '_skin_3' => 'Style 03',
                    '_skin_4' => 'Style 04',
                ],
                'default' => '_skin_1'
            ]
        );
    }

	//Thumbnail Size
	protected function register_blog_list_thumbnail_size_controls() {
        
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => '_blog_list_thumbnail_size',
                'default' => 'full',
                'condition' => [
                	$this->get_control_id( '_blog_list_show_thumb' ) => [ 'yes' ],
                ],
            ]
        );

        $this->add_responsive_control(
            '_blog_list_image_width',
            [
                'label' => __( 'Image Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post_list__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_blog_list_image_height',
            [
                'label'      => __('Height', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__wrap .droit-post_list__thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_blog_list_object-fit',
            [
                'label' => __( 'Object Fit', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,

                'condition' => [
                    $this->get_control_id('_blog_list_image_height[size]!') => '',
                ],
                'options' => [
                    '' => __( 'Default', 'droit-addons' ),
                    'fill' => __( 'Fill', 'droit-addons' ),
                    'cover' => __( 'Cover', 'droit-addons' ),
                    'contain' => __( 'Contain', 'droit-addons' ),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-post_list__thumbnail img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
    }

    //Column
    protected function register_blog_list_columns_controls() {
        $this->add_responsive_control(
            '_blog_list_columns',
            [
                'label' => __( 'Columns', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 6,
                'tablet_default' => 6,
                'mobile_default' => 12,
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '5' => '5',
                    '2' => '6',
                ],
            ]
        );
    }

    // Show Hide
    protected function register_blog_list_show_hide_controls(){
        $this->add_control(
            '_blog_list_show_title',
            [
                'label'     => __('Title', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            '_blog_list_title_tag',
            [
                'label' => __( 'Title HTML Tag', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'droit-addons' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'droit-addons' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'droit-addons' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'droit-addons' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'droit-addons' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'droit-addons' ),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'p'  => [
                        'title' => __( 'P', 'droit-addons' ),
                        'icon' => 'eicon-editor-paragraph'
                    ],
                ],
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                            $this->get_control_id( '_blog_list_show_title' ) => 'yes',
                        ],
            ]
        );
        $this->add_control(
            '_blog_list_show_excerpt',
            [
                'label'     => __('Excerpt', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1', '_skin_4' ],
                ],
            ]
        );
        $this->add_control(
			'_blog_list_excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => apply_filters( 'excerpt_length', 70 ),
				'condition' => [
					$this->get_control_id( '_blog_list_show_excerpt' ) => 'yes',
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1', '_skin_4' ],
				],

			]
		);
        
        $this->add_control(
            '_blog_list_show_thumb',
            [
                'label'     => __('Show Thumbnail', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            '_blog_list_show_author',
            [
                'label'     => __('Show Author', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1' ],
                ],
            ]
        );
        $this->add_control(
            '_blog_list_show_author_image',
            [
                'label'     => __('Show Author Image', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'condition' => [
					$this->get_control_id( '_blog_list_show_author' ) => 'yes',
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1' ],
				],
            ]
        );
        $this->add_control(
            '_blog_list_default_author_image', [
                'label'      => __('Default Auth', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'default'    => [
                    'url' => '',
                ],
                'show_label' => true,
                'description' => __('Keep empty to display default image','droit-addons'),
                'condition' => [
					$this->get_control_id( '_blog_list_show_author' ) => 'yes',
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1' ],
				],
            ]
        );
        $this->add_control(
            '_blog_list_enable_author',
            [
                'label'     => __('Enable Author Link', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('No', 'droit-addons'),
                'label_on'  => __('Yes', 'droit-addons'),
                'condition' => [
					$this->get_control_id( '_blog_list_show_author' ) => 'yes',
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1' ],
				],
            ]
        );

        $this->add_control(
            '_blog_list_show_date',
            [
                'label'     => __('Show Date', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'separator' => 'before',
            ]
        );
    }

    // Read More
    protected function register_blog_list_read_more_controls(){
        $this->add_control(
            '_blog_list_show_read_more',
            [
                'label'     => __('Read More', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1', '_skin_4' ],
                ],
            ]
        );

        $this->add_control(
            '_blog_list_read_more_text',
            [
                'label'     => __('Read More Text', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __('Read More »', 'droit-addons'),
                'condition' => [
					$this->get_control_id( '_blog_list_show_read_more' ) => 'yes',
                    $this->get_control_id( '_blog_list_skin' ) => [ '_skin_1', '_skin_4' ],
				],
            ]
        );
    }

    //Link
    protected function register_blog_list_link_controls() {
        $this->add_control(
            '_blog_list_open_new_tab',
            [
                'label' => __( 'Open in new window', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-addons' ),
                'label_off' => __( 'No', 'droit-addons' ),
                'default' => 'no',
                'render_type' => 'none',
            ]
        );
    }

    //Query
    public function register_blog_list_query_controls(){
        $this->start_controls_section(
            '_blog_list_query_section',
            [
                'label' => esc_html__('Query', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            '_blog_list_post_type',
            [
                'label' => __( 'Source', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => \DROIT_ELEMENTOR\DL_Helper::get_post_types( [],[ 'elementor_library', 'attachment' ] ),
                'default' => 'post',
            ]
        );

        $this->add_control(
            '_blog_list_posts_per_page', [
                'label'       => esc_html__('Posts Per Page', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'droit-addons'),
                'default'     => 2,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                ],
            ]
        );

        $this->register_blog_list_order_orderby_controls();
        $this->end_controls_section();
    }

    // Order
    protected function register_blog_list_order_orderby_controls(){
        $this->add_control(
            '_blog_list_order_by',
            [
                'label'   => __('Order By', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'modified'   => __('Modified', 'droit-addons'),
                    'date'       => __('Date', 'droit-addons'),
                    'rand'       => __('Rand', 'droit-addons'),
                    'ID'         => __('ID', 'droit-addons'),
                    'title'      => __('Title', 'droit-addons'),
                    'author'     => __('Author', 'droit-addons'),
                    'name'       => __('Name', 'droit-addons'),
                    'parent'     => __('Parent', 'droit-addons'),
                    'menu_order' => __('Menu Order', 'droit-addons'),
                ],
                'separator' => 'before',
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                ],
            ]
        );
        $this->add_control(
            '_blog_list_order',
            [
                'label'   => __('Order', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase'  => __('Ascending Order', 'droit-addons'),
                    'desc' => __('Descending Order', 'droit-addons'),
                ],
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                ],
            ]
        );
        $this->add_control(
            '_blog_list_ignore_sticky_posts', [
            'label' => __( 'Ignore Sticky Posts', 'droit-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
            'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => ['page', 'by_id', 'category'],
                ],
            'description' => __( 'Sticky-posts ordering is visible on frontend only', 'droit-addons' ),
            ]
        );
    }

    // Meta Data
    protected function register_blog_list_meta_data_controls() {
		$this->add_control(
			'_blog_list_meta_data',
			[
				'label' => __( 'Meta Data', 'droit-addons' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => [ 'date' ],
				'multiple' => true,
				'options' => [
					'tag' => __( 'Tag', 'droit-addons' ),
					'category' => __( 'Category', 'droit-addons' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'_blog_list_meta_separator',
			[
				'label' => __( 'Separator Between', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '///',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta-data span + span:before' => 'content: "{{VALUE}}"',
				],
				'condition' => [
					$this->get_control_id( '_blog_list_meta_data!' ) => [],
				],
			]
		);
	}

	/* ==============Style Section==============*/

	//General
	public function register_blog_list_general_style_controls(){
		$this->start_controls_section(
            '_blog_list_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dl_bloglist_items_background',
				'label' => __( 'Background', 'droit-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post',
			]
		);
        
        $this->add_responsive_control(
			'_blog_list_align',
			[
				'label' => __( 'Alignment', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'droit-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'droit-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'droit-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'droit-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            '_blog_list_loop_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_loop_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
				'default'	=> [
					'top' => 0,
					'right' => 0,
                	'bottom' => 15,
					'left' => 0,
                	'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_blog_list_loop_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_loop_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_blog_list_loop_box_shadow',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog_list_loop_post',
            ]
        );
        
        $this->add_control(
			'dl_meta_content_options',
			[
				'label' => __( 'Meta Content Padding', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        
        $this->add_responsive_control(
            '_blog_list_items_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_blog_list_post.dl_style_03 .dl_blog_list_content_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
	}
	//Title
	public function register_blog_list_title_style_controls(){
		$this->start_controls_section(
            '_blog_list_title_section',
            [
                'label' => esc_html__('Title', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                	$this->get_control_id( '_blog_list_show_title' ) => [ 'yes' ],
                ],
            ]
        );
			$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_blog_list_title_typography',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog-list-title a',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_title_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog-list-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_title_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog-list-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_blog_list_title_header_tabs');

        $this->start_controls_tab('_blog_list_title_header_normal_tab', 
        	['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_blog_list_title_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog-list-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_blog_list_title_header_hover_tab', 
        	['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_blog_list_title_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-blog-list-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
	}

	//Content
	public function register_blog_list_content_style_controls(){
		$this->start_controls_section(
            '_blog_list_content_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                	$this->get_control_id( '_blog_list_show_excerpt' ) => [ 'yes' ],
                ],
            ]
        );
			$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_blog_list_content_typography',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_excerpt',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_content_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_blog_list_post.dl_style_01 .dl_blog_list_content_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dl_blog_list_post.dl_style_07 .dl_blog_list_content_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dl_blog_list_post.dl_style_03 .dl_blog_list_content_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_content_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_blog_list_content_header_tabs');

        $this->start_controls_tab('_blog_list_content_header_normal_tab', 
        	['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_blog_list_content_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_blog_list_content_header_hover_tab', 
        	['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_blog_list_content_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_excerpt:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
	}

	//Author
	public function register_blog_list_author_style_controls(){
		$this->start_controls_section(
            '_blog_list_author_section',
            [
                'label' => esc_html__('Author', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                	$this->get_control_id( '_blog_list_show_author' ) => [ 'yes' ],
                ],
            ]
        );
			$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_blog_list_author_typography',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_author .droit-post_list_author_name',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_author_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_author_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_blog_list_author_header_tabs');

        $this->start_controls_tab('_blog_list_author_header_normal_tab', 
        	['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_blog_list_author_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_author .droit-post_list_author_name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_blog_list_author_header_hover_tab', 
        	['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_blog_list_author_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_author .droit-post_list_author_name:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
	}
    //Date
    public function register_blog_list_date_style_controls(){
        $this->start_controls_section(
            '_blog_list_date_section',
            [
                'label' => esc_html__('Date', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                    $this->get_control_id( '_blog_list_show_date' ) => [ 'yes' ],
                ],
            ]
        );
            $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_blog_list_date_typography',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_date',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_date_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_date_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_blog_list_date_header_tabs');

        $this->start_controls_tab('_blog_list_date_header_normal_tab', 
            ['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_blog_list_date_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_blog_list_date_header_hover_tab', 
            ['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_blog_list_date_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_date:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }
	//Read More
	public function register_blog_list_read_more_style_controls(){
		$this->start_controls_section(
            '_blog_list_read_more_section',
            [
                'label' => esc_html__('Read More', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	$this->get_control_id( '_blog_list_post_type!' ) => [ 'category', 'by_id' ],
                	$this->get_control_id( '_blog_list_show_read_more' ) => [ 'yes' ],
                ],
            ]
        );
			$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_blog_list_read_more_typography',
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_read_more_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog_list_read_more_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_blog_list_read_more_header_tabs');

        $this->start_controls_tab('_blog_list_read_more_header_normal_tab', 
        	['label' => esc_html__('Normal', 'droit-addons')]
        );
        
        $this->add_control(
            '_blog_list_read_more_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_blog_list_read_more_bg_color',
            [
                'label' => esc_html__('Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_blog_list_read_more_border_normal',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more',
            ]
        );
        $this->add_responsive_control(
            '_blog_list_read_more_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('_blog_list_read_more_header_hover_tab', 
        	['label' => esc_html__('Hover', 'droit-addons')]
        );
 
        $this->add_control(
            '_blog_list_read_more_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_blog_list_read_more_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_blog_list_read_more_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more:hover',
            ]
        );

        $this->add_responsive_control(
            '_blog_list_read_more_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__wrap .droit-blog_list_loop_wrap .droit-post_list_read-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
	}



    //Html render
    protected function render(){
        $settings = $this->get_settings_for_display();
        
        $cate_manual_arr = ['category', 'by_id'];

        if ( in_array( $this->get_blog_settings('_blog_list_post_type') , $cate_manual_arr ) ) {
                dl_pro_message();
            }else{

            $_blog_skin  = !empty($this->get_blog_settings('_blog_list_skin')) ? $this->get_blog_settings('_blog_list_skin') : '_skin_1';

            switch ($_blog_skin) {
                case '_skin_1':
                    $this->_first_blog_list_layout();
                    break; 
                case '_skin_2':
                    $this->_second_blog_list_layout();
                    break;
                case '_skin_3':
                    $this->_third_blog_list_layout();
                    break;
                case '_skin_4':
                    $this->_four_blog_list_layout();
                    break;
                default:
                    $this->_first_blog_list_layout();
                    break;
            }
        }
    }

    //Query
    protected function query_posts() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        $sticky_post = $this->get_blog_settings('_blog_list_ignore_sticky_posts') ? true : false;
        
        $arrayType = ['page', 'by_id', 'category'];

        $query_args['posts_ids'] = [];
        $query_args['offset'] = 0;

        if(!empty($_blog_list_order_by)) {
            $query_args['orderby'] = $_blog_list_order_by;
        }

        if(!empty($_blog_list_order)) {
            $query_args['order'] = $_blog_list_order;
        }
        
        if(!empty($_blog_list_post_type)) {
            $query_args['post_type'] = $_blog_list_post_type;
        }

        if( !empty( $post_type ) && !in_array($post_type, $arrayType) ){
            $sticky_args = array(
                'ignore_sticky_posts' => $sticky_post,
            );

            $query_args = array_merge( $query_args, $sticky_args );
        }
        
        if( !empty( $_blog_list_posts_per_page )){
            $query_args['posts_per_page'] = $_blog_list_posts_per_page;
        }

        $tax_query[] = [
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => ['post-format-quote', 'post-format-link'],
            'operator' => 'NOT IN',
        ];
        $query_args['tax_query'] = $tax_query;
        
        $dl_query = new \WP_Query($query_args);
        return $dl_query;
    }

    //Header
    protected function render_blog_list_post_header() {
        $settings = $this->get_settings_for_display();
        $p_id = get_the_ID();
        $this->add_render_attribute( 'blog_list_main_wrapper', 
            'class', [
            "droit-post__wrap dl_row {$this->get_blog_settings('_blog_list_skin')} post-{$p_id}",
        ] );

        $main_wrapper = $this->get_render_attribute_string( 'blog_list_main_wrapper' );
        ?>
        <div <?php echo $main_wrapper; ?>>
        <?php
    }

    //Footer
    protected function render_blog_list_post_footer() {
        ?>
        </div>
        <?php
    }

    protected function get_optional_link_attributes_html() {
        $settings = $this->get_settings_for_display();
        $new_tab_setting_key = $this->get_control_id( '_blog_list_open_new_tab' );
        $optional_attributes_html = 'yes' === $settings[ $new_tab_setting_key ] ? 'target="_blank"' : '';

        return $optional_attributes_html;
    }

    protected function render_title(){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blog_settings('_blog_list_show_title')) {
            return;
        }
        $optional_attributes_html = $this->get_optional_link_attributes_html();

        $this->add_render_attribute( 'blog_list_title_wrapper', 'class', [
            "dl_title droit-blog-list-title",
        ] );

        $title_attributes = $this->get_render_attribute_string( 'blog_list_title_wrapper' );
        ?>
    
    <<?php echo esc_html( dl_title_tag($this->get_blog_settings('_blog_list_title_tag')) ); ?> <?php echo $title_attributes; ?>> 
        <a href="<?php echo esc_url($this->current_permalink); ?>" <?php echo $optional_attributes_html; ?>><?php the_title();?></a> 
    </<?php echo esc_html( dl_title_tag($this->get_blog_settings('_blog_list_title_tag')) ); ?>>
    <?php
    }

    protected function render_thumbnail() {
        $settings = $this->get_settings_for_display();
        
        if (!$this->get_blog_settings('_blog_list_show_thumb')) {
            return;
        }
        
        $setting_key = $this->get_control_id( '_blog_list_thumbnail_size' );
        $settings[ $setting_key ] = [
            'id' => get_post_thumbnail_id(),
        ];
        $thumbnail_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, $setting_key );

        if ( empty( $thumbnail_html ) ) {
            return;
        }

        $optional_attributes_html = $this->get_optional_link_attributes_html();

        ?>
        <a class="dl_blog_thumb droit-post_list__thumbnail__link droit-post_list__thumbnail" href="<?php echo esc_url($this->current_permalink); ?>" <?php echo $optional_attributes_html; ?>>
            <?php echo $thumbnail_html; ?>
        </a>
        <?php
    }

    protected function render_excerpt() {
        $settings = $this->get_settings_for_display();
        
        if ( ! $this->get_blog_settings('_blog_list_show_excerpt') ) {
            return;
        }

         $content = strip_shortcodes( dl_shorten_txt( get_the_excerpt(), $this->render_excerpt_length() ) ); 

        ?>
        <p class="droit-post_list_excerpt dl_description">
            <?php echo $content; ?>
        </p>
        <?php
    }

    protected function render_excerpt_length() {
        $settings = $this->get_settings_for_display();
        return $this->get_blog_settings('_blog_list_excerpt_length');
    }

    protected function _droit_get_link_attributes_html() {
        $settings = $this->get_settings_for_display();
        $new_tab_setting_key = $this->get_control_id( '_blog_list_open_new_tab' );
        $optional_attributes_html = 'yes' === $this->get_blog_settings($new_tab_setting_key ) ? 'target="_blank"' : '';

        return $optional_attributes_html;
    }

    protected function render_read_more(){

        $settings = $this->get_settings_for_display();
        if ( ! $this->get_blog_settings('_blog_list_show_read_more') ) {
            return;
        }

        $optional_attributes_html = $this->_droit_get_link_attributes_html();

        ?>
            <a class="droit-post_list_read-more dl_read_more_btn" href="<?php echo esc_url($this->current_permalink); ?>" <?php echo $optional_attributes_html; ?>>
                <?php echo $this->get_blog_settings('_blog_list_read_more_text'); ?>
            </a>
        <?php
    }

    protected function render_date() {
        $settings = $this->get_settings_for_display();
        
        if ( ! $this->get_blog_settings('_blog_list_show_date') ) {
            return;
        }
        ?>
        <a href="#" class="dl_date droit-post_list_date">
            <?php
            echo apply_filters( 'the_date', get_the_date(), get_option( 'date_format' ), '', '' );
            ?>
        </a>
        <?php
    }

    protected function render_author(){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blog_settings('_blog_list_show_author')) {
            return;
        }
        $this->add_render_attribute( '_author_name', 'class', 'dl_post_author droit-post_list_author_name' );

        $icon_tag = 'span';

        if ( ! empty( $this->get_blog_settings('_blog_list_enable_author')) ) {
            $icon_tag = 'a';
            $auth_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
            $href = 'href="'.$auth_url.'"';
        }
        
        ?>
        <div class="dl_author_info droit-post_list_author">
            <?php $this->render_author_image(); ?>
            <<?php echo esc_html( $icon_tag ) . ' '. $href; ?> <?php echo $this->get_render_attribute_string( '_author_name' ); ?>><?php the_author();?></<?php echo esc_html($icon_tag); ?>>
        </div>
     <?php
    }

    protected function render_author_image(){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blog_settings('_blog_list_show_author_image')) {
            return;
        }
        $author_id = get_the_author_meta( 'ID' );
        $auth_args = [
            'size' => '150',
        ];
        $auth_static = !empty($this->get_blog_settings('_blog_list_default_author_image')['url']) ? $this->get_blog_settings('_blog_list_default_author_image')['url'] : get_avatar_url($author_id, $auth_args); 
        
        ?>
       <img src="<?php echo $auth_static; ?>" alt="#" class="dl_author_img">
     <?php
    }


    // First Layout
    protected function _first_blog_list_layout(){
        $settings = $this->get_settings_for_display();

        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = !empty($this->get_blog_settings('_blog_list_columns')) ? $this->get_blog_settings('_blog_list_columns') : 2;
        
        $columns_mobile = !empty($this->get_blog_settings('_blog_list_columns_mobile')) ? $this->get_blog_settings('_blog_list_columns_mobile') : 12;
        
        $columns_tablet = !empty($this->get_blog_settings('_blog_list_columns_tablet')) ? $this->get_blog_settings('_blog_list_columns_tablet') : 6;

        $this->add_render_attribute( 'blog_list_wrapper', 'class', [
            "dl_col_lg_{$columns} dl_col_{$columns_mobile} dl_col_sm_{$columns_tablet} droit-blog_list_loop_wrap",
        ] );

        $this->add_render_attribute( 'blog_list_wrapper_inner', 'class', [
            "dl_blog_list_post dl_style_01 droit-blog_list_loop_post",
        ] );

        $wrapper_attributes = $this->get_render_attribute_string( 'blog_list_wrapper' );
        $wrapper_inner = $this->get_render_attribute_string( 'blog_list_wrapper_inner' );

        $this->render_blog_list_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();
        ?>
        <div <?php echo $wrapper_attributes; ?>>
            <div <?php echo $wrapper_inner; ?>>
                <?php echo $this->render_thumbnail(); ?>
                <div class="dl_blog_list_content_inner">
                    <?php $this->render_date(); ?>
                    <?php echo $this->render_title(); ?>
                   <?php echo $this->render_excerpt(); ?>
                    <div class="dl_post_meta">
                        <?php echo $this->render_author(); ?>
                        <?php echo $this->render_read_more(); ?>
                    </div>
                </div>
            </div>
        </div>
         <?php endwhile;
         wp_reset_postdata(); 
           $this->render_blog_list_post_footer();
          ?>
    <?php }

    // Second Layout
    protected function _second_blog_list_layout(){
        $settings = $this->get_settings_for_display();

        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = !empty($this->get_blog_settings('_blog_list_columns')) ? $this->get_blog_settings('_blog_list_columns') : 2;
        
         $columns_mobile = !empty($this->get_blog_settings('_blog_list_columns_mobile')) ? $this->get_blog_settings('_blog_list_columns_mobile') : 12;
        
        $columns_tablet = !empty($this->get_blog_settings('_blog_list_columns_tablet')) ? $this->get_blog_settings('_blog_list_columns_tablet') : 6;

        $this->add_render_attribute( 'blog_list_wrapper', 'class', [
            "dl_col_lg_{$columns} dl_col_{$columns_mobile} dl_col_sm_{$columns_tablet} droit-blog_list_loop_wrap",
        ] );

        $this->add_render_attribute( 'blog_list_wrapper_inner', 'class', [
            "dl_blog_list_post dl_style_03 droit-blog_list_loop_post",
        ] );

        $wrapper_attributes = $this->get_render_attribute_string( 'blog_list_wrapper' );
        $wrapper_inner = $this->get_render_attribute_string( 'blog_list_wrapper_inner' );

        $this->render_blog_list_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();
        ?>
        <div <?php echo $wrapper_attributes; ?>>
            <div <?php echo $wrapper_inner; ?>>
                <?php echo $this->render_thumbnail(); ?>
                <div class="dl_blog_list_content_inner">
                    <div class="dl_post_meta">
                        <?php $this->render_date(); ?>
                    </div>
                    <?php echo $this->render_title(); ?>
                </div>
            </div>
        </div>
         <?php endwhile;
            wp_reset_postdata(); 
           $this->render_blog_list_post_footer();
          ?>
    <?php }
    
    // Third Layout
    protected function _third_blog_list_layout(){
        $settings = $this->get_settings_for_display();

        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = !empty($this->get_blog_settings('_blog_list_columns')) ? $this->get_blog_settings('_blog_list_columns') : 2;
         $columns_mobile = !empty($this->get_blog_settings('_blog_list_columns_mobile')) ? $this->get_blog_settings('_blog_list_columns_mobile') : 12;
        
        $columns_tablet = !empty($this->get_blog_settings('_blog_list_columns_tablet')) ? $this->get_blog_settings('_blog_list_columns_tablet') : 6;

        $this->add_render_attribute( 'blog_list_wrapper', 'class', [
            "dl_col_lg_{$columns} dl_col_{$columns_mobile} dl_col_sm_{$columns_tablet} droit-blog_list_loop_wrap",
        ] );

        $this->add_render_attribute( 'blog_list_wrapper_inner', 'class', [
            "dl_blog_list_post dl_style_05 droit-blog_list_loop_post",
        ] );

        $wrapper_attributes = $this->get_render_attribute_string( 'blog_list_wrapper' );
        $wrapper_inner = $this->get_render_attribute_string( 'blog_list_wrapper_inner' );

        $this->render_blog_list_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();
        ?>
        <div <?php echo $wrapper_attributes; ?>>
            <div <?php echo $wrapper_inner; ?>>
                <?php echo $this->render_thumbnail(); ?>
                <div class="dl_blog_list_content_inner">
                    <?php $this->render_date(); ?>
                    <?php echo $this->render_title(); ?>
                </div>
            </div>
        </div>
         <?php endwhile;
            wp_reset_postdata(); 
           $this->render_blog_list_post_footer();
          ?>
    <?php }
    
    // Four Layout
    protected function _four_blog_list_layout(){
        $settings = $this->get_settings_for_display();

        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = !empty($this->get_blog_settings('_blog_list_columns')) ? $this->get_blog_settings('_blog_list_columns') : 2;
        
        $columns_mobile = !empty($this->get_blog_settings('_blog_list_columns_mobile')) ? $this->get_blog_settings('_blog_list_columns_mobile') : 12;
        
        $columns_tablet = !empty($this->get_blog_settings('_blog_list_columns_tablet')) ? $this->get_blog_settings('_blog_list_columns_tablet') : 6;

        $this->add_render_attribute( 'blog_list_wrapper', 'class', [
            "dl_col_lg_{$columns} dl_col_{$columns_mobile} dl_col_sm_{$columns_tablet} droit-blog_list_loop_wrap",
        ] );

        $this->add_render_attribute( 'blog_list_wrapper_inner', 'class', [
            "dl_blog_list_post dl_style_07 droit-blog_list_loop_post",
        ] );

        $wrapper_attributes = $this->get_render_attribute_string( 'blog_list_wrapper' );
        $wrapper_inner = $this->get_render_attribute_string( 'blog_list_wrapper_inner' );

        $this->render_blog_list_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();
        ?>
        <div <?php echo $wrapper_attributes; ?>>
            <div <?php echo $wrapper_inner; ?>>
                <?php echo $this->render_thumbnail(); ?>
                <div class="dl_blog_list_content_inner">
                    <?php $this->render_date(); ?>
                    <?php echo $this->render_title(); ?>
                    <?php echo $this->render_excerpt(); ?>
                    <div class="dl_post_meta">
                        <?php echo $this->render_read_more(); ?>
                    </div>
                </div>
            </div>
        </div>
         <?php endwhile;
            wp_reset_postdata(); 
           $this->render_blog_list_post_footer();
          ?>
    <?php }
    
    protected function content_template()
    {}
}