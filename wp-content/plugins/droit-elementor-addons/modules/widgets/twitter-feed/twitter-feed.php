<?php

namespace DROIT_ELEMENTOR\Widgets;

if (!defined('ABSPATH')) {exit;}

class Droit_Addons_Twitter_Feed extends \Elementor\Widget_Base {

    public function get_name() {
        return 'dladdons-tweet-feed';
    }

    public function get_title() {
        return esc_html__( 'Twitter Feed', 'droit-addons' );
    }

    public function get_icon() {
        return 'eicon-twitter-embed addons-icon';
    }

    public function get_categories() {
        return ['droit_addons'];
    }

    public function get_keywords() {
        return [
            'Twitter',
            'Twitter form',
            'dl twitter',
            'social media',
            'twitter embed',
            'twitter field',
            'feedback',
            'social',
            'form',
            'dl',
            'droit'
        ];
    }

    protected function _register_controls() {

    //$this->register_switcher_feed_content_control();
    $this->register_twitter_feed_preset_controls();
    $this->register_twitter_feed_option_controls();
    $this->register_general_style_section();
    $this->register_users_style_section();
    $this->register_content_style_section();
    do_action('dl_widget/section/style/custom_css', $this);

    }

    //Preset
    public function register_twitter_feed_preset_controls(){

    	$this->start_controls_section(
            '_dl_twitter_feed_layout_section',
            [
                'label' => esc_html__('Twitter Key', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT, 
            ]
        );
   
        $this->register_twitter_feed_account_info();

        $this->end_controls_section();
    }

	//Account Ination
	protected function register_twitter_feed_account_info(){
		$this->add_control(
            '_dl_twitter_feed_account_name',
            [
                'label' => esc_html__('Account Name', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '@Kevin_David_K',
                'label_block' => false,
                'description' => esc_html__('Use @ sign with your account name.', 'droit-addons'),
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_consumer_key',
            [
                'label' => esc_html__('Consumer Key', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'aslJhY6WYpX8Vff0VD8hX4VZv',
                'description' => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Key.</a> Create a new app or select existing app and grab the <b>consumer key.</b>',
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_consumer_secret',
            [
                'label' => esc_html__('Consumer Secret', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'default' => 'GLMt2K9rpeWlhz6vDD1Ijq53JiIaEk80NiPnDJ60djsCmNy3GI',
                'description' => '<a href="https://apps.twitter.com/app/" target="_blank">Get Consumer Secret.</a> Create a new app or select existing app and grab the <b>consumer secret.</b>',
            ]
        );
 
	}
    //Option
    public function register_twitter_feed_option_controls(){
        $this->start_controls_section(
            '_dl_twitter_feed_options_layout_section',
            [
                'label' => esc_html__('Options', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT, 
            ]
        );
        $this->register_twitter_feed_options();

        $this->end_controls_section();
    }

    protected function register_twitter_feed_options(){
        $this->add_responsive_control(
            '_dl_twitter_feed_type_col_type',
            [
                'label'          => __( 'Columns', 'droit-addons' ),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 4,
                'tablet_default' => 6,
                'mobile_default' => 12,
                'options' => [
                        '12' => '1',
                        '6'  => '2',
                        '4'  => '3',
                        '3'  => '4',
                        '5'  => '5',
                        '2'  => '6',
                ],
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_content_length',
            [
                'label'       => esc_html__('Content Length', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => '100',
            ]
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_column_spacing',
            [
                'label' => esc_html__('Row Spacing', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_post_limit',
            [
                'label'       => esc_html__('Post Limit', 'droit-addons'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'label_block' => false,
                'default'     => 6,
                'separator'   => 'after'
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_show_avater',
            [
                'label'        => esc_html__('Show Avater', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('yes', 'droit-addons'),
                'label_off'    => __('no', 'droit-addons'),
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_show_name',
            [
                'label'        => esc_html__('Show Name', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('yes', 'droit-addons'),
                'label_off'    => __('no', 'droit-addons'),
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_show_favorites',
            [
                'label'        => esc_html__('Show Favorite', 'droit-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('yes', 'droit-addons'),
                'label_off'    => __('no', 'droit-addons'),
                'default'      => 'yes',
                'return_value' => 'yes',
                
            ]
        );
    }

    // twitter_feed General
	public function register_general_style_section(){

		$this->start_controls_section(
            '_dl_twitter_feed_general_style_section',
            [
                'label' => esc_html__('General', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            '_dl_twitter_feed_padding',
            [
                'label'      => esc_html__('Padding', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => '_dl_twitter_feed_background',
                'label'    => __('Background', 'droit-addons'),
                'types'    => ['gradient','classic'],
                'selector' => '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner',
            ]
        );

		$this->add_responsive_control(
            '_dl_twitter_feed_width',
            [
                'label' => esc_html__(' Width', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => '_dl_twitter_feed_border',
                'selector' => '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner',
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => '_dl_twitter_feed_box_shadow',
                'selector' => '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twiter-feed-wrapper-inner',
            ]
        );
		
	    $this->end_controls_section();   
	}


    public function register_users_style_section(){

        $this->start_controls_section(
            '_dl_twitter_feed_label_style_section',
            [
                'label' => esc_html__('Users', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_label_tabs' );


        $this->start_controls_tab( '_dl_label_style',
            [ 
                'label' => esc_html__( 'General Style', 'droit-addons')
            ] 
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_logo_size',
            [
                'label'      => __('Image Size', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-social a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-twiter-feed-wrapper img.droit-feed-profile-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            '_dl_twitter_feed_logo_position',
            [
                'label'      => __('Image Position Left', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-social' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-twiter-feed-wrapper img.droit-feed-profile-image' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_logo_position_top',
            [
                'label'      => __('Image Position Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-social' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .droit-twiter-feed-wrapper img.droit-feed-profile-image' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            '_dl_twitter_feed_user_name_heading',
            [
                'label' => __( 'User Name', 'droit-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_user_name_color',
            [
                'label'     => __('Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_user_name__position',
            [
                'label'      => __('Left', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-name' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_user_name__margin',
            [
                'label'      => __('Top', 'droit-addons'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => '_dl_twitter_feed_user_name_typography',
                'label'    => __('Typography', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-name',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_label_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );

         $this->add_control(
            '_dl_twitter_feed_user_name_heading_hover',
            [
                'label' => __( 'User Name', 'droit-addons' ),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            '_dl_twitter_feed_user_name_color_hover',
            [
                'label' => __('Color', 'droit-addons'),
                'type'  => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper:hover .droit-twitter-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();

        $this->end_controls_section();   
    }

    public function register_content_style_section(){

        $this->start_controls_section(
            '_dl_twitter_feed_content_style_section',
            [
                'label' => esc_html__('Content', 'droit-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_dl_content_tabs' );

        $this->start_controls_tab( '_dl_content_style',
            [ 
                'label' => esc_html__( 'Style', 'droit-addons')
            ] 
        );

        $this->add_control(
            '_dl_twitter_feed_content_color',
            [
                'label'     => __('Text Color', 'droit-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_dl_twitter_feed_content_typography',
                'label' => __('Typography', 'droit-addons'),
                'selector' => '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-desc',
            ]
        );

        $this->add_responsive_control(
            '_dl_twitter_feed_content_spacing',
            [
                'label'  => __('Spacing', 'droit-addons'),
                'type'   => \Elementor\Controls_Manager::SLIDER,
                'range'  => [
                    'px' => [
                        'min'  => -200,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper .droit-twitter-desc' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        
        $this->end_controls_tab();

        $this->start_controls_tab( '_dl_content_hover',
            [ 
                'label' => esc_html__( 'Hover', 'droit-addons')
            ] 
        );
        
        $this->add_control(
            '_dl_twitter_feed_content_color_hover',
            [
                'label' => __('Text Color', 'droit-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .droit-twiter-feed-wrapper:hover .droit-twitter-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
                
        $this->end_controls_tabs();

        $this->end_controls_section();   
    }
        //Html render
    protected function render(){
    
        $settings = $this->get_settings_for_display();
        extract($settings);
        
        $token = get_option($this->get_id() . '_' . $_dl_twitter_feed_account_name . '_twitter_feed_token');
        $items = get_transient($this->get_id() . '_' . $_dl_twitter_feed_account_name . '_twitter_feed_cache');
    
        if (empty($_dl_twitter_feed_consumer_key) || empty($_dl_twitter_feed_consumer_secret)) {
                return;
            }
    
        if ($items === false) {

            if (empty($token)) {
                    $credentials = base64_encode($_dl_twitter_feed_consumer_key . ':' . $_dl_twitter_feed_consumer_secret);
    
                add_filter('https_ssl_verify', '__return_false');

                $response = wp_remote_post('https://api.twitter.com/oauth2/token', [
                    'method' => 'POST',
                    'httpversion' => '1.1',
                    'blocking' => true,
                    'headers' => [
                        'Authorization' => 'Basic ' . $credentials,
                        'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
                    ],
                    'body' => ['grant_type' => 'client_credentials'],
                ]);

                $body = json_decode(wp_remote_retrieve_body($response));

                if ($body) {
                    update_option($this->get_id() . '_' . $_dl_twitter_feed_account_name . '_twitter_feed_token', $body->access_token);
                    $token = $body->access_token;
                }

                $body = json_decode(wp_remote_retrieve_body($response));  
            }
    
            $args = array(
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => "Bearer $token",
                ),
            );
    
            add_filter('https_ssl_verify', '__return_false');

            $response = wp_remote_get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $_dl_twitter_feed_account_name . '&count=999&tweet_mode=extended', [
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
            ]);

            if (!is_wp_error($response)) {
                $items = json_decode(wp_remote_retrieve_body($response), true);
                //set_transient($this->get_id() . '_' . $this->get_twitter_feed_settings('_dl_twitter_feed_account_name') . '_twitter_feed_cache', $items, 1800);
            }
            }
    
            if (empty($items)) {
                return;
            }
    
            $items = array_splice( $items, 0, $_dl_twitter_feed_post_limit );
    
            //Columns
            $columns_desc = !empty($_dl_twitter_feed_type_col_type) ? $_dl_twitter_feed_type_col_type : 4;
    
            //Wrapper class
            $this->add_render_attribute( 'twitter_feed_wraper', 'class', [
                "droit-twiter-feed-wrapper",
                "dl_col_lg_{$columns_desc}",
                "dl_col_sm_{$columns_desc}",
                "dl_col_sm_{$columns_desc}",
            ] );
    
            $wrapper_attributes = $this->get_render_attribute_string( 'twitter_feed_wraper' );
            
            $this->add_render_attribute( 'twitter_feed_inner_wraper', 'class', [
                "dl_social_feed_wrapper",
                "dl_style_06",
                "droit-twiter-feed-wrapper-inner",
            ] );
    
            $wrapper_attributes_inner = $this->get_render_attribute_string( 'twitter_feed_inner_wraper' );
    
            //Account information
            $desc_length = !empty($_dl_twitter_feed_content_length) ? $_dl_twitter_feed_content_length : '';
        ?>
    
        <div class="dl_row">
        <?php foreach ($items as $index => $item): 

            $full_text      = ($item['full_text']) ?? '';
            $description    = strlen($full_text) > $desc_length ? '...' : '';
            $link_free_text = isset($item['entities']['urls'][0]['url'])?str_replace($item['entities']['urls'][0]['url'], '', $full_text):$full_text;
            $details_url    = @$item['user']['screen_name'] . '/status/' . $item['id_str'];

            ?>
            <div <?php echo $wrapper_attributes;?>>
                <div <?php echo $wrapper_attributes_inner;?>>
                    <a href="//twitter.com/<?php echo esc_url($details_url) ?? ''; ?>" target="_blank">
                        <p class="dl_desc droit-twitter-desc"> <?php echo esc_attr(substr( $link_free_text, 0, $desc_length) . $description); ?> </p>
                    </a>
                    
                    <div class="top_social_feed">
                        <div class="dl_prodile_info">
                            <?php if ($_dl_twitter_feed_show_avater === 'yes'): ?>
                                <img src="<?php echo esc_url($item['user']['profile_image_url_https']) ?? ''; ?>" alt="#" class="dl_client_thumb droit-feed-profile-image">
                            <?php endif;?>

                            <?php if ($_dl_twitter_feed_show_name === 'yes'): 
                                ?>
                                <h4 class="dl_name">
                                    <a href="//twitter.com/<?php if(!empty($_dl_twitter_feed_account_name))echo esc_html($_dl_twitter_feed_account_name); ?>" target="_blank" class="droit-twitter-name"><?php echo esc_html($item['user']['name']) ?? ''; ?></a>
                                </h4>
                            <?php endif;?>
                        </div>

                        <?php if($_dl_twitter_feed_show_favorites === 'yes'): ?>
                            <a href="//twitter.com/<?php echo $details_url; ?>" target="_blank" class="social_icon">
                                <?php echo esc_html( $item['favorite_count'] ) ?? 0; ?>
                                
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
            </div>
        <?php 
    }

    protected function content_template(){}
}
