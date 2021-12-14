<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Serialized Features
 */
class Serialized_features extends Widget_Base {
    public function get_name() {
        return 'saasland_serialized_features';
    }

    public function get_title() {
        return __( 'Serialized Features', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //********************************** Feature Section ********************************//
        $this->start_controls_section(
            'feature_section', [
                'label' => esc_html__( 'Feature Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'feature_title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Our great services'
            ]
        );

        $this->add_control(
            'feature_subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Skive off mush victoria sponge super lavatory it\'s all gone to pot <br>  knees up fanny around vagabond'
            ]
        );

        $this->end_controls_section();

        //************************************** Feature List ********************************//
        $this->start_controls_section(
            'feature_sec',
            [
                'label' => esc_html__( 'Features List', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' =>Controls_Manager::TEXT,
                'default' => 'Awesome design',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'contents',
            [
                'label' => esc_html__( 'Content', 'saasland-core' ),
                'type' =>Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'img_icon',
            [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home10/icon1.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'feature_list',
            [
                'label' => esc_html__( 'Feature list', 'saasland-core' ),
                'type' =>Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}'
            ]
        );

        $this->end_controls_section();


        /**
         * Tab Style
         * Text Color
         * Background
         * Typography
         */
        // *************************** Section Title Style ******************************//
        $this->start_controls_section(
            'style_feature_title_sec', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_title', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .f_600.f_600.f_p.l_height50.f_size_30',
            ]
        );

        $this->end_controls_section();

        // *************************** Section Serial Number Style ******************************//
        $this->start_controls_section(
            'serial_number_sec', [
                'label' => esc_html__( 'Serial Number', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'serial_no_font_color', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'serial_no_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .number' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'serial_no_border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .number' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Hover Stats style
         ******************************/
        $this->start_controls_section(
            'hover_style_sec', [
                'label' => esc_html__( 'Serial Number Hover', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hover_serial_color_bg_sec', [
                'label' => esc_html__( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover .number' => 'background: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_color', [
                'label' => esc_html__( 'Separator Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .separator:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_serial_font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'hover_serial_number_box-shadow',
                'label' => esc_html__( 'Box shadow', 'saasland-core' ),
                'type' => Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .new_service .saas_features_item:hover .number'
            ]
        );

        $this->end_controls_section();


        // Feature Item on Hover
        $this->start_controls_section(
            'hover_feature_item_sec', [
                'label' => esc_html__( 'Feature Item Hover', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hover_fitem_title_color', [
                'label' => esc_html__( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_fitem_subtitle_color', [
                'label' => esc_html__( 'Subtitle Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control (
            'hover_fitem_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_service .saas_features_item:hover .new_service_content' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name' => 'hover_feature_item_shadow',
                'label' => esc_html__( 'Box shadow', 'saasland-core' ),
                'type' => Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .new_service .saas_features_item:hover .new_service_content'
            ]
        );

        $this->end_controls_section();


        // *************************** Section Background Style ******************************//
        $this->start_controls_section(
            'bg_style_sec', [
                'label' => esc_html__( 'Background Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_bg_sec', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bg_color' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = $settings['feature_list'];
        ?>
        <section class="saas_features_area_three bg_color sec_pad">
            <div class="container">

                <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
                    <?php if (!empty($settings['feature_title'])) : ?>
                        <h2 class="f_p f_size_30 l_height50 f_600 t_color"><?php echo esc_html($settings['feature_title']) ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['feature_subtitle'])) : ?>
                        <p class="f_400 f_size_16"><?php echo wp_kses_post(nl2br($settings['feature_subtitle'])) ?></p>
                    <?php endif; ?>
                </div>

                <div class="row mb_30 new_service">
                    <?php
                    $i = 1;
                    if (!empty( $features )) {
                    foreach ( $features as $feature ) {
                        ?>
                        <div class="col-lg-4 col-sm-6 elementor-repeater-item-<?php echo $feature['_id'] ?>">
                            <div class="saas_features_item text-center wow fadeInUp" data-wow-delay="0.3s">
                                <div class="number"><?php echo $i ?></div>
                                <div class="separator"></div>
                                <div class="new_service_content">
                                    <?php if (!empty($feature['img_icon']['url'])) : ?>
                                        <img src="<?php echo esc_url($feature['img_icon']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($feature['title'])) : ?>
                                        <h4 class="f_size_20 f_p t_color f_500"><?php echo esc_html($feature['title']) ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($feature['contents'])) : ?>
                                        <p class="f_400 f_size_15 mb-0"><?php echo wp_kses_post($feature['contents']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i ++;
                    }}
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}