<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    '_product_tab_filter', [
        'label' => __( 'Filters', 'saasland-core' ),
        'condition' => [
            'product_style' => ['4']
        ]
    ]
);
$this->add_control(
    '_product_show_count', [
        'label' => esc_html__( 'Show products', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 6,

    ]
);
$this->add_control(
    '_tab_product_order', [
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
    '_tab_product_exclude', [
        'label' => esc_html__( 'Exclude Products', 'saasland-core' ),
        'description' => esc_html__( 'Enter the product post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,

    ]
);
$this->end_controls_section();

/*======================== Product Tab Style =========================*/
$this->start_controls_section(
    'product_tab_style', [
        'label' => __( 'Tab Style', 'saasland-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['4']
        ]
    ]
);
$this->start_controls_tabs( '_product_tab_style_tab');
$this->start_controls_tab( '_product_tab_style_normal', [
    'label' => esc_html__('Normal', 'saasland-core')
    ]
);
$this->add_control(
    'tab_label_color', [
        'label' => __( 'Tab label Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .product_filter .work_portfolio_item' => 'color: {{VALUE}};',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'tab_label_typo',
        'label' => __( 'Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .product_filter .work_portfolio_item',
        'separator' => 'after'
    ]
);
$this->add_control(
    'tab_item_margin',
    [
        'label' => __( 'Margin', 'plugin-domain' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .product_filter .work_portfolio_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->end_controls_tab();
$this->start_controls_tab( '_product_tab_style_active', [
    'label' => esc_html__('Active/Hover', 'saasland-core')
    ]
);
$this->add_control(
    'tab_label_hover_color', [
        'label' => __( 'Tab label Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .product_filter .work_portfolio_item:hover' => 'color: {{VALUE}};',
            '{{WRAPPER}} .product_filter .work_portfolio_item.active' => 'color: {{VALUE}};',
            '{{WRAPPER}} .product_filter .work_portfolio_item:before' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->end_controls_tab();
$this->end_controls_tabs();
$this->end_controls_section();

/*======================Product Style=======================*/
$this->start_controls_section(
    'tab_product_style', [
        'label' => esc_html__( 'Product Style', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['2', '3', '4']
        ]
    ]
);

$this->start_controls_tabs( 'tab_product_content_style' );
$this->start_controls_tab(
    'product_style_normal', [
        'label' => esc_html__( 'Normal', 'saasland-core' )
    ]
);
$this->add_control(
    '_product_title_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .single_pr_details h3' => 'color: {{VALUE}}',
        ],
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => '_title_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_pr_item .single_pr_details h3',
    ]
);

$this->add_control(
    '_regular_price_color', [
        'label' => __( 'Regular Price Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .single_pr_details .price>del .woocommerce-Price-amount' => 'color: {{VALUE}}',
            '{{WRAPPER}} .gadget_pr_item .single_pr_details .price del' => 'color: {{VALUE}}',
        ],
        'separator' => 'before'
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => '_regular_price_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_pr_item .single_pr_details .price>del .woocommerce-Price-amount',
    ]
);

$this->add_control(
    '_sell_price_color', [
        'label' => __( 'Sell Price Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .single_pr_details .price .woocommerce-Price-amount' => 'color: {{VALUE}}',
        ],
        'separator' => 'before'
    ]
);
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => '_sell_price_typo',
        'label' => __( 'Sell Price Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} .gadget_pr_item .single_pr_details .price .woocommerce-Price-amount',
        'separator' => 'after'
    ]
);
$this->add_control(
    '_cart_icon_bg', [
        'label' => __( 'Cart Icon Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .pr_img .hover_content a' => 'background-color: {{VALUE}}',
        ],
        'separator' => 'before'
    ]
);

$this->end_controls_tab();

$this->start_controls_tab(
    'style_hover', [
        'label' => esc_html__( 'Hover', 'saasland-core' )
    ]
);
$this->add_control(
    'title_hover_color', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .single_pr_details h3' => 'color: {{VALUE}}',
        ],
    ]
);
$this->add_control(
    '_cart_icon_hover_bg', [
        'label' => __( 'Cart Icon Background', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .gadget_pr_item .pr_img .hover_content a:before' => 'background-color: {{VALUE}}',
        ],
        'separator' => 'before'
    ]
);
$this->end_controls_tab();
$this->end_controls_tabs();
$this->end_controls_section();