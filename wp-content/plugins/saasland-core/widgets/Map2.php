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
 * Saasland Map
 */
class Map2 extends Widget_Base {
    public function get_name() {
        return 'saasland_map2';
    }

    public function get_title() {
        return __( 'Saasland Map', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {
        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'map_sec', [
                'label' => __( 'Map Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'api', [
                'label' => esc_html__( 'Map API', 'saasland-core' ),
                'description' => __( 'Get your Google Map API from <a href="https://goo.gl/kDJSKd" target="_blank"> here </a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'address', [
                'label' => esc_html__( 'Address', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'lat', [
                'label' => esc_html__( 'Latitude', 'saasland-core' ),
                'description' => __( 'Get your Map Latitude from <a href="http://www.mapcoordinates.net/en" target="_blank"> here </a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'long', [
                'label' => esc_html__( 'Longitude', 'saasland-core' ),
                'description' => __( 'Get your Map Longitude from <a href="http://www.mapcoordinates.net/en" target="_blank"> here </a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => esc_html__( 'Zoom', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $this->add_control(
            'marker', [
                'label' => esc_html__( 'Marker', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => plugins_url( 'images/map_marker.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Map Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'is_full_width',
            [
                'label' => __( 'Remove Border', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); // End title section

    }

    protected function render() {
        $settings = $this->get_settings();
        $height = !empty($settings['height']) ? 'style="height: '.esc_attr($settings['height']).'px;"' : '';
        ?>
        <div class="mapbox<?php echo ($settings['is_full_width'] == 'yes' ) ? '2' : ''; ?>" <?php echo $height; ?>>
            <div id="mapBox" class="row m0"
                 <?php if (!empty($settings['lat'])) : ?> data-lat="<?php echo esc_attr($settings['lat']) ?>" <?php endif; ?>
                 <?php if (!empty($settings['long'])) : ?> data-lon="<?php echo esc_attr($settings['long']) ?>" <?php endif; ?>
                 <?php if (!empty($settings['zoom']['size'])) : ?> data-zoom="<?php echo esc_attr($settings['zoom']['size']) ?>" <?php endif; ?>
                 <?php if (!empty($settings['address'])) : ?> data-info="<?php echo esc_attr($settings['address']) ?>" <?php endif; ?>
                 <?php if (!empty($settings['marker']['url'])) : ?> data-marker="<?php echo esc_attr($settings['marker']['url']) ?>" <?php endif; ?>
                <?php if (!empty($settings['lat'])) : ?> data-mlat="<?php echo esc_attr($settings['lat']) ?>" <?php endif; ?>
                <?php if (!empty($settings['long'])) : ?> data-mlon="<?php echo esc_attr($settings['long']) ?>" <?php endif; ?>>
            </div>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $settings['api'] ?>&callback=initMap"></script>
        <script src="<?php echo plugins_url( 'js/gmaps.min.js', __FILE__) ?>"></script>
        <?php
    }

}