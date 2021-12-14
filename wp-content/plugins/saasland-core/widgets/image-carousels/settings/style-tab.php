<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

$this->start_controls_section(
    'style_title', [
        'label' => __( 'Style section title', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'color_title', [
        'label' => __( 'Text Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .t_color3.mb_20' => 'color: {{VALUE}};',
            '{{WRAPPER}} .section_title h2' => 'color: {{VALUE}};',
            '{{WRAPPER}} .u_content h2' => 'color: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_two h2' => 'color: {{VALUE}};'
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(), [
        'name' => 'typography_title',
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '
            {{WRAPPER}} .t_color3.mb_20,
            {{WRAPPER}} .section_title h2,
            {{WRAPPER}} .u_content h2,
            {{WRAPPER}} .portfolio_area_two h2',
    ]
);

$this->end_controls_section();


//------------------------------ Style subtitle ------------------------------
$this->start_controls_section(
    'style_subtitle', [
        'label' => __( 'Style subtitle', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'style' => ['style_01', 'style_02', 'style_03', 'style_06' ]
        ]
    ]
);

$this->add_control(
    'color_subtitle', [
        'label' => __( 'Text Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
            '{{WRAPPER}} .section_title p' => 'color: {{VALUE}};',
            '{{WRAPPER}} .u_content p' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(), [
        'name' => 'typography_subtitle',
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '
            {{WRAPPER}} .sec_title p,
            {{WRAPPER}} .section_title p,
            {{WRAPPER}} .u_content p',
    ]
);

$this->end_controls_section();


// ------------------------------------- Style Section ---------------------------//
$this->start_controls_section(
    'style_section', [
        'label' => __( 'Style section', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'bg_color', [
        'label' => __( 'Background Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .app_screenshot_area' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} .slider_demos_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .blog_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_two' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_three' => 'background: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'sec_padding', [
        'label' => __( 'Section padding', 'saasland-core' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .app_screenshot_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .slider_demos_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .blog_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

        ],
    ]
);

$this->end_controls_section();


$this->start_controls_section(
    'carousel_dot_style', [
        'label' => __( 'Dot Style', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'style' => ['style_01', 'style_03' ]
        ]
    ]
);
$this->add_control(
    'color_dot', [
        'label' => __( 'Dot Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}}',
            '{{WRAPPER}} .portfolio_area .p_slider_inner ul.slick-dots li button' => 'background: {{VALUE}}',
            '{{WRAPPER}} .app_screenshot_area .app_screenshot_slider .owl-dots .owl-dot span' => 'background: {{VALUE}}',
        ],
    ]
);
$this->add_control(
    'dot_active_color', [
        'label' => __( 'Active Dot Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'color: {{VALUE}};background: {{VALUE}}',
            '{{WRAPPER}} .app_screenshot_area .app_screenshot_slider .owl-dots .owl-dot.active span' => 'background: {{VALUE}};background: {{VALUE}}',
            '{{WRAPPER}} .nav_container .owl-dots .owl-dot.active span' => 'background: {{VALUE}};background: {{VALUE}}'
        ],
    ]
);
$this->add_control(
    'dot_dimensions',
    [
        'label' => __( 'Dot Size', 'plugin-domain' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
            ],
            '%' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 8,
        ],
        'selectors' => [
            '{{WRAPPER}} .portfolio_area .p_slider_inner ul.slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .app_screenshot_area .app_screenshot_slider .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .slick-dots li button:before' => 'line-height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'font-size: {{SIZE}}{{UNIT}};border-radius:{{SIZE}}{{UNIT}} !important',
        ],
    ]
);

$this->end_controls_section();



$this->start_controls_section(
    'carousel_arrow_style', [
        'label' => __( 'Arrow Style', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'style' => ['style_01', 'style_03' ]
        ]
    ]
);
$this->start_controls_tabs('carousel_arrow_tabs');
$this->start_controls_tab( 'carousel_arrow_tab', [
    'label' => __( 'Normal', 'saasland-core' ),
]);
$this->add_control(
    'carousel_arrow_color', [
        'label' => __( 'Arrow color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .arrow i' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_control(
    'carousel_arrow_bg', [
        'label' => __( 'Arrow Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .arrow i' => 'background: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'carousel_arrow_border',
        'label' => __( 'Border', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .arrow i',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'carousel_arrow_shadow',
        'label' => __( 'Box Shadow', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .arrow i',
    ]
);
$this->end_controls_tab();
$this->start_controls_tab( 'carousel_arrow_tab_hover', [
    'label' => __( 'Hover', 'saasland-core' ),
]);
$this->add_control(
    'carousel_arrow_hover_color', [
        'label' => __( 'Arrow color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .arrow i:hover' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_control(
    'carousel_arrow_hover_bg', [
        'label' => __( 'Arrow Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .arrow i:hover' => 'background: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'carousel_arrow_hover_border',
        'label' => __( 'Border', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .arrow i:hover',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'carousel_arrow_hover_shadow',
        'label' => __( 'Box Shadow', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .arrow i:hover',
    ]
);
$this->end_controls_tab();
$this->end_controls_tabs();

$this->end_controls_section();