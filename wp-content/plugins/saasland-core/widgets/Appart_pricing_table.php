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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_pricing_table extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_pricing_table';
    }

    public function get_title() {
        return __( 'Pricing Table 02', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-price-table';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Pricing Table'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'pricing_table', [
                'label' => __( 'Pricing Table', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style one ', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style two ', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        /**
         * Pricing Tables 01
         */
        $this->add_control(
            'tables', [
                'label' => __( 'Pricing Tables', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => ['style_01']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Table name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Free'
                    ],
                    [
                        'name' => 'currency',
                        'label' => __( 'Currency', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '$',
                    ],
                    [
                        'name' => 'price',
                        'label' => __( 'Price', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '0',
                    ],
                    [
                        'name' => 'duration',
                        'label' => __( 'Duration', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Lifetime',
                    ],
                    [
                        'name' => 'list_items',
                        'label' => __( 'List items', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => '<li>One User</li>
                                      <li>1000 ui elements</li>
                                      <li>E-mail support</li>',
                    ],
                    [
                        'name' => 'try_btn_label',
                        'label' => __( 'Try button label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Try Now',
                        'label_block' => true
                    ],
                    [
                        'name' => 'try_btn_url',
                        'label' => __( 'Try button URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                    [
                        'name' => 'purchase_btn_label',
                        'label' => __( 'Purchase button label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Purchase',
                        'label_block' => true
                    ],
                    [
                        'name' => 'purchase_btn_url',
                        'label' => __( 'Purchase button URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                ],
            ]
        );

        /**
         * Pricing Tables 02
         */
        $this->add_control(
            'tables2', [
                'label' => __( 'Pricing Tables', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Table name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Free'
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'currency',
                        'label' => __( 'Currency', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '$',
                    ],
                    [
                        'name' => 'price',
                        'label' => __( 'Price', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '0',
                    ],
                    [
                        'name' => 'list_items',
                        'label' => __( 'List items', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                        'default' => '<li>One User</li>
                                      <li>1000 ui elements</li>
                                      <li>E-mail support</li>',
                    ],
                    [
                        'name' => 'try_btn_label',
                        'label' => __( 'Try button label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Try Now',
                        'label_block' => true
                    ],
                    [
                        'name' => 'try_btn_url',
                        'label' => __( 'Try button URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                    [
                        'name' => 'purchase_btn_label',
                        'label' => __( 'Purchase button label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Purchase',
                        'label_block' => true
                    ],
                    [
                        'name' => 'purchase_btn_url',
                        'label' => __( 'Purchase button URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                            'is_external' => '',
                        ],
                        'show_external' => true,
                    ],
                ],
            ]
        );
        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
                'default' => '#1a264a'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four h2',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four p',
            ]
        );
        $this->end_controls_section();


        /** ======================== Table Header (style one) ========================= */
        $this->start_controls_section(
            'style_price_table_header', [
                'label' => __( 'Table Header', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );
        $this->start_controls_tabs(
            'style_table_header'
        );
        /// Normal Button Style Tab
        $this->start_controls_tab(
            'style_table_header_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'table_header_bg_color', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'table_header_bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price .pricing-box .pricing-header' => 'background-image: -webkit-linear-gradient( 44deg, {{table_header_bg_color.VALUE}} 1%, {{VALUE}} 100%);',
                )
            ]
        );
        $this->end_controls_tab();
        /// *** Hover Style
        $this->start_controls_tab(
            'table_header_style_hover',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'table_header_bg_color_hover', [
                'label' => __( 'Background Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'table_header_bg_color2_hover', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price .pricing-box:hover .pricing-header' => 'background-image: -webkit-linear-gradient( 44deg, {{table_header_bg_color_hover.VALUE}} 1%, {{VALUE}} 100%);',
                )
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        //------------------------------ Style Price Table ------------------------------
        $this->start_controls_section(
            'style_price_table', [
                'label' => __( 'Price Table', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'price_color_title', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_box_two h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .price .pricing-box .pricing-header h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_price_title',
                'label' => __( 'Title Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_box_two h5, {{WRAPPER}} .price .pricing-box .pricing-header h2',
            ]
        );
        $this->add_control(
            'price_subtitle_hr', [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );
        $this->add_control(
            'price_color_subtitle', [
                'label' => __( 'Subtitle Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_box_two p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Subtitle Typography', 'saasland-core' ),
                'name' => 'typography_price_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_box_two p',
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );
        $this->add_control(
            'price_amount_hr', [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'price_amount_color', [
                'label' => __( 'Price Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_box_two .rate' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .price .pricing-box .pricing-header .packeg_typ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'price_amount_color_hover', [
                'label' => __( 'Price Text Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_box_two:hover .rate' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Price Text Typography', 'saasland-core' ),
                'name' => 'typography_price_amount',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_box_two .rate, {{WRAPPER}} .price .pricing-box .pricing-header .packeg_typ',
            ]
        );
        $this->add_control(
            'price_table_atts_hr', [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'price_table_atts_color', [
                'label' => __( 'List Items Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price_box_two ul li' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .price .pricing-box .plan-lists li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'List Items Typography', 'saasland-core' ),
                'name' => 'typography_price_table_atts',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .price_box_two ul li, {{WRAPPER}} .price .pricing-box .plan-lists li',
            ]
        );
        $this->end_controls_section();

        // Style Button
        $this->start_controls_section(
            'buttons_style_sec',
            [
                'label' => __( 'Style Button', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
        /// Normal Button Style Tab
        $this->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'btn_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .purchase-btn' => 'color: {{VALUE}}',
                )
            ]
        );
        $this->add_control(
            'btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .purchase-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );
        $this->add_control(
            'btn_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .purchase-btn' => 'border-color: {{VALUE}}',
                )
            ]
        );
        $this->end_controls_tab();
        /// ----------------------------- Hover Button Style
        $this->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'btn_hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .purchase-btn:hover' => 'color: {{VALUE}}',
                )
            ]
        );
        $this->add_control(
            'btn_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .purchase-btn:hover' => 'background-color: {{VALUE}};',
                ),
            ]
        );
        $this->add_control(
            'btn_hover_bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two:before' => 'background-image: -webkit-linear-gradient( 0deg, {{btn_hover_bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ),
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );
        $this->add_control(
            'btn_hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .price_box_two .purchase_btn_two:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .purchase-btn:hover' => 'border-color: {{VALUE}}',
                )
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section(); // End Buttons


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Section Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .priceing_area_two.appart' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-area' => 'background-color: {{VALUE}};'
                )
            ]
        );
        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .priceing_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $tables = isset($settings['tables']) ? $settings['tables'] : '';
        $tables2 = isset($settings['tables2']) ? $settings['tables2'] : '';
        wp_deregister_style('saasland-elements');
        if ( $settings['style']=='style_01' ) {
            ?>
            <section class="pricing-area">
                <div class="container">
                    <div class="title-four text-center">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?> <?php echo wpautop($settings['subtitle_text']); endif; ?>
                    </div>
                    <div class="priceing-tab">
                        <div class="row">
                            <?php if ($tables) {
                                foreach ( $tables as $table ) {
                                    $try_btn = $table['try_btn_url'];
                                    $try_btn_target = $try_btn['is_external'] ? 'target="_blank"' : '';
                                    $purchase_btn = $table['purchase_btn_url'];
                                    $purchase_btn_target = $purchase_btn['is_external'] ? 'target="_blank"' : '';
                                    ?>
                                    <div class="col-md-4 col-sm-6 price wow fadeInUp" data-wow-dealy="150ms">
                                        <div class="pricing-box">
                                            <div class="pricing-header">
                                                <h2><?php echo esc_html($table['title']) ?></h2>
                                                <h3 class="packeg_typ">
                                                    <span><?php echo esc_html($table['currency']) ?></span><?php echo esc_html($table['price']) ?>
                                                    <small> <?php echo esc_html($table['duration']) ?></small>
                                                </h3>
                                            </div>
                                            <ul class="list-unstyled plan-lists">
                                                <?php echo $table['list_items']; ?>
                                            </ul>
                                            <?php if (!empty($table['try_btn_label'])) : ?>
                                                <a href="<?php echo esc_url($try_btn['url']); ?>" class="try" <?php echo esc_attr($try_btn_target); ?>>
                                                    <?php echo esc_html($table['try_btn_label']) ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($table['purchase_btn_label'])) : ?>
                                                <a href="<?php echo esc_url($purchase_btn['url']); ?>" class="purchase-btn" <?php echo $purchase_btn_target; ?>>
                                                    <?php echo esc_html($table['purchase_btn_label']) ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif ( $settings['style'] == 'style_02' ) {
            ?>
            <section class="priceing_area_two appart">
                <div class="container">
                    <div class="title-four h_color text-center">
                        <?php if (!empty($settings['title_text'])) : ?> <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2> <?php endif; ?>
                        <?php if (!empty($settings['subtitle_text'])) : ?>
                            <?php echo '<p class="p_color wow fadeInUp" data-wow-delay="200ms">'.$settings['subtitle_text']."</p>";
                        endif; ?>
                    </div>
                    <div class="row">
                        <?php if ( $tables2 ) {
                            unset($table);
                            foreach ( $tables2 as $table ) {
                                $try_btn = $table['try_btn_url'];
                                $try_btn_target = $try_btn['is_external'] ? 'target="_blank"' : '';
                                $purchase_btn = $table['purchase_btn_url'];
                                $purchase_btn_target = $purchase_btn['is_external'] ? 'target="_blank"' : '';
                                ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="price_box_two text-center wow fadeInLeft" data-wow-delay="250ms">
                                        <?php
                                        if ( !empty($table['title']) ) {
                                            echo '<h5>'. esc_html( $table['title'] ) .'</h5>';
                                        }
                                        ?>
                                        <div class="price_icon">
                                            <?php if ( !empty($table['image_icon']['url']) ) { ?>
                                                <img src="<?php echo esc_url($table['image_icon']['url']); ?>" alt="<?php echo esc_attr($table['title']) ?>">
                                            <?php } ?>
                                        </div>
                                        <h2 class="rate"><?php echo esc_html($table['currency']) ?><?php echo esc_html($table['price'])?></h2>
                                        <ul class="list-unstyled plan-lists">
                                            <?php echo $table['list_items']; ?>
                                        </ul>
                                        <?php if (!empty($table['try_btn_label'])) : ?>
                                            <a href="<?php echo esc_url($try_btn['url']); ?>" class="try" <?php echo esc_attr($try_btn_target); ?>>
                                                <?php echo esc_html($table['try_btn_label']) ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($table['purchase_btn_label'])) : ?>
                                            <a href="<?php echo esc_url($purchase_btn['url']); ?>" class="purchase_btn_two hover_color" <?php echo $purchase_btn_target; ?>>
                                                <?php echo esc_html($table['purchase_btn_label']) ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }

    protected function _content_template() {
    }

}