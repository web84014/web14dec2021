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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Features_tabs extends Widget_Base {

    public function get_name() {
        return 'Saasland_features_tabs';
    }

    public function get_title() {
        return __( 'Features Tabs', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-tabs';
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
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_subtitle',
            [
                'label' => __( 'Tab Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater2 = new Repeater();

        $repeater2->add_control(
            'feature_icon',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-user',
            ]
        );

        $repeater2->add_control(
            'feature_title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater2->add_control(
            'feature_desc',
            [
                'label' => __( 'Description', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'features',
            [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater2->get_controls(),
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
                        'tab_title' => 'Tab 01'
                    ],
                    [
                        'tab_title' => 'Tab 02'
                    ],
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
        <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <ul class="nav nav-tabs software_service_tab" id="myTab" role="tablist">
                    <?php
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
                        ?>
                        <li class="nav-item">
                            <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                <?php if (!empty($item['tab_title'])) : ?>
                                    <h5> <?php echo wp_kses_post($item['tab_title']); ?> </h5>
                                <?php endif; ?>
                                <?php if ( !empty($item['tab_subtitle']) ) : ?>
                                    <p> <?php echo wp_kses_post(nl2br($item['tab_subtitle'])); ?> </p>
                                <?php endif; ?>
                            </a>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
            <div class="col-lg-9 col-md-9">
            <div class="tab-content software_service_tab_content">
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
                        <div class="row">
                            <?php
                            if (!empty($item['features'])) {
                            $i = 0.2;
                            foreach ($item['features'] as $feature) {
                                ?>
                                <div class="col-lg-5 col-md-6">
                                    <div class="software_service_item mb_70 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                        <i class="<?php echo esc_attr($feature['feature_icon']) ?>"></i>
                                        <h5 class="mt_30 mb_15"> <?php echo esc_html($feature['feature_title']) ?> </h5>
                                        <?php echo wpautop($feature['feature_desc']) ?>
                                    </div>
                                </div>
                                <?php
                                $i = $i + 0.1;
                            }}
                            ?>
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