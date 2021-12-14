<?php
get_header();
$opt = get_option( 'saasland_opt' );
$portfolio_layout = !empty($opt['portfolio_layout']) ? $opt['portfolio_layout'] : 'leftc_righti';
$layout = (get_field( 'layout' ) != 'default' || get_field( 'layout' ) == '') ? get_field( 'layout' ) : $portfolio_layout;
?>
    <section class="portfolio_details_area sec_pad">
    <div class="container">
        <?php
        if ($layout == 'leftc_righti' ) {
            get_template_part( 'template-parts/portfolio/leftc', 'righti' );
        }

        elseif ($layout == 'lefti_rightc' ) {
            get_template_part( 'template-parts/portfolio/lefti', 'rightc' );
        }

        elseif ($layout == 'topi_bottomc' ) {
            get_template_part( 'template-parts/portfolio/topi', 'bottomc' );
        }

        else {
            get_template_part( 'template-parts/portfolio/leftc', 'righti' );
        }
        ?>
    </div>
    </section>
<?php
get_footer();