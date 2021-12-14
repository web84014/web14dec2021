
    <div class="container">
        <div class="row align-items-center">

            <?php
            if ( !empty( $table3 ) ) {
                foreach ($table3 as $table) {
                    $is_active = !empty( $table['is_active'] == 'yes' ) ? 'active' : '';
                    ?>
                    <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-md-6">
                        <div class="analytices_price_item <?php echo esc_attr( $is_active ) ?> elementor-repeater-item-<?php echo $table['_id']; ?>">
                            <div class="p_head">
                                <?php echo !empty($table['title']) ? '<h5>' . $table['title'] . '</h5>' : ''; ?>

                                <?php if ( !empty( $table['ribbon'] ) ) : ?>
                                    <h6 class="tag">
                                        <i class="<?php echo esc_attr( $table['ribbon_icon'] ) ?>"></i>
                                        <?php echo esc_html( $table['ribbon'] )  ?>
                                    </h6>
                                <?php endif; ?>
                                <?php echo !empty($table['price']) ? '<div class="rate">' . $table['price'] . '</div>' : ''; ?>
                                <?php echo !empty($table['duration']) ? '<h6>' . $table['duration'] . '</h6>' : '';
                                ?>
                            </div>
                            <ul class="list-unstyled p_body">
                                <?php echo !empty($table['content_list']) ?  $table['content_list'] : ''; ?>
                            </ul>
                            <?php echo !empty($table['btn_label']) ? '<a '.saasland_el_btn($table['btn_url'], false).' class="er_btn er_btn_two elementor-repeater-item-' . $table['_id'] .'">' . $table['btn_label'] . '</a>' : ''; ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>