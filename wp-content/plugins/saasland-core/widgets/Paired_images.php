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
 * Paired Images
 */
class Paired_images extends Widget_Base {
    public function get_name() {
        return 'Saasland_paired_images';
    }

    public function get_title() {
        return __( 'Paired Images', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_keywords() {
        return [ 'dual images' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Image Pairs', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'pairs', [
                'label' => esc_html__( 'Pairs', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'left_image',
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'right_image',
                        'type' => Controls_Manager::MEDIA,
                    ],
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        ?>
        <div class="container">
            <?php
            if (!empty($settings['pairs'])) {
            foreach ($settings['pairs'] as $i => $pair) {
                ?>
                <div class="row <?php echo $i != 0 ? 'paired-margin-top' : ''; ?>">
                    <div class="col-lg-7 col-md-7">
                        <div class="design_img wow fadeInRight" data-wow-delay="0.2s">
                            <?php echo wp_get_attachment_image($pair['left_image']['id'], 'full', false, array( 'class' => 'img-fluid')) ?>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 d-flex align-items-center">
                        <div class="design_img_two wow fadeInRight" data-wow-delay="0.4s">
                            <?php echo wp_get_attachment_image($pair['right_image']['id'], 'full', false, array( 'class' => 'img-fluid')) ?>
                        </div>
                    </div>
                </div>
                <?php
            }}
            ?>
        </div>
        <?php
    }
}