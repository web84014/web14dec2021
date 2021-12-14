<?php
namespace DROIT_ELEMENTOR\Module\Extention;
defined( 'ABSPATH' ) || exit;


use \Elementor\Element_Column;

class Custom_Column{

    private static $instance;

    public function load(){
        add_action( 'elementor/element/column/layout/before_section_end', [ $this, 'column_control' ] );
    }

    public function column_control( Element_Column $el ){
        $el->add_responsive_control(
            '_droit_column_custom_width',
            [
                'label' => __( 'Custom Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before',
                'label_block' => true,
                'description' => __( 'Set custom column width. (E.g 500px, 100%, calc(100% - 300px))', 'droit-addons' ),
                'selectors' => [
                    '{{WRAPPER}}.elementor-column' => 'width: {{VALUE}};',
                ],
            ]
        );

        $el->add_responsive_control(
            '_droit_column_custom_order',
            [
                'label' => __( 'Column Order', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'style_transfer' => true,
                'description' => sprintf(
                    __( 'Column ordering for responsive design. You can learn more about CSS order property from %sMDN%s.', 'droit-addons' ),
                    '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>'
                ),
                'selectors' => [
                    '{{WRAPPER}}.elementor-column' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
            ]
        );
    }

    public static function instance(){
        if ( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

}