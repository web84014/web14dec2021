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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Counter extends Widget_Base {

    public function get_name() {
        return 'saasland_stats_counter';
    }

    public function get_title() {
        return __( 'Stats counter', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'waypoints', 'counterup' ];
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
                'default' => 'Trusted'
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
                'default' => 'h1',
                'separator' => 'before',
            ]
            );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .w_color.f_p.f_700.mb_20' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .w_color.f_p.f_700.mb_20',
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
                    '{{WRAPPER}} .fun_fact_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .fun_fact_content p',
            ]
        );

        $this->end_controls_section(); // End description section

        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'counters_sec', [
                'label' => __( 'Counter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'counters', [
                'label' => __( 'Counters', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ label }}}',
                'fields' => [
                    [
                        'name' => 'label',
                        'label' => __( 'Count label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => 'Users trust our tools'
                    ],
                    [
                        'name' => 'count_value',
                        'label' => __( 'Count to', 'saasland-core' ),
                        'type' => Controls_Manager::NUMBER,
                        'default' => '7'
                    ],
                    [
                        'name' => 'count_append',
                        'label' => __( 'Count Append Text', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'M+'
                    ],
                ],
            ]
        );
        $this->end_controls_section(); // Facts


        // ------------------------------ Featured Image ------------------------------
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Counter ------------------------------
        $this->start_controls_section(
            'style_counter_sec', [
                'label' => __( 'Style Title Counter', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fun_fact_content .fact_item h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_counter_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .fun_fact_content .fact_item h5',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Counter subtitle ------------------------------
        $this->start_controls_section(
            'style_counter_sec2', [
                'label' => __( 'Style Subtitle Counter', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_subtitle_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.mb-0.d_p_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_counter_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.mb-0.d_p_color',
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Section ------------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .fun_fact_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [

                ],
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fun_fact_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'is_shape1',
            [
                'label' => __( 'Triangle Shape 1', 'saasland-core' ),
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
                    'is_shape1' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape1_color_right', [
                'label'     => esc_html__( 'Shape 1 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .fact_author_img .box_three' => 'background-image: -webkit-linear-gradient(140deg, {{shape1_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape1' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'is_shape2',
            [
                'label' => __( 'Triangle Shape 2', 'saasland-core' ),
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
                    'is_shape2' => ['yes'],
                ]
            ]
        );

        $this->add_control(
            'shape2_color_right', [
                'label'     => esc_html__( 'Shape 2 Color Right', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .fact_author_img .box_four' => 'background-image: -webkit-linear-gradient(140deg, {{shape2_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'is_shape2' => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        wp_enqueue_style( 'simple-line-icons' );
        $settings = $this->get_settings();
        $counters = isset($settings['counters']) ? $settings['counters'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h1';
        ?>
        <section class="fun_fact_area dk_bg_two">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-7 col-md-6">
                        <div class="fact_author_img text-right">
                            <?php if ( $settings['is_shape1'] == 'yes' ) : ?>
                                <div class="square_box box_three"></div>
                            <?php endif; ?>
                            <?php if ( $settings['is_shape2'] == 'yes' ) : ?>
                                <div class="square_box box_four"></div>
                            <?php endif; ?>
                            <?php echo wp_get_attachment_image($settings['featured_image']['id'], 'full', '', array( 'class' => 'wow fadeInUp', 'data-wow-delay' => '0.4s')) ?>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="fun_fact_content">
                            <?php if (!empty($settings['title'])) : ?>
                                <<?php echo $title_tag ?> class="w_color f_p f_700 mb_20">
                                    <?php echo saasland_kses_post(nl2br($settings['title'])) ?>
                                </<?php echo $title_tag; ?>>
                            <?php endif; ?>
                            <?php if (!empty($settings['desc'])) : ?>
                                <p class="f_300 d_p_color f_size_15 l_height28 mb_40">
                                    <?php echo saasland_kses_post(nl2br($settings['desc'])) ?> </p>
                            <?php endif; ?>
                            <div class="d-flex">
                                <?php
                                if (is_array($counters)) {
                                foreach ($counters as $i => $counter) { ?>
                                    <div class="fact_item <?php echo ($i == 0) ? '' : 'pl_100'; ?>">
                                        <h5 class="w_color">
                                            <span class="counter"><?php echo esc_html($counter['count_value']) ?></span><?php echo esc_html($counter['count_append']) ?>
                                        </h5>
                                        <p class="mb-0 d_p_color">
                                            <?php echo saasland_kses_post(nl2br($counter['label'])) ?>
                                        </p>
                                    </div>
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}