<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

$slides2 = new \Elementor\Repeater();

$this->start_controls_section( 'saasland_slider_settings_2', [
    'label' => __( 'Slider Two Settings', 'saasland-core' ),
    'condition' => [
        'slider_style' => ['2', '3']
    ]
] );
$slides2->start_controls_tabs( 'slider_2_tab' );
$slides2->start_controls_tab(
    'saasland_slider_2_content', [
        'label' => __( 'Content', 'saasland-core' )
    ]
);
$slides2->add_control(
    'slider_2_feature_img', [
        'label' => __( 'Feature Image', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);

$slides2->add_control(
    'slider_2_title', [
        'label' => __( 'Slider Title', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => ''
    ]
);
$slides2->add_control(
    'slider_2_subtitle', [
        'label' => __( 'Sub-title', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => ''
    ]
);
$slides2->add_control(
    'slider_2_bg_text', [
        'label' => __( 'Background Text', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => ''
    ]
);
$slides2->add_control(
    'slider_2_btn_label', [
        'label' => __( 'Button Title', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'Go to shop',
    ]
);
$slides2->add_control(
    'slider_2_btn_url', [
        'label' => __( 'Button URL', 'saasland-core' ),
        'type' => Controls_Manager::URL,
        'default' => [
            'url' => '#'
        ]
    ]
);
$slides2->add_control(
    'slider_2_content', [
        'label' => __( 'Content', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::TEXTAREA,
        'label_block' => true,
    ]
);
$slides2->end_controls_tab();
$slides2->start_controls_tab(
    'slider_2_tab_style', [
        'label' => __( 'Style', 'saasland-core' )
    ]
);
$slides2->add_control(
    'slider_2_title_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content h3' => 'color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content h3' => 'color: {{VALUE}};',
        ],
    ]
);
$slides2->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'slider_2_title_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '
            {{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content h3,
            {{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content h3
        ',
    ]
);
$slides2->add_control(
    'slider_2_subtitle_color', [
        'label' => __( 'Sub-Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content h6' => 'color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content h6' => 'color: {{VALUE}};',
        ],
        'separator' => 'before'
    ]
);
$slides2->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'slider_2_subtitle_typo',
        'label' => __( 'Sub-title Typography', 'saasland-core' ),
        'selector'  => '
            {{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content h6,
            {{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content h6,
        ',
        'separator' => 'after'
    ]
);
$slides2->add_control(
    'slider_2_bg_shape', [
        'label' => __( 'Background Object', 'saasland-core' ),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'saasland-core' ),
        'label_off' => __( 'Hide', 'saasland-core' ),
        'return_value' => 'yes',
        'default' => 'yes',
        'separator' => 'before'
    ]
);
$slides2->add_control(
    'slider_2_shape_img', [
        'label' => __( 'Shape Image', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'condition' => [
            'slider_2_bg_shape' => 'yes'
        ]
    ]
);
$slides2->add_control(
    'slider_2_bg_color', [
        'label' => __( 'Background Color', 'saasland-core' ),
        'type' =>  \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} ' => 'background: {{VALUE}} !important;',
        ],
    ]
);

$slides2->add_control(
    'slider_2_item_bg', [
        'label' => __( 'Background Type', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'classic' => [
                'title' => __( 'Classic', 'saasland-core' ),
                'icon' => 'fa fa-paint-brush',
            ],
            'gradient' => [
                'title' => __( 'Gradient', 'saasland-core' ),
                'icon' => 'fa fa-barcode',
            ],

        ],
        'default' => 'classic',
        'toggle' => true,
    ]
);

$slides2->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name' 			=> 'background_classic',
        'label' 		=> __( 'Background Classic', 'saasland-core' ),
        'types' 		=> [ 'classic' ],
        'selector' 		=> '{{CURRENT_ITEM}}',
        'condition' => [
            'slider_2_item_bg' => 'classic'
        ]
    ]
);

$slides2->add_control(
    'slide_bg_gradient_1st', [
        'label' => __( 'Background First Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'condition' => [
            'slider_2_item_bg' => 'gradient'
        ]
    ]
);
$slides2->add_control(
    'slide_background_gradient', [
        'label' => __( 'Background Second Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'condition' => [
            'slider_2_item_bg' => 'gradient'
        ]
    ]
);
$slides2->add_control(
    'gradient_angle',
    [
        'label' => __( 'Angle', 'saasland-core' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'deg' ],
        'range' => [
            'deg' => [
                'min' => 1,
                'max' => 360,
                'step' => 0,
            ],
        ],
        'default' => [
            'unit' => 'deg',
            'size' => 90,
        ],
        'condition' => [
            'slider_2_item_bg' => 'gradient'
        ]
    ]
);

$slides2->add_control(
    '_slide_btn_color', [
        'label' => __( 'Button Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content .gadget_btn' => 'color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content .gadget_btn' => 'color: {{VALUE}};'
        ],
        'separator' => 'before'
    ]
);
$slides2->add_control(
    '_slide_btn_hover_color', [
        'label' => __( 'Button Hover Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content .gadget_btn:hover' => 'color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content .gadget_btn:hover' => 'color: {{VALUE}};'
        ]
    ]
);
$slides2->add_control(
    '_slide_btn_bg', [
        'label' => __( 'Button Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content .gadget_btn' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content .gadget_btn' => 'background-color: {{VALUE}};'
        ],
        'separator' => 'before'
    ]
);
$slides2->add_control(
    '_slide_btn_hover_bg', [
        'label' => __( 'Button Hover Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content .gadget_btn:hover' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content .gadget_btn:hover' => 'background-color: {{VALUE}};'
        ],
        'separator' => 'after'
    ]
);
$slides2->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'slide_btn_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '
            {{WRAPPER}} {{CURRENT_ITEM}} .gadget_slider_content gadget_btn,
            {{WRAPPER}} {{CURRENT_ITEM}} .shop_slider_content .gadget_btn 
         ',
    ]
);

$slides2->end_controls_tab();
$slides2->end_controls_tabs();

$this->add_control(
    'slider_2_items', [
        'label' => __( 'Slide Items', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'title_field' => '{{{ slider_2_title }}}',
        'fields' => $slides2->get_controls(),
        'separator' => 'before'
    ]
);

$this->end_controls_section();


$this->start_controls_section(
    'slider_2_settings', [
        'label' => __( 'Slider Settings', 'saasland-core' ),
        'condition' => [
            'slider_style' => [ '2', '3' ]
        ]
    ]
);

$this->add_control(
    'slider_2_loop', [
        'label' => __( 'Loop', 'saasland-core' ),
        'type' => Controls_Manager::SWITCHER,
        'return_value' => 'yes',
        'default' => 'yes'
    ]
);

$this->add_control(
    'slider_2_delay_duration', [
        'label' => __( 'Delay Duration', 'saasland-core' ),
        'description' => __( 'Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled.', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 5000
    ]
);

$this->add_control(
    'slider_2_transition_anim', [
        'label' => __( 'Transition Effect', 'saasland-core' ),
        'type' => Controls_Manager::ANIMATION,
    ]
);

$this->end_controls_section();


/** ====== Content Styling ======  */
$this->start_controls_section(
    'content_styling_sec', [
        'label' => esc_html__( 'Content Styling', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'slider_style' => '2'
        ]
    ]
);


$this->end_controls_section();