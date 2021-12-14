<?php

// Slider Settings =============================================
use Elementor\Controls_Manager;

$this->start_controls_section(
    'slider', [
        'label' => __( 'Slider', 'saasland-core' ),
        'condition' => [
            'slider_style' => '1'
        ]
    ]
);

$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'style', [
        'label' => __( 'Slide Style', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            '1' => __( 'Three Images', 'saasland-core' ),
            '2' => __( 'One Image', 'saasland-core' ),
        ],
        'default' => '2',
    ]
);

$repeater->add_control(
    'content', [
        'label' => __( 'Slider content', 'saasland-core' ),
        'type' => Controls_Manager::WYSIWYG,
        'label_block' => true,
        'default' => '',
    ]
);

$repeater->add_control(
    'btn_divider', [
        'type' => \Elementor\Controls_Manager::DIVIDER,
        'style' => 'thick',
    ]
);

$repeater->add_control(
    'btn_label', [
        'label' => __( 'Button label', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'Get Started'
    ]
);

$repeater->add_control(
    'btn_url', [
        'label' => __( 'Button URL', 'saasland-core' ),
        'type' => Controls_Manager::URL,
        'label_block' => true,
        'default' => [
            'url' => '#'
        ]
    ]
);

$repeater->add_control(
    'btn2_label', [
        'label' => __( 'Button 2 label', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'Get Started'
    ]
);

$repeater->add_control(
    'btn2_url', [
        'label' => __( 'Button 2 URL', 'saasland-core' ),
        'type' => Controls_Manager::URL,
        'label_block' => true,
        'default' => [
            'url' => '#'
        ]
    ]
);

$repeater->add_control(
    'image_divider', [
        'type' => \Elementor\Controls_Manager::DIVIDER,
        'style' => 'thick',
    ]
);

$repeater->add_control(
    'image1', [
        'label' => __( 'Image', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);

$repeater->add_control(
    'image2', [
        'label' => __( 'Image 02', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'condition' => ['style' => '1']
    ]
);

$repeater->add_control(
    'image3', [
        'label' => __( 'Image 03', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'condition' => ['style' => '1']
    ]
);

$repeater->add_control(
    'bg_divider', [
        'type' => \Elementor\Controls_Manager::DIVIDER,
        'style' => 'thick',
    ]
);

$repeater->add_control(
    'bg_color', [
        'label' => __( 'Background Color 01', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
    ]
);

$repeater->add_control(
    'bg_color2', [
        'label' => __( 'Background Color 02', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
    ]
);

$repeater->add_control(
    'bg_color3', [
        'label' => __( 'Background Color 03', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}}.slider_item.slider_item_two' => 'background-image: -webkit-linear-gradient(125deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 64%, {{VALUE}} 100%);',
            '{{WRAPPER}} {{CURRENT_ITEM}}.slider_item' => 'background-image: -webkit-linear-gradient(-120deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 64%, {{VALUE}} 100%);',
        ],
    ]
);

$this->add_control(
    'slides', [
        'label' => __( 'Slide items', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'title_field' => '{{{ content }}}',
        'fields' => $repeater->get_controls()
    ]
);

$this->end_controls_section();

/**
 * Slider Settings
 */
$this->start_controls_section(
    'slider_settings', [
        'label' => __( 'Slider Settings', 'saasland-core' ),
        'condition' => [
            'slider_style' => '1'
        ]
    ]
);

$this->add_control(
    'loop',
    [
        'label' => __( 'Loop', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'true' => esc_html__( 'True', 'saasland-core' ),
            'false' => esc_html__( 'False', 'saasland-core' ),
        ],
        'default' => 'true'
    ]
);

$this->add_control(
    'slide_speed',
    [
        'label' => __( 'Slide Speed', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 1000
    ]
);

$this->add_control(
    'transition_anim',
    [
        'label' => __( 'Transition Effect', 'saasland-core' ),
        'type' => Controls_Manager::ANIMATION,
        'default' => 'fadeOut'
    ]
);

$this->end_controls_section();