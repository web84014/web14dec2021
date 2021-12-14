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
 * Class Tabs_with_icon
 * @package SaaslandCore\Widgets
 */
class Tabs_with_icon extends Widget_Base {

    public function get_name() {
        return 'saasland_tabs_with_icon';
    }

    public function get_title() {
        return __( 'Tabs with Icon', 'saasland-hero' );
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
            'icon_type',
            [
                'label' => __( 'Icon Type 01', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome' => esc_html__( 'Font-Awesome', 'saasland-core' ),
                    'eicon' => esc_html__( 'Elegant Icon', 'saasland-core' ),
                    'ticon' => esc_html__( 'Themify Icon', 'saasland-core' ),
                    'slicon' => esc_html__( 'Simple Line Icon', 'saasland-core' ),
                    'flaticon' => esc_html__( 'Flaticon', 'saasland-core' ),
                ],
                'default' => 'fontawesome',
            ]
        );

        $repeater->add_control(
            'fontawesome',
            [
                'label' => __( 'Font-Awesome', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'icon_type' => 'fontawesome'
                ]
            ]
        );

        $repeater->add_control(
            'eicon',
            [
                'label' => __( 'Elegant Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_elegant_icons(),
                'include' => saasland_include_elegant_icons(),
                'default' => 'arrow_right',
                'condition' => [
                    'icon_type' => 'eicon'
                ]
            ]
        );

        $repeater->add_control(
            'ticon',
            [
                'label' => __( 'Themify Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-panel',
                'condition' => [
                    'icon_type' => 'ticon'
                ]
            ]
        );

        $repeater->add_control(
            'slicon',
            [
                'label'     => __( 'Simple Line Icon', 'saasland-core' ),
                'type'      => Controls_Manager::ICON,
                'options'   => saasland_simple_line_icons(),
                'include'   => saasland_include_simple_line_icons(),
                'default'   => 'icon-cloud-upload',
                'condition' => [
                    'icon_type' => 'slicon'
                ]
            ]
        );

        $repeater->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'saasland-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => saasland_flaticons(),
                'include'    => saasland_include_flaticons(),
                'default'    => 'flaticon-mortarboard',
                'condition'  => [
                    'icon_type' => 'flaticon'
                ]
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
            'image1',
            [
                'label' => __( 'Image 01', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/web_image.jpg', __FILE__)
                ]
            ]
        );

        $repeater->add_control(
            'image2',
            [
                'label' => __( 'Image 02', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/iPhoneX.png', __FILE__)
                ]
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Tab Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .nav-link.active, {{WRAPPER}} {{CURRENT_ITEM}}:hover .nav-link' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .icon' => 'background-color: {{VALUE}};',
                ]
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
                'default' => [
                    [
                        'tab_title' => 'Business Intelligence',
                        'tab_content' => 'Tab Contents',
                        'icon_type' => 'slicon',
                        'slicon' => 'icon-screen-tablet',
                        'image1' => [ 'url' => plugins_url( 'images/web_image.jpg', __FILE__) ],
                        'image2' => [ 'url' => plugins_url( 'images/iPhoneX.png', __FILE__) ],
                        'color' => '#23a455',
                    ]
                ]
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
        <section class="startup_fuatures_area">
            <div class="container">
                <ul class="nav nav-tabs startup_tab" id="myTab" role="tablist">
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
                        ]);
                        switch ($item['icon_type']) {
                            case 'fontawesome':
                                $icon = !empty($item['fontawesome']) ? $item['fontawesome'] : '';
                                break;
                            case 'eicon':
                                $icon = !empty($item['eicon']) ? $item['eicon'] : '';
                                break;
                            case 'ticon':
                                $icon = !empty($item['ticon']) ? $item['ticon'] : '';
                                break;
                            case 'slicon':
                                wp_enqueue_style( 'simple-line-icon' );
                                $icon = !empty($item['slicon']) ? $item['slicon'] : '';
                                break;
                            case 'flaticon':
                                $icon = !empty($item['flaticon']) ? $item['flaticon'] : '';
                                break;
                        }
                        $icon_class = (!empty($icon)) ? "class='$icon'" : '';
                        ?>
                        <li class="nav-item <?php echo "elementor-repeater-item-{$item['_id']}"; ?>">
                            <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                <?php if (!empty($icon_class)) : ?>
                                    <span class="icon"> <i <?php echo $icon_class ?>> </i></span>
                                <?php endif; ?>
                                <?php if (!empty($item['tab_title'])) : ?>
                                    <h3><?php echo wp_kses_post($item['tab_title']); ?></h3>
                                <?php endif; ?>
                            </a>
                        </li>
                        <?php
                        $i = $i + 0.2;
                    endforeach;
                    ?>
                </ul>
                <div class="tab-content startup_tab_content" id="myTabContent">
                    <?php
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $active = $tab_count == 1 ? 'show active' : '';
                        $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                        $this->add_render_attribute( $tab_content_setting_key, [
                            'class' => [ 'tab-pane', 'fade', $active ],
                            'aria-labelledby' => 'saasland'.'-tab-'.$id_int . $tab_count,
                            'data-toggle' => 'tab',
                            'role' => 'tab',
                            'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                        ] );
                        ?>
                        <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                            <div class="startup_tab_img">
                                <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                <div class="web_img">
                                    <img src="<?php echo esc_url($item['image1']['url']) ?>" alt="<?php echo esc_attr($item['tab_title']); ?>">
                                </div>
                                <div class="phone_img"><img src="<?php echo esc_url($item['image2']['url']) ?>" alt="<?php echo esc_attr($item['tab_title']); ?>"></div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}