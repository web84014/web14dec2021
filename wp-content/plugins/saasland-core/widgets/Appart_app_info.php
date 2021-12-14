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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Appart_app_info extends Widget_Base {

    public function get_name() {
        return 'saasland_appart_app_info';
    }

    public function get_title() {
        return __( 'App info', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'appart-style', 'appart-responsive' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title section', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'title_text', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Find Our App On'
            ]
        );
        $this->add_control(
            'subtitle_text', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed consequuntur magni dolores ratione voluptatem '
            ]
        );
        $this->end_controls_section(); // End title section

        // ------------------------------ Buttons ------------------------------
        $this->start_controls_section(
            'info_sec', [
                'label' => __( 'Info columns', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'infos', [
                'label' => __( 'App info', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'App Store Features',
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'font_icon' => __( 'Font icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'font_icon',
                        'label' => __( 'Font icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'default' => 'ti-apple',
                        'condition' => [
                            'icon_type' => 'font_icon'
                        ]
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url( 'images/app-icon.png', __FILE__)
                        ],
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
                    ],
                    [
                        'name' => 'rating',
                        'label' => __( 'Star rating', 'saasland-core' ),
                        'description' => __( 'Select the star rating of your app out of five star rating.', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '1' => '1',
                            '1.5' => '1.5',
                            '2' => '2',
                            '2.5' => '2.5',
                            '3' => '3',
                            '3.5' => '3.5',
                            '4' => '4',
                            '4.5' => '4.5',
                            '5' => '5',
                        ]
                    ],
                    [
                        'name' => 'rating_label',
                        'label' => __( 'Rating label', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '824 Ratings',
                    ],
                    [
                        'name' => 'info_items',
                        'label' => __( 'Info items', 'saasland-core' ),
                        'description' => esc_html__( 'Input the info based on <tr><td>Key</td></tr> <tr><td>Value</td></tr>', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => '<tr>
                                        <td>Category:</td>
                                        <td>Health & Fitness</td>
                                      </tr>
                                      <tr>
                                         <td>Updated:</td>
                                         <td>Oct 19, 2017</td>
                                      </tr>
                                      <tr>
                                         <td>Version:</td>
                                         <td>5.5.1</td>
                                      </tr>
                                      <tr>
                                         <td>Size:</td>
                                         <td>65.2 MB</td>
                                      </tr>
                                      <tr>
                                          <td>Language:</td>
                                          <td>English</td>
                                      </tr>
                                      <tr>
                                          <td>Seller: </td>
                                          <td>Skyfit Sports Inc.</td>
                                      </tr>',
                    ],
                ],
            ]
        );
        $this->end_controls_section(); // End Buttons

        // ------------------------------  Featured image ------------------------------
        $this->start_controls_section(
            'featured_image', [
                'label' => __( 'Featured image', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'the_featured_image', [
                'label' => esc_html__( 'Featured image', 'saasland-core' ),
                'desc' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->end_controls_section(); // End title section

        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four h2' => 'color: {{VALUE}};',
                ],
                'default' => '#1a264a'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four h2',
            ]
        );
        $this->end_controls_section();

        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'color_suffix',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-four p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title-four p',
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
        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app-deatails-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $infos = isset($settings['infos']) ? $settings['infos'] : '';
        ?>
        <section class="app-deatails-area">
            <div class="container">
                <div class="title-four text-center">
                    <?php if (!empty($settings['title_text'])) : ?>
                        <h2 class="wow fadeInUp"> <?php echo esc_html($settings['title_text']); ?> </h2>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle_text'])) : ?>
                        <div class="wow fadeInUp" data-wow-delay="300ms"><?php echo wpautop($settings['subtitle_text']); ?></div>
                    <?php endif;?>
                </div>
                <div class="app_info">
                    <div class="row m0">
                        <?php
                        if (is_array($infos)) {
                            foreach ( $infos as $info ) {
                                ?>
                                <div class="col-md-6 col-sm-12 p0">
                                    <div class="app-details">
                                        <div class="app-icon">
                                            <?php if ($info['icon_type']=='image_icon' ) { ?>
                                                <img src="<?php echo esc_url($info['image_icon']['url']) ?>" alt="">
                                            <?php }elseif ($info['icon_type']=='font_icon' ) { ?>
                                                <i class="<?php echo esc_attr($info['font_icon']) ?>"></i> <?php
                                            } ?>
                                        </div>
                                        <div class="app-title">
                                            <h5> <?php echo esc_html($info['title']); ?> </h5>
                                            <div class="user-info">
                                                <div class="star-rating">
                                                    <?php
                                                    switch($info['rating']) {
                                                        case 1:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 1.5:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 2:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 2.5:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 3:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 3.5:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 4:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="far fa-star" aria-hidden="true"></i>';
                                                            break;
                                                        case 4.5:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star-half-alt" aria-hidden="true"></i>';
                                                            break;
                                                        case 5:
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                                            break;
                                                    }
                                                    ?>
                                                </div>
                                                <?php if (!empty($info['rating_label'])) ?> <span> <?php echo esc_html($info['rating_label']); ?> </span>
                                            </div>
                                        </div>
                                        <div class="table-responsive customer_table">
                                            <table class="table">
                                                <tbody>
                                                <?php echo $info['info_items']; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}