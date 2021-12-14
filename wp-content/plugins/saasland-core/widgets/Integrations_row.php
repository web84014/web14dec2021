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
 * Row Integrations
 */
class Integrations_row extends Widget_Base {
    public function get_name() {
        return 'saasland_integrations_row';
    }

    public function get_title() {
        return __( 'Row Integrations', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-handle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'logo_carousel', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->add_control(
            'logos', [
                'label' => __( 'Logos', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Logo title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Company name'
                    ],
                    [
                        'name' => 'logo_url',
                        'label' => __( 'URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '#'
                        ]
                    ],
                    [
                        'name' => 'logo_image',
                        'label' => __( 'Logo image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                ],
            ]
        );
        $this->end_controls_section(); //

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $logos = isset($settings['logos']) ? $settings['logos'] : '';
        ?>
        <div class="row intregration_logo">
            <?php
            if (is_array($logos)) {
                foreach ($logos as $i => $logo) {
                    $target = $logo['logo_url']['is_external'] ? 'target="_blank"' : '';
                    ?>
                    <div class="col-<?php echo $settings['column'] ?> intregration_item">
                        <a href="<?php echo esc_url($logo['logo_url']['url']) ?>" <?php echo $target ?> class="intregration_icon">
                            <img src="<?php echo esc_url($logo['logo_image']['url']) ?>" alt="<?php echo esc_attr($logo['title']) ?>">
                        </a>
                    </div>
                    <?php
                }}
            ?>
        </div>
        <?php
    }
}