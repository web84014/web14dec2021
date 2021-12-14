<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Website Footer
 */
class Footer extends Widget_Base {

    public function get_name() {
        return 'saasland_footer';
    }

    public function get_title() {
        return __( 'Website Footer', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        /**
         * Style Tab
         */
        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_note', [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'This is the website default footer. You can control the Footer from Theme Settings > Footer. Set the widgets from Appearance > Widgets', 'saasland-core' ),
                'content_classes' => 'elementor-warning',
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .new_footer_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $opt = get_option( 'saasland_opt' );
        $copyright_text = !empty($opt['copyright_txt']) ? $opt['copyright_txt'] : esc_html__( '© 2020 DroitThemes. All rights reserved', 'saasland-core' );
        $right_content = !empty($opt['right_content']) ? $opt['right_content'] : '';
        wp_enqueue_style( 'saasland-footer' );
        ?>
        <footer class="new_footer_area bg_color">
            <div class="new_footer_top">
                <?php if ( is_active_sidebar('footer_widgets') ) { ?>
                    <div class="container">
                        <div class="row">
                            <?php dynamic_sidebar( 'footer_widgets' ) ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="footer_bg">
                    <?php if (!empty($opt['footer_obj_1']['url'])) : ?>
                        <div class="footer_bg_one"></div>
                    <?php endif; ?>
                    <?php if (!empty($opt['footer_obj_2']['url'])) : ?>
                        <div class="footer_bg_two"></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-7">
                            <?php echo wp_kses_post(wpautop($copyright_text)); ?>
                        </div>
                        <div class="col-lg-6 col-sm-5 text-right">
                            <?php echo wp_kses_post(wpautop($right_content)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}