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
 * Processes
 */
class Processes extends Widget_Base {

    public function get_name() {
        return 'Saasland_processes';
    }

    public function get_title() {
        return __( 'Processes', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-product-related';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        // ---------------------------------------- Select Style  ------------------------------ //
        $this->start_controls_section(
            'select_style',
            [
                'label' => __( 'Process Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        //----------------------------- row 01 -------------------------------------//
        /// --------------- Images ----------------
        $repeater_fields = new \Elementor\Repeater();
        $repeater_fields->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater_fields->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater_fields->add_control(
            'btn_type', [
                'label' => __( 'Button Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => 'Icon',
                    'button' => 'Button'
                ]
            ]
        );

        $repeater_fields->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url'   => '#'
                ]
            ]
        );

        $repeater_fields->add_control(
            'btn_icon', [
                'label' => __( 'Button Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'condition' => [
                    'btn_type' => ['icon']
                ]
            ]
        );

        $repeater_fields->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Get in Touch',
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );


        //---------------------------- Normal and Hover Style ---------------------------//
        $repeater_fields->start_controls_tabs(
            'style_tabs'
        );


        /************************** Normal Color *****************************/
        $repeater_fields->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_banner_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_featured_content .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $repeater_fields->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}  .agency_banner_btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_banner_btn' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'icon_bg_color', [
                'label' => esc_html__( 'Background Color One', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'btn_type' => ['icon']
                ]
            ]
        );

        $repeater_fields->add_control(
            'icon_bg_color2', [
                'label' => esc_html__( 'Background Color Two', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'background-image: linear-gradient( 40deg, {{icon_bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
                'condition' => [
                    'btn_type' => ['icon']
                ]
            ]
        );

        $repeater_fields->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'label' => __( 'Box Shadow', 'plugin-domain' ),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .icon',
                'condition' => [
                    'btn_type' => ['icon']
                ]
            ]
        );

        $repeater_fields->end_controls_tab();

        //**************************** Hover Color *****************************//
        $repeater_fields->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_banner_btn:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_banner_btn:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .agency_banner_btn:hover' => 'border: 1px solid {{VALUE}}',
                ],
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->end_controls_tab();

        $repeater_fields->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater_fields->add_control(
            'custom_number', [
                'label' => __( 'Custom Number', 'saasland-core' ),
                'description' => __( '1-5 number will be placed automatically. If you upload here the Custom Number, the automatic number will not shown up. Or you can use here your icons instead of the numbers.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater_fields->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'rows_note', [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __( 'Currently the dashed line will show for 5 process items.', 'saasland-core' ),
                'content_classes' => 'elementor-warning',
            ]
        );

        $this->add_control(
            'rows', [
                'label' => __( 'Processes', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater_fields->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Hero content

        $this->start_controls_section(
            'content_section2',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'condition' => [
                        'style' => 'style_02'
                ]
            ]
        );
        //-------------------------------- Rows Two ---------------------------------//
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,

            ]
        );

        $repeater->add_control(
            'process_serial_no',
            [
                'label' => esc_html__( 'Process Serial Number', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'fimage',
            [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'rows2', [
                'label' => __( 'Processes', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                        'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_featured_area h2.text-center' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .agency_featured_area h2.text-center'
            ]
        );

        $this->end_controls_section();

        // Process Title
        $this->start_controls_section(
            'style_process_title', [
                'label' => __( 'Style Process Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_process_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_featured_item .agency_featured_content h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .setup_inner .setup_content h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_process_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .agency_featured_item .agency_featured_content h3,
				    {{WRAPPER}} .setup_inner .setup_content h5
                    '
            ]
        );

        $this->end_controls_section();

        // Style Process description
        $this->start_controls_section(
            'style_process_desc', [
                'label' => __( 'Style Process Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_process_desc', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_featured_item .agency_featured_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .setup_inner .setup_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_process_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .agency_featured_item .agency_featured_content p,
				    {{WRAPPER}} .setup_inner .setup_content p
				    '
            ]
        );

        $this->end_controls_section();


        /**
         * Style Number
         */
        $this->start_controls_section(
            'style_process_number', [
                'label' => __( 'Style Number', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'color_process_number', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .setup_inner .setup_item .round' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_process_number', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .setup_inner .setup_item .round' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_process_number',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
				    {{WRAPPER}} .setup_inner .setup_item .round
				    '
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                        'style' => 'style_01'
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $rows = isset($settings['rows']) ? $settings['rows'] : '';
        $rows2 = isset($settings['rows2']) ? $settings['rows2'] : '';
        if ( $settings['style'] == 'style_01' ) {
            ?>
            <section class="agency_featured_area">
                <div class="container">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2 class="f_size_30 f_600 t_color3 l_height40 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </h2>
                    <?php endif; ?>
                    <div class="features_info">
                        <?php
                        if (count($rows) == 2) { ?>
                            <img class="dot_img" src="<?php echo plugins_url( 'images/dot_2_items.png', __FILE__) ?>"
                                 alt="">
                            <?php
                        } elseif (count($rows) == 3) { ?>
                            <img class="dot_img" src="<?php echo plugins_url( 'images/dot_3_items.png', __FILE__) ?>"
                                 alt="">
                            <?php
                        } elseif (count($rows) == 4) { ?>
                            <img class="dot_img" src="<?php echo plugins_url( 'images/dot_4_items.png', __FILE__) ?>"
                                 alt="">
                            <?php
                        } elseif (count($rows) == 5) { ?>
                            <img class="dot_img" src="<?php echo plugins_url( 'images/dot_5_items.png', __FILE__) ?>"
                                 alt="">
                            <?php
                        }
                        ?>
                        <?php
                        if (!empty($rows)) {
                            $i = 1;
                            foreach ($rows as $row) {
                                ?>
                                <div class="row agency_featured_item elementor-repeater-item-<?php echo $row['_id']; echo $row['is_row_reverse'] == 'yes' ? ' flex-row-reverse' : ' agency_featured_item_two'; ?>">
                                    <div class="col-lg-6">
                                        <div class="agency_featured_img text-right wow fadeInRight"
                                             data-wow-delay="0.4s">
                                            <?php echo wp_get_attachment_image($row['image']['id'], 'full' ) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="agency_featured_content pr_70 pl_<?php echo $row['is_row_reverse'] == 'yes' ? '70' : '100'; ?> wow fadeInLeft"
                                             data-wow-delay="0.6s">
                                            <div class="dot"><span class="dot1"></span><span class="dot2"></span></div>
                                            <?php if (empty($row['custom_number']['id'])) { ?>
                                                <img class="number"
                                                     src="<?php echo plugins_url( 'images/numbers/' . $i . '.png', __FILE__) ?>"
                                                     alt="<?php echo esc_attr($row['title']) ?>">
                                                <?php
                                            } else {
                                                echo wp_get_attachment_image($row['custom_number']['id'], 'full' );
                                            }
                                            ?>
                                            <?php if (!empty($row['title'])) : ?>
                                                <h3> <?php echo esc_html($row['title']) ?> </h3>
                                            <?php endif; ?>
                                            <?php echo !empty( $row['subtitle']) ? wpautop($row['subtitle']) : ''; ?>
                                            <?php
                                            if ($row['btn_type'] == 'icon' ) { ?>
                                                <a href="<?php echo esc_url($row['btn_url']['url']) ?>" <?php saasland_is_external($row['btn_url']) ?>
                                                   class="icon mt_30 btn_icon"><i
                                                            class="<?php echo esc_attr($row['btn_icon']) ?>"></i></a>
                                                <?php
                                            } elseif ($row['btn_type'] == 'button' ) {
                                                if (!empty($row['btn_title'])) {
                                                    ?>
                                                    <a href="<?php echo esc_url($row['btn_url']['url']) ?>" <?php saasland_is_external($row['btn_url']) ?>
                                                       class="btn_hover agency_banner_btn mt_30">
                                                        <?php echo esc_html($row['btn_title']) ?>
                                                    </a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                ++$i;
                            }
                        }
                        ?>
                        <div class="dot middle_dot <?php echo 'middle_dot' . $i; ?>"><span class="dot1"></span><span
                                    class="dot2"></span></div>
                    </div>
                </div>
            </section>
            <?php
        }
        elseif ($settings['style'] == 'style_02' ) {
            ?>
            <div class="container">
                <div class="setup_inner">
                    <?php
                    $delay = 0.5;
                    if ( !empty( $rows2 ) ) {
                        foreach ( $rows2 as $row ) {
                            ?>
                            <div class="setup_item row elementor-repeater-item-<?php echo $row['_id']; ?> <?php echo $row['is_row_reverse'] == 'yes' ? 'flex-row-reverse' : ''; ?>">
                                <div class="col-md-5 setup_img wow fadeInLeft" data-wow-delay="0.2s">
                                    <?php echo wp_get_attachment_image( $row['fimage']['id'], 'full' ); ?>
                                </div>
                                <div class="col-md-2 s_number">
                                    <?php if ( !empty($row['process_serial_no'] ) ) : ?>
                                        <div class="round"><?php echo esc_html( $row['process_serial_no'] ) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-5">
                                    <div class="setup_content wow fadeInRight" data-wow-delay="0.4s">
                                        <?php echo !empty( $row['title'] ) ? '<h5>' . $row['title'] . '</h5>' : ''; ?>
                                        <?php echo !empty( $row['subtitle'] ) ? wpautop( $row['subtitle'] ) : ''; ?>
                                    </div>
                                </div>
                                <div class="line bottom_half wow height" data-wow-delay="<?php echo esc_attr( $delay ) ?>s"></div>
                            </div>
                            <?php
                            $delay = $delay + 0.5;
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}