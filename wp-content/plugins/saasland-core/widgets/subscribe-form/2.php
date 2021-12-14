<?php if ( !empty($settings['sec_bg_image']['url']) ) : ?>
    <style>
        .s_subscribe_area:before {
            background: url("<?php echo esc_url($settings['sec_bg_image']['url']) ?>") no-repeat scroll center 0;
        }
    </style>
<?php endif; ?>

<section class="s_subscribe_area">
    <div class="s_shap">
        <svg class="right_shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <linearGradient id="PSgrad_5">
                    <stop offset="0%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="rgb(25,204,230)" stop-opacity="0.95" />
                </linearGradient>
            </defs>
            <path fill="url(#PSgrad_5)"
                  d="M543.941,156.289 L227.889,41.364 C184.251,25.497 136.000,47.975 120.118,91.571 L5.084,407.325 C-10.799,450.921 11.701,499.127 55.339,514.995 L371.391,629.920 C415.029,645.788 463.280,623.309 479.162,579.713 L594.196,263.959 C610.079,220.362 587.579,172.157 543.941,156.289 Z"/>
            <path fill="url(#PSgrad_5)"
                  d="M625.661,120.004 L309.609,5.079 C265.971,-10.790 217.720,11.689 201.838,55.286 L86.804,371.039 C70.921,414.636 93.421,462.842 137.059,478.709 L453.111,593.634 C496.749,609.502 545.000,587.024 560.882,543.427 L675.916,227.673 C691.799,184.077 669.299,135.872 625.661,120.004 Z"/>
        </svg>
        <svg class="bottom_shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <linearGradient id="PSgrad_6" x1="76.604%" x2="0%" y1="0%" y2="64.279%">
                    <stop offset="0%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="rgb(25,204,230)" stop-opacity="0.95" />
                </linearGradient>
            </defs>
            <path fill="url(#PSgrad_6)"
                  d="M543.941,156.289 L227.889,41.365 C184.251,25.496 136.000,47.975 120.118,91.572 L5.084,407.325 C-10.799,450.922 11.701,499.127 55.339,514.995 L371.391,629.920 C415.029,645.788 463.280,623.310 479.162,579.713 L594.196,263.959 C610.079,220.362 587.579,172.157 543.941,156.289 Z"/>
            <path fill="url(#PSgrad_6)"
                  d="M625.661,120.004 L309.609,5.078 C265.971,-10.789 217.720,11.689 201.838,55.286 L86.804,371.040 C70.921,414.636 93.421,462.842 137.059,478.709 L453.111,593.634 C496.749,609.502 545.000,587.023 560.882,543.427 L675.916,227.673 C691.799,184.077 669.299,135.871 625.661,120.004 Z"/>
        </svg>
    </div>
    <div class="container">
        <div class="sec_title text-center mb_50 wow fadeInUp" data-wow-delay="0.4s">
            <?php if (!empty($settings['title'])) : ?>
            <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 t_color saas_subscribe_color">
            <?php echo wp_kses_post($settings['title']); ?>
        </<?php echo $title_tag; ?>>
        <?php endif; ?>
        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="f_300 f_size_18 l_height34 subtitle_color"><?php echo nl2br($settings['subtitle']); ?></p>
        <?php endif; ?>
    </div>
    <form class="mailchimp wow fadeInUp" data-wow-delay="0.6s" method="post"  id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
        <div class="input-group s_subcribes">
            <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
            <button class="btn btn-submit" type="submit"><i class="ti-arrow-right"></i></button>
        </div>
        <p class="mchimp-errmessage" style="display: none;"></p>
        <p class="mchimp-sucmessage" style="display: none;"></p>
    </form>
    </div>
</section>