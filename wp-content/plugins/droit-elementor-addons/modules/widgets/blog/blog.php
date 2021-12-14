<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR\Widgets;

use \DROIT_ELEMENTOR\DL_Images as DL_Images;
use \DROIT_ELEMENTOR\Module\Controls\Droit_Control as DL_Controls;


if (!defined('ABSPATH')) { exit;}

class Droit_Addons_Blog extends \Elementor\Widget_Base {
    protected $current_permalink;

    public function get_name() {
        return 'droit-blog';
    }
 
    public function get_title() {
        return __( 'Blog', 'droit-addons' );
    }

    public function get_icon() {
        return 'dlicons-blog-post addons-icon';
    }

    public function get_keywords() {
        return [
            'blog',
            'blogs',
            'post',
            'posts',
            'cpt',
            'item',
            'loop',
            'query',
            'cards',
            'post type',
            'custom post type',
            'droit blog',
            'droit blogs',
            'droit post',
            'droit posts',
            'dl blog',
            'dl blogs',
            'dl post',
            'dl posts',
            'droit',
            'dl',
            'addons',
            'addon'
        ];
    }
    
    public function get_categories() {
        return ['droit_addons'];
    }

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }

    final public function get_blogs_settings( $control_key ) {
        $control_id = $this->get_control_id( $control_key );
        return $this->get_settings( $control_id );
    }

    protected function _register_controls()
    {
        parent::_register_controls();
        $this->register_dl_blog_layout_controls();
        $this->register_dl_blog_query_section_controls();
        $this->register_dl_blog_general_style_section_controls();
        $this->register_dl_blog_thumbnail_style_section_controls();
        $this->register_dl_blog_title_style_section_controls();
        $this->register_dl_blog_content_style_section_controls();
        $this->register_dl_blog_cat_style_section_controls();
        $this->register_dl_blog_auth_style_section_controls();
        $this->register_dl_blog_date_style_section_controls();
        do_action('dl_widget/section/style/custom_css', $this);
    }

    
    // Layout
    public function register_dl_blog_layout_controls(){
        $this->start_controls_section(
            '_dl_blog_layout_section',
            [
                'label' => esc_html__('Layout', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
        '_dl_blog_skin',
        [
            'label' => esc_html__( 'Design Format', 'droit-addons' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'label_block' => false,
            'options'   => [
                '_skin_1' => 'Style 01',
                '_skin_2' => 'Style 02',
                '_skin_3' => 'Style 03',
                '_skin_4' => 'Style 04',
            ],
            'default' => '_skin_1'
        ]
    );
        
            $this->register_dl_blog_thumbnail_size_controls();
            $this->register_dl_blog_columns_controls();
            $this->register_dl_blog_show_hide_controls();
            $this->register_dl_blog_read_more_controls();
            $this->register_dl_blog_link_controls();
            $this->end_controls_section();   
            $this->register_dl_blog_masonary_layout_one_controls();
            $this->register_dl_blog_masonary_layout_four_controls();
    }
    
    protected function register_dl_blog_thumbnail_size_controls() {
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'full',
            ]
        );
    }

    protected function register_dl_blog_columns_controls() {
        $this->add_responsive_control(
            '_dl_blog_columns',
            [
                'label' => __( 'Columns', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '12' => '1',
                    '6' => '2',
                    '4' => '3',
                    '3' => '4',
                    '5' => '5',
                    '2' => '6',
                ],
                'condition' => [
                    $this->get_control_id('_dl_blog_skin!') => ['_skin_1', '_skin_4'],
                ],
            ]
        );
    } 

    // Query
    public function register_dl_blog_query_section_controls(){
        $this->start_controls_section(
            '_dl_blog_query_section',
            [
                'label' => esc_html__('Query', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => __( 'Source', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => \DROIT_ELEMENTOR\DL_Helper::get_post_types( [],[ 'elementor_library', 'attachment' ] ),
                'default' => 'post',
            ]
        );
        $this->register_dl_blog_notification_controls();
        $this->add_control(
            'posts_per_page', [
                'label'       => esc_html__('Posts Per Page', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Number', 'droit-addons'),
                'default'     => '6',
            ]
        );

        
        $this->register_dl_blog_order_orderby_controls();
        $this->end_controls_section();
    }

    // Order
    protected function register_dl_blog_order_orderby_controls(){
        $this->add_control(
            'order_by',
            [
                'label'   => __('Order By', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'modified'   => __('Modified', 'droit-addons'),
                    'date'       => __('Date', 'droit-addons'),
                    'rand'       => __('Rand', 'droit-addons'),
                    'ID'         => __('ID', 'droit-addons'),
                    'title'      => __('Title', 'droit-addons'),
                    'author'     => __('Author', 'droit-addons'),
                    'name'       => __('Name', 'droit-addons'),
                    'parent'     => __('Parent', 'droit-addons'),
                    'menu_order' => __('Menu Order', 'droit-addons'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'ase',
                'options' => [
                    'ase'  => __('Ascending Order', 'droit-addons'),
                    'desc' => __('Descending Order', 'droit-addons'),
                ],
            ]
        );
        $this->add_control(
            'ignore_sticky_posts', [
            'label' => __( 'Ignore Sticky Posts', 'droit-addons' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
            'condition' => [
                $this->get_control_id('post_type!') => ['page', 'by_id', 'category'],
            ],
            'description' => __( 'Sticky-posts ordering is visible on frontend only', 'droit-addons' ),
            ]
        );
    }

    // Notification
    protected function register_dl_blog_notification_controls(){
        if (!did_action('droitPro/loaded')) {
             $this->add_control(
                '_dl_blog_message',
                [
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'  => DL_Controls::render([
                        'icon'     => drdt_core()->images. "pro_icon.svg",
                        'title'    => __('Meet Droit Addons Pro', 'droit-addons'),
                        'btn_text'    => __('Upgrade Droit Addons', 'droit-addons'),
                        'btn_url'    => dl_pro_demo_url(),
                        'messages' => __('Create stunning website effects on your site and blow everyone away.', 'droit-addons'),
                    ]),
                    'condition' => [
                        $this->get_control_id('post_type!') => ['post', 'page'],
                    ],
                ]
            );
        }else{
            $this->add_control(
                '_dl_blog_message',
                [
                    'type' => \Elementor\Controls_Manager::RAW_HTML,
                    'raw'  => DL_Controls::render([
                        'icon'     => drdt_core()->images. "pro_icon.svg",
                        'messages' => __('Please use our pro widget widget for more feature', 'droit-addons'),
                    ]),
                    'condition' => [
                        $this->get_control_id('post_type!') => ['post', 'page'],
                    ],
                ]
            );
        }
    }
    
    // Show Hide
    protected function register_dl_blog_show_hide_controls(){
        $this->add_control(
            'show_title',
            [
                'label'     => __('Title', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
            ]
        );
        $this->add_control(
            'show_excerpt',
            [
                'label'     => __('Excerpt', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                'separator' => 'before',
                'condition' => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_3'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
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
                    $this->get_control_id('show_title') => ['yes'],
                ],

            ]
        );
        $this->add_control(
            'show_category',
            [
                'label'     => __('Category', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_1', '_skin_2', '_skin_3'],
                ],
            ]
        );
        $this->add_control(
            'show_tag',
            [
                'label'     => __('Tags', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'condition' => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_2'],
                ]
            ]
        );
        
        $this->add_control(
            'show_thumb',
            [
                'label'     => __('Show Image', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
            ]
        );
        $this->add_control(
            'show_author',
            [
                'label'     => __('Show Author', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_2', '_skin_3', '_skin_4'],
                ],
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'     => __('Show Date', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_off' => __('Hide', 'droit-addons'),
                'label_on'  => __('Show', 'droit-addons'),
            ]
        );
    }

    // Read More
    protected function register_dl_blog_read_more_controls(){
        $this->add_control(
            'show_read_more',
            [
                'label'     => __('Read More', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'  => __('Show', 'droit-addons'),
                'label_off' => __('Hide', 'droit-addons'),
                'default'   => 'yes',
                'separator' => 'before',
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_4'],
                ],
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'     => __('Read More Text', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __('Learn More »', 'droit-addons'),
                'condition' => [
                    $this->get_control_id('show_read_more') => ['yes'],
                    $this->get_control_id('_dl_blog_skin') => ['_skin_4'],
                ] 
            ]
        );
    }
    // Open Link Tab
    protected function register_dl_blog_link_controls(){
        $this->add_control(
            'open_new_tab',
            [
                'label' => __( 'Open in new window', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'droit-addons' ),
                'label_off' => __( 'No', 'droit-addons' ),
                'default' => 'no',
                'render_type' => 'none',
            ]
        );
    }

    // Masonary
    protected function register_dl_blog_masonary_layout_one_controls(){   
        $this->start_controls_section(
            '_dl_blog_masonary_section',
            [
                'label' => esc_html__('Masonary Layout', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_1'],
                ]
            ]
        );
        $this->add_control(
            '_dl_masonary_type',
            [
                'label'   => __('Masonary Type', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'metro',
                'options' => [
                    'metro'   => __('Metro', 'droit-addons'),
                    'masonry'       => __('Masonry', 'droit-addons'),
                ],
            ]
        );
        $this->add_responsive_control(
            'zigzag_height',
            [
                'label'     => esc_html__( 'Zigzag Height', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'step'      => 1,
            ] 
        );

        $this->add_control(
            'zigzag_reversed',
            [
                'label'     => esc_html__( 'Zigzag Reversed?', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,   
            ] 
        );


        $this->add_control( 'metro_image_size_width', [
            'label'     => esc_html__( 'Image Size', 'droit-addons' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'step'      => 1,
            'default'   => 480,
        ] );

        $this->add_control( 'metro_image_ratio', [
            'label'     => esc_html__( 'Image Ratio', 'droit-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'max'  => 2,
                    'min'  => 0.10,
                    'step' => 0.01,
                ],
            ],
            'default'   => [
                'size' => 1,
            ],
            
        ] );

        $this->add_responsive_control( 'grid_columns', [
            'label'          => esc_html__( 'Columns', 'droit-addons' ),
            'type'           => \Elementor\Controls_Manager::NUMBER,
            'min'            => 1,
            'max'            => 12,
            'step'           => 1,
            'default'        => 4,
            'tablet_default' => 2,
            'mobile_default' => 1,
        ] );

        $this->add_responsive_control( 'grid_gutter', [
            'label'   => esc_html__( 'Gutter', 'droit-addons' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 200,
            'step'    => 1,
            'default' => '',
        ] );

        $layout_repeater = new \Elementor\Repeater();

        $layout_repeater->add_control( 'size', [
            'label'   => esc_html__( 'Item Size', 'droit-addons' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1:1',
            'options' => \DROIT_ELEMENTOR\DL_Helper::grid_size(),
        ] );

        $this->add_control( 'grid_metro_layout', [
            'label'       => esc_html__( 'Metro Layout', 'droit-addons' ),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $layout_repeater->get_controls(),
            'default'     => [
                [ 'size' => '2:2' ],
                [ 'size' => '1:1' ],
                [ 'size' => '1:1' ],
                [ 'size' => '2:2' ],                    
                [ 'size' => '1:1' ],                    
                [ 'size' => '1:1' ],                    
            ],
            'title_field' => '{{{ size }}}',
        ] );
        $this->end_controls_section();
    }

    // Masonary 
    protected function register_dl_blog_masonary_layout_four_controls(){   
        $this->start_controls_section(
            '_dl_blog_masonary_four_section',
            [
                'label' => esc_html__('Masonary Layout', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_4'],
                ]
            ]
        );
        $this->add_control(
            '_dl_masonary_type_four',
            [
                'label'   => __('Masonary Type', 'droit-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'masonry',
                'options' => [
                    'metro'   => __('Metro', 'droit-addons'),
                    'masonry'       => __('Masonry', 'droit-addons'),
                ],
            ]
        );
        $this->add_responsive_control(
            'zigzag_height_four',
            [
                'label'     => esc_html__( 'Zigzag Height', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'step'      => 1, 
            ] 
        );

        $this->add_control(
            'zigzag_reversed_four',
            [
                'label'     => esc_html__( 'Zigzag Reversed?', 'droit-addons' ),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                
            ] 
        );


        $this->add_control( 'metro_image_size_width_four', [
            'label'     => esc_html__( 'Image Size', 'droit-addons' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'step'      => 1,
            'default'   => 480,
        ] );

        $this->add_control( 'metro_image_ratio_four', [
            'label'     => esc_html__( 'Image Ratio', 'droit-addons' ),
            'type'      => \Elementor\Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'max'  => 2,
                    'min'  => 0.10,
                    'step' => 0.01,
                ],
            ],
            'default'   => [
                'size' => null,
            ],
            
        ] );

        $this->add_responsive_control( 'grid_columns_four', [
            'label'          => esc_html__( 'Columns', 'droit-addons' ),
            'type'           => \Elementor\Controls_Manager::NUMBER,
            'min'            => 1,
            'max'            => 12,
            'step'           => 1,
            'default'        => 2,
            'tablet_default' => 2,
            'mobile_default' => 1,
        ] );

        $this->add_responsive_control( 'grid_gutter_four', [
            'label'   => esc_html__( 'Gutter', 'droit-addons' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 200,
            'step'    => 1,
            'default' => 30,
        ] );
        $this->end_controls_section();
    }
    public function register_dl_blog_general_style_section_controls(){
        $this->start_controls_section(
            '_dl_blog_style_general',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            '_dl_blog_style_general_background',
            [
                'label' => esc_html__('Background Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .dl_post_box_content' => 'background-color: {{VALUE}};',
                ],
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_3'],
                    $this->get_control_id('show_excerpt') => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_blog_box_margin',
            [
                'label' => esc_html__('Margin', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       

        $this->end_controls_section();
    }
    // Thumbnail Style
    public function register_dl_blog_thumbnail_style_section_controls(){

        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => __('Thumbnail', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'   => [
                    $this->get_control_id('show_thumb') => ['yes'],
                ],
            ]
        );
        $this->start_controls_tabs( '_dl_blog_thumbnail_tabs' );


        $this->start_controls_tab( '_dl_blog_thumbnail_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );
        
        $this->add_responsive_control(
            '_free_dl_blog_image_width',
            [
                'label' => __( 'Image Width', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_free_dl_blog_image_height',
            [
                'label'      => __('Height', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'   => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em'  => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dl_blog_object-fit',
            [
                'label' => __( 'Object Fit', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,

                'condition' => [
                    $this->get_control_id('_free_dl_blog_image_height[size]!') => '',
                ],
                'options' => [
                    '' => __( 'Default', 'droit-addons' ),
                    'fill' => __( 'Fill', 'droit-addons' ),
                    'cover' => __( 'Cover', 'droit-addons' ),
                    'contain' => __( 'Contain', 'droit-addons' ),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            '_dl_blog_image_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'image_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_blog_image_ofset') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'image_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-post__area .droit-post__thumbnail img'  => '-ms-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x.SIZE || 0}}{{UNIT}}, {{image_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-post__area .droit-post__thumbnail img'   => '-ms-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{image_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-post__area .droit-post__thumbnail img'   => '-ms-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{image_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{image_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
    
        $this->add_responsive_control(
            '_dl_blog_image_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_blog_image_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );
        $this->end_controls_tab();
                
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Title Style
    public function register_dl_blog_title_style_section_controls(){

        $this->start_controls_section(
            '_dl_blog_section_style_title',
            [
                'label'     => __('Title', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('show_title') => ['yes'],
                ]
            ]
        );
        $this->start_controls_tabs( '_dl_blog_title_tabs' );
        $this->start_controls_tab( '_dl_blog_title_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $this->add_control(
        '_dl_blog_title_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__title a' => 'color: {{VALUE}};',
                ],
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_blog_title_typography',
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post__title a, {{WRAPPER}} .droit-post__area .droit-post__title',
            ]
        );
        $this->add_control(
            '_dl_blog_title_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'blog_title_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_blog_title_ofset') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'blog_title_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__title' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-post__area .droit-post__title'  => '-ms-transform: translate({{blog_title_offset_x.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_title_offset_x.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{blog_title_offset_x.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-post__area .droit-post__title'   => '-ms-transform: translate({{blog_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{blog_title_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-post__area .droit-post__title'   => '-ms-transform: translate({{blog_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{blog_title_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_title_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        
        $this->add_responsive_control(
            '_dl_blog_title_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( '_dl_blog_title_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
        '_dl_blog_title_h_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__title a:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Content Style
    public function register_dl_blog_content_style_section_controls(){

        $this->start_controls_section(
            '_dl_blog_section_style_content',
            [
                'label'     => __('Content', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_3', '_skin_4'],
                    $this->get_control_id('show_excerpt') => ['yes'],
                ],
            ]
        );
        $this->start_controls_tabs( '_dl_blog_content_tabs' );


        $this->start_controls_tab( '_dl_blog_content_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );
         $this->add_control(
        '_dl_blog_content_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .droit-post__area .droit-post__content p' => 'color: {{VALUE}};',
                ],
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_blog_content_typography',
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post__content p, {{WRAPPER}} .droit-post__area .droit-post__content',
            ]
        );
        
        $this->add_responsive_control(
            '_dl_blog_content_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
                
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    // Category Style
    public function register_dl_blog_cat_style_section_controls(){

        $this->start_controls_section(
            '_dl_blog_section_style_cat',
            [
                'label'     => __('Category', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_1','_skin_2', '_skin_3'],
                    $this->get_control_id('show_category') => ['yes'],
                ],
            ]
        );

         $this->add_control(
        '_dl_blog_cat_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__category' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => '',
                ],
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_blog_cat_typography',
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post__category',
            ]
        );
        $this->add_control(
            '_dl_blog_cat_bg_color_after',
                [
                    'label'     => __('Background After Color', 'droit-addons'),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .dl_blog_grid_masonory_post.style_8 .dl_tag:after' => 'background-color: {{VALUE}};',
                    ],
                    'condition'   => [
                        $this->get_control_id('_dl_blog_skin') => ['_skin_3'],
                        $this->get_control_id('show_category') => ['yes'],
                    ],
                ]
            );
        $this->add_control(
        '_dl_blog_cat_bg_color',
            [
                'label'     => __('Background Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__category' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            '_dl_blog_cat_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'blog_cat_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_blog_cat_ofset') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'blog_cat_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__category' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-post__area .droit-post__category'  => '-ms-transform: translate({{blog_cat_offset_x.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_cat_offset_x.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{blog_cat_offset_x.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-post__area .droit-post__category'   => '-ms-transform: translate({{blog_cat_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_cat_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{blog_cat_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-post__area .droit-post__category'   => '-ms-transform: translate({{blog_cat_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_cat_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{blog_cat_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_cat_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        
        $this->add_responsive_control(
            '_dl_blog_cat_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_dl_blog_cat_border',
                'label' => esc_html__('Border', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post__category',
            ]
        );

        $this->add_responsive_control(
            '_dl_blog_cat_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );
        $this->end_controls_section();
    }

    // Author Style
    public function register_dl_blog_auth_style_section_controls(){

        $this->start_controls_section(
            '_dl_blog_section_style_auth',
            [
                'label'     => __('Author', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'   => [
                    $this->get_control_id('_dl_blog_skin') => ['_skin_2', '_skin_3', '_skin_4'],
                    $this->get_control_id('show_author') => ['yes'],
                ],
            ]
        );
        $this->start_controls_tabs( '_dl_blog_author_tabs' );


        $this->start_controls_tab( '_dl_blog_author_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );
         $this->add_control(
        '_dl_blog_auth_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post_author a' => 'color: {{VALUE}};',
                ],
            ]
        );
       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_blog_auth_typography',
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post_author a, .droit-post__area .droit-post_author',
            ]
        );
        $this->add_control(
            '_dl_blog_auth_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'blog_auth_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_blog_auth_ofset') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'blog_auth_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post_author' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-post__area .droit-post_author'  => '-ms-transform: translate({{blog_auth_offset_x.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_auth_offset_x.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{blog_auth_offset_x.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-post__area .droit-post_author'   => '-ms-transform: translate({{blog_auth_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_auth_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{blog_auth_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-post__area .droit-post_author'   => '-ms-transform: translate({{blog_auth_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_auth_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{blog_auth_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_auth_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        
        $this->add_responsive_control(
            '_dl_blog_auth_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_blog_auth_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_blog_author_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
        '_dl_blog_auth_h_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post_author a:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    // Date Style
    public function register_dl_blog_date_style_section_controls(){

        $this->start_controls_section(
            '_dl_blog_section_style_date',
            [
                'label'     => __('Date', 'droit-addons'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    $this->get_control_id('show_date') => ['yes'],
                ]
            ]
        );
        $this->start_controls_tabs( '_dl_blog_date_tabs' );


        $this->start_controls_tab( '_dl_blog_date_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );
        $this->add_control(
        '_dl_blog_date_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__date a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_blog_date_typography',
                'selector' => '{{WRAPPER}} .droit-post__area .droit-post__date a, .droit-post__area .droit-post__date',
            ]
        );
        $this->add_control(
            '_dl_blog_date_ofset',
            [
                'label'        => __('Offset', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_on'     => __('Custom', 'droit-addons'),
                'label_off'    => __('None', 'droit-addons'),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'blog_date_offset_x',
            [
                'label'       => __('Offset Left', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'size_units'  => ['px', '%', 'em', 'rem'],
                'condition'   => [
                    $this->get_control_id('_dl_blog_date_ofset') => ['yes'],
                ],
                'range'       => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'blog_date_offset_y',
            [
                'label'      => __('Offset Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__date' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '(desktop){{WRAPPER}} .droit-post__area .droit-post__date'  => '-ms-transform: translate({{blog_date_offset_x.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_date_offset_x.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{blog_date_offset_x.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .droit-post__area .droit-post__date'   => '-ms-transform: translate({{blog_date_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_date_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{blog_date_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .droit-post__area .droit-post__date'   => '-ms-transform: translate({{blog_date_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{blog_date_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{blog_date_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{blog_date_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );

        $this->end_popover();
        
        $this->add_responsive_control(
            '_dl_blog_date_pading',
            [
                'label'      => __('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_dl_blog_date_radius',
            [
                'label'      => __('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['%', 'px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-post__area .droit-post__date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'after',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_blog_date_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
        '_dl_blog_date_h_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-post__area .droit-post__date a:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();
         
        $this->end_controls_section();
    }    

    protected function render_title(){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_title')) {
            return;
        }
        $optional_attributes_html = $this->get_optional_link_attributes_html();

        $tag = !empty($this->get_blogs_settings('title_tag')) ? $this->get_blogs_settings('title_tag') : 'h3';
        ?>
    
    <<?php echo $tag; ?> class="dl_title droit-post__title"> <a href="<?php echo $this->current_permalink; ?>" <?php echo $optional_attributes_html; ?>><?php the_title();?></a> </<?php echo $tag; ?>>
    <?php
    }
    protected function render_thumbnail($_image_width, $_image_height){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_thumb')) {
            return;
        }
       
         if ( has_post_thumbnail() ) : 
            DL_Images::the_post_thumbnail(
                array(
                    'size'   => 'custom',
                    'width'  => $_image_width,
                    'height' => $_image_height
                ) 
            ); 
         else: 
            DL_Images::image_placeholder( 480, 480 );
         endif;
    }

    protected function render_thumbnails() {
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_thumb')) {
            return;
        }
        
        ?>
        <div class="droit-post__thumbnail">
            <?php
                 if ( has_post_thumbnail() ) :
                 $class = '';
                 switch ($this->get_blogs_settings('_dl_blog_skin')) {
                      case '_skin_1':
                           $class = ' dl_img_res zoom_in_img ';
                          break;
                      case '_skin_4':
                           $class = ' blog_masonry_thumb ';
                          break;
                  } 
                    $size = $this->get_blogs_settings('thumbnail_size_size');
                    the_post_thumbnail( $size, array( 'class' => $class . 'zoom_in_img dl_thumbnail_fluid ' ) );
                 else:
                    DL_Images::image_placeholder( 480, 480 );
                 endif;
             ?>
        </div>
    <?php
    }

    protected function render_excerpt() {
        $settings = $this->get_settings_for_display();
        if ( !$this->get_blogs_settings('show_excerpt') ) {
            return;
        }

        ?>
        <div class="droit-post__excerpt dl_description droit-post__content dl_desc">
            <?php 
            if ( ! has_excerpt() ) {
                echo '<p>';
                echo wp_trim_words( get_the_content(), 10, '...' );
               echo '</p>';
            } else { 
                the_excerpt();
            }?>
        </div>
        <?php
    }

    protected function render_category( $taxonomy = 'category', $type = 'single' ){ //single or multiple
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_category')) {
            return;
        }
        $output = '';
        $class = $this->get_blogs_settings('_dl_blog_skin') == '_skin_2' || $this->get_blogs_settings('_dl_blog_skin') == '_skin_3' ? 'dl_tag droit-post__category' : 'd-inline-block dl_tag sa droit-post__category';
        if( 'category' == $taxonomy ) {
            if( $type == 'single' ){
                $category = get_the_category();
                if( !empty( $category ) ) {
                    $output = '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) .'" class="'.$class.'">'. esc_html( $category[0]->cat_name ) .'</a>';
                }
            }
            else{
                $category = get_the_category_list(', ');
                if( !empty( $category ) ) {
                    $output = '<a href="#" class="'.$class.'">'. esc_html( $category[0]->cat_name ) .'</a>';
                }
                
            }
        }
        else {
            $terms = get_the_terms( get_the_ID(), $taxonomy );
            $term_link = get_term_link( $terms[0], $taxonomy );

            if( !empty( $terms ) ) {
                $output = '<a href="' . esc_url( $term_link ) .'" class="'.$class.'">'. esc_html( $terms[0]->name ) .'</a>';
            }
        }
        echo $output;
    }

    protected function render_author(){
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_author')) {
            return;
        }

        ?>
        <p class="dl_post_author droit-post_author">
         <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author();?></a>
     </p>
     <?php
    }

    protected function render_avatar() {
        $args = array(
        'size'          => 45,
        'height'        => 45,
        'width'         => 45,
        'class'         => 'dl_author_img',
    );
    if (!$this->get_blogs_settings('show_author')) {
        return;
    }
        
    ?>
    <div class="droit-post__avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 45, '', get_the_author_meta( 'display_name' ), $args ); ?>
    </div>
    <?php
    }

    protected function render_date() {   
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_date')) {
            return;
        }
        $author_prefix_text = $this->get_blogs_settings('_dl_blog_skin') == '_skin_1' ? ' By' : '';
        echo '<p class="dl_date droit-post__date"><a href="#">'.apply_filters('the_date', get_the_date(), get_option('date_format'), '', ''). $author_prefix_text . '</a></p>';
    }

    protected function render_tag() {    
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_tag')) {
            return;
        }
        $output = '';
        $post_tags = get_the_tags();
        $separator = ', ';
        if (!empty($post_tags)) {
            $output .= '<ul class="tag_list">';
            foreach ($post_tags as $tag) {
                $output .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>' . $separator;
            }
             $output .= '</ul>';
            echo trim($output, $separator);

        }
    }

    protected function render_meta() {
        $settings = $this->get_settings_for_display();
        if (!$this->get_blogs_settings('show_author') && !$this->get_blogs_settings('show_date')) {
            return;
        }
        ?>
        <div class="dl_post_meta">
            <?php 
                $this->render_date();
                $this->render_author();
            ?> 
        </div>
        <?php
    }

    protected function render_read_more() {
        $settings = $this->get_settings_for_display();
        if ( ! $this->get_blogs_settings('show_read_more') ) {
            return;
        }

        $optional_attributes_html = $this->get_optional_link_attributes_html();

        ?>
            <a class="droit-post__read-more read_more_btn" href="<?php echo $this->current_permalink; ?>" <?php echo $optional_attributes_html; ?>>
                <?php echo $this->get_blogs_settings('read_more_text'); ?>
            </a>
        <?php
    }

    protected function get_optional_link_attributes_html() {
        $settings = $this->get_settings_for_display();
        $new_tab_setting_key = $this->get_control_id( 'open_new_tab' );
        $optional_attributes_html = 'yes' === $this->get_blogs_settings($new_tab_setting_key) ? 'target="_blank"' : '';

        return $optional_attributes_html;
    }

    protected function get_grid_options( array $settings ) {
        $grid_options = [
            'type'  => $this->get_blogs_settings('_dl_masonary_type'),
            'ratio' => $this->get_blogs_settings('metro_image_ratio')['size'],
        ];

        // Columns.
        if ( ! empty( $this->get_blogs_settings('grid_columns') ) ) {
            $grid_options['columns'] = $this->get_blogs_settings('grid_columns');
        }

        if ( ! empty( $this->get_blogs_settings('grid_columns_tablet') ) ) {
            $grid_options['columnsTablet'] = $this->get_blogs_settings('grid_columns_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('grid_columns_mobile') ) ) {
            $grid_options['columnsMobile'] = $this->get_blogs_settings('grid_columns_mobile');
        }

        // Gutter
        if ( ! empty( $this->get_blogs_settings('grid_gutter') ) ) {
            $grid_options['gutter'] = $this->get_blogs_settings('grid_gutter');
        }

        if ( ! empty( $this->get_blogs_settings('grid_gutter_tablet') ) ) {
            $grid_options['gutterTablet'] = $this->get_blogs_settings('grid_gutter_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('grid_gutter_mobile') ) ) {
            $grid_options['gutterMobile'] = $this->get_blogs_settings('grid_gutter_mobile');
        }

        // Zigzag height.
        if ( ! empty( $this->get_blogs_settings('zigzag_height') ) ) {
            $grid_options['zigzagHeight'] = $this->get_blogs_settings('zigzag_height');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_height_tablet') ) ) {
            $grid_options['zigzagHeightTablet'] = $this->get_blogs_settings('zigzag_height_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_height_mobile') ) ) {
            $grid_options['zigzagHeightMobile'] = $this->get_blogs_settings('zigzag_height_mobile');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_reversed') ) && 'yes' === $this->get_blogs_settings('zigzag_reversed') ) {
            $grid_options['zigzagReversed'] = 1;
        }

        return $grid_options;
    }

    protected function get_grid_layout_four_options( array $settings ) {
        $grid_options = [
            'type'  => $this->get_blogs_settings('_dl_masonary_type_four'),
            'ratio' => 'null',
        ];

        // Columns.
        if ( ! empty( $this->get_blogs_settings('grid_columns_four') ) ) {
            $grid_options['columns'] = $this->get_blogs_settings('grid_columns_four');
        }

        if ( ! empty( $this->get_blogs_settings('grid_columns_four_tablet') ) ) {
            $grid_options['columnsTablet'] = $this->get_blogs_settings('grid_columns_four_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('grid_columns_four_mobile') ) ) {
            $grid_options['columnsMobile'] = $this->get_blogs_settings('grid_columns_four_mobile');
        }

        // Gutter
        if ( ! empty( $this->get_blogs_settings('grid_gutter_four') ) ) {
            $grid_options['gutter'] = $this->get_blogs_settings('grid_gutter_four');
        }

        if ( ! empty( $this->get_blogs_settings('grid_gutter_four_tablet') ) ) {
            $grid_options['gutterTablet'] = $this->get_blogs_settings('grid_gutter_four_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('grid_gutter_four_mobile') ) ) {
            $grid_options['gutterMobile'] = $this->get_blogs_settings('grid_gutter_four_mobile');
        }

        // Zigzag height.
        if ( ! empty( $this->get_blogs_settings('zigzag_height_four') ) ) {
            $grid_options['zigzagHeight'] = $this->get_blogs_settings('zigzag_height_four');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_height_four_tablet') ) ) {
            $grid_options['zigzagHeightTablet'] = $this->get_blogs_settings('zigzag_height_four_tablet');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_height_four_mobile') ) ) {
            $grid_options['zigzagHeightMobile'] = $this->get_blogs_settings('zigzag_height_four_mobile');
        }

        if ( ! empty( $this->get_blogs_settings('zigzag_reversed_four') ) && 'yes' === $this->get_blogs_settings('zigzag_reversed_four') ) {
            $grid_options['zigzagReversed'] = 1;
        }

        return $grid_options;
    }

    protected function query_posts() {
        $settings = $this->get_settings_for_display();
        extract($settings);

        //post sticky
        $sticky_post = $this->get_blogs_settings('ignore_sticky_posts') ? true : false;

        $arrayType = ['page', 'by_id', 'category'];

        $query_args['offset'] = 0;
        $query_args['posts_per_page'] = 6;
        $query_args['posts_ids'] = [];

        if(!empty($post_type)) {
            $query_args['post_type'] = $post_type;
        }

        if(!empty($order_by)) {
            $query_args['orderby'] = $order_by;
        }

        if(!empty($order)) {
            $query_args['order'] = $order;
        }

        if( !empty( $post_type ) && !in_array($post_type, $arrayType) ){
            $sticky_args = array(
                'ignore_sticky_posts' => $sticky_post,
            );

            $query_args = array_merge( $query_args, $sticky_args );
        }

        if(!empty( $posts_per_page )) {
            $query_args['posts_per_page'] = $posts_per_page;
        }

        $tax_query = [
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => ['post-format-quote', 'post-format-link'],
            'operator' => 'NOT IN',
        ];

        $query_args['tax_query'] = $tax_query;
        
        $dl_query = new \WP_Query($query_args);
        return $dl_query;
    }

    //Html render
    protected function render(){ 
        $settings = $this->get_settings_for_display();

        $_dl_blog_skin  = isset($settings['_dl_blog_skin']) && !empty($settings['_dl_blog_skin']) ? $settings['_dl_blog_skin'] : '_skin_1';
   
        switch ($_dl_blog_skin) {
            case '_skin_1':
                 $this->_dl_blog_skin_one();
                break;
            case '_skin_2':
                 $this->_dl_blog_skin_two();
                break;
            case '_skin_3':
                 $this->_dl_blog_skin_three();
                break;
            case '_skin_4':
                 $this->_dl_blog_skin_four();
                break;
            default:
                $this->_dl_blog_skin_one();
                break;
        }
        ?>
        <script>
            jQuery(".dl_addons_grid_wrapper").each(function () {
                var dl_addons_grid_wrapper = jQuery('.dl_addons_grid_wrapper');
                if (dl_addons_grid_wrapper.length) {
                    jQuery(this).dlAddonsGridLayout();
                }
            });
        </script>   
        <?php
    }

    protected function _dl_blog_skin_one(){ 
        $settings = $this->get_settings_for_display();
        
        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', [
            'dl_addons_grid_wrapper dl_grid_metro',
            'style-masonary',
        ] );

        $this->add_render_attribute( 'wrapper', 'class', 'blog-grid-masonary' );
 
        $grid_options = $this->get_grid_options( $settings );

        $this->add_render_attribute( 'wrapper', 'data-grid', wp_json_encode( $grid_options ) );
        if ( isset( $settings['grid_metro_layout'] ) && !empty($settings['grid_metro_layout']) ) {
            $metro_layout = [];

        foreach ( $this->get_blogs_settings('grid_metro_layout') as $key => $value ) {
            $metro_layout[] = $value['size'];
            
            }
        } else {
            $metro_layout = [
                '2:2',
                '1:1',
                '1:1',
                '2:2',
                '1:1',      
                '1:1',      
            ];
        }
    if ( count( $metro_layout ) < 1 ) {
        return;
    }
    $metro_layout_count = count( $metro_layout );
    $metro_item_count   = 0;
    $count              = $query_posts->post_count;
        ?>

            <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div class="dl_addons_grid">
                <div class="grid-sizer"></div>
                    <?php 
                    while ( $query_posts->have_posts() ) :
                        $query_posts->the_post();
                        $this->current_permalink = get_permalink();
                        $classes = "grid-item";
                         
                        $size   = $metro_layout[ $metro_item_count ];

                        $ratio  = explode( ':', $size );
                  
                        $ratioW = $ratio[0];
                        $ratioH = $ratio[1];

                        $_image_width  = $this->get_blogs_settings('metro_image_size_width');
                        $_image_height = $_image_width * isset($this->get_blogs_settings('metro_image_ratio')['size'])? $this->get_blogs_settings('metro_image_ratio')['size'] : '';
                         
                        if ( in_array( $ratioW, array( '2' ) ) ) {
                            $_image_width *= 1;
                        }

                        if ( in_array( $ratioH, array( '1.3', '2' ) ) ) {
                            $_image_height *= 2;
                        }
                    ?>
                      <div class="<?php echo $classes; ?>" data-width="<?php echo esc_attr( $ratioW ); ?>" data-height="<?php echo esc_attr( $ratioH ); ?>">

                        <div class="grid-item-height" style="height: 950px;">
                            <div class="grid-item-content dl_masonry_blog_post zoom_in_effect droit-post__area blog_grid_masonory">
                                <a href="<?php echo $this->current_permalink; ?>" class="dl_masonry_blog_thumb">
                                    <?php $this->render_thumbnails(); ?>
                                </a>
                                 <?php $this->render_category();  ?>
                                <div class="dl_masonry_blog_content blog_grid_masonory_content">
                                    <div class="dl_post_meta">
                                         <?php
                                            $this->render_date(); 
                                            $this->render_author();
                                        ?>
                                    </div>
                                    <?php $this->render_title(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $metro_item_count++;
                    if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
                        $metro_item_count = null;
                    }
                endwhile; 
                wp_reset_postdata();
                ?>
                 </div>
            </div>
    <?php }

    protected function render_post_header() {
        $settings = $this->get_settings_for_display();
        ?>
        <div <?php post_class( [  $this->get_blogs_settings('_dl_blog_skin'), 'dl_row' ] ); ?>>
        <?php
    }

    protected function render_post_footer() {
        ?>
        </div>
        <?php
    }
    protected function _dl_blog_skin_two()
    { 
        $settings = $this->get_settings_for_display();
        
        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = isset($settings['_dl_blog_columns']) && !empty($settings['_dl_blog_columns']) ? $settings['_dl_blog_columns'] : 4;
        
        $this->render_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();

        ?>
         <div class="dl_col_lg_<?php echo $columns; ?> dl_col_sm_<?php echo $this->get_blogs_settings('_dl_blog_columns_tablet'); ?>">
            
            <div class="droit-post__area blog_grid_masonory style_5 zoom_in_effect">
                <?php 
                if ( $this->get_blogs_settings('show_thumb') == 'yes'):
                 ?>
                <a href="<?php echo $this->current_permalink; ?>" class="post_thumb">
                    <?php $this->render_thumbnails();?>
                </a>
            <?php endif; ?>
                 <?php $this->render_category();  ?>
                <div class="blog_grid_masonory_content">
                     <?php $this->render_title(); ?>
                    <div class="dl_post_meta">
                        <?php
                            $this->render_author();
                            $this->render_date(); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
         <?php endwhile;
         wp_reset_postdata(); 
           $this->render_post_footer();
          ?>
   <?php }
    protected function _dl_blog_skin_three()
    { 
        $settings = $this->get_settings_for_display();
        
        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }
        //Columns
        $columns = isset($settings['_dl_blog_columns']) && !empty($settings['_dl_blog_columns']) ? $settings['_dl_blog_columns'] : 4;
        
        $this->render_post_header();
        while ( $query_posts->have_posts() ) :
              $query_posts->the_post();
              $this->current_permalink = get_permalink();
        ?>
         <div class="dl_col_lg_<?php echo $columns; ?> dl_col_sm_<?php echo $this->get_blogs_settings('_dl_blog_columns_tablet'); ?>">
            
            <div class="droit-post__area dl_blog_grid_masonory_post style_8 zoom_in_effect">
                 <a href="<?php echo $this->current_permalink; ?>" class="dl_blog_grid_masonory_img">
                    <?php $this->render_thumbnails();?>
                </a>
                <div class="dl_post_box_content">
                    <?php 
                        $this->render_category();
                        $this->render_title();
                        $this->render_excerpt()
                     ?>
                    <div class="dl_post_meta">
                        <?php
                            $this->render_avatar();
                            $this->render_author();
                            $this->render_date(); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
         <?php endwhile;
         wp_reset_postdata(); 
           $this->render_post_footer();
          ?>
   <?php }

   protected function _dl_blog_skin_four(){ 
        $settings = $this->get_settings_for_display();
        
        $query_posts = $this->query_posts();
      
        if (!$query_posts->found_posts) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', [
            'dl_addons_grid_wrapper dl_grid_metro',
            'style-masonary',
        ] );

        $this->add_render_attribute( 'wrapper', 'class', 'blog-grid-masonary' );

        $grid_options = $this->get_grid_layout_four_options( $settings );

        $this->add_render_attribute( 'wrapper', 'data-grid', wp_json_encode( $grid_options ) );

        $metro_item_count   = 0;
    
        ?>
            <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div class="dl_addons_grid loaded">
                <div class="grid-sizer"></div>
                    <?php 
                    while ( $query_posts->have_posts() ) :
                        $query_posts->the_post();
                        $this->current_permalink = get_permalink();
                        $classes = "grid-item";

                        $_image_width  = $this->get_blogs_settings('metro_image_size_width_four');
                        $_image_height = $_image_width * isset($this->get_blogs_settings('metro_image_ratio_four')['size'])? $this->get_blogs_settings('metro_image_ratio_four')['size'] : '';

                    ?>
                      <div class="<?php echo $classes; ?>">
                        
                        <div class="droit-post__area dl_blog_grid_masonory_post style_6">
                            <a href="<?php echo $this->current_permalink; ?>" class="dl_blog_grid_masonory_post_thumb">
                               <?php $this->render_thumbnails(); ?>
                            </a>
                            <div class="dl_blog_grid_masonory_post_inner">
                                <div class="dl_post_meta">
                                    <?php 
                                        $this->render_avatar(); 
                                        $this->render_author(); 
                                        $this->render_date(); 
                                        ?>
                                </div>
                                <div class="dl_blog_grid_masonory_content">
                                    <?php $this->render_title(); ?>
                                    <?php $this->render_excerpt(); ?>
                                    <?php $this->render_read_more(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                 </div>
            </div>
    <?php }
    
    protected function content_template(){}
}
