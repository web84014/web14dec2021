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
 * Prototype Features
 */
class Prototype_features extends Widget_Base {
    public function get_name() {
        return 'Saasland_prototype_features';
    }

    public function get_title() {
        return __( 'Prototype Features', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
            );

        /// --------------- Images ----------------
        /// Image Fields
        $repeater_fields = new \Elementor\Repeater();

        $repeater_fields->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $repeater_fields->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'icons', [
                'label' => __( 'Image Icons', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $repeater_fields->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater_fields->add_control(
            'animation', [
                'label' => __( 'Animation', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );

        $repeater_fields->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'rows', [
                'label' => __( 'Info Rows', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater_fields->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Hero content


        //------------------------------ Style Title ------------------------------
		$this->start_controls_section(
			'style_title_sec', [
				'label' => __( 'Style Section Title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
		$this->add_control(
			'color_title', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .f_600.t_color3.l_height40.text-center' => 'color: {{VALUE}};',
				],
			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .f_600.t_color3.l_height40.text-center',
			]
		);
		$this->end_controls_section();


         //------------------------------ Style Rows Title ------------------------------
		$this->start_controls_section(
			'style_subti', [
				'label' => __( 'Style Rows Title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
		$this->add_control(
			'color_row_title', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .f_500.f_p.t_color3' => 'color: {{VALUE}};',
				],
			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_row_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .f_500.f_p.t_color3',
			]
        );
        
        $this->end_controls_section();
        
        

         //------------------------------ Style Background Color ------------------------------
		$this->start_controls_section(
			'style_bg_color_sec', [
				'label' => __( 'Style Background', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
		$this->add_control(
			'color_bg', [
				'label' => __( 'Background Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prototype_featured_area' => 'background: {{VALUE}};',
				],
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

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .prototype_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $rows = isset($settings['rows']) ? $settings['rows'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <section class="prototype_featured_area sec_pad">
            <div class="container">
                <?php if (!empty($settings['title'])) : ?>
                    <<?php echo esc_html($title_tag); ?> class="f_size_30 f_600 t_color3 l_height40 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </<?php echo esc_html($title_tag); ?>>
                <?php endif; ?>
                <?php
                foreach ($rows as $row) {
                    $title_tag = !empty($row['title_html_tag']) ? $row['title_html_tag'] : 'h2';
                    ?>
                    <div class="row <?php echo $row['is_row_reverse'] != 'yes' ? 'flex-row-reverse' : ''; ?> p_feature_item">
                        <div class="col-lg-7">
                            <div class="p_feture_img_<?php echo $row['is_row_reverse'] != 'yes' ? 'one' : 'two'; ?> wow fadeInRight" data-wow-delay="0.4s">
                                <?php echo wp_get_attachment_image($row['image']['id'], 'full' ) ?>
                            </div>
                        </div>
                        <div class="col-lg-5 d-flex align-items-center">
                            <div class="prototype_content wow fadeInLeft" data-wow-delay="0.5s">
                                <<?php echo $title_tag; ?> class="f_500 f_p t_color3"> <?php echo $row['title'] ?> </<?php echo $title_tag; ?>>
                                <div class="prototype_logo">
                                    <?php
                                    foreach ($row['icons'] as $icon) {
                                        echo '<a href="'.$icon['url'].'"> '.wp_get_attachment_image($icon['id'], 'full' ).' </a>';
                                    }
                                    ?>
                                </div>
                                <?php echo wpautop($row['subtitle']) ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <?php
    }
}