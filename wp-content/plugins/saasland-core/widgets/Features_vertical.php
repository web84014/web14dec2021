<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/**
 * Features (Vertical)
 */
class Features_vertical extends Widget_Base {

    public function get_name() {
        return 'Saasland_features_vertical';
    }

    public function get_title() {
        return __( 'Features (Vertical)', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-elementor';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /*public function get_script_depends() {
        return [ 'circle-progress' ];
    }*/

    protected function _register_controls() {

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Our Services'
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
            'title_icon', [
                'label' => esc_html__( 'Title Icon', 'saasland-core' ),
                'description' => esc_html__( 'Thee title icon will display above the section title', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home9/icon3.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_service_area .f_p.w_color.f_700' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_service_area .f_p.w_color.f_700',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle  ------------------------------
        $this->start_controls_section(
            'desc_sec', [
                'label' => __( 'Description', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_service_area .service-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_service_area .service-content p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'features', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Subtitle', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon Type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'image_icon',
                        'options' => [
                            'ti' => __( 'Themify Icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'icon_color',
                        'label' => __( 'Icon Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .icon i' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'bg_color',
                        'label' => __( 'Icon Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'background-color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Themify Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url( 'images/home9/icon4.png', __FILE__),
                        ],
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
                    ],
                ],
            ]
        );

        $this->end_controls_section();



        // ---------------- Style Title
        $this->start_controls_section(
            'style_feature_item_title', [
                'label' => __( 'Feature Item Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_service_item h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_service_item h3',
            ]
        );

        $this->end_controls_section();


        // ----------- Style subtitle
        $this->start_controls_section(
            'style_feature_item_subtitle', [
                'label' => __( 'Feature Item Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_service_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_service_item p',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_shape', [
                'label' => __( 'Background Shape Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home9/shape_two.png', __FILE__),
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        ?>
        <section class="payment_service_area" style="background: url(<?php echo esc_url($settings['bg_shape']['url']) ?>) no-repeat scroll center 0; background-size: cover;">
        <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-4">
                <div class="service-content wow fadeInRight" data-wow-delay="0.2s">
                    <div class="pay_icon">
                        <div class="icon_shape"></div>
                        <img src="<?php echo esc_url($settings['title_icon']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                    </div>
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_p w_color f_700"> <?php echo nl2br($settings['title']) ?> </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_p w_color"> <?php echo nl2br($settings['subtitle']) ?> </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    if (!empty($settings['features'])) {
                    $i = 0.2;
                    foreach ($settings['features'] as $feature) {
                        ?>
                        <div class="col-md-6 media payment_service_item wow fadeInUp <?php echo 'elementor-repeater-item-' . $feature['_id'] . '"';?>"
                            data-wow-delay="<?php echo esc_attr($i) ?>s">
                            <div class="icon">
                                <?php
                                if ($feature['icon_type'] == 'ti' ) { ?>
                                    <i class="<?php echo esc_attr($feature['ti']) ?>"></i>
                                    <?php
                                } elseif ($feature['icon_type'] == 'image_icon' ) {
                                    echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                }
                                ?>
                            </div>
                            <div class="media-body">
                                <h3 class="f_size_20 f_p w_color f_600"><?php echo esc_html($feature['title']) ?></h3>
                                <?php if (!empty($feature['subtitle'])) : ?>
                                    <p class="f_400 f_size_15 w_color"> <?php echo $feature['subtitle']; ?> </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                        $i = $i + 0.1;
                    }}
                    ?>
                </div>
            </div>
        </div>
        </div>
        </section>
        <?php
    }
}