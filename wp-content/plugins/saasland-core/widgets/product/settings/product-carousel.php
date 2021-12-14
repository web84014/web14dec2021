<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$products_carousel = new \Elementor\Repeater();
$this->start_controls_section(
    'product_carousel_style',
    [
        'label' => __( 'Product Carousel', 'saasland-core' ),
        'condition' => [
            'product_style' => ['1']
        ]
    ]
);
$products_carousel->start_controls_tabs( 'product_carousel_option_tab' );
$products_carousel->start_controls_tab(
    'product_carousel_content', [
        'label' => __( 'Content', 'saasland-core' )
    ]
);

$products_carousel->add_control(
    'selected_id', [
        'label' => esc_html__( 'Select Product', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'label_block' => true,
        'options' => saasland_cat_array('product_cat')
    ]
);
$products_carousel->add_control(
    'product_item_title', [
        'label' => esc_html__( 'Title', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,

    ]
);
$products_carousel->add_control(
    'product_item_subtitle', [
        'label' => esc_html__( 'Sub Title', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,

    ]
);
$products_carousel->add_control(
    'see_more_label', [
        'label' => esc_html__( 'See More Label', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
        'default'   => 'See More'
    ]
);
$products_carousel->add_control(
    'product_featured_img', [
        'label' => esc_html__( 'Feature image', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
        'label_block' => true,

    ]
);
$products_carousel->end_controls_tab();
$products_carousel->start_controls_tab(
    'product_carousel_style_tab', [
        'label' => __( 'Style', 'saasland-core' )
    ]
);

$products_carousel->add_control(
    'product_carousel_title', [
        'label' => __( 'Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{CURRENT_ITEM}} .gadget_features_item .content h6' => 'color: {{VALUE}};',
        ],
    ]
);
$products_carousel->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'product_carousel_title_typo',
        'label' => __( 'Title Typography', 'saasland-core' ),
        'selector'  => '{{CURRENT_ITEM}} .gadget_features_item .content h6',
        'separator' => 'after'
    ]
);
$products_carousel->add_control(
    'product_carousel_subtitle_color', [
        'label' => __( 'Sub-Title Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{CURRENT_ITEM}} .gadget_features_item .content h3' => 'color: {{VALUE}};',
        ],
    ]
);
$products_carousel->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'product_carousel_subtitle_typo',
        'label' => __( 'Sub-title Typography', 'saasland-core' ),
        'selector'  => '{{CURRENT_ITEM}} .gadget_features_item .content h3',
        'separator' => 'after'
    ]
);
$products_carousel->add_control(
    'product_carousel_readmore_color', [
        'label' => __( 'Read More Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{CURRENT_ITEM}} .gadget_features_item .content .see_btn' => 'color: {{VALUE}};',
            '{{CURRENT_ITEM}} .gadget_features_item .content .see_btn:before' => 'background: {{VALUE}};',
        ],
    ]
);
$products_carousel->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'product_carousel_readmore_typo',
        'label' => __( 'Read More Typography', 'saasland-core' ),
        'selector'  => '{{CURRENT_ITEM}} .gadget_features_item .content .see_btn',
        'separator' => 'after'
    ]
);
$products_carousel->add_control(
    'product_carousel_bg_color1', [
        'label' => __( 'Background Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{CURRENT_ITEM}} .gadget_features_item' => 'background-color: {{VALUE}};',
        ],
    ]
);
$products_carousel->add_control(
    'product_carousel_bg_color2', [
        'label' => __( 'Background Gradient Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
    ]
);

$products_carousel->end_controls_tab();
$products_carousel->end_controls_tabs();

$this->add_control(
    'selected_products', [
        'label' => __( 'Product Carousel', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'title_field' => '{{{ selected_id }}}',
        'fields' => $products_carousel->get_controls(),
    ]
);


$this->end_controls_section();