<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Tabs_horizontal
 * @package SaaslandCore\Widgets
 */
class Tabs_horizontal extends Widget_Base {
    public function get_name() {
        return 'Saasland_tabs_horizontal';
    }

    public function get_title() {
        return __( 'Horizontal Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ---------------------------------------- Select Style  ------------------------------ //
        $this->start_controls_section(
            'select_tab_style',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
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
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section(); // End Select Style

        // ---------------------------------------- Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
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
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .t_color3.mb_50' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hosting_title.text-center .saasland_horizontal_tab_s' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .t_color3.mb_50,
                    {{WRAPPER}} .hosting_title.text-center .saasland_horizontal_tab_s
                    ',
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ------------------------------ Feature list Style 01 ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_03']
                ]
            ]
        );

        $this->add_control(
            'tab_instructions',
            [
                'label' => '',
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Insert this widget in a fullwidth section. ', 'saasland-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'default' => __( 'Tab Content', 'saasland-core' ),
                'placeholder' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'featured_image',
            [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // ------------------------------ Feature list Style 02 ------------------------------
        $this->start_controls_section(
            'section_tabs2',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );

        $this->add_control(
            'tab_instructions2',
            [
                'label' => '',
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Insert this widget in a fullwidth section. ', 'saasland-core' ),
            ]
        );

        $tabs2 = new Repeater();

        $tabs2->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'saasland-core' ),
                'placeholder' => __( 'Tab Title', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $tabs2->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'saasland-core' ),
                'default' => __( 'Tab Content', 'saasland-core' ),
                'placeholder' => __( 'Tab Content', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $tabs2->add_control(
            'featured_image',
            [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $tabs2->add_control(
            'shape_f_img',
            [
                'label' => __( 'Pattern Image', 'saasland-core' ),
                'description' => __( 'The featured image will show on the half column width.', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/home-pos/tab_pattern.png', __FILE__)
                ]
            ]
        );

        $tabs2->add_control(
            'circle_shape_color', [
                'label' => esc_html__( 'Circle Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs2',
            [
                'label' => __( 'Tabs Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $tabs2->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // ------------------------------ Tab Title Color ------------------------------
        $this->start_controls_section(
            'tabs2_title_style_sec',
            [
                'label' => __( 'Tab Items', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tabs2_title_normal_color', [
                'label' => esc_html__( 'Regular Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs2_title_active_color', [
                'label' => esc_html__( 'Active Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-item .nav-link.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nav-item .nav-link:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .developer_product_content .develor_tab .nav-item .nav-link:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .developer_product_content .develor_tab .nav-item .nav-link.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tabs3_style_sec',
            [
                'label' => __( 'Tab Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .tab_img_info:before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $tabs2 = $this->get_settings_for_display( 'tabs2' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ( $settings['style'] == 'style_01' ) {
            ?>
            <div class="ht-tab container tabs-<?php echo $this->get_id(); ?>" id="tabs-<?php echo $this->get_id(); ?>">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="developer_product_content">
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height30 t_color3 mb_50 wow fadeInUp" data-wow-delay="0.2s">
                                <?php echo esc_html($settings['title']); ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <ul class="nav nav-tabs develor_tab mb-30" id="myTab-<?php echo $this->get_id(); ?>" role="tablist">
                            <?php
                            $i = 0.2;
                            foreach ( $tabs as $index => $item ) :
                                $tab_count = $index + 1;
                                $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                                $active = $tab_count == 1 ? 'active' : '';
                                $this->add_render_attribute( $tab_title_setting_key, [
                                    'class' => [ 'nav-link', $active ],
                                    'id' => 'saasland'.'-tab-'.$id_int . $tab_count,
                                    'data-toggle' => 'tab',
                                    'role' => 'tab',
                                    'href' => '#saasland-tab-content-' . $id_int . $tab_count,
                                    'aria-controls' => 'saasland-tab-content-' . $id_int . $tab_count,
                                    'data-tab' => 'ht1_tab_'.$index.'_'.$this->get_id(),
                                ]);
                                ?>
                                <li class="nav-item">
                                    <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                        <?php echo wp_kses_post($item['tab_title']); ?>
                                    </a>
                                </li>
                                <?php
                                $i = $i + 0.2;
                            endforeach;
                            ?>
                        </ul>
                        <div class="tab-content developer_tab_content">
                            <?php
                            foreach ( $tabs as $index => $item ) :
                                $tab_count = $index + 1;
                                $active = $tab_count == 1 ? 'show active' : '';
                                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                                $this->add_render_attribute( $tab_content_setting_key, [
                                    'class' => [ 'tab-pane', 'fade', $active ],
                                    'aria-labelledby' => 'saasland'.'-tab-'.$id_int . $tab_count,
                                    'role' => 'tabpanel',
                                    'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                                ]);
                                ?>
                                <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                                    <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tab_img_info">
                        <?php
                        foreach ( $tabs as $index => $item ) :
                            $tab_count = $index + 1;
                            $active = $tab_count == 1 ? ' active' : '';
                            if ( !empty($item['featured_image']['url']) ) :
                                ?>
                                <div class="tab_img<?php echo esc_attr($active) ?>" id="ht1_tab_<?php echo esc_attr($index).'_'.$this->get_id(); ?>">
                                    <img class="img-fluid wow fadeInRight" data-wow-delay="0.4s" src="<?php echo esc_url($item['featured_image']['url']) ?>" alt="<?php echo esc_attr($item['tab_title']); ?>">
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        $("#tabs-<?php echo $this->get_id(); ?> .develor_tab li a").click(function() {
                            var tab_id = $(this).attr("data-tab");
                            $("#tabs-<?php echo $this->get_id(); ?> .tab_img").removeClass("active");
                            $("#" + tab_id).addClass("active");
                        });
                    })
                })(jQuery);
            </script>
            <?php
        }
        elseif ( $settings['style'] == 'style_02' ) { ?>
            <section class="pos_developer_product_area sec_pad ht-tab tabs-<?php echo $this->get_id(); ?>" id="tabs-<?php echo $this->get_id(); ?>">
                <div class="container">
                    <?php if (!empty($settings['title'])) : ?>
                    <div class="hosting_title text-center">
                        <<?php echo $title_tag; ?> class="saasland_horizontal_tab_s wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post( $settings['title'] ) ?>
                    </<?php echo $title_tag; ?>>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tab_img_info">
                            <?php
                            foreach ( $tabs2 as $index => $item ) :
                                $tab_count = $index + 1;
                                $active = $tab_count == 1 ? 'active' : '';
                                if (!empty($item['featured_image']['url'])) :
                                    ?>
                                    <div class="tab_img <?php echo esc_attr( $active ) ?>" id="ht2_tab_<?php echo esc_attr( $index ).'_'.$this->get_id() ?>">
                                        <img class="img-fluid wow fadeInRight" data-wow-delay="0.4s" src="<?php echo esc_url($item['featured_image']['url']) ?>" alt="<?php echo esc_attr($item['tab_title']); ?>">
                                        <div class="square"></div>
                                        <div class="bg_circle elementor-repeater-item-<?php echo $item['_id']; ?>"></div>
                                        <div data-parallax='{"x": 0, "y": 100}' class="tab_round"></div>
                                        <div data-parallax='{"x": 50, "y": 5}' class="tab_triangle"></div>
                                        <?php if ( !empty( $item['shape_f_img']['url'] ) ) : ?>
                                            <div data-parallax='{"x": 0, "y": 100}'>
                                                <div class="pattern_shap" style="background: url(<?php echo esc_url( $item['shape_f_img']['url']) ?>);"></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="developer_product_content">
                            <ul class="nav nav-tabs develor_tab mb-30" id="myTab-<?php echo $this->get_id(); ?>" role="tablist">
                                <?php
                                $i = 0.2;
                                foreach ( $tabs2 as $index => $item ) :
                                    $tab_count = $index + 1;
                                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                                    $active = $tab_count == 1 ? ' active show' : '';
                                    $this->add_render_attribute( $tab_title_setting_key, [
                                        'class' => [ 'nav-link', $active ],
                                        'id' => 'saasland-tab-'.$id_int . $tab_count,
                                        'data-toggle' => 'tab',
                                        'role' => 'tab',
                                        'data-tab' => 'ht2_tab_'.$index.'_'.$this->get_id(),
                                        'href' => '#saasland-tab-content-' . $id_int . $tab_count,
                                        'aria-controls' => 'saasland-tab-content-' . $id_int . $tab_count,
                                        'aria-selected' => $index == 1 ? 'true' : 'false',
                                    ]);
                                    ?>
                                    <li class="nav-item">
                                        <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                            <?php echo wp_kses_post($item['tab_title']); ?>
                                        </a>
                                    </li>
                                    <?php
                                    $i = $i + 0.2;
                                endforeach;
                                ?>
                            </ul>
                            <div class="tab-content developer_tab_content">
                                <?php
                                foreach ( $tabs2 as $index => $item ) :
                                    $tab_count = $index + 1;
                                    $active = $tab_count == 1 ? ' active show' : '';
                                    $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                                    $this->add_render_attribute( $tab_content_setting_key, [
                                        'class' => [ 'tab-pane fade', $active ],
                                        'aria-labelledby' => 'saasland'.'-tab-'.$id_int . $tab_count,
                                        'role' => 'tabpanel',
                                        'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                                    ]);
                                    ?>
                                    <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                                        <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        $("#tabs-<?php echo $this->get_id(); ?> .develor_tab li a").click(function() {
                            var tab_id = $(this).attr("data-tab");
                            $("#tabs-<?php echo $this->get_id(); ?> .tab_img").removeClass("active");
                            $("#" + tab_id).addClass("active");
                        });
                    })
                })(jQuery);
            </script>
            <?php
        }
        elseif ( $settings['style'] == 'style_03' ) {
            wp_enqueue_style( 'saasland-style-new' );
            ?>
            <section class="product_multitask_area">
                <div class="container">
                    <div class="tab_img_info">
                        <?php
                        if( is_array( $tabs ) ){
                            $img_inc = 1;
                            foreach ( $tabs as $tab_img ){
                                $active = $img_inc == 1 ? 'active' : '';
                                ?>
                                <figure id="tab_<?php echo esc_attr( $img_inc++ ) ?>" style="background: url(<?php echo esc_url( $tab_img['featured_image']['url'] ) ?>)" class="tab_img <?php echo esc_attr( $active ) ?>"></figure>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <ul class="nav nav-tabs develor_tab multitask_tab" id="myTab2" role="tablist">
                        <?php
                        if( is_array( $tabs ) ){
                            $tab_inc = 1;
                            foreach ( $tabs as $tab_item ){
                                $show_active = $tab_inc == 1 ? 'show active' : '';
                                $tab_ID = str_replace( ' ', '', $tab_item['tab_title'] );
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo esc_attr( $show_active ) ?>" data-tab="tab_<?php echo esc_attr( $tab_inc++ ) ?>" id="photo-tab" data-toggle="tab" href="#<?php echo esc_attr( $tab_ID ) ?>" role="tab" aria-controls="photo" aria-selected="true">
                                        <?php echo esc_html( $tab_item['tab_title'] ) ?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <div class="tab-content multitask_tab_content">
                        <?php
                        if( is_array( $tabs ) ){
                            $tab_contet_inc = 1;
                            foreach ( $tabs as $tab_content ){
                                $active_show = $tab_contet_inc == 1 ? 'show active' : '';
                                $tab_contet_inc++;
                                $content_ID = str_replace( ' ', '', $tab_content['tab_title'] ); ?>
                                <div class="tab-pane fade <?php echo esc_attr( $active_show ) ?>" id="<?php echo esc_attr( $content_ID ) ?>" role="tabpanel" aria-labelledby="photo-tab">
                                    <?php echo wp_kses_post( $tab_content['tab_content'] ) ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        if ($(".develor_tab li a").length > 0) {
                            $(".develor_tab li a").click(function () {
                                var tab_id = $(this).attr("data-tab");
                                $(".tab_img").removeClass("active");
                                $("#" + tab_id).addClass("active");
                            });
                        }
                    })
                })(jQuery);
            </script>
            <?php
        }

    }
}