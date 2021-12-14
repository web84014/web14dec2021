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
 * Features <br> with Shapes (Dark)
 */
class Features_with_shapes extends Widget_Base {

    public function get_name() {
        return 'Saasland_features_with_shapes';
    }

    public function get_title() {
        return __( 'Features <br> with Shapes (Dark)', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-posts-grid';
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
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saas_featured_content h2',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Description  ------------------------------
        $this->start_controls_section(
            'desc_sec', [
                'label' => __( 'Description', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'desc', [
                'label' => esc_html__( 'Description Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_desc', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saas_featured_content p',
            ]
        );

        $this->end_controls_section(); // End description section


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
                        'name' => 'desc',
                        'label' => __( 'Description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon Type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'ti',
                        'options' => [
                            'ti' => __( 'Themify Icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
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
                        'name' => 'bg_color_left',
                        'label' => __( 'Background Color Left', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                    ],
                    [
                        'name' => 'bg_color_right',
                        'label' => __( 'Background Color Right', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'output' => array(
                            '{{CURRENT_ITEM}} .saas_featured_item' => 'background-image: -webkit-linear-gradient(40deg, {{bg_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                        ),
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        // --------------------------------- Buttons --------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'btn_normal_color', [
                'label' => esc_html__( 'Normal color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_five' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_color', [
                'label' => esc_html__( 'Hover color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_five:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End the Button


        /**
         * Feature Item Title
         */
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
                    '{{WRAPPER}} .saas_featured_info .saas_featured_item h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saas_featured_info .saas_featured_item h6',
            ]
        );

        $this->end_controls_section();


        // ----------------------------- Style subtitle ------------------------
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
                    '{{WRAPPER}} .saas_featured_info .saas_featured_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .saas_featured_info .saas_featured_item p',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label'     => esc_html__( 'Section Background Color', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .dk_bg_one' => 'background: {{VALUE}};',
                ),
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .saas_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_control(
            'is_btm_shape1',
            [
                'label' => __( 'Bottom Triangle Shape 1', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape1_color_left', [
                'label'     => esc_html__( 'Shape 1  Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'is_btm_shape1' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape1_color_right', [
                'label'     => esc_html__( 'Shape 1 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_one' => 'background-image: -webkit-linear-gradient(140deg, {{shape1_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_btm_shape1' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'is_btm_shape2',
            [
                'label' => __( 'Bottom Triangle Shape 2', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'shape2_color_left', [
                'label'     => esc_html__( 'Shape 2  Color Left', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'is_btm_shape1' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape2_color_right', [
                'label'     => esc_html__( 'Shape 2 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .square_box.box_two' => 'background-image: -webkit-linear-gradient(140deg, {{shape2_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_btm_shape1' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        ?>
        <section class="saas_featured_area sec_pad dk_bg_one">
            <?php if ( $settings['is_btm_shape1'] == 'yes' ) : ?>
                <div class="square_box box_one"></div>
            <?php endif; ?>
             <?php if ( $settings['is_btm_shape2'] == 'yes' ) : ?>
                <div class="square_box box_two"></div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="saas_featured_content pr_70 mt_60">
                            <?php if (!empty($settings['title'])) : ?>
                                <h2 class="f_600 f_p f_size_30 w_color l_height40 mb-30 wow fadeInUp" data-wow-delay="0.3s">
                                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                </h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['desc'])) : ?>
                                <p class="f_300 f_size_15 l_height_28 d_p_color mb_50 wow fadeInUp" data-wow-delay="0.4s">
                                    <?php echo wp_kses_post(nl2br($settings['desc'])) ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($settings['btn_label'])): ?>
                                <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                    <?php saasland_is_external($settings['btn_url']) ?>
                                    <?php echo saasland_is_external($settings['btn_url']); ?>
                                   class="btn_hover btn_five wow fadeInUp" data-wow-delay="0.5s">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-7 saas_featured_info">
                        <div class="row mb_30">
                            <?php
                            if (!empty($features)) {
                            $i = 0.3;
                            foreach ($features as $feature) {
                                $bg_color = !empty($feature['bg_color_left']) ? "style='background-image: -webkit-linear-gradient(40deg, {$feature['bg_color_left']} 0%, {$feature['bg_color_right']} 100%);'" : '';
                                ?>
                                <div class="col-lg-6 col-md-6 elementor-repeater-item-<?php echo esc_attr($feature['_id']) ?>">
                                    <div class="saas_featured_item s_featured_one wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s" <?php echo $bg_color; ?>>
                                        <?php
                                        if ($feature['icon_type'] == 'ti' ) { ?>
                                            <i class="<?php echo esc_attr($feature['ti']) ?> f_size_30"></i>
                                            <?php
                                        }elseif ($feature['icon_type'] == 'image_icon' ) {
                                            echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}>";
                                        }
                                        ?>
                                        <h6 class="mt_30 mb_20"> <?php echo esc_html($feature['title']) ?> </h6>
                                        <?php if (!empty($feature['desc'])) : ?>
                                            <p class="mb-0"> <?php echo esc_html($feature['desc']) ?> </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                                $i = $i + 0.2;
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