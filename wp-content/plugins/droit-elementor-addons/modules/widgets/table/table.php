<?php
namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Table extends \Elementor\Widget_Base {

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_table_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    public function get_name() {
        return 'droit-table';
    }
    
    public function get_title() {
        return esc_html__( 'Table', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-table addons-icon';
    }

    public function get_keywords() {
        return [
            'table',
            'dl table',
            'droit table',
            'data table',
            'table styler',
            'elementor table',
            'dl',
            'droit'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    protected function _register_controls(){

        
        $this->register_table_content_controls();
        $this->register_general_style_section();
        $this->register_header_style_section();
        $this->register_content_style_section();
  
        do_action('dl_widget/section/style/custom_css', $this);
  
      }

    //Content
    public function register_table_content_controls(){
        $this->start_controls_section(
            '_dl_table__content_layout_section',
            [
                'label' => esc_html__('Table Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( '_dl_content_tabs' );

        
        $this->start_controls_tab( '_dl_header_content_style',
            [ 
                'label' => esc_html__( 'Header', 'droit-addons')
            ] 
        );
        $this->register_header_data_tab_section();
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_header_content_hover',
            [ 
                'label' => esc_html__( 'Content', 'droit-addons')
            ] 
        );
        $this->register_content_data_tab_section();
        $this->end_controls_tab();
        $this->end_controls_tabs();  
        
        $this->end_controls_section();
    }
    // Header & Content
   
    protected function register_header_data_tab_section(){
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_table_header_col',
            [
                'label' => esc_html__( 'Column Name', 'droit-addons'),
                'default' => 'Table Header',
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            '_dl_table_header_col_span',
            [
                'label' => esc_html__( 'Column Span', 'droit-addons'),
                'default' => '',
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
            ]
        );


        
        $repeater->add_control(
            '_dl_table_header_css_class',
            [
                'label'         => esc_html__( 'CSS Class', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => false,
            ]
        );

        $repeater->add_control(
            '_dl_table_header_css_id',
            [
                'label'         => esc_html__( 'CSS ID', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => false,
            ]
        );

        $default_header = [
                    [ '_dl_table_header_col' => '#' ],
                    [ '_dl_table_header_col' => 'Name' ],
                    [ '_dl_table_header_col' => 'Phone' ],
                    [ '_dl_table_header_col' => 'Email' ],
                    [ '_dl_table_header_col' => 'Address' ],
                ];
        $this->add_control(
            '_dl_table_header_cols_data',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => $default_header,
                'fields'      => array_values( $repeater->get_controls() ),
                'title_field' => '{{_dl_table_header_col}}',
            ]
        );
    }
    
    protected function register_content_data_tab_section(){
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            '_dl_table_content_row_type',
            [
                'label' => esc_html__( 'Row Type', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'row',
                'label_block' => false,
                'options' => [
                    'row' => esc_html__( 'Row', 'droit-addons'),
                    'col' => esc_html__( 'Column', 'droit-addons'),
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_colspan',
            [
                'label'         => esc_html__( 'Col Span', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'description'   => esc_html__( 'Default: 1 (optional).', 'droit-addons'),
                'default'       => 1,
                'min'           => 1,
                'label_block'   => true,
                'condition'     => [
                    '_dl_table_content_row_type' => 'col'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_type',
            [
                'label'     => esc_html__( 'Content Type', 'droit-addons'),
                'type'  => \Elementor\Controls_Manager::CHOOSE,
                'options'               => [
                    'textarea'        => [
                        'title'   => esc_html__( 'Textarea', 'droit-addons'),
                        'icon'    => 'fa fa-text-width',
                    ],
                    'editor'       => [
                        'title'   => esc_html__( 'Editor', 'droit-addons'),
                        'icon'    => 'fa fa-pencil',
                    ],
                ],
                'default'   => 'textarea',
                'condition' => [
                    '_dl_table_content_row_type' => 'col'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_rowspan',
            [
                'label'         => esc_html__( 'Row Span', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'description'   => esc_html__( 'Default: 1 (optional).', 'droit-addons'),
                'default'       => 1,
                'min'           => 1,
                'label_block'   => true,
                'condition'     => [
                    '_dl_table_content_row_type' => 'col'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_title',
            [
                'label' => esc_html__( 'Cell Text', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Content', 'droit-addons'),
                'condition' => [
                    '_dl_table_content_row_type' => 'col',
                    '_dl_table_content_type' => 'textarea'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_content',
            [
                'label' => esc_html__( 'Cell Text', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => esc_html__( 'Content', 'droit-addons'),
                'condition' => [
                    '_dl_table_content_row_type' => 'col',
                    '_dl_table_content_type' => 'editor'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_title_link',
            [
                'label' => esc_html__( 'Link', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                        'url' => '',
                        'is_external' => '',
                     ],
                     'show_external' => true,
                     'separator' => 'before',
                 'condition' => [
                    '_dl_table_content_row_type' => 'col',
                    '_dl_table_content_type' => 'textarea'
                ],
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_css_class',
            [
                'label'         => esc_html__( 'CSS Class', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => false,
                'condition'     => [
                    '_dl_table_content_row_type' => 'col'
                ]
            ]
        );

        $repeater->add_control(
            '_dl_table_content_row_css_id',
            [
                'label'         => esc_html__( 'CSS ID', 'droit-addons'),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => false,
                'condition'     => [
                    '_dl_table_content_row_type' => 'col'
                ]
            ]
        );

        $default_content = [
                    [ '_dl_table_content_row_type' => 'row' ],
                    [ '_dl_table_content_row_type' => 'col' ],
                    [ '_dl_table_content_row_type' => 'col' ],
                    [ '_dl_table_content_row_type' => 'col' ],
                    [ '_dl_table_content_row_type' => 'col' ],
                    [ '_dl_table_content_row_type' => 'col' ],
                ];
        $this->add_control(
            '_dl_table_content_rows',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => $default_content,
                'fields' => array_values( $repeater->get_controls() ),
                'title_field' => '{{_dl_table_content_row_type}}::{{_dl_table_content_row_title || _dl_table_content_row_content}}',
            ]
        );
    }

    // Table General
    public function register_general_style_section(){

        $this->start_controls_section(
            '_dl_table__general_style_section',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_general_tabs' );

        
        $this->start_controls_tab( '_dl_general_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_table__background',
                'label' => __('Background', 'droit-addons'),
                'types' => ['classic','gradient'],
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table',
            ]
        );

        $this->add_responsive_control(
            '_dl_table__width',
            [
                'label' => esc_html__('Width', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_table__margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_table__padding',
            [
                'label' => esc_html__('Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbodt tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_table__border',
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_table__box_shadow',
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table',
            ]
        );

        $this->add_control(
            '_dl_table__general_radius',
            [
                'label' => esc_html__( 'Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap table.droit-table' => 'border-radius: {{SIZE}}px',
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:last-child td:last-child' => 'border-radius: 0px 0px {{SIZE}}px 0px;',
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:last-child td:first-child' => 'border-radius: 0px 0px 0px {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_general_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => '_dl_table__background_hover',
                'label' => __('Background', 'droit-addons'),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_table__box_shadow_hover',
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table:hover',
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();

        $this->end_controls_section();   
    }
    // Table Head
    public function register_header_style_section(){

        $this->start_controls_section(
            '_dl_table__head_style_section',
            [
                'label' => esc_html__('Table Head', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_head_tabs' );


        $this->start_controls_tab( '_dl_head_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $this->add_control(
            '_dl_table__head_color',
            [
                'label' => __('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dl_table th' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_table__head_typography',
                'label' => __('Typography', 'droit-addons'),
                'selector' => '{{WRAPPER}} .dl_table th',
            ]
        );

        $this->add_control(
            '_dl_table__title_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-table tr th' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => '_dl_table__border_th',
                    'label' => esc_html__( 'Border', 'droit-addons'),
                    'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th'
                ]
        );

        $this->add_control(
            '_dl_table___header_radius',
            [
                'label' => esc_html__( 'Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_table___header_padding',
            [
                'label' => esc_html__( 'Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_head_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
            '_dl_table__head_color_hover',
            [
                'label' => __('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:hover' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            '_dl_table__title_bg_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table thead tr th:hover' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();   
    }
    // Table Content
    public function register_content_style_section(){

        $this->start_controls_section(
            '_dl_table_content_style_section',
            [
                'label' => esc_html__('Table Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_contents_tabs' );


        $this->start_controls_tab( '_dl_content_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $this->add_responsive_control(
            '_dl_table_content_color',
            [
                'label' => __('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr td' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_table_content_typography',
                'label' => __('Typography', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr td',
            ]
        );

        $this->add_responsive_control(
            '_dl_table_even_content_bg_color',
            [
                'label' => esc_html__( 'Even Row bg Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:nth-child(even)' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        
        $this->add_responsive_control(
            '_dl_table_odd_content_bg_color',
            [
                'label' => esc_html__( 'Odd Row bg Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} table tbody>tr:nth-child(odd)>td' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => '_dl_table_content_border',
                    'label' => esc_html__( 'Border', 'droit-addons'),
                    'selector' => '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr td'
                ]
        );

        $this->add_responsive_control(
            '_dl_table__content_radius',
            [
                'label' => esc_html__( 'Border Radius', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:last-child td:last-child' => 'border-radius: 0px 0px {{SIZE}}px 0px;',
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:last-child td:first-child' => 'border-radius: 0px 0px 0px {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_table__content_padding',
            [
                'label' => esc_html__( 'Padding', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_content_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
            '_dl_table_content_color_hover',
            [
                'label' => __('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr td:hover' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            '_dl_table__content_bg_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-table-wrap .droit-table tbody tr:hover td' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();   
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        extract($settings);

        $table_tr = [];
        $table_td = [];
        foreach( $this->get_table_settings('_dl_table_content_rows') as $content_row ) {

            $row_id = uniqid();
            if( $content_row['_dl_table_content_row_type'] == 'row' ) {
                $table_tr[] = [
                    'id' => $row_id,
                    'type' => $content_row['_dl_table_content_row_type'],
                ];

            }
            if( $content_row['_dl_table_content_row_type'] == 'col' ) {
                $target = $content_row['_dl_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $content_row['_dl_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';

                $table_tr_keys = array_keys( $table_tr );
                $last_key = end( $table_tr_keys );
                
                $tbody_content = ($content_row['_dl_table_content_type'] == 'editor') ? $content_row['_dl_table_content_row_content'] : $content_row['_dl_table_content_row_title'];

                $table_td[] = [
                    'row_id'        => $table_tr[$last_key]['id'],
                    'type'          => $content_row['_dl_table_content_row_type'],
                    'content_type'  => $content_row['_dl_table_content_type'],
                    'title'         => $tbody_content,
                    'link_url'      => $content_row['_dl_table_content_row_title_link']['url'],
                    'link_target'   => $target,
                    'nofollow'      => $nofollow,
                    'colspan'       => $content_row['_dl_table_content_row_colspan'],
                    'rowspan'       => $content_row['_dl_table_content_row_rowspan'],
                    'tr_class'      => $content_row['_dl_table_content_row_css_class'],
                    'tr_id'         => $content_row['_dl_table_content_row_css_id']
                ];
            }
        }  
        $table_th_count = count($this->get_table_settings('_dl_table_header_cols_data'));

        $this->add_render_attribute('data_table_wrap', 'class', [
            'dl_table',
            'droit-table-wrap',
            'dl_table_border_style',
        ]);
        $table_wrapper = $this->get_render_attribute_string('data_table_wrap');

        $this->add_render_attribute('data_table', [
            'class'      => [ 'droit-table' ],
            'id'         => esc_attr($this->get_id()),
            'data-id'    => 'table-'.esc_attr($this->get_id())
        ]);
        $data_table = $this->get_render_attribute_string('data_table');

        $th = $this->get_table_settings('_dl_table_header_cols_data');
    
        ?>
        
        <div <?php echo $table_wrapper; ?>>
            <table <?php echo $data_table; ?>>
                <thead>
                    <tr class="droit-table-head">
                        <?php $i = 0; foreach( $th as $header_title ) :
                            $this->add_render_attribute('th_class'.$i, [
                                'class'     => ['table-head'],
                            ]);
                            if(!empty($header_title['_dl_table_header_css_class'])){
                                $this->add_render_attribute('th_class'.$i, [
                                'class'     => $header_title['_dl_table_header_css_class'],
                            ]);
                            }
                            if(!empty($header_title['_dl_table_header_css_id'])){
                                $this->add_render_attribute('th_class'.$i, [
                                'id'     => $header_title['_dl_table_header_css_id'],
                            ]);
                            }
                            if(!empty($header_title['_dl_table_header_col_span'])){
                                $this->add_render_attribute('th_class'.$i, [
                                'colspan'     => $header_title['_dl_table_header_col_span'],
                            ]);
                            }
                        ?>
                        <th <?php echo $this->get_render_attribute_string('th_class'.$i); ?>>
                            <?php echo __( $header_title['_dl_table_header_col'], 'droit-addons'); ?>
                        </th>
                        <?php $i++; endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
                        <tr>
                            <?php
                                $data_column = 0;
                                for( $j = 0; $j < count( $table_td ); $j++ ) {
                                    if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ) {

                                        $data_column = ($data_column > count( $table_td ) ) ? 0 : $data_column;

                                        $this->add_render_attribute('table_inside_td'.$i.$j,
                                            [
                                            
                                                'data-column' => isset($th[$data_column]['_dl_table_header_col']) ? $th[$data_column]['_dl_table_header_col'] : 'dl-column'
                                            ]
                                        );
                                        ?>
                                    <?php if(  $table_td[$j]['content_type'] == 'textarea' && !empty($table_td[$j]['link_url']) ) : ?>
                                    <td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
                                            <a href="<?php echo esc_url( $table_td[$j]['link_url'] ); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo wp_kses_post($table_td[$j]['title']); ?></a>
                                        </td>
                                        <?php else: ?>
                                            <td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
                                                <?php echo $table_td[$j]['title']; ?>
                                            </td>      
                                    <?php endif ?>
                                        
                                        <?php
                                        $data_column++;
                                    }
                                }
                            ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
      <?php 
      }
  
    protected function content_template(){}
}