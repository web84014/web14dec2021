<?php
// ------------------------------  Title Section ------------------------------
use Elementor\Controls_Manager;

$this->start_controls_section(
    'title_sec', [
        'label' => __( 'Title section', 'saasland-core' ),
        'condition' => [
            'style' => [ 'style_01', 'style_04', 'style_05', 'style_06' ]
        ]
    ]
);

$this->add_control(
    'title_text', [
        'label' => esc_html__( 'Title text', 'saasland-core' ),
        'type' => Controls_Manager::TEXTAREA,
        'label_block' => true,
    ]
);

$this->add_control(
    'title_html_tag',
    [
        'label' => __( 'Title HTML Tag', 'elementor' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
            'div' => 'div',
        ],
        'default' => 'h2',
        'separator' => 'before',
    ]
);

$this->add_control(
    'subtitle_text', [
        'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
        'type' => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'condition' => [
            'style' => ['style_01', 'style_02', 'style_03', 'style_06']
        ]
    ]
);

$this->end_controls_section(); // End title section