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
 * Jobs
 */
class Jobs extends Widget_Base {
    public function get_name() {
        return 'saasland_jobs';
    }

    public function get_title() {
        return __( 'Jobs', 'saasland-core' );
    }

    public function get_icon() {
        return 'dashicons dashicons-clipboard';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Open Job Positions'
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .job_listing h3',
            ]
        );

        $this->end_controls_section(); // End title section



        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All Filter Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All'
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
            'is_pagination', [
                'label' => esc_html__( 'Pagination', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'ppp', [
                'label' => esc_html__( 'Posts Per Page', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'condition' => [
                    'is_pagination' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        // ---------------------------------- Apply ------------------------
        $this->start_controls_section(
            'apply', [
                'label' => __( 'Apply', 'saasland-core' ),
            ]
        );

        /*$this->add_control(
            'is_apply_external', [
                'label' => esc_html__( 'Apply Internal / External', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Internal', 'saasland-core' ),
                'label_off' => __( 'External', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );*/

        $this->add_control(
            'temp_slug', [
                'label' => esc_html__( 'Job Application Form Page Slug', 'saasland-core' ),
                'description' => esc_html__( 'Enter here the Job Application Form page template slug', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'apply_label', [
                'label' => esc_html__( 'Apply Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /*-------------------------- Style Job Content --------------------------*/
        $this->start_controls_section(
            'style_job_content', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tab_label_color', [
                'label' => __( 'Tab Label Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .job_list_tab .list_item_tab' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'tab_label_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .job_listing .job_list_tab .list_item_tab',
            ]
        );
        $this->add_control(
            'tab_label_underline', [
                'label' => __( 'Tab Label Underline Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .job_list_tab .list_item_tab:before' => 'background: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'job_title_color', [
                'label' => __( 'Title Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'job_title_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text h4 a',
            ]
        );
        $this->add_control(
            'job_title_hover_color', [
                'label' => __( 'Title Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text h4 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_meta_color', [
                'label' => __( 'Meta Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text ul li' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'job_meta_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text ul li',
            ]
        );


        $this->start_controls_tabs(
            'job_apply_btn_tab'
        );
        $this->start_controls_tab(
            'apply_btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'apply_btn_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'apply_btn_background', [
                'label' => __( 'Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'apply_btn_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'apply_btn_typo',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'apply_btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );
        $this->add_control(
            'apply_btn_hover_color', [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'apply_btn_hover_background', [
                'label' => __( 'Background', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'apply_btn_hover_border',
                'label' => __( 'Border', 'saasland-core' ),
                'selector' => '{{WRAPPER}} .job_listing .listing_tab .list_item .joblisting_text .jobsearch-job-userlist .apply_btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();



        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        if ( $settings['is_pagination'] == 'yes' ) {
            global $wp_query;
            global $paged;
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query();
            $ppp = !empty($settings['ppp']) ? $settings['ppp'] : 6;
            $wp_query->query( 'showposts='.$ppp.'&post_type=job'.'&paged='.$paged);
        } else {
            $wp_query = new WP_Query( array (
                'post_type' => 'job',
                'posts_per_page' => -1,
                'order' => $settings['order'],
            ));
        }

        $all = !empty($settings['all_label']) ? $settings['all_label'] : esc_html__( 'All', 'saaslandc-ore' );
        ?>

        <div class="job_listing">
            <?php if (!empty($settings['title'])) : ?>
                <h3 class="f_p f_size_24 l_height28 f_500 t_color3 mb-30"> <?php echo wp_kses_post($settings['title']); ?> </h3>
            <?php endif; ?>
            <div id="job_filter" class="job_list_tab">
                <div data-filter="*" class="list_item_tab active"> <?php echo esc_html($all) ?> </div>
                <?php
                $locations = get_terms( array ( 'taxonomy' => 'job_location', 'hide_empty' => true ) );
                if ($locations) {
                    foreach ($locations as $i => $location) {
                        ?>
                        <div data-filter=".<?php echo esc_attr($location->slug) ?>" class="list_item_tab"> <?php echo esc_html($location->name) ?> </div>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="listing_tab" id="tab_filter">
                <?php
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    $job_type_terms = get_the_terms(get_the_ID(), 'job_location' );
                    $job_type_slug = '';
                    if (is_array($job_type_terms)) {
                        foreach ($job_type_terms as $job_type) {
                            $job_type_slug .= $job_type->slug.' ';
                        }
                    }
                    $apply = !empty($settings['apply_label']) ? $settings['apply_label'] : esc_html__( 'Apply Now', 'saasland-core' );
                    $temp_slug = $settings['temp_slug'] ? $settings['temp_slug'] : 'job-apply-form';
                    $apply_url = '';
                    if ( function_exists( 'saasland_get_page_template_id' ) ) {
                        $apply_url = get_permalink(saasland_get_page_template_id()) . "?id=" . get_the_ID();
                    }
                    ?>
                    <div class="item <?php echo esc_attr($job_type_slug); ?>">
                        <div class="list_item">
                            <figure>
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail( 'full' ) ?>
                                </a>
                            </figure>
                            <div class="joblisting_text">
                                <div class="job_list_table">
                                    <div class="jobsearch-table-cell">
                                        <h4><a href="<?php the_permalink() ?>" class="f_500 t_color3"> <?php the_title() ?> </a></h4>
                                        <ul class="list-unstyled">
                                            <?php
                                            $job_type_term = get_field( 'job_type' );
                                            $job_location_term = get_field( 'job_location' );

                                            if ($job_type_term) : ?>
                                                <li class="p_color"> <?php echo $job_type_term->name; ?> </li>
                                            <?php endif; ?>
                                            <?php if ($job_location_term) : ?>
                                                <li> <?php echo $job_location_term->name ?> </li>
                                            <?php endif; ?>
                                            <li> <?php the_time(get_option( 'date_format')) ?> </li>
                                        </ul>
                                    </div>
                                    <div class="jobsearch-table-cell">
                                        <div class="jobsearch-job-userlist">
                                            <a href="<?php echo esc_url($apply_url) ?>" class="apply_btn"> <?php echo esc_html($apply) ?> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <?php saasland_pagination(); wp_reset_query();  ?>

        </div>
        <?php
    }
}