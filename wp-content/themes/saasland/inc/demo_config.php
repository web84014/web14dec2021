<?php
$purchase_code_status = trim( get_option( 'saasland_purchase_code_status' ) );
if ( $purchase_code_status == 'valid' ) :
// Disable regenerating images while importing media
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Change some options for the jQuery modal window
function saasland_ocdi_confirmation_dialog_options ( $options ) {
    return array_merge( $options, array(
        'width'       => 400,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ) );
}
add_filter( 'pt-ocdi/confirmation_dialog_options', 'saasland_ocdi_confirmation_dialog_options', 10, 1 );

function saasland_ocdi_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi_custom-intro-text notice notice-info inline">';
    $default_text .= sprintf (
        '%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
        esc_html__( 'Install and activate all ', 'saasland' ),
        get_admin_url(null, 'themes.php?page=tgmpa-install-plugins' ),
        esc_html__( 'required plugins', 'saasland' ),
        esc_html__( 'before you click on the "Import" button.', 'saasland' )
    );
    $default_text .= sprintf (
        ' %1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
        esc_html__( 'You will find all the pages in ', 'saasland' ),
        get_admin_url(null, 'edit.php?post_type=page' ),
        esc_html__( 'Pages.', 'saasland' ),
        esc_html__( 'Other pages will be imported along with the main Homepage.', 'saasland' )
    );
    $default_text .= '<br>';
    $default_text .= sprintf (
        '%1$s <a href="%2$s" target="_blank">%3$s</a>',
        esc_html__( 'If you fail to import the demo data, follow the alternative way', 'saasland' ),
        'https://goo.gl/mMLj3B',
        esc_html__( 'here.', 'saasland' )
    );
    $default_text .= '</div>';

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'saasland_ocdi_intro_text' );

