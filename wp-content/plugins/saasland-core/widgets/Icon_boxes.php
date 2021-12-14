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
 *
 * Icon Boxes
 *
 */
class Icon_boxes extends Widget_Base {

    public function get_name() {
        return 'saasland_icon_boxes';
    }

    public function get_title() {
        return __( 'Icon Boxes', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-handle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /*public function get_script_depends() {
        return [ 'circle-progress' ];
    }*/

    protected function _register_controls() {

        // ------------------------------ Icon Boxes ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title', [
                'label' => __( 'Feature title', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Default Title'
            ]
        );

        $repeater->add_control(
            'icon_type', [
                'label' => __( 'Icon Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'sli',
                'options' => [
                    'sli' => __( 'Simple-Line-Icons', 'saasland-core' ),
                    'ti' => __( 'Themify Icon', 'saasland-core' ),
                    'image_icon' => __( 'Image icon', 'saasland-core' ),
                ],
            ]
        );

        $repeater->add_control(
            'sli', [
                'label' => __( 'Simple-Line-Icons', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_simple_line_icons(),
                'include' => saasland_include_simple_line_icons(),
                'default' => 'icon-cloud-upload',
                'condition' => [
                    'icon_type' => 'sli'
                ]
            ]
        );

        $repeater->add_control(
            'ti', [
                'label' => __( 'Themify Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-panel',
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $repeater->add_control(
            'image_icon', [
                'label' => __( 'Image icon', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'icon_type' => 'image_icon'
                ]
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Accent Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .nav-link .icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover .nav-link' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icons', [
                'label' => __( 'Icon Boxes', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /*$this->add_control(
            'column', [
                'label' => __( 'Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '2' => esc_html__( 'Two', 'saasland-core' ),
                    '3' => esc_html__( 'Three', 'saasland-core' ),
                    '4' => esc_html__( 'Four', 'saasland-core' ),
                    '5' => esc_html__( 'Five', 'saasland-core' ),
                    '6' => esc_html__( 'Six', 'saasland-core' ),
                ],
                'default' => '5'
            ]
        );*/

        $this->add_control(
            'col_padding', [
                'label' => __( 'Column Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .startup_tab .nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $icons = isset($settings['icons']) ? $settings['icons'] : '';
        ?>
        <ul class="nav nav-tabs startup_tab">
            <?php
            if (!empty($icons)) {
                foreach ($icons as $icon) {
                    ?>
                    <li class="nav-item elementor-repeater-item-<?php echo $icon['_id'] ?>">
                        <a class="nav-link" href="#<?php echo uniqid('icon_box') ?>">
                            <span class="icon">
                                <?php
                                if ( $icon['icon_type'] == 'sli' ) {
                                    wp_enqueue_style( 'simple-line-icon' );
                                    echo '<i class="'.$icon['sli'].'"></i>';
                                }elseif ( $icon['icon_type'] == 'ti' ) {
                                    echo '<i class="'.$icon['ti'].'"></i>';
                                } elseif ( $icon['icon_type'] == 'image_icon' ) {
                                    echo wp_get_attachment_image($icon['image_icon']['id'], 'full' );
                                }
                                ?>
                            </span>
                            <?php if (!empty($icon['title'])) : ?> <h3> <?php echo $icon['title'] ?> </h3> <?php endif; ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <?php
    }
}