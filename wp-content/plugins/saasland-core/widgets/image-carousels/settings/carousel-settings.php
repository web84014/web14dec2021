<?php
use Elementor\Controls_Manager;

$this->start_controls_section(
    'carousel_settings', [
        'label' => __( 'Carousel Settings', 'saasland-core' ),
    ]
);

$this->add_control(
    'is_auto_play',
    [
        'label' => __( 'Autoplay', 'saasland-core' ),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __( 'Yes', 'saasland-core' ),
        'label_off' => __( 'No', 'saasland-core' ),
        'return_value' => 'yes',
        'default' => 'yes'
    ]
);


$this->add_control(
    'autoplay_speed',
    [
        'label' => __( 'Autoplay Speed', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'condition' => [
            'is_auto_play' => 'yes'
        ]
    ]
);

$this->add_control(
    'is_loop',
    [
        'label' => __( 'Infinite Loop', 'saasland-core' ),
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
        'label' => __( 'Animation Speed', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
    ]
);

$this->end_controls_section();