// OneClick Demo Importer
add_filter( 'pt-ocdi/import_files', 'saasland_import_files' );
function saasland_import_files() {
    return array (

        array(
            'import_file_name'             => esc_html__( 'Digital Agency 2', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/digital-agency.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/digital-agency.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will not imported with this Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/digital-agency/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Fashion', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/fashion.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/fashion.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will not imported with this Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-fashion/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'WooCommerce', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Product Dark', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/Product-Dark.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/product-dark.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/product-dark/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Gadget', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/Home-Gadget.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/home-gadget.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-gadget/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),
        array(
            'import_file_name'             => esc_html__( 'Personal Portfolio', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/home-personal-portfolio.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/personal-portfolio.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/personal-portfolio/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Portfolio', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),
        array(
            'import_file_name'             => esc_html__( 'Home Portfolio', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/home-portfolio.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/home-portfolio.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/personal-portfolio/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Portfolio', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),
        array(
            'import_file_name'             => esc_html__( 'Home Creative', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/home-creative.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/home-creative.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/personal-portfolio/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Portfolio', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Event & Conference', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/event.png',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-event/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), 'Marketing' ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Saasland Demo Landing', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/demo-landing.jpg',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-demo-landing/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Support Chat Platform', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/chat.png',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-chat/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Design Studio', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/desing-studio.png',
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/',
            'categories'                   => array ( esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Security Software', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/security_software.jpg',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-security/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Tracking Software', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/time_tracking_software.jpg',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-security/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Email Client', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/email-client.png',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-mail/',
            'categories'                   => array ( esc_html__( 'Marketing', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Cloud Based Saas', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/cloud-based-saas.jpg',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-cloud/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Prototype & Wireframing', 'saasland' ),
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/prototype-wireframing.jpg',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-prototyping/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Digital Marketing', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/digital-marketing.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-marketing/',
            'categories'                   => array ( esc_html__( 'Marketing', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Software (Dark)', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/software-(dark).jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-software-dark/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'App Showcase', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/app-showcase.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-app-showcase/',
            'categories'                   => array ( esc_html__( 'Mobile App', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Startup', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/startup.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-startup/',
            'categories'                   => array ( esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Payment Processing', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/payment-processing.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-payment-processing/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Classic Saas', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/classic-saas.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-saas/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Accounts & Billing', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/accounts-billing.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/accounts-billing/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Company', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/home-company.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-company/',
            'categories'                   => array ( esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'CRM Software', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/CRM-software.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-crm-software/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'HR Management', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/hr-management.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-hr-management/',
            'categories'                   => array ( esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Digital Agency', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/digital-agency.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-digital-agency/',
            'categories'                     => array( esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Saas 2 (Slider)', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/saas-2-slider.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-saas-2-slider/',
            'categories'                     => array( esc_html__( 'Slider', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Digital Shop', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/all/digital-shop.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/main.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/all/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://droitthemes.com/wp/saasland-theme/home-shop/',
            'categories'                     => array( esc_html__( 'eCommerce', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/all/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Agency Colorful', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/agency-colorful.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-agency-colorful/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ), esc_html__( 'Slider', 'saasland' ), esc_html__( 'Full-Screen', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Web Hosting', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/home-hosting.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-hosting/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Slider', 'saasland' ), esc_html__( 'Hosting', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'ERP Solution', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/erp.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-erp/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Point Of Sale (POS)', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/pos.png',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-pos/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Split Screen Slider', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/split.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-split/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Slider', 'saasland' ), esc_html__( 'Full-Screen', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Analytics Software', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/analytics-software.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-analytics-software/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Saas', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'Support Desk', 'saasland' ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/new/support-desk.jpg',
            'import_file_url'              => 'https://droitthemes.com/wpplugin/demo/saasland/saasland2.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/new/widgets.wie',
            'import_notice'                => __( 'All other pages will be imported along with the main Homepage.', 'saasland' ),
            'preview_url'                  => 'https://saasland2.droitthemes.com/home-support/',
            'categories'                   => array ( esc_html__( 'New', 'saasland' ), esc_html__( 'Agency', 'saasland' ) ),
            'local_import_redux'           => array (
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/new/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),

        array(
            'import_file_name'             => esc_html__( 'OnePage', 'saasland' ),
            'import_file_url'            => 'https://droitthemes.com/wpplugin/demo/saasland/onepage.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demos/onepage/widgets.wie',
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ).'inc/demos/onepage/screenshot.jpg',
            'import_notice'                => esc_html__( 'WooCommerce and WooCommerce Wishlist plugins are not required for this demo.', 'saasland' ),
            'preview_url'                  => '//saasland.droitthemes.com/onepage',
            'categories'                   => array ( esc_html__( 'OnePage', 'saasland' ), esc_html__( 'Mobile App', 'saasland' ) ),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/onepage/settings.json',
                    'option_name' => 'saasland_opt',
                ),
            ),
        ),


    );
}


function saasland_after_import_setup($selected_import) {
    /**
     * Import The Sliders
     */
    if ( class_exists( 'RevSlider' ) ) {
        $slider = new RevSlider();
        if ( 'Web Hosting' == $selected_import['import_file_name'] ) {
            $hosting_slider = 'https://droitthemes.com/wpplugin/demo/saasland/hosting_slider.zip';
            $slider->importSliderFromPost( true, true, $hosting_slider );
        }
    }

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $olay_menu = get_term_by( 'name', 'Overlay Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array (
            'main_menu' => $main_menu->term_id,
            'overlay_menu' => $olay_menu->term_id
        )
    );

    // Disable Elementor's Default Colors and Default Fonts
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_global_image_lightbox', '' );

    // Assign front page and posts page (blog page).
    if ( 'Saasland Demo Landing' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Demo Landing' );
    }
    if ( 'Design Studio' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home' );
    }
    if ( 'Event & Conference' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Event' );
    }
    if ( 'Support Chat Platform' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Chat' );
    }
    if ( 'Security Software' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home-Security' );
    }
    if ( 'Tracking Software' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Tracking' );
    }
    if ( 'Email Client' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Mail' );
    }
    if ( 'Cloud Based Saas' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Cloud' );
    }
    if ( 'Prototype & Wireframing' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Prototyping' );
    }
    if ( 'Digital Marketing' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Marketing' );
    }
    if ( 'Software (Dark)' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Software Dark' );
    }
    if ( 'App Showcase' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - App Showcase' );
    }
    if ( 'Startup' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Startup' );
    }
    if ( 'Payment Processing' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Payment Processing' );
    }
    if ( 'Classic Saas' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Saas' );
    }
    if ( 'Accounts & Billing' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Accounts & Billing' );
    }
    if ( 'Company' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Company' );
    }
    if ( 'CRM Software' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - CRM Software' );
    }
    if ( 'HR Management' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - HR Management' );
    }
    if ( 'Digital Agency' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Digital Agency' );
    }
    if ( 'Saas 2 (Slider)' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Saas 2 (Slider)' );
    }
    if ( 'Digital Shop' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Shop' );
    }
    if ( 'Agency Colorful' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Agency Colorful' );
    }
    if ( 'Web Hosting' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Hosting' );
    }
    if ( 'ERP Solution' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - ERP' );
    }
    if ( 'Point Of Sale (POS)' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - POS' );
    }
    if ( 'Split Screen Slider' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Split' );
    }
    if ( 'Support Desk' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Support' );
    }
    if ( 'Analytics Software' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home - Analytics Software' );
    }
    if ( 'OnePage' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home' );
    }
    if ( 'Gadget' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Gadget' );
    }
    if ( 'Product Dark' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Product Dark' );
    }
    if ( 'Fashion' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Fashion' );
    }
    if ( 'Digital Agency 2' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Digital Agency' );
    }
    if ( 'Personal Portfolio' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Personal Portfolio' );
    }
    if ( 'Home Portfolio' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Portfolio' );
    }
    if ( 'Home Creative' == $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( 'Home Creative' );
    }

    $blog_page_id  = get_page_by_title( 'Blog' );
    // Set the home page and blog page
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'saasland_after_import_setup' );

endif;