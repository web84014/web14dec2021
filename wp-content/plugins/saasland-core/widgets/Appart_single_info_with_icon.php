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
 * Class Appart_single_info_with_icon
 * @package SaaslandCore\Widgets
 */
class Appart_single_info_with_icon extends Widget_Base {

    public function get_name() {
        return 'Saasland_appart_single_info_with_icon';
    }

    public function get_title() {
        return __( 'Single info with icon', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Default Title'
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_featured_item h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .new_featured_item h4',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_featured_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .new_featured_item p',
            ]
        );
        $this->end_controls_section(); // End subtitle section


        // ------------------------------  Icon ------------------------------
        $this->start_controls_section(
            'icon_sec', [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'icon_type', [
                'label' => esc_html__( 'Icon type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ti_icon',
                'options' => [
                    'ti_icon' => __( 'Themify Icon', 'saasland-core' ),
                    'fontawesome' => __( 'Fontawesome Icon', 'saasland-core' ),
                    'image' => __( 'Image Icon', 'saasland-core' ),
                ]
            ]
        );

        $this->add_control(
            'ti_icon', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                //include' => saasland_thimify_include_icons(),
                'default' => 'icon-trophy',
                'condition' => [
                    'icon_type' => 'ti_icon'
                ]
            ]
        );

        $this->add_control(
            'fontawesome', [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'icon_type' => 'fontawesome'
                ]
            ]
        );

        $this->add_control(
            'image_icon', [
                'label' => __( 'Image Icon', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icon_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .new_featured_item i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => ['ti_icon', 'fontawesome']
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['icon_type'] == 'ti_icon' ) {
            $icon = $settings['ti_icon'];
        }
        elseif ( $settings['icon_type'] == 'fontawesome' ) {
            $icon = $settings['fontawesome'];
        }
        ?>
        <div class="new_featured_item">
            <?php
            if ( $settings['icon_type'] == 'image' ) {
                echo wp_get_attachment_image($settings['image_icon']['id'], 'full');
            } else {
                ?>
                <i class="<?php echo esc_attr($icon) ?>"></i>
                <?php
            }
            ?>
            <?php echo !empty($settings['title']) ? '<h4>'.esc_html($settings['title']).'</h4>' : ''; ?>
            <?php echo !empty($settings['subtitle']) ? '<p>'.esc_html($settings['subtitle']).'</p>' : ''; ?>
        </div>
        <?php
    }
}