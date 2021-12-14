<?php

use Elementor\Controls_Manager;

$this->start_controls_section(
    'images_sec', [
        'label' => __( 'Images', 'saasland-core' ),
        'condition' => [
            'style' => [ 'style_01', 'style_02', 'style_03', 'style_04' ]
        ]
    ]
);

$this->add_control(
    'images', [
        'label' => esc_html__( 'Add images', 'saasland-core' ),
        'type' => Controls_Manager::GALLERY,
        'condition' => [
            'style' => [ 'style_01', 'style_03', 'style_04' ]
        ]
    ]
);

$carousel_rows = new \Elementor\Repeater();

$carousel_rows->add_control(
    'cr_items',
    [
        'label' => __( 'View', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::HIDDEN,
    ]
);

$carousel_rows->add_control(
    'images', [
        'label' => esc_html__( 'Add images', 'saasland-core' ),
        'type' => Controls_Manager::GALLERY,
    ]
);

$this->add_control(
    'carousel_rows', [
        'label' => __( 'Carousel Rows', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'title_field' => '{{{ cr_items }}}',
        'fields' => $carousel_rows->get_controls(),
        'condition' => [ 'style' => 'style_02' ]
    ]
);

$this->end_controls_section();