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
 * Class Appart_parallax_hero
 * @package SaaslandCore\Widgets
 */
class Appart_parallax_hero extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_parallax_hero';
    }

    public function get_title() {
        return __( 'Tilt Images', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'parallax' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive', 'tilt-image2' ];
    }

    protected function _register_controls() {
        
        $this->start_controls_section(
            'style_sec',
            [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Select Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Parallax Images with Title & Button (Hero)',
                    '2' => 'Images with Round Shape',
                ],
                'default' => '1'
            ]
        );
                
        $this->end_controls_section();

        /**
         * Title
         */
        $this->start_controls_section(
            'title_sec',
            [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'We create best wordpress Theme'
            ]
        );
        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End title section


        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => __( 'Button', 'saasland-core' ),
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );
        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Learn More',
            ]
        );
        $this->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );
        $this->end_controls_section(); // End the Button


        // ------------------------------  Featured image ------------------------------
        $this->start_controls_section(
            'featured_image', [
                'label' => __( 'Featured images', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'images', [
                'label' => esc_html__( 'Images', 'saasland-core' ),
                'desc' => esc_html__( 'Upload the featured images', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );
        $this->end_controls_section(); // End title section


        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         *
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Section Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_prefix', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .appart_new_content h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #utilityPages .section_title h2' => 'color: {{VALUE}};',
                ],
                'default' => '#282835'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .appart_new_content h1, {{WRAPPER}} .section_title h2,
                    {{WRAPPER}} #utilityPages .section_title h2
                ',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle', [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .appart_new_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #utilityPages .section_title h2 span' => 'color: {{VALUE}};',
                ],
                'default' => '#747d85'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .appart_new_content p,
                    {{WRAPPER}} #utilityPages .section_title h2 span
                ',
            ]
        );
        $this->end_controls_section();


        //------------------------------ Style button ------------------------------
        $this->start_controls_section(
            'style_button', [
                'label' => __( 'Style button', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );
        $this->add_control(
            'bg_color_btn', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .appart_new_content .new_banner_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'color_btn', [
                'label' => __( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .appart_new_content .new_banner_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .appart_new_content .new_banner_btn',
            ]
        );
        $this->end_controls_section();

        /**
         * Style Section
         */
        $this->start_controls_section(
            'style_sec_opt', [
                'label' => __( 'Style Section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color_sec', [
                'label' => __( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .appart_new_banner_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .utility_pages_1_wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_round_shape', [
                'label' => __( 'Background Round Shape', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/shapes/round_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['2']
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $images = isset($settings['images']) ? $settings['images'] : '';
        ?>
        <?php
        if ( $settings['style'] == '1' ) :
            ?>
            <section class="appart_new_banner_area">
                <div class="new_parallax_effect scene" id="scene">
                    <?php
                    if (is_array($images)) {
                        foreach ($images as $index => $image) {
                            switch ($index) {
                                case 0:
                                    $depth_x = '10';
                                    $depth_y = '0.10';
                                    break;
                                case 1:
                                    $depth_x = '20';
                                    $depth_y = '0.10';
                                    break;
                                case 2:
                                    $depth_x = '30';
                                    $depth_y = '0.20';
                                    break;
                                case 3:
                                    $depth_x = '20';
                                    $depth_y = '-0.20';
                                    break;
                                case 4:
                                    $depth_x = '25';
                                    $depth_y = '-0.10';
                                    break;
                                case 5:
                                    $depth_x = '15';
                                    $depth_y = '-0.20';
                                    break;
                                case 6:
                                    $depth_x = '35';
                                    $depth_y = '0.10';
                                    break;
                                case 7:
                                    $depth_x = '20';
                                    $depth_y = '0.30';
                                    break;
                            }
                            ?>
                            <div class="item item_<?php echo $index; ?> layer"
                                 data-depth-x="0.<?php echo esc_attr($depth_x) ?>"
                                 data-depth-y="<?php echo esc_attr($depth_y) ?>">
                                <?php echo wp_get_attachment_image($image['id'], 'full' ) ?>
                            </div>
                        <?php }} ?>
                </div>
                <div class="container">
                    <div class="appart_new_content text-center">

                        <?php echo (!empty($settings['title'])) ? '<h1>'.saasland_kses_post( nl2br( $settings['title'] ) ).'</h1>' : ''; ?>

                        <?php echo (!empty($settings['subtitle'])) ? '<p>'.saasland_kses_post( nl2br( $settings['subtitle'] ) ).'</p>' : ''; ?>

                        <?php
                        if (!empty($settings['btn_label'])) : ?>
                            <a <?php saasland_el_btn($settings['btn_url']) ?> class="new_banner_btn">
                                <?php echo esc_html($settings['btn_label']) ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </section>
            <script>
                ;(function($) {
                    "use strict";
                    $(document).ready(function () {
                        $( '#scene' ).parallax();
                    }); // End Document.ready
                })(jQuery);
            </script>
            <?php
        elseif ( $settings['style'] == '2' ) :
            ?>
            <section class="utility_pages_1_wrap" id="utilityPages">
                <?php if ( !empty($settings['bg_round_shape']['url']) ) : ?>
                    <div class="round_shape_bg">
                        <div class="r_img">
                            <img src="<?php echo $settings['bg_round_shape']['url'] ?>" alt="round shape" class="img-fluid">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="section_title text-center">
                                <h2 class="wow fadeInUp" data-wow-delay="400ms">
                                    <?php echo (!empty($settings['subtitle'])) ? '<span>'.saasland_kses_post( $settings['subtitle'] ).'</span> <br>' : ''; ?>
                                    <?php echo saasland_kses_post( nl2br( $settings['title'] ) ) ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="utility_pages_imgs">
                                <div class="utility_img">
                                    <?php
                                    foreach ($images as $index => $image) {
                                        $img_number = $index + 1;
                                        switch ($index) {
                                            case 0:
                                                $animation_delay = '200ms';
                                                break;
                                            case 1:
                                                $animation_delay = '400ms';
                                                break;
                                            case 2:
                                                $animation_delay = '600ms';
                                                break;
                                            case 3:
                                                $animation_delay = '800ms';
                                                break;
                                            case 4:
                                                $animation_delay = '1000ms';
                                                break;
                                            case 5:
                                                $animation_delay = '1200ms';
                                                break;
                                            default:
                                                $animation_delay = '200ms';
                                        }
                                        ?>
                                        <div class="utility_img_<?php echo $img_number ?> uti_img">
                                            <?php echo wp_get_attachment_image($image['id'], 'full', '', array('class' => 'wow fadeInUp', 'data-wow-delay' => $animation_delay ) ) ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        endif;
    }
}