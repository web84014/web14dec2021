<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    'portfolio_slider_filter', [
        'label' => __( 'Filter', 'saasland-core' ),
        'condition' => [
            'slider_style' => '4'
        ]
    ]
);
$this->add_control(
    'posts_per_page',
    [
        'label' => __( 'Posts Per Page', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 10
    ]
);

$this->add_control(
    'portfolio_order', [
        'label' => esc_html__( 'Order', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'ASC' => 'ASC',
            'DESC' => 'DESC'
        ],
        'default' => 'ASC'
    ]
);

$this->add_control(
    'portfolio_exclude', [
        'label' => esc_html__( 'Exclude Post', 'saasland-core' ),
        'description' => esc_html__( 'Enter the post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
    ]
);

$this->end_controls_section();


$this->start_controls_section(
    'portfolio_slider_4_style', [
        'label' => esc_html__( 'Style', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'slider_style' => '4'
        ]
    ]
);
$this->add_control(
    'portfolio_title_heading',
    [
        'label' => __( 'Portfolio Title Style', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);
$this->start_controls_tabs( 'portfolio_slider_title_style');
$this->start_controls_tab( 'portfolio_title_normal', [
        'label' => esc_html__('Normal', 'saasland-core')
    ]
);
$this->add_control(
    'portfolio_title_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .carousel-indicators li' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'portfolio_title_typo',
        'label' => __( 'Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .carousel-indicators li',
        'separator' => 'after'
    ]
);
$this->add_control(
    'title_padding',
    [
        'label' => __( 'Padding', 'plugin-domain' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .carousel-indicators li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->end_controls_tab();
$this->start_controls_tab( 'slider_title_hover_style', [
        'label' => esc_html__('Active/Hover', 'saasland-core')
    ]
);
$this->add_control(
    'tab_label_hover_color', [
        'label' => __( 'Tab label Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .carousel-indicators li.active' => 'color: {{VALUE}};',
            '{{WRAPPER}} .carousel-indicators li:hover' => 'color: {{VALUE}};',
        ],
    ]
);

$this->end_controls_tab();
$this->end_controls_tabs();


$this->add_control(
    'arrow_btn_heading',
    [
        'label' => __( 'Portfolio Arrow Style', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);
$this->start_controls_tabs( 'portfolio_slider_arrow_style');
$this->start_controls_tab( 'portfolio_arrow_normal', [
        'label' => esc_html__('Normal', 'saasland-core')
    ]
);
$this->add_control(
    'portfolio_arrow_color', [
        'label' => __( 'Arrow Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .main_product_slider .carousel-control-prev' => 'color: {{VALUE}};',
            '{{WRAPPER}} .main_product_slider .carousel-control-next' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'portfolio_arrow_bg',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient' ],
        'selector' => '
            {{WRAPPER}} .main_product_slider .carousel-control-prev,
            {{WRAPPER}} .main_product_slider .carousel-control-next
        ',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'slider_arrow_box_shadow',
        'label' => __( 'Box Shadow', 'plugin-domain' ),
        'selector' => '
            {{WRAPPER}} .main_product_slider .carousel-control-next,
            {{WRAPPER}} .main_product_slider .carousel-control-prev
        ',
    ]
);

$this->end_controls_tab();
$this->start_controls_tab( 'slider_arrow_hover_style', [
        'label' => esc_html__('Hover', 'saasland-core')
    ]
);
$this->add_control(
    'portfolio_arrow_hover_color', [
        'label' => __( 'Arrow Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .main_product_slider .carousel-control-prev:hover' => 'color: {{VALUE}};',
            '{{WRAPPER}} .main_product_slider .carousel-control-next:hover' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'portfolio_arrow_hover_bg',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient' ],
        'selector' => '
            {{WRAPPER}} .main_product_slider .carousel-control-prev:hover,
            {{WRAPPER}} .main_product_slider .carousel-control-next:hover
        ',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'slider_arrow_hover_box_shadow',
        'label' => __( 'Box Shadow', 'plugin-domain' ),
        'selector' => '
            {{WRAPPER}} .main_product_slider .carousel-control-next:hover,
            {{WRAPPER}} .main_product_slider .carousel-control-prev:hover
        ',
    ]
);

$this->end_controls_tab();
$this->end_controls_tabs();

$this->end_controls_section();