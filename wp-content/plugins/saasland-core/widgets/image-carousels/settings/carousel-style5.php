<?php
use Elementor\Controls_Manager;

$this->start_controls_section(
    'carousel5_sec', [
        'label' => __( 'Carousel', 'saasland-core' ),
        'condition' => [
            'style' => 'style_05',
        ]
    ]
);

$repeater = new \Elementor\Repeater();
$repeater->add_control(
    'site_title', [
        'label' => __( 'Title', 'saasland-core' ),
        'type' => Controls_Manager::TEXT,
        'label_block' => true,
    ]
);

$repeater->add_control(
    'site_url', [
        'label' => __( 'URL', 'saasland-core' ),
        'type' => Controls_Manager::URL,
        'default' => [
            'url' => '#'
        ]
    ]
);

$repeater->add_control(
    'image', [
        'label' => __( 'Image', 'saasland-core' ),
        'type' => Controls_Manager::MEDIA,
    ]
);

$this->add_control(
    'carousel5', [
        'label' => __( 'Images with Title', 'saasland-core' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'title_field' => '{{{ site_title }}}',
        'fields' => $repeater->get_controls()
    ]
);

$this->end_controls_section(); // Carousels 05
