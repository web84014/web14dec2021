<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Newstricker extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_newstricker_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-newstricker';
    }
    
    public function get_title() {
        return esc_html__( 'News Stricker', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-newsticky addons-icon';
    }

    public function get_keywords() {
       return [
            'news tricker',
            'news tricker',
            'toggle',
            'droit news tricker',
            'dl newstricker',
            'dl advanced newstricker',
            'panel',
            'navigation',
            'group',
            'Animated title content',
            'product Animated title',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls() {
        $this->_droit_register_dl_newstricker_content_controls();
        $this->_droit_register_dl_newstricker_general_style_controls();
        $this->_droit_register_dl_newstricker_content_style_controls();
    }
   
	//General
	public function _droit_register_dl_newstricker_general_style_controls(){
		$this->start_controls_section(
            '_dl_newstricker_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_dl_newstricker_margin',
				'label' => __( 'Background', 'droit-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dl_news_tricker_wrapper.dl_news_tricker_style_01',
			]
		);

        $this->add_responsive_control(
            '_dl_newstricker_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_news_tricker_wrapper.dl_news_tricker_style_01' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_newstricker_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_news_tricker_wrapper.dl_news_tricker_style_01' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //news
    public function _droit_register_dl_newstricker_content_controls(){
        $this->start_controls_section(
            '_dl_newstricker_content_section',
            [
                'label' => __( 'News Content', 'droit-addons' ),
            ]
        );

        $this->add_control(
            '_dl_newstricker_title',
            [
                'label' => __( 'Button Title', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Breaking News', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            '_dl_newstricker_button_size',
            [
                'label' => __( 'Title HTML Tag', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'droit-addons' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'droit-addons' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'droit-addons' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'droit-addons' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'droit-addons' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'droit-addons' ),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'p'  => [
                        'title' => __( 'P', 'droit-addons' ),
                        'icon' => 'eicon-editor-paragraph'
                    ],
                    'span'  => [
                        'title' => __( 'span', 'droit-addons' ),
                        'icon' => 'eicon-editor-span'
                    ],
                ],
                'default' => 'span',
                'toggle' => false,
                
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_newstricker_list_title',
            [
                'label' => __( 'Ticker Title', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Title Here', 'droit-addons' ),
                'placeholder' => __( 'Enter your title', 'droit-addons' ),
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            '_dl_newstricker_url_show',
            [
                'label' => esc_html__('Enable URL', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );
        
        $repeater->add_control(
            '_dl_newstricker_link',
            [
                'label' => __( 'Link', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
                'condition' => [
                    $this->get_control_id( '_dl_newstricker_url_show' ) => [ 'yes' ],
                ],
            ]
        );
        
        $this->add_control(
            '_dl_newstricker_list',
            [
                'label'       => __('News Ticker', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    ['_dl_newstricker_list_title' => esc_html__('news Ticker Title 1', 'droit-addons')],
                    ['_dl_newstricker_list_title' => esc_html__('news Ticker Title 2', 'droit-addons')],
                ],
                'title_field' => '{{{ _dl_newstricker_list_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

    //button
    public function _droit_register_dl_newstricker_content_style_controls(){
        $this->start_controls_section(
            '_dl_newstricker_button_style_content',
            [
                'label' => esc_html__('Button style', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_newsticker_button_color',
            [
                'label' => __( 'Color', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_input_group_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_newsticker_button_bg_color',
            [
                'label'     => __( 'Background Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_input_group_text' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_newsticker_button_typography',
                'selector' => '{{WRAPPER}} .dl_input_group_text',
            ]
        );

        $this->add_responsive_control(
            '_dl_newstricker_button_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_input_group_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_newstricker_button_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_input_group_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_newstricker_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_news_tricker_wrapper.dl_news_tricker_style_01 .dl_input_group_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
            
        $this->end_controls_section();

        $this->start_controls_section(
            '_dl_newstricker_text_style_content',
            [
                'label' => esc_html__('Content style', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_newsticker_text_bg_color',
            [
                'label'     => __( 'Background Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_news_tricker_wrapper .dl_input_group' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_newsticker_text_color',
            [
                'label'     => __( 'Color', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_marquee_content_inner .dl_marquee_tag' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_newsticker_text_typography',
                'selector' => '{{WRAPPER}} .dl_marquee_content_inner .dl_marquee_tag',
            ]
        );

        $this->add_responsive_control(
            '_dl_newstricker_content_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_marquee_content_inner .dl_marquee_tag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_newstricker_content_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_marquee_content_inner .dl_marquee_tag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            '_dl_newstricker_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_news_tricker_wrapper.dl_news_tricker_style_01 .dl_marquee_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->end_controls_section();
    }

    //Html render
    protected function render(){
        $settings                            = $this->get_settings_for_display();
        $_dl_newstricker_title               = ! empty( $this->get_newstricker_settings('_dl_newstricker_title') );
        $_dl_button_title_size               =  $this->get_newstricker_settings('_dl_newstricker_button_size');
        
        $has_marquee = ! empty( $this->get_newstricker_settings('_dl_newstricker_list') );
    ?>
        <div class="dl_news_tricker_wrapper dl_news_tricker_style_01">
            <form action="#">
                <div class="dl_input_group">
                    <?php if ( $_dl_newstricker_title ) : ?> 
                    <div class="dl_input_group_prepend">
                        <<?php echo $_dl_button_title_size; ?> class="dl_input_group_text"><?php echo esc_html( $this->get_newstricker_settings('_dl_newstricker_title') ); ?></<?php echo $_dl_button_title_size; ?>>
                    </div>
                    <?php endif; ?>
                    <div class="dl_marquee_wrapper">
                        <?php
                        if($has_marquee): 
                        ?>
                        <div class="dl_marquee_content">
                            <div class="dl_marquee_content_inner">
                                <?php
                                    foreach ( $this->get_newstricker_settings('_dl_newstricker_list') as $index => $item ) :
                                ?>
                                <a href="<?php echo $item['_dl_newstricker_link']['url']; ?>" class="dl_marquee_tag"><?php echo wp_kses_post($item['_dl_newstricker_list_title']); ?></a>
                                <?php  endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
            
        <?php
    }

    protected function content_template(){}
}
