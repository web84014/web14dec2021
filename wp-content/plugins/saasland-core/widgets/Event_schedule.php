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
 * Event Schedule Tabs
 */
class Event_schedule extends Widget_Base {

    public function get_name() {
        return 'saasland_event_schedule';
    }

    public function get_title() {
        return __( 'Event Schedule Tabs', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'event-schedule' ];
    }


    protected function _register_controls() {
        // ------------------------------------------- Event Schedule list -----------------------------------------
        $this->start_controls_section(
            'sec_title_sec', [
                'label' => __( 'Section Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'sec_title',
            [
                'label' => __( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->end_controls_section();


        // ------------------------------------------- Event Schedule list -----------------------------------------
        $this->start_controls_section(
            'event_schedule_sec', [
                'label' => __( 'Event Schedule', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'type' => Controls_Manager::DATE_TIME,
                'label_block' => true,
                'picker_options' => [
                    'dateFormat'    => 'M j, Y'
                ]
            ]
        );

        $repeater->add_control(
            'schedule_title',
            [
                'label' => __( 'Schedule Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => __( 'Author Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'event_contents',
            [
                'label' => __( 'Contents', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'author_img',
            [
                'label' => __( 'Author Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'event_time',
            [
                'label' => __( 'Event Time Schedule', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'event_tabs',
            [
                'label' => __( 'Tabs', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();


        /***
         * @@ Style Tabs
         */
        //-------------------------------------------------- Section Title Style -------------------------------------//
        $this->start_controls_section(
            'sec_title_style', [
                'label' => __( 'Section Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .security_title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sec_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .security_title h2',
            ]
        );

        $this->end_controls_section();


        //-------------------------------------------------- Tab Title Style -------------------------------------//
        $this->start_controls_section(
            'tab_title_style', [
                'label' => __( 'Tab Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs_title'
        );

        // Normal Color
        $this->start_controls_tab(
            'normal_tabs_title_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'normal_tab_title_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link h5' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_tab_title_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link.active, .event_schedule_inner .event_tab .nav-item .nav-link' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_tab_title_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();


        // Hover Color
        $this->start_controls_tab(
            'hover_tabs_title_style',
            [
                'label' => __( 'Active', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_tab_title_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link.active h5, .event_schedule_inner .event_tab .nav-item .nav-link:hover h5' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_tab_title_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link.active, .event_schedule_inner .event_tab .nav-item .nav-link:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_tab_title_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_inner .event_tab .nav-item .nav-link:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        //-------------------------------------------------- Schedule Title Style -------------------------------------//
        $this->start_controls_section(
            'schedule_title_style', [
                'label' => __( 'Schedule Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'schedule_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_tab_content .media .media-body .h_head' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'schedule_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .event_tab_content .media .media-body .h_head',
            ]
        );

        $this->end_controls_section();


        //-------------------------------------------------- Author Name Style -------------------------------------//
        $this->start_controls_section(
            'author_name_style', [
                'label' => __( 'Author Name', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'author_name_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_tab_content .media .media-body span a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_name_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .event_tab_content .media .media-body span a',
            ]
        );

        $this->end_controls_section();


        //--------------------------------------------------  Event Contents Style -------------------------------------//
        $this->start_controls_section(
            'event_contents_style', [
                'label' => __( 'Contents', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'event_contents_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_tab_content .media .media-body p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'event_contents_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .event_tab_content .media .media-body p',
            ]
        );

        $this->end_controls_section();


        //----------------------------------------- Section Background Style ----------------------------------------------------//
        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __( 'Section Background', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event_schedule_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $event_tabs = $settings['event_tabs'];
        $cats       = array_column( $event_tabs, 'tab_title' );
        $getCats    = array_unique( $cats );
        $tab_data   = return_tab_data( $getCats , $event_tabs );
        ?>
        <section class="event_schedule_area sec_pad">
            <div class="container">
                <div class="hosting_title security_title text-center">
                    <?php
                    if ( !empty( $settings['sec_title'] ) ){
                        echo '<h2 class="wow fadeInUp" data-wow-delay="0.2s">'. wp_kses_post( $settings['sec_title'] ) .'</h2>';
                    } ?>
                </div>
                <div class="event_schedule_inner">
                    <ul class="nav nav-tabs event_tab" role="tablist">
                        <?php
                        if ( is_array( $event_tabs ) && count( $event_tabs ) > 0 ){
                            $tabs   = '';
                            $i      = 1;
                            foreach ( $getCats as $cat ){
                                $catForFilter = sanitize_title_with_dashes( $cat );
                                $catForFilter = str_replace( '-', '', $catForFilter );
                                $active = $i==1 ? ' active' : '';
                                $aria_selected = $i==1 ? 'true' : 'false';
                                $tabs .= '<li class="nav-item wow fadeInUp" data-wow-delay="0.4s">
                                             <a class="nav-link'. esc_attr( $active ) .'" id="tab'.esc_attr( $catForFilter ).'" data-toggle="tab" href="#'.esc_attr( $catForFilter ).'" role="tab" aria-controls="one" aria-selected="'. esc_attr( $aria_selected ) .'">
                                                <h5>Day '.$i++.' <span>' . wp_kses_post( $cat ) . '</span></h5>
                                             </a>
                                         </li>';
                            }
                            echo $tabs;
                        } ?>
                    </ul>
                    <div class="tab-content event_tab_content">
                        <?php

                        if ( !empty( $tab_data ) ){
                            $i = 0;
                            foreach ($tab_data as $key => $val) {
                                $tagforfilter = sanitize_title_with_dashes($key);
                                $catForFilter = str_replace( '-', '', $tagforfilter );
                                $i++;
                                $active = $i == 1 ? ' show active' : '';
                                ?>
                                <div class="tab-pane fade<?php echo esc_attr($active) ?>" id="<?php echo esc_attr($catForFilter); ?>" role="tabpanel">
                                   <?php
                                   foreach ( $val as $data ) { ?>
                                       <div class="media">
                                           <div class="media-left">
                                               <?php
                                               if ( !empty( $data['author_img']['id'] ) ) {
                                                   echo wp_get_attachment_image( $data['author_img']['id'], 'full' );
                                               }
                                               if ( !empty( $data['event_time'] ) ){
                                                   echo wp_kses_post( $data['event_time'] );
                                               } ?>
                                           </div>
                                           <div class="media-body">
                                               <?php
                                               if ( !empty( $data['schedule_title'] ) ){
                                                   echo '<h3 class="h_head">'. esc_html( $data['schedule_title'] ) .'</h3>';
                                               }

                                               if ( !empty( $data['author_name'] ) ){
                                                   echo '<span>by <a href="#">'. esc_html( $data['author_name'] ) .'</a></span>';
                                               }

                                               if ( !empty( $data['event_contents'] ) ){
                                                   echo '<p>'. esc_html( $data['event_contents'] ) .'</p>';
                                               } ?>
                                           </div>
                                       </div>
                                       <?php
                                   } ?>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}