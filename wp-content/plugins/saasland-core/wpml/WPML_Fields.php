<?php
defined( 'ABSPATH' ) || die();

require_once __DIR__ . '/widgets/App_info.php';
require_once __DIR__ . '/widgets/Tabs_horizontal.php';
require_once __DIR__ . '/widgets/Appart_features.php';
require_once __DIR__ . '/widgets/Appart_hero_buttons.php';
require_once __DIR__ . '/widgets/Appart_pricing_table.php';
require_once __DIR__ . '/widgets/Appart_screen_feature.php';
require_once __DIR__ . '/widgets/Appart_testimonials.php';
require_once __DIR__ . '/widgets/Navbar_buttons.php';
require_once __DIR__ . '/widgets/Circle_counter.php';
require_once __DIR__ . '/widgets/Client_logos.php';
require_once __DIR__ . '/widgets/Counter.php';
require_once __DIR__ . '/widgets/Get_app_download.php';
require_once __DIR__ . '/widgets/Event_schedule.php';
require_once __DIR__ . '/widgets/Features.php';
require_once __DIR__ . '/widgets/Features_with_image_dark.php';
require_once __DIR__ . '/widgets/Features_tabs.php';
require_once __DIR__ . '/widgets/Hero_buttons.php';
require_once __DIR__ . '/widgets/Hero_videos.php';
require_once __DIR__ . '/widgets/Hero_integrations.php';
require_once __DIR__ . '/widgets/Hero_app_animated_images.php';
require_once __DIR__ . '/widgets/Hotspots.php';
require_once __DIR__ . '/widgets/Icons.php';
require_once __DIR__ . '/widgets/Image_carousel5.php';
require_once __DIR__ . '/widgets/Integrations.php';
require_once __DIR__ . '/widgets/Integrations_row_logos.php';
require_once __DIR__ . '/widgets/Map3_locations.php';
require_once __DIR__ . '/widgets/Map_info_items.php';
require_once __DIR__ . '/widgets/Pricing_tables.php';
require_once __DIR__ . '/widgets/Pricing_comparison_features.php';
require_once __DIR__ . '/widgets/Processes_rows.php';
require_once __DIR__ . '/widgets/Processes_rows2.php';
require_once __DIR__ . '/widgets/Prototype_features_rows.php';
require_once __DIR__ . '/widgets/Serialized_feature_list.php';
require_once __DIR__ . '/widgets/Service_boxes.php';
require_once __DIR__ . '/widgets/Services_list.php';
require_once __DIR__ . '/widgets/Slider_slides.php';
require_once __DIR__ . '/widgets/Integrations_solar_planets.php';
require_once __DIR__ . '/widgets/Table_tabs.php';
require_once __DIR__ . '/widgets/Team_members.php';
require_once __DIR__ . '/widgets/Testimonials.php';
require_once __DIR__ . '/widgets/Testimonials2.php';
require_once __DIR__ . '/widgets/Testimonials3.php';
require_once __DIR__ . '/widgets/Two_column_features.php';
require_once __DIR__ . '/widgets/Two_column_features2.php';

