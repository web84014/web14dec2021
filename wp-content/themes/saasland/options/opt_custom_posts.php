<?php
/**
 * Custom Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Custom Post Types', 'saasland' ),
    'id'        => 'cpt_opt',
    'icon'      => 'dashicons dashicons-admin-post',
));

/**
 * Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Types', 'saasland' ),
    'id'        => 'cpt',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cpt_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Enable Disable Custom Post Types', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => esc_html__( 'If you want, you can disable any custom post type of Saasland from here.', 'saasland' )
        ),

        array(
            'id'       => 'is_service_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Services', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_team_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Team', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_portfolio_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Portfolios', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_case_study_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Case Studies', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_faq_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('FAQs', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_job_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Jobs', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_mega_menu_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mega Menu', 'saasland' ),
            'subtitle' => esc_html__( 'If you want to use third party navigation menu (Eg, Elementor pro, Jet menu etc), you need to disable the Mega Menu feature from here.', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'        => 'note_headers_footers',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => sprintf(
                '%1$s <a href="%2$s"> %3$s </a> %4$s',
                esc_html__( 'If you are using Elementor Pro and not able to create Popup, disable the Header & Footer from here. We recommend you to create custom Header, Footer using Elementor pro. Learn more', 'saasland' ),
                'https://is.gd/XO9OzB',
                esc_html__( 'here', 'saasland' ),
                'https://is.gd/XO9OzB'
            ),
        ),

        array(
            'id'       => 'is_header_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Headers', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_footer_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Footers', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),
    )
));

/**
 * Slug Re-write
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Type Slugs', 'saasland' ),
    'id'        => 'saasland_cp_slugs',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cp_slug_note',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__( 'Slug Re-write:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => sprintf (
                '%1$s <a href="%2$s"> %3$s</a> %4$s',
                esc_html__( "These are the custom post's slugs offered by Saasland. You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don't forget to save the permalinks settings from", 'saasland' ),
                get_admin_url( null, 'options-permalink.php' ),
                esc_html__( 'Settings > Permalinks', 'saasland' ),
                esc_html__( 'after changing the slug value.', 'saasland' )
            )
        ),
        
        array(
            'title'     => esc_html__( 'Service Slug', 'saasland' ),
            'id'        => 'service_slug',
            'type'      => 'text',
            'required'  => array( 'is_service_cpt', '=', '1' ),
            'default'   => 'service'
        ),
        
        array(
            'title'     => esc_html__( 'Portfolio Slug', 'saasland' ),
            'id'        => 'portfolio_slug',
            'type'      => 'text',
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
            'default'   => 'portfolio'
        ),
        
        array(
            'title'     => esc_html__( 'Case Study Slug', 'saasland' ),
            'id'        => 'case_study_slug',
            'type'      => 'text',
            'required'  => array( 'is_case_study_cpt', '=', '1' ),
            'default'   => 'case_study'
        ),
        array(
            'title'     => esc_html__( 'Team Slug', 'saasland' ),
            'id'        => 'team_slug',
            'type'      => 'text',
            'required'  => array( 'is_team_cpt', '=', '1' ),
            'default'   => 'team'
        ),

        array(
            'title'     => esc_html__( 'Jobs Slug', 'saasland' ),
            'id'        => 'job_slug',
            'type'      => 'text',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'default'   => 'job'
        ),
    )
));

/**
 * Portfolio
 */
