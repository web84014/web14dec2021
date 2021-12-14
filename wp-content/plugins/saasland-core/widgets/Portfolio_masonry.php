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
 * Masonry Portfolio
 */
class Portfolio_masonry extends Widget_Base {
    public function get_name() {
        return 'saasland_portfolio_masonry';
    }

    public function get_title() {
        return __( 'Masonry Portfolio', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-gallery-masonry';
    }

    public function get_script_depends() {
        return ['imagesloaded', 'isotope'];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'select_style', [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover'     => esc_html__( 'Hover Contents', 'saasland-core' ),
                    'normal'    => esc_html__( 'Normal Contents', 'saasland-core' ),
                    'style_3'   => esc_html__( 'Masonry Contents', 'saasland-core' ),
                    'style_4'   => esc_html__( 'Fullwidth Masonry', 'saasland-core' ),
                ],
                'label_block' => true,
                'default' => 'hover'
            ]
        );
        $this->end_controls_section();


        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_filter', [
                'label' => __( 'Filter', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'normal', 'hover', 'style_3' ]
                ]
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All',
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
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


        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_layout', [
                'label' => __( 'Layout', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'normal', 'hover' ]
                ]
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->end_controls_section();

        /*----------------------------- Portfolio Style ------------------------------------*/
        $this->start_controls_section(
            'portfolio_style', [
                'label' => __( 'Portfolio Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_3'
                ]
            ]
        );
        $this->add_control(
            'title_color', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_grid .item_title > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color', [
                'label' => __( 'Title Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_grid .item_title > a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_title_typo',
                'selector' => '{{WRAPPER}} .portfolio_grid .item_title > a',
            ]
        );

        $this->add_control(
            'category_color', [
                'label' => __( 'Category Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_grid .category_list > li > a' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'cat_hover_color', [
                'label' => __( 'Category Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_grid .category_list > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio_grid .category_list > li > a:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_title_typo',
                'selector' => '{{WRAPPER}} .portfolio_grid .category_list > li > a',
            ]
        );
        $this->add_control(
            'image_hover_color', [
                'label' => __( 'Image Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_grid .item_image:before' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before'
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
                'condition' => [
                    'style' => [ 'hover', 'normal' ],
                    'style!' => 'style_3',
                ]
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

        $item_columns = new \Elementor\Repeater();
        $this->start_controls_section(
            'portfolio_column', [
                'label' => __( 'Column', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_4'
                ]
            ]
        );

        $item_columns->add_control(
            'portfolio_post', [
                'label' => __( 'Select Post', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => saasland_get_post_title('portfolio'),
            ]
        );
        $item_columns->add_control(
            'item_column', [
                'label' => __( 'Grid column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                    '2' => __( 'Six column', 'saasland-core' ),
                ],
                'default' => '4'
            ]
        );

        $this->add_control(
            'item_columns',
            [
                'label' => __( 'Item Columns', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $item_columns->get_controls(),
                'title_field' => '{{{ portfolio_post }}}',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $portfolios = new WP_Query(array(
            'post_type'     => 'portfolio',
            'posts_per_page'=> $settings['show_count'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'post__not_in' => !empty($settings['exclude']) ? explode( ',', $settings['exclude']) : '',
        ));
        $portfolio_cats = get_terms(array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => true
        ));

        if( $settings['style'] == 'style_4' ){
            wp_enqueue_style( 'saasland-digital-agency' );
            $saasland_posts = array(
                'post_type' => 'portfolio',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'fields' => 'ids',
                'post__not_in' => !empty($settings['exclude']) ? explode( ',', $settings['exclude']) : ''
            );
            $portfolio_posts = get_posts( $saasland_posts );
            ?>
            <section class="home_portfolio_fullwidth_area">
                <div class="container-fluid pl-0 pr-0">
                    <div class="row portfolio_gallery ml-0 mr-0" id="home_pr_masonry">
                        <div class="col-lg-3 col-sm-6 grid-sizer"></div>
                        <?php
                        if( is_array( $settings['item_columns'] ) ){
                            foreach ( $settings['item_columns'] as $portfolio ) {
                                $column = !empty( $portfolio['item_column'] ) ? $portfolio['item_column'] : '4';
                                $portfolio_item = get_post( $portfolio['portfolio_post'] );

                                switch ( $column ) {
                                    case 2:
                                        $image_size = 'saasland_370x480';
                                        break;
                                    case 3:
                                        $image_size = 'saasland_480x480';
                                        break;
                                    case 4:
                                        $image_size = 'saasland_634x480';
                                        break;
                                    case 6:
                                        $image_size = 'saasland_960x670';
                                        break;
                                }

                                ?>
                                <div class="col-lg-<?php echo esc_attr($column) ?> col-sm-6 portfolio_item p0">
                                    <div class="portfolio_img">
                                        <?php echo get_the_post_thumbnail( $portfolio_item->ID, $image_size ); ?>
                                        <div class="hover_content">
                                            <a href="<?php echo get_the_post_thumbnail_url( $portfolio_item->ID ) ?>" class="img_popup leaf"><i class="ti-plus"></i></a>
                                            <div class="portfolio-description leaf">
                                                <a href="<?php echo get_the_permalink( $portfolio_item->ID ); ?>" class="portfolio-title">
                                                    <h3 class="f_500 f_size_20 f_p"><?php echo $portfolio_item->post_title; ?></h3>
                                                </a>
                                                <div class="links">
                                                    <?php
                                                    $categories = get_the_terms( $portfolio_item->ID, 'portfolio_cat' );
                                                    foreach( $categories as $category ) {
                                                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="'. esc_attr( $category->name ) .'">' . esc_html( $category->name ) . '</a>';
                                                    }
                                                   ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                        }
                        ?>
                    </div>
                </div>
            </section>
            <div class="height-emulator"></div>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {

                        function homeMasonry() {
                            var gallery = $("#home_pr_masonry");
                            if (gallery.length) {
                                gallery.imagesLoaded(function () {
                                    gallery.isotope({
                                        layoutMode: "masonry",
                                        originLeft: false,
                                        masonry: {
                                            columnWidth: '.grid-sizer'
                                        },
                                        percentPosition: true,
                                    });
                                });
                            }
                        }
                        homeMasonry();

                    })
                })(jQuery)
            </script>
            <?php
        }
        elseif( $settings['style'] == 'style_3' ){
            wp_enqueue_style('saasland-digital-agency'); ?>
            <section class="portfolio_section">
                <div class="container">
                    <div class="portfolio_masonry_grid grid">
                        <div class="grid-sizer"></div>
                        <?php
                        if( $portfolios->have_posts() ){
                            $increment = 0;
                            while ( $portfolios->have_posts() ){
                                $portfolios->the_post();

                                switch ( $increment ) {
                                    case 0:
                                        $grid_class = "w_66";
                                        $image_size = 'saasland_700x480';
                                        break;
                                    case 1:
                                        $grid_class = "";
                                        $image_size = 'saasland_370x480';
                                        break;
                                    case 2:
                                        $grid_class = "";
                                        $image_size = 'saasland_370x480';
                                        break;
                                    case 3:
                                        $grid_class = "w_66";
                                        $image_size = 'saasland_700x480';
                                        break;
                                    case 4:
                                        $grid_class = "w_66";
                                        $image_size = 'saasland_700x480';
                                        break;
                                    case 5:
                                        $grid_class = "";
                                        $image_size = 'saasland_370x480';
                                        break;
                                    case 6:
                                        $grid_class = "";
                                        $image_size = 'saasland_370x480';
                                        break;
                                    case 7:
                                        $grid_class = "w_66";
                                        $image_size = 'saasland_700x480';
                                        break;
                                } ?>
                                <div class="grid-item <?php echo esc_attr( $grid_class ) ?>">
                                    <div class="portfolio_grid wow fadeInDown" data-wow-delay="0.2s">
                                        <a class="item_image" target="_blank" href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( $image_size ); ?>
                                        </a>
                                        <div class="item_content">
                                            <h3 class="item_title"><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <ul class="category_list clearfix">
                                                <?php
                                                $portfolio_cats = get_the_terms(get_the_ID(), 'portfolio_cat' );
                                                if( is_array( $portfolio_cats ) ){
                                                    foreach ( $portfolio_cats as $cat ){
                                                        echo '<li><a href="'. esc_url( get_term_link( $cat->slug, 'portfolio_cat' ) ) .'">'. esc_html( $cat->name ) .'</a></li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $increment++;
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>

                </div>
            </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        /*---------  grid -----------*/
                        var $grid = $('.grid').imagesLoaded( function() {
                            $grid.masonry({
                                itemSelector: '.grid-item',
                                percentPosition: true,
                                columnWidth: '.grid-sizer'
                            });
                        });
                    })
                })(jQuery)
            </script>
            <?php
        }
        else { ?>
            <section class="portfolio_area">
            <div class="container">
                <div id="portfolio_filter" class="portfolio_filter mb_50">
                    <?php if (!empty($settings['all_label'])) : ?>
                        <div data-filter="*" class="work_portfolio_item active">
                            <?php echo esc_html($settings['all_label']); ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    if (is_array($portfolio_cats)) {
                        foreach ($portfolio_cats as $portfolio_cat) { ?>
                            <div data-filter=".portfolio_filter_id_<?php echo esc_attr( $portfolio_cat->term_id ) ?>" class="work_portfolio_item">
                                <?php echo $portfolio_cat->name ?>
                            </div>
                            <?php
                            
                        }
                    }
                    ?>
                </div>
                <div class="row portfolio_gallery mb_30" id="work-portfolio">
                    <?php
                    while ($portfolios->have_posts()) : $portfolios->the_post();
                        $cats = get_the_terms(get_the_ID(), 'portfolio_cat' );
                        $cat_slug = '';
                        if (is_array($cats)) {
                            foreach ($cats as $cat) {
                                $cat_slug .= ' portfolio_filter_id_'.$cat->term_id.' ';
                            }
                        }
                        $column = !empty($settings['column']) ? $settings['column'] : '6';

                        if (has_post_thumbnail()) {
                            if ($settings['style'] == 'hover' ) { ?>
                                <div class="col-lg-<?php echo esc_attr($column);
                                echo esc_attr( $cat_slug ); ?> col-sm-6 portfolio_item mb-30">
                                    <div class="portfolio_img" onclick="window.location='<?php the_permalink() ?>';">
                                        <?php the_post_thumbnail( 'full' ) ?>
                                        <div class="hover_content <?php echo ($column == '3' || $column == '4' ) ? 'h_content_two' : ''; ?>">

                                            <div class="portfolio-description leaf">
                                                <a href="<?php the_permalink() ?>" class="portfolio-title">
                                                    <h3 class="f_500 f_size_20 f_p"> <?php the_title() ?> </h3>
                                                </a>
                                                <div class="links">
                                                    <?php
                                                    if ($cats) {
                                                        $cat_i = 0;
                                                        $cat_count = count($cats);
                                                        foreach ($cats as $cat) {
                                                            $separator = '';
                                                            if (++$cat_i != $cat_count) {
                                                                $separator .= ', ';
                                                            }
                                                            echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php the_post_thumbnail_url() ?>" class="img_popup leaf">
                                        <i class="ti-plus"></i>
                                    </a>
                                </div>
                                <?php
                            } elseif ($settings['style'] == 'normal' ) {
                                ?>
                                <div class="col-lg-<?php echo esc_attr($column);
                                echo esc_attr( ' ' . $cat_slug); ?> col-sm-6 portfolio_item br ux mb_50">
                                    <div class="portfolio_img">
                                        <a href="<?php the_post_thumbnail_url() ?>" class="img_popup">
                                            <img class="img_rounded" src="<?php the_post_thumbnail_url() ?>"
                                                 alt="<?php the_title_attribute() ?>">
                                        </a>
                                        <div class="portfolio-description">
                                            <a href="<?php the_permalink() ?>" class="portfolio-title">
                                                <h3 class="f_500 f_size_20 f_p mt_30"> <?php the_title(); ?> </h3>
                                            </a>
                                            <div class="links">
                                                <?php
                                                if ($cats) {
                                                    $cat_i = 0;
                                                    $cat_count = count($cats);
                                                    foreach ($cats as $cat) {
                                                        $separator = '';
                                                        if (++$cat_i != $cat_count) {
                                                            $separator .= ', ';
                                                        }
                                                        echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <?php
        }
    }

}