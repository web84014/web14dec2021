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
 * Class Table_tabs
 * @package SaaslandCore\Widgets
 */
class Table_tabs extends Widget_Base {

    public function get_name() {
        return 'saasland_table_tabs';
    }

    public function get_title() {
        return __( 'Table Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-tabs';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------ Tab Title  ------------------------------//
        $this->start_controls_section(
            'tab_title_sec',
            [
                'label' => __( 'Table Title', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Standard', 'saasland-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'table_subtitle',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'table_contents',
            [
                'label' => __( 'Table Contents', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section(); //End Tab Title


    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        ?>
        <div class="container">
            <div class="h_price_inner">
                <ul class="nav nav-tabs hosting_tab" id="myTab" role="tablist">
                    <?php
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $active = $tab_count == 1 ? ' active' : '';
                        $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                        $this->add_render_attribute( $tab_title_setting_key, [
                            'class' => [ 'nav-link', $active ],
                            'id' => 'saasland-tab-content-' . $id_int . $tab_count,
                            'data-toggle' => 'tab',
                            'role' => 'tab',
                            'href' => '#saasland-tab-' . $id_int . $tab_count,
                            'aria-controls' =>  'saasland-tab-' . $id_int . $tab_count,
                            'aria-selected' => $index == 1 ? 'true' : 'false',
                        ]);
                        ?>
                        <li class="nav-item">
                            <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                                <?php echo wp_kses_post($item['tab_title']); ?>
                            </a>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
                <div class="tab-content h_price_tab" id="myTabContent">
                    <?php
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $active = $tab_count == 1 ? ' show active' : '';
                        $tab_contents_setting_key = $this->get_repeater_setting_key( 'table_subtitle', 'tabs', $index );
                        $this->add_render_attribute( $tab_contents_setting_key, [
                            'class' => [ 'tab-pane fade', $active ],
                            'id' => 'saasland-tab-' . $id_int . $tab_count,
                            'role' => 'tabpanel',
                            'aria-labelledby' => 'saasland-tab-content-'.$id_int . $tab_count,
                        ]);
                        ?>
                        <div <?php echo $this->get_render_attribute_string( $tab_contents_setting_key ); ?>>
                            <p><?php echo wp_kses_post($item['table_subtitle'] ); ?></p>
                            <div class="h_price_body">
                                <?php echo wp_kses_post( $item['table_contents'] ) ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}