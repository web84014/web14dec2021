<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

$this->start_controls_section(
    'cats_block_5', [
        'label' => __( 'Category Block', 'saasland-core' ),
        'condition' => [
            'product_style' => ['5']
        ]
    ]
);
$cats = new \Elementor\Repeater();
$cats->start_controls_tabs( '_product_category_block_tab' );
$cats->start_controls_tab( '_product_category_block_tab_content', [
        'label' => __('Content', 'saasland-core')
    ]
);
$cats->add_control(
    '_cat_id', [
        'label' => __( 'Category Name', 'saasland-core' ),
        'description' => __( 'Choose a category name to display.', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::SELECT,
        'options' => saasland_cat_array('product_cat'),
        'default' => 'uncategorized'
    ]
);
$cats->add_control(
    '_cat_column', [
        'label' => __( 'Column', 'saasland-core' ),
        'description' => __( 'Choose a column size you want to place in the category.', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::SELECT,
        'options' => [
            '12' => '12/12 (full width)',
            '6' => '12/6 (half of the full width)',
            '4' => '12/4 (33% of the full width)',
            '3' => '12/3 (25% of the full width)',
        ],
        'default' => '6'
    ]
);
$cats->add_control(
    '_cat_img', [
        'label' => __( 'Featured Image', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::MEDIA,
    ]
);
$cats->end_controls_tab();
$cats->start_controls_tab( '_product_category_block_tab_style', [
        'label' => __('Style', 'saasland-core')
    ]
);
$cats->add_control(
    '_cat_title_color', [
        'label' => __( 'Category Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .cat_name' => 'color: {{VALUE}}'
        ]
    ]
);
$cats->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'cat_name_typo',
        'label' => __( 'Category Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .cat_name',
        'separator' => 'after'
    ]
);
$cats->add_control(
    '_cat_btn_color', [
        'label' => __( 'Button Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_btn' => 'color: {{VALUE}}'
        ],
        'separator' => 'before'
    ]
);
$cats->add_control(
    '_cat_btn_hover_color', [
        'label' => __( 'Button Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .shop_btn:hover' => 'color: {{VALUE}}'
        ],
        'separator' => 'before'
    ]
);
$cats->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'cat_btn_typo',
        'label' => __( 'Button Typography', 'saasland-core' ),
        'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .shop_btn',
        'separator' => 'after'
    ]
);
$cats->add_control(
    'item_padding',
    [
        'label' => __( 'Item Padding', 'saasland-core' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$cats->end_controls_tab();
$cats->end_controls_tabs();

$this->add_control(
    '_categories_block', [
        'label' => __( 'Categories', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'title_field' => '{{{ _cat_id }}}',
        'fields' => $cats->get_controls(),
    ]
);
$this->end_controls_section();

/*========================= Category Block Style ===========================*/
$this->start_controls_section(
    'product_category_block_settings', [
        'label' => __( 'Section Style', 'saasland-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['5']
        ]
    ]
);
$this->add_control(
    'cat_block_margin',
    [
        'label' => __( 'Margin', 'saasland-core' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .shop_featured_gallery_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->add_control(
    'cat_block_padding',
    [
        'label' => __( 'Padding', 'saasland-core' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .shop_featured_gallery_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'cat_block_bg',
        'label' => __( 'Background', 'saasland-core' ),
        'types' => [ 'classic', 'gradient', 'video' ],
        'selector' => '{{WRAPPER}} .shop_featured_gallery_area',
    ]
);
$this->end_controls_section();