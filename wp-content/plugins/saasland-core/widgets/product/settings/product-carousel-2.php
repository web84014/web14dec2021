<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;


$this->start_controls_section(
    'product_carousel_style2',
    [
        'label' => __( 'Product Carousel Title', 'saasland-core' ),
        'condition' => [
            'product_style' => ['3']
        ]
    ]
);
$this->add_control(
    'product_carousel_sec_title', [
        'label' => esc_html__( 'Title', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'Trending Products'

    ]
);

$this->add_control(
    '_product_carousel_title_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{CURRENT_ITEM}} .shop_title h2.w_color' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => '_product_carousel_title_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '{{CURRENT_ITEM}} .shop_title h2.w_color',
        'separator' => 'after'
    ]
);
$this->end_controls_section();

/*====================== Carousel Setting ================================*/
$this->start_controls_section(
    'product_carousel_settings', [
        'label' => __( 'Slider Settings', 'saasland-core' ),
        'condition' => [
            'product_style' => ['3']
        ],
    ]
);
$this->add_control(
    'carousel_loop',
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
    'carousel_autoplay',
    [
        'label' => __( 'Autoplay', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'true' => esc_html__( 'True', 'saasland-core' ),
            'false' => esc_html__( 'False', 'saasland-core' ),
        ],
        'default' => 'true'
    ]
);
$this->add_control(
    'carousel_slide_speed',
    [
        'label' => __( 'Slide Speed', 'saasland-core' ),
        'description' => __( 'Set the slide speed in millisecond', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 2500
    ]
);
$this->add_control(
    'carousel_slide_delay',
    [
        'label' => __( 'Slide Delay', 'saasland-core' ),
        'description' => __( 'Set the slide delay in millisecond', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 5000
    ]
);
$this->add_control(
    'slide_item',
    [
        'label' => __( 'Show Items', 'saasland-core' ),
        'description' => __( 'How many item you want to show per row', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 5
    ]
);

$this->end_controls_section();

/*====================== Product Background ==========================*/
$this->start_controls_section(
    'product_carousel2_bg', [
        'label' => __( 'Style', 'saasland-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['3']
        ]
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'product_carousel_background',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient', 'video' ],
        'selector' => '{{WRAPPER}} .trending_product_area',
    ]
);

$this->end_controls_section();