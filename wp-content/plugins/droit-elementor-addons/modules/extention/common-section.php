<?php
namespace DROIT_ELEMENTOR\Module\Extention;
defined( 'ABSPATH' ) || exit;


use \Elementor\Element_Base;
use \DROIT_ELEMENTOR\Module\Controls\Droit_Control as DL_Controls;

class Common_Section{

    private static $instance;

    public function load(){
        if( !did_action('droitPro/loaded') ){
            add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'section_pro'], 1);
            add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'section_pro'], 1);
            add_action('elementor/element/common/_section_style/after_section_end', [$this, 'section_pro'], 1);
        }
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'droit_controls_section'], 1);
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'droit_controls_section'], 1);
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'droit_controls_section'], 1);
        add_action('elementor/frontend/before_render', [$this, 'droit_section_render'], 1);
    }

    public function section_pro( Element_Base $el ){
        if( did_action('droitPro/loaded') ){
            return;
        }
        $tabs = \Elementor\Controls_Manager::TAB_CONTENT;
        if ('section' === $el->get_name() || 'column' === $el->get_name()) {
            $tabs = \Elementor\Controls_Manager::TAB_LAYOUT;
        }
        $el->start_controls_section(
            'section_pro_section',
            [
                'label' => __('Premium Features', 'droit-addons').dl_get_icon(), 
                'tab'   => $tabs,
            ]
        );
        $el->add_control(
            'section_pro_pro_required',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => DL_Controls::render(
                    [
                        'icon'     => drdt_core()->images . "pro_icon.svg",
                        'title'    => __('Go Premium with Droit Pro', 'droit-addons'),
                        'messages' => __('Enjoy additional and exclusive features to create a stunning website with premium Droit Pro', 'droit-addons'),
                        'btn_text' => __('Get Premium Version', 'droit-addons'),
                        'btn_url'  => 'https://droitthemes.com/droit-elementor-addons/',
                    ]
                ),
            ]
        );

        $el->end_controls_section();
    }

    public function droit_controls_section( Element_Base $el ){
        $tabs = \Elementor\Controls_Manager::TAB_CONTENT;
        if ('section' === $el->get_name() || 'column' === $el->get_name()) {
            $tabs = \Elementor\Controls_Manager::TAB_LAYOUT;
        }

        $el->start_controls_section(
            '_section_wrapper_link',
            [
                'label' => __('Section Link', 'droit-addons') . dl_get_icon(),
                'tab'   => $tabs,
            ]
        );

        $el->add_control(
            'droit_section_link',
            [
                'label'       => __('Link', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => 'https://droitthemes.com',
            ]
        );

        $el->end_controls_section();
    }

    public function droit_section_render( Element_Base $el ){
        $settings = $el->get_settings_for_display();
        $dl_link  = isset($settings['droit_section_link']) ? $settings['droit_section_link'] : [];

        if ($dl_link && !empty($dl_link['url'])) {
            $el->add_render_attribute(
                '_wrapper',
                [
                    'data-section-link' => json_encode($dl_link),
                    'style'             => 'cursor: pointer',
                ]
            );
        }
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}