$widgets_map = [
    /**
     * Alert
     */
    'saasland_alerts_box' => [
        'fields'     => [
            [
                'field' => 'alert_title',
                'type' => __('Alert Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'alert_description',
                'type' => __('Alert Description', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * App Info
     */
    'saasland_appart_app_info' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('App Info: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('App Info: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\App_info',
    ],

    /**
     * Tabs Horizontal
     */
    'Saasland_tabs_horizontal' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Tabs Horizontal: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Tabs_horizontal',
    ],

    /**
     * Call to Action
     */
    'saasland_appart_c2a' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Call to Action: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Call to Action: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Call to Action: Button Label', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Features
     */
    'saasland_appart_features' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Features: Section Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Features: Section Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Appart_features',
    ],

    /**
     * App Hero
     */
    'saasland_appart_hero' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('App Hero: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('App Hero: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Appart_hero_buttons',
    ],

    /**
     * Hero (Parallax Images)
     */
    'Appart_parallax_hero' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero (Parallax Images): Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero (Parallax Images): Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Hero (Parallax Images): Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Pricing Table
     */
    'Saasland_appart_pricing_table' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Pricing Table: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Pricing Table: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Appart_pricing_table',
    ],

    /**
     * Products (Grid View)
     */
    'Saasland_appart_products' => [
        'fields' => [
            [
                'field' => 'btn_label',
                'type' => __('Products (Grid View): Button label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Pricing Table: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Screen Features
     */
    'saasland_appart_screen_feature' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Screen Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Screen Features: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Appart_screen_feature',
    ],

    /**
     * Single info with icon
     */
    'Saasland_appart_single_info_with_icon' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Single info with icon: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Single info with icon: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Single Video 02
     */
    'Saasland_appart_single_video' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Single Video 02: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Single Video 02: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'play_btn_label',
                'type' => __('Single Video 02: Play button label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Testimonials Style
     */
    'saasland_appart_testimonials' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Testimonials Style: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Testimonials Style: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Appart_testimonials',
    ],

    /**
     * Blog Posts
     */
    'saasland_blog' => [
        'fields' => [
            [
                'field' => 'btn_title',
                'type' => __('Blog Posts: Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Bubble Features
     */
    'saasland_bubble_features' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Bubble Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Bubble Features: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_title',
                'type' => __('Bubble Features: Button title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Bubble_features',
    ],

    /**
     * Saasland Navbar
     */
    'saasland-navbar' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Navbar_buttons',
    ],

    /**
     * Text Button with Icon
     */
    'saasland_button_icons' => [
        'fields' => [
            [
                'field' => 'btn_label',
                'type' => __('Text Button with Icon: Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Call to Action
     */
    'saasland_c2a' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Call to Action: Title', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Call to Action: Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Circle Counter
     */
    'saasland_circle_counter' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Circle_counter',
    ],

    /**
     * Client Logos
     */
    'saasland_client_logos' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Client_logos',
    ],

    /**
     * Date Countdown
     */
    'saasland_countdown' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Date Countdown: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Stats counter
     */
    'saasland_stats_counter' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Stats counter: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'desc',
                'type' => __('Stats counter: Description Text', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Counter',
    ],

    /**
     * Domain Search form
     */
    'saasland_domain_form' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Domain search form: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Download Section
     */
    'saasland-download-sec' => [
        'fields' => [
            [
                'field' => 'contents',
                'type' => __('Download Section: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Get_app_download',
    ],

    /**
     * Event Schedule Tabs
     */
    'saasland_event_schedule' => [
        'fields' => [
            [
                'field' => 'sec_title',
                'type' => __('Event Schedule Tabs: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Event_schedule',
    ],

    /**
     * FAQ with Tabs
     */
    'saasland_faq' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('FAQ with Tabs: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Features
     */
    'saasland_main_features' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Features: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Features',
    ],

    /**
     * Features Tabs
     */
    'Saasland_features_tabs' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Features_tabs',
    ],

    /**
     * Features (Vertical)
     */
    'Saasland_features_vertical' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Features: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Features',
    ],

    /**
     * Features with Image (Dark)
     */
    'Saasland_features_with_image' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Features_with_image_dark',
    ],

    /**
     * Features with Image (White)
     */
    'Saasland_features_with_image_white' => [
        'fields' => [],
        'integration-class' => 'SaaslandCore\WPML\Features_with_image_white',
    ],

    /**
     * Features with Shapes (Dark)
     */
    'Saasland_features_with_shapes' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Features with Shapes (Dark): Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'desc',
                'type' => __('Features with Shapes (Dark): Description', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Features with Shapes (Dark): Button Title', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Features_with_shapes',
    ],

    /**
     * Hero Mobile
     */
    'saasland-hero-app' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero Mobile: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero Mobile: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_app_animated_images', 'SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Hero Section
     */
    'saasland_hero' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero Section: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero Section: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'upper_title',
                'type' => __('Hero Section: Upper Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Hero_buttons',
    ],

    /**
     * Hero SEO
     */
    'saasland_hero_seo' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero SEO: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero SEO: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => 'SaaslandCore\WPML\Hero_buttons',
    ],

    /**
     * Hero Video Slides
     */
    'saasland_hero_videos' => [
        'fields' => [
            [
                'field' => 'content',
                'type' => __('Hero Video Slides: Contents', 'saasland-core'),
                'editor_type' => 'VISUAL'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_videos', 'SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Hero Integrations
     */
    'saasland_hero_integration' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero Integrations: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_integrations', 'SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Hero ERP
     */
    'Saasland_hero_erp' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Hero ERP: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero ERP: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Hero CRM
     */
    'saasland_hero_crm' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero CRM Software: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero CRM Software: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_app_animated_images', 'SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Hero with Background Image
     */
    'saasland_hero_with_bg_img' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Hero with Background Image: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Hero with Background Image: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hero_buttons'],
    ],

    /**
     * Image Hotspots
     */
    'saasland_hotspot' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Image Hotspots: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Image Hotspots: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Hotspots'],
    ],

    /**
     * Icon Boxes
     */
    'saasland_icon_boxes' => [
        'integration-class' => ['SaaslandCore\WPML\icons'],
    ],

    /**
     * Saasland Carousels
     */
    'saasland-image-carousels' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Saasland Carousels: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Saasland Carousels: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Image_carousel5'],
    ],

    /**
     * Integrations
     */
    'saasland_integrations' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Integrations: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Integrations: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Integrations'],
    ],

    /**
     * Row Integrations
     */
    'saasland_integrations_row' => [
        'integration-class' => ['SaaslandCore\WPML\Integrations_row_logos'],
    ],

    /**
     * Jobs
     */
    'saasland_jobs' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Jobs: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Jobs: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Integrations'],
    ],

    /**
     * Locations
     */
    'saasland_map3' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Locations: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Locations: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Map3_locations'],
    ],

    /**
     * Login Form
     */
    'saasland-login' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Login Form: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Login Form: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Login Form: Button Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'signup_link_text',
                'type' => __('Login Form: Sing up link text', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'forget_link_label',
                'type' => __('Login Form: Forget Password Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'remember_label',
                'type' => __('Login Form: Remember Checkbox Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Embed Map with Info
     */
    'saasland_map' => [
        'integration-class' => ['SaaslandCore\WPML\Map_info_items'],
    ],

    /**
     * Saasland Map
     */
    'saasland_map2' => [
        'fields' => [
            [
                'field' => 'address',
                'type' => __('Saasland Map: Address', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Pricing Table
     */
    'saasland-pricing-table' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Pricing Table: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Pricing Table: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Pricing_tables'],
    ],

    /**
     * Pricing Plan Comparison
     */
    'saasland_pricing_table_features' => [
        'fields' => [
            [
                'field' => 'feature_title',
                'type' => __('Pricing Plan Comparison: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan1_title',
                'type' => __('Pricing Comparison: Plan 01 Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan1_price',
                'type' => __('Pricing Comparison: Plan 01 Price', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan1_duration',
                'type' => __('Pricing Comparison: Plan 01 Duration', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn1_label',
                'type' => __('Pricing Comparison: Plan 01 Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],

            [
                'field' => 'plan2_title',
                'type' => __('Pricing Comparison: Plan 02 Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan2_price',
                'type' => __('Pricing Comparison: Plan 02 Price', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan2_duration',
                'type' => __('Pricing Comparison: Plan 02 Duration', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn2_label',
                'type' => __('Pricing Comparison: Plan 02 Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],

            [
                'field' => 'plan3_title',
                'type' => __('Pricing Comparison: Plan 03 Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan3_price',
                'type' => __('Pricing Comparison: Plan 03 Price', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'plan3_duration',
                'type' => __('Pricing Comparison: Plan 03 Duration', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn3_label',
                'type' => __('Pricing Comparison: Plan 03 Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Pricing_comparison_features'],
    ],

    /**
     * Pricing Table Tabs Carousel
     */
    'saasland-pricing-table-tabs-carousel' => [
        'fields' => [
            [
                'field' => 'tab1_title',
                'type' => __('Pricing Table Tabs: Tab 01 Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'tab2_title',
                'type' => __('Pricing Table Tabs: Tab 02 Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Pricing_tabs_tables', 'SaaslandCore\WPML\Pricing_tabs_tables2'],
    ],

    /**
     * Processes
     */
    'Saasland_processes' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Processes: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Processes_rows', 'SaaslandCore\WPML\Processes_rows2'],
    ],

    /**
     * Prototype Features
     */
    'Saasland_prototype_features' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Prototype Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Prototype_features_rows'],
    ],

    /**
     * Check URL Form
     */
    'saasland_seo_check_form' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Check URL Form: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Check URL Form: Button Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'url_placeholder',
                'type' => __('Check URL Form: URL Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Serialized Features
     */
    'saasland_serialized_features' => [
        'fields' => [
            [
                'field' => 'feature_title',
                'type' => __('Serialized Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'feature_subtitle',
                'type' => __('Serialized Features: Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Serialized_feature_list'],
    ],

    /**
     * Services
     */
    'saasland_services' => [
        'fields' => [
            [
                'field' => 'btn_label',
                'type' => __('Services: Read More Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Services & Features with Shapes
     */
    'saasland_services_shapes' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Services & Features: Section Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Services & Features: Section Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Service_boxes', 'SaaslandCore\WPML\Services_list'],
    ],

    /**
     * Signup Form
     */
    'saasland-signup' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Signup Form: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'contents',
                'type' => __('Signup Form: Left Contents', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'forget_link_label',
                'type' => __('Signup Form: Forget Password Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'submit_label',
                'type' => __('Signup Form: Button Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'username_label',
                'type' => __('Signup Form: Username Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'username_place',
                'type' => __('Signup Form: Username Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'email_label',
                'type' => __('Signup Form: Email Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'email_place',
                'type' => __('Signup Form: Email Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'pwd_label',
                'type' => __('Signup Form: Password Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'pwd_place',
                'type' => __('Signup Form: Password Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Single Feature
     */
    'saasland_single_feature' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Single Feature: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Single Feature: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'btn_title',
                'type' => __('Single Feature: Link Title', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Featured Video
     */
    'saasland_single_video' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Featured Video: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Featured Video: Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'author_name',
                'type' => __('Featured Video: Author', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'designation',
                'type' => __('Featured Video: Designation', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'bg_title',
                'type' => __('Featured Video: Background Title', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
    ],

    /**
     * Saasland Slider
     */
    'saasland_slider' => [
        'integration-class' => ['SaaslandCore\WPML\Slider_slides'],
    ],

    /**
     * Integrations
     */
    'saasland_solar-system' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Integrations: Section Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Integrations: Section Subtitle', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Integrations_solar_planets'],
    ],

    /**
     * Subscribe form
     */
    'saasland_subsciribe' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Subscribe form: Section Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Subscribe form: Section Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'email_placeholder',
                'type' => __('Subscribe form: Email Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'name_placeholder',
                'type' => __('Subscribe form: Name Placeholder', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Subscribe form: Button Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Table Tabs
     */
    'saasland_table_tabs' => [
        'integration-class' => ['SaaslandCore\WPML\Table_tabs'],
    ],

    /**
     * Saasland Tabs
     */
    'saasland_tabs' => [
        'integration-class' => ['SaaslandCore\WPML\Table_tabs'],
    ],

    /**
     * Tabs with Icon
     */
    'saasland_tabs_with_icon' => [
        'integration-class' => ['SaaslandCore\WPML\Table_tabs'],
    ],

    /**
     * Tabs with Icon
     */
    'Saasland_team' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Team: Section Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle_text',
                'type' => __('Team: Section Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn_title',
                'type' => __('Team: Button Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Team_members'],
    ],

    /**
     * Saasland Testimonials
     */
    'saasland_testimonial' => [
        'fields' => [
            [
                'field' => 'title_text',
                'type' => __('Saasland Testimonials: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'desc',
                'type' => __('Saasland Testimonials: Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Testimonials', 'SaaslandCore\WPML\Testimonials2'],
    ],

    /**
     * Bubble Testimonials
     */
    'saasland_testimonial_bubble' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Bubble Testimonials: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Bubble Testimonials: Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Testimonials'],
    ],

    /**
     * Testimonials with Ratting
     */
    'saasland_testimonial_ratting' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Testimonials with Ratting: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Testimonials with Ratting: Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Testimonials', 'SaaslandCore\WPML\Testimonials3'],
    ],

    /**
     * Testimonial Single
     */
    'Saasland_testimonial_single' => [
        'fields' => [
            [
                'field' => 'testimonial_text',
                'type' => __('Testimonial Single: Text', 'saasland-core'),
                'editor_type' => 'AREA'
            ],
            [
                'field' => 'author',
                'type' => __('Testimonial Single: Author', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'author_designation',
                'type' => __('Testimonial Single: Author Designation', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
    ],

    /**
     * Ticket Price Plan
     */
    'saasland_ticket_plan' => [
        'integration-class' => ['SaaslandCore\WPML\Tickets'],
    ],

    /**
     * Two Column Features
     */
    'saasland_two_column_features' => [
        'fields' => [
            [
                'field' => 'title',
                'type' => __('Two Column Features: Title', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'subtitle',
                'type' => __('Two Column Features: Subtitle', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
            [
                'field' => 'btn_label',
                'type' => __('Two Column Features: Button Label', 'saasland-core'),
                'editor_type' => 'LINE'
            ],
        ],
        'integration-class' => ['SaaslandCore\WPML\Two_column_features','SaaslandCore\WPML\Two_column_features2' ],
    ],
];


foreach ( $widgets_map as $widget_name => $data ) {
    $entry = [
        'conditions' => [
            'widgetType' => $widget_name,
        ],
        'fields' => $data['fields'],
    ];

    if ( isset( $data['integration-class'] ) ) {
        $entry['integration-class'] = $data['integration-class'];
    }

    $widgets[ $widget_name ] = $entry;
}