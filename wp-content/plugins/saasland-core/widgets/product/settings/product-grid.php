<?php


use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

$this->start_controls_section(
    'saasland_product_filter', [
        'label' => __( 'Filters', 'saasland-core' ),
        'condition' => [
            'product_style' => ['2','3']
        ]
    ]
);
$this->add_control(
    'select_product_query', [
        'label' => __( 'Product Query', 'saasland-core' ),
        'type' => Controls_Manager::SELECT,
        'options' => [
            '1' => __( 'All Product', 'saasland-core' ),
            '2' => __( 'product Category', 'saasland-core' ),
            '3' => __( 'Featured product', 'saasland-core' ),
        ],
        'default' => '1',
        'label_block' => true
    ]
);
$this->add_control(
    'product_cat_slug', [
        'label' => __( 'Category Name', 'saasland-core' ),
        'description' => __( 'Choose a category name to display.', 'saasland-core' ),
        'separator' => 'before',
        'type' => Controls_Manager::SELECT,
        'options' => saasland_cat_array('product_cat'),
        'default' => 'uncategorized',
        'condition' => [
            'select_product_query' => ['2']
        ]
    ]
);
$this->add_control(
    'saasland_featured_product', [
        'label' => __( 'Featured Product', 'saasland-core' ),
        'description' => __( 'Choose Products name to display.', 'saasland-core' ),
        'separator' => 'before',
        'label_block'   => true,
        'type' => Controls_Manager::SELECT2,
        'options' => get_products_title(),
        'multiple' => true,
        'condition' => [
            'select_product_query' => ['3']
        ]
    ]
);

$this->add_control(
    'product_show_count', [
        'label' => esc_html__( 'Show products', 'saasland-core' ),
        'type' => Controls_Manager::NUMBER,
        'default' => 6,
        'condition' => [
            'select_product_query' => ['1', '2']
        ]
    ]
);

$this->add_control(
    'product_order', [
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
    'product_exclude', [
        'label' => esc_html__( 'Exclude Products', 'saasland-core' ),
        'description' => esc_html__( 'Enter the product post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'condition' => [
            'select_product_query' => ['1', '2']
        ]
    ]
);


$this->end_controls_section();


/*====================== Product Column Settings ==========================*/
$this->start_controls_section(
    'product_column_settings', [
        'label' => __( 'Column Settings', 'saasland-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['2', '4']
        ]
    ]
);
$this->add_control(
    'product_col',
    [
        'label' => __( 'Product Column', 'saasland-core' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            '6' => __( '2', 'saasland-core' ),
            '4' => __( '3', 'saasland-core' ),
            '3' => __( '4', 'saasland-core' ),
            '2' => __( '6', 'saasland-core' )
        ],
        'default'   => '4'
    ]
);
$this->end_controls_section();


/*====================== Product Background ==========================*/
$this->start_controls_section(
    'product_background_shape', [
        'label' => __( 'Style', 'saasland-core' ),
        'tab'   => Controls_Manager::TAB_STYLE,
        'condition' => [
            'product_style' => ['2']
        ]
    ]
);

$this->add_control(
    'backgropund_shape_1', [
        'label' => esc_html__( 'Background Shape 1', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);
$this->add_control(
    'backgropund_shape_2', [
        'label' => esc_html__( 'Background Shape 2', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);
$this->end_controls_section();