Redux::setSection( 'saasland_opt', array(
    'title'         => esc_html__( 'Portfolio', 'saasland' ),
    'id'            => 'portfolio_settings',
    'icon'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'portfolio_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_portfolio_cpt', '=', '' ),
            'desc'      => esc_html__( "Portfolio post type is disabled that's why the portfolio settings are gone from here. Enable the portfolio post type from 'Theme Settings > Custom Post Types > Post Types' To show the portfolio settings.", 'saasland' )
        ),

        //================================Portfolio Page Title Bar=================================
        array(
            'title'     => esc_html__( 'Page Title', 'saasland' ),
            'id'        => 'portfolio_pagetitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Portfolios', 'saasland' ),
        ),
        array(
            'id'       => 'portfolio_titlebar_bg',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('Title-bar Background Image', 'saasland'),
            'default'  => array(
                'url'  => ''
            ),
        ),
        array(
            'id'        => 'portfolio_bg_1',
            'type'      => 'color_rgba',
            'title'     => 'Background Color',
        ),
        array(
            'id'        => 'portfolio_bg_2',
            'type'      => 'color_rgba',
            'title'     => 'Gradient Background Color',
        ),
        array(
            'id'          => 'portfolio_titlebar_title_typo',
            'type'        => 'typography',
            'title'       => __('Page Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-portfolio .breadcrumb_content h1'),
            'units'       =>'px',

        ),
        array(
            'id'       => 'is_portfolio_page_subtitle',
            'type'     => 'switch',
            'title'    => __('Page Sub Title Show/Hide', 'saasland'),
            'default'  => true,
        ),
        array(
            'id'          => 'portfolio_titlebar_subtitle_typo',
            'type'        => 'typography',
            'title'       => __('Page Sub Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-portfolio .breadcrumb_content > p'),
            'units'       =>'px',
            'required'    => array( 'is_portfolio_page_subtitle', '=', '1' ),
        ),

        array(
            'title'     => esc_html__( 'Default Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the default portfolio layout for portfolio details page', 'saasland' ),
            'id'        => 'portfolio_layout',
            'type'      => 'select',
            'default'   => 'leftc_righti',
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
            'options'   => array(
                'leftc_righti' => esc_html__( 'Left Content Right Images', 'saasland' ),
                'lefti_rightc' => esc_html__( 'Left Images Right Content', 'saasland' ),
                'topi_bottomc' => esc_html__( 'Top Images Bottom Content', 'saasland' ),
            )
        ),

        // Portfolio Share Options
        array(
            'id'        => 'portfolio_share_start',
            'type'      => 'section',
            'title'     => __( 'Share Options', 'saasland' ),
            'subtitle'  => __( 'Enable/Disable social media share options as you want.', 'saasland' ),
            'indent'    => true,
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
        ),

        array(
            'id'        => 'share_options',
            'type'      => 'switch',
            'title'     => esc_html__( 'Share Options', 'saasland' ),
            'default'   => true,
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
        ),
        array(
            'id'       => 'share_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'saasland' ),
            'default'  => esc_html__( 'Share on', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
        ),
        array(
            'id'       => 'is_portfolio_fb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Facebook', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_twitter',
            'type'     => 'switch',
            'title'    => esc_html__( 'Twitter', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_googleplus',
            'type'     => 'switch',
            'title'    => esc_html__( 'Google Plus', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_linkedin',
            'type'     => 'switch',
            'title'    => esc_html__( 'Linkedin', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_pinterest',
            'type'     => 'switch',
            'title'    => esc_html__( 'Pinterest', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),

        array(
            'id'     => 'portfolio_share_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

/*=================== Service Page Title bar  =====================*/
Redux::setSection( 'saasland_opt', array(
    'title'         => esc_html__( 'Services', 'saasland' ),
    'id'            => '_cp_service_settings',
    'icon'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'service_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_service_cpt', '=', '' ),
            'desc'      => esc_html__( "Service post type is disabled that's why the service settings are gone from here. Enable the service post type from 'Theme Settings > Custom Post Types > Post Types' To show the service settings.", 'saasland' )
        ),

        //================================Service Page Title Bar=================================
        array(
            'title'     => esc_html__( 'Page Title', 'saasland' ),
            'id'        => 'service_pagetitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Services', 'saasland' ),
        ),
        array(
            'id'       => 'service_titlebar_bg',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('Title-bar Background Image', 'saasland'),
            'default'  => array(
                'url'  => ''
            ),
        ),
        array(
            'id'        => 'service_bg_1',
            'type'      => 'color_rgba',
            'title'     => 'Background Color',
        ),
        array(
            'id'        => 'service_bg_2',
            'type'      => 'color_rgba',
            'title'     => 'Gradient Background Color',
        ),
        array(
            'id'          => 'service_titlebar_title_typo',
            'type'        => 'typography',
            'title'       => __('Page Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-service .breadcrumb_content h1'),
            'units'       =>'px',

        ),
        array(
            'id'       => 'is_service_page_subtitle',
            'type'     => 'switch',
            'title'    => __('Page Sub Title Show/Hide', 'saasland'),
            'default'  => true,
        ),
        array(
            'id'          => 'service_titlebar_subtitle_typo',
            'type'        => 'typography',
            'title'       => __('Page Sub Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-service .breadcrumb_content > p'),
            'units'       =>'px',
            'required'    => array( 'is_service_page_subtitle', '=', '1' ),
        )

    )
));


/*=================== Case Study Page Title bar  =====================*/
Redux::setSection( 'saasland_opt', array(
    'title'         => esc_html__( 'Case Study', 'saasland' ),
    'id'            => '_cp_casestudy_settings',
    'icon'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'casestudy_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_case_study_cpt', '=', '' ),
            'desc'      => esc_html__( "Case Study post type is disabled that's why the case study settings are gone from here. Enable the case study post type from 'Theme Settings > Custom Post Types > Post Types' To show the case study settings.", 'saasland' )
        ),

        array(
            'title'     => esc_html__( 'Page Title', 'saasland' ),
            'id'        => 'casestudy_pagetitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Case Study', 'saasland' ),
        ),
        array(
            'id'       => 'casestudy_titlebar_bg',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('Title-bar Background Image', 'saasland'),
            'default'  => array(
                'url'  => ''
            ),
        ),
        array(
            'id'        => 'casestudy_bg_1',
            'type'      => 'color_rgba',
            'title'     => 'Background Color',
        ),
        array(
            'id'        => 'casestudy_bg_2',
            'type'      => 'color_rgba',
            'title'     => 'Gradient Background Color',
        ),
        array(
            'id'          => 'casestudy_titlebar_title_typo',
            'type'        => 'typography',
            'title'       => __('Page Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-case_study .breadcrumb_content h1'),
            'units'       =>'px',

        ),
        array(
            'id'       => 'is_casestudy_page_subtitle',
            'type'     => 'switch',
            'title'    => __('Page Sub Title Show/Hide', 'saasland'),
            'default'  => true,
        ),
        array(
            'id'          => 'casestudy_titlebar_subtitle_typo',
            'type'        => 'typography',
            'title'       => __('Page Sub Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-case_study .breadcrumb_content > p'),
            'units'       =>'px',
            'required'    => array( 'is_casestudy_page_subtitle', '=', '1' ),
        )

    )
));

