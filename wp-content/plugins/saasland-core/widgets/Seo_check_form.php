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
 * Check URL Form
 */
class Seo_check_form extends Widget_Base {
    public function get_name() {
        return 'saasland_seo_check_form';
    }

    public function get_title() {
        return __( 'Check URL Form', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

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
                'default' => 'Check your Website’s SEO!'
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} h2',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ MailChimp form ------------------------------
        $this->start_controls_section(
            'form_settings', [
                'label' => __( 'Form settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Submit Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Check',
            ]
        );

        $this->add_control(
            'url_placeholder', [
                'label' => esc_html__( 'URL Filed Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Enter URL',
            ]
        );

        $this->add_control(
            'action_url', [
                'label' => esc_html__( 'Action URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


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
            'bg_image', [
                'label' => esc_html__( 'Background Image 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/seo/cloud_bg.png', __FILE__)
                ],
            ]
        );

        $this->add_control(
            'bg_image2', [
                'label' => esc_html__( 'Background Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/seo/cloud.png', __FILE__)
                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .seo_subscribe_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .seo_subscribe_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_render_attribute( 'action_url', 'action', $settings['action_url']);
        $this->add_render_attribute( 'bg_image', 'style', "background: url({$settings['bg_image']['url']}) no-repeat scroll center 0/cover");
        $this->add_render_attribute( 'bg_image2', 'style', "background: url({$settings['bg_image2']['url']}) no-repeat");
        $this->add_render_attribute( 'url_placeholder', 'placeholder', "{$settings['url_placeholder']}");
        ?>
        <section class="seo_subscribe_area">
            <div class="overlay_img" <?php echo $this->get_render_attribute_string( 'bg_image' ) ?>></div>
            <div class="cloud_img" <?php echo $this->get_render_attribute_string( 'bg_image2' ) ?>></div>
            <div class="container">
                <div class="seo_sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p> <?php echo nl2br($settings['subtitle']) ?> </p>
                    <?php endif; ?>
                </div>
                <form <?php echo $this->get_render_attribute_string( 'action_url' ) ?> class="row seo_subscribe_form">
                    <div class="input-group col-lg-9">
                        <input type="url" name="website" id="website" <?php echo $this->get_render_attribute_string( 'url_placeholder' ) ?> class="form-control">
                    </div>
                    <?php if (!empty($settings['btn_label'])) : ?>
                        <div class="input-group col-lg-3">
                            <input type="submit" name="submit" value="<?php echo esc_attr($settings['btn_label']); ?>" class="check-btn">
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </section>
        <?php
    }
}