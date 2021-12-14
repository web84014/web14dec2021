<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Title extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_title_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-title';
    }
    
    public function get_title() {
        return esc_html__( 'Title', 'droit-addons' );
    }

    public function get_icon() {
        return 'addons-icon eicon-post-title';
    }

    public function get_keywords() {
        return [
            'Title heading',
            'heading',
            'Title title',
            'Title text',
            'toggle',
            'droit Title',
            'dl Title',
            'dl advanced Title',
            'panel',
            'navigation',
            'group',
            'Title content',
            'product Title',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){
        
       $this->_droit_register_dl_dtitle_content_controls();
       $this->_droit_register_dl_sub_dtitle_content_controls();
       $this->_droit_register_dl_tcontent_content_controls();
       $this->_droit_register_dl_title_text_style_controls();
       $this->_droit_register_dl_sub_title_text_style_controls();
       $this->_droit_register_dl_title_contnet_style_controls();
       do_action('dl_widget/section/style/custom_css', $this);
    }

    //Content Title Section
    public function _droit_register_dl_dtitle_content_controls() {

        $this->start_controls_section(
            '_dl_title_content_section',
            [
                'label' => __( 'Title', 'droit-addons' ),
            ]
        );

        $this->add_control(
            'show_dl_title_sub_revars',
            [
                'label'     => __('Title & Sub Title Position Reverse', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Yes', 'droit-addons'),
                'label_off' => __('No', 'droit-addons'),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'show_dl_title',
            [
                'label'     => __('Title Text', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                
            ]
        );

        $this->add_control(
            'dl_title_tag',
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
                ],
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                    $this->get_control_id('show_dl_title') => ['yes'],
                ],

            ]
        );
        
        $this->add_control(
            '_dl_title_text',
            [
                'label'       => __( 'Title', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __( 'Droit Element Addons', 'droit-addons' ),
                'placeholder' => __( 'Enter Your Title Text', 'droit-addons' ),
                'description' => __( 'Highlighted text must be write in { }. Example : Welcome to { Our Website }', 'droit-addons' ),
                'label_block' => true,
                'condition'   => [
                    $this->get_control_id('show_dl_title') => ['yes'],
                ],
            ]
        );

        $this->add_control(
			'dl_title_link',
			[
				'label' => __( 'URL', 'droit-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'droit-addons' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

        $this->end_controls_section();
    }

    //Content Sub Title Section
    public function _droit_register_dl_sub_dtitle_content_controls() {

        $this->start_controls_section(
            '_dl_sub_title_content_section',
            [
                'label' => __( 'Sub Title', 'droit-addons' ),
            ]
        );

        $this->add_control(
            'show_dl_sub_title',
            [
                'label'     => __('Sub Title Text', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                
            ]
        );

        $this->add_control(
            'dl_sub_title_tag',
            [
                'label' => __( 'Sub Title HTML Tag', 'droit-addons' ),
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
                ],
                'default' => 'h4',
                'toggle' => false,
                'condition' => [
                    $this->get_control_id('show_dl_sub_title') => ['yes'],
                ],

            ]
        );

        $this->add_control(
            '_dl_sub_title_text',
            [
                'label'       => __( 'Sub Title Text', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __( 'Droit Addons For Elementor', 'droit-addons' ),
                'placeholder' => __( 'Enter Your Title Text', 'droit-addons' ),
                'label_block' => true,
                'condition'   => [
                    $this->get_control_id('show_dl_sub_title') => ['yes'],
                ],
            ]
        );

        $this->add_control(
			'dl_subtitle_link',
			[
				'label'         => __( 'URL', 'droit-addons' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'droit-addons' ),
				'show_external' => true,
				'default' => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

        $this->end_controls_section();
     
    }

        //Content Text Section
        public function _droit_register_dl_tcontent_content_controls(){
        $this->start_controls_section(
            '_dl_tcontent_content_section',
            [
                'label' => __( 'Content', 'droit-addons' ),
            ]
        );

        $this->add_control(
            'show_dl_tcontent',
            [
                'label'     => __('Show/Hide', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                
            ]
        );

        $this->add_control(
            '_dl_tcontent_text',
            [
                'label'       => __( 'Text', 'droit-addons' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
                'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'droit-addons' ),
                'placeholder' => __( 'Enter Your Content', 'droit-addons' ),
                'label_block' => true,
                'condition'   => [
                    $this->get_control_id('show_dl_tcontent') => ['yes'],
                ],
            ]
        );

        $this->end_controls_section();
      
    }

    //Title Style
    public function _droit_register_dl_title_text_style_controls() {
        $this->start_controls_section(
            '_dl_title_style_title',
            [
                'label'     => esc_html__('Title', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('show_dl_title') => ['yes'],
                    $this->get_control_id('_dl_title_text!') => '',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_title_text_typography',
                'selector' => '{{WRAPPER}} .dl_title_section .dl_title_text',
            ]
        );
        $this->add_control(
            '_dl_title_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_title_text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .dl_title_section .dl_title_text a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_title_text_align',
            [
                'label'     => __('Text Alignment', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'droit-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'droit-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_title_text'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_title_text_margin',
            [
                'label'      => esc_html__('Margin', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_title_section .dl_title_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_title_text_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_title_section .dl_title_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_dl_high_title_style_title',
            [
                'label'      => esc_html__('Highlighted Text', 'droit-addons'),
                'tab'        => \Elementor\Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => '_dl_title_text',
                            'operator' => '!=',
                            'value' => ''
                        ],
                        [
                            'name' => '_dl_sub_title_text',
                            'operator' => '!=',
                            'value' => ''
                        ],
                        [
                            'name' => '_dl_tcontent_text',
                            'operator' => '!=',
                            'value' => ''
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'high_title_background',
                'label'    => esc_html__('Background Color', 'droit-addons'),
                'types'    => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .dl_title_section .dl_title_text span',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_high_title_text_typography',
                'selector' => '{{WRAPPER}} .dl_title_section .dl_title_text span',
            ]
        );

        $this->add_control(
            '_dl_high_title_text_color',
            [
                'label'     => esc_html__('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_title_text span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Sub Title Style
    public function _droit_register_dl_sub_title_text_style_controls() {

        $this->start_controls_section(
            '_dl_sub_title_style_title',
            [
                'label' => esc_html__('Sub Title', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('show_dl_sub_title') => ['yes'],
                    $this->get_control_id('_dl_sub_title_text!') => '',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_sub_title_text_typography',
                'selector' => '{{WRAPPER}} .dl_title_section .dl_sub_title_text',
            ]
        );

        $this->add_control(
            '_dl_sub_title_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_sub_title_text a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .dl_title_section .dl_sub_title_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_sub_title_text_align',
            [
                'label'     => __('Text Alignment', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'droit-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'droit-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_sub_title_text'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_sub_title_text_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_sub_title_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_sub_title_text_padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_sub_title_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Content Style
    public function _droit_register_dl_title_contnet_style_controls() {

        $this->start_controls_section(
            '_dl_title_content_style_title',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('show_dl_tcontent') => ['yes'],
                    $this->get_control_id('_dl_tcontent_text!') => '',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dl_content_text_background',
                'label' => esc_html__('Background Color', 'droit-addons'),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .dl_title_section .dl_content_text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_content_text_typography',
                'selector' => '{{WRAPPER}} .dl_title_section .dl_content_text',
            ]
        );

        $this->add_control(
            '_dl_content_text_color',
            [
                'label' => esc_html__('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_content_text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_content_text_align',
            [
                'label'     => __('Text Alignment', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'droit-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'droit-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'droit-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_content_text'   => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_content_text_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .dl_title_section .dl_content_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_content_text_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .dl_title_section .dl_content_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //Html render
    protected function render(){

        $settings = $this->get_settings_for_display();
        extract($settings);

        // for Data Showing
        $has_title      = ! empty( $this->get_title_settings('show_dl_title') );
        $has_sub_title  = ! empty( $this->get_title_settings('show_dl_sub_title') );
        $has_content    = ! empty( $this->get_title_settings('show_dl_tcontent') );
        //$show_dl_revars = ! empty( $this->get_title_settings('show_dl_title_sub_revars') );

        // For Title
        $dl_title_tags  = $this->get_title_settings('dl_title_tag');
        $dl_title_text  = $this->get_title_settings('_dl_title_text');
        $show_dl_revars = $this->get_title_settings('show_dl_title_sub_revars');
        $title_link     = ($dl_title_link['url'])??'';
        if(!empty($dl_title_link['custom_attributes'])) {
            $cus_attr = explode( '|', $dl_title_link['custom_attributes'] );
        }
    
        // For sub Title
        $dl_subtitle_tags = $this->get_title_settings('dl_sub_title_tag');
        $dl_subtitle_text = $this->get_title_settings('_dl_sub_title_text');
        $subtitle_link    = ($dl_subtitle_link['url'])??'';
        if(!empty($dl_subtitle_link['custom_attributes'])) {
            $sub_attr = explode( '|', $dl_subtitle_link['custom_attributes'] );
        }       

        // For Content Title
        $dl_content_text = $this->get_title_settings('_dl_tcontent_text'); 
    ?>
	    <div class="dl_title_section">
	        <?php if($has_title): ?>
	            <<?php echo $dl_title_tags; ?> class="dl_title_text" 
                <?php if($show_dl_revars =='yes'): ?> style="order:2;" <?php endif; ?>> 
                    <?php if(!empty($title_link)) { ?> 
                        <a href="<?php echo esc_url($title_link); ?>" <?php if(!empty($dl_title_link['is_external']) && $dl_title_link['is_external'] == 'on'){ ?>target="_blank"<?php } ?> <?php if(!empty($dl_subtitle_link['nofollow']) && $dl_title_link['nofollow'] == 'on'){ ?>rel="nofollow"<?php } ?> <?php if(!empty($dl_title_link['custom_attributes'])) { ?> <?php echo esc_attr($cus_attr[0]); ?> = "<?php echo esc_attr($cus_attr[1]); ?>"<?php } ?> > 
                    <?php } ?>
                        <?php echo str_replace(['{', '}'], ['<span>', '</span>'], $dl_title_text); ?><?php if(!empty($title_link)){ ?></a><?php } ?> 
                          </<?php echo $dl_title_tags; ?>>
	        <?php endif; ?>

	        <?php if($has_sub_title): ?>
	            <<?php echo $dl_subtitle_tags; ?> class="dl_sub_title_text" <?php if($show_dl_revars=='yes'): ?> style="order:1;" <?php endif; ?>> <?php if(!empty($subtitle_link)) { ?> <a href="<?php echo esc_url($subtitle_link); ?>" <?php if( !empty($dl_subtitle_link['is_external']) && $dl_subtitle_link['is_external'] == 1 ){ ?>target="_blank"<?php } ?> <?php if(!empty($dl_subtitle_link['nofollow']) && $dl_subtitle_link['nofollow'] == 1 ){ ?>rel="nofollow"<?php } ?> <?php if(!empty($dl_subtitle_link['custom_attributes'])) { ?> <?php echo esc_attr($sub_attr[0]); ?> = "<?php echo esc_attr($sub_attr[1]); ?>"<?php } ?>> <?php } ?><?php echo wp_kses_post( $dl_subtitle_text ); ?><?php if(!empty($subtitle_link)){ ?></a><?php } ?> </<?php echo $dl_subtitle_tags; ?>>
	        <?php endif; ?>

	        <?php if($has_content): ?>
	            <div class="dl_content_text" <?php if($show_dl_revars=='yes'): ?> style="order:3;" <?php endif ?>><?php echo wp_kses_post( $dl_content_text ); ?></div>
	        <?php endif; ?>
	    </div>    
	    <?php }
  
    protected function content_template(){}
}