/*=================== Team Page Title bar  =====================*/
Redux::setSection( 'saasland_opt', array(
    'title'         => esc_html__( 'Team', 'saasland' ),
    'id'            => '_cp_team_settings',
    'icon'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'team_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_team_cpt', '=', '' ),
            'desc'      => esc_html__( "Team post type is disabled that's why the team settings are gone from here. Enable the team post type from 'Theme Settings > Custom Post Types > Post Types' To show the team settings.", 'saasland' )
        ),

        array(
            'title'     => esc_html__( 'Page Title', 'saasland' ),
            'id'        => 'team_pagetitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Team', 'saasland' ),
        ),
        array(
            'title'     => esc_html__( 'Page Sub-title', 'saasland' ),
            'id'        => 'team_archive_subtitle',
            'type'      => 'text',
            'default'   => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s', 'saasland' ),
        ),
        array(
            'id'       => 'team_titlebar_bg',
            'type'     => 'media',
            'url'      => true,
            'title'    => __('Title-bar Background Image', 'saasland'),
            'default'  => array(
                'url'  => ''
            ),
        ),
        array(
            'id'        => 'team_bg_1',
            'type'      => 'color_rgba',
            'title'     => 'Background Color',
        ),
        array(
            'id'        => 'team_bg_2',
            'type'      => 'color_rgba',
            'title'     => 'Gradient Background Color',
        ),
        array(
            'id'          => 'team_titlebar_title_typo',
            'type'        => 'typography',
            'title'       => __('Page Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-case_study .breadcrumb_content h1'),
            'units'       =>'px',

        ),
        array(
            'id'       => 'is_team_page_subtitle',
            'type'     => 'switch',
            'title'    => __('Page Sub Title Show/Hide', 'saasland'),
            'default'  => true,
        ),
        array(
            'id'          => 'team_titlebar_subtitle_typo',
            'type'        => 'typography',
            'title'       => __('Page Sub Title Typography', 'saasland'),
            'google'      => true,
            'font-backup' => true,
            'output'      => array('.single-case_study .breadcrumb_content > p'),
            'units'       =>'px',
            'required'    => array( 'is_team_page_subtitle', '=', '1' ),
        )

    )
));

/**
 * Job
 */
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Job', 'saasland' ),
    'id'               => 'job_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'        => 'job_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_job_cpt', '=', '' ),
            'desc'      => esc_html__( "The Job post type is disabled that's why the job settings are gone from here. Enable the job post type from 'Theme Settings > Custom Post Types > Post Types' To show the Job settings.", 'saasland' )
        ),

        array(
            'title'     => esc_html__( 'Form Shortcode', 'saasland' ),
            'subtitle'  => __( 'Get the Job Apply form template from <a href="https://is.gd/N6sJVo" target="_blank">here.</a>', 'saasland' ),
            'id'        => 'apply_form_shortcode',
            'type'      => 'text',
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Apply Button Title', 'saasland' ),
            'id'        => 'apply_btn_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Apply Now', 'saasland' ),
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Before Apply Form', 'saasland' ),
            'subtitle'  => esc_html__( 'Place contents to show before the Apply Form', 'saasland' ),
            'id'        => 'before_form',
            'type'      => 'editor',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                //'tabindex' => 1,
                //'editor_css' => '',
                'teeny'         => false,
                //'tinymce' => array(),
                'quicktags'     => false,
            )
        ),

        // Styling
        array(
            'id'            => 'job_divide_start',
            'type'          => 'section',
            'title'         => esc_html__( 'Job Details Page Styling', 'saasland' ),
            'indent'        => true,
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),

        array(
            'title'         => esc_html__( 'Icons Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Job attribute icons color', 'saasland' ),
            'id'            => 'job_atts_icon_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.job_info .info_item i, .job_info .info_head i',
                'required'  => array( 'is_job_cpt', '=', '1' ),
            ),
        ),

        array(
            'title'         => esc_html__( 'Job Info Background', 'saasland' ),
            'subtitle'      => esc_html__( 'Job info box background color', 'saasland' ),
            'id'            => 'job_info_bg_color',
            'type'          => 'color',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'background'      => '.job_info',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Title Color', 'saasland' ),
            'id'            => 'job_atts_title_color',
            'type'          => 'color',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'color'      => '.job_info .info_item h6, .job_info .info_head h6',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Value Color', 'saasland' ),
            'id'            => 'job_atts_value_color',
            'type'          => 'color',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'color'      => '.job_info .info_item p',
            ),
        ),
        array(
            'id'            => 'job_divide_end',
            'type'          => 'section',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'indent'        => false,
        ),
    )
));