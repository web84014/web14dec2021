<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Tabs
 * @package SaaslandCore\Widgets
 */
class Tabs extends Widget_Base {

    public function get_name() {
        return 'saasland_tabs';
    }

    public function get_title() {
        return __( 'Saasland Tabs', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
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
                'default' => 'h5',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tab_subtitle',
            [
                'label' => __( 'Tab Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
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

        $repeater->end_controls_tab();

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

        
    //--------------------- Section Color-----------------------------------//

    $this->start_controls_section(
        'style_tabs_sec',
        [
            'label' => __( 'Tabs Style', 'saasland-core' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->start_controls_tabs(
    'style_tabs'
    );

    /// Normal  Style
    $this->start_controls_tab(
        'style_normal',
        [
            'label' => __( 'Normal', 'saasland-core' ),
        ]
    );

    $this->add_control(
        'normal_title_font_color', [
            'label' => __( 'Title Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color .title_color' => 'color: {{VALUE}}',
            )
        ]
    );

    $this->add_control(
        'normal_subtitle_font_color', [
            'label' => __( 'Subtitle Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color p' => 'color: {{VALUE}}',
            )
        ]
    );

    $this->add_control(
        'normal_bg_color', [
            'label' => __( 'Background Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'background: {{VALUE}};',
            )
        ]
    );

    $this->end_controls_tab();

    /// ----------------------------- Active Style--------------------------//
    $this->start_controls_tab(
        'style_active_btn',
        [
            'label' => __( 'Active', 'saasland-core' ),
        ]
    );

    $this->add_control(
        'active_title_font_color', [
            'label' => __( 'Title Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active .title_color' => 'color: {{VALUE}};',
            )
        ]
    );
    
    $this->add_control(
        'active_subtitle_font_color', [
            'label' => __( 'Subtitle Font Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active p' => 'color: {{VALUE}};',
            )
        ]
    );

    $this->add_control(
        'active_bg_color', [
            'label' => __( 'Background Color', 'saasland-core' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => array(
                '{{WRAPPER}} .design_tab .nav-item .nav-link.active' => 'background: {{VALUE}};',
            )
        ]
    );

    $this->end_controls_tab();

    $this->end_controls_section();

    //------------------------------------ Tab Border Radius -------------------------------------------//
    $this->start_controls_section(
        'border_radius_sec', [
            'label' => __( 'Border Radius', 'saasland-core' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'border_radius', [
            'label' => esc_html__( 'Radius', 'saasland-core' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        ?>
        <div class="container">
        <div class="row">
            <div class="col-lg-4 d-flex align-items-center">
                <ul class="nav nav-tabs design_tab" role="tablist">
                    <?php
                    $i = 0.2;
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                        $active = $tab_count == 1 ? 'active' : '';
                        $title_tag =  $title_tag = !empty($item['title_html_tag']) ? $item['title_html_tag'] : 'h5';
                        $this->add_render_attribute( $tab_title_setting_key, [
                            'class' => [ 'nav-link normal_color', $active ],
                            'id' => 'saasland'.'-tab-'.$id_int . $tab_count,
                            'data-toggle' => 'tab',
                            'role' => 'tab',
                            'href' => '#saasland-tab-content-' . $id_int . $tab_count,
                            'aria-controls' => 'saasland-tab-content-' . $id_int . $tab_count,
                        ]);
                        ?>
                        <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                            <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                <<?php echo $title_tag; ?> class="title_color"><?php echo wp_kses_post($item['tab_title']); ?></<?php echo $title_tag; ?>>
                                <p><?php echo wp_kses_post(nl2br($item['tab_subtitle'])); ?></p>
                            </a>
                        </li>
                        <?php
                    $i = $i + 0.2;
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="col-lg-8">
                <div class="tab-content">
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
                            <div class="tab_img">
                                <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
}