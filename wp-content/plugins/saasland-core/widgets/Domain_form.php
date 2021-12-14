<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Domain Search form
 */
class Domain_form extends Widget_Base
{
    public function get_name()
    {
        return 'saasland_domain_form';
    }

    public function get_title()
    {
        return __( 'Domain search form', 'saasland-core' );
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['saasland-elements'];
    }

    public function get_script_depends()
    {
        return ['niceselect'];
    }

    protected function _register_controls()
    {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Looking for domain name?'
            ]
        );

        $this->end_controls_section(); //End Title Section


        /// ------------------------- Domain Price ---------------------------- ////
        $this->start_controls_section(
            'domain_name_sec',
            [
                'label' => esc_html__( 'Domain Name', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'domain_name', [
                'label' => esc_html__( 'Name', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '.com',
            ]
        );

        $this->add_control(
            'domains', [
                'label' => esc_html__( 'Domain Extensions', 'saasland-core' ),
                'description' => esc_html__( 'This program is created with the help of some well-known domain registration sites like Godaddy, name.com, and register.com', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ domain_name }}}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                       'domain_name' => '.com'
                    ],
                    [
                       'domain_name' => '.net'
                    ],
                    [
                       'domain_name' => '.co'
                    ],
                    [
                       'domain_name' => '.org'
                    ],
                    [
                       'domain_name' => '.me'
                    ],
                ]
            ]
        );

        $this->end_controls_section();


        /// ------------------------- Domain Price ---------------------------- ////
        $this->start_controls_section(
            'domain_price_sec',
            [
                'label' => esc_html__( 'Domain Price', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'domain_price', [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '.com <span>$6.50</span>'
            ]
        );

        $this->add_control(
            'domains_price', [
                'label' => esc_html__( 'Price', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ domain_price }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // ------------------------------ MailChimp form ------------------------------
        $this->start_controls_section(
            'buttons_sec', [
                'label' => __( 'Form Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'domain_placeholder', [
                'label' => esc_html__( 'Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Enter your domain name',
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Search',
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs'
        );

        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Left Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain_form_inner' => 'border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'normal_box_shadow',
                'label' => __( 'Box Shadow', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .hosting_btn',
            ]
        );

        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hosting_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

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
                'selectors' => [
                    '{{WRAPPER}} .domain_box_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .domain_box_info h3',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_bg_color_sec',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .domain_search_area' => 'background: {{VALUE}};',
                ]
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
            'sec_bg_image', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/map.png', __FILE__)
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px',
                'selectors' => [
                    '{{WRAPPER}} .domain_search_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $domain_price = $settings['domains_price'];
        $domains = $settings['domains'];
        wp_enqueue_style( 'nice-select' );
        wp_enqueue_script( 'nice-select' );
        ?>
        <section class="domain_search_area sec_pad">
            <div class="map_bg" style="background: url(<?php echo esc_url( $settings['sec_bg_image']['url'] ) ?>)
                    no-repeat scroll center 0/cover;">
            </div>
            <div class="container">
                <div class="domain_box_info">
                    <?php if ( !empty($settings['title']) ) : ?>
                        <h3 class="wow fadeInUp" data-wow-delay="0.3s"><?php echo esc_html( $settings['title'] ) ?></h3>
                    <?php endif; ?>
                    <form action="" method="get">
                        <div class="domain_form_inner">
                            <?php
                            $domain_name = isset($_GET['domain']) ? $_GET['domain'] : '';
                            ?>
                            <input type="text" name="domain" class="form-control" value="<?php echo esc_attr($domain_name) ?>" placeholder="<?php echo esc_attr( $settings['domain_placeholder'] ) ?>">
                            <?php if ( $domains ) : ?>
                                <div class="domain_select">
                                    <select name="extension" class="form-control selectpickers">
                                        <?php
                                        foreach ( $domains as $domain ) {
                                            $extension = isset($_GET['extension']) ? $_GET['extension'] : '';
                                            $is_current = ( $extension == $domain['domain_name'] ) ? 'selected="selected"' : ''; ?>
                                            <option <?php echo $is_current ?>> <?php echo wp_kses_post($domain['domain_name']) ?> </option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['btn_label'])) : ?>
                                <button type="submit" class="hosting_btn">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </form>

                    <ul class="list-unstyled domain_price">
                        <?php
                        if (!empty( $domain_price )) {
                            foreach ( $domain_price as $item ) {
                                ?>
                                <li><?php echo wp_kses_post($item['domain_price']) ?></li>
                                <?php
                            }}
                        ?>
                    </ul>
                    <div id="results" class="result">
                        <?php
                        error_reporting(0);
                        if ( isset($_GET['domain']) ) {
                            $domain = str_replace( ' ', '', $_GET['domain'] );
                            $domain = $domain.$_GET['extension'];
                            $godaddycheck = 'https://in.godaddy.com/domains/searchresults.aspx?checkAvail=1&tmskey=&domainToCheck='.$domain.'';
                            $namecomcheck = 'https://www.name.com/domain/search/'.$domain.'';
                            $registercomcheck = 'http://www.register.com/domain/search/wizard.rcmx?searchDomainName='.$domain.'&searchPath=Default&searchTlds=';
                            if ( gethostbyname($domain) != $domain ) {
                                echo "<p class='not-available'> Sorry! <span> $domain is Already Registered! </span>  Try search another. </p>";
                            }
                            else {
                                echo "<p class='available'> <strong> Congratulations! </strong> <span class='domain_name'> $domain </span> is available!</p>";
                                if ( !empty($settings['buy_domain_title']) ) {
                                    echo "<br>";
                                    echo "<a class='buy_domain_btn' href='{$settings['buy_domain_link']['url']}'> {$settings['buy_domain_title']} </a>";
                                }
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