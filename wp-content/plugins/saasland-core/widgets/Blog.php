<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Blog Posts
 */
class Blog extends Widget_Base {
    public function get_name() {
        return 'saasland_blog';
    }

    public function get_title() {
        return __( 'Blog Posts', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {


        // ----------------------------------------  Blog Posts  ------------------------------ //
        $this->start_controls_section(
            'blog_select_sec',
            [
                'label' => __( 'Blog Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Select Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__( 'Style One - Category Posts Carousel', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two - Column Grid', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();

        //----------------------------------------------------- Featured Post ID ---------------------------------------------------------//
        $this->start_controls_section(
            'featured_post_sec', [
                'label' => __( 'Featured Post', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'featured_post', [
                'label' => esc_html__( 'Featured Post ID', 'saasland-core' ),
                'description' => __( '<a href="https://pagely.com/blog/find-post-id-wordpress/" target="_blank">How to Find the Post ID?</a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();


        //--------------------------------------------------- Buttons Section ---------------------------------------------------------------//
        $this->start_controls_section(
            'button_sec', [
                'label' => __( 'Read More Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More'
            ]
        );

        $this->add_control(
            'btn_icon_f_size',
            [
                'label' => __( 'Icon Size', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => 'px',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .learn_btn_two i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]

            ]
        );


        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ],
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn:hover' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // ----------------------------- Posts Carousel ----------------------
        $this->start_controls_section(
            'posts_carousel', [
                'label' => __( 'Posts Carousel', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'slide_cats', [
                'label' => __( 'Slide Category', 'saasland-core' ),
                'description' => __( 'The slide items are category based. You have to choose a post category to show a slide item and make sure it contains at least 3 posts.', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ cat }}}',
                'fields' => [
                    [
                        'name' => 'cat',
                        'label' => __( 'Category Name', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => saasland_cat_array(),
                        'default' => 'all'
                    ]
                ],
            ]
        );

        $this->end_controls_section();



        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
            ]
        );

        $this->add_control(
            'cat', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_cat_array(),
                'default' => 'all',
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control(
            'title_limit_char', [
                'label' => esc_html__( 'Title Character Limit', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20
            ]
        );
        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_control(
            'pagination_align',
            [
                'label' => __( 'Alignment', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __( 'Left', 'saasland-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'saasland-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'end' => [
                        'title' => __( 'Right', 'saasland-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'condition' => [
                    'show_pagination' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- Column Grid Section ---------------------------------//
        $this->start_controls_section(
            'column_sec', [
                'label' => __( 'Grid Column', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '6'
            ]
        );

        $this->end_controls_section();

        //----------------------------- Style Title Section --------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20',
            ]
        );

        $this->end_controls_section();


        //----------------------------- Style Subtitle Section --------------------------------//
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Subtitle Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} p.f_size_15.f_300.mb_40' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.f_size_15.f_300.mb_40',
            ]
        );

        $this->end_controls_section();


        //----------------------------- Style Background Gradient --------------------------------//
        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Left Gradient Color', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->add_control(
            'fpb_color_left', [
                'label'     => esc_html__( 'Color One', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'fpb_color_right', [
                'label'     => esc_html__( 'Color Two', 'saasland-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.about_content' => 'background-image: -webkit-linear-gradient(40deg, {{fpb_color_left.VALUE}} 0%, {{VALUE}} 100%)'
                ],
            ]
        );

        $this->end_controls_section();

        //----------------------------- Style Blog Title --------------------------------//
        $this->start_controls_section(
            'style_blog_title_sec', [
                'label' => __( 'Title Style', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_title_typography',
                'label' => __( 'Typography', 'saasland-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .h_blog_item .h_blog_content h3',
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- Accent Color  ---------------------------------//
        $this->start_controls_section(
            'accent_color_sec', [
                'label' => __( 'Accent Color', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'accent_style_tabs'

        );
        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'accent_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'accent_normal_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post_time' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .post-info-comments' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'accent_normal_icon_color', [
                'label' => __( 'Icon Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post_time i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .post-info-comments i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:before' => 'background: {{VALUE}}',

                ],
            ]
        );

        $this->end_controls_tab();


        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'accent_hover_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'accent_hover_font_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h_blog_item .h_blog_content h3:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .h_blog_item .h_blog_content .post-info-bottom .learn_btn_two:hover:before' => 'background: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        $featured_post = new WP_Query(array(
            'post_type'     => 'post',
            'posts_per_page'=> -1,
            'p' => $settings['featured_post'],
        ));

        if ( $settings['style'] == 'style_01' ) {
            ?>
            <section class="agency_about_area d-flex">
                <?php
                while($featured_post->have_posts()) : $featured_post->the_post();
                    $excerpt = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '');
                    ?>
                    <div class="col-lg-6 about_content_left">
                        <div class="about_content mb_30">
                            <?php the_title( '<h2 class="f_size_30 f_700 l_height45 mb_20">', '</h2>' ) ?>
                            <?php if ( $excerpt ) : ?>
                                <p class="f_size_15 f_300 mb_40"> <?php echo saasland_kses_post($excerpt) ?> </p>
                            <?php endif; ?>
                            <?php if (!empty($settings['btn_title'])) : ?>
                                <a href="<?php the_permalink() ?>" class="about_btn">
                                    <?php echo esc_html($settings['btn_title']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="col-lg-6 about_img">
                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="pluse_icon"><i class="ti-link"></i></a>
                    <div class="about_img_slider owl-carousel">
                        <?php
                        if ( !empty($settings['slide_cats']) ) {
                            foreach ( $settings['slide_cats'] as $cat ) {
                                echo '<div class="item">';
                                if ( $cat['cat'] == 'all' ) {
                                    $cat_posts = new WP_Query(array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 3,
                                    ));
                                } else {
                                    $cat_posts = new WP_Query(array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 3,
                                        'category_name' => $cat['cat'],
                                    ));
                                }
                                $cat_i = 0;
                                while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
                                    ?>
                                    <div class="about_item <?php echo ($cat_i == 0) ? 'w45' : 'w55'; ?>">
                                        <?php
                                        $image_size = ($cat_i == 0) ? 'saasland_455x600' : 'saasland_520x300';
                                        the_post_thumbnail($image_size);
                                        ?>
                                        <div class="about_text">
                                            <span class="br"></span>
                                            <a href="<?php the_permalink() ?>">
                                                <h5 class="f_size_18 l_height28 mb-0"> <?php the_title() ?> </h5>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    ++$cat_i;
                                endwhile;
                                wp_reset_postdata();
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
            <script>
                ;(function($) {
                    "use strict";
                    $(document).ready(function () {
                        var reviews_slider2 = $(".about_img_slider");
                        if (reviews_slider2.length) {
                            reviews_slider2.owlCarousel({
                                loop: true,
                                margin: 0,
                                items: 1,
                                nav: false,
                                autoplay: false,
                                smartSpeed: 2000,
                                responsiveClass: true,
                            })
                        }
                    })
                })(jQuery)
            </script>
            <?php
        }
        elseif ( $settings['style'] == 'style_02' ) {
            $limit_char = isset( $settings['title_limit_char'] ) ? $settings['title_limit_char'] : '10';
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            if ( !empty($settings['cat']) && $settings['cat'] != 'all' ) {
                $blog_post = new WP_Query( array (
                    'post_type' => 'post',
                    'posts_per_page' => $settings['show_count'],
                    'order' => $settings['order'],
                    'category_name' => $settings['cat'],
                    'paged' => $paged
                ));
            } else {
                $blog_post = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => $settings['show_count'],
                    'order' => $settings['order'],
                    'paged' => $paged,
                ));
            }
            ?>
            <div class="container">
                <div class="row">
                    <?php
                    while($blog_post->have_posts()) : $blog_post->the_post();
                        if ( $settings['column'] == '4' ) {
                            $style2_image_size = 'saasland_370x320';
                        } else {
                            $style2_image_size = 'saasland_560x400';
                        }
                        ?>
                        <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-md-6 mb-5">
                            <div class="h_blog_item">
                                <?php the_post_thumbnail($style2_image_size) ?>
                                <div class="h_blog_content">
                                    <a href="<?php saasland_core_day_link() ?>" class="post_time">
                                        <i class="icon_clock_alt"></i>
                                        <?php the_time(get_option( 'date_format')) ?>
                                    </a>
                                    <a href="<?php the_permalink() ?>">
                                        <h3 title="<?php echo esc_attr( the_title() ) ?>"><?php echo saaslandCore_limit_latter(get_the_title(), $limit_char) ?></h3>
                                    </a>
                                    <div class="post-info-bottom">
                                        <?php if (!empty($settings['btn_title'])) : ?>
                                            <a href="<?php the_permalink() ?>" class="learn_btn_two">
                                                <?php echo esc_html($settings['btn_title']) ?> <i class="arrow_right"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a class="post-info-comments" href="#">
                                            <i class="icon_comment_alt" aria-hidden="true"></i>
                                            <span><?php comments_number() ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    if( $settings['show_pagination'] == 'yes' ) {
                        $align_class = !empty( $settings['pagination_align'] ) ? $settings['pagination_align'] : 'center';
                        $total_pages = $blog_post->max_num_pages;
                        if ($total_pages > 1) {
                            echo '<div class="custom_blog pagination justify-content-'.esc_attr( $align_class ).'"><div class="nav-links">';
                            $current_page = max(1, get_query_var('paged'));
                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => '/page/%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'prev_text' => '<i class="ti-arrow-left"></i>',
                                'next_text' => '<i class="ti-arrow-right"></i>',
                                'add_args' => array()
                            ));
                            echo '</div></div>';
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        }
    }
}