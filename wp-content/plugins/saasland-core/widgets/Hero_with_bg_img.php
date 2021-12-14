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
 * Hero with Background Image
 */
class Hero_with_bg_img extends Widget_Base {

    public function get_name() {
        return 'saasland_hero_with_bg_img';
    }

    public function get_title() {
        return __( 'Hero with Background Image', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_script_depends() {
        return [ 'stellar' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'January 10, 2019 / New York City'
            ]
        );

        $this->end_controls_section(); // End Hero content


        /// --------------------  Buttons ----------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => esc_html__( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $repeater->start_controls_tab(
            'style_normal_btn',
            [
                'label' => esc_html__( 'Normal', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.about_btn' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.about_btn' => 'background: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}.about_btn' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// ----------------------------- Hover Button Style
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => esc_html__( 'Hover', 'saasland-core' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => esc_html__( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => esc_html__( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'buttons', [
                'label' => esc_html__( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_label }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => esc_html__( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .company_banner_area .company_banner_content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .company_banner_area .company_banner_content h2',
            ]
        );

        $this->end_controls_section();


        //  ------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => esc_html__( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .company_banner_area .company_banner_content h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .company_banner_area .company_banner_content h6',
            ]
        );

        $this->end_controls_section();


        //********************************************** Gradient Color *************************************************************//
        $this->start_controls_section(
            'background_style',
            [
                'label' => esc_html__( 'Background Gradient Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => esc_html__( 'Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'bg_color1', [
                'label' => esc_html__( 'Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => esc_html__( 'Color Three', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .company_banner_area' => 'background-image: -webkit-linear-gradient(125deg, {{bg_color.VALUE}} 0%, {{bg_color1.VALUE}} 64%, {{VALUE}} 100%)',
                ],
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'bg_image_sec', [
                'label' => esc_html__( 'Featured image', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'bg_img', [
                'label' => esc_html__( 'Upload the background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section(); // End Featured image


    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        ?>
        <section class="company_banner_area">
            <?php if ( !empty($settings['bg_img']['url']) ) : ?>
                <div class="parallax-effect" style="background: url(<?php echo esc_url($settings['bg_img']['url']) ?>);"></div>
            <?php endif; ?>
            <div class="container">
                <div class="company_banner_content">
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <h6><?php echo esc_html($settings['subtitle']) ?></h6>
                    <?php endif; ?>
                    <?php if (!empty($settings['title'])) : ?>
                        <h2><?php echo wp_kses_post(nl2br($settings['title'])) ?></h2>
                    <?php endif; ?>
                    <?php
                    if (!empty( $buttons )) {
                    foreach ( $buttons as $button ) {
                        ?>
                        <?php if (!empty($button['btn_label'])) : ?>
                            <a class="about_btn btn_hover elementor-repeater-item-<?php echo $button['_id'] ?>" href="<?php echo esc_url($button['btn_url']['url']) ?>"
                                <?php saasland_is_external($button['btn_url']) ?>>
                                <?php echo esc_html($button['btn_label']) ?>
                            </a>
                        <?php endif; ?>
                        <?php
                    }}
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
