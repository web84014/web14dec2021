<?php
namespace SaaslandCore\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Saasland_Nav_Navwalker;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Saasland Navbar
 */
class Navbar extends Widget_Base {
    public function get_name() {
        return 'saasland-navbar';
    }

    public function get_title() {
        return __( 'Saasland Navbar', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-logo';
    }

    public function get_keywords() {
        return [ 'Menu', 'Navigation' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //------------ Menu ---------------- //
        $this->start_controls_section(
            'menu_settings',
            [
                'label' => __( 'Menu', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'menu', [
                'label' => __( 'Menu', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_get_menu_array()
            ]
        );

        $this->end_controls_section();


        // Logo settings
        $this->start_controls_section(
            'section_logo',
            [
                'label' => __( 'Logo', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'main_logo',
            [
                'label' => __( 'Main Logo', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/logos/logo.png', __FILE__),
                ],
            ]
        );

        $this->add_control(
            'sticky_logo',
            [
                'label' => __( 'Sticky Logo', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/logos/logo2.png', __FILE__),
                ],
            ]
        );

        $this->add_control(
            'logomax_width',
            [
                'label' => __( 'Max Width', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .navbar-brand img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Retina Logo
        $this->start_controls_section(
            'section_retina_logo',
            [
                'label' => __( 'Retina Logo', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'retina_main_logo',
            [
                'label' => __( 'Main Logo', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/logos/logo_default.png', __FILE__),
                ],
            ]
        );

        $this->add_control(
            'retina_sticky_logo',
            [
                'label' => __( 'Sticky Logo', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url( 'images/logos/logo_sticky_retina.png', __FILE__),
                ],
            ]
        );

        $this->end_controls_section();


        // ------------ Layout Settings ---------------- //
        $this->start_controls_section(
            'layout_settings',
            [
                'label' => __( 'Layout Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'nav_box_layout', [
                'label' => __( 'Navbar box layout', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'boxed',
                'options' => [
                    'boxed' => esc_html__( 'Boxed', 'saasland-core' ),
                    'wide' => esc_html__( 'Wide', 'saasland-core' ),
                    'full_width' => esc_html__( 'Full Width', 'saasland-core' ),
                ]
            ]
        );

        $this->add_control(
            'menu_alignment', [
                'label' => __( 'Menu Alignment', 'saasland-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ]
            ]
        );

        $this->end_controls_section();


        // ------------ Layout Settings ---------------- //
        $this->start_controls_section(
            'navbar_settings',
            [
                'label' => __( 'Navbar Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'is_sticky',
            [
                'label' => __( 'Sticky', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();


        // ------------------------ Buttons ------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Login'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->add_control(
            'radius',
            [
                'label' => __( 'Border Radius', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->start_controls_tabs(
            'style_tabs'
        );
            /// Normal Button Style
            $repeater->start_controls_tab(
                'style_normal_btn',
                [
                    'label' => __( 'Normal', 'saasland-core' ),
                ]
            );
                $repeater->add_control(
                    'font_color', [
                        'label' => __( 'Font Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'bg_color', [
                        'label' => __( 'Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'border_color', [
                        'label' => __( 'Border Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                        )
                    ]
                );
            $repeater->end_controls_tab();

            /// Hover Button Style
            $repeater->start_controls_tab(
                'style_hover_btn',
                [
                    'label' => __( 'Hover', 'saasland-core' ),
                ]
            );
            $repeater->add_control(
                'hover_font_color', [
                    'label' => __( 'Font Color', 'saasland-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                    )
                ]
            );
            $repeater->add_control(
                'hover_bg_color', [
                    'label' => __( 'Background Color', 'saasland-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                    )
                ]
            );
            $repeater->add_control(
                'hover_border_color', [
                    'label' => __( 'Border Color', 'saasland-core' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                    )
                ]
            );
            $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $repeater->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_control(
            'button_style_on_sticky',
            [
                'label' => __( 'On Sticky', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );



        // ------------------------------- Button on Sticky Mode
        $repeater->start_controls_tabs(
            'sticky_btn_style_tabs'
        );
            /// Normal Button Style
            $repeater->start_controls_tab(
                'style_sticky_btn',
                [
                    'label' => __( 'Normal', 'saasland-core' ),
                ]
            );
                $repeater->add_control(
                    'sticky_font_color', [
                        'label' => __( 'Font Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'sticky_btn_bg_color', [
                        'label' => __( 'Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'sticky_btn_border_color', [
                        'label' => __( 'Border Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}' => 'border: 1px solid {{VALUE}}',
                        )
                    ]
                );
            $repeater->end_controls_tab();

            /// Hover Button Style
            $repeater->start_controls_tab(
                'sticky_hover_btn_style',
                [
                    'label' => __( 'Hover', 'saasland-core' ),
                ]
            );
                $repeater->add_control(
                    'sticky_btn_hover_font_color', [
                        'label' => __( 'Font Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'sticky_btn_hover_bg_color', [
                        'label' => __( 'Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                        )
                    ]
                );
                $repeater->add_control(
                    'sticky_btn_hover_border_color', [
                        'label' => __( 'Border Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} .navbar_fixed {{CURRENT_ITEM}}:hover' => 'border: 1px solid {{VALUE}}',
                        )
                    ]
                );
            $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // Buttons repeater field
        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Buttons
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        $opt = get_option( 'saasland_opt' );

        $nav_layout_header = '';
        $nav_layout_start = '<div class="container">';
        $nav_layout_end = '</div>';

        switch ( $settings['nav_box_layout'] ) {
            case 'boxed':
                $nav_layout_start = '<div class="container">';
                $nav_layout_end = '</div>';
                $nav_layout_header = '';
                break;
            case 'wide':
                $nav_layout_start = '<div class="container custom_container">';
                $nav_layout_end = '</div>';
                $nav_layout_header = '';
                break;
            case 'full_width':
                $nav_layout_start = '';
                $nav_layout_header = 'header_area_five nav_full_width';
                $nav_layout_end = '';
                break;
        }

        switch ( $settings['menu_alignment'] ) {
            case 'right':
                $nav_alignment = 'navbar navbar-expand-lg menu_one';
                $ul_class = ' ml-auto';
                $menu_container = '';
                break;
            case 'left':
                $nav_alignment = 'navbar navbar-expand-lg menu_one menu_four';
                $ul_class = ' pl_120';
                $menu_container = '';
                break;
            case 'center':
                $nav_alignment = 'navbar navbar-expand-lg menu_six';
                $menu_container = 'justify-content-center';
                $ul_class = ' ml-auto mr-auto';
                break;
        }

        $is_sticky = ( $settings['is_sticky'] == 'yes' ) ? ' header_stick' : 'no_fixed';

        $header = new \WP_Query(array(
            'post_type' => 'header',
            'posts_per_page' => -1,
        ));
        $reverse_logo = '';
        if ( !is_page_template('elementor_canvas') ) {
            while ( have_posts() ) : the_post();
                $reverse_logo = function_exists('get_field') ? get_field('reverse_logo') : '';
            endwhile;
            wp_reset_postdata();
        }

        $error_img_select = !empty($opt['error_img_select']) ? $opt['error_img_select'] : '1';
        $is_blog_sticky_logo = isset($opt['is_blog_sticky_logo']) ? $opt['is_blog_sticky_logo'] : '';

        if ( $reverse_logo || (is_home() && $is_blog_sticky_logo == '1') || ($error_img_select == '2' && is_404()) ) {
            // Main Logo
            $main_logo = !empty($settings['sticky_logo']['url']) ? $settings['sticky_logo']['url'] : '';
            $sticky_logo = !empty($settings['sticky_logo']['url']) ? $settings['sticky_logo']['url'] : '';
            // Retina Logo
            $retina_main_logo = !empty($settings['retina_sticky_logo']['url']) ? "srcset='{$settings['retina_sticky_logo']['url']} 2x'" : '';
            $retina_sticky_logo = !empty($settings['retina_sticky_logo']['url']) ? "srcset='{$settings['retina_sticky_logo']['url']} 2x'" : '';
        } else {
            // Main Logo
            $main_logo = !empty($settings['main_logo']['url']) ? $settings['main_logo']['url'] : '';
            $sticky_logo = !empty($settings['sticky_logo']['url']) ? $settings['sticky_logo']['url'] : '';
            // Retina Logo
            $retina_main_logo = !empty($settings['retina_main_logo']['url']) ? "srcset='{$settings['retina_main_logo']['url']} 2x'" : '';
            $retina_sticky_logo = !empty($settings['retina_sticky_logo']['url']) ? "srcset='{$settings['retina_sticky_logo']['url']} 2x'" : '';
        }
        ?>

        <header class="header_area elementor_navbar <?php echo esc_attr($nav_layout_header); echo esc_attr($is_sticky); ?>">
            <nav class="<?php echo esc_attr($nav_alignment) ?>">

                <?php echo wp_kses_post($nav_layout_start); ?>

                    <a class="navbar-brand sticky_logo" href="<?php echo esc_url(home_url( '/')) ?>">
                        <?php printf( '<img src="%s" %s alt="%s" class="navigation-main__logo main_logo_img" />', $main_logo, $retina_main_logo, get_bloginfo('title') ); ?>
                        <?php printf( '<img src="%s" %s alt="%s" class="sticky-nav__logo sticky_logo_img" />', $sticky_logo, $retina_sticky_logo, get_bloginfo('title') ); ?>
                    </a>

                  
               
                    <a class="ubermenu-responsive-toggle ubermenu-responsive-toggle-main ubermenu-skin-black-white-2 ubermenu-loc-main_menu ubermenu-responsive-toggle-content-align-left ubermenu-responsive-toggle-align-full " tabindex="0" data-ubermenu-target="ubermenu-main-2-main_menu-2"><i class="fas fa-bars"></i>Menu</a>
                    <nav id="ubermenu-main-2-main_menu-2" class="ubermenu ubermenu-main ubermenu-menu-2 ubermenu-loc-main_menu ubermenu-responsive ubermenu-responsive-default ubermenu-responsive-collapse ubermenu-horizontal ubermenu-transition-shift ubermenu-trigger-hover ubermenu-skin-black-white-2 ubermenu-has-border ubermenu-bar-align-full ubermenu-items-align-flex ubermenu-bound ubermenu-disable-submenu-scroll ubermenu-sub-indicators ubermenu-retractors-responsive ubermenu-submenu-indicator-closes ubermenu-notouch">
                        <ul id="ubermenu-nav-main-2-main_menu" class="ubermenu-nav" data-title="Main Menu"><li id="menu-item-170" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-170 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Services</span><i class="ubermenu-sub-indicator fas fa-angle-down"></i><span class="ubermenu-sub-indicator-close"><i class="fas fa-times"></i></span></a><ul class="ubermenu-submenu ubermenu-submenu-id-170 ubermenu-submenu-type-auto ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-left_edge_bar ubermenu-autoclear"><li id="menu-item-171" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-171 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A1</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-171 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-145" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-145 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/ios-app-development-2/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/iOS-Application-Development.svg" alt="iOS Application Development"><span class="ubermenu-target-title ubermenu-target-text">iOS Application Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Build your native iOS Apps with Swift and Obj C</span></a></li><li id="menu-item-144" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-144 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/android-app-development-2/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/Android-Application-Development.svg" width="512" height="512" alt="Android Application Development"><span class="ubermenu-target-title ubermenu-target-text">Android App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Native Android development with Java and Kotlin</span></a></li><li id="menu-item-146" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-146 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/cross-platform-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/Cross-platform-Application-Development.svg" width="512" height="512" alt="Cross platform Application Development"><span class="ubermenu-target-title ubermenu-target-text">Hybrid App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Cross platform apps using JavaScript, TypeScript, HTML5 and Dart</span></a></li></ul></li><li id="menu-item-138" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-138 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A2</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-138 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-149" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-149 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/enterprise-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/Enterprise-Application-Development.svg" alt="Enterprise Application Development"><span class="ubermenu-target-title ubermenu-target-text">Enterprise App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Transforming your business process digitally</span></a></li><li id="menu-item-148" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-148 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/web-app-development/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/Web-Application-Development.svg" width="512" height="512" alt="Web Application Development"><span class="ubermenu-target-title ubermenu-target-text">Web App Development</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Offering smooth and secure Web Applications Development</span></a></li><li id="menu-item-147" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-147 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-target-with-image ubermenu-item-layout-image_left" href="https://www.shreesaiind.com/sitemay2021/ui-x-ux-design-2/"><img class="ubermenu-image ubermenu-image-size-full" src="https://www.shreesaiind.com/sitemay2021/wp-content/uploads/2021/06/UI-X-UX-Design.svg" width="512" height="512" alt="UI X UX Design"><span class="ubermenu-target-title ubermenu-target-text">UI x UX Design</span><span class="ubermenu-target-divider"> – </span><span class="ubermenu-target-description ubermenu-target-text">Great way to kickstart your digital journey with seamless user experience</span></a></li></ul></li><li id="menu-item-139" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-139 ubermenu-item-auto ubermenu-item-header ubermenu-item-level-1 ubermenu-column ubermenu-column-1-3 ubermenu-has-submenu-stack"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#"><span class="ubermenu-target-title ubermenu-target-text">A3</span></a><ul class="ubermenu-submenu ubermenu-submenu-id-139 ubermenu-submenu-type-auto ubermenu-submenu-type-stack"><li id="menu-item-172" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-172 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-2 ubermenu-column ubermenu-column-auto"><div class="ubermenu-content-block ubermenu-custom-content ubermenu-custom-content-padded">

                                <div class="mega-menu-left-img">
                                    <div class="drop-item-tx">
                                        <h5 class="nav-ico-tx">Making IT Extraordinary</h5>
                                        <p class="tx_sm">
                                           At Whitelotus, we mix knowledge and experience to work as a value added product engineering team to design and build your disruptive digital products in an absolutely efficient way. 
                                        </p>
                                        <a href="#" class="btn-white" tabindex="0">#BuildYourNextWithUS</a>
                                    </div>
                                </div>
                            
                            <style type="text/css">
                                .mega-menu-left-img {
    background-color: #f7fdfc;
    width: 100%;
    height: 388px;
    
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
    padding: 30px !important;
}
.six-menu .drop-item-tx .nav-ico-tx {
    margin-bottom: 0px !important;
}
.mega-menu-left-img .drop-item-tx .nav-ico-tx {
    color: #2C2C51 !important;
    font-size: 25px !important;
    margin-bottom: 0px;
}
.drop-item-tx .nav-ico-tx {
    
    font-weight: 500 !important;
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
}
h5{
   font-family: inherit !important;
}
.mega-menu-left-img .drop-item-tx .tx_sm {
    color: #606060 !important;
    margin-top: 14px;
    line-height: 24px;
}
 .drop-item-tx .tx_sm {
    font-size: 14px !important;
font-weight: 400;
}
.mega-menu-left-img .drop-item-tx {
    text-align: center;
}
    .mega-menu-left-img .btn-white {
    border: solid 1px #533DB6;
    padding: 10px 30px;
    color: #533DB6;
    margin-top: 25px;
border-radius: 5px;
    display: inline-block;
    font-size: 17px;
    position: relative;
font-weight: 500;
}
.globalNav a {
    text-decoration: none;
    -webkit-tap-highlight-color: transparent;
   
}
.globalNav a {
    transition: color .0s !important;
}
                            </style></div></li></ul></li></ul></li><li id="menu-item-9" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-9 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="#" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Case Studies</span></a></li><li id="menu-item-110" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-110 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto"><a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="https://www.shreesaiind.com/sitemay2021/solutions/" tabindex="0"><span class="ubermenu-target-title ubermenu-target-text">Solutions</span></a></li></ul></nav>                

                <?php echo wp_kses_post($nav_layout_end); ?>
                <div id="mySidenav" class="sidenav" style="width: 0px;">
    <div class="container animate fadeInRight four" id="Side">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ab_1">
                <div class="mainMenuItems">
                    <div class="mainMenuItems__content vb vb-visible" style="position: relative; overflow: hidden;">
                        <div class="mainMenu__wrapper mainMenu__wrapper--align-center">
                            <div class="animate fadeInUp one" id="p">
                                <a href="https://www.shreesaiind.com/sitemay2021/about-us/" data-cy="works" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #00fa92">About Us</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">How we are nurtured.</div>
                                </a>
                                <a href="https://www.shreesaiind.com/sitemay2021/portfolio/" data-cy="philosophy" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #ff9e14">Portfolio</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Have a look at what we've created.</div>
                                </a>
                                <a href="https://www.shreesaiind.com/sitemay2021/blog/" data-cy="contacts" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #ff5747">Blog</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Read about latest technology and trends.</div>
                                </a>
                                <a href="https://www.shreesaiind.com/sitemay2021/contact-us/" data-cy="contacts" class="mainMenuItems__item">
                                    <div class="mainMenuItems__title">
                                        <span style="color: #3f68ff">Contact</span>
                                    </div>
                                    <div class="mainMenuItems__subtitle">Start your project.</div>
                                </a>
                                <div class="mainMenuContacts__title" style="margin-left:20px;margin-bottom:25px;margin-top:10px;"> Follow Us</div>
                                <div class="row" style="margin-left: 3px;margin-top:20px;margin-right:5px;">
                                <div class="col-xs-2 col-sm-2 col-md-2"> 
                                    <svg href="https://www.facebook.com/whitelotuscorporation" class="svg-inline--fa fa-facebook-f fa-w-10" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <a href="https://www.facebook.com/whitelotuscorporation" class="ti-facebook" target="_blank"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></a>
                                    </svg>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2"> 
                                    <svg href="https://twitter.com/whitelotuscorp" class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <a href="https://twitter.com/whitelotuscorp" class="ti-twitter-alt" target="_blank"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                        </path></a>
                                    </svg>
                                </div>
                                
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <svg href="https://www.linkedin.com/company/whitelotus-corporation" class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <a href="https://www.linkedin.com/company/whitelotus-corporation" class="ti-linkedin" target="_blank"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z">
                                        </path></a>
                                    </svg>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <svg href="https://www.youtube.com/whitelotuscorp" class="svg-inline--fa fa-youtube fa-w-18" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                        <a href="https://www.youtube.com/whitelotuscorp" class="ti-youtube" target="_blank"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
                                        </path></a>
                                    </svg>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-col-xs-12 col-sm-12 col-md-5 col-lg-5 ab_2">
                <div class="animate fadeInUp one" id="p1">
                <div class="mainMenu__title" style="color:#ffd025">MAKING &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IT <br>EXTRAORDINARY</div>
                    <div class="mainMenu__subtitle">Since 2012</div>
                        <div class="mainMenu__text"><p>From B2B or B2E apps for enterprises, small businesses, and startups, Whitelotus have worked on all sort of apps for segments like Smart Retail, Financial services, Logistics &amp; Transportation, Smart homes, Healthcare, mCommerce, E-governance, Education, Lifestyle, Utility and much more with a proven track record of creating 150+ result driven and engaging mobile apps on all popular platforms with Native, Cross-Platform, and Web Technologies.</p>
                        </div>
                    <div class="mainMenu__footer">
                        <div class="mainMenu__wrapper">
                            <div class="mainMenuContacts">
                                <div class="mainMenuContacts__item">
                                    <div class="mainMenuContacts__title">Call us</div>
                                    <a href="tel:+17864608841" data-cy="contanctLinkPhone" class="mainMenuContacts__link" style="padding-left:0px;">
                                        <span>+91 - 886-687-8983</span>
                                    </a>
                                </div>
                                <div class="mainMenuContacts__item">
                                    <div class="mainMenuContacts__title">Write us</div>
                                    <a href="mailto:hello@mst.agency" data-cy="contanctLinkEmail" class="mainMenuContacts__link mainMenuContacts__link--underline" style="padding-left: 0px;">
                                        <span>contact@whitelotuscorporation.com</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1" style="">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            </div>
        </div>
    </div>
</div>
            <div id="" class="menu_second">
                <span id="open" class="menu_second" onclick="openNav()"> ☰</span>
            </div>
            <script>
            
            function openNav() {
                
                document.getElementById("mySidenav").style.width = "760px";
                //document.getElementById("main").style.marginLeft = "0px";
                const element = document.getElementById('Side')
                        const element1 = document.getElementById('p')
                        const element2 = document.getElementById('p1')

                        element.classList.remove('fadeInRight'); // reset animation
                        void element.offsetWidth; // trigger reflow
                        element.classList.add('fadeInRight');

                        element1.classList.remove('fadeInUp'); // reset animation
                        void element1.offsetWidth; // trigger reflow
                        element1.classList.add('fadeInUp');

                        element2.classList.remove('fadeInUp'); // reset animation
                        void element1.offsetWidth; // trigger reflow
                        element2.classList.add('fadeInUp');
            } 
                
            
            function closeNav() {

                    document.getElementById("mySidenav").style.width = "0";
                     document.getElementById("main").style.marginLeft = "0px";       
                }
                
                // window.addEventListener("scroll", bringmenu);

                //     function bringmenu() {

                //         if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
                //             document.getElementById("mySidenav").style.visibility = "hidden";
                //             document.getElementById("mySidenav").style.opacity = "0";
                //         } else {
                //             document.getElementById("mySidenav").style.visibility = "visible";
                //             document.getElementById("mySidenav").style.opacity = "1";
                //         }
                //         closeNav()
                //     }
            
            document.getElementById("mySidenav").addEventListener("click", e=>e.stopPropagation(), false)

                document.getElementById("open").addEventListener("click", e=>e.stopPropagation(), false)
                document.documentElement.addEventListener("click", function(e) {
                    closeNav()
                    e.preventDefault() 
                }, false)

                
            </script>
            </nav>
            
        </header>
        <?php
    }

}
