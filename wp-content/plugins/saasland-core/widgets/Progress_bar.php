<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Processes
 */
class Progress_bar extends Widget_Base {

    public function get_name() {
        return 'Saasland_progress_bar';
    }

    public function get_title() {
        return __( 'Progress Bar [ Saasland ]', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-skill-bar';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'saasland-style-new' ];
    }

    protected function _register_controls() {
        $progress = new \Elementor\Repeater();
        
        $this->start_controls_section(
            'progress_bar_sec',
            [
                'label' => __( 'Progress Bar', 'saasland-core' ),
            ]
        );

        $progress->start_controls_tabs( 'progress_bar_tab' );
        $progress->start_controls_tab( 'progress_btn_normal', [
            'label' => __( 'Content', 'saasland-core' )
        ] );
        $progress->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Education'
            ]
        );
        $progress->add_control(
            'percentage',
            [
                'label' => esc_html__( 'Percentage', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '70'
            ]
        );


        $progress->end_controls_tab();
        $progress->start_controls_tab( 'btn_hover', [
            'label' => __( 'Style', 'saasland-core' )
        ] );
        $progress->add_control(
            'progressbar_margin',
            [
                'label' => __( 'Margin', 'plugin-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $progress->add_control(
            'progress_title_color', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{CURRENT_ITEM}} .progress_title' => 'color: {{VALUE}};',

                )
            ]
        );
        $progress->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'selector' => '{{CURRENT_ITEM}} .progress_title',
            ]
        );
        $progress->add_control(
            'progress_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{CURRENT_ITEM}} .progress-bar' => 'background: {{VALUE}};',
                    '{{CURRENT_ITEM}} .count-tip' => 'color: {{VALUE}};'

                )
            ]
        );
        $progress->add_control(
            'progressbar_height',
            [
                'label' => __( 'Height', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,

            ]
        );
        
        $progress->end_controls_tab();
        $progress->end_controls_tabs();
        
        

        $this->add_control(
            'progressbar',
            [
                'label' => __( 'Propress Bar', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $progress->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'style_background', [
                'label' => __( 'Style Background', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'c2a_background',
                'label' => __( 'Background', 'saasland-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .promo_area_two',
            ]
        );
        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();
        ?>
        <div class="progress-element">
            <?php
            if( is_array( $settings['progressbar'] ) ){
                foreach ( $settings['progressbar'] as $item ){
                    $progressbar_height = !empty( $item['progressbar_height'] ) ? 'style="height: '. esc_attr( absint( $item['progressbar_height'] ) ) .'px"' : '';
                    ?>
                    <div class="progress_item elementor-repeater-item-<?php echo esc_attr(  $item['_id'] ) ?>">
                        <div class="d-flex justify-content-between">
                            <?php
                            if( !empty( $item['title'] ) ){
                                echo '<p class="progress_title">'. esc_html( $item['title'] ) .'</p>';
                            } ?>
                            <div class="count-tip"><span class="counter"><?php echo esc_html( absint( $item['percentage'] ) ) ?></span>%</div>
                        </div>
                        <div class="progress" <?php echo wp_kses_post( $progressbar_height ) ?>>
                            <div class="progress-bar" style="width:<?php echo esc_attr( absint( $item['percentage'] ) ) ?>%" role="progressbar" aria-valuenow="<?php echo esc_attr( absint( $item['percentage'] ) ) ?>" aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
        </div>
    <?php
    }
}