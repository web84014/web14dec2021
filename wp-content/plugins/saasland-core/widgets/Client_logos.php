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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Client_logos extends Widget_Base {

    public function get_name() {
        return 'saasland_client_logos';
    }

    public function get_title() {
        return __( 'Client Logos', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-carousel';
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
        $this->end_controls_section(); // End Buttons

        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Section Style Options', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-center .partner_logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->add_responsive_control(
            'margin', [
                'label' => esc_html__( 'Margin', 'saasland-core' ),
                'description' => esc_html__( 'Margin around single image item', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fab fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'fab fa-align-center',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'image_contrast',
            [
                'label' => __( 'Image Contrast', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item img' => 'filter: contrast({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_contrast_hover',
            [
                'label' => __( 'Image Contrast on Hover', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .partner_logo .p_logo_item:hover img' => 'filter: brightness({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section(); // End Buttons

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $logos = isset($settings['logos']) ? $settings['logos'] : '';
        ?>
        <section class="protype_clients_logo <?php echo ($settings['align'] == 'center' ) ? 'logo-center' : ''; ?>">
        <div class="container">
            <div class="partner_logo">
                <?php
                if (is_array($logos)) {
                foreach ($logos as $i => $logo) {
                    $target = $logo['logo_url']['is_external'] ? 'target="_blank"' : '';
                    ?>
                    <div class="p_logo_item wow fadeInLeft" data-wow-delay="0.<?php echo $i; ?>s">
                        <a href="<?php echo esc_url($logo['logo_url']['url']) ?>" <?php echo $target ?>>
                            <img alt="<?php echo esc_attr($logo['title']) ?>"
                                 src="<?php echo esc_url($logo['logo_image']['url']) ?>"/>
                        </a>
                    </div>
                    <?php
                }}
                ?>
            </div>
        </div>
        </section>
        <?php
    }
}