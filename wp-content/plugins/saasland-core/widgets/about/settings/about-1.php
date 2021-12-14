<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    'saasland_about',
    [
        'label' => __( 'About', 'saasland-core' ),
    ]
);
$this->add_control(
    'about_title', [
        'label' => esc_html__( 'Title', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'Best Selling Product of the month'
    ]
);
$this->add_control(
    'about_description', [
        'label' => esc_html__( 'Description', 'saasland-core' ),
        'type' => Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => ''
    ]
);
$this->add_control(
    'about_btn_label', [
        'label' => esc_html__( 'Button Label', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default' => ''
    ]
);
$this->add_control(
    'about_btn_url', [
        'label' => esc_html__( 'Button URL', 'saasland-core' ),
        'type' => Controls_Manager::URL,
        'label_block' => true,

    ]
);
$this->add_control(
    'about_feature_img1', [
        'label' => esc_html__( 'Feature image One', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'label_block' => true,

    ]
);
$this->add_control(
    'about_feature_img2', [
        'label' => esc_html__( 'Feature image Two', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'label_block' => true,

    ]
);
$this->add_control(
    'about_background_text', [
        'label' => esc_html__( 'Background Text', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,

    ]
);

$this->end_controls_section();


/*--------------------------Style------------------------*/
$this->start_controls_section(
    'about_styling', [
        'label' => esc_html__( 'Content Styling', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);
$this->add_control(
    'about_title_margin',
    [
        'label' => __( 'Title Margin', 'plugin-domain' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .gadget_details h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->add_control(
    'about_title_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_details h2' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'about_title_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_details h2',
    ]
);
$this->add_control(
    'about_desc_margin',
    [
        'label' => __( 'Description Margin', 'plugin-domain' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .gadget_details p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'separator' => 'before'
    ]
);
$this->add_control(
    'about_desc_color', [
        'label' => __( 'Description Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_details p' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'about_desc_typo',
        'label' => __( 'Description Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_details p',

    ]
);

$this->add_control(
    'about_button_headding', [
        'label' => __( 'Button Style', 'saasland-core' ),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before'
    ]
);
$this->start_controls_tabs( 'about_button_style_tab' );
$this->start_controls_tab(
    'about_btn_style_normal', [
        'label' => esc_html__( 'Normal', 'saasland-core' ),
    ]
);
$this->add_control(
    'about_btn_color', [
        'label' => __( 'Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_btn' => 'color: {{VALUE}}',
        ]
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'about_btn_bg_color',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .gadget_btn',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'about_btn_box_shadow',
        'label' => __( 'Box Shadow', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .gadget_btn',
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'about_btn_typo',
        'label' => __( 'Button Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_btn',
        'separator' => 'after'
    ]
);
$this->end_controls_tab();
$this->start_controls_tab(
    'about_btn_style_hover', [
        'label' => esc_html__( 'Hover', 'saasland-core' )
    ]
);
$this->add_control(
    'btn_hover_color', [
        'label' => __( 'Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_btn:hover' => 'color: {{VALUE}}',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'about_btn_hover_bg_color',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient' ],
        'selector' => '{{WRAPPER}} .gadget_btn:hover',
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'about_btn_hover_box_shadow',
        'label' => __( 'Box Shadow', 'saasland-core' ),
        'selector' => '{{WRAPPER}} .gadget_btn:hover',
    ]
);
$this->end_controls_tab();
$this->end_controls_tabs();

$this->add_control(
    'about_bg_text_headding', [
        'label' => __( 'Background Text Style', 'saasland-core' ),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before'
    ]
);
$this->add_control(
    'about_bg_text_color', [
        'label' => __( 'Background Text Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .text_shadow' => 'color: {{VALUE}}',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'about_background_text_typo',
        'label' => __( 'Button Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .text_shadow',
        'separator' => 'after'
    ]
);
$this->end_controls_section();