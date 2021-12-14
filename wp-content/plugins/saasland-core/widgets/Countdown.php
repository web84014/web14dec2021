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
 * Class Countdown
 * @package SaaslandCore\Widgets
 */
class Countdown extends Widget_Base {

    public function get_name() {
        return 'saasland_countdown';
    }

    public function get_title() {
        return __( 'Date Countdown', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends()
    {
        return ['red-countdown-settings', 'redcountdown', 'moment', 'throttle', 'knob'];
    }
    public function get_style_depends()
    {
        return ['date-countdown'];
    }

    protected function _register_controls() {

        // ------------------------------------------------- Count Down -------------------------------------------//
        $this->start_controls_section(
            'date_count_down_style', [
                'label' => __( 'Countdown Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'countdown_style', [
                'label' => __( 'Countdown Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Style 01', 'saasland-core' ),
                    '2' => __( 'Style 02', 'saasland-core' ),
                ],
                'default' => '1',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'date_count_down_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
                'condition' => [
                    'countdown_style' => '1'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'date_count_down',
            [
                'label' => __( 'Date Time Picker', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false,
                    'dateFormat' => "d/m/Y"
                )
            ]
        );

        $this->end_controls_section();


        /* CountDown Style 2 ============================== */
        $this->start_controls_section(
            'date_count_down_sec2', [
                'label' => __( 'Contents', 'saasland-core' ),
                'condition' => [
                    'countdown_style' => '2'
                ]
            ]
        );

        $this->add_control(
            'date_count_down2',
            [
                'label' => __( 'Date Time Picker', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => array(
                    'enableTime' => false,
                    'dateFormat' => "Y-m-d"
                )
            ]
        );

        $this->end_controls_section();


        //----------------------------------------- Title Style ----------------------------------------------------//
        $this->start_controls_section(
            'title_style_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event_text h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .event_text h3',
            ]
        );

        $this->end_controls_section();


        //-----------------------------------------  Style ----------------------------------------------------//
        $this->start_controls_section(
            'countdown_content_style', [
                'label' => __( 'Countdown Content Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'timer_color', [
                'label' => __( 'Timer Number Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Timer Number Typography', 'saasland-core' ),
                'name' => 'timer_number_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer span,
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer:before
                ',
            ]
        );
        $this->add_control(
            'timer_text_color', [
                'label' => __( 'Timer Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gadget_discount_info .discount-time .clock .timer .smalltext' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => __( 'Timer Text Typography', 'saasland-core' ),
                'name' => 'timer_text_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .gadget_discount_info .discount-time .clock .timer .smalltext',
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
                    '{{WRAPPER}} .event_counter_area' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => esc_html__( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .event_counter_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if( $settings['countdown_style'] == '1' ){
        wp_enqueue_style( 'date-countdown' );
        wp_enqueue_script( 'knob' );
        wp_enqueue_script( 'throttle' );
        wp_enqueue_script( 'moment' );
        wp_enqueue_script( 'redcountdown' );
        wp_enqueue_script( 'red-countdown-settings' );

        $date_count_down = !empty( $settings['date_count_down'] ) ? $settings['date_count_down'] : '';
        $title = !empty( $settings['title'] ) ? $settings['title'] : '';
        ?>
        <section class="event_counter_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="event_text wow fadeInLeft">
                            <?php
                            if ( $title ) {
                                echo '<h3>' . saasland_kses_post( $title ) . '</h3>';
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="event_countdown wow fadeInRight">
                            <div class="event_counter red-time-counter">
                                <?php if ( $date_count_down ) { ?>
                                    <div class="red-countdown red-countdown-one" data-countdown="<?php echo esc_attr( $date_count_down ); ?>"></div>
                                    <?php
                                } ?>
                                <script>
                                    ( function( $ ){

                                        jQuery(document).ready(function(){
                                            var redCounter = $('.red-countdown');
                                            if(redCounter.length){
                                                redCounter.each(function() {
                                                    var $this = $(this), NewDate = $(this).data('countdown');

                                                    //var NewDate = '28/12/2019';

                                                    let current_datetime = new Date();
                                                    let formatted_date = current_datetime.getDate() + "/" + (current_datetime.getMonth() + 1) + "/" + current_datetime.getFullYear();
                                                    var a = moment(formatted_date, 'DD/MM/YYYY');
                                                    var b = moment(NewDate, 'DD/MM/YYYY');
                                                    var remainingDays = b.diff(a, 'days');
                                                    //var remainingDays = moment(NewDate).fromNow(true);
                                                    var currentHours = current_datetime.getHours();
                                                    var FinalHours = (24-currentHours)*60*60;
                                                    var currentMins = current_datetime.getMinutes();
                                                    var FinalMins = (60-currentMins)*60;
                                                    var currentSecs = current_datetime.getSeconds();
                                                    var FinalSecs = (60-currentSecs);
                                                    var remainSum = FinalHours+FinalMins+FinalSecs;

                                                    var endDate = remainingDays*24*60*60;
                                                    var FinalendDate = endDate+remainSum;
                                                    //alert(FinalendDate);
                                                    $('.red-countdown-one').redCountdown({
                                                        end: $.now() + FinalendDate,
                                                        labels: true,
                                                        style: {
                                                            element: "",
                                                            textResponsive: 0.5,
                                                            daysElement: {
                                                                gauge: {
                                                                    thickness: 0.09,
                                                                    bgColor: "#f2ede6",
                                                                    fgColor: "#fd485e"
                                                                }
                                                            },
                                                            hoursElement: {
                                                                gauge: {
                                                                    thickness: 0.09,
                                                                    bgColor: "#f2ede6",
                                                                    fgColor: "#2d8dfa"
                                                                }
                                                            },
                                                            minutesElement: {
                                                                gauge: {
                                                                    thickness: 0.09,
                                                                    bgColor: "#f2ede6",
                                                                    fgColor: "#9449fb"
                                                                }
                                                            },
                                                            secondsElement: {
                                                                gauge: {
                                                                    thickness: 0.09,
                                                                    bgColor: "#f2ede6",
                                                                    fgColor: "#4ad425"
                                                                }
                                                            }

                                                        },
                                                        onEndCallback: function() { console.log("Time out!"); }
                                                    });
                                                });
                                            }
                                        })
                                    })(jQuery);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        elseif( $settings['countdown_style'] == '2' ){
            wp_enqueue_style( 'saasland-style-new' );
            wp_enqueue_script( 'comming-soon' );

            $date_count_down = !empty( $settings['date_count_down2'] ) ? $settings['date_count_down2'] : '';

            if( $date_count_down ){
                ?>
                <div class="gadget_discount_info">
                    <div class="discount-time">
                        <div id="clockdiv" class="clock" data-date="<?php echo esc_attr( $date_count_down ); ?>"></div>
                    </div>
                </div>
                <script>
                    (function ( $ ) {
                        function pad(n) {
                            return (n < 10) ? ("0" + n) : n;
                        }

                        $.fn.showclock = function() {

                            var currentDate=new Date();
                            var fieldDate=$(this).data('date').split('-');
                            var futureDate=new Date(fieldDate[0],fieldDate[1]-1,fieldDate[2]);
                            var seconds=futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

                            if(seconds<=0 || isNaN(seconds)){
                                this.hide();
                                return this;
                            }

                            var days=Math.floor(seconds/86400);
                            seconds=seconds%86400;

                            var hours=Math.floor(seconds/3600);
                            seconds=seconds%3600;

                            var minutes=Math.floor(seconds/60);
                            seconds=Math.floor(seconds%60);

                            var html="";

                            if(days!=0){
                                html+="<div class='timer days'>"
                                html+="<span class='days days-bottom'>"+pad(days)+"</span>";
                                html+="<div class='smalltext days-top'>Days</div>";
                                html+="</div>";
                            }

                            html+="<div class='timer hours'>"
                            html+="<span class='hours hours-bottom'>"+pad(hours)+"</span>";
                            html+="<div class='smalltext hours-top'>Hours</div>";
                            html+="</div>";

                            html+="<div class='timer minutes'>"
                            html+="<span class='minutes minutes-bottom'>"+pad(minutes)+"</span>";
                            html+="<div class='smalltext minutes-top'>Mins</div>";
                            html+="</div>";

                            html+="<div class='timer seconds'>"
                            html+="<span class='seconds seconds-bottom'>"+pad(seconds)+"</span>";
                            html+="<div class='smalltext seconds-top'>Secs</div>";
                            html+="</div>";

                            this.html(html);
                        };

                        $.fn.countdown = function() {
                            var el=$(this);
                            el.showclock();
                            setInterval(function(){
                                el.showclock();
                            },1000);

                        }

                        jQuery(document).ready(function(){
                            if(jQuery(".clock").length>0)
                                jQuery(".clock").countdown();
                        })

                    }(jQuery));
                </script>
            <?php
            }
        }
    }
}