<?php
namespace SaaslandCore\Widgets;

use Elementor\Group_Control_Image_Size;
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
 * Filterable Portfolio
 */
class Portfolio extends Widget_Base {
    public function get_name() {
        return 'saasland_portfolio';
    }

    public function get_title() {
        return __( 'Filterable Portfolio', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'portfolio_style', [
                'label' => __( 'Portfolio Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'select_style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( 'Filterable Portfolio', 'saasland-core' ),
                    '2' => __( 'Portfolio Vertical Carousel', 'saasland-core' ),
                ],
                'default' => '1'
            ]
        );
        $this->end_controls_section();

        $portfolio_carousel = new \Elementor\Repeater();
        $this->start_controls_section(
            'portfolio_carousel', [
                'label' => __( 'Portfolio Vertical Carousel', 'saasland-core' ),
                'condition' => [
                   'select_style' => '2'
                ]
            ]
        );

        $portfolio_carousel->add_control(
            'portfolio_post_id', [
                'label' => __( 'Select Post', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_get_post_title('portfolio'),
            ]
        );
        $portfolio_carousel->add_control(
            'sub_title', [
                'label' => __( 'Item Sub-title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $portfolio_carousel->add_control(
            'sub_title_underline', [
                'label' => __( 'Sub-title Underline', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $portfolio_carousel->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $this->add_control(
            'portfolio_items',
            [
                'label' => __( 'Portfolios', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $portfolio_carousel->get_controls(),
                'title_field' => '{{{ portfolio_post_id }}}',
            ]
        );
        $this->end_controls_section();


        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_filter', [
                'label' => __( 'Filter Bar', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All'
            ]
        );

        $this->add_control(
            'is_show_count', [
                'label' => esc_html__( 'Show Count', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Query Options
         */
        $this->start_controls_section(
            'portfolio_query', [
                'label' => __( 'Query', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Posts Per Page', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '8'
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'description' => esc_html__( '‘ASC‘ – ascending order from lowest to highest values (1, 2, 3; a, b, c). ‘DESC‘ – descending order from highest to lowest values (3, 2, 1; c, b, a).', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                    'comment_count' => 'Comment Count',
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Portfolio', 'saasland-core' ),
                'description' => esc_html__( 'Enter the portfolio post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        /**
         * Layout
         */
        $this->start_controls_section(
            'portfolio_layout', [
                'label' => __( 'Layout', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover' => esc_html__( 'Hover Contents', 'saasland-core' ),
                    'normal' => esc_html__( 'Normal Contents', 'saasland-core' ),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two Column', 'saasland-core' ),
                    '4' => __( 'Three Column', 'saasland-core' ),
                    '3' => __( 'Four Column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->add_control(
            'is_full_width', [
                'label' => __( 'Full Width', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'is_cat', [
                'label' => __( 'Categories', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'is_plus_icon', [
                'label' => __( 'Lightbox Plus Icon', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => 'hover'
                ]
            ]
        );

        $this->end_controls_section();


        /**
         * Filter Bar Styling
         */
        $this->start_controls_section(
            'portfolio_color', [
                'label' => __( 'Filter Bar', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'filter_color', [
                'label' => __( 'Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_count_color', [
                'label' => __( 'Filter Count Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work_portfolio_item span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_active_color', [
                'label' => __( 'Active Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active, .portfolio_filter .work_portfolio_item:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active:before, .portfolio_filter .work_portfolio_item:hover:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        $portfolios = new WP_Query( array (
            'post_type'     => 'portfolio',
            'posts_per_page'=> $settings['show_count'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'post__not_in' => !empty($settings['exclude']) ? explode( ',', $settings['exclude']) : ''
        ));

        $portfolio_cats = get_terms( array (
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => true
        ));

        $settings['thumbnail_size'] = [
            'id' => get_post_thumbnail_id(),
        ];
        $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
        $is_show_count = $settings['is_show_count'] == 'yes' ? "show-portfolio-count" : '';
        $layout = ($settings['is_full_width'] == 'yes' ) ? ' portfolio_fullwidth_area' : ' portfolio_area';

        if( $settings['select_style'] == '2' ){
            wp_enqueue_style( 'saasland-digital-agency' );
            wp_enqueue_script( 'slick' ); ?>
            <section>
                <div class="showcase_slider">
                    <?php
                    if( is_array( $settings['portfolio_items'] ) ){
                        foreach ( $settings['portfolio_items'] as $portfolio ) {
                            $portfolio_item = get_post( $portfolio['portfolio_post_id'] ); ?>

                            <div class="slider elementor-repeater-item-<?php echo esc_attr(  $portfolio['_id'] ) ?>">
                                <?php echo get_the_post_thumbnail( $portfolio['portfolio_post_id'], 'full', array('class'=>'showcase_bg') ); ?>

                                <div class="showcase_slider_item">
                                    <a href="<?php echo get_the_permalink( $portfolio_item->ID ); ?>">
                                        <h3 data-animation="fadeInUp" data-delay="0.3s"><?php echo esc_html( $portfolio_item->post_title ); ?></h3>
                                    </a>
                                    <?php
                                    if( !empty( $portfolio['sub_title'] ) ){
                                        echo '<h6 data-animation="fadeInUp" data-delay="0.5s">'. esc_html( $portfolio['sub_title'] ) .'</h6>';
                                    }

                                    if( !empty( $portfolio['sub_title_underline']['id'] ) ){
                                        echo wp_get_attachment_image( $portfolio['sub_title_underline']['id'], 'full' );
                                    } ?>

                                    <p data-animation="fadeInUp" data-delay="0.6s">
                                        <?php
                                        $categories = get_the_terms( $portfolio_item->ID, 'portfolio_cat' );
                                        foreach( $categories as $category ) {
                                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="'. esc_attr( $category->name ) .'">' . esc_html( $category->name ) . '</a>';
                                        } ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {

                        if ($(".showcase_slider").length) {
                            const sliders = $('.showcase_slider');
                            sliders.on("init", function (e, slick) {
                                var $firstAnimatingElements = $("div.slider:first-child").find(
                                    "[data-animation]"
                                );
                                doAnimations($firstAnimatingElements);
                            });
                            sliders.on("beforeChange", function (
                                e,
                                slick,
                                currentSlide,
                                nextSlide
                            ) {
                                var $animatingElements = $(
                                    'div.slider[data-slick-index="' + nextSlide + '"]'
                                ).find("[data-animation]");
                                doAnimations($animatingElements);
                            });

                            function onSliderAfterChange(event, slick, currentSlide) {
                                $(event.target).data('current-slide', currentSlide);
                            }

                            function onSliderWheel(e) {
                                var deltaY = e.originalEvent.deltaY,
                                    $currentSlider = $(e.currentTarget),
                                    currentSlickIndex = $currentSlider.data('current-slide') || 0;

                                if (
                                    // check when you scroll up
                                    (deltaY < 0 && currentSlickIndex == 0) ||
                                    // check when you scroll down
                                    (deltaY > 0 && currentSlickIndex == $currentSlider.data('slider-length') - 1)
                                ) {
                                    return;
                                }

                                e.preventDefault();

                                if (e.originalEvent.deltaY < 0) {
                                    $currentSlider.slick('slickPrev');
                                } else {
                                    $currentSlider.slick('slickNext');
                                }
                            }

                            sliders.each(function (index, element) {
                                var $element = $(element);
                                $element.data('slider-length', $element.children().length);
                            })
                                .slick({
                                    infinite: false,
                                    slidesToShow: 1,
                                    vertical: true,
                                    verticalSwiping: true,
                                    slidesToScroll: 1,
                                    dots: false,
                                    arrows: false,
                                    rows: 0,
                                    responsive: [
                                        {
                                            breakpoint: 991,
                                            settings: {
                                                verticalSwiping: false,
                                                vertical: false,
                                            },
                                        },

                                    ],

                                })
                                .on('afterChange', onSliderAfterChange)
                                .on('wheel', onSliderWheel);

                            function doAnimations(elements) {
                                var animationEndEvents =
                                    "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
                                elements.each(function () {
                                    var $this = $(this);
                                    var $animationDelay = $this.data("delay");
                                    var $animationType = "animated " + $this.data("animation");
                                    $this.css({
                                        "animation-delay": $animationDelay,
                                        "-webkit-animation-delay": $animationDelay,
                                    });
                                    $this.addClass($animationType).one(animationEndEvents, function () {
                                        $this.removeClass($animationType);
                                    });
                                });
                            }
                        }

                    })
                })(jQuery)
            </script>
            <?php
        }
        else { ?>
            <section class="<?php echo $is_show_count; echo $layout ?>">
                <?php echo ($settings['is_full_width'] == 'yes' ) ? '' : '<div class="container">'; ?>
                <div id="portfolio_filter" class="portfolio_filter mb_50">
                    <?php if ( !empty($settings['all_label'] ) ) : ?>
                        <div data-filter="*" class="work_portfolio_item active">
                            <?php echo esc_html($settings['all_label']); ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    if ( is_array($portfolio_cats) ) {
                        foreach ( $portfolio_cats as $portfolio_cat ) {
                            $is_show_count = $settings['is_show_count'] == 'yes' ? "<span>{$portfolio_cat->count}</span>" : '';
                            ?>
                            <div data-filter=".item_filter_id_<?php echo esc_attr( $portfolio_cat->term_id ) ?>" class="work_portfolio_item">
                                <?php echo $portfolio_cat->name.$is_show_count ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <?php echo ( $settings['is_full_width'] == 'yes' ) ? '<div class="container-fluid pl-0 pr-0">' : ''; ?>

                <?php
                if ( $settings['style'] == 'hover' ) {
                    include ( 'portfolio/portfolio-hover.php' );
                }
                elseif ( $settings['style'] == 'normal' ) {
                    include ( 'portfolio/portfolio-normal.php' );
                }

                echo ($settings['is_full_width'] == 'yes' ) ? '</div>' : '';
                ?>
            </section>
            <?php
        }
    }

}