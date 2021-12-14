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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Icon_with_featured_img extends Widget_Base {

    public function get_name() {
        return 'saasland_icon_with_featured_img';
    }

    public function get_title() {
        return __( 'Icon with Featured Image', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Featured Image  ------------------------------ //
        $this->start_controls_section(
            'fimage_sec',
            [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
                'default' => 'icon_lightbulb_alt',
            ]
        );

        $this->add_control(
            'fimage',
            [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section(); // End Featured Image


        $this->start_controls_section(
            'style_icon_sec',
            [
                'label' => __( 'Style Icon', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .erp_features_img_two .img_icon .pluse_1:after, {{WRAPPER}} .erp_features_img_two .img_icon .pluse_2:after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wave_color',
            [
                'label' => __( 'Wave Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .erp_features_img_two .img_icon .pluse_1, {{WRAPPER}} .erp_features_img_two .img_icon .pluse_2' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'img_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .erp_features_img_two img',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'position_set_sec',
            [
                'label' => __( 'Icon Position', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'horizontal_position', [
                'label' => __( 'Horizontal Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -600,
                        'max' => 600,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .flex-row-reverse .erp_features_img_two .img_icon' => 'left: {{SIZE}}{{UNIT}}; right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_position', [
                'label' => __( 'Vertical Position', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -600,
                        'max' => 600,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .flex-row-reverse .erp_features_img_two .img_icon' => 'top: {{SIZE}}{{UNIT}}; bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <div class="row erp_item_features flex-row-reverse">
            <div class="erp_features_img_two">
                <div class="img_icon">
                    <span class="pluse_1"></span>
                    <span class="pluse_2"></span>
                    <i class="<?php echo esc_attr($settings['icon']) ?>"></i>
                </div>
                <?php echo wp_get_attachment_image( $settings['fimage']['id'], 'full' ); ?>
            </div>
        </div>
        <?php
    }
}