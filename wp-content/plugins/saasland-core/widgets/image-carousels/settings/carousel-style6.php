<?php

use Elementor\Controls_Manager;

$this->start_controls_section(
    'carousels6_sec', [
        'label' => __( 'Carousel Gallery', 'saasland-core' ),
        'condition' => [
            'style' => 'style_06'
        ]
    ]
);

$carousels6 = new \Elementor\Repeater();

$carousels6->add_control(
    'gallery_items',
    [
        'label' => __( 'View', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::HIDDEN,
    ]
);

$carousels6->add_control(
    'img_badge', [
        'label' => __( 'Image Badge', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
    ]
);

$carousels6->add_control(
    'image1', [
        'label' => __( 'Image 01', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);

$carousels6->add_control(
    'image2', [
        'label' => __( 'Image 02', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);

$this->add_control(
    'carousels6', [
        'label' => __( 'Images', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'title_field' => '{{{ gallery_items }}}',
        'fields' => $carousels6->get_controls()
    ]
);

$this->end_controls_section();