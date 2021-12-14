<?php
get_header();
$details_column = have_rows('service_attributes') ? '7' : '12';
?>

<section class="service_details_area sec_pad">
    <div class="container">
        <div class="row">
            <?php if ( have_rows('service_attributes') ) : ?>
                <div class="col-lg-4 pl_70">
                    <div class="job_info">
                        <?php if ( get_field('attribute_section_title') ) : ?>
                            <div class="info_head">
                                <?php if (get_field('attribute_section_icon')) : ?>
                                    <i class="<?php echo esc_attr(get_field('attribute_section_icon')) ?>"></i>
                                <?php endif; ?>
                                <h6 class="f_p f_600 f_size_18 t_color3"> <?php echo wp_kses_post(get_field('attribute_section_title')) ?> </h6>
                            </div>
                        <?php endif; ?>
                        <?php
                        while ( have_rows('service_attributes') ) : the_row();
                            ?>
                            <div class="info_item">
                                <?php if (get_sub_field( 'attribute_icon')) : ?>
                                    <i class="<?php echo esc_attr(get_sub_field( 'attribute_icon')) ?>"></i>
                                <?php endif; ?>
                                <h6> <?php echo esc_html(get_sub_field('attribute_title')) ?> </h6>
                                <p> <?php echo esc_html(get_sub_field('attribute_value')); ?> </p>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-<?php echo esc_attr($details_column) ?>">
                <div class="details_content